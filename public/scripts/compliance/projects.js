
$(document).ready(function(){
	var proj_table = $('#all_proj').DataTable({"lengthMenu": [[ 10, 25, 50, -1], [ 10, 25, 50, "All"]] });
	var proj_id;

//MASTERPLAN
	$('#open_masterplan').click(function(){
		// $('#proj_modal_title').html('ADD PROJECT');
		$('#proj_name2').val('');
		$('#proj_desc2').val('');
		$('#proj_id').val('');

		$('#save_proj_changes2').hide();
		$('#save_proj2').show();
	});

//ADD Project bottom
	$('#add_project_btn').click(function(){
		$('#proj_modal_title').html('ADD PROJECT');
		$('#proj_name').val('');
		$('#proj_desc').val('');
		$('#proj_id').val('');

		$('#save_proj_changes').hide();
		$('#save_proj').show();
	});

	$('#proj_cancel').click(function(){
		$('#proj_name').val('');
		$('#proj_desc').val('');
		$('#proj_id').val('');
	});

	$('#save_proj').click(function(){
		var proj_name = $('#proj_name').val();
		var proj_desc = $('#proj_desc').val();
		if (proj_name != '' || proj_desc != '') {
			$.ajax({
				type: "POST",
	            url : baseurl + "engineering/save_project",
	            dataType : "json",
	            data: {'project_name': proj_name,'project_description': proj_desc},
	            success : function(data){
	            	$('#proj_name').val('');
					$('#proj_desc').val('');
	            },  
	            error: function(errorThrown){
	                console.log(errorThrown);
	            }
			});
		}else{
			    toastr.options.timeOut = 500;
    			toastr.error('Complete Required Fields!', 'Warning!');
		}
	});

	$('#all_proj').on('dblclick', 'tr', function(){
		$('#add_project').modal('toggle');
		$('#save_proj_changes').show();
		$('#save_proj').hide();
		$('#proj_modal_title').html('EDIT PROJECT');

		var row = $(this).closest('tr')[0];
        var proj_id = proj_table.cell(row, 0 ).data();

		$.ajax({
			type: "POST",
            url : baseurl + "engineering/get_project",
            dataType : "json",
            data: {'proj_id': proj_id},
            success : function(data){
            	$('#proj_name').val(data[0].project_name);
				$('#proj_desc').val(data[0].project_description);
				$('#proj_id').val(data[0].project_id);
            },  
            error: function(errorThrown){
                console.log(errorThrown);
            }
		});
	});

	$('#save_proj_changes').click(function(){
		var proj_name = $('#proj_name').val();
		var proj_desc = $('#proj_desc').val();
		var proj_id   = $('#proj_id').val();
		console.log(proj_id + '-->' + proj_name + '-->' + proj_desc);

		$.ajax({
			type: "POST",
            url : baseurl + "engineering/save_project_changes",
            dataType : "json",
            data: {'proj_id': proj_id, 'project_name': proj_name,'project_description': proj_desc},
            success : function(data){
            	$('#proj_name').val('');
				$('#proj_desc').val('');
				$('#proj_id').val('');
				$('#add_project').modal('toggle');
            },  
            error: function(errorThrown){
                console.log(errorThrown);
            }
		});

	});

});	
