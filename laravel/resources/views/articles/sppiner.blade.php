@if ($articles->nextPageUrl())
  <a href="{{ $articles->appends(request()->only('search'))->nextPageUrl() }}" class="infinity-scroll" infinity-scroll>
    <div class="d-flex justify-content-center my-4">
      <div class="spinner-border" role="status">
        <span class="sr-only">Loading...</span>
      </div>
    </div>
  </a>
@endif
