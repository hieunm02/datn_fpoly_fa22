@extends('layouts.admin.admin-master')
@section('title', $title)
@section('content')
    <link rel="stylesheet" href="{{ asset('/css/paginate.css') }}">
    <div class="main-content">
        <div class="page-header d-flex align-items-center">
            <h2 class="header-title flex-fill">{{ $title }}</h2>
            <x:notify-messages />
        </div>
        @if ($menus->count())
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
                        <div class="col-lg-4 text-right">
                            <a href="{{ route('menus.create') }}">
                                <button class="btn btn-primary">
                                    <i class="anticon anticon-plus-circle m-r-5"></i>
                                    <span>Thêm mới</span>
                                </button>
                            </a>
                        </div>
                        <div>
                            {{ $menus->links() }}
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover e-commerce-table " style="font-size: 14px">
                            <thead>
                                <tr>
                                    <th>
                                        <div class="checkbox">
                                            <input id="checkAll" type="checkbox">
                                            <label for="checkAll" class="m-b-0"></label>
                                        </div>
                                    </th>
                                    <th>ID</th>
                                    <th>Tên danh mục</th>
                                    <th>Danh mục cha</th>
                                    <th>Ảnh</th>
                                    <th class="text-center">Trạng thái</th>
                                    <th class="text-right">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody id="cate_list">
                                @foreach ($menus as $menu)
                                    <tr id="id{{ $menu->id }}">
                                        <td>
                                            <div class="checkbox">
                                                <input id="check-item-1" type="checkbox">
                                                <label for="check-item-1" class="m-b-0"></label>
                                            </div>
                                        </td>
                                        <td>
                                            #{{ $menu->id }}
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img class="img-fluid rounded" src="" style="max-width: 60px"
                                                    alt="">
                                                <h6 class="m-b-0 m-l-10">{{ $menu->name }}</h6>
                                            </div>
                                        </td>
                                        <td>{{ $menu->parent_id }}</td>
                                        <td>
                                            <img src="{{ $menu->thumb }}" alt="" width="68px">
                                        </td>
                                        <td>
                                            <div class="text-center" style="cursor: pointer">
                                                <input type="hidden" id="is-active{{ $menu->id }}"
                                                    value="{{ $menu->active }}">
                                                @if ($menu->active === 1)
                                                    <div class="m-r-10"></div>
                                                    <div class="btn-status" data-id="{{ $menu->id }}">
                                                        <i style="color: red"
                                                            class="bi bi-lock-fill btn-active{{ $menu->id }}"
                                                            id="icon-active{{ $menu->id }}"></i>
                                                    </div>
                                                @else
                                                    <div class="m-r-10"></div>
                                                    <div class="btn-status" data-id="{{ $menu->id }}">
                                                        <i style="color: green"
                                                            class="bi bi-unlock-fill btn-active{{ $menu->id }}"
                                                            id="icon-active{{ $menu->id }}"></i>
                                                    </div>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="text-right">
                                            <a href="{{ route('menus.edit', $menu->id) }}">
                                                <button class="btn btn-icon btn-hover btn-sm btn-rounded pull-right">
                                                    <i class="anticon anticon-edit"></i>
                                                </button>
                                            </a>
                                            <button onclick="deleteAjax('menus',<?php echo $menu->id; ?>)"
                                                class="btn btn-icon btn-hover btn-sm btn-rounded">
                                                <i class="anticon anticon-delete"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="text-right pagination">
                        {{ $menus->links() }}
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
                                    chưa có menu nào
                                </th>
                            </center>
                        </div>
                        <div class="col-lg-2 text-right">
                            <a href="{{ route('menus.create') }}" class="btn btn-primary">
                                <i class="anticon anticon-plus-circle m-r-5"></i>
                                <span>Add</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="{{ asset('/js/handleGeneral/category/filter.js') }}"></script>
@endsection
<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    });
    setTimeout(() => {
        document.getElementById('setout').classList.add('d-none');
    }, 5000);
</script>
