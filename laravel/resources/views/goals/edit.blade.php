@extends('app')
@section('title', 'Chỉnh sửa ' . $goal->topic)
@include('nav')
@section('content')

  <div class="container my-5">
    <div class="row">
      <div class="mx-auto col-md-10">
        <div class="card">
          <h2 class="h4 card-header text-center blue-gradient text-white">Tạo mục tiêu</h2>
          <div class="card-body pt-3">
            @include('error_card_list')
            <div class="my-4">
              <form method="POST" class="w-75 mx-auto" action="{{ route('goals.update', ['goal' => $goal]) }}">
                @method('PATCH')
                @include('goals.form')
                <div class="mt-4">
                  <button class="btn btn-block blue-gradient mt-2 mb-2" type="submit" text-while>
                    <span class="h5">Cập nhật</span>
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
@section('script')
    <script src="//cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
    <script>
        $(function(){
            CKEDITOR.replace($('textarea')[0]);
        })
    </script>
@endsection
