@if($meetings->isEmpty())
  @include('not_exist', ['message' => 'Không có cuộc họp。'])
@endif

@foreach($meetings as $meeting)
  @include('meetings.card')
@endforeach
