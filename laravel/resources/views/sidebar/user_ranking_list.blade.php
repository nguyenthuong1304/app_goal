<div class="card mb-4 sidebar-content">
    <div class="card-header d-flex align-items-center row m-0 text-center">
        <div class="col-10 pl-0">
            <i class="fas fa-crown mr-2 text-warning fa-lg"></i>
            <span class="mr-1">{{ __('common.rank') }}</span>
        </div>
        <div class="col-2 p-1 rounded sunny-morning-gradient d-flex align-items-center justify-content-center font-weight-bold text-white">
            <span class="font-weight-bold text-white">{{ __('common.month') }} {{ date('m') }}</span>
        </div>
    </div>
    <div class="card-body user-ranking-list py-3">
        @foreach ($ranked_users as $ranked_user)
        <div class="d-flex">
            <p class="ranking-icon{{ $ranked_user->rank }} mr-3">
                {{ $ranked_user->rank}}
            </p>
            <a class="mr-1" href="{{ route('users.show', ['name' => $ranked_user->name]) }}">
                <img class="user-mini-icon rounded-circle mr-2" src="{{ $ranked_user->profile_image ?? '/default.png'}}">
                Mr. {{$ranked_user->name}}
            </a>
            <p class="h5 ml-auto">{{ $ranked_user->articles_count }} {{ __('common.postm') }}</p>
        </div>
        @endforeach
    </div>
</div>
