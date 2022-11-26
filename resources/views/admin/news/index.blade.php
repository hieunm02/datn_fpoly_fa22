@extends('layouts.admin.admin-master')
@section('title', $title)
@section('content')
    <link rel="stylesheet" href="{{ asset('/css/paginate.css') }}">
    <div class="main-content">
        <div class="page-header">
            <h2 class="header-title">{{ $title }}</h2>
        </div>
        <x:notify-messages />
        @if ($news->count())
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
                            <a href="{{ route('news.create') }}" class="btn btn-primary">
                                <i class="anticon anticon-plus-circle m-r-5"></i>
                                <span>Thêm mới</span>
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
                                    <th>Tiêu đề</th>
                                    <th>Ảnh</th>
                                    <th>Trạng thái</th>
                                    <th class="text-center">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody id="news_list">
                                @foreach ($news as $item)
                                    <tr id="id{{ $item->id }}">
                                        <td>
                                            <div class="checkbox">
                                                <input id="check-item-1" type="checkbox">
                                                <label for="check-item-1" class="m-b-0"></label>
                                            </div>
                                        </td>
                                        <td>#{{ $item->id }}</td>
                                        <td>{{ $item->title }}</td>
                                        <td><img width="100px" src="{{ asset($item->image_path) }}" alt=""></td>
                                        <td>
                                            <div class="text-center" style="cursor: pointer">
                                                @if ($item->active === 0)
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
                                        <td class="text-center">
                                            <a href="{{ route('news.edit', $item->id) }}"
                                                class="btn-icon btn-hover btn-sm btn-rounded pull-right">
                                                <i class="anticon anticon-edit"></i>
                                            </a>
                                            <button class="btn btn-icon btn-hover btn-sm btn-rounded"
                                                onclick="deleteAjax('news',<?php echo $item->id; ?>)">
                                                <i class="anticon anticon-delete"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="text-right pagination">
                        {{ $news->links() }}
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
                                    chưa có bài viết nào
                                </th>
                            </center>
                        </div>
                        <div class="col-lg-2 text-right">
                            <a href="{{ route('news.create') }}" class="btn btn-primary">
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
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });
    </script>
    <script src="{{ asset('/js/handleGeneral/new/filter.js') }}"></script>
@endsection
