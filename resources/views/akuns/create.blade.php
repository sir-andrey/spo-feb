@extends('layouts.app')

@section('content')

 <section role="main" class="content-body">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb mt-3">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
        <li class="breadcrumb-item"><a href="{{ route('akun.index') }}">Manajemen Akun</a></li>
        <li class="breadcrumb-item active" aria-current="page">Tambah</li>
      </ol>
    </nav>

    <section class="card mt-3">
        <div class="card-header">
                <h4>Tambah Akun</h2>
        </div>
        <div class="card-body">
            <div class="col-md-12">
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
    </section>
</section>

@endsection