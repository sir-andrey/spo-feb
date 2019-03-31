@extends('layouts.app')

@section('content')

 <section role="main" class="content-body">

    <nav aria-label="breadcrumb">
      <ol class="breadcrumb mt-3">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
        <li class="breadcrumb-item"><a href="{{ route('akun.index') }}">Manajemen Akun</a></li>
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
                <h4>Edit Akun</h4>
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

            <form method="post" action="{{ route('akun.update') }}">
                @csrf
                    <div class="col-md-6">
        
                        <input type="hidden" name="id" value="{{ $akun->id }}">
                        <<div class="form-group">
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
                                <input type="text" class="form-control" name="username" value="{{ $akun->username }}"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Email <span class="required">*</span></label>
                            <div class="col-md-7">
                                <input type="text" class="form-control" name="email" value="{{ $akun->email }}"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Password <span class="required">*</span></label>
                            <div class="col-md-7">
                                <input type="text" class="form-control" name="password" value="{{ $akun->password }}"/>
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
    </section>
</section>


@endsection