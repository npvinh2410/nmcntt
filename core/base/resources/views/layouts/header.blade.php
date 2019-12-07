<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>
        Hydrogen | Dashboard
    </title>
    <meta name="description" content="Latest updates and statistic charts">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="{{ asset('backend/css/vendors.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/css/style2.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/css/fonts.css') }}" rel="stylesheet" type="text/css" />
    @yield('custom_css')
    <link href="{{ asset('backend/css/custom.css') }}" rel="stylesheet" type="text/css" />
    <link rel="shortcut icon" href="{{ asset('backend/images/logo/hydrogen.png') }}" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="m-page--fluid m--skin- m-content--skin-light2 m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default"  >
<!-- begin:: Page -->