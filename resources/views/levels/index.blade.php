@extends('layouts.app')

@section('content')

<section role="main" class="content-body">

   <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
         <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
         <li class="breadcrumb-item active" aria-current="page">Data Level</li>
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
         <h3>Data Level</h3>
      </div>

      <div class="card-body">     
         <button class="btn btn-primary" data-toggle="modal" data-target="#createLevel"><i class="fa fa-plus"></i></button>
         <a href="{{ route('level.print') }}">
            <button class="btn btn-primary"><i class="fa fa-print"></i></button>
         </a>
         <br>
         <br>
         <table class="table table-bordered table-striped table-hover" id="data-id" width="100%">
            <thead>
               <tr>
                  <th style="text-align: center;">NO.</th>
                  <th style="text-align: center;">Kode Level</th>
                  <th style="text-align: center;">Level</th>
                  <th style="text-align: center;" width="200px">Aksi</th>
               </tr>
            </thead>
            <tbody>
               @foreach( $levels as $key => $level )
               <tr>
                  <td style="text-align: center;">{{ $key+1 }}</td>
                  <td>{{ $level->kode_level }}</td>
                  <td>{{ $level->nama_level }}</td>
                  <td style="text-align: center;">
                     <button class="btn btn-primary col-sm-4" data-toggle="modal" data-target="#editLevel" data-id="{{ $level->id_level }}" data-kode="{{ $level->kode_level }}" data-level="{{ $level->nama_level }}"><i class="fa fa-pencil-alt"></i></button>
                     <a href="{{ route('level.destroy', $level->id_level) }}">
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
<div class="modal fade" id="createLevel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Tambah Level</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form method="POST" action="{{ route('level.store') }}">
            @csrf
            <div class="modal-body">
               <div class="form-group">
                  <label for="recipient-name" class="col-form-label">Kode Level:</label>
                  <input type="text" class="form-control" name="kode_level" id="kode" readonly=""  value="{{ $id_level }}">
               </div>
               <div class="form-group">
                  <label for="recipient-name" class="col-form-label">Level:</label>
                  <input type="text" class="form-control" name="nama_level" id="nama_level" onkeypress="return hanyaHuruf(event)" >
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


<div class="modal fade" id="editLevel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ubah Level</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form method="POST" action="{{ route('level.update') }}">
            @csrf
            <div class="modal-body">
               <div class="">
                  <input type="hidden" class="form-control" name="id_level" id="id">
               </div>
               <div class="">
                  <label for="recipient-name" class="col-form-label">Kode Level:</label>
                  <input type="text" class="form-control" name="kode_level" id="kode" readonly="">
               </div>
               <div class="form-group">
                  <label for="recipient-name" class="col-form-label">Level:</label>
                  <input type="text" class="form-control" name="nama_level" id="nama_level" onkeypress="return hanyaHuruf(event)" >
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