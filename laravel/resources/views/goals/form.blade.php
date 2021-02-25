@csrf
<div class="form-group">
  <label for="topic">
    Tên mục tiêu
    <small class="text-danger">（Bắt buộc）</small>
  </label>
  <input class="form-control" type="text" id="topic" name="topic" value="{{ $goal->topic ?? old('topic') }}">
</div>
<div class="form-group">
  <label for="agenda">
    Tiêu đề
    <small class="text-danger">（Bắt buộc）</small>
  </label>
  <input class="form-control" type="text" id="agenda" name="agenda" value="{{ $goal->agenda ?? old('agenda') }}">
</div>
<div class="d-flex">
    <div class="form-group w-50">
        <label for="start_time">
            Ngày giờ bắt đầu
            <small class="text-danger">（Bắt buộc）</small>
        </label>
        <input class="form-control" type="date" id="start_time" name="start_time" value="{{ $goal->start_time ?? old('start_time') }}">
    </div>

    <div class="form-group w-50">
        <label for="end_time">
            Ngày giờ kết thúc
        </label>
        <input class="form-control" type="date" id="end_time" name="end_time" value="{{ $goal->end_time ?? old('end_time') }}">
    </div>
</div>

<div class="form-group">
    <label for="description">
        Độ ưu tiên <small class="text-primary">（0 < độ ưu tiên < 5）</small>
    </label>
    <textarea name="description" class="form-control" id="description" rows="5" value="{{ $goal->desciption ?? old('desciption') }}">{{ $goal->desciption ?? old('desciption') }}</textarea>
</div>

<div class="form-group w-50">
    <label for="priority">
        Độ ưu tiên <small class="text-primary">（0 < độ ưu tiên < 5）</small>
    </label>
    <input class="form-control" type="number" id="priority" name="priority" value="{{ $goal->priority ?? old('priority') ?? 0 }}">
</div>
