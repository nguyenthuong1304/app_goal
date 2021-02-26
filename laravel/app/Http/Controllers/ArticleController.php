<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Comment;
use App\Models\Tag;
use App\Models\User;
use App\Http\Requests\ArticleRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Article::class, 'article');
    }

    public function index(Request $request, User $user)
    {
        $search = $request->input('search');
        $query = Article::query();
        if ($search !== null){
//            $search_split = mb_convert_kana($search,'s');
            $search_split2 = preg_split('/[\s]+/', $search,-1,PREG_SPLIT_NO_EMPTY);

            foreach($search_split2 as $value) {
                $query->where('body','like','%'.$value.'%');
            }
        };

        $articles = $query->with(['user', 'likes', 'tags'])
            ->withCount('likes', 'comments')
            ->orderByRaw('likes_count desc, created_at desc')
            ->paginate(5);

        if ($request->ajax()) {
            return response()->json([
                'html' => view('articles.list', ['articles' => $articles])->render(),
                'next' =>  $articles->appends($request->only('search'))->nextPageUrl()
            ]);
        }
        $ranked_users = $user->ranking();

        return view('articles.index', [
            'articles' => $articles,
            'ranked_users' => $ranked_users,
            'search' => $search
        ]);
    }

    public function create()
    {
        $user = Auth::user();
        $allTagNames = Tag::all()->map(function ($tag) {
            return ['text' => $tag->name];
        });

        return view('articles.create', [
            'allTagNames' => $allTagNames,
            'user' => $user
        ]);
    }

    public function store(ArticleRequest $request, Article $article)
    {
        $request->session()->regenerateToken();
        $user = $request->user();
        $article = $user->articles()->create($request->validated());
        $request->tags->each(function ($tagName) use ($article) {
            $tag = Tag::firstOrCreate(['name' => $tagName]);
            $article->tags()->attach($tag);
        });

        if (
            $user->wake_up_time->copy()->subHour($user->range_of_success) <= $article->created_at
            && $article->created_at <= $user->wakeup_time
        ) {
            $result = $user->achievement_days()->firstOrCreate([
                'date' => $article->created_at->copy()->startOfDay(),
            ]);

            if ($result->wasRecentlyCreated) {
                session()->flash('msg_achievement', '早起き達成です！');
            }
        } else {
            session()->flash('msg_success', '投稿が完了しました');
        }

        return redirect()->route('articles.index');
    }

    public function edit(Article $article)
    {
        $tagNames = $article->tags->map(function ($tag) {
            return ['text' => $tag->name];
        });
        $allTagNames = Tag::all()->map(function ($tag) {
            return ['text' => $tag->name];
        });

        return view('articles.edit', [
            'article' => $article,
            'tagNames' => $tagNames,
            'allTagNames' => $allTagNames,
        ]);
    }

    public function update(ArticleRequest $request, Article $article)
    {
        $article->fill($request->validated())->save();
        $article->tags()->detach();
        $request->tags->each(function ($tagName) use ($article) {
            $tag = Tag::firstOrCreate(['name' => $tagName]);
            $article->tags()->attach($tag);
        });
        session()->flash('msg_success', '投稿を編集しました');

        return redirect()->route('articles.index');
    }

    public function destroy(Article $article)
    {
        $article->delete();
        session()->flash('msg_success', 'Xóa bài viết thành công');

        return redirect()->route('articles.index');
    }

    public function show(Article $article, Comment $comment)
    {
        $comments = $article->comments()
                            ->orderBy('created_at', 'desc')
                            ->paginate(5);

        return view('articles.show', [
            'article' => $article,
            'comments' => $comments
        ]);
    }

    public function like(Request $request, Article $article)
    {
        $article->likes()->detach($request->user()->id);
        $article->likes()->attach($request->user()->id);

        return [
            'id' => $article->id,
            'countLikes' => $article->count_likes,
        ];
    }

    public function unlike(Request $request, Article $article)
    {
        $article->likes()->detach($request->user()->id);

        return [
            'id' => $article->id,
            'countLikes' => $article->count_likes,
        ];
    }
}

