<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="fixed">


<head>
   

    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Basic -->
    <meta charset="UTF-8">

    <title>E-rapor.sch</title>

    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" /> <meta name="description" content="">
    <meta name="author" content="">

    <title>E-raport.sch</title>

    <!-- Bootstrap core CSS --><link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- Font Awesome core CSS -->
    <link href="{{ asset('vendor/fontawesome/css/all.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/fontawesome/css/fontawesome.css') }}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/simple-sidebar.css') }}" rel="stylesheet">
    <link href="{{ asset('css/datatables.css') }}" rel="stylesheet">
    <link href="{{ asset('css/datatables.min.css') }}" rel="stylesheet">

    <!-- Vendor CSS -->
    <link href="{{ asset('vendor/select2/dist/css/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/datatables/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/buttons/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/scroller/css/scroller.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/responsive/css/responsive.bootstrap4.min.css') }}" rel="stylesheet">
    <style type="text/css">
        table{
            width: 100%;
        }
    </style>

</head>

<body>

    <div class="d-flex" id="wrapper">

        <!-- Sidebar -->
        <div class="bg-light" id="sidebar-wrapper">
            <div class="sidebar-heading border-right">E-raport </div>
            <div class="list-group list-group-flush">
                <a href="{{ route('home') }}" class="list-group-item list-group-item-action bg-light">Beranda</a>
                @if(Auth::user()->id_level == 1)
                <a href="{{ route('akun.index') }}" class="list-group-item list-group-item-action bg-light">Manejemen Akun</a>
                <a href="#data-collapse" data-toggle="collapse" class="list-group-item list-group-item-action bg-light">Data Master</a>
                <li class="collapse" id="data-collapse">
                    <a href="{{ route('level.index') }}" class="list-group-item list-group-item-action bg-light">Data Level</a>
                    <a href="{{ route('siswa.index') }}" class="list-group-item list-group-item-action bg-light">Data Siswa</a>
                    <a href="{{ route('guru.index') }}" class="list-group-item list-group-item-action bg-light">Data Guru</a>
                    <a href="{{ route('kelas.index') }}" class="list-group-item list-group-item-action bg-light">Data Kelas</a>
                    <a href="{{ route('jurusan.index') }}" class="list-group-item list-group-item-action bg-light">Data Jurusan</a>

                    <a href="{{ route('mapel.index') }}" class="list-group-item list-group-item-action bg-light">Data Mata Pelajaran</a>
                    <a href="{{ route('tahun.index') }}" class="list-group-item list-group-item-action bg-light">Data Tahun Ajaran</a>    
                    <a href="{{ route('walikelas.index') }}" class="list-group-item list-group-item-action bg-light">Data Walikelas</a>    
                </li>
                <a href="{{ route('mapel.index') }}" class="list-group-item list-group-item-action bg-light">Mata Pelajaran</a>
                @endif
                @if(Auth::user()->id_level == 2)
                
                <a href="{{ route('nilai.create') }}" class="list-group-item list-group-item-action bg-light">Penilaian</a>
                
                    <a href="{{ route('nilai.index') }}" class="list-group-item list-group-item-action bg-light">Data Nilai</a>
                @endif
                @if(Auth::user()->id_level == 4)
                <a href="{{ route('absen.create') }}" class="list-group-item list-group-item-action bg-light">Absensi</a>
                <a href="{{ route('absen.index') }}" class="list-group-item list-group-item-action bg-light">Rekapitulasi</a>
                
                @endif

                <a href="{{ route('logout') }}" class="list-group-item list-group-item-action bg-light" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>

            </div>
        </div>
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper">

        <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
            <i id="menu-toggle" class="fa fa-align-justify btn-lg"></i>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ auth::user()->name }}
                        </a>
                        <div id="menu-toggle" class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="#">Profil</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                               
                        </div>
                    </li>
                </ul>
            </div>
        </nav>

        <div class="container-fluid">
            @yield('content')
        </div>
    </div>
    <!-- /#page-content-wrapper -->
    
    </div>
    <!-- /#wrapper -->


</body>
<!-- Bootstrap core JavaScript -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <!-- Custom JavaScript -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/css.js') }}"></script>
    <script src="{{ asset('js/datatables.min.js') }}"></script>

    <!-- Vendor JavaScript -->
    <script src="{{ asset('vendor/select2/dist/js/select2.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/js/datatables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('vendor/fontawesome/js/all.min.js') }}"></script>
    <script src="{{ asset('vendor/buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('vendor/responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('vendor/scroller/js/scroller.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery-chained/jquery.chained.js') }}"></script>

    <!-- Menu Toggle Script -->
    <script>
        $(document).ready(function(){
            $("#menu-toggle").click(function(){
                $("#menu").toggle();
            });
        });
    </script>

    <!-- Datatable Script -->
    <script>
        $(document).ready(function() {
            $('#data-id').DataTable({
                "scrollX": true,
                "aLengthMenu": [[10, 25, 50, 100, 250, 500, -1], [10, 25, 50, 100, 250, 500, 'All']],
                "oLanguage": { 
                    "sInfo": 'Total _TOTAL_ data ditampilkan (_START_ sampai _END_)',
                    "sLengthMenu": 'Tampilkan _MENU_ data',   
                    "sInfoEmpty": 'Tidak ada data.',
                    "sSearch": 'Pencarian:',
                    "sEmptyTable": 'Tidak ada data di dalam Database',
                    "oPaginate": {
                        "sNext": 'Selanjutnya',
                        "sLast": 'Terakhir',
                        "sFirst": 'Pertama',
                        "sPrevious": 'Sebelumnya'
                    }
                }
            });
        });


    </script>

    <!-- Select Script -->
    <script>
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });
    </script>

    <!-- Chained Script -->
    <script>
        $('#kelas').chained('#tahun');
    </script>

    <!-- Modal Script -->
    <script>
            $('#exampleModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var recipient = button.data('whatever') // Extract info from data-* attributes
  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
  var modal = $(this)
  modal.find('.modal-title').text('New message to ' + recipient)
  modal.find('.modal-body input').val(recipient)
})
    </script>

    <!-- Modal Edit Script -->
    <script>
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
    </script>

    <!-- Modal Edit Level -->

    <script>
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
    </script>

      <!-- Modal Edit Jurusan -->

    <script>
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
    </script>

    <script>
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
    </script>


    <script>
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
    </script>

    <script>
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
</html>