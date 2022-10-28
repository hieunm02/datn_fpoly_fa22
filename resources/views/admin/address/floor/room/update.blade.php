@extends('layouts.admin.admin-master')
@section('title', $title ?? '')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/address/building.css') }}">

    <div class="main-content">
        <form action="{{ route('room.update', $room->id) }}" enctype="multipart/form-data" method="POST">
            @csrf
            @method('PUT')
            <div class="page-header no-gutters has-tab">
                <div class="d-md-flex m-b-15 align-items-center justify-content-between">
                    <div class="m-b-15">
                        <button type="submit" class="btn btn-primary submit_form">
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
                                        placeholder="Nhập tên tòa" value="{{ $room->building->name }}" disabled>
                                    <input type="hidden" name="building_id" value="{{ $room->building->id }}">
                                </div>
                                <div class="form-group">
                                    <label class="font-weight-semibold" for="">Tên Tầng</label>
                                    <input type="text" class="form-control" name="floor_name" placeholder="Nhập tên tầng"
                                        value="{{ $room->floor->name }}" disabled>
                                    <input type="hidden" name="floor_id" value="{{ $room->floor->id }}">
                                </div>
                                <div class="form-group ">
                                    <label class="font-weight-semibold " for="name">Tên phòng</label>
                                    <input type="text"
                                        class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" id="name_floor"
                                        value="{{ $room->name }}" name="name" placeholder="Nhập tên phòng">
                                    <p class="text-danger log_error">
                                        @error('name')
                                            {{ $message }}
                                        @enderror
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
