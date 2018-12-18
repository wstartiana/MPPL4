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

Route::get('/peta', 'petaController@index');
Route::get('/tampilpeta', 'petaController@tampilpeta') -> name('tampilpeta');
Route::get('/sekolah/{id}/lihatSekolah', 'SekolahController@lihatSekolah')->name('lihatSekolah');
Route::post('/sekolah/lihatSekolah', 'SekolahController@cariSekolah') -> name('cariSekolah');
Route::get('/info', 'SekolahController@infoSekolah');
