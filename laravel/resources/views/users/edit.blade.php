@extends('app')

@section('title', __('common.edit_profile'))

@include('nav')

@section('content')
<div class="container my-5">
    <div class="row">
      <div class="mx-auto col-md-7">
        <div class="card">
          <h2 class="h4 card-header text-center sunny-morning-gradient text-white">{{ __('common.edit_profile') }}</h2>
          <div class="card-body">

            @include('error_card_list')

            <div class="user-form my-4">
              <form method="POST" action="{{ route('users.update', ['name' => $user->name]) }}" enctype="multipart/form-data">
                @method('PATCH')
                @csrf
                <div class="form-group text-center">
                  <label for="profile_image">
                    <p class="mb-1">{{ __('common.edit_my_profile') }}</p>
                    <img class="profile-icon image-upload rounded-circle" src="{{ $user->profile_image }}" alt="プロフィールアイコン">
                    @if (Auth::id() != config('user.guest_user_id'))
                      <input type="file" name="profile_image" id="profile_image" class="d-none" accept="image/*">
                    @endif
                  </label>
                </div>
                @if (Auth::id() == config('user.guest_user_id'))
                  <p class="text-danger">
                      {!! __('common.note_edit_profile') !!}
                  </p>
                @endif
                <div class="form-group">
                  <label for="name">
                      {{ __('common.form.username') }}
                    <small class="blue-grey-text">（{{ __('common.form.username_plhd') }}）</small>
                  </label>
                  @if (Auth::id() == config('user.guest_user_id'))
                    <input class="form-control" type="text" id="name" name="name" value="{{ $user->name }}" readonly>
                  @else
                    <input class="form-control" type="text" id="name" name="name" value="{{ $user->name ?? old('name') }}">
                  @endif
                </div>
                <div class="form-group">
                  <label for="email">{{__('common.form.email')}}</label>
                  @if (Auth::id() == config('user.guest_user_id'))
                    <input class="form-control" type="text" id="email" name="email" value="{{ $user->email }}" readonly>
                  @else
                    <input class="form-control" type="text" id="email" name="email" value="{{ $user->email ?? old('email') }}">
                  @endif
                </div>
                <div class="form-group">
                  <label for="email">{{__('common.birthday')}}</label>
                  @if (Auth::id() == config('user.guest_user_id'))
                      <input class="form-control" type="text" id="date" name="email" value="{{ $user->birthday }}" readonly>
                  @else
                      <input class="form-control" type="date" id="birthday" name="birthday" value="{{ $user->birthday ? $user->birthday->format('Y-m-d') : '' ?? old('birthday') }}">
                  @endif
                </div>
                <div class="form-group">
                  <label for="wake_up_time">
                      {{ __('common.form.goal') }}
                    <small class="blue-grey-text">（04:00 〜 10:00）</small>
                    <p class="mb-1 small text-default">{{__('common.form.text_goal')}}。</p>
                  </label>
                  <!-- 動作確認用に、目標起床時間の設定可能時間帯の制限を解除中。　min="04:00" max="10:00" -->
                  <input class="form-control" type="time" id="wake_up_time" name="wake_up_time"
                  value="{{
                    null !== old('wake_up_time') ?
                    Carbon\Carbon::parse(old('wake_up_time'))->format('H:i') :
                    $user->wake_up_time->format('H:i')
                  }}">
                </div>
                <div class="form-group">
                  <label for="email">
                    {{ __('common.form.desc') }}
                    <small class="blue-grey-text">（{{ __('common.form.desc_plhd') }}）</small>
                  </label>
                  <textarea name="self_introduction" class="form-control" rows="8">{{ $user->self_introduction ?? old('self_introduction') }}</textarea>
                </div>
                <div class="d-flex justify-content-between align-items-center">
                  <button class="btn peach-gradient mt-2 mb-2" type="submit">
                    <span class="h6">{{__('common.save')}}</span>
                  </button>
                  <a href="{{ route('users.edit_password', ['name' => $user->name]) }}">{{__('common.change_pwd')}}</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
