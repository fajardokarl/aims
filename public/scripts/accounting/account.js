var masterlist = function(){
	var _init = function(){
		var submit = false;
		
		var currentRow = 0;
//-----------------------------------------------
//BUTTONS
//-----------------------------------------------
		$(window).load(function(){
			$('#tbl_masterlist_filter input').focus();
		});

		$(document).on('keydown', function(e){
			switch(e.which){
				case 113:
					e.preventDefault();
					$('#btn_add').click();
					break;
			}
		});


		var tbl_masterlist = $('#tbl_masterlist').DataTable({
			'bPaginate': true,
			'bLengthChange': true,
			'bSort': false,
			'bFilter': true,

			fixedHeader: {
				header: false
			}
		});

		$('#tbl_masterlist_filter input').on('keydown', function(e){
			switch(e.which){
				case 9:
					e.preventDefault();
					break;
				case 37:
					e.preventDefault();
					tbl_masterlist.page('previous').draw('page');
					break;
				case 39:
					e.preventDefault();
					tbl_masterlist.page('next').draw('page');
			}
		});

		$('#tbl_masterlist tbody').on('click', '.status_action', function(){
			$('#mod_accountid').val($(this).closest('tr').children(':eq(0)').text());
			
			switch($(this).closest('tr').children(':eq(3)').text().trim()){
				case 'active':
					$('#mod_statusid').val('3');
					$('#btn_changestatus').text('Suspend');
					$('#btn_changestatus').removeClass('btn btn-circle green');
					$('#btn_changestatus').addClass('btn btn-circle red');
					break;
				case 'suspended':
					$('#mod_statusid').val('1');
					$('#btn_changestatus').text('Activate');
					$('#btn_changestatus').removeClass('btn btn-circle red');
					$('#btn_changestatus').addClass('btn btn-circle green');
					break;
			}
			$('#frm_status').modal('toggle');
		});

		$('#btn_add').on('click', function(){
			$('#frm_masterlist').hide();
			$('#frm_information').show();
			$('#account_name').val('');
			$('#account_code').val('');
			$('#account_code').focus();
			$('#account_id').val('');
			$('#code_error').text('');
			submit = false;
			currentRow = 0;
			$('#tbl_subaccount tbody').empty();
			var items = '<tr><td><input type="text" name="account_subsidiary_id[]" id="account_subsidiary_id" class="form-control" readonly="readonly" tabindex="-1"></td>'+
									'<td><input type="text" name="subsidiary_code[]" id="subsidiary_code" class="form-control subsidiary-code" autocomplete="off"></td>'+
									'<td><input type="text" name="subsidiary_description[]" id="subsidiary_description" class="form-control subsidiary-description"></td>'+
									'<td><select name="substatus[]" class="form-control" id="substatus">'+
									'<option value="1" selected>Active</option><option value="3">Suspended</option></select></td></tr>';
			$('#tbl_subaccount').append(items);
			$('#frm_information').attr('action', baseurl+'Accounting/Account/insertAccount');
		});

		$('#tbl_masterlist tbody').on('dblclick', 'tr', function(){
			$('#btn_delete').attr('disabled','disabled');
			$('#frm_information').attr('action', baseurl+'Accounting/Account/updateAccount');
			var tbldata = tbl_masterlist.row(this).data();
			$.ajax({
				type: 'POST',
				url: baseurl+'Accounting/Account/getAccountByID',
				dataType: 'json',
				data: {'account_id': tbldata[0]},
				success: function(data){
					$('#account_id').val(data[0].account_id);
					$('#account_code').val(data[0].account_code);
					$('#account_name').val(data[0].account_name);

					$.ajax({
						type: 'POST',
						url: baseurl+'Accounting/Account/getSubAccountByID',
						dataType: 'json',
						data: {'account_id': tbldata[0]},
						success: function(data2){
							$('#tbl_subaccount tbody').empty();
							if (data2 != false) {
								var items = '';
								for(var i = 0; i <= data2.length - 1; i++){
									items+= '<tr><td><input type="text" name="account_subsidiary_id[]" id="account_subsidiary_id" class="form-control" readonly="readonly" tabindex="-1" value="'+data2[i].account_subsidiary_id+'"></td>'+
										'<td><input type="text" name="subsidiary_code[]" id="subsidiary_code" class="form-control subsidiary-code" autocomplete="off" value="'+data2[i].subsidiary_code+'"></td>'+
										'<td><input type="text" name="subsidiary_description[]" id="subsidiary_description" class="form-control subsidiary-description" value="'+data2[i].subsidiary_description+'"></td>'+
										'<td><select name="substatus[]" class="form-control" id="substatus">';
										switch(data2[i].status_id){
											case '1':
												items+= '<option value="1" selected>Active</option><option value="3">Suspended</option></select></td></tr>';
												break;
											case '3':
												items+= '<option value="1">Active</option><option value="3" selected>Suspended</option></select></td></tr>';
												break;
										}
								}
							} else {
								items = '<tr><td><input type="text" name="account_subsidiary_id[]" id="account_subsidiary_id" class="form-control" readonly="readonly" tabindex="-1"></td>'+
									'<td><input type="text" name="subsidiary_code[]" id="subsidiary_code" class="form-control subsidiary-code" autocomplete="off"></td>'+
									'<td><input type="text" name="subsidiary_description[]" id="subsidiary_description" class="form-control subsidiary-description"></td>'+
									'<td><select name="substatus[]" class="form-control" id="substatus">'+
									'<option value="1" selected>Active</option><option value="3">Suspended</option></select></td></tr>';
							}
							$('#tbl_subaccount').append(items);
						},
						error: function(errorThrown){
							toastr.error('Sub Account Error#41121','Operation Failed!');
							console.log(errorThrown);
						}
					});
				},
				error: function(errorThrown){
					toastr.error('Account ID Error#43313','Operation Failed!');
					console.log(errorThrown);
				}
			});

			currentRow = 0;
			$('#frm_masterlist').hide();
			$('#frm_information').show();
		});

		$('#btn_back').on('click', function(){
			$('#frm_masterlist').show();
			$('#frm_information').hide();
			$('#account_code').val('');
			$('#account_name').val('');
			$('#account_id').val('');

			tbl_masterlist.$('tr.highlight').removeClass('highlight');
			$('#btn_delete').attr('disabled','disabled');
		});

		$('#btn_save').on('click', function(){
			submit = true;
			checkFields();
			checkSubCode();
			if (submit) {
				$('#frm_information').submit();
			}
		}).on('keydown', function(e){
			switch(e.which){
				case 9:
					e.preventDefault();
					$('#btn_back').focus();
					break;
			}
		});

//----------------------------------------------
//INPUT
//----------------------------------------------
		$('#account_code').on('keydown', function(e){
			switch(e.keyCode){
				case 9:
				case 13:
					e.preventDefault();
					checkSubCode();
					break;
				case 27:
					e.preventDefault();
					$('#btn_back').click();
					break;
			}
		});

		function checkSubCode(){
			$.ajax({
				type: 'POST',
				url: baseurl+'Accounting/Account/checkSubCode',
				dataType: 'json',
				data: {'account_code': $('#account_code').val(), 'account_id': $('#account_id').val()},
				success: function(data){
					console.log('data:'+data);
					console.log('submit:'+submit);
					if(data){
						$('#code_error').text('Duplicate Code Found. Please try another.');
						$('#account_code').focus();
						submit = false;
					} else {
						$('#code_error').text('');
						$('#account_name').focus();					
						submit = true;
					}
				},
				error: function(errorThrown){
					toastr.error('Account Code Error#98533','Operation Failed');
					console.log(errorThrown);
				}
			});
		}

		function checkFields(){
			if ($('#account_code').val().trim().length > 0 && $('#account_name').val().trim().length > 0) {
				submit = true;
			} else {
				submit = false;
			}
		}

		$('#account_name').on('keydown', function(e){
			switch(e.keyCode){
				case 9:
				case 13:
					e.preventDefault();
					if ($(this).val().trim().length > 0) {
						$('#tbl_subaccount tbody tr').children(':eq(1)').find('input').focus();
						$('#name_error').text('');
					} else {
						$(this).focus();
						$('#name_error').text('Account Name cannot be empty.')
					}
			}
		});
		
//special magic skadoosh-------------------------------------------------
		$('#tbl_subaccount tbody').on('click', 'tr', function(){
			currentRow = $(this).closest('tr').index();
		});

		

		/*$('#tbl_subaccount tbody').on('keydown', '.subsidiary-code', function(e){
			switch(e.keyCode){
				case 9:
				case 13:
					e.preventDefault();
					checkSubCodeSub();
					break;
			}
		});

		function checkSubCodeSub(){
			$.ajax({
				type: 'POST',
				url: baseurl+'Accounting/Account/checkSubCodeSub',
				dataType: 'json',
				data: {'sub_code': $('#tbl_subaccount tbody tr').children(':eq('+((currentRow*4)+1)+')').find('input').val()},
				success: function(data){
					if (data) {
						$('#code_error2').text('Duplicate Subsidiary Code Found. Please try another.');
						$('#tbl_subaccount tbody tr').children('eq('+((currentRow*4)+1)+')').find('input').focus();
					} else {
						$('#code_error2').text('');
						$('#tbl_subaccount tbody tr').children('eq('+((currentRow*4)+1)+')').find('input').focus();
					}
				}
			});
		}*/

		$('#tbl_subaccount tbody').on('keydown', '.subsidiary-description', function(e){
			switch(e.keyCode){
				case 13:
					e.preventDefault();
					var newrow = '<tr><td><input type="text" name="account_subsidiary_id[]" id="account_subsidiary_id" class="form-control" readonly="readonly" tabindex="-1"></td>'+
						'<td><input type="text" name="subsidiary_code[]" id="subsidiary_code" class="form-control subsidiary-code" autocomplete="off"></td>'+
						'<td><input type="text" name="subsidiary_description[]" id="subsidiary_description" class="form-control subsidiary-description"></td>'+
						'<td><select name="substatus[]" class="form-control" id="substatus">'+
						'<option value="1" selected>Active</option><option value="3">Suspended</option></select></td></tr>';
					$('#tbl_subaccount').append(newrow);
					currentRow = $('#tbl_subaccount tbody tr').length - 1;
					$('#tbl_subaccount tbody tr').children(':eq('+((currentRow*4)+1)+')').find('input').focus();
					break;
			}
		});
	}//end of _init
	return {
		init: function(){
			_init();
		}
	};
}();
jQuery(document).ready(function(){
	masterlist.init();
});