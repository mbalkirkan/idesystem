@extends('layouts.dark')
@section('title')
    Ürünler
@endsection
@section('content')
    <div class="row mb-4">
        <div class="col-12 col-sm-12">
            <div class="row">

                <div class="col-12 col-md-12 mb-4">
                    <div class="card redial-border-light redial-shadow">
                        <div class="card-header">
                                <div class="btn-group mb-2">
                                    <button type="button"  data-toggle="modal" data-target="#new_product"  class="btn btn-success"><i class="fa fa-plus-square"></i></button>
                                </div>
                        </div>
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
                                                                <li><span><i class="fa fa-rocket pr-2"></i> Satın Alan Sayısı : {{\App\Models\Licence::where('product_id',$product->id)->whereDate('end_date','>=', now())->get()->count()}}</span></li>
                                                                <li><i class="fa fa-bookmark pr-2"></i> {{$product->summary}}</li>
                                                                <li class="comment more"><i class="fa fa-paragraph pr-2"></i> {{$product->description}}</li>
                                                                <li><i class="fa fa-turkish-lira pr-2"></i> {{$product->price}}</li>
                                                            </ul>
                                                            <a href="{{route('admin.product.toggle',['id'=>$product->id])}}" class="btn @if($product->publish) btn-secondary @else btn-warning @endif btn-xs mb-2"><i class="fa fa-refresh pr-2"></i> @if($product->publish) Yayından Kaldır @else Yayınla @endif</a>
                                                            <a href="#" class="btn btn-success btn-xs mb-2"><i class="fa fa-shopping-cart pr-2"></i> Satın Al</a>

                                                            <a href="#" class="btn btn-info btn-xs mb-2"><i class="fa fa-download pr-2"></i> İndir</a>

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


    <!-- Kullanıcı Düzenleme -->
    <div class="modal fade" id="new_product" tabindex="-1" role="dialog" aria-labelledby="new_product"
         aria-hidden="true">
        <div class="modal-dialog  modal-lg" role="document">
            <div class="modal-content redial-border-light">
                <div class="modal-header redial-border-light">
                    <h5 class="modal-title pt-2" id="exampleModalLabel">Yeni Ürün Ekle</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{route('admin.product.add')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <div class="input-group form-group">
                                <span class="input-group-addon"><i class="fa fa-bookmark"></i></span>
                                <input id="add_product_name" type="text" name="add_product_name" class="form-control"
                                       placeholder="Ürün adı">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group form-group">
                                <span class="input-group-addon"><i class="fa fa-indent"></i></span>
                                <input id="add_product_summary" type="text" class="form-control" name="add_product_summary"
                                       placeholder="Özet"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group form-group">
                                <span class="input-group-addon"><i class="fa fa-file-text"></i></span>
                                <textarea name="add_product_description" style="height: 80px !important;" class="form-control" placeholder="Ürün açıklaması"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group form-group">
                                <span class="input-group-addon"><i class="fa fa-turkish-lira"></i></span>
                                <input id="add_product_price" type="text" class="form-control" name="add_product_price"
                                       placeholder="Fiyat"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group form-group">
                                <span class="input-group-addon"><i class="fa fa-file-image-o"></i></span>
                                <input id="add_product_image" name="add_product_image" type="file">

                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group form-group">
                                <span class="input-group-addon"><i class="fa fa-file"></i></span>
                                <input id="add_product_system_file" name="add_product_system_file" type="file">

                            </div>
                        </div>
                        <button type="submit"
                                class="btn btn-success btn-md redial-rounded-circle-50 btn-block">Yeni Ürün Ekle
                        </button>
                    </form>
                </div>
                <div class="modal-footer redial-border-light">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Vazgeç</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Kullanıcı Düzenleme -->
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
    <script>
        $(document).ready(function() {
            var showChar = 100;
            var ellipsestext = "...";
            var moretext = "daha fazla";
            var lesstext = "daha az";
            $('.more').each(function() {
                var content = $(this).html();

                if(content.length > showChar) {

                    var c = content.substr(0, showChar);
                    var h = content.substr(showChar-1, content.length - showChar);

                    var html = c + '<span class="moreellipses">' + ellipsestext+ '&nbsp;</span><span class="morecontent"><span>' + h + '</span>&nbsp;&nbsp;<a href="" class="morelink">' + moretext + '</a></span>';

                    $(this).html(html);
                }

            });

            $(".morelink").click(function(){
                if($(this).hasClass("less")) {
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
            text-decoration:none;
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
