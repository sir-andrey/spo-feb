<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tahun;
use DB;
use PDF;

class TahunController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tahuns = Tahun::all();

       $id_tahun = Tahun::select('kode_tahun')->whereRaw('id_tahun = (select max(`id_tahun`) from tahuns) ')->first();
        $kode = substr($id_tahun['kode_tahun'], 1,4);
        $tambah = $kode+1;
        if ($tambah<10) {
            $id_tahun = "T000".$tambah;
        } elseif ($tambah<100) {
            $id_tahun = "T00".$tambah;
        } elseif ($tambah<1000) {
            $id_tahun = "T0".$tambah;
        } else{
            $id_tahun = "T".$tambah;
        }



        return view('tahuns/index', compact('tahuns','id_tahun'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tahuns/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
    {
        $tahun = new Tahun;
        $tahun->kode_tahun = $req->kode_tahun;
        $tahun->tahun = $req->tahun;

        $nama_tahun = DB::table('tahuns')->where('tahun', $req->tahun)->get();
        $count_nama_tahun = count($nama_tahun);
        $kode_tahun = DB::table('tahuns')->where('kode_tahun', $req->kode_tahun)->get();
        $count_kode_tahun = count($kode_tahun);

        if ($count_nama_tahun > 0 || $count_kode_tahun > 0){
            session()->flash('failed-create', 'Data tersebut sudah ada');
            return redirect()->back();
        } else {
            $tahun->save();
            session()->flash('success-create', 'Data Tahun berhasil disimpan');
            return redirect('/tahun/index');
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
    public function edit($id_tahun)
    {
        $tahun = Tahun::find($id_tahun);
        return view('tahuns/edit', compact('tahun'));
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
        $tahun = Tahun::find($req->id_tahun);
        $tahun->kode_tahun = $req->kode_tahun;
        $tahun->tahun = $req->tahun;
        $tahun->save();

        return redirect('/tahun/index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_tahun)
    {
        $tahun = Tahun::find($id_tahun);
        $tahun->delete();

        return redirect()->back();
    }

    public function print()
    {
        $tahun = Tahun::all();

        $pdf = PDF::loadview('tahuns/cetak', compact('tahun'), ['tahun' => $tahun]);

        return $pdf->stream('Cetak tahun.pdf');
    }
}
