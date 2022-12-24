@extends('layouts.admin.admin-master')
@section('title', $title)
@section('content')
    <div class="main-content">
        <div class="page-header">
            <h2 class="header-title">{{ $title }}</h2>
            <x:notify-messages />
        </div>
        @if (count($staffs))
            <div class="card">
                <div class="card-body">
                    <div class="card">
                        <div class="card-body">
                            <div class="row m-b-30">
                                <div class="col-lg-8">
                                </div>
                                <div class="col-lg-4 text-right">
                                    <a href="{{ route('staffs.create') }}" class="btn btn-primary">
                                        <i class="anticon anticon-plus-circle m-r-5"></i>
                                        <span>Thêm tài khoản</span>
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
                                            <th colspan="2"></th>
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
                                                <td>
                                                    <div class="text-center" style="cursor: pointer">
                                                        @if ($item->active === 1)
                                                            <div class="m-r-10"></div>
                                                            <input type="hidden" id="is-active{{ $item->id }}"
                                                                value="{{ $item->active }}">
                                                            <div class="btn-status" data-id="{{ $item->id }}">
                                                                <i style="color: red"
                                                                    class="bi bi-lock-fill btn-active{{ $item->id }}"
                                                                    id="icon-active{{ $item->id }}"></i>
                                                            </div>
                                                        @else
                                                            <div class="m-r-10"></div>
                                                            <input type="hidden" id="is-active{{ $item->id }}"
                                                                value="{{ $item->active }}">
                                                            <div class="btn-status" data-id="{{ $item->id }}">
                                                                <i style="color: green"
                                                                    class="bi bi-unlock-fill btn-active{{ $item->id }}"
                                                                    id="icon-active{{ $item->id }}"></i>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </td>
                                                <td>
                                                    @role('manager')
                                                    <td class="text-right">
                                                        <a href="{{ route('staffs.edit', $item->id) }}">
                                                            <button
                                                                class="btn btn-icon btn-hover btn-sm btn-rounded pull-right">
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
