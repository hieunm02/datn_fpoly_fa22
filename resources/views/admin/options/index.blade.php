@extends('layouts.admin.admin-master')
@section('title', $title)
@section('content')
<div class="main-content">
    <div class="page-header">
        <h2 class="header-title">{{ $title }}</h2>
    </div>
    <x:notify-messages />
    {{-- @dd($data) --}}

    @if (count($data))
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
                                <option value="inStock">In Stock</option>
                                <option value="outOfStock">Out of Stock</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 text-right">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                        <i class="anticon anticon-plus-circle m-r-5"></i>
                        <span>Add</span>
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Thêm mới thuộc tính</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('options.store') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="tab-content m-t-15">
                                            <div class="tab-pane fade show active" id="product-edit-basic">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div class="form-group">
                                                            <label class="font-weight-semibold" for="optionName">Name</label>
                                                            <input type="text" name="name" class="form-control <?php echo $errors->first('name') ? 'is-invalid' : ''; ?>" id="optionName" placeholder="Option name" value="{{ old('name') }}">
                                                            @if ($errors->first('name'))
                                                            <div class="invalid-feedback">
                                                                {{ $errors->first('name') }}
                                                            </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                                            <button type="submit" class="btn btn-primary">Lưu</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
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
                            <th>Tên thuộc tính</th>
                            <th>Active</th>
                            <th></th>
                            <th></th>
                            <th colspan="2">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                        <tr id="id{{ $item['options']->id }}">
                            <td>
                                <div class="checkbox">
                                    <input id="check-item-1" type="checkbox">
                                    <label for="check-item-1" class="m-b-0"></label>
                                </div>
                            </td>
                            <td>#{{ $item['options']->id }}</td>
                            <td>{{ $item['options']->name }}</td>
                            @if ($item['options']->active === 0)
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="badge badge-danger badge-dot m-r-10"></div>
                                    <div>Private</div>
                                </div>
                            </td>
                            @else
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="badge badge-success badge-dot m-r-10"></div>
                                    <div>Public</div>
                                </div>
                            </td>
                            @endif
                            <td>
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter-{{ $item['options']->id }}">
                                    Show List Data
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="exampleModalCenter-{{ $item['options']->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">List
                                                    {{ $item['options']->name }}
                                                    Data
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <table class="table">
                                                    <thead>
                                                        <th>ID</th>
                                                        <th>Value</th>
                                                        <th>Price</th>
                                                        <th colspan="2">Action</th>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($item['option_details'] as $value)
                                                        <tr>
                                                            <td># {{ $value->id }}</td>
                                                            <td>{{ $value->value }}</td>
                                                            <td>{{ $value->price }}</td>
                                                            <td>Edit</td>
                                                            <td><button class="btn btn-icon btn-hover btn-sm btn-rounded" onclick="deleteAjax('option-details',<?php echo $value->id; ?>)">
                                                                <i class="anticon anticon-delete"></i>
                                                            </button></td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td><a href="{{ route('option-details.create', $item['options']->id) }}" class="btn-icon btn-hover btn-sm btn-rounded pull-right">
                                    <button class="btn btn-primary">Thêm danh sách</button>
                                </a></td>
                            <td class="text-right">
                                <!-- Button trigger modal -->
                                <button type="button" class="btn" data-toggle="modal" data-target="#exampleModal-{{ $item['options']->id }}">
                                    <i class="anticon anticon-edit"></i>
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal-{{ $item['options']->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">
                                                    Sửa thuộc tính
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('options.update', $item['options']->id) }}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="tab-content m-t-15">
                                                        <div class="tab-pane fade show active" id="product-edit-basic">
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <div class="form-group">
                                                                        <label class="font-weight-semibold" for="optionName">Name</label>
                                                                        <input type="text" name="name" class="form-control <?php echo $errors->first('name') ? 'is-invalid' : ''; ?>" id="optionName" placeholder="Option name" value="{{ $item['options']->name }}">
                                                                        @if ($errors->first('name'))
                                                                        <div class="invalid-feedback">
                                                                            {{ $errors->first('name') }}
                                                                        </div>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                                                        <button type="submit" class="btn btn-primary">Lưu</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td><button class="btn btn-icon btn-hover btn-sm btn-rounded" onclick="deleteAjax('options',<?php echo $item['options']->id; ?>)">
                                    <i class="anticon anticon-delete"></i>
                                </button></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @else
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
                                <option value="inStock">In Stock</option>
                                <option value="outOfStock">Out of Stock</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 text-right">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                        <i class="anticon anticon-plus-circle m-r-5"></i>
                        <span>Add</span>
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Thêm mới thuộc tính</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('options.store') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="tab-content m-t-15">
                                            <div class="tab-pane fade show active" id="product-edit-basic">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div class="form-group">
                                                            <label class="font-weight-semibold" for="optionName">Name</label>
                                                            <input type="text" name="name" class="form-control <?php echo $errors->first('name') ? 'is-invalid' : ''; ?>" id="optionName" placeholder="Option name" value="{{ old('name') }}">
                                                            @if ($errors->first('name'))
                                                            <div class="invalid-feedback">
                                                                {{ $errors->first('name') }}
                                                            </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                                            <button type="submit" class="btn btn-primary">Lưu</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">

                <div class="col-10 text-center">
                    <center class="text-uppercase text-center text-20xl font-size-20 opacity-7 font-weight-border">
                        <th>
                            chưa có {{ $obj_name }} nào !!!
                        </th>
                    </center>
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
@endsection
