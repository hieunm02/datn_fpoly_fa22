@extends('layouts.client.client-master')
@section('title-page', 'Hoá đơn')
@section('content')
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
    <div class="d-none">
        <div class="bg-primary border-bottom p-3 d-flex align-items-center">
            <h4 class="font-weight-bold m-0 text-white flex-fill">Giỏ hàng</h4>
            <a class="toggle1 text-white" id="clickMenus"><span> <i class="feather-align-justify fs-30"></i></span></a>
        </div>
    </div>
    <!-- checkout -->
    <div class="container position-relative">
        <div class="py-5 row">
            <div class="col-md-12">
                <h3 class="text-center">Hoá đơn của bạn</h3>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th colspan="">#Mã code</th>
                                <th>Tên</th>
                                <th>Số điện thoại</th>
                                <th>Địa chỉ</th>
                                <th>Ngày đặt</th>
                                <th class="text-center">Trạng thái</th>
                                <th class="text-center">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($bills as $it)
                                <tr>
                                    <td>#{{ $it->code }}</td>
                                    <td>{{ $it->name }}</td>
                                    <td>{{ $it->phone }}</td>
                                    <td>{{ $it->address }}</td>
                                    <td>{{ $it->created_at }}</td>
                                    <td class="text-center" id="loadStatusOk">
                                        @if ($it->status_id == 1)
                                            <select class="form-control" id="changeStatusBill" data-id="{{ $it->id }}"
                                                name="status">
                                                @foreach ($status as $stt)
                                                    <option value="{{ $stt->id }}"
                                                        {{ $it->status_id == $stt->id ? 'selected' : '' }}>
                                                        {{ $stt->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        @elseif ($it->status_id == 2)
                                            <p class="text-warning">Đang xử lý</p>
                                        @elseif ($it->status_id == 3)
                                            <p class="text-warning">Đang giao</p>
                                        @elseif ($it->status_id == 4)
                                            <p class="text-success">Đã giao</p>
                                        @else
                                            <p class="text-danger">Đã hủy đơn</p>
                                        @endif
                                    </td>
                                    <td class="text-center"><a href="{{ route('billDetail', $it->code) }}"><i
                                                class="fas fa-eye"></i></a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center">{{ $bills->links() }}</div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $("#changeStatusBill").change(function() {
            var id = $(this).data("id");
            status = this.value;
            // alert()
            $.ajax({
                type: "POST",
                url: "/bill/change/" + id,
                data: {
                    id: id,
                    status: status
                },
                dataType: "JSON",
                success: function(response) {
                    $("#changeStatusBill").replaceWith('<p class="text-danger">Đã hủy đơn</p>');
                    // $('#changeStatusBill').append('<p class="text-danger">Đã hủy đơn</p>');
                    Swal.fire(
                        'Successful!',
                        'Huỷ đơn thành công!',
                        'success'
                    )
                }
            });
        })
    </script>
@endsection
