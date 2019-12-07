<!DOCTYPE html>
<html lang="en" >
<head>
    <meta charset="utf-8" />
    <title>
        Hydrogen | Login
    </title>
    <meta name="description" content="hydrogen CMS">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!--begin::Web font -->
    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
    <script>
        WebFont.load({
            google: {"families":["Poppins:300,400,500,600,700","Roboto:300,400,500,600,700"]},
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>
    <link href="{{ asset('backend/css/vendors.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/css/custom.css') }}" rel="stylesheet" type="text/css" />
    <link rel="shortcut icon" href="{{ asset('vendor/base/images/logo/hydrogen.png') }}" />
</head>
<body class="m--skin- m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default"  >
<div class="m-grid m-grid--hor m-grid--root m-page">
    <div class="m-grid__item m-grid__item--fluid m-grid m-grid--hor m-login m-login--singin m-login--2 m-login-2--skin-2" id="m_login" style="background-image: url('{{ asset('backend/images//bg/bg-3.jpg') }}');">
        <div class="m-grid__item m-grid__item--fluid m-login__wrapper">
            <div class="m-login__container">
                <div class="m-login__logo">
                    <a href="#">
                        <img src="{{ asset('backend/images/logos/logo.png') }}" style="width: 100px;">
                    </a>
                </div>
                <div class="m-login__signin">
                    <div class="m-login__head">
                        <h3 class="m-login__title">
                            Sign In To Admin
                        </h3>
                    </div>
                    <form class="m-login__form m-form" action="{{ route('authenticate') }}" method="POST">

                        @if(session('msg'))
                            <div class="m-alert m-alert--outline alert alert-danger alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                                <span>{{ session('msg') }}</span>
                            </div>
                        @endif

                        {{ csrf_field() }}
                        <div class="form-group m-form__group">
                            <input class="form-control m-input" type="email" placeholder="Email" name="email" autocomplete="off">
                        </div>
                        <div class="form-group m-form__group">
                            <input class="form-control m-input m-login__form-input--last" type="password" placeholder="Password" name="password">
                        </div>
                        <div class="row m-login__form-sub">
                            <div class="col m--align-left m-login__form-left">
                                <label class="m-checkbox">
                                    <input type="checkbox" name="remember">
                                    Remember me
                                    <span></span>
                                </label>
                            </div>
                        </div>
                        <div class="m-login__form-action">
                            <button id="m_login_signin_submit" class="btn btn-lg m-btn--pill m-btn--air m-btn m-btn--gradient-from-primary m-btn--gradient-to-info">
                                Sign In
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('backend/js/vendors.bundle.js') }}" type="text/javascript"></script>
<script src="{{ asset('backend/js/scripts.bundle.js') }}" type="text/javascript"></script>
</body>
</html>
