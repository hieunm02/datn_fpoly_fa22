@extends('layouts.admin.admin-master')
@section('title', $title)
@section('content')
<div class="main-content">
    <form action="{{route('news.update',$news->id)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="page-header no-gutters has-tab">
            <div class="d-md-flex m-b-15 align-items-center justify-content-between">
                <div class="media align-items-center m-b-15">
                    <div class="avatar avatar-image rounded" style="height: 70px; width: 70px">
                        <div>
                            <img src="{{$news->image_path}}" alt="">
                        </div>
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
                    <a class="nav-link active" data-toggle="tab" href="#product-edit-basic">Chi tiết tin tức</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#product-edit-description">Nội dung</a>
                </li>
            </ul>
        </div>
        <div class="tab-content m-t-15">
            <div class="tab-pane fade show active" id="product-edit-basic">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <div class="custom-file">
                                <input type="file" class="form-control custom-file-input <?php echo $errors->first('image_path') ? 'is-invalid' : ''; ?>" id="upload">
                                <label class="custom-file-label" for="customFile">Chọn ảnh</label>
                                <input type="hidden" name="image_path" id="thumb">
                            </div>
                            @if ($errors->first('image_path'))
                            <div class="invalid-feedback">
                                {{$errors->first('image_path')}}
                            </div>
                            @endif
                        </div>
                        <div id="image_show"></div>
                        <div class="form-group">
                            <label class="font-weight-semibold" for="titleNews">Tiêu đề</label>
                            <input type="text" name="title" class="form-control <?php echo $errors->first('title') ? 'is-invalid' : ''; ?>" id="titleNews" placeholder="News title" value="{{$news->title}}">
                            @if ($errors->first('title'))
                            <div class="invalid-feedback">
                                {{$errors->first('title')}}
                            </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label class="font-weight-semibold" for="short_desc">Mô tả ngắn</label>
                            <textarea name="short_desc">{{$news->short_desc}}</textarea>
                            <script>
                                CKEDITOR.replace('short_desc');
                            </script>
                            @if ($errors->first('short_desc'))
                            <div class="invalid-feedback">
                                {{$errors->first('short_desc')}}
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="product-edit-description">
                <div class="form-group">
                    <label class="font-weight-semibold" for="content">Nội dung</label>
                    <textarea name="content">{{$news->content}}</textarea>
                    <script>
                        CKEDITOR.replace('content');
                    </script>
                    @if ($errors->first('content'))
                    <div class="invalid-feedback">
                        {{$errors->first('content')}}
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
