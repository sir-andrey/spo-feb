<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Siswa;
use App\Kelas;
use App\Jurusan;
use App\Tahun;
use App\Nilai;
use App\Mapel;
use App\Absen;
use DB;
use Response;
use PDF;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $siswas = Siswa::all();
        $kelas = Kelas::all();
        $jurusans = Jurusan::all();
        $tahun = Tahun::all();

        return view('siswas/index', compact('siswas', 'kelas','jurusans','tahun'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    { 
        $tahun = Tahun::all();
        $kelas = Kelas::all(); 
        $jurusan = Jurusan::all(); 
        return view('siswas/create', compact('kelas','jurusan', 'tahun'));
    }

    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
    {
        $siswa = new Siswa;
        $siswa->kode_siswa = $req->kode_siswa;
        $siswa->nisn = $req->nisn;
        $siswa->nama_siswa = $req->nama_siswa;

        $siswa->id_kelas = $req->id_kelas;

        $nisn = DB::table('siswas')->where('nisn', $req->nisn)->get();
        $count_nisn = count($nisn);
        $kode_siswa = DB::table('siswas')->where('kode_siswa', $req->kode_siswa)->get();
        $count_kode_siswa = count($kode_siswa);

        if ($count_nisn > 0 || $count_kode_siswa > 0){
            session()->flash('failed-create', 'Data Kode atau NISN siswa tersebut sudah ada');
            return redirect()->back();
        } else {

            $siswa->save();

            $id_siswa = Siswa::all();

            $count_id = count($id_siswa);

            $mapel = Mapel::all();
            $count_mapel = count($mapel);

            for ($i=1; $i <= $count_mapel; $i++) { 
                $nilai = new Nilai;
                $nilai->kode_nilai = "09839";
                $nilai->id_siswa = $count_id;
                $nilai->id_mapel = $i;
                $nilai->semester = "Ganjil";
                $nilai->save();

                $nilai = new Nilai;
                $nilai->kode_nilai = "19839";
                $nilai->id_siswa = $count_id;
                $nilai->id_mapel = $i;
                $nilai->semester = "Genap";
                $nilai->save();
            }

            $bulanIndo = array(
              '01' => 'Januari',
              '02' => 'Februari',
              '03' => 'Maret',
              '04' => 'April',
              '05' => 'Mei',
              '06' => 'Juni',
              '07' => 'Juli',
              '08' => 'Agustus',
              '09' => 'September',
              '10' => 'Oktober',
              '11' => 'November',
              '12' => 'Desember',
            );

            $awaltempo = "2019-07-01";

            for ($a=0; $a < 12; $a++) { 
                $jatuhtempo = date("Y-m-d", strtotime("+$a month", strtotime($awaltempo)));

                $absen = new Absen;
                $absen->id_siswa = $count_id;
                $absen->bulan = $bulanIndo[date('m', strtotime($jatuhtempo))];
                $absen->id_kelas = $req->id_kelas;
                $absen->save();
            }

            session()->flash('success-create', 'Data Siswa berhasil disimpan');
            return redirect('/siswa/index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id_siswa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id_siswa)
    {
        $siswa = Siswa::find($id_siswa);
        $kelas = Kelas::all();
        return view('siswas/edit', compact('siswa','kelas'));
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
        $siswa = Siswa::find($req->id_siswa);
        $siswa->id_siswa = $req->id_siswa;
        $siswa->nisn = $req->nisn;
        $siswa->nama = $req->nama;
        $siswa->id_kelas = $req->id_kelas;
        
        $siswa->save();

        return redirect('/siswa/index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_siswa)
    {
        
        $siswa = Siswa::find($id_siswa);
        $siswa->delete();

        return redirect()->back();
    }

    public function print()
    {
        $siswa = Siswa::all();

        $pdf = PDF::loadview('siswas/cetak', compact('siswa'), ['siswa' => $siswa]);

        return $pdf->stream('Cetak siswa.pdf');
    }

    public function printRaport($id_siswa)
    {   

        $siswa = Siswa::find($id_siswa);

        $pdf = PDF::loadview('siswas/cetakRaport', compact('siswa'), ['siswa' => $siswa]);

        return $pdf->stream('Cetak Raport.pdf');
    }

    
}
