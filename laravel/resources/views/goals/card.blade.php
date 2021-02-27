<div class="card mb-4">
    <div class="card-header d-flex flex-row align-items-center blue-gradient text-white">
        <a href="{{ route('users.show', ['name' => $goal->user->name]) }}" class="text-dark m">
            <img class="user-icon rounded-circle mr-3" src="{{ $goal->user->profile_image }}">
        </a>
        <a href="{{ route('users.show', ['name' => $goal->user->name]) }}" class="text-white">
            <strong>{{ $goal->user->name }}</strong> &nbsp;Mục tiêu
            <i class="fas fa-calendar-week ml-2"></i>
        </a>
    @if(Auth::id() === $goal->user_id)
            <div class="ml-auto card-text">
                <div class="dropdown">
                    <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v fa-lg"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="{{ route('goals.edit', ['goal' => $goal]) }}">
                            <i class="fas fa-pen mr-1"></i>Sửa mục tiêu
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item text-danger" data-toggle="modal" data-target="#modal-delete-{{ $goal->id }}">
                            <i class="fas fa-trash-alt mr-1"></i>Xóa mục tiêu
                        </a>
                    </div>
                </div>
            </div>

            <div id="modal-delete-{{ $goal->id }}" class="modal fade" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="閉じる">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form method="POST" action="{{ route('goals.destroy', ['goal' => $goal]) }}">
                            @csrf
                            @method('DELETE')
                            <div class="modal-body text-center text-dark">
                                Bạn có chác xóa mục tiêu : {{ $goal->topic }} ?
                            </div>
                            <div class="modal-footer justify-content-between">
                                <a class="btn btn-outline-grey" data-dismiss="modal">{{ __('common.cancel') }}</a>
                                <button type="submit" class="btn btn-danger">{{ __('common.ok') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endif
    </div>
    <div class="card-body p-0">
        <table class="table table w-75 mx-auto mb-0">
            <tbody class="container">
            <tr class="row">
                <th scope="row" class="col-4 border-top-0 font-weight-bold">Tên mục tiêu</th>
                <td class="col-8 border-top-0">
                    @if ($goal->is_pin) 
                        <i class="fas fa-thumbtack ml-auto text-primary"></i>
                    @endif
                    {{ $goal->topic }}
                </th> 
            </tr>
            @isset($goal->agenda)
                <tr class="row">
                    <th scope="row" class="col-4 font-weight-bold">Agenda</th>
                    <td class="col-8">{{ $goal->agenda }}</td>
                </tr>
            @endisset
            <tr class="row">
                <th scope="row" class="col-4 font-weight-bold">{{ __('common.time') }} bắt đầu</th>
                <td class="col-8">
                    <i class="fas fa-clock mr-2 text-primary"></i>
                    {{ date('d/m/Y', strtotime($goal->start_time)) }}
                </td>
            </tr>
            <tr class="row">
                <th scope="row" class="col-4 font-weight-bold">{{ __('common.time') }} kết thúc</th>
                <td class="col-8">
                    <i class="fas fa-clock mr-2 text-danger"></i>
                    {{ $goal->end_time ? date('d/m/Y', strtotime($goal->end_time)) : "dd/mm/YYYY" }}
                </td>
            </tr>
            <tr class="row">
                <th scope="row" class="col-4 font-weight-bold">
                    Mô tả chi tiết
                </th>
                <td class="col-8">
                    {!! substr($goal->description, 0, 75) !!} @if(strlen($goal->description) > 75) ... @endif
                </td>
            </tr>
            <tr class="row">
                <th scope="row" class="col-4 font-weight-bold">
                    Trạng thái
                </th>
                <td class="col-8" id="status-{{ $goal->id }}">
                    @if($goal->status)
                        <b class="text-success">Đã xong</b>
                    @elseif(!$goal->status && strtotime($goal->end_time) < strtotime('now'))
                        <b class="text-danger">Chưa xong</b>
                    @else
                        <b class="text-info">Đang thực hiện</b>
                    @endif
                </td>
            </tr>
            <tr class="row">
                <th scope="row" class="col-4 font-weight-bold">
                    Tiến độ 
                    @if($goal->user_id == auth()->user()->id && !$goal->status)
                        <small 
                        class="text-primary cursor-pointer"
                        data-toggle="popover"
                        data-html="true"
                        id="popover-{{ $goal->id }}"
                        >(Cập nhật)
                            <form id="goal-{{ $goal->id }}" class="d-none form-update-progress">
                                <div class="form-group">
                                    <label>Tiến độ</label>
                                    <input
                                        type="number"
                                        name="progress"
                                        class="form-control form-control-sm"
                                        placeholder="Tiến độ"
                                        value="{{ $goal->progress }}"
                                    >
                                </div>
                                <div class="form-group">
                                    <label>Chi tiết</label>
                                    <textarea class="form-control form-control-sm" name="body"></textarea>
                                </div>
                                <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                            </form>
                        </small>
                    @endif
                </th>
                <td class="col-8 ">
                    <div class="progress" style="height: 20px">
                        @php
                            if ($goal->progress <= 25) {
                                $color = 'bg-danger';
                            } else if ($goal->progress >= 25 && $goal->progress < 49) {
                                $color = 'bg-warning';
                            } else if ($goal->progress >= 49 && $goal->progress <= 75) {
                                $color = 'bg-info';
                            } else {
                                $color = 'bg-success';
                            }
                        @endphp
                        <div
                          class="progress-bar {{ $color }}"
                          role="progressbar"
                          style="width:{{ $goal->progress }}%;color: black"
                          aria-valuenow="{{ $goal->progress }}"
                          aria-valuemin="0"
                          aria-valuemax="100"
                          id="progress-{{ $goal->id }}"
                        >
                            {{ $goal->progress }} %
                        </div>
                      </div>
                </td>
            </tr>
            <tr class="row">
                <th scope="row" class="col-4 font-weight-bold">Ngày tạo mục tiêu</th>
                <td class="col-8">
                    {{ $goal->created_at->format('H:s:i d-m-Y') }}
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
