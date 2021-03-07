@extends('layouts.dark')
@section('title')
    Kullanıcı Paneli
@endsection
@section('content')
    <div class="row mb-4">
        <div class="col-12 col-sm-12">
            <div class="row">

                <div class="col-12 col-md-12 mb-4">
                    <div class="card redial-border-light redial-shadow">
                        <div class="card-body">
                            <h6 class="header-title pl-3 redial-relative">Ürünler</h6>
                            <div class="col-12 col-sm-12">
                                <div class="row mb-4">

                                    @foreach($products as $product)
                                        <div class="col-12 col-xl-6 mb-4">
                                            <div class="card redial-border-light redial-shadow">
                                                <div class="card-body">
                                                    <div class="media d-block d-sm-flex text-center text-sm-left">
                                                        <a href="#"><img src="{{asset('dist/images/product/'.$product->image)}}" alt="" class="img-fluid d-sm-flex mr-sm-3 mb-3 mb-sm-0 rounded-circle" width="120" /></a>
                                                        <div class="media-body">
                                                            <a href="#"><h4>{{$product->name}}</h4></a>

                                                            <ul class="list-unstyled redial-font-weight-600">

                                                                <li><i class="fa fa-bookmark pr-2"></i> {{$product->summary}}</li>
                                                                <li class="comment more"><i class="fa fa-paragraph pr-2"></i> {{$product->description}}</li>
                                                                <li><i class="fa fa-turkish-lira pr-2"></i> {{$product->price}}</li>
                                                            </ul>
                                                            @if(!\App\Models\Licence::where('product_id',$product->id)->where('user_id',\Illuminate\Support\Facades\Auth::id())->whereDate('end_date','>=', now())->whereDate('start_date','<=', now())->first())
                                                                <a href="#" class="btn btn-success btn-xs mb-2"><i
                                                                        class="fa fa-shopping-cart pr-2"></i> Satın
                                                                    Al</a>
                                                            @else
                                                                <a href="#" class="btn btn-info btn-xs mb-2"><i
                                                                        class="fa fa-download pr-2"></i> İndir</a>
                                                                @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
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
