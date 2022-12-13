@extends('layouts.client.client-master')
@section('title-page', 'Home')
@section('content')
    <div class="bg-primary p-3 d-none">
        <div class="text-white">
            <div class="title d-flex align-items-center">
                <a class="toggle1" id="clickMenus">
                    <span> <i class="feather-align-justify fs-30"></i></span>
                </a>
                <h4 class="font-weight-bold m-0 pl-2">Browse</h4>
                <a class="text-white font-weight-bold ml-auto" data-toggle="modal" data-target="#exampleModal"
                    href="#">Filter</a>
            </div>
        </div>
        <div class="input-group mt-3 rounded shadow-sm overflow-hidden">
            <div class="input-group-prepend">
                <button class="border-0 btn btn-outline-secondary text-dark bg-white btn-block"><i
                        class="feather-search"></i></button>
            </div>
            <input type="text" class="shadow-none border-0 form-control" placeholder="Search for restaurants or dishes">
        </div>
    </div>
    <!-- Filters -->
    <div class="container">
        @if (session()->has('error'))
            <div id="setout" class="text-white alert bg-danger position-fixed" style="margin-top: 4px; right: 4px; z-index: 9999;">
                {{ session()->get('error') }}
            </div>
        @endif
        <div class="cat-slider">
            @foreach ($menus as $menu)
                <div class="cat-item px-1 py-3">
                    <a class="bg-white rounded d-block p-2 text-center shadow-sm"
                        href="{{ route('list-products', $menu->id) }}">
                        <img alt="#" src="{{ $menu->thumb }}" class="img-fluid mb-2">
                        <p class="m-0 small">{{ $menu->name }}</p>
                    </a>
                </div>
            @endforeach

        </div>
    </div>
    <!-- offer sectio slider -->
    <div class="bg-white">
        <div class="container">
            <div class="offer-slider">
                @foreach ($slides ?? '' as $slide)
                    @if ($slide->product)
                        <div class="cat-item px-1 py-3">
                            <a class="d-block text-center shadow-sm"
                                href="{{ route('product-detail', $slide->product->id) }}">
                                <img alt="#" src="{{ $slide->thumb }}" class="img-fluid rounded">
                            </a>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
    <div class="container">
        <!-- slider -->
        <div class="trending-slider">
            @foreach ($products as $products)
                <div class="osahan-slider-item">
                    <div class="list-card bg-white h-100 rounded overflow-hidden position-relative shadow-sm">
                        <div class="list-card-image" style="box-sizing: border-box; overflow: hidden;height: 192px">
                            @if ($products->price_sales != null)
                                <div class="favourite-heart text-white badge-danger p-1 rounded position-absolute">
                                    <span>Sale</span></div>
                            @endif
                            <a href="{{ route('product-detail', $products->id) }}">
                                <img alt="#" src="{{ asset($products->thumb) }}" class="img-fluid item-img w-100">
                            </a>
                        </div>
                        <div class="p-3 position-relative">
                            <div class="list-card-body">
                                <h6 class="mb-1"><a href="{{ route('product-detail', $products->id) }}"
                                        class="text-black">{{ $products->name }}
                                    </a>
                                </h6>
                                <p class="text-gray mb-3">{{ $products->menu->name }}</p>
                                <p class="text-gray mb-3 time"><span
                                        class="bg-light text-dark rounded-sm pl-2 pb-1 pt-1 pr-2"><i
                                            class="feather-clock"></i> 10–15 min</span>
                                    <span class="float-right d-block text-danger">
                                        {{ number_format($products->price_sales != null ? $products->price_sales : $products->price, 0, ',', '.') }}
                                        VND</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
        <!-- Most popular -->
        <div class="py-3 title text-center align-items-center">
            <h5 class="m-0"><a href="{{ url('/list-products') }}">Các Sản Phẩm Khác</a></h5>
        </div>
        <!-- Most popular -->
        <div class="most_popular">
            <div class="row">
                @foreach ($productBtm as $product)
                    <div class="col-md-3 pb-3">
                        <div class="list-card bg-white h-100 rounded overflow-hidden position-relative shadow-sm">
                            <div class="list-card-image" style="box-sizing: border-box; overflow: hidden;height: 141px">
                                @if ($product->price_sales != null)
                                    <div class="star position-absolute"><span class="badge badge-danger">Sale</span>
                                    </div>
                                @endif
                                <div class="favourite-heart text-danger position-absolute"><a href="#"></a></div>
                                <a href="{{ route('product-detail', $product->id) }}">
                                    <img alt="#" src="{{ asset($product->thumb) }}"
                                        class="img-fluid item-img w-100">
                                </a>
                            </div>
                            <div class="p-3 position-relative">
                                <div class="list-card-body">
                                    <h6 class="mb-1"><a href="{{ route('product-detail', $product->id) }}"
                                            class="text-black">{{ $product->name }}
                                        </a>
                                    </h6>
                                    <p class="text-gray mb-3">{{ $product->menu->name }}</p>
                                    <p class="text-gray mb-3 time"><span
                                            class="bg-light text-dark rounded-sm pl-2 pb-1 pt-1 pr-2"><i
                                                class="feather-clock"></i> 10–15 min</span>
                                        <span class="float-right d-block text-danger">
                                            {{ number_format($product->price_sales != null ? $product->price_sales : $product->price, 0, ',', '.') }}
                                            VND</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
        <!-- Most sales -->
        @if ($slides->count())
            <!-- Most sales -->
            <div class="most_sale">
                <div class="row mb-3">
                    @foreach ($slides ?? '' as $slide)
                        <div class="col-md-4 mb-3">
                            <div
                                class="d-flex align-items-center list-card bg-white h-100 rounded overflow-hidden position-relative shadow-sm">
                                @if ($slide->product)
                                    <div class="list-card-image text-center">
                                        <div class="favourite-heart text-danger position-absolute"><a href="#"></a>
                                        </div>
                                        <a href="{{ route('product-detail', $slide->product->id) }}">
                                            <img alt="#" src="{{ asset($slide->thumb) }}"
                                                class="img-fluid item-img w-100">
                                        </a>
                                    </div>
                                    <div class="p-3 position-relative">
                                        <div class="list-card-body">
                                            <h6 class="mb-1"><a href="{{ route('product-detail', $slide->product->id) }}" class="text-black"> {{ $slide->name }}
                                                </a>
                                            </h6>
                                            <p class="text-gray mb-3">{{ $slide->product->name }}</p>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
@endsection
