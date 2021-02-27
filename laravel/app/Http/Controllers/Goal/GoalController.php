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
//            $search_split = mb_convert_kana($search,'s');
            $search_split2 = preg_split('/[\s]+/', $search,-1,PREG_SPLIT_NO_EMPTY);
            foreach($search_split2 as $value)
            {
                $query->where('topic','like','%'.$value.'%')
                      ->orWhere('agenda','like','%'.$value.'%');
            }
        };

        $goals = $query->with(['user'])
                       ->orderBy('is_pin', 'desc')
                       ->orderBy('created_at', 'desc')
                       ->orderBy('priority', 'desc')
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

    public function show(Goal $goal)
    {   
        $goal->load('histories');
        return view('goals.modal_detail', ['goal' => $goal])->render();
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

    public function updateProgress(Request $request, Goal $goal)
    {
        $this->authorize('updateProgress', $goal);
        if ($request->ajax()) {
           $dataHistory = $request->validate([
                'body' => 'required|max:200',
                'progress' => 'required|lte:100|gte:0|numeric',
            ]);
            $dataHistory['previos'] = $goal->progress;

            if ($dataHistory['progress'] == 100) {
                $goal->status = true;
                $goal->end_time = date('Y-m-d');
            }
            $goal->progress = $dataHistory['progress'];
            $goal->save();
            $goal->histories()->create([
                'data' => $dataHistory,
                'user_id' => $goal->user_id,
            ]);

            if ($dataHistory['progress'] <= 25) {
                $color = 'bg-danger';
            } else if ($dataHistory['progress'] >= 25 && $dataHistory['progress'] < 49) {
                $color = 'bg-warning';
            } else if ($dataHistory['progress'] >= 49 && $dataHistory['progress'] <= 75) {
                $color = 'bg-info';
            } else {
                $color = 'bg-success';
            }

            if($goal->status) {
                $status = '<b class="text-success">Đã xong</b>';
            } elseif(!$goal->status && strtotime($goal->end_time) < strtotime('now')) {
                $status = '<b class="text-danger">Chưa xong</b>';
            } else {
                $status = '<b class="text-info">Đang thực hiện</b>';
            }

            return response()->json([
                'progress' => $dataHistory['progress'],
                'color' => $color,
                'status' => $status,
            ], 200);
        }
    }
}
