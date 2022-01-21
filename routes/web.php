<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Nasabah\NasabahController;
use App\Http\Controllers\Transaksi\TransaksiController;

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
    $all_nasabah = DB::table('nasabah')->get();
    $all_transaksi = DB::table('transaksi')
    ->join('nasabah','transaksi.AccountID','=','nasabah.AccountID')
    ->select('transaksi.*','nasabah.Name')
    ->get();
    return view('welcome',compact('all_nasabah','all_transaksi'));
});


// NASABAH
Route::post('store_nasabah',[NasabahController::class,'store'])->name('store_nasabah');
// show
Route::get('show_nasabah/{id}',[NasabahController::class,'all_transaksi']);


// TRANSAKSI
Route::post('store_transaksi',[TransaksiController::class,'store'])->name('store_transaksi');
// get user balance
Route::get('getBalance',[NasabahController::class,'getBalance']);
// validating transaction
Route::post('CheckTransaction',[TransaksiController::class,'CheckTransaction']);