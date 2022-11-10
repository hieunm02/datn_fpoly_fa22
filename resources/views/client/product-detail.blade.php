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
                                    <img width="100%" id="imgClick" src="{{ asset($product->thumb) }}" alt="">
                                </div>
                                <div class="col-md-12 p-0 d-flex">
                                    @foreach ($thumb as $img)
                                        <div class="col-md-3 p-1">
                                            <img width="100%" onclick="changeImage('{{ asset($img->image) }}')"
                                                src="{{ asset($img->image) }}" alt="">
                                        </div>
                                    @endforeach
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- @if (session()->has('success'))
                <div id="setout" class="text-white alert bg-success position-fixed" style="right: 8px; z-index: 9999;">
                    {{ session()->get('success') }}
                </div>
            @endif --}}
            <div class="col-md-6">
                <div class="osahan-cart-item rounded rounded shadow-sm overflow-hidden bg-white">
                    <div class="d-flex osahan-cart-item-profile bg-white p-3">
                        <div class="d-flex col-md-12 flex-column p-0">
                            <div class="header-sub-title">
                                <nav class="breadcrumb breadcrumb-dash m-0">
                                    <a href="#" class="breadcrumb-item"><i
                                            class="anticon anticon-home m-r-5"></i>Home</a>
                                    <a class="breadcrumb-item" href="#">Products</a>
                                    <span class="breadcrumb-item">Product Detail</span>
                                </nav>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white">
                        <div class="gold-members d-flex align-items-center justify-content-between px-3">
                            <h1 class="font-weight-bolder m-0">{{ $product->name }}</h1>
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
                        @if($product->price !== $product->price_sales)
                            <h3 class="text-primary font-weight-bold pt-3">
                                <del>{{ number_format($product->price, 0, ',', ',') }}₫</del>
                                - {{ number_format($product->price_sales, 0, ',', ',') }}₫
                            </h3>
                        @else
                            <h3 class="text-primary font-weight-bold pt-3">
                                {{ number_format($product->price_sales, 0, ',', ',') }}₫
                            </h3>
                        @endif
                        <h6 class="text-dark font-weight-light">Loại: <a
                                href="{{ route('list-products', $product->menu->id) }}">{{ $product->menu->name }}</a>
                        </h6>
                        <p class="text-break">{{ $product->content }}</p>
                    </div>
                    <div class="p-3">
                        {{-- action="{{ url('carts') }}" method="POST" --}}
                        <form>
                            @csrf
                            <input type="text" hidden name="product_id" value="{{ $product->id }}">
                            <input type="text" hidden name="user_id" value="{{ Auth::user() ? Auth::user()->id : '' }}">
                            <input type="text" hidden name="date" value="{{ date('Y-m-d') }}">
                            <input type="button" onclick="tru()" value="-" class="btn btn-outline-primary">
                            <input name="quantity" style="width: 44px;" class="input-qty btn btn-default" id="quantity"
                                min="1" type="text" value="1">
                            <input type="button" onclick="cong()" value="+" class="btn btn-outline-primary">
                            <button type="button" class="btn btn-success" id="addtocart">Đặt hàng<i
                                    class="feather-arrow-right"></i></button>
                        </form>
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
                            </div>
                            @foreach ($comment as $cmt)
                                <div
                                    class="product-item px-3 py-2 my-1 d-flex justify-content-between ele_{{ $cmt->id }}">
                                    <div class="col-md-12 d-flex">
                                        <div class="avatar setCt mr-2">
                                            <img src="{{ $cmt->user->avatar }}"
                                                style="width: 60px; height: 60px; object-fit: cover;" class="rounded-circle"
                                                alt="">
                                        </div>
                                        <div class="setCt d-flex flex-column justify-content-center" style="flex: none;">
                                            <h6 class="mb-0">{{ $cmt->user->name }}</h6>
                                            <p class="text-black-50">{{ $cmt->created_at }}</p>
                                            <div class="value_comment_{{ $cmt->id }}">
                                                <input type="hidden" value="{{ $cmt->content }}"
                                                    class="form-control edit-content-{{ $cmt->id }}"
                                                    name="edit_content">
                                                <p id="id{{ $cmt->id }}" data-id="{{ $cmt->id }}"
                                                    class="text-black-100 font-weight-bold text_content_{{ $cmt->id }}">
                                                    {{ $cmt->content }}
                                                </p>
                                            </div>

                                            <div style="display:flex; cursor: pointer">
                                                @foreach ($reacts as $react)
                                                    <i class="{{ $react->icon }} mr-2 icon-comment"
                                                        data-id="{{ $cmt->id }}" id="icon_cm_{{ $cmt->id }}">
                                                        <input type="hidden" name="reaction_id"
                                                            value="{{ $react->id }}">
                                                        <span
                                                            class="quan_like_{{ $cmt->id }}">{{ $cmt->reactions->count() }}</span>
                                                    </i>
                                                @endforeach
                                                <i class="fas fa-reply mr-2"></i>
                                                @if (Auth::id() === $cmt->user_id)
                                                    <p style="cursor: pointer; font-size: 10px">
                                                        <span id="edcm_{{ $cmt->id }} " class="edit_comment"
                                                            data-id="{{ $cmt->id }}" style="color: blue">Edit</span>
                                                        |
                                                        <span id="dlcm_{{ $cmt->id }} " class="dele_comment"
                                                            data-id="{{ $cmt->id }}"
                                                            style="color: red">Delete</span>
                                                    </p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <div class="info-comment"></div>
                            <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
                            <form action="" method="POST">
                                @csrf
                                @if (!Auth::user())
                                    <p>Vui lòng đăng nhập để bình luận!</p>
                                @else
                                    <div class="form-comment">
                                        <img src="{{ Auth::user()->avatar }}" style="" class="mr-2"
                                            alt="" srcset="">
                                        <textarea type="text" name="content" class="form-control mr-2" placeholder="Viết bình luận"></textarea>
                                        <button type="button" class="btn btn-primary submit_comment">Bình luận</button>
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <input type="hidden" name="user_id"
                                            value="{{ !empty(Auth::id()) ? Auth::id() : '' }}">
                                    </div>
                                @endif
                            </form>
                        </div>
                        <script type="text/javascript" src="{{ asset('js/handleGeneral/comment/handle.js') }}"></script>
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
            @foreach ($products as $product)
                <div class="col-md-3 pb-3">
                    <div class="list-card bg-white h-100 rounded overflow-hidden position-relative shadow-sm">
                        <div class="list-card-image">
                            <div class="star position-absolute"><span class="badge badge-success"><i
                                        class="feather-star"></i> 3.1 (300+)</span></div>
                            <div class="favourite-heart text-danger position-absolute"><a href="#"><i
                                        class="feather-heart"></i></a></div>
                            <div class="member-plan position-absolute"><span class="badge badge-dark">Promoted</span>
                            </div>
                            <a href="{{ route('product-detail', $product->id) }}">
                                <img alt="#" src="{{ asset($product->thumb) }}" class="img-fluid item-img w-100">
                            </a>
                        </div>
                        <div class="p-3 position-relative">
                            <div class="list-card-body">
                                <h6 class="mb-1"><a href="{{ route('product-detail', $product->id) }}"
                                        class="text-black">{{ $product->name }}</a></h6>
                                <p class="text-gray mb-1 small">• {{ $product->menu->name }}</p>
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
