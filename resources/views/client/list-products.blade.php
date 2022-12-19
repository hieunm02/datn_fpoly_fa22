@extends('layouts.client.client-master')
@section('title-page', 'Sản phẩm')
@section('content')
<style>
    .loader {
        display: none;
        width: 100%;
        height: 100%;
        position: fixed;
        padding-top: 10%;
        background-color: #f5f5f5;
        padding-left: 48%;
        margin: 0 auto;
        z-index: 9999;
    }
</style>
<div class="d-none">
    <div class="bg-primary border-bottom p-3 d-flex align-items-center">
        <h4 class="font-weight-bold m-0 text-white flex-fill">BeeFood</h4>
        <a class="toggle1 text-white" id="clickMenus"><span> <i class="feather-align-justify fs-30"></i></span></a>
    </div>
</div>
<div class="osahan-trending">
    @if (Auth::user())
    <input type="hidden" name="user_id" id="user_id" value="{{ Auth::user()->id }}">
    @endif
    <div class="loader" style="margin-top:90px;">
        <img src="{{asset('images/oval.svg')}}" alt="">
    </div>
    <div class="container">
        <div class="most_popular py-5">
            <div class="d-flex justify-content-between mb-4 row">
                <h3 class="font-weight-bold text-dark mb-0">Danh sách sản phẩm</h3>
                <div class="d-flex">
                    <div class="btn-create-order-group mx-2" id="btn-create-order-group">
                        <div class="input-group">
                            <input type="text" id="search" class="form-control form-control-lg input_search border-right-0" id="inlineFormInputGroup" placeholder="Tìm kiếm ở đây...">
                            <div class="input-group-prepend">
                                <div class="btn input-group-text bg-white border_search border-left-0 text-primary"><i class="feather-search"></i></div>
                            </div>
                        </div>
                    </div>
                    <a href="#" data-toggle="modal" data-target="#filters" class="ml-auto btn btn-primary mx-1">Bộ
                        lọc</a>
                    @if (Auth::user())
                    <a href="#" data-toggle="modal" data-target="#order_group" id="btn-order_group" class="ml-auto btn btn-primary mx-1">Đặt nhóm</a>
                    @else()
                    <a href="#" data-toggle="modal" data-target="#check_login" id="btn-check_login" class="ml-auto btn btn-primary mx-1">Đặt nhóm</a>
                    @endif
                </div>
            </div>

            <div class="row" id="innerResult">
                @foreach ($products as $product)
                <div class="col-md-3 pb-3">
                    <div class="list-card bg-white h-100 rounded overflow-hidden position-relative shadow-sm">
                        <div class="list-card-image" style="box-sizing: border-box; overflow: hidden;height: 141px">
                            @if ($product->price_sales != null)
                            <div class="star position-absolute"><span class="badge badge-danger">Sale</span>
                            </div>
                            @endif
                            <div class="favourite-heart text-danger position-absolute"><a href="#"></a></div>
                            <a href="{{ route('product-detail', $product->id) }}">
                                <img alt="#" src="{{ asset($product->thumb) }}" class="img-fluid item-img w-100">
                            </a>
                        </div>
                        <div class="p-3 position-relative">
                            <div class="list-card-body">
                                <h6 class="mb-1"><a href="{{ route('product-detail', $product->id) }}"
                                        class="text-black font-weight-bolder">{{ $product->name }}
                                    </a>
                                </h6>
                                <p class="text-gray mb-3 ">{{ $product->menu->name }}</p>
                                <p class="text-gray mb-3 time">
                                    <span class="text-dark rounded-sm pb-1 pt-1 pr-2">
                                        Còn lại: <span class="{{ $product->quantity < 10 ? 'text-danger': '' }}">{{ $product->quantity }} sản phẩm</span> 
                                    </span>
                                    <span class="float-right d-block text-danger font-weight-bolder">
                                        {{ number_format($product->price_sales != null ? $product->price_sales : $product->price, 0, ',', '.') }}
                                        VND</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="d-flex justify-content-center text-center">{{ $products->links() }}</div>
        </div>
    </div>
</div>

<div class="modal fade" id="filters" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Bộ lọc</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-0">
                <div class="osahan-filter">
                    <div class="filter">
                        <!-- SORT BY -->
                        <div class="p-3 bg-light border-bottom">
                            <h6 class="m-0">Sắp xếp giá theo</h6>
                        </div>
                        <form action="/list-products" method="get">
                            <div class="custom-control border-bottom px-0  custom-radio">
                                <input type="radio" id="customRadio3" value="0" name="price_low_high" class="custom-control-input">
                                <label class="custom-control-label py-3 w-100 px-3" for="customRadio3">Từ thấp đến
                                    cao</label>
                            </div>
                            <div class="custom-control border-bottom px-0  custom-radio">
                                <input type="radio" id="customRadio4" value="1" name="price_low_high" class="custom-control-input">
                                <label class="custom-control-label py-3 w-100 px-3" for="customRadio4">Từ cao đến
                                    thấp</label>
                            </div>
                            <div class="px-3 pt-3">
                                <div class="form-row">
                                    <div class="form-group col-6">
                                        <label>Từ</label>
                                        <input class="form-control" name="price_from" placeholder="Từ" type="number">
                                    </div>
                                    <div class="form-group text-right col-6">
                                        <label>Đến</label>
                                        <input class="form-control" name="price_to" placeholder="Đến" type="number">
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer p-0 border-0">
                <div class="col-6 m-0 p-0">
                    <a href="#" class="btn border-top btn-lg btn-block" data-dismiss="modal">Đóng</a>
                </div>
                <div class="col-6 m-0 p-0">
                    <button type="submit" class="btn btn-primary btn-lg btn-block">Lọc</button>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>

{{-- Chức năng đặt hàng nhóm  --}}
<div class="modal fade" id="order_group" style="margin-top: 8%" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Đặt món theo nhóm</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-0 mt-3">
                <div class="title text-center">
                    <img alt="#" src="{{ asset('assets/images/logo/order-group.png') }}" class="img-fluid item-img" width="25%">
                    <h6><b>Chào mừng bạn đến với chức năng đặt đồ nhóm!</b></h6>
                </div>
                <div class="desc px-3">
                    <span>*Nếu bạn là trưởng nhóm, hãy click vào nút <b>Tạo nhóm</b>, sau đó copy đường dẫn và gửi cho
                        bạn bè</span><br>
                    <span>*Nếu bạn là thành viên, hãy dán đường dẫn bạn bè gửi vào ô bên dưới, sau đó click vào nút
                        <b>Vào nhóm</b></span>
                </div>
                <div class="link input-group px-3 mt-3">
                    <div type="text" class="form-control" id="link_group" name="" contenteditable="">
                    </div>
                </div>
                <div class="modal-button text-center my-3">
                    <input type="button" id="create_group" class="btn btn-light" value="Tạo nhóm">
                    <input type="button" id="join_group" onclick="joinGroup()" class="btn btn-light" value="Vào nhóm">
                </div>
            </div>
            <div class="modal-footer p-0 border-0">
                <div class="col-6 m-0 p-0">
                    <input type="submit" class="btn btn-primary btn-lg btn-block" onclick="orderGroup()" value="Tiếp tục đặt nhóm" data-dismiss="modal">
                </div>
            </div>
            </form>
        </div>
    </div>
</div>

{{-- check-login  --}}
<div class="modal fade" id="check_login" tabindex="-1" style="margin-top: 8%" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="login-page vh-50">
                <div class="d-flex align-items-center justify-content-center vh-50">
                    <div class="p-5 col-md-12 ml-auto">
                        <div class="col-12 mx-auto">
                            <p class="text-50">Sign in to continue</p>
                            <form class="mt-5 mb-4" action="/login" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="exampleInputEmail1" class="text-dark">Email</label>
                                    <input type="email" name="email" placeholder="Enter Email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1" class="text-dark">Password</label>
                                    <input type="password" name="password" placeholder="Enter Password" class="form-control" id="exampleInputPassword1">
                                </div>
                                <button class="btn btn-success btn-lg btn-block" type="submit">SIGN IN</button>
                                <div class="py-2">
                                    <a href="/auth/google/redirect">
                                        <button type="button" class="btn btn-lg btn-primary btn-block"><i class="feather-google"></i> Connect with Google</button>
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.1.js"></script>
<script>
    //setup before functions
    var typingTimer; //timer identifier
    var doneTypingInterval = 0; //time in ms, 5 seconds for example
    //on keyup, start the countdown
    $('#search').on('keyup', function() {
        clearTimeout(typingTimer);
        typingTimer = setTimeout(doneTyping, doneTypingInterval);
    });

    //on keydown, clear the countdown 
    $('#search').on('keydown', function() {
        $('.loader').css('display', 'block');
        clearTimeout(typingTimer);
    });

    //user is "finished typing," do something
    function doneTyping() {
        var result = document.querySelector('#search').value;
        $.ajax({
            url: '/search/client',
            type: "GET",
            dataType: "JSON",
            data: {
                result: result
            },
            success: function(data) {
                if (data.result == '') {
                    var string = `
                        <div class="col-4"></div>
                        <div class="row d-flex align-items-center justify-content-center py-5">
                            <div class="col-md-4 py-5">
                                <div class="text-center py-5">
                                    <p class="h4 mb-4"><i class="feather-search bg-primary text-white rounded p-2"></i></p>
                                    <p class="font-weight-bold text-dark h5">Không có kết quả</p>
                                    <p>Chúng tôi không tìm thấy món bạn cần, vui lòng thử lại sau.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-4"></div>`;
                    $('.loader').fadeOut(1000);
                    $('#innerResult').html(string);
                } else {
                    $('.loader').fadeOut(0);
                    $('#innerResult').html(data.result);
                }
            },
        });
    }
</script>
<script src="{{ asset('js/handleGeneral/ordergroup/order-group.js') }}"></script>

{{-- đặt nhóm  --}}
<script>
    function rand_string(length) {
        var result = '';
        var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        var charactersLength = characters.length;
        for (var i = 0; i < length; i++) {
            result += characters.charAt(Math.floor(Math.random() * charactersLength));
        }
        return result;
    }


    var url = '';
    $('#create_group').on('click', function() {
        $('#link_group').html(`http://localhost:8000/order-group/` + rand_string(16)).then(
            url = $('#link_group').html()
        )
    })

    function orderGroup() {
        history.pushState({}, "", url);
        let route = "{{ route('order-group') }}"
        let room = url
        let user_id = $('#user_id').val()
        let role = 'manager'
        let formData = new FormData()
        let token = "{{ csrf_token() }}"

        formData.append('room', room)
        formData.append('user_id', user_id)
        formData.append('role', role)
        formData.append('_token', token)

        $.ajax({
            url: route,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'JSON',
            success: function(response) {
                if (response.success) {
                    console.log(response.data);
                }
            }
        })
        localStorage.setItem('role', JSON.stringify('manager'))
        location.reload()
    }

    function joinGroup() {
        let url = $('#link_group').html()
        history.pushState({}, "", url);
        let route = "{{ route('order-group') }}"
        let room = url
        let user_id = $('#user_id').val()
        let role = 'member'
        let formData = new FormData()
        let token = "{{ csrf_token() }}"

        formData.append('room', room)
        formData.append('user_id', user_id)
        formData.append('role', role)
        formData.append('_token', token)

        $.ajax({
            url: route,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'JSON',
            success: function(response) {
                if (response.success) {
                    console.log(response.data);
                }
            }
        });
        localStorage.setItem('role', JSON.stringify('member'))
        location.reload();
    }
</script>
@endsection