<div class="container">
	<h5>Transaksi</h5>
	<table class="table" id="transaksi-table">
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
			@foreach($all_transaksi as $transaksi)
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