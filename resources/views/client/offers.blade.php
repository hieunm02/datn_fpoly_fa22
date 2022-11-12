@extends('layouts.client.client-master')
@section('title-page', 'Offers')
@section('content')
<div class="d-none">
    <div class="bg-primary p-3 d-flex align-items-center">
        <h4 class="font-weight-bold m-0 text-white flex-fill">Offer</h4>
        <a class="toggle1 text-white" id="clickMenus"><span> <i class="feather-align-justify fs-30"></i></span></a>
    </div>
</div>
<div class="offer-section">
    <div class="container">
        <div class="py-5 d-flex align-items-center">
            <div>
                <h2 class="text-white">Offers for you</h2>
                <p class="h6 text-white">Explore top deals and offers exclusively for you!</p>
            </div>
            <div class="ml-auto"><img alt="#" src="img/offers.png" class="img-fluid offers_img"></div>
        </div>
    </div>
</div>
<!-- Tabs -->
<div class="bg-white shadow-sm">
    <div class="container">
        <div class="bg-white">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="px-0 py-3 nav-link text-dark h6 border-0 mb-0 active" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Voucher của bạn</a>
                </li>
                <li class="nav-item bottom-tab" role="presentation">
                    <a class="px-0 py-3 nav-link text-dark h6 border-0 mb-0 ml-3" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Voucher của website</a>
                </li>
            </ul>
        </div>
    </div>
</div>
<div class="container">
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade py-4" id="home" role="tabpanel" aria-labelledby="home-tab">
            <h5 class="mb-3 mt-0">Voucher sẵn có</h5>
            <div class="row justify-content-center">
                @if(count($publicVouchers) > 0)
                @foreach($publicVouchers as $publicVoucher)
                <?php
                $diff = abs(strtotime($publicVoucher->end_time) - strtotime($publicVoucher->start_time));
                $years = floor($diff / (365 * 60 * 60 * 24));
                $months = floor(($diff - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
                $days = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));
                $hours = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24) / (60 * 60));
                $minutes = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24 - $hours * 60 * 60) / 60);
                ?>
                <div class="col-md-4 mb-3">
                    <div class="bg-white shadow-sm rounded p-4">
                        <p class="h6 mb-3"><span class="feather-tag text-primary"></span><span id="p{{$publicVoucher->id}}" class="ml-3">{{$publicVoucher->code}}</span></p>
                        <p class="font-weight-bold mb-2">{!!$publicVoucher->description!!}</p>
                        <p class="mb-4 expire">Hạn sử dụng còn: {{$days}} ngày {{$hours}} giờ {{$minutes}} phút</p>
                        <a href="javascrip:void(0)" class="btn btn-outline-primary" onclick="copyToClipboard('#p{{$publicVoucher->id}}')">COPY CODE</a>
                    </div>
                </div>
                @endforeach
                @else
                <div class="my-3">
                    <h1 class="text-danger">Chưa có voucher nào</h1>
                </div>
                @endif
            </div>
        </div>




        <div class="tab-pane fade show active py-4" style="background-color: #f5f5f5;" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            <h5 class="mb-3 mt-0">Voucher sẵn có</h5>
            <div class="row">
                @foreach($privateVouchers as $privateVoucher)
                <div class="col-md-4 mb-3">
                    <div class="bg-white shadow-sm rounded p-4">
                        <p class="h6 mb-3"><span class="feather-tag text-primary"></span><span id="p{{$privateVoucher->id}}" class="ml-3">{{$privateVoucher->code}}</span></p>
                        <p class="font-weight-bold mb-2">{!!$privateVoucher->description!!}</p>
                        <p class="mb-4">Hạn sử dụng: vĩnh viễn</p>
                        <!-- <p><a href="#" class="text-primary">+ MORE</a></p> -->
                        <a href="javascrip:void(0)" class="btn btn-outline-primary" onclick="copyToClipboard('#p{{$privateVoucher->id}}')">COPY CODE</a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<script>
    function copyToClipboard(element) {
        var $temp = $("<input>");
        $("body").append($temp);
        $temp.val($(element).text()).select();
        document.execCommand("copy");
        $temp.remove();
    }
</script>
@endsection