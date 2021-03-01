<div class="row ml-3 mb-2 this-delete">
    <div class="row">
        <div class="col-md-6">
            <input
            class="form-control"
            type="text"
            name="skills[{{ $key ?? 'key-index' }}][skill]"
            value="{{ $skill['skill'] ?? '' }}"
            placeholder="Kỹ năng"
        >
        </div>
        <div class="col-md-6 d-flex align-items-center block-star">
            @for ($i = 1; $i <= 5; $i++)
                <span class="fa fa-star @if($i <= ($skill['value'] ?? 0)) checked @endif"></span>
            @endfor
            <div class="ml-auto">
                <i class="fas fa-trash text-danger delete-this cursor-pointer" alt="Xóa"></i>
            </div>
            <input
                class="form-control"
                type="hidden"
                name="skills[{{ $key ?? 'key-index' }}][value]"
                value="{{ $skill['value'] ?? '' }}"
                placeholder="Mô tả công việc"
            >
        </div>
    </div>
</div>
<hr>
