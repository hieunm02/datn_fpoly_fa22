@extends('layouts.client.client-master')
@section('title-page', 'Checkout')
@section('content')
<div class="d-none">
    <div class="bg-primary border-bottom p-3 d-flex align-items-center">
        <h4 class="font-weight-bold m-0 text-white flex-fill">Checkout</h4>
        <a class="toggle1 text-white" id="clickMenus"><span> <i class="feather-align-justify fs-30"></i></span></a>
    </div>
</div>
<!-- checkout -->
<div id="mess">
    @if (session()->has('success'))
    <div id="setout" class="text-white alert bg-success position-fixed" style="right: 8px; z-index: 9999;">
        {{ session()->get('success') }}
    </div>
    @endif
</div>
<div class="container position-relative">
    <div class="py-5 row">
        <div action="#" class="row">
            {{-- {{ url('/orders') }} method="post"
            @csrf
            @method('POST') --}}
            <input type="hidden" value="{{ Auth::id() }}" class="auth_id">
            <div class="col-md-6 mb-3">
                <div>
                    <div class="osahan-cart-item mb-3 rounded shadow-sm bg-white overflow-hidden">
                        <div class="osahan-cart-item-profile bg-white p-3">
                            <div class="d-flex flex-column">
                                <h6 class="mb-3 font-weight-bold display-5 py-3 rounded text-center btn-primary">Chi
                                    tiết thanh toán</h6>
                                <div class="row">
                                    <div class="col-md-12 form-group">
                                        <label class="form-label font-weight-bold">Họ và tên <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <input placeholder="Họ tên" value="{{ Auth::user()->name ? Auth::user()->name : old('name') }}" name="name" type="text" class="form-control input-name">
                                        </div>
                                        <p class="text-danger m-0 error-name"></p>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-3 form-group">
                                                <label class="form-label font-weight-bold">Tòa <span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <select name="building" id="building" class="form-control input-building appearance-none  ">
                                                        <option value="">Tòa</option>
                                                        @foreach ($buildings as $building)
                                                        <option value="{{ $building->id }}">{{ $building->name }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <p class="text-danger m-0 error-building"></p>
                                            </div>
                                            <div class="col-md-3 form-group">
                                                <label class="form-label font-weight-bold">Tầng <span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <select name="floor" id="floor" class="form-control input-building appearance-none ">
                                                        <option value="">Tầng</option>
                                                    </select>
                                                </div>
                                                <p class="text-danger m-0 error-building"></p>

                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label class="form-label font-weight-bold">Phòng <span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <select name="room" id="room" class="form-control input-building appearance-none ">
                                                        <option value="">Phòng</option>
                                                    </select>
                                                </div>
                                                <p class="text-danger m-0 error-building"></p>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-6 form-group">
                                                <label class="form-label font-weight-bold">Số điện thoại <span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <input placeholder="Số điện thoại" value="{{ Auth::user()->phone ? Auth::user()->phone : old('phone') }}" name="phone" type="text" class="form-control input-phone">
                                                </div>
                                                <p class="text-danger m-0 error-phone"></p>

                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label class="form-label font-weight-bold">Email <span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <input placeholder="Email" name="email" type="text" class="form-control input-email" value="{{ Auth::user()->email ? Auth::user()->email : old('email') }}">
                                                </div>
                                                <p class="text-danger m-0 error-email"></p>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <label class="form-label font-weight-bold">Ghi chú</label>
                                        <div class="input-group">
                                            <textarea rows="5" name="note" placeholder="Ghi chú về đơn đặt hàng của bạn. Ví dụ : Ghi chú đặc biệt giao hàng." class="form-control">{{ old('note') }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="osahan-cart-item rounded rounded shadow-sm overflow-hidden bg-white sticky_sidebar">
                    <div class="border-bottom osahan-cart-item-profile bg-white p-3">
                        <div class="d-flex flex-column">
                            <h6 class="mb-3 font-weight-bold display-5 py-3 rounded text-center btn-primary">Đơn hàng
                                của bạn</h6>
                        </div>
                    </div>
                    <div class="bg-white py-2" id="showCartUser">
                        @if (count($carts) > 0)
                        @foreach ($carts as $cart)
                        <div hidden>
                            {{ $prd_option = 0 }}
                            {{ $cart->price_sales ? ($total += $cart->price_sales * $cart->quantity) : ($total += $cart->price * $cart->quantity) }}
                        </div>
                        <input hidden id="prd_id{{ $cart->id }}" value="{{ $cart->product_id }}">

                        <div id="cart_item{{ $cart->id }}" class="gold-members d-flex align-items-center justify-content-between px-3 py-2 border-bottom cart_item{{ $cart->product_id }}">
                            <div class="media align-items-center">
                                <div class="media-body d-flex">
                                    <input type="checkbox" hidden checked name="product_id[]" class="mr-1" value="{{ $cart->product_id }}">
                                    <p class="m-0">{{ $cart->name }}</p>
                                    <p class="m-0">
                                        @if ($cart->options != null)
                                        (@foreach (json_decode($cart->options) as $op)
                                        @foreach ($options as $it)
                                        @if ($it->id == $op)
                                    <p hidden>{{ $total += ($it->price * $cart->quantity) }} {{ $prd_option +=$it->price }}</p>
                                    {{ $it->value }},
                                    @endif
                                    @endforeach
                                    @endforeach)
                                    @endif
                                    </p>
                                </div>
                            </div>
                            <div class="d-flex align-items-center">
                                <span class="count-number float-right">
                                    <input class="count-number-input pr-1" width="50px" type="number" name="quantity" id="quantity{{ $cart->id }}" min="1" value="{{ $cart->quantity }}"><button type="button" class="btn-sm right inc btn btn-outline-secondary updateQty" data-id={{ $cart->id }} style="height: 24px;">
                                        <i class="feather-check"></i>
                                    </button>
                                </span>
                                <p id="show_total_product{{ $cart->id }}" class="text-gray mb-0 float-right ml-2 text-muted small">
                                    {{ number_format($cart->price_sales ? ($cart->price_sales + $prd_option) * $cart->quantity : ($cart->price + $prd_option) * $cart->quantity) }}
                                    <sup>đ</sup>
                                </p>
                                <button type="button" class="border-0 text-danger bg-white deletePrd" style="outline: none;" data-id={{ $cart->id }}><i class="feather-x-circle"></i></button>
                            </div>
                        </div>
                        @endforeach
                        <p class="text-danger text-center m-0 ml-3 error-product hetsanpham"></p>
                        @else
                        <div class="text-center text-danger">Chưa có sản phẩm nào</div>
                        @endif
                        <div class="text-center text-danger" id="cartNull"></div>
                    </div>
                    <div class="bg-white p-3 py-3 border-bottom clearfix">
                        <div class="input-group-sm mb-2 input-group">
                            <input data-toggle="modal" data-target="#modalVouchers" type="text" class="form-control code-voucher" name="voucher" placeholder="Xem voucher khả dụng">
                            <div class="input-group-append">
                                <button id="applyVoucher" type="button" class="btn btn-primary"><i class="feather-percent"></i> Áp
                                    dụng</button>
                            </div>
                        </div>
                        <p class="text-danger text-center m-0 error-voucher"></p>
                    </div>
                    <input type="hidden" value="{{$total}}" class="hidden_total">
                    <div class="bg-white p-3 clearfix border-bottom">
                        <p class="mb-1">Tổng <span id="show_total" class="float-right text-dark">{{ number_format($total) }}
                                <sup>đ</sup></span></p>
                        <p class="mb-1">Shipping<span class="text-info ml-1"><i class="feather-info"></i></span><span class="float-right text-dark">Free</span>
                        </p>
                        <p class="mb-1 text-success">Giảm voucher<span class="float-right text-success discount-voucher">{{ number_format(0) }} <sup>đ</sup></span></p>
                        <hr>
                        <h6 class="font-weight-bold mb-0">Thanh toán <span id="show_order" class="float-right">{{ number_format($total) }} <sup>đ</sup></span></h6>
                        <div class="form-group mt-1 d-flex align-items-center">
                            <input type="radio" checked name="" id="checkin">
                            <label for="checkin" class="m-0 mx-1">Thanh toán khi nhận hàng</label>
                        </div>
                    </div>
                    <div class="p-3">
                        <button class="btn btn-success btn-block btn-lg" id="datHang">Đặt hàng<i class="feather-arrow-right"></i></button>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    </div>
</div>
<div class="modal fade" id="modalVouchers" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Danh sách voucher</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-0">
                <div class="osahan-filter">
                    <div class="filter filter-voucher">
                        <!-- SORT BY -->
                        <div class="p-3 bg-light border-bottom">
                            <h6 class="m-0">Chọn voucher bạn muốn sử dụng</h6>
                        </div>
                        @foreach($vouchers as $voucher)
                        <div class="custom-control border-bottom px-0  custom-radio">
                            <input type="radio" id="customRadio{{$voucher->id}}" value="{{$voucher->code}}" name="voucher_code" class="custom-control-input">
                            <label class="custom-control-label py-3 w-100 px-3" for="customRadio{{$voucher->id}}">Mã <b style="color: red;">{{$voucher->code}}</b> (giảm {{$voucher->discount}}%)</label>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="modal-footer p-0 border-0">
                <div class="col-6 m-0 p-0">
                    <a href="#" class="btn border-top btn-lg btn-block" data-dismiss="modal">Đóng</a>
                </div>
                <div class="col-6 m-0 p-0">
                    <button type="submit" id="confirm_choose" class="btn btn-primary btn-lg btn-block">Chọn</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<style>
    .appearance-none {
        appearance: none;
    }
</style>