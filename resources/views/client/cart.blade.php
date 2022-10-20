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
                            <tr>
                                <th><input type="checkbox" name="" id=""></th>
                                <th colspan="2">Sản Phẩm</th>
                                <th>Đơn Giá</th>
                                <th>Số Lượng</th>
                                <th>Số Tiền</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><input type="checkbox" name="" id=""></td>
                                <td><img src="http://vn.blog.kkday.com/wp-content/uploads/chup-anh-dep-bang-dien-thoai-25.jpg"
                                        width="100px" alt=""></td>
                                <td>Danh mục: Bánh mì</td>
                                <td>100.000 <sup>Đ</sup></td>
                                <td>
                                    <span class="count-number">
                                        <button type="button" class="btn-sm left dec btn btn-outline-secondary"> <i
                                                class="feather-minus"></i> </button><input class="count-number-input"
                                            type="text" readonly="" value="2"><button type="button"
                                            class="btn-sm right inc btn btn-outline-secondary"> <i class="feather-plus"></i>
                                        </button>
                                    </span>
                                </td>
                                <td class="text-danger">200.000 <sup>Đ</sup></td>
                                <td>1</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-12 py-2 row">
                    <div class="col-12">
                        <input type="checkbox" name="" id=""> Sản phẩm
                    </div>
                    <div class="col-1"> <input type="checkbox" name="" id=""></div>
                    <div class="col-4">
                        <img src="http://vn.blog.kkday.com/wp-content/uploads/chup-anh-dep-bang-dien-thoai-25.jpg" width="100px" alt="">
                    </div>
                    <div class="col-7"></div>
                </div>
            </div>
        </div>
    </div>
@endsection
