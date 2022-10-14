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
            <div class="col-md-6 mb-3">
                <div class="rounded shadow-sm">
                    <div class="osahan-cart-item-profile bg-white rounded shadow-sm p-4">
                        <div class="flex-column">
                            <div class="col-md-12 p-0 pb-2">
                                @if (session()->has('success'))
                                    <p id="setout" class="text-white alert bg-success m-0">
                                        {{ session()->get('success') }}
                                    </p>
                                @endif
                            </div>
                            <h6 class="font-weight-bold">Liên hệ với chúng tôi</h6>
                            <p class="text-muted">Bạn có thắc mắc hay góp ý, hãy liên hệ với chúng tôi.</p>
                            <form action="" method="POST">
                                @csrf
                                <div class="col-md-12 p-0 row m-0">
                                    <div class="form-group col-md-6 p-0 pr-1">
                                        <label for="exampleFormControlInput1" class="small font-weight-bold">Tên của bạn</label>
                                        <input type="text" class="form-control <?php echo $errors->first('name') ? 'is-invalid': '' ?>" id="exampleFormControlInput1" value="{{ old('name') }}" name="name"
                                            placeholder="Nguyễn Trung Hiếu" >
                                        @if ($errors->has('name'))
                                            <p class="text-danger m-0">{{ $errors->first('name') }}</p>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-6 p-0 pl-1">
                                        <label for="exampleFormControlInput3" class="small font-weight-bold">Số điện
                                            thoại</label>
                                        <input type="number" class="form-control  <?php echo $errors->first('phone') ? 'is-invalid': '' ?>" id="exampleFormControlInput3" value="{{ old('phone') }}" name="phone"
                                            placeholder="0123456789">
                                            @if ($errors->has('phone'))
                                            <p class="text-danger m-0">{{ $errors->first('phone') }}</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlInput2" class="small font-weight-bold">Email</label>
                                    <input type="email" class="form-control  <?php echo $errors->first('email') ? 'is-invalid': '' ?>" id="exampleFormControlInput2" value="{{ old('email') }}" name="email"
                                        placeholder="hieunt@gmail.com">
                                        @if ($errors->has('email'))
                                        <p class="text-danger">{{ $errors->first('email') }}</p>
                                    @endif
                                </div>
                                
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1" class="small font-weight-bold">Chúng tôi có thể
                                        giúp gì cho bạn</label>
                                    <textarea class="form-control  <?php echo $errors->first('content') ? 'is-invalid': '' ?>" id="exampleFormControlTextarea1" value="{{ old('content') }}" name="content" placeholder="Nội dung ..."
                                        rows="5">{{ old('content') }}</textarea>
                                        @if ($errors->has('content'))
                                        <p class="text-danger">{{ $errors->first('content') }}</p>
                                    @endif
                                </div>
                                <button type="submit" class="btn btn-primary btn-block">Liên hệ</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <!-- Map -->
                <div class="mapouter border-dark">
                    <div class="gmap_canvas">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3723.8639810443356!2d105.74459841485445!3d21.03812778599324!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x313454b991d80fd5%3A0x53cefc99d6b0bf6f!2sFPT%20Polytechnic%20Hanoi!5e0!3m2!1sfr!2s!4v1665498762239!5m2!1sfr!2s"
                            width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer -->
@endsection
@include('client.chatbox')
<script>
    setTimeout(() => {
        document.getElementById('setout').classList.add('d-none');
    }, 5000);
</script>
