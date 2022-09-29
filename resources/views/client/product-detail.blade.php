@extends('layouts.client.client-master')
@section('title-page', 'Product Detail')
@section('content')
    <div class="d-none">
        <div class="bg-primary border-bottom p-3 d-flex align-items-center">
            <a class="toggle togglew toggle-2" href="#"><span></span></a>
            <h4 class="font-weight-bold m-0 text-white">Product Detail</h4>
        </div>
    </div>
    <!-- checkout -->
    <div class="container position-relative">
        <div class="py-3 row">
            <div class="col-md-6 mb-3">
                <div>
                    <div class="osahan-cart-item mb-3 rounded shadow-sm bg-white overflow-hidden">
                        <div class="osahan-cart-item-profile bg-white p-3">
                            <div class="d-flex flex-column">
                                <div class="col-md-12 p-0 mb-1">
                                    <img width="100%" id="imgClick"
                                        src="https://images.foody.vn/res/g75/747170/prof/s640x400/foody-upload-api-foody-mobile-1-jpg-180606103333.jpg"
                                        alt="">
                                </div>
                                <div class="col-md-12 p-0 d-flex">
                                    <div class="col-md-3 p-1">
                                        <img width="100%"
                                            onclick="changeImage('https://images.foody.vn/res/g105/1048075/prof/s640x400/foody-upload-api-foody-mobile-c3-200924105851.jpg')"
                                            src="https://images.foody.vn/res/g105/1048075/prof/s640x400/foody-upload-api-foody-mobile-c3-200924105851.jpg"
                                            alt="">
                                    </div>
                                    <div class="col-md-3 p-1">
                                        <img width="100%"
                                            onclick="changeImage('https://images.foody.vn/res/g92/911616/prof/s640x400/foody-upload-api-foody-mobile-pizza-190503102619.jpg')"
                                            src="https://images.foody.vn/res/g92/911616/prof/s640x400/foody-upload-api-foody-mobile-pizza-190503102619.jpg"
                                            alt="">
                                    </div>
                                    <div class="col-md-3 p-1">
                                        <img width="100%"
                                            onclick="changeImage('https://images.foody.vn/res/g106/1050058/prof/s640x400/image-15c36f87-211105213046.jpeg')"
                                            src="https://images.foody.vn/res/g106/1050058/prof/s640x400/image-15c36f87-211105213046.jpeg"
                                            alt="">
                                    </div>
                                    <div class="col-md-3 p-1">
                                        <img width="100%"
                                            onclick="changeImage('https://images.foody.vn/res/g100/996223/prof/s640x400/foody-upload-api-foody-mobile-kham-pha-3-quan-che--200102135359.jpg')"
                                            src="https://images.foody.vn/res/g100/996223/prof/s640x400/foody-upload-api-foody-mobile-kham-pha-3-quan-che--200102135359.jpg"
                                            alt="">
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="osahan-cart-item rounded rounded shadow-sm overflow-hidden bg-white">
                    <div class="d-flex osahan-cart-item-profile bg-white p-3">
                        <div class="d-flex col-md-12 flex-column p-0">
                            <div class="header-sub-title">
                                <nav class="breadcrumb breadcrumb-dash m-0">
                                    <a href="#" class="breadcrumb-item"><i
                                            class="anticon anticon-home m-r-5"></i>Home</a>
                                    <a class="breadcrumb-item" href="#">Products</a>
                                    <span class="breadcrumb-item active">Product Detail</span>
                                </nav>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white">
                        <div class="gold-members d-flex align-items-center justify-content-between px-3">
                            <h1 class="font-weight-bolder m-0">Bánh mì pate</h1>
                        </div>
                    </div>
                    <div class="bg-white px-3 clearfix d-flex align-items-center">
                        <div class="mb-1 h6 p-0 text-warning flex-fill">
                            <i class="feather-star mr-n1"></i>
                            <i class="feather-star mr-n1"></i>
                            <i class="feather-star mr-n1"></i>
                            <i class="feather-star mr-n1"></i>
                            <i class="feather-star mr-n1"></i>
                            <div class="mx-2 p-0 px-2 text-white btn btn-warning">50+</div>
                        </div>
                        <div class="p-2 text-white btn btn-warning">Chia sẻ link</div>
                    </div>
                    <div class="p-3">
                        <h3 class="text-primary font-weight-bold pt-3">$50.000 - $60.000</h3>
                        <h5 class="text-dark font-weight-light">Loại: Bánh mì</h5>
                        <p class="text-break">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ut ad velit quam est
                            fugiat cum adipisci odit, laudantium illo facilis doloribus alias eligendi quasi, maiores
                            possimus voluptatibus, labore excepturi quos!</p>
                    </div>
                    <div class="p-3">
                        <input type="button" onclick="tru()" value="-" class="btn btn-outline-primary">
                        <input name="quantity"style="width: 40px;" class="input-qty btn btn-default" id="quantity"
                            min="1" type="text" value="1">
                        <input type="button" onclick="cong()" value="+" class="btn btn-outline-primary">
                        <a class="btn btn-success" href="successful.html">Đặt hàng<i class="feather-arrow-right"></i></a>
                        {{-- <a class="btn btn-outline-success" href="#"><i class="feather-heart h6"></i></a> --}}
                    </div>

                </div>
            </div>
        </div>
        <div class="pb-3 row">
            <div class="col-md-12">
                <div class="col-md-12 p-0">
                    <button class="p-3 m0 d-inline-block btn-dark cursor-pointer" onclick="clickComment()" id="clickComment">
                        Bình luận đánh giá</button>
                    <button class="p-3 m0 d-inline-block btn-dark cursor-pointer"  onclick="clickContent()"  id="clickContent">Mô tả</button>
                </div>
                <div class="osahan-cart-item mb-3 rounded shadow-sm bg-white overflow-hidden">
                    <div class="osahan-cart-item-profile bg-white p-3">
                        <div class="col-md-12" id="comment">
                            <div class="section-heading">
                                <h2>Bình luận</h2>
                                {{-- {{ Auth::user()->id }} --}}
                            </div>
                            {{-- @foreach ($comments as $item) --}}
                            <div class="product-item px-3 py-2 my-1 d-flex justify-content-between">
                                <div class="d-flex">
                                    <div class="avatar mr-2">
                                        <img src="https://images.foody.vn/res/g105/1048075/prof/s640x400/foody-upload-api-foody-mobile-c3-200924105851.jpg"
                                            style="width: 60px; height: 60px; object-fit: cover;" class="rounded-circle"
                                            alt="">
                                    </div>
                                    <div class="d-flex flex-column justify-content-center" style="flex: none;">
                                        <h6 class="mb-0">Khách hàng</h6>
                                        <div class="text-warning">
                                            <i class="feather-star mr-n1"></i>
                                            <i class="feather-star mr-n1"></i>
                                            <i class="feather-star mr-n1"></i>
                                            <i class="feather-star mr-n1"></i>
                                            <i class="feather-star mr-n1"></i>
                                        </div>
                                        <p class="text-black-50"> 30/09/2022</p>
                                    </div>
                                    <div class="content mx-4 my-auto">
                                        <p class="text-black-50 font-weight-bold"> Lorem, ipsum dolor sit amet consectetur
                                            adipisicing elit. Ducimus tempore placeat architecto, iste sit pariatur
                                            obcaecati cumque molestias, quo dolorem voluptatem alias sed nisi expedita
                                            veniam magni, ratione illum similique.</p>
                                    </div>
                                </div>
                                <form action="" method="post">
                                    <div class="float-right align-content-center">
                                        <button type="submit" class="btn btn-danger">Xóa</button>
                                    </div>
                                </form>
                            </div>

                            <form action="" method="POST">
                                <div class="form-group d-flex">
                                    <div>
                                        <img src="https://images.foody.vn/res/g100/996223/prof/s640x400/foody-upload-api-foody-mobile-kham-pha-3-quan-che--200102135359.jpg"
                                            style="width: 60px; height: auto;" class="mr-2" alt=""
                                            srcset="">
                                    </div>
                                    <input type="hidden" value=" $dataProduct->id" name="product_id"
                                        class="form-control mr-2" placeholder="id sản phẩm">
                                    <textarea type="text" name="content" class="form-control mr-2" placeholder="Viết bình luận"></textarea>
                                    <div><button type="submit" class="btn btn-primary">Bình luận</button></div>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-12 d-none" id="content">
                            <div class="section-heading">
                                <h2>Mô tả</h2>
                                {{-- {{ Auth::user()->id }} --}}
                            </div>
                            {{-- @foreach ($comments as $item) --}}
                            <div class="product-item px-3 py-2 my-1 d-flex justify-content-between">
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Iste, explicabo dignissimos.
                                    Aperiam consequatur rerum nam dignissimos officiis maxime quidem rem dolor quis in
                                    tenetur amet provident, consectetur velit sequi eaque!</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="pb-5 row">
            <div class="col-md-3 pb-3">
                <div class="list-card bg-white h-100 rounded overflow-hidden position-relative shadow-sm">
                    <div class="list-card-image">
                        <div class="star position-absolute"><span class="badge badge-success"><i class="feather-star"></i> 3.1 (300+)</span></div>
                        <div class="favourite-heart text-danger position-absolute"><a href="#"><i class="feather-heart"></i></a></div>
                        <div class="member-plan position-absolute"><span class="badge badge-dark">Promoted</span></div>
                        <a href="restaurant.html">
                            <img alt="#" src="img/popular2.png" class="img-fluid item-img w-100">
                        </a>
                    </div>
                    <div class="p-3 position-relative">
                        <div class="list-card-body">
                            <h6 class="mb-1"><a href="restaurant.html" class="text-black">Thai Famous Indian Cuisine</a></h6>
                            <p class="text-gray mb-1 small">• Indian • Pure veg</p>
                            <p class="text-gray mb-1 rating">
                            </p>
                            <ul class="rating-stars list-unstyled">
                                <li>
                                    <i class="feather-star star_active"></i>
                                    <i class="feather-star star_active"></i>
                                    <i class="feather-star star_active"></i>
                                    <i class="feather-star star_active"></i>
                                    <i class="feather-star"></i>
                                </li>
                            </ul>
                            <p></p>
                        </div>
                        <div class="list-card-badge">
                            <span class="badge badge-success">OFFER</span> <small>65% off</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 pb-3">
                <div class="list-card bg-white h-100 rounded overflow-hidden position-relative shadow-sm">
                    <div class="list-card-image">
                        <div class="star position-absolute"><span class="badge badge-success"><i class="feather-star"></i> 3.1 (300+)</span></div>
                        <div class="favourite-heart text-danger position-absolute"><a href="#"><i class="feather-heart"></i></a></div>
                        <div class="member-plan position-absolute"><span class="badge badge-dark">Promoted</span></div>
                        <a href="restaurant.html">
                            <img alt="#" src="img/popular2.png" class="img-fluid item-img w-100">
                        </a>
                    </div>
                    <div class="p-3 position-relative">
                        <div class="list-card-body">
                            <h6 class="mb-1"><a href="restaurant.html" class="text-black">Thai Famous Indian Cuisine</a></h6>
                            <p class="text-gray mb-1 small">• Indian • Pure veg</p>
                            <p class="text-gray mb-1 rating">
                            </p>
                            <ul class="rating-stars list-unstyled">
                                <li>
                                    <i class="feather-star star_active"></i>
                                    <i class="feather-star star_active"></i>
                                    <i class="feather-star star_active"></i>
                                    <i class="feather-star star_active"></i>
                                    <i class="feather-star"></i>
                                </li>
                            </ul>
                            <p></p>
                        </div>
                        <div class="list-card-badge">
                            <span class="badge badge-success">OFFER</span> <small>65% off</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 pb-3">
                <div class="list-card bg-white h-100 rounded overflow-hidden position-relative shadow-sm">
                    <div class="list-card-image">
                        <div class="star position-absolute"><span class="badge badge-success"><i class="feather-star"></i> 3.1 (300+)</span></div>
                        <div class="favourite-heart text-danger position-absolute"><a href="#"><i class="feather-heart"></i></a></div>
                        <div class="member-plan position-absolute"><span class="badge badge-dark">Promoted</span></div>
                        <a href="restaurant.html">
                            <img alt="#" src="img/popular2.png" class="img-fluid item-img w-100">
                        </a>
                    </div>
                    <div class="p-3 position-relative">
                        <div class="list-card-body">
                            <h6 class="mb-1"><a href="restaurant.html" class="text-black">Thai Famous Indian Cuisine</a></h6>
                            <p class="text-gray mb-1 small">• Indian • Pure veg</p>
                            <p class="text-gray mb-1 rating">
                            </p>
                            <ul class="rating-stars list-unstyled">
                                <li>
                                    <i class="feather-star star_active"></i>
                                    <i class="feather-star star_active"></i>
                                    <i class="feather-star star_active"></i>
                                    <i class="feather-star star_active"></i>
                                    <i class="feather-star"></i>
                                </li>
                            </ul>
                            <p></p>
                        </div>
                        <div class="list-card-badge">
                            <span class="badge badge-success">OFFER</span> <small>65% off</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 pb-3">
                <div class="list-card bg-white h-100 rounded overflow-hidden position-relative shadow-sm">
                    <div class="list-card-image">
                        <div class="star position-absolute"><span class="badge badge-success"><i class="feather-star"></i> 3.1 (300+)</span></div>
                        <div class="favourite-heart text-danger position-absolute"><a href="#"><i class="feather-heart"></i></a></div>
                        <div class="member-plan position-absolute"><span class="badge badge-dark">Promoted</span></div>
                        <a href="restaurant.html">
                            <img alt="#" src="img/popular2.png" class="img-fluid item-img w-100">
                        </a>
                    </div>
                    <div class="p-3 position-relative">
                        <div class="list-card-body">
                            <h6 class="mb-1"><a href="restaurant.html" class="text-black">Thai Famous Indian Cuisine</a></h6>
                            <p class="text-gray mb-1 small">• Indian • Pure veg</p>
                            <p class="text-gray mb-1 rating">
                            </p>
                            <ul class="rating-stars list-unstyled">
                                <li>
                                    <i class="feather-star star_active"></i>
                                    <i class="feather-star star_active"></i>
                                    <i class="feather-star star_active"></i>
                                    <i class="feather-star star_active"></i>
                                    <i class="feather-star"></i>
                                </li>
                            </ul>
                            <p></p>
                        </div>
                        <div class="list-card-badge">
                            <span class="badge badge-success">OFFER</span> <small>65% off</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
