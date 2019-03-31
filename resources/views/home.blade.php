@extends('layouts.app')

@section('content')

 <section role="main" class="content-body">
 
    <section class="card mt-3">
        <div class="card-header">
                <h4>Beranda</h2>
        </div>
        <div class="card-body">  
            <div class="card-body" align="center">Selamat Datang, {{ Auth::user()->name }}</div>
        </div>
    </section>
</section>

@endsection
