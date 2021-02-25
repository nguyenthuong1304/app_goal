@csrf
<div class="form-group">
  <label for="topic">
    Tên cuộc họp
    <small class="text-danger">（Bắt buộc）</small>
  </label>
  <input class="form-control" type="text" id="topic" name="topic" value="{{ $meeting->topic ?? old('topic') }}">
</div>
<div class="form-group">
  <label for="agenda">
    Tiêu đề
    <small class="blue-grey-text"> （Bắt buộc）</small>
  </label>
  <input class="form-control" type="text" id="agenda" name="agenda" value="{{ $meeting->agenda ?? old('agenda') }}">
</div>
<div class="form-group w-50">
  <label for="start_time">
    Ngày giờ bắt đầu
    <small class="text-danger"> （Bắt buộc） </small>
  </label>
  <input class="form-control" type="datetime-local" id="start_time" name="start_time" value="{{ $meeting->start_time ?? old('start_time') }}">
</div>
