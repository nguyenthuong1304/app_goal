<div class="card mb-4">
    <div class="btn blue-gradient text-center m-0">
        <a href="{{ route("users.show", ["name" => $superUser->name]) }}" class="text-white">
            <p class="h1 mb-0">
                <img src="{{ $superUser->profile_image }}" alt="Biểu tượng hồ sơ" class="profile-icon rounded-circle">
            </p>
            <p class="h2 mt-2">{{ $superUser->name }} ({{ $superUser->age }})</p>
            <p class="h5 mt-3">
            {{ $superUser->self_introduction }}
            </p>
            <p class="h6 mt-2" style="text-transform: none">
                Tin rằng bạn có thể làm một điều gì đó đồng nghĩa với việc bạn đã đi được nửa đường đến đó.
            </p>
        </a>
    </div>
    <div class="d-flex justify-content-center">
        <button type="button" class="p-0 btn btn-primary btn-lg btn-floating">
            <i class="fab fa-facebook-f"></i>
        </button>
        <button type="button" class="p-0 btn btn-lg btn-floating text-white" style="background-color: #ac2bac;">
            <i class="fab fa-instagram"></i>
        </button>
    </div>
</div>
