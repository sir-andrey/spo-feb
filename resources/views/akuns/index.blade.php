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
        <div class="card-header">
            
                <h4>Manajemen Akun</h2>
        </div>
        <div class="card-body">
            <a href="{{ route('akun.create') }}"><button class="btn btn-primary col-md-">Tambah</button></a>
            <a href="{{ route('akun.print') }}"><button class="btn btn-primary col-md-1">Cetak</button></a>
            <br>
            <br>
            <table class="table table-bordered table-striped table-hover table-responsive" id="data-id">
                <thead>
                    <tr>
                        <th style="text-align: center;">Nama</th>
                        <th style="text-align: center;">Username</th>
                        <th style="text-align: center;">Email</th>
                        <th style="text-align: center;">Status</th>
                        <th style="text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach( $akun as $data )
                    <tr>
                        <td>{{ $data->name }}</td>
                        <td>{{ $data->username }}</td>
                        <td>{{ $data->email }}</td>
                        <td>{{ $data->level->nama_level }}</td>
                        <td>
                            <a href="{{ route('akun.edit', $data->id) }}">
                                <button class="btn btn-primary col-sm-8" >Edit
                                </button></a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
</section>

@endsection