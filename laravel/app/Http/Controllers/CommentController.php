<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Models\Comment;
use App\Http\Requests\CommentRequest;

class CommentController extends Controller
{

    public function store(CommentRequest $request, Comment $comment)
    {
        $request->session()->regenerateToken();

        $article = Article::findOrFail($request->article_id);
        $data = $request->all();
        $data['user_id'] = auth()->user()->id;
        $article->comments()->create($data);

        session()->flash('msg_success', 'コメントを投稿しました');

        return back();
    }

}
