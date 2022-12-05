@extends('layouts.admin.admin-master')
@section('title', $title)
@section('content')
    <link rel="stylesheet" href="{{ asset('/css/paginate.css') }}">
    <div class="main-content">
        <div class="page-header">
            <h2 class="header-title">{{ $title }}</h2>
        </div>
        <x:notify-messages />
        @if ($vouchers->count())
            <div class="card">
                <div class="card-body">
                    <div class="row m-b-30">
                        <div class="col-lg-8">
                            <div class="d-md-flex">
                                <div class="m-b-10 mr-3">
                                    <select class="custom-select select-active" style="min-width: 180px;">
                                        <option selected value="">Trạng thái</option>
                                        <option value="1">Mở</option>
                                        <option value="0">Khóa</option>
                                    </select>
                                </div>
                                <div class="m-b-10">
                                    <input type="text" name="text_search" class="form-control" placeholder="Tìm kiếm..."
                                        style="width: 180px;">
                                </div>
                            </div>
                        </div>
                        <a class="col-lg-4 text-right" href="{{ route('vouchers.create') }}">
                            <button class="btn btn-primary" type="button">
                                <i class="anticon anticon-plus-circle m-r-5"></i>
                                <span>Add voucher</span>
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
                                    <th>Mã Code</th>
                                    <th>Loại</th>
                                    <th>Giảm giá</th>
                                    <th class="text-center">Trạng thái</th>
                                    <th class="text-center">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody id="vouchers_list">
                                @foreach ($vouchers as $index => $voucher)
                                    <tr id="id{{ $voucher->id }}">
                                        <td>
                                            <div class="checkbox">
                                                <input id="check-item-{{ $index + 1 }}" name="{{ $voucher->id }}"
                                                    type="checkbox">
                                                <label for="check-item-{{ $index + 1 }}" class="m-b-0"></label>
                                            </div>
                                        </td>
                                        <td>
                                            #{{ $voucher->id }}
                                        </td>
                                        <td>
                                            {{ $voucher->code }}
                                        </td>
                                        @if ($voucher->menu_id != null)
                                            <td>{{ $voucher->menu->name }}</td>
                                        @else
                                            <td>Voucher cá nhân</td>
                                        @endif
                                        <td>{{ $voucher->discount }} %</td>
                                        <td class="text-center">
                                            @if ($voucher->active === 1)
                                                <div class="m-r-10"></div>
                                                <input type="hidden" id="is-active{{ $voucher->id }}"
                                                    value="{{ $voucher->active }}">
                                                <div class="btn-status" data-id="{{ $voucher->id }}">
                                                    <i style="color: red"
                                                        class="bi bi-lock-fill btn-active{{ $voucher->id }}"
                                                        id="icon-active{{ $voucher->id }}"></i>
                                                </div>
                                            @else
                                                <div class="m-r-10"></div>
                                                <input type="hidden" id="is-active{{ $voucher->id }}"
                                                    value="{{ $voucher->active }}">
                                                <div class="btn-status" data-id="{{ $voucher->id }}">
                                                    <i style="color: green"
                                                        class="bi bi-unlock-fill btn-active{{ $voucher->id }}"
                                                        id="icon-active{{ $voucher->id }}"></i>
                                                </div>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('vouchers.edit', $voucher->id) }}">
                                                <button class="btn btn-icon btn-hover btn-sm btn-rounded pull-right">
                                                    <i class="anticon anticon-edit"></i>
                                                </button>
                                            </a>
                                            <button class="btn btn-icon btn-hover btn-sm btn-rounded"
                                                onclick="deleteAjax('vouchers',<?php echo $voucher->id; ?>)">
                                                <i class="anticon anticon-delete"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="text-right pagination">
                        {{ $vouchers->links() }}
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
                                    chưa có voucher nào
                                </th>
                            </center>
                        </div>
                        <div class="col-lg-2 text-right">
                            <a href="{{ route('vouchers.create') }}" class="btn btn-primary">
                                <i class="anticon anticon-plus-circle m-r-5"></i>
                                <span>Add Voucher</span>
                            </a>
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
    <script type="text/javascript" src="{{ asset('/js/handleGeneral/voucher/filter.js') }}"></script>
@endsection
