<form method="POST" action="{{ route('profile-update', ['user' => $user]) }}">
    @csrf
    <div class="form-group">
        <label for="job">Công việc hiện tại</label>
        <input class="form-control" type="text" id="job" name="job" value="{{ $user->profile->job ?? old('job') }}" placeholder="Developer, SEOer, ...">
    </div>
    <div class="form-group block-jobs">
        <label for="job">Kinh nghiệm làm việc : </label>
        <a href="#"
            alt="Thêm công việc" 
            class="btn-add float-right"
            data-html='@include('users.form.job_block', ["key" => "key-index"])'
            data-append=".block-jobs"
        >
            <i class="fas fa-plus-square"></i>Thêm
        </a>
        <div id="job-block">
                @php $experiences = old('experiences') ??  $user->profile->experiences ?? []; @endphp
                @foreach($experiences as $key => $experience)
                    @include('users.form.job_block', compact('experience', 'key'))
                @endforeach
                @if (!count($experiences)) 
                    @include('users.form.job_block', ['key' => 0])
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
    <div class="form-group block-socials">
        <label for="job">Kỹ năng : </label>
        <a href="#"
            alt="Thêm công việc" 
            class="btn-add float-right"
            data-html='@include('users.form.skill_block')'
            data-append=".block-socials"
        >
            <i class="fas fa-plus-square"></i>Thêm
        </a>
        <div id="job-block">
            <input name="socials" value="" class="form-control">
        </div>
    </div>
    <div class="form-group">
        <label for="about_me">Giới thiệu bản thân</label>
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