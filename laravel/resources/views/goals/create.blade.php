@extends('app')

@section('title', 'Tạo mới mục tiêu cho bản thân')

@section('content')

  @include('nav')

  <div class="container my-5">
    <div class="row">
      <div class="mx-auto col-md-12">
        <div class="card">
          <h2 class="h4 card-header text-center blue-gradient text-white">Tạo mục tiêu mới！</h2>
          <div class="card-body pt-3">
            @include('error_card_list')
            <div class="my-4">
              <form method="POST" class="w-75 mx-auto" action="{{ route('goals.store') }}">
                @csrf
                @include('goals.form')
               <div class="mt-4">
                  <button type="submit" class="btn btn-block blue-gradient">
                    <span class="h6">Tạo mục tiêu</span>
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