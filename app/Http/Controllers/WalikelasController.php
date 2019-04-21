<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Walikelas;
use App\Guru;
use App\Kelas;
use App\Jurusan;
use App\Tahun;
use App\Jadwal;
use DB;
use Response;
use PDF;

class WalikelasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $walikelass = Walikelas::all();
        $gurus = Guru::all();
        $kelas = Kelas::all();
        $jurusans = Jurusan::all();
        $tahun = Tahun::all();
        $jadwal = Jadwal::all();


        return view('walikelas/index', compact('walikelass', 'gurus','kelas','jurusans','tahun', 'jadwal'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    { 
        $guru = Guru::all();
        $tahun = Tahun::all();
        $kelas = Kelas::all(); 
        $jurusan = Jurusan::all(); 
        return view('walikelas/create', compact('guru','kelas','jurusan', 'tahun'));
    }

    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
    {
        $walikelas = new Walikelas;
        $walikelas->id_guru = $req->id_guru;
        $walikelas->id_kelas = $req->id_kelas;

        $guru = DB::table('walikelas')->where('id_guru', $req->id_guru)->get();
        $count_guru = count($guru);
        $id_kelas = DB::table('walikelas')->where('id_kelas', $req->id_kelas)->get();
        $count_id_kelas = count($id_kelas);

        if ($count_guru > 0 || $count_id_kelas > 0){
            session()->flash('failed-create', 'Data  tersebut sudah ada');
            return redirect()->back();
        } else {

            $walikelas->save();

            session()->flash('success-create', 'Data berhasil disimpan');
            return redirect('/walikelas/index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id_walikelas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id_walikelas)
    {
        $walikelas = Walikelas::find($id_walikelas);
        $guru = Guru::all();
        $kelas = Kelas::all();
        return view('walikelas/edit', compact('walikelas','guru','kelas'));
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
        $walikelas = Walikelas::find($req->id_walikelas);
        $walikelas->id_guru = $req->id_guru;
        $walikelas->id_kelas = $req->id_kelas;
        
        $walikelas->save();

        return redirect('/walikelas/index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_walikelas)
    {
        
        $walikelas = Walikelas::find($id_siswa);
        $walikelas->delete();

        return redirect()->back();
    }

    public function print()
    {
        $walikelas = Walikelas::all();

        $pdf = PDF::loadview('walikelas/cetak', compact('walikelas'), ['walikelas' => $walikelas]);

        return $pdf->stream('Cetak walikelas.pdf');
    }

    public function getKelas($param){
      //GET THE ACCOUNT BASED ON TYPE
      $kelas = Kelas::where('id_tahun','=',$param)->get();
      //CREATE AN ARRAY 
      $options = array();      
      foreach ($kelas as $arrayForEach) {
                $options += array($arrayForEach->id_kelas => $arrayForEach->nama);                
            }
      
      return Response::json($options);

    }
}
