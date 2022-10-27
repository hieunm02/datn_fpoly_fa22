@extends('layouts.admin.admin-master')
@section('title', $title)
@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>;
<div class="main-content">
    <div class="page-header">
        <h2 class="header-title">Bills List</h2>
        <div class="header-sub-title">
            <nav class="breadcrumb breadcrumb-dash">
                <a href="#" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>Home</a>
                <a class="breadcrumb-item" href="#">Apps</a>
                <a class="breadcrumb-item" href="#">E-commerce</a>
                <span class="breadcrumb-item active">Bills List</span>
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
                            <th>Email</th>
                            <th>Code</th>
                            <th>Name</th>
                            <th>Total</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bills as $index => $bill)
                        <tr id="id{{$bill->id}}">
                            <td>
                                <div class="checkbox">
                                    <input id="check-item-1" type="checkbox">
                                    <label for="check-item-1" class="m-b-0"></label>
                                </div>
                            </td>
                            <td>{{$bill->id}}</td>
                            <td>{{$bill->email}}</td>
                            <td>{{$bill->code}}</td>
                            <td>{{$bill->name}}</td>
                            <td>{{$bill->total}}</td>
                            <td>
                                <button data-toggle="modal" data-target=".bd-example-modal-xl" onclick="viewBillDetail(<?php echo $bill->id ?>)" class="btn btn-icon btn-hover btn-sm btn-rounded">
                                    <i class="anticon anticon-eye"></i>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="modal fade bd-example-modal-xl">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title h4">Hóa đơn chi tiết</h5>
                                <button type="button" class="close" data-dismiss="modal">
                                    <i class="anticon anticon-close"></i>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="table-responsive">
                                    <table class="table table-hover e-commerce-table">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Email</th>
                                                <th>Code</th>
                                                <th>Name</th>
                                                <th>Phone</th>
                                                <th>Address</th>
                                                <th>Shipper</th>
                                                <th>Voucher</th>
                                                <th>Note</th>
                                            </tr>
                                        </thead>
                                        <tbody id="table-bill-detail">

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div style="display: flex; justify-content: center">
    {{ $bills->links() }}
</div>
</div>
</div>
</div>
</div>
@endsection