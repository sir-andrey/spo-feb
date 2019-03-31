@extends('layouts.app')

@section('content')
<section role="main" class="content-body">


       <nav aria-label="breadcrumb">
      <ol class="breadcrumb mt-3">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
        <li class="breadcrumb-item active" aria-current="page">Data Nilai</li>
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
            <h4>Data Nilai</h2>
        </div>
        <div class="card-body">
            <a href="{{ route('nilai.print') }}"><button class="btn btn-primary">Cetak Data Siswa</button></a>
            <br>
            <br>
            <table class="table table-bordered table-striped table-hover" id="data-id">
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
                            <td><a href="{{ route('nilai.detail', $siswa->id_siswa) }}"><button class="btn btn-primary col-sm-8" >Detil</button></a></td>
                        </tr>
                        @endforeach
                </tbody>
            </table>
        </div>
    </section>
</section>



@endsection
