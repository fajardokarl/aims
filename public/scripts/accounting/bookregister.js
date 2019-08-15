var masterlist = function(){
	var _init = function(){
		var masterRow = -1;
		var submit = false;

		$(window).load(function(){
			$('#tbl_masterlist_filter input').focus();
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
			$('#frm_masterlist').hide();
			$('#frm_information').show();
			$('#book_description').val('');
			$('#book_reference').val('');
			$('#book_code').val('');
			$('#book_code').focus();
			$('#book_register_id').val('');
			$('#code_error').text('');
			$('#code_error2').text('');
			$('#code_error3').text('');
			submit = false;
			$('#frm_information').attr('action', baseurl+'Accounting/Bookregister/insertBook');
		});

		$('#btn_back').on('click', function(){
			$('#frm_masterlist').show();
			$('#frm_information').hide();
			$('#book_description').val('');
			$('#book_reference').val('');
			$('#book_code').val('');
			$('#book_register_id').val('');
			$('#code_error').text('');
			$('#code_error2').text('');
			$('#code_error3').text('');
			masterRow = -1;
			tbl_masterlist.$('tr.highlight').removeClass('highlight');
			$('#tbl_masterlist_filter input').focus();
		});

		$('#btn_save').on('click', function(){
			submit = true;
			checkFields();
			checkSubCode();
			if(submit){
				$('#frm_information').submit();
			}
		});
		$('#btn_save').on('keydown', function(e){
			switch(e.keyCode){
				case 9:
					e.preventDefault();
					$('#btn_back').focus();
					break;
			}
		});

		$('#book_description').on('keydown', function(e){
			switch(e.keyCode){
				case 9:
				case 13:
					e.preventDefault();
					if ($(this).val().trim().length > 0) {
						$('#code_error3').text('');
						$('#btn_save').focus();
					} else {
						$('#code_error3').text('Book Description cannot be empty. Please fill in the blank field.');
						$(this).focus();
					}
					break;
			}
		});

		$('#book_code').on('keydown', function(e){
			switch(e.keyCode){
				case 9:
				case 13: 
					e.preventDefault();
					checkSubCode();
					break;
				case 27:
					$('#btn_back').trigger('click');
					break;
			}
		});

		$('#book_reference').on('keydown', function(e){
			switch(e.keyCode){
				case 9:
				case 13:
					e.preventDefault();
					if ($(this).val().trim().length > 0) {
						$('#code_error2').text('');
						$('#book_description').focus();
					} else {
						$('#code_error2').text('Book Reference cannot be empty. Please fill in the blank field.');
						$(this).focus();	
					}
			}
		});
		

		$('#tbl_masterlist tbody').on('dblclick', 'tr', function(){
			$('#frm_information').attr('action', baseurl+'Accounting/Bookregister/updateBook');
			var data = tbl_masterlist.row(this).data();
			$('#book_description').val(data[3]);
			$('#book_reference').val(data[2]);
			$('#book_code').val(data[1]);
			$('#book_register_id').val(data[0]);
			$('#frm_masterlist').hide();
			$('#frm_information').show();
			$('#book_code').focus();
			$('#code_error').text('');
			$('#code_error2').text('');
			$('#code_error3').text('');
			submit = false;
		});

		function checkSubCode(){
			if ($('#book_code').val().trim().length > 0) {
				$.ajax({
					type: 'POST',
					url: baseurl+'Accounting/Bookregister/checkSubCode',
					dataType: 'json',
					data: {'book_code': $('#book_code').val(), 'book_id': $('#book_register_id').val()},
					success: function(data){
						if(data){
							$('#code_error').text('Duplicate Code Found. Please try another.');
							$('#book_code').focus();
							submit = false;
						} else {
							submit = true;
							$('#code_error').text('');
							$('#book_reference').focus();
						}
					},
					error: function(errorThrown){
						toastr.error('Book Code Error#98666', 'Operation Failed');
						console.log(errorThrown);
					}
				});
			} else {
				$('#code_error').text('Book Code cannot be empty. Please fill in the blank field.');
				$('#book_code').focus();	
			}
		}

		function checkFields(){
			if ($('#book_reference').val().trim().length > 0 && $('#book_description').val().trim().length > 0) {
				submit = true;
				$('#code_error2').text('');
				$('#code_error3').text('');
			} else {
				submit = false;
				
					$('#code_error').text('Book Code cannot be empty. Please fill in the blank field.');
				
				if ($('#book_reference').val().trim().length == 0) {
					$('#code_error2').text('Book Reference cannot be empty. Please fill in the blank field.');
				}
				if ($('#book_description').val().trim().length == 0) {
					$('#code_error3').text('Book Description cannot be empty. Please fill in the blank field.');
				}
			}
		}

	}//end _init
	return {
		init: function(){
			_init();
		}
	};
}();
jQuery(document).ready(function(){
	masterlist.init();
});