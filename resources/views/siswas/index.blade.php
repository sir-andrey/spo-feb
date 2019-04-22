@extends('layouts.app')

@section('content')
<section role="main" class="content-body">

   <nav aria-label="breadcrumb">
      <ol class="breadcrumb mt-3">
         <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
         <li class="breadcrumb-item active" aria-current="page">Data Siswa</li>
      </ol>
   </nav>

   <section class="card mt-3">
      <section class="panel">
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
         <h5>Data Siswa</h5>
      </div>

      <div class="card-body">
         <button class="btn btn-primary" data-toggle="modal" data-target="#createSiswa"><i class="fa fa-plus"></i></button>
         <a href="{{ route('siswa.print') }}"><button class="btn btn-primary"><i class="fa fa-print"></i></button></a>                     
         <br>
         <br>
         <table class="table table-bordered table-striped table-hover" width="100%" id="data-id">
            <thead>
               <tr> 
                  <th>No.</th>
                  <th>NISN</th>
                  <th>Nama</th>
                  <th>Jenis Kelamin</th>
                  <th>TTL</th>
                  <th>Agama</th>
                  <th>No Telp</th>
                  <th>Kelas</th>
                  <th>Tahun Ajaran</th>
                  <th></th>
               </tr>
            </thead>
            <tbody>
               @foreach( $siswas as $key => $siswa )
               <tr>
                  <td>{{ $key+1 }}</td>
                  <td>{{ $siswa->nisn }}</td>
                  <td>{{ $siswa->nama_siswa }}</td>
                  <td>{{ substr($siswa->jk,0,1) }}</td>
                  <td>{{ $siswa->tempat_lahir }}, 
                      {{ $siswa->tanggal_lahir }}</td>
                  <td>{{ $siswa->agama }}</td>
                  <td>{{ $siswa->no_telp }}</td>    
                  <td>{{ $siswa->kelas->tingkat }} - {{ $siswa->kelas->jurusan->nama_jurusan }} - {{ $siswa->kelas->kelas }}
                  <td>{{ $siswa->kelas->tahun->tahun }}</td>
                  <td style="text-align: center;">
                     <button class="btn btn-primary col-sm-5" data-toggle="modal" data-target="#editSiswa" data-id="{{ $siswa->id_siswa }}" data-kode="{{ $siswa->kode_siswa }}" data-nisn="{{ $siswa->nisn }}" data-nama="{{ $siswa->nama_siswa }}" data-tempat="{{ $siswa->tempat_lahir }}" data-agama="{{ $siswa->agama }}" data-jk="{{ $siswa->jk }}" data-tanggal="{{ $siswa->tanggal }}" data-alamat="{{ $siswa->alamat }}" data-no="{{ $siswa->no_telp }}"><i class="fa fa-pencil-alt"></i></button>
                     <a href="{{ route('siswa.destroy', $siswa->id_siswa) }}">
                        <button class="btn btn-danger col-sm-5" onclick="return confirm('Hapus data ini?')">
                           <i class="fa fa-trash-alt"></i>
                        </button>
                     </a></td>
               </tr>
               @endforeach
            </tbody>
         </table>
      </div>
   </section>
</section>

<!-- Modal -->
<div class="modal fade" id="createSiswa" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Tambah Siswa</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form method="post" action="{{ route('siswa.store') }}">
            @csrf
               <div class="form-group">
                  <label class="control-label">Kode Siswa<span class="required">*</span></label>
                  <div class="">
                     <input type="text" class="form-control" name="kode_siswa" value="{{ $id_siswa }}" maxlength="5" readonly>
                  </div>
               </div>
               <div class="form-group">
                  <label class="control-label">NISN <span class="required">*</span></label>
                  <div class="">
                     <input type="text" onkeypress="return hanyaAngka(event)" maxlength="10" name="nisn" class="form-control" />
                  </div>
               </div> 
               <div class="form-group">
                  <label class="control-label">Nama <span class="required">*</span></label>
                  <div class="">
                      <input type="text" class="form-control" name="nama_siswa" maxlength="50" onkeypress="return hanyaHuruf(event)" >
                  </div>
               </div>
                <div class="form-group">
                  <label for="recipient-name" class="control-label">Jenis Kelamin <span >*</span></label><br>
                  <input type="radio" name="jk" value="Laki Laki">Laki Laki<br>
                  <input type="radio" name="jk" value="Perempuan"> Perempuan<br>
               </div>  
                <div class="form-group">
                  <label class="control-label">Tempat Lahir <span class="required">*</span></label>
                  <div class="">
                      <input type="text" class="form-control" name="tempat_lahir" maxlength="30" onkeypress="return hanyaHuruf(event)" placeholder="Cth : Bandung" >
                  </div>
               </div> 
               <div class="form-group">
                  <label class="control-label">Tanggal Lahir <span class="required">*</span></label>
                  <div class="">
                      <input type="date" class="form-control" name="tanggal_lahir">
                  </div>
               </div> 
                <div class="form-group">
                  <label for="recipient-name" class="control-label">Agama <span >*</span></label>
                  <select data-plugin-selectTwo name="agama" class="form-control" id="agama">
                     <option value="">-- Pilih Agama --</option>
                     <option value="Buddha">Buddha</option>
                     <option value="Hindu">Hindu</option>
                     <option value="Islam">Islam</option>
                     <option value="Katolik">Katolik</option>
                     <option value="Kong Hu Cu">Kong Hu Cu</option>
                     <option value="Protestan">Protestan</option>
                  </select>
               </div>  
               <div class="form-group">
                  <label class="control-label">Alamat<span class="required">*</span></label>
                  <div class="">
                      <input type="text" class="form-control" name="alamat">
                  </div>
               </div> 
               <div class="form-group">
                  <label class="control-label">No Telp<span class="required">*</span></label>
                  <div class="">
                     <input id="cc" name="no_telp" type="text" placeholder="085603754023" class="form-control" />    
                  </div>
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
               <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        <button type="submit" class="btn btn-primary">Tambah</button>
      </div>
         </form>
      </div>
      
    </div>
  </div>
</div>



<!-- Modal View -->
<div class="modal fade" id="editSiswa" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"> Edit Siswa </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form method="post" action="{{ route('siswa.update') }}">
            @csrf
            <div class="modal-body">
               <div class="form-group">
                  <label class="control-label">Kode Siswa<span class="required">*</span></label>
                  <div class="">
                     <input type="hidden" class="form-control" name="id" maxlength="5" id="id">
                     <input type="text" class="form-control" name="kode_siswa" maxlength="5" id="kode" readonly>
                  </div>
               </div>
               <div class="form-group">
                  <label class="control-label">NISN <span class="required">*</span></label>
                  <div class="">
                     <input type="text" onkeypress="return hanyaAngka(event)" maxlength="10" name="nisn" class="form-control" id="nisn" />
                  </div>
               </div> 
               <div class="form-group">
                  <label class="control-label">Nama <span class="required">*</span></label>
                  <div class="">
                     <input type="text" class="form-control" name="nama_siswa" maxlength="50" onkeypress="return hanyaHuruf(event)" id="nama" >
                  </div>
               </div> 
               <div class="form-group">
                  <label class="control-label">Jenis Kelamin <span class="required">*</span></label>
                  <div class="">
                     <input type="text" class="form-control" name="jk" maxlength="10" onkeypress="return hanyaHuruf(event)" id="jk" >
                  </div>
               </div> 
               <div class="form-group">
                  <label class="control-label">Tempat Lahir <span class="required">*</span></label>
                  <div class="">
                     <input type="text" class="form-control" name="tempat_lahir" maxlength="50" onkeypress="return hanyaHuruf(event)" id="tempat" placeholder="Cth : Bandung">
                  </div>
               </div> 
               <div class="form-group">
                  <label class="control-label">Tanggal Lahir <span class="required">*</span></label>
                  <div class="">
                     <input type="date" class="form-control" name="tanggal_lahir" onkeypress="return hanyaHuruf(event)" id="tanggal" >
                  </div>
               </div> 
               <div class="form-group">
                  <label class="control-label">Agama <span class="required">*</span></label>
                  <div class="">
                     <input type="text" class="form-control" name="agama" onkeypress="return hanyaHuruf(event)" id="agama" >
                  </div>
               </div> 
               <div class="form-group">
                  <label class="control-label">Alamat <span class="required">*</span></label>
                  <div class="">
                     <input type="textarea" class="form-control" name="alamat" onkeypress="return hanyaHuruf(event)" id="alamat" >
                  </div>
               </div> 
               <div class="form-group">
                  <label class="control-label">No Telp<span class="required">*</span></label>
                  <div class="">
                     <input id="cc no_telp" name="no_telp" type="text" placeholder="085603754023" class="form-control" />    
                  </div>
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
            <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
               <button type="submit" class="btn btn-primary">Ubah</button>
            </div>
         </form>
      </div>
   </div>
</div>

@endsection
