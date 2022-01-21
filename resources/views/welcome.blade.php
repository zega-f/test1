@extends('layouts.app')
@section('content')
<div class="container" style="padding: 20px;"> 
    <a href="#" class="btn btn-outline-dark btn-sm" onclick="createNasabah();">Nasabah <i class="bi bi-people-fill"></i></a>
    <a href="#" class="btn btn-outline-dark btn-sm" onclick="createTransaksi();">Transaksi <i class="bi bi-arrow-left-right"></i></a>
    <a href="#" class="btn btn-outline-dark btn-sm">Laporan <i class="bi bi-printer"></i></a>
    <hr>
    @include('component.semua_nasabah')
    <hr>
    @include('component.all_transaksi')
    @include('component.create_transaksi')
    @include('component.create_nasabah')
</div>
@endsection