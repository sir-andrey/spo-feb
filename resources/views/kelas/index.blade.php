@extends('layouts.app')

@section('content')

 <section role="main" class="content-body">


    <nav aria-label="breadcrumb">
      <ol class="breadcrumb mt-3">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
        <li class="breadcrumb-item active" aria-current="page">Data Kelas</li>
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
                <h4>Data Kelas</h2>
        </div>
        <div class="card-body">
             
            <a href="{{ route('kelas.create') }}">
                <button class="btn btn-primary">Tambah Data Kelas</button>
            </a>
            <a href="{{ route('kelas.print') }}">
                <button class="btn btn-primary">Cetak Data Kelas</button>
            </a>
            <br>
            <br>
            <table class="table table-bordered table-striped table-hover" id="data-id">
                <thead>
                    <tr>
                        <th style="text-align: center;">NO.</th>
                        <th style="text-align: center;">Kode Kelas</th>
                        <th style="text-align: center;">Kelas</th>
                        <th style="text-align: center;">Tahun Ajaran</th>
                        <th style="text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                   @foreach( $kelas as $key => $data )
                    <tr>
                        <td style="text-align: center;">{{ $key+1 }}</td>
                        <td>{{ $data->kode_kelas }}</td>
                        <td>{{ $data->tingkat }}
                            {{ $data->jurusan->nama_jurusan }}
                            {{ $data->kelas }}
                        </td>
                        <td>{{ $data->tahun->tahun }}</td>
                        <td style="text-align: center;">
                            <a href="{{ route('kelas.edit', $data->id_kelas) }}">
                                <button class="btn btn-primary col-sm-4" >Edit
                                </button></a>
                            <a href="{{ route('kelas.destroy', $data->id_kelas) }}">
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