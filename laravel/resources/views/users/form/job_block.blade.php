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
                name="experiences[{{ $key ?? 'key-index' }}][from]" 
                value="{{ $experience['from'] ?? '' }}"
            >
        </div>
        <div class="col-md-6">
            <input 
                class="form-control" 
                type="date" 
                name="experiences[{{ $key ?? 'key-index' }}][to]" 
                value="{{ $experience['to'] ?? '' }}"
            >
        </div>
    </div>
</div>
<div class="row ml-3 mb-2">
    <label for="year" class="col-md-3 col-form-label p-0">Công việc</label>
    <div class="col-md-9">
        <input 
            class="form-control" 
            type="text" 
            name="experiences[{{ $key ?? 'key-index' }}][detail]" 
            value="{{ $experience['detail'] ?? '' }}"
            placeholder="Mô tả công việc"
        >
    </div>
</div>
<hr>