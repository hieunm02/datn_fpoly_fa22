@extends('layouts.admin.admin-master')
@section('title', $title)
@section('content')
<style>
    @import url("https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@500;800&display=swap");

    :root {
        --Red: hsl(1, 90%, 64%);
        --Blue: hsl(219, 85%, 26%);
        --White: hsl(0, 0%, 100%);
        --Very-light-grayish-blue: hsl(210, 60%, 98%);
        --Light-grayish-blue-1: hsl(211, 68%, 94%);
        --Light-grayish-blue-2: hsl(205, 33%, 90%);
        --Grayish-blue: hsl(219, 14%, 63%);
        --Dark-grayish-blue: hsl(219, 12%, 42%);
        --Very-dark-blue: hsl(224, 21%, 14%);
    }
    .header-noti {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 2rem;
    }

    .notif_box {
        display: flex;
        align-items: center;
    }

    #notifes {
        background-color: var(--Blue);
        margin-left: 0.5rem;
        width: 35px;
        display: flex;
        align-items: center;
        justify-content: center;
        height: 30px;
        color: var(--White);
        font-weight: 800;
        border-radius: 0.5rem;
    }

    #mark_all {
        cursor: pointer;
    }

    #mark_all:hover {
        color: var(--Blue);
    }

    p {
        color: var(--Dark-grayish-blue);
    }

    main {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .notif_card {
        display: flex;
        align-items: center;
        border-radius: 0.5rem;
        padding: 1rem;
        cursor: pointer;
    }
    .description {
        margin-left: 1rem;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .unread {
        background-color: var(--Light-grayish-blue-1) !important;
    }

    @media screen and (max-width:550px) {
        .container {
            margin: 0;
        }
    }
</style>
<div class="container" style="margin-top: 100px;">
    <div class="header-noti">
        <div class="notif_box">
            <h2 class="title">Thông báo</h2>
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
