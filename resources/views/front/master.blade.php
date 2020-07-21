<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>KMS Kemahasiswaan</title>
    <!-- LOADING STYLESHEETS -->
    <link href="{{ url('/') }}/front/css/bootstrap.css" rel="stylesheet">
    <link href="{{ url('/') }}/front/css/font-awesome.min.css" rel="stylesheet">
    <link href="{{ url('/') }}/front/css/style.css" rel="stylesheet">
@stack('head')
</head>

<body>
    <div class="container-fluid featured-area-white-border">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="login-box border-right-1">
                        <a href="{{route('login')}}">
                            <i class="fa fa-key"></i> Login</a>
                    </div>
                    <div class="login-box border-left-1 border-right-1">
                        <a href="{{route('register')}}">
                            <i class="fa fa-pencil"></i> Daftar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- TOP NAVIGATION -->
    <div class="container-fluid">
        <div class="navigation">
            <div class="row">
                <ul class="topnav">
                    <li></li>
                    <li>
                        <a href="{{route('front.dashboard')}}">
                            <i class="fa fa-home"></i> Home</a>
                    </li>
                    <li>
                        <a href="{{route('front.dashboard.knowledge')}}">
                            <i class="fa fa-book"></i> Pengetahuan</a>
                    </li>
                     <li>
                        <a href="{{route('front.dashboard.forum')}}">
                            <i class="fa fa-lightbulb-o"></i> Forum</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- END TOP NAVIGATION -->
    <!-- SEARCH FIELD AREA -->
    <div class="searchfield bg-hed-six">
        <div class="container" style="padding-top: 20px; padding-bottom: 20px;">
            <div class="row text-center margin-bottom-20">
                <h1 class="white"> KMS Kemahasiswaan</h1>
                <span class="nested"> IT Telkom Purwokerto </span>
            </div>
            <br>
            <div class="row search-row">
                <form action="{{route('front.dashboard.cari')}}" method="GET">
                <input type="text" name="cari" class="search" placeholder="Masukan Kata Kunci ...">
                <button type="submit" class="btn btn-primary" value="CARI">Search</button>
                </form>
            </div>
        </div>
    </div>
    <!-- END SEARCH FIELD AREA -->
    <!-- MAIN SECTION -->
    <div class="container featured-area-default padding-30">
        @yield('content')
    </div>
    <!-- END MAIN SECTION -->


    <!-- COPYRIGHT INFO -->
    <div class="container-fluid footer-copyright marg30">
        <div class="container">
            <div class="pull-left">
                Copyright © 2018 Sunny Gohil</a>
            </div>
            <div class="pull-right">
                <i class="fa fa-facebook"></i> &nbsp;
                <i class="fa fa-twitter"></i> &nbsp;
                <i class="fa fa-linkedin"></i>
            </div>
        </div>
    </div>
    <!-- END COPYRIGHT INFO -->

    <!-- LOADING MAIN JAVASCRIPT -->
    <script src="{{ url('/') }}/front/js/jquery-2.2.4.min.js"></script>
    <script src="{{ url('/') }}/front/js/main.js"></script>
    <script src="{{ url('/') }}/front/js/bootstrap.min.js"></script>
    <script src='https://cdn.rawgit.com/VPenkov/okayNav/master/app/js/jquery.okayNav.js'></script>
@stack('scripts') 
</body>
</html>