@if($goals->isEmpty())
  @include('not_exist', ['message' => 'Không có mục tiêu nào'])
@endif

@foreach($goals as $goal)
  @include('goals.card')
@endforeach
