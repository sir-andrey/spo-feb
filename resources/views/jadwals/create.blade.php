@extends('layouts.app')

@section('content')

 <section role="main" class="content-body">

    <nav aria-label="breadcrumb">
      <ol class="breadcrumb mt-3">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
        <li class="breadcrumb-item"><a href="{{ route('jadwal.index') }}">Data Jadwal</a></li>
        <li class="breadcrumb-item active" aria-current="page">Tambah</li>
      </ol>
    </nav>


    <section class="card mt-3">
        <div class="card-header">
              <section class="panel">
                            @if(session()->has('failed-create'))
                            <div class="row-md-5">
                                <div class="alert alert-danger"> 
                                    <center>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                                        &times;
                                        </button>
                                        <strong>Gagal</strong><br>
                                        {{ session()->get('failed-create') }}
                                    </center>
                                </div>
                            </div>
                            @endif
                        </section>
                        <h4>Tambah Siswa</h4>
        </div>
        <div class="card-body">
            <div class="col-md-12">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div><br />
            @endif

            <form method="post" action="{{ route('jadwal.store') }}">
                @csrf
                <div class="form-group">
                    <label for="name">ID Jadwal :</label>
                    <input type="text" class="form-control" name="kode_jadwal"/>
                </div>
                <div class="form-group">
                    <label>Guru : </label><br>
                    <select name="id_guru">
                    @foreach ($gurus as $guru)
                        <option value="{{ $guru->id_guru }}">{{ $guru->nama_guru }}</option>
                    @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Mata Pelajaran : </label><br>
                    <select name="id_mapel">
                    @foreach ($mapels as $mapel)
                        <option value="{{ $mapel->id_mapel }}">{{ $mapel->nama_mapel }}  </option>
                    @endforeach
                    </select>
                </div>
                   <div class="form-group">
                    <label for="name">Tahun Ajaran :</label>
                    <select name="id_tahun" id="tahun">
                        <option value="">-- Pilih Tahun --</option>
                        @foreach ($tahuns as $data)
                        <option value="{{ $data->id_tahun }}">{{ $data->tahun }}</option>
                        @endforeach
                    </select>
                    
                    <label for="name">Kelas :</label>
                    <select name="id_kelas" id="kelas">
                        <option value="">-- Pilih Tahun terlebih dahulu --</option>
                        @foreach ($kelas as $datas)
                        <option value="{{ $datas->id_kelas }}" class="{{ $datas->id_tahun }}">{{ $datas->tingkat }} {{ $datas->jurusan->nama_jurusan }} {{ $datas->kelas }}</option>
                        @endforeach
                    </select>
                </div>
              
                <button type="submit" class="btn btn-primary">Add</button>
            </form>
            </div>
        </div>
    </section>
</section>


@endsection