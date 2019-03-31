@extends('layouts.app')

@section('content')

<section role="main" class="content-body">
                    <header class="page-header">
                        <h2>Data Siswa</h2>
                    
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
                        
                                <h2 class="panel-title">Edit Data Siswa</h2>
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
