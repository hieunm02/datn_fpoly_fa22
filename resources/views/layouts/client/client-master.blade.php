<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Askbootstrap">
    <meta name="author" content="Askbootstrap">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" href="img/fav.png">
    <title>BeeFood - @yield('title-page')</title>
    <!-- Slick Slider -->
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/slick/slick.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/slick/slick-theme.min.css') }}" />
    <!-- Feather Icon-->
    <link href="{{ asset('vendor/icons/feather.css') }}" rel="stylesheet" type="text/css">
    <!-- Bootstrap core CSS -->
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Custom styles for this template -->

    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/chatbox.css') }}" rel="stylesheet">
    <!-- Sidebar CSS -->
    <link href="{{ asset('vendor/sidebar/demo.css') }}" rel="stylesheet">
    {{-- link font awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
</head>

<body class="fixed-bottom-bar">
    @include('layouts.client.header-client')
    <div class="osahan-home-page">
        @yield('content')
    </div>
    <!-- Footer -->
    @include('layouts.client.footer-client')
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- slick Slider JS-->
    <script type="text/javascript" src="{{ asset('vendor/slick/slick.min.js') }}"></script>
    <!-- Sidebar JS-->
    <script type="text/javascript" src="{{ asset('vendor/sidebar/hc-offcanvas-nav.js') }}"></script>
    <!-- Custom scripts for all pages-->
    <script type="text/javascript" src="{{ asset('js/osahan.js') }}"></script>
    <script src="{{ asset('js\handleGeneral\checkout\select.js') }}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- <script src="https://code.jquery.com/jquery-3.6.1.js"></script> -->
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });
        $('#btn-exchange-point').on('click', function() {
            var point_exchange = $('#point_exchange').val();
            $.ajax({
                url: "/vouchers/exchange",
                type: "POST",
                data: {
                    point_exchange: point_exchange
                },

                dataType: 'json',
                success: function(data) {
                    Swal.fire(
                        'Successful!',
                        'Đổi thành công!',
                        'success'
                    )
                    $('.point-user').text(data.user.point);
                    $('.modal-backdrop').removeClass('modal-backdrop fade show');
                    $('.modal').css("display","none");
                },
                error: function(errors) {
                    if (errors.responseJSON.errors.required) {
                        $('.error').text(errors.responseJSON.errors.required);
                    }
                    if (errors.responseJSON.errors.enough) {
                        $('.error').text(errors.responseJSON.errors.enough);
                    }
                    if (errors.responseJSON.errors.multiple) {
                        $('.error').text(errors.responseJSON.errors.multiple);
                    }
                    if (errors.responseJSON.errors.dis) {
                        $('.error').text(errors.responseJSON.errors.dis);
                    }
                }
            });
        })
    </script>
</body>

</html>