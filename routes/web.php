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
    ->join('jenis_transaksi','transaksi.TransactionType','=','jenis_transaksi.id_jenis')
    ->select('transaksi.*','nasabah.Name','jenis_transaksi.jenis_transaksi','jenis_transaksi.type')
    ->get();
    return view('welcome',compact('all_nasabah','all_transaksi'));
});


// NASABAH
Route::post('store_nasabah',[NasabahController::class,'store'])->name('store_nasabah');
// show
Route::get('show_nasabah/{id}',[NasabahController::class,'all_transaksi']);
// search transaksi nasabah
Route::get('search_transaksi_nasabah/{id}',[NasabahController::class,'search']);
// search nasabah


// TRANSAKSI
Route::post('store_transaksi',[TransaksiController::class,'store'])->name('store_transaksi');
// get user balance
Route::get('getBalance',[NasabahController::class,'getBalance']);
// validating transaction
Route::post('CheckTransaction',[TransaksiController::class,'CheckTransaction']);
// Laporan
Route::get('Laporan',function(){
    $all_nasabah = DB::table('nasabah')->get();
    return view('laporan',compact('all_nasabah'));
});

// search laporan
Route::get('searchTransaction',[TransaksiController::class,'searchTransaction']);