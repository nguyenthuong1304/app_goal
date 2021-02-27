<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Goal;
use App\Models\Comment;
use App\Http\Requests\CommentRequest;

class CommentController extends Controller
{

    public function store(CommentRequest $request, Comment $comment)
    {
        $request->session()->regenerateToken();
        $request->article_id
            ? $objModel = Article::findOrFail($request->article_id)
            : $objModel = Goal::findOrFail($request->goal_id);
        
        $data = $request->all();
        $data['user_id'] = auth()->user()->id;
        $objModel->comments()->create($data);

        if ($request->ajax()) {
            return view('comments.list', ['comments' => $objModel->comments])->render();
        } else {
            session()->flash('msg_success', 'Đăng bình luận thành công');

            return back();
        }
    }

}
