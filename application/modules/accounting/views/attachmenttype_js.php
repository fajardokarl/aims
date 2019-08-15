<script type="text/javascript">
	//src="<?=base_url()?>public/scripts/accounting/attachmenttype.js"
var masterlist = function(){
	var _init = function(){

		$('#btn_add').on('click',function(){
			showInformationForm(true);
			$('#frm_information').attr('action',baseurl+'Accounting/Attachmenttype/insertAttach');
			$('#caption').text('Insert Information');
		});

		$('#btn_back').on('click', function(){
			showInformationForm(false);
		});

		$('#btn_save').on('click', function(){
			if($('#attachment_type').val().trim().length == 0 || $('#description').val().trim().length == 0){
				checkError('all');
			} else {
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

		$('#tbl_masterlist').on('dblclick', 'tr', function(){
			showInformationForm(true);
			$('#frm_information').attr('action', baseurl+'Accounting/Attachmenttype/updateAttach');
			$('#caption').text('Update Information');
			$.ajax({
				type: 'POST',
				url: baseurl+'Accounting/Attachmenttype/getAttachByID',
				dataType: 'json',
				data: {'attachid': $(this).children(':eq(0)').text()},
				success: function(data){
					$('#attachment_type_id').val(data[0].attachment_type_id);
					$('#attachment_type').val(data[0].attachment_type);
					$('#description').val(data[0].description);
				},
				error: function(errorThrown){
					toastr.error('Attachment Type ID Error#45132', 'Operation Failed');
					console.log(errorThrown);
				}
			});
		});

		$('#attachment_type').on('keydown', function(e){
			switch(e.keyCode){
				case 9:
					e.preventDefault();
					checkError('type');
					break;
				case 27:
					e.preventDefault();
					$('#btn_back').click();
					break;
			}
		});

		$('#description').on('keydown', function(e){
			switch(e.keyCode){
				case 9:
					e.preventDefault();
					checkError('desc');
					break;
			}
		});

		function showInformationForm(show){
			switch(show){
				case true:
					$('#frm_masterlist').hide();
					$('#frm_information').show();
					break;
				case false:
					$('#frm_masterlist').show();
					$('#frm_information').hide();
					break;
			}
			$('#attachment_type').focus();
			$('#attachment_type_id').val('');
			$('#attachment_type').val('');
			$('#description').val('');
		}

		function checkError(field){
			switch(field){
				case 'all':
					if($('#description').val().trim().length == 0){
						$('#error2').text('Please fill in the blank field.');
						$('#description').focus();
					}
					if($('#attachment_type').val().trim().length == 0){
						$('#error1').text('Please fill in the blank field.');
						$('#attachment_type').focus();
					}
					break;
				case 'type':
					if($('#attachment_type').val().trim().length == 0){
						$('#error1').text('Please fill in the blank field.');
						$('#attachment_type').focus();
					} else {
						$('#error1').text('');
						$('#description').focus();
					}
					break;
				case 'desc':
					if($('#description').val().trim().length == 0){
						$('#error2').text('Please fill in the blank field.');
						$('#description').focus();
					} else {
						$('#error2').text('');
						$('#btn_save').focus();
					}
					break;		
			}
		}

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
</script>