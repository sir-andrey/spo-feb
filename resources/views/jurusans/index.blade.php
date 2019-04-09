@extends('layouts.app')

@section('content')

 <section role="main" class="content-body">

        <nav aria-label="breadcrumb">
      <ol class="breadcrumb mt-3">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
        <li class="breadcrumb-item active" aria-current="page">Data Jurusan</li>
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
                <h4>Data Jurusan</h2>
        </div>
        <div class="card-body">
             
                <button class="btn btn-primary" data-toggle="modal" data-target="#createJurusan">Tambah Data Jurusan</button>
            <a href="{{ route('jurusan.print') }}">
                <button class="btn btn-primary">Cetak Data Jurusan</button>
            </a>

<div class="modal fade" id="createJurusan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Jurusan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" action="{{ route('jurusan.store') }}">
        @csrf
          <div class="modal-body">
              <div class="form-group">
                <label for="recipient-name" class="col-form-label">Kode Jurusan:</label>
                <input type="text" class="form-control" name="kode_jurusan" id="kode_jurusan">
              </div>
              <div class="form-group">
                <label for="recipient-name" class="col-form-label">Jurusan:</label>
                <input type="text" class="form-control" name="nama_jurusan" id="nama_jurusan" required="">
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


<div class="modal fade" id="editJurusan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ubah Jurusan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" action="{{ route('jurusan.update') }}">
        @csrf
          <div class="modal-body">
              <div class="">
                <input type="hidden" class="form-control" name="id_jurusan" id="id">
              </div>
              <div class="form-group">
                <label for="recipient-name" class="col-form-label">Kode Jurusan:</label>
                <input type="text" class="form-control" name="kode_jurusan" id="kode_jurusan" readonly="">
              </div>
              <div class="form-group">
                <label for="recipient-name" class="col-form-label">Jurusan:</label>
                <input type="text" class="form-control" name="nama_jurusan" id="nama_jurusan">
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
            <table class="table table-bordered table-striped table-hover table-responsive" id="data-id" width="100%">
                <thead>
                    <tr>
                        <th style="text-align: center;">NO.</th>
                        <th style="text-align: center;">Kode Jurusan</th>
                        <th style="text-align: center;">Jurusan</th>
                        <th style="text-align: center;" width="200px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                   @foreach( $jurusans as $key => $jurusan )
                    <tr>
                        <td style="text-align: center;">{{ $key+1 }}</td>
                        <td>{{ $jurusan->kode_jurusan }}</td>
                        <td>{{ $jurusan->nama_jurusan }}</td>
                        <td style="text-align: center;">
                                <button class="btn btn-primary" data-toggle="modal" data-target="#editJurusan" data-id="{{ $jurusan->id_jurusan }}" data-kode="{{ $jurusan->kode_jurusan }}" data-jurusan="{{ $jurusan->nama_jurusan }}">Edit</button>
                            <a href="{{ route('jurusan.destroy', $jurusan->id_jurusan) }}">
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