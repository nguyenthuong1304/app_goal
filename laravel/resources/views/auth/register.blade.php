@extends('app')

@section('title', 'Đăng ký người dùng')

@section('content')

  @include('nav')

  <div class="container my-5">
    <div class="row">
      <div class="mx-auto col-md-7">
        <div class="card">
          <h2 class="h4 card-header text-center sunny-morning-gradient text-white">{{ __('common.register') }}</h2>
          <div class="card-body">

            @include('error_card_list')

            <div class="user-form my-4">
              <form method="POST" action="{{ route('register') }} " enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                  <label for="name">
                      {{ __('common.form.username') }}
                    <small class="text-danger">（{{ __('common.form.required') }}）</small>
                  </label>
                  <input class="form-control" type="text" id="name" name="name" value="{{ old('name') }}" placeholder="{{ __('common.form.username_plhd') }}">
                </div>
                <div class="form-group">
                  <label for="email">
                      {{ __('common.form.email') }}
                    <small class="text-danger">（{{ __('common.form.required') }}）</small>
                  </label>
                  <input class="form-control" type="text" id="email" name="email" value="{{ old('email') }}" placeholder="{{ __('common.form.email_plhd') }}">
                </div>
                <div class="form-group">
                  <label for="password">
                      {{ __('common.form.password') }}
                    <small class="text-danger">（{{ __('common.form.required') }}）</small>
                  </label>
                  <input class="form-control" type="password" id="password" name="password" placeholder="{{ __('common.form.password_plhd') }}">
                </div>
                <div class="form-group">
                  <label for="password_confirmation">
                      {{ __('common.form.password_conf') }}
                    <small class="text-danger">（{{ __('common.form.required') }}）</small>
                  </label>
                  <input class="form-control" type="password" id="password_confirmation" name="password_confirmation" placeholder="{{ __('common.form.password_conf_plhd') }}">
                </div>
                <div class="form-group">
                  <label for="wake_up_time">
                      {{ __('common.form.goal') }}
                    <small class="blue-grey-text">（04:00 〜 10:00）</small>
                    <p class="mb-1 small text-default">{{ __('common.form.text_goal') }}</p>
                  </label>
                  <!-- 動作確認用に、目標起床時間の設定可能時間帯の制限を解除中。　min="04:00" max="10:00" -->
                  <input class="form-control" type="time" id="wake_up_time" name="wake_up_time"
                  value="{{
                    null !== old('wake_up_time') ?
                    Carbon\Carbon::parse(old('wake_up_time'))->format('H:i') :
                    '07:00'
                  }}">
                </div>
                <div class="form-group">
                  <label for="profile_image">
                      {{ __('common.form.avatar') }}
                    <small class="blue-grey-text">（{{ __('common.form.option') }}）</small>
                  </label>
                  <input  type="file" id="profile_image" name="profile_image" accept="image/*">
                </div>
                <button class="btn btn-block peach-gradient mt-2 mb-2" type="submit">
                  <span class="h6">{{ __('common.register') }}</span>
                </button>
              </form>
              <div class="mt-3">
                <a href="{{ route('login') }}" class="text-primary">{{ __('common.form.login_text') }}</a>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
