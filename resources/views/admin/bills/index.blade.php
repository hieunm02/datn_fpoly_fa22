@extends('layouts.admin.admin-master')
@section('title', $title)
@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>;
<div class="main-content">
    <div class="page-header">
        <h2 class="header-title">{{$title}}</h2>
    </div>
    @if (session('success'))
    <div class="alert alert-success">
        <i class="fa fa-check"></i>
        <span class="alert_success">{{ session('success') }}</span>
    </div>
    @endif
    @if($bills->count())
    <div class="card">
        <div class="card-body">
            <div class="row m-b-30">
                <div class="col-lg-7">
                    <div class="d-md-flex">
                        <div class="m-b-10">
                            <select class="custom-select" style="min-width: 180px;">
                                <option selected>Status</option>
                                <option value="all">All</option>
                                <option value="inStock">In Stock </option>
                                <option value="outOfStock">Out of Stock</option>
                            </select>
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
                                    <input id="checkAll" type="checkbox" disabled>
                                    <label for="checkAll" class="m-b-0"></label>
                                </div>
                            </th>
                            <th>ID</th>
                            <th>Email</th>
                            <th>Mã</th>
                            <th>Tên</th>
                            <th>Tổng tiền</th>
                            <th>Chức năng</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bills as $index => $bill)
                        <tr id="id{{$bill->id}}">
                            <td>
                                <div class="checkbox">
                                    <input id="check-item-1" type="checkbox">
                                    <label for="check-item-1" class="m-b-0"></label>
                                </div>
                            </td>
                            <td>{{$bill->id}}</td>
                            <td>{{$bill->email}}</td>
                            <td>{{$bill->code}}</td>
                            <td>{{$bill->name}}</td>
                            <td>{{$bill->total}}</td>
                            <td>
                                <button data-toggle="modal" data-target=".bd-example-modal-xl" data-id="{{$bill->id}}" class="btn btn-icon btn-hover btn-sm btn-rounded bill-detail">
                                    <i class="anticon anticon-eye"></i>
                                </button>
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
                                                <!-- <p style="margin:0 0 10px 0;padding:0;font-size:14px;"><span style="display:block;font-weight:bold;font-size:13px;">Number of gusets</span> 2</p>
                                                <p style="margin:0 0 10px 0;padding:0;font-size:14px;"><span style="display:block;font-weight:bold;font-size:13px;">Duration of your vacation</span> 25/04/2017 to 28/04/2017 (3 Days)</p> -->
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
                                                <b>Phone:</b> 03552-222011<br>
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
        </div>
    </div>
    @else
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-12 text-center">
                    <center class="text-uppercase text-center text-20xl font-size-20 opacity-7 font-weight-border">
                        <th>
                            chưa có hóa đơn hàng nào
                        </th>
                    </center>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
<div style="display: flex; justify-content: center">
    {{ $bills->links() }}
</div>
</div>
</div>
</div>
</div>
@endsection