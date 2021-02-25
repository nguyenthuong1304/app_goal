<div class="card mb-4">
    <div class="btn blue-gradient text-center m-0">
        <a href="{{ route("users.show", ["name" => $superUser->name]) }}" class="text-white">
            <p class="h4">{{ $superUser->name }}</p>
            <p class="h1 mb-0">
                <img src="{{ $superUser->profile_image }}" alt="Biểu tượng hồ sơ" class="profile-icon rounded-circle">
            </p>
            <p class="h5 mt-2">
                Hello các cậu, mình là developer (21 tuổi)
            </p>
            <p class="h6" style="text-transform: none">
                Tin rằng bạn có thể làm một điều gì đó đồng nghĩa với việc bạn đã đi được nửa đường đến đó
            </p>
        </a>
    </div>
</div>
