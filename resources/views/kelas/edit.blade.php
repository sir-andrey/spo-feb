@extends('layouts.app')

@section('content')

 <section role="main" class="content-body">

     <nav aria-label="breadcrumb">
      <ol class="breadcrumb mt-3">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
        <li class="breadcrumb-item"><a href="{{ route('kelas.index') }}">Data Kelas</a></li>
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
                <h4>Edit Kelas</h4>
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

            <form method="post" action="{{ route('kelas.update') }}">
                            @csrf

                                    <input type="hidden" name="id_kelas" value="{{ $kelas->id_kelas }}">
                                     <div class="form-group">
                                        <label class="col-md-3 control-label">Kode Kelas<span class="required">*</span></label>
                                        <div class="col-md-7">
                                            <input type="text" class="form-control" name="kode_kelas" value="{{ $kelas->kode_kelas }}"  readonly="true" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Tingkat<span class="required">*</span></label>
                                        <div class="col-md-7">
                                            <input type="text" class="form-control" name="tingkat" value="{{ $kelas->tingkat }}"  maxlength="4" />
                                        </div>
                                    </div>
                                     <div class="form-group">
                                        <label class="col-md-3 control-label">Jurusan<span class="required">*</span></label>
                                        <div class="col-md-7">
                                            <select data-plugin-selectTwo name="id_jurusan"  id="jurusan" required="true">
                                                <option value="">-- Pilih Jurusan --</option>
                                            @foreach ($jurusan as $jurusans)
                                                <option value="{{ $jurusans->id_jurusan }}" class="{{ $jurusans->id_jurusan }}" id="jurusan">{{ $jurusans->nama_jurusan }} </option>
                                            @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Kelas<span class="required">*</span></label>
                                        <div class="col-md-7">
                                            <input type="text" class="form-control" name="kelas" value="{{ $kelas->kelas }}"  maxlength="1" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Tahun Ajaran<span class="required">*</span></label>
                                        <div class="col-md-7">
                                            <select data-plugin-selectTwo name="id_tahun"  id="tahun" required="true">
                                                <option value="">-- Pilih Tahun Ajaran --</option>
                                            @foreach ($tahun as $tahuns)
                                                <option value="{{ $tahuns->id_tahun }}" class="{{ $tahuns->id_tahun }}" id="tahun">{{ $tahuns->tahun }} </option>
                                            @endforeach
                                            </select>
                                        </div>
                                    </div>         
                                    <div class="form-group" style="margin-left: 230px;">
                                        <button type="submit" class="btn btn-primary">Edit</button>
                                    </div> 
                    </div>
             </form>

            </div>
        </div>
    </section>
</section>


@endsection