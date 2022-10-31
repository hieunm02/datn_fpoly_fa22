<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>@yield('title')</title>
<!-- Favicon -->
<link rel="shortcut icon" href="{{ asset('assets/images/logo/favicon.png') }}">

<!-- page css -->
<link rel="shortcut icon" href="{{ asset('assets/images/logo/favicon.png') }}">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.ckeditor.com/4.20.0/standard/ckeditor.js"></script><!-- page css -->
<!-- Core css -->
<link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet">
<meta name="csrf-token" content="{{ csrf_token() }}">

{{-- icon bootstrap --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
@yield('layouts.admin.head')
