<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jurusan;
use DB;
use PDF;

class JurusanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jurusans = Jurusan::all();

        return view('jurusans/index', compact('jurusans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('jurusans/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     public function store(Request $req)
    {
        $jurusan = new Jurusan;
        $jurusan->kode_jurusan = $req->kode_jurusan;
        $jurusan->nama_jurusan = $req->nama_jurusan;

        $nama_jurusan = DB::table('jurusans')->where('nama_jurusan', $req->nama_jurusan)->get();
        $count_nama_jurusan = count($nama_jurusan);
        $kode_jurusan = DB::table('jurusans')->where('kode_jurusan', $req->kode_jurusan)->get();
        $count_kode_jurusan = count($kode_jurusan);

        if ($count_nama_jurusan > 0 || $count_kode_jurusan > 0){
            session()->flash('failed-create', 'Data Kode atau Jurusan tersebut sudah ada');
            return redirect()->back();
        } else {
            $jurusan->save();
            session()->flash('success-create', 'Data Jurusan berhasil disimpan');
            return redirect('/jurusan/index');
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
    public function edit($id_jurusan)
    {
        $jurusan = Jurusan::find($id_jurusan);
        return view('jurusans/edit', compact('jurusan'));
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
        $jurusan = Jurusan::find($req->id_jurusan);
        $jurusan->kode_jurusan = $req->kode_jurusan;
        $jurusan->nama_jurusan = $req->nama_jurusan;
        $jurusan->save();

        return redirect('/jurusan/index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_jurusan)
    {
        $jurusan = Jurusan::find($id_jurusan);
        $jurusan->delete();

        return redirect()->back();
    }

    public function print()
    {
        $jurusan = Jurusan::all();

        $pdf = PDF::loadview('jurusans/cetak', compact('jurusan'), ['jurusan' => $jurusan]);

        return $pdf->stream('Cetak jurusan.pdf');
    }
}
