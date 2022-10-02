@extends('layouts.admin.admin-master')
@section('title', ' Edit Products')
@section('content')
    <div class="main-content">
        <form>
            <div class="page-header no-gutters has-tab">
                <div class="d-md-flex m-b-15 align-items-center justify-content-between">
                    <div class="media align-items-center m-b-15">
                        <div class="avatar avatar-image rounded" style="height: 70px; width: 70px">
                            <img src="" alt="">
                        </div>
                        <div class="m-l-15">
                            <h4 class="m-b-0" id="outPut"></h4>
                            <p class="text-muted m-b-0">Code: #5325</p>
                        </div>
                    </div>
                    <div class="m-b-15">
                        <button class="btn btn-primary">
                            <i class="anticon anticon-save"></i>
                            <span>Save</span>
                        </button>
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
                                <input type="text" class="form-control" id="productName" placeholder="Product Name"
                                       value="">
                            </div>
                            <div class="form-group">
                                <label class="font-weight-semibold" for="productPrice">Price</label>
                                <select class="custom-select" id="productCategory">
                                    <option value="cloths" selected>Cloths</option>
                                    <option value="homeDecoration">Home Decoration</option>
                                    <option value="eletronic">Eletronic</option>
                                    <option value="jewellery">Jewellery</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-semibold" for="productCategory">Menu</label>
                                <select class="custom-select" id="productCategory">
                                    <option value="cloths" selected>12.000 --> 11.000</option>
                                    <option value="cloths">13.000 --> 11.000</option>
                                    <option value="cloths">15.000 --> 11.000</option>

                                </select>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-semibold" for="productBrand">Content</label>
                                <input type="text" class="form-control" id="productBrand" placeholder="Brand"
                                       value="H&M">
                            </div>
                            <div class="form-group">
                                <label class="font-weight-semibold" for="productStatus">Status</label>
                                <select class="custom-select" id="productStatus">
                                    <option value="inStock" selected>In Stock</option>
                                    <option value="outOfStock">Out of Stock</option>
                                    <option value="pending">Pending</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="product-edit-description">
                    <div class="card">
                        <div class="card-body">
                            <textarea name="editor1"></textarea>
                            <script>
                                CKEDITOR.replace('editor1');
                            </script>

                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

    <script>
        $('#productName').change(function () {
            $('#outPut').html($(this).val());
        });
    </script>
@endsection
