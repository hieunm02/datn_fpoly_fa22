@extends('layouts.client.client-master')
@section('title-page', 'Hồ sơ')
@section('content')
@if(Auth::check())
<div class="osahan-profile">
    @if (session()->has('error'))
    <div id="setout" class="text-white alert bg-danger position-fixed" style="right: 8px; z-index: 9999;">
        {{ session()->get('error') }}
    </div>
    @endif
    <div class="d-none">
        <div class="bg-primary border-bottom p-3 d-flex align-items-center">
            <h4 class="font-weight-bold m-0 text-white flex-fill">Hồ sơ</h4>
            <a class="toggle1 text-white" id="clickMenus"><span> <i class="feather-align-justify fs-30"></i></span></a>
        </div>
    </div>
    <!-- profile -->
    <div class="container position-relative">
        <div class="py-5 osahan-profile row">
            <div class="col-md-4 mb-3">
                <div class="bg-white rounded shadow-sm sticky_sidebar overflow-hidden">
                    <a href="#" class="">
                        <div class="d-flex align-items-center p-3">
                            <div class="left mr-3">
                                <img alt="#" src="{{ Auth::user()->avatar }}" class="rounded-circle">
                            </div>
                            <div class="right">
                                <h6 class="mb-1 font-weight-bold">{{ Auth::user()->name }}
                                    <i class="feather-check-circle text-success"></i>
                                </h6>
                                <p class="text-muted m-0 small">{{ Auth::user()->email }}</p>
                            </div>
                        </div>
                    </a>
                    <div class="osahan-credits d-flex align-items-center p-3 bg-light">
                        <p class="m-0">Điểm tích lũy: </p>
                        <h5 class="m-0 ml-auto text-primary point-user">{{Auth::user()->point}}</h5>
                    </div>
                    <!-- profile-details -->
                    <div class="bg-white profile-details">
                        <!-- <a data-toggle="modal" data-target="#paycard" class="d-flex w-100 align-items-center border-bottom p-3">
                            <div class="left mr-3">
                                <h6 class="font-weight-bold mb-1 text-dark">Thẻ thanh toán</h6>
                                <p class="small text-muted m-0">Thêm thẻ tín dụng hoặc thẻ ghi nợ</p>
                            </div>
                            <div class="right ml-auto">
                                <h6 class="font-weight-bold m-0"><i class="feather-chevron-right"></i></h6>
                            </div>
                        </a> -->
                        <a data-toggle="modal" data-target="#exampleModal" class="d-flex w-100 align-items-center border-bottom p-3">
                            <div class="left mr-3">
                                <h6 class="font-weight-bold mb-1 text-dark">Đổi điểm lấy voucher</h6>
                                <p class="small text-muted m-0">Sử dụng điểm tích lũy để đổi voucher</p>
                            </div>
                            <div class="right ml-auto">
                                <h6 class="font-weight-bold m-0"><i class="feather-chevron-right"></i></h6>
                            </div>
                        </a>
                        <a class="d-flex align-items-center text-muted border-bottom p-3" href="/offers" >
                            <div class="left mr-3">
                                <h6 class="font-weight-bold mb-1">Kho voucher</h6>
                                <p class="small text-primary m-0">Quản lý voucher của bạn</p>
                            </div>
                            <div class="right ml-auto">
                                <h6 class="font-weight-bold m-0"><i class="feather-chevron-right"></i></h6>
                            </div>
                        </a>
                        <a href="faq.html" class="d-flex w-100 align-items-center border-bottom px-3 py-4">
                            <div class="left mr-3">
                                <h6 class="font-weight-bold m-0 text-dark"><i class="feather-truck bg-danger text-white p-2 rounded-circle mr-2"></i>Hỗ trợ
                                    giao hàng</h6>
                            </div>
                            <div class="right ml-auto">
                                <h6 class="font-weight-bold m-0"><i class="feather-chevron-right"></i></h6>
                            </div>
                        </a>
                        <a href="contact-us.html" class="d-flex w-100 align-items-center border-bottom px-3 py-4">
                            <div class="left mr-3">
                                <h6 class="font-weight-bold m-0 text-dark"><i class="feather-phone bg-primary text-white p-2 rounded-circle mr-2"></i>Liên lạc
                                </h6>
                            </div>
                            <div class="right ml-auto">
                                <h6 class="font-weight-bold m-0"><i class="feather-chevron-right"></i></h6>
                            </div>
                        </a>
                        <a href="terms.html" class="d-flex w-100 align-items-center border-bottom px-3 py-4">
                            <div class="left mr-3">
                                <h6 class="font-weight-bold m-0 text-dark"><i class="feather-info bg-success text-white p-2 rounded-circle mr-2"></i>Điều
                                    khoản sử dụng</h6>
                            </div>
                            <div class="right ml-auto">
                                <h6 class="font-weight-bold m-0"><i class="feather-chevron-right"></i></h6>
                            </div>
                        </a>
                        <a href="privacy.html" class="d-flex w-100 align-items-center px-3 py-4">
                            <div class="left mr-3">
                                <h6 class="font-weight-bold m-0 text-dark"><i class="feather-lock bg-warning text-white p-2 rounded-circle mr-2"></i>Chính
                                    sách bảo mật</h6>
                            </div>
                            <div class="right ml-auto">
                                <h6 class="font-weight-bold m-0"><i class="feather-chevron-right"></i></h6>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-8 mb-3">
                <div class="rounded shadow-sm p-4 bg-white">
                    <h5 class="mb-4">Tài khoản của tôi</h5>
                    @if (session()->has('success'))
                    <p class="text-white alert bg-success m-0">
                        {{ session()->get('success') }}
                    </p>
                    @endif
                    <div id="edit_profile">
                        <div>
                            <form action="{{ route('profile.update') }}" method="POST">
                                @csrf
                                <input name="id" type="hidden" value="{{ Auth::id() }}">
                                <div class="form-group">
                                    <label for="exampleInputName1">Họ và tên</label>
                                    <input type="text" class="form-control" disabled id="exampleInputName1d" value="{{ Auth::user()->name }}" name="name">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputNumber1">Số điện thoại</label>
                                    <input type="number" class="form-control" id="exampleInputNumber1" <?php echo $errors->first('phone') ? 'is-invalid' : ''; ?> value="{{ Auth::user()->phone }}" name="phone">
                                    <p>{{ $errors->first('phone') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email</label>
                                    <input type="email" class="form-control" disabled id="exampleInputEmail1" value="{{ Auth::user()->email }}" name="email">
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary btn-block">Lưu thay đổi</button>
                                </div>
                            </form>
                        </div>
                        <div class="additional">
                            <div class="change_password my-3">
                                <a href="forgot_password.html" class="p-3 border rounded bg-white btn d-flex align-items-center">Đổi mật khẩu
                                    <i class="feather-arrow-right ml-auto"></i></a>
                            </div>
                            <div class="deactivate_account">
                                <a href="forgot_password.html" class="p-3 border rounded bg-white btn d-flex align-items-center">Hủy kích hoạt tài
                                    khoản
                                    <i class="feather-arrow-right ml-auto"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer -->
</div>
@endif
@endsection