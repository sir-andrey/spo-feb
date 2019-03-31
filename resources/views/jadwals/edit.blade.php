@extends('layouts.app')

@section('content')

<section role="main" class="content-body">
    
     <nav aria-label="breadcrumb">
      <ol class="breadcrumb mt-3">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
        <li class="breadcrumb-item"><a href="{{ route('jadwal.index') }}">Data Jadwal</a></li>
        <li class="breadcrumb-item active" aria-current="page">Ubah</li>
      </ol>
    </nav>

                    <header class="page-header">
                        <h2>Data Jadwal</h2>
                    
                        <div class="right-wrapper pull-right">
                            <ol class="breadcrumbs">
                                <li>
                                    <a href="{{ route('home') }}">
                                        <i class="fa fa-home"></i>
                                    </a>
                                </li>
                            </ol>
                    
                            <a class="sidebar-right-toggle" data-open="sidebar-right"></a>
                        </div>
                    </header>

                    <!-- start: page -->
                        <section class="panel">
                            <header class="panel-heading">
                        
                                <h2 class="panel-title">Edit Data Jadwal</h2>
                            </header>
                            <div class="panel-body">
                                @if ($errors->any())
                                <div class="alert alert-danger">
                                  <ul>
                                      @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                      @endforeach
                                  </ul>
                                </div><br />
                                @endif
                                <form method="post" action="{{ route('jadwal.update') }}">
                                    @csrf
                                    <input type="hidden" name="id_jadwal" value="{{ $siswa->id_jadwal }}">
                                    <div class="form-group">
                                        <label>Guru : </label><br>
                                        <select name="id_guru">
                                        @foreach ($jadwals as $jadwal)
                                            <option value="{{ $jadwal->id_guru }}">{{ $jadwal->guru->nama }}</option>
                                        @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Mata Pelajaran : </label><br>
                                        <select name="id_mapel">
                                        @foreach ($jadwals as $jadwal)
                                            <option value="{{ jadwal->id_mapel }}">{{ jadwal->mapel->nama }}  </option>
                                        @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Kelas : </label><br>
                                        <select name="id_kelas">
                                        @foreach ($jadwals as $jadwal)
                                            <option value="{{ $jadwal->id_kelas }}">{{ $jadwal->tingkat }} {{ $jadwal->jurusan}} {{ $jadwal->kelas }} </option>
                                        @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Tahun Ajaran : </label><br>
                                        <select name="id_kelas">
                                        @foreach ($jadwals as $jadwal)
                                            <option value="{{ $jadwal->id_kelas }}">{{ $jadwal->tahun }}</option>
                                        @endforeach
                                        </select>
                                    </div>
                                    
                                    <button type="submit" class="btn btn-primary">Edit</button>
                                </form>
                            </div>
                        </section>
@endsection
