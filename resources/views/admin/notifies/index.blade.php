@extends('layouts.admin.admin-master')
@section('title', $title)
@section('content')
<div class="main-content">
    <div class="page-header">
        <h2 class="header-title">Blog List</h2>
        <div class="header-sub-title">
            <nav class="breadcrumb breadcrumb-dash">
                <a href="#" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>Home</a>
                <a class="breadcrumb-item" href="#">Pages</a>
                <span class="breadcrumb-item active">Blog List</span>
            </nav>
        </div>
    </div>
    <div class="container">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="avatar avatar-icon avatar-lg avatar-blue">
                            <i class="anticon anticon-dollar"></i>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <h4 class="m-b-10">You Should Know About Enlink</h4>
                        <div class="d-flex align-items-center m-t-5 m-b-15">
                            <div class="avatar avatar-image avatar-sm">
                                <!-- <img src="assets/images/avatars/thumb-2.jpg" alt=""> -->
                            </div>
                            <div class="m-l-10">
                                <span class="text-gray font-weight-semibold">Darryl Day</span>
                                <span class="m-h-5 text-gray">|</span>
                                <span class="text-gray">Jan 2, 2019</span>
                            </div>
                        </div>
                        <p class="m-b-20">Jelly-o sesame snaps halvah croissant oat cake cookie. Cheesecake bear claw topping. Chupa chups apple pie carrot cake chocolate cake caramels</p>
                        <div class="text-right">
                            <a class="btn btn-hover font-weight-semibold" href="blog-post.html">
                                <span>Read More</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <img class="img-fluid" src="assets/images/others/img-3.jpg" alt="">
                    </div>
                    <div class="col-md-8">
                        <h4 class="m-b-10">Enlink Has The Answer</h4>
                        <div class="d-flex align-items-center m-t-5 m-b-15">
                            <div class="avatar avatar-image avatar-sm">
                                <img src="assets/images/avatars/thumb-3.jpg" alt="">
                            </div>
                            <div class="m-l-10">
                                <span class="text-gray font-weight-semibold">Marshall Nichols</span>
                                <span class="m-h-5 text-gray">|</span>
                                <span class="text-gray">Jan 2, 2019</span>
                            </div>
                        </div>
                        <p class="m-b-20">Efficiently unleash cross-media information without cross-media value. Quickly maximize timely deliverables for real-time schemas. Dramatically maintain clicks-and-mortar.</p>
                        <div class="text-right">
                            <a class="btn btn-hover font-weight-semibold" href="blog-post.html">
                                <span>Read More</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <a href="" id="mark_all">Đánh dấu tất cả là đã đọc</a>
    </div>
    <main id="data-wrapper">
        <!-- <div class="notif_card unread">
            <div class="avatar avatar-volcano avatar-icon">
                <i class="anticon anticon-message"></i>
            </div>
            <div class="description">
                <a href="" class="user_activity">
                    <strong>Mark Webber</strong> reacted to your recent post
                    <b>My first tournament today!</b>
                </a>
                <p class="time">1m ago</p>
            </div>
        </div> -->
    </main>
    <div class="auto-load text-center">
        <svg version="1.1" id="L9" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" height="60" viewBox="0 0 100 100" enable-background="new 0 0 0 0" xml:space="preserve">
            <path fill="#000" d="M73,50c0-12.7-10.3-23-23-23S27,37.3,27,50 M30.9,50c0-10.5,8.5-19.1,19.1-19.1S69.1,39.5,69.1,50">
                <animateTransform attributeName="transform" attributeType="XML" type="rotate" dur="1s" from="0 50 50" to="360 50 50" repeatCount="indefinite" />
            </path>
        </svg>
    </div>
</div>
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    var ENDPOINT = "{{ url('/') }}";
    var page = 1;
    infinteLoadMore(page);
    $(window).scroll(function() {
        if ($(window).scrollTop() + $(window).height() >= $(document).height()) {
            page++;
            infinteLoadMore(page);
        }
    });

    function infinteLoadMore(page) {
        $.ajax({
                url: ENDPOINT + "/notifies?page=" + page,
                datatype: "html",
                type: "get",
                beforeSend: function() {
                    $('.auto-load').show();
                }
            })
            .done(function(response) {
                if (response.length == 0) {
                    $('.auto-load').html("Đã hiển thị hết thông báo");
                    return;
                }
                $('.auto-load').hide();
                $("#data-wrapper").append(response);
            })
            .fail(function(jqXHR, ajaxOptions, thrownError) {
                console.log('Server error occured');
            });
    }
</script>
