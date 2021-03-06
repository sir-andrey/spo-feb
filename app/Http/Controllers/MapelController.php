<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mapel;
use App\Tahun;
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
        $mapel = Mapel::all();
        $jurusan = Jurusan::all();

        $id_mapel = Mapel::select('kode_mapel')->whereRaw('id_mapel = (select max(`id_mapel`) from mapels) ')->first();
        $kode = substr($id_mapel['kode_mapel'], 1,4);
        $tambah = $kode+1;
        if ($tambah<10) {
            $id_mapel = "M000".$tambah;
        } elseif ($tambah<100) {
            $id_mapel = "M00".$tambah;
        } elseif ($tambah<1000) {
            $id_mapel = "M0".$tambah;
        } else{
            $id_mapel = "M".$tambah;
        }


        return view('mapels/index', compact('mapel','jurusan','id_mapel'));
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

