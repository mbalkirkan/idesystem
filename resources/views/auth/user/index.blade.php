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
                                                                <li class="comment more"><i
                                                                        class="fa fa-paragraph pr-2"></i> {{$product->description}}
                                                                </li>
                                                                @if(!\App\Models\Licence::where('product_id',$product->id)->where('user_id',\Illuminate\Support\Facades\Auth::id())->where('end_date','>=', now())->where('start_date','<=', now())->first())
                                                                <li> <i class="fa fa-turkish-lira pr-2"></i> {{$product->price}} / {{$product->period}} Ay</li>
                                                                @else
                                                                    <li><i class="fa fa-clock-o pr-2"></i> {{ \Carbon\Carbon::parse(\App\Models\Licence::where('product_id',$product->id)->where('user_id',\Illuminate\Support\Facades\Auth::id())->where('end_date','>=', now())->where('start_date','<=', now())->first()->end_date)->longRelativeDiffForHumans(\Carbon\Carbon::now())}} sona erecek</li>
                                                                    @endif
                                                            </ul>
                                                            @if(!\App\Models\Licence::where('product_id',$product->id)->where('user_id',\Illuminate\Support\Facades\Auth::id())->where('end_date','>=', now())->where('start_date','<=', now())->first())
                                                                <a href="#" class="btn btn-success btn-xs mb-2"><i
                                                                        class="fa fa-shopping-cart pr-2"></i> Satın
                                                                    Al</a>
                                                            @else
                                                                <a href="{{asset('dist/systems/product/'.$product->system_file)}}" class="btn btn-info btn-xs mb-2"><i
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
    <script>
        $(document).ready(function () {
            var showChar = 100;
            var ellipsestext = "...";
            var moretext = "daha fazla";
            var lesstext = "daha az";
            $('.more').each(function () {
                var content = $(this).html();

                if (content.length > showChar) {

                    var c = content.substr(0, showChar);
                    var h = content.substr(showChar - 1, content.length - showChar);

                    var html = c + '<span class="moreellipses">' + ellipsestext + '&nbsp;</span><span class="morecontent"><span>' + h + '</span>&nbsp;&nbsp;<a href="" class="morelink">' + moretext + '</a></span>';

                    $(this).html(html);
                }

            });

            $(".morelink").click(function () {
                if ($(this).hasClass("less")) {
                    $(this).removeClass("less");
                    $(this).html(moretext);
                } else {
                    $(this).addClass("less");
                    $(this).html(lesstext);
                }
                $(this).parent().prev().toggle();
                $(this).prev().toggle();
                return false;
            });
        });
    </script>
@endsection
@section('head')
    <style>

        a.morelink {
            text-decoration: none;
            outline: none;
            color: #0254EB
        }

        .morecontent span {
            display: none;
        }

        .comment {
            /*width: 400px;*/
            /*background-color: #f0f0f0;*/
            /*margin: 10px;*/
        }
    </style>

@endsection
