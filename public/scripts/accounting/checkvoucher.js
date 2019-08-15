var masterlist = function (){
	var _init = function(){
		var masterRow = -1, curRow = 0, col=3, tabRow = 0;
		var d = new Date();
		var month = ((d.getMonth()+1)<10? '0'+(d.getMonth()+1):(d.getMonth()+1));
		var day = ((d.getDate())<10? '0'+(d.getDate()):(d.getDate()))

		$(window).load(function(){
			$('#startdate').datepicker({
				format: 'yyyy-mm-dd',
				autoclose: true,
			}).datepicker('setDate', d.getFullYear()+"-"+month+"-01");
			$('#enddate').datepicker({
				format: 'yyyy-mm-dd',
				autoclose: true,
			}).datepicker('setDate', d.getFullYear()+"-"+month+"-"+new Date(d.getFullYear(),d.getMonth()+1,0));
			$('#btn_searchrange').trigger('click');

			$('#check_date').datepicker({
				format: 'yyyy-mm-dd',
				autoclose: true
			}).datepicker('setDate', d.getFullYear()+"-"+month+"-"+day);

			$('#tbl_masterlist_filter input').focus();
		});

		$(document).on('keydown', function(e){
			switch(e.which){
				/*case 27:
					e.preventDefault();
					formControl('close');
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
			switch(e.keyCode){
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
					masterRow = -1
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



		var tbl_ric = $('#tbl_ric').DataTable({
			'bPaginate': true,
			'bLengthChange': true,
			'bSort': true,
			'aLengthMenu': [[10,50,100,-1],[10,50,100,'All']],
			'iDisplayLength': 10,
			fixedHeader: {
				header: false
			}
		});
		$('#tbl_ric_filter input').bind('keydown', function(e){
			switch(e.keyCode){
				case 13:
					e.preventDefault();
					$('#tbl_ric tbody tr:eq('+tabRow+')').click();
					break;
				case 27:
					e.preventDefault();
					formMdlRic(false);
					break;
				case 37:
					e.preventDefault();
					tabRow = 0;
					tbl_ric.page('previous').draw('page');
					tbl_ric.$('tr.highlight').removeClass('highlight');
					$('#tbl_ric tbody tr:eq('+tabRow+')').addClass('highlight');
					break;
				case 38:
					e.preventDefault();
					tbl_ric.$('tr.highlight').removeClass('highlight');
					tabRow--;
					if(tabRow < 0 ) { tabRow = $('#tbl_ric tbody tr').length-1; }
					$('#tbl_ric tbody tr:eq('+tabRow+')').addClass('highlight');
					break;
				case 39:
					e.preventDefault();
					tabRow = 0;
					tbl_ric.page('next').draw('page');
					tbl_ric.$('tr.highlight').removeClass('highlight');
					$('#tbl_ric tbody tr:eq('+tabRow+')').addClass('highlight');
					break;
				case 40:
					e.preventDefault();
					tbl_ric.$('tr.highlight').removeClass('highlight');
					tabRow++;
					if(tabRow > $('#tbl_ric tbody tr').length-1){tabRow = 0; }
					$('#tbl_ric tbody tr:eq('+tabRow+')').addClass('highlight');
					break;
			}
		});
		$('#tbl_ric tbody').on('click','tr', function(){
			formMdlRic(false);
			var ric_data = tbl_ric.row(this).data();
			displayRicid(ric_data[0]);
		});

		$('#ric_id').on('click', function(){
			formMdlRic(true);
		}).on('keydown', function(e){
			switch(e.keyCode){
				case 9:
					e.preventDefault();
					if ($(this).val().length == 0) {
						$('#check_date').focus();
					} else {
						displayRicid($(this).val());
					}
					break;
				case 13:
					e.preventDefault();
					formMdlRic(true);
					break;
				case 27:
					e.preventDefault();
					formControl('close');
					break;
			}
		});

		function displayRicid(ricid){
			$.ajax({
				type: 'POST',
				url: baseurl+'Accounting/Checkvoucher/getRICByID',
				dataType: 'json',
				data: {'ricid': ricid},
				success: function(data){
					if (data) {
						$('#tbl_cvdetail tbody').empty();
						var items = '';
						var totalamount = 0;
						for (var i = 0; i <= data.length-1; i++){
							items+= '<tr><td><input type="text" name="cv_detail_id[]" class="form-control cv_detail_id" disabled></td>'+
								'<td><input type="text" name="particular[]" class="form-control particular" value="'+data[i].particular+'"  /></td>'+
								'<td><input type="text" name="amount[]" class="form-control amount" value="'+data[i].amount+'" /></td></tr>';
							totalamount = parseFloat(totalamount) + parseFloat(data[i].amount);
						}
						$('#tbl_cvdetail').append(items);
						$('#ric_id').val(data[0].ric_id);
						$('#check_amount').val(parseFloat(totalamount).toFixed(2));
						$('#payee_table').val('employee');
						$('#payee_id').val(data[0].employee_id)
						$('#payee').val(data[0].employee);
						$('#check_date').focus();
					} else {
						$('#ric_id').val('');
						$('#ric_id').focus();
					}
				},
				error: function(errorThrown){
					toastr.error('RIC Error#14474','Operation Failed');
					console.log(errorThrown);
				}
			});
		}





		$('#btn_searchrange').on('click', function(){
			$.ajax({
				type: 'POST',
				url: baseurl+'Accounting/Checkvoucher/getCheckVoucherByRange',
				dataType: 'json',
				data: {'startdate': $('#startdate').val(), 'enddate': $('#enddate').val()},
				success: function(data){
					tbl_masterlist.clear().draw();
					for (var i = 0; i <= data.length-1; i++) {
						tbl_masterlist.row.add([
							data[i].check_voucher_id,
							data[i].ric_id,
							data[i].bank_name,
							data[i].reference_number,
							data[i].payee,
							data[i].check_amount,
							data[i].payment_type.charAt(0).toUpperCase()+data[i].payment_type.slice(1),
							data[i].prepared,
							data[i].check_voucher_date,
							data[i].check_date
							]).draw(false);
					}
				},
				error: function(errorThrown){
					toastr.error('Check Voucher Range Error#12445','Operation Failed');
					console.log(errorThrown);
				}
			});
			$('#tbl_masterlist_filter input').focus();
		});


		$('#btn_add').on('click', function(){
			formControl('insert');
			$('#ric_id').focus();
		});

		$('#btn_back').on('click', function(){
			formControl('close');
		});

		$('#btn_save').on('click', function(){
			$('#frm_information').submit();
		}).on('keydown', function(e){
			if(e.keyCode == 9){
				e.preventDefault();
				$('#btn_back').focus();
			}
		});

		
		

//update
		$('#tbl_masterlist tbody').on('dblclick', 'tr', function(){
			var cvid = $(this).children(':eq(0)').text();
			$.ajax({
				type: 'POST',
				url: baseurl+'Accounting/Checkvoucher/getCVByID',
				dataType: 'json',
				data: {'cvid': cvid},
				success: function(data){
					$('#check_voucher_id').val(data[0].check_voucher_id);
					$('#check_voucher_date').val(data[0].check_voucher_date.substr(0,10));
					$('#ric_id').val(data[0].ric_id);
					$('#check_date').val(data[0].check_date.substr(0,10));
					$('#bank_id').val(data[0].bank_id);
					$('#reference_number').val(data[0].reference_number);
					$('#payee_table').val(data[0].payee_table);
					$('#payee_id').val(data[0].payee_id);
					$('#payee').val(data[0].payee);
					$('#check_amount_words').val(data[0].check_amount_words);
					$('#check_amount').val(data[0].check_amount);
					$('#received_from').val(data[0].received_from);
					$('#payment_type').val(data[0].payment_type);
					$('#prepared_by').val(data[0].prepared_by);

					var formupdate = (data[0].action_status == 'Disapproved') ? true : false;

					$.ajax({
						type: 'POST',
						url: baseurl+'Accounting/Checkvoucher/getCVDetailByID',
						dataType: 'json',
						data: {'cvid': cvid},
						success: function(dtdetail){
							$('#tbl_cvdetail tbody').empty();
							var items = '';
							if (!dtdetail) {
								items+= '<tr><td><input type="text" name="cv_detail_id[]" class="form-control cv_detail_id" disabled></td>'+
									'<td><input type="text" name="particular[]" class="form-control particular"></td>'+
									'<td><input type="text" name="amount[]" class="form-control amount"></td></tr>';
							} else {
								if (formupdate) {
									for (var i = 0; i <= dtdetail.length-1; i++) {
										items+= '<tr><td><input type="text" name="cv_detail_id[]" class="form-control cv_detail_id" disabled value="'+dtdetail[i].check_voucher_detail_id+'"></td>'+
											'<td><input type="text" name="particular[]" class="form-control particular" value="'+dtdetail[i].particular+'" /></td>'+
											'<td><input type="text" name="amount[]" class="form-control amount" value="'+dtdetail[i].amount+'" /></td>';
									}
								} else {
									for (var i = 0; i <= dtdetail.length-1; i++) {
									items+= '<tr><td><input type="text" name="cv_detail_id[]" class="form-control cv_detail_id" disabled value="'+dtdetail[i].check_voucher_detail_id+'"></td>'+
										'<td><input type="text" name="particular[]" class="form-control particular" value="'+dtdetail[i].particular+'" disabled /></td>'+
										'<td><input type="text" name="amount[]" class="form-control amount" value="'+dtdetail[i].amount+'" disabled /></td>';
									}
								}
							}
							$('#tbl_cvdetail').append(items);
						},
						error: function(errorThrown){
							toastr.error('Check Voucher Detail Error#10012','Operation Failed');
							console.log(errorThrown);
						}
					});

					$.ajax({
						type: 'POST',
						url: baseurl+'Accounting/Checkvoucher/getCVActionByID',
						dataType: 'json',
						data: {'cvid': cvid},
						success: function(dtaction){
							if (dtaction) {
								if (dtaction[0].action_id == '6') {
									$('#approved_by').val(dtaction[0].action_employee_id);
								} else {
									$('#approved_by').val('0');
								}
							} else {
								$('#approved_by').val('0');
							}
						},
						error: function(errorThrown){
							toastr.error('Check Voucher Action Error#78826','Operation Failed');
							console.log(errorThrown);
						}
					});

					$.ajax({
						type: 'POST',
						url: baseurl+'Accounting/Checkvoucher/getUserRole',
						dataType: 'json',
						data: {'cvid': cvid},
						success: function(dtuser){
							switch(data[0].action_status){
								case 'Submitted':
									if(dtuser.role_code == '3'){
										formControl('approve');
									} else {
										formControl('view');
									}
									break;
								case 'Disapproved':
									if ($('#user_employee_id').val() == $('#prepared_by').val()) {
										formControl('update');
									} else {
										formControl('view');
									}
									break;
								case 'Approved':
									formControl('approved');
									break;
							}
						},
						error: function(errorThrown){
							toastr.error('User Role Error#74145','Operation Failed');
							console.log(errorThrown);
						}
					});
				},
				error: function(errorThrown){
					toastr.error('Check Voucher Error#10011','Operation Failed');
					console.log(errorThrown);
				}
			})
		});

		function formMdlRic(show){
			switch(show){
				case true:
					$('#mdl_ricid').modal('toggle');
					setTimeout(function(){ 
						$('div#tbl_ric_filter input').focus();
						tabRow = 0;
						$('#tbl_ric tbody tr:eq('+tabRow+')').addClass('highlight');
					}, 300);

					break;
				case false:
					$('#mdl_ricid .close').click();
					$('#ric_id').focus();
					tbl_ric.$('tr.highlight').removeClass('highlight');
					break;
			}
		}

		function formControl(show){
			switch(show){
				case 'insert':
					$('#frm_masterlist').hide();
					$('#frm_information').show();
					$('#frm_information').attr('action', baseurl+'Accounting/Checkvoucher/insertCV');
			
					$('#frm_information').find('input, select').removeAttr('disabled');
					$('#check_voucher_id').attr('disabled', 'disabled');
					$('#check_voucher_date').attr('disabled', 'disabled');
					$('#prepared_by').attr('disabled', 'disabled');
					$('#approved_by').attr('disabled', 'disabled');
			
					$('#h3_actionstatus').text('');
					$('#check_voucher_id').val('');
					$('#check_voucher_date').val(d.getFullYear()+"-"+month+"-"+day);
					$('#ric_id').val('');
					$('#bank_id').val('0');
					$('#reference_number').val('');
					$('#payee_table').val('');
					$('#payee_id').val('');
					$('#payee').val('');
					$('#check_amount_words').val('');
					$('#check_amount').val('');
					$('#received_from').val('');
					$('#payment_type').val('full');
					$('#prepared_by').val($('#user_employee_id').val());
					$('#approved_by').val('0');

					$('#tbl_cvdetail tbody').empty();
					var items = '<tr><td><input type="text" name="cv_detail_id[]" class="form-control cv_detail_id" disabled/></td>'+
									'<td><input type="text" name="particular[]" class="form-control particular" /></td>'+
									'<td><input type="text" name="amount[]" class="form-control amount" /></td></tr>';
					$('#tbl_cvdetail').append(items);
			
					$('#btn_save').show();
					$('#btn_approve').hide();
					$('#btn_disapprove').hide();
					break;
				case 'approve':
					$('#frm_masterlist').hide();
					$('#frm_information').show();
					$('#frm_information').find('input, select').attr('disabled', 'disabled');
					$('#h3_actionstatus').text('');

					$('#btn_save').hide();
					$('#btn_approve').show();
					$('#btn_disapprove').show();
					break;
				case 'approved':
					$('#frm_masterlist').hide();
					$('#frm_information').show();
					$('#frm_information').find('input, select').attr('disabled', 'disabled');
					$('#h3_actionstatus').text('APPROVED');

					$('#btn_save').hide();
					$('#btn_approve').hide();
					$('#btn_disapprove').hide();
					break;
				case 'update':
					$('#frm_masterlist').hide();
					$('#frm_information').show();
					$('#frm_information').attr('action', baseurl+'Accounting/Checkvoucher/updateCV');
					
					$('#btn_save').show();
					$('#btn_approve').hide();
					$('#btn_disapprove').hide();
					break;
				case 'view':
					$('#frm_masterlist').hide();
					$('#frm_information').show();
					$('#frm_information').find('input, select').attr('disabled', 'disabled');
					$('#h3_actionstatus').text('');

					$('#btn_save').hide();
					$('#btn_approve').hide();
					$('#btn_disapprove').hide();
					break;
				case 'close':
					$('#frm_masterlist').show();
					$('#frm_information').hide();

					$('#ric_id').val('');
					$('#tbl_masterlist_filter input').focus();
					masterRow = -1;
					tbl_masterlist.$('tr.highlight').removeClass('highlight');
					break;
			}
		}


//Detail Table Magic Shit Memengskie
		$('#tbl_cvdetail tbody').on('click', 'td', function(){
			curRow = $(this).closest('tr').index();
		});

		$('#tbl_cvdetail tbody').on('keydown', '.particular', function(e){
			switch(e.keyCode){
				case 37:
					e.preventDefault();
					$('#tbl_cvdetail tbody tr').children(':eq('+((curRow*col)+2)+')').find('input').focus();
					break;
				case 38:
					e.preventDefault();
					curRow--;
					if(curRow < 0){
						curRow = $('#tbl_cvdetail tbody tr').length-1;
					}
					$('#tbl_cvdetail tbody tr').children(':eq('+((curRow*col)+1)+')').find('input').focus();
					break;
				case 39:
					e.preventDefault();
					$('#tbl_cvdetail tbody tr').children(':eq('+((curRow*col)+2)+')').find('input').focus();
					break;
				case 40:
					e.preventDefault();
					curRow++;
					if(curRow > $('#tbl_cvdetail tbody tr').length-1){
						curRow = 0;
					}
					$('#tbl_cvdetail tbody tr').children(':eq('+((curRow*col)+1)+')').find('input').focus();
					break;
			}
		});

		$('#tbl_cvdetail tbody').on('keydown', '.amount', function(e){
			switch(e.keyCode){
				case 9: 
					e.preventDefault();
					curRow++;
					if(curRow < $('#tbl_cvdetail tbody tr').length){
						$('#tbl_cvdetail tbody tr').children(':eq('+((curRow*col)+1)+')').find('input').focus();
					} else {
						$('#btn_save').focus();
					}
					($(this).val().length > 0) ? $(this).val(parseFloat($(this).val()).toFixed(2)): $(this).val('');
					break;
				case 13:
					e.preventDefault();
					var newrow = '<tr><td><input type="text" name="cv_detail_id[]" class="form-control cv_detail_id" disabled></td>'+
						'<td><input type="text" name="particular[]" class="form-control particular"></td>'+
						'<td><input type="text" name="amount[]" class="form-control amount"></td></tr>';
					$('#tbl_cvdetail').append(newrow);
					curRow = $('#tbl_cvdetail tbody tr').length-1;
					$('#tbl_cvdetail tbody tr').children(':eq('+((curRow*col)+1)+')').find('input').focus();
					($(this).val().length > 0) ? $(this).val(parseFloat($(this).val()).toFixed(2)): $(this).val('');
					break;
				case 37:
					e.preventDefault();
					$('#tbl_cvdetail tbody tr').children(':eq('+((curRow*col)+1)+')').find('input').focus();
					break;
				case 38:
					e.preventDefault();
					curRow--;
					if(curRow < 0){
						curRow = $('#tbl_cvdetail tbody tr').length-1;
					}
					$('#tbl_cvdetail tbody tr').children(':eq('+((curRow*col)+2)+')').find('input').focus();
					break;
				case 39:
					e.preventDefault();
					$('#tbl_cvdetail tbody tr').children(':eq('+((curRow*col)+1)+')').find('input').focus();
					break;
				case 40:
					e.preventDefault();
					curRow++;
					if(curRow > $('#tbl_cvdetail tbody tr').length-1){
						curRow = 0;
					}
					$('#tbl_cvdetail tbody tr').children(':eq('+((curRow*col)+2)+')').find('input').focus();
					break;
				case 46:
					e.preventDefault();
					if($('#tbl_cvdetail tbody tr').length != 1){
						if($('#tbl_cvdetail tbody tr').children(':eq('+((curRow*col))+')').find('input').val() != ''){
							$('#tbl_cvdetail tbody tr').children(':eq('+((curRow*col)+1)+')').find('input').val('');
							$('#tbl_cvdetail tbody tr').children(':eq('+((curRow*col)+2)+')').find('input').val('');
						} else {
							$(this).closest('tr').remove();
							curRow--;
							$('#tbl_cvdetail tbody tr').children(':eq('+((curRow*col)+1)+')').find('input').focus();
						}
					} else {
						toastr.warning('Cannot Delete Last Row', 'System Warning!');
					}
					break;
				default:
					break;
			}
		}).on('keyup', '.amount', function(e){
			if ($(this).val().length > 0) {
					calcTotal();
			}
		});

		function calcTotal(){
			var total = 0;
			$('.amount').each(function(index){
				var str = $(this).val();
				if (str.length < 1) {
					total = parseFloat(total) + parseFloat('0');
				} else {
					total = parseFloat(total) + parseFloat($(this).val());
				}
			});
			$('#check_amount').val(parseFloat(total).toFixed(2));
		}

		$('#frm_information').on('submit', function(){
			$('#check_voucher_id').removeAttr('disabled');
			$('.cv_detail_id').removeAttr('disabled');
		});

		$('#btn_approve').on('click', function(){
			var actionstatus = 'Submitted';
			$.ajax({
				type: 'POST',
				url: baseurl+'Accounting/Checkvoucher/checkActionStatus',
				dataType: 'json',
				data: {'action_status': actionstatus, 'cvid': $('#check_voucher_id').val()},
				success: function(data){
					if(data){
						$('#frm_information').attr('action', baseurl+'Accounting/Checkvoucher/approveCV');
						$('#frm_information').submit();
					} else {
						window.location.replace(baseurl+'Accounting/Checkvoucher');
					}
				},
				error: function(errorThrown){
					toastr.error('Check Action Status Error#14578','Operation Failed');
					console.log(errorThrown);
				}
			});
		});

		$('#btn_disapprove').on('click', function(){
			var actionstatus = 'Submitted';
			console.log($('#check_voucher_id').val());
			$.ajax({
				type: 'POST',
				url: baseurl+'Accounting/Checkvoucher/checkActionStatus',
				dataType: 'json',
				data: {'action_status': actionstatus, 'cvid': $('#check_voucher_id').val()},
				success: function(data){
					if (data) {
						$('#frm_information').attr('action', baseurl+'Accounting/Checkvoucher/disapproveCV');
						$('#frm_information').submit();
					} else {
						window.location.replace(baseurl+'Accounting/Checkvoucher');
					}
				},
				error: function(errorThrown){
					toastr.error('Check Action Status Error#14579','Operation Failed');
					console.log(errorThrown);
				}
			});
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