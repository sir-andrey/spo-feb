@extends('layouts.app')
@php
use App\Absen;
@endphp
@section('content')

<section role="main" class="content-body">

      <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
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
            <a href="{{ route('absen.print') }}"><button class="btn btn-primary"><i class="fa fa-print"></i></button></a>
            <br>
            <br>
            <table class="table table-bordered table-striped table-hover" id="data-id" width="100%">
                <thead>
                    <tr> 
                        <th rowspan="2">No.</th>
                        <th rowspan="2">Nama</th>
                        <th colspan="3" style="text-align: center;">Juli</th>
                        <th colspan="3" style="text-align: center;">Agustus</th>
                        <th colspan="3" style="text-align: center;">September</th>
                        <th colspan="3" style="text-align: center;">Oktober</th>
                        <th colspan="3" style="text-align: center;">November</th>
                        <th colspan="3" style="text-align: center;">Desember</th>
                        <th colspan="3" style="text-align: center;">Januari</th>
                        <th colspan="3" style="text-align: center;">Februari</th>
                        <th colspan="3" style="text-align: center;">Maret</th>
                        <th colspan="3" style="text-align: center;">April</th>
                        <th colspan="3" style="text-align: center;">Mei</th>
                        <th colspan="3" style="text-align: center;">Juni</th>
                        <th colspan="3" style="text-align: center;">Total</th>
                    </tr>
                    <tr>
                        @for($i = 1; $i <= 13; $i++)
                        <th style="width: 10px;">S</th>
                        <th style="width: 10px;">I</th>
                        <th style="width: 10px;">A</th>
                        @endfor
                    </tr>
                </thead>
                <tbody>
                    @foreach( $dataabsen as $key => $siswa )
                        <tr>
                            <td>{{ $key+1 }}<input type="hidden" name="id_absen" value="{{ $siswa->id }}"></td>
                            <td>{{ $siswa->siswa->nama_siswa }}</td>
                            @php
                                $abse = Absen::where('id_siswa', $siswa->id_siswa)->get();

                                $sakit = Absen::select('sakit')->where('id_siswa', $siswa->id_siswa)->get();
                                $sumsakit = $sakit->sum('sakit');

                                $izin = Absen::select('izin')->where('id_siswa', $siswa->id_siswa)->get();
                                $sumizin = $izin->sum('izin');

                                $alpa = Absen::select('alpa')->where('id_siswa', $siswa->id_siswa)->get();
                                $sumalpa = $alpa->sum('alpa');


                            @endphp

                            @foreach( $abse as $key => $absen )
                            <td>{{ $absen->sakit }}</td>
                            <td>{{ $absen->izin }}</td>
                            <td>{{ $absen->alpa }}</td>
                            @endforeach
                            <td>{{ $sumsakit }}</td>
                            <td>{{ $sumizin }}</td>
                            <td>{{ $sumalpa }}</td>
                            
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
</section>

@endsection
