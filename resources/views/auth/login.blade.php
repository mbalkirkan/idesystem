<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>İdeSystem - Giriş Yap</title>
    <link rel="icon" href="{{asset('dist/images/favicon.ico')}}" />

    <!--Plugin CSS-->
    <link href="{{asset('dist/css/plugins.min.css')}}" rel="stylesheet">

    <!--main Css-->
    <link href="{{asset('dist/css/main.min.css')}}" rel="stylesheet">
</head>
<body>

<!-- main-content-->
<div class="wrapper">
    <div class="w-100">
        <div class="row d-flex justify-content-center  pt-5 mt-5">
            <div class="col-12 col-xl-4">
                <div class="card">
                    <div class="card-body text-center">
                        <h4 class="mb-0 redial-font-weight-400">Lütfen Giriş Yapın</h4>
                    </div>
                    <div class="redial-divider"></div>
                    <div class="card-body py-4 text-center">
                        <img src="{{asset('dist/images/logo-v1.png')}}" alt="" class="img-fluid mb-4">
                        @if(session()->has('message'))
                            <div class="alert alert-success">
                                {{ session()->get('message') }}
                            </div>
                        @endif
                        @if(session()->has('error'))
                            <div class="alert alert-danger">
                                {{ session()->get('error') }}
                            </div>
                        @endif
                        <form method="POST" action="{{route('login.login')}}">
                            @csrf
                            <div class="form-group">
                                <div class="input-group form-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input type="text" name="username" class="form-control" placeholder="Kullanıcı Adı" >
                                </div>

                                @error('username')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <div class="input-group form-group">
                                    <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                    <input type="password" name="password" class="form-control" placeholder="Şifre" >
                                </div>
                                @error('password')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group text-left">
                                <input name="remember" type="checkbox" id="checkbox11">
                                <label for="checkbox11">Beni Hatırla</label>
                            </div>
                            <button type="submit" class="btn btn-primary btn-md redial-rounded-circle-50 btn-block">Giriş Yap</button>
                            <p class="my-3">Üyeliğiniz yok mu ?</p>
                            <a href="{{route('register.index')}}" class="btn btn-success btn-md redial-rounded-circle-50 btn-block">Yeni Üyelik Oluşturun</a>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End main-content-->

<!-- jQuery -->
<script src="{{asset('dist/js/plugins.min.js')}}"></script>
<script src="{{asset('dist/js/common.js')}}"></script>
</body>
</html>
