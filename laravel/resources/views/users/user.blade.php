<div class="card my-4">
    <div class="card-body">
        <div class="d-flex flex-row row">
            <div class="col-3 text-center">
                <a href="{{ route('users.show', ['name' => $user->name]) }}" class="text-dark">
                    <img class="profile-icon rounded-circle" src="{{ $user->profile_image ?? $user->avatar }}" alt="Biểu tượng hồ sơ">
                </a>
                <a
                    data-toggle="collapse"
                    href="#collapseProfile"
                    role="button"
                    aria-expanded="false"
                    aria-controls="collapseProfile"
                >Hiện / ẩn hồ sơ</a>
            </div>
            <div class="col-9">
                <div class="row mb-2">
                    <div class="col-5">
                        <h2 class="h5 card-title font-weight-bold mb-3">
                            <a href="{{ route('users.show', ['name' => $user->name]) }}" class="text-dark">
                                {{ $user->name }}
                            </a>
                        </h2>
                        <p class="text-primary m-0">
                            <i class="fas fa-briefcase"></i> {{ $user->profile->job ?? 'Đang cập nhật' }}
                        </p>
                    </div>
                    <div class="col-7 row">
                        <div class="col-3 calendar pl-0 d-flex justify-content-center">
                            <p class="mt-auto">
                                <span class="h5">
                                    {{ date('m') }}
                                </span>
                            </p>
                        </div>
                        <div class="col-4 rounded peach-gradient d-flex align-items-center justify-content-center p-1">
                            <div class="text-white text-center d-flex align-items-center justify-content-center">
                                <div>
                                    <p class="small m-0">Đã hoàn thành</p>
                                    <p class="m-0">
                                        <span class="h5 mr-1">{{ $user->goals()->where('status', 1)->count()  }}</span> mục tiêu
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-5 text-center pr-0">
                            @if(Auth::id() !== $user->id)
                                <follow-button
                                    :initial-is-followed-by='@json($user->isFollowedBy(Auth::user()))'
                                    :authorized='@json(Auth::check())'
                                    endpoint="{{ route('users.follow', ['name' => $user->name]) }}"
                                >
                                </follow-button>
                            @else
                                <a  href="{{ route('users.edit', ['name' => Auth::user()->name]) }}" class="btn btn-default d-block d-flex justify-content-center align-items-center rounded h-100 m-0 p-1">
                                    {{ __('common.edit_profile') }}
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="mb-4">
                    @foreach ($user->profile->socials ?? [] as $k => $social)
                        <a href="{{ $social }}" class="mr-2" target="_blank">
                            <i class="fab fa-lg fa-{{ $k }}"></i>
                        </a>
                    @endforeach
                    <p class="small m-0 text-muted">
                        <i class="fas fa-phone"></i> {{ $user->profile->phone ?? 'Đang cập nhật' }}
                    </p>
                </div>
                <div class="row">
                    <div class="col-10 pr-0">
                        @if (isset($user->self_introduction))
                            <p class="mb-0">{!! nl2br(e( $user->self_introduction )) !!}</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--    profile in here--}}
    <div class="card-body">
        <div class="collapse show not-scroll" id="collapseProfile">
            <div class="card card-body">
                @if($user->profile)
                    <div class="rounded bg-white shadow-dark padding-30">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <p>{!! nl2br(e( $user->self_introduction )) !!}</p>
                                <div class="mt-3 text-center">
                                    <a href="javascript:toastr.info('Chức năng đang được phát triển!');" class="btn btn-primary">Download CV</a>
                                </div>
                            </div>
                            <div class="col-md-6">
                                @foreach($user->profile->skills as $skill)
                                    <div class="skill-item">
                                        <div class="skill-info clearfix">
                                            <h6 class="float-left mb-3 mt-0">{{ $skill['skill'] ?? '-'}}</h6>
                                            <span class="float-right">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    <span class="fa fa-star @if($i <= ($skill['value'] ?? 0))checked @endif"></span>
                                                @endfor
                                            </span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 rounded card p-3 mb-2">
                                @foreach($user->profile->educations as $education)
                                    <div class="timeline-container">
                                        <div class="content">
                                            <span class="time">{{ $education['from'] .' - ' }} {{ $education['to'] == date('Y') ? 'Hiện tại' : $education['to'] }}</span>
                                            <h5 class="title">{{ $education['detail'] }}</h5>
                                        </div>
                                    </div>
                                @endforeach
                                <span class="line"></span>
                            </div>
                            <div class="col-md-6 rounded card p-3 mb-2">
                                @foreach($user->profile->experiences as $experience)
                                    <div class="timeline-container">
                                        <div class="content">
                                            <span class="time">{{ $experience['from'] .' - ' }} {{ $experience['to'] == date('Y') ? 'Hiện tại' : $education['to'] }}</span>
                                            <h5 class="title">{{ $experience['detail'] }}</h5>
                                        </div>
                                    </div>
                                @endforeach
                                <span class="line"></span>
                            </div>
                            <div class="col-md-6 rounded card p-3 mb-2">
                                @foreach($user->profile->achievements as $achievement)
                                    <div class="timeline-container">
                                        <div class="content">
                                            <span class="time">{{ $achievement['date']}}</span>
                                            <h5 class="title">{{ $achievement['detail'] }}</h5>
                                        </div>
                                    </div>
                                @endforeach
                                <span class="line"></span>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="card-body">
        <div>
            <a href="{{ route('users.followings', ['name' => $user->name]) }}" id="following" class="text-muted mr-3">
                <span>{{ $user->count_followings }}</span> {{ __('common.following') }}
            </a>
            <a href="{{ route('users.followers', ['name' => $user->name]) }}" id="follower" class="text-muted">
                <span>{{ $user->count_followers }}</span> {{ __('common.follower') }}
            </a>
        </div>
    </div>
</div>
