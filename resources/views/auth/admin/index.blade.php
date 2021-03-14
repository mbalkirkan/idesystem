@extends('layouts.dark')
@section('title')
    Admin Paneli
@endsection
@section('content')
    <div class="row mb-xl-4 mb-0">
        <div class="col-12 col-sm-6 col-xl-3 mb-4 mb-xl-0">
            <div class="card  redial-shadow redial-bg-primary text-white">
                <div class="card-body">
                    <div class="media d-block d-sm-flex text-center text-sm-left">
                        <div class="d-lg-flex h1 mb-1 redial-primary align-self-center"><i class="fa fa-users"></i></div>
                        <div class="media-body">
                            <div class="fact-box text-center text-sm-right">
                                <h2 class="counter_number mb-1 redial-font-weight-400 text-white">{{\App\Models\User::all()->count()}} </h2>
                                <p class="mb-2">Toplam Kullanıcı</p>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-xl-3 mb-4 mb-xl-0">
            <div class="card redial-bg-success redial-border-success redial-shadow text-white">
                <div class="card-body">
                    <div class="media d-block d-sm-flex text-center text-sm-left">
                        <div class="d-lg-flex h1 mb-1 align-self-center"><i class="fa fa-bookmark"></i></div>
                        <div class="media-body">
                            <div class="fact-box text-center text-sm-right">
                                <h2 class="counter_number mb-1 redial-font-weight-400 text-white">{{\App\Models\Product::all()->count()}} </h2>
                                <p class="mb-2">Toplam Ürün</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card redial-bg-info redial-border-info redial-shadow text-white">
                <div class="card-body">
                    <div class="media d-block d-sm-flex text-center text-sm-left">
                        <div class="d-lg-flex h1 mb-1 align-self-center"><i class="fa fa-id-badge"></i></div>
                        <div class="media-body">
                            <div class="fact-box text-center text-sm-right">
                                <h2 class="counter_number mb-1 redial-font-weight-400 text-white">{{\App\Models\Licence::where('end_date','>=', now())->where('start_date','<=', now())->get()->count()}} </h2>
                                <p class="mb-2">Toplam Aktif Lisans</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card redial-bg-warning redial-border-info redial-shadow text-white">
                <div class="card-body">
                    <div class="media d-block d-sm-flex text-center text-sm-left">
                        <div class="d-lg-flex h1 mb-1 align-self-center"><i class="fa fa-certificate"></i></div>
                        <div class="media-body">
                            <div class="fact-box text-center text-sm-right">
                                <h2 class="counter_number mb-1 redial-font-weight-400 text-white">{{\App\Models\Licence::all()->count()}} </h2>
                                <p class="mb-2">Toplam Alınan Lisans</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')

@endsection
