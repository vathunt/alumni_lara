@extends('admin.layout.master_layout')

@section('title', 'Akun')

@section('content')
    @if(count($errors) > 0)
        <ul class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
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
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header user-header">
                    <strong class="card-title">Foto Profil</strong>
                </div>
                <div class="card-body fotoProfil" id="fieldFoto">
                    <img src="./images/users/{{ Auth::user()->foto_profil ? Auth::user()->foto_profil : 'no-image.png' }}" class="card-img-top" alt="Gambar">
                </div>
                <div class="card-body">
                    <span id="statusFoto"></span>
                </div>
                <div class="card-body" style="text-align: center;">
                    <h4 class="card-title mb-3">Foto Profil</h4>
                    <p class="card-text">
                        Untuk Ganti Foto, Silakan Klik Foto Profil Diatas
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header user-header">
                    <strong class="card-title">Data Pengguna</strong>
                </div>
                <div class="card-body">
                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active show" id="identitasPengguna-tab" data-toggle="tab" href="#identitasPengguna" role="tab" aria-controls="identitasPengguna" aria-selected="false">Identitas Pengguna</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="ubahPassword-tab" data-toggle="tab" href="#ubahPassword" role="tab" aria-controls="ubahPassword" aria-selected="false">Ubah Password</a>
                        </li>
                    </ul>
                    <div class="tab-content pl-3 p-1" id="myTabContent">
                        <div class="tab-pane fade active show" id="identitasPengguna" role="tabpanel" aria-labelledby="identitasPengguna-tab">
                            <form action="{{ route('update.akun') }}" method="post" class="form-horizontal" id="frmEditAkun">@csrf
                                <div class="card-body">
                                    <div class="row form-group">
                                        <div class="col col-md-4">
                                            <label for="username-input" class=" form-control-label">Username</label>
                                        </div>
                                        <div class="col-12 col-md-8">
                                            <input type="text" id="userAkun-input" name="username" class="form-control" value="{{ Auth::user()->username}}" readonly="">
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-4">
                                            <label for="input-nama" class=" form-control-label">Nama Lengkap</label>
                                        </div>
                                        <div class="col-12 col-md-8">
                                            <input type="text" id="input-nama" name="nama_lengkap" class="form-control" value="{{ Auth::user()->name }}" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-4">
                                            <label for="input-email" class=" form-control-label">Email</label>
                                        </div>
                                        <div class="col-12 col-md-8">
                                            <input type="text" id="input-email" name="email" class="form-control" value="{{ Auth::user()->email}}" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary btn-sm" id="btnEditAkun">
                                        <i class="fa fa-save"></i> Simpan
                                    </button>
                                    <button type="reset" class="btn btn-danger btn-sm">
                                        <i class="fa fa-ban"></i> Reset
                                    </button>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="ubahPassword" role="tabpanel" aria-labelledby="ubahPassword-tab">
                            <form action="{{ route('update.password') }}" method="post" class="form-horizontal" id="frmEditPassword">@csrf
                                <div class="card-body">
                                    <div class="row form-group">
                                        <div class="col col-md-4">
                                            <label for="passLama-input" class=" form-control-label">Password Lama</label>
                                        </div>
                                        <div class="col-12 col-md-8">
                                            <input type="password" id="passLama-input" name="password_lama" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-4">
                                            <label for="passBaru-input" class=" form-control-label">Password Baru</label>
                                        </div>
                                        <div class="col-12 col-md-8">
                                            <input type="password" id="passBaru-input" name="password" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-4">
                                            <label for="passBaruConf-input" class=" form-control-label">Konfirmasi Password</label>
                                        </div>
                                        <div class="col-12 col-md-8">
                                            <input type="password" id="passBaruConf-input" name="password_confirmation" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-4"></div>
                                        <div class="col-12 col-md-8">
                                            <label class="check-remaind">
                                                <input type="checkbox" onclick="lihatPassword()">
                                                <span class="checkmark"></span>
                                                <p class="show" style="float: right;">&nbsp;Lihat Password</p>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary btn-sm" id="btnEditPassword" disabled="">
                                        <i class="fa fa-save"></i> Simpan
                                    </button>
                                    <button type="reset" class="btn btn-danger btn-sm">
                                        <i class="fa fa-ban"></i> Reset
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script> 
    // Change the type of input to password or text 
        function lihatPassword() { 
            let passLama = document.getElementById("passLama-input"); 
            let passBaru = document.getElementById("passBaru-input");
            let passBaruConf = document.getElementById("passBaruConf-input");
            if (passLama.type === "password" && passBaru.type === "password" && passBaruConf.type === "password") { 
                passLama.type = "text";
                passBaru.type = "text";
                passBaruConf.type = "text";
            } 
            else { 
                passLama.type = "password"; 
                passBaru.type = "password";
                passBaruConf.type = "password";
            } 
        } 
    </script> 
@endsection

@section('javascript')
    <!-- Jquery Validate -->
    <script src="{{ asset('vendor/validate/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('vendor/validate/additional-methods.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('vendor/validate/validate-style.css') }}">

    <script type="text/javascript">
        // Validasi Ubah Identitas Pengguna
        $(document).ready(function () {
            $('#frmEditAkun').on('blur keyup', function() {
                if ($("#frmEditAkun").valid()) {
                    $('#btnEditAkun').prop('disabled', false);  
                } else {
                    $('#btnEditAkun').prop('disabled', 'disabled');
                }
            });

            $('#frmEditAkun').validate({
                rules: {
                    nama_lengkap: {required: true},
                    username: {required: true},
                    email: {required: true, email: true}
                },
                messages: {
                    nama_lengkap: {required: "Nama Lengkap Harus Diisi"},
                    username: {required: "Username Harus Diisi"},
                    email: {required: "Email Harus Diisi", email: "Email Tidak Valid"}
                },
                errorPlacement: function(error, element){
                    error.insertAfter(element);
                }
            });
        });

        // Validasi Ubah Password
        $(document).ready(function () {
            $("#frmEditPassword").on('blur keyup', function() {
                if ($("#frmEditPassword").valid()) {
                    $('#btnEditPassword').prop('disabled', false);  
                } else {
                    $('#btnEditPassword').prop('disabled', 'disabled');
                }
            });

            $('#frmEditPassword').validate({
                rules: {
                    password_lama: {
                        required: true, 
                        minlength: 8, 
                        remote: {
                            url: "{{ route('cek.password') }}",
                            type: "POST",
                            data: {
                                _token: "{{csrf_token()}}",
                                password: function () {
                                    return $("input[name='password']").val();
                                }
                            },
                            dataFilter: function (data) {
                                var json = JSON.parse(data);
                                if (json.msg == "true") {
                                    return 'true';
                                } else {
                                    return "\"" + "Password Lama Salah" + "\"";
                                }
                            }
                        }
                    },
                    password: {required: true, minlength: 8},
                    password_confirmation: {required: true, minlength: 8, equalTo: "#passBaru-input"}
                },
                messages: {
                    password_lama: {required: "Password Lama Harus Diisi", minlength: "Minimal 8 Karakter"},
                    password: {required: "Password Baru Harus Diisi", minlength: "Minimal 8 Karakter"},
                    password_confirmation: {required: "Konfirmasi Password Harus Diisi", minlength: "Minimal 8 Karakter", equalTo: "Input Password Tidak Sama"}
                },
                errorPlacement: function(error, element){
                    error.insertAfter(element);
                }
            });
        });
    </script>

    <script type="text/javascript" src="{{ asset('js/ajaxupload.3.5.js') }}" ></script>
    <script type="text/javascript" >
        window.onload = function(){
            var uplFoto = $('#fieldFoto');
            var stsFile = $('#statusFoto');
            
            new AjaxUpload (uplFoto, {
                action: "{{ route('update.foto') }}",
                type: 'POST',
                data: { _token: "{{csrf_token()}}" },
                name: 'foto_profil',
                onSubmit: function(fileFoto, ext){
                    if (! (ext && /^(jpg|png|jpeg)$/.test(ext))){ 
                        // extension is not allowed 
                        stsFile.html('<div class="sufee-alert alert with-close alert-danger alert-dismissible fade show"><span class="badge badge-pill badge-danger">Error</span> Ekstensi File Bukan *.jpg atau *.png<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></div>');
                        return false;
                    }
                    $('#statusFoto').html('<div class="sufee-alert alert-danger" style="display: flex;justify-content:center;align-items: center;"><i class="fas fa-spinner fa-pulse"></i> Upload File...</div>');
                },
                onComplete: function(fileFoto, response){
                    stsFile.html('');
                    console.log(response);
                    //Add uploaded file to list
                    if(response){
                        stsFile.html('<div class="sufee-alert alert with-close alert-success alert-dismissible fade show"><span class="badge badge-pill badge-success">Berhasil</span> Foto Profil Diubah!!!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></div>');
                        $(".fotoProfil").html('');
                        $(".fotoProfil").append("<img src='./images/users/"+response+"' class='card-img-top' alt='Gambar'>");
                    } else {
                        stsFile.html('<div class="sufee-alert alert with-close alert-danger alert-dismissible fade show"><span class="badge badge-pill badge-danger">Gagal</span> Tampaknya Ada Masalah!!!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></div>');
                    }
                }
            });
            
        };
    </script>
@endsection