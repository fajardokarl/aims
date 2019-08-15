var masterlist = function(){
	var _init = function(){
		var masterRow = -1;
		
		$(window).load(function(){
			setTimeout(function(){ $('#tbl_masterlist_filter input').focus(); }, 500);
		});

		$(document).on('keydown', function(e){
			switch(e.which){
				case 27:
					e.preventDefault();
					formControl('back');
					break;
				case 113:
					e.preventDefault();
					formControl('insert');
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
			formControl('insert');
		});

		$('#btn_back').on('click', function(){
			formControl('back');
		});

		$('#btn_save').on('click', function(){
			var submit = true;
			if ($('#postal_code').val().length == 0) {
				$('#postal_code').css('border', '1px solid red');
				$('#postal_code').focus();
				submit = false;
			}
			if ($('#country_id').val() == 0) {
				$('#country_id').css('border', '1px solid red');
				$('#country_id').focus();
				submit = false;
			}
			if ($('#province_id').val() == 0) {
				$('#province_id').css('border', '1px solid red');
				$('#province_id').focus();
				submit = false;
			}
			if ($('#city_id').val() == 0) {
				$('#city_id').css('border', '1px solid red');
				$('#city_id').focus();
				submit = false;
			}
			if ($('#line_3').val().length == 0) {
				$('#line_3').css('border', '1px solid red');
				$('#line_3').focus();
				submit = false;
			}
			if ($('#line_2').val().length == 0) {
				$('#line_2').css('border', '1px solid red');
				$('#line_2').focus();
				submit = false;
			}
			if ($('#line_1').val().length == 0) {
				$('#line_1').css('border', '1px solid red');
				$('#line_1').focus();
				submit = false;
			}
			if ($('#contact_number').val().length == 0) {
				$('#contact_number').css('border', '1px solid red');
				$('#contact_number').focus();
				submit = false;
			}
			/*if ($('#legacy_subcode').val().length == 0) {
				$('#legacy_subcode').css('border', '1px solid red');
				$('#legacy_subcode').focus();
			}*/
			if ($('#account_number').val().length == 0) {
				$('#account_number').css('border', '1px solid red');
				$('#account_number').focus();
				submit = false;
			}
			if ($('#bank_name').val().length == 0){
				$('#bank_name').css('border', '1px solid red');
				$('#bank_name').focus();
				submit = false;
			}
			if (submit) {
				$('#frm_information').submit();
			} 		
		}).on('keydown', function(e){
			switch(e.keyCode){
				case 9:
					e.preventDefault();
					$('#btn_back').focus();
					break;
				case 13:
					e.preventDefault();
					$('#btn_save').click();
					break;
			}
		});

		$('#frm_information').on('submit', function(){
			$('#bank_id').removeAttr('disabled');
		});

		$('#tbl_masterlist tbody').on('dblclick', 'tr', function(){
			var bank_id = $(this).children(':eq(0)').text();
			$.ajax({
				type: 'POST',
				url: baseurl+'Accounting/Bank/getBankByID',
				dataType: 'json',
				data: {'bank_id': bank_id},
				success: function(data){
					$('#bank_id').val(data[0].bank_id);
					$('#bank_name').val(data[0].bank_name);
					$('#account_number').val(data[0].account_number);
					//$('#legacy_subcode').val(data[0].legacy_subcode);
					$('#contact_id').val(data[0].contact_id);
					$('#contact_number').val(data[0].contact_value);
					$('#address_id').val(data[0].address_id);
					$('#line_1').val(data[0].line_1);
					$('#line_2').val(data[0].line_2);
					$('#line_3').val(data[0].line_3);
					$('#city_id').val(data[0].city_id);
					$('#province_id').val(data[0].province_id);
					$('#country_id').val(data[0].country_id);
					$('#postal_code').val(data[0].postal_code);
				},
				error: function(errorThrown){
					toastr.error('Bank Masterlist Error#10011','Operation Failed');
					console.log(errorThrown);
				}
			});
			formControl('update');
		});

		function formControl(show){
			switch(show){
				case 'insert':
					$('#frm_masterlist').hide();
					$('#frm_information').show();
					$('#frm_information').attr('action', baseurl+'Accounting/Bank/insertBank');
					$('#bank_name').focus();

					$('#bank_id').val('');
					$('#bank_name').val('');
					$('#account_number').val('');
					//$('#legacy_subcode').val('');
					$('#contact_id').val('');
					$('#contact_number').val('');
					$('#address_id').val('');
					$('#line_1').val('');
					$('#line_2').val('');
					$('#line_3').val('');
					$('#city_id').val('0');
					$('#province_id').val('0');
					$('#country_id').val('0');
					$('#postal_code').val('');

					$('#bank_id').attr('disabled', 'disabled');
					break;
				case 'update':
					$('#frm_masterlist').hide();
					$('#frm_information').show();
					$('#frm_information').attr('action', baseurl+'Accounting/Bank/updateBank');
					$('#bank_name').focus();
					break;
				case 'back':
					$('#frm_masterlist').show();
					$('#frm_information').hide();
					$('#tbl_masterlist_filter input').focus();
					masterRow = -1;
					tbl_masterlist.$('tr.highlight').removeClass('highlight');
					break;
			}
		}

//Check Fields -----------------------------------
		$('#bank_name').on('keydown', function(e){
			switch(e.keyCode){
				case 9:
					e.preventDefault();
					if ($(this).val().length == 0) {
						$(this).css('border','1px solid red');
						$(this).focus();
					} else {
						$(this).css('border','');
						$('#account_number').focus();
					}
					break;
			}
		});

		$('#account_number').on('keydown', function(e){
			switch(e.keyCode){
				case 9:
					e.preventDefault();
					if ($(this).val().length == 0) {
						$(this).css('border', '1px solid red');
						$(this).focus();
					} else {
						$(this).css('border', '');
						$('#contact_number').focus();
					}
					break;
			}
		});

		/*$('#legacy_subcode').on('keydown', function(e){
			switch(e.which){
				case 9:
					e.preventDefault();
					if ($(this).val().length == 0) {
						$(this).css('border', '1px solid red');
						$(this).focus();
					} else {
						$(this).css('border', '');
						$('#contact_number').focus();
					}
			}
		});*/

		$('#contact_number').on('keydown', function(e){
			switch(e.keyCode){
				case 9:
					e.preventDefault();
					if ($(this).val().length == 0) {
						$(this).css('border','1px solid red');
						$(this).focus();
					} else {
						$(this).css('border','');
						$('#line_1').focus();
					}
					break;
			}
		});

		$('#line_1').on('keydown', function(e){
			switch(e.keyCode){
				case 9:
					e.preventDefault();
					if ($(this).val().length == 0) {
						$(this).css('border','1px solid red');
						$(this).focus();
					} else {
						$(this).css('border','');
						$('#line_2').focus();
					}
					break;
			}
		});

		$('#line_2').on('keydown', function(e){
			switch(e.keyCode){
				case 9:
					e.preventDefault();
					if ($(this).val().length == 0) {
						$(this).css('border', '1px solid red');
						$(this).focus();
					} else {
						$(this).css('border','');
						$('#line_3').focus();
					}
					break;
			}
		});

		$('#line_3').on('keydown', function(e){
			switch(e.keyCode){
				case 9:
					e.preventDefault();
					if ($(this).val().length == 0) {
						$(this).css('border','1px solid red');
						$(this).focus();
					} else {
						$(this).css('border', '');
						$('#city_id').focus();
					}
					break;
			}
		});

		$('#city_id').on('keydown', function(e){
			switch(e.keyCode){
				case 9:
					e.preventDefault();
					if ($(this).val() == 0) {
						$(this).css('border','1px solid red');
						$(this).focus();
					} else {
						$(this).css('border','');
						$('#province_id').focus();
					}
					break;
			}
		});

		$('#province_id').on('keydown', function(e){
			switch(e.keyCode){
				case 9:
					e.preventDefault();
					if ($(this).val() == 0) {
						$(this).css('border', '1px solid red');
						$(this).focus();
					} else {
						$(this).css('border', '');
						$('#country_id').focus();
					}
					break;
			}
		});

		$('#country_id').on('keydown', function(e){
			switch(e.keyCode){
				case 9:
					e.preventDefault();
					if ($(this).val() == 0) {
						$(this).css('border','1px solid red');
						$(this).focus();
					} else {
						$(this).css('border', '');
						$('#postal_code').focus();
					}
					break;
			}
		});

		$('#postal_code').on('keydown', function(e){
			switch(e.keyCode){
				case 9:
					e.preventDefault();
					if ($(this).val().length == 0) {
						$(this).css('border', '1px solid red');
						$(this).focus();
					} else {
						$(this).css('border', '');
						$('#btn_save').focus();
					}
					break;
			}
		});
//------------------------------------------------------

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