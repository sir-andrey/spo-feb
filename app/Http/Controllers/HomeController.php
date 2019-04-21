<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Siswa;
use App\Guru;
use App\Kelas;
use App\Mapel;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $siswa = Siswa::all();
        $guru = Guru::all();
        $kelas = Kelas::all();
        $mapel = Mapel::all();

        $count_siswa = count($siswa);
        $count_guru = count($guru);
        $count_kelas = count($kelas);
        $count_mapel = count($mapel);

        return view('home', compact('siswa', 'guru', 'kelas', 'mapel', 'count_siswa', 'count_guru', 'count_mapel', 'count_kelas'));
    }
}
