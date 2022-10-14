@extends('layouts.client.client-master')
@section('title-page', 'Product Detail')
@section('content')
    <div class="d-none">
        <div class="bg-primary border-bottom p-3 d-flex align-items-center">
            <h4 class="font-weight-bold m-0 text-white flex-fill">Product Detail</h4>
            <a class="toggle1 text-white" id="clickMenus"><span> <i class="feather-align-justify fs-30"></i></span></a>
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
                                         src="{{asset($product->thumb)}}"
                                         alt="">
                                </div>
                                <div class="col-md-12 p-0 d-flex">
                                    @foreach($thumb as $img)
                                        <div class="col-md-3 p-1">
                                            <img width="100%"
                                                 onclick="changeImage('{{asset($img->image)}}')"
                                                 src="{{asset($img->image)}}"
                                                 alt="">
                                        </div>
                                    @endforeach
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
                            <h1 class="font-weight-bolder m-0">{{$product->name}}</h1>
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
                        <h3 class="text-primary font-weight-bold pt-3">{{$product->price->original}}
                            - {{$product->price->sale}}</h3>
                        <h5 class="text-dark font-weight-light">Loại: {{$product->menu->name}}</h5>
                        <p class="text-break">{{$product->content}}</p>
                    </div>
                    <div class="p-3">
                        <input type="button" onclick="tru()" value="-" class="btn btn-outline-primary">
                        <input name="quantity" style="width: 40px;" class="input-qty btn btn-default" id="quantity"
                               min="1" type="text" value="1">
                        <input type="button" onclick="cong()" value="+" class="btn btn-outline-primary">
                        <a class="btn btn-success" href="successful.html">Đặt hàng<i
                                class="feather-arrow-right"></i></a>
                        {{-- <a class="btn btn-outline-success" href="#"><i class="feather-heart h6"></i></a> --}}
                    </div>

                </div>
            </div>
        </div>
        <div class="pb-3 row">
            <div class="col-md-12">
                <div class="col-md-12 p-0">
                    <button class="p-3 m0 d-inline-block btn-dark cursor-pointer" onclick="clickComment()"
                            id="clickComment">
                        Bình luận đánh giá
                    </button>
                    <button class="p-3 m0 d-inline-block btn-dark cursor-pointer" onclick="clickContent()"
                            id="clickContent">Mô tả
                    </button>
                </div>
                <div class="osahan-cart-item mb-3 rounded shadow-sm bg-white overflow-hidden">
                    <div class="osahan-cart-item-profile bg-white p-3">
                        <div class="col-md-12" id="comment">
                            <div class="section-heading">
                                <h2>Bình luận</h2>
                                {{-- {{ Auth::user()->id }} --}}
                            </div>
                            @foreach($comment as $cmt)
                                <div class="product-item px-3 py-2 my-1 d-flex justify-content-between">
                                    <div class="col-md-12 d-flex">
                                        <div class="avatar setCt mr-2">
                                            <img
                                                src="https://images.foody.vn/res/g105/1048075/prof/s640x400/foody-upload-api-foody-mobile-c3-200924105851.jpg"
                                                style="width: 60px; height: 60px; object-fit: cover;"
                                                class="rounded-circle"
                                                alt="">
                                        </div>
                                        <script
                                            src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
                                            integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
                                            crossorigin="anonymous"></script>
                                        <script
                                            src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
                                            integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF"
                                            crossorigin="anonymous"></script>

                                        <div class="setCt d-flex flex-column justify-content-center"
                                             style="flex: none;">
                                            <h6 class="mb-0">{{$cmt->user->name}}</h6>
                                            <h9 class="text-black-50"> 30/09/2022</h9>
                                            <h7 id="id{{$cmt->id}}"
                                                class="text-black-100 font-weight-bold"> {{$cmt->content}}
                                                <a
                                                    onclick="update({{ $cmt->id }})"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#edit-bookmark" id="editStudent"
                                                    data-id="{{ $cmt->id }}">
                                                    <img src="https://img.icons8.com/officexs/2x/edit.png" width="20px">
                                                </a>
                                            </h7>
                                            <form action="{{route('react-cmt')}}" method="post">
                                                @csrf
                                                <div class="text-warning" id="icon">
                                                    @foreach($react as $rct)
                                                        <style>
                                                            .example {
                                                                background: url({{$rct->icon}}) no-repeat;
                                                                cursor: pointer;;
                                                                width: 32px;
                                                                height: 32px;
                                                                border: none;
                                                            }
                                                        </style>
                                                        <input hidden name="comment_id" value="{{$cmt->id}}">
                                                        <input hidden name="reaction_id" value="1">
                                                        <input type="submit" class="example" value=""/> {{$cmt->reactions->count()}}
                                                    @endforeach
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <div class="modal fade modal-bookmark" id="edit-bookmark" tabindex="-1"
                                 style="display: none;"
                                 aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">chỉnh sửa bình luận</h5>
                                        </div>
                                        <div class="modal-body">
                                            <form class="form-bookmark needs-validation" novalidate="">
                                                <div class="form-row">
                                                    <div class="form-group col-md-12">
                                                        <div
                                                            class="form-group m-t-15 m-checkbox-inline mb-0 custom-radio-ml">
                                                            <input class="form-control" value="" id="content">
                                                        </div>
                                                    </div>
                                                </div>
                                                <input type="hidden" name="comment_id" value="{{$cmt->id}}"
                                                       id="comment_id">
                                                <br>
                                                <button class="btn btn-secondary" type="button" id="saveUpdateForm"
                                                        onclick="saveUpdate()">
                                                    Lưu
                                                </button>
                                                <button class="btn btn-primary" data-bs-dismiss="modal"
                                                        type="button"> Tắt
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
                            <script src="{{asset('assets/js/edit_comment.js')}}"></script>
                            <form action="{{route('product-comment', $product->id)}}" method="POST">
                                @csrf
                                <div class="form-group d-flex">
                                    <div>
                                        <img
                                            src="https://images.foody.vn/res/g100/996223/prof/s640x400/foody-upload-api-foody-mobile-kham-pha-3-quan-che--200102135359.jpg"
                                            style="width: 60px; height: auto;" class="mr-2" alt=""
                                            srcset="">
                                    </div>
                                    <input hidden name="product_id" value="{{$product->id}}">
                                    <textarea type="text" name="content" class="form-control mr-2"
                                              placeholder="Viết bình luận"></textarea>
                                    <div>
                                        <button type="submit" class="btn btn-primary">Bình luận</button>
                                    </div>
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
                                <p>
                                    {!! $product->desc !!}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="pb-5 row">
            @foreach($products as $product)
                <div class="col-md-3 pb-3">
                    <div class="list-card bg-white h-100 rounded overflow-hidden position-relative shadow-sm">
                        <div class="list-card-image">
                            <div class="star position-absolute"><span class="badge badge-success"><i
                                        class="feather-star"></i> 3.1 (300+)</span></div>
                            <div class="favourite-heart text-danger position-absolute"><a href="#"><i
                                        class="feather-heart"></i></a></div>
                            <div class="member-plan position-absolute"><span class="badge badge-dark">Promoted</span>
                            </div>
                            <a href="{{route('product-detail', $product->id)}}">
                                <img alt="#" src="{{asset($product->thumb)}}" class="img-fluid item-img w-100">
                            </a>
                        </div>
                        <div class="p-3 position-relative">
                            <div class="list-card-body">
                                <h6 class="mb-1"><a href="{{route('product-detail', $product->id)}}"
                                                    class="text-black">{{$product->name}}</a></h6>
                                <p class="text-gray mb-1 small">• {{$product->menu->name}}</p>
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
            @endforeach
        </div>
    </div>
@endsection
