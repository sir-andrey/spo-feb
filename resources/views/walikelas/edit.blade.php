@extends('layouts.app')

@section('content')

 <section role="main" class="content-body">

         <nav aria-label="breadcrumb">
      <ol class="breadcrumb mt-3">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
        <li class="breadcrumb-item"><a href="{{ route('tahun.index') }}">Data Siswa</a></li>
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
                <h4>Edit Tahun Ajaran</h4>
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

            <form method="post" action="{{ route('tahun.update') }}">
                @csrf
                    <div class="col-md-6">
        
                        <div class="form-group">
                  <label for="recipient-name" class="col-form-label">Guru:</label>
                  <select class="js-example-basic-single col-md-12" name="id_guru" data-show-subtext="true">
                     <option value="">-- Cari -- </option>
                     <optgroup label="Guru">
                        @foreach( $jadwal as $dataguru )
                        <option value="{{ $dataguru->id_guru }}">{{ $dataguru->guru->nama_guru }} ({{ $dataguru->mapel->nama_mapel }})</option>
                        @endforeach
                     </optgroup> 
                  </select>
               </div>
               <div class="form-group">
                  <label class="control-label">Tahun Ajaran <span class="required">*</span></label>
                  <div class="">
                     <select name="id_tahun" id="tahun" class="form-control">
                        <option value="">-- Pilih Tahun --</option>
                        @foreach ($tahun as $data)
                           <option value="{{ $data->id_tahun }}">{{ $data->tahun }}</option>
                        @endforeach
                     </select>
                  </div>
               </div>
               <div class="form-group">
                  <label class="control-label">Kelas <span class="required">*</span></label>
                  <div class="">
                     <select name="id_kelas" id="kelas" class="form-control">
                        <option value="">-- Pilih Tahun terlebih dahulu --</option>
                        @foreach ($kelas as $datas)
                           <option value="{{ $datas->id_kelas }}" class="{{ $datas->id_tahun }}">{{ $datas->tingkat }} {{ $datas->jurusan->nama_jurusan }} {{ $datas->kelas }}</option>
                        @endforeach
                        </select>
                  </div>
               </div>
                    </div>
             </form>

            </div>
        </div>
    </section>
</section>


@endsection