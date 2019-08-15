var masterlist = function(){
	var _init = function(){
//-------------------------------------------------------
//global declarations

//-------------------------------------------------------
//DataTable		
		var tbl_masterlist = $('#tbl_masterlist').DataTable({
			'bPaginate': true,
			'bLengthChange': true,
			'bSort': false,
			'bFilter': true,
			//'aLengthMenu': [[10,25,50,-1],[10,25,50,'All']],
			//'iDisplayLength': 10,
			fixedHeader: {
				header: false,
			}
		});

		$(window).load(function(){
			$('#fiscal_id').val('');
			$('#begin_date').val('');
			$('#end_date').val('');
		});
		$('#tbl_masterlist tbody').on('click', 'tr', function(){
			tbl_masterlist.$('tr.highlight').removeClass('highlight');
			$(this).addClass('highlight');
			var data = tbl_masterlist.row(this).data();
			$('#fiscal_id').val(data[0]);
			$('#begin_date').val(data[2]);
			$('#end_date').val(data[3]);
			$('#is_locked').val(data[5].toLowerCase());

			if ($('#is_locked').val().toLowerCase() == 'no') {
				$('#btn_lock').text('LOCK');
			} else {
				$('#btn_lock').text('UNLOCK');
			}
		});

		$('#tbl_masterlist tbody').on('dblclick', 'tr', function(){
			var data = tbl_masterlist.row(this).data();
			$('#fiscal_id').val(data[0]);
			$('#begin_date').val(data[2]);
			$('#end_date').val(data[3]);
			$('#is_locked').val(data[5].toLowerCase());

			if ($('#is_locked').val().toLowerCase() == 'no') {
				$('#btn_lock').text('LOCK');
			} else {
				$('#btn_lock').text('UNLOCK');
			}
			$.ajax({
				type: 'POST',
				url: baseurl+'Accounting/Monthlypost/getTransactions',
				dataType: 'json',
				data: {'begin_date': $('#begin_date').val(), 'end_date': $('#end_date').val()},
				success: function(data){
					$('#tbl_alert tbody').empty();
					if (data != false) {
						var items = '';
						for(var i = 0; i <= data.length - 1; i++){
							items += '<tr><td>'+data[i].transaction_id+'</td><td>'+data[i].post_status.charAt(0).toUpperCase()+data[i].post_status.slice(1)+'</td><td>'+data[i].is_locked.charAt(0).toUpperCase()+data[i].is_locked.slice(1)+'</td></tr>';
						}
						$('#tbl_alert').append(items);
					}
				},
				error: function(errorThrown){
					toastr.error('Transaction Information Error#89244','Operation Failed');
					console.log(errorThrown);
				}
			});
			$('#mdl_alert').modal('toggle');
		});

		$('#btn_post').on('click', function(){
			$('#frm_actions').attr('action', baseurl+'Accounting/Monthlypost/getPosted');
		});

		$('#btn_lock').on('click', function(){
			if ($('#is_locked').val().toLowerCase() == 'no') {
				$('#is_locked').val('yes');
			} else {
				$('#is_locked').val('no');
			}
			$('#frm_actions').attr('action', baseurl+'Accounting/Monthlypost/getLocked');
		});
	}//end sa init
	return {
		init: function(){
			_init();
		}
	};
}();
jQuery(document).ready(function(){
	masterlist.init();
});