var masterlist = function(){
	var _init = function(){

		$(window).load(function(){
			$('#ric_id').attr('readonly', 'readonly');
			$.ajax({
				type: 'POST',
				url: baseurl+'Accounting/Ric/getUserRole',
				dataType: 'json',
				data: {'ricid': $('#ric_id').val()},
				success: function(dtuser){
					if ($('#is_cancelled').val() == '1') {
						formControl('cancelled');
					} else {
						switch($('#action_status').val()){
							case 'Submitted':
								if (dtuser.role_code == '2' && $('#department_id').val() == dtuser.department_id) {
									formControl('verify');
								} else {
									formControl('view');
								}
								break;
								
							case 'Verified':
								if (dtuser.role_code == '3' && $('#department_id').val() == dtuser.department_id) {
									formControl('approve');
								} else {
									formControl('view');
								}
								break;
									
							case 'Denied':
									formControl('view');
								break;

							case 'Approved':
								formControl('approved');
								break;

							case 'Disapproved':
									formControl('view');
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
		});

		function formControl(show){
			switch(show){
				case 'cancelled':
					$('#h3_cancelled').text('REQUEST CANCELLED');
					$('#btn_save').hide();
					$('#btn_verify').hide();
					$('#btn_deny').hide();
					$('#btn_approve').hide();
					$('#btn_disapprove').hide();
					$('#btn_cancel').hide();
					break;

				case 'verify':
					$('#h3_cancelled').text('');
					$('#btn_save').hide();
					$('#btn_verify').show();
					$('#btn_deny').show();
					$('#btn_approve').hide();
					$('#btn_disapprove').hide();
					$('#btn_cancel').hide();
					break;

				case 'approve':
					$('#h3_cancelled').text('');
					$('#btn_save').hide();
					$('#btn_verify').hide();
					$('#btn_deny').hide();
					$('#btn_approve').show();
					$('#btn_disapprove').show();
					$('#btn_cancel').hide();
					break;

				case 'approved':
					$('#h3_cancelled').text('APPROVED');
					$('#btn_save').hide();
					$('#btn_verify').hide();
					$('#btn_deny').hide();
					$('#btn_approve').hide();
					$('#btn_disapprove').hide();
					$('#btn_cancel').hide();
					break;

				case 'view':
					$('#h3_cancelled').text('');
					$('#btn_save').hide();
					$('#btn_verify').hide();
					$('#btn_deny').hide();
					$('#btn_approve').hide();
					$('#btn_disapprove').hide();
					$('#btn_cancel').hide();
					break;
			}
		}

		$('#frm_action').on('submit', function(){
			$('#ric_id').removeAttr('readonly');
		});


		$('#btn_verify').on('click', function(){
			var actionstatus = 'Submitted';
			$.ajax({
				type: 'POST',
				url: baseurl+'Accounting/Ric/checkActionStatus',
				dataType: 'json',
				data: {'action_status': actionstatus, 'ric_id': $('#ric_id').val()},
				success: function(data){
					if (data) {
						$('#frm_action').attr('action', baseurl+'Accounting/Ric/verifyRIC');
						$('#frm_action').submit();
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
						$('#frm_action').attr('action', baseurl+'Accounting/Ric/denyRIC');
						$('#frm_action').submit();
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
						$('#frm_action').attr('action', baseurl+'Accounting/Ric/approveRIC');
						$('#frm_action').submit();
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
						$('#frm_action').attr('action',baseurl+'Accounting/Ric/disapproveRIC');
						$('#frm_action').submit();
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
						$('#frm_action').attr('action', baseurl+'Accounting/Ric/cancelRIC');
						$('#frm_action').submit();
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

		$('#tbl_attachment tbody').on('click', '.btn_view', function(){
			$('#mdl_attachmentview').modal('toggle');
			$('#ifr_attachment').attr('data', baseurl+'public/files/attachments/'+$(this).closest('tr').children(':eq(1)').find('input').val());
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