@extends('layouts.client.client-master')
@section('title-page', $news->title)
@section('content')
    <div class="d-none">
        <div class="bg-primary border-bottom p-3 d-flex align-items-center">
            <h4 class="font-weight-bold m-0 text-white flex-fill">BeeFood</h4>
            <a class="toggle1 text-white" id="clickMenus"><span> <i class="feather-align-justify fs-30"></i></span></a>
        </div>
    </div>
    <!-- Most popular -->
    <div class="container most_popular py-5">
        <div class="col-md-12 p-0">
            <h2 class="font-weight-bolder">{{ $news->title }}</h2>
            <p>
                <span class="badge badge-secondary"><i class="feather-user"></i>
                    @foreach ($authors as $auth)
                        @if ($news->user_id == $auth->id)
                            {{ $auth->name }}
                        @endif
                    @endforeach
                </span>
                <span class="badge"><i class="feather-calendar p-1"></i> {{ $news->created_at->format('d-m-Y') }}</span>
            </p>
            <p>
                {!! $news->content !!}
            </p>
        </div>
        <h3 class="font-weight-bold my-3 text-center">Các bài viết khác</h3>
        @foreach($newsAll as $new)
        <div class="row">
            <div class="col-md-3 mb-3">
                <div class="list-card bg-white h-100 rounded overflow-hidden position-relative shadow-sm grid-card">
                    <div class="list-card-image">
                        <div class="star position-absolute"></div>
                        <div class="member-plan position-absolute"><span class="badge badge-dark">News</span></div>
                        <a href="{{ route('news-detail', $new->id) }}">
                            <img alt="#" src="{{asset($new->image_path)}}" class="img-fluid item-img w-100">
                        </a>
                    </div>
                    <div class="p-3 position-relative">
                        <div class="list-card-body">
                            <h6 class="mb-1"><a href="{{ route('news-detail', $new->id) }}" class="text-black">{{$new->title}}
                                </a>
                            </h6>
                            <p class="mb-3 newsHide"></p>
                            <p class="text-gray mb-3 time"><span class="badge badge-secondary"><i class="feather-user"></i>
                                @foreach ($authors as $auth)
                                    @if ($news->user_id == $auth->id)
                                        {{ $auth->name }}
                                    @endif
                                @endforeach
                            </span>
                        </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    </div>
    @endsection