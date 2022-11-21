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
    @if (session()->has('success'))
    <div id="setout" class="text-white alert bg-success position-fixed" style="right: 8px; z-index: 9999;">
        {{ session()->get('success') }}
        {{-- {{ Session::forget('success') }} --}}
    </div>
    @endif
    <div class="py-5 osahan-profile row">
        <div class="col-md-6 mb-3">
            <div class="rounded shadow-sm">
                <div class="osahan-cart-item-profile bg-white rounded shadow-sm p-4">
                    <div class="flex-column">
                        <h6 class="font-weight-bold">Liên hệ với chúng tôi</h6>
                        <p class="text-muted">Bạn có thắc mắc hay góp ý, hãy liên hệ với chúng tôi.</p>
                        <form>
                            <input type="hidden" value="{{Auth::id()}}" class="auth_id">
                            <div class="col-md-12 p-0 row m-0">
                                <div class="form-group col-md-6 p-0 pr-1">
                                    <label for="exampleFormControlInput1" class="small font-weight-bold">Tên của
                                        bạn</label>
                                    <input type="text" class="form-control <?php echo $errors->first('name') ? 'is-invalid' : ''; ?>" id="exampleFormControlInput1" value="{{ old('name') }}" name="name" placeholder="Nguyễn Trung Hiếu">
                                    @if ($errors->has('name'))
                                    <p class="text-danger m-0">{{ $errors->first('name') }}</p>
                                    @endif
                                </div>
                                <div class="form-group col-md-6 p-0 pl-1">
                                    <label for="exampleFormControlInput3" class="small font-weight-bold">Số điện
                                        thoại</label>
                                    <input type="hidden" name="status" value="0">
                                    <input type="number" class="form-control  <?php echo $errors->first('phone') ? 'is-invalid' : ''; ?>" id="exampleFormControlInput3" value="{{ old('phone') }}" name="phone" placeholder="0123456789">
                                    @if ($errors->has('phone'))
                                    <p class="text-danger m-0">{{ $errors->first('phone') }}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlInput2" class="small font-weight-bold">Email</label>
                                <input type="email" class="form-control  <?php echo $errors->first('email') ? 'is-invalid' : ''; ?>" id="exampleFormControlInput2" value="{{ old('email') }}" name="email" placeholder="hieunt@gmail.com">
                                @if ($errors->has('email'))
                                <p class="text-danger">{{ $errors->first('email') }}</p>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="exampleFormControlTextarea1" class="small font-weight-bold">Chúng tôi có thể
                                    giúp gì cho bạn</label>
                                <textarea class="form-control  <?php echo $errors->first('content') ? 'is-invalid' : ''; ?>" id="exampleFormControlTextarea1" value="{{ old('content') }}" name="content" placeholder="Nội dung ..." rows="5">{{ old('content') }}</textarea>
                                @if ($errors->has('content'))
                                <p class="text-danger">{{ $errors->first('content') }}</p>
                                @endif
                            </div>
                            <button type="button" class="btn btn-primary btn-block submit_form">Liên hệ</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <!-- Map -->
            <div class="mapouter border-dark">
                <div class="gmap_canvas">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3723.8639810443356!2d105.74459841485445!3d21.03812778599324!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x313454b991d80fd5%3A0x53cefc99d6b0bf6f!2sFPT%20Polytechnic%20Hanoi!5e0!3m2!1sfr!2s!4v1665498762239!5m2!1sfr!2s" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Footer -->
@endsection
@if (Auth::user())
@include('client.chatbox')
@endif
<script>
    setTimeout(() => {
        document.getElementById('setout').classList.add('d-none');
    }, 5000);
</script>
<script>
    $(function() {
        let ip_address = '127.0.0.1';
        let socket_port = '3000';
        let socket = io(ip_address + ':' + socket_port);
        $('.submit_form').click(function() {
            var name = $('input[name=name]').val()
            var phone = $('input[name=phone]').val()
            var email = $('input[name=email]').val()
            var content = $('textarea[name=content]').val()
            // alert(name + '-' + phone + '-' + email + '-' + content)
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'POST',
                url: "/contact-us",
                // dataType: "JSON",
                data: {
                    name: name,
                    phone: phone,
                    email: email,
                    content: content,
                    status: 0,
                },
                success: function(data) {
                    var user_id = $('.auth_id').val();
                    var name = $('input[name=name]').val()
                    var date = new Date();
                    
                    saveNotify(user_id,'contact');
                    socket.emit('sendNotifyToServer', {
                        user_name: name,
                        type: 'contact',
                        date: date
                    });
                    Swal.fire(
                        'Successful!',
                        'Gửi liên hệ thành công!',
                        'success'
                    )
                },
                error: function(data) {
                    Swal.fire(
                        'Error!',
                        'Gửi liên hệ không thành công!',
                        'error'
                    )
                }
            });
        });
    })
</script>