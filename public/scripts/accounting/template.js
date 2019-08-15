var masterlist = function(){
	var _init = function(){
		var masterRow = -1;
		var currentRow = 0, col = 4;

		$(window).load(function(){
			$('#tbl_masterlist_filter input').focus();
		});

		$(document).on('keydown', function(e){
			switch(e.which){
				/*case 27:
					e.preventDefault();
					$('#btn_back').click();
					break;*/
				case 113:
					e.preventDefault();
					$('#btn_add').click();
					break;
			}
		});

		var tbl_masterlist = $('#tbl_masterlist').DataTable({
			'processing': true,
			'bInfo': true,
			'bSort': false,
			'bLengthChange': true,
			fixedHeader: {
				header: false
			}
		});

		$('#tbl_masterlist_filter input').on('keydown', function(e){
			switch(e.which){
				case 9:
					e.preventDefault();
					break;
				case 13:
					e.preventDefault();
					if (masterRow > -1) { $('#tbl_masterlist tbody tr:eq('+masterRow+')').trigger('dblclick'); }
					tbl_masterlist.$('tr.highlight').removeClass('highlight');
					break;
				case 37:
					e.preventDefault();
					masterRow = -1;
					tbl_masterlist.page('previous').draw('page');
					tbl_masterlist.$('tr.highlight').removeClass('highlight');
					break;
				case 38:
					e.preventDefault();
					tbl_masterlist.$('tr.highlight').removeClass('highlight');
					masterRow--;
					if (masterRow < 0) { masterRow = $('#tbl_masterlist tbody tr').length-1; }
					$('#tbl_masterlist tbody tr:eq('+masterRow+')').addClass('highlight');
					break;
				case 39:
					e.preventDefault();
					masterRow = -1;
					tbl_masterlist.page('next').draw('page');
					tbl_masterlist.$('tr.highlight').removeClass('highlight');
					break;
				case 40:
					e.preventDefault();
					tbl_masterlist.$('tr.highlight').removeClass('highlight');
					masterRow++;
					if (masterRow > $('#tbl_masterlist tbody tr').length-1) { masterRow = 0; }
					$('#tbl_masterlist tbody tr:eq('+masterRow+')').addClass('highlight');
					break;
			}
		});


		$('#btn_add').on('click', function(){
			$('#frm_information').attr('action',baseurl+'Accounting/Template/insertTemplate');
			showForm(true);
			currentRow = 0;
		});

		$('#btn_back').on('click', function(){
			showForm(false);
		});

		$('#btn_save').on('click', function(){
			if($('#transaction_type').val().trim().length > 0){
				$('#frm_information').submit();
			}
		});

		$('#transaction_type').on('keydown', function(e){
			switch(e.keyCode){
				case 9:
					e.preventDefault();
					if ($(this).val().trim().length > 0) {
						showError('transaction_type', false);
						$('#tbl_template tbody tr').children(':eq('+((currentRow*col)+1)+')').find('select').focus();
					} else {
						$(this).focus();
						showError('transaction_type', true);
					}
					break;
				case 27: 
					e.preventDefault();
					showForm(false);
					break;
			}
		});

		$('#frm_information').submit(function(){
			$('.id').removeAttr('disabled');
		});

		function showForm(show){
			switch(show){
				case true:
					$('#frm_masterlist').hide();
					$('#frm_information').show();
					$('#transaction_type').val('');
					$('#transaction_type').focus();

					$('#tbl_template tbody').empty();
					var items = "<tr><td><input type='text' name='id[]' class='form-control id' disabled='disabled' value=''></td>"+
						"<td><select name='drcr[]' class='form-control drcr'><option value='Dr'>Debit</option><option value='Cr'>Credit</option></select></td>"+
						"<td><input type='text' name='account_code[]' class='form-control account_code'></td>"+
						"<td><input type='text' name='remarks[]' class='form-control remarks'></td></tr>";
					$('#tbl_template').append(items);
					break;
				case false:
					$('#frm_masterlist').show();
					$('#frm_information').hide();
					$('#err_transactiontype').text('');
					masterRow = -1;
					$('#tbl_masterlist_filter input').focus();
					tbl_masterlist.$('tr.highlight').removeClass('highlight');
					break;
			}
			$('.id').attr('disabled', 'disabled');
		}

		function showError(key, show){
			switch(key){
				case 'transaction_type':
					if (show==true) {
						$('#err_transactiontype').text('Transaction Type cannot be empty. Please fill in the blank.');
					}else{
						$('#err_transactiontype').text('');
					}
					break;
			}
		}
	//------------------------------------------------
	//datatable
		var tbl_accountcode = $('#tbl_accountcode').DataTable({
			'bInfo': false,
			'bSort': false,
		});
		$('#tbl_accountcode_filter input').bind('keydown', function(e){
			switch(e.keyCode){
				case 9:
					e.preventDefault();
					break;
				case 13:
					e.preventDefault();
					$('#tbl_accountcode tbody tr:eq('+accountRow+')').click();
					$('#tbl_template tbody tr').children(':eq('+((currentRow*col)+3)+')').find('input').focus();
					break;
				case 27:
					e.preventDefault();
					$('#frm_account .close').click();
					$('#tbl_template tbody tr').children(':eq('+((currentRow*col)+2)+')').find('input').focus();
					break;
				case 37:
					e.preventDefault();
					accountRow = 0;
					tbl_accountcode.page('previous').draw('page');
					tbl_accountcode.$('tr.highlight').removeClass('highlight');
					$('#tbl_accountcode tbody tr:eq('+accountRow+')').addClass('highlight');
					break;
				case 38:
					e.preventDefault();
					tbl_accountcode.$('tr.highlight').removeClass('highlight');
					accountRow--;
					if (accountRow < 0) { accountRow = $('#tbl_accountcode tbody tr').length-1; }
					$('#tbl_accountcode tbody tr:eq('+accountRow+')').addClass('highlight');
					break;
				case 39:
					e.preventDefault();
					accountRow = 0;
					tbl_accountcode.page('next').draw('page');
					tbl_accountcode.$('tr.highlight').removeClass('highlight');
					$('#tbl_accountcode tbody tr:eq('+accountRow+')').addClass('highlight');
					break;
				case 40:
					e.preventDefault();
					tbl_accountcode.$('tr.highlight').removeClass('highlight');
					accountRow++;
					if (accountRow > $('#tbl_accountcode tbody tr').length-1) { accountRow = 0; }
					$('#tbl_accountcode tbody tr:eq('+accountRow+')').addClass('highlight');
					break;
				default:
					accountRow = 0;
					tbl_accountcode.$('tr.highlight').removeClass('highlight');
					$('#tbl_accountcode tbody tr:eq('+accountRow+')').addClass('highlight');
					break;
			}
		});
		$('#tbl_accountcode tbody').on('click', 'tr', function(){
			var tbldata = tbl_accountcode.row(this).data();
			$('#tbl_template tbody tr').children(':eq('+((currentRow*col)+2)+')').find('input').val(tbldata[0]);
			$('#frm_account .close').click();
			$('#tbl_accountcode_filter input').val('');
		});

		$('#frm_account').on('shown.bs.modal',function(){
			$('#tbl_accountcode_filter input').val('');
			$('#tbl_accountcode_filter input').focus();
			accountRow = 0;
			tbl_accountcode.$('tr.highlight').removeClass('highlight');
			$('#tbl_accountcode tbody tr:eq('+accountRow+')').addClass('highlight');
		});



	//tbl_template	--------------------------------------------------------
		$('#tbl_template tbody').on('click', 'td', function(){
			currentRow = $(this).closest('tr').index();
		});

		$('#tbl_template tbody').on('click', '.account_code', function(e){
			$('#frm_account').modal('toggle');
			$('#txt_searchaccount').focus();
		});
		$('#tbl_template tbody').on('keydown', '.account_code', function(e){
			switch(e.keyCode){
				case 9:
					checkAccountCode();
					break;
				case 13:
					if ($(this).val().trim().length > 0) {
						checkAccountCode();
					} else {
						$('#frm_account').modal('toggle');
						$('#txt_searchaccount').focus();
					}
					break;
			}
		});

		$('#tbl_template tbody').on('keydown', '.remarks', function(e){
			switch(e.keyCode){
				case 9:
					e.preventDefault();
					currentRow++;
					if (currentRow < $('#tbl_template tbody tr').length) {
						$('#tbl_template tbody tr').children(':eq('+((currentRow*col)+1)+')').find('select').focus();
					} else {
						$('#btn_save').focus();
					}
					break;
				case 13:
					var newline = "<tr><td><input type='text' name='id[]' class='form-control id' disabled='disabled' value=''></td>"+
						"<td><select name='drcr[]' class='form-control drcr'><option value='Dr'>Debit</option><option value='Cr'>Credit</option></select></td>"+
						"<td><input type='text' name='account_code[]' class='form-control account_code'></td>"+
						"<td><input type='text' name='remarks[]' class='form-control remarks'></td></tr>";
					$('#tbl_template').append(newline);
					currentRow = $('#tbl_template tbody tr').length-1;
					$('#tbl_template tbody tr').children(':eq('+((currentRow*col)+1)+')').find('select').focus();
					break;
				case 46:
					e.preventDefault();
					if ($('#tbl_template tbody tr').length != 1) {
						if($('#tbl_template tbody tr').children(':eq('+(currentRow*col)+')').find('input').val() != ''){
							$('#tbl_template tbody tr').children(':eq('+((currentRow*col)+2)+')').find('input').val('');
							$('#tbl_template tbody tr').children(':eq('+((currentRow*col)+3)+')').find('input').val('');
						} else {
							$(this).closest('tr').remove();
							currentRow--;
							$('#tbl_template tbody tr').children(':eq('+((currentRow*col)+3)+')').find('input').focus();
						}
					} else {
						toastr.warning('Cannot Delete Last Row', 'System Warning!');
					}
					break;
			}
		});

		function checkAccountCode(){
			$.ajax({
				type: 'POST',
				url: baseurl+'Accounting/Template/checkAccountCode',
				dataType: 'json',
				data: {'account_code': $('#tbl_template tbody tr').children(':eq('+((currentRow*col)+2)+')').find('input').val()},
				success: function(data){
					if (data == false){
						$('#tbl_template tbody tr').children(':eq('+((currentRow*col)+2)+')').find('input').val('');
						$('#tbl_template tbody tr').children(':eq('+((currentRow*col)+2)+')').find('input').focus();
					} else {
						$('#tbl_template tbody tr').children(':eq('+((currentRow*col)+3)+')').find('input').focus()
					}
				},
				error: function(errorThrown){
					toastr.error('Account Code Error#:53972','Operation Failed');
					console.log(errorThrown);
				}
			});
		}

		//UPDATE ---------------------------------------------------------------
		$('#tbl_masterlist tbody').on('dblclick', 'tr', function(){
			$('#frm_information').attr('action', baseurl+'Accounting/Template/updateTemplate');
			$.ajax({
				type: 'POST',
				url: baseurl+'Accounting/Template/getTemplateByTransactionType',
				dataType: 'json',
				data: {'transaction_type': $(this).children(':eq(1)').text()},
				success: function(data){
					$('#transaction_type').val(data[0].transaction_type);
					$('#tbl_template tbody').empty();
					if (data != false) {
						var items = '';
						for(var i = 0; i <= data.length - 1; i++){
							items +=  "<tr><td><input type='text' name='id[]' class='form-control id' disabled='disabled' value='"+data[i].transaction_template_id+"''></td>";
							if (data[i].drcr == 'Dr') {
								items += "<td><select name='drcr[]' class='form-control drcr'><option value='Dr' selected>Debit</option><option value='Cr'>Credit</option></select></td>";
							} else {
								items += "<td><select name='drcr[]' class='form-control drcr'><option value='Dr'>Debit</option><option value='Cr' selected>Credit</option></select></td>";
							}
							items += "<td><input type='text' name='account_code[]' class='form-control account_code' value='"+data[i].account_code+"'></td>"+
							"<td><input type='text' name='remarks[]' class='form-control remarks' value='"+data[i].remarks+"'></td></tr>";
						}
					} else {
						items = "<tr><td><input type='text' name='id[]' class='form-control id' disabled='disabled' value=''></td>"+
						"<td><select name='drcr[]' class='form-control drcr'><option value='Dr'>Debit</option><option value='Cr'>Credit</option></select></td>"+
						"<td><input type='text' name='account_code[]' class='form-control account_code'></td>"+
						"<td><input type='text' name='remarks[]' class='form-control remarks'></td></tr>";
					}
					$('#tbl_template').append(items);
				},
				error: function(errorThrown){
					toastr.error('Get Template Error#87834','Operation Failed');
					console.log(errorThrown);
				}
			});
			showForm(true);
		});
		
	}
	return {
		init: function(){
			_init();
		}
	};
}();
jQuery(document).ready(function(){
	masterlist.init();
});