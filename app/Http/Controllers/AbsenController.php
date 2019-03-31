<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Nilai;
use App\Kelas;
use App\Jurusan;
use App\Tahun;
use App\Mapel;
use App\Siswa;
use App\Jadwal;
use Auth;
use Response;
use PDF;

class AbsenController extends Controller
{
    public function index()
    {
        
        $absens = Nilai::all();
        $siswas = Siswa::all();
        $kelas = Kelas::all();
        $jurusan = Jurusan::all();
        $mapels = Mapel::all();
        $tahuns = Tahun::all();

        return view('absens/index', compact('absens', 'siswas', 'kelas','jurusan', 'mapels', 'tahuns'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    { 
        $id_jadwal = Auth::user()->id_jadwal;

        $mapel = Jadwal::select('id_mapel')->where('id_jadwal', $id_jadwal)->first();

        $id_mapel = $mapel['id_mapel'];

        $dataabsen = Nilai::where('id_mapel', $id_mapel)->where('semester', 'Genap')->get();
        $absens = Nilai::all();
        $siswas = Siswa::all();
        $kelas = Kelas::all();
        $jurusan = Jurusan::all();
        $mapels = Mapel::all();
        $tahuns = Tahun::all();

        return view('absens/create', compact('dataabsen','absens', 'siswas', 'kelas','jurusan', 'mapels', 'tahuns'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
    {
        $absen = new Nilai;
        $absen->id_absen = $req->id_absen;
        $absen->nisn = $req->nisn;
        $absen->nama = $req->nama;
        $absen->id_kelas = $req->id_kelas;
        $absen->save();
        session()->flash('success-create', 'Data Nilai berhasil disimpan');
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
        $absen = Nilai::find($req->id_absen);
        $absen->id = $req->id_absen;
        $absen->n1 = $req->n1;
        $absen->n2 = $req->n2;
        $absen->n3 = $req->n3;
        $absen->pts = $req->pts;
        $absen->pas = $req->pas;
        $absen->save();

        session()->flash('success-create', 'Data Nilai berhasil disimpan');
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
