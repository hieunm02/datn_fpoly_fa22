@extends('layouts.admin.admin-master')
@section('title', $title)
@section('content')

<div class="main-content">
    <div class="page-header">
        <h2 class="header-title">{{ $title }}</h2>
    </div>
    <input type="hidden" value="{{ Auth::id() }}" id="user_id">
    @if (session()->has('success'))
    <div class="text-white alert bg-success">
        {{ session()->get('success') }}
    </div>
    @endif
    <div class="card">
        <div class="card-body">
            <div class="m-b-50">
                <form action="" class="row col-md-8">
                    <div class="col-md-4">
                        <select name="active_search" id="status_id" class="custom-select" style="width: 180px;">
                            <option value="">Trạng thái</option>
                            @foreach ($status as $st)
                                <option class="" value="{{ $st->id }}"
                                    @if ($active_search == $st->id) selected="selected" @endif
                                >{{ $st->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <input type="text" style="width: 180px;" class="form-control" name="txt_search" value="{{ $txt_search }}" placeholder="Nhập từ khóa...">
                    </div>
                    <div class="col-md-4">
                        <button class="btn btn-success">Tìm kiếm</button>
                    </div>
                </form>
            </div>
            @if($orders->count())
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
                            <th>Mã đơn hàng</th>
                            <th>Tên người nhận</th>
                            <th>Số điện thoại</th>
                            <th>Địa chỉ</th>
                            <th>Ngày đặt</th>
                            <th>Phương thức</th>
                            <th>Người đặt</th>
                            <th>Chi tiết</th>
                            <th>Trạng thái</th>
                        </tr>
                    </thead>
                    <tbody id="tbodyOrder">
                        @foreach ($orders as $item)
                        <tr id="idOrder{{ $item->id }}">
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
                            <td>{{ $item->type }}</td>
                            <td>
                                @foreach ($authors as $author)
                                @if ($author->id == $item->user_id)
                                {{ $author->name }}
                                @endif
                                @endforeach
                            </td>
                            <td>
                            <a href="/admin/orders/{{$item->id}}">
                                    <i class="anticon anticon-eye"></i>
                                </a>
                            </td>
                            <td>
                                <select name="status" id="status" class="custom-select select-order" style="min-width: 180px;" data-id="{{$item->id}}">
                                    @foreach ($status as $stt)
                                    <option class="status-{{ $item->id }}" value="{{ $stt->id }}" {{ $stt->id == $item->status_id ? ' selected' : '' }}>
                                        {{ $stt->name }}
                                    </option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="text-right">
                    {{ $orders->links() }}
                </div>
            </div>
            @else
            <div class="row">
                <div class="col-12 text-center">
                    <center class="text-uppercase text-center text-20xl font-size-20 opacity-7 font-weight-border">
                        <th>
                            chưa có đơn hàng nào
                        </th>
                    </center>
                </div>
            </div>
            @endif
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
<script type="text/javascript" src="{{ asset('/js/handleGeneral/order/filter.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/handleGeneral/order/detail.js') }}"></script>
@endsection
