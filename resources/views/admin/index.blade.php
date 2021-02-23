@extends('admin.layout.master_layout')

@section('title', 'Dashboard')

@section('content')
    @if(Auth::user()->id_status == 1)
    <div class="row m-t-25">
        <div class="col-sm-6 col-lg-6">
            <div class="overview-item overview-item--c1">
                <div class="overview__inner">
                    <div class="overview-box clearfix">
                        <div class="icon">
                            <i class="zmdi zmdi-graduation-cap"></i>
                        </div>
                        <div class="text">
                            <h2>{{ $count_alumni }}</h2>
                            <span>Data Alumni</span>
                        </div>
                    </div>
                    <div class="overview-chart">
                        <!-- <canvas id="widgetChart1"></canvas> -->
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-6">
            <div class="overview-item overview-item--c3">
                <div class="overview__inner">
                    <div class="overview-box clearfix">
                        <div class="icon">
                            <i class="zmdi zmdi-account-box"></i>
                        </div>
                        <div class="text">
                            <h2>{{ $count_user }}</h2>
                            <span>Data Pengguna</span>
                        </div>
                    </div>
                    <div class="overview-chart">
                        <!-- <canvas id="widgetChart2"></canvas> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-user"></i>
                    <strong class="card-title pl-2">Profil</strong>
                </div>
                <div class="card-body">
                    <div class="mx-auto d-block">
                        <center>
                            <img class="card-img-top" src="./images/users/{{ Auth::user()->foto_profil ? Auth::user()->foto_profil : 'no-image.png' }}" style="max-width: 50%;" alt="{{ Auth::user()->name }}">
                        </center>
                        <h5 class="text-sm-center mt-2 mb-1">{{ Auth::user()->name }}</h5>
                        <div class="location text-sm-center">
                            {{ Auth::user()->email }}
                        </div>
                    </div>
                    <hr>
                    <div class="card-text text-sm-center">
                        Status Pengguna : 
                        @if(Auth::user()->id_status == 1)
                            <span class="role admin">Admin</span>
                        @else
                            <span class="role user">Alumni</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="card border border-success">
                <div class="card-header">
                    <strong class="card-title">Selamat Datang</strong>
                </div>
                <div class="card-body">
                    <center>
                        <img src="{{ asset('images/IAIN-Madura.png') }}" alt="IAIN-Madura-Logo" width="35%">
                        <h1 class="card-text">Sistem Informasi Pendataan Alumni
                        </h1>
                    </center>
                </div>
            </div>
        </div>
    </div>
@endsection