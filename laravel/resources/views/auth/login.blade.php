@extends('app')

@section('title', 'ログイン')

@section('content')

  @include('nav')

  <div class="container mt-5">
    <div class="row">
      <div class="mx-auto col-md-7">
        <div class="card mt-3">
          <h2 class="h4 card-header text-center sunny-morning-gradient text-white">{{ __('common.login') }}</h2>
          <div class="card-body">

            @include('error_card_list')

            <div class="user-form my-4">
              <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-group">
                  <label for="email">{{ __('common.form.email') }}</label>
                  <input class="form-control" type="text" id="email" name="email" value="{{ old('email') }}">
                </div>

                <div class="form-group">
                  <label for="password">{{ __('common.form.password') }}</label>
                  <input class="form-control" type="password" id="password" name="password">
                </div>

                <!-- 次回から自動でログインする(remember meトークン) -->
                <input type="hidden" name="remember" id="remember" value="on">

                <div class="d-flex justify-content-between">
                  <button class="btn peach-gradient" type="submit" text-while>
                    {{ __('common.login') }}
                  </button>
                  <a href="{{ route('login.guest') }}" class="btn btn-default p-3">
                      {{ __('common.login_guest') }}
                  </a>
                </div>

              </form>

              <div class="mt-3">
                <a href="{{ route('register') }}" class="text-primary">{{ __('common.register') }}</a>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
