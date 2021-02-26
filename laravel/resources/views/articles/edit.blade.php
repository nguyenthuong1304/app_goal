@extends('app')

@section('title', '記事更新')

@include('nav')

@section('content')
  <div class="container my-5">
    <div class="row">
      <div class="mx-auto col-7">
        <div class="card">
          <h2 class="h4 card-header text-center sunny-morning-gradient text-white">Chỉnh sửa bài</h2>
          <div class="card-body pt-3">

            @include('error_card_list')

            <div class="card-text">
              <form method="POST" class="w-75 mx-auto" action="{{ route('articles.update', ['article' => $article]) }}">

                @method('PATCH')
                @include('articles.form')

                <button type="submit" class="btn peach-gradient btn-block">
                  <span class="h6">Cập nhật</span>
                </button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('script')
<script src="//cdn.ckeditor.com/4.16.0/basic/ckeditor.js"></script>
<script>
  $(function(){
    CKEDITOR.replace($('textarea')[0]);
  })
</script>
@endsection