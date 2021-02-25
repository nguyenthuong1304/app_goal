<?php

namespace App\Http\Controllers\Goal;

use App\Http\Requests\GoalRequest;
use App\Models\Goal;
use App\Models\Meeting;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\MeetingRequest;
use App\Client\ZoomJwtClient;

class GoalController extends Controller
{

    private $client;
    /**
     * @var Goal
     */
    private $goal;

    public function __construct(ZoomJwtClient $client, Goal $goal) {
        $this->client = $client;
        $this->goal = $goal;
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

    public function store(GoalRequest $request)
    {
        // 二重送信対策
        $request->session()->regenerateToken();
        $data = $request->all();
        $data['user_id'] = auth()->user()->id;
        $this->goal->fill($data)->save();
        session()->flash('msg_success', 'Thêm mục tiêu cho bản thân thành công!');

        return redirect()->route('goals.index');
        // ZoomAPIへ、ミーティング作成のリクエスト
//        $path = 'users/' . config('zoom.zoom_account_email') . '/goals';
//        $response = $this->client->zoomPost($path, $request->zoomParams());
//
//        // レスポンスのミーティング開始日時を、日本時刻に変換
//        $body = json_decode($response->getBody(), true);
//        $body['start_time'] = $this->client->toUnixTimeStamp($body['start_time'], $body['timezone']);
//        $body['start_time'] = date('Y-m-d\TH:i:s', $body['start_time']);
//
//        // 作成したミーティング情報をDBに保存
//        if ($response->getStatusCode() === 201) {  // 201：ミーティング作成成功のHTTPステータスコード
//            $meeting
//                ->fill($body + [ 'meeting_id' => $body['id'], 'user_id' => $request->user()->id ])
//                ->save();
//
//            session()->flash('msg_success', 'ミーティングを作成しました');
//            return redirect()->route('goals.index');
//        }

        // エラーページにリダイレクト
        return view('errors.meeting', ['method' => '作成']);
    }

    public function destroy(Meeting $meeting)
    {
        // ZoomAPIにミーティング削除のリクエスト
        $id = $meeting->meeting_id;
        $path = 'goals/' . $id;
        $response = $this->client->zoomDelete($path);

        // DBからもミーティングを削除
        if ($response->getStatusCode() === 204) {  // 204：ミーティング削除成功のHTTPステータスコード
            $meeting->delete();

            session()->flash('msg_success', 'ミーティングを削除しました');

            return redirect()->route('goals.index');
        }

        // エラーページにリダイレクト
        return view('errors.meeting', ['method' => '削除']);
    }

    public function edit(Meeting $meeting)
    {
        return view('goals.edit', ['meeting' => $meeting]);
    }

    public function update(MeetingRequest $request, Meeting $meeting)
    {
        // ZoomAPIにミーティング更新のリクエスト
        $id = $meeting->meeting_id;
        $path = 'goals/' . $id;
        $response = $this->client->zoomPatch($path, $request->zoomParams());

        // DBに更新後のミーティングを保存
        if ($response->getStatusCode() === 204) {  // 204：ミーティング更新成功のHTTPステータスコード
            $meeting->fill($request->validated())->save();

            session()->flash('msg_success', 'ミーティングを編集しました');

            return redirect()->route('goals.index');
        }

        // エラーページにリダイレクト
        return view('errors.meeting', ['method' => '更新']);
    }

}
