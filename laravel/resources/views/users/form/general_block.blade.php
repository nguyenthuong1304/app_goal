<div class="this-delete">
    <div class="row ml-3 mb-2">
        <div class="row">
            <div class="col-md-6">
                <input
                    class="form-control"
                    type="text"
                    name="{{$nameInput}}[{{ $key ?? 'key-index' }}][from]"
                    value="{{ $object['from'] ?? '' }}"
                    placeholder="2020"
                >
            </div>
            <div class="col-md-6">
                <input
                    class="form-control"
                    type="text"
                    name="{{$nameInput}}[{{ $key ?? 'key-index' }}][to]"
                    value="{{ $object['to'] ?? '' }}"
                    placeholder="H tại"
                >
            </div>
        </div>
    </div>
    <div class="row ml-3 mb-2">
        <input
            class="form-control"
            type="text"
            name="{{$nameInput}}[{{ $key ?? 'key-index' }}][detail]"
            value="{{ $object['detail'] ?? '' }}"
            placeholder="Mô tả chi tiết"
        >
    </div>
    <div class="text-center">
        <i class="fas fa-trash text-danger delete-this cursor-pointer" alt="Xóa"></i>
    </div>
</div>
<hr>
