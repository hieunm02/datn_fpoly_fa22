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
<div class="container position-relative">
    <div class="py-5 row">
        <div class="col-md-6 mb-3">
            <div>
                <div class="osahan-cart-item mb-3 rounded shadow-sm bg-white overflow-hidden">
                    <div class="osahan-cart-item-profile bg-white p-3">
                        <div class="d-flex flex-column">
                            <h6 class="mb-3 font-weight-bold btn btn-primary">Chi tiết thanh toán</h6>
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <label class="form-label font-weight-bold">Họ và tên <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input placeholder="" name="" type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-3 form-group">
                                            <label class="form-label font-weight-bold">Tòa <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <select name="" class="form-control">
                                                    <option value="">Tòa</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3 form-group">
                                            <label class="form-label font-weight-bold">Tầng <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <select name="" class="form-control">
                                                    <option value="">Tầng</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label class="form-label font-weight-bold">Phòng <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <select name="" class="form-control">
                                                    <option value="">Phòng</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-6 form-group">
                                            <label class="form-label font-weight-bold">Số điện thoại <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <input placeholder="" name="" type="text" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label class="form-label font-weight-bold">Email <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <input placeholder="" name="" type="text" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 form-group">
                                    <label class="form-label font-weight-bold">Ghi chú</label>
                                    <div class="input-group">
                                        <textarea rows="5" name="" placeholder="Ghi chú về đơn đặt hàng của bạn. Ví dụ : Ghi chú đặc biệt giao hàng." class="form-control"></textarea>
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
                <div class="d-flex border-bottom osahan-cart-item-profile bg-white p-3">
                    <div class="d-flex col-md-12 flex-column p-0">
                        <h6 class="mb-3 font-weight-bold btn btn-primary">Đơn hàng của bạn</h6>
                    </div>
                </div>
                <div class="bg-white border-bottom py-2">
                    <div class="gold-members d-flex align-items-center justify-content-between px-3 py-2 border-bottom">
                        <div class="media align-items-center">
                            <div class="mr-2 text-danger">&middot;</div>
                            <div class="media-body">
                                <p class="m-0">Chicken Tikka Sub</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <span class="count-number float-right"><button type="button" class="btn-sm left dec btn btn-outline-secondary"> <i class="feather-minus"></i> </button><input class="count-number-input" type="text" readonly="" value="2"><button type="button" class="btn-sm right inc btn btn-outline-secondary"> <i class="feather-plus"></i> </button></span>
                            <p class="text-gray mb-0 float-right ml-2 text-muted small">$628</p>
                        </div>
                    </div>
                    <div class="gold-members d-flex align-items-center justify-content-between px-3 py-2 border-bottom">
                        <div class="media align-items-center">
                            <div class="mr-2 text-danger">&middot;</div>
                            <div class="media-body">
                                <p class="m-0">Methi Chicken Dry
                                </p>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <span class="count-number float-right"><button type="button" class="btn-sm left dec btn btn-outline-secondary"> <i class="feather-minus"></i> </button><input class="count-number-input" type="text" readonly="" value="2"><button type="button" class="btn-sm right inc btn btn-outline-secondary"> <i class="feather-plus"></i> </button></span>
                            <p class="text-gray mb-0 float-right ml-2 text-muted small">$628</p>
                        </div>
                    </div>
                    <div class="gold-members d-flex align-items-center justify-content-between px-3 py-2 border-bottom">
                        <div class="media align-items-center">
                            <div class="mr-2 text-danger">&middot;</div>
                            <div class="media-body">
                                <p class="m-0">Reshmi Kebab
                                </p>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <span class="count-number float-right"><button type="button" class="btn-sm left dec btn btn-outline-secondary"> <i class="feather-minus"></i> </button><input class="count-number-input" type="text" readonly="" value="2"><button type="button" class="btn-sm right inc btn btn-outline-secondary"> <i class="feather-plus"></i> </button></span>
                            <p class="text-gray mb-0 float-right ml-2 text-muted small">$628</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white p-3 py-3 border-bottom clearfix">
                    <div class="input-group-sm mb-2 input-group">
                        <input placeholder="Nhập mã voucher" type="text" class="form-control">
                        <div class="input-group-append"><button type="button" class="btn btn-primary"><i class="feather-percent"></i> Áp dụng</button></div>
                    </div>
                </div>
                <div class="bg-white p-3 clearfix border-bottom">
                    <p class="mb-1">Tổng <span class="float-right text-dark">$3140</span></p>
                    <p class="mb-1">Shipping<span class="text-info ml-1"><i class="feather-info"></i></span><span class="float-right text-dark">Free</span></p>
                    <p class="mb-1 text-success">Giảm voucher<span class="float-right text-success">$1884</span></p>
                    <hr>
                    <h6 class="font-weight-bold mb-0">Thanh toán <span class="float-right">$1329</span></h6>
                    <div class="form-group mt-1 d-flex align-items-center">
                        <input type="checkbox" name="" id="checkin"> 
                        <label for="checkin" class="m-0 mx-1">Thanh toán khi nhận hàng</label>
                    </div>
                </div>
                <div class="p-3">
                    <a class="btn btn-success btn-block btn-lg" href="successful.html">Đặt hàng<i class="feather-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection