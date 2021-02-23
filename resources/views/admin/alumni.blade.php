@extends('admin.layout.master_layout')

@section('title', 'Alumni')

@section('content')
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
                    <strong class="card-title">Data Alumni</strong>
                </div>
                <div class="card-body">
                    <div class="table-data__tool">
                        <div class="table-data__tool-right">
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small" data-toggle="modal" data-target="#tambahAlumni">
                                <i class="zmdi zmdi-plus"></i>Tambah Data
                            </button>
                            <button class="au-btn au-btn-icon au-btn--blue au-btn--small" data-toggle="modal" data-target="#importAlumni">
                                <i class="zmdi zmdi-upload"></i>Import Data
                            </button>
                            <button class="au-btn au-btn-icon au-btn--blue2 au-btn--small" ><a href="{{ route('export.alumni') }}" style="text-decoration: none; color: white;">
                                <i class="zmdi zmdi-download"></i>Download Data</a>
                            </button>
                        </div>
                    </div>

                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2 table-striped" id="table-alumni">
                            <thead>
                                <tr style="text-align: center;">
                                    <th>No.</th>
                                    <th>NIM</th>
                                    <th>Nama Alumni</th>
                                    <th>Tempat, Tanggal Lahir</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Alamat</th>
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
        var id;
        function hapusAlumni(id, nama) {
            // id = $('#tr_alumni-'+tr+' input.id').val();
            // // var nim = $('#tr_alumni-'+tr+' input.nim').val();
            // var nama = $('#tr_alumni-'+tr+' input.nama').val();
            // var tmp_lahir = $('#tr_alumni-'+tr+' input.tmp_lahir').val();
            // var tgl_lahir = $('#tr_alumni-'+tr+' input.tgl_lahir').val();
            // var jenis_kelamin = $('#tr_alumni-'+tr+' input.jenis_kelamin').val();
            // var alamat = $('#tr_alumni-'+tr+' input.alamat').val();

            // $('[name="jenis_kelamin"][value="'+jenis_kelamin+'"]').prop('checked',true);
            
            $('#idDelete').val(id);
            $('.modalNama').text(nama);

            // $('#idEdit').val(id);
            // $('#nim-edit').val(nim);
            // $('#nama-edit').val(nama);
            // $('#tmp-edit').val(tmp_lahir);
            // $('#tgl-edit').val(tgl_lahir);
            // $('#jenisKelamin').val(tgl_lahir);
            // $('#alamat-edit').text(alamat);

            // console.log($('[name="jenis_kelamin"]:checked').val())
            // $('.modalTitle').html($(this).attr('title')).text();
            // console.log(nama);
            // console.log(id);
        }


        function editAlumni(id){
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
    <!-- Modal Tambah Alumni -->
    <div class="modal fade" id="tambahAlumni" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalMdTitle">Tambah Data Alumni</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('alumni.store') }}" id="frmTmbAlumni" method="post" enctype="multipart/form-data" class="form-horizontal">@csrf
                    <div class="modal-body">
                        <div class="row form-group">
                            <div class="col col-md-3"><label for="nim-input" class="form-control-label">NIM</label></div>
                            <div class="col-12 col-md-9"><input type="text" id="nim-input" name="nim" class="form-control" autocomplete="off"></div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3"><label for="nama-input" class="form-control-label">Nama Alumni</label></div>
                            <div class="col-12 col-md-9"><input type="text" id="nama-input" name="nama_alumni" class="form-control" autocomplete="off"></div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3"><label for="tmpLahir-input" class="form-control-label">Tempat Lahir</label></div>
                            <div class="col-12 col-md-9"><input type="text" id="tmpLahir-input" name="tmp_lahir" class="form-control" autocomplete="off"></div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3"><label for="tglLahir-input" class=" form-control-label">Tanggal Lahir</label></div>
                            <div class="col-12 col-md-9">
                                <input type="text" id="tglLahir-input" name="tgl_lahir" class="form-control datepicker" autocomplete="off" readonly="">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3"><label class="form-control-label">Jenis Kelamin</label></div>
                            <div class="col col-md-9">
                                <div class="form-check">
                                    <div class="radio">
                                        <label for="jenisKelamin-input" class="form-check-label ">
                                            <input type="radio" name="jenis_kelamin" value="1" class="form-check-input">Laki-laki
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label for="jenisKelamin-input" class="form-check-label ">
                                            <input type="radio" name="jenis_kelamin" value="0" class="form-check-input">Perempuan
                                        </label>
                                    </div>
                                    <div id="errorJkInput"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3"><label for="alamat-input" class=" form-control-label">Alamat</label></div>
                            <div class="col-12 col-md-9"><textarea name="alamat" id="alamat-input" rows="5" class="form-control"></textarea></div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3"><label for="fotoAlumni-input" class=" form-control-label">Foto Alumni</label></div>
                            <div class="col-12 col-md-9">
                                <img id="fotoAlumni" src="./images/users/no-image.png" style="width: 40%;">
                                <input type="file" id="fotoAlumni-input" name="foto_alumni" class=" form-control" accept="image/*">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">
                            <i class="fa fa-ban"></i> Batal
                        </button>
                        <button type="submit" class="btn btn-primary btn-sm" id="btnTmbAlumni">
                            <i class="fa fa-save"></i> Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Akhir Modal Tambah Alumni -->

    <!-- Modal Edit Alumni -->
    <div class="modal fade" id="editAlumni" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalMdTitle">Edit Data Alumni</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('alumni.update') }}" id="frmEditAlumni" method="post" enctype="multipart/form-data" class="form-horizontal">@csrf
                    <input type="hidden" name="idEdit" id="idEdit">
                    <div class="modal-body">
                        <div class="row form-group">
                            <div class="col col-md-3"><label for="nim-edit" class="form-control-label">NIM</label></div>
                            <div class="col-12 col-md-9"><input type="text" id="nim-edit" name="nim" class="form-control" autocomplete="off"></div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3"><label for="nama-edit" class="form-control-label">Nama Alumni</label></div>
                            <div class="col-12 col-md-9"><input type="text" id="nama-edit" name="nama_alumni" class="form-control" autocomplete="off"></div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3"><label for="tmpLahir-edit" class="form-control-label">Tempat Lahir</label></div>
                            <div class="col-12 col-md-9"><input type="text" id="tmp-edit" name="tmp_lahir" class="form-control" autocomplete="off"></div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3"><label for="tglLahir-edit" class=" form-control-label">Tanggal Lahir</label></div>
                            <div class="col-12 col-md-9">
                                <input type="text" id="tgl-edit" name="tgl_lahir" class="datepicker form-control" autocomplete="off" readonly="">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3"><label class="form-control-label">Jenis Kelamin</label></div>
                            <div class="col col-md-9">
                                <div class="form-check">
                                    <div class="radio">
                                        <label for="jenisKelamin-input" class="form-check-label ">
                                            <input type="radio" name="jenis_kelamin" value="1" class="form-check-input">Laki-laki
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label for="jenisKelamin-input" class="form-check-label ">
                                            <input type="radio" name="jenis_kelamin" value="0" class="form-check-input">Perempuan
                                        </label>
                                    </div>
                                    <div id="errorJkEdit"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3"><label for="alamat-input" class=" form-control-label">Alamat</label></div>
                            <div class="col-12 col-md-9"><textarea name="alamat" id="alamat-edit" rows="5" class="form-control"></textarea></div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3"><label for="fotoAlumni-edit" class=" form-control-label">Foto Alumni</label></div>
                            <div class="col-12 col-md-9">
                                <div id="previewAlumni" style="width: 40%;"></div>
                                <input type="file" id="fotoAlumni-edit" name="foto_alumni" class=" form-control" accept="image/*">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">
                            <i class="fa fa-ban"></i> Batal
                        </button>
                        <button type="submit" class="btn btn-primary btn-sm" id="btnEditAlumni">
                            <i class="fa fa-edit"></i> Ubah
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Akhir Modal Edit Alumni -->

    <!-- Modal Hapus Alumni -->
    <div class="modal fade" id="hapusAlumni" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Hapus Data Alumni</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="modalMdContent">
                        <h4 class="text-center">Apakah anda yakin ingin menghapus data alumni <span class="modalNama"></span>?</h4>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal">
                        <i class="fas fa-ban"></i> Batal
                    </button>
                    <form action="{{ url('alumni') }}" method="post">@csrf
                        @method('delete')
                        <input type="hidden" name="id" id="idDelete">
                        <button type="submit" class="btn btn-danger btn-sm" >
                            <i class="fas fa-trash"></i> Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Akhir Modal Hapus Alumni -->

    <!-- Modal Import Alumni -->
    <div class="modal fade" id="importAlumni" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Import Data Alumni</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('import.alumni') }}" id="frmImportAlumni" method="post" enctype="multipart/form-data" class="form-horizontal">@csrf
                    <div class="modal-body">
                        <div id="modalMdContent">
                            <div class="sufee-alert alert alert-info">
                                Silakan Download Template Excel dan Lengkapi Datanya!
                                <span class="badge badge-pill badge-success"><i class="fa fa-download"></i><a href="{{ asset('file/Temp_Alumni.xlsx') }}" style="color: white;">&nbsp;&nbsp;Download Template</a></span>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3"><label for="file-input" class="form-control-label">Pilih File</label></div>
                                <div class="col-12 col-md-9">
                                    <input type="file" id="file-input" name="file_import" class="form-control-file">
                                    &nbsp;
                                    <div class="progress mb-2">
                                        <div id="bar"></div >
                                        <div id="percent">0%</div >
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal">
                            <i class="fas fa-ban"></i> Batal
                        </button>
                        <button type="submit" class="btn btn-danger btn-sm" id="btnImportAlumni">
                            <i class="fas fa-upload"></i> Import
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Akhir Modal Import Alumni -->
@endsection

@section('javascript')
    <!-- Date Picker -->
    <script type="text/javascript">
        $('.datepicker').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: 'true'
        });
    </script>
    
    <!-- Ajax Untuk Menampilkan Data Alumni -->
    <script type="text/javascript">
        // (function ($) {
        //     $('.table').DataTable();
        // })(jQuery);
        var table_alumni = $('#table-alumni').DataTable({ 
            processing: true,
            serverSide: true,
            ajax: {
                "url": "{{ route('alumni.data') }}",
                "dataType": "json",
                "type": "GET",
                // "data":{ _token: "{{csrf_token()}}"}
            },
            // ajax: "{{ route('alumni.data') }}",
            columns: [
                {"data": null, "orderable": false, 
                   render: function (data, type, row, meta) {
                             return meta.row + meta.settings._iDisplayStart + 1;
                            }  
                },
                // {"data": "urut"}.
                {"data": "nim"},
                {"data": "nama_alumni"},
                {"data": "tmp_lahir"},
                {"render": function ( data, type, row ) {
                                var jk = "" 
                                if(row.jenis_kelamin == 1){ 
                                    jk = 'Laki-laki'
                                }else{ 
                                    jk = 'Perempuan'
                                }
                                return jk;
                            }
                },
                {"data": "alamat"},
                {"data": "action", "name": "action", "orderable": false},
            ],
            "columnDefs": [
                { "width": "12%", "targets": 4},
                { "width": "12%", "targets": 6 },
                { "targets": "__all", "visible": false }
            ],
            // "responsive": true,
            // dom: 'frtipB',
            // buttons: [
            //     'copy', 'csv', 'excel', 'pdf', 'print'
            // ]
        });

        // // Handle click on "Expand All" button
        // $('#btn-show-all-children').on('click', function(){
        //     // Expand row details
        //     console.log('Inside click');
        //     table.rows(':not(.parent)').nodes().to$().find('td:first-child').trigger('click');
        // });

        // // Handle click on "Collapse All" button
        // $('#btn-hide-all-children').on('click', function(){
        //     // Collapse row details
        //     table.rows('.parent').nodes().to$().find('td:first-child').trigger('click');
        // });

        // $('#btn-show-all-children').trigger('click');
    </script>
    <!-- Akhir Ajax Menampilkan Alumni di Datatable -->

    <!-- Menampilkan Foto Ketika Diupload (Insert) -->
    <script>
        $(document).ready(function() {
            $("#fotoAlumni-input").change(function(event) {  
                fadeInAdd();
                getURL(this);    
            });

            $("#fotoAlumni-input").on('click',function(event){
                fadeInAdd();
            });

            function getURL(input) {  
                if (input.files && input.files[0]) {  
                    var reader = new FileReader();
                    var filename = $("#fotoAlumni-input").val();
                    filename = filename.substring(filename.lastIndexOf('\\')+1);
                    reader.onload = function(e) {
                        // debugger;
                        $('#fotoAlumni').attr('src', e.target.result);
                        $('#fotoAlumni').hide();
                        $('#fotoAlumni').fadeIn(500);      
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
    <!-- Akhir Menampilkan Foto (Insert) -->

    <!-- Menampilkan Foto Ketika Diupload (Update) -->
    <script>
        $(document).ready(function() {
            $("#fotoAlumni-edit").change(function(event) {  
                fadeInAdd();
                getURL(this);    
            });

            $("#fotoAlumni-edit").on('click',function(event){
                fadeInAdd();
            });

            function getURL(input) {  
                if (input.files && input.files[0]) {  
                    var reader = new FileReader();
                    var filename = $("#fotoAlumni-edit").val();
                    filename = filename.substring(filename.lastIndexOf('\\')+1);
                    reader.onload = function(e) {
                        // debugger;
                        $('#fotoAlumniTampil').attr('src', e.target.result);
                        $('#fotoAlumniTampil').hide();
                        $('#fotoAlumniTampil').fadeIn(500);      
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
    <!-- Akhir Menampilkan Foto (Update) -->

    <!-- Jquery Validate -->
    <script src="{{ asset('vendor/validate/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('vendor/validate/additional-methods.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('vendor/validate/validate-style.css') }}">

    <script type="text/javascript">
        // Validasi Import Alumni
        $(document).ready(function () {
            $("#frmImportAlumni").on('blur keyup', function() {
                if ($("#frmImportAlumni").valid()) {
                    $('#btnImportAlumni').prop('disabled', false);  
                } else {
                    $('#btnImportAlumni').prop('disabled', 'disabled');
                }
            });

            $('#frmImportAlumni').validate({
                rules: {
                    file_import: {required: true, extension: "xlsx|xls"}
                },
                messages: {
                    file_import: {required: "Tidak File Dipilih", extension: "Ekstensi Harus *.xlsx atau *.xls"}
                },
                errorPlacement: function(error, element){
                    error.insertAfter(element);
                }
            });
        });

        // Validasi Tambah Alumni
        $(document).ready(function() {
            $("#frmTmbAlumni").on('blur keyup', function() {
                if ($("#frmTmbAlumni").valid()) {
                    $('#btnTmbAlumni').prop('disabled', false);
                } else {
                    $('#btnTmbAlumni').prop('disabled', 'disabled');
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

            $("#frmTmbAlumni").validate({
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
                                nim_input: function () {
                                    return $("input[name='nim']").val();
                                }
                            },
                            dataFilter: function (data) {
                                var json = JSON.parse(data);
                                if (json.msg == "true") {
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
                    if(element.attr("name") == "jenis_kelamin"){
                        error.appendTo($('#errorJkInput'));
                    }else{
                        // error.appendTo(element.parent().next());
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

    <!-- Progres Bar Untuk Import Alumni -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.js"></script>
    <style>
        .progress { 
            position: relative; 
            width: 100%; 
        }
        #bar { 
            background-color: #28a745; 
            width: 0%; 
            height: 20px; 
        }
        #percent { 
            position: absolute; 
            display: inline-block; 
            left: 50%; 
            color: #040608;
        }
    </style>
    
    <script type="text/javascript">
        var SITEURL = "{{URL('/')}}";
        $(function() {
            $(document).ready(function()
            {
                var bar = $('#bar');
                var percent = $('#percent');
                $('#frmImportAlumni').ajaxForm({
                    beforeSend: function() {
                        var percentVal = '0%';
                        bar.width(percentVal)
                        percent.html(percentVal);
                    },
                    uploadProgress: function(event, position, total, percentComplete) {
                        var percentVal = percentComplete + '%';
                        bar.width(percentVal)
                        percent.html(percentVal);
                    },
                    success: function(xhr) {
                        const swalWithBootstrapButtons = Swal.mixin({
                            customClass: {
                                confirmButton: 'btn btn-success',
                            },
                            buttonsStyling: false
                        });

                        swalWithBootstrapButtons.fire({
                            title: 'Berhasil',
                            text: "File Berhasil Diimport",
                            icon: 'success',
                            confirmButtonText: '<i class="fa fa-check"></i> OK',
                            confirmButtonColor: '#3085d6'
                        }).then(function() {
                            window.location.href = SITEURL +"/"+"alumni";
                        });
                        // setTimeout(function () {
                        //     window.location.href = SITEURL +"/"+"alumni";
                        // }, 3000);
                    },
                    error: function(xhr) {
                        const swalWithBootstrapButtons = Swal.mixin({
                            customClass: {
                                confirmButton: 'btn btn-danger',
                            },
                            buttonsStyling: false
                        });

                        swalWithBootstrapButtons.fire({
                            title: 'Gagal',
                            text: "Periksa Data Kembali",
                            icon: 'error',
                            confirmButtonText: '<i class="fa fa-check"></i> OK',
                            confirmButtonColor: '#3085d6'
                        }).then(function() {
                            window.location.reload();
                        });
                        // setTimeout(function () {
                        //     window.location.reload();
                        // }, 3000);
                    } 
                });
            }); 
        });
    </script>
    <!-- Akhir Progres Bar -->
@endsection