@extends('layouts.admin.admin-master')
@section('title', $title)
@section('content')

<div class="main-content">
    <div class="page-header">
        <h2 class="header-title">{{ $title }}</h2>
    </div>
    <input type="hidden" value="{{ Auth::id() }}" id="user_id">
    @if (session()->has('success'))
    <div class="text-white alert bg-success">
        {{ session()->get('success') }}
    </div>
    @endif
    @if($orders->count())
    <div class="card">
        <div class="card-body">
            <div class="row m-b-30">
                <div class="col-lg-8">
                    <div class="d-md-flex">
                        <div class="m-b-10 m-r-15">
                            <select id="status_id" class="custom-select" onchange="selectOrderByStatus()" style="min-width: 180px;">
                                <option selected>Trạng thái</option>
                                @foreach ($status as $stt)
                                <option class="status" value="{{ $stt->id }}">
                                    {{ $stt->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="m-b-10">
                            <input name="code" type="text" id="search-by-code" class="form-control" placeholder="Search by code">
                        </div>
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-hover e-commerce-table">
                    <thead>
                        <tr>
                            <th>
                                <div class="checkbox">
                                    <input id="checkAll" type="checkbox">
                                    <label for="checkAll" class="m-b-0"></label>
                                </div>
                            </th>
                            <th>ID</th>
                            <th>Mã đơm hàng</th>
                            <th>Tên người nhận</th>
                            <th>Số điện thoại</th>
                            <th>Địa chỉ</th>
                            <th>Ngày đặt</th>
                            <th>Người đặt</th>
                            <th>Chi tiết</th>
                            <th>Trạng thái</th>
                        </tr>
                    </thead>
                    <tbody id="tbodyOrder">
                        @foreach ($orders as $item)
                        <tr id="idOrder{{ $item->id }}">
                            <td>
                                <div class="checkbox">
                                    <input id="check-item-{{ $item->id }}" type="checkbox">
                                    <label for="check-item-{{ $item->id }}" class="m-b-0"></label>
                                </div>
                            </td>
                            <td>#{{ $item->id }}</td>
                            <td>{{ $item->code }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->phone }}</td>
                            <td>{{ $item->address }}</td>
                            <td>{{ $item->created_at }}</td>
                            <td>
                                @foreach ($authors as $author)
                                @if ($author->id == $item->user_id)
                                {{ $author->name }}
                                @endif
                                @endforeach
                            </td>
                            <td>
                                <button data-toggle="modal" data-target=".modal-order-detail" data-id="{{$item->id}}" class="btn btn-icon btn-hover btn-sm btn-rounded order-detail">
                                    <i class="anticon anticon-eye"></i>
                                </button>
                            </td>
                            <td>
                                @if($item->id != 5)
                                <select name="status" id="status" class="custom-select select-order" style="min-width: 180px;" data-id="{{$item->id}}" {{$item->status_id == 5 ? 'disabled' : ''}}>
                                    @foreach ($status as $stt)
                                    <option class="status-{{ $item->id }}" value="{{ $stt->id }}" {{ $stt->id == $item->status_id ? ' selected' : '' }}>
                                        {{ $stt->name }}
                                    </option>
                                    @endforeach
                                </select>
                                @else
                                Đã hủy
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="modal fade bd-example-modal-xl modal-order-detail">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title h4">Chi tiết đơn hàng</h5>
                                <button type="button" class="close" data-dismiss="modal">
                                    <i class="anticon anticon-close"></i>
                                </button>
                            </div>
                            <div class="modal-body">
                                <table class="table-responsive" style="max-width:670px;margin:50px auto 10px;background-color:#fff;padding:50px;-webkit-border-radius:3px;-moz-border-radius:3px;border-radius:3px;-webkit-box-shadow:0 1px 3px rgba(0,0,0,.12),0 1px 2px rgba(0,0,0,.24);-moz-box-shadow:0 1px 3px rgba(0,0,0,.12),0 1px 2px rgba(0,0,0,.24);box-shadow:0 1px 3px rgba(0,0,0,.12),0 1px 2px rgba(0,0,0,.24); border-top: solid 10px #11e3fe;">
                                    <thead>
                                        <tr>
                                            <th style="text-align:left;"><img id="avatar_customer" style="max-width: 150px;" src="" alt="Avatar customer"></th>
                                            <th style="text-align:right;font-weight:400;" id="order_time"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td style="height:35px;"></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" style="border: solid 1px #ddd; padding:10px 20px;">
                                                <p style="font-size:14px;margin:0 0 6px 0;"><span style="font-weight:bold;display:inline-block;min-width:150px">Trạng thái</span><b style="color:green;font-weight:normal;margin:0">Thành công</b></p>
                                                <p id="order_code" style="font-size:14px;margin:0 0 6px 0;"></p>
                                                <p id="order_total" style="font-size:14px;margin:0 0 0 0;"></p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="height:35px;"></td>
                                        </tr>
                                        <tr>
                                            <td style="width:50%;padding:20px;vertical-align:top">
                                                <p id="name_customer" style="margin:0 0 10px 0;padding:0;font-size:14px;"></p>
                                                <p id="email_customer" style="margin:0 0 10px 0;padding:0;font-size:14px;"></p>
                                                <p id="phone_customer" style="margin:0 0 10px 0;padding:0;font-size:14px;"></p>

                                            </td>
                                            <td style="width:50%;padding:20px;vertical-align:top">
                                                <p id="order_address" style="margin:0 0 10px 0;padding:0;font-size:14px;"></p>
                                                <p id="id_customer" style="margin:0 0 10px 0;padding:0;font-size:14px;"></p>
                                                <p id="code_voucher" style="margin:0 0 10px 0;padding:0;font-size:14px;"></p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" style="font-size:20px;padding:30px 15px 0 15px;">Sản phẩm</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" style="padding:15px;" id="order_products">

                                            </td>
                                        </tr>
                                    </tbody>
                                    <tfooter>
                                        <tr>
                                            <td colspan="2" style="font-size:14px;padding:50px 15px 0 15px;">
                                                <strong style="display:block;margin:0 0 10px 0;">Trân trọng</strong> BeeFood<br> Tòa nhà FPT Polytechnic, P. Trịnh Văn Bô, Xuân Phương, Nam Từ Liêm, Hà Nội
                                                <br><br>
                                                <b> Số điện thoại:</b> 03552-222011<br>
                                                <b>Email:</b> beefood@gmail.com
                                            </td>
                                        </tr>
                                    </tfooter>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-right">
                    {{ $orders->links() }}
                </div>
            </div>
        </div>
    </div>
    @else
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-12 text-center">
                    <center class="text-uppercase text-center text-20xl font-size-20 opacity-7 font-weight-border">
                        <th>
                            chưa có đơn hàng nào
                        </th>
                    </center>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    });
</script>
<script type="text/javascript" src="{{ asset('/js/handleGeneral/order/filter.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/handleGeneral/order/detail.js') }}"></script>
@endsection