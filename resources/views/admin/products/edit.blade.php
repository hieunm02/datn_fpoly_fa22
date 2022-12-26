@extends('layouts.admin.admin-master')
@section('title', $title)
@section('content')
    <link rel="stylesheet" href="{{ asset('css/product/style.css') }}">
    <div class="main-content">
        <form action="{{ route('products.update', $product->id) }}" enctype="multipart/form-data" method="post">
            @csrf
            @method('PUT')
            <div class="page-header no-gutters has-tab">
                <div class="d-md-flex m-b-15 align-items-center justify-content-between">
                    <div class="m-b-15">
                        <button class="btn btn-primary submit-form">
                            <i class="anticon anticon-save"></i>
                            <span>Save</span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="page-header no-gutters has-tab">
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
                                                    placeholder="Product Name" value="{{ $product->name }}">
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
                                                    placeholder="Product Price" value="{{ $product->price }}">
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-semibold" for="productPrice">Giá Sales</label>
                                            @if ($errors->first('price_sales'))
                                                <input type="text" class="form-control is-invalid" name="price_sales"
                                                    id="" placeholder="Product Price Sales"
                                                    value="{{ old('price_sales') }}">
                                                <div class="invalid-feedback">{{ $errors->first('price_sales') }}</div>
                                            @elseif(session()->has('error_price_sales'))
                                                <input type="text" class="form-control is-invalid" name="price_sales"
                                                    id="" placeholder="Product Price Sales"
                                                    value="{{ $product->price_sales }}">
                                                <div class="invalid-feedback">{{ session('error_price_sales') }}</div>
                                            @else
                                                <input type="text" class="form-control" name="price_sales" id=""
                                                    placeholder="Product Price Sales" value="{{ $product->price_sales }}">
                                            @endif
                                        </div>
                                        <label class="font-weight-semibold" for="">
                                            Ảnh chi tiết sản phẩm</label><br>
                                        <div class="file col-12">
                                            <div class="media align-items-center">
                                                <div class="m-r-15 font-size-30" id="div-thumb">
                                                    <img name="avatar" style="cursor: pointer; height: 85px; width: 100px"
                                                        id="thumb"
                                                        src="https://www.lifewire.com/thmb/blKERZhp27lzE_9SjqlnovU0v-s=/1768x1326/smart/filters:no_upscale()/cloud-upload-a30f385a928e44e199a62210d578375a.jpg" />
                                                    <input id="files" type="file" name="image[]"
                                                        style="display:none; cursor: pointer" multiple />
                                                    <input type="hidden" id="thumbnail" name="thumbnail"
                                                        value="{{ $thumbnails }}">
                                                    <input type="hidden" name="image_update" id="image_update">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="font-weight-semibold" for="">Ảnh sản phẩm</label><br>
                                        <div class="row">
                                            <div class="col-3">
                                                <div class="avatar avatar-image rounded" style="height: 100px; width:100px">
                                                    <img name="avatar" data-toggle="tooltip" data-placement="top"
                                                        title="Tải lên Ảnh Sản Phẩm" style="cursor: pointer" id="avatar"
                                                        src="{{ asset($product->thumb) }}" />
                                                    <input id="fileinput" accept="image/jpeg, image/jpg, image/png" type="file"
                                                        name="thumb" style="display:none; cursor: pointer" />
                                                </div>
                                            </div>
                                            @error('thumb')
                                            <p class="text-danger">
                                                {{ $message }}
                                            </p>
                                            @enderror
                                            <div class="col-9">
                                                <div class="show_images" style="display:none; gap: 0 10px; color: red; font-size:15px">
                                                    File ảnh không hợp lệ
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-semibold" for="productBrand">Số lượng sản
                                                phẩm</label>
                                            @if ($errors->first('quantity'))
                                                <input type="text" placeholder="Quantity" name="quantity"
                                                    value="{{ old('quantity') }}" class="form-control is-invalid"
                                                    id="productBrand">
                                                <div class="invalid-feedback">{{ $errors->first('quantity') }}</div>
                                            @else
                                                <input type="text" class="form-control" name="quantity"
                                                    id="productName" placeholder="Quantity"
                                                    value="{{ $product->quantity }}">
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-semibold" for="productCategory">Menu</label>
                                            <select class="custom-select" name="menu_id" id="productCategory">
                                                @foreach ($menus as $menu)
                                                    @if ($product->menu_id === $menu->id)
                                                        <option value="{{ $menu->id }}" selected>{{ $menu->name }}
                                                        </option>
                                                    @else
                                                        <option value="{{ $menu->id }}">{{ $menu->name }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-semibold" for="productBrand">Mô tả ngắn</label>
                                            @if ($errors->first('content'))
                                                <textarea type="text" placeholder="Content" name="content" class="form-control is-invalid" id="productBrand">{{ old('content') }}</textarea>
                                                <div class="invalid-feedback">{{ $errors->first('content') }}</div>
                                            @else
                                                <textarea type="text" class="form-control" name="content" id="" placeholder="Content">{{ $product->content }}</textarea>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row ">
                                    <div class="col-12">
                                        <label class="font-weight-semibold" for="">Mô tả chi tiết</label>
                                        <div>
                                            @if ($errors->first('desc'))
                                                <textarea name="desc">{{ old('desc') }}</textarea>
                                                <div class="invalid-feedback">{{ $errors->first('desc') }}</div>
                                            @else
                                                <textarea name="desc">{{ $product->desc }}</textarea>
                                                <div class="invalid-feedback">{{ $errors->first('desc') }}</div>
                                            @endif
                                            <script>
                                                CKEDITOR.replace('desc');
                                            </script>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-5">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label class="font-weight-semibold" for="options">Loại tùy biến</label>
                                            <select class="custom-select" name="option" id="options" data-product="{{ $product->id }}">
                                                <option value="0">
                                                    Chọn ...
                                                </option>
                                                @foreach ($options as $option)
                                                    <option value="{{ $option->id }}" {{ !empty($check_option) && $check_option[0]['option_id'] == $option->id  ? "selected" : ""}}>{{ $option->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="input-group-prepend">
                                            <label class="font-weight-semibold" for="">Chi tiết tùy biến</label>
                                        </div>
                                        <div id="option_details" class="text-center">
                                            Không có tùy biến nào !
                                        </div>
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
    <script type="text/javascript" src="{{ asset('js/handleGeneral/product/handleEdit.js') }}"></script>
    <script src="{{ asset('js/handleGeneral/product/select_option.js') }}"></script>
@endsection
