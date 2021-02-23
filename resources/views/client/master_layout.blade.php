<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@include('client.head')

<body>

  @include('client.header')

  @yield('content')

  @include('client.footer')

  <a href="#" class="back-to-top"><i class="bx bxs-up-arrow-alt"></i></a>

  <!-- Vendor JS Files -->
  <script src="{{ asset('vendor/jquery-3.2.1.min.js') }}"></script>
  <script src="{{ asset('vendor/bootstrap-4.1/bootstrap.min.js') }}"></script>
  <script src="{{ asset('vendor/jquery.easing/jquery.easing.min.js') }}"></script>
  <script src="{{ asset('vendor/php-email-form/validate.js') }}"></script>
  <script src="{{ asset('vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
  <script src="{{ asset('vendor/venobox/venobox.min.js') }}"></script>
  <script src="{{ asset('vendor/owl.carousel/owl.carousel.min.js') }}"></script>
  <script src="{{ asset('vendor/aos/aos.js') }}"></script>

  <!-- Template Main JS File -->
  <script src="{{ asset('Client/js/main.js') }}"></script>

  <!-- Data Tables JS -->
  <!-- <script src="{{ asset('vendor/datatables.net/js/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('vendor/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('vendor/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
  <script src="{{ asset('vendor/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('vendor/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
  <script src="{{ asset('vendor/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
  <script src="{{ asset('vendor/datatables.net-buttons/js/buttons.colVis.min.js') }}"></script> -->

  <script type="text/javascript">
    $('#search').on('keyup',function(){
      $value = $(this).val();
      $.ajax({
        type : 'get',
        url : '{{ URL::to('search') }}',
        data: {'search':$value},
        success:function(data){
          $('tbody').html(data);
        }
      });
    })
  </script>

  <script type="text/javascript">
    $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
  </script>

  <script type="text/javascript">
    function lihatAlumni(id){
      $.ajax({
          url: "{{ url('/') }}/alumni/lihat/"+id,
          dataType: "json"
      }).done(function(respon) {
          $('#id-view').val(respon.id);
          $('#nim-view').text(respon.nim);
          $('#nama-view').text(respon.nama_alumni);
          $('#ttl-view').text(respon.tmp_lahir + ', ' + format(respon.tgl_lahir));
          $('#alamat-view').text(respon.alamat);
          $('#jenkel-view').text(jk(respon.jenis_kelamin));

          $("#fotoAlumniView").html('');
          let gambar = respon.foto_alumni;
          if (gambar) {
              gambar = respon.foto_alumni
          } else if (respon.jenis_kelamin === 1) {
              gambar = 'wisudawan.png';
          } else {
              gambar = 'wisudawati.png';
          }
          $("#fotoAlumniView").append("<img src='./images/users/"+gambar+"' class='container__image'>");

          // console.log(respon);
          $('#lihatAlumni').modal('toggle');
      });
    }

    function jk(gender) {
      return gender ? 'Laki-laki' : 'Perempuan';
    }

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
  <!-- <script type="text/javascript">
    const table_alumni = $('#table-alumni').DataTable();
  </script> -->

</body>

</html>