@extends('layouts.admin.admin-master')
@section('title', $title)
@section('content')

    <div class="main-content">
        <div class="card">
            <div class="card-body">
                <div class="page-header">
                    <h2 class="header-title">{{ $title }}</h2>
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
                    </div>
                    <div class="tab-content m-t-15">
                        <div class="tab-pane fade show active" id="product-edit-basic">
                            <div class="card">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label class="font-weight-semibold" for="optionName">Name</label>
                                        <input type="text" name="name" class="form-control <?php echo $errors->first('name') ? 'is-invalid' : ''; ?>"
                                            id="optionName" placeholder="Option name" value="{{ old('name') }}">
                                        @if ($errors->first('name'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('name') }}
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
