<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=yes">
	<meta name="author" content="colorlib.com">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Daftar Akun - SIM Alumni IAIN Madura</title>
	<link rel="icon" href="{{ asset('images/IAIN-Madura.png') }}"/>

    <!-- Font Icon -->
    <link rel="stylesheet" href="{{ asset('vendor/mdi-font/css/material-design-iconic-font.min.css') }}">

    <!-- Sweet Alert -->
    <script src="{{ asset('vendor/sweetalert/sweetalert2.all.min.js') }}"></script>

    <!-- Main css -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>

    <div class="main">
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <div class="card-text">
                        <h2>Form Registrasi Akun</h2>
                        <a href="{{ url('/') }}"><span class="home"><i class="zmdi zmdi-home"></i></span></a>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
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

            <form id="signup-form" class="signup-form" enctype="multipart/form-data">@csrf
                <input type="hidden" id="fotoReg" name="foto_alumni">
                <h3></h3>
                <fieldset>
                    <span class="step-current"> <span class="step-current-content"><span class="step-number"><span>01</span>/03</span></span> </span>
                    <div class="fieldset-flex">
                        <figure>
                            <img src="{{ asset('images/signup-step-1.png') }}" alt="">
                        </figure>
                        <div class="fieldset-content">
                            <label class="form-label">Silakan Masukkan NIM</label>
                            <div class="form-group">
                                <input type="text" name="nim" id="nimReg" placeholder="NIM" autocomplete="off" />
                                <div id="nimList"></div>
                            </div>
                            <div class="form-group">
                                <input type="text" name="nama_alumni" id="namaReg" placeholder="Nama Alumni" readonly="" />
                            </div>
                            <div class="form-group">
                                <input type="text" name="tmp_lahir" id="tmpReg" placeholder="Tempat Lahir" readonly="" />
                            </div>
                            <div class="form-group">
                                <input type="text" name="tgl_lahir" id="tglReg" placeholder="Tanggal Lahir" readonly="" />
                            </div>
                            <div class="form-group">
                            	<textarea name="alamat" id="alamatReg" rows="2" placeholder="Alamat" readonly=""></textarea>
                            </div>
                        </div>
                    </div>
                </fieldset>

                <h3></h3>
                <fieldset>
                    <span class="step-current"><span class="step-current-content"><span class="step-number"><span>02</span>/03</span></span></span>
                    <div class="fieldset-flex">
                        <figure>
                            <img src="{{ asset('images/signup-step-2.png') }}" alt="">
                        </figure>
                        <div class="fieldset-content">
                            <label for="your_review" class="form-label">Silakan Masukkan Data Login Anda</label>
                            <div class="form-group">
                            	<input type="text" name="username" id="usernameReg" placeholder="Username" autocomplete="off">
                            </div>
                            <div class="form-group">
                            	<input type="password" name="password" id="passwordReg" placeholder="Password">
                            	<i class="zmdi zmdi-eye" id="togglePassword"></i>
                            </div>
                            <div class="form-group">
                            	<input type="password" name="password_confirmation" id="passwordConfReg" placeholder="Konfirmasi Password">
                            	<i class="zmdi zmdi-eye" id="togglePasswordConf"></i>
                            </div>
                            <div class="form-group">
                            	<input type="text" name="email" id="emailReg" placeholder="Email" autocomplete="off">
                            </div>
                        </div>
                    </div>
                </fieldset>

                <h3></h3>
                <fieldset>
                    <span class="step-current"><span class="step-current-content"><span class="step-number"><span>03</span>/03</span></span></span>
                    <div class="fieldset-flex">
                        <figure>
                            <img src="{{ asset('images/signup-step-3.png') }}" alt="Langkah 3">
                        </figure>
                        <div class="fieldset-content">
                            <label class="form-label">Konfirmasi</label>
                            <div class="table-responsive">
                                <table class="table">
									<tbody>
										<tr class="space-row">
											<th>NIM</th>
											<td id="nim-val"></td>
										</tr>
										<tr class="space-row">
											<th>Username</th>
											<td id="username-val"></td>
										</tr>
										<tr class="space-row">
											<th>Password</th>
											<td id="password-val"></td>
										</tr>
										<tr class="space-row">
											<th>Nama Alumni</th>
											<td id="nama-val"></td>
										</tr>
										<tr class="space-row">
											<th>Tempat, Tgl. Lahir</th>
											<td id="tmpTgl-val"></td>
										</tr>
										<tr class="space-row">
											<th>Alamat</th>
											<td id="alamat-val"></td>
										</tr>
										<tr class="space-row">
											<th>Email</th>
											<td id="email-val"></td>
										</tr>
									</tbody>
								</table>
                            </div>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>

    </div>

    <!-- JS -->
    <script src="{{ asset('vendor/jquery-3.5.1.min.js') }}"></script>
	<script src="{{ asset('js/jquery.steps.min.js') }}"></script>
    <!-- Jquery Validate -->
    <script src="{{ asset('vendor/validate/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('vendor/validate/additional-methods.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('vendor/validate/validate-style.css') }}">

    <script>
    	$(document).ready(function() {
    		var form = $("#signup-form");
            var rowSelector = ".form-group";
            
            form.validate({
                onfocusout: function (element) {
                    var element = $(element);
                    element.valid();
                },
                onclick: function(element) {
                    var row = $(element).closest(rowSelector);
                    if (row.hasClass('is-row-error')) {
                        $(element).valid();
                    }
                },
    			rules: {
                    nim: {required: true, digits: true, minlength: 10, maxlength: 10},
                    nama_alumni: {required: true},
                    tmp_lahir: {required: true},
                    tgl_lahir: {required: true},
                    alamat: {required: true},

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
                                    return "\"" + "Username Sudah Dipakai" + "\"";
                                } else {
                                    return 'true';
                                }
                            }
                        }
                    },
                    password: {required: true, minlength: 8},
                    password_confirmation: {required: true, minlength: 8, equalTo: "#passwordReg"},
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
                    }
                },
                messages: {
                    nim: { required: "Harus Diisi", digits: "Harus Digit Angka", minlength: "Panjang 10 Karakter", maxlength: "Panjang 10 Karakter"},
                    nama_alumni: {required: "Harus Diisi"},
                    tmp_lahir: {required: "Harus Diisi"},
                    tgl_lahir: {required: "Harus Diisi"},
                    alamat: {required: "Harus Diisi"},

                    username: {required: "Username Harus Diisi"},
                    password: {required: "Password Harus Diisi", minlength: "Panjang Karakter Minimal 8 Digit"},
                    password_confirmation: {required: "Konfirmasi Password Harus Diisi", minlength: "Panjang Karakter Minimal 8 Digit", equalTo: "Password Tidak Sama"},
                    email: {required: "Email Harus Diisi", email: "Email Tidak Valid"}
                },
                errorPlacement: function errorPlacement (error, element){
					error.insertAfter(element);
                }
    		});

		    form.steps({
		        headerTag: "h3",
		        bodyTag: "fieldset",
		        transitionEffect: "fade",
		        labels: {
		            previous: 'Sebelumnya',
		            next: 'Selanjutnya',
		            finish: 'Simpan',
		            current: ''
		        },
		        titleTemplate: '<h3 class="title">#title#</h3>',
		        onStepChanging: function (event, currentIndex, newIndex)
		        {
                    var nim 		= $('#nimReg').val();
		            var nama_alumni = $('#namaReg').val();
		            var tmpTgl_lahir 	= $('#tmpReg').val() + ", " + $('#tglReg').val();
		            var alamat 		= $('#alamatReg').val();

		            var username 	= $('#usernameReg').val();
		            var password 	= $('#passwordReg').val();
		            var email 		= $('#emailReg').val();

                    let txt_password = '';
                    for (let i = 0; i <= password.length - 1; i++) {
                        if (i >= 2 && i <= password.length - 3) {
                            txt_password += password[i].replace(password[i], '*');
                        } else {
                            txt_password += password[i];
                        }
                    }

		            $('#nim-val').text(nim);
		            $('#nama-val').text(nama_alumni);
		            $('#tmpTgl-val').text(tmpTgl_lahir);
		            $('#alamat-val').text(alamat);

		            $('#username-val').text(username);
		            // $('#password-val').text(password.replace(password.substring(3, password.length - 2), '*****'));
                    $('#password-val').text(txt_password);
		            $('#email-val').text(email);

		        	form.validate().settings.ignore = ":disabled,:hidden";
		            // console.log(form.steps("getCurrentIndex"));
		            return form.valid();

		            // if(currentIndex === 0) {

		            //     form.find('.content .body .step-current-content').find('.step-inner').removeClass('.step-inner-0');
		            //     form.find('.content .body .step-current-content').find('.step-inner').removeClass('.step-inner-1');
		            //     form.find('.content .body .step-current-content').append('<span class="step-inner step-inner-' + currentIndex + '"></span>');
		            // }

		            // if(currentIndex === 1) {
		            //     form.find('.content .body .step-current-content').find('.step-inner').removeClass('step-inner-0').addClass('step-inner-'+ currentIndex + '');
		            // }

		            // return true;
		        },
		        onFinishing: function(event, currentIndex) {
		            form.validate().settings.ignore = ":disabled";
		            // console.log(currentIndex);
		            return form.valid();
		        },
		        onFinished: function(event, currentIndex) {
		            // alert('Submited');
					$.ajax({
						url: 'register',
						method: 'post',
						data: $(this).serialize(),             
						success: function(data) {    
                            document.getElementById('signup-form').reset();          
							let pesan = JSON.parse(JSON.stringify(data));
                            swal.fire({
                                title: 'Berhasil',
                                text: pesan.pesan,
                                icon: 'success',
                                confirmButtonText: 'OK',
                                confirmButtonColor: '#3085d6'
                            }).then(function() {
                                window.location.href = "{{ route('form.login') }}";
                            });
						},
                        error: function(data) {
                            swal.fire({
                                title: 'Gagal',
                                text: 'Proses Registrasi Gagal',
                                icon: 'error',
                                confirmButtonText: 'OK',
                                confirmButtonColor: '#3085d6'
                            }).then(function() {
                                window.location.reload();
                            });
                        }
					});
		        }
		    });

		    $("#togglePassword").on('click', function() {

		        $(this).toggleClass("zmdi-eye zmdi-eye-off");
		        var pass = $("#passwordReg");
		        pass.attr("type") == "password" ? pass.attr("type", "text") : pass.attr("type", "password");
		    });

		    $("#togglePasswordConf").on('click', function() {

		        $(this).toggleClass("zmdi-eye zmdi-eye-off");
		        var passConf = $("#passwordConfReg");
		    	passConf.attr("type") == "password" ? passConf.attr("type", "text") : passConf.attr("type", "password");
		    });
    	});
    </script>

    <script>  
		$(document).ready(function(){  
		 	$('#nimReg').on('keyup',function(){  
	        	$.ajax({  
					url: "{{ route('search.nim') }}",  
					method: "POST",  
					data: {
						_token: "{{csrf_token()}}",
                        nimReg: function () {
                            return $('#nimReg').val();
                        }
					}, 
					success:function(data)  
					{  
						$('#nimList').fadeIn();  
						$('#nimList').html(data);  
					}  
	            });  
			});  

			$(document).on('click', '.nimReg', function(){ 
				$('#nimReg').val($(this).text());  
				$('#nimList').fadeOut(); 

				$.ajax({  
					url: "{{ route('nim.find') }}",  
					method: "POST", 
					dataType: "json", 
					data: {
						_token: "{{csrf_token()}}",
                        nimFind: function () {
                            return $('#nimReg').val();
                        }
					}
	            }).done(function(respon)  
				{
					$('#namaReg').val(respon[0].nama_alumni);  
					$('#tmpReg').val(respon[0].tmp_lahir);
					$('#tglReg').val(format(respon[0].tgl_lahir));
					$('#alamatReg').val(respon[0].alamat);  
                    $('#fotoReg').val(respon[0].foto_alumni);
				}); 
			});  
		});  

		function format(inputDate) {
	        const date = new Date(inputDate);
	        if (!isNaN(date.getTime())) {
	            const day = date.getDate().toString();
	            // var month = (date.getMonth() + 1).toString();
	            // Months use 0 index.
	            let month = date.getMonth();

	            switch(month) {
	              case 0: month = "Januari"; break;
	              case 1: month = "Februari"; break;
	              case 2: month = "Maret"; break;
	              case 3: month = "April"; break;
	              case 4: month = "Mei"; break;
	              case 5: month = "Juni"; break;
	              case 6: month = "Juli"; break;
	              case 7: month = "Agustus"; break;
	              case 8: month = "September"; break;
	              case 9: month = "Oktober"; break;
	              case 10: month = "November"; break;
	              case 11: month = "Desember"; break;
	            }

	            return (day[1] ? day : '0' + day[0]) + ' ' + month + ' ' + date.getFullYear();

	        }
	    }
	</script>
</body>

</html>