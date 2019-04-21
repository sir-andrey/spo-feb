@extends('layouts.app')

@section('content')

 <section role="main" class="content-body">

   <nav aria-label="breadcrumb">
      <ol class="breadcrumb mt-3">
         <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
         <li class="breadcrumb-item active" aria-current="page">Data Walikelas</li>
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
         <h4>Data Walikelas</h2>
      </div>
        
      <div class="card-body">
             
         <button class="btn btn-primary" data-toggle="modal" data-target="#createWalikelas"><i class="fa fa-plus"></i></button>
         <a href="{{ route('tahun.print') }}">
            <button class="btn btn-primary"><i class="fa fa-print"></i></button>
         </a>
         <br>
         <br>
         <table class="table table-bordered table-striped table-hover" id="data-id" width="100%">
            <thead>
               <tr>
                  <th style="text-align: center;">NO.</th>
                  <th style="text-align: center;">Nama Guru</th>
                  <th style="text-align: center;">Kelas</th>
                  <th style="text-align: center; width: 200px;">Aksi</th>
               </tr>
            </thead>
            <tbody>
               @foreach( $walikelass as $key => $walikelas )
               <tr>
                  <td style="text-align: center;">{{ $key+1 }}</td>
                  <td>{{ $walikelas->guru->nama_guru }}</td>
                  <td>{{ $walikelas->kelas->tingkat }} {{ $walikelas->kelas->jurusan->nama_jurusan }} {{ $walikelas->kelas->kelas }}</td>
                  <td style="text-align: center;">
                      <button class="btn btn-primary col-sm-4" data-toggle="modal" data-target="#editWalikelas" data-id="{{ $walikelas->id_walikelas }}" data-nama="{{ $walikelas->guru->nama_guru }}"><i class="fa fa-pencil-alt"></i></button>
                      <a href="{{ route('tahun.destroy', $walikelas->id_walikelas) }}">
                          <button class="btn btn-danger col-sm-4" onclick="return confirm('Hapus data ini?')"><i class="fa fa-trash-alt"></i></button>
                       </a></td>
               </tr>
               @endforeach
            </tbody>
         </table>
      </div>
   </section>
</section>

<div class="modal fade" id="editWalikelas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Walikelas</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form method="POST" action="{{ route('walikelas.update') }}">
            @csrf
            <div class="modal-body">
               <div class="form-group">
                  <label for="recipient-name" class="col-form-label">Guru:</label>
                  <input type="hidden" name="id_walikelas" class="form-control" id="id">
                  <input type="text" name="nama" class="form-control" id="nama">
               </div>
               <div class="form-group">
                  <label class="control-label">Tahun Ajaran <span class="required">*</span></label>
                  <div class="">
                     <select name="id_tahun" id="tahun" class="form-control">
                        <option value="">-- Pilih Tahun --</option>
                        @foreach ($tahun as $data)
                           <option value="{{ $data->id_tahun }}">{{ $data->tahun }}</option>
                        @endforeach
                     </select>
                  </div>
               </div>
               <div class="form-group">
                  <label class="control-label">Kelas <span class="required">*</span></label>
                  <div class="">
                     <select name="id_kelas" id="kelas" class="form-control">
                        <option value="">-- Pilih Tahun terlebih dahulu --</option>
                        @foreach ($kelas as $datas)
                           <option value="{{ $datas->id_kelas }}" class="{{ $datas->id_tahun }}">{{ $datas->tingkat }} {{ $datas->jurusan->nama_jurusan }} {{ $datas->kelas }}</option>
                        @endforeach
                        </select>
                  </div>
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

<div class="modal fade" id="createWalikelas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Tambah Walikelas</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form method="POST" action="{{ route('walikelas.store') }}">
            @csrf
            <div class="modal-body">
               <div class="form-group">
                  <label for="recipient-name" class="col-form-label">Guru:</label><br>    
                  <select class="js-example-basic-single col-md-12" name="id_guru" data-show-subtext="true">
                     <option value="">-- Cari -- </option>
                     <optgroup label="Guru">
                        @foreach( $jadwal as $dataguru )
                        <option value="{{ $dataguru->id_guru }}">{{ $dataguru->guru->nama_guru }} ({{ $dataguru->mapel->nama_mapel }})</option>
                        @endforeach
                     </optgroup> 
                  </select>
               </div>
               <div class="form-group">
                  <label class="control-label">Tahun Ajaran <span class="required">*</span></label>
                  <div class="">
                     <select name="id_tahun" id="tahun" class="form-control">
                        <option value="">-- Pilih Tahun --</option>
                        @foreach ($tahun as $data)
                           <option value="{{ $data->id_tahun }}">{{ $data->tahun }}</option>
                        @endforeach
                     </select>
                  </div>
               </div>
               <div class="form-group">
                  <label class="control-label">Kelas <span class="required">*</span></label>
                  <div class="">
                     <select name="id_kelas" id="kelas" class="form-control">
                        <option value="">-- Pilih Tahun terlebih dahulu --</option>
                        @foreach ($kelas as $datas)
                           <option value="{{ $datas->id_kelas }}" class="{{ $datas->id_tahun }}">{{ $datas->tingkat }} {{ $datas->jurusan->nama_jurusan }} {{ $datas->kelas }}</option>
                        @endforeach
                        </select>
                  </div>
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

@endsection