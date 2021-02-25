@extends('app');

@section('title', 'ミーティングエラー')

@section('content')

<div class="container d-flex justify-content-center">
  <div>
    <p class="h5">{{ $method }}một lỗi đã xảy ra trong quá trình xử lý。</p>
    <a href="{{ route('articles.index') }}">trở lại trang đầu</a>
  </div>
</div>

@endsection
