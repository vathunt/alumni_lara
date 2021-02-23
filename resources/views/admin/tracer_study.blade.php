@extends('admin.layout.master_layout')

@section('title', 'Tracer Study')

@section('content')
    <!-- <style>
        /* Mark input boxes that gets an error on validation: */
        input.invalid {
          background-color: #ffdddd;
        }

        /* Hide all steps by default: */
        .tab {
          display: none;
        }

        /* Make circles that indicate the steps of the form: */
        .step {
          height: 15px;
          width: 15px;
          margin: 0 2px;
          background-color: #008000;
          border: none;  
          border-radius: 50%;
          display: inline-block;
          opacity: 0.5;
        }

        .step.active {
          opacity: 1;
        }
    </style> -->
    <link rel="stylesheet" href="{{ asset('css/jquery.steps.css') }}">
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
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <strong class="card-title">Tracer Study Alumni</strong>
                </div>
                <iframe src="https://docs.google.com/forms/d/e/1FAIpQLSd7ltBP2K4lgjwsNzBmvXjpQVnqP8r4MY1mUH3eO5JZWWLtLQ/viewform?embedded=true" width="100%" height="800" frameborder="0" marginheight="0" marginwidth="0">Memuat…</iframe>
                <!-- <form action="#" id="frmTracerStudy" method="post" enctype="multipart/form-data" class="form-horizontal">@csrf
                    <div class="card-body card-block"> -->
                        <!-- <div class="tab">
                            <div class="row form-group">
                                <div class="col col-md-2">
                                    <label for="nim-input" class=" form-control-label">NIM</label>
                                </div>
                                <div class="col-12 col-md-4">
                                    <input type="text" id="nim" name="nim" class="form-control" value="{{ $alumni->nim }}">
                                </div>
                                <div class="col col-md-2">
                                    <label for="nama-input" class=" form-control-label">Nama Alumni</label>
                                </div>
                                <div class="col-12 col-md-4">
                                    <input type="text" id="nama_alumni" name="nama_alumni" class="form-control" value="{{ $alumni->nama_alumni }}">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-2">
                                    <label for="tmpLahir-input" class=" form-control-label">Tempat Lahir</label>
                                </div>
                                <div class="col-12 col-md-4">
                                    <input type="text" id="tmp_lahir" name="tmp_lahir" class="form-control" value="{{ $alumni->tmp_lahir }}">
                                </div>
                                <div class="col col-md-2">
                                    <label for="tglLahir-input" class=" form-control-label">Tanggal Lahir</label>
                                </div>
                                <div class="col-12 col-md-4">
                                    <input type="text" id="tgl_lahir" name="tgl_lahir" class="form-control" value="{{ date_format($alumni->tgl_lahir, 'Y-m-d') }}" readonly="">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-2">
                                    <label for="disabled-input" class=" form-control-label">Jenis Kelamin</label>
                                </div>
                                <div class="col-12 col-md-4">
                                    <div class="form-check">
                                        <?php for ($i = 1; $i >= 0; $i--): ?>
                                            <div class="radio">
                                                <label for="jenisKelamin-input" class="form-check-label ">
                                                    <input type="radio" name="jenis_kelamin" value="<?=$i?>" class="form-check-input" <?= $i == $alumni->jenis_kelamin ? 'checked' : '' ?>><?= $i==1 ? 'Laki-laki' : 'Perempuan' ?>
                                                </label>
                                            </div>
                                        <?php endfor ?>
                                        <div id="errorJkInput"></div>
                                    </div>
                                </div>
                                <div class="col col-md-2">
                                    <label for="alamat-input" class=" form-control-label">Alamat</label>
                                </div>
                                <div class="col-12 col-md-4">
                                    <textarea name="alamat" id="alamat" rows="5" class="form-control">{{ $alumni->alamat }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="tab">
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="select" class=" form-control-label">Select</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <select name="select" id="select" class="form-control">
                                        <option value="0">Please select</option>
                                        <option value="1">Option #1</option>
                                        <option value="2">Option #2</option>
                                        <option value="3">Option #3</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div style="overflow:auto;">
                            <div style="float:right;">
                                <button type="button" class="btn btn-danger btn-sm" id="prevBtn" onclick="nextPrev(-1)">
                                    <i class="fa fa-arrow-circle-left"></i> Sebelumnya
                                </button>
                                <button type="button" class="btn btn-primary btn-sm" id="nextBtn" onclick="nextPrev(1)">
                                </button>
                            </div>
                        </div>
                        <div style="text-align:center;margin-top:40px;">
                            <span class="step"></span>
                            <span class="step"></span>
                        </div> -->

                        <!-- Form Step v.2 -->
                        <!-- <h3>Riwayat Pribadi</h3>
                        <section>
                            <div class="row form-group">
                                <div class="col col-md-2">
                                    <label for="nim-input" class=" form-control-label">NIM</label>
                                </div>
                                <div class="col-12 col-md-4">
                                    <input type="text" id="nim" name="nim" class="form-control" value="{{ $alumni->nim }}" readonly="">
                                </div>
                                <div class="col col-md-2">
                                    <label for="nama-input" class=" form-control-label">Nama Alumni</label>
                                </div>
                                <div class="col-12 col-md-4">
                                    <input type="text" id="nama_alumni" name="nama_alumni" class="form-control" value="{{ $alumni->nama_alumni }}" readonly="">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-2">
                                    <label for="tmpLahir-input" class=" form-control-label">Tempat Lahir</label>
                                </div>
                                <div class="col-12 col-md-4">
                                    <input type="text" id="tmp_lahir" name="tmp_lahir" class="form-control" value="{{ $alumni->tmp_lahir }}" autocomplete="off">
                                </div>
                                <div class="col col-md-2">
                                    <label for="tglLahir-input" class=" form-control-label">Tanggal Lahir</label>
                                </div>
                                <div class="col-12 col-md-4">
                                    <input type="text" id="tgl_lahir" name="tgl_lahir" class="form-control" value="{{ date_format($alumni->tgl_lahir, 'Y-m-d') }}" readonly="">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-2">
                                    <label for="jenisKelamin-input" class=" form-control-label">Jenis Kelamin</label>
                                </div>
                                <div class="col-12 col-md-4">
                                    <div id="errorJkInput"></div>
                                    <div class="form-check">
                                        <?php for ($i = 1; $i >= 0; $i--): ?>
                                            <div class="radio">
                                                <label for="jenisKelamin-input" class="form-check-label ">
                                                    <input type="radio" name="jenis_kelamin" value="<?=$i?>" class="form-check-input" <?= $i == $alumni->jenis_kelamin ? 'checked' : '' ?>><?= $i==1 ? 'Laki-laki' : 'Perempuan' ?>
                                                </label>
                                            </div>
                                        <?php endfor ?>
                                    </div>
                                </div>
                                <div class="col col-md-2">
                                    <label for="alamat-input" class=" form-control-label">Alamat</label>
                                </div>
                                <div class="col-12 col-md-4">
                                    <textarea name="alamat" id="alamat" rows="5" class="form-control">{{ $alumni->alamat }}</textarea>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-2">
                                    <label for="email-input" class="form-control-label">Email</label>
                                </div>
                                <div class="col-12 col-md-4">
                                    <input type="text" id="email" name="email" class="form-control" value="{{ Auth::user()->email }}" autocomplete="off">
                                </div>
                                <div class="col col-md-2">
                                    <label for="nope-input" class="form-control-label">No. HP</label>
                                </div>
                                <div class="col-12 col-md-4">
                                    <input type="text" id="no_hp" name="no_hp" class="form-control" autocomplete="off">
                                </div>
                            </div>
                        </section>
                        <h3>Riwayat Pendidikan</h3>
                        <section>
                            <div class="row form-group">
                                <div class="col col-md-2">
                                    <label for="thnMasuk-input" class="form-control-label">Tahun Masuk</label>
                                </div>
                                <div class="col-12 col-md-4">
                                    <input type="text" id="thn_masuk" name="thn_masuk" class="form-control" autocomplete="off">
                                </div>
                                <div class="col col-md-2">
                                    <label for="tglLulus-input" class="form-control-label">Tanggal Lulus</label>
                                </div>
                                <div class="col-12 col-md-4">
                                    <input type="text" id="tgl_lulus" name="tgl_lulus" class="form-control" readonly="">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-2">
                                    <label for="fakultas-input" class="form-control-label">Fakultas</label>
                                </div>
                                <div class="col-12 col-md-4">
                                    <select name="fakultas" id="fakultas" class="form-control">
                                        <option value="">-- Pilih Salah Satu --</option>
                                    </select>
                                </div>
                                <div class="col col-md-2">
                                    <label for="prodi-input" class="form-control-label">Program Studi</label>
                                </div>
                                <div class="col-12 col-md-4">
                                    <select name="prodi" id="prodi" class="form-control">
                                        <option value="">-- Pilih Salah Satu --</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-10">
                                    <label for="pilProdi-input" class="form-control-label">Pada saat masuk IAIN Madura, Prodi yang Saudara pilih tersebut merupakan pilihan ke?</label>
                                </div>
                                <div class="col-12 col-md-2">
                                    <select name="pilProdi" id="pilProdi" class="form-control">
                                        <option value="">-- Pilih --</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-10">
                                    <label for="questOrg-input" class="form-control-label">Apakah Saudara berorganisasi ketika masih mahasiswa?</label>
                                </div>
                                <div class="col-12 col-md-2">
                                    <select name="questOrg" id="questOrg" class="form-control" onchange="showDiv('alasanOrganisasi', this)">
                                        <option value="">-- Pilih --</option>
                                        <option value="1">Ya</option>
                                        <option value="0">Tidak</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row form-group" id="alasanOrganisasi" style="display: none;">
                                <div class="col col-md-6">
                                    <label for="alasanTidakOrganisasi-input" class="form-control-label">Mengapa Saudara Tidak Berorganisasi?</label>
                                </div>
                                <div class="col-12 col-md-6">
                                    <select name="alasanTidakOrganisasi" id="alasanTidakOrganisasi" class="form-control">
                                        <option value="">-- Pilih --</option>
                                        <option value="">Sibuk</option>
                                        <option value="">Tidak Berminat</option>
                                        <option value="">Tidak Sempat</option>
                                        <option value="">Tidak Cocok dengan Organisasi yang Ada</option>
                                        <option value="">Lainnya</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-10">
                                    <label for="afterGraduate-input" class="form-control-label">Setelah lulus Sarjana dari IAIN Madura, apakah Saudara bersekolah lagi?</label>
                                </div>
                                <div class="col-12 col-md-2">
                                    <select name="afterGraduate" id="afterGraduate" class="form-control">
                                        <option value="">-- Pilih --</option>
                                    </select>
                                </div>
                            </div>
                        </section>
                        <h3>Hints</h3>
                        <section>
                            <ul>
                                <li>Foo</li>
                                <li>Bar</li>
                                <li>Foobar</li>
                            </ul>
                        </section>
                        <h3>Finish</h3>
                        <section>
                            <input id="acceptTerms" name="acceptTerms" type="checkbox" class="required"> <label for="acceptTerms">I agree with the Terms and Conditions.</label>
                        </section> -->
                    <!-- </div>
                </form> -->
            </div>
        </div>
    </div>

    <script>
        function showDiv(divId, element)
        {
            document.getElementById(divId).style.display = element.value == 0 ? '' : 'none';
        }
    </script>
@endsection

@section('javascript')
    <!-- <script>
        let currentTab = 0; // Current tab is set to be the first tab (0)
        showTab(currentTab); // Display the current tab

        function showTab(n) {
            // This function will display the specified tab of the form...
            let x = document.getElementsByClassName("tab");
            x[n].style.display = "block";
            //... and fix the Previous/Next buttons:
            n == 0 ? document.getElementById("prevBtn").style.display = "none" : document.getElementById("prevBtn").style.display = "inline";

            n == (x.length - 1) ? $("#nextBtn").html("<i class='fa fa-save'></i> Simpan") : $("#nextBtn").html("Selanjutnya <i class='fa fa-arrow-circle-right'></i>");

            //... and run a function that will display the correct step indicator:
            fixStepIndicator(n)
        }

        function nextPrev(n) {
            // This function will figure out which tab to display
            let x = document.getElementsByClassName("tab");
            // Exit the function if any field in the current tab is invalid:
            if (n == 1 && !validateForm()) return false;
            // Hide the current tab:
            x[currentTab].style.display = "none";
            // Increase or decrease the current tab by 1:
            currentTab = currentTab + n;
            // if you have reached the end of the form...
            if (currentTab >= x.length) {
            // ... the form gets submitted:
                document.getElementById("frmTracerStudy").submit();
                return false;
            }
            // Otherwise, display the correct tab:
            showTab(currentTab);
        }

        function validateForm() {
            // This function deals with validation of the form fields
            let x, y, i, valid = true;
            x = document.getElementsByClassName("tab");
            y = x[currentTab].getElementsByTagName("input");
            // A loop that checks every input field in the current tab:
            for (i = 0; i < y.length; i++) {
            // If a field is empty...
                if (y[i].value == "") {
                    // add an "invalid" class to the field:
                    y[i].className += " invalid";
                    // and set the current valid status to false
                    valid = false;
                }
            }
            // If the valid status is true, mark the step as finished and valid:
            if (valid) {
                document.getElementsByClassName("step")[currentTab].className += " finish";
            }
            return valid; // return the valid status
        }

        function fixStepIndicator(n) {
            // This function removes the "active" class of all steps...
            let i, x = document.getElementsByClassName("step");
            for (i = 0; i < x.length; i++) {
                x[i].className = x[i].className.replace(" active", "");
            }
            //... and adds the "active" class on the current step:
            x[n].className += " active";
        }
    </script> -->

    <!-- <script src="{{ asset('js/jquery.steps.min.js') }}"></script>
    <script src="{{ asset('vendor/validate/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('vendor/validate/additional-methods.min.js') }}"></script>
    <script>
        var form = $("#frmTracerStudy");
        form.validate({
            errorPlacement: function errorPlacement(error, element) { element.attr("name") == "jenis_kelamin" ? error.appendTo($('#errorJkInput')) : element.before(error); },
            rules: {
                nim: {required: true, digits: true, minlength: 10, maxlength: 10},
                nama_alumni: {required: true},
                tmp_lahir: {required: true},
                tgl_lahir: {required: true},
                jenis_kelamin: {required: true},
                alamat: {required: true},
                email: {required: true, email: true},
                no_hp: {required: true}
            },
            messages: {
                nim: {required: "Harus Diisi", digits: "Harus Angka", minlength: "Harus 10 Karakter", maxlength: "Harus 10 Karakter"},
                nama_alumni: {required: "Harus Diisi"},
                tmp_lahir: {required: "Harus Diisi"},
                tgl_lahir: {required: "Harus Diisi"},
                jenis_kelamin: {required: "Harus Diisi"},
                alamat: {required: "Harus Diisi"},
                email: {required: "Harus Diisi", email: "Email Tidak Valid"},
                no_hp: {required: "Harus Diisi"}
            }
        });

        form.children("div").steps({
            headerTag: "h3",
            bodyTag: "section",
            transitionEffect: "slide", //none or 0, fade or 1, slide or 2, slideLeft or 3
            labels: {
                previous: '<i class="fa fa-arrow-circle-left"></i> Sebelumnya',
                next: 'Selanjutnya <i class="fa fa-arrow-circle-right"></i>',
                finish: '<i class="fa fa-save"></i> Simpan',
                current: ''
            },
            onStepChanging: (event, currentIndex, newIndex) =>
            {
                //Kembali ke halaman selanjutnya walau terdapat error
                if (currentIndex > newIndex)
                {
                    return true;
                }

                form.validate().settings.ignore = ":disabled,:hidden";
                return form.valid();
            },
            onFinishing: (event, currentIndex) =>
            {
                form.validate().settings.ignore = ":disabled";
                return form.valid();
            },
            onFinished: (event, currentIndex) =>
            {
                alert("Submitted!");
            }
        });
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
    <script>
       $(document).ready(function() {
           $("#no_hp").mask("000-000-000-000", {placeholder:"08X-XXX-XXX-XXX"});
           $("#thn_masuk").mask("0000", {placeholder:" "});
        });
    </script>

    <script type="text/javascript">
        // $('#tgl_lahir').datepicker('remove');
        $('#tgl_lahir, #tgl_lulus').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: 'true',
            onSelect: function(d,i){
                if(d !== i.lastVal){
                    $(this).change();
                }
            },
            endDate: new Date(new Date().setDate(new Date().getDate() + 0))
        });
    </script> -->
@endsection