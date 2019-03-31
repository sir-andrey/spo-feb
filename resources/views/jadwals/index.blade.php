@extends('layouts.app')

@section('content')
<section role="main" class="content-body">

    <nav aria-label="breadcrumb">
      <ol class="breadcrumb mt-3">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
        <li class="breadcrumb-item active" aria-current="page">Data Jadwal</li>
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
            <h4>Data Jadwal Pelajaran</h2>
        </div>
        <div class="card-body">
            <a href="{{ route('jadwal.create') }}"><button class="btn btn-primary">Tambah Data</button></a>
            <a href="{{ route('jadwal.print') }}"><button class="btn btn-primary">Cetak Data</button></a>                     
            <br>
            <br>
            <table class="table table-bordered table-striped table-hover" id="data-id">
                <thead>
                    <tr> 
                        <th style="text-align: center;">No</th>
                        <th style="text-align: center;">NIP</th>
                        <th style="text-align: center;">Guru</th>
                        <th style="text-align: center;">Mata Pelajaran</th>
                        <th style="text-align: center;">Kelas</th>
                        <th style="text-align: center;">Tahun Ajaran</th>
                        @if(auth::user()->id_level == 1)
                        <th style="text-align: center;">Aksi</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach( $jadwals as $key => $jadwal )
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $jadwal->guru->nip }}</td>
                            <td>{{ $jadwal->guru->nama_guru }}</td>
                            <td>{{ $jadwal->mapel->nama_mapel }}</td>
                            <td>{{ $jadwal->kelas->tingkat }}
                                {{ $jadwal->kelas->jurusan->nama_jurusan }}
                                {{ $jadwal->kelas->kelas }}
                            </td>
                            <td>{{ $jadwal->kelas->tahun->tahun }}</td>

                            @if(auth::user()->id_level == 1)
                            <td style="text-align: center;">
                            <a href="{{ route('jadwal.edit', $jadwal->id_jadwal) }}">
                                <button class="btn btn-primary col-sm-4" >Edit
                                </button></a>
                            <a href="{{ route('jadwal.destroy', $jadwal->id_jadwal) }}">
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
