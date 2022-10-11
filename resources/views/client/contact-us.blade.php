@extends('layouts.client.client-master')
@section('title-page', 'Contact us')
@section('content')
<div class="d-none">
    <div class="bg-primary border-bottom p-3 d-flex align-items-center">
        <h4 class="font-weight-bold m-0 text-white flex-fill">Contact</h4>
        <a class="toggle1 text-white" id="clickMenus"><span> <i class="feather-align-justify fs-30"></i></span></a>
    </div>
</div>
<!-- profile -->
<div class="container position-relative">
    <div class="py-5 osahan-profile row">
        {{-- <div class="col-md-4 mb-3">
            <div class="bg-white rounded shadow-sm sticky_sidebar overflow-hidden">
                <a href="profile.html" class="">
                    <div class="d-flex align-items-center p-3">
                        <div class="left mr-3">
                            <img alt="#" src="img/user1.jpg" class="rounded-circle">
                        </div>
                        <div class="right">
                            <h6 class="mb-1 font-weight-bold">Gurdeep Singh <i class="feather-check-circle text-success"></i></h6>
                            <p class="text-muted m-0 small">iamosahan@gmail.com</p>
                        </div>
                    </div>
                </a>
                <div class="osahan-credits d-flex align-items-center p-3 bg-light">
                    <p class="m-0">Accounts Credits</p>
                    <h5 class="m-0 ml-auto text-primary">$52.25</h5>
                </div>
                <!-- profile-details -->
                <div class="bg-white profile-details">
                    <a data-toggle="modal" data-target="#paycard" class="d-flex w-100 align-items-center border-bottom p-3">
                        <div class="left mr-3">
                            <h6 class="font-weight-bold mb-1 text-dark">Payment Cards</h6>
                            <p class="small text-muted m-0">Add a credit or debit card</p>
                        </div>
                        <div class="right ml-auto">
                            <h6 class="font-weight-bold m-0"><i class="feather-chevron-right"></i></h6>
                        </div>
                    </a>
                    <a data-toggle="modal" data-target="#exampleModal" class="d-flex w-100 align-items-center border-bottom p-3">
                        <div class="left mr-3">
                            <h6 class="font-weight-bold mb-1 text-dark">Address</h6>
                            <p class="small text-muted m-0">Add or remove a delivery address</p>
                        </div>
                        <div class="right ml-auto">
                            <h6 class="font-weight-bold m-0"><i class="feather-chevron-right"></i></h6>
                        </div>
                    </a>
                    <a class="d-flex align-items-center border-bottom p-3" data-toggle="modal" data-target="#inviteModal">
                        <div class="left mr-3">
                            <h6 class="font-weight-bold mb-1">Refer Friends</h6>
                            <p class="small text-primary m-0">Get $10.00 FREE</p>
                        </div>
                        <div class="right ml-auto">
                            <h6 class="font-weight-bold m-0"><i class="feather-chevron-right"></i></h6>
                        </div>
                    </a>
                    <a href="faq.html" class="d-flex w-100 align-items-center border-bottom px-3 py-4">
                        <div class="left mr-3">
                            <h6 class="font-weight-bold m-0 text-dark"><i class="feather-truck bg-danger text-white p-2 rounded-circle mr-2"></i> Delivery Support</h6>
                        </div>
                        <div class="right ml-auto">
                            <h6 class="font-weight-bold m-0"><i class="feather-chevron-right"></i></h6>
                        </div>
                    </a>
                    <a href="contact-us.html" class="d-flex w-100 align-items-center border-bottom px-3 py-4">
                        <div class="left mr-3">
                            <h6 class="font-weight-bold m-0 text-dark"><i class="feather-phone bg-primary text-white p-2 rounded-circle mr-2"></i> Contact</h6>
                        </div>
                        <div class="right ml-auto">
                            <h6 class="font-weight-bold m-0"><i class="feather-chevron-right"></i></h6>
                        </div>
                    </a>
                    <a href="terms.html" class="d-flex w-100 align-items-center border-bottom px-3 py-4">
                        <div class="left mr-3">
                            <h6 class="font-weight-bold m-0 text-dark"><i class="feather-info bg-success text-white p-2 rounded-circle mr-2"></i> Term of use</h6>
                        </div>
                        <div class="right ml-auto">
                            <h6 class="font-weight-bold m-0"><i class="feather-chevron-right"></i></h6>
                        </div>
                    </a>
                    <a href="privacy.html" class="d-flex w-100 align-items-center px-3 py-4">
                        <div class="left mr-3">
                            <h6 class="font-weight-bold m-0 text-dark"><i class="feather-lock bg-warning text-white p-2 rounded-circle mr-2"></i> Privacy policy</h6>
                        </div>
                        <div class="right ml-auto">
                            <h6 class="font-weight-bold m-0"><i class="feather-chevron-right"></i></h6>
                        </div>
                    </a>
                </div>
            </div>
        </div> --}}
        <div class="col-md-12 mb-3">
            <div class="rounded shadow-sm">
                <div class="osahan-cart-item-profile bg-white rounded shadow-sm p-4">
                    <div class="flex-column">
                        <h6 class="font-weight-bold">Liên hệ với chúng tôi</h6>
                        <p class="text-muted">Bạn có thắc mắc hay góp ý, hãy liên hệ với chúng tôi.</p>
                        <form>
                            <div class="form-group">
                                <label for="exampleFormControlInput1" class="small font-weight-bold">Tên của bạn</label>
                                <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Nguyễn Trung Hiếu">
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlInput2" class="small font-weight-bold">Email</label>
                                <input type="email" class="form-control" id="exampleFormControlInput2" placeholder="hieunt@gmail.com">
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlInput3" class="small font-weight-bold">Số điện thoại</label>
                                <input type="number" class="form-control" id="exampleFormControlInput3" placeholder="0123456789">
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1" class="small font-weight-bold">Chúng tôi có thể giúp gì cho bạn</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" placeholder="Nội dung ..." rows="3"></textarea>
                            </div>
                            <a class="btn btn-primary btn-block" href="#">Liên hệ</a>
                        </form>
                        <!-- Map -->
                        <div class="mapouter pt-3">
                            <div class="gmap_canvas">
                                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3723.8639810443356!2d105.74459841485445!3d21.03812778599324!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x313454b991d80fd5%3A0x53cefc99d6b0bf6f!2sFPT%20Polytechnic%20Hanoi!5e0!3m2!1sfr!2s!4v1665498762239!5m2!1sfr!2s" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Footer -->

@endsection