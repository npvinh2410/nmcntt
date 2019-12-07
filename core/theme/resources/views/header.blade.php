<!DOCTYPE html>
<html lang="en-US">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>VNV Team - Real Value of Life</title>
    <meta name="description" content="Creative CV is a HTML resume template for professionals. Built with Bootstrap 4, Now UI Kit and FontAwesome, this modern and responsive design template is perfect to showcase your portfolio, skils and experience." />
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href="{{ asset('frontend/css/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/styles/main.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/styles/style.css') }}" rel="stylesheet">
</head>

<body id="top">
<header>
    <div class="profile-page sidebar-collapse">
        <nav class="navbar navbar-expand-lg fixed-top navbar-transparent bg-primary" color-on-scroll="400">
            <div class="container">
                <div class="navbar-translate"><a class="navbar-brand" href="{{ route('root') }}" rel="tooltip">VMV Team</a>
                    <button class="navbar-toggler navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-bar bar1"></span><span class="navbar-toggler-bar bar2"></span><span class="navbar-toggler-bar bar3"></span></button>
                </div>
                <div class="collapse navbar-collapse justify-content-end" id="navigation">
                    <ul class="navbar-nav">
                        <li class="nav-item"><a class="nav-link smooth-scroll" href="{{ route('view', ['slug' => 'bien-ban-thanh-lap-nhom']) }}">Biên bảng thành lập</a></li>
                        <li class="nav-item"><a class="nav-link smooth-scroll" href="#experience">Clip sản phẩm</a></li>
                        <li class="nav-item"><a class="nav-link smooth-scroll" href="#logo">Thiết kế logo</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</header>