@extends('layouts.app')

@section('content')

 <section role="main" class="content-body">

    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
        <li class="breadcrumb-item"><a href="{{ route('akun.index') }}">Manajemen Akun</a></li>
        <li class="breadcrumb-item active" aria-current="page">Ubah</li>
      </ol>
    </nav>

    <section class="card mt-3">
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
        </section>
        <div class="card-header">
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

            <form method="post" action="{{ route('akun.update-akun') }}">
                @csrf
                <div>
                    <input type="hidden" name="id" value="{{ $akun->id }}">
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control col-md-4" name="password" required>
                </div>
                <div class="form-group">
                    <label>Ketik Ulang Password</label>
                    <input type="password" class="form-control col-md-4" name="password1" required>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Ubah</button>
                </div>    
             </form>

            </div>
        </div>
    </section>
</section>


@endsection