<div
class="modal fade"
id="modal-detail-goal"
tabindex="-1"
aria-labelledby="modal-detail-goal"
aria-hidden="true"
>
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header d-flex">
                <h5 class="modal-title">
                    Mục tiêu : {{ $goal->topic }} 
                    @if ($goal->is_pin) 
                        <i class="fas fa-thumbtack ml-auto text-primary"></i>
                    @endif
                </h5>
                <div class="ml-auto">
                    @if($goal->status)
                        <b class="text-success">Đã xong</b>
                    @elseif(!$goal->status && strtotime($goal->end_time) < strtotime('now'))
                        <b class="text-danger">Chưa xong</b>
                    @else
                        <b class="text-info">Đang thực hiện</b>
                    @endif
                </div>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        {!! $goal->description !!}
                    </div>
                    @if($goal->histories->count())
                        <div class="col-md-12">
                            <h3>Giai đoạn : </h3>
                            <ul class="list-style-none">
                                @foreach ($goal->histories as $history)
                                    @if($history->data['progress'] < $history->data['previos'])
                                        <li>
                                            <span class="text-danger">
                                                <i class="fas fa-level-down-alt"></i>
                                                {{ $history->data['progress'] }}%
                                            </span> - {{ $history->data['body'] }}
                                        </li>
                                    @elseif($history->data['progress'] == $history->data['previos'])
                                        <li> 
                                            <span class="text-info">
                                                <i class="fas fa-grip-lines-vertical"></i>
                                                {{ $history->data['progress'] }}%
                                            </span> - {{ $history->data['body'] }}
                                        </li>
                                    @else
                                        <li> 
                                            <span class="text-success">
                                                <i class="fas fa-level-up-alt"></i>
                                                {{ $history->data['progress'] }}%
                                            </span> - {{ $history->data['body'] }}
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            </div>
            <div class="modal-footer f-flex">
                <div>
                    <b>Ngày tạo mục tiêu</b>  : {{ $goal->created_at->format('H:s:i d-m-Y') }}
                </div>
                <div>
                    <b>Ngày bắt đầu</b>  : {{ date('d/m/Y', strtotime($goal->start_time)) }}
                </div>
                <button type="button" class="btn btn-sm ml-auto btn-secondary close-modal">
                    Đóng
                </button>
            </div>
        </div>
    </div>
</div>