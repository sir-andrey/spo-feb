@extends('layouts.app')

@section('content')
<section role="main" class="content-body">
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
            <h4>Data Nilai</h2>
        </div>
        <div class="card-body">
           <div class="col-md-6">
                
           </div>
        </div>
    </section>
</section>



@endsection
