@extends('layouts.admin.admin-master')
@section('title', 'Giá sản phẩm')
@section('content')
<div class="main-content">
    <div class="page-header">
        <h2 class="header-title">Danh sách giá</h2>
        <x:notify-messages />
    </div>
    <div class="card">
        <div class="card-body">
            <div class="row m-b-30">
                <div class="col-lg-8">
                    <div class="d-md-flex">
                    </div>
                </div>
                <div class="col-lg-4 text-right">
                    <a href="{{ route('prices.create') }}">
                        <button class="btn btn-primary">
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
                                    <input id="checkAll" type="checkbox">
                                    <label for="checkAll" class="m-b-0"></label>
                                </div>
                            </th>
                            <th>ID</th>
                            <th>Giá gốc</th>
                            <th>Giá giảm</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($prices as $price)
                        <tr id="id{{$price->id}}">
                            <td>
                                <div class="checkbox">
                                    <input id="check-item-1" type="checkbox">
                                    <label for="check-item-1" class="m-b-0"></label>
                                </div>
                            </td>
                            <td>#{{ $price->id }}</td>
                            <td>${{ $price->original }}</td>
                            <td>${{ $price->sale }}</td>
                            <td class="text-right">
                                <a href="{{ route('prices.edit', $price->id) }}">
                                    <button class="btn btn-icon btn-hover btn-sm btn-rounded pull-right">
                                        <i class="anticon anticon-edit"></i>
                                    </button>
                                </a>
                                <button class="btn btn-icon btn-hover btn-sm btn-rounded"  onclick="deleteAjax('prices',<?php echo $price->id; ?>)">
                                    <i class="anticon anticon-delete"></i>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection