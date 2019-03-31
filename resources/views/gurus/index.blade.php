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
                <h4>Data Guru</h2>
        </div>
        <div class="card-body">
             
            <a href="{{ route('guru.create') }}">
                <button class="btn btn-primary">Tambah Data Guru</button>
            </a>
            <a href="{{ route('guru.print') }}">
                <button class="btn btn-primary">Cetak Data Guru</button>
            </a>
            <br>
            <br>
            <table class="table table-bordered table-striped table-hover" id="data-id">
                <thead>
                    <tr>
                        <th style="text-align: center;">NO.</th>
                        <th style="text-align: center;">NIP</th>
                        <th style="text-align: center;">Nama</th>
                        <th style="text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                   @foreach( $gurus as $key => $guru )
                    <tr>
                        <td style="text-align: center;">{{ $key+1 }}</td>
                        <td>{{ $guru->nip }}</td>
                        <td>{{ $guru->nama_guru }}</td>
                        @if(Auth::user()->id_level == 1)
                        <td style="text-align: center;">
                            <a href="{{ route('guru.edit', $guru->id_guru) }}">
                                <button class="btn btn-primary col-sm-4" >Edit
                                </button></a>
                            <a href="{{ route('guru.destroy', $guru->id_guru) }}">
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