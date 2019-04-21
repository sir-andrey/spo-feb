@extends('layouts.app')

@section('content')
<section role="main" class="content-body">

   <nav aria-label="breadcrumb">
      <ol class="breadcrumb mt-3">
         <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
         <li class="breadcrumb-item active" aria-current="page">Data Jadwal</li>
      </ol>
   </nav>

         
    <section class="card mt-3">
      <section class="panel">
         @if(session()->has('success-create'))
         <div class="row-md-5">
            <div class="alert alert-success"> 
               <center>
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                     &times;
                  </button>
                  <strong>Berhasil</strong><br>
                  {{ session()->get('success-create') }}
               </center>
            </div>
         </div>
         @endif

         @if(session()->has('failed-create'))
         <div class="row-md-5">
            <div class="alert alert-danger"> 
               <center>
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                     &times;
                  </button>
                  <strong>Gagal</strong><br>
                  {{ session()->get('failed-create') }}
               </center>
            </div>
         </div>
         @endif
      </section>

      <div class="card-header">
         <h5>Data Jadwal Pelajaran</h5>
      </div>

      <div class="card-body">
         <button class="btn btn-primary" data-toggle="modal" data-target="#createJadwal"><i class="fa fa-plus"></i></button>
         <a href="{{ route('jadwal.print') }}"><button class="btn btn-primary"><i class="fa fa-print"></i></button></a>                     
         <br>
         <br>
         <table class="table table-bordered table-striped table-hover " id="data-id" width="100%">
            <thead>
               <tr> 
                  <th style="text-align: center;">No</th>
                  <th style="text-align: center;">NIP</th>
                  <th style="text-align: center;">Guru</th>
                  <th style="text-align: center;">Mata Pelajaran</th>
                  <th style="text-align: center;">Kelas</th>
                  <th style="text-align: center;">Tahun Ajaran</th>
                  @if(auth::user()->id_level == 1)
                     <th style="text-align: center;">Aksi</th>
                  @endif
               </tr>
            </thead>
            <tbody>
               @foreach( $jadwals as $key => $jadwal )
               <tr>
                  <td>{{ $key+1 }}</td>
                  <td>{{ $jadwal->guru->nip }}</td>
                  <td>{{ $jadwal->guru->nama_guru }}</td>
                  <td>{{ $jadwal->mapel->nama_mapel }}</td>
                  <td>{{ $jadwal->kelas->tingkat }} - {{ $jadwal->kelas->jurusan->nama_jurusan }} - {{ $jadwal->kelas->kelas }}</td>
                  <td>{{ $jadwal->kelas->tahun->tahun }}</td>

                  @if(auth::user()->id_level == 1)
                  <td style="text-align: center;">
                     <button class="btn btn-primary col-sm-4" data-toggle="modal" data-target="#editJadwal" data-id="{{ $jadwal->id_jadwal }}" data-kode="{{ $jadwal->kode_jadwal }}"><i class="fa fa-pencil-alt"></i></button>
                     <a href="{{ route('jadwal.destroy', $jadwal->id_jadwal) }}">
                        <button class="btn btn-danger col-sm-4" onclick="return confirm('Hapus data ini?')"><i class="fa fa-trash-alt"></i></button>
                     </a></td>
                  @endif
               </tr>
               @endforeach
            </tbody>
         </table>
      </div>
   </section>
</section>

<div class="modal fade" id="createJadwal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Tambah Jadwal Pelajaran</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form method="POST" action="{{ route('jadwal.store') }}">
            @csrf
            <div class="modal-body">
               <div class="form-group">
                  <label for="name">Kode Jadwal :</label>
                  <input type="text" class="form-control" name="kode_jadwal" id="kode" value="{{ $id_jadwal }}" maxlength="5" readonly />
               </div>
               <div class="form-group">
                  <label>Guru : </label><br>
                  <select name="id_guru" class="form-control">
                     <option value="">-- Pilih Guru --</option>
                     @foreach ($gurus as $guru)
                        <option value="{{ $guru->id_guru }}">{{ $guru->nama_guru }}</option>
                     @endforeach
                  </select>
               </div>
               <div class="form-group">
                  <label>Mata Pelajaran : </label><br>
                  <select name="id_mapel" class="form-control">
                  <option value="">-- Pilih Mata Pelajaran --</option>
                  @foreach ($mapels as $mapel)
                     <option value="{{ $mapel->id_mapel }}">{{ $mapel->nama_mapel }}  </option>
                  @endforeach
                  </select>
               </div>
               <div class="form-group">
                  <label for="name">Tahun Ajaran :</label>
                  <select name="id_tahun" id="tahun" class="form-control">
                     <option value="">-- Pilih Tahun --</option>
                     @foreach ($tahuns as $data)
                        <option value="{{ $data->id_tahun }}">{{ $data->tahun }}</option>
                     @endforeach
                  </select>
                    
                  <label for="name">Kelas :</label>
                  <select name="id_kelas" id="kelas" class="form-control">
                     <option value="">-- Pilih Tahun terlebih dahulu --</option>
                     @foreach ($kelas as $datas)
                        <option value="{{ $datas->id_kelas }}" class="{{ $datas->id_tahun }}">{{ $datas->tingkat }} {{ $datas->jurusan->nama_jurusan }} {{ $datas->kelas }}</option>
                     @endforeach
                  </select>
                </div>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
               <button type="submit" class="btn btn-primary">Tambah</button>
            </div>
         </form>
      </div>
   </div>
</div>

<div class="modal fade" id="editJadwal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ubah Jadwal Pelajaran</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form method="POST" action="{{ route('jadwal.update') }}">
            @csrf
            <div class="modal-body">
               <div class="form-group">
                  <label for="name">ID Jadwal :</label>
                  <input type="text" class="form-control" name="kode_jadwal" id="kode" />
               </div>
               <div class="form-group">
                  <label>Guru : </label><br>
                  <select name="id_guru" class="form-control">
                     <option value="">-- Pilih Guru --</option>
                     @foreach ($gurus as $guru)
                        <option value="{{ $guru->id_guru }}">{{ $guru->nama_guru }}</option>
                     @endforeach
                  </select>
               </div>
               <div class="form-group">
                  <label>Mata Pelajaran : </label><br>
                  <select name="id_mapel" class="form-control">
                     <option value="">-- Pilih Mata Pelajaran --</option>
                     @foreach ($mapels as $mapel)
                        <option value="{{ $mapel->id_mapel }}">{{ $mapel->nama_mapel }}  </option>
                     @endforeach
                 </select>
               </div>
               <div class="form-group">
                  <label for="name">Tahun Ajaran :</label>
                  <select name="id_tahun" id="tahun" class="form-control">
                     <option value="">-- Pilih Tahun --</option>
                     @foreach ($tahuns as $data)
                        <option value="{{ $data->id_tahun }}">{{ $data->tahun }}</option>
                     @endforeach
                  </select>
               </div>
               <div class="form-group">
                  <label for="name">Kelas :</label>
                  <select name="id_kelas" id="kelas" class="form-control">
                     <option value="">-- Pilih Tahun terlebih dahulu --</option>
                     @foreach ($kelas as $datas)
                        <option value="{{ $datas->id_kelas }}" class="{{ $datas->id_tahun }}">{{ $datas->tingkat }} {{ $datas->jurusan->nama_jurusan }} {{ $datas->kelas }}</option>
                     @endforeach
                  </select>
               </div>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
               <button type="submit" class="btn btn-primary">Ubah</button>
            </div>
         </form>
      </div>
   </div>
</div>

@endsection
