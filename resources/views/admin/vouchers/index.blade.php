@extends('layouts.admin.admin-master')
@section('title', $title)
@section('content')
<div class="main-content">
    <div class="page-header">
        <h2 class="header-title">Orders List</h2>
        <div class="header-sub-title">
            <nav class="breadcrumb breadcrumb-dash">
                <a href="#" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>Home</a>
                <a class="breadcrumb-item" href="#">Apps</a>
                <a class="breadcrumb-item" href="#">E-commerce</a>
                <span class="breadcrumb-item active">Orders List</span>
            </nav>
        </div>
    </div>
    <x:notify-messages />
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
                            <select class="custom-select" style="min-width: 180px;">
                                <option selected>Status</option>
                                <option value="all">All</option>
                                <option value="inStock">In Stock </option>
                                <option value="outOfStock">Out of Stock</option>
                            </select>
                        </div>
                    </div>
                </div>
                <a class="col-lg-4 text-right" href="{{ route('vouchers.create') }}">
                    <button class="btn btn-primary" type="button">
                        <i class="anticon anticon-plus-circle m-r-5"></i>
                        <span>Add voucher</span>
                    </button>
                </a>
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
                            <th>Code</th>
                            <th>Thumbnail</th>
                            <th>Loai</th>
                            <th>Giảm giá</th>
                            <th>Trạng thái</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($vouchers as $index => $voucher)
                        <tr id="id{{$voucher->id}}">
                            <td>
                                <div class="checkbox">
                                    <input id="check-item-{{ $index + 1 }}" name="{{ $voucher->id }}" type="checkbox">
                                    <label for="check-item-{{ $index + 1 }}" class="m-b-0"></label>
                                </div>
                            </td>
                            <td>
                                #{{ $voucher->id }}
                            </td>
                            <td>
                                {{ $voucher->code }}
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img class="img-fluid rounded" src="{{$voucher->thumb}}" style="max-width: 60px" alt="">
                                </div>
                            </td>
                            @if($voucher->menu_id != null)
                            <td>{{ $voucher->menu->name }}</td>
                            @esle
                            <td>Voucher cá nhân</td>
                            @endif
                            <td>{{ $voucher->discount }} %</td>
                            <td>
                                <div class="d-flex align-items-center" style="cursor: pointer">
                                    @if ($voucher->active === 1)
                                    <div class="badge badge-danger badge-dot m-r-10"></div>
                                    <div>Hết hạn</div>
                                    @else
                                    <div class="badge badge-success badge-dot m-r-10"></div>
                                    <div>Còn hạn</div>
                                    @endif
                                </div>
                                </form>

                            </td>
                            <td class="text-right">
                                <a href="{{ route('vouchers.edit', $voucher->id) }}">
                                    <button class="btn btn-icon btn-hover btn-sm btn-rounded pull-right">
                                        <i class="anticon anticon-edit"></i>
                                    </button>
                                </a>
                                <button class="btn btn-icon btn-hover btn-sm btn-rounded" onclick="deleteAjax('vouchers',<?php echo $voucher->id ?>)">
                                    <i class="anticon anticon-delete"></i>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="text-right">
                    {{ $vouchers->links() }}
                </div>
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