@extends('layouts.admin.admin-master')
@section('title', $title)
@section('content')
    <style>
        .error {
            border: 1px solid red;
        }
    </style>
    <div class="main-content">
        <form action="{{ route('menus.store') }}" method="POST">
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
                    <div class="card p-3">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-weight-semibold" for="menuName">Tên danh mục</label>
                                    <input type="text" class="form-control <?php echo $errors->first('name') ? 'is-invalid' : ''; ?>" id="menuName"
                                        name="name" placeholder="Nhập tên danh mục" value="{{ old('name') }}">
                                    @if ($errors->has('name'))
                                        <p class="text-danger">{{ $errors->first('name') }}</p>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="font-weight-semibold" for="menuParent">Danh mục</label>
                                    <select name="parent_id" class="form-control <?php echo $errors->first('parent_id') ? 'is-invalid' : ''; ?>" id="">
                                        <option value="0">Danh mục cha</option>
                                        @foreach ($menus as $menu)
                                            <option value="{{ $menu->id }}">{{ $menu->name }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('parent_id'))
                                        <p class="text-danger">{{ $errors->first('parent_id') }}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-weight-semibold" for="menuThumb">Ảnh danh mục</label>
                                    <input type="file" class="form-control <?php echo $errors->first('thumb') ? 'is-invalid' : ''; ?>" id="upload">
                                    <div id="image_show">
                                    </div>
                                    <input type="hidden" name="thumb" id="thumb">
                                    @if ($errors->has('thumb'))
                                        <p class="text-danger">{{ $errors->first('thumb') }}</p>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="font-weight-semibold" for="menuActive">Kích hoạt</label>
                                    <div class="custom-control custom-radio">
                                        <input class="custom-control-input <?php echo $errors->first('active') ? 'is-invalid' : ''; ?>" type="radio"
                                            id="active" value="0" name="active" checked="">
                                        <label for="active" class="custom-control-label">Có</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input class="custom-control-input <?php echo $errors->first('active') ? 'is-invalid' : ''; ?>" type="radio"
                                            id="no_active" value="1" name="active">
                                        <label for="no_active" class="custom-control-label">Không</label>
                                    </div>
                                    @if ($errors->has('active'))
                                        <p class="text-danger">{{ $errors->first('active') }}</p>
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
    <script>
        
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
@endsection
