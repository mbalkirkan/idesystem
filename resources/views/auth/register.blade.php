<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>İdeSystem - Üyelik Oluştur</title>
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
        <div class="row d-flex justify-content-center  pt-5 mt-5 mb-4">
            <div class="col-12 col-xl-4">
                <div class="card">
                    <div class="card-body text-center">
                        <h4 class="mb-0 redial-font-weight-400">Yeni Üyelik Oluşturun</h4>
                    </div>
                    <div class="redial-divider"></div>
                    <div class="card-body py-4 text-center">
                        <img src="{{asset('dist/images/logo-v1.png')}}" alt="" class="img-fluid mb-4">
                        <form method="POST" action="{{route('register.register')}}">
                            @csrf
                            <div class="form-group">
                                <input type="text" class="form-control" name="username" placeholder="Kullanıcı adı" />
                                @error('username')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="email" placeholder="E-mail" />
                                @error('email')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="name" placeholder="Adınız" />
                                @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" name="password" placeholder="Şifre" />
                                @error('password')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" name="password_confirmation" placeholder="Şifre onay" />
                                @error('password_confirmation')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary btn-md redial-rounded-circle-50 btn-block">Kayıt Ol</button>
                            <p class="my-3">Zaten üyeliğiniz var mı ?</p>
                            <a href="{{route('login.index')}}" class="btn btn-success btn-md redial-rounded-circle-50 btn-block">Giriş Yap</a>
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
