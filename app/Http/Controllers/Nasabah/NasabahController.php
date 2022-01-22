<?php

namespace App\Http\Controllers\Nasabah;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class NasabahController extends Controller
{
    public function store(Request $request)
    {
        DB::table('nasabah')
        ->insert([
            'Name'=>$request->nasabah,
        ]);

        return back();
    }

    public function all_transaksi($id)
    {
        $this_nasabah = DB::table('nasabah')
        ->where('AccountID',$id)
        ->first();

        $this_nasabah_transaksi = DB::table('transaksi')
        ->join('nasabah','transaksi.AccountID','=','nasabah.AccountID')
        ->join('jenis_transaksi','transaksi.TransactionType','=','jenis_transaksi.id_jenis')
        ->select('transaksi.*','nasabah.Name','jenis_transaksi.jenis_transaksi','jenis_transaksi.type')
        ->where('transaksi.AccountID',$id)
        ->paginate(20);

        return view('show_nasabah',compact('this_nasabah','this_nasabah_transaksi'));
    }

    public function getBalance(Request $request)
    {
        $this_nasabah = DB::table('nasabah')
        ->where('AccountID',$request->AccountID)
        ->first();

        if (!$this_nasabah) {
            header('HTTP/1.1 500 Internal Server Not Error Aawkawokawokaw');
            header('Content-Type: application/json; charset=UTF-8');
            die(json_encode(array('message' => 'Tidak ditemukan', 'code' => 404)));
        }else{
            return response($this_nasabah->Balance);
        }
    }

    public function search(Request $request, $id)
    {
        $this_nasabah = DB::table('nasabah')
        ->where('AccountID',$id)
        ->first();

        $start = $request->start;
        $end = $request->end;

        if ($start && $end) {
            $this_nasabah_transaksi = DB::table('transaksi')
            ->join('nasabah','transaksi.AccountID','=','nasabah.AccountID')
            ->join('jenis_transaksi','transaksi.TransactionType','=','jenis_transaksi.id_jenis')
            ->select('transaksi.*','nasabah.Name','jenis_transaksi.jenis_transaksi','jenis_transaksi.type')
            ->where('transaksi.AccountID',$id)
            ->whereBetween('transaksi.TransactionDate',[$start, $end])
            ->get();
        }elseif ($start && !$end) {
            $this_nasabah_transaksi = DB::table('transaksi')
            ->join('nasabah','transaksi.AccountID','=','nasabah.AccountID')
            ->join('jenis_transaksi','transaksi.TransactionType','=','jenis_transaksi.id_jenis')
            ->select('transaksi.*','nasabah.Name','jenis_transaksi.jenis_transaksi','jenis_transaksi.type')
            ->where('transaksi.AccountID',$id)
            ->whereDate('transaksi.TransactionDate','>=',$start)
            ->get();
        }elseif (!$start && $end) {
            $this_nasabah_transaksi = DB::table('transaksi')
            ->join('nasabah','transaksi.AccountID','=','nasabah.AccountID')
            ->join('jenis_transaksi','transaksi.TransactionType','=','jenis_transaksi.id_jenis')
            ->select('transaksi.*','nasabah.Name','jenis_transaksi.jenis_transaksi','jenis_transaksi.type')
            ->where('transaksi.AccountID',$id)
            ->whereDate('transaksi.TransactionDate','<=',$end)
            ->get();
        }else{
            $this_nasabah_transaksi = DB::table('transaksi')
            ->join('nasabah','transaksi.AccountID','=','nasabah.AccountID')
            ->join('jenis_transaksi','transaksi.TransactionType','=','jenis_transaksi.id_jenis')
            ->select('transaksi.*','nasabah.Name','jenis_transaksi.jenis_transaksi','jenis_transaksi.type')
            ->where('transaksi.AccountID',$id)
            ->get();
        }

        return view('show_nasabah',compact('this_nasabah','this_nasabah_transaksi','start','end'));
    }
}
