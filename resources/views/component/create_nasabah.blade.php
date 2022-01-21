<div class="modal modal-dark" id="modal-createNasabah">
	<div class="bg-white container rounded" style="padding: 0; max-width: 400px;">
		<div class="card-header">
			Tambah nasabah
			<span style="float: right;" class="bi bi-x-lg pointer" data-id="createNasabah" onclick="closeModal(this);"></span>
		</div>
		<div class="card-body">
			<form action="{{route('store_nasabah')}}" method="post">
				@csrf
				<div class="form-group mb-3">
					<label>Nama Nasabah</label>
					<input type="text" name="nasabah" class="form-control" required>
				</div>
				<button class="btn btn-dark btn-sm">Simpan</button>
			</form>
		</div>
	</div>
</div>