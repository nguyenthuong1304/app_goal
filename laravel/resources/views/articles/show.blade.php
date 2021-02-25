@extends('app')

@section('title', '投稿詳細')

@section('content')

@include('nav')

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="mb-3">
                @include('articles.card')
            </div>

            <div class="mb-3">
                <ul class="list-group card mt-3">
                    <li class="card-header sunny-morning-gradient text-white text-center">bình luận</li>
                    @guest
                    <li class="list-group-item">
                        <p class="mb-0 text-secondary">Bạn sẽ có thể bình luận khi đăng nhập。</p>
                    </li>
                    @endguest

                    @auth
                    <!-- コメント投稿フォーム -->
                    @include('comments.form')

                    @endauth
                    <!-- コメント一覧 -->
                    @include('comments.card')
                </ul>
                {{ $comments->links('pagination::default') }}
            </div>
        </div>
    </div>
</div>

@endsection
