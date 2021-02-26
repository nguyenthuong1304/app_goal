<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Doctrine\DBAL\Query\QueryException;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * ログイン後の処理
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * @override \Illuminate\Http\Foundation\Auth\AuthenticatesUsers
     */
    protected function authenticated(Request $request)
    {
        // フラッシュメッセージを表示
        session()->flash('msg_success', __('common.msg.login_success'));
        return redirect('/');
    }

    // ゲストユーザーログイン
    public function guestLogin()
    {
        if (Auth::loginUsingId(config('user.guest_user_id'))) {
            session()->flash('msg_success', __('common.msg.login_guest'));
            return redirect('/');
        }

        session()->flash('msg_error', __('common.msg.login_guest_fail'));
        return redirect('/');
    }

    /**
     * ユーザーをログアウトさせる
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * @override \Illuminate\Http\Foundation\Auth\AuthenticatesUsers
     */
    protected function loggedOut(Request $request)
    {
        $this->guard()->logout();
        $request->session()->regenerateToken();
        $request->session()->invalidate();

        // フラッシュメッセージを表示
        session()->flash('msg_success', __('common.msg.logout_success'));
        return redirect('/');
    }

    public function redirectToProvider($driver)
    {
        return Socialite::driver($driver)->redirect();
    }

    public function handleProviderCallback($driver)
    {
        try {
            $user = Socialite::driver($driver)->user();
        } catch (\Exception $e) {
            return redirect()->route('login');
        }
        $existingUser = User::where('email', $user->getEmail())->first();
        if ($existingUser) {
            auth()->login($existingUser, true);
        } else {
            $countExistingName = User::where('name', 'like', "%{$user->getName()}%")->count();
            $newUser                    = new User;
            $newUser->provider_name     = $driver;
            $newUser->provider_id       = $user->getId();
            $newUser->name              = $countExistingName > 0
                                            ? $user->getName() . $countExistingName
                                            : $user->getName();
            $newUser->email             = $user->getEmail();
            $newUser->email_verified_at = now();
            $newUser->avatar            = $user->getAvatar();
            $newUser->save();
            auth()->login($newUser, true);
        }

        session()->flash('msg_success', __('common.msg.login_success'));
        return redirect($this->redirectPath());
    }
}
