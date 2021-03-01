<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UpdatePasswordRequest;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    private $user;

    public function __construct(User $user) {
        $this->user = $user;
    }

    public function show(string $name, Request $request)
    {
        $user = $this->user->where('name', $name)
                           ->with('profile')
                           ->first();

        $articles = $user->articles()
                         ->orderBy('created_at', 'desc')
                         ->paginate(5);

        if ($request->ajax()) {
            return response()->json([
                'html' => view('articles.list', ['articles' => $articles])->render(),
                'next' => $articles->nextPageUrl()
            ]);
        }

        return view('users.show', [
            'user' => $user,
            'articles' => $articles,
        ]);
    }

    public function edit(string $name)
    {
        $user = User::with('profile')->where('name', $name)->first();
        $this->authorize('update', $user);

        return view('users.edit', ['user' => $user]);
    }

    public function update(UserRequest $request, string $name)
    {
        $user = User::where('name', $name)->first();
        $this->authorize('update', $user);

        $user->fill($request->userParams())->save();

        session()->flash('msg_success', 'Cập nhật profile thành công');
        return redirect()->route('users.show',['name' => $user->name]);
    }

    public function editPassword(string $name)
    {
        $user = User::where('name', $name)->first();
        $this->authorize('update', $user);

        return view('users.edit_password', ['user' => $user]);
    }

    public function updatePassword(UpdatePasswordRequest $request, string $name)
    {
        $user = User::where('name', $name)->first();
        $this->authorize('update', $user);

        $user->password = Hash::make($request->input('new_password'));
        $user->save();

        session()->flash('msg_success', 'Cập nhật mật khẩu thành công');
        return redirect()->route('users.show',['name' => $user->name]);
    }

    public function likes(string $name, Request $request)
    {
        $user = $this->user->withCountAchievementDays($name);

        $articles = $user->likes()
                         ->orderBy('created_at', 'desc')
                         ->paginate(10);

        if ($request->ajax()) {
            return response()->json([
                'html' => view('articles.list', ['articles' => $articles])->render(),
                'next' => $articles->nextPageUrl()
            ]);
        }

        return view('users.likes', [
            'user' => $user,
            'articles' => $articles,
        ]);
    }

    public function followings(string $name)
    {
        $user = $this->user->withCountAchievementDays($name)->load('followings.followers');
        $followings = $user->followings()
                           ->orderBy('created_at', 'desc')
                           ->paginate(5);

        return view('users.followings', [
            'user' => $user,
            'followings' => $followings,
        ]);
    }

    public function followers(string $name)
    {
        $user = $this->user->withCountAchievementDays($name)->load('followers.followers');;
        $followers = $user->followers()
                          ->orderBy('created_at', 'desc')
                          ->paginate(5);

        return view('users.followers', [
            'user' => $user,
            'followers' => $followers,
        ]);
    }

    public function follow(Request $request, string $name)
    {
        $user = User::where('name', $name)->first();

        if ($user->id === $request->user()->id) {
            return abort('404', 'Cannot follow yourself.');
        }

        $request->user()->followings()->detach($user);
        $request->user()->followings()->attach($user);

        return ['name' => $name, 'count' => $user->followers()->count()];
    }

    public function unfollow(Request $request, string $name)
    {
        $user = User::where('name', $name)->first();

        if ($user->id === $request->user()->id) {
            return abort('404', 'Cannot follow yourself.');
        }

        $request->user()->followings()->detach($user);

        return ['name' => $name, 'count' => $user->followers()->count()];
    }

    public function profileUpdate(ProfileRequest $request)
    {
        $request->user()->profile()->updateOrCreate(
            ['user_id' => $request->user()->id],
            $request->all()
        );
        session()->flash('msg_success', 'Cập nhật chi tiết hồ sơ thành công');

        return redirect()->back();
    }
}
