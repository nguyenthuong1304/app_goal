@if($articles->isEmpty())
  @include('not_exist', ['message' => 'Không có bài đăng nào。'])
@else
  @foreach($articles as $article)
    @include('articles.card')
  @endforeach
@endif
