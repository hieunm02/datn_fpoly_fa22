@extends('layouts.admin.admin-master')
@section('title', $title)
@section('content')
    <div class="main-content">
        <div class="page-header">
            <h2 class="header-title">{{ $title }}</h2>
            <x:notify-messages />
        </div>
        @if(count($staffs))
        <div class="card">
            <div class="card-body">
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
                            <div class="col-lg-4 text-right">
                                <a href="{{ route('staffs.create') }}" class="btn btn-primary">
                                    <i class="anticon anticon-plus-circle m-r-5"></i>
                                    <span>Add</span>
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
                                        <th>Tên nhân viên</th>
                                        <th>Email</th>
                                        <th>Ảnh đại diện</th>
                                        <th>Trạng thái</th>
                                        <th colspan="2">Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($staffs as $item)
                                        <tr id="id{{ $item->id }}">
                                            <td>
                                                <div class="checkbox">
                                                    <input id="check-item-1" type="checkbox">
                                                    <label for="check-item-1" class="m-b-0"></label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <h6 class="m-b-0">{{ $item->id }}</h6>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <h6 class="m-b-0">{{ $item->name }}</h6>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <h6 class="m-b-0">{{ $item->email }}</h6>
                                                </div>
                                            </td>
                                            <td>
                                                <img src="{{ asset($item->avatar) }}" alt="" width="100">
                                            </td>
                                            <td>{!! \App\Helpers\Helper::active($item->active) !!}</td>

                                            <td>
                                            @role('manager')
                                            <td class="text-right">
                                                <a href="{{ route('staffs.edit', $item->id) }}">
                                                    <button class="btn btn-icon btn-hover btn-sm btn-rounded pull-right">
                                                        <i class="anticon anticon-edit"></i>
                                                    </button>
                                                </a>
                                                <button class="btn btn-icon btn-hover btn-sm btn-rounded"
                                                    onclick="deleteAjax('staffs',<?php echo $item->id; ?>)">
                                                    <i class="anticon anticon-delete"></i>
                                                </button>
                                            </td>
                                            @endrole
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @else
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-10 text-center">
                            <center class="text-uppercase text-center text-20xl font-size-20 opacity-7 font-weight-border">
                                <th>
                                    chưa có nhân viên nào
                                </th>
                            </center>
                        </div>
                        <div class="col-lg-2 text-right">
                            <a href="{{ route('staffs.create') }}" class="btn btn-primary">
                                <i class="anticon anticon-plus-circle m-r-5"></i>
                                <span>Add</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
    <script>
        setTimeout(() => {
            document.getElementById('setout').classList.add('d-none');
        }, 5000);

        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });
    </script>
@endsection
