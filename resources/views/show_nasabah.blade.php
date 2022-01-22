@extends('layouts.app')
@section('content')
<div class="container" style="padding: 20px;">
	<nav aria-label="breadcrumb">
	  <ol class="breadcrumb bg-white">
	    <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
	    <li class="breadcrumb-item active" aria-current="page">Nasabah</li>
	  </ol>
	</nav>
	<h5>{{$this_nasabah->Name}} | Rp. {{number_format($this_nasabah->Balance)}} | {{$this_nasabah->Point}} Points</h5>
	<hr>
	<form action="{{url('search_transaksi_nasabah/'.$this_nasabah->AccountID)}}" class="mb-3" method="get" style="max-width: 600px;">
	    <header class="mb-3 fw-600">Pencarian Berdasarkan Tanggal</header>
	    <div class="form-group mb-3 row">
	        <div class="col-5">
	            <input type="date" value="<?php if(isset($start)) echo $start; ?>" class="form-control" name="start" id="dateStart">
	            <small>Tanggal Mulai</small>
	        </div>
	        <div class="col-5">
	            <input type="date" value="<?php if(isset($end)) echo $end; ?>" class="form-control" name="end" id="dateEnd">
	            <small>Tanggal Akhir</small>
	        </div>
	    </div>
	    <button class="btn btn-dark shadow-sm btn-sm">Terapkan</button>
	    <a class="btn btn-warning shadow-sm btn-sm" href="{{url('show_nasabah/'.$this_nasabah->AccountID)}}">Reset Filter</a>
	</form>
	@if(isset($start) || isset($end))
	<div class="alert alert-info">Menampilkan hasil pencarian untuk {{$this_nasabah->Name}} dengan tanggal {{$start}} - {{$end}}</div>
	@endif
	<table class="table">
		<thead>
			<tr>
				<th>Nama</th>
				<th>Tanggal Transaksi</th>
				<th>Deskripsi</th>
				<th>Credit</th>
				<th>Debit</th>
				<th>Nominal</th>
				<th>Point</th>
			</tr>
		</thead>
		<tbody>
			@foreach($this_nasabah_transaksi as $transaksi)
			<tr>
				<td>{{$transaksi->Name}}</td>
				<td>{{$transaksi->TransactionDate}}</td>
				<td>{{$transaksi->jenis_transaksi}}</td>
				<td>
					@if($transaksi->DebitCreditStatus=='C')
					Rp. {{number_format($transaksi->Amount)}}
					@else
					-
					@endif
				</td>
				<td>
					@if($transaksi->DebitCreditStatus=='D')
					Rp. {{number_format($transaksi->Amount)}}
					@else
					-
					@endif
				</td>
				<td>Rp. {{number_format($transaksi->Amount)}}</td>
				<td>{{$transaksi->Point}}</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>
@endsection