<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Nilai;
use App\Kelas;
use App\Jurusan;
use App\Tahun;
use App\Mapel;
use App\Siswa;
use App\Jadwal;
use App\Guru;
use Auth;
use Response;
use PDF;

class NilaiController extends Controller
{
    public function index()
    {
        
        $id_user = Auth::user()->id;

        $guru = Guru::select('id_guru')->where('id_user', $id_user)->first();

        $id_guru = $guru['id_guru'];

        $mapel = Jadwal::select('id_mapel')->where('id_guru', $id_guru)->first();

        $id_mapel = $mapel['id_mapel'];

        $datanilai = Nilai::select('id_siswa', 'id_mapel')->where('id_mapel', $id_mapel)->distinct()->get();

        $nilais = Nilai::all();
        $siswas = Siswa::all();
        $kelas = Kelas::all();
        $jurusan = Jurusan::all();
        $mapels = Mapel::all();
        $tahuns = Tahun::all();

        return view('nilais/index', compact('datanilai','nilais', 'siswas', 'kelas','jurusan', 'mapels', 'tahuns'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $req)
    { 
        $id_user = Auth::user()->id;

        $guru = Guru::select('id_guru')->where('id_user', $id_user)->first();

        $id_guru = $guru['id_guru'];

        $mapel = Jadwal::select('id_mapel')->where('id_guru', $id_guru)->first();

        $id_mapel = $mapel['id_mapel'];

            $this->validate($req, [
        'limit' => 'integer',
    ]);

        $datanilai = Nilai::where('id_mapel', $id_mapel)->when($req->semester, function ($query) use ($req) {
            $query->where('semester', $req->semester);
        })->paginate($req->limit ? $req->limit : 20);

        $datanilai->appends($req->only('semester'));

        $nilais = Nilai::all();
        $siswas = Siswa::all();
        $kelas = Kelas::all();
        $jurusan = Jurusan::all();
        $mapels = Mapel::all();
        $tahuns = Tahun::all();

        return view('nilais/create', compact('datanilai','nilais', 'siswas', 'kelas','jurusan', 'mapels', 'tahuns'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
    {
        $nilai = new Nilai;
        $nilai->id_nilai = $req->id_nilai;
        $nilai->nisn = $req->nisn;
        $nilai->nama = $req->nama;
        $nilai->id_kelas = $req->id_kelas;
        $nilai->save();
        session()->flash('success-create', 'Data Nilai berhasil disimpan');
        return redirect('/nilai/index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id_nilai)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id_nilai)
    {
        $nilai = Nilai::find($id_nilai);
        $kelas = Kelas::all();
        return view('nilais/edit', compact('nilai','kelas'));
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
        $nilai = Nilai::find($req->id_kelas);
        $nilai->id = $req->id_nilai;
        $nilai->n1 = $req->n1;
        $nilai->n2 = $req->n2;
        $nilai->n3 = $req->n3;
        $nilai->pts = $req->pts;
        $nilai->pas = $req->pas;
        $nilai->save();

        session()->flash('success-create', 'Data Nilai berhasil disimpan');
        return redirect('/nilai/create');
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_nilai)
    {
        
        $nilai = Nilai::find($id_nilai);
        $nilai->delete();

        return redirect()->back();
    }

    public function print()
    {
        $nilai = Nilai::all();

        $pdf = PDF::loadview('nilais/cetak', compact('nilai'), ['nilai' => $nilai]);

        return $pdf->stream('Cetak nilai.pdf');
    }

    public function detail($id_siswa)
    {
        $nilai = Nilai::where('id_siswa', $id_siswa);

        return view('nilais/detail');
    }

    public function paginate($request)
    {
        $id_user = Auth::user()->id;

        $guru = Guru::select('id_guru')->where('id_user', $id_user)->first();

        $id_guru = $guru['id_guru'];

        $mapel = Jadwal::select('id_mapel')->where('id_guru', $id_guru)->first();

        $id_mapel = $mapel['id_mapel'];

        return $request->semester;

        $siswas = Nilai::when($request->semester, function ($query) use ($request) {
            $query->where('semester', $request->semester);
        })->get();

        $nilais = Nilai::all();
        $kelas = Kelas::all();
        $jurusan = Jurusan::all();
        $mapels = Mapel::all();
        $tahuns = Tahun::all();

        return view('nilais/index', compact('nilais', 'siswas', 'kelas','jurusan', 'mapels', 'tahuns'));
    }

}
