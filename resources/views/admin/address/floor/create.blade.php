@extends('layouts.admin.admin-master')
@section('title', $title ?? '')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/address/building.css') }}">

    <div class="main-content">
        <form action="{{ route('floor.store') }}" enctype="multipart/form-data" method="POST">
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
                                    <label class="font-weight-semibold" for="">Tên Tòa</label>
                                    <input type="text" class="form-control" name="building_name"
                                        placeholder="Nhập tên tòa" value="{{ $building->name }}" disabled>
                                    <input type="hidden" name="building_id" value="{{ $building->id }}">
                                </div>
                                <div class="form-group floor_group ">
                                    <label class="font-weight-semibold " for="name_floor">Tên Tầng</label>
                                    <div class="floor_input ip_group">
                                        <input type="text"
                                            class="form-control {{ $errors->has('name_floor_hd') ? 'is-invalid' : '' }}"
                                            id="name_floor" name="name_floor" placeholder="Nhập tên tầng"
                                            value="{{ old('name_floor') }}">
                                        <input type="hidden" name="name_floor_hd">
                                        <a class="add_room" title="Thêm Phòng"><img
                                                src="{{ asset('/assets/images/others/icon-add.png') }}" /></a>
                                    </div>
                                    @error('name_floor_hd')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group room_group">
                                    <label class="font-weight-semibold label_floor" for="name_room"></label>
                                    <div class="room_input ip_group">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <script src="{{ asset('js/handleGeneral/address/floor.js') }}"></script>
    </div>
@endsection
