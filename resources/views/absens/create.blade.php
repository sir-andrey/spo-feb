@extends('layouts.app')

@section('content')

<section role="main" class="content-body">

      <nav aria-label="breadcrumb">
      <ol class="breadcrumb mt-3">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
        <li class="breadcrumb-item active" aria-current="page">Absensi</li>
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
            <h4>Data Absensi</h2>
        </div>
        <div class="card-body">
            <a href="{{ route('absen.print') }}"><button class="btn btn-primary">Cetak Data Siswa</button></a>
            <br>
            <br>
            <table class="table table-bordered table-striped table-hover table-responsive" id="data-id" width="100%">
                <thead>
                    <tr> 
                        <th rowspan="2">No.</th>
                        <th rowspan="2">NISN</th>
                        <th rowspan="2">Nama</th>
                        <th rowspan="2">Kelas</th>
                        <th colspan="3" style="text-align: center;">{{ $bulan }} {{ date('Y') }}</th>
                        <th rowspan="2" style="width: 50px;"></th>
                    </tr>
                    <tr>
                        <th style="width: 50px;">Sakit</th>
                        <th style="width: 50px;">Izin</th>
                        <th style="width: 50px;">Alpa</th>
                    </tr>
                </thead>
                <tbody>

                    @if ( Auth::user()->id_level == 4)
                        @foreach( $dataabsen as $key => $siswa )
                            <tr>
                                <form role="form" action="{{ route('absen.update') }}" method="POST">
                                @csrf
                                <td>{{ $key+1 }}<input type="hidden" name="id_absen" value="{{ $siswa->id }}"></td>
                                <td>{{ $siswa->siswa->nisn }}</td>
                                <td>{{ $siswa->siswa->nama_siswa }}</td>
                                <td>{{ $siswa->kelas->tingkat }} {{ $siswa->kelas->jurusan->nama_jurusan }} {{ $siswa->kelas->kelas }}</td>
                                <td><input type="number" max="31" maxlength="3" style="text-align: center;" name="sakit" class="form-control" value="{{ $siswa->sakit }}"></td>
                                <td><input type="number" max="31" maxlength="3" style="text-align: center;" name="izin" class="form-control" value="{{ $siswa->izin }}"></td>
                                <td><input type="number" max="31" maxlength="3" style="text-align: center;" name="alpa" class="form-control" value="{{ $siswa->alpa }}"></td>
                                <td><button type="submit" class="btn btn-primary col-sm-12">Input</button></td>

                            </form>
                            </tr>
                        @endforeach
                    @elseif ( Auth::user()->id_level == 2 )
                        @foreach( $dataabsen as $key => $siswa )
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $siswa->siswa->nisn }}</td>
                                <td>{{ $siswa->siswa->nama_siswa }}</td>
                                <td>{{ $siswa->semester }}</td>
                                <td>{{ $siswa->n1 }}</td>
                                <td>{{ $siswa->n2 }}</td>
                                <td>{{ $siswa->n3 }}</td>
                                <td></td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </section>
</section>

@endsection
