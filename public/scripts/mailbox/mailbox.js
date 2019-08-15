var mail = function(){
	var _init = function(){

		var mails = $("#mails").DataTable({searching: false, "columnDefs": [
                {
                    "targets": [0],
                    "visible": false,
                    "searchable": false
                }
            ]
        });



		mails.on('click', 'tbody tr', function (e) {
	        var row = $(this).closest('tr')[0];
	        var inbox_id = mails.cell(row, 0 ).data();

	        $.ajax({
	            type: "POST",
	            url:  baseurl + "mailbox/get_onemail",
	            dataType: "json",
	            data: {'inbox_id': inbox_id },
	            success: function(data){

	            	$('#main_inbox').hide();
					$('#message_content').show();

	            	$('#mail_subject').html(data.subject);
	            	$('#mail_sender').html(data.firstname + ' ' + data.lastname);
	            	$('#mail_body').html(data.body);

	                // toastr.success('Success.', 'Success');
				},
	            error: function (errorThrown){
	                console.log(errorThrown)
	                toastr.error('Error!.', 'Operation Done');
	            }
	        });

	        // alert(inbox_id);
	    });
		


		$('#back_mail').click(function(){
			$('#main_inbox').show();
			$('#message_content').hide();
		});

		$('#compose_mail').click(function(){
			$('#modal_compose').modal('toggle');
			$('#compose_recepient').focus();
		});

		// SENDING TO RECEPIENTS
		$('#send_mail').click(function(){
			$.ajax({
	            type: "POST",
	            url:  baseurl + "mailbox/send_mail",
	            dataType: "json",
	            data: {'inbox_id': 1 },
	            success: function(data){
	            	

	            	
	                toastr.success('Success.', 'Success');
				},
	            error: function (errorThrown){
	                console.log(errorThrown)
	                toastr.error('Error!.', 'Operation Done');
	            }
	        });
		});

		// IGNORING AND CLOSING COMPOSE 
		$('#delete_mail').click(function(){
			$('#compose_recepient').val('');
			$('#compose_subject').val('');
			$('#compose_body').val('');
			$('#modal_compose').modal('toggle');
		});

		$('#close_modal').click(function(e){
			e.preventDefault();
			$('#modal_compose').modal('toggle');
		});
		

	}
	return {
		init: function(){
			_init();
		}
	};
}();

jQuery(document).ready(function(){
	// $("<style type='text/css'> .odd{ background:#acbad4;} </style>").appendTo("head");
	// $("<style type='text/css'> .even{ background:#abc123;} </style>").appendTo("head");
	mail.init();
});