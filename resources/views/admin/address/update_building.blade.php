@extends('layouts.admin.admin-master')
@section('title', $title)
@section('content')
    <style>
        .error {
            border: 1px solid red;
        }
    </style>
    <div class="main-content">
        <form action="{{ route('building.update', $building->id) }}" enctype="multipart/form-data" method="POST">
            @csrf
            @method('PUT')
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
                                <div class="form-group floor_group ">
                                    <label class="font-weight-semibold " for="name">Tên Tòa</label>
                                    <div class="floor_input ip_group">
                                        <input type="text"
                                            class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                            value="{{ $building->name }}" name="name" placeholder="Nhập tên tòa">
                                    </div>
                                    @error('name')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
