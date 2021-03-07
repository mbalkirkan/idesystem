@extends('layouts.dark')
@section('title')
    Profil
@endsection
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="redial-relative redial-grediant grediant-tb profile-header">
                <div class="background-image-maker py-5"></div>
                <div class="holder-image">
                    <img src="{{asset('dist/images/background/6043d2b9ba336.jpg')}}" alt="" class="img-fluid d-none">
                </div>
                <div class="redial-relative pl-md-3 pt-5">
                    <div class="media d-md-flex d-block">
                        <a href="#"><img src="{{asset('dist/images/lockscreen.jpg')}}" width="250" alt="" class="d-md-flex img-fluid rounded border redial-border-width-8 border-white redial-relative profile-avatar ml-md-0 ml-4 mb-md-0 mb-3" /></a>
                        <div class="media-body align-self-end pt-4">
                            <div class="pl-4">
                                <h1 class="display-4 text-uppercase text-white mb-0 redial-font-weight-900">{{$user->name}}</h1>
                                <h6 class="text-uppercase text-white mb-0 redial-font-weight-700">{{\App\Models\UserType::find($user->type)->role}}</h6>
                            </div>
                            <div class="profile-menu mt-4 redial-bg-secondry-light border border-left-0 border-right-0 redial-border-light">
                                <div class="clearfix">
                                    <div class="float-xl-left float-none">
                                        <ul class="nav nav-pills flex-column flex-sm-row redial-font-weight-700" id="myTab" role="tablist">
                                            <li class="nav-item ml-0">
                                                <a class="nav-link redial-dark py-2 px-3 px-lg-4 redial-relative active" data-toggle="tab" href="#edit" role="tab" aria-controls="edit" aria-expanded="true"> Profil Bilgilerini Düzenle</a>
                                            </li>
                                            <li class="nav-item ml-0">
                                                <a class="nav-link redial-dark py-2 px-3 px-lg-4 redial-relative" data-toggle="tab" href="#edit_password" role="tab" aria-controls="edit_password" aria-expanded="true"> Şifre Değiştir</a>
                                            </li>
                                        </ul>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4 mb-4">
        <div class="col-xl-3 mt-5">

            <div class="card redial-border-light redial-shadow mb-4 mb-xl-0">
                <div class="card-body">
                    <h6 class="header-title pl-3 redial-relative">Son Hareketler</h6>
                    <div class="custom-tabs2">
                        <ul class="nav nav-tabs flex-column flex-md-row" id="myTab" role="tablist">
                            @foreach($logTypes as $logType)
                            <li class="nav-item">
                                <a class="nav-link redial-light rounded-0 @if($loop->first) active @endif" data-toggle="tab" href="#tab{{$logType->id}}" role="tab" aria-selected="@if($loop->first) true @else false @endif" aria-expanded="@if($loop->first) true @else false @endif">{{$logType->name}}</a>
                            </li>
                            @endforeach

                        </ul>

                        <div class="tab-content border redial-border-light" id="myTabContent">
                            @foreach($logTypes as $logType)
                            <div class="tab-pane fade @if($loop->first) active show @endif" id="tab{{$logType->id}}" role="tabpanel" aria-expanded="@if($loop->first) true @else false @endif">
                                <ul class="list-unstyled mb-0">
                                    @forelse($logs->where('type',$logType->id)->splice(0, 5) as $log)
                                    <li class="redial-border-top redial-border-light py-2 redial-line-height-1_5">
                                        <small>{{$log->message}}</small>
                                        <small class="d-block pt-2"><i class="fa fa-clock-o"> {{\Carbon\Carbon::parse($log->created_at)->longRelativeDiffForHumans()}}</i></small>
                                    </li>
                                    @empty
                                        <small>Henüz bir hareket yok.</small>
                                    @endforelse
                                </ul>
                            </div>
                            @endforeach
                        </div>

                    </div>

                </div>
            </div>
        </div>
        <div class="col-xl-9">
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade active show" id="edit" role="tabpanel" aria-labelledby="edit" aria-expanded="true">
                    <div class="card redial-border-light redial-shadow">
                        <div class="card-body">
                            <form method="POST" action="{{route('auth.profile.update')}}">
                                @csrf
                                <input type="text" name="edit_id" id="edit_id" value="{{$user->id}}" hidden>
                                <div class="form-group">
                                    <div class="input-group form-group">
                                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                        <input  type="text"  disabled value="{{$user->username}}" class="form-control"
                                               placeholder="Kullanıcı Adı">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group form-group">
                                        <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                        <input id="edit_email" type="text" value="{{$user->email}}" class="form-control" name="edit_email"
                                               placeholder="E-mail">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group form-group">
                                        <span class="input-group-addon"><i class="fa fa-address-card"></i></span>
                                        <input id="edit_name" type="text" value="{{$user->name}}" class="form-control" name="edit_name"
                                               placeholder="Adınız"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group form-group">
                                        <span class="input-group-addon"><i class="fa fa-address-card"></i></span>
                                        <input id="edit_ideal_username" value="{{$user->ideal_username}}" type="text" class="form-control"
                                               name="edit_ideal_username"
                                               placeholder="İdeal Kullanıcı Adı"/>
                                    </div>
                                </div>

                                <button type="submit"
                                        class="btn btn-success btn-md redial-rounded-circle-50 btn-block">Bilgileri
                                    Güncelle
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="edit_password" role="tabpanel" aria-labelledby="edit_password" aria-expanded="true">
                    <div class="card redial-border-light redial-shadow">
                        <div class="card-body">
                            <form method="POST" action="{{route('auth.profile.update.password')}}">
                                @csrf
                                <div class="form-group">
                                    <div class="input-group form-group">
                                        <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                        <input type="password" class="form-control" name="old_password" placeholder="Şuanki şifreniz" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group form-group">
                                        <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                        <input type="password" class="form-control" name="password" placeholder="Yeni şifre" />
                                    </div>
                                </div>
                                <div class="input-group form-group">
                                    <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                    <input type="password" class="form-control" name="password_confirmation" placeholder="Yeni şifre onay" />
                                </div>
                                <button type="submit"
                                        class="btn btn-success btn-md redial-rounded-circle-50 btn-block">Şifre Güncelle
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        @if ($errors->any())
        @foreach ($errors->all() as $error)
        toastr.error('Hata - <br /> {{ $error }}');
        @endforeach
        @endif
    </script>
    <script>
        @if(session()->has('message'))
        toastr.success("Başarılı - <br /> {{ session()->get('message') }}");
        @endif
    </script>
@endsection
