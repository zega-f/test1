<?php

namespace App\Http\Controllers\Transaksi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use DB;

class TransaksiController extends Controller
{
    public function store(Request $request)
    {
        $datetime = date('Y-m-d');

        $type = $request->jenis;
        $nominal = $request->amount;
        $point = 0;

        if ($type=='1') {
            // calc_h merupakan nilai kelebihan dari 30k
            // calc_l merupakan nilai kelebihan dari 10k namun kurang dari 30k
            if ($nominal>30000) {
                $calc_h = $nominal-30000;
                $calc_l = $nominal-($calc_h + 10000);
                $point2 = floor(($calc_h/1000)*2);
                $point1 = floor($calc_l/1000);
                $point = $point1+$point2;
            }elseif($nominal<=30000 && $nominal>10000){
                $calc_l = $nominal-10000;
                $point1 = floor($calc_l/1000);
                $point=$point1;
            }
        }

        if ($type=='2') {
            // calc_h merupakan nilai kelebihan dari 100k
            // calc_l merupakan nilai kelebihan dari 50k namun kurang dari 100k
            if ($nominal>100000) {
                $calc_h = $nominal-100000;
                $calc_l = $nominal-($calc_h + 50000);
                $point2 = floor(($calc_h/2000)*2);
                $point1 = floor($calc_l/2000);
                $point = $point1+$point2;
            }elseif($nominal<=100000 && $nominal>50000){
                $calc_l = $nominal-50000;
                $point1 = floor($calc_l/2000);
                $point=$point1;
            }
        }

        // insert new transaksi to table transaksi
        DB::table('transaksi')
        ->insert([
            'TransactionID'=>Str::random(8),
            'AccountID'=>$request->nasabah_name,
            'TransactionDate'=>$datetime,
            'Description'=>$request->jenis,
            'DebitCreditStatus'=>$request->status,
            'Amount'=>$request->amount,
            'Point'=>$point,
        ]);

        // get nasabah info
        $this_nasabah = DB::table('nasabah')
        ->where('AccountID',$request->nasabah_name);

        // get nasabah current point
        $this_nasabah_point = $this_nasabah->value('Point');
        // update nasabah with new point
        $this_nasabah->update([
            'Point'=>$this_nasabah_point+$point,
        ]);

        $transaksi_type = DB::table('jenis_transaksi')
        ->where('id_jenis',$request->jenis)
        ->value('type');

        $currentBalance = DB::table('nasabah')
        ->where('AccountID',$request->nasabah_name)
        ->value('Balance');

        if ($transaksi_type=="D") {
            if ($currentBalance-$request->amount<1) {
                $output = ['type'=>'bad','msg'=>'<div class="alert alert-danger">Harap Untuk cek ketersediaan saldo untuk melakukan transaksi debit</div>'];
            }else{
                $output = ['type'=>'oke'];
            }
        }else{
            $output = ['type'=>'oke'];
        }

        return back();
    }

    public function CheckTransaction(Request $request)
    {
        $currentBalance = DB::table('nasabah')
        ->where('AccountID',$request->nasabah_name)
        ->value('Balance');

        $transaksi_type = DB::table('jenis_transaksi')
        ->where('id_jenis',$request->jenis)
        ->value('type');

        if ($transaksi_type=="D") {
            if ($currentBalance-$request->amount<1) {
                $output = ['type'=>'bad','msg'=>'<div class="alert alert-danger">Harap Untuk cek ketersediaan saldo untuk melakukan transaksi debit</div>'];
            }else{
                $output = ['type'=>'oke'];
            }
        }else{
            $output = ['type'=>'oke'];
        }

        return response($output);
    }
}