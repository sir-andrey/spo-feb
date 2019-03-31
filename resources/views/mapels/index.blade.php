@extends('layouts.app')

@section('content')
<section role="main" class="content-body">

       <nav aria-label="breadcrumb">
      <ol class="breadcrumb mt-3">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
        <li class="breadcrumb-item active" aria-current="page">Data Mata Pelajaran</li>
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
            <h4>Data Mata Pelajaran</h2>
        </div>
        <div class="card-body">
            <a href="{{ route('mapel.create') }}"><button class="btn btn-primary">Tambah Data</button></a>
            <a href="{{ route('mapel.print') }}"><button class="btn btn-primary">Cetak Data</button></a>
            <br>
            <br>
            <table class="table table-bordered table-striped table-hover" id="data-id">
                <thead>
                    <tr> 
                        <th>N0.</th>
                        <th>Mata Pelajaran</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach( $mapels as $key => $mapel )
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $mapel->nama_mapel }}</td>
                            <td><a href="{{ route('mapel.edit', $mapel->id_mapel) }}">
                            <button class="btn btn-primary col-sm-4" >Edit</button></a><a href="{{ route('mapel.destroy', $mapel->id_mapel) }}">
                            <button class="btn btn-danger col-sm-4">Hapus</button></a></td>
                        </tr>
                        @endforeach
                </tbody>
            </table>
        </div>
    </section>
</section>

@endsection
