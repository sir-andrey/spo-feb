@extends('layouts.app')

@section('content')

 <section role="main" class="content-body">
    
     
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb mt-3">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
        <li class="breadcrumb-item active" aria-current="page">Data Jurusan</li>
      </ol>
    </nav>


    <section class="card mt-3">
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
    <section class="card mt-3">
        
        <div class="card-header">
                <h4>Data Jurusan</h2>
        </div>
        <div class="card-body">
             
            <a href="{{ route('jurusan.create') }}">
                <button class="btn btn-primary">Tambah Data Jurusan</button>
            </a>
            <a href="{{ route('jurusan.print') }}">
                <button class="btn btn-primary">Cetak Data Jurusan</button>
            </a>
            <br>
            <br>
            <table class="table table-bordered table-striped table-hover" id="data-id">
                <thead>
                    <tr>
                        <th style="text-align: center;">NO.</th>
                        <th style="text-align: center;">Kode Jurusan</th>
                        <th style="text-align: center;">Nama Jurusan</th>
                        @if(Auth::user()->id_level == 1)
                        <th style="text-align: center;">Aksi</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                   @foreach( $jurusans as $key => $jurusan )
                    <tr>
                        <td style="text-align: center;">{{ $key+1 }}</td>
                        <td>{{ $jurusan->kode_jurusan }}</td>
                        <td>{{ $jurusan->nama_jurusan }}</td>
                        @if(Auth::user()->id_level == 1)
                        <td style="text-align: center;">
                            <a href="{{ route('jurusan.edit', $jurusan->id_jurusan) }}">
                                <button class="btn btn-primary col-sm-4" >Edit
                                </button></a>
                            <a href="{{ route('jurusan.destroy', $jurusan->id_jurusan) }}">
                                <button class="btn btn-danger col-sm-4" onclick="return confirm('Hapus data ini?')">Hapus
                                </button></a>
                        </td>
                        @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
</section>

@endsection