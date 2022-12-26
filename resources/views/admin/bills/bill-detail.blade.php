@extends('layouts.admin.admin-master')
@section('title', $title)
@section('content')
<div class="d-none">
    <div class="bg-primary border-bottom p-3 d-flex align-items-center">
        <h4 class="font-weight-bold m-0 text-white flex-fill">BeeFood</h4>
        <a class="toggle1 text-white" id="clickMenus"><span> <i class="feather-align-justify fs-30"></i></span></a>
    </div>
</div>
<!-- checkout -->
<div class="container position-relative pb-5">
    <div class="py-5 row">
        <div class="col-md-12 text-center">
            <h3 class="text-center">Hoá đơn của chi tiết</h3>
        </div>
    </div>
    <div class="col-lg-7 col-md-7 m-auto p-3" style="border:1px solid #ffcc29">
        <div class="d-flex">
            <div class="text-uppercase">
                <h2 class="font-weight-bolder">Bee<em style="color: #e6b216; font-style: normal;">Food</em></h2>
            </div>
        </div>
        <div class="w-100">
            <h3 class="text-center">Hóa đơn mua hàng</h3>
            <h6 class="text-center pb-5">{{ $bill->created_at }}</h6>
            <div class="p-3 col-lg-10 m-auto">
                <p class="text-center"><b>Mã hóa đơn:</b> {{ $bill->code }}</p>
                <div class="d-flex">
                    <div class="col-lg-6"><b>Tên khách hàng: </b>{{ $bill->name }}</div>
                    <div class="col-lg-6"><b>Số điện thoại: </b> {{ $bill->phone }}</div>
                </div>
                <div class="d-flex">
                    <div class="col-lg-6"><b>Email: </b> {{ $bill->email }}</div>
                    <div class="col-lg-6"><b>Địa chỉ: </b> {{ $bill->address }}</div>
                </div>
            </div>
        </div>
        <div class="">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th></th>
                        <th>Tên sản phẩm</th>
                        {{-- <th>Ảnh</th> --}}
                        <th>Giá</th>
                        <th>Số lượng</th>
                        <th>Thành tiền</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($billDetail as $item)
                    <tr>
                        <td>{{ $item->user_name }}</td>
                        <td>{{ $item->nameProduct }} <br>
                            @if ($item->options != null)
                            @foreach ($item->options as $op)
                            @foreach ($options as $it)
                            @if ($it->id == $op)
                            <a class="text-primary">{{ $it->value }},</a>
                            @endif
                            @endforeach
                            @endforeach
                            @endif
                        </td>
                        {{-- <td><img src="{{ asset($item->avatar )}}" width="100px" alt=""></td> --}}
                        <td>{{ number_format($item->price) }}<sup>đ</sup></td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ number_format($item->total) }}<sup>đ</sup></td>
                        <p hidden>{{ $total += $item->total }}</p>
                    </tr>
                    @endforeach
                    <tr>
                        <td colspan="3">Shipper:</td>
                        <td colspan="1" class="text-success">Free<sup>đ</sup></td>
                    </tr>
                    <tr>
                        <td colspan="3">Mã giảm giá:</td>
                        <td colspan="1" class="text-warning">{{ $voucher != null ? $voucher->code : 'Không có' }}
                            {{ $voucher != null ? '(giảm '. $voucher->discount . '%)' : '' }}
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">Tổng tiền:</td>
                        <td colspan="1">
                            {{ $voucher != null ? number_format($total * ((100 - $voucher->discount) / 100)) : number_format($total) }}<sup>đ</sup>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="mt-3 text-center">
        <a href="{{ URL::previous() }}" class="btn btn-success ml-3">Quay lại</a>
    </div>
</div>
@endsection