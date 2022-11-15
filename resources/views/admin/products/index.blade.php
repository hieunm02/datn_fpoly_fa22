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
        <x:notify-messages />
        <div class="card">
            <div class="card-body">
                <div class="row m-b-30">
                    <div class="col-lg-7">
                        <div class="d-md-flex">
                            <div class="m-b-10 m-r-15">
                                <select class="custom-select select-massaction" style="min-width: 180px;">
                                    <option selected>MassAction</option>
                                    <option id="check-select" value="select-page">Select Page</option>
                                    <option value="select-all">Select All</option>
                                    <option value="un-select">UnSelected</option>
                                </select>
                            </div>
                            <div class="m-b-10 mr-3">
                                <select class="custom-select" style="min-width: 180px;">
                                    <option selected>Status</option>
                                    <option value="all">All</option>
                                    <option value="inStock">In Stock </option>
                                    <option value="outOfStock">Out of Stock</option>
                                </select>
                            </div>
                            <div class="m-b-10">
                                <input type="text" name="text_search" class="form-control" placeholder="Tìm kiếm..."
                                    style="min-width: 180px;">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5  text-right">
                        {{-- <a class="delete-action">
                            <button class="btn btn-danger" type="button">
                                <i class="anticon anticon-plus-circle m-r-5"></i>
                                <span>Delete</span>
                            </button>
                        </a> --}}
                        <a class="" href="{{ route('products.create') }}">
                            <button class="btn btn-primary" type="button">
                                <i class="anticon anticon-plus-circle m-r-5"></i>
                                <span>Thêm mới</span>
                            </button>
                        </a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover e-commerce-table">
                        <thead>
                            <tr>
                                <th>
                                    <div class="checkbox">
                                        <input id="checkAll" type="checkbox" disabled>
                                        <label for="checkAll" class="m-b-0"></label>
                                    </div>
                                </th>
                                <th>ID</th>
                                <th>Tên sản phẩm</th>
                                <th>Tên danh mục</th>
                                <th>Giá sản phẩm</th>
                                <th>Số lượng</th>
                                <th>Trạng thái</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody id="products_list">
                            @foreach ($products as $index => $product)
                                <tr>
                                    <td>
                                        <div class="checkbox">
                                            <input id="check-item-{{ $index + 1 }}" class="check-item"
                                                onclick="checkBox({{ $product->id }})" value="{{ $product->id }}"
                                                name="{{ $product->id }}" type="checkbox">
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
                                    <td>${{ $product->price }}</td>
                                    <td>{{ $product->quantity }}</td>
                                    <td>

                                        <div class="d-flex align-items-center" style="cursor: pointer">
                                            @if ($product->active === 0)
                                                <div class="m-r-10"></div>
                                                <input type="hidden" id="is-active{{ $product->id }}"
                                                    value="{{ $product->active }}">
                                                <div class="btn-status" data-id="{{ $product->id }}">
                                                    <i style="color: green"
                                                        class="bi bi-lock-fill btn-active{{ $product->id }}"
                                                        id="icon-active{{ $product->id }}"></i>
                                                </div>
                                            @else
                                                <div class="m-r-10"></div>
                                                <input type="hidden" id="is-active{{ $product->id }}"
                                                    value="{{ $product->active }}">
                                                <div class="btn-status" data-id="{{ $product->id }}">
                                                    <i style="color: red"
                                                        class="bi bi-unlock-fill btn-active{{ $product->id }}"
                                                        id="icon-active{{ $product->id }}"></i>
                                                </div>
                                            @endif
                                        </div>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('js/handleGeneral/product/checkboxProduct.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/handleGeneral/product/filter.js') }}"></script>
@endsection
