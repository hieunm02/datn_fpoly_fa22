@extends('layouts.client.client-master')
@section('title-page', 'Favorites')
@section('content')
    <div class="d-none">
        <div class="bg-primary border-bottom p-3 d-flex align-items-center">
            <h4 class="font-weight-bold m-0 text-white flex-fill">Favorites</h4>
            <a class="toggle1 text-white" id="clickMenus"><span> <i class="feather-align-justify fs-30"></i></span></a>
        </div>
    </div>
    <!-- Most popular -->
    <div class="container most_popular py-5">
        <h2 class="font-weight-bold mb-3">Favorites</h2>
        <div class="row">
            @foreach ($products as $product)
                <div class="col-md-4 mb-3">
                    <div class="list-card bg-white h-100 rounded overflow-hidden position-relative shadow-sm grid-card">
                        <div class="list-card-image">
                            <div class="star position-absolute"><span class="badge badge-success"><i
                                        class="feather-star"></i>
                                    3.1 (300+)</span></div>
                            <div class="favourite-heart text-danger position-absolute"><a href="#"><i
                                        class="feather-heart"></i></a></div>
                            <div class="member-plan position-absolute"><span class="badge badge-dark">
                                    <i class="bi bi-star"></i></span></div>
                            <a href="{{ route('product-detail', $product->id) }}">
                                <img alt="#" src="{{ asset($product->thumb) }}" class="img-fluid item-img w-100">
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
                                            class="feather-clock"></i>
                                        15–25 min</span> <span class="float-right text-black-50">{{ $product->name }}
                                        VND</span></p>
                            </div>
                            <div class="list-card-badge">
                                <span class="badge badge-danger">OFFER</span> <small>65% OSAHAN50</small>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div></div>
    </div>
    <!-- Footer -->
@endsection
