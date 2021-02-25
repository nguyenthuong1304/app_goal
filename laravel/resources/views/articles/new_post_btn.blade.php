@auth
  <div class="new-post">
    <a class="new-article-btn" href="{{ route('articles.create') }}">
      <p>{{ __('common.new_post') }}</p>
      <i class="fas fa-plus"></i>
    </a>
  </div>
@endauth
