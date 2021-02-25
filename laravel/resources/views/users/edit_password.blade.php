@extends('app')

@section('title', __('common.change_pwd'))

@include('nav')

@section('content')
<div class="container my-5">
    <div class="row">
      <div class="mx-auto col-md-7">
        <div class="card">
          <h2 class="h4 card-header text-center sunny-morning-gradient text-white">{{ __('common.change_pwd') }}</h2>
          <div class="card-body">

            @include('error_card_list')

            <div class="user-form my-4">
              <form method="POST" action="{{ route('users.update_password', ['name' => $user->name]) }}" enctype="multipart/form-data">
                @method('PATCH')
                @csrf
                <div class="form-group">
                  <label for="current_password">
                      {{ __('common.current_pwd') }}
                  </label>
                  <input class="form-control" type="password" id="current_password" name="current_password" placeholder="{{ __('common.pls_required_pwd') }}">
                </div>
                <div class="form-group">
                  <label for="new_password">
                      {{ __('common.new_pwd') }}
                  </label>
                  <input class="form-control" type="password" id="new_password" name="new_password" placeholder="{{ __('common.form.password_plhd') }}">
                </div>
                <div class="form-group">
                  <label for="new_password_confirmation">
                      {{ __('common.new_pwd_conf') }}
                  </label>
                  <input class="form-control" type="password" id="new_password_confirmation" name="new_password_confirmation" placeholder="{{ __('common.form.password_conf_plhd') }}">
                </div>
                <div class="d-flex justify-content-between align-items-center">
                  <button class="btn peach-gradient mt-2 mb-2" type="submit">
                    <span class="h6">{{ __('common.save') }}</span>
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
