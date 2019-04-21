<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kelas;
use App\Jurusan;
use App\Tahun;
use PDF;
use DB;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kelas = Kelas::all();
        $jurusan = Jurusan::all(); 
        $tahun = Tahun::all(); 

        $id_kelas = Kelas::select('kode_kelas')->whereRaw('id_kelas = (select max(`id_kelas`) from kelas) ')->first();
        $kode = substr($id_kelas['kode_kelas'], 1,4);
        $tambah = $kode+1;
        if ($tambah<10) {
            $id_kelas = "K000".$tambah;
        } elseif ($tambah<100) {
            $id_kelas = "K00".$tambah;
        } elseif ($tambah<1000) {
            $id_kelas = "K0".$tambah;
        } else{
            $id_kelas = "K".$tambah;
        }
        return view('kelas/index', compact('kelas','jurusan','tahun','id_kelas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
         $jurusan = Jurusan::all(); 
         $tahun = Tahun::all(); 
         return view('kelas/create',compact('jurusan','tahun'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
    {
        $kelas = new Kelas;
        $kelas->kode_kelas = $req->kode_kelas;
        $kelas->tingkat = $req->tingkat;
        $kelas->id_jurusan = $req->id_jurusan;
        $kelas->kelas = $req->kelas;
        $kelas->id_tahun = $req->id_tahun;
        
        $kode_kelas = DB::table('kelas')->where('kode_kelas', $req->kode_kelas)->get();
        $count_kode_kelas = count($kode_kelas);
       

        if ($count_kode_kelas > 0 ){
            session()->flash('failed-create', 'Data Kelas tersebut sudah ada');
            return redirect()->back();
        } else {
            $kelas->save();
            session()->flash('success-create', 'Data Kelas berhasil disimpan');
            return redirect('/kelas/index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id_kelas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id_kelas)
    {
        $kelas = Kelas::find($id_kelas);
        $jurusan = Jurusan::all();
        $tahun = Tahun::all();
        return view('kelas/edit', compact('kelas','jurusan','tahun'));
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
        $kelas = Kelas::find($req->id_kelas);
        $kelas->kode_kelas = $req->kode_kelas;
        $kelas->tingkat = $req->tingkat;
        $kelas->id_jurusan = $req->id_jurusan;
        $kelas->kelas = $req->kelas;
        $kelas->id_tahun = $req->id_tahun;
        $kelas->save();

        return redirect('/kelas/index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_kelas)
    {
        $kelas = Kelas::find($id_kelas);
        $kelas->delete();
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      
        return redirect()->back();
    }

    public function print()
    {
        $kelas = Kelas::all();

        $pdf = PDF::loadview('kelas/cetak', compact('kelas'), ['kelas' => $kelas]);

        return $pdf->stream('Cetak kelas.pdf');
    }

    

}
