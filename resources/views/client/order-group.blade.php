@extends('layouts.client.client-master')
@section('title-page', 'Favorites')
@section('content')
<div class="osahan-trending" style="padding-bottom: 500px;">
    <!-- Most popular -->
    {{-- <div class="input-group mb-4">
        <input type="text" id="search" class="form-control form-control-lg input_search border-right-0" id="inlineFormInputGroup" placeholder="Tìm kiếm ở đây...">
        <div class="input-group-prepend">
            <div class="btn input-group-text bg-white border_search border-left-0 text-primary"><i class="feather-search"></i></div>
        </div>
    </div> --}}
    <div class="container col-12 px-5">
        <div class="row d-flex justify-content-around">
        <div class="most_popular py-5 col-8">
            <div class="d-flex align-items-center mb-4">
                <h3 class="font-weight-bold text-dark mb-0">Danh sách sản phẩm</h3>
            </div>
            
            <input type="hidden" name="user_id" id="user_id" value="{{ Auth::user()->id }}">
            <input type="hidden" name="user_name" id="user_name" value="{{ Auth::user()->name }}">
            <input type="hidden" name="user_avatar" id="user_avatar" value="{{ Auth::user()->avatar }}">
            
            <div class="row" id="innerResult">
                @foreach ($products as $product)
                <div class="col-lg-4 mb-3">
                    <div class="list-card bg-white h-100 rounded overflow-hidden position-relative shadow-sm grid-card">
                        <div class="list-card-image">
                            <a href="{{ route('product-detail', $product->id) }}">
                                <img alt="#" src="{{asset($product->thumb)}}" class="img-fluid item-img w-100">
                            </a>
                        </div>
                        <p>{{$product->price}}</p>
                        <div class="p-3 position-relative">
                            <div class="list-card-body">
                                <h6 class="mb-1"><a data-toggle="modal" data-target="#select-product" data-id_product="{{$product->id}}" class="text-black quick-view">{{$product->name}}
                                    </a>
                                </h6>
                                <p class="text-gray mb-3">{{$product->menu->name}}</p>
                                <p class="text-gray mb-3 time"><span class="bg-light text-dark rounded-sm pl-2 pb-1 pt-1 pr-2"><i class="feather-clock"></i> 15–25 min</span> <span class="float-right text-black-50"> $500 FOR TWO</span></p>
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
                        <a href="#" data-toggle="modal" data-target="#invite" id="btn-invite" class="ml-auto btn btn-primary">Mời bạn cùng đặt</a>
                    </div>
                </div>
                <div class="product-cart" id="product-cart" style="color: #cfcaca;">
                    <div class="row p-3">
                        <div class="btn-manage-member col-6" id="btn-manage-member">
                            <a href="#" data-toggle="modal" data-target="#manage-member" id="btn-manage-member" class="ml-auto btn btn-primary">Quản lý thành viên</a>
                        </div>
                        <div class="col-6"></div>
                    </div>
                        <div class="info-cart p-3">
                        @foreach($carts as $cart)
                            @if($cart->room == url()->current())
                                {{-- <div class="user border-bottom">
                                        <a href="#" class="text-dark py-3 d-block" aria-haspopup="true" aria-expanded="false">
                                            <img alt="#" src="{{ $cart->user_avatar }}" class="img-fluid rounded-circle header-user mr-2 header-user">
                                            {{ $cart->user_name }}
                                        </a>
                                </div> --}}
                                    <div class="product py-3" id="cart-product" style="color: black; font-size: 20px">
                                        <div class="header row px-2">
                                            <div class="col-3">
                                                <img alt="#" src="{{ $cart->user_avatar }}" class="img-fluid rounded-circle header-user mr-2 header-user">
                                            </div>
                                            <div class="col-6">
                                                {{ $cart->product_name }}
                                            </div>
                                            <div class="col-3">
                                                {{ $cart->product_price }}đ
                                            </div>
                                        </div>
                                        <div class="row py-3 border-bottom">
                                            @if($cart->user_id == Auth::user()->id)
                                            <div class="col-7"></div>
                                            <div class="quantity col-5">
                                                <input type="button" onclick="tru()" value="-" class="btn btn-outline-primary">
                                                <input name="quantity" style="width: 44px; font-size: 20px" class="input-qty btn btn-default" id="quantity"
                                                    min="1" type="text" value="1">
                                                <input type="button" onclick="cong()" value="+" class="btn btn-outline-primary">
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                            @endforeach()
                        </div>
                    @if(empty($carts))
                        <h6 class="p-5 text-center">Hãy chọn món yêu thích của bạn trên menu để đặt giao hàng ngay!</h6> 
                    @endif
                </div>
                <div class="order-cart-footer row p-3">
                    <div class="total col-9">
                        <h5>Tổng:</h5>
                    </div>
                    <div class="total-price col-3 text-danger font-weight-bold">
                        <h5>= 0 đ</h5>
                    </div>
                </div>
            </div>
            <div class="checkout">
                    <button class="btn my-3 btn btn-primary" style="color: white; font-weight: bold; width: 100%; font-size: 20px">Tiếp tục</button>
            </div>
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
                    <img id="product_thumb" src="" alt="">
                    <h5 id="product_name" class="modal-title"></h5>
                </div>
                <div class="quantity">
                    <input type="button" onclick="tru()" value="-" class="btn btn-outline-primary">
                    <input name="quantity" style="width: 44px;" class="input-qty btn btn-default" id="quantity"
                        min="1" type="text" value="1">
                    <input type="button" onclick="cong()" value="+" class="btn btn-outline-primary">
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
                <div class="option">
                    <h6><b>Option</b></h6>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                          Thêm đá
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                          Nhiều đường
                        </label>
                      </div>
                </div>
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
                                <a href="#" class="text-dark d-block" aria-haspopup="true" aria-expanded="false">
                                    <img alt="#" src="{{ $member->user_avatar }}" class="img-fluid rounded-circle header-user mr-2 header-user member_avatar">
                                    <span class="member_name">{{ $member->user_name }}</span>
                                        @if($member->user_id == Auth::user()->id)
                                            <span>(Bạn)</span>
                                        @endif
                                        @if($member->role == 'manager')
                                            <span>(Chủ phòng)</span>
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
                    <div type="text" class="form-control" id="link_invite" name=""></div>
                </div>
                <div class="modal-button text-center my-3">
                    <input type="button" id="order_group" class="btn btn-light" onclick="copyLinkGroup()" value="Sao chép">
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.1.js"></script>

<script src="{{ asset('js/handleGeneral/ordergroup/order-group.js') }}"></script>
<script>
        // xem chi tiết sản phẩm 
        $('.quick-view').on('click', function() {
        let product_id = $(this).data('id_product');
        let _token = "{{ csrf_token() }}";
        let quantity = $('#quantity').val();
        console.log(quantity);

        $.ajax({
            url:"{{ route('quickview') }}",
            method:"POST",
            dataType:"JSON",
            data:{
                product_id:product_id,
                _token:_token,
            },
            success:function(data){
                $('#product_id').val(data.product_id)
                $('#product_name').html(data.product_name)
                $('#product_price').val(data.product_price)
                $('#product_thumb').attr("src", data.product_thumb)
            }
            
        })
    })
</script>

<script src="https://cdn.socket.io/4.0.1/socket.io.min.js" integrity="sha384-LzhRnpGmQP+lOvWruF/lgkcqD+WDVt9fU3H4BWmwP5u5LTmkUGafMcpZKNObVMLU" crossorigin="anonymous"></script>
    <script>
        $(function() {
            let ip_address = '127.0.0.1';
            let socket_port = '3000';
            let socket = io(ip_address + ':' + socket_port);

            let btn_addcart = $('#product_price');

            btn_addcart.on('click', function() {
                let user_name = $('#user_name').val()
                let user_avatar = $('#user_avatar').val()
                let product_name = $('#product_name').html()
                let product_price = $('#product_price').val()
                let room_id = location.href
                console.log(user_name, user_avatar, product_name, product_price);

                // Gửi dữ liệu lên server 
                socket.emit('orderGroup', user_name, user_avatar, product_name, product_price, room_id);
                addToCart()
                $('#select-product').modal('toggle');
                return false;
            });
            
       
            // Thêm sản phẩm vào giỏ hàng 
            function addToCart()
            {
                let route = "{{ route('order-group-add-cart') }}"
                let product_id = $('#product_id').val()
                let user_id = $('#user_id').val()
                let room = location.href
                let formData = new FormData()
                let token = "{{ csrf_token() }}"

                formData.append('product_id', product_id)
                formData.append('user_id', user_id)
                formData.append('room', room)
                formData.append('_token', token)

                $.ajax({
                    url: route,
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    dataType: 'JSON',
                    success: function(response) {
                        if(response.success){
                            console.log(response.data);
                        }
                    }
                })
            }

            // Nhận vào dữ liệu
            socket.on('orderGroup', (user_name, user_avatar, product_name, product_price, room_id) => {
                $('#product-cart').append(
                    room_id == location.href ? `<div class="info-cart p-3">
                        <div class="product py-3" id="cart-product" style="color: black; font-size: 20px">
                            <div class="header row px-2">
                                <div class="col-3">
                                    <img alt="#" src="${user_avatar}" class="img-fluid rounded-circle header-user mr-2 header-user">
                                </div>
                                <div class="col-6">
                                    ${product_name}
                                </div>
                                <div class="col-3">
                                    ${product_price}đ
                                </div>
                            </div>
                        </div>
                    </div>
                ` : ``);

                $('#product-cart').append(
                    user_name == $('#user_name').val() ? `
                        <div class="row py-3 border-bottom">
                            <div class="col-7"></div>
                            <div class="quantity col-5">
                                <input type="button" onclick="tru()" value="-" class="btn btn-outline-primary">
                                <input name="quantity" style="width: 44px; font-size: 20px" class="input-qty btn btn-default" id="quantity"
                                    min="1" type="text" value="1">
                                <input type="button" onclick="cong()" value="+" class="btn btn-outline-primary">
                            </div>
                        </div>
                    `:``
                )

                // $('#info-member').append(
                //     room_id == location.href ? `
                //      <div class="link input-group px-3 mt-3">
                //         <a href="#" class="text-dark d-block" aria-haspopup="true" aria-expanded="false">
                //             <img alt="#" src="${user_avatar}" class="img-fluid rounded-circle header-user mr-2 header-user member_avatar">
                //             <span class="member_name">${user_name}</span>
                //         </a>
                //      </div>
                // `:``)
            });
        });
    </script>
@endsection