<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Guru;
use App\Mapel;
use App\Jadwal;
use App\Kelas;
use App\Tahun;
use PDF;
use DB;

class JadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gurus = Guru::get();
        $mapels = Mapel::get();
        $kelas = Kelas::get();
        $tahuns = Tahun::get();
        $jadwals = Jadwal::all();

        return view('jadwals/index', compact('jadwals','mapels','kelas','gurus','tahuns'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $gurus = Guru::get();
        $mapels = Mapel::get();
        $kelas = Kelas::get();
        $tahuns = Tahun::get();
        

        return view('jadwals/create', compact('mapels','kelas','gurus','tahuns'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
    {
        $jadwal = new Jadwal;
        $jadwal->kode_jadwal = $req->kode_jadwal;

        $jadwal->id_guru = $req->id_guru;

        $jadwal->id_mapel = $req->id_mapel;

        $jadwal->id_kelas = $req->id_kelas;

        $cekguru = DB::table('jadwals')->where([['id_guru', $req->id_guru], ['id_mapel', $req->id_mapel], ['id_kelas', $req->id_kelas]])->get();

        $hitungmapel = count($cekguru);

        if ( $hitungmapel == 0 ) {
            session()->flash('success-create', 'Data berhasil disimpan');
            $jadwal->save();
            return redirect('/jadwal/index');
        } else {
            session()->flash('failed-create', 'Data tersebut sudah ada');
            return redirect()->back();
        }


        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id_jadwal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id_jadwal)
    {
        $jadwal = Jadwal::find($id_jadwal);
        $gurus = Guru::get();
        $mapels = Mapel::get();  
        $kelas = Kelas::get();
        $tahuns = Tahun::get();

        return view('jadwals/edit', compact('gurus','mapels','kelas','tahuns'));
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
        $jadwal = Jadwal::find($req->id_jadwal);
        $jadwal->id_jadwal = $req->id_jadwal;
        $jadwal->id_guru = $req->id_guru;
        $jadwal->id_mapel = $req->id_mapel;
        $jadwal->id_kelas = $req->id_kelas;
        $jadwal->id_tahun = $req->id_tahun;

        return redirect('/jadwal/index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_guru)
    {
        $jadwal = Jadwal::find($id_guru);
        $jadwal->delete();

        return redirect()->back();
    }

    public function print()
    {
        $jadwal = Jadwal::all();

        $pdf = PDF::loadview('jadwals/cetak', compact('jadwal'), ['jadwal' => $jadwal]);

        return $pdf->stream('Cetak Jadwal.pdf');
    }

}
