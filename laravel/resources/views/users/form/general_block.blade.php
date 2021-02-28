<div class="row ml-3 mb-2">
    <div class="row col-md-12">
        <div class="col-md-6 text-center">
            <label>Từ:</label>
        </div>
        <div class="col-md-6 text-center">
            <label>Đến:</label>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <input 
                class="form-control" 
                type="date" 
                name="{{$nameInput}}[{{ $key ?? 'key-index' }}][from]" 
                value="{{ $object['from'] ?? '' }}"
            >
        </div>
        <div class="col-md-6">
            <input 
                class="form-control" 
                type="date" 
                name="{{$nameInput}}[{{ $key ?? 'key-index' }}][to]" 
                value="{{ $object['to'] ?? '' }}"
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
        placeholder="Mô tả học vấn"
    >
</div>
<hr>