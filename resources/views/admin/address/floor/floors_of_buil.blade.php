@extends('layouts.admin.admin-master')
@section('title', $title ?? '')
@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>;
    <div class="main-content">
        <div class="page-header">
            <h2 class="header-title">Address List</h2>
            <div class="header-sub-title">
                <nav class="breadcrumb breadcrumb-dash">
                    <a href="{{ route('building.index') }}" class="breadcrumb-item"><i
                            class="anticon anticon-home m-r-5"></i>Buildings</a>
                    <span class="breadcrumb-item active">Floors</span>
                </nav>
            </div>
        </div>
        @if (session('success'))
            <div class="alert alert-success">
                <i class="fa fa-check"></i>
                <span class="alert_success">{{ session('success') }}</span>
            </div>
        @endif
        @if($floors->count())
        <div class="card">
            <div class="card-body">
                <div class="row m-b-30">
                    <div class="col-lg-7">
                    </div>
                    <div class="col-lg-5  text-right">
                        <a class="" href="{{ route('floor.create', $buildind_id) }}">
                            <button class="btn btn-primary" type="button">
                                <i class="anticon anticon-plus-circle m-r-5"></i>
                                <span>Thêm tầng</span>
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
                                        <input id="checkAll" type="checkbox" disabled>
                                        <label for="checkAll" class="m-b-0"></label>
                                    </div>
                                </th>
                                <th>ID</th>
                                <th>Tòa</th>
                                <th>Tầng</th>
                                <th>Số Phòng</th>
                                <th>Trạng thái</th>
                                <th class="text-center">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($floors as $index => $floor)
                                <tr>
                                    <td>
                                        <div class="checkbox">
                                            <input id="check-item-{{ $index + 1 }}" class="check-item"
                                                onclick="checkBox({{ $floor->id }})" value="{{ $floor->id }}"
                                                name="{{ $floor->id }}" type="checkbox">
                                            <label for="check-item-{{ $index + 1 }}" class="m-b-0"></label>
                                        </div>
                                    </td>
                                    <td>
                                        #{{ $floor->id }}
                                    </td>
                                    <td>Tòa {{ $floor->building->name }}</td>
                                    <td>Tầng {{ $floor->name }}</td>
                                    <td>
                                        {{ $floor->rooms->count() }}
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center" style="cursor: pointer">
                                            @if ($floor->active === 0)
                                                <div id="icon-active{{ $floor->id }}"
                                                    class="badge badge-success badge-dot m-r-10"></div>
                                                <input type="hidden" id="is-active{{ $floor->id }}"
                                                    value="{{ $floor->active }}">
                                                <div class="btn-status btn-active{{ $floor->id }}"
                                                    data-id="{{ $floor->id }}">Hoạt động</div>
                                            @else
                                                <div id="icon-active{{ $floor->id }}"
                                                    class="badge badge-danger badge-dot m-r-10"></div>
                                                <input type="hidden" id="is-active{{ $floor->id }}"
                                                    value="{{ $floor->active }}">
                                                <div class="btn-status btn-active{{ $floor->id }}"
                                                    data-id="{{ $floor->id }}">Ngừng hoạt động
                                                </div>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('floor.rooms', $floor->id) }}">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <a href="{{ route('floor.update', $floor->id) }}">
                                            <button class="btn btn-icon btn-hover btn-sm btn-rounded pull-right">
                                                <i class="anticon anticon-edit"></i>
                                            </button>
                                        </a>
                                        <form method="POST" class="inline-block"
                                            onsubmit="return confirm('Xác nhận xóa dữ liệu.')"
                                            action="{{ route('floor.destroy', $floor->id) }}">
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
                        {{ $floors->links() }}
                    </div>
                </div>
            </div>
        </div>
        @else
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-10 text-center">
                            <center
                                class="text-uppercase text-center text-20xl font-size-20 opacity-7 font-weight-border">
                                <th>
                                        chưa có tầng nào được thêm trong tòa
                                </th>
                            </center>
                        </div>
                        <div class="col-lg-2 text-right">
                            <a href="{{ route('floor.create', $buildind_id) }}"class="btn btn-primary">
                                <i class="anticon anticon-plus-circle m-r-5"></i>
                                <span>Add</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
