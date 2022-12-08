@extends('layouts.admin.admin-master')
@section('title', $title)
@section('content')

    <div class="main-content">
        <div class="page-header">
            <h2 class="header-title">{{ $title }}</h2>
        </div>
        @if (session()->has('success'))
            <div class="text-white alert bg-success">
                {{ session()->get('success') }}
            </div>
        @endif

        <div class="card">
            <div class="card-body">
                <div class="row m-b-30">
                    <div class="col-lg-8">
                        <div class="d-md-flex">
                            <div class="m-b-10 m-r-15">
                                <select id="status_id" class="custom-select" onchange="selectOrderByStatus()"
                                    style="min-width: 180px;">
                                    <option selected>Trạng thái</option>
                                    @foreach ($status as $stt)
                                        <option class="status" value="{{ $stt->id }}">
                                            {{ $stt->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="m-b-10">
                                <input type="text" name="text_search" class="form-control" placeholder="Tìm kiếm..."
                                    style="min-width: 180px;">
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
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->note }}</td>
                                    <td>
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-primary" data-toggle="modal"
                                            data-target="#exampleModalScrollable-{{ $item->id }}">
                                            Chi tiết
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModalScrollable-{{ $item->id }}"
                                            tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-scrollable" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalScrollableTitle">Modal title
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <table class="table table-bordered">
                                                            <thead>
                                                                <td>ID</td>
                                                                <td>Tên sản phẩm</td>
                                                                <td>Số lượng</td>
                                                                <td>Giá</td>
                                                                <td>Tổng</td>
                                                                <td>Ngày đặt</td>
                                                            </thead>
                                                            <tbody>
                                                                {{-- <tr>
                                                                    <td>{{ $item->id }}</td>
                                                                    <td>{{ $item->nameProduct }}</td>
                                                                    <td>{{ $item->quantity }}</td>
                                                                    <td>{{ $item->price }}</td>
                                                                    <td>{{ $item->total }}</td>
                                                                    <td>{{ $item->date_order }}</td>
                                                                </tr> --}}
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <select name="status" id="status" class="custom-select"
                                            style="min-width: 180px;" onchange="changeStatusAjax({{ $item->id }})">
                                            @foreach ($status as $stt)
                                                <option class="status-{{ $item->id }}" value="{{ $stt->id }}"
                                                    {{ $stt->id == $item->status_id ? ' selected' : '' }}>
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

<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    <script type="text/javascript" src="{{ asset('/js/handleGeneral/order/filter.js') }}"></script>
@endsection
