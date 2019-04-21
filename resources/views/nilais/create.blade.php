@extends('layouts.app')

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
        <div class="card-header">
            <h4>Cari</h4>
        </div>
        <div class="card-body">
            <div class="col-md-12">   
                <form action="{{ url()->current() }}">
                    <div class="form-group">
                        <label for="">Semester</label>
                        <select name="semester" id="" class="form-control col-md-3">
                            <option value="Genap">Genap</option>
                            <option value="Ganjil">Ganjil</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Cari</button>
                    </div>
                </form>
            </div>
        </div>
    </section>    
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
            <table class="table table-bordered table-striped table-hover" id="data-id" width="100%">
                <thead>
                    <tr> 
                        <th rowspan="2">No.</th>
                        <th rowspan="2">NISN</th>
                        <th rowspan="2">Nama</th>
                        <th rowspan="2">Mapel</th>
                        <th colspan="6" style="text-align: center;">Semester</th>
                        <th rowspan="2">#</th>
                    </tr>
                    <tr>
                        <th>N1</th>
                        <th>N2</th>
                        <th>N3</th>
                        <th>PTS</th>
                        <th>PAS</th>
                        <th>NA</th>
                    </tr>
                </thead>
                <tbody>

                    @if ( Auth::user()->id_level == 2)
                        @foreach( $datanilai as $key => $siswa )
                            <tr>
                                <form role="form" action="{{ route('nilai.update') }}" method="POST">
                                @csrf
                                <td>{{ $key+1 }}<input type="hidden" name="id" value="{{ $siswa->id_mapel }}"></td>
                                <td>{{ $siswa->siswa->nisn }}</td>
                                <td>{{ $siswa->siswa->nama_siswa }}</td>
                                <td>{{ $siswa->mapel->nama_mapel }}</td>
                                @if($siswa->n1 == NULL)
                                <td><input type="text" style="text-align: center;" name="n1" class="form-control" value="{{ $siswa->n1 }}" maxlength="3" max="100" id="numberbox"></td>
                                @else
                                <td style="text-align: center;">{{ $siswa->n1 }} <input type="hidden" name="n1" value="{{ $siswa->n1 }}"></td>
                                @endif

                                @if($siswa->n2 == NULL)
                                <td><input type="text" style="text-align: center;" name="n2" class="form-control" value="{{ $siswa->n2 }}" onkeypress="return hanyaAngka(event)" maxlength="3" max="100"></td>
                                @else
                                <td style="text-align: center;">{{ $siswa->n2 }} <input type="hidden" name="n2" value="{{ $siswa->n2 }}"></td>
                                @endif

                                @if($siswa->n3 == NULL)
                                <td><input type="text" style="text-align: center;" name="n3" class="form-control" value="{{ $siswa->n3 }}" onkeypress="return hanyaAngka(event)" maxlength="3"></td>
                                @else
                                <td style="text-align: center;">{{ $siswa->n3 }} <input type="hidden" name="n3" value="{{ $siswa->n3 }}"></td>
                                @endif

                                @if($siswa->pts == NULL)
                                <td><input type="text" style="text-align: center;" name="pts" class="form-control" value="{{ $siswa->pts }}" onkeypress="return hanyaAngka(event)" maxlength="3"></td>
                                @else
                                <td style="text-align: center;">{{ $siswa->pts }} <input type="hidden" name="pts" value="{{ $siswa->pts }}"></td>
                                @endif

                                @if($siswa->pas == NULL)
                                <td><input type="text" style="text-align: center;" name="pas" class="form-control" value="{{ $siswa->pas }}" onkeypress="return hanyaAngka(event)" maxlength="3"></td>
                                @else
                                <td style="text-align: center;">{{ $siswa->pas }} <input type="hidden" name="pas" value="{{ $siswa->pas }}"></td>
                                @endif
                                
                                @if ($siswa->n1 != NULL && $siswa->n2 != NULL && $siswa->n3 != NULL && $siswa->pts != NULL && $siswa->pas != NULL)
                                <td>{{ ($siswa->n1 + $siswa->n2 + $siswa->n3 + $siswa->pts + $siswa->pas) / 5 }}</td>
                                @else
                                <td></td>
                                @endif
                                <td><button type="submit" class="btn btn-primary col-sm-12"><i class="fa fa-save"></i></button></td>
                            </form>
                            </tr>
                        @endforeach
                    @elseif ( Auth::user()->id_level == 4 )
                        @foreach( $datanilai as $key => $siswa )
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $siswa->siswa->nisn }}</td>
                                <td>{{ $siswa->siswa->nama_siswa }}</td>
                                <td>{{ $siswa->semester }}</td>
                                <td>{{ $siswa->n1 }}</td>
                                <td>{{ $siswa->n2 }}</td>
                                <td>{{ $siswa->n3 }}</td>
                                <td>{{ $siswa->pts }}</td>
                                <td>{{ $siswa->pas }}</td>
                                <td></td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
            <nav aria-label="Page navigation example">
  <ul class="pagination">
    {{ $datanilai->links() }}
  </ul>
</nav>
            
        </div>

    </section>
</section>

@endsection
