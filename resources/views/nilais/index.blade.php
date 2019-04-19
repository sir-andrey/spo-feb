@extends('layouts.app')
@php
use App\Nilai;
@endphp
@section('content')

<section role="main" class="content-body">

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mt-3">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
            <li class="breadcrumb-item"><a href="{{ route('nilai.index') }}">Data Nilai</a></li>
            <li class="breadcrumb-item active" aria-current="page">Penilaian</li>
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
                    <p>Silahkan lihat <a href="{{ route('nilai.index') }}">Data nilai</a></p>
                </center>
            </div>
        </div>
        @endif
        <div class="card-header">
            <h4>Data Nilai</h2>
        </div>
        <div class="card-body">
            @if( auth::user()->id_level != 3 )
            <a href="{{ route('nilai.print') }}"><button class="btn btn-primary"><i class="fa fa-print"></i></button></a>
            <br>
            <br>
            <table class="table table-bordered table-striped table-hover " id="data-id" width="100%">
                <thead>
                    <tr>
                        
                    </tr>
                    <tr> 
                        <th rowspan="3">No.</th>
                        <th rowspan="3">NISN</th>
                        <th rowspan="4">Nama</th>
                        <th rowspan="3">Mapel</th>
                        <th colspan="14" style="text-align: center;">Semester</th>
                        <th rowspan="3">Total</th>
                        
                    </tr>
                    <tr>
                        <th colspan="7" style="text-align: center;">Ganjil</th>
                        <th colspan="7" style="text-align: center;">Genap</th>
                        
                        
                    </tr>
                    <tr>
                        <th>N1</th>
                        <th>N2</th>
                        <th>N3</th>
                        <th>PTS</th>
                        <th>PAS</th>
                        <th>NA</th>
                        <th>Total</th>

                        <th>N1</th>
                        <th>N2</th>
                        <th>N3</th>
                        <th>PTS</th>
                        <th>PAS</th>
                        <th>NA</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                        @foreach( $datanilai as $key => $siswa )
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $siswa->siswa->nisn }}</td>
                                <td>{{ $siswa->siswa->nama_siswa }}</td>
                                <td>{{ $siswa->mapel->nama_mapel }}</td>
                                @php
                                    $nilai = Nilai::where('id_siswa', $siswa->id_siswa)->where('id_mapel', $siswa->id_mapel)->get();
                                @endphp
                                @foreach($nilai as $key => $nilais)
                                <td>{{ $nilais->n1 }}</td>
                                <td>{{ $nilais->n2 }}</td>
                                <td>{{ $nilais->n3 }}</td>
                                <td>{{ $nilais->pts }}</td>
                                <td>{{ $nilais->pas }}</td>                     
                                <td>{{ ($nilais->n1 + $nilais->n2 + $nilais->n3 + $nilais->pts + $nilais->pas) / 5 }}</td>
                                <td>{{ $nilais->n1 + $nilais->n2 + $nilais->n3 + $nilais->pts + $nilais->pas }}</td>
                                @endforeach
                                <td></td>

                            </tr>
                        @endforeach
                </tbody>
            </table>
            @else
            <div class="col-md-12">
                <p>NISN : {{ $siswa->nisn }}</p>
                <p>Nama : {{ $siswa->nama_siswa }}</p>
                <p>Nama : {{ $siswa->kelas->tingkat }} {{ $siswa->kelas->jurusan->nama_jurusan }} {{ $siswa->kelas->kelas }}</p>
            </div>
            <table class="table table-bordered table-striped table-hover " id="data-id" width="100%">
                <thead>
                    <tr> 
                        <th rowspan="3">No.</th>
                        <th rowspan="3">Mapel</th>
                        <th colspan="14" style="text-align: center;">Semester</th>
                        <th rowspan="3">Total</th>
                        
                    </tr>
                    <tr>
                        <th colspan="7" style="text-align: center;">Ganjil</th>
                        <th colspan="7" style="text-align: center;">Genap</th>
                        
                        
                    </tr>
                    <tr>
                        <th>N1</th>
                        <th>N2</th>
                        <th>N3</th>
                        <th>PTS</th>
                        <th>PAS</th>
                        <th>NA</th>
                        <th>Total</th>

                        <th>N1</th>
                        <th>N2</th>
                        <th>N3</th>
                        <th>PTS</th>
                        <th>PAS</th>
                        <th>NA</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                        @foreach( $datanilai as $key => $siswa )
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $siswa->mapel->nama_mapel }}</td>
                                @php
                                    $nilai = Nilai::where('id_siswa', $siswa->id_siswa)->where('id_mapel', $siswa->id_mapel)->get();
                                @endphp
                                @foreach($nilai as $key => $nilais)
                                <td>{{ $nilais->n1 }}</td>
                                <td>{{ $nilais->n2 }}</td>
                                <td>{{ $nilais->n3 }}</td>
                                <td>{{ $nilais->pts }}</td>
                                <td>{{ $nilais->pas }}</td>                     
                                <td>{{ ($nilais->n1 + $nilais->n2 + $nilais->n3 + $nilais->pts + $nilais->pas) / 5 }}</td>
                                <td>{{ $nilais->n1 + $nilais->n2 + $nilais->n3 + $nilais->pts + $nilais->pas }}</td>
                                @endforeach
                                <td></td>

                            </tr>
                        @endforeach
                </tbody>
            </table>
            @endif
        </div>
    </section>
</section>

@endsection
