<!-- Required meta tags-->
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="au theme template">
<meta name="author" content="Hau Nguyen">
<meta name="keywords" content="au theme template">

<!-- Title Page-->
<!-- <script language='JavaScript'>
    var txt = "..:: SIM Alumni IAIN Madura - @yield('title') ::.. ";
    var speed = 300;
    var refresh = null;
    function action() { 
        document.title = txt;
        txt = txt.substring(1,txt.length)+txt.charAt(0);
        relefresh = setTimeout("action()",speed);
    }
    action();
</script> -->
<title>@yield('title') - SIM Alumni IAIN Madura</title>
<link rel="icon" href="{{ asset('images/IAIN-Madura.png') }}"/>

<!-- Fontfaces CSS-->
<link href="{{ asset('css/font-face.css') }}" rel="stylesheet" media="all">
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"> -->
<link href="{{ asset('vendor/font-awesome-5/css/all.min.css') }}" rel="stylesheet" media="all">
<link href="{{ asset('vendor/mdi-font/css/material-design-iconic-font.min.css') }}" rel="stylesheet" media="all">

<!-- Bootstrap CSS-->
<!-- <link href="{{ asset('vendor/bootstrap-4.1/bootstrap.min.css') }}" rel="stylesheet" media="all"> -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

<!-- Vendor CSS-->
<link href="{{ asset('vendor/animsition/animsition.min.css') }}" rel="stylesheet" media="all">
<link href="{{ asset('vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css') }}" rel="stylesheet" media="all">
<link href="{{ asset('vendor/wow/animate.css') }}" rel="stylesheet" media="all">
<link href="{{ asset('vendor/css-hamburgers/hamburgers.min.css') }}" rel="stylesheet" media="all">
<link href="{{ asset('vendor/slick/slick.css') }}" rel="stylesheet" media="all">
<link href="{{ asset('vendor/select2/select2.min.css') }}" rel="stylesheet" media="all">
<link href="{{ asset('vendor/perfect-scrollbar/perfect-scrollbar.css') }}" rel="stylesheet" media="all">

<!-- Data Table CSS -->
<link rel="stylesheet" href="{{ asset('vendor/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('vendor/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}">

<!-- Datepicker CSS -->
<link rel="stylesheet" type="text/css" href="{{ asset('vendor/datepicker/css/datepicker.css') }}">

<!-- Main CSS-->
<link href="{{ asset('css/theme.css') }}" rel="stylesheet" media="all">

<!-- Sweet Alert -->
<script src="{{ asset('vendor/sweetalert/sweetalert2.all.min.js') }}"></script>

<!-- Cropper JS -->
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.css"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.js"></script>
 -->