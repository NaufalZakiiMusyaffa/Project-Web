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
/*
Route::get('/', function () {
    return view('home');
});
*/
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'HomeController@index');
/*
Route::get('/user', 'UserController@index');
Route::get('/user-register', 'UserController@create');
Route::post('/user-register', 'UserController@store');
Route::get('/user-edit/{id}', 'UserController@edit');
*/
Route::resource('user', 'UserController');

Route::resource('karyawan', 'KaryawanController');
Route::resource('driver', 'DriverController');
Route::resource('kategori', 'KategoriController');
Route::resource('history', 'HistoryController');

Route::resource('aset', 'AsetController');
Route::resource('asetac', 'AutocareController');
Route::resource('pemeliharaan', 'PemeliharaanController');

// Route::get('/format_buku', 'BukuController@format');
// Route::post('/import_buku', 'BukuController@import');

Route::resource('autocare-transaksi', 'TransaksiAutocareController');
Route::resource('transaksi', 'TransaksiController');
Route::get('/laporan/trs', 'LaporanController@transaksi');
Route::post('/laporan/trs/pdf', 'LaporanController@transaksiPdf');
Route::post('/laporan/trs/excel', 'LaporanController@transaksiExcel');
Route::post('/laporan/transaksiac/pdf', 'LaporanController@transaksiacPdf');
Route::post('/laporan/transaksiac/excel', 'LaporanController@transaksiacExcel');

Route::get('/laporan/aset', 'LaporanController@aset');
Route::post('/laporan/aset/pdf', 'LaporanController@asetPdf');
Route::post('/laporan/aset/excel', 'LaporanController@asetExcel');
Route::post('/laporan/history/pdf', 'LaporanController@historyPdf');
Route::post('/laporan/history/excel', 'LaporanController@historyExcel');
Route::get('/laporan/karyawan/pdf', 'LaporanController@karyawanPdf');
Route::get('/laporan/karyawan/excel', 'LaporanController@karyawanExcel');
Route::get('/laporan/asetac/pdf', 'LaporanController@asetacPdf');
Route::get('/laporan/asetac/excel', 'LaporanController@asetacExcel');
Route::get('/laporan/pengguna/pdf', 'LaporanController@penggunaPdf');
Route::get('/laporan/pengguna/excel', 'LaporanController@penggunaExcel');


