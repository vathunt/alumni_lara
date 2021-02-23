<!-- ======= Header ======= -->
<header id="header" class="fixed-top">
  <div class="container d-flex">

    <div class="logo mr-auto">
      <!-- <h1 class="text-light"><a href="/"><span>Sistem Informasi Alumni</span></a></h1> -->
      <!-- Uncomment below if you prefer to use an image logo -->
       <a href="{{ route('client.dashboard') }}"><img src="{{ asset('images/icon-sim-alumni.png') }}" alt="Logo SIM Alumni" class="img-fluid"></a>
    </div>

    @yield('menu')
  </div>
</header><!-- End Header -->