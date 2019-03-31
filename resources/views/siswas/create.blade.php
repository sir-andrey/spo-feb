@extends('layouts.app')

@section('content')

 
 <section role="main" class="content-body">

     <nav aria-label="breadcrumb">
      <ol class="breadcrumb mt-3">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
        <li class="breadcrumb-item"><a href="{{ route('siswa.index') }}">Data Siswa</a></li>
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
                        <h4>Tambah Siswas</h4>
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

            <form method="post" action="{{ route('siswa.store') }}">
                    @csrf
                    <div class="col-md-6">
        
                        <div class="form-group">
                            <label class="col-md-3 control-label">Kode Siswa<span class="required">*</span></label>
                            <div class="col-md-7">
                                <input type="text" class="form-control" name="kode_siswa" maxlength="5">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">NISN <span class="required">*</span></label>
                            <div class="col-md-7">
                                <input type="text" class="form-control" name="nisn" maxlength="10">
                            </div>
                        </div> 
                        <div class="form-group">
                            <label class="col-md-3 control-label">Nama <span class="required">*</span></label>
                            <div class="col-md-7">
                                <input type="text" class="form-control" name="nama_siswa" maxlength="50" >
                            </div>
                        </div> 
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="name">Tahun Ajaran</label>
                            <div class="col-md-7">
                                <select name="id_tahun" id="tahun" class="form-control">
                                    <option value="">-- Pilih Tahun --</option>
                                    @foreach ($tahun as $data)
                                    <option value="{{ $data->id_tahun }}">{{ $data->tahun }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="name">Kelas</label>
                            <div class="col-md-7">
                                <select name="id_kelas" id="kelas" class="form-control">
                                    <option value="">-- Pilih Tahun terlebih dahulu --</option>
                                    @foreach ($kelas as $datas)
                                    <option value="{{ $datas->id_kelas }}" class="{{ $datas->id_tahun }}">{{ $datas->tingkat }} {{ $datas->jurusan->nama_jurusan }} {{ $datas->kelas }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>    
                   
                        <div class="form-group" style="margin-left: 220px;">
                            <button type="submit" class="btn btn-primary">Tambah</button>
                        </div>   
                    </div>
                </form>
            </div>
        </div>
    </section>
</section>


@endsection