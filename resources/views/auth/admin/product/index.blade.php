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
                                <button type="button" data-toggle="modal" data-target="#new_product"
                                        class="btn btn-success"><i class="fa fa-plus-square"></i></button>
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
                                                        <a href="#"><img
                                                                src="{{asset('dist/images/product/'.$product->image)}}"
                                                                alt=""
                                                                class="img-fluid d-sm-flex mr-sm-3 mb-3 mb-sm-0 rounded-circle"
                                                                width="120"/></a>
                                                        <div class="media-body">
                                                            <a href="#"><h4>{{$product->name}}</h4></a>

                                                            <ul class="list-unstyled redial-font-weight-600">
                                                                <li>
                                                                    <i class="fa fa-key pr-2"></i> {{$product->id}}
                                                                </li>
                                                                <li><span><i class="fa fa-rocket pr-2"></i> Satın Alan Sayısı : {{\App\Models\Licence::where('product_id',$product->id)->where('end_date','>=', now())->get()->count()}}</span>
                                                                </li>
                                                                <li>
                                                                    <i class="fa fa-bookmark pr-2"></i> {{$product->summary}}
                                                                </li>
                                                                <li class="comment more"><i
                                                                        class="fa fa-paragraph pr-2"></i> {{$product->description}}
                                                                </li>
                                                                <li>
                                                                    <i class="fa fa-turkish-lira pr-2"></i> {{$product->price}} / {{$product->period}} Ay
                                                                </li>
                                                            </ul>
                                                            <a href="{{route('admin.product.toggle',['id'=>$product->id])}}"
                                                               class="btn @if($product->publish) btn-secondary @else btn-warning @endif btn-xs mb-2"><i
                                                                    class="fa fa-refresh pr-2"></i> @if($product->publish)
                                                                    Yayından Kaldır @else Yayınla @endif</a>
                                                            <button      onclick="$('#define_product').val('{{$product->id}}').change();"  type="button" data-toggle="modal"
                                                                    data-target="#define_product_modal"
                                                                    class="btn btn-success btn-xs mb-2"><i
                                                               class="fa fa-shopping-cart pr-2"></i> Tanımla
                                                            </button>

                                                            <a href="{{asset('dist/systems/product/'.$product->system_file)}}"
                                                               class="btn btn-info btn-xs mb-2"><i
                                                                    class="fa fa-download "></i> </a>
                                                            <button onclick="delete_product('{{$product->id}}','{{$product->name}}')" type="button" class="btn btn-danger btn-xs mb-2"><i class="fa fa-trash"></i>
                                                            </button>
                                                            <button
                                                                onclick="edit_product('{{$product->id}}','{{$product->name}}','{{$product->summary}}','{{$product->description}}','{{$product->price}}','{{$product->period}}')"
                                                                data-toggle="modal" data-target="#edit_product_modal" type="button"
                                                                class="btn btn-warning btn-xs mb-2"><i class="fa fa-edit"></i>
                                                            </button>
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

    <!-- Kullanıcıya Sistem Tanımla -->
    <div class="modal fade" id="define_product_modal" tabindex="-1" role="dialog" aria-labelledby="define_product_modal"
         aria-hidden="true">
        <div class="modal-dialog  modal-lg" role="document">
            <div class="modal-content redial-border-light">
                <div class="modal-header redial-border-light">
                    <h5 class="modal-title pt-2" id="exampleModalLabel">Kullanıcıya Lisans Tanımla</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{route('admin.product.define')}}">
                        @csrf
                        <div class="form-group">
                            <div class="input-group form-group">
                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                <select name="define_user" id="define_user" class="fancy-select form-control">
                                    <option selected disabled>Kullanıcı seçiniz</option>
                                    @foreach(\App\Models\User::all() as $user)
                                        <option value="{{$user->id}}">{{$user->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group form-group">
                                <span class="input-group-addon"><i class="fa fa-bookmark"></i></span>
                                <select name="define_product" id="define_product" class="fancy-select form-control">

                                    @foreach($products as $product)
                                        <option value="{{$product->id}}">{{$product->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-12 col-sm-6 pl-0">
                                <div class="input-group form-group">
                                    <span class="input-group-addon"><i class="fa fa-circle-thin"></i></span>
                                    <input type="text" placeholder="Başlangıç tarihi" class="form-control"
                                        name="start_date" autocomplete="off"   id="datetimepicker"/>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 pr-0">
                                <div class="input-group form-group">
                                    <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                    <input type="text" placeholder="Bitiş tarihi" class="form-control"
                                         name="end_date"  autocomplete="off" id="datetimepicker2"/>
                                </div>
                            </div>
                        </div>


                        <button type="submit"
                                class="btn btn-success btn-md redial-rounded-circle-50 btn-block">Kullanıcıya Lisans
                            Tanımla
                        </button>
                    </form>
                </div>
                <div class="modal-footer redial-border-light">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Vazgeç</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Kullanıcıya Sistem Tanımla -->

    <!-- Sistem Ekleme -->
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
                                <input id="add_product_summary" type="text" class="form-control"
                                       name="add_product_summary"
                                       placeholder="Özet"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group form-group">
                                <span class="input-group-addon"><i class="fa fa-file-text"></i></span>
                                <textarea name="add_product_description" style="height: 80px !important;"
                                          class="form-control" placeholder="Ürün açıklaması"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-12 col-sm-6 pl-0">
                                <div class="input-group form-group">
                                    <span class="input-group-addon"><i class="fa fa-turkish-lira"></i></span>
                                    <input id="add_product_price" type="text" class="form-control" name="add_product_price"
                                           placeholder="Fiyat"/>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 pr-0">
                                <div class="input-group form-group">
                                    <span class="input-group-addon"><i class="fa fa-refresh"></i></span>
                                    <input id="add_product_period" type="text" class="form-control" name="add_product_period"
                                           placeholder="Periyot"/>
                                </div>
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
    <!-- Sistem Ekleme -->

    <!-- Sistem Düzenleme -->
    <div class="modal fade" id="edit_product_modal" tabindex="-1" role="dialog" aria-labelledby="edit_product_modal"
         aria-hidden="true">
        <div class="modal-dialog  modal-lg" role="document">
            <div class="modal-content redial-border-light">
                <div class="modal-header redial-border-light">
                    <h5 class="modal-title pt-2" id="exampleModalLabel">Ürün Düzenle</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{route('admin.product.update')}}" enctype="multipart/form-data">
                        @csrf
                        <input type="text" name="edit_product_id" id="edit_product_id" hidden>
                        <div class="form-group">
                            <div class="input-group form-group">
                                <span class="input-group-addon"><i class="fa fa-bookmark"></i></span>
                                <input id="edit_product_name" type="text" name="edit_product_name" class="form-control"
                                       placeholder="Ürün adı">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group form-group">
                                <span class="input-group-addon"><i class="fa fa-indent"></i></span>
                                <input id="edit_product_summary" type="text" class="form-control"
                                       name="edit_product_summary"
                                       placeholder="Özet"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group form-group">
                                <span class="input-group-addon"><i class="fa fa-file-text"></i></span>
                                <textarea name="edit_product_description" id="edit_product_description" style="height: 80px !important;"
                                          class="form-control" placeholder="Ürün açıklaması"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-12 col-sm-6 pl-0">
                                <div class="input-group form-group">
                                    <span class="input-group-addon"><i class="fa fa-turkish-lira"></i></span>
                                    <input id="edit_product_price" type="text" class="form-control" name="edit_product_price"
                                           placeholder="Fiyat"/>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 pr-0">
                                <div class="input-group form-group">
                                    <span class="input-group-addon"><i class="fa fa-refresh"></i></span>
                                    <input id="edit_product_period" type="text" class="form-control" name="edit_product_period"
                                           placeholder="Periyot"/>
                                </div>
                            </div>

                        </div>
                        <div class="form-group">
                            <div class="input-group form-group">
                                <span class="input-group-addon"><i class="fa fa-file-image-o"></i></span>
                                <input id="edit_product_image" name="edit_product_image" type="file">

                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group form-group">
                                <span class="input-group-addon"><i class="fa fa-file"></i></span>
                                <input id="edit_product_system_file" name="edit_product_system_file" type="file">

                            </div>
                        </div>
                        <button type="submit"
                                class="btn btn-warning btn-md redial-rounded-circle-50 btn-block">Ürün Bilgilerini Güncelle
                        </button>
                    </form>
                </div>
                <div class="modal-footer redial-border-light">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Vazgeç</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Sistem Düzenleme -->
@endsection
@section('js')
    <script>
        @if(session()->has('error'))
        toastr.error('Hata - <br />   {{ session()->get('error') }}');
        @endif
    </script>
    <script>
        @if(session()->has('message'))
        toastr.success("Başarılı - <br /> {{ session()->get('message') }}");
        @endif
    </script>
    <script>
        @if ($errors->any())
        @foreach ($errors->all() as $error)
        toastr.error('Hata - <br /> {{ $error }}');
        @endforeach
        @endif
    </script>
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
    <script>
        function edit_product(id, name, summary, description, price, period) {
            $('#edit_product_id').val(id);
            $('#edit_product_name').val(name);
            $('#edit_product_summary').val(summary);
            $('#edit_product_description').val(description);
            $('#edit_product_price').val(price);
            $('#edit_product_period').val(period);
        }
    </script>
    <script src="{{asset('dist/datetimepicker/jquery.datetimepicker.full.js')}}"></script>
    <script>


        $('#datetimepicker').datetimepicker({
            lang: 'tr',
            format: 'd/m/Y H:i',
        });
        $('#datetimepicker2').datetimepicker({
            lang: 'tr',
            format: 'd/m/Y H:i',
        });
    </script>

    <script>
        function delete_product(id, name) {
            swal({
                    title: 'Emin misiniz ?',
                    text: name + "' adlı sistemi silmek üzeresiniz ?",
                    type: "warning",
                    confirmButtonText: 'SİL',
                    confirmButtonClass: 'btn-danger',
                    cancelButtonText: 'Vazgeç',
                    cancelButtonClass: 'btn-primary',
                    showCancelButton: true,

                },
                function (isConfirm) {
                    if (isConfirm) {
                        window.location.href='{{route('admin.product.delete')}}?id='+id;
                    }
                });
        }
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
    <link rel="stylesheet" href="{{asset('dist/datetimepicker/jquery.datetimepicker.min.css')}}">
@endsection
