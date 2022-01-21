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
	<table class="table">
		<thead>
			<tr>
				<th>Nama</th>
				<th>Tanggal Transaksi</th>
				<th>Deskripsi</th>
				<th>Status Transaksi</th>
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
					Credit
					@else
					Debit
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