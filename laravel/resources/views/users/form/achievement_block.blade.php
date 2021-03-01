<div class="this-delete">
    <div class="row ml-3 mb-2">
        <input
            class="form-control col-md-2"
            type="text"
            name="achievements[{{ $key ?? 'key-index' }}][date]"
            value="{{ $achievement['date'] ?? '' }}"
            placeholder="2020"
        >
        <input
            class="form-control col-md-9"
            type="text"
            name="achievements[{{ $key ?? 'key-index' }}][detail]"
            value="{{ $achievement['detail'] ?? '' }}"
            placeholder="Mô tả chi tiết"
        >
        <div class="col-md-1 d-flex align-items-center">
            <i class="fas fa-trash text-danger delete-this cursor-pointer" alt="Xóa"></i>
        </div>
    </div>
</div>
<hr>
