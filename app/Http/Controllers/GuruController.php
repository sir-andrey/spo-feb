<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Guru;
use PDF;
use DB;
class GuruController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gurus = Guru::all();

        return view('gurus/index', compact('gurus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('gurus/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
    {
       
        $guru = new Guru;
        $guru->kode_guru = $req->kode_guru;
        $guru->nip = $req->nip;
        $guru->nama_guru = $req->nama_guru;
       

        $kode_guru = DB::table('gurus')->where('kode_guru', $req->kode_guru)->get();
        $count_kode_guru = count($kode_guru);
        $nip = DB::table('gurus')->where('nip', $req->nip)->get();
        $count_nip = count($nip);


        if ($count_kode_guru > 0 ||  $count_nip > 0){
            session()->flash('failed-create', 'Data Guru tersebut sudah ada');
            return redirect()->back();
        } else {
            $guru->save();
            session()->flash('success-create', 'Data Guru berhasil disimpan');
            return redirect('/guru/index');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id_mapel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id_mapel)
    {
        $guru = Guru::find($id_mapel);
        return view('gurus/edit', compact('guru'));
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
        $guru = Guru::find($req->id_guru);
        $guru->nip = $req->nip;
        $guru->nama_guru = $req->nama_guru;
  
        $guru->save();

        return redirect('/guru/index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_guru)
    {
        $guru = Guru::find($id_guru);
        $guru->delete();

        return redirect()->back();
    }

    public function print()
    {
        $guru = Guru::all();

        $pdf = PDF::loadview('gurus/cetak', compact('guru'), ['guru' => $guru]);

        return $pdf->stream('Cetak guru.pdf');
    }
}
