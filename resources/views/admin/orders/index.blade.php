@extends('layouts.admin.admin-master')
@section('title', $title)
@section('content')
<link rel="stylesheet" href="{{ asset('/css/paginate.css') }}">
<div class="main-content">
    <div class="page-header">
        <h2 class="header-title">{{ $title }}</h2>
    </div>
    <input type="hidden" name="user_id" id="user_id" value="{{Auth::id()}}">
    @if (session()->has('success'))
    <div class="text-white alert bg-success">
        {{ session()->get('success') }}
    </div>
    @endif
    @if ($orders->count())
    <div class="card">
        <div class="card-body">
            <div class="card">
                <div class="card-body">
                    <div class="card">
                        <div class="card-body">
                            <div class="row m-b-30">
                                <div class="col-lg-8">
                                    <div class="d-md-flex">
                                        <div class="m-b-10 mr-3">
                                            <select class="custom-select select-active" style="min-width: 180px;">
                                                <option selected value="">Trạng thái</option>
                                                @foreach ($status as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="m-b-10">
                                            <input type="text" name="text_search" class="form-control" placeholder="Tìm kiếm..." style="width: 180px;">
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
                                            <th>Mã đơn hàng</th>
                                            <th>Tên người nhận</th>
                                            <th>Số điện thoại</th>
                                            <th>Địa chỉ</th>
                                            <th>Ngày đặt</th>
                                            <th>Người đặt</th>
                                            <th>Ghi chú</th>
                                            <th>Trạng thái</th>
                                        </tr>
                                    </thead>
                                    <tbody id="orders_list">
                                        @foreach ($orders as $item)
                                        <tr id="id{{ $item->id }}">
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
                                            <td>{{ $item->user_id }}</td>
                                            <td>{{ $item->note }}</td>

                                            <td>
                                                <input type="hidden" class="array_status" value="{{ $status }}">
                                                <select name="status" data-id="{{ $item->id }}" id="status" class="custom-select custom_status" style="min-width: 180px;">
                                                    @foreach ($status as $stt)
                                                    <option class="status-{{ $item->id }}" value="{{ $stt->id }}" {{ $stt->id == $item->status_id ? ' selected' : '' }}>
                                                        {{ $stt->name }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-xl" onclick="orderDetails({{ $item->id }})">Chi tiết đơn
                                                    hàng</button>


                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-xl">
                                        <div class="modal-content col-12">
                                            <table class="table table-responsive-lg">
                                                <thead>
                                                    <th>#id</th>
                                                    <th>Tên sản phẩm</th>
                                                    <th>Ảnh</th>
                                                    <th>Giá</th>
                                                    <th>Số lượng</th>
                                                    <th>Tổng tiền</th>
                                                </thead>
                                                <tbody class="order_details">

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-right pagination">
                                {{ $orders->links() }}
                            </div>
                        </div>
                    </div>
                    <<<<<<< HEAD <div class="table-responsive">
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
                                    <th>Mã đơn hàng</th>
                                    <th>Tên người nhận</th>
                                    <th>Số điện thoại</th>
                                    <th>Địa chỉ</th>
                                    <th>Ngày đặt</th>
                                    <th>Người đặt</th>
                                    <th>Chi tiết</th>
                                    <th>Trạng thái</th>
                                </tr>
                            </thead>
                            <tbody id="orders_list">
                                @foreach ($orders as $item)
                                <tr id="id{{ $item->id }}">
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
                                    <td>{{ $item->user->name }}</td>
                                    <td><button data-toggle="modal" data-target=".bd-example-modal-xl" data-id="{{$item->id}}" class="btn btn-icon btn-hover btn-sm btn-rounded order-detail">
                                            <i class="anticon anticon-eye"></i>
                                        </button></td>
                                    <td>
                                        <input type="hidden" class="array_status" value="{{ $status }}">
                                        <select name="status" data-id="{{$item->id}}" id="status" class="custom-select custom_status" style="min-width: 180px;">
                                            @foreach ($status as $stt)
                                            <option class="status-{{ $item->id }}" value="{{ $stt->id }}" {{ $stt->id == $item->status_id ? ' selected' : '' }}>
                                                {{ $stt->name }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="modal fade bd-example-modal-xl">
                            <div class="modal-dialog modal-xl">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title h4">Hóa đơn chi tiết</h5>
                                        <button type="button" class="close" data-dismiss="modal">
                                            <i class="anticon anticon-close"></i>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <table class="table-responsive" style="max-width:670px;margin:50px auto 10px;background-color:#fff;padding:50px;-webkit-border-radius:3px;-moz-border-radius:3px;border-radius:3px;-webkit-box-shadow:0 1px 3px rgba(0,0,0,.12),0 1px 2px rgba(0,0,0,.24);-moz-box-shadow:0 1px 3px rgba(0,0,0,.12),0 1px 2px rgba(0,0,0,.24);box-shadow:0 1px 3px rgba(0,0,0,.12),0 1px 2px rgba(0,0,0,.24); border-top: solid 10px #11e3fe;">
                                            <thead>
                                                <tr>
                                                    <th style="text-align:left;"><img id="avatar_customer" style="max-width: 150px;" src="" alt="Avatar customer"></th>
                                                    <th style="text-align:right;font-weight:400;" id="bill_time"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td style="height:35px;"></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2" style="border: solid 1px #ddd; padding:10px 20px;">
                                                        <p style="font-size:14px;margin:0 0 6px 0;"><span style="font-weight:bold;display:inline-block;min-width:150px">Trạng thái</span><b style="color:green;font-weight:normal;margin:0">Thành công</b></p>
                                                        <p id="bill_code" style="font-size:14px;margin:0 0 6px 0;"></p>
                                                        <p id="bill_total" style="font-size:14px;margin:0 0 0 0;"></p>
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
                                                        <p id="bill_address" style="margin:0 0 10px 0;padding:0;font-size:14px;"></p>
                                                        <p id="id_customer" style="margin:0 0 10px 0;padding:0;font-size:14px;"></p>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2" style="font-size:20px;padding:30px 15px 0 15px;">Sản phẩm</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2" style="padding:15px;" id="bill_products">

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
                </div>
                <div class="text-right pagination">
                    {{ $orders->links() }}
                    =======
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
                        >>>>>>> dev
                    </div>
                </div>
            </div>
            @endif

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