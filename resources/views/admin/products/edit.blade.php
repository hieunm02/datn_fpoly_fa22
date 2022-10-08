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
                    <div class="media align-items-center m-b-15">
                        <div class="avatar avatar-image rounded" style="height: 60px; width:60px">
                            <img name="avatar" data-toggle="tooltip" data-placement="top" title="Tải lên Ảnh Sản Phẩm"
                                style="cursor: pointer" id="avatar" src="{{ asset($product->thumb) }}" />
                            <input id="fileinput" onchange="loadFile(event)" accept=".jpg" type="file" name="thumb"
                                style="display:none; cursor: pointer" />
                        </div>

                        <div class="m-l-15">
                            <h4 class="m-b-0" id="outPut"></h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="page-header no-gutters has-tab">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#product-edit-basic">Thông tin sản phẩm</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#product-edit-description">Mô tả chi tiết</a>
                    </li>
                </ul>
                <div class="tab-content m-t-15">
                    <div class="tab-pane fade show active" id="product-edit-basic">
                        <div class="card">
                            <div class="card-body">
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
                                <link href='https://css.gg/arrow-left-r.css' rel='stylesheet'>
                                <div class="form-group">
                                    <label class="font-weight-semibold" for="productPrice">Thuộc tầm giá</label>
                                    <select class="custom-select" name="price_id" id="productCategory">
                                        @foreach ($prices as $price)
                                            @if ($product->price_id === $price)
                                                <option value="{{ $price->id }}" selected>{{ $price->original }}
                                                    => {{ $price->sale }}</option>
                                            @else
                                                <option value="{{ $price->id }}">{{ $price->original }}
                                                    => {{ $price->sale }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="font-weight-semibold" for="productCategory">Menu</label>
                                    <select class="custom-select" name="menu_id" id="productCategory">
                                        @foreach ($menus as $menu)
                                            @if ($product->menu_id === $menu->id)
                                                <option value="{{ $menu->id }}" selected>{{ $menu->name }}</option>
                                            @else
                                                <option value="{{ $menu->id }}">{{ $menu->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="font-weight-semibold" for="productBrand">Số lượng sản phẩm</label>
                                    @if ($errors->first('quantity'))
                                        <input type="text" placeholder="Quantity" name="quantity"
                                            value="{{ old('quantity') }}" class="form-control is-invalid"
                                            id="productBrand">
                                        <div class="invalid-feedback">{{ $errors->first('quantity') }}</div>
                                    @else
                                        <input type="text" class="form-control" name="quantity" id="productName"
                                            placeholder="Quantity" value="{{ $product->quantity }}">
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="font-weight-semibold" for="productBrand">Mô tả ngắn</label>
                                    @if ($errors->first('content'))
                                        <input type="text" placeholder="Content" name="content"
                                            value="{{ old('content') }}" class="form-control is-invalid"
                                            id="productBrand">
                                        <div class="invalid-feedback">{{ $errors->first('content') }}</div>
                                    @else
                                        <input type="text" class="form-control" name="content" id="productName"
                                            placeholder="Content" value="{{ $product->content }}">
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="product-edit-description">
                        <div class="card">
                            <div class="card-body">
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
                        <div class="cart">
                            <div class="card-body">
                                <div class="file">
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
                                        <div>
                                            <h6 class="mb-0">Ảnh chi tiết sản phẩm</h6>
                                            <span class="font-size-13 text-muted">60MB</span>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="m-b-15">
                            <button class="btn btn-primary submit-form">
                                <i class="anticon anticon-save"></i>
                                <span>Save</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

        </form>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
        <script type="text/javascript" src="{{ asset('js/handleGeneral/product/handleEdit.js') }}"></script>
    </div>
@endsection
