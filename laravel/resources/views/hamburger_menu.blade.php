<section class="hamburger d-md-none">
    <a href="#" class="nav-button">
        <span></span>
        <span></span>
        <span></span>
    </a>
</section>
<nav class="menu-area sunny-morning-gradient d-md-none">
    <ul class="nav-modal mb-0 text-center">
        @guest
            <li>
                <a class="waves-effect waves-light modal-link" href="{{ route('register') }}">
                    <i class="fas fa-user-plus mr-1"></i>
                    {{ __('common.register') }}
                </a>
            </li>
            <li>
                <a class="waves-effect waves-light modal-link" href="{{ route('login') }}">
                    <i class="fas fa-sign-in-alt mr-1"></i>
                    {{ __('common.login') }}
                </a>
            </li>
            <li class="bg-default rounded">
                <a class="waves-effect waves-light modal-link" href="{{ route('login.guest') }}">
                    <i class="fas fa-user-check mr-1"></i>
                    {{ __('common.login_guest') }}
                </a>
            </li>
        @endguest
        @auth
            <li>
                <a class="waves-effect waves-light modal-link" href="{{ route('goals.index') }}">
                    <i class="fas fa-video mr-2"></i>
                    Mục tiêu
                </a>
            </li>

            <li>
                <a class="waves-effect waves-light modal-link" href="{{ route('articles.create') }}">
                    <i class="fas fa-pen mr-2"></i>
                    {{ __('common.create_article') }}
                </a>
            </li>
            <li>
                <button form="quick-post" type="submit" class="waves-effect waves-light modal-link button-reset">
                    <i class="far fa-clock mr-1"></i>{{ __('common.quick_post') }}
                </button>
            </li>
            <form id="quick-post" method="POST" action="{{ route('articles.store') }}">
                @csrf
                <input type="hidden" name="body" value="Ngày mới tốt lành !">
            </form>

            <li>
                <a class="waves-effect waves-light modal-link" onclick="location.href='{{ route("users.show", ["name" => Auth::user()->name]) }}'">
                    <i class="fas fa-user mr-1"></i>
                    {{ __('common.profile') }}
                </a>
            </li>
            <li>
                <button form="logout-button" class="button-reset waves-effect waves-light text-white modal-link" type="submit">
                    <i class="fas fa-sign-out-alt mr-1"></i>
                    {{ __('common.logout') }}
                </button>
            </li>
            <form id="logout-button" method="POST" action="{{ route('logout') }}">
                @csrf
            </form>
        @endauth
    </ul>
</nav>
