@extends('layouts.client.client-master')
@section('title-page', 'Giỏ hàng')
@section('content')
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
                <div class="table-responsive">
                    <table class="table table-borderless">
                        <thead>
                            <tr style="border:1px solid black;">
                                <th><input type="checkbox" name="" id=""></th>
                                <th colspan="2">Sản Phẩm</th>
                                <th>Đơn Giá</th>
                                <th>Số Lượng</th>
                                <th>Số Tiền</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($carts)
                                @foreach ($carts as $cart)
                                    <tr>
                                        <td><input type="checkbox" name="" id=""></td>
                                        <td><img src="{{ asset($cart->thumb) }}" width="100px" alt=""></td>
                                        <td>{{ $cart->name }}</td>
                                        <td>{{ $cart->price }} <sup>Đ</sup></td>
                                        <td>
                                            <span class="count-number">
                                                <input class="count-number-input" width="50px" type="number" name="quantity"
                                                    value="{{ $cart->quantity }}" id="quantity">
                                                <button type="button" class="btn-sm right inc btn btn-outline-secondary">
                                                    <i class="feather-check"></i>
                                                </button>
                                            </span>
                                        </td>
                                        <td class="text-danger">{{ $cart->quantity * $cart->price }}<sup>Đ</sup></td>
                                        <td>
                                            <form action="{{ url('carts', $cart->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button><i class="feather-delete"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            @if (isset($carts))
                                <tr>
                                    <th colspan="7"><h2 class="text-center">Chưa có sản phẩm nào</h2></th>
                                </tr>
                            @endif 

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
