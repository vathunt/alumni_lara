@extends('client.master_layout')

@section('menu')
  <nav class="nav-menu d-none d-lg-block">
    <ul>
      <li class="active"><a href="#beranda">Beranda</a></li>
      <li><a href="#pengumuman">Pengumuman</a></li>
      <li><a href="#berita">Berita</a></li>
      <li><a href="#tracer_study">Tracer Study</a></li>
      <li><a href="#layanan">Layanan</a></li>

      <li><a href="{{ route('form.login') }}">Masuk</a></li>
    </ul>
  </nav>
@endsection

@section('content')
  <!-- ======= Hero Section ======= -->
  <section id="beranda">

    <div class="container">
      <div class="row">
        <div class="col-lg-6 pt-5 pt-lg-0 order-2 order-lg-1 d-flex flex-column justify-content-center" data-aos="fade-up">
          <div>
            <h1>Pencarian Data Alumni</h1>
            <div class="row form-group">
              <div class="col col-md-12">
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-key"></i></span>
                  </div>
                  <input type="text" id="search" name="search" class="form-control" placeholder="Masukkan NIM atau Nama Anda" autocomplete="off">
                </div>
              </div>
            </div>
            <table class="table table-bordered table-hover" id="table-alumni">
              <tbody>
              </tbody>
            </table>
          </div>
        </div>
        <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="fade-left">
          <img src="{{ asset('images/graduation(1).png') }}" class="img-fluid" alt="">
        </div>
      </div>
      <!-- Modal Lihat Alumni -->
      <div class="modal fade" id="lihatAlumni" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true" data-backdrop="static">
          <div class="modal-dialog modal-lg" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="modalMdTitle">Lihat Data Alumni</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <div class="modal-body">
                    <div class="row form-group">
                        <div class="col-12 col-md-12" id="fotoAlumniView">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3"><label for="nim-view" class="form-control-label">NIM</label></div>
                        <div class="col-12 col-md-9"><span id="nim-view" class="teks"></span></div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3"><label for="nama-edit" class="form-control-label">Nama Alumni</label></div>
                        <div class="col-12 col-md-9"><span id="nama-view" class="teks"></span></div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3"><label for="tmpLahir-edit" class="form-control-label">Tempat, Tanggal Lahir</label></div>
                        <div class="col-12 col-md-9"><span id="ttl-view" class="teks"></span></div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3"><label class="form-control-label">Jenis Kelamin</label></div>
                        <div class="col-12 col-md-9"><span id="jenkel-view" class="teks"></span></div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3"><label for="alamat-input" class=" form-control-label">Alamat</label></div>
                        <div class="col-12 col-md-9"><span id="alamat-view" class="teks"></span></div>
                    </div>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">
                          <i class="fa fa-times"></i> Tutup
                      </button>
                  </div>
              </div>
          </div>
      </div>
      <!-- Akhir Modal Edit Alumni -->
    </div>

  </section><!-- End Hero -->

  <main id="main">

  <!-- ======= About Section ======= -->
  <section id="about" class="about">
    <div class="container">

      <div class="row">
        <div class="col-lg-6" data-aos="zoom-in">
          <img src="{{ asset('images/IAIN-Madura.png') }}" class="img-fluid" alt="">
        </div>
        <div class="col-lg-6 d-flex flex-column justify-contents-center" data-aos="fade-left">
          <div class="content pt-4 pt-lg-0">
            <h3>Selayang Pandang</h3>
            <p class="font-italic">
              Visi IAIN Madura
            </p>
            <ul>
              <li><i>“ Religius dan Kompetitif ”</i></li>
            </ul>
            <p class="font-italic">
              Misi IAIN Madura
            </p>
            <ul style="text-align: justify;">
              <li><i class="icofont-check-circled"></i> Menyelenggarakan pendidikan dan pembelajaran guna menghasilkan lulusan yang religius berakhlak mulia, cerdas, kompeten, berdaya saing, mandiri, cinta tanah air, dan mampu berkembang secara profesional;</li>
              <li><i class="icofont-check-circled"></i> Menyelenggarakan penelitian dan pengkajian ilmu pengetahuan dan teknologi keagamaan Islam yang berorientasi pada pengembangan ilmu, kemaslahatan umat, dan daya saing bangsa;</li>
              <li><i class="icofont-check-circled"></i> Menyelenggarakan pengabdian kepada masyarakat dalam bidang ilmu pengetahuan dan teknologi keagamaan Islam guna mewujudkan masyarakat yang mandiri, produktif, sejahtera, dan islami;</li>
              <li><i class="icofont-check-circled"></i> Menyelenggarakan tatakelola kelembagaan secara profesional, partisipasif, transparan, dan akuntabel guna menjamin peningkatan mutu berkelanjutan;</li>
              <li><i class="icofont-check-circled"></i> Melakukan kerjasama dengan lembaga regional, nasional, dan internasional</li>
            </ul>
          </div>
        </div>
      </div>

    </div>
  </section><!-- End About Section -->

  <!-- ======= Features Section ======= -->
  <section id="pengumuman" class="features">
    <div class="container">
      <h3>Pengumuman</h3>
      <div class="row">
        <div class="col-lg-6 mt-2 mb-tg-0 order-2 order-lg-1">
          <ul class="nav nav-tabs flex-column">
            @foreach($announcements as $pengumuman)
            <li class="nav-item mt-2" data-aos="fade-up" data-aos-delay="100">
              <a class="nav-link" data-toggle="tab" href="#tab-{{ $pengumuman->id }}">
                <h4>{{ $pengumuman->judul_pengumuman }}</h4>
                <p>{{ Carbon\Carbon::parse($pengumuman->created_at)->locale('id')->isoFormat('LLLL') }}</p>
              </a>
            </li>
            @endforeach
          </ul>
        </div>
        <div class="col-lg-6 order-1 order-lg-2" data-aos="zoom-in">
          <div class="tab-content">
            @foreach($announcements as $pengumuman)
            <div class="tab-pane show" id="tab-{{ $pengumuman->id }}">
              <h4>{{ $pengumuman->judul_pengumuman }}</h4>
              {{ \Illuminate\Support\Str::of(strip_tags($pengumuman->isi_pengumuman))->words(20, ' ...') }}
              <span><a href="pengumuman/lihat/{{ Illuminate\Support\Facades\Crypt::encryptString($pengumuman->id) }}" class="link-icon">Lihat Selengkapnya</a></span>
            </div>
            @endforeach
          </div>
        </div>
      </div>
      <hr>
    </div>
    <div class="container">
      <span class="btn message"><a href="pengumuman" class="link">Lihat Pengumuman Lebih Banyak</a></span>
    </div>
  </section><!-- End Features Section -->

  <!-- ======= Services Section ======= -->
  <section id="berita" class="services section-bg">
    <div class="container">

      <div class="section-title" data-aos="fade-up">
        <h2>Berita Alumni</h2>
      </div>

      <div class="row">
        <?php
          function warna($indeks) {
            switch ($indeks) {
              case 1:
                return 'green';
                break;

              case 2:
                return 'red';
                break;
              
              case 3:
                return 'cyan';
                break;

              case 4:
                return 'orange'; 
                break;
            }
          }
        ?>
        <?php for($i=1;$i<5;$i++): ?>
        <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0" data-aos="zoom-in">
          <div class="icon-box icon-box-<?=warna($i)?>">
            <div class="icon"><img src="{{ asset('images/404-1.jpg') }}" class="img-fluid" alt=""></div>
            <h4 class="title">Lorem Ipsum</h4>
            <p class="description">Voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate</p>
            <a href="#" class="link-icon">Lihat Selengkapnya</a>
          </div>
        </div>
        <?php endfor ?>

      </div>
      <hr>
    </div>
    <div class="container">
      <center><span class="btn message"><a href="berita" class="link">Lihat Berita Lebih Banyak</a></span></center>
    </div>
  </section><!-- End Services Section -->

  <!-- ======= Cta Section ======= -->
  <section id="tracer_study" class="cta">
    <div class="container">

      <div class="row" data-aos="zoom-in">
        <div class="col-lg-9 text-center text-lg-left">
          <h3>Tracer Study</h3>
          <p> Untuk Mengisi Tracer Study Silakan Masuk Terlebih Dahulu.</p>
        </div>
        <div class="col-lg-3 cta-btn-container text-center">
          <a class="cta-btn align-middle" href="signin">Masuk Aplikasi</a>
        </div>
      </div>

    </div>
  </section><!-- End Cta Section -->

      <!-- ======= Testimonials Section ======= -->
  <section id="testimoni" class="testimonials">
    <div class="container">

      <div class="section-title" data-aos="fade-up">
        <h2>Testimoni Alumni</h2>
      </div>

      <div class="owl-carousel testimonials-carousel" data-aos="fade-up" data-aos-delay="100">
        <?php for($i=1;$i<=15;$i++): ?>
        <div class="testimonial-item">
          <p>
            <i class="bx bxs-quote-alt-left quote-icon-left"></i>
            Proin iaculis purus consequat sem cure digni ssim donec porttitora entum suscipit rhoncus. Accusantium quam, ultricies eget id, aliquam eget nibh et. Maecen aliquam, risus at semper.
            <i class="bx bxs-quote-alt-right quote-icon-right"></i>
          </p>
          <img src="{{ asset('images/3x4.jpg') }}" class="testimonial-img" alt="">
          <h3>Saul Goodman <?=$i?></h3>
          <h4>Ceo &amp; Founder <?=$i?></h4>
        </div>
        <?php endfor ?>
      </div>

    </div>
  </section><!-- End Testimonials Section -->

  <!-- ======= Team Section ======= -->
  <section id="layanan" class="team">
    <div class="container">

      <div class="section-title" data-aos="fade-up">
        <h2>Layanan Alumni</h2>
      </div>

      <div class="row">

        <div class="col-lg-4 col-md-6">
          <div class="member" data-aos="zoom-in">
            <div class="pic"><img src="{{ asset('images/completed_task__isometric.svg') }}" class="img-fluid" alt=""></div>
            <div class="member-info">
              <h4>Legalisasi Ijazah</h4>
              <span>Proses Legalisir Ijazah Secara Online</span>
              <div class="social">
                <a href="#"><i class="fas fa-external-link-alt"></i> Proses</a>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-4 col-md-6">
          <div class="member" data-aos="zoom-in" data-aos-delay="100">
            <div class="pic"><img src="{{ asset('images/career__isometric.svg') }}" class="img-fluid" alt=""></div>
            <div class="member-info">
              <h4>Lowongan Kerja</h4>
              <span>Berbagai Informasi Lowongan Kerja</span>
              <div class="social">
                <a href="#"><i class="fas fa-external-link-alt"></i> Proses</a>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-4 col-md-6">
          <div class="member" data-aos="zoom-in" data-aos-delay="200">
            <div class="pic"><img src="{{ asset('images/report_analysis__isometric.svg') }}" class="img-fluid" alt=""></div>
            <div class="member-info">
              <h4>Cek Validasi Ijazah</h4>
              <span>Proses Cek Validasi Keaslian Ijazah di Kemendikbud</span>
              <div class="social">
                <a href="https://ijazah.kemdikbud.go.id/" target="blank"><i class="fas fa-external-link-alt"></i> Proses</a>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>
  </section><!-- End Team Section -->

</main><!-- End #main -->

@endsection