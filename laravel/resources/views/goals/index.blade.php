@extends('app')
@section('title', 'Danh sách mục tiêu')
@section('content')
  @include('nav')
  <div class="container mt-4">
    <div class="row">
      <div class="mx-auto col-md-7">
          @include('goals.list', compact('goals'))
          @include('goals.sppiner')
      </div>
    </div>
    @include('goals.new_post_btn')
  </div>
@endsection
@section('script')
<script src="{{ mix('js/goal.js') }}"></script>
@endsection