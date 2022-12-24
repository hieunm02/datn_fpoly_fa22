@extends('layouts.client.client-master')
@section('title-page', 'Đặt theo nhóm')
@section('content')
<style>
    /* START TOOLTIP STYLES */
[tooltip] {
  position: relative; /* opinion 1 */
}

/* Applies to all tooltips */
[tooltip]::before,
[tooltip]::after {
  text-transform: none; /* opinion 2 */
  font-size: .9em; /* opinion 3 */
  line-height: 1;
  user-select: none;
  pointer-events: none;
  position: absolute;
  display: none;
  opacity: 0;
}
[tooltip]::before {
  content: '';
  border: 5px solid transparent; /* opinion 4 */
  z-index: 1001; /* absurdity 1 */
}
[tooltip]::after {
  content: attr(tooltip); /* magic! */
  
  /* most of the rest of this is opinion */
  font-family: Helvetica, sans-serif;
  text-align: center;
  
  /* 
    Let the content set the size of the tooltips 
    but this will also keep them from being obnoxious
    */
  min-width: 3em;
  max-width: 21em;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
  padding: 1ch 1.5ch;
  border-radius: .3ch;
  box-shadow: 0 1em 2em -.5em rgba(0, 0, 0, 0.35);
  background: #333;
  color: #fff;
  z-index: 1000; /* absurdity 2 */
}

/* Make the tooltips respond to hover */
[tooltip]:hover::before,
[tooltip]:hover::after {
  display: block;
}

/* don't show empty tooltips */
[tooltip='']::before,
[tooltip='']::after {
  display: none !important;
}

/* FLOW: UP */
[tooltip]:not([flow])::before,
[tooltip][flow^="up"]::before {
  bottom: 100%;
  border-bottom-width: 0;
  border-top-color: #333;
}
[tooltip]:not([flow])::after,
[tooltip][flow^="up"]::after {
  bottom: calc(100% + 5px);
}
[tooltip]:not([flow])::before,
[tooltip]:not([flow])::after,
[tooltip][flow^="up"]::before,
[tooltip][flow^="up"]::after {
  left: 50%;
  transform: translate(-50%, -.5em);
}

/* FLOW: DOWN */
[tooltip][flow^="down"]::before {
  top: 100%;
  border-top-width: 0;
  border-bottom-color: #333;
}
[tooltip][flow^="down"]::after {
  top: calc(100% + 5px);
}
[tooltip][flow^="down"]::before,
[tooltip][flow^="down"]::after {
  left: 50%;
  transform: translate(-50%, .5em);
}

/* FLOW: LEFT */
[tooltip][flow^="left"]::before {
  top: 50%;
  border-right-width: 0;
  border-left-color: #333;
  left: calc(0em - 5px);
  transform: translate(-.5em, -50%);
}
[tooltip][flow^="left"]::after {
  top: 50%;
  right: calc(100% + 5px);
  transform: translate(-.5em, -50%);
}

/* FLOW: RIGHT */
[tooltip][flow^="right"]::before {
  top: 50%;
  border-left-width: 0;
  border-right-color: #333;
  right: calc(0em - 5px);
  transform: translate(.5em, -50%);
}
[tooltip][flow^="right"]::after {
  top: 50%;
  left: calc(100% + 5px);
  transform: translate(.5em, -50%);
}

/* KEYFRAMES */
@keyframes tooltips-vert {
  to {
    opacity: .9;
    transform: translate(-50%, 0);
  }
}

@keyframes tooltips-horz {
  to {
    opacity: .9;
    transform: translate(0, -50%);
  }
}

/* FX All The Things */ 
[tooltip]:not([flow]):hover::before,
[tooltip]:not([flow]):hover::after,
[tooltip][flow^="up"]:hover::before,
[tooltip][flow^="up"]:hover::after,
[tooltip][flow^="down"]:hover::before,
[tooltip][flow^="down"]:hover::after {
  animation: tooltips-vert 300ms ease-out forwards;
}

[tooltip][flow^="left"]:hover::before,
[tooltip][flow^="left"]:hover::after,
[tooltip][flow^="right"]:hover::before,
[tooltip][flow^="right"]:hover::after {
  animation: tooltips-horz 300ms ease-out forwards;
}

</style>
@if (session()->has('success'))
            <div id="setout" class="text-white alert bg-success position-fixed" style="right: 8px; z-index: 9999;">
                {{ session()->get('success') }}
                {{-- {{ Session::forget('success') }} --}}
            </div>
        @endif
@if (session()->has('error'))
            <div id="setout" class="text-white alert bg-danger position-fixed" style="right: 8px; z-index: 9999;">
                {{ session()->get('error') }}
                {{-- {{ Session::forget('error') }} --}}
            </div>
        @endif
<div class="osahan-trending" style="padding-bottom: 500px;">
<div class="container col-12 px-5">
    <div class="row d-flex justify-content-around">
        <div class="most_popular py-5 col-8">
            <div class="d-flex align-items-center mb-4 justify-content-between">
                <h3 class="font-weight-bold text-dark mb-0">Danh sách sản phẩm</h3>
                <div class="input-group d-flex col-3">
                <input type="text" id="searchOrderGroup" class="form-control form-control-lg input_search border-right-0" id="inlineFormInputGroup" placeholder="Tìm kiếm ở đây...">
                            <div class="input-group-prepend">
                                <div class="btn input-group-text bg-white border_search border-left-0 text-primary"><i class="feather-search"></i></div>
                            </div>
                </div>
            </div>
            @if(Auth::user())
            <input type="hidden" name="user_id" id="user_id" value="{{ Auth::user()->id }}">
            <input type="hidden" name="user_name" id="user_name" value="{{ Auth::user()->name }}">
            <input type="hidden" name="user_avatar" id="user_avatar" value="{{ Auth::user()->avatar }}">
            @endif
            <input type="hidden" name="cart_product" id="cart_product" value="">
            <div class="row" id="innerResultOrder" style="overflow: scroll;max-height:600px;min-height:300px">
                @foreach ($products as $product)
                <div class="col-lg-2 mb-3">
                    <div class="list-card bg-white h-100 rounded overflow-hidden position-relative shadow-sm grid-card">
                        <div class="list-card-image">
                            <a data-toggle="modal" data-target="#select-product" data-id_product="{{$product->id}}" class="quick-view">
                                <img alt="#" src="{{asset($product->thumb)}}" class="img-fluid item-img w-100">
                            </a>
                        </div>
                        <p class="ml-2">{{ number_format($product->price, 0, ',', '.') }} VND</p>
                        <div class="p-3 position-relative">
                            <div class="list-card-body">
                                <h6 style="cursor: pointer;" class="mb-1"><a data-toggle="modal" data-target="#select-product" data-id_product="{{$product->id}}" class="text-black quick-view">{{$product->name}}
                                    </a>
                                </h6>
                                <p class="text-gray mb-3">{{$product->menu->name}}</p>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="col-3">
            <div class="order-cart shadow-sm px-3" style="background-color: white; margin-top: 105px; height: auto">
                <div class="order-cart-header border-bottom row p-3" style="height: 65px; width: 100%">
                    <div class="order-cart-header-title col-7" id="order-cart-header-title" style="color: #a3a1a1;">
                        <h6>ĐƠN HÀNG THEO NHÓM</h6>
                    </div>
                    <div class="btn-create-order-group col-5" id="btn-create-order-group">
                        <a data-toggle="modal" data-target="#invite" id="btn-invite" class="ml-auto btn btn-primary text-white">Mời bạn cùng đặt</a>
                    </div>
                </div>
                <div class="product-cart" id="product-cart" style="color: #cfcaca;">
                    <div class="row p-3">
                        <div class="btn-manage-member col-6" id="btn-manage-member">
                            @foreach($listMembers as $member)
                            @if($member->user_id == Auth::id() && $member->role == "manager")
                            <a data-toggle="modal" data-target="#manage-member" id="btn-manage-member" class="ml-auto btn btn-primary">Quản lý thành viên</a>
                            @endif
                            @endforeach
                        </div>
                        <div class="col-6"></div>
                    </div>

                    @php
                    $sumPriceCart = 0;
                    @endphp

                    <div class="info-cart p-3">
                        @foreach($carts as $cart)
                        @if($cart->room == url()->current())
                        @php
                        $sumPriceCart += (($cart->product_price) * ($cart->quantity));
                        @endphp
                        <div class="product py-3" id="cart-product" style="color: black; font-size: 20px">
                            <input type="hidden" name="product_id" id="cart-product_id" value="{{ $cart->product_id }}">
                            {{-- Số lượng từng sản phẩm trong giỏ hàng --}}
                            <input type="hidden" name="cart_product_quantity" id="cart_product_quantity" value="">
                            {{-- Tài nguyên dùng để update số lượng sản phẩm trong giỏ hàng  --}}
                            <input type="hidden" id="cart_product_quantity_{{ $cart->user_id }}{{$cart->product_id}}" value="{{ $cart->quantity }}">
                            <input type="hidden" id="cart_product_price_{{ $cart->user_id }}{{$cart->product_id}}" value="{{ $cart->product_price }}">
                            <input type="hidden" name="product_id" id="cart-product_id_{{ $cart->user_id }}{{$cart->product_id}}" value="{{ $cart->product_id }}">

                            <div class="header row px-2" id="cart_header_{{ $cart->user_id }}{{$cart->product_id}}">
                                <div class="col-3" tooltip="{{$cart->user_name}}">
                                    <img alt="#" src="{{ $cart->user_avatar }}" class="img-fluid rounded-circle header-user mr-2 header-user">
                                </div>
                                {{-- <div class="col-6" style="font-family: Arial; font-size: 17px">
                                    <div hidden>
                                        {{ $prd_option = 0 }}
                                        {{ $total += $cart->product_price * $cart->quantity }}
                                    </div>
                                    {{ $cart->product_name }} <br>
                                    <span style="font-size: 12px">
                                        @if ($cart->options != null)
                                        (@foreach (json_decode($cart->options) as $op)
                                            @foreach ($options as $it)
                                                @if ($it->id == $op)
                                                    <p hidden>
                                                        {{ $total += $it->price * $cart->quantity }}
                                                        {{ $prd_option += $it->price }}</p>
                                                    {{ $it->value }},
                                                @endif
                                            @endforeach
                                        @endforeach)
                                    @endif
                                    </span>
                                </div> --}}
                                <div class="col-3" id="cart-product_price_{{ $cart->user_id }}{{$cart->product_id}}" style="font-family: Arial; font-weight: bold; font-size: 17px">
                                    {{ ($cart->product_price) * ($cart->quantity) }}<sup>đ</sup>
                                </div>
                            </div>
                            <div class="row py-3 border-bottom">
                                <div class="quantity px-3" id="cart-quantity">
                                    <div id="cart-quantity_{{ $cart->user_id }}{{$cart->product_id}}">
                                        @if(Auth::user() && $cart->user_id == Auth::user()->id)
                                        <input type="button" value="-" onclick="decrease({{ $cart->user_id }}{{$cart->product_id}})" class="btn btn-outline-primary" id="decrease">
                                        <input name="cart_quantity" style="width: 63px; font-family: Arial; font-weight: bold; font-size: 17px" class="input-qty btn btn-default" id="quantity_{{ $cart->user_id }}{{$cart->product_id}}" min="1" type="text" value="{{$cart->quantity}}" readonly>
                                        <input type="button" onclick="increase({{ $cart->user_id }}{{$cart->product_id}})" id="increase" value="+" class="btn btn-outline-primary">
                                        @else()
                                        <h6 style="color: #cfcaca">Số lượng sản phẩm:
                                            <input name="cart_quantity" style="width: 63px; font-family: Arial; font-weight: bold; font-size: 17px" class="input-qty btn btn-default" min="1" type="text" value="x{{$cart->quantity}}">
                                        </h6>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        @endforeach()
                    </div>
                </div>
                <div class="order-cart-footer row p-3">
                    <div class="total col-8">
                        <h5>Tổng:</h5>
                    </div>
                    <div class="total-price col-4 text-danger font-weight-bold" id="total-price">
                        <input type="hidden" name="cart_total_price" id="cart_total_price" value="{{ $sumPriceCart }}">
                        <h5 style="font-family: Arial; font-weight: bold; font-size: 20px">= {{$sumPriceCart}} <sup>đ</sup></h5>
                    </div>
                </div>
            </div>
            <form action="{{ route('OrderGroup-checkout') }}" method="GET">
                <input type="hidden" name="room" value="{{ url()->current() }}">
                <div class="checkout">
                    @foreach($listMembers as $member)
                    @if($member->user_id == Auth::id() && $member->role == "manager")
                    <button class="btn my-3 btn" style="color: white; font-weight: bold; width: 100%; font-size: 20px; background-color: #cfcaca;">Tiếp tục</button>
                    @endif
                    @if($member->user_id == Auth::id() && $member->role == "member")
                    <input type="submit" id="btn-success_order" class="btn my-3 btn btn-primary" style="color: white; font-weight: bold; width: 100%; font-size: 20px" value="Tôi đã xong">
                    @endif
                    @endforeach
                </div>
            </form>
        </div>
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
                <img alt="#" src="{{asset('assets/images/logo/order-group.png')}}" class="img-fluid item-img" width="25%">
                <h6><b>Chào mừng bạn đến với chức năng đặt đồ nhóm!</b></h6>
            </div>
            <div class="desc px-3">
                <span>*Nếu bạn là trưởng nhóm, hãy click vào nút <b>Tạo nhóm</b>, sau đó copy đường dẫn và gửi cho bạn bè</span><br>
                <span>*Nếu bạn là thành viên, hãy dán đường dẫn bạn bè gửi vào ô bên dưới, sau đó click vào nút <b>Vào nhóm</b></span>
            </div>
            <div class="link input-group px-3 mt-3">
                <div type="text" class="form-control" id="link_group" name="" contenteditable=""></div>
            </div>
            <div class="modal-button text-center my-3">
                <input type="submit" id="create_group" class="btn btn-light" value="Tạo nhóm">
                <input type="button" id="join_group" class="btn btn-light" value="Vào nhóm">
            </div>
        </div>
        <div class="modal-footer p-0 border-0">
            <div class="col-6 m-0 p-0">
                <a href="" class="btn border-top btn-lg btn-block" data-dismiss="modal">Thoát nhóm</a>
            </div>
            <div class="col-6 m-0 p-0">
                <input type="submit" class="btn btn-primary btn-lg btn-block" onclick="orderGroup()" value="Tiếp tục đặt nhóm" data-dismiss="modal">
            </div>
        </div>
        </form>
    </div>
</div>
</div>

{{-- Chọn sản phẩm  --}}
<div class="modal fade" id="select-product" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-scrollable modal-lg">
    <div class="modal-content">
        <input type="hidden" name="product_id" id="product_id">
        <div class="modal-header">
            <div class="info-product d-flex" style="width: 600px">
                <div id="product_thumb" style="width: 40%;"></div>
                <h5 id="product_name" class="modal-title ml-3"></h5>
            </div>
            <div class="quantity">
                {{-- <input type="button" onclick="tru()" value="-" class="btn btn-outline-primary"> --}}
                <input name="quantity" style="width: 44px;" class="input-qty btn btn-default" id="product_quantity" min="1" type="text" value="1" hidden>
                {{-- <input type="button" onclick="cong()" value="+" class="btn btn-outline-primary"> --}}
            </div>
            <div class="btn-close">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
        <div class="modal-body px-4 mt-3">
            <div class="title">
                <h6><b>Ghi chú thêm (nếu có)</b></h6>
                <textarea type="text" name="note" placeholder="Ví dụ: thêm đá riêng,..." style="width: 100%; border:none"></textarea>
            </div>

            {{-- <h6><b>Option</b></h6> --}}
            {{-- <div class="option">
    
            </div> --}}
        </div>
        <div class="modal-footer p-0 border-0">
            <div class="col-4 m-0 p-5">
                <input id="product_price" type="submit" class="btn btn-primary btn-lg btn-block rounded-pill" value="" data-dismiss="modal">
            </div>
        </div>
    </div>
</div>
</div>

{{-- quản lý nhóm  --}}
<div class="modal fade" style="margin-top: 15%" id="manage-member" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Danh sách thành viên</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body p-0 mt-3 mb-3">
            <div class="desc px-3">
                <span>*Bạn có thể chủ động đánh dấu đã xong với thành viên của bạn để tiến hành đặt hàng.</span><br>
            </div>
            <div class="info-member" id="info-member">
                @foreach ($listMembers as $member)
                @if($member->room == url()->current())
                <div class="link input-group px-3 mt-3">
                    <a class="text-dark d-block" aria-haspopup="true" aria-expanded="false">
                        <img src="{{ $member->user_avatar }}" class="img-fluid rounded-circle header-user mr-2 header-user member_avatar">
                        <span class="member_name" id="member_name_">{{ $member->user_name }}</span>
                        @if(Auth::user() && $member->user_id == Auth::user()->id)
                        <span>(Bạn)</span>
                        @endif
                        @if($member->role == 'member')
                        <input class="ml-2" type="checkbox" id="success-order">
                        @endif
                    </a>
                </div>
                @endif
                @endforeach()
            </div>
        </div>
    </div>
</div>
</div>

{{-- Mời bạn cùng đặt  --}}
<div class="modal fade" style="margin-top: 15%" id="invite" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
        <div class="modal-body p-0 mt-3">
            <div class="desc px-3">
                <span>Mời bạn bè cùng đặt chung đơn hàng, tiện lợi và tiết kiệm hơn!</span><br>
                <span>Bạn chỉ cần copy đường dẫn bên dưới và gửi cho bạn bè:</span><br>
            </div>
            <div class="link input-group px-3 mt-3">
                <input type="text" class="form-control" id="link_invite">
            </div>
            <div class="modal-button text-center my-3">
                <div class="loading-buttons">
                    <input type="button" id="order_group" class="btn btn-light" onclick="copyLinkGroup($('#link_invite'))" value="Sao chép">
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
</div>

{{-- @include('client.order-group-checkout') --}}
<script src="https://code.jquery.com/jquery-3.6.1.js"></script>

<script src="{{ asset('js/handleGeneral/ordergroup/order-group.js') }}"></script>
<script>
    // xem chi tiết sản phẩm 
    $(document).on('click','.quick-view', function() {
        let product_id = $(this).data('id_product');
        let room = location.href
        let _token = "{{ csrf_token() }}";
        let quantity = $('#product_quantity').val();

        $.ajax({
            url: "{{ route('quickview') }}",
            method: "POST",
            dataType: "JSON",
            data: {
                product_id: product_id,
                room: room,
                quantity: quantity,
                _token: _token,
            },
            success: function(data) {
                if(data){
                $('#product_id').val(data.product_id)
                $('#product_name').html(data.product_name)
                $('#product_price').val(data.product_price)
                $('#product_thumb').html(data.product_thumb)
                $('#cart_product').val(data.cart_product)
                $('#cart_product_quantity').val(data.cart_product_quantity)
                
                // let option = '';
                // for(let $i = 0; $i < data.product_option.length; $i++){
                //     option += `
                //     <div class="form-check">
                //         <input type="checkbox" name="option_product[]" id="option_product" class="form-check-input"
                //             value="${data.product_option[$i].option_detail_id}">
                //         <label for="option" class="form-check-label">${data.product_option[$i].value}
                //             ${data.product_option[$i].price}đ</label>
                //     </div>
                //     `
                // }
                // $('.option').html(
                //     option
                // )
            }}
        })
    })

    //xem danh sách thành viên 
    $('#btn-manage-member').on('click', function() {
        let room = location.href
        let _token = "{{ csrf_token() }}";
        $.ajax({
            url: "{{ route('list_member_order_group') }}",
            method: "POST",
            dataType: "JSON",
            data: {
                room: room,
                _token: _token,
            },
            success: function(data) {
                if(data){
                    let list = ''
                    for(let i = 0; i < data.length; i++){
                        // console.log(data[i].user_name);
                        list += `
                        <div class="link input-group px-3 mt-3">
                        <a class="text-dark d-block" aria-haspopup="true" aria-expanded="false">
                        <img src="${data[i].user_avatar}" class="img-fluid rounded-circle header-user mr-2 header-user member_avatar">
                        <span class="member_name" id="member_name_">${data[i].user_name}</span>
                        <input class="ml-2" type="checkbox" id="success-order">
                        </a>
                        </div>
                        `
                        $('#info-member').html(
                            list
                        )
                    } 
            }
        }
        })
    })

    $(document).on('change','#success-order',function() {
        $('.checkout').html(`
            <button class="btn my-3 btn btn-primary" style="color: white; font-weight: bold; width: 100%; font-size: 20px">Tiếp tục</button>
            `
        )
    });

</script>

<script src="https://cdn.socket.io/4.0.1/socket.io.min.js" integrity="sha384-LzhRnpGmQP+lOvWruF/lgkcqD+WDVt9fU3H4BWmwP5u5LTmkUGafMcpZKNObVMLU" crossorigin="anonymous"></script>
<script>
    $(function() {
        let ip_address = '127.0.0.1';
        let socket_port = '3000';
        let socket = io(ip_address + ':' + socket_port);

        let btn_addcart = $('#product_price');

        btn_addcart.on('click', function() {
            let user_id = $('#user_id').val()
            let user_name = $('#user_name').val()
            let user_avatar = $('#user_avatar').val()
            let product_name = $('#product_name').html()
            let product_price = $('#product_price').val()
            let product_id = $('#product_id').val()
            let cart_product = $('#cart_product').val()
            let quantity = $('#product_quantity').val()
            let cart_total_price = $('#cart_total_price').val()
            let cart_product_quantity = $('#cart_product_quantity').val()
            let room_id = location.href
            
            // var options = $("input[type='checkbox']:checked"); // returns object of checkeds.
            // var arr = []
            // for (var i = 0; i < options.length; i++) {
            //     arr.push($(options[i]).val())
            //     console.log();
            // };
            // console.log(arr);
            console.log(user_id, user_name, user_avatar, product_name, product_price, cart_product, cart_product_quantity, quantity, cart_total_price);

            // Gửi dữ liệu lên server 
            socket.emit('orderGroup', user_id, user_name, user_avatar, product_id, product_name, product_price, room_id, cart_product, cart_product_quantity, quantity, cart_total_price);
            addToCart()
            $('#select-product').modal('toggle');
            return false;
        });


        // Thêm sản phẩm vào giỏ hàng 
        function addToCart() {
            let route = "{{ route('order-group-add-cart') }}"
            let product_id = $('#product_id').val()
            let user_id = $('#user_id').val()
            let quantity = $('#product_quantity').val()
            var options = $("input[type='checkbox']:checked"); // returns object of checkeds.
            var arr = []
            for (var i = 0; i < options.length; i++) {
                arr.push($(options[i]).val())
            };
            let room = location.href
            let formData = new FormData()
            let token = "{{ csrf_token() }}"

            formData.append('product_id', product_id)
            formData.append('user_id', user_id)
            formData.append('room', room)
            formData.append('quantity', quantity)
            formData.append('options', arr)
            formData.append('_token', token)

            $.ajax({
                url: route,
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                dataType: 'JSON',
                success: function(data) {}
            })
        }

        //member xác nhận đặt hàng xong
        $('#btn-success_order').on('click', function() {
            const message = 'Xác nhận đặt hàng xong';
            socket.emit('successOrder', message);
            document.getElementById('btn-success_order').disabled = true
        })
        // manager đặt hàng thành công
        $('#doneCheckout').on('click', function() {
            const message = '';
            socket.emit('doneCheckout', message);
        })

        // Nhận vào dữ liệu
        socket.on('orderGroup', (user_id, user_name, user_avatar, product_id, product_name, product_price, room_id, cart_product, cart_product_quantity, quantity, cart_total_price) => {
            // Số lượng sản phẩm lúc mua hàng 
            cart_product == 'false' ?
                $('#product-cart').append(
                    `<div class="info-cart p-3">
                        <div class="product" id="cart-product" style="color: black; font-size: 20px">
                            <input type="hidden" name="product_id" id="cart-product_id" value="${product_id}">
                            <input type="hidden" name="cart_product_quantity" id="cart_product_quantity" value="">
                            <input type="hidden" id="cart_product_quantity_${user_id}${product_id}" value="${quantity}">
                            <input type="hidden" id="cart_product_price_${user_id}${product_id}" value="${product_price}">
                            <input type="hidden" name="product_id" id="cart-product_id_${user_id}${product_id}" value="${product_id}">
                            <div class="header row px-2" id="cart_header_${user_id}${product_id}">
                                <div class="col-3" tooltip="${user_name}">
                                    <img alt="#" src="${user_avatar}" class="img-fluid rounded-circle header-user mr-2 header-user">
                                </div>
                                <div class="col-6" style="font-family: Arial; font-size: 17px">
                                    ${product_name}
                                </div>
                                <div class="col-3" id="cart-product_price_${user_id}${product_id}" style="font-family: Arial; font-weight: bold; font-size: 17px">
                                    ${product_price * (quantity * 1)}<sup>đ</sup>
                                
            `) : ``
            // 
            cart_product == 'false' && user_id == $('#user_id').val() ?
                $('#product-cart').append(
                    `</div>
                    </div>
                        <div class="row px-3 border-bottom">
                            <div class="quantity px-3" id="cart-quantity">
                                <div id="cart-quantity_${user_id}${product_id}">
                                    <input type="button" value="-" onclick="decrease(${user_id}${product_id})" class="btn btn-outline-primary" id="decrease">
                                    <input name="cart_quantity" style="width: 63px; font-family: Arial; font-weight: bold; font-size: 17px" class="input-qty btn btn-default" id="quantity_${user_id}${product_id}"
                                    min="1" type="text" value="${(quantity * 1)}" readonly>
                                    <input type="button" onclick="increase(${user_id}${product_id})" id="increase" value="+" class="btn btn-outline-primary">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
                `
                ) : ``
            //
            cart_product == 'false' && user_id != $('#user_id').val() ?
                $('#product-cart').append(
                    `</div>
                    </div>
                        <div class="row px-3 border-bottom">
                            <div class="quantity px-3" id="cart-quantity">
                                <div id="cart-quantity_${user_id}${product_id}">
                                    <h6 style="color: #cfcaca">Số lượng sản phẩm: 
                                        <input name="cart_quantity" style="width: 63px; font-family: Arial; font-weight: bold; font-size: 17px" class="input-qty btn btn-default"
                                        min="1" type="text" value="x${(quantity * 1)}">
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
                `
                ) : ``
            //
            cart_product == 'true' ?
                $(`#cart-product_price_${user_id}${product_id}`).html(
                    `
                    ${product_price * ((cart_product_quantity * 1) + (quantity * 1))}<sup>đ</sup>
                `
                ) : ``
            //
            cart_product == 'true' && user_id == $('#user_id').val() ?
                $(`#cart-quantity_${user_id}${product_id}`).html(
                    `   <input type="button" value="-" onclick="decrease(${user_id}${product_id})" class="btn btn-outline-primary" id="decrease">
                    <input name="cart_quantity" style="width: 63px; font-family: Arial; font-weight: bold; font-size: 17px" class="input-qty btn btn-default" id="quantity_${user_id}${product_id}"
                    min="1" type="text" value="${(cart_product_quantity * 1) + (quantity * 1)}" readonly>
                    <input type="button" onclick="increase(${user_id}${product_id})" id="increase" value="+" class="btn btn-outline-primary">
                `
                ) : ``
            //
            cart_product == 'true' && user_id != $('#user_id').val() ?
                $(`#cart-quantity_${user_id}${product_id}`).html(
                    `<h6 style="color: #cfcaca">Số lượng sản phẩm: 
                    <input name="cart_quantity" style="width: 63px; font-family: Arial; font-weight: bold; font-size: 17px" class="input-qty btn btn-default"
                    min="1" type="text" value="x${(cart_product_quantity * 1) + (quantity * 1)}">
                </h6>
                `
                ) : ``
            //
            cart_product == 'true' ?
                $(`#cart_product_quantity_${user_id}${product_id}`).val(
                    `
                    ${(cart_product_quantity * 1) + (quantity * 1)}
                    
                `
                ) : ``
            //
            cart_product == 'true' && ((cart_product_quantity * 1) + (quantity * 1)) < 1 ?
                $(`#cart-quantity_${user_id}${product_id}`).html(
                    ``
                ) : ``;
            //
            cart_product == 'true' && ((cart_product_quantity * 1) + (quantity * 1)) < 1 ?
                $(`#cart_header_${user_id}${product_id}`).html(
                    ``
                ) : ``;
            //

            $('#total-price').html(
                `<input type="hidden" name="cart_total_price" id="cart_total_price" value="${(cart_total_price * 1) + (product_price *  quantity)}">
                <h5>= ${(cart_total_price * 1) + (product_price * quantity )}<sup>đ</sup></h5>`
            )

        });

        //member xác nhận đặt hàng xong
        socket.on('successOrder', (message) => {
            $('.checkout').html(`
            <button class="btn my-3 btn btn-primary" style="color: white; font-weight: bold; width: 100%; font-size: 20px">Tiếp tục</button>
            `)
        });

        //manager đặt hàng thành công
        socket.on('doneCheckout', (message) => {
            $('#product-cart').html(``)
            $('#total-price').html(`
                <input type="hidden" name="cart_total_price" id="cart_total_price" value="{{ $sumPriceCart }}">
                <h5>= 0 <sup>đ</sup></h5>
            `)
        })
    });
    //phân quyền 
    let role = window.localStorage.getItem('role');
    if (JSON.parse(role) == "manager") {
        $('.checkout').html(
            `
            <a id="btn-checkout" class="btn my-3 btn" style="color: white; font-weight: bold; width: 100%; font-size: 20px; background-color: #cfcaca;">Tiếp tục</a>
            `
        )
        $('#btn-manage-member').html(
            `
            <a href="#" data-toggle="modal" data-target="#manage-member" id="btn-manage-member" class="ml-auto btn btn-primary">Quản lý thành viên</a>
            `
        )
    } else {
        $('.checkout').html(
            `
            <input type="submit" id="btn-success_order" class="btn my-3 btn btn-primary" style="color: white; font-weight: bold; width: 100%; font-size: 20px" value="Tôi đã xong">
            `
        )
    }
</script>

<script>
    //cập nhật số lượng sản phẩm trong giỏ hàng
    let ip_address = '127.0.0.1';
    let socket_port = '3000';
    let socket = io(ip_address + ':' + socket_port);

    function decrease(product) {
        let isProduct = product;

        let user_id = $('#user_id').val()
        let user_name = $('#user_name').val()
        let user_avatar = $('#user_avatar').val()
        let product_price = $('#cart_product_price_' + product).val()
        let product_id = $('#cart-product_id_' + product).val()
        let cart_product = 'true'
        let quantity = -1
        let cart_total_price = $('#cart_total_price').val()
        let cart_product_quantity = $('#cart_product_quantity_' + product).val()
        console.log(cart_product_quantity);
        let room_id = location.href
        console.log(user_id, user_name, user_avatar, product_id, product_name, product_price, cart_product, cart_product_quantity, quantity, cart_total_price);

        // Gửi dữ liệu lên server 
        socket.emit('orderGroup', user_id, user_name, user_avatar, product_id, product_name, product_price, room_id, cart_product, cart_product_quantity, quantity, cart_total_price);
        updateToCart(isProduct, quantity)
        return false;
    };

    function increase(product) {
        let isProduct = product;

        let user_id = $('#user_id').val()
        let user_name = $('#user_name').val()
        let user_avatar = $('#user_avatar').val()
        let product_price = $('#cart_product_price_' + product).val()
        let product_id = $('#cart-product_id_' + product).val()
        let cart_product = 'true'
        let quantity = 1
        let cart_total_price = $('#cart_total_price').val()
        let cart_product_quantity = $('#cart_product_quantity_' + product).val()
        console.log(cart_product_quantity);
        let room_id = location.href
        console.log(user_id, user_name, user_avatar, product_id, product_name, product_price, cart_product, cart_product_quantity, quantity, cart_total_price);

        // Gửi dữ liệu lên server 
        socket.emit('orderGroup', user_id, user_name, user_avatar, product_id, product_name, product_price, room_id, cart_product, cart_product_quantity, quantity, cart_total_price);
        updateToCart(isProduct, quantity)
        return false;
    };

    // cập nhật số lượng sản phẩm trong giỏ hàng 
    function updateToCart(product, isQuantity) {
        let route = "{{ route('order-group-add-cart') }}"
        let product_id = $('#cart-product_id_' + product).val()
        let user_id = $('#user_id').val()
        let quantity = isQuantity
        let room = location.href
        let formData = new FormData()
        let token = "{{ csrf_token() }}"

        formData.append('product_id', product_id)
        formData.append('user_id', user_id)
        formData.append('room', room)
        formData.append('quantity', quantity)
        formData.append('_token', token)

        $.ajax({
            url: route,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'JSON',
            success: function(data) {}
        })
    }
</script>
<script>
    function copyLinkGroup(element) {
        element.select();
        document.execCommand("copy");
        $('.modal').removeClass('show');
        $('#invite').modal('toggle');
    }
</script>
<script src="https://code.jquery.com/jquery-3.6.1.js"></script>
<script>
    //setup before functions
    var typingTimer; //timer identifier
    var doneTypingInterval = 0; //time in ms, 5 seconds for example
    //on keyup, start the countdown
    $('#searchOrderGroup').on('keyup', function() {
        clearTimeout(typingTimer);
        typingTimer = setTimeout(doneTyping, doneTypingInterval);
    });

    //on keydown, clear the countdown 
    $('#searchOrderGroup').on('keydown', function() {
        $('.loader').css('display', 'block');
        clearTimeout(typingTimer);
    });

    //user is "finished typing," do something
    function doneTyping() {
        var result = document.querySelector('#searchOrderGroup').value;
        $.ajax({
            url: '/search/order-group',
            type: "GET",
            dataType: "JSON",
            data: {
                search: result
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
                    $('#innerResultOrder').html(string);
                } else {
                    $('.loader').fadeOut(0);
                    $('#innerResultOrder').html(data.result);
                }
            },
        });
    }
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
    setTimeout(() => {
        $('#setout').css('display', 'none');
    }, 3000)
</script>
@endsection