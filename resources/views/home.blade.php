@extends('layouts.app')

@section('content')

	<nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Beranda</li>
        </ol>
    </nav>

    <div class="content mt-3">

        <div class="col-sm-6 col-lg-3">
            <div class="card text-white bg-flat-color-1">
                <div class="card-body pb-0">
                    <h1 class="mb-0">
                        <span class="count">{{ $count_siswa }}</span>
                    </h1>
                    <p class="text-light">Total Siswa</p>

                

                </div>

            </div>
        </div>
        <!--/.col-->

        <div class="col-sm-6 col-lg-3">
            <div class="card text-white bg-flat-color-2">
                <div class="card-body pb-0">
                    <h1 class="mb-0">
                        <span class="count">{{ $count_guru }}</span>
                    </h1>
                    <p class="text-light">Total Guru</p>

                

                </div>
            </div>
        </div>
        <!--/.col-->

        <div class="col-sm-6 col-lg-3">
            <div class="card text-white bg-flat-color-3">
                <div class="card-body pb-0">
                    <h1 class="mb-0">
                        <span class="count">{{ $count_kelas }}</span>
                    </h1>
                    <p class="text-light">Total Kelas</p>

                </div>

            
            </div>
        </div>
        <!--/.col-->

        <div class="col-sm-6 col-lg-3">
            <div class="card text-white bg-flat-color-4">
                <div class="card-body pb-0">
                    <h1 class="mb-0">
                        <span class="count">{{ $count_mapel }}</span>
                    </h1>
                    <p class="text-light">Total Mapel</p>

                

                </div>
            </div>
        </div>
        <!--/.col-->

@endsection
