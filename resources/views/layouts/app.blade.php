<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en">
<!--<![endif]-->

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Basic -->
    <meta charset="UTF-8">

    <title>E-rapor.sch</title>

    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" /> <meta name="description" content="">
    <meta name="author" content="">

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">

    <!-- Custom styles for this template -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Vendor CSS -->
    <link href="{{ asset('vendor/select2/dist/css/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/datatables/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/buttons/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/scroller/css/scroller.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/responsive/css/responsive.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/fontawesome/css/all.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('vendors/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/themify-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/flag-icon-css/css/flag-icon.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/selectFX/css/cs-skin-elastic.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/jqvmap/dist/jqvmap.min.css') }}">


    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

</head>

<body>
    <!-- Left Panel -->

    <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">

            <div class="navbar-header">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="{{ route('home') }}">E - rapor.sch&nbsp; </a>
                <a class="navbar-brand hidden" href="{{ route('home') }}"><b>E</b></a>
            </div>

            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="active">
                      <a href="{{ route('home') }}"> <i class="menu-icon ti-desktop"></i>Beranda </a>
                    </li>
                    @if(Auth::user()->id_level == 1)
                    <h3 class="menu-title">Admin</h3><!-- /.menu-title -->

                    <li>
                        <a href="{{ route('akun.index') }}"> <i class="menu-icon ti-user"></i>Manajemen Akun </a>
                    </li>

                    <li class="menu-item-has-children dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon ti-menu-alt"></i>Data Master</a>
                      <ul class="sub-menu children dropdown-menu">
                        <li><i class="ti-arrow-circle-right"></i><a href="{{ route('level.index') }}">Data Level</a></li>
                        <li><i class="ti-arrow-circle-right"></i><a href="{{ route('siswa.index') }}">Data Siswa</a></li>
                        <li><i class="ti-arrow-circle-right"></i><a href="{{ route('guru.index') }}">Data Guru</a></li>
                        <li><i class="ti-arrow-circle-right"></i><a href="{{ route('kelas.index') }}">Data Kelas</a></li>
                        <li><i class="ti-arrow-circle-right"></i><a href="{{ route('jurusan.index') }}">Data Jurusan</a></li>
                        <li><i class="ti-arrow-circle-right"></i><a href="{{ route('mapel.index') }}">Data Mata Pelajaran</a></li>
                        <li><i class="ti-arrow-circle-right"></i><a href="{{ route('tahun.index') }}">Data Tahun Ajaran</a></li>
                        <li><i class="ti-arrow-circle-right"></i><a href="{{ route('walikelas.index') }}">Data Walikelas</a></li>
                        <li><i class="ti-arrow-circle-right"></i><a href="{{ route('jadwal.index') }}">Data Jadwal Pelajaran</a></li>
                      </ul>
                    </li>
                    @endif

                    @if(Auth::user()->id_level == 2)
                    <h3 class="menu-title">Guru</h3><!-- /.menu-title -->

                    <li>
                        <a href="{{ route('nilai.index') }}"><i class="menu-icon ti-clipboard"></i>Data Nilai </a>
                    </li>

                    <li>
                        <a href="{{ route('nilai.create') }}"><i class="menu-icon ti-import"></i>Penilaian </a>
                    </li>
                    @endif

                    @if(Auth::user()->id_level == 3)
                    <h3 class="menu-title">Siswa</h3><!-- /.menu-title -->

                    <li>
                        <a href="{{ route('nilai.index') }}"> <i class="menu-icon ti-clipboard"></i>Data Nilai </a>
                    </li>
                    @endif

                    @if(Auth::user()->id_level == 4)
                    <h3 class="menu-title">Walikelas</h3><!-- /.menu-title -->

                    <li>
                        <a href="{{ route('absen.index') }}"> <i class="menu-icon ti-agenda"></i>Rekapitulasi </a>
                    </li>

                    <li>
                        <a href="{{ route('absen.create') }}"> <i class="menu-icon ti-calendar"></i>Absensi </a>
                    </li>
                    @endif                   
                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
    </aside><!-- /#left-panel -->

    <!-- Left Panel -->

    <!-- Right Panel -->

    <div id="right-panel" class="right-panel">

        <!-- Header-->
        <header id="header" class="header">

            <div class="header-menu">

                <div class="col-sm-7">
                    <a id="menuToggle" class="menutoggle pull-left"><i class="fa fa fa-tasks"></i></a>
                </div>

                <div class="col-sm-5">
                    <div class="user-area dropdown float-right">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> {{ Auth::user()->name }} <i class="fa fa-caret-down"></i>
                        </a>

                        <div class="user-menu dropdown-menu">

                            <a href="{{ route('akun.edit', str_random(20)) }}"><i class="menu-icon ti-panel"></i>  Kelola Akun </a> <br>

                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                              <i class="menu-icon ti-power-off"></i>  {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </header><!-- /header -->
        <!-- Header-->

        <div class="content mt-3">
            @yield('content')
        </div> <!-- .content -->
    </div><!-- /#right-panel -->

    <!-- Right Panel -->

    <script src="{{ asset('vendors/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('vendors/popper.js/dist/umd/popper.min.js') }}"></script>
    <script src="{{ asset('vendors/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>

    <!-- Vendor JavaScript -->
    <script src="{{ asset('vendor/select2/dist/js/select2.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/js/datatables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('vendor/fontawesome/js/all.min.js') }}"></script>
    <script src="{{ asset('vendor/buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('vendor/responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('vendor/scroller/js/scroller.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery-chained/jquery.chained.js') }}"></script>

    <script src="{{ asset('vendors/chart.js/dist/Chart.bundle.min.js') }}"></script>
    <script src="{{ asset('js/dashboard.js') }}"></script>
    <script src="{{ asset('js/widgets.js') }}"></script>
    <script src="{{ asset('vendors/jqvmap/dist/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('vendors/jqvmap/examples/js/jquery.vmap.sampledata.js') }}"></script>
    <script src="{{ asset('vendors/jqvmap/dist/maps/jquery.vmap.world.js') }}"></script>

    <!-- jQuery AIO solver -->
    <script>
        var $=jQuery.noConflict();
    </script>

    <!-- Select Script -->
    <script>
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });
    </script>

    <!-- Chained Script -->
    <script>
      $(document).ready(function() {
        $('#kelas').chained('#tahun');
      });
    </script>

    <!-- Modal Edit Script -->
    <script>
      $(document).ready(function() {
        $('#editTahun').on('show.bs.modal', function (event) {
              var button = $(event.relatedTarget) 
              var kode = button.data('kode') 
              var tahun = button.data('tahun') 
              var id = button.data('id') 
              var modal = $(this)



              console.log = ('Modal');
              modal.find('.modal-body #id').val(id);
              modal.find('.modal-body #kode').val(kode);
              modal.find('.modal-body #tahun').val(tahun);
        })
        });
    </script>

    <!-- Modal Edit Level -->

    <script>
      $(document).ready(function() {
        $('#editLevel').on('show.bs.modal', function (event) {
              var button = $(event.relatedTarget) 
              var kode = button.data('kode') 
              var nama_level = button.data('level') 
              var id = button.data('id') 
              var modal = $(this)



              console.log = ('Modal');
              modal.find('.modal-body #id').val(id);
              modal.find('.modal-body #kode').val(kode);
              modal.find('.modal-body #nama_level').val(nama_level);
        })
        });
    </script>

      <!-- Modal Edit Jurusan -->

    <script>
      $(document).ready(function() {
        $('#editJurusan').on('show.bs.modal', function (event) {
              var button = $(event.relatedTarget) 
              var kode_jurusan = button.data('kode') 
              var nama_jurusan = button.data('jurusan') 
              var id = button.data('id') 
              var modal = $(this)



              console.log = ('Modal');
              modal.find('.modal-body #id').val(id);
              modal.find('.modal-body #kode_jurusan').val(kode_jurusan);
              modal.find('.modal-body #nama_jurusan').val(nama_jurusan);
        })
        });
    </script>

    <script>
      $(document).ready(function() {
        $('#editKelas').on('show.bs.modal', function (event) {
              var button = $(event.relatedTarget) 
              var tahun = button.data('tahun') 
              var kode = button.data('kode') 
              var tingkat = button.data('tingkat') 
              var jurusan = button.data('jurusan') 
              var kelas = button.data('kelas') 
              var id = button.data('id') 
              var modal = $(this)



              console.log = ('Modal');
              modal.find('.modal-body #id').val(id);
              modal.find('.modal-body #kode').val(kode);
              modal.find('.modal-body #tingkat').val(tingkat);
              modal.find('.modal-body #kelas').val(kelas);
              
        })
        });
    </script>


    <script>
      $(document).ready(function() {
        $('#editGuru').on('show.bs.modal', function (event) {
              var button = $(event.relatedTarget) 
              var guru = button.data('guru') 
              var kode = button.data('kode') 
              var id = button.data('id') 
              var nip = button.data('nip') 
              var modal = $(this)



              console.log = ('Modal');
              modal.find('.modal-body #id').val(id);
              modal.find('.modal-body #kode').val(kode);
              modal.find('.modal-body #guru').val(guru);
              modal.find('.modal-body #nip').val(nip);
              
        })
        });
    </script>

    <script>
      $(document).ready(function() {
        $('#editMapel').on('show.bs.modal', function (event) {
              var button = $(event.relatedTarget) 
              var nama = button.data('nama') 
              var kode = button.data('kode') 
              var id = button.data('id') 
              var kategori = button.data('kategori') 
              var jurusan = button.data('jurusan') 
              var modal = $(this)



              console.log = ('Modal');
              modal.find('.modal-body #id').val(id);
              modal.find('.modal-body #kode').val(kode);
              modal.find('.modal-body #nama').val(nama);
              modal.find('.modal-body #jurusan').val(jurusan);
              modal.find('.modal-body #kategori').val(kategori);
              
        })
        });
    </script>

    <script>
      $(document).ready(function() {
        $('#editSiswa').on('show.bs.modal', function (event) {
              var button = $(event.relatedTarget) 
              var nama = button.data('nama') 
              var kode = button.data('kode') 
              var id = button.data('id') 
              var nisn = button.data('nisn') 
              var modal = $(this)



              console.log = ('Modal');
              modal.find('.modal-body #id').val(id);
              modal.find('.modal-body #kode').val(kode);
              modal.find('.modal-body #nama').val(nama);
              modal.find('.modal-body #nisn').val(nisn);
              
        })
        });
    </script>

    <script>
      $(document).ready(function() {
        $('#editAkun').on('show.bs.modal', function (event) {
              var button = $(event.relatedTarget) 
              var nama = button.data('nama') 
              var username = button.data('username') 
              var id = button.data('id') 
              var email = button.data('email') 
              var modal = $(this)



              console.log = ('Modal');
              modal.find('.modal-body #id').val(id);
              modal.find('.modal-body #username').val(username);
              modal.find('.modal-body #nama').val(nama);
              modal.find('.modal-body #email').val(email);
              
        })
        });
    </script>

    <script>
      $(document).ready(function() {
        $('#editJadwal').on('show.bs.modal', function (event) {
              var button = $(event.relatedTarget) 
              var kode = button.data('kode') 
              var id = button.data('id') 
              var modal = $(this)



              console.log = ('Modal');
              modal.find('.modal-body #id').val(id);
              modal.find('.modal-body #kode').val(kode);
              
        })
        });
    </script>

    <script>
      function hanyaAngka(evt) {
        var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode > 31 && (charCode < 48 || charCode > 57))
   
          return false;
        return true;
      }
    </script>

    <script>
      function hanyaHuruf(evt) {
       var charCode = (evt.which) ? evt.which : event.keyCode
        if ((charCode < 65 || charCode > 90)&&(charCode < 97 || charCode > 122)&&charCode>32)
            return false;
        return true;
      }
    </script>


</body>

</html>
