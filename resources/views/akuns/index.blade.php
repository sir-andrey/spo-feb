@extends('layouts.app')

@section('content')

 <section role="main" class="content-body">

        <nav aria-label="breadcrumb">
      <ol class="breadcrumb mt-3">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
        <li class="breadcrumb-item active" aria-current="page">Manajemen Akun</li>
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
                <h4>Data Level</h2>
        </div>
        <div class="card-body">
             
                <button class="btn btn-primary" data-toggle="modal" data-target="#createAkun">Tambah</button>
            <a href="{{ route('akun.print') }}">
                <button class="btn btn-primary">Cetak</button>
            </a>

<div class="modal fade" id="createAkun" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Akun</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
       <form action="{{ route('akun.store') }}" method="POST">
                    @csrf 
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Nama <span class="required">*</span></label>
                            <div class="col-sm-9 tambahElemen">
                                <select class="js-example-basic-single col-md-12" name="id" data-show-subtext="true">
                                   <option value="">-- Cari --</option>
                                   @if( $hitungjadwal > 0 )
                                   <optgroup label="Guru">
                                    @foreach( $jadwal as $dataguru )
                                    <option value="{{ $dataguru->id_guru }}">{{ $dataguru->guru->nama_guru }} ({{ $dataguru->mapel->nama_mapel }})</option>
                                    @endforeach
                                   </optgroup> 
                                   @endif
                                   
                                   @if( $hitungsiswa > 0 )
                                   <optgroup label="Siswa">
                                    @foreach( $siswa as $datasiswa )
                                    <option value="{{ $datasiswa->id_siswa }}">{{ $datasiswa->nama_siswa }} </option>
                                    @endforeach
                                   </optgroup> 
                                   @endif

                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Username <span class="required">*</span></label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="username">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Email <span class="required">*</span></label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="email">
                            </div>
                        </div>    
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-md-3 control-label">Password<span class="required">*</span></label>
                            <div class="col-md-9">
                                <input type="password" class="form-control" name="password">
                            </div>
                        </div>  
                        <div class="form-group">
                            <label class="col-md-3 control-label">Ketik Ulang Password <span class="required">*</span></label>
                            <div class="col-md-9">
                                <input type="password" class="form-control" name="password-confirmation">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Level<span class="required">*</span></label>
                            <div class="col-md-9">
                                <select name="id_level">
                                    @foreach ($level as $data)
                                    <option value="{{ $data->id_level }}">{{ $data->nama_level }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            &nbsp;<button type="submit" class="btn btn-primary">Tambah</button>
                        </div>  
                    </div>
                </form>
    </div>
  </div>
</div>8


<div class="modal fade" id="editAkun" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ubah Akun</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" action="{{ route('akun.update') }}">
                @csrf
                    <div class="col-md-6">
        
                        <input type="hidden" name="id">

                         <div class="form-group">
                            @if(Auth::user()->id_level == 1 || id_level == 2 || id_level == 4)

                            <label class="col-md-3 control-label">NIP<span class="required">*</span></label>
                            @endif
                            @if(Auth::user()->id_level == 4)
                            <label class="col-md-3 control-label">NIP<span class="required">*</span></label>
                            @endif
                            <div class="col-md-7">
                                <input type="text" class="form-control" name="nip" readonly="" />
                            </div>
                        </div>
                        @endif
                        
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Nama <span class="required">*</span></label>
                            <div class="col-sm-9 tambahElemen">
                                <select class="js-example-basic-single col-md-12" name="id" data-show-subtext="true">
                                   <option value="">-- Cari --</option>
                                   @if( $hitungjadwal > 0 )
                                   <optgroup label="Guru">
                                    @foreach( $jadwal as $dataguru )
                                    <option value="{{ $dataguru->id_guru }}">{{ $dataguru->guru->nama_guru }} ({{ $dataguru->mapel->nama_mapel }})</option>
                                    @endforeach
                                   </optgroup> 
                                   @endif
                                   
                                   @if( $hitungsiswa > 0 )
                                   <optgroup label="Siswa">
                                    @foreach( $siswa as $datasiswa )
                                    <option value="{{ $datasiswa->id_siswa }}">{{ $datasiswa->nama_siswa }} </option>
                                    @endforeach
                                   </optgroup> 
                                   @endif

                                </select>
                            </div>
                        </div>
                         <div class="form-group">
                            <label class="col-md-3 control-label">Username<span class="required">*</span></label>
                            <div class="col-md-7">
                                <input type="text" class="form-control" name="username"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Email <span class="required">*</span></label>
                            <div class="col-md-7">
                                <input type="text" class="form-control" name="email"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Password <span class="required">*</span></label>
                            <div class="col-md-7">
                                <input type="text" class="form-control" name="password"/>
                            </div>
                        </div
                        div class="form-group">
                                        <label class="col-md-3 control-label">Level<span class="required">*</span></label>
                                        <div class="col-md-7">
                                            <select data-plugin-selectTwo name="id_level"  id="level" required="true">
                                                <option value="">-- Pilih Level --</option>
                                            @foreach ($level as $levels)
                                                <option value="{{ $levels->id_level }}" class="{{ $levels->id_level }}" id="level">{{ $levels->nama_level }} </option>
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
</div>


            <br>
            <br>
            <table class="table table-bordered table-striped table-hover" id="data-id" width="100%">
                <thead>
                    <tr>
                        <th style="text-align: center;">NO.</th>
                        <th style="text-align: center;">Nama</th>
                        <th style="text-align: center;">Level</th>
                        <th style="text-align: center;" width="200px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                   @foreach( $akuns as $key => $akun )
                    <tr>
                        <td style="text-align: center;">{{ $key+1 }}</td>
                        <td>{{ $akun->name }}</td>
                        <td>{{ $akun->level->nama_level }}</td>
                        <td style="text-align: center;">
                                <button class="btn btn-primary" data-toggle="modal" data-target="#editAkun" data-id="{{ $akun->id }}" data-nama="{{ $akun->name }}" data-level="{{ $akun->level->nama_level }}">Edit</button>
                            <a href="{{ route('akun.destroy', $level->id_level) }}">
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