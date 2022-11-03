@extends('layouts.admin.admin-master')
@section('title', $title)
@section('content')
<div class="main-content">
    <div class="row m-b-30">
        <div class="col-lg-7">
        </div>
        <div class="col-lg-5  text-right">
            <a class="btn btn-primary" href="#" onclick="randomCode()">Tạo mã code</a>
        </div>
    </div>
    <form action="{{ route('vouchers.store') }}" enctype="multipart/form-data" method="post">
        @csrf
        <div class="page-header no-gutters has-tab">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#product-edit-basic">Thông tin voucher</a>
                </li>
            </ul>
            <div class="tab-content m-t-15">
                <div class="tab-pane fade show active" id="product-edit-basic">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label class="font-weight-semibold" for="productName">Mã voucher</label>
                                <input type="text" class="form-control <?php echo $errors->first('code') ? 'is-invalid' : ''; ?>" id="code-voucher" name="code" placeholder="Mã" value="{{ old('code') }}">
                                @if ($errors->first('code'))
                                <div class="invalid-feedback">{{ $errors->first('code') }}</div>
                                @endif
                            </div>

                            <div class="form-group">
                                <label class="font-weight-semibold" for="productName">Thumbnail voucher</label>
                                <div class="custom-file">
                                    <input type="file" class="form-control custom-file-input <?php echo $errors->first('thumb') ? 'is-invalid' : ''; ?>" id="upload">
                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                    <input type="hidden" name="thumb" id="thumb">
                                </div>
                                @if ($errors->first('thumb'))
                                <div class="invalid-feedback">
                                    {{$errors->first('thumb')}}
                                </div>
                                @endif
                            </div>
                            <div id="image_show">
                            </div>

                            <div class="form-group">
                                <label class="font-weight-semibold" for="productName">Discount voucher</label>
                                <input type="number" class="form-control <?php echo $errors->first('discount') ? 'is-invalid' : ''; ?>" name="discount" placeholder="Discount" value="{{ old('discount') }}">
                                @if ($errors->first('discount'))
                                <div class="invalid-feedback">{{ $errors->first('discount') }}</div>
                                @endif
                            </div>

                            <div class="form-group">
                                <label class="font-weight-semibold" for="productName">Quantity voucher</label>
                                <input type="number" class="form-control <?php echo $errors->first('quantity') ? 'is-invalid' : ''; ?>" name="quantity" placeholder="Số lượng" value="{{ old('quantity') }}">
                                @if ($errors->first('quantity'))
                                <div class="invalid-feedback">{{ $errors->first('discount') }}</div>
                                @endif
                            </div>

                            <div class="form-group">
                                <label class="font-weight-semibold" for="productCategory">Menu</label>
                                <select class="custom-select" name="menu_id" id="productCategory">
                                    @foreach ($menus as $menu)
                                    <option value="{{$menu->id}}">{{$menu->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label class="font-weight-semibold" for="productName">Start time voucher</label>
                                <input type="datetime-local" class="form-control <?php echo $errors->first('start_time') ? 'is-invalid' : ''; ?>" name="start_time" placeholder="start_time" value="{{ old('start_time') }}">
                                @if ($errors->first('start_time'))
                                <div class="invalid-feedback">{{ $errors->first('start_time') }}</div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label class="font-weight-semibold" for="productName">End time voucher</label>
                                <input type="datetime-local" class="form-control <?php echo $errors->first('end_time') ? 'is-invalid' : ''; ?>" name="end_time" placeholder="end_time" value="{{ old('end_time') }}">
                                @if ($errors->first('end_time'))
                                <div class="invalid-feedback">{{ $errors->first('end_time') }}</div>
                                @endif
                            </div>


                            <div class="form-group">
                                <label class="font-weight-semibold" for="productName">Mô tả voucher</label>
                                <textarea id="description" name="description">{{ old('description') }}</textarea>
                                <script>
                                    CKEDITOR.replace('description');
                                </script>
                                @if ($errors->first('description'))
                                <div class="invalid-feedback">{{ $errors->first('description') }}</div>
                                @endif
                            </div>

                            <div class="form-group">
                                <label class="font-weight-semibold" for="menuActive">Kích hoạt</label>
                                <div class="custom-control custom-radio">
                                    <input class="custom-control-input <?php echo $errors->first('active') ? 'is-invalid' : ''; ?>" type="radio" id="active" value="0" name="active" checked="">
                                    <label for="active" class="custom-control-label">Có</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input class="custom-control-input <?php echo $errors->first('active') ? 'is-invalid' : ''; ?>" type="radio" id="no_active" value="1" name="active">
                                    <label for="no_active" class="custom-control-label">Không</label>
                                </div>
                                @if ($errors->has('active'))
                                <p class="text-danger">{{ $errors->first('active') }}</p>
                                @endif
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