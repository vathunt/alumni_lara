@extends('admin.layout.master_layout')

@section('title', 'Pengguna')

@section('content')
    @if(count($errors) > 0)
        <ul class="sufee-alert alert with-close alert-danger alert-dismissible fade show" style="padding-left: 2.25rem">
            <span class="badge badge-pill badge-danger">Gagal</span>
        @foreach($errors->all() as $error)
            <li>
                {{ $error }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </li>
        @endforeach
        </ul>
    @endif
    <!-- @if(Session::has('pesan'))
        <div class="sufee-alert alert with-close alert-{{ Session::get('cat') }} alert-dismissible fade show">
            <span class="badge badge-pill badge-{{ Session::get('cat') }}">Sukses</span>
            {{ Session::get('pesan') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <strong class="card-title">Data Pengguna</strong>
                </div>
                <div class="card-body">
                    <div class="table-data__tool">
                        <div class="table-data__tool-right">
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small" data-toggle="modal" data-target="#tambahPengguna">
                                <i class="zmdi zmdi-plus"></i>Tambah Data</button>
                        </div>
                    </div>
                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2 table-striped" id="table-pengguna">
                            <thead>
                                <tr style="text-align: center;">
                                    <th>No.</th>
                                    <th>Nama</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody style="text-align: center;">
                                {{-- @foreach($alumni as $key => $data)
                                <!-- <tr class="tr-shadow" id="tr_alumni-{{ $key }}" style="text-align: center;">
                                    <input type="hidden" name="id" class="id" value="{{ $data->id }}">
                                    <input type="hidden" name="nama" class="nama" value="{{ $data->nama_alumni }}">
                                    <td>{{ $loop->iteration }} 
                                    </td>
                                    <td>{{ $data->nim }}</td>
                                    <td>{{ $data->nama_alumni }}</td>
                                    <td>{{ $data->tmp_lahir }}, {{ showDateTime($data->tgl_lahir, 'd F Y') }}</td>
                                    <td>{{ $data->jenis_kelamin==1?"Laki-laki":"Perempuan" }}</td>
                                    <td>{{ $data->alamat }}</td>
                                    <td>
                                        <div class="table-data-feature">
                                            <button class="item btn btn-primary" data-placement="top" onClick="editAlumni('{{ $data->id }}')" title="Edit Data Alumni">
                                                <i class="zmdi zmdi-edit"></i>
                                            </button>
                                            <button class="item btn btn-danger" onClick="hapusAlumni('{{ $key }}')" data-placement="top" title="Hapus Data Alumni" data-toggle="modal" data-target="#hapusAlumni">
                                                <i class="zmdi zmdi-delete"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr> -->
                                endforeach --}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        var id; //Variabel Publik

        function hapusPengguna(id, nama) {
            $('#idDelPengguna').val(id);
            $('.namaPengguna').text(nama);
        }


        function editPengguna(id){
            $.ajax({
                url: "{{ url('/') }}/pengguna/"+id,
                dataType: "json"
            }).done(function(respon) {
                $('#idEditUser').val(respon.id);
                $('#namaLengkap-edit').val(respon.name);
                $('#username-edit').val(respon.username);
                $('#email-edit').val(respon.email);
                $('[name="status"][value="'+respon.id_status+'"]').prop('checked',true);
                
                // respon.id_status === 2 ? document.getElementById('namaLengkap-edit').disabled = true : document.getElementById('namaLengkap-edit').disabled = false;
                
                $("#preview").html('');
                let gambar = respon.foto_profil;
                if (gambar) {
                    gambar = respon.foto_profil
                } else {
                    gambar = 'no-image.png';
                } 
                $("#preview").append("<img src='./images/users/"+gambar+"' class='contentimg' id='fotoPenggunaTampil'>");

                // console.log(respon.name);
                $('#editPengguna').modal('toggle');
            });
        }
    </script>
@endsection

@section('modal')
    <!-- Modal Tambah Pengguna -->
    <div class="modal fade" id="tambahPengguna" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="largeModalLabel">Tambah Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('pengguna.store') }}" id="frmTmbPengguna" method="post" enctype="multipart/form-data" class="form-horizontal">@csrf
                    <div class="modal-body">
                        <div class="row form-group">
                            <div class="col col-md-3"><label for="namaUser-input" class=" form-control-label">Nama Lengkap</label></div>
                            <div class="col-12 col-md-9">
                                <input type="text" id="namaUser-input" name="nama" class="form-control" autocomplete="off">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3"><label for="username-input" class=" form-control-label">Username</label></div>
                            <div class="col-12 col-md-9"><input type="text" id="username-input" name="username" class="form-control" autocomplete="off"></div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3"><label for="password-input" class=" form-control-label">Password</label></div>
                            <div class="col-12 col-md-9">
                                <input type="password" id="password-input" name="password" class="form-control">
                                <i class="toggle fa fa-eye" id="togglePasswordInput"></i>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3"><label for="passwordConf-input" class=" form-control-label">Konfirmasi Password</label></div>
                            <div class="col-12 col-md-9">
                                <input type="password" id="passwordConf-input" name="password_confirmation" class="form-control">
                                <i class="toggle fa fa-eye" id="togglePasswordConfInput"></i>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3"><label for="email-input" class=" form-control-label">Email</label></div>
                            <div class="col-12 col-md-9"><input type="text" id="email-input" name="email" class=" form-control" autocomplete="off"></div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3"><label for="status-input" class="form-control-label">Status</label></div>
                            <div class="col col-md-9">
                                <div class="form-check">
                                    @foreach($status as $data)
                                    <div class="radio">
                                        <label for="status-input" class="form-check-label ">
                                            <input type="radio" id="statusUser{{ $data->id }}" name="status" value="{{ $data->id }}" class="form-check-input" {{ $data->id == 2 ? 'disabled' : 'checked' }}>{{ $data->status }}
                                        </label>
                                    </div>
                                    @endforeach
                                    <div id="errorbox"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3"><label for="foto-input" class=" form-control-label">Foto Profil</label></div>
                            <div class="col-12 col-md-9">
                                <img id="fotoPengguna" src="./images/users/no-image.png" style="width: 40%;">
                                <input type="file" id="foto-input" name="foto_profil" class=" form-control" accept="image/*">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">
                            <i class="fa fa-ban"></i> Batal
                        </button>
                        <button type="submit" class="btn btn-primary btn-sm" id="btnTmbPengguna" disabled="">
                            <i class="fa fa-save"></i> Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Akhir Modal Tambah Pengguna -->

    <!-- Modal Edit Pengguna -->
    <div class="modal fade" id="editPengguna" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalMdTitle">Edit Data Pengguna</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('pengguna.update') }}" id="frmEditPengguna" method="post" enctype="multipart/form-data" class="form-horizontal">@csrf
                    <input type="hidden" name="idEdit" id="idEditUser">
                    <div class="modal-body">
                        <div class="row form-group">
                            <div class="col col-md-3"><label for="nama-edit" class=" form-control-label">Nama Lengkap</label></div>
                            <div class="col-12 col-md-9"><input type="text" id="namaLengkap-edit" name="nama" class="form-control" autocomplete="off"></div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3"><label for="username-edit" class=" form-control-label">Username</label></div>
                            <div class="col-12 col-md-9"><input type="text" id="username-edit" name="username" class="form-control" readonly=""></div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3"><label for="email-edit" class=" form-control-label">Email</label></div>
                            <div class="col-12 col-md-9"><input type="text" id="email-edit" name="email" class=" form-control" autocomplete="off"></div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3"><label class="form-control-label">Status</label></div>
                            <div class="col col-md-9">
                                <div class="form-check">
                                    @foreach($status as $data)
                                    <div class="radio">
                                        <label for="status-input" class="form-check-label ">
                                            <input type="radio" id="status{{ $data->id }}" name="status" value="{{ $data->id }}" class="form-check-input">{{ $data->status }}
                                        </label>
                                    </div>
                                    @endforeach
                                </div>
                                <div id="errorbox"></div>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3"><label for="foto-edit" class=" form-control-label">Foto Profil</label></div>
                            <div class="col-12 col-md-9">
                                <div id="preview" style="width: 40%;"></div>
                                <input type="file" id="foto-edit" name="foto_profil" class=" form-control" accept="image/*">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">
                            <i class="fa fa-ban"></i> Batal
                        </button>
                        <button type="submit" class="btn btn-primary btn-sm" id="btnEditPengguna">
                            <i class="fa fa-edit"></i> Ubah
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Akhir Modal Edit Pengguna -->

    <!-- Modal Hapus Pengguna -->
    <div class="modal fade" id="hapusPengguna" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Hapus Data Pengguna</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="modalMdContent">
                        <h4 class="text-center">Apakah anda yakin ingin menghapus data pengguna <span class="namaPengguna"></span>?</h4>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal">
                        <i class="fas fa-ban"></i> Batal
                    </button>
                    <form action="{{ url('pengguna') }}" method="post">
                        @csrf
                        @method('delete')
                        <input type="hidden" name="id" id="idDelPengguna">
                        <button type="submit" class="btn btn-danger btn-sm" >
                            <i class="fas fa-trash"></i> Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Akhir Modal Hapus Pengguna -->
@endsection

@section('javascript')
    <!-- Toggle Password -->
    <script>
        $('#togglePasswordInput').on('click', function() {
            $(this).toggleClass('fa-eye fa-eye-slash');
            let pass = $('#password-input');
            pass.attr('type') == 'password' ? pass.attr('type', 'text') : pass.attr('type', 'password');
        });

        $('#togglePasswordConfInput').on('click', function() {
            $(this).toggleClass('fa-eye fa-eye-slash');
            let pass = $('#passwordConf-input');
            pass.attr('type') == 'password' ? pass.attr('type', 'text') : pass.attr('type', 'password');
        });
    </script>

    <!-- Ajax Untuk Menampilkan Data Pengguna -->
    <script type="text/javascript">
        var table_pengguna = $('#table-pengguna').DataTable({ 
            processing: true,
            serverSide: true,
            ajax: {
                "url": "{{ route('pengguna.data') }}",
                "dataType": "json",
                "type": "GET",
                // "data":{ _token: "{{csrf_token()}}"}
            },
            columns: [
                {"data": null, "orderable": false, 
                   render: function (data, type, row, meta) {
                             return meta.row + meta.settings._iDisplayStart + 1;
                            }  
                },
                {"data": "name"},
                {"data": "username"},
                {"data": "email"},
                {"render": function ( data, type, row ) {
                                if(row.status == "admin"){ 
                                    status = '<span class="role admin">Admin</span>'
                                }else{ 
                                    status = '<span class="role member">Alumni</span>'
                                }
                                return status;
                            }
                },
                // {"data": "status"},
                {"data": "action", "name": "action", "orderable": false},
            ],
            "columnDefs": [
                { "width": "12%", "targets": 5 },
                { "targets": "__all", "visible": false }
             ]
        });
    </script>
    <!-- Akhir Ajax Untuk Menampilkan Data Pengguna -->

    <!-- Menampilkan Foto Ketika Diupload (Insert) -->
    <script>
        $(document).ready(function() {
            $("#foto-input").change(function(event) {  
                fadeInAdd();
                getURL(this);    
            });

            $("#foto-input").on('click',function(event){
                fadeInAdd();
            });

            function getURL(input) {  
                if (input.files && input.files[0]) {  
                    var reader = new FileReader();
                    var filename = $("#foto-input").val();
                    filename = filename.substring(filename.lastIndexOf('\\')+1);
                    reader.onload = function(e) {
                        // debugger;
                        $('#fotoPengguna').attr('src', e.target.result);
                        $('#fotoPengguna').hide();
                        $('#fotoPengguna').fadeIn(500);      
                        // $('.custom-file-label').text(filename);             
                    }
                    reader.readAsDataURL(input.files[0]);    
                }
                $(".alert").removeClass("loadAnimate").hide();
            }
        });

        function fadeInAdd(){
            fadeInAlert();  
        }
        function fadeInAlert(text){
            $(".alert").text(text).addClass("loadAnimate");  
        }
    </script>
    <!-- Akhir Menampilkan Foto Ketika Diupload (Insert) -->

    <!-- Menampilkan Foto Ketika Diupload (Update) -->
    <script>
        $(document).ready(function() {
            $("#foto-edit").change(function(event) {  
              fadeInAdd();
              getURL(this);    
            });

            $("#foto-edit").on('click',function(event){
              fadeInAdd();
            });

            function getURL(input) {    
              if (input.files && input.files[0]) {   
                var reader = new FileReader();
                var filename = $("#foto-edit").val();
                filename = filename.substring(filename.lastIndexOf('\\')+1);
                reader.onload = function(e) {
                  // debugger;
                  $('#fotoPenggunaTampil').hide();
                  $('#fotoPenggunaTampil').attr('src', e.target.result);
                  $('#fotoPenggunaTampil').fadeIn(500);      
                  // $('.custom-file-label').text(filename);             
                }
                reader.readAsDataURL(input.files[0]);    
              }
              $(".alert").removeClass("loadAnimate").hide();
            }
        });

        function fadeInAdd(){
          fadeInAlert();  
        }
        function fadeInAlert(text){
          $(".alert").text(text).addClass("loadAnimate");  
        }
    </script>
    <!-- Akhir Menampilkan Foto Ketika Diupload (Update) -->

    <!-- Jquery Validate -->
    <script src="{{ asset('vendor/validate/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('vendor/validate/additional-methods.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('vendor/validate/validate-style.css') }}">

    <!-- Validasi -->
    <script type="text/javascript">
        // Validasi Tambah Pengguna
        $(document).ready(function () {
            // jQuery.validator.setDefaults({
            //   debug: true,
            //   success: "valid"
            // });

            $('#frmTmbPengguna').on('blur change', function() {
                if ($("#frmTmbPengguna").valid()) {
                    $('#btnTmbPengguna').prop('disabled', false);  
                } else {
                    $('#btnTmbPengguna').prop('disabled', 'disabled');
                }
            });

            // $.validator.addMethod('maxupload', function(value, element, param) {
            //    var length = ( element.files.length );
            //     return this.optional( element ) || length <= param;
            // });

            $.validator.addMethod('maxfilesize', function(value, element, param) {
                var length = ( element.files.length );
                var fileSize = 0;
                if (length > 0) {
                   fileSize = element.files[0].size; // get file size
                   // console.log(element.files[0].size);
                    // console.log("if" +length);
                        fileSize = fileSize / 1000000; //file size in Mb
                        // console.log(fileSize);
                     return this.optional( element ) || fileSize <= param;
                } else {
                    return this.optional( element ) || fileSize <= param;
                        //console.log("else" +length);
                }
            });

            $('#frmTmbPengguna').validate({ // initialize the plugin
                rules: {
                    nama: {required: true},
                    username: {
                        required: true,
                        remote: {
                            url: "{{ route('cek.user') }}",
                            type: "POST",
                            data: {
                                _token: "{{csrf_token()}}",
                                username_input: function () {
                                    return $("input[name='username']").val();
                                }
                            },
                            dataFilter: function (data) {
                                var json = JSON.parse(data);
                                if (json.msg === "true") {
                                    return "\"" + "Username Sudah Diapakai" + "\"";
                                } else {
                                    return 'true';
                                }
                            }
                        }
                    },
                    password: {required: true, minlength: 8},
                    password_confirmation: {required: true, minlength: 8, equalTo: "#password-input"},
                    email: {
                        required: true, 
                        email: true,
                        remote: {
                            url: "{{ route('cek.email') }}",
                            type: "POST",
                            data: {
                                _token: "{{csrf_token()}}",
                                email_input: function () {
                                    return $("input[name='email']").val();
                                }
                            },
                            dataFilter: function (data) {
                                var json = JSON.parse(data);
                                if (json.message === "true") {
                                    return "\"" + "Email Sudah Dipakai" + "\"";
                                } else {
                                    return 'true';
                                }
                            }
                        }
                    },
                    status: {required: true},
                    foto_profil: {maxfilesize: 2, extension: "jpg|jpeg|png"}
                },
                messages: {
                    nama: {required: "Nama Lengkap Harus Diisi"},
                    username: {required: "Username Harus Diisi"},
                    password: {required: "Password Harus Diisi", minlength: "Panjang Karakter Minimal 8 Digit"},
                    password_confirmation: {required: "Konfirmasi Password Harus Diisi", minlength: "Panjang Karakter Minimal 8 Digit", equalTo: "Password Tidak Sama"},
                    email: {required: "Email Harus Diisi", email: "Email Tidak Valid"},
                    status: {required: "Status Harus Dipilih"},
                    foto_profil: {maxfilesize: "Ukuran File Tidak Boleh Lebih dari 2 MB", extension: "Ekstensi Yang Diijinkan Harus *.png, *.jpg, *.jpeg"}
                },
                errorPlacement: function(error, element){
                    if(element.attr("name") == "status"){
                        error.appendTo($('#errorbox'));
                    }else{
                        // error.appendTo(element.parent().next());
                        error.insertAfter(element);
                    }
                }
            });
        });

        // Validasi Ubah Pengguna
        $(document).ready(function () {
            $('#frmEditPengguna').on('blur keyup', function() {
                if ($("#frmEditPengguna").valid()) {
                    $('#btnEditPengguna').prop('disabled', false);  
                } else {
                    $('#btnEditPengguna').prop('disabled', 'disabled');
                }
            });

            $.validator.addMethod('maxfilesize', function(value, element, param) {
                var length = ( element.files.length );
                var fileSize = 0;
                if (length > 0) {
                   fileSize = element.files[0].size;
                        fileSize = fileSize / 1000000;
                     return this.optional( element ) || fileSize <= param;
                } else {
                    return this.optional( element ) || fileSize <= param;
                }
            });

            $('#frmEditPengguna').validate({
                rules: {
                    nama: {required: true},
                    username: {required: true},
                    password: {required: true, minlength: 8},
                    password_confirmation: {required: true, minlength: 8, equalTo: "#password-input"},
                    email: {
                        required: true, 
                        email: true,
                        remote: {
                            url: "{{ route('cek.email') }}",
                            type: "POST",
                            data: {
                                _token: "{{csrf_token()}}",
                                id_edit: function() {
                                    return $("#idEditUser").val();
                                },
                                email_edit: function () {
                                    return $("input[name='email']").val();
                                }
                            },
                            dataFilter: function (data) {
                                var json = JSON.parse(data);
                                if (json.message === "true") {
                                    return "\"" + "Email Sudah Dipakai" + "\"";
                                } else {
                                    return 'true';
                                }
                            }
                        }
                    },
                    status: {required: true},
                    foto_profil: {maxfilesize: 2, extension: "jpg|jpeg|png"}
                },
                messages: {
                    nama: {required: "Nama Lengkap Harus Diisi"},
                    username: {required: "Username Harus Diisi"},
                    password: {required: "Password Harus Diisi", minlength: "Panjang Karakter Minimal 8 Digit"},
                    password_confirmation: {required: "Konfirmasi Password Harus Diisi", minlength: "Panjang Karakter Minimal 8 Digit", equalTo: "Password Tidak Sama"},
                    email: {required: "Email Harus Diisi", email: "Email Tidak Valid"},
                    status: {required: "Status Harus Dipilih"},
                    foto_profil: {maxfilesize: "Ukuran File Tidak Boleh Lebih dari 2 MB", extension: "Ekstensi Yang Diijinkan Harus *.png, *.jpg, *.jpeg"}
                },
                errorPlacement: function(error, element){
                    if(element.attr("name") == "status"){
                        error.appendTo($('#errorbox'));
                    }else{
                        // error.appendTo(element.parent().next());
                        error.insertAfter(element);
                    }
                }
            });
        });
    </script>
    <!-- Akhir Jquery Validate -->
@endsection