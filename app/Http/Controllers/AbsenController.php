<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Absen;
use App\Nilai;
use App\Kelas;
use App\Jurusan;
use App\Tahun;
use App\Mapel;
use App\Siswa;
use App\Jadwal;
use App\Walikelas;
use Auth;
use Response;
use PDF;

class AbsenController extends Controller
{
    public function index()
    {
        
        $bulanIndo = array(
          '01' => 'Januari',
          '02' => 'Februari',
          '03' => 'Maret',
          '04' => 'April',
          '05' => 'Mei',
          '06' => 'Juni',
          '07' => 'Juli',
          '08' => 'Agustus',
          '09' => 'September',
          '10' => 'Oktober',
          '11' => 'November',
          '12' => 'Desember',
        );

        $bulan = $bulanIndo[date('m')];

        $id_user = Auth::user()->id;

        $kelas = Walikelas::select('id_kelas')->where('id_user', $id_user)->first();

        $id_kelas = $kelas['id_kelas'];

        $dataabsen = Absen::select('id_siswa')->where('id_kelas', $id_kelas)->distinct()->get();
        
        $absens = Nilai::all();
        $siswas = Siswa::all();
        $kelas = Kelas::all();
        $jurusan = Jurusan::all();
        $mapels = Mapel::all();
        $tahuns = Tahun::all();

        return view('absens/index', compact('dataabsen','absens', 'bulan','siswas', 'kelas','jurusan', 'mapels', 'tahuns'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    { 
        $bulanIndo = array(
          '01' => 'Januari',
          '02' => 'Februari',
          '03' => 'Maret',
          '04' => 'April',
          '05' => 'Mei',
          '06' => 'Juni',
          '07' => 'Juli',
          '08' => 'Agustus',
          '09' => 'September',
          '10' => 'Oktober',
          '11' => 'November',
          '12' => 'Desember',
        );

        $bulan = $bulanIndo[date('m')];

        $id_user = Auth::user()->id;

        $kelas = Walikelas::select('id_kelas')->where('id_user', $id_user)->first();

        $id_kelas = $kelas['id_kelas'];

        $dataabsen = Absen::where('bulan', $bulan)->where('id_kelas', $id_kelas)->get();

        $absens = Nilai::all();
        $siswas = Siswa::all();
        $kelas = Kelas::all();
        $jurusan = Jurusan::all();
        $mapels = Mapel::all();
        $tahuns = Tahun::all();

        return view('absens/create', compact('dataabsen','absens', 'bulan','siswas', 'kelas','jurusan', 'mapels', 'tahuns'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
    {
        $absen = new Absen;
        $absen->sakit = $req->id_absen;
        $absen->nisn = $req->nisn;
        $absen->nama = $req->nama;
        $absen->id_kelas = $req->id_kelas;
        $absen->save();
        session()->flash('success-create', 'Data Absen berhasil disimpan');
        return redirect('/absen/index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id_absen)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id_absen)
    {
        $absen = Nilai::find($id_absen);
        $kelas = Kelas::all();
        return view('absens/edit', compact('absen','kelas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req)
    {
        $absen = Absen::find($req->id_absen);
        $absen->sakit = $req->sakit;
        $absen->izin = $req->izin;
        $absen->alpa = $req->alpa;
        $absen->save();

        session()->flash('success-create', 'Data Absen berhasil disimpan');
        return redirect('/absen/create');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_absen)
    {
        
        $absen = Nilai::find($id_absen);
        $absen->delete();

        return redirect()->back();
    }

    public function print()
    {
        $absen = Nilai::all();

        $pdf = PDF::loadview('absens/cetak', compact('absen'), ['absen' => $absen]);

        return $pdf->stream('Cetak absen.pdf');
    }

    public function detail($id_siswa)
    {
        $absen = Nilai::where('id_siswa', $id_siswa);

        return view('absens/detail');
    }
}
