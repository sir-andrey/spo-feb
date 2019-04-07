@extends('layouts.app')

@section('content')

 <section role="main" class="content-body">

      <nav aria-label="breadcrumb">
      <ol class="breadcrumb mt-3">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
        <li class="breadcrumb-item"><a href="{{ route('tahun.index') }}">Data Walikelas</a></li>
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
            <h4>Tambah Walikelas</h4>
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

            <form method="post" action="{{ route('tahun.store') }}">
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
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Kode Tahun<span class="required">*</span></label>
                            <div class="col-md-7">
                                <input type="text" class="form-control" name="kode_tahun" maxlength="5">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Tahun Ajaran <span class="required">*</span></label>
                            <div class="col-md-7">
                                <input type="text" placeholder="Contoh : 2018-2019" class="form-control" name="tahun">
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