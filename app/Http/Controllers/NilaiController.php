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

class NilaiController extends Controller
{
    public function index()
    {
        
        $nilais = Nilai::all();
        $siswas = Siswa::all();
        $kelas = Kelas::all();
        $jurusan = Jurusan::all();
        $mapels = Mapel::all();
        $tahuns = Tahun::all();

        return view('nilais/index', compact('nilais', 'siswas', 'kelas','jurusan', 'mapels', 'tahuns'));
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

        $datanilai = Nilai::where('id_mapel', $id_mapel)->get();
        $nilais = Nilai::all();
        $siswas = Siswa::all();
        $kelas = Kelas::all();
        $jurusan = Jurusan::all();
        $mapels = Mapel::all();
        $tahuns = Tahun::all();

        return view('nilais/create', compact('datanilai','nilais', 'siswas', 'kelas','jurusan', 'mapels', 'tahuns'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
    {
        $nilai = new Nilai;
        $nilai->id_nilai = $req->id_nilai;
        $nilai->nisn = $req->nisn;
        $nilai->nama = $req->nama;
        $nilai->id_kelas = $req->id_kelas;
        $nilai->save();
        session()->flash('success-create', 'Data Nilai berhasil disimpan');
        return redirect('/nilai/index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id_nilai)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id_nilai)
    {
        $nilai = Nilai::find($id_nilai);
        $kelas = Kelas::all();
        return view('nilais/edit', compact('nilai','kelas'));
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
        $nilai = Nilai::find($req->id_nilai);
        $nilai->id = $req->id_nilai;
        $nilai->n1 = $req->n1;
        $nilai->n2 = $req->n2;
        $nilai->n3 = $req->n3;
        $nilai->pts = $req->pts;
        $nilai->pas = $req->pas;
        $nilai->save();

        session()->flash('success-create', 'Data Nilai berhasil disimpan');
        return redirect('/nilai/create');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_nilai)
    {
        
        $nilai = Nilai::find($id_nilai);
        $nilai->delete();

        return redirect()->back();
    }

    public function print()
    {
        $nilai = Nilai::all();

        $pdf = PDF::loadview('nilais/cetak', compact('nilai'), ['nilai' => $nilai]);

        return $pdf->stream('Cetak nilai.pdf');
    }

    public function detail($id_siswa)
    {
        $nilai = Nilai::where('id_siswa', $id_siswa);

        return view('nilais/detail');
    }

}
