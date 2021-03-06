<nav class="navbar navbar-expand navbar-dark blue-gradient sticky-top">

    <div class="container d-flex justify-content-center px-4">
        <a class="navbar-brand mr-auto" href="/" style="font-size:1.5rem;"><i class="fas fa-sun mr-1"></i>Goal & Dairy</a>
        @include('hamburger_menu')
        @if(isset($articles))
            <form method="GET" action="{{ route('articles.index') }}" class="search-form form-inline w-25 d-none d-md-flex">
                <span></span>
                <input class="form-control w-100" name="search" type="search" placeholder="{{ __('common.search_placeholder') }}" value="{{ $search ?? old('search') }}">
            </form>
        @elseif(isset($goals))
            <form method="GET" action="{{ route('goals.index') }}" class="search-form form-inline w-25 d-none d-md-flex">
                <span></span>
                <input class="form-control w-100" name="search" type="search" placeholder="{{ __('common.search_meet_placeholder') }}" value="{{ $search ?? old('search') }}">
            </form>
        @else
        @endif
        <ul class="navbar-nav ml-auto d-none d-md-flex align-items-center">
            @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}"><i class="fas fa-user-plus mr-1"></i>{{ __('common.register') }}</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link mr-2" href="{{ route('login') }}"><i class="fas fa-sign-in-alt mr-1"></i>{{ __('common.login') }}</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link mr-2" href="{{ route('login.provider', 'google') }}">Đăng nhập bằng <i class="fab fa-google mr-1"></i></a>
                </li>

                <li class="nav-item bg-default rounded">
                    <a class="nav-link waves-effect waves-light" href="{{ route('login.guest') }}"><i class="fa fa-user-check mr-1"></i>{{ __('common.login_guest') }}</a>
                </li>
            @endguest

            @auth
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('goals.index') }}"><i class="fas fa-calendar-week"></i>Mục tiêu</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('articles.create') }}"><i class="fas fa-pen mr-1"></i>{{ __('common.create_article') }}</a>
                </li>

                <li class="nav-item">
                    <button form="quick-post" type="submit" class="nav-link button-reset">
                        <i class="far fa-clock mr-1"></i>{{ __('common.quick_post') }}
                    </button>
                </li>
                <form id="quick-post" method="POST" action="{{ route('articles.store') }}">
                    @csrf
                    <input type="hidden" name="body" value="Buổi sáng tốt lành！">
                </form>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false">
                        <img class="user-mini-icon  rounded-circle" src="{{ auth()->user()->profile_image ?? auth()->user()->avatar }}">
                        Mr.{{ auth()->user()->name }}
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
                        <button class="dropdown-item" type="button"
                                onclick="location.href='{{ route("users.show", ["name" => auth()->user()->name]) }}'">
                            {{ trans('common.profile') }}
                        </button>
                        <div class="dropdown-divider"></div>
                        <button form="logout-button" class="dropdown-item" type="submit">
                            {{ __('common.logout') }}
                        </button>
                    </div>
                </li>
                <form id="logout-button" method="POST" action="{{ route('logout') }}">
                    @csrf
                </form>
            @endauth
        </ul>
    </div>

</nav>
