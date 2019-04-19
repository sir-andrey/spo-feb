@extends('layouts.app')

@section('content')

<section role="main" class="content-body">

   <nav aria-label="breadcrumb">
      <ol class="breadcrumb mt-3">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
        <li class="breadcrumb-item active" aria-current="page">Data Guru</li>
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
         <h5>Data Guru</h5>
      </div>

      <div class="card-body">
         <button class="btn btn-primary" data-toggle="modal" data-target="#createGuru"><i class="fa fa-plus"></i></button>
         <a href="{{ route('tahun.print') }}">
            <button class="btn btn-primary"><i class="fa fa-print"></i></button>
         </a>
         <br>
         <br>
         <table class="table table-bordered table-striped table-hover" id="data-id" width="100%">
            <thead>
               <tr>
                  <th style="text-align: center;">NO.</th>
                  <th style="text-align: center;">NIP</th>
                  <th style="text-align: center;">Nama</th>
                  <th style="text-align: center;" width="200px">Aksi</th>
               </tr>
            </thead>
            <tbody>
               @foreach( $gurus as $key => $guru )
               <tr>
                  <td style="text-align: center;">{{ $key+1 }}</td>
                  <td>{{ $guru->nip }}</td>
                  <td>{{ $guru->nama_guru }}</td>
                  <td style="text-align: center;">
                     <button class="btn btn-primary col-sm-4" data-toggle="modal" data-target="#editGuru" data-id="{{ $guru->id_guru }}" data-kode="{{ $guru->kode_guru }}" data-nip="{{ $guru->nip }}" data-guru="{{ $guru->nama_guru }}"><i class="fa fa-pencil-alt"></i></button>
                     <a href="{{ route('guru.destroy', $guru->id_guru) }}">
                          <button class="btn btn-danger col-sm-4" onclick="return confirm('Hapus data ini?')"><i class="fa fa-trash-alt"></i></button>
                     </a></td>
               </tr>
               @endforeach
            </tbody>
         </table>
      </div>
   </section>
</section>

<!-- Modal View -->
<div class="modal fade" id="createGuru" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Tambah Tahun Ajaran</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form method="POST" action="{{ route('guru.store') }}">
            @csrf
            <div class="modal-body">
               <div class="form-group">
                  <label for="recipient-name" class="col-form-label">Kode Guru:</label>
                  <input type="text" class="form-control" name="kode_guru" id="kode" maxlength="5">
               </div>
               <div class="form-group">
                  <label for="recipient-name" class="col-form-label">NIP:</label>
                  <input type="text" onkeypress="return hanyaAngka(event)" maxlength="10" name="nip" class="form-control" />
               </div>
               <div class="form-group">
                  <label for="recipient-name" class="col-form-label">Nama:</label>
                  <input type="text" class="form-control" name="nama_guru" id="nama_guru" onkeypress="return hanyaHuruf(event)" >
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


<div class="modal fade" id="editGuru" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ubah Guru</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form method="POST" action="{{ route('guru.update') }}">
            @csrf
            <div class="modal-body">
               <div class="">
                  <input type="hidden" class="form-control" name="id_guru" id="id">
               </div>
               <div class="form-group">
                  <label for="recipient-name" class="col-form-label">Kode Guru:</label>
                  <input type="text" class="form-control" name="kode_guru" id="kode" readonly="" maxlength="5">
               </div>
               <div class="form-group">
                  <label for="recipient-name" class="col-form-label">NIP:</label>
                  <input type="text" class="form-control" name="nip" id="nip" onkeypress="return hanyaAngka(event)" >
               </div>
               <div class="form-group">
                  <label for="recipient-name" class="col-form-label">Nama:</label>
                  <input type="text" class="form-control" name="nama_guru" id="guru" onkeypress="return hanyaHuruf(event)" >
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