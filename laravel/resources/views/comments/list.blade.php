@foreach ($comments as $comment)
    <div class="w-100 d-flex mb-2">
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
        <div class="d-flex justify-content-end flex-grow-1">
            <p class="mb-0 font-weight-lighter">
                {{ $comment->created_at->format('Y-m-d H:i') }}
                <a href="#">
                    <i class="far fa-edit text-warning"></i>
                </a>
                <a href="#">
                    <i class="far fa-trash-alt text-danger"></i>
                </a>
            </p>
        </div>
    </div>
@endforeach 