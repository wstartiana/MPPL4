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

Route::get('/peta', 'petaController@index')->name('lihatPeta');
Route::get('/tampilpeta', 'petaController@tampilpeta') -> name('tampilpeta');
Route::post('/sekolah/lihatSekolah', 'SekolahController@cariSekolah') -> name('cariSekolah');
Route::get('/info/{id}', 'SekolahController@infoSekolah')->name('lihatSekolah');
// Route::post('/tampilpeta', 'petaController@tampilpeta');