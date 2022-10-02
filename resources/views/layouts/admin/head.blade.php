<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>@yield('title')</title>
<script src="https://cdn.ckeditor.com/4.10.1/standard/ckeditor.js"></script>
<!-- Favicon -->
<link rel="shortcut icon" href="{{asset('assets/images/logo/favicon.png')}}">

<!-- page css -->
<!-- Core css -->
<link href="{{asset('assets/css/app.min.css')}}" rel="stylesheet">
<meta name="csrf-token" content="{{ csrf_token() }}">

@yield('layouts.admin.head')