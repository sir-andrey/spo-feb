<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Level;
use App\Guru;
use App\Siswa;
use App\Jadwal;
use App\Walikelas;
use DB;
use Illuminate\Support\Facades\Hash;

class AkunController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $akuns = User::all();
        $siswa = Siswa::all();
        $guru = Guru::all(); 
        $level = Level::all();
        $jadwal = Jadwal::all();

        $hitungjadwal = count($jadwal);
        $hitungsiswa = count($siswa);

        return view('akuns/index', compact('akuns','level', 'guru', 'siswa', 'jadwal', 'hitungjadwal', 'hitungsiswa'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $akun = User::all();
        $siswa = Siswa::all();
        $guru = Guru::all(); 
        $level = Level::all();
        $jadwal = Jadwal::all();

        $hitungjadwal = count($jadwal);
        $hitungsiswa = count($siswa);

        return view('akuns/create', compact('akun','level', 'guru', 'siswa', 'jadwal', 'hitungjadwal', 'hitungsiswa'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
    {
        if ($req->id_level == 2 || $req->id_level == 4) {
            
            $jadwal = Jadwal::select('id_jadwal')->where('id_guru', $req->id)->first();
            $guru = Guru::select('nama_guru')->where('id_guru', $req->id)->first();
            $nama = $guru['nama_guru'];
            $id_jadwal = $jadwal['id_jadwal'];
        } else{
            $siswa = Siswa::select('nama_siswa')->where('id_siswa', $req->id)->first();
            $nama = $siswa['nama_siswa'];
        }

        $akun = new User;
        
        $akun->name = $nama;
        $akun->username = $req->username;
        $akun->email = $req->email;
        $akun->password = Hash::make($req->password);
        $akun->id_level = $req->id_level;
        $akun->id_jadwal = $id_jadwal;
        $akun->save();

        if ($req->id_level == 4) {
            
            $akun_id = User::select('id')->whereRaw('id = (select max(`id`) from users)')->first();
            $guru = Guru::select('nama_guru')->where('id_guru', $req->id)->first();

            $

            $walikelas = new Walikelas;
            $walikelas->id_user = $akun_id;

        }
            session()->flash('success-create', 'Data berhasil disimpan');
            return redirect('/akun/index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
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
    public function edit($id)
    {
        $akun = User::all();
        $siswa = Siswa::all();
        $guru = Guru::all(); 
        $level = Level::all();
        $jadwal = Jadwal::all();

        return view('akuns/edit', compact('akun','level', 'guru', 'siswa', 'jadwal'));
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
        $akun = User::find($req->id);
        $akun->name = $req->name;
        $akun->username = $req->username;
        $akun->email = $req->email;
        $akun->id_level = $req->id_level;
        $akun->id_jadwal = $req->id_jadwal;
  
        $akun->save();

        return redirect('/akun/index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $akun = Akun::find($id);
        $akun->delete();
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      
        return redirect()->back();
    }
}
