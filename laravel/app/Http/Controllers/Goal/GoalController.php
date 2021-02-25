<?php

namespace App\Http\Controllers\Goal;

use App\Http\Requests\GoalRequest;
use App\Models\Goal;
use App\Models\Meeting;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\MeetingRequest;
use App\Client\ZoomJwtClient;
use Carbon\Carbon;
class GoalController extends Controller
{

    private $client;
    /**
     * @var Goal
     */

    public function __construct(ZoomJwtClient $client) {
        $this->client = $client;
        $this->authorizeResource(Goal::class, 'goal');
    }

    public function index(Request $request)
    {
        $search = $request->input('search');
        $query = Goal::query();
        if ($search !== null){
            //全角スペースを半角に
            $search_split = mb_convert_kana($search,'s');

            //空白で区切る
            $search_split2 = preg_split('/[\s]+/', $search_split,-1,PREG_SPLIT_NO_EMPTY);

            //単語をループで回す
            foreach($search_split2 as $value)
            {
                $query->where('topic','like','%'.$value.'%')
                      ->orWhere('agenda','like','%'.$value.'%');
            }
        };

        ### ミーティング一覧を、無限スクロールで表示 ###
        $goals = $query->with(['user'])
                          ->orderBy('created_at', 'desc')
                          ->paginate(5);

        if ($request->ajax()) {
            return response()->json([
                'html' => view('goals.list', ['goals' => $goals])->render(),
                'next' => $goals->appends($request->only('search'))->nextPageUrl()
            ]);
        }

        return view('goals.index', [
            'goals' => $goals,
            'search' => $search
        ]);
    }

    public function create()
    {
        return view('goals.create');
    }

    public function store(GoalRequest $request, Goal $goal)
    {
        $request->session()->regenerateToken();
        $data = $request->all();
        $data['user_id'] = auth()->user()->id;
        $goal->fill($data)->save();
        if (isset($data['remind_update'])) {
            // handle job send mail
        }
        session()->flash('msg_success', 'Thêm mục tiêu cho bản thân thành công!');

        return redirect()->route('goals.index');
    }

    public function destroy(Goal $goal)
    {
        $goal->delete()
            ? session()->flash('msg_success', 'Xoá mục tiêu thành công')
            : session()->flash('msg_error', 'Có lỗi vui lòng thử lại');

        return redirect()->route('goals.index');
    }

    public function edit(Goal $goal)
    {
        if ($goal->status || $goal->progress == 100) {
            session()->flash('msg_warning', 'Mục tiêu này đã hoàn thành');

            return redirect()->route('goals.index');
        }
        return view('goals.edit', ['goal' => $goal]);
    }

    public function update(GoalRequest $request, Goal $goal)
    {
        $id = $goal->id;
        $data = $request->validated();
        if ((isset($data['status']) && $data['status']) || $data['progress'] == 100) {
            $data['status'] = true;
            $data['progress'] = 100;
            $data['end_time'] = date('Y-m-d');
        }

        $goal->fill($data)->save();
        session()->flash('msg_success', 'Cập nhật mục tiêu thành công');

        return redirect()->route('goals.index');
    }

}
