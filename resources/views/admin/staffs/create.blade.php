@extends('layouts.admin.admin-master')
@section('title', $title)
@section('content')

    <div class="main-content">
        <div class="card">
            <div class="card-body">
                <div class="page-header">
                    <h2 class="header-title">Thêm nhân viên mới</h2>
                </div>
                <form action="{{ route('staffs.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="page-header no-gutters has-tab">
                        <div class="d-md-flex m-b-15 align-items-center justify-content-between">
                            <div class="media align-items-center m-b-15">
                                <div class="avatar avatar-image rounded" style="height: 70px; width: 70px">
                                    <div id="image_show"></div>
                                </div>
                                <div class="m-l-15">
                                    <p class="text-muted m-b-0" id="name-thumbnail"></p>
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
                                <a class="nav-link active" data-toggle="tab"
                                    href="#product-edit-basic">{{ $title }}</a>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-content m-t-15">
                        <div class="tab-pane fade show active" id="product-edit-basic">
                            <div class="card">
                                <div class="card-body">
                                    <div class="form-group">
                                        <div class="custom-file">
                                            <input type="file" class="form-control custom-file-input <?php echo $errors->first('image_path') ? 'is-invalid' : ''; ?>"
                                                id="upload">
                                            <label class="custom-file-label" for="customFile">Choose file</label>
                                            <input type="hidden" name="image_path" id="thumb">
                                        </div>
                                        @if ($errors->first('image_path'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('image_path') }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-semibold" for="staffName">Name</label>
                                        <input type="text" name="name" class="form-control <?php echo $errors->first('name') ? 'is-invalid' : ''; ?>"
                                            id="staffName" placeholder="Staff name" value="{{ old('name') }}">
                                        @if ($errors->first('name'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('name') }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-semibold" for="staffphone">Phone number</label>
                                        <input type="text" name="phone" class="form-control <?php echo $errors->first('phone') ? 'is-invalid' : ''; ?>"
                                            id="staffphone" placeholder="Staff phone" value="{{ old('phone') }}">
                                        @if ($errors->first('phone'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('phone') }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-semibold" for="staffEmail">Email</label>
                                        <input type="text" name="email" class="form-control <?php echo $errors->first('title') ? 'is-invalid' : ''; ?>"
                                            id="staffEmail" placeholder="Staff email" value="{{ old('email') }}">
                                        @if ($errors->first('email'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('email') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
