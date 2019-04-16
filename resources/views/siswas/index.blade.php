@extends('layouts.app')

@section('content')
<section role="main" class="content-body">

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mt-3">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
            <li class="breadcrumb-item active" aria-current="page">Data Siswa</li>
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
                <h4>Data Siswa</h2>
        </div>
        <div class="card-body">
            <button class="btn btn-primary" data-toggle="modal" data-target="#createSiswa"><i class="fa fa-plus"></i> Tambah Data</button>
            <a href="{{ route('siswa.print') }}"><button class="btn btn-primary"><i class="fa fa-print"></i> Cetak Data</button></a>                     
            <br>
            <br>
            <table class="table table-bordered table-striped table-hover " id="data-id">
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
                            <td style="text-align: center;">
                            <a href="{{ route('siswa.edit', $siswa->id_siswa) }}">
                                <button class="btn btn-primary col-sm-3" >
                                    <i class="fa fa-pencil-alt"></i> Edit
                                </button>
                            </a>
                            <a href="{{ route('siswa.destroy', $siswa->id_siswa) }}">
                                <button class="btn btn-danger col-sm-3" onclick="return confirm('Hapus data ini?')">
                                    <i class="fa fa-trash-alt"></i> Hapus
                                </button>
                            </a>
                            <a href="{{ route('siswa.printRaport', $siswa->id_siswa) }}">
                                <button class="btn btn-success col-sm-3" ><i class="fa fa-print"></i> Cetak
                                </button>
                            </a></td>
                        </tr>
                        @endforeach
                </tbody>
            </table>
        </div>
    </section>
</section>

<!-- Modal View -->
<div class="modal fade" id="createSiswa" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Siswa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="{{ route('siswa.store') }}">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label class="control-label">Kode Siswa<span class="required">*</span></label>
                        <div class="">
                            <input type="text" class="form-control" name="kode_siswa" maxlength="5">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">NISN <span class="required">*</span></label>
                        <div class="">
                            <input type="text" onkeypress="return hanyaAngka(event)" maxlength="10" name="nisn" class="form-control" />
                        </div>
                    </div> 
                    <div class="form-group">
                        <label class="control-label">Nama <span class="required">*</span></label>
                        <div class="">
                            <input type="text" class="form-control" name="nama_siswa" maxlength="50" onkeypress="return hanyaHuruf(event)" >
                        </div>
                    </div> 
                    <div class="form-group">
                        < <label class="control-label">Tahun Ajaran <span class="required">*</span></label>
                        <div class="">
                            <select name="id_tahun" id="tahun" class="form-control">
                                <option value="">-- Pilih Tahun --</option>
                                @foreach ($tahun as $data)
                                <option value="{{ $data->id_tahun }}">{{ $data->tahun }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                         <label class="control-label">Kelas <span class="required">*</span></label>
                        <div class="">
                            <select name="id_kelas" id="kelas" class="form-control">
                                <option value="">-- Pilih Tahun terlebih dahulu --</option>
                                @foreach ($kelas as $datas)
                                <option value="{{ $datas->id_kelas }}" class="{{ $datas->id_tahun }}">{{ $datas->tingkat }} {{ $datas->jurusan->nama_jurusan }} {{ $datas->kelas }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>      
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
