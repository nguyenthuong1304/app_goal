<div class="row">
    <div class="col-md mb-4">
        <div class="card article-card">
            <a href="{{ route('articles.show', ['article' => $article]) }}" class="full-range-link"></a>

            <div class="card-body d-flex flex-row row">
                <div class="col-md-3 col-sm-5 text-center">
                    <a href="{{ route('users.show', ['name' => $article->user->name]) }}" class="in-link text-dark">
                        <img class="user-icon rounded-circle" src="{{ $article->user->profile_image ?? $article->user->avatar }}">
                    </a>
                </div>
                <div class="col-md-6 col-sm-7">
                    <p class="mb-1">
                        <a href="{{ route('users.show', ['name' => $article->user->name]) }}" class="font-weight-bold user-name-link text-dark mr-4">
                            {{ $article->user->name }}
                        </a>
                        <span class="font-weight-lighter">{{ $article->created_at->format('Y/m/d') }}</span>
                    </p>
                    <p class="text-primary m-0">
                        <i class="fas fa-clock mr-2"></i>{{ __('common.wakeup_time') }}：{{ $article->user->wake_up_time->format('H:i') }}
                    </p>
                </div>

                <div class="col-md-2 d-md-block mb-auto rounded peach-gradient p-1">
                    <div class="text-white text-center">
                        <span class="mr-1">{{ \Carbon\Carbon::createFromTimeStamp(strtotime($article->created_at))->diffForHumans() }}</span>
                    </div>
                </div>

            @if( Auth::id() === $article->user_id )
                <!-- dropdown -->
                    <div class="col-1 card-text">
                        <div class="dropdown text-center">
                            <a class="in-link p-2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v fa-lg"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="{{ route('articles.edit', ['article' => $article]) }}">
                                    <i class="fas fa-pen mr-1"></i>{{ __('common.edit_post')}}
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item text-danger" data-toggle="modal" data-target="#modal-delete-{{ $article->id }}">
                                    <i class="fas fa-trash-alt mr-1"></i>{{ __('common.delete_post')}}
                                </a>
                            </div>
                        </div>
                    </div>
                    <div id="modal-delete-{{ $article->id }}" class="modal fade" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="閉じる">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form method="POST" action="{{ route('articles.destroy', ['article' => $article]) }}">
                                    @csrf
                                    @method('DELETE')
                                    <div class="modal-body text-center">
                                        {{ __('common.delete_conf') }}
                                    </div>
                                    <div class="modal-footer justify-content-between">
                                        <a class="btn btn-outline-grey" data-dismiss="modal">{{ __('common.cancel') }}</a>
                                        <button type="submit" class="btn btn-danger">{{ __('common.ok') }}</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endif

            </div>
            @foreach($article->tags as $tag)
                @if($loop->first)
                    <div class="card-body pt-0">
                        <div class="card-text line-height px-3">
                            @endif
                            <a href="{{ route('tags.show', ['name' => $tag->name]) }}" class="border border-default text-default p-1 mr-1 mt-1 in-link">
                                {{ $tag->hashtag }}
                            </a>
                            @if($loop->last)
                        </div>
                    </div>
                @endif
            @endforeach
            <div class="card-body pt-0">
                <div class="px-3">
                    {!! nl2br(e( $article->body )) !!}
                </div>
            </div>
            <div class="card-footer py-1 d-flex justify-content-end bg-white">
                <div class="mr-3 d-flex align-items-center">
                    <a class="in-link p-1" href="{{ route('articles.show', ['article' => $article]) }}">
                        <i class="far fa-comment fa-fw fa-lg"></i>
                    </a>
                    <p class="mb-0">{{ $article->comments_count }}</p>
                </div>
                <div class="d-flex align-items-center">
                    <article-like
                        :initial-is-liked-by='@json($article->isLikedBy(Auth::user()))'
                        :initial-count-likes='@json($article->likes_count)'
                        :authorized='@json(Auth::check())'
                        endpoint="{{ route('articles.like', ['article' => $article]) }}"
                    >
                    </article-like>
                </div>
            </div>
        </div>
    </div>
</div>
