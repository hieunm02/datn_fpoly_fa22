@extends('layouts.admin.admin-master')
@section('title', $title)
@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>;
<div class="main-content">
    <div class="page-header">
        <h2 class="header-title">{{$title}}</h2>
    </div>
    @if (session('success'))
    <div class="alert alert-success">
        <i class="fa fa-check"></i>
        <span class="alert_success">{{ session('success') }}</span>
    </div>
    @endif
    <div class="card">
        <div class="card-body">
            <div class="m-b-50">
                <form action="" class="row col-md-8">
                    <div class="col-md-4">
                        <input type="text" style="width: 180px;" class="form-control" name="txt_search" value="{{ $txt_search }}" placeholder="Nhập từ khóa...">
                    </div>
                    <div class="col-md-4">
                        <button class="btn btn-success">Tìm kiếm</button>
                    </div>
                </form>
            </div>
            @if($bills->count())
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
                            <th>Email</th>
                            <th>Mã</th>
                            <th>Tên</th>
                            <th>Phương thức</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bills as $index => $bill)
                        <tr id="id{{$bill->id}}">
                            <td>
                                <div class="checkbox">
                                    <input id="check-item-1" type="checkbox">
                                    <label for="check-item-1" class="m-b-0"></label>
                                </div>
                            </td>
                            <td>{{$bill->id}}</td>
                            <td>{{$bill->email}}</td>
                            <td>{{$bill->code}}</td>
                            <td>{{$bill->name}}</td>
                            <td>{{$bill->type}}</td>
                            <td>
                                <a href="/admin/bills/{{$bill->id}}">
                                    <i class="anticon anticon-eye"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <div class="row">
                <div class="col-12 text-center">
                    <center class="text-uppercase text-center text-20xl font-size-20 opacity-7 font-weight-border">
                        <th>
                            chưa có hóa đơn hàng nào
                        </th>
                    </center>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
<div style="display: flex; justify-content: center">
    {{ $bills->links() }}
</div>
</div>
</div>
</div>
</div>
@endsection