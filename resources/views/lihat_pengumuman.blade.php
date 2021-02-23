@extends('client.master_layout')

@section('content')

<main id="main">

  <!-- ======= Breadcrumbs ======= -->
  <section id="breadcrumbs" class="breadcrumbs">
    <div class="container">

      <ol>
        <li><a href="{{ route('client.dashboard') }}">Beranda</a></li>
        <li><a href="{{ route('pengumuman') }}">Pengumuman</a></li>
        <li>{{ $dt_pengumuman->judul_pengumuman }}</li>
      </ol>

    </div>
  </section><!-- End Breadcrumbs -->

  <!-- ======= Portfolio Details Section ======= -->
  <section id="portfolio-details" class="portfolio-details">
    <div class="container">

      <div class="portfolio-details-container">

        <div class="owl-carousel portfolio-details-carousel">
          <img src="{{ asset('images/bg-title-01.jpg') }}" class="img-fluid" alt="">
          <img src="{{ asset('images/bg-title-02.jpg') }}" class="img-fluid" alt="">
        </div>

        <div class="portfolio-info">
          <h3>Informasi</h3>
          <ul>
            <li><strong>Kategori</strong>: Pengumuman</li>
            <li><strong>Diterbitkan</strong>: {{ Carbon\Carbon::parse($dt_pengumuman->created_at)->locale('id')->isoFormat('LLLL') }}</li>
          </ul>
        </div>

      </div>

      <div class="portfolio-description">
        <h2>{{ $dt_pengumuman->judul_pengumuman }}</h2>
        {!! $dt_pengumuman->isi_pengumuman !!}
      </div>

    </div>
  </section><!-- End Portfolio Details Section -->

</main><!-- End #main -->

@endsection