<ul class="nav nav-tabs nav-justified mt-3">
  <li class="nav-item">
    <a class="
    nav-link my-post {{ $hasArticles ? 'active' : 'text-muted' }}"
      href="#" data-href="{{ route('users.show', ['name' => $user->name]) }}">
      {{ __('common.post') }}
    </a>
  </li>
  <li class="nav-item text-muted">
    <a class="nav-link my-post-favorite {{ $hasLikes ? 'active' : 'text-muted' }}"
       href="#" data-href="{{ route('users.likes', ['name' => $user->name]) }}">
    {{ __('common.great') }}
    </a>
  </li>
</ul>
