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
use Auth;
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

            $guru = Guru::select('nama_guru')->where('id_guru', $req->id)->first();
            $nama = $guru['nama_guru'];
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
        $akun->save();

        if ($req->id_level == 4) {
            
            $akun_id = User::select('id')->whereRaw('id = (select max(`id`) from users)')->first();

            $walikelas = Walikelas::find($req->id);
            $walikelas->id_user = $akun_id;
            $walikelas->save();

        } elseif ($req->id_level == 2) {
            $akun_id = User::select('id')->whereRaw('id = (select max(`id`) from users)')->first();

            $guru = Guru::find($req->id);
            $guru->id_user = $akun_id['id'];
            $guru->save();
        } elseif ($req->id_level == 3) {
            $akun_id = User::select('id')->whereRaw('id = (select max(`id`) from users)')->first();

            $siswa = Siswa::find($req->id);
            $siswa->id_user = $akun_id['id'];
            $siswa->save();
        }
            session()->flash('success-create', 'Data Akun berhasil disimpan');
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
    public function edit()
    {
        $id = Auth::user()->id;
        $akun = User::find($id);
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
    public function updateakun(Request $req)
    {
        $akun = User::find($req->id);
        $passold = $akun->password;
        if ($req->password != $req->password1) {
            session()->flash('failed-create', 'Password tidak sama');
            return redirect()->back();
        } else{
            $akun->password = Hash::make($req->password);
            $akun->save();
            session()->flash('success-create', 'Password berhasil diubah');
            return redirect()->back();
        }
    }

    public function update(Request $req)
    {
        $akun = User::find($req->id);
        $akun->name = $req->name;
        $akun->username = $req->username;
        $akun->email = $req->email;
        $akun->id_level = $req->id_level;
  
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
        $akun = User::find($id);
        $akun->delete();
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      
        return redirect()->back();
    }
}
