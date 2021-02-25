<div class="card mb-4">
    <div class="card-header d-flex flex-row align-items-center blue-gradient text-white">
        <a href="{{ route('users.show', ['name' => $goal->user->name]) }}" class="text-dark m">
            <img class="user-icon rounded-circle mr-3" src="{{ $goal->user->profile_image }}">
        </a>
        <a href="{{ route('users.show', ['name' => $goal->user->name]) }}" class="text-white">
            <strong>{{ $goal->user->name }}</strong> &nbsp;Mục tiêu
            <i class="fas fa-calendar-week ml-2"></i>
        </a>

    @if( Auth::id() === $goal->user_id )
        <!-- dropdown -->
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
            <!-- modal -->
        @endif
    </div>
    <div class="card-body p-0">
        <table class="table table w-75 mx-auto mb-0">
            <tbody class="container">
            <tr class="row">
                <th scope="row" class="col-4 border-top-0 font-weight-bold">Tên mục tiêu</th>
                <td class="col-8 border-top-0"> {{ $goal->topic }}</th>
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
                    {{ date('Y/m/d', strtotime($goal->start_time)) }}
                </td>
            </tr>
            <tr class="row">
                <th scope="row" class="col-4 font-weight-bold">{{ __('common.time') }} kết thúc ( dự kiến )</th>
                <td class="col-8">
                    <i class="fas fa-clock mr-2 text-primary"></i>
                    {{ $goal->end_tiem ? date('Y/m/d', strtotime($goal->end_tiem)) : "dd/mm/YYYY" }}
                </td>
            </tr>
            <tr class="row">
                <th scope="row" class="col-4 font-weight-bold">
                    Mô tả chi tiết
                </th>
                <td class="col-8 ">
                    {{ substr($goal->description, 0, 75) }} @if(strlen($goal->description) > 75) ... @endif
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
