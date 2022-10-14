@extends('layouts.admin.admin-master')
@section('title', $title)
@section('content')
<div class="main-content">
    <form action="{{ route('products.store') }}" enctype="multipart/form-data" method="post">
        @csrf
        <div class="page-header no-gutters has-tab">
            <div class="d-md-flex m-b-15 align-items-center justify-content-between">
                <div class="media align-items-center m-b-15">
                    <div class="avatar avatar-image rounded" style="height: 60px; width:60px">
                        @if ($errors->first('thumb'))
                        <img name="avatar" data-toggle="tooltip" data-placement="top" title="Tải lên Ảnh Sản Phẩm" style="cursor: pointer" id="avatar" src="https://a3sharing.com/images/sections/upload.png" />
                        <input id="fileinput" onchange="loadFile(event)" accept=".jpg" type="file" name="thumb" style="display:none; cursor: pointer" />
                        <div class="invalid-feedback">{{ $errors->first('thumb') }}</div>
                        @else
                        <img name="avatar" data-toggle="tooltip" data-placement="top" title="Tải lên Ảnh Sản Phẩm" style="cursor: pointer" id="avatar" src="https://a3sharing.com/images/sections/upload.png" />
                        <input id="fileinput" onchange="loadFile(event)" accept=".jpg" type="file" name="thumb" style="display:none; cursor: pointer" />
                        @endif
                        <script type="text/JavaScript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
                        <script>
                            $(function() {
                                $('#avatar').on('click', function() {
                                    $('#fileinput').trigger('click');
                                });
                                $('.submit-form').click(function() {
                                    if (!$('#fileinput').val()) {
                                        alert('Ảnh sản phẩm đang trống.')
                                    }
                                })
                            });
                            var loadFile = function(event) {
                                var output = document.querySelector('#avatar');
                                console.log(output);
                                output.src = URL.createObjectURL(event.target.files[0]);
                                output.onload = function() {
                                    URL.revokeObjectURL(output.src)
                                }
                            };
                        </script>
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
                                <input type="text" class="form-control is-invalid" name="name" id="productName" placeholder="Product Name" value="{{ old('name') }}">
                                <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                                @else
                                <input type="text" class="form-control" name="name" id="productName" placeholder="Product Name" value="{{ old('name') }}">
                                @endif
                            </div>
                            <link href='https://css.gg/arrow-left-r.css' rel='stylesheet'>
                            <div class="form-group">
                                <label class="font-weight-semibold" for="productPrice">Thuộc tầm giá</label>
                                <select class="custom-select" name="price_id" id="productCategory">
                                    @foreach ($prices as $price)
                                    <option value="{{ $price->id }}" selected>{{ $price->original }}
                                        => {{ $price->sale }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-semibold" for="productCategory">Menu</label>
                                <select class="custom-select" name="menu_id" id="productCategory">
                                    @foreach ($menus as $menu)
                                    <option value="{{ $menu->id }}" selected>{{ $menu->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-semibold" for="productBrand">Số lượng sản phẩm</label>
                                @if ($errors->first('quantity'))
                                <input type="text" placeholder="Quantity" name="quantity" value="{{ old('quantity') }}" class="form-control is-invalid" id="productBrand">
                                <div class="invalid-feedback">{{ $errors->first('quantity') }}</div>
                                @else
                                <input type="text" class="form-control" name="quantity" id="productName" placeholder="Quantity" value="{{ old('quantity') }}">
                                @endif
                            </div>
                            <div class="form-group">
                                <label class="font-weight-semibold" for="productBrand">Mô tả ngắn</label>
                                @if ($errors->first('content'))
                                <input type="text" placeholder="Content" name="content" value="{{ old('content') }}" class="form-control is-invalid" id="productBrand">
                                <div class="invalid-feedback">{{ $errors->first('content') }}</div>
                                @else
                                <input type="text" class="form-control" name="content" id="productName" placeholder="Content" value="{{ old('content') }}">
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
                            <textarea name="desc">{{ old('desc') }}</textarea>
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
                                        <img name="avatar" style="cursor: pointer; height: 85px; width: 100px" id="thumb" src="https://www.lifewire.com/thmb/blKERZhp27lzE_9SjqlnovU0v-s=/1768x1326/smart/filters:no_upscale()/cloud-upload-a30f385a928e44e199a62210d578375a.jpg" />
                                        <input id="files" type="file" name="image[]" style="display:none; cursor: pointer" multiple />
                                        <script>
                                            $(function() {
                                                $('#thumb').on('click', function() {
                                                    $('#files').trigger('click');
                                                });
                                            });
                                        </script>
                                        <style>
                                            input[type="file"] {
                                                display: block;
                                            }

                                            .imageThumb {

                                                max-height: 95px;
                                                padding: 1px;
                                                cursor: pointer;
                                            }

                                            .imageThumb:hover {
                                                max-height: 95px;
                                                padding: 1px;
                                                background-color: indianred;
                                            }

                                            .pip {
                                                display: inline-block;
                                                margin: 10px 10px 0 0;
                                            }

                                            .remove {
                                                margin-bottom: 60px;
                                                display: block;
                                                color: rgb(223, 30, 30);
                                                text-align: center;
                                                cursor: pointer;
                                            }

                                            .remove:hover {
                                                background: white;
                                                color: black;
                                            }
                                        </style>
                                        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
                                        <script>
                                            $(document).ready(function() {
                                                if (window.File && window.FileList && window.FileReader) {
                                                    $("#files").on("change", function(e) {
                                                        var files = e.target.files,
                                                            filesLength = files.length;
                                                        for (var i = 0; i < filesLength; i++) {
                                                            var f = files[i]
                                                            var fileReader = new FileReader();
                                                            fileReader.onload = (function(e) {
                                                                var file = e.target;

                                                                // Old code here
                                                                $("<img></img>", {
                                                                    class: "imageThumb",
                                                                    src: e.target.result,
                                                                    title: file.name + " | Click to remove"
                                                                }).insertAfter("#files").click(function() {
                                                                    $(this).remove();
                                                                    f = ''
                                                                });

                                                            });
                                                            fileReader.readAsDataURL(f);
                                                            console.log(f);
                                                        }

                                                    });
                                                }
                                            });
                                        </script>
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
    <script>
        $('#productName').change(function() {
            $('#outPut').html($(this).val());
        });
    </script>
</div>
@endsection