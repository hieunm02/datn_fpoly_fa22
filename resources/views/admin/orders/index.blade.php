@extends('layouts.admin.admin-master')
@section('title', $title)
@section('content')

    <div class="main-content">
        <div class="page-header">
            <h2 class="header-title">{{ $title }}</h2>
        </div>
        @if (session()->has('success'))
            <div class="text-white alert bg-success">
                {{ session()->get('success') }}
            </div>
        @endif
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
                                <input name="code" type="text" id="search-by-code" class="form-control" placeholder="Search by code">
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
                                        <input id="checkAll" type="checkbox">
                                        <label for="checkAll" class="m-b-0"></label>
                                    </div>
                                </th>
                                <th>ID</th>
                                <th>Mã đơm hàng</th>
                                <th>Tên người nhận</th>
                                <th>Số điện thoại</th>
                                <th>Địa chỉ</th>
                                <th>Ngày đặt</th>
                                <th>Người đặt</th>
                                <th>Ghi chú</th>
                                <th>Trạng thái</th>
                            </tr>
                        </thead>
                        <tbody id="tbodyOrder">
                            @foreach ($orders as $item)
                                <tr id="id{{ $item->id }}">
                                    <td>
                                        <div class="checkbox">
                                            <input id="check-item-{{ $item->id }}" type="checkbox">
                                            <label for="check-item-{{ $item->id }}" class="m-b-0"></label>
                                        </div>
                                    </td>
                                    <td>#{{ $item->id }}</td>
                                    <td>{{ $item->code }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->phone }}</td>
                                    <td>{{ $item->address }}</td>
                                    <td>{{ $item->created_at }}</td>
                                    <td>
                                        @foreach ($authors as $author)
                                            @if ($author->id == $item->user_id)
                                                {{ $author->name }}
                                            @endif
                                        @endforeach
                                    </td>
                                    <td>{{ $item->note }}</td>
                                    <td>
                                        <select name="status" id="status" class="custom-select"
                                            style="min-width: 180px;" onchange="changeStatusAjax({{ $item->id }})">
                                            @foreach ($status as $stt)
                                                <option class="status-{{ $item->id }}" value="{{ $stt->id }}"
                                                    {{ $stt->id == $item->status_id ? ' selected' : '' }}>
                                                    {{ $stt->name }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{-- <div class="text-right">
                        {{ $products->links() }}
                    </div> --}}
                </div>
            </div>
        </div>
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
@endsection
