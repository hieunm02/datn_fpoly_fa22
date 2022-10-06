@extends('layouts.admin.admin-master')
@section('title', $title)
@section('content')
    <div class="main-content">
        <div class="page-header">
            <h2 class="header-title">Orders List</h2>
            <div class="header-sub-title">
                <nav class="breadcrumb breadcrumb-dash">
                    <a href="#" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>Home</a>
                    <a class="breadcrumb-item" href="#">Apps</a>
                    <a class="breadcrumb-item" href="#">E-commerce</a>
                    <span class="breadcrumb-item active">Orders List</span>
                </nav>
            </div>
        </div>
        @if (session('success'))
            <div class="alert alert-success">
                <i class="fa fa-check"></i>
                {{ session('success') }}
            </div>
        @endif
        <div class="card">
            <div class="card-body">
                <div class="row m-b-30">
                    <div class="col-lg-8">
                        <div class="d-md-flex">
                            <div class="m-b-10 m-r-15">
                                <select class="custom-select" style="min-width: 180px;">
                                    <option selected>Catergory</option>
                                    <option value="all">All</option>
                                    <option value="homeDeco">Home Decoration</option>
                                    <option value="eletronic">Eletronic</option>
                                    <option value="jewellery">Jewellery</option>
                                </select>
                            </div>
                            <div class="m-b-10">
                                <select class="custom-select" style="min-width: 180px;">
                                    <option selected>Status</option>
                                    <option value="all">All</option>
                                    <option value="inStock">In Stock </option>
                                    <option value="outOfStock">Out of Stock</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <a class="col-lg-4 text-right" href="{{ route('products.create') }}">
                        <button class="btn btn-primary" type="button">
                            <i class="anticon anticon-plus-circle m-r-5"></i>
                            <span>Add Product</span>
                        </button>
                    </a>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover e-commerce-table">
                        <thead>
                            <tr>
                                <th>
                                    <div class="checkbox">
                                        <input id="checkAll" type="checkbox">
                                        <label for="checkAll" class="m-b-0"></label>
                                    </div>
                                </th>
                                <th>ID</th>
                                <th>Product</th>
                                <th>Category</th>
                                <th>Price</th>
                                <th>Stock Left</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $index => $product)
                                <tr>
                                    <td>
                                        <div class="checkbox">
                                            <input id="check-item-{{ $index + 1 }}" name="{{ $product->id }}"
                                                type="checkbox">
                                            <label for="check-item-{{ $index + 1 }}" class="m-b-0"></label>
                                        </div>
                                    </td>
                                    <td>
                                        #{{ $product->id }}
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img class="img-fluid rounded" src="" style="max-width: 60px"
                                                alt="">
                                            <h6 class="m-b-0 m-l-10">{{ $product->name }}</h6>
                                        </div>
                                    </td>
                                    <td>{{ $product->menu->name }}</td>
                                    <td>${{ $product->price->original }}</td>
                                    <td>{{ $product->quantity }}</td>
                                    <td><img src="{{asset($product->thumb)}}"></td>
                                    <td>
                                        <form method="POST" class="inline-block"
                                            onsubmit="return confirm('Xác nhận xóa sản phẩm.')"
                                            >
                                            @csrf
                                            @method('PUT')
                                            <div class="d-flex align-items-center" style="cursor: pointer">
                                                @if ($product->active === 1)
                                                    <div class="badge badge-success badge-dot m-r-10"></div>
                                                    <div>In Stock</div>
                                                @else
                                                    <div class="badge badge-danger badge-dot m-r-10"></div>
                                                    <div>Out Of Stock</div>
                                                @endif
                                            </div>
                                        </form>

                                    </td>
                                    <td class="text-right">    
                                        <a href="{{ route('products.edit', $product->id) }}">
                                            <button class="btn btn-icon btn-hover btn-sm btn-rounded pull-right">
                                                <i class="anticon anticon-edit"></i>
                                            </button>
                                        </a>
                                        <form method="POST" class="inline-block"
                                            onsubmit="return confirm('Xác nhận xóa sản phẩm.')"
                                            action="{{ route('products.destroy', $product->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-icon btn-hover btn-sm btn-rounded">
                                                <i class="anticon anticon-delete"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="text-right">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
