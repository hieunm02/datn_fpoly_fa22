@extends('layouts.admin.admin-master')
@section('title', $title)
@section('content')
    <style>
        .error {
            border: 1px solid red;
        }
    </style>
    <div class="main-content">
        <form action="{{ route('slides.store') }}" enctype="multipart/form-data" method="POST">
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
            </div>
            <div class="tab-content m-t-15">
                <div class="tab-pane fade show active" id="product-edit-basic">
                    <div class="card">
                        <div class="card-body row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-weight-semibold" for="name">Tên slide</label>
                                    <input type="text" class="form-control <?php echo $errors->first('name') ? 'is-invalid' : ''; ?>" id="menuName"
                                        name="name" placeholder="Nhập tên slide" value="{{ old('name') }}">
                                    @if ($errors->has('name'))
                                        <p class="text-danger">{{ $errors->first('name') }}</p>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="font-weight-semibold" for="product_id">Sản phẩm</label>
                                    <select name="product_id" class="form-control <?php echo $errors->first('product_id') ? 'is-invalid' : ''; ?>" id="">
                                        <option value="">Tất cả sản phẩm</option>
                                        @foreach ($products as $product)
                                            <option value="{{ $product->id }}">{{ $product->name }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('product_id'))
                                        <p class="text-danger">{{ $errors->first('product_id') }}</p>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="font-weight-semibold " for="">Trạng thái</label> <br>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="active" id="inlineRadio1"
                                            value="0" checked>
                                        <label class="form-check-label" for="inlineRadio1">Kích hoạt</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="active" id="inlineRadio2"
                                            value="1">
                                        <label class="form-check-label" for="inlineRadio2">Không kích hoạt</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-weight-semibold" for="">Ảnh slide </label>
                                    <div class="media align-items-center m-b-15">
                                        <div class="avatar avatar-image rounded" style="height: 100px; width:100px">
                                            <img name="avatar" data-toggle="tooltip" data-placement="top"
                                                title="Tải lên Ảnh slides" style="cursor: pointer" id="avatar"
                                                src="https://a3sharing.com/images/sections/upload.png" />
                                            <input id="fileinput" type="file"
                                                name="thumb" style="display:none; cursor: pointer" />
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
                                                $('#fileinput').on('change', function(e){
                                                    var files = e.target.files
                                                    let ftype = files[0].type;
                                                    let fsize = files[0].size;
                                                    switch (ftype) {
                                                        case 'image/png':
                                                        case 'image/jpg':
                                                        case 'image/jpeg':
                                                            if (fsize < 10485760){
                                                                loadFile(e);
                                                            } else {
                                                                alert('Ảnh quá dung lượng cho phép')
                                                            }
                                                            break;
                                                        default:
                                                            alert('Ảnh không đúng định dạng');
                                                            break;
                                                    }
                                                })

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
                                                @error('thumb')
                                                <p class="text-danger">
                                                    {{ $message }}
                                                </p>
                                                @enderror
                                        <div class="alert-error">
                                            @if (session('thumb_error'))
                                                <span class="text-danger">{{ session('thumb_error') }}</span>
                                            @endif
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
@endsection
