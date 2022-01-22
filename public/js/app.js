var base_url = window.location.pathname;
function createNasabah()
{
	$('#modal-createNasabah').fadeIn('fast').css({
		'display':'grid',
		'place-items':'center',
	});
}

function closeModal(selector)
{
	$('#modal-'+$(selector).data('id')).fadeOut('fast');
}

function createTransaksi()
{
	$('#modal-createTransaksi').fadeIn('fast').css({
		'display':'grid',
		'place-items':'center',
	});
}

function checkingBalanceB4Submit(e)
{
	e.preventDefault();
	var url = base_url+'CheckTransaction';
	let Transaction_Form = document.getElementById('transaction_form');
	let formData = new FormData(Transaction_Form);

	$.ajax({
		type : 'post',
		url : url,
		data : formData,
		success:function(data)
		{
			if (data['type']=='oke') {
				$('#transaction_form').submit();
				$('.transaction-msg-bag').html('')
			}else{
				$('.transaction-msg-bag').html(data['msg'])
			}
		},
	    cache: false,
	    contentType: false,
	    processData: false
	})
}

$(document).ready(function() {
    $('.js-example-basic-single').select2();
    $('#nasabah-table').DataTable();
    $('#transaksi-table').DataTable();
});
