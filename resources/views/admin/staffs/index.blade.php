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
                                <div class="d-md-flex col-md-8">
                                    <div class="m-b-10 mr-3">
                                        <select class="custom-select select-active" style="min-width: 180px;">
                                            <option selected value="">Trạng thái</option>
                                            <option value="0">Mở</option>
                                            <option value="1">Khóa</option>
                                        </select>
                                    </div>
                                    <div class="m-b-10">
                                        <input type="text" name="text_search" class="form-control" placeholder="Tìm kiếm..."
                                            style="width: 180px;">
                                    </div>
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
                                            <th class="text-center">Trạng thái</th>
                                            <th class="text-center">Thao tác</th>
                                        </tr>
                                    </thead>
                                    <tbody id="staff_list">
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
                                                    <div class="text-center" style="cursor: pointer">
                                                        <input type="hidden" name="auth_id" value="{{ Auth::user()->id }}">
                                                        @if ($item->active == 1)
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
                                                @role('manager')
                                                <td class="text-center">
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
                            <div class="text-right pagination">
                                {{ $staffs->links() }}
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
                                    Chưa có nhân viên nào
                                </th>
                            </center>
                        </div>
                        <div class="col-lg-2 text-right">
                            <a href="{{ route('staffs.create') }}" class="btn btn-primary">
                                <i class="anticon anticon-plus-circle m-r-5"></i>
                                <span>Thêm tài khoản</span>
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
    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="{{ asset('/js/handleGeneral/staff/filter.js') }}"></script>
@endsection
