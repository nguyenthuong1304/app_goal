@csrf
<div class="form-group">
  <label for="topic">
    Tên mục tiêu
    <small class="text-danger">（Bắt buộc）</small>
  </label>
  <input class="form-control" type="text" id="topic" name="topic" value="{{ $goal->topic ?? old('topic') }}">
</div>
<div class="row">
    <div class="form-group col-md-6 col-xs-12">
        <label for="start_time">
            Ngày giờ bắt đầu
            <small class="text-danger">（Bắt buộc）</small>
        </label>
        <input class="form-control" type="date" id="start_time" name="start_time" value="{{ $goal->start_time ?? old('start_time') }}">
    </div>

    <div class="form-group col-md-6 col-xs-12">
        <label for="end_time">
            Ngày giờ kết thúc
        </label>
        <input class="form-control" type="date" id="end_time" name="end_time" value="{{ $goal->end_time ?? old('end_time') }}">
    </div>
</div>

<div class="form-group">
    <label for="description">
        Mô tả mục tiêu （Bắt buộc）
    </label>
    <textarea name="description" class="form-control" id="description" rows="5" value="{{ $goal->description ?? old('description') }}">{{ $goal->description ?? old('description') }}</textarea>
</div>

<div class="form-group w-40">
    <label for="priority">
        Độ ưu tiên <small class="text-primary">（0 < độ ưu tiên < 5）</small>
    </label>
    <input class="form-control" type="number" id="priority" name="priority" value="{{ $goal->priority ?? old('priority') ?? 0 }}">
</div>
@if(isset($goal))
<div class="form-group w-40">
    <label for="progress">
        Nhận thông báo nhắc nhở hàng tuần
    </label>
    <input class="form-control" type="number" min="0" max="100" id="progress" name="progress" value={{ $goal->progress ?? old('progress') }}>
</div>
@endif
<div class="row">
    <div class="form-group w-40 col-md-6 text-center">
        <label for="remind_update">
            Nhận thông báo nhắc nhở hàng tuần
        </label>
        <input type="checkbox" id="remind_update" name="remind_update" @if($goal->remind_update ?? old('remind_update')) checked @endif value="1">
    </div>
    <div class="form-group w-40 col-md-6 text-center">
        <label for="is_pin">
            Ghim mục tiêu này ?
        </label>
        <input type="checkbox" id="is_pin" name="is_pin" @if($goal->is_pin ?? old('is_pin')) checked @endif value="1">
    </div>
</div>
