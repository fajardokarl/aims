var masterlist = function(){
	var _init = function(){
		var masterRow = -1, curRow = 0, col=3;
		var d = new Date();
		var month = ((d.getMonth()+1)<10? '0'+(d.getMonth()+1):(d.getMonth()+1));
		var day = ((d.getDate()+1)<10? '0'+(d.getDate()):(d.getDate()));

		$(window).load(function(){
			$('#startdate').datepicker({
				format: 'yyyy-mm-dd',
				autoclose: true,
			}).datepicker('setDate', d.getFullYear()+'-'+month+'-01');
			$('#enddate').datepicker({
				format: 'yyyy-mm-dd',
				autoclose: true,
			}).datepicker('setDate', d.getFullYear()+'-'+month+'-'+new Date(d.getFullYear(),d.getMonth()+1,0));
			$('#btn_searchrange').trigger('click');
		});

		$(document).on('keydown', function(e){
			switch(e.which){
				case 27:
					e.preventDefault();
					$('#btn_back').click();
					break;
				case 113:
					e.preventDefault();
					$('#btn_add').click();
					break;
			}
		});

		$('#btn_searchrange').on('click', function(){
			$.ajax({
				type: 'POST',
				url: baseurl+'Accounting/Ric/getRIC',
				dataType: 'json',
				data: {'begin': $('#startdate').val(), 'end': $('#enddate').val()},
				success: function(data){
					tbl_masterlist.clear().draw();
					for (var i = 0; i <= data.length-1; i++){
						tbl_masterlist.row.add([
							data[i].ric_id,
							data[i].employee,
							data[i].ric_date.substr(0,10),
							data[i].department,
							data[i].purpose,
							data[i].prepared,
							data[i].requested,
							data[i].action_status,
							data[i].cancelled,
						]).draw(false);
					}
				},
				error: function(errorThrown){
					toastr.error('RIC Range Error#10101','Operation Failed');
					console.log(errorThrown);
				}
			});
			$('#tbl_masterlist_filter input').focus();
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

		$('#btn_add').click(function(){
			formControl('add');
			$('#frm_information').attr('action', baseurl+'Accounting/Ric/insertRIC');
		});

		$('#btn_back').click(function(){
			formControl(false);
			masterRow = -1;
		});

		$('#btn_save').click(function(){
			checkError('all');
		}).on('keydown', function(e){
			switch(e.keyCode){
				case 9:
					e.preventDefault();
					$('#btn_back').focus();
					break;
			}
		});

		$('#frm_information').on('submit', function(){
			$('#ric_id').removeAttr('readonly');
			$('#ric_id').removeAttr('disabled');
			$('#ric_date').removeAttr('readonly');
			$('#prepared_by').removeAttr('disabled');
			$('.ric_detail_id').removeAttr('disabled');
			//$('#department_id').removeAttr('readonly');
			$('#verified_by').removeAttr('disabled');
			$('#approved_by').removeAttr('disabled');
			$('#user_employee_id').removeAttr('disabled');
			$('#user_id').removeAttr('disabled');
		});	

		$('#tbl_masterlist tbody').on('dblclick', 'tr', function(){
			$('#frm_information').attr('action', baseurl+'Accounting/Ric/updateRIC');
			var ricid = $(this).children(':eq(0)').text();
			$.ajax({
				type: 'POST',
				url: baseurl+'Accounting/Ric/getRICByID',
				dataType: 'json',
				data: {'ricid': ricid},
				success: function(data){
					$('#ric_id').val(data[0].ric_id);
					$('#employee_id').val(data[0].employee_id);
					//$('#ric_date').val(data[0].ric_date.substr(0,10));
					$('#ric_date').val(data[0].ric_date);	
					$('#department_id').val(data[0].department_id);
					$('#purpose').val(data[0].purpose);
					$('#prepared_by').val(data[0].prepared_by);
					$('#requested_by').val(data[0].requested_by);

					var formupdate;
					if (data[0].is_cancelled == 1) {
						formupdate = false;
					} else {
						if (data[0].action_status == 'Denied' || data[0].action_status == 'Disapproved') {
							formupdate = true;
						} else {
							formupdate = false;
						}
					}

					$.ajax({
						type: 'POST',
						url: baseurl+'Accounting/Ric/getRICDetailByID',
						dataType: 'json',
						data: {'ricid': ricid},
						success: function(dtdetail){
							$('#tbl_ricdetail tbody').empty();
							var items = '';
							if(!formupdate){
								for (var i = 0; i <= dtdetail.length-1; i++) {
									items+= '<tr><td><input type="text" name="ric_detail_id[]" class="form-control ric_detail_id" disabled value="'+dtdetail[i].ric_detail_id+'"></td>'+
									'<td><input type="text" name="particular[]" class="form-control particular" value="'+dtdetail[i].particular+'" disabled></td>'+
									'<td><input type="number" name="amount[]" class="form-control amount" value="'+dtdetail[i].amount+'" disabled></td></tr>';
								}								
							} else {
								for (var i = 0; i <= dtdetail.length-1; i++) {
									items+= '<tr><td><input type="text" name="ric_detail_id[]" class="form-control ric_detail_id" disabled value="'+dtdetail[i].ric_detail_id+'"></td>'+
									'<td><input type="text" name="particular[]" class="form-control particular" value="'+dtdetail[i].particular+'"></td>'+
									'<td><input type="number" name="amount[]" class="form-control amount" value="'+dtdetail[i].amount+'"></td></tr>';
								}
							}
							$('#tbl_ricdetail').append(items);
						},
						error: function(errorThrown){
							toastr.error('RIC Detail Masterlist Error#10015', 'Operation Failed');
							console.log(errorThrown);
						}
					});


					$.ajax({
						type: 'POST',
						url: baseurl+'Accounting/Ric/getAttachmentByRicid',
						dataType: 'json',
						data: {'ricid': ricid},
						success: function(dtattach){
							$('#tbl_attachment tbody').empty();
							var items = '';
							if (!formupdate) {
								for (var i = 0; i <= dtattach.length-1; i++) {
									items += '<tr><td><input type="text" name="attachment_id[]" class="form-control" value="'+dtattach[i].attachment_id+'" readonly tabindex="-1"></td>'+
									'<td><input type="text" name="filename[]" class="form-control" value="'+dtattach[i].filename+'" readonly tabindex="-1"></td>'+
									'<td><button type="button" name="btn_view" id="btn_view" class="btn btn-circle green btn_view">View</button></td>'+
									'<td><button type="button" name="btn_remove" id="btn_remove" class="btn btn-circle red btn_remove" disabled>Remove</button></td></tr>';
								}
							} else {
								for (var i = 0; i <= dtattach.length-1; i++) {
									items += '<tr><td><input type="text" name="attachment_id[]" class="form-control" value="'+dtattach[i].attachment_id+'" readonly tabindex="-1"></td>'+
									'<td><input type="text" name="filename[]" class="form-control" value="'+dtattach[i].filename+'" readonly tabindex="-1"></td>'+
									'<td><button type="button" name="btn_view" id="btn_view" class="btn btn-circle green btn_view">View</button></td>'+
									'<td><button type="button" name="btn_remove" id="btn_remove" class="btn btn-circle red btn_remove">Remove</button></td></tr>';
								}
							}
							$('#tbl_attachment').append(items);
						}
					});

					$.ajax({
						type: 'POST',
						url: baseurl+'Accounting/Ric/getRICActionByID',
						dataType: 'json',
						data: {'ricid': ricid},
						success: function(dtaction){
							if (dtaction) {
								switch(dtaction[0].action_id){
									case '6': 
										$('#verified_by').val(dtaction[1].action_employee_id);
										$('#approved_by').val(dtaction[0].action_employee_id);
										break;
									case '1':
										$('#verified_by').val(dtaction[0].action_employee_id);
										$('#approved_by').val('0');
										break;
									default:
										$('#verified_by').val('0');
										$('#approved_by').val('0');
										break;
								}
							} else {
								$('#verified_by').val('0');
								$('#approved_by').val('0');
							}
						},
						error: function(errorThrown){
							toastr.error('RIC Action Error#78825', 'Operation Failed');
							console.log(errorThrown);
						},
					});


					$.ajax({
						type: 'POST',
						url: baseurl+'Accounting/Ric/getUserRole',
						dataType: 'json',
						data: {'ricid': ricid},
						success: function(dtuser){
							console.log(ricid);
							console.log(data[0]);
							console.log(dtuser);
							if (data[0].is_cancelled == 1) {
								formControl('cancelled');
							} else {
								switch(data[0].action_status){
									case 'Submitted':
										if (dtuser.role_code == '2' && data[0].department_id == dtuser.department_id) {
											formControl('verify');
										} else {
											formControl('view');
										}
										break;
									
									case 'Verified':
										if (dtuser.role_code == '3' && data[0].department_id == dtuser.department_id) {
											formControl('approve');
										} else {
											formControl('view');
										}
										break;
									
									case 'Denied':
										if($('#user_employee_id').val() == $('#prepared_by').val()){
											formControl('update');
										} else {
											formControl('view');
										}
										break;

									case 'Approved':
										formControl('approved');
										break;

									case 'Disapproved':
										if($('#user_employee_id').val() == $('#prepared_by').val()){
											formControl('update');
										} else {
											formControl('view');
										}
										break;
								}
								//formControl('update');								
							}
						},
						error: function(errorThrown){
							toastr.error('User Role Error#74144', 'Operation Failed');
							console.log(errorThrown);
						}
					});

				},
				error: function(errorThrown){
					toastr.error('RIC Masterlist Error#10005', 'Operation Failed');
					console.log(errorThrown);
				}
			});
		});
//------------------------------------------------------------------------------
		function formControl(show){
			switch(show){
				case 'add':
					$('#frm_masterlist').hide();
					$('#frm_information').show();
					//$('#frm_information').find('input, select').removeAttr('disabled');
					$('#employee_id').removeAttr('disabled');
					$('#department_id').removeAttr('disabled');
					$('#purpose').removeAttr('disabled');
					$('#attachment_file').removeAttr('disabled');

					$('#ric_id').attr('readonly','readonly');
					$('#ric_date').attr('readonly','readonly');
					$('#prepared_by').attr('disabled', 'disabled');
					$('#verified_by').attr('disabled', 'disabled');
					$('#approved_by').attr('disabled', 'disabled');
					//$('#department_id').attr('readonly', 'readonly');
					
					$('#tbl_ricdetail tbody').empty();
					var items = '<tr><td><input type="text" name="ric_detail_id[]" class="form-control ric_detail_id" disabled></td>'+
						'<td><input type="text" name="particular[]" class="form-control particular" autocomplete="off"></td>'+
						'<td><input type="number" name="amount[]" class="form-control amount" autocomplete="off"></td></tr>';
					$('#tbl_ricdetail').append(items);

					$('#tbl_attachment tbody').empty();
					$('#employee_id').focus();
					$('#ric_id').val('');
					$('#ric_date').val(d.getFullYear()+"-"+month+"-"+day);
					$('#employee_id').val('0');
					$('#department_id').val('0');
					$('#purpose').val('');
					$('#requested_by').val('0');
					$('#verified_by').val('0');
					$('#approved_by').val('0');
					$('#prepared_by').val($('#user_employee_id').val());
					$('#btn_upload').show();
					
					$('#is_cancelled').text('');
					$('#btn_save').show();
					$('#btn_verify').hide();
					$('#btn_deny').hide();
					$('#btn_approve').hide();
					$('#btn_disapprove').hide();
					$('#btn_cancel').hide();
					break;

				case 'cancelled':
					$('#frm_masterlist').hide();
					$('#frm_information').show();
					$('#frm_information').find('input, select').attr('disabled', 'disabled');
					$('#btn_upload').hide();

					$('#is_cancelled').text('REQUEST CANCELLED');
					$('#btn_save').hide();
					$('#btn_verify').hide();
					$('#btn_deny').hide();
					$('#btn_approve').hide();
					$('#btn_disapprove').hide();
					$('#btn_cancel').hide();
					break;
				
				case 'verify':
					$('#frm_masterlist').hide();
					$('#frm_information').show();
					$('#frm_information').find('input, select').attr('disabled', 'disabled');

					$('#is_cancelled').text('');
					$('#btn_save').hide();
					$('#btn_verify').show();
					$('#btn_deny').show();
					$('#btn_approve').hide();
					$('#btn_disapprove').hide();
					if($('#user_employee_id').val() == $('#prepared_by').val()){
						$('#btn_cancel').show();
					} else {
						$('#btn_cancel').hide();
					}
					break;

				case 'approve':
					$('#frm_masterlist').hide();
					$('#frm_information').show();
					$('#frm_information').find('input, select').attr('disabled', 'disabled');

					$('#is_cancelled').text('');
					$('#btn_save').hide();
					$('#btn_verify').hide();
					$('#btn_deny').hide();
					$('#btn_approve').show();
					$('#btn_disapprove').show();
					if($('#user_employee_id').val() == $('#prepared_by').val()){
						$('#btn_cancel').show();
					} else {
						$('#btn_cancel').hide();
					}
					break;

				case 'approved':
					$('#frm_masterlist').hide();
					$('#frm_information').show();
					$('#frm_information').find('input, select').attr('disabled', 'disabled');

					$('#is_cancelled').text('APPROVED');
					$('#btn_save').hide();
					$('#btn_verify').hide();
					$('#btn_deny').hide();
					$('#btn_approve').hide();
					$('#btn_disapprove').hide();
					$('#btn_cancel').hide();
					break;

				case 'update': 
					$('#frm_masterlist').hide();
					$('#frm_information').show();
					//$('#frm_information').find('input, select').removeAttr('disabled');
					$('#employee_id').removeAttr('disabled');
					$('#department_id').removeAttr('disabled');
					$('#purpose').removeAttr('disabled');
					$('#attachment_file').removeAttr('disabled');

					$('#ric_id').attr('readonly','readonly');
					$('#ric_date').attr('readonly','readonly');
					$('#prepared_by').attr('disabled', 'disabled');
					$('#verified_by').attr('disabled', 'disabled');
					$('#approved_by').attr('disabled', 'disabled');
					//$('#department_id').attr('readonly', 'readonly');
					
					$('#employee_id').focus();
					$('#btn_upload').show();
					
					$('#is_cancelled').text('');
					$('#btn_save').show();
					$('#btn_verify').hide();
					$('#btn_deny').hide();
					$('#btn_approve').hide();
					$('#btn_disapprove').hide();
					$('#btn_cancel').hide();
					break;

				case 'view':
					$('#frm_masterlist').hide();
					$('#frm_information').show();
					$('#frm_information').find('input, select').attr('disabled', 'disabled');

					$('#is_cancelled').text('');
					$('#btn_save').hide();
					$('#btn_verify').hide();
					$('#btn_deny').hide();
					$('#btn_approve').hide();
					$('#btn_disapprove').hide();
					if($('#user_employee_id').val() == $('#prepared_by').val()){
						$('#btn_cancel').show();
					} else {
						$('#btn_cancel').hide();
					}
					break;
				
				case false:
					$('#frm_masterlist').show();
					$('#frm_information').hide();
					$('#tbl_masterlist_filter input').focus();
					tbl_masterlist.$('tr.highlight').removeClass('highlight');
					break;
			}
		}
//---------------------------------------------------------------------------
		$('#btn_verify').on('click', function(){
			var actionstatus = 'Submitted';
			$.ajax({
				type: 'POST',
				url: baseurl+'Accounting/Ric/checkActionStatus',
				dataType: 'json',
				data: {'action_status': actionstatus, 'ric_id': $('#ric_id').val()},
				success: function(data){
					if (data) {
						$('#frm_information').attr('action', baseurl+'Accounting/Ric/verifyRIC');
						$('#frm_information').submit();
					} else {
						window.location.replace(baseurl+'Accounting/Ric');
					}
				},
				error: function(errorThrown){
					toastr.error('Check Action Status Error#45614','Operation Failed');
					console.log(errorThrown);
				}
			});
		});

		$('#btn_deny').on('click', function(){
			var actionstatus = 'Submitted';
			$.ajax({
				type: 'POST',
				url: baseurl+'Accounting/Ric/checkActionStatus',
				dataType: 'json',
				data: {'action_status': actionstatus, 'ric_id': $('#ric_id').val()},
				success: function(data){
					if (data) {
						$('#frm_information').attr('action', baseurl+'Accounting/Ric/denyRIC');
						$('#frm_information').submit();
					} else {
						window.location.replace(baseurl+'Accounting/Ric');
					} 
				},
				error: function(errorThrown){
					toastr.error('Check Action Status Error#45613','Operation Failed');
					console.log(errorThrown);
				}
			});
		});

		$('#btn_approve').on('click', function(){
			var actionstatus = 'Verified';
			$.ajax({
				type: 'POST',
				url: baseurl+'Accounting/Ric/checkActionStatus',
				dataType: 'json',
				data: {'action_status': actionstatus, 'ric_id': $('#ric_id').val()},
				success: function(data){
					if (data) {
						$('#frm_information').attr('action', baseurl+'Accounting/Ric/approveRIC');
						$('#frm_information').submit();
					} else {
						window.location.replace(baseurl+'Accounting/Ric');
					}
				},
				error: function(errorThrown){
					toastr.error('Check Action Status Error#45612','Operation Failed');
					console.log(errorThrown);
				}
			});
		});

		$('#btn_disapprove').on('click', function(){
			var actionstatus = 'Verified';
			$.ajax({
				type: 'POST',
				url: baseurl+'Accounting/Ric/checkActionStatus',
				dataType: 'json',
				data: {'action_status': actionstatus, 'ric_id': $('#ric_id').val()},
				success: function(data){
					if (data) {
						$('#frm_information').attr('action', baseurl+'Accounting/Ric/disapproveRIC');
						$('#frm_information').submit();
					} else {
						window.location.replace(baseurl+'Accounting/Ric');
					}
				},
				error: function(errorThrown){
					toastr.error('Check Action Status Error#45611','Operation Failed');
					console.log(errorThrown);
				}
			});
		});

		$('#btn_cancel').on('click', function(){
			var actionstatus = 'Approved';
			$.ajax({
				type: 'POST',
				url: baseurl+'Accounting/Ric/checkActionStatus',
				dataType: 'json',
				data: {'action_status': actionstatus, 'ric_id': $('#ric_id').val()},
				success: function(data){
					if (!data) {
						$('#frm_information').attr('action', baseurl+'Accounting/Ric/cancelRIC');
						$('#frm_information').submit();
					} else {
						window.location.replace(baseurl+'Accounting/Ric');
					}
				},
				error: function(errorThrown){
					toastr.error('Check Action Status Error#45610','Operation Failed');
					console.log(errorThrown);
				}
			});
		});
//---------------------------------------------------------------------------
		$('#employee_id').on('change', function(){
			$.ajax({
				type: 'POST',
				url: baseurl+'Accounting/Ric/getEmployeeDepartment',
				dataType: 'json',
				data: {'employee_id': $(this).val()},
				success: function(data){
					if (data==false){
						$('#department_id').val('0');
					} else {
						$('#department_id').val(data[0].department_id);
					}
				},
				error: function(errorThrown){
					toastr.error('Employee Department Error#75234', 'Operation Failed');
					console.log(errorThrown);
				}
			});
			checkError('employee_id');
		}).on('keydown', function(e){
			switch(e.keyCode){
				case 9:
					e.preventDefault();
					checkError('employee_id');
					break;
			}
		});

		$('#department_id').on('change', function(){
			checkError('department_id');
		}).on('keydown', function(e){
			switch(e.keyCode){
				case 9:
					e.preventDefault();
					checkError('department_id');
					break;
			}
		});

		$('#purpose').on('keydown', function(e){
			switch(e.keyCode){
				case 9:
					e.preventDefault();
					checkError('purpose');
					break;
			}
		});


//ricdetail table--------------------------------------------------------------
		$('#tbl_ricdetail tbody').on('click', 'td', function(){
			curRow = $(this).closest('tr').index();
		});

		$('#tbl_ricdetail tbody').on('keydown', '.particular', function(e){
			switch(e.keyCode){
				case 37:
					e.preventDefault();
					$('#tbl_ricdetail tbody tr').children(':eq('+((curRow*col)+2)+')').find('input').focus();
					break;
				case 38:
					e.preventDefault();
					curRow--;
					if(curRow < 0){
						curRow = $('#tbl_ricdetail tbody tr').length-1;
					}
					$('#tbl_ricdetail tbody tr').children(':eq('+((curRow*col)+1)+')').find('input').focus();
					break;
				case 39:
					e.preventDefault();
					$('#tbl_ricdetail tbody tr').children(':eq('+((curRow*col)+2)+')').find('input').focus();
					break;
				case 40:
					e.preventDefault();
					curRow++;
					if(curRow > $('#tbl_ricdetail tbody tr').length-1){
						curRow = 0;
					}
					$('#tbl_ricdetail tbody tr').children(':eq('+((curRow*col)+1)+')').find('input').focus();
					break;

			}
		}).on('keyup','.particular', function(e){
			checkError('tbl_ricdetail particular');
		});

		$('#tbl_ricdetail tbody').on('keydown','.amount', function(e){
			switch(e.keyCode){
				case 9:
					e.preventDefault();
					curRow++;
					if (curRow < $('#tbl_ricdetail tbody tr').length) {
						$('#tbl_ricdetail tbody tr').children(':eq('+((curRow*col)+1)+')').find('input').focus();
					} else {
						$('#attachment_file').focus();
					}
					break;
				case 13:
					e.preventDefault();
					var newrow = '<tr><td><input type="text" name="ric_detail_id[]" class="form-control ric_detail_id" disabled></td>'+
						'<td><input type="text" name="particular[]" class="form-control particular"></td>'+
						'<td><input type="number" name="amount[]" class="form-control amount"></td></tr>';
					$('#tbl_ricdetail').append(newrow);
					curRow = $('#tbl_ricdetail tbody tr').length-1;
					$('#tbl_ricdetail tbody tr').children(':eq('+((curRow*col)+1)+')').find('input').focus();
					break;
				case 37:
					e.preventDefault();
					$('#tbl_ricdetail tbody tr').children(':eq('+((curRow*col)+1)+')').find('input').focus();
					break;
				case 38:
					e.preventDefault();
					curRow--;
					if(curRow < 0){
						curRow = $('#tbl_ricdetail tbody tr').length-1;
					}
					$('#tbl_ricdetail tbody tr').children(':eq('+((curRow*col)+2)+')').find('input').focus();
					break;
				case 39:
					e.preventDefault();
					$('#tbl_ricdetail tbody tr').children(':eq('+((curRow*col)+1)+')').find('input').focus();
					break;
				case 40:
					e.preventDefault();
					curRow++;
					if(curRow > $('#tbl_ricdetail tbody tr').length-1){
						curRow = 0;
					}
					$('#tbl_ricdetail tbody tr').children(':eq('+((curRow*col)+2)+')').find('input').focus();
					break;
				case 46:
					e.preventDefault();
					if($('#tbl_ricdetail tbody tr').length != 1) {
						if($('#tbl_ricdetail tbody tr').children(':eq('+((curRow*col))+')').find('input').val() != ''){
							$('#tbl_ricdetail tbody tr').children(':eq('+((curRow*col)+1)+')').find('input').val('');
							$('#tbl_ricdetail tbody tr').children(':eq('+((curRow*col)+2)+')').find('input').val('');
						} else {
							$(this).closest('tr').remove();
							curRow--;
							$('#tbl_ricdetail tbody tr').children(':eq('+((curRow*col)+1)+')').find('input').focus();
						}
					} else {
						toastr.warning('Cannot Delete Last Row', 'System Warning!');
					}
					break;
			}
		}).on('keyup', '.amount', function(e){
			checkError('tbl_ricdetail amount');
		});

		$('#tbl_ricdetail tbody').on('focus', 'input[type=number]', function(e){
			$(this).on('mousewheel.disableScroll', function(e){
				e.preventDefault();
			});
		});

		function checkError(field){
			switch(field){
				case 'all':
					var submit = true;
					if($('#tbl_attachment tbody tr').length == 0){
						$('#attachment_file').focus();
						$('#tbl_attachment').css({'border': '1px solid red'});
						submit = false;
					}
					if($('#tbl_ricdetail tbody tr').length == 1 && $('#tbl_ricdetail tbody tr .amount').val().trim().length == 0){
						$('#tbl_ricdetail tbody tr .amount').focus();
						$('#tbl_ricdetail tbody tr .amount').css({'border': '1px solid red'});
						submit = false;
					}
					if($('#tbl_ricdetail tbody tr').length == 1 && $('#tbl_ricdetail tbody tr .particular').val().trim().length == 0){
						$('#tbl_ricdetail tbody tr .particular').focus();
						$('#tbl_ricdetail tbody tr .particular').css({'border': '1px solid red'});
						submit = false;
					}
					if ($('#purpose').val().trim().length == 0) {
						$('#purpose').focus();
						$('#purpose').css({'border': '1px solid red'});
						submit = false;
					}
					if ($('#department_id').val() == 0) {
						$('#department_id').focus();
						$('#department_id').css({'border': '1px solid red'});
						submit = false;
					}
					if($('#employee_id').val() == 0){
						$('#employee_id').focus();
						$('#employee_id').css({'border': '1px solid red'});
						submit = false;
					}
					if(submit){
						$('#frm_information').submit();
					}
					break;

				case 'employee_id':
					if($('#employee_id').val() == '0'){
						$('#employee_id').css({'border': '1px solid red'});
						$('#employee_id').focus();
					} else {
						$('#department_id').focus();
						$('#employee_id').css({'border': ''});
					}
					break;

				case 'department_id':
					if ($('#department_id').val() == '0') {
						$('#department_id').focus();
						$('#department_id').css({'border': '1px solid red'});
					} else {
						$('#purpose').focus();
						$('#department_id').css({'border': ''});
					}
					break;
					
				case 'purpose':
					if($('#purpose').val().trim().length == 0){
						$('#purpose').focus();
						$('#purpose').css({'border': '1px solid red'});
					} else {
						$('#tbl_ricdetail tbody tr').children(':eq(1)').find('input').focus();
						$('#purpose').css({'border': ''});
					}
					break;

				case 'tbl_ricdetail particular':
					if($('#tbl_ricdetail tbody tr').length == 1 && $('#tbl_ricdetail tbody tr .particular').val().trim().length == 0 && $('#tbl_ricdetail tbody tr .amount').val().trim().length == 0){
						$('#tbl_ricdetail tbody tr .particular').css({'border': '1px solid red'});
					} else {
						$('#tbl_ricdetail tbody tr .particular').css({'border': ''});
					}
					break;

				case 'tbl_ricdetail amount':
					if($('#tbl_ricdetail tbody tr').length == 1 && $('#tbl_ricdetail tbody tr .amount').val().trim().length == 0){
						$('#tbl_ricdetail tbody tr .amount').css({'border': '1px solid red'});
					} else {
						$('#tbl_ricdetail tbody tr .amount').css({'border': ''});
					}
					break;

				case 'tbl_attachment':
					if($('#tbl_attachment tbody tr').length == 0){
						$('#attachment_file').focus();
						$('#tbl_attachment').css({'border': '1px solid red'});
					} else {
						$('#tbl_attachment').css({'border': ''});
					}
					break;
			}
		}
//ATTACHMENTS-----------------------------------------------------------

		$('#upload_form').on('submit', function(e){
			e.preventDefault();
			if ($('#attachment_file').val().trim().length != 0) {
				var formData = new FormData(this);
				$.ajax({
					url: baseurl+'Accounting/Ric/uploadAttachment',
					type:'POST',
					data: formData,
					dataType: 'json',
					cache: false,
					contentType: false,
					processData: false,
					success: function(data){
						if (data == false) {
							$('#attachment_error').text('Cannot upload this file type.');
							$('#attachment_file').val('');
							$('#attachment_file').focus();
						} else {
							var items = '<tr><td><input type="text" name="attachment_id[]" class="form-control" value="'+data[0].attachment_id+'" readonly tabindex="-1"></td>'+
								'<td><input type="text" name="filename[]" class="form-control" value="'+data[0].filename+'" readonly tabindex="-1"></td>'+
								//'<td><a href="'+baseurl+'public/files/attachments/'+data[0].filename+'">'+data[0].filename+'</a></td>'+
								'<td><button type="button" name="btn_view" id="btn_view" class="btn btn-circle green btn_view">View</button></td>'+
								'<td><button type="button" name="btn_remove" id="btn_remove" class="btn btn-circle red btn_remove">Remove</button></td></tr>';
							$('#tbl_attachment').append(items);
							$('#attachment_file').val('');
							$('#attachment_error').text('');
						}
						checkError('tbl_attachment');
					},
					error: function(errorThrown){
						console.log(errorThrown);
					},
				});
			}
		});

		$('#tbl_attachment tbody').on('click', '.btn_remove', function(){
			$(this).closest('tr').remove();
			$.ajax({
				url: baseurl+'Accounting/Ric/deleteAttachment',
				type: 'POST',
				dataType: 'json',
				data: {'attachmentid': $(this).closest('tr').children(':eq(0)').find('input').val()},
				success: function(data){
				},
				error: function(errorThrown){
					toastr.error('Delete Attachment Error#78941','Operation Failed');
					console.log(errorThrown);
				}
			});
		});

		$('#tbl_attachment tbody').on('click', '.btn_view', function(){
			//$(this).closest('tr').remove();
			$('#mdl_attachmentview').modal('toggle');
			$('#ifr_attachment').attr('data', baseurl+'public/files/attachments/'+$(this).closest('tr').children(':eq(1)').find('input').val());
		});

		$('#btn_closeattachment').on('keydown', function(e){
			switch(e.keyCode){
				case 9:
				case 27:
					$(this).click();
					break;
			}
		});
//---------------------------------------------------------------------
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