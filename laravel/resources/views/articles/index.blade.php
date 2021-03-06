@extends('app')

@section('title', 'Trang chủ')
@section('content')
    @include('nav')
    @if(session('msg_achievement'))
        <div class="modal fade" id="achievement-modal" tabindex="-1" role="dialog" aria-labelledby="label1" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body text-center font-weight-bold">
                        <p class="h5 text-primary  font-weight-bold mb-3">
                            <i class="fas fa-award mr-2"></i>
                            {{ session('msg_achievement') }}
                        </p>
                        <p>
                            <span class="d-inline-block">{{ date('m') }}</span>
                            <span class="d-inline-block rounded peach-gradient text-white p-1">
                                {{
                                  \Auth::user()->achievement_days()
                                  ->where('date', '>=', \Carbon\Carbon::now()->startOfMonth()->toDateString())
                                  ->where('date', '<=', \Carbon\Carbon::now()->endOfMonth()->toDateString())
                                  ->count()
                                }}ngày
                          </span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="container mt-4">
        <div class="row d-flex justify-content-center">
            <div class="row col-md-12">
                <aside class="col-5 d-none d-md-block col-xs-12 position-sticky">
                    @include('sidebar.list')
                </aside>
                <main class="col-md-7 col-xs-12">
                    @include('articles.list', compact('articles'))
                    @include('articles.sppiner')
                    @include('articles.new_post_btn')
                </main>
            </div>
        </div>
    </div>


@endsection
