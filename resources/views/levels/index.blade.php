@extends('layouts.app')

@section('content')

 <section role="main" class="content-body">

      <nav aria-label="breadcrumb">
      <ol class="breadcrumb mt-3">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
        <li class="breadcrumb-item active" aria-current="page">Data  Level</li>
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
        <div class="card-header">
                <h4>Data Level</h2>
        </div>
        <div class="card-body">
             
            <a href="{{ route('level.create') }}">
                <button class="btn btn-primary">Tambah Data Level</button>
            </a>
            <a href="{{ route('level.print') }}">
                <button class="btn btn-primary">Cetak Data Level</button>
            </a>
            <br>
            <br>
            <table class="table table-bordered table-striped table-hover" id="data-id">
                <thead>
                    <tr>
                        <th style="text-align: center;">NO.</th>
                        <th style="text-align: center;">Kode Level</th>
                        <th style="text-align: center;">Nama Level</th>
                        <th style="text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                   @foreach( $levels as $key => $level )
                    <tr>
                        <td style="text-align: center;">{{ $key+1 }}</td>
                        <td>{{ $level->kode_level }}</td>
                        <td>{{ $level->nama_level }}</td>
                        <td style="text-align: center;">
                            <a href="{{ route('level.edit', $level->id_level) }}">
                                <button class="btn btn-primary col-sm-4" >Edit
                                </button></a>
                            <a href="{{ route('level.destroy', $level->id_level) }}">
                                <button class="btn btn-danger col-sm-4" onclick="return confirm('Hapus data ini?')">Hapus
                                </button></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
</section>

@endsection