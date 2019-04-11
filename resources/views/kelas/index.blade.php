@extends('layouts.app')

@section('content')

 <section role="main" class="content-body">

        <nav aria-label="breadcrumb">
      <ol class="breadcrumb mt-3">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
        <li class="breadcrumb-item active" aria-current="page">Data Kelas</li>
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
                <h4>Data Kelas</h2>
        </div>
        <div class="card-body">
             
                <button class="btn btn-primary" data-toggle="modal" data-target="#createKelas">Tambah Data Kelas</button>
            <a href="{{ route('kelas.print') }}">
                <button class="btn btn-primary">Cetak Data Kelas</button>
            </a>

<div class="modal fade" id="createKelas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Kelas</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" action="{{ route('kelas.store') }}">
        @csrf
          <div class="modal-body">
            <div class="form-group">
                <label for="recipient-name" class="col-form-label">Kode Kelas:</label>
                <input type="text" class="form-control" name="kode_kelas" id="kode" maxlength="5">
            </div>
            <div class="form-group">
                <label for="recipient-name" class="col-form-label">Tingkat:</label>
                <input type="text" class="form-control" name="tingkat" maxlength="4" placeholder="Contoh : X/XI/XII/XIII" id="tingkat" required="" maxlength="4">
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
            <div class="form-group">
                <label for="recipient-name" class="control-label">Kelas <span class="required">*</span></label>
                <input type="text" class="form-control" name="kelas" maxlength="1" placeholder="Contoh : A/B/C/D">
            </div> 
            <div class="form-group">
                <label for="recipient-name" class="control-label">Tahun Ajaran <span class="required">*</span></label>
                <select data-plugin-selectTwo name="id_tahun" class="form-control" id="tahun">
                    <option value="">-- Pilih Tahun Ajaran --</option>
                        @foreach ($tahun as $tahuns)
                            <option value="{{ $tahuns->id_tahun }}" class="{{ $tahuns->id_tahun }}" id="tahun">{{ $tahuns->tahun }}  
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


<div class="modal fade" id="editKelas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ubah Kelas</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" action="{{ route('kelas.update') }}">
        @csrf
          <div class="modal-body">
              <div class="">
                <input type="hidden" class="form-control" name="id_kelas" id="id">
              </div>
              <div class="form-group">
                <label for="recipient-name" class="col-form-label">Kode Kelas:</label>
                <input type="text" class="form-control" name="kode_kelas" id="kode" readonly="">
              </div>
              <div class="form-group">
                <label for="recipient-name" class="col-form-label">Tingkat:</label>
                <input type="text" class="form-control" name="tingkat" id="tingkat">
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
              
              <div class="form-group">
                <label for="recipient-name" class="col-form-label">Kelas:</label>
                <input type="text" class="form-control" name="kelas" id="kelas">
              </div>
              <div class="form-group">
                <label for="recipient-name" class="control-label">Tahun Ajaran <span class="required">*</span></label>
                <select data-plugin-selectTwo name="id_tahun" class="form-control">
                        <option value="">-- Pilih Tahun Ajaran --</option>
                    @foreach ($tahun as $tahuns)
                        <option value="{{ $tahuns->id_tahun }}" class="{{ $tahuns->id_tahun }}" id="tahun">{{ $tahuns->tahun }} </option>
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
                        <th style="text-align: center;">Kode Kelas</th>
                        <th style="text-align: center;">Kelas</th>
                        <th style="text-align: center;">Tahun Ajaran</th>
                        <th style="text-align: center;" width="200px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                   @foreach( $kelas as $key => $data )
                    <tr>
                        <td style="text-align: center;">{{ $key+1 }}</td>
                        <td>{{ $data->kode_kelas }}</td>
                        <td>{{ $data->tingkat }}
                            {{ $data->jurusan->nama_jurusan }}
                            {{ $data->kelas }}</td>
                        <td>{{ $data->tahun->tahun }}</td>
                        <td style="text-align: center;">
                                <button class="btn btn-primary" data-toggle="modal" data-target="#editKelas" data-id="{{ $data->id_kelas }}" data-kode="{{ $data->kode_kelas }}" data-tingkat="{{ $data->tingkat }}" data-jurusan="{{ $data->jurusan->nama_jurusan }}" data-kelas="{{ $data->kelas }}" data-tahun="{{ $data->tahun }}">Edit</button>
                            <a href="{{ route('kelas.destroy', $data->id_kelas) }}">
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