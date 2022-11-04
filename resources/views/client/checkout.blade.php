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
    {{-- <div id="mess">
        @if (session()->has('success'))
            <div id="setout" class="text-white alert bg-success position-fixed" style="right: 8px; z-index: 9999;">
                {{ session()->get('success') }}
            </div>
        @endif
    </div> --}}
    <div class="container position-relative">
        <div class="py-5 row">
            <form action="{{ url('/orders') }}" class="row" method="post">
                @csrf
                @method('POST')
                <div class="col-md-6 mb-3">
                    <div>
                        <div class="osahan-cart-item mb-3 rounded shadow-sm bg-white overflow-hidden">
                            <div class="osahan-cart-item-profile bg-white p-3">
                                <div class="d-flex flex-column">
                                    <h6 class="mb-3 font-weight-bold display-5 py-3 rounded text-center btn-primary">Chi
                                        tiết thanh toán</h6>
                                    <div class="row">
                                        <div class="col-md-12 form-group">
                                            <label class="form-label font-weight-bold">Họ và tên <span
                                                    class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <input placeholder="Họ tên" value="{{ old('name') }}" name="name"
                                                    type="text" class="form-control @error('name') is-invalid @enderror">
                                            </div>
                                            @error('name')
                                                <p class="text-danger m-0">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-3 form-group">
                                                    <label class="form-label font-weight-bold">Tòa <span
                                                            class="text-danger">*</span></label>
                                                    <div class="input-group">
                                                        <select name="building" id="building"
                                                            class="form-control @error('building') is-invalid appearance-none  @enderror">
                                                            <option value="">Tòa</option>
                                                            @foreach ($buildings as $building)
                                                                <option value="{{ $building->id }}">{{ $building->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    @error('building')
                                                        <p class="text-danger m-0">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="col-md-3 form-group">
                                                    <label class="form-label font-weight-bold">Tầng <span
                                                            class="text-danger">*</span></label>
                                                    <div class="input-group">
                                                        <select name="floor" id="floor"
                                                            class="form-control @error('floor') is-invalid appearance-none @enderror">
                                                            <option value="">Tầng</option>
                                                        </select>
                                                    </div>
                                                    @error('floor')
                                                        <p class="text-danger m-0">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <label class="form-label font-weight-bold">Phòng <span
                                                            class="text-danger">*</span></label>
                                                    <div class="input-group">
                                                        <select name="room" id="room"
                                                            class="form-control @error('room') is-invalid appearance-none @enderror">
                                                            <option value="">Phòng</option>
                                                        </select>
                                                    </div>
                                                    @error('room')
                                                        <p class="text-danger m-0">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-6 form-group">
                                                    <label class="form-label font-weight-bold">Số điện thoại <span
                                                            class="text-danger">*</span></label>
                                                    <div class="input-group">
                                                        <input placeholder="Số điện thoại" value="{{ old('phone') }}"
                                                            name="phone" type="text"
                                                            class="form-control @error('phone') is-invalid @enderror">
                                                    </div>
                                                    @error('phone')
                                                        <p class="text-danger m-0">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <label class="form-label font-weight-bold">Email <span
                                                            class="text-danger">*</span></label>
                                                    <div class="input-group">
                                                        <input placeholder="Email" name="email" type="text"
                                                            class="form-control @error('email') is-invalid @enderror"
                                                            value="{{ Auth::user()->email ? Auth::user()->email : old('email') }}">
                                                    </div>
                                                    @error('email')
                                                        <p class="text-danger m-0">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 form-group">
                                            <label class="form-label font-weight-bold">Ghi chú</label>
                                            <div class="input-group">
                                                <textarea rows="5" name="note"
                                                    placeholder="Ghi chú về đơn đặt hàng của bạn. Ví dụ : Ghi chú đặc biệt giao hàng." class="form-control">{{ old('note') }}</textarea>
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
                        <div class="bg-white py-2">
                            @if (count($carts) > 0)
                                @foreach ($carts as $cart)
                                    <div hidden>
                                        {{ $total += $cart->price * $cart->quantity }}
                                    </div>
                                    <input hidden id="prd_id{{ $cart->id }}" value="{{ $cart->product_id }}">
                                        
                                    <div id="cart_item{{ $cart->id }}"
                                        class="gold-members d-flex align-items-center justify-content-between px-3 py-2 border-bottom">
                                        <div class="media align-items-center">
                                            {{-- <div class="mr-2 text-danger">&middot;</div> --}}
                                            {{-- <form action="{{ url('carts', $cart->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                    </form> --}}
                                            <div class="media-body d-flex">
                                                <input type="checkbox" name="product_id[]" class="mr-1"
                                                    value="{{ $cart->id }}">
                                                <p class="m-0">{{ $cart->name }}</p>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <span class="count-number float-right">
                                                <input class="count-number-input pr-1" width="50px" type="number"
                                                    name="quantity" id="quantity{{ $cart->id }}" min="1"
                                                    value="{{ $cart->quantity }}"><button type="button"
                                                    class="btn-sm right inc btn btn-outline-secondary updateQty"
                                                    data-id={{ $cart->id }} style="height: 24px;">
                                                    <i class="feather-check"></i>
                                                </button>
                                            </span>
                                            <p id="show_total_product{{ $cart->id }}"
                                                class="text-gray mb-0 float-right ml-2 text-muted small">
                                                {{ number_format($cart->quantity * $cart->price) }} <sup>đ</sup></p>
                                            <button type="button" class="border-0 text-danger bg-white deletePrd"
                                                style="outline: none;" data-id={{ $cart->id }}><i
                                                    class="feather-x-circle"></i></button>
                                        </div>
                                    </div>
                                @endforeach
                                @error('product_id')
                                    <p class="text-danger m-0 ml-3">{{ $message }}</p>
                                @enderror
                            @else
                                <div class="text-center text-danger" >Chưa có sản phẩm nào</div>
                            @endif
                            <div class="text-center text-danger" id="cartNull"></div>
                        </div>
                        <div class="bg-white p-3 py-3 border-bottom clearfix">
                            <div class="input-group-sm mb-2 input-group">
                                <input placeholder="Nhập mã voucher" type="text" class="form-control">
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-primary"><i
                                            class="feather-percent"></i> Áp dụng</button></div>
                                </div>
                            </div>
                            <div class="bg-white p-3 clearfix border-bottom">
                                <p class="mb-1">Tổng <span id="show_total"
                                        class="float-right text-dark">{{ number_format($total) }}
                                        <sup>đ</sup></span></p>
                                <p class="mb-1">Shipping<span class="text-info ml-1"><i
                                            class="feather-info"></i></span><span
                                        class="float-right text-dark">Free</span></p>
                                <p class="mb-1 text-success">Giảm voucher<span
                                        class="float-right text-success">{{ number_format(0) }} <sup>đ</sup></span></p>
                                <hr>
                                <h6 class="font-weight-bold mb-0">Thanh toán <span id="show_order"
                                        class="float-right">{{ number_format($total) }} <sup>đ</sup></span></h6>
                                <div class="form-group mt-1 d-flex align-items-center">
                                    <input type="checkbox" name="" id="checkin">
                                    <label for="checkin" class="m-0 mx-1">Thanh toán khi nhận hàng</label>
                                </div>
                            </div>
                            <div class="p-3">
                                <button class="btn btn-success btn-block btn-lg" type="submit">Đặt hàng<i
                                        class="feather-arrow-right"></i></button>
                            </div>
                        </div>
                    </div>
            </form>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        </div>
    </div>
@endsection
<style>
    .appearance-none {
        appearance: none;
    }
</style>
