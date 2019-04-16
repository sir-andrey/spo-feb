@extends('layouts.app')

@section('content')

 <section role="main" class="content-body">

        <nav aria-label="breadcrumb">
      <ol class="breadcrumb mt-3">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
        <li class="breadcrumb-item active" aria-current="page">Data Mapel</li>
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

        <div class="card-header">
                <h4>Data Mata Pelajaran</h2>
        </div>
        <div class="card-body">
             
        <button class="btn btn-primary" data-toggle="modal" data-target="#createMapel">Tambah Data</button>
        <a href="{{ route('mapel.print') }}">
            <button class="btn btn-primary">Cetak Data</button>
        </a>

<div class="modal fade" id="createMapel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Mapel</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" action="{{ route('mapel.store') }}">
        @csrf
          <div class="modal-body">
            <div class="form-group">
                <label for="recipient-name" class="col-form-label">Kode Mapel<span class="required">*</span></label>
                <input type="text" class="form-control" name="kode_mapel" id="kode" maxlength="5">
            </div>
            <div class="form-group">
                <label for="recipient-name" class="col-form-labMata Pelajaran<span class="required">*</span></label>
                <input type="text" class="form-control" name="nama_mapel"id="nama" onkeypress="return hanyaHuruf(event)" >
            </div>
            <div class="form-group">
              <label for="recipient-name" class="col-form-label">Kategori</label>
              <select class="form-control" name="kategori"> 
                <option value="">-- Pilih Kategori --</option>
                <option value="Adaptif">Adaptif</option>
                <option value="Normatif">Normatif</option>
              </select>

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
           
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            <button type="submit" class="btn btn-primary">Tambah</button>
        </div>
      </form>
    </div>
  </div>
</div>


<div class="modal fade" id="editMapel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ubah Mapel</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" action="{{ route('mapel.update') }}">
        @csrf
          <div class="modal-body">
              <div class="">
                <input type="hidden" class="form-control" name="id_mapel" id="id">
              </div>
              <div class="form-group">
                <label for="recipient-name" class="col-form-label">Kode Mapel:</label>
                <input type="text" class="form-control" name="kode_mapel" id="kode" readonly="" maxlength="5" >
              </div>
              <div class="form-group">
                <label for="recipient-name" class="col-form-label">Mata Pelajaran:</label>
                <input type="text" class="form-control" name="nama_mapel" id="nama" onkeyprsess="return hanyaHuruf(event)" >
              </div>
             <div class="form-group">
                <label for="recipient-name" class="control-label">Jurusan <span class="required">*</span></label>
                <select data-plugin-selectTwo name="id_jurusan" class="form-control">
                    <option value="">-- Pilih Jurusan --</option>
                    @foreach ($jurusan as $jurusans)
                        <option value="{{ $jurusans->id_jurusan }}" class="{{ $jurusans->id_jurusan }}" id="jurusan">{{ $jurusans->nama_jurusan }} </option>
                    @endforeach
                    </select>
                </div>   
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            <button type="submit" class="btn btn-primary">Ubah</button>
          </div>
      </form>
    </div>
  </div>
</div>



            <br>
            <br>
            <table class="table table-bordered table-striped table-hover" id="data-id" width="100%">
                <thead>
                    <tr>
                        <th style="text-align: center;">NO.</th>
                        <th style="text-align: center;">Kode Mapel</th>
                        <th style="text-align: center;">Mata Pelajaran</th>
                        <th style="text-align: center;">Jurusan</th>
                        <th style="text-align: center;">Kategori</th>
                        <th style="text-align: center;" width="200px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                   @foreach( $mapel as $key => $data )
                    <tr>
                        <td style="text-align: center;">{{ $key+1 }}</td>
                        <td>{{ $data->kode_mapel }}</td>
                        <td>{{ $data->nama_mapel }}</td>
                        <td>{{ $data->jurusan->nama_jurusan }}</td>
                        <td>{{ $data->kategori }}</td>
                        <td style="text-align: center;">
                                <button class="btn btn-primary" data-toggle="modal" data-target="#editMapel" data-id="{{ $data->id_mapel }}" data-kode="{{ $data->kode_mapel }}" data-nama="{{ $data->nama_mapel }}" data-jurusan="{{ $data->jurusan->nama_jurusan }}" data-kategori="{{ $data->kategori}}">Edit</button>
                            <a href="{{ route('mapel.destroy', $data->id_mapel) }}">
                                <button class="btn btn-danger col-sm-4" onclick="return confirm('Hapus data ini?')">Hapus
                                </button></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
</section>

@endsection