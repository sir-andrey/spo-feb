<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//akun
Route::get('/akun/index', 'AkunController@index')->name('akun.index');

Route::get('/akun/create', 'AkunController@create')->name('akun.create');

Route::get('/akun/print', 'AkunController@print')->name('akun.print');

Route::post('/akun/store', 'AkunController@store')->name('akun.store');

Route::get('/akun/edit/{id}', 'AkunController@edit')->name('akun.edit');

Route::post('/akun/update', 'AkunController@update')->name('akun.update');

Route::post('/akun/kelola-akun', 'AkunController@updateakun')->name('akun.update-akun');

Route::get('/akun/destroy/{id}', 'AkunController@destroy')->name('akun.destroy');


//level
Route::get('/level/index', 'LevelController@index')->name('level.index');

Route::get('/level/create', 'LevelController@create')->name('level.create');

Route::get('/level/print', 'LevelController@print')->name('level.print');

Route::post('/level/store', 'LevelController@store')->name('level.store');

Route::get('/level/edit/{id}', 'LevelController@edit')->name('level.edit');

Route::post('/level/update', 'LevelController@update')->name('level.update');

Route::get('/level/destroy/{id}', 'LevelController@destroy')->name('level.destroy');


//jurusan
Route::get('/jurusan/index', 'JurusanController@index')->name('jurusan.index');

Route::get('/jurusan/create', 'JurusanController@create')->name('jurusan.create');

Route::get('/jurusan/print', 'JurusanController@print')->name('jurusan.print');

Route::post('/jurusan/store', 'JurusanController@store')->name('jurusan.store');

Route::get('/jurusan/edit/{id}', 'JurusanController@edit')->name('jurusan.edit');

Route::post('/jurusan/update', 'JurusanController@update')->name('jurusan.update');

Route::get('/jurusan/destroy/{id}', 'JurusanController@destroy')->name('jurusan.destroy');

//guru
Route::get('/guru/index', 'GuruController@index')->name('guru.index');

Route::get('/guru/create', 'GuruController@create')->name('guru.create');

Route::get('/guru/print', 'GuruController@print')->name('guru.print');

Route::post('/guru/store', 'GuruController@store')->name('guru.store');

Route::get('/guru/edit/{id}', 'GuruController@edit')->name('guru.edit');

Route::post('/guru/update', 'GuruController@update')->name('guru.update');

Route::get('/guru/destroy/{id}', 'GuruController@destroy')->name('guru.destroy');


//mapel
Route::get('/mapel/index', 'MapelController@index')->name('mapel.index');

Route::get('/mapel/create', 'MapelController@create')->name('mapel.create');

Route::get('/mapel/print', 'MapelController@print')->name('mapel.print');

Route::post('/mapel/store', 'MapelController@store')->name('mapel.store');

Route::get('/mapel/edit/{id}', 'MapelController@edit')->name('mapel.edit');

Route::post('/mapel/update', 'MapelController@update')->name('mapel.update');


Route::get('/mapel/destroy/{id}', 'MapelController@destroy')->name('mapel.destroy');


//siswa
Route::get('/siswa/index', 'SiswaController@index')->name('siswa.index');

Route::get('/siswa/create', 'SiswaController@create')->name('siswa.create');

Route::get('/siswa/print', 'SiswaController@print')->name('siswa.print');

Route::get('/siswa/printRaport', 'SiswaController@print')->name('siswa.printRaport');

Route::post('/siswa/store', 'SiswaController@store')->name('siswa.store');

Route::get('/siswa/edit/{id}', 'SiswaController@edit')->name('siswa.edit');

Route::post('/siswa/update', 'SiswaController@update')->name('siswa.update');


Route::get('/siswa/destroy/{id}', 'SiswaController@destroy')->name('siswa.destroy');

//kelas

Route::get('/kelas/index', 'KelasController@index')->name('kelas.index');

Route::get('/kelas/create', 'KelasController@create')->name('kelas.create');

Route::get('/kelas/print', 'KelasController@print')->name('kelas.print');

Route::post('/kelas/store', 'KelasController@store')->name('kelas.store');

Route::get('/kelas/edit/{id}', 'KelasController@edit')->name('kelas.edit');

Route::post('/kelas/update', 'KelasController@update')->name('kelas.update');

Route::get('/kelas/destroy/{id}', 'KelasController@destroy')->name('kelas.destroy');

Route::get('/kelas/getStates/{param}','KelasController@getStates');

//jadwal

Route::get('/jadwal/index', 'JadwalController@index')->name('jadwal.index');

Route::get('/jadwal/create', 'JadwalController@create')->name('jadwal.create');

Route::get('/jadwal/print', 'JadwalController@print')->name('jadwal.print');

Route::post('/jadwal/store', 'JadwalController@store')->name('jadwal.store');

Route::get('/jadwal/edit/{id}', 'JadwalController@edit')->name('jadwal.edit');

Route::post('/jadwal/update', 'JadwalController@update')->name('jadwal.update');

Route::get('/jadwal/destroy/{id}', 'JadwalController@destroy')->name('jadwal.destroy');

//tahun
Route::get('/tahun/index', 'TahunController@index')->name('tahun.index');

Route::get('/tahun/create', 'TahunController@create')->name('tahun.create');

Route::get('/tahun/print', 'TahunController@print')->name('tahun.print');

Route::post('/tahun/store', 'TahunController@store')->name('tahun.store');

Route::get('/tahun/edit/{id}', 'TahunController@edit')->name('tahun.edit');

Route::post('/tahun/update', 'TahunController@update')->name('tahun.update');

Route::get('/tahun/destroy/{id}', 'TahunController@destroy')->name('tahun.destroy');

//walikelas
Route::get('/walikelas/index', 'WalikelasController@index')->name('walikelas.index');

Route::get('/walikelas/create', 'WalikelasController@create')->name('walikelas.create');

Route::get('/walikelas/print', 'WalikelasController@print')->name('walikelas.print');

Route::post('/walikelas/store', 'WalikelasController@store')->name('walikelas.store');

Route::get('/walikelas/edit/{id}', 'WalikelasController@edit')->name('walikelas.edit');

Route::post('/walikelas/update', 'WalikelasController@update')->name('walikelas.update');

Route::get('/walikelas/destroy/{id}', 'WalikelasController@destroy')->name('walikelas.destroy');

//nilai
Route::get('/nilai/index', 'NilaiController@index')->name('nilai.index');

Route::get('/nilai/create', 'NilaiController@create')->name('nilai.create');

Route::get('/nilai/print', 'NilaiController@print')->name('nilai.print');

Route::get('/nilai/printraport', 'NilaiController@printraport')->name('nilai.printraport');

Route::get('/nilai/detail/{id}', 'NilaiController@detail')->name('nilai.detail');

Route::post('/nilai/store', 'NilaiController@store')->name('nilai.store');

Route::get('/nilai/edit/{id}', 'NilaiController@edit')->name('nilai.edit');

Route::get('/nilai/input/{id}', 'NilaiController@input')->name('nilai.input');

Route::post('/nilai/update', 'NilaiController@update')->name('nilai.update');

Route::get('/nilai/destroy/{id}', 'NilaiController@destroy')->name('nilai.destroy');

//absen
Route::get('/absen/index', 'AbsenController@index')->name('absen.index');

Route::get('/absen/create', 'AbsenController@create')->name('absen.create');

Route::get('/absen/print', 'AbsenController@print')->name('absen.print');

Route::get('/absen/detail/{id}', 'AbsenController@detail')->name('absen.detail');

Route::post('/absen/store', 'AbsenController@store')->name('absen.store');

Route::get('/absen/edit/{id}', 'AbsenController@edit')->name('absen.edit');

Route::get('/absen/input/{id}', 'AbsenController@input')->name('absen.input');

Route::post('/absen/update', 'AbsenController@update')->name('absen.update');

Route::get('/absen/destroy/{id}', 'AbsenController@destroy')->name('absen.destroy');
