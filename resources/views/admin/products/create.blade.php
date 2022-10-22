@extends('layouts.admin.admin-master')
@section('title', $title)
@section('content')
    <link rel="stylesheet" href="{{ asset('css/product/style.css') }}">
    <div class="main-content">
        <form action="{{ route('products.store') }}" enctype="multipart/form-data" method="post">
            @csrf
            <div class="page-header no-gutters has-tab">
                <div class="d-md-flex m-b-15 align-items-center justify-content-between">
                    <div class="m-b-15">
                        <button type="submit" class="btn btn-primary">
                            <i class="anticon anticon-save"></i>
                            <span>Save</span>
                        </button>
                    </div>
                    @if (session()->has('success'))
                        <div class="text-white alert bg-success">
                            {{ session()->get('success') }}
                        </div>
                    @endif
                </div>
                <div class="tab-content m-t-15">
                    <div class="tab-pane fade show active" id="product-edit-basic">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="font-weight-semibold" for="productName">Tên sản phẩm</label>

                                            @if ($errors->first('name'))
                                                <input type="text" class="form-control is-invalid" name="name"
                                                    id="productName" placeholder="Product Name" value="{{ old('name') }}">
                                                <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                                            @else
                                                <input type="text" class="form-control" name="name" id="productName"
                                                    placeholder="Product Name" value="{{ old('name') }}">
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-semibold" for="productPrice">Giá sản phẩm</label>
                                            @if ($errors->first('price'))
                                                <input type="text" class="form-control is-invalid" name="price"
                                                    id="" placeholder="Product Price" value="{{ old('price') }}">
                                                <div class="invalid-feedback">{{ $errors->first('price') }}</div>
                                            @else
                                                <input type="text" class="form-control" name="price" id=""
                                                    placeholder="Product Price" value="{{ old('price') }}">
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-semibold" for="productPrice">Giá Sales</label>
                                            @if (session('price_sales'))
                                                <input type="text" class="form-control is-invalid" name="price_sales"
                                                    id="" placeholder="Product Price Sales"
                                                    value="{{ old('price_sales') }}">
                                                <div class="invalid-feedback">{{ session('price_sales') }}</div>
                                            @else
                                                <input type="text" class="form-control" name="price_sales" id=""
                                                    placeholder="Product Price Sales" value="{{ old('price_sales') }}">
                                            @endif
                                        </div>
                                        <label class="font-weight-semibold" for="">Ảnh chi tiết</label>
                                        <div class="file col-12">
                                            <div class="media align-items-center">
                                                <div class="m-r-15 font-size-30" id="div-thumb">
                                                    <img name="avatar" style="cursor: pointer; height: 85px; width: 100px"
                                                        id="thumb"
                                                        src="https://www.lifewire.com/thmb/blKERZhp27lzE_9SjqlnovU0v-s=/1768x1326/smart/filters:no_upscale()/cloud-upload-a30f385a928e44e199a62210d578375a.jpg" />
                                                    <input id="files" type="file" name="image[]"
                                                        style="display:none; cursor: pointer" multiple />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="font-weight-semibold" for="">Ảnh sản phẩm</label><br>
                                        <div class="avatar avatar-image rounded" style="height: 100px; width:100px">
                                            <img name="avatar" data-toggle="tooltip" data-placement="top"
                                                title="Tải lên Ảnh Sản Phẩm" style="cursor: pointer" id="avatar"
                                                src="https://a3sharing.com/images/sections/upload.png" />
                                            <input id="fileinput" onchange="loadFile(event)" accept=".jpg" type="file"
                                                name="thumb" style="display:none; cursor: pointer" />
                                            <div class="invalid-feedback">{{ $errors->first('thumb') }}</div>
                                        </div>
                                        <div class="form-group mt-3">
                                            <label class="font-weight-semibold" for="productBrand">Số lượng sản
                                                phẩm</label>
                                            @if ($errors->first('quantity'))
                                                <input type="text" placeholder="Quantity" name="quantity"
                                                    value="{{ old('quantity') }}" class="form-control is-invalid"
                                                    id="productBrand">
                                                <div class="invalid-feedback">{{ $errors->first('quantity') }}</div>
                                            @else
                                                <input type="text" class="form-control" name="quantity"
                                                    id="" placeholder="Quantity" value="{{ old('quantity') }}">
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-semibold" for="productCategory">Menu</label>
                                            <select class="custom-select" name="menu_id" id="productCategory">
                                                @foreach ($menus as $menu)
                                                    <option value="{{ $menu->id }}" selected>{{ $menu->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-semibold" for="productBrand">Mô tả ngắn</label>
                                            @if ($errors->first('content'))
                                                <textarea type="text" placeholder="Content" name="content" class="form-control is-invalid" id="productBrand">{{ old('content') }}</textarea>
                                                <div class="invalid-feedback">{{ $errors->first('content') }}</div>
                                            @else
                                                <textarea type="text" class="form-control" name="content" id="productName" placeholder="Content">{{ old('content') }}</textarea>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <label class="font-weight-semibold" for="">Mô tả chi tiết</label>
                                        @if ($errors->first('desc'))
                                            <textarea name="desc">{{ old('desc') }}</textarea>
                                            <div class="invalid-feedback">{{ $errors->first('desc') }}</div>
                                        @else
                                            <textarea name="desc">{{ old('desc') }}</textarea>
                                            <div class="invalid-feedback">{{ $errors->first('desc') }}</div>
                                        @endif
                                        <script>
                                            CKEDITOR.replace('desc');
                                        </script>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('js/handleGeneral/product/hanldeCreate.js') }}"></script>
    <script>
        $('#productName').change(function() {
            $('#outPut').html($(this).val());
        });
    </script>
    </div>
@endsection
