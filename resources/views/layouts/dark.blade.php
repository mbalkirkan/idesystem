<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>İdeSystem - @yield('title')</title>
    <link rel="icon" href="{{asset('dist/images/favicon.ico')}}"/>
    <meta lang="tr">

    <link href="{{asset('dist/css/plugins.min.css')}}" rel="stylesheet">

    <link href="{{asset('dist/css/main.min.css')}}" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('head')
</head>
<body>

<div id="header-fix" class="header py-4 py-lg-2 fixed-top">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-lg-3 col-xl-2 align-self-center">
                <div class="site-logo">
                    <a href="#"><img src="{{asset('dist/images/logo-v1.png')}}" alt="" class="img-fluid"/></a>
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

<div class="wrapper">
    <nav id="sidebar" class="card redial-border-light px-2 mb-4">
        <div class="sidebar-scrollarea">
            <ul class="metismenu list-unstyled mb-0" id="menu">
                <div class="media py-3 redial-divider-dashed">
                    <a href="#" class="redial-light redial-relative">
                        <img src="{{asset('dist/images/lockscreen.jpg')}}" alt="{{\Illuminate\Support\Facades\Auth::user()->name}}" class="img-fluid rounded-circle d-flex mr-3">

                    </a>
                    <div class="media-body align-self-center redial-line-height-1_5">
                        <a href="{{route('auth.profile.index')}}" class="redial-light">
                            <small class="d-block redial-font-weight-800 redial-dark"><span class="lnr lnr-user pr-2"></span>{{\Illuminate\Support\Facades\Auth::user()->name}}</small> </a>
                            <small>{{\App\Models\UserType::find(\Illuminate\Support\Facades\Auth::user()->type)->role}}</small>

                    </div>
                </div>
                <li><a href="{{route('auth.index')}}"><span class="lnr lnr-home pr-2"></span> Anasayfa</a></li>
                @if(\Illuminate\Support\Facades\Auth::user()->type==1)
                    <li><a href="{{route('admin.product.index')}}"><i class="fa fa-th-list pr-2"></i> Ürünler</a></li>
                    <li><a href="{{route('admin.user.index')}}"><i class="fa fa fa-user-circle pr-2"></i> Kullanıcılar</a></li>
                @endif
                <li><a href="{{route('auth.logout')}}"><i class="fa fa-sign-out pr-2"></i> Çıkış Yap</a></li>


                  </ul>
        </div>
    </nav>
    <div id="content">
        @yield('content')
    </div>
</div>

<a href="#" class="scrollup text-center redial-bg-primary redial-rounded-circle-50 ">
    <h4 class="text-white mb-0"><i class="icofont icofont-long-arrow-up"></i></h4>
</a>




<script src="{{asset('dist/js/plugins.min.js')}}"></script>

<script src="{{asset('dist/js/common.js')}}"></script>
@yield('js')
</body>

</html>
