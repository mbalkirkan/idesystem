@extends('layouts.dark')
@section('title')
    Kullanıcılar
@endsection
@section('content')
    <div class="row mb-4">
        <div class="col-12 col-sm-12">
            <div class="row">
                <div class="col-12 col-md-12 mb-4">
                    <div class="card redial-border-light redial-shadow">
                        <div class="card-body">
                            <h6 class="header-title pl-3 redial-relative">Kullanıcılar</h6>
                            <table id="user_table" class="table table-bordered" cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                    <th>İsim</th>
                                    <th>E-posta</th>
                                    <th>Kullanıcı adı</th>
                                    <th>Rol</th>
                                    <th>İdeal kullanıcı adı</th>
                                    <th>Üyelik tarihi</th>
                                    <th>#</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>{{$user->username}}</td>
                                        <td><span
                                                class="badge @if($user->type==3) badge-info @elseif($user->type==2) badge-warning @else badge-primary @endif text-white">{{$user->type_name}}</span>
                                        </td>
                                        <td>{{$user->ideal_username}}</td>
                                        <td>{{\Carbon\Carbon::parse($user->created_at)->format('d/m/Y H:i')}}</td>
                                        <td>
                                            <button
                                                onclick="get_licence('{{$user->id}}')"
                                               type="button"
                                                class="btn btn-info"><i class="fa fa-bookmark"></i>
                                            </button>
                                            <button
                                                onclick="edit_fill('{{$user->id}}','{{$user->name}}','{{$user->username}}','{{$user->email}}','{{$user->ideal_username}}','{{$user->type}}')"
                                                data-toggle="modal" data-target="#user_edit_modal" type="button"
                                                class="btn btn-warning"><i class="fa fa-edit"></i>
                                            </button>
                                            <button onclick="delete_user('{{$user->id}}','{{$user->name}}')" type="button" class="btn btn-danger"><i class="fa fa-trash"></i>
                                            </button>

                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Kullanıcı Düzenleme -->
    <div class="modal fade" id="user_edit_modal" tabindex="-1" role="dialog" aria-labelledby="user_edit_modal"
         aria-hidden="true">
        <div class="modal-dialog  modal-lg" role="document">
            <div class="modal-content redial-border-light">
                <div class="modal-header redial-border-light">
                    <h5 class="modal-title pt-2" id="exampleModalLabel">Kullanıcı Düzenle</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{route('admin.user.update')}}">
                        @csrf
                        <input type="text" name="edit_id" id="edit_id" hidden>
                        <div class="form-group">
                            <div class="input-group form-group">
                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                <input id="edit_username" type="text" name="edit_username" class="form-control"
                                       placeholder="Kullanıcı Adı">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group form-group">
                                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                <input id="edit_email" type="text" class="form-control" name="edit_email"
                                       placeholder="E-mail">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group form-group">
                                <span class="input-group-addon"><i class="fa fa-address-card"></i></span>
                                <input id="edit_name" type="text" class="form-control" name="edit_name"
                                       placeholder="Adınız"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group form-group">
                                <span class="input-group-addon"><i class="fa fa-address-card"></i></span>
                                <input id="edit_ideal_username" type="text" class="form-control"
                                       name="edit_ideal_username"
                                       placeholder="İdeal Kullanıcı Adı"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group form-group">
                                <span class="input-group-addon"><i class="fa fa-handshake-o"></i></span>

                                <select name="edit_type" id="edit_type" class="fancy-select form-control">
                                    @foreach(\App\Models\UserType::all() as $type)
                                        <option value="{{$type->id}}">{{$type->role}}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>
                        <button type="submit"
                                class="btn btn-success btn-md redial-rounded-circle-50 btn-block">Kullanıcı Bilgilerini
                            Düzenle
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



    <!-- Kullanıcı Lisansları -->
    <div class="modal fade" id="user_licences" tabindex="-1" role="dialog" aria-labelledby="user_licences"
         aria-hidden="true">
        <div class="modal-dialog  modal-lg" role="document">
            <div class="modal-content redial-border-light">
                <div class="modal-header redial-border-light">
                    <h5 class="modal-title pt-2" id="exampleModalLabel">Kullanıcı Lisansları</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table id="licence_table" class="table table-bordered" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>İsim</th>
                            <th>Lisans</th>
                            <th>Başlangıç Tarihi</th>
                            <th>Bitiş Tarihi</th>
                        </tr>
                        </thead>

                    </table>
                </div>
                <div class="modal-footer redial-border-light">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Kullanıcı Lisansları -->


@endsection
@section('js')
    <script>
        $('#user_table').DataTable({
            language: {
                search: "Ara :",
                "lengthMenu": "_MENU_ Kayıt",
                "info": "_PAGE_. sayfa gösteriliyor. Toplam _PAGES_ sayfa",
                "infoFiltered": "(_MAX_ Kayıt içinden filtrelendi)",
                "infoEmpty": "Gösterilecek kayıt bulunamadı",
                "paginate": {
                    "previous": "Önceki",
                    "next": "Sonraki"
                }
            }
        });
    </script>
    <script>
        function edit_fill(id, name, username, email, ideal_username, type) {
            $('#edit_id').val(id);
            $('#edit_name').val(name);
            $('#edit_username').val(username);
            $('#edit_email').val(email);
            $('#edit_ideal_username').val(ideal_username);
            $('#edit_type').val(type).change();
        }
    </script>

    <script>
        function get_licence(id) {

            $('#licence_table').DataTable().destroy();

            $('#licence_table').DataTable( {
                processing:true,
                serverSide: true,
                paging: false,
                bDestroy:true,
                searching:false,
                dom: 'Bfrtip',
                retrieve: true,
                info:false,

                "ajax": {
                    data: {
                        'id':id,
                    } ,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    "url": "{{route('admin.user.get.licence')}}",
                    "type": "POST",
                   // "dataSrc":""
                    "dataSrc": function ( json ) {
                        if(json.length==0)
                        {
                            toastr.success("Kullanıcıya ait bir lisans bulunamadı.");
                        }
                        else{
                            $('#user_licences').modal('show');
                        }
                        return json;
                    },

                },

                "columns": [
                    { "data": "user_name" },
                    { "data": "product_name" },
                    { "data": function (data,type,row)
                        {
                            return moment( data['start_date']).format('MM/DD/YYYY hh:mm');
                        }},
                    { "data": function (data,type,row)
                        {
                            return moment( data['end_date']).format('MM/DD/YYYY hh:mm');
                        }},
                ]
            } );

        }
    </script>
    <script>
        function delete_user(id, name) {
            swal({
                    title: 'Emin misiniz ?',
                    text: name + "' adlı kullanıcıyı silmek üzeresiniz ?",
                    type: "warning",
                    confirmButtonText: 'SİL',
                    confirmButtonClass: 'btn-danger',
                    cancelButtonText: 'Vazgeç',
                    cancelButtonClass: 'btn-primary',
                    showCancelButton: true,

                },
                function (isConfirm) {
                    if (isConfirm) {
                        window.location.href='{{route('admin.user.delete')}}?id='+id;
                    }
                });
        }
    </script>
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
