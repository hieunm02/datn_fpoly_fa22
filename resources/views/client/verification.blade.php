<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Askbootstrap">
    <meta name="author" content="Askbootstrap">
    <link rel="icon" type="image/png" href="img/fav.png">
    <title>BeeFood - Verification</title>
    <!-- Slick Slider -->
    <link rel="stylesheet" type="text/css" href="{{asset('vendor/slick/slick.min.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('vendor/slick/slick-theme.min.css')}}" />
    <!-- Feather Icon-->
    <link href="{{asset('vendor/icons/feather.css')}}" rel="stylesheet" type="text/css">
    <!-- Bootstrap core CSS -->
    <link href="{{asset('vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="{{asset('css/style.css')}}" rel="stylesheet">
    <!-- Sidebar CSS -->
    <link href="{{asset('vendor/sidebar/demo.css')}}" rel="stylesheet">
</head>

<body class="fixed-bottom-bar">

    <div class="osahan-signup login-page">
        <video loop autoplay muted id="vid">
            <source src="{{asset('img/bg.mp4')}}" type="video/mp4">
            <source src="{{asset('img/bg.mp4')}}" type="video/ogg">
            Your browser does not support the video tag.
        </video>
        <div class="d-flex align-items-center justify-content-center flex-column vh-100">
            <div class="px-5 col-md-6 ml-auto">
                <div class="px-5 col-10 mx-auto mb-4">
                    <h2 class="mb-3">Verify your phone number</h2>
                    <h6 class="text-black-50">Enter your OTP code here</h6>
                    <form action="home.html">
                        <div class="row my-5 mx-0 otp">
                            <div class="col pr-1 pl-0">
                                <input type="text" value="4" class="form-control form-control-lg">
                            </div>
                            <div class="col px-2">
                                <input type="text" value="0" class="form-control form-control-lg">
                            </div>
                            <div class="col px-2">
                                <input type="text" value="8" class="form-control form-control-lg">
                            </div>
                            <div class="col pl-1 pr-0">
                                <input type="text" value="0" class="form-control form-control-lg">
                            </div>
                        </div>
                        <button class="btn btn-lg btn-primary btn-block">Verify Now</button>
                    </form>
                </div>
                <div class="new-acc d-flex align-items-center justify-content-center">
                    <a href="login.html">
                        <p class="text-center m-0">Already an account? Sign in</p>
                    </a>
                </div>
            </div>
        </div>
    </div>


    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- slick Slider JS-->
    <script type="text/javascript" src="{{asset('vendor/slick/slick.min.js')}}"></script>
    <!-- Sidebar JS-->
    <script type="text/javascript" src="{{asset('vendor/sidebar/hc-offcanvas-nav.js')}}"></script>
    <!-- Custom scripts for all pages-->
    <script type="text/javascript" src="{{asset('js/osahan.js')}}"></script>
</body>

</html>