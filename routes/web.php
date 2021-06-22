<?php

use Illuminate\Support\Facades\Route;
// use Illuminate\Support\Facades\Hash;

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
Route::get('/', 'ClientController@index')->name('client.dashboard');
Route::get('/search', 'ClientController@search');
Route::get('/alumni/lihat/{id}', 'AlumniController@lihat');

Route::get('/admin', 'AuthController@showFormLogin')->name('form.login');
Route::get('/signin', 'AuthController@showFormLogin')->name('form.login');
Route::post('signin', 'AuthController@login')->name('login');
Route::get('register', 'AuthController@showFormRegister')->name('form.register');
Route::post('register', 'AuthController@register');
Route::post('/alumni/cari_nim', 'AlumniController@cari_nim')->name('search.nim');
Route::post('/alumni/find_nim', 'AlumniController@find_nim')->name('nim.find');
Route::post('/alumni/cek_user', 'PenggunaController@cek_user')->name('cek.user');
Route::post('/alumni/cek_email', 'PenggunaController@cek_email')->name('cek.email');
Route::post('/pengguna/cek_password', 'PenggunaController@cek_password')->name('cek.password');
Route::get('/pengumuman/lihat/{slug}','ClientController@lihat_pengumuman');

Route::group(['middleware' => ['auth', 'revalidate']], function() {
	Route::get('/home', 'HomeController@index');
	Route::get('/alumni', 'AlumniController@index');
	Route::get('/alumni/data', 'AlumniController@data')->name('alumni.data');
	Route::post('/alumni', 'AlumniController@simpan')->name('alumni.store');
	Route::delete('/alumni', 'AlumniController@destroy')->name('alumni.delete');
	Route::post('/alumni/import', 'AlumniController@import_data')->name('import.alumni');
	Route::get('/alumni/export_alumni', 'AlumniController@export_excel')->name('export.alumni');
	Route::post('/alumni/cek_nim', 'AlumniController@cek_nim')->name('cek.nim');
	Route::get('/alumni/{id}', 'AlumniController@edit');
	Route::post('/alumni/update', 'AlumniController@update')->name('alumni.update');

	Route::get('/pengguna', 'PenggunaController@index');
	Route::get('/pengguna/data', 'PenggunaController@data')->name('pengguna.data');
	Route::post('/pengguna', 'PenggunaController@simpan')->name('pengguna.store');
	
	Route::get('/pengguna/{id}', 'PenggunaController@edit');
	Route::post('/pengguna/update', 'PenggunaController@update')->name('pengguna.update');
	Route::delete('/pengguna', 'PenggunaController@destroy')->name('pengguna.delete');

	Route::get('/akun', 'PenggunaController@akun')->name('akun');
	Route::post('/akun', 'PenggunaController@update_akun')->name('update.akun');
	Route::post('/akun/update_password', 'PenggunaController@update_password')->name('update.password');
	Route::post('/akun/update_foto', 'PenggunaController@update_foto')->name('update.foto');

	Route::get('tracer_study', 'TracerStudyController@index');

	Route::get('pengumuman', 'PengumumanController@index')->name('pengumuman');
	Route::get('pengumuman/data', 'PengumumanController@data')->name('pengumuman.data');
	Route::post('pengumuman', 'PengumumanController@simpan')->name('pengumuman.store');

	Route::get('/logout', 'AuthController@logout')->name('logout');
});

// Route::get('latihan', 'Latihan@index');
// Route::get('latihan/view', 'Latihan@view');
// Route::get('/test', function() {
// 	return Hash::make('admin123');
// });
// Route::get('/berita/{id}', function($id) {
// 	if($id == 1){
// 		return abort(503);
// 	}elseif($id == 2){
// 		return abort(429);
// 	}else{
// 		return abort(500);
// 	}
// });
// Route::get('coba', function() {
// 	return view('coba');
// });
// Route::post('coba', 'Latihan@latihan')->name('coba.import');
// Route::get('data', 'Latihan@data');
// Route::get('data/{enkripsi}', 'Latihan@data_enkripsi');
// Route::get('crop', 'Latihan@crop');
// Route::post('crop', 'Latihan@uploadCropImage');