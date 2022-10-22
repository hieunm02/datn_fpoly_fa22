@extends('layouts.admin.admin-master')
@section('title', $title)
@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>;
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
                <span class="alert_success">{{ session('success') }}</span>
            </div>
        @endif
        <div class="card">
            <div class="card-body">
                <div class="row m-b-30">
                    <div class="col-lg-7">
                        <div class="d-md-flex">
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
                                <th>Product</th>
                                <th>UserName</th>
                                <th>Content</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $index => $order)
                                <tr>
                                    <td>
                                        <div class="checkbox">
                                            <input id="check-item-{{ $index + 1 }}" class="check-item"
                                                onclick="checkBox({{ $order->id }})" value="{{ $order->id }}"
                                                name="{{ $order->id }}" type="checkbox">
                                            <label for="check-item-{{ $index + 1 }}" class="m-b-0"></label>
                                        </div>
                                    </td>
                                    <td>
                                        #{{ $order->id }}
                                    </td>

                                    <td>{{ $order->product->name }}</td>
                                    <td>{{ $order->user->name }}</td>
                                    <td>{{ $order->content }}</td>
                                    <td>
                                        <form method="POST" class="inline-block"
                                            onsubmit="return confirm('Xác nhận xóa sản phẩm.')" action="">
                                            @csrf
                                            @method('PUT')
                                            <div class="d-flex align-items-center" style="cursor: pointer">
                                                @if ($order->active === 0)
                                                    <div id="icon-active{{ $order->id }}"
                                                        class="badge badge-success badge-dot m-r-10"></div>
                                                    <input type="hidden" id="is-active{{ $order->id }}"
                                                        value="{{ $order->active }}">
                                                    <div class="btn-status btn-active{{ $order->id }}"
                                                        data-id="{{ $order->id }}">Actived</div>
                                                @else
                                                    <div id="icon-active{{ $order->id }}"
                                                        class="badge badge-danger badge-dot m-r-10"></div>
                                                    <input type="hidden" id="is-active{{ $order->id }}"
                                                        value="{{ $order->active }}">
                                                    <div class="btn-status btn-active{{ $order->id }}"
                                                        data-id="{{ $order->id }}">Deactive
                                                    </div>
                                                @endif
                                            </div>
                                        </form>
                                    </td>
                                    <td class="text-right">
                                        <form method="POST" class="inline-block"
                                            onsubmit="return confirm('Xác nhận xóa sản phẩm.')"
                                            action="{{ route('orders.destroy', $order->id) }}">
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
                    <div style="display: flex; justify-content: center">
                        {{-- {{ $orders->links() }} --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="{{ asset('js/handleGeneral/changeStatusorder.js') }}"></script>
@endsection
