<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Askbootstrap">
    <meta name="author" content="Askbootstrap">
    <link rel="icon" type="image/png" href="img/fav.png">
    <title>BeeFood - @yield('title-page')</title>
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
    @include('layouts.client.header-client')
    <div class="osahan-home-page">
        @yield('content')
    </div>
    <!-- Footer -->
    @include('layouts.client.footer-client')
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
<script>
    let subOverlay = document.getElementById('subOverlay');
    let menu_sub = document.getElementById('menu-sub');
    let closeSubNav = document.getElementById('closeSubNav');
    let subClick = document.getElementById('subClick');
    let clickNavSiderBar = document.getElementById('clickMenus');
    let clickNavSiderBar1 = document.getElementById('clickMenus1');
    let navSiderBar = document.getElementById('navSiderBar');
    let ovarlay = document.getElementById('overlay');
    clickNavSiderBar.addEventListener('click', function() {
        navSiderBar.classList.add('nav-open');
        ovarlay.classList.add('nav-open');
    });
    clickNavSiderBar1.addEventListener('click', function() {
        navSiderBar.classList.add('nav-open');
        ovarlay.classList.add('nav-open');
    });
    ovarlay.addEventListener('click', function() {
        navSiderBar.classList.remove('nav-open');
        ovarlay.classList.remove('nav-open');
    });
    subClick.addEventListener('click', function() {
        subOverlay.classList.add('sub-level-open');
        menu_sub.classList.add('level-open');
    });
    closeSubNav.addEventListener('click', function() {
        subOverlay.classList.remove('sub-level-open');
        menu_sub.classList.remove('level-open');
    });
</script>