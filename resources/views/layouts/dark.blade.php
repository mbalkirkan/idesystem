<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>İdeSystem - @yield('title')</title>
    <link rel="icon" href="{{asset('dist/images/favicon.ico')}}" />

    <!--Plugin CSS-->
    <link href="{{asset('dist/css/plugins.min.css')}}" rel="stylesheet">
    <!--main Css-->
    <link href="{{asset('dist/css/main.min.css')}}" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('head')
</head>
<body>
<!-- header-->
<div id="header-fix" class="header py-4 py-lg-2 fixed-top">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-lg-3 col-xl-2 align-self-center">
                <div class="site-logo">
                    <a href="#"><img src="{{asset('dist/images/logo-v1.png')}}" alt="" class="img-fluid" /></a>
                </div>
                <div class="navbar-header">
                    <button type="button" id="sidebarCollapse" class="navbar-btn bg-transparent float-right">
                        <i class="glyphicon glyphicon-align-left"></i>
                        <span class="navbar-toggler-icon"></span>
                        <span class="navbar-toggler-icon"></span>
                        <span class="navbar-toggler-icon"></span>
                    </button>
                </div>
            </div>
            <div class="col-12 col-lg-3 align-self-center d-none d-lg-inline-block">

            </div>

        </div>
    </div>
</div>
<!-- End header-->

<!-- Main-content Top bar-->
<div class="redial-relative mt-80">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-md-2 align-self-center my-3 my-lg-0">
                <h6 class="text-uppercase redial-font-weight-700 redial-light mb-0 pl-2">@yield('title')</h6>
            </div>
            <div class="col-12 col-md-4 align-self-center">
                <div class="float-sm-left float-none mb-4 mb-sm-0">
                    <ol class="breadcrumb mb-0 bg-transparent redial-light">
{{--                        <li class="breadcrumb-item"><a href="#" class="redial-light">@yield('title')</a></li>--}}
                    </ol>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="clearfix d-none d-md-inline">

                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Main-content Top bar-->

<!-- main-content-->
<div class="wrapper">
    <nav id="sidebar" class="card redial-border-light px-2 mb-4">
        <div class="sidebar-scrollarea">
            <ul class="metismenu list-unstyled mb-0" id="menu">
                <div class="media py-3 redial-divider-dashed">
                    <a href="#" class="redial-light redial-relative">
                        <img src="dist/images/lockscreen.jpg" alt="" class="img-fluid rounded-circle d-flex mr-3">

                    </a>
                    <div class="media-body align-self-center redial-line-height-1_5">
                        <a href="#" class="redial-light">
                            <small class="d-block redial-font-weight-800 redial-dark">{{\Illuminate\Support\Facades\Auth::user()->name}}</small>
                            <small>{{\App\Models\UserType::find(\Illuminate\Support\Facades\Auth::user()->type)->role}}</small>
                        </a>
                    </div>
                </div>


{{--                <li><a href="{{route('scan.index')}}"><i class="fa fa-dashboard pr-1"></i> Tarama</a></li>--}}
{{--                <li><a href="{{route('scan.stocks.get')}}"><i class="fa fa-dashboard pr-1"></i> Hisse Senetleri</a></li>--}}
{{--                <li><a href="{{route('scan.results')}}"><i class="fa fa-dashboard pr-1"></i> Tarama Sonuçları</a></li>--}}
{{--                <li><a href="{{route('scan.results.nrefresh')}}"><i class="fa fa-dashboard pr-1"></i> Tarama Sonuçları (N.R.)</a></li>--}}
{{--                <li><a href="{{route('operation.purchased')}}"><i class="fa fa-dashboard pr-1"></i> Pozisyonda Olan Hisseler</a></li>--}}
{{--                <li><a href="{{route('operation.profit_taken')}}"><i class="fa fa-dashboard pr-1"></i> Kar Alınanlar</a></li>--}}
{{--                <li><a href="{{route('operation.stopped')}}"><i class="fa fa-dashboard pr-1"></i> Stoplananlar</a></li>--}}
{{--                <li><a href="{{route('optimization.index')}}"><i class="fa fa-dashboard pr-1"></i> Optimizasyon</a></li>--}}
{{--                <li><a href="{{route('optimization.stock')}}"><i class="fa fa-dashboard pr-1"></i> Hisse Optimizasyon</a></li>--}}
            </ul>
        </div>
    </nav>
    <div id="content">
        @yield('content')
    </div>
</div>
<!-- End main-content-->

<!-- Top To Bottom--> <a href="#" class="scrollup text-center redial-bg-primary redial-rounded-circle-50 ">
    <h4 class="text-white mb-0"><i class="icofont icofont-long-arrow-up"></i></h4>
</a>
<!-- End Top To Bottom-->





<!-- jQuery -->
<script src="{{asset('dist/js/plugins.min.js')}}"></script>

<script src="{{asset('dist/js/common.js')}}"></script>
@yield('js')
</body>

</html>
