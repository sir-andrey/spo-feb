@extends('layouts.app')

@section('content')
<section role="main" class="content-body">


     <nav aria-label="breadcrumb">
      <ol class="breadcrumb mt-3">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
        <li class="breadcrumb-item"><a href="{{ route('siswa.index') }}">Data Siswa</a></li>
        <li class="breadcrumb-item active" aria-current="page">Ubah</li>
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
                <h4>Edit Siswa</h4>
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
                                <form method="post" action="{{ route('siswa.update') }}">
                                    @csrf
                                    <input type="hidden" name="id_siswa" value="{{ $siswa->id_siswa }}">
                                    <div class="form-group">
                                        <label for="name">NISN :</label>
                                        <input type="text" class="form-control" name="nisn" value="{{ $siswa->nisn }}" />
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Nama:</label>
                                        <input type="text" class="form-control" name="nama" value="{{ $siswa->nama }}" />
                                    </div>
                                    <div class="form-group">
                                        <label>Kelas : </label><br>
                                        <select name="id_kelas">
                                        @foreach ($kelas as $siswa)
                                            <option value="{{ $siswa->id_kelas }}">{{ $siswa->tingkat }} {{ $siswa->jurusan}} {{ $siswa->kelas }} ({{ $siswa->tahun }}) </option>
                                        @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Tahun Ajaran : </label><br>
                                        <select name="id_kelas">
                                        @foreach ($kelas as $siswa)
                                            <option value="{{ $siswa->id_kelas }}">{{ $siswa->tahun }}</option>
                                        @endforeach
                                        </select>
                                    </div>
                                    
                                    <button type="submit" class="btn btn-primary">Edit</button>
                                </form>
                            </div>
                        </section>
@endsection
