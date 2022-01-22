@extends('layouts.app')
@section('content')
<div class="container" style="padding: 20px;">
	<nav aria-label="breadcrumb">
	  <ol class="breadcrumb bg-white">
	    <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
	    <li class="breadcrumb-item active" aria-current="page">Laporan</li>
	  </ol>
	</nav>
	<form class="mb-3" id="searchForm" style="max-width: 600px;">
	    <header class="mb-3 fw-600">Pencarian Berdasarkan Tanggal</header>
	    <div class="form-group mb-3">
			<label>Nama Nasabah</label>
			<select style="display: block !important; width: 100%;" name="nasabah_name" id="nasabah-selection" class="js-example-basic-single form-control nasabah-select" name="state">
				<option value="" selected>Pilih Nasabah</option>
				@foreach($all_nasabah as $nasabah)
			  		<option value="{{$nasabah->AccountID}}">{{$nasabah->Name}}</option>
			  	@endforeach
			</select>
		</div>
	    <div class="form-group mb-3 row">
	        <div class="col-6">
	            <input type="date" value="<?php if(isset($start)) echo $start; ?>" class="form-control" name="start" id="dateStart">
	            <small>Tanggal Mulai</small>
	        </div>
	        <div class="col-6">
	            <input type="date" value="<?php if(isset($end)) echo $end; ?>" class="form-control" name="end" id="dateEnd">
	            <small>Tanggal Akhir</small>
	        </div>
	    </div>
	    <button class="btn btn-dark shadow-sm btn-sm">Terapkan</button>
	</form>
	<table class="table" id="transaction-table">
		<thead>
			<tr>
				<th>Tanggal Transaksi</th>
				<th>Deskripsi</th>
				<th>Credit</th>
				<th>Debit</th>
				<th>Nominal</th>
				<th>Point</th>
			</tr>
		</thead>
		<tbody></tbody>
	</table>
</div>
<script type="text/javascript">
	$('#searchForm').submit(function(e){
		e.preventDefault();
		
		$.ajax({
			type : 'get',
			url : '{{URL::to('searchTransaction')}}',
			data : $(this).serialize(),
			success:function(data)
			{
				$('#transaction-table tbody').html('');
				var tbody = $("<tbody />");
				var tr;
				$.each(data,function(object, result) {
					tr = $("<tr />");
					var credit = '-';
					var debit = '-';
					if (result['type']=='D') {
						debit = result['Amount'];
					}else{
						credit = result['Amount'];
					}
				    tr.append("<td>"+result['TransactionDate']+"</td><td>"+result['jenis_transaksi']+"</td><td>"+credit+"</td><td>"+debit+"</td><td>"+result['Amount']+"</td><td>"+result['Point']+"</td>")
				    tr.appendTo(tbody);
				});
				tbody.appendTo("#transaction-table");
			},
			error:function()
			{

			},
			cache: false,
			contentType: false,
			processData: false
		})
	})

	// $('#searchForm').submit(function(e){
	// 	e.preventDefault();
	// 	$.ajax({
	// 		type : 'get',
	// 		url : '{{URL::to('new_search')}}',
	// 		data : {keyword:keyword},
	// 		success:function(data)
	// 		{
	// 			$('#myTable tbody').html('');
	// 			var tbody = $("<tbody />");
	// 			var tr;
	// 			$.each(data,function(object, result) {
	// 				tr = $("<tr />");
	// 			    $.each(data[0],function(key, value) {
	// 			        tr.append("<td>"+result[key]+"</td>")
	// 			    });
	// 			    tr.appendTo(tbody);
	// 			});
	// 			tbody.appendTo("#myTable");
	// 		}
	// 	})
	// })
</script>
@endsection