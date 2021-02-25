@if($articles->isEmpty())
  @include('not_exist', ['message' => 'Không có bài đăng nào。'])
@endif

@foreach($articles as $article)
  @include('articles.card')
@endforeach
