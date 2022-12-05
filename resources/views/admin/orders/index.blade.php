@extends('layouts.admin.admin-master')
@section('title', $title)
@section('content')
<link rel="stylesheet" href="{{ asset('/css/paginate.css') }}">
<div class="main-content">
    <div class="page-header">
        <h2 class="header-title">{{ $title }}</h2>
    </div>
    @if (session()->has('success'))
    <input type="hidden" name="user_id" id="user_id" value="{{Auth::id()}}">
    <div class="text-white alert bg-success">
        {{ session()->get('success') }}
    </div>
    @endif
    @if ($orders->count())
    <div class="card">
        <div class="card-body">
            <div class="card">
                <div class="card-body">
                    <div class="row m-b-30">
                        <div class="col-lg-8">
                            <div class="d-md-flex">
                                <div class="m-b-10 mr-3">
                                    <select class="custom-select select-active" style="min-width: 180px;">
                                        <option selected value="">Trạng thái</option>
                                        @foreach ($status as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="m-b-10">
                                    <input type="text" name="text_search" class="form-control" placeholder="Tìm kiếm..." style="width: 180px;">
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
                                            <input id="checkAll" type="checkbox">
                                            <label for="checkAll" class="m-b-0"></label>
                                        </div>
                                    </th>
                                    <th>ID</th>
                                    <th>Mã đơn hàng</th>
                                    <th>Tên người nhận</th>
                                    <th>Số điện thoại</th>
                                    <th>Địa chỉ</th>
                                    <th>Ngày đặt</th>
                                    <th>Người đặt</th>
                                    <th>Ghi chú</th>
                                    <th>Trạng thái</th>
                                </tr>
                            </thead>
                            <tbody id="orders_list">
                                @foreach ($orders as $item)
                                <tr id="id{{ $item->id }}">
                                    <td>
                                        <div class="checkbox">
                                            <input id="check-item-{{ $item->id }}" type="checkbox">
                                            <label for="check-item-{{ $item->id }}" class="m-b-0"></label>
                                        </div>
                                    </td>
                                    <td>#{{ $item->id }}</td>
                                    <td>{{ $item->code }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->phone }}</td>
                                    <td>{{ $item->address }}</td>
                                    <td>{{ $item->created_at }}</td>
                                    <td>{{ $item->user_id }}</td>
                                    <td>{{ $item->note }}</td>
                                    <td>
                                        <input type="hidden" class="array_status" value="{{ $status }}">
                                        <select name="status" id="status" class="custom-select custom_status" style="min-width: 180px;" onchange="changeStatusAjax({{ $item->id }})">
                                            @foreach ($status as $stt)
                                            <option class="status-{{ $item->id }}" value="{{ $stt->id }}" {{ $stt->id == $item->status_id ? ' selected' : '' }}>
                                                {{ $stt->name }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="text-right pagination">
                        {{ $orders->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <<<<<<< HEAD <div class="table-responsive">
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
                    <th>Mã đơn hàng</th>
                    <th>Tên người nhận</th>
                    <th>Số điện thoại</th>
                    <th>Địa chỉ</th>
                    <th>Ngày đặt</th>
                    <th>Người đặt</th>
                    <th>Ghi chú</th>
                    <th>Trạng thái</th>
                </tr>
            </thead>
            <tbody id="tbodyOrder" class="order_list">
                @foreach ($orders as $item)
                <tr id="id{{ $item->id }}">
                    <td>
                        <div class="checkbox">
                            <input id="check-item-{{ $item->id }}" type="checkbox">
                            <label for="check-item-{{ $item->id }}" class="m-b-0"></label>
                        </div>
                    </td>
                    <td>#{{ $item->id }}</td>
                    <td>{{ $item->code }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->phone }}</td>
                    <td>{{ $item->address }}</td>
                    <td>{{ $item->created_at }}</td>
                    <td>{{ $item->user_id }}</td>
                    <td>{{ $item->note }}</td>
                    <td>
                        <select name="status" id="status" class="custom-select change-status{{ $item->id }}" data-id="{{ $item->id }}" style="min-width: 180px;">
                            @foreach ($status as $stt)
                            <option class="status-{{ $item->id }}" value="{{ $stt->id }}" {{ $stt->id == $item->status_id ? ' selected' : '' }}>
                                {{ $stt->name }}
                            </option>
                            @endforeach
                        </select>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{-- <div class="text-right">
                        {{ $products->links() }}
</div> --}}
</div>
=======
@else
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-12 text-center">
                <center class="text-uppercase text-center text-20xl font-size-20 opacity-7 font-weight-border">
                    <th>
                        chưa có đơn hàng nào
                    </th>
                </center>
            </div>
        </div>
    </div>
</div>
@endif
>>>>>>> dev
</div>
</div>
</div>
</div>
@else
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-12 text-center">
                <center class="text-uppercase text-center text-20xl font-size-20 opacity-7 font-weight-border">
                    <th>
                        chưa có đơn hàng nào
                    </th>
                </center>
            </div>
        </div>
    </div>
</div>
@endif
</div>
<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    });
</script>
<script type="text/javascript" src="{{ asset('/js/handleGeneral/order/filter.js') }}"></script>
@endsection