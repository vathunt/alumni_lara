<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('admin.layout.head')
</head>

<body class="animsition">
    <div class="page-wrapper">
        @include('admin.layout.left_sidebar')

        <!-- PAGE CONTAINER-->
        <div class="page-container">
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
                            confirmButton: 'btn btn-danger',
                        },
                        buttonsStyling: false
                    });

                    swalWithBootstrapButtons.fire({
                        title: 'Gagal',
                        text: "{{ Session::get('error') }}",
                        icon: 'error',
                        confirmButtonText: '<i class="fa fa-check"></i> OK',
                        confirmButtonColor: '#3085d6'
                    });
                </script>
            @endif
            @include('admin.layout.top_sidebar')

            <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        @yield('content')
                        @include('admin.layout.footer')
                    </div>
                </div>
            </div>
            <!-- END MAIN CONTENT-->
            <!-- END PAGE CONTAINER-->
            @yield('modal')
        </div>

    </div>

    <!-- Jquery JS-->
    <!-- <script src="{{ asset('vendor/jquery-3.2.1.min.js') }}"></script> -->
    <script src="{{ asset('vendor/jquery-3.5.1.min.js') }}"></script>
    <!-- Bootstrap JS-->
    <!-- <script src="{{ asset('vendor/bootstrap-4.1/popper.min.js') }}"></script> -->
    <!-- <script src="{{ asset('vendor/bootstrap-4.1/bootstrap.min.js') }}"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <!-- Vendor JS       -->
    <script src="{{ asset('vendor/slick/slick.min.js') }}">
    </script>
    <script src="{{ asset('vendor/wow/wow.min.js') }}"></script>
    <script src="{{ asset('vendor/animsition/animsition.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap-progressbar/bootstrap-progressbar.min.js') }}">
    </script>
    <script src="{{ asset('vendor/counter-up/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('vendor/counter-up/jquery.counterup.min.js') }}">
    </script>
    <script src="{{ asset('vendor/circle-progress/circle-progress.min.js') }}"></script>
    <script src="{{ asset('vendor/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('vendor/chartjs/Chart.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/select2/select2.min.js') }}">
    </script>

    <!-- Data Tables JS -->
    <script src="{{ asset('vendor/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables.net-buttons/js/buttons.colVis.min.js') }}"></script>

    <!-- Datepicker JS -->
    <script type="text/javascript" src="{{ asset('vendor/datepicker/js/bootstrap-datepicker.js') }}"></script>

    <!-- Main JS-->
    <script src="{{ asset('js/main.js') }}"></script>
    
    @yield('javascript')
</body>

</html>
<!-- end document-->
