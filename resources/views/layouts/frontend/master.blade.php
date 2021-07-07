<!DOCTYPE html>
<html lang="en">
<head>
<title>{{ config('app.name', 'Laravel') }}</title>
<!-- Meta tag Keywords -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="" />

<!--// Meta tag Keywords -->
<!-- css files -->
<link href="{{asset('css/style.css')}}" rel="stylesheet" type="text/css" media="all">
<link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" media="all">
<link href="{{asset('css/font-awesome.min.css')}}" rel="stylesheet" type="text/css" media="all">
<link rel="shortcut icon" href="{{asset('favicon.png')}}" />

<!-- //css files -->
<!-- online-fonts -->
<link href="https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i&amp;subset=latin-ext" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Covered+By+Your+Grace" rel="stylesheet">
<!-- //online-fonts -->
    <link rel="stylesheet" type="text/css" href="{{asset('css/front_report.css')}}">
    <script src='https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js'></script>

<script src="{{asset('js/print_result.js')}}"></script>
<!-- //js -->
</head>
<!-- <body oncontextmenu="return false;">

 -->
<body>
 @include('layouts.frontend.nav')
@yield('content')
@include('layouts.frontend.footer')
