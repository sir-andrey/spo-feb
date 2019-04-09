@extends('layouts.app')

@section('content')
<section role="main" class="content-body">


       <nav aria-label="breadcrumb">
      <ol class="breadcrumb mt-3">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
        <li class="breadcrumb-item active" aria-current="page">Data Siswa</li>
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
                <h4>Data Siswa</h2>
        </div>
        <div class="card-body">
            <a href="{{ route('siswa.create') }}"><button class="btn btn-primary">Tambah Data</button></a>
            <a href="{{ route('siswa.print') }}"><button class="btn btn-primary">Cetak Data</button></a>                     
            <br>
            <br>
            <table class="table table-bordered table-striped table-hover table-responsive" id="data-id">
                <thead>
                    <tr> 
                        <th>No.</th>
                        <th>NISN</th>
                        <th>Nama</th>
                        <th>Kelas</th>
                        <th>Tahun Ajaran</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach( $siswas as $key => $siswa )
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $siswa->nisn }}</td>
                            <td>{{ $siswa->nama_siswa }}</td>
                            <td>{{ $siswa->kelas->tingkat }}-
                                {{ $siswa->kelas->jurusan->nama_jurusan }}-
                                {{ $siswa->kelas->kelas }}
                            <td>{{ $siswa->kelas->tahun->tahun }}</td>
                            <td style="text-align: center;">
                            <a href="{{ route('siswa.edit', $siswa->id_siswa) }}">
                                <button class="btn btn-primary col-sm-4" >Edit
                                </button></a>
                            <a href="{{ route('siswa.destroy', $siswa->id_siswa) }}">
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
