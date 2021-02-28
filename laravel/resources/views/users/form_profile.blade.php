<form method="POST" action="{{ route('profile-update', ['user' => $user]) }}">
    @csrf
    <div class="form-group">
        <label for="job">Công việc hiện tại</label> <small class="blue-grey-text">（Không quá 50 kí tự）</small>
        <input class="form-control" type="text" id="job" name="job" value="{{ $user->profile->job ?? old('job') }}" placeholder="Developer, SEOer, ...">
    </div>
    <div class="form-group block-jobs">
        <label for="job">Kinh nghiệm làm việc : </label>
        <a href="#"
            alt="Thêm công việc" 
            class="btn-add float-right"
            data-html='@include('users.form.job_block', ["key" => "key-index", "nameInput" => "experiences"])'
            data-append=".block-jobs"
        >
            <i class="fas fa-plus-square"></i>Thêm
        </a>
        <div id="job-block">
            @php
                $experiences = old('experiences') ??  $user->profile->experiences ?? []; 
                $nameInput = "experiences";
                $object = null; 
            @endphp
            @foreach($experiences as $key => $object)
                @include('users.form.general_block', compact('object', 'key', 'nameInput'))
            @endforeach
            @if (!count($experiences)) 
                @include('users.form.general_block', ['key' => 0, 'nameInput' => $nameInput])
            @endif
        </div>
    </div>
    <div class="form-group block-skills">
        <label for="job">Kỹ năng : </label>
        <a href="#"
            alt="Thêm công việc" 
            class="btn-add float-right"
            data-html='@include('users.form.skill_block', ["key" => "key-index"])'
            data-append=".block-skills"
        >
            <i class="fas fa-plus-square"></i>Thêm
        </a>
        <div id="job-block">
            @php $skills = old('skills') ??  $user->profile->skills ?? []; @endphp
            @foreach($skills as $key => $skill)
                @include('users.form.skill_block', compact('skill', 'key'))
            @endforeach
            @if (!count($skills)) 
                @include('users.form.skill_block', ['key' => 0])
            @endif
        </div>
    </div>
    <div class="form-group block-educations">
        @php $object = null; @endphp
        <label for="job">Học vấn: </label>
        <a href="#"
            alt="Thêm công việc" 
            class="btn-add float-right"
            data-html='@include('users.form.general_block', ["key" => "key-index", "nameInput" => "educations"])'
            data-append=".block-educations"
        >
            <i class="fas fa-plus-square"></i>Thêm
        </a>
        <div id="job-block">
            @php 
                $educations = old('educations') ??  $user->profile->educations ?? [];
                $nameInput = "educations"; 
            @endphp
            @foreach($educations as $key => $object)
                @include('users.form.general_block', compact('object', 'key', 'nameInput'))
            @endforeach
            @if (!count($educations)) 
                @include('users.form.general_block', ['key' => 0, 'nameInput' => $nameInput])
            @endif
        </div>
    </div>
    <div class="form-group block-achievements">
        <label for="job">Thành tựu: </label>
        @php $object = null; @endphp
        <a href="#"
            alt="Thêm công việc" 
            class="btn-add float-right"
            data-html='@include('users.form.general_block', ["key" => "key-index", "nameInput" => "achievements"])'
            data-append=".block-achievements"
        >
            <i class="fas fa-plus-square"></i>Thêm
        </a>
        <div id="job-block">
            @php 
                $achievements = old('achievements') ??  $user->profile->achievements ?? [];
                $nameInput = "achievements";
            @endphp
            @foreach($achievements as $key => $object)
                @include('users.form.general_block', compact('object', 'key', 'nameInput'))
            @endforeach
            @if (!count($achievements)) 
                @include('users.form.general_block', ['key' => 0, 'nameInput' => $nameInput])
            @endif
        </div>
    </div>
    <div class="form-group block-socials">
        <label for="job">Mạng xã hội : </label>
        @foreach (App\Models\Profile::SOCIALS as $social)
            <div class="row mb-2 d-flex align-items-center">
                <div class="col-md-2">
                    <i class="fab fa-2x fa-{{ $social }}"></i>
                </div>
                <div class="col-md-10">
                    <input
                        type="text" 
                        class="form-control form-control-sm" 
                        name="socials[{{ $social }}]"
                        value="{{ $user->profile->socials[$social] ?? old("socials.$social") }}"
                        placeholder="Nhập địa chỉ {{ $social }}"
                    >
                </div>
            </div>
        @endforeach
    </div>
    <div class="form-group">
        <label for="about_me">Mục tiêu nghề nghiệp</label> 
        <small class="blue-grey-text">（Không quá 200 kí tự）</small>
        <textarea
            class="form-control" 
            type="text" 
            id="about_me" 
            name="about_me"
            placeholder="Developer, SEOer, ..."
        >{{ $user->profile->about_me ?? old('about_me') }}</textarea>
    </div>
    <div class="d-flex justify-content-center">
        <button class="btn peach-gradient" type="submit">
            <span class="h6">{{__('common.save')}}</span>
        </button>
    </div>
 </form>