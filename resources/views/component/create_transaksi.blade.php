<div class="modal modal-dark" id="modal-createTransaksi">
	<div class="bg-white container rounded" style="padding: 0; max-width: 600px;">
		<div class="card-header">
			Buat Transaksi
			<span style="float: right;" class="bi bi-x-lg pointer" data-id="createTransaksi" onclick="closeModal(this);"></span>
		</div>
		<div class="card-body">
			<form action="{{route('store_transaksi')}}" id="transaction_form" method="post">
				@csrf
				<div class="form-group mb-3">
					<label>Nama Nasabah</label>
					<select style="display: block !important; width: 100%;" name="nasabah_name" id="nasabah-selection" class="js-example-basic-single form-control nasabah-select" name="state">
						<option value="" selected>Pilih Nasabah</option>
						@foreach($all_nasabah as $nasabah)
					  		<option value="{{$nasabah->AccountID}}">{{$nasabah->Name}}</option>
					  	@endforeach
					</select>
				</div>
				<div class="form-group mb-3">
					<?php $all_jenis = DB::table('jenis_transaksi')->get(); ?>
					<label>Jenis Transaksi</label>
					<select class="form-control" name="jenis" id="jenis" required>
						<option selected value="">Jenis Transaksi</option>
						@foreach($all_jenis as $jenis)
							<option value="{{$jenis->id_jenis}}">{{$jenis->jenis_transaksi}} ({{$jenis->type}})</option>
						@endforeach
					</select>
					<small class="text-info">C = Credit, D = Debit</small>
				</div>
				<div class="form-group mb-3">
					<label>Nominal</label>
					<input type="number" class="form-control" id="nominal" max="" step="100" min="5000" name="amount" required>
				</div>
				<div class="form-group mb-3">
					<label>Current Balance</label>
					<input type="number" id="currentBalance" disabled class="form-control">
				</div>
				<div class="form-group mb-3">
					<label>Date</label>
					<input type="date" name="date" class="form-control" required>
				</div>
				<div class="transaction-msg-bag"></div>
				<button class="btn btn-dark btn-sm" id="saving" onclick="checkingBalanceB4Submit();" disabled>Simpan</button>
			</form>
		</div>
	</div>
</div>