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

        $id_siswa = Siswa::select('kode_siswa')->whereRaw('id_siswa = (select max(`id_siswa`) from siswas) ')->first();
        $kode = substr($id_siswa['kode_siswa'], 1,4);
        $tambah = $kode+1;
        if ($tambah<10) {
            $id_siswa = "S000".$tambah;
        } elseif ($tambah<100) {
            $id_siswa = "S00".$tambah;
        } elseif ($tambah<1000) {
            $id_siswa = "S0".$tambah;
        } else{
            $id_siswa = "S".$tambah;
        }

        return view('siswas/index', compact('siswas', 'kelas','jurusans','tahun', 'id_siswa'));
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
        $siswa->jk = $req->jk;
        $siswa->tempat_lahir = $req->tempat_lahir;
        $siswa->tanggal_lahir = $req->tanggal_lahir;
        $siswa->agama = $req->agama;
        $siswa->alamat = $req->alamat;
        $siswa->no_telp = $req->no_telp;

        $siswa->id_kelas = $req->id_kelas;

        $nisn = DB::table('siswas')->where('nisn', $req->nisn)->get();
        $count_nisn = count($nisn);
        $kode_siswa = DB::table('siswas')->where('kode_siswa', $req->kode_siswa)->get();
        $count_kode_siswa = count($kode_siswa);

        if ($count_nisn > 0 || $count_kode_siswa > 0){
            session()->flash('failed-create', 'Data siswa tersebut sudah ada');
            return redirect()->back();
        } else {

            $siswa->save();

            $id_siswa = Siswa::all();

            $siswa_id = Siswa::select('id_siswa')->whereRaw('id_siswa = (select max(`id_siswa`) from siswas)')->first();

            $mapel = Mapel::all();
            $count_mapel = count($mapel);

            for ($i=1; $i <= $count_mapel; $i++) { 
                $nilai = new Nilai;
                $nilai->kode_nilai = "09839";
                $nilai->id_siswa = $siswa_id['id_siswa'];
                $nilai->id_mapel = $i;
                $nilai->semester = "Ganjil";
                $nilai->save();

                $nilai = new Nilai;
                $nilai->kode_nilai = "19839";
                $nilai->id_siswa = $siswa_id['id_siswa'];
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
                $absen->id_siswa = $siswa_id['id_siswa'];
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
        $siswa->jk = $req->jk;
        $siswa->tempat_lahir = $req->tempat_lahir;
        $siswa->tanggal_lahir = $req->tanggal_lahir;
        $siswa->agama = $req->agama;
        $siswa->alamat = $req->alamat;
        $siswa->no_telp = $req->no_telp;
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
        $datanilai = Nilai::all();
        $pdf = PDF::loadview('siswas/cetak', compact('siswa', 'datanilai'), ['datanilai' => $datanilai]);

        return $pdf->stream('Cetak siswa.pdf');
    }

    public function printRaport($id_siswa)
    {   

        $siswa = Siswa::find($id_siswa);

        $pdf = PDF::loadview('siswas/cetakRaport', compact('siswa'), ['siswa' => $siswa]);

        return $pdf->stream('Cetak Raport.pdf');
    }

    
}
