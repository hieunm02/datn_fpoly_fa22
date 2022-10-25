@extends('layouts.admin.admin-master')
@section('title', $title ?? '')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/address/building.css') }}">

    <div class="main-content">
        <form action="" enctype="multipart/form-data" method="POST">
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
                            <div class="col-md-4">
                                <div class="form-group group-building">
                                    <label class="font-weight-semibold" for="name_building">Tên Tòa</label>
                                    <input type="text" class="form-control <?php echo $errors->first('name_building') ? 'is-invalid' : ''; ?>" id="menuName"
                                        name="name_building" placeholder="Nhập tên tòa" value="{{ old('name_building') }}">
                                    @if ($errors->has('name_building'))
                                        <p class="text-danger">{{ $errors->first('name_building') }}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="field_wrapper">
                                    <div>
                                        <input type="text" name="field_name[]" value="" />
                                        <a href="javascript:void(0);" class="add_button" title="Add field"><img
                                                src="https://findicons.com/files/icons/986/aeon/256/add.png" /></a>
                                    </div>
                                </div>
                                <div class="form-group group-floor">
                                    <label class="font-weight-semibold" for="name_floor">Tên Tầng</label>
                                    <input type="text" class="form-control <?php echo $errors->first('name') ? 'is-invalid' : ''; ?>" id="menuName"
                                        name="name_floor" placeholder="Nhập tên tầng" value="{{ old('name_floor') }}">
                                    @if ($errors->has('name_floor'))
                                        <p class="text-danger">{{ $errors->first('name_floor') }}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="font-weight-semibold" for="name_room">Tên Phòng</label>
                                    <input type="text" class="form-control <?php echo $errors->first('name_room') ? 'is-invalid' : ''; ?>" id="menuName"
                                        name="name_room" placeholder="Nhập tên slide" value="{{ old('name_room') }}">
                                    @if ($errors->has('name_room'))
                                        <p class="text-danger">{{ $errors->first('name_room') }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <script src="{{ asset('js/handleGeneral/address/building.js') }}"></script>
    </div>
@endsection
