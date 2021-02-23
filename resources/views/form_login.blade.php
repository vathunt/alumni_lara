<!--
Author: W3layouts
Author URL: http://w3layouts.com
-->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- <script language='JavaScript'>
        var txt = "..:: SIM Alumni IAIN Madura - Halaman Login ::.. ";
        var speed = 300;
        var refresh = null;
        function action() { 
            document.title = txt;
            txt = txt.substring(1,txt.length)+txt.charAt(0);
            relefresh = setTimeout("action()",speed);
        }
        action();
    </script> -->
    <title>Halaman Login - SIM Alumni IAIN Madura</title>
    <link rel="icon" href="{{ asset('images/IAIN-Madura.png') }}"/>
	<!-- Meta tag Keywords -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="UTF-8" />
	<meta name="keywords"
		content="Working Signin form Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
	<!-- //Meta tag Keywords -->
	<link href="//fonts.googleapis.com/css2?family=Karla:wght@400;700&display=swap" rel="stylesheet">
	<!--/Style-CSS -->
	<link rel="stylesheet" href="{{ asset('Login/css/style.css') }}" type="text/css" media="all" />
	<!--//Style-CSS -->
    <!-- Bootstrap CSS-->
    <link href="{{ asset('vendor/bootstrap-4.1/bootstrap.min.css') }}" rel="stylesheet" media="all">
    <!-- //Bootstrap CSS -->
    <!-- Sweet Alert -->
    <script src="{{ asset('vendor/sweetalert/sweetalert2.all.min.js') }}"></script>
    <!-- Font Awesome -->
    <!-- <link href="{{ asset('vendor/font-awesome-4.7/css/font-awesome.min.css') }}" rel="stylesheet" media="all"> -->
    <link href="{{ asset('vendor/font-awesome-5/css/fontawesome-all.min.css') }}" rel="stylesheet" media="all">

    <!-- <script src="https://www.google.com/recaptcha/api.js" async defer></script> -->
</head>

<body>

	 <!-- form section start -->
	 <section class="w3l-workinghny-form">
        <!-- /form -->
        <div class="workinghny-form-grid">
            <div class="wrapper">
                <div class="logo">
                    <h1><a class="brand-logo" href="{{ route('client.dashboard') }}" style="text-decoration: none;"><span>Sistem Informasi </span> Alumni</a></h1>
                    <!-- if logo is image enable this   
                        <a class="brand-logo" href="#index.html">
                            <img src="image-path" alt="Your logo" title="Your logo" style="height:35px;" />
                        </a> -->
                </div>
                <div class="workinghny-block-grid">
                    <div class="workinghny-left-img align-end">
                        <img src="{{ asset('Login/images/Writing CV Illustration.jpg') }}" class="img-responsive" alt="img" />
                    </div>
                    <div class="form-right-inf">
						{{-- @include('sweetalert::alert') --}}
                        @if(Session::has('sukses'))
                        <script type="application/javascript">
                            const swalWithBootstrapButtons = Swal.mixin({
                                customClass: {
                                    confirmButton: 'btn btn-success',
                                },
                                buttonsStyling: false
                            });

                            swalWithBootstrapButtons.fire({
                                title: 'Berhasil',
                                text: "{{ Session::get('sukses') }}",
                                icon: 'success',
                                confirmButtonText: '<i class="fa fa-check"></i> OK',
                                confirmButtonColor: '#3085d6'
                            });
                        </script>
                        @elseif(Session::has('error'))
                            <script type="application/javascript">
                                const swalWithBootstrapButtons = Swal.mixin({
                                    customClass: {
                                        confirmButton: 'btn btn-danger'
                                    },
                                    buttonsStyling: false
                                });

                                swalWithBootstrapButtons.fire({
                                    title: 'Gagal',
                                    text: "Periksa Kembali Username dan Password",
                                    icon: 'error',
                                    confirmButtonText: '<i class="fa fa-check"></i> OK'
                                });
                            </script>
                        @endif
                        <div class="login-form-content">
                            <h2>Where to?</h2>
                            @if(session('errors'))
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
                            <!-- @if (Session::has('error'))
                                <div class="alert alert-danger">
                                    <span class="badge badge-pill badge-danger">Gagal</span>
                                    {{ Session::get('error') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif -->
                            <form action="signin" class="signin-form" method="post" id="frmLogin">@csrf
								<div class="one-frm">
									<label>Username</label>
									<input type="text" name="username" id="username"  value="{{ old('username') }}" autocomplete="off">
								</div>
								<div class="one-frm">
									<label>Password</label>
									<input type="password" name="password" id="password" value="{{ old('password') }}" >
                                    <i class="fa fa-eye" id="togglePassword"></i>
								</div>
                                <!-- <label class="check-remaind">
                                    <input type="checkbox" onclick="Toggle()">
                                    <span class="checkmark"></span>
                                    <p class="show">Lihat Password</p>

                                </label> -->
                                <!-- <label>
                                    <div class="g-recaptcha" data-sitekey="6LfrFKQUAAAAAMzFobDZ7ZWy982lDxeps8cd1I2i"></div>
                                </label> -->
                                <button type="submit" id="btnLogin" class="btn btn-style mt-3">Masuk </button>
                                <p class="already">Buat Akun Terlebih Dahulu? <a href="register">Registrasi</a></p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- //form -->
        <!-- copyright-->
        <div class="copyright text-center">
            <div class="wrapper">
                <p class="copy-footer-29">Copyright © 2020 TIPD IAIN Madura. All rights reserved | Design by <a href="https://w3layouts.com">W3layouts</a></p>
            </div>
        </div>
        <!-- //copyright-->
    </section>
    <!-- //form section start -->
    <!-- Jquery JS-->
    <script src="{{ asset('vendor/jquery-3.2.1.min.js') }}"></script>
    <!-- //Jquery JS -->
    <!-- Bootstrap JS-->
    <script src="{{ asset('vendor/bootstrap-4.1/popper.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap-4.1/bootstrap.min.js') }}"></script>
    <!-- //Bootstrap JS -->

    <script> 
        // Change the type of input to password or text 
        // function Toggle() { 
        //     var temp = document.getElementById("password"); 
        //     if (temp.type === "password") { 
        //         temp.type = "text";
        //     } 
        //     else { 
        //         temp.type = "password"; 
        //     } 
        // } 
        $("#togglePassword").on('click', function() {

            $(this).toggleClass("fa-eye fa-eye-slash");
            var pass = $("#password");
            pass.attr("type") == "password" ? pass.attr("type", "text") : pass.attr("type", "password");
        });
    </script> 

    <!-- ReCaptcha -->
    <!-- <script type="text/javascript">
        document.getElementById("frmLogin").addEventListener("submit",function(evt)
        {

            var response = grecaptcha.getResponse();
            if(response.length == 0) 
            { 
                //reCaptcha not verified
                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: 'btn btn-danger'
                    },
                    buttonsStyling: false
                });

                swalWithBootstrapButtons.fire({
                    title: 'Gagal',
                    text: "Verifikasi Captcha Terlebih Dahulu",
                    icon: 'error',
                    confirmButtonText: '<i class="fa fa-check"></i> OK'
                });
                evt.preventDefault();
                return false;
            }
        });
    </script> -->

    <!-- Jquery Validate -->
    <script src="{{ asset('vendor/validate/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('vendor/validate/additional-methods.min.js') }}"></script>

    <script type="text/javascript">
        // Validasi Login
        $(document).ready(function () {
            $("#frmLogin").on('blur keyup', function() {
                if ($("#frmLogin").valid()) {
                    $('#btnLogin').prop('disabled', false);  
                } else {
                    $('#btnLogin').prop('disabled', 'disabled');
                }
            });

            $('#frmLogin').validate({
                rules: {
                    username: {required: true},
                    password: {required: true, minlength: 8}
                },
                messages: {
                    username: {required: "Username Harus Diisi"},
                    password: {required: "Password Harus Diisi", minlength: "Password Minimal 8 Karakter"}
                },
                errorPlacement: function(error, element){
                    error.insertBefore(element);
                }
            });
        });
    </script>

</body>

</html>