@extends('layouts.admin.admin-master')
@section('title', $title)
@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>;
    <div class="main-content">
        <div class="page-header">
            <h2 class="header-title">{{ $title }}</h2>
        </div>
        @if (session('success'))
            <div class="alert alert-success">
                <i class="fa fa-check"></i>
                <span class="alert_success">{{ session('success') }}</span>
            </div>
        @endif
        @if($comments->count())
        <div class="card">
            <div class="card-body">
                <div class="row m-b-30">
                    <div class="col-lg-7">
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
                                <th>Sản phẩm</th>
                                <th>Tên người dùng</th>
                                <th>Nội dung</th>
                                <th class="text-center">Trạng thái</th>
                                <th class="text-center">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody id="comments_list">
                            @foreach ($comments as $index => $comment)
                                <tr id="id{{$comment->id}}">
                                    <td>
                                        <div class="checkbox">
                                            <input id="check-item-{{ $index + 1 }}" class="check-item"
                                                onclick="checkBox({{ $comment->id }})" value="{{ $comment->id }}"
                                                name="{{ $comment->id }}" type="checkbox">
                                            <label for="check-item-{{ $index + 1 }}" class="m-b-0"></label>
                                        </div>
                                    </td>
                                    <td>
                                        #{{ $comment->id }}
                                    </td>

                                    <td>{{ $comment->product->name }}</td>
                                    <td>{{ $comment->user->name }}</td>
                                    <td>{{ $comment->content }}</td>
                                    <td class="text-center">
                                        <div class="text-center" style="cursor: pointer">
                                            @if ($comment->active === 1)
                                            <div class="m-r-10"></div>
                                            <input type="hidden" id="is-active{{ $comment->id }}"
                                                value="{{ $comment->active }}">
                                            <div class="btn-status" data-id="{{ $comment->id }}">
                                                <i style="color: red" class="bi bi-lock-fill btn-active{{ $comment->id }}"
                                                    id="icon-active{{ $comment->id }}"></i>
                                            </div>
                                            @else
                                                <div class="m-r-10"></div>
                                                <input type="hidden" id="is-active{{ $comment->id }}"
                                                    value="{{ $comment->active }}">
                                                <div class="btn-status" data-id="{{ $comment->id }}">
                                                    <i style="color: green"
                                                        class="bi bi-unlock-fill btn-active{{ $comment->id }}"
                                                        id="icon-active{{ $comment->id }}"></i>
                                                </div>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <button class="btn btn-icon btn-hover btn-sm btn-rounded"  onclick="deleteAjax('comments',<?php echo $comment->id; ?>)">
                                            <i class="anticon anticon-delete"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="text-right pagination">
                        {{ $comments->links() }}
                    </div>
                </div>
            </div>
        </div>
        @else
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 text-center">
                            <center class="text-uppercase text-center text-20xl font-size-20 opacity-7 font-weight-border">
                                <th>
                                    chưa có bình luận, đánh giá nào
                                </th>
                            </center>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
    <script type="text/javascript" src="{{ asset('/js/handleGeneral/comment/filter.js') }}"></script>
@endsection
