@foreach ($comments as $comment)
    <div class="w-100 d-flex mb-2 item-cmt">
        <a href="{{ route('users.show', ['name' => $comment->user->name]) }}" class="in-link text-dark">
            <img class="user-icon rounded-circle" src="{{ $comment->user->profile_image ?? $comment->user->avatar }}" alt="Icon avatar">
        </a>
        <div class="ml-2 d-flex flex-column">
            <a href="{{ route('users.show', ['name' => $comment->user->name]) }}" class="in-link text-dark">
                <p class="font-weight-bold mb-0">
                    {{ $comment->user->name }}
                </p>
            </a>
            {!! $comment->comment !!}
        </div>
        <div class="d-flex justify-content-end align-items-center flex-grow-1">
            <p class="mb-0 font-weight-lighter">
                {{ $comment->created_at->format('Y-m-d H:i') }}
                @if ($comment->user_id === auth()->user()->id)
                    <a href="javascript:void(0)">
                        <i class="far fa-edit text-warning"></i>
                    </a>
                    <a href="#" class="delete-cmt" data-id="{{ $comment->id }}" data-goal-id="{{ $comment->commentable->id }}">
                        <i class="far fa-trash-alt text-danger"></i>
                    </a>
                @endif
            </p>
        </div>
    </div>
@endforeach 