@extends('app')

@section('title', $user->name)
@section('style')
    <style>
        .timeline-container {
            padding-left: 40px;
            margin-bottom: 10px;
            position: relative;
            background-color: inherit;
            width: 100%;
        }
        .timeline-container h5.title {
            margin-left: 10px;
        }

        .timeline-container .content .time {
            color: rgb(139 136 177);
            font-size: 14px;
        }

        .timeline-container h1, h2, h3, h4, h5, h6 {
            color: rgb(69 67 96);
            font-family: "Rubik", sans-serif;
            font-weight: 700;
            margin: 10px 0;
        }
        span.line {
            position: absolute;
            width: 1px;
            background-color: rgb(255 76 96);
            top: 30px;
            bottom: 30px;
            left: 34px;
        }
    </style>
@stop
@section('content')

  @include('nav')

  <div class="container mt-4">
    <div class="row  justify-content-center">

      <div class="col-md-9">
        @include('users.user')

        @include('users.tabs', ['hasArticles' => false, 'hasLikes' => false])

        @foreach($followings as $person)
          @include('users.person')
        @endforeach

        {{ $followings->links('pagination::default') }}
      </div>

    </div>
  </div>
@endsection
