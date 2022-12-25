<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BeeFood - Login</title>
    <!-- Slick Slider -->
    <link rel="stylesheet" type="text/css" href="vendor/slick/slick.min.css" />
    <link rel="stylesheet" type="text/css" href="vendor/slick/slick-theme.min.css" />
    <!-- Feather Icon-->
    <link href="vendor/icons/feather.css" rel="stylesheet" type="text/css">
    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet">
    <!-- Sidebar CSS -->
    <link href="vendor/sidebar/demo.css" rel="stylesheet">
</head>

<body>
    <div class="login-page vh-100">

        <div class="d-flex  align-items-center justify-content-center vh-100" >
            <div id="vid" class="col-md-6 pl-5">
                <img width="100%" style="border-radius: 50px" src="{{ asset('./images/image_login/img.jpeg') }}" alt="">
            </div>
            <div class="px-5 col-md-6 ml-auto" style="box-sizing: border-box">
                <div class="px-5 col-10 mx-auto">
                    <h2 class="text-dark my-0">Chào mừng quay trở lại</h2>
                    <p class="text-50">Vui lòng đăng nhập để tiếp tục</p>
                    <form class="mt-5 mb-4" action="/login" method="POST">
                        @csrf
                        <input name="url" type="hidden" value="{{ $url }}" >
                        <div class="form-group">
                            <label for="exampleInputEmail1" class="text-dark">Email</label>
                            <input type="email" name="email" placeholder="Mời nhập email" value="{{old('email')}}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1" class="text-dark">Mật khẩu</label>
                            <input type="password" name="password" placeholder="Mời nhập mật khẩu" class="form-control" id="exampleInputPassword1">
                        </div>
                        @if(session()->has('error'))
                        <p class="text-danger text-center mb-3 m-0">{{session()->get('error')}}</p>
                        @endif

                        <button class="btn btn-success btn-lg btn-block" type="submit">ĐĂNG NHẬP</button>
                        <div class="py-2">
                            <a href="/auth/google/redirect">
                                <button type="button" class="btn btn-lg btn-primary btn-block"><i class="feather-google"></i> Đăng nhập với Google</button>
                            </a>
                        </div>
                    </form>
                    {{-- <a href="forgot_password.html" class="text-decoration-none">
                        <p class="text-center">Quên mật khẩu?</p>
                    </a> --}}
                    <div class="d-flex align-items-center justify-content-center">
                        <a href="{{ route('register') }}">
                            <p class="text-center m-0">Chưa có tài khoản? Đăng kí ngay</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
