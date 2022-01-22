<div class="container">
	<h5>Nasabah</h5>
	<table class="table">
		<thead>
			<tr>
				<th>ID</th>
				<th>Nama Nasabah</th>
				<th>Poin</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			@foreach($all_nasabah as $nasabah)
			<tr>
				<td>{{$nasabah->AccountID}}</td>
				<td>{{$nasabah->Name}}</td>
				<td>
					{{$nasabah->Point}}
				</td>
				<td>
					<button class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></button>
					<a href="{{url('show_nasabah/'.$nasabah->AccountID)}}" class="btn btn-info btn-sm"><i class="bi bi-eye"></i></a>
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>