@extends('layouts.admin.admin-master')
@section('title', $title)
@section('content')
    <div class="main-content">
        <form action="{{route('menus.store')}}" method="POST">
            @csrf
            <div class="page-header no-gutters has-tab">
                <div class="d-md-flex m-b-15 align-items-center justify-content-between">
   
                    <div class="m-b-15">
                        <button type="submit" class="btn btn-primary">
                            <i class="anticon anticon-save"></i>
                            <span>Save</span>
                        </button>
                    </div>
                </div>
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#product-edit-basic">Thông tin danh mục</a>
                    </li>
                </ul>
            </div>
            <div class="tab-content m-t-15">
                <div class="tab-pane fade show active" id="product-edit-basic">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label class="font-weight-semibold" for="menuName">Tên danh mục</label>
                                <input type="text" class="form-control" id="menuName" name="name" placeholder="Nhập tên danh mục"
                                       value="">
                            </div>
                            <div class="form-group">
                                <label class="font-weight-semibold" for="menuParent">Danh mục</label>
                                <select name="parent_id" class="form-control" id="">
                                    <option value="0">Danh mục cha</option>
                                    @foreach ($menus as $menu)
                                    <option value="{{$menu->id}}">{{$menu->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-semibold" for="menuThumb">Ảnh danh mục</label>
                                <input type="file"  class="form-control" id="upload">
                                <div id="image_show">
                                </div>
                                <input type="hidden" name="thumb"  id="thumb">
                            </div>
                            <div class="form-group">
                                <label class="font-weight-semibold" for="menuActive">Kích hoạt</label>
                                <div class="custom-control custom-radio">
                                    <input class="custom-control-input" type="radio" id="active" value="0" name="active" checked="">
                                    <label for="active" class="custom-control-label">Có</label>
                                  </div>
                                  <div class="custom-control custom-radio">
                                    <input class="custom-control-input" type="radio" id="no_active" value="1" name="active" >
                                    <label for="no_active" class="custom-control-label">Không</label>
                                  </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
@endsection
