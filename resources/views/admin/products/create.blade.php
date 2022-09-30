@extends('layouts.admin.admin-master')
@section('title', ' Create Products')
@section('content')
    <div class="main-content">
        <form action="{{route('products.store')}}" enctype="multipart/form-data" method="post">
            @csrf
            <div class="page-header no-gutters has-tab">
                <div class="d-md-flex m-b-15 align-items-center justify-content-between">
                    <div class="media align-items-center m-b-15">
                        <div class="avatar avatar-image rounded" style="height: 75px; width: 75px">
                            <img name="avatar" style="cursor: pointer" id="avatar"
                                 src="https://play-lh.googleusercontent.com/NuJSG_bIoce6kvvtJnULAf34_Rsa1j-HDEt4MWTOrL_3XA51QH9qOQR5UmAYxPI96jA"/>
                            <input id="fileinput" onchange="loadFile(event)" type="file" name="thumb"
                                   style="display:none; cursor: pointer"/>
                            <script type="text/JavaScript"
                                    src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js">
                            </script>
                            <script>
                                $(function () {
                                    $('#avatar').on('click', function () {
                                        $('#fileinput').trigger('click');
                                    });
                                });
                                var loadFile = function (event) {
                                    var output = document.querySelector('#avatar');
                                    console.log(output);
                                    output.src = URL.createObjectURL(event.target.files[0]);
                                    output.onload = function () {
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
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#product-edit-basic">Product Info</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#product-edit-description">Description</a>
                    </li>
                </ul>
            </div>
            <div class="tab-content m-t-15">
                <div class="tab-pane fade show active" id="product-edit-basic">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label class="font-weight-semibold" for="productName">Product Name</label>

                                @if ($errors->first('name'))
                                    <input type="text" class="form-control is-invalid" name="name" id="productName"
                                           placeholder="Product Name"
                                           value="{{ old('name') }}">
                                    <div class="invalid-feedback">{{$errors->first('name')}}</div>
                                @else
                                    <input type="text" class="form-control" name="name" id="productName"
                                           placeholder="Product Name"
                                           value="{{ old('name') }}">
                                @endif
                            </div>
                            <link href='https://css.gg/arrow-left-r.css' rel='stylesheet'>
                            <div class="form-group">
                                <label class="font-weight-semibold" for="productPrice">Price</label>
                                <select class="custom-select" name="price_id" id="productCategory">
                                    @foreach($prices as $price)
                                        <option value="{{$price->id}}" selected>{{$price->original}}
                                            => {{$price->sale}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-semibold" for="productCategory">Menu</label>
                                <select class="custom-select" name="menu_id" id="productCategory">
                                    @foreach($menus as $menu)
                                        <option value="{{$menu->id}}" selected>{{$menu->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-semibold" for="productBrand">Content</label>
                                @if ($errors->first('content'))
                                    <input type="text" placeholder="Content" name="content" value="{{ old('content') }}"
                                           class="form-control is-invalid" id="productBrand">
                                    <div class="invalid-feedback">{{$errors->first('content')}}</div>
                                @else
                                    <input type="text" class="form-control" name="content" id="productName"
                                           placeholder="Content"
                                           value="{{ old('content') }}">
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
                                <div class="invalid-feedback">{{$errors->first('desc')}}</div>
                            @else
                                <textarea name="desc">{{ old('desc') }}</textarea>
                                <div class="invalid-feedback">{{$errors->first('desc')}}</div>
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
{{--                                        <img name="avatar" style="cursor: pointer; height: 75px; width: 75px" id="thumb"--}}
{{--                                             src="https://cdn0.iconfinder.com/data/icons/Folder_Icons_akkasone/256/Pictures-Folder-Icon.png"/>--}}
{{--                                        <input id="imageinput" type="file" name="image[]"--}}
{{--                                               style="display:none; cursor: pointer" multiple/>--}}
{{--                                        <script>--}}
{{--                                            $(function () {--}}
{{--                                                $('#thumb').on('click', function () {--}}
{{--                                                    $('#imageinput').trigger('click');--}}
{{--                                                });--}}
{{--                                            });--}}
{{--                                        </script>--}}
                                        <style>
                                            input[type="file"] {
                                                display: block;
                                            }

                                            .imageThumb {
                                                max-height: 75px;
                                                padding: 1px;
                                                cursor: pointer;
                                            }

                                            .imageThumb:hover {
                                                max-height: 75px;
                                                padding: 1px;
                                                background-color: red;
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
                                        <script
                                            src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
                                        <div class="field" align="left">
                                            <input type="file" id="files" name="files[]" multiple/>
                                        </div>
                                        <script>
                                            $(document).ready(function () {
                                                if (window.File && window.FileList && window.FileReader) {
                                                    $("#files").on("change", function (e) {
                                                        var files = e.target.files,
                                                            filesLength = files.length;
                                                        for (var i = 0; i < filesLength; i++) {
                                                            var f = files[i]
                                                            var fileReader = new FileReader();
                                                            fileReader.onload = (function (e) {
                                                                var file = e.target;

                                                                // Old code here
                                                                $("<img></img>", {
                                                                    class: "imageThumb",
                                                                    src: e.target.result,
                                                                    title: file.name + " | Click to remove"
                                                                }).insertAfter("#files").click(function () {
                                                                    $(this).remove();
                                                                    f = ''
                                                                });

                                                            });
                                                            fileReader.readAsDataURL(f);
                                                            console.log(f);
                                                        }

                                                    });
                                                } else {
                                                    alert("Your browser doesn't support to File API")
                                                }
                                            });
                                        </script>
                                    </div>
                                    <div>
                                        <h6 class="mb-0">Image Detail</h6>
                                        <span class="font-size-13 text-muted">60MB</span>
                                    </div>

                                </div>
                            </div>
                            <div class="gallery">
                            </div>
                            <style>
                                .closeBtn:hover {
                                    color: red;
                                    display: inline-block;
                                }

                                .gallery {
                                    margin-bottom: 59px;
                                }

                                .gallery img {
                                    margin: 107px 7px -1px -8px;
                                    height: 105px;
                                    width: 126px;
                                }
                            </style>
                        </div>
                    </div>
                </div>

            </div>
            <div class="m-b-15">
                <button type="submit" class="btn btn-primary">
                    <i class="anticon anticon-save"></i>
                    <span>Save</span>
                </button>
            </div>
        </form>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script>
        $('#productName').change(function () {
            $('#outPut').html($(this).val());
            console.log($(this).val())
        });
    </script>
@endsection
