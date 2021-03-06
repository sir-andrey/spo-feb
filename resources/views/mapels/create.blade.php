@extends('layouts.app')

@section('content')

 <section role="main" class="content-body">

     <nav aria-label="breadcrumb">
      <ol class="breadcrumb mt-3">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
        <li class="breadcrumb-item"><a href="{{ route('mapel.index') }}">Data Mata Pelajaran</a></li>
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
                        <h4>Tambah Mata Pelajaran</h4>
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

            <form method="post" action="{{ route('mapel.store') }}">
                    @csrf
                    <div class="col-md-6">
        
                        <div class="form-group">
                            <label class="col-md-3 control-label">Kode Mapel<span class="required">*</span></label>
                            <div class="col-md-7">
                                <input type="text" class="form-control" name="kode_mapel" maxlength="5">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Nama Mapel <span class="required">*</span></label>
                            <div class="col-md-7">
                                <input type="text" class="form-control" name="nama_mapel" maxlength="30">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="control-label">Jurusan <span class="required">*</span></label>
                            <select data-plugin-selectTwo name="id_jurusan" class="form-control" id="jurusan">
                                <option value="">-- Pilih Jurusan --</option>
                                @foreach ($jurusan as $jurusans)
                                <option value="{{ $jurusans->id_jurusan }}" class="{{ $jurusans->id_jurusan }}" id="jurusan">{{ $jurusans->nama_jurusan }}  
                                </option>
                                @endforeach
                            </select>
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