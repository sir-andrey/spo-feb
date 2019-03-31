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
                <h4>Edit Level</h4>
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

            <form method="post" action="{{ route('level.update') }}">
                @csrf
                    <div class="col-md-6">
        
                        <input type="hidden" name="id_level" value="{{ $level->id_level }}">
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
                        <div class="form-group">
                            <label class="col-md-3 control-label">Nama Level <span class="required">*</span></label>
                            <div class="col-md-7">
                                <input type="text" class="form-control" name="nama_level" value="{{ $level->nama_level }}"/>
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