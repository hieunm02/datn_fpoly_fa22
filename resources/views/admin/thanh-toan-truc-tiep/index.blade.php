@extends('layouts.admin.admin-master')
@section('title', $title)
@section('content')
    <div class="main-content">
        <div class="col-12">
            <h2 class="text-center font-weight-bold">Bán hàng trực tiếp tại quầy</h2>
        </div>
        <div class="col-12">
            <div class="row">
                <div class="col-md-9 pl-0" style="height: 560px;">
                    <div class="col-12 p-0" id="cartOrder">
                        {{-- show các đơn chưa thanh toán ở mua trực tuyến --}}
                        @foreach ($cartOrder as $index => $or)
                            <div class="btn btn-success p-1" data-id="{{ $or->order_tt }}"
                                onclick="showDonHang('{{ $or->order_tt }}')">Đơn {{ $index + 1 }}</div>
                        @endforeach
                        <div class="btn btn-success p-1" onclick="createOrderNew()"><i class="bi bi-plus"></i></div>
                    </div>
                    <div class="col-md-12 p-0 text-white" style="height: 280px;">
                        <div class="table-wrapper-scroll-y my-custom-scrollbar">
                            <table class="table table-bordered">
                                <thead class="table-success">
                                    <tr>
                                        <th>Sản phẩm</th>
                                        <th>Số lượng</th>
                                        <th>Thành tiền</th>
                                        <th></th>
                                    </tr>
                                    <tr id="id_cartTT">
                                        <input type="hidden" id="orderNew" value="order_ttnum">
                                    </tr>
                                </thead>
                                <tbody id="showCartTT">

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-12 text-white p-0" style="height: 280px;">
                        <div class="col-12 p-2 table-success">
                            <div class="d-inline-block">
                                <a class="d-inline btn btn-primary p-1" onclick="filterPrdAll()">Tất cả</a>
                                @foreach ($menus as $mn)
                                    <a class="d-inline btn btn-primary p-1"
                                        onclick="filterPrd({{ $mn->id }})">{{ $mn->name }}</a>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-12 py-2 table-wrapper-scroll-y my-custom-scrollbar"
                            style="background-color: rgb(234, 234, 234);">
                            <div class="row">
                                @foreach ($prds as $it)
                                    <div class="col-md-3 text-whiter p-2 filterPrd{{ $it->menu_id }} prdTT">
                                        <div class="d-flex bg-green-500">
                                            <div class="col-md-6 p-0">
                                                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcShR9LtGu7CHTBVgFYxmOzbU6FMo2XZEYuMSnha8Vejmz7H6gs_lrHkwTBn9J7p4BKJmAk&usqp=CAU"
                                                    width="100%" alt="">
                                            </div>
                                            <div class="col-md-6 pl-2 p-1">
                                                <span class="css_text">{{ $it->name }}</span>
                                                {{ $it->price_sales == 0 || $it->price_sales == null ? number_format($it->price, 0, ',', ',') : number_format($it->price_sales, 0, ',', ',') }}₫
                                                <a class="cursor-pointer">
                                                    <input type="checkbox" name="getPrd[]" value="{{ $it->id }}"></a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <button id="addprd" class="btn btn-primary mt-2">Thêm</button>
                    </div>
                </div>
                <div class="col-md-3 p-0 alert" style="height: 560px;">
                    <h3 class="alert badge-primary m-0">Thông tin hóa đơn</h3>
                    <div class="p-2 border">
                        <p class="border-bottom py-2 border-5">Tổng tiền hàng<span class="float-right text-dark"><span
                                    id="total1"></span><sup>đ</sup></span>
                        </p>
                        <p class="border-bottom py-2 border-5">Shipper<span class="float-right text-dark">Free</span></p>
                        <p class="border-bottom py-2 border-5 font-weight-bold">Tổng tiền hóa đơn<span
                                class="float-right text-danger"><span id="total2"></span><sup>đ</sup></span></p>
                        <div class="form-group mb-1">
                            <label for="">Tên khách hàng</label>
                            <input type="text" name="name" class="form-control" placeholder="Tên khách hàng">
                        </div>
                        <div class="form-group mb-1">
                            <label for="">Email</label>
                            <input type="email" name="email" class="form-control" placeholder="Email khách hàng">
                        </div>
                        <div class="form-group mb-1">
                            <label for="">Số điện thoại</label>
                            <input type="number" name="phone" class="form-control"
                                placeholder="Số điện thoại khách hàng">
                        </div>
                        <button class="btn btn-primary" id="payment">Thanh toán</button>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <style>
        .my-custom-scrollbar {
            position: relative;
            max-height: 260px;
            overflow: auto;
        }

        .table-wrapper-scroll-y {
            display: block;
        }

        .css_text {
            display: -webkit-box;
            max-height: 3.2rem;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: normal;
            -webkit-line-clamp: 1;
            line-height: 1.6rem;
        }
    </style>
    <script src="{{ asset('js/handleGeneral/admin/thanh-toan-truc-tiep.js') }}"></script>
    <script>$('#orderNew').val(Math.floor(Math.random() * 10000))</script>
@endsection
