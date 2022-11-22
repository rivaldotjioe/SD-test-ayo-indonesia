<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/teams', 'App\Http\Controllers\TeamController@index');
Route::post('/teams', 'App\Http\Controllers\TeamController@create');
Route::put('/teams/{id}', 'App\Http\Controllers\TeamController@update');
Route::delete('/teams/{id}', 'App\Http\Controllers\TeamController@delete');

Route::post('/pemain', 'App\Http\Controllers\PemainController@create');
Route::put('/pemain/{id}', 'App\Http\Controllers\PemainController@update');
Route::get('/pemain', 'App\Http\Controllers\PemainController@index');
Route::delete('/pemain/{id}', 'App\Http\Controllers\PemainController@delete');

Route::post('/jadwal', 'App\Http\Controllers\JadwalPertandinganController@create');
Route::get('/jadwal', 'App\Http\Controllers\JadwalPertandinganController@index');

Route::put('/hasil-pertandingan/{id}', 'App\Http\Controllers\HasilPertandinganController@update');

Route::get('/log-gol', 'App\Http\Controllers\LogGolController@index');
Route::post('/log-gol', 'App\Http\Controllers\LogGolController@create');

Route::get('/report-pertandingan', 'App\Http\Controllers\ReportController@reportHasilPertandingan');
