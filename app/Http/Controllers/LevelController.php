<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Level;
use DB;
use PDF;

class LevelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $levels = Level::all();

        return view('levels/index', compact('levels'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('levels/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     public function store(Request $req)
    {
        $level = new Level;
        $level->kode_level = $req->kode_level;
        $level->nama_level = $req->nama_level;

        $nama_level = DB::table('levels')->where('nama_level', $req->nama_level)->get();
        $count_nama_level = count($nama_level);
        $kode_level = DB::table('levels')->where('kode_level', $req->kode_level)->get();
        $count_kode_level = count($kode_level);

        if ($count_nama_level > 0 || $count_kode_level > 0){
            session()->flash('failed-create', 'Data tersebut sudah ada');
            return redirect()->back();
        } else {
            $level->save();
            session()->flash('success-create', 'Data Level berhasil disimpan');
            return redirect('/level/index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id_tahun)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id_level)
    {
        $level = Level::find($id_level);
        return view('levels/edit', compact('level'));
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
        $level = Level::find($req->id_level);
        $level->kode_level = $req->kode_level;
        $level->nama_level = $req->nama_level;
        $level->save();

        return redirect('/level/index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_level)
    {
        $level = Level::find($id_level);
        $level->delete();

        return redirect()->back();
    }

    public function print()
    {
        $level = Level::all();

        $pdf = PDF::loadview('levels/cetak', compact('level'), ['level' => $level]);

        return $pdf->stream('Cetak level.pdf');
    }
}
