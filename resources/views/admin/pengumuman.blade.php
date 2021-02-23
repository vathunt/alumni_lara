@extends('admin.layout.master_layout')

@section('title', 'Pengumuman')

@section('content')
    <link href="{{ asset('vendor/kartik-v/bootstrap-fileinput/css/fileinput.css') }}" media="all" rel="stylesheet" type="text/css"/>
    <style>
        .td_center {
            text-align: center;
            vertical-align: top !important;
        }
    </style>
    @if(count($errors) > 0)
        <ul class="sufee-alert alert with-close alert-danger alert-dismissible fade show" style="padding-left: 2.25rem;">
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
                    <strong class="card-title">Data Pengumuman</strong>
                </div>
                <div class="card-body">
                    <div class="table-data__tool">
                        <div class="table-data__tool-right">
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small" data-toggle="modal" data-target="#tambahPengumuman">
                                <i class="zmdi zmdi-plus"></i>Tambah Data
                            </button>
                        </div>
                    </div>

                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2 table-striped" id="table-pengumuman">
                            <thead>
                                <tr style="text-align: center;">
                                    <th>No.</th>
                                    <th>Judul Pengumuman</th>
                                    <th>Isi Pengumuman</th>
                                    <th>Tanggal Dibuat</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        var id;
        function editPengumuman(id){
            $('.datepicker').datepicker('remove');
            $.ajax({
                url: "{{ url('/') }}/alumni/"+id,
                dataType: "json"
            }).done(function(respon) {
                $('#idEdit').val(respon.id);
                $('#nim-edit').val(respon.nim);
                $('#nama-edit').val(respon.nama_alumni);
                $('#tmp-edit').val(respon.tmp_lahir);
                $('#tgl-edit').val(format(respon.tgl_lahir));
                $('#alamat-edit').text(respon.alamat);
                $('[name="jenis_kelamin"][value="'+respon.jenis_kelamin+'"]').prop('checked',true);

                $("#previewAlumni").html('');
                let gambar = respon.foto_alumni;
                if (gambar) {
                    gambar = respon.foto_alumni
                } else if (respon.jenis_kelamin === 1) {
                    gambar = 'wisudawan.png';
                } else {
                    gambar = 'wisudawati.png';
                }

                $("#previewAlumni").append("<img src='./images/users/"+gambar+"' class='contentimg' id='fotoAlumniTampil'>");

                // console.log(respon);
                $('#editAlumni').modal('toggle');

                // $('.datepicker').datepicker('update', respon.tgl_lahir);
                $('.datepicker').datepicker({
                    format: 'yyyy-mm-dd',
                    autoclose: 'true'
                });
            });
        }

        function format(inputDate) {
            var date = new Date(inputDate);
            if (!isNaN(date.getTime())) {
                var day = date.getDate().toString();
                var month = (date.getMonth() + 1).toString();
                // Months use 0 index.

                return date.getFullYear() + '-' + (month[1] ? month : '0' + month[0]) + '-' + (day[1] ? day : '0' + day[0]);

            }
        }
    </script>
@endsection

@section('modal')
    <!-- Modal Tambah Pengumuman -->
    <div class="modal fade" id="tambahPengumuman" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="largeModalLabel">Tambah Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('pengumuman.store') }}" id="frmTmbPengumuman" enctype="multipart/form-data" class="form-horizontal">@csrf
                    <div class="modal-body">
                        <div class="row form-group">
                            <div class="col col-md-3"><label for="judul-input" class=" form-control-label">Judul Pengumuman</label></div>
                            <div class="col-12 col-md-9">
                                <input type="text" id="judul-pengumuman" name="judul_pengumuman" class="form-control" autocomplete="off" autofocus required="">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3"><label for="isi-input" class=" form-control-label">Isi Pengumuman</label></div>
                            <div class="col-12 col-md-9">
                                <textarea id="isi-pengumuman" name="isi_pengumuman" class="form-control" required=""></textarea>
                                <div id="errorIsiInput"></div>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3"><label for="tanggal-input" class=" form-control-label">Tgl. Pengumuman</label></div>
                            <div class="col-12 col-md-9">
                                <input type="text" id="tgl-pengumuman" name="tgl_pengumuman" class="form-control" readonly="">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3"><label for="gambar-input" class=" form-control-label">Thumbnail</label></div>
                            <div class="col-12 col-md-9">
                                <input type="file" id="gambar-pengumuman" name="gambar_pengumuman" class="form-control file" data-theme="fas" accept="image/*">
                                <div id="errorInput"></div>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3"><label for="lampiran-input" class=" form-control-label">Lampiran</label></div>
                            <div class="col-12 col-md-9">
                                <input type="file" id="lampiran-pengumuman" name="lampiran_pengumuman[]" class="form-control file" multiple data-theme="fas">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">
                            <i class="fa fa-ban"></i> Batal
                        </button>
                        <button type="submit" class="btn btn-primary btn-sm" id="btnTmbPengumuman" disabled="">
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
    <!-- Ajax Simpan Pengumuman -->
    <script>
        $(document).ready(function() {
            $('#frmTmbPengumuman').submit(function(e) {
                e.preventDefault(); // avoid to execute the actual submit of the form.

                let form =  new FormData(this);
                // console.log(form);
                let url = $('#frmTmbPengumuman').attr('action');

                $.ajax({
                    url: url,
                    method: 'POST',
                    data: form,
                    contentType: false,
                    processData: false,   
                    success: function(data) {    
                        let pesan = JSON.parse(JSON.stringify(data));
                        swal.fire({
                            title: 'Berhasil',
                            text: pesan.pesan,
                            icon: 'success',
                            confirmButtonText: '<i class="fa fa-check"></i> OK',
                            confirmButtonColor: '#3085d6'
                        }).then(function() {
                            window.location.reload();
                        });
                    },
                    error: function(data) {
                        swal.fire({
                            title: 'Gagal',
                            text: 'Data Pengumuman Gagal Disimpan',
                            icon: 'error',
                            confirmButtonText: '<i class="fa fa-check"></i> OK',
                            confirmButtonColor: '#3085d6'
                        });
                    }
                });
            });
        });
    </script>
    <!-- Ajax Simpan Pengumuman -->

    <!-- Ajax Untuk Menampilkan Data Alumni -->
    <script type="text/javascript">
        var table_alumni = $('#table-pengumuman').DataTable({ 
            processing: true,
            serverSide: true,
            ajax: {
                "url": "{{ route('pengumuman.data') }}",
                "dataType": "json",
                "type": "GET",
            },
            columns: [
                {
                    "data": null, 
                    "orderable": false, 
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }  
                },
                {"data": "judul_pengumuman"},
                {"data": "isi_pengumuman"},
                {"data": "tgl_pengumuman"},
                {"data": "action", "name": "action", "orderable": false},
            ],
            "columnDefs": [
                { "width": "30%", "targets": 1 },
                { "width": "40%", "targets": 2 },
                { "width": "15%", "targets": 3 },
                { "width": "15%", "targets": 4},
                { "className": "td_center", "targets": [ 0, 1, 3, 4 ] },
                { "targets": "__all", "visible": false }
            ],
        });
    </script>
    <!-- Akhir Ajax Menampilkan Pengumuman di Datatable -->

    <!-- Jquery Validate -->
    <script src="{{ asset('vendor/validate/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('vendor/validate/additional-methods.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('vendor/validate/validate-style.css') }}">

    <script type="text/javascript">
        // Validasi Tambah Pengumuman
        $(document).ready(function() {
            $("#frmTmbPengumuman").on('blur keyup', function() {
                if ($("#frmTmbPengumuman").valid()) {
                    $('#btnTmbPengumuman').prop('disabled', false);
                } else {
                    $('#btnTmbPengumuman').prop('disabled', 'disabled');
                }
            });

            $.validator.addMethod('maxfilesize', function(value, element, param) {
                var length = ( element.files.length );
                var fileSize = 0;
                if (length > 0) {
                    fileSize = element.files[0].size; // get file size
                    fileSize = fileSize / 1000000; //file size in Mb
                    return this.optional( element ) || fileSize <= param;
                } else {
                    return this.optional( element ) || fileSize <= param;
                }
            });

            // $.validator.addMethod('check_content', function(value, element, param) {
            //     // element is the textarea
            //     return ($(element).summernote('code') !== "<p><br></p>" || $(element).summernote('code') !== "<p></p>");
            // }, "Harus Diisi");
            // $.validator.classRuleSettings.check_content = { check_content: true }

            $("#frmTmbPengumuman").validate({
                // errorElement: "div",
                // errorClass: "is-invalid",
                validClass: "is-valid",
                ignore: "",
                rules: {
                    judul_pengumuman: {required: true},
                    isi_pengumuman: {required: true},
                    tgl_pengumuman: {required: true},
                    gambar_pengumuman: {extension: "jpg|jpeg|png"},
                    lampiran_pengumuman: {maxfilesize: 1}
                },
                messages: {
                    judul_pengumuman: { required: "Harus Diisi"},
                    isi_pengumuman: {required: "Harus Diisi"},
                    tgl_pengumuman: {required: "Harus Diisi"},
                    gambar_pengumuman: {extension: "Ekstensi File *.jpg, *.jpeg atau *.png"},
                },
                errorPlacement: function(error, element){
                    if(element.attr("name") == "gambar_pengumuman"){
                        error.appendTo($('#errorInput'));
                    } else if (element.attr("name") == "isi_pengumuman") {
                        error.appendTo($('#errorIsiInput'));
                    } else{
                        error.insertAfter(element);
                    }
                }
            });
        });

        // Validasi Ubah Alumni
        $(document).ready(function() {
            $("#frmEditAlumni").on('blur keyup', function() {
                if ($("#frmEditAlumni").valid()) {
                    $('#btnEditAlumni').prop('disabled', false);
                } else {
                    $('#btnEditAlumni').prop('disabled', 'disabled');
                }
            });

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
            $("#frmEditAlumni").validate({
                rules: {
                    nim: {
                        required: true, 
                        digits: true, 
                        minlength: 10, 
                        maxlength: 10,
                        remote: {
                            url: "{{ route('cek.nim') }}",
                            type: "POST",
                            data: {
                                _token: "{{csrf_token()}}",
                                nim_edit: function () {
                                    return $("input[name='nim']").val();
                                },
                                id_edit: function () {
                                    return $("input[name='idEdit']").val();
                                }
                            },
                            dataFilter: function (data) {
                                var json = JSON.parse(data);
                                if (json.msg === "true") {
                                    return "\"" + "NIM Sudah Ada" + "\"";
                                } else {
                                    return 'true';
                                }
                            }
                        }
                    },
                    nama_alumni: {required: true},
                    tmp_lahir: {required: true},
                    tgl_lahir: {required: true},
                    jenis_kelamin: {required: true},
                    alamat: {required: true},
                    foto_alumni: {maxfilesize: 2, extension: "jpg|jpeg|png"}
                },
                messages: {
                    nim: { required: "Harus Diisi", digits: "Harus Digit Angka", minlength: "Panjang 10 Karakter", maxlength: "Panjang 10 Karakter"},
                    nama_alumni: {required: "Harus Diisi"},
                    tmp_lahir: {required: "Harus Diisi"},
                    tgl_lahir: {required: "Harus Diisi"},
                    jenis_kelamin: {required: "Harus Dipilih"},
                    alamat: {required: "Harus Diisi"},
                    foto_alumni: {maxfilesize: "Ukuran File Tidak Boleh Lebih dari 2 MB", extension: "Ekstensi File *.jpg, *.jpeg atau *.png"}
                },
                errorPlacement: function(error, element){
                    error.insertAfter(element);
                }
            });
        });
    </script>
    <!-- Akhir Jquery Validate -->

    <!-- WYSYG Editor -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script>
        $(document).ready(function() {
            $('textarea#isi-pengumuman').summernote({
                minHeight: 200,
                placeholder: 'Write here ...',
                focus: false,
                airMode: false,
                fontNames: ['Roboto', 'Calibri', 'Times New Roman', 'Arial'],
                fontNamesIgnoreCheck: ['Roboto', 'Calibri'],
                dialogsInBody: true,
                dialogsFade: true,
                disableDragAndDrop: false,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['fontname', 'fontsize']],
                    ['fontstyle', ['bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear']],
                    ['color', ['color']],
                    ['para', [, 'ul', 'ol', 'paragraph', 'table']],
                    ['height', ['height']],
                    ['insert', ['link']],
                    ['misc', ['undo', 'redo', 'print']]
                ],
                // popover: {
                //     air: [
                //         ['color', ['color']],
                //         ['font', ['bold', 'underline', 'clear']]
                //     ]
                // }
           });
        });
    </script> -->

    <link href="https://cdn.jsdelivr.net/npm/froala-editor@latest/css/froala_editor.pkgd.min.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/froala-editor@latest/js/froala_editor.pkgd.min.js"></script>

    <script>
        // new FroalaEditor('#isi-pengumuman');
        new FroalaEditor('#isi-pengumuman', {
            "charCounterCount": true,
            "toolbarButtons": [
                'undo', 'redo', 'clearFormatting', '|',
                'fontFamily', 'fontSize', 'textColor', 'backgroundColor', 'inlineClass', 'paragraphStyle', 'lineHeight', '|',
                'bold', 'italic', 'underline', 'strikeThrough', 'subscript', 'superscript', '|', 
                'paragraphFormat', 'align', 'formatOL', 'formatUL', 'outdent', 'indent', 'quote', '-', 'insertLink', 'insertImage', 'insertTable', '|', 
                'specialCharacters', 'insertHR', 'selectAll', '|', 
                'spellChecker', 'help', 'html', '|',
            ],
            "tabSpaces": 4,
            // "fontFamilyDefaultSelection": "Arial",
            "fontFamilySelection": true,
            "fontSizeSelection": true,
            // "fontSizeDefaultSelection": "12",
            // "fontSizeUnit": "px",
            "autofocus": true,
            "attribution": false,
            "height": -1,
            "linkAlwaysBlank": true,
            // "paragraphDefaultSelection": "Normal",
            "paragraphFormatSelection": true,
            "quickInsertButtons" : ['table', 'ol', 'ul', 'hr'],
            "language": "id"
        });
    </script>
    <!-- WYSYG Editor -->

    <!-- Judul Pengumuman dibuat UPPERCASE -->
    <script>
        $(document).ready(function(){
            $('#judul-pengumuman').keyup(function(){
                $(this).val($(this).val().toUpperCase());
            });
        });
    </script>
    <!-- Judul Pengumuman dibuat UPPERCASE -->

    <!-- File Input -->
    <script src="{{ asset('vendor/kartik-v/bootstrap-fileinput/js/fileinput.js') }}" type="text/javascript"></script>
    <script src="{{ asset('vendor/kartik-v/bootstrap-fileinput/themes/fas/theme.js') }}" type="text/javascript"></script>
    <script>
        $("#gambar-pengumuman").fileinput({
            showPreview: true,
            showUpload: false,
            browseOnZoneClick: true,
            uploadAsync: false,
            removeFromPreviewOnError: true,
            allowedFileExtensions: ['jpg', 'png'],
            fileActionSettings: {
                showZoom: false,
            },
            removeClass : 'btn btn-danger',
            theme: 'fas',
            overwriteInitial: false,
            purifyHtml: true,
            maxFileSize: 2000,
            slugCallback: function (filename) {
                return filename.replace('(', '_').replace(']', '_');
            }
        });

        $("#lampiran-pengumuman").fileinput({
            showPreview: true,
            showUpload: false,
            browseOnZoneClick: true,
            uploadAsync: false,
            removeFromPreviewOnError: true,
            fileActionSettings: {
                showZoom: false,
            },
            removeClass : 'btn btn-danger',
            theme: 'fas',
            overwriteInitial: false,
            purifyHtml: true,
            maxFileSize: 15000,
            maxFilesNum: 10,
            allowedFileTypes: ['image', 'text', 'video', 'audio', 'pdf', 'object'],
            slugCallback: function (filename) {
                return filename.replace('(', '_').replace(']', '_');
            }
        });
    </script>
    <!-- File Input -->

    <!-- Datepicker -->
    <script type="text/javascript">
        $('#tgl-pengumuman').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: 'true',
            onSelect: function(d,i){
                if(d !== i.lastVal){
                    $(this).change();
                }
            },
            endDate: new Date(new Date().setDate(new Date().getDate() + 0))
        });
    </script>
    <!-- Datepicker -->
@endsection