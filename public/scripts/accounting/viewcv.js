var masterlist = function(){
	var _init = function(){

		$(window).load(function(){
			$('#check_voucher_id').attr('disabled', 'disabled');
			$.ajax({
				type: 'POST',
				url: baseurl+'Accounting/Checkvoucher/getUserRole',
				dataType: 'json',
				data: {'cvid': $('#check_voucher_id').val()},
				success: function(dtuser){
					if (dtuser) {
						switch(dtuser.action_status){
							case 'Submitted':
								if (dtuser.role_code == '3') {
									formControl('approve');
								} else {
									formControl(false);
								}
								break;
							case 'Approved':
								formControl('approved');
								break;
						}
					} else {
						formControl(false);
					}
				},
				error: function(errorThrown){
					toastr.error('User Role Error#74114', 'Operation Failed');
					console.log(errorThrown);
				}
			});
		});

		function formControl(show){
			switch(show){
				case 'approve':
					$('#btn_approve').show();
					$('#btn_disapprove').show();
					$('#h3_actionstatus').text('');
					break;
				case 'approved':
					$('#btn_approve').hide();
					$('#btn_disapprove').hide();
					$('#h3_actionstatus').text('APPROVED');
					break;
				case false:
					$('#btn_approve').hide();
					$('#btn_disapprove').hide();
					$('#h3_actionstatus').text('');
					break;
			}
		}

		$('#frm_information').on('submit', function(){
			$('#check_voucher_id').removeAttr('disabled');
		});

		$('#btn_approve').on('click', function(){
			var actionstatus = 'Submitted';
			$.ajax({
				type: 'POST',
				url: baseurl+'Accounting/Checkvoucher/checkActionStatus',
				dataType: 'json',
				data: {'action_status': actionstatus, 'cvid': $('#check_voucher_id').val()},
				success: function(data){
					if (data) {
						$('#frm_information').attr('action', baseurl+'Accounting/Checkvoucher/approveCV');
						$('#frm_information').submit();
					} else {
						window.location.replace(baseurl+'Accounting/Checkvoucher');
					}
				},
				error: function(errorThrown){
					toastr.error('Check Action Status Error#14577','Operation Failed');
					console.log(errorThrown);
				}
			});
		});

		$('#btn_disapprove').on('click', function(){
			var actionstatus = 'Submitted';
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
					toastr.error('Check Action Status Error#14576','Operation Failed');
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