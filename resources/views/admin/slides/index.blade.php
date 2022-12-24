@extends('layouts.admin.admin-master')
@section('title', $title)
@section('content')
    <link rel="stylesheet" href="{{ asset('/css/paginate.css') }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>;
    <div class="main-content">
        <x:notify-messages />
        <div class="card">
            <div class="card-body">
                <div class="row m-b-30">
                    <div class="col-lg-7">
                        <div class="d-md-flex">
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
                    </div>
                    <div class="col-lg-5  text-right">
                        <a class="" href="{{ route('slides.create') }}">
                            <button class="btn btn-primary" type="button">
                                <i class="anticon anticon-plus-circle m-r-5"></i>
                                <span>Thêm mới</span>
                            </button>
                        </a>
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
                            <th>Tên Silde</th>
                            <th>Sản phẩm</th>
                            <th class="text-center">Trạng thái</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody id="slides_list">
                        @foreach ($slides as $index => $slide)
                            <tr id="id{{ $slide->id }}">
                                <td>
                                    <div class="checkbox">
                                        <input id="check-item-{{ $index + 1 }}" class="check-item"
                                            onclick="checkBox({{ $slide->id }})" value="{{ $slide->id }}"
                                            name="{{ $slide->id }}" type="checkbox">
                                        <label for="check-item-{{ $index + 1 }}" class="m-b-0"></label>
                                    </div>
                                </td>
                                <td>
                                    #{{ $slide->id }}
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img class="img-fluid rounded" src="" style="max-width: 60px"
                                            alt="">
                                        <h6 class="m-b-0 m-l-10">{{ $slide->name }}</h6>
                                    </div>
                                </td>
                                <td>{{ $slide->product->name }}</td>
                                <td class="text-center">
                                    <div class="text-center" style="cursor: pointer">
                                        @if ($slide->active === 1)
                                            <div class="m-r-10"></div>
                                            <input type="hidden" id="is-active{{ $slide->id }}"
                                                value="{{ $slide->active }}">
                                            <div class="btn-status" data-id="{{ $slide->id }}">
                                                <i style="color: red" class="bi bi-lock-fill btn-active{{ $slide->id }}"
                                                    id="icon-active{{ $slide->id }}"></i>
                                            </div>
                                        @else
                                            <div class="m-r-10"></div>
                                            <input type="hidden" id="is-active{{ $slide->id }}"
                                                value="{{ $slide->active }}">
                                            <div class="btn-status" data-id="{{ $slide->id }}">
                                                <i style="color: green"
                                                    class="bi bi-unlock-fill btn-active{{ $slide->id }}"
                                                    id="icon-active{{ $slide->id }}"></i>
                                            </div>
                                        @endif
                                    </div>
                                </td>
                                <td class="">
                                    <a href="{{ route('slides.edit', $slide->id) }}">
                                        <button class="btn btn-icon btn-hover btn-sm btn-rounded pull-right">
                                            <i class="anticon anticon-edit"></i>
                                        </button>
                                    </a>
                                    <button onclick="deleteAjax('slides',<?php echo $slide->id; ?>)"
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
                {{ $slides->links() }}
            </div>
        </div>
    </div>
    <script type="text/javascript" src="{{ asset('/js/handleGeneral/slide/filter.js') }}"></script>
@endsection
