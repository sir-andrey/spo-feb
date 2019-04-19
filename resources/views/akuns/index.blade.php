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
                <h4>Data Level</h2>
        </div>
        <div class="card-body">
            <button class="btn btn-primary" data-toggle="modal" data-target="#createAkun"><i class="fa fa-plus"></i></button>
            <a href="{{ route('akun.print') }}">
                <button class="btn btn-primary"><i class="fa fa-print"></i></button>
            </a>
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
                            <button class="btn btn-primary col-sm-4" data-toggle="modal" data-target="#editAkun" data-id="{{ $akun->id }}" data-nama="{{ $akun->name }}" data-username="{{ $akun->username }}" data-email="{{ $akun->email }}"><i class="fa fa-pencil-alt"></i></button>
                            <a href="{{ route('akun.destroy', $akun->id) }}">
                                <button class="btn btn-danger col-sm-4" onclick="return confirm('Hapus data ini?')"><i class="fa fa-trash-alt"></i></button>
                            </a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
</section>

<div class="modal fade" id="createAkun" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Akun</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('akun.store') }}" method="POST">
                    @csrf 
                    <div class="form-group">
                        <label class="control-label">Nama <span class="required">*</span></label>
                        <div class="tambahElemen">
                            <select class="js-example-basic-single col-md-12" name="id" data-show-subtext="true">
                                <option value="">-- Cari -- </option>
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
                        <label class="control-label">Username <span class="required">*</span></label>
                        <div class="">
                            <input type="text" class="form-control" name="username">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Email <span class="required">*</span></label>
                        <div class="">
                            <input type="text" class="form-control" name="email">
                        </div>
                    </div>    
                    <div class="form-group">
                        <label class="control-label">Password<span class="required">*</span></label>
                        <div class="">
                        <input type="password" class="form-control" name="password">
                        </div>
                    </div>  
                    <div class="form-group">
                        <label class="control-label">Ketik Ulang Password <span class="required">*</span></label>
                        <div class="">
                            <input type="password" class="form-control" name="password-confirmation">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Level<span class="required">*</span></label>
                        <div>
                            <select name="id_level" class="form-control">
                                @foreach ($level as $data)
                                <option value="{{ $data->id_level }}">{{ $data->nama_level }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        &nbsp;<button type="submit" class="btn btn-primary">Tambah</button>
                    </div>  
                </form>    
            </div>
        </div>
    </div>
</div>


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
                <div class="modal-body">
                    <input type="hidden" name="id" id="id">
                    
                    <div class="form-group">
                        <label class="control-label">Nama <span class="required">*</span></label>
                        <div>
                            <input type="text" class="form-control" name="name" id="nama" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Username<span class="required">*</span></label>
                        <div>
                            <input type="text" class="form-control" name="username" id="username" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Email <span class="required">*</span></label>
                        <div>
                            <input type="text" class="form-control" name="email" id="email" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Password <span class="required">*</span></label>
                        <div>
                            <input type="password" class="form-control" name="password"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Level<span class="required">*</span></label>
                        <div>
                            <select data-plugin-selectTwo name="id_level" class="form-control" id="level" required="true">
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


@endsection