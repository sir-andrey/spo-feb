<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mapel;
use App\Jurusan;
use PDF;
use DB;

class MapelController extends Controller{
 /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mapels = Mapel::all();
        $jurusans = Jurusan::all();

        return view('mapels/index', compact('mapels','jurusans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('mapels/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
    {
        $mapel = new Mapel;
        
        $mapel->kode_mapel = $req->kode_mapel;
        
        $mapel->nama_mapel = $req->nama_mapel;

        $mapel->id_jurusan = $req->id_jurusan;
        
        $nama = DB::table('mapels')->where('nama_mapel', $req->nama_mapel)->get();
        $count_nama = count($nama);
        
        $kode_mapel = DB::table('mapels')->where('kode_mapel', $req->kode_mapel)->get();
        $count_id = count($kode_mapel);
       

        if ($count_id > 0  || $count_nama > 0 ){
            session()->flash('failed-create', 'Data Mapel tersebut sudah ada');
            return redirect()->back();
        } else {
            $mapel->save();
            session()->flash('success-create', 'Data Mapel berhasil disimpan');
            return redirect('/mapel/index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id/
     * @return \Illuminate\Http\Response
     */
    public function show($id)
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
        $mapel = Mapel::find($id_mapel);

        return view('mapels/edit', compact('mapel'));
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
        $mapel = Mapel::find($req->id_mapel);
        
        $mapel->kode_mapel = $req->kode_mapel;
        
        $mapel->nama_mapel = $req->nama_mapel;
        
        $mapel->save();

        return redirect('/mapel/index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $mapel = Mapel::find($id);
        $mapel->delete();

        return redirect()->back();
    }

   public function print()
    {
        $mapel = Mapel::all();

        $pdf = PDF::loadview('mapels/cetak', compact('mapel'), ['mapel' => $mapel]);

        return $pdf->stream('Cetak Mapel.pdf');
    }
}

