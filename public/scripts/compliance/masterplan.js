$(document).ready(function(){
	
	var tbl_lot	   = $('#tbl_lot').DataTable({bInfo:false, searching: false, "lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]], "columnDefs": [
                    {
                        "targets": [ 0,1,6 ],
                        "visible": false,
                        "searchable": false
                    }
                ] });
	var tbl_phase  = $('#tbl_phase').DataTable({bInfo:false, searching: false, "lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]], "columnDefs": [
                    {
                        "targets": [ 0,1 ],
                        "visible": false,
                        "searchable": false
                    }
                ] });
	var tbl_block  = $('#tbl_block').DataTable({bInfo:false, searching: false, "lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]], "columnDefs": [
                    {
                        "targets": [ 0,1 ],
                        "visible": false,
                        "searchable": false
                    }
                ] });
	var tbl_lot_temp = $('#tbl_lot_temp').DataTable({bInfo:false, searching: false, "lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]], "columnDefs": [
                    {
                        "targets": [ 4 ],
                        "visible": false,
                        "searchable": false
                    }
                ] });
	var proj_id;

	$('#btn_clear').click(function(){
		// $('#opt_project').val(0);
		// $('#opt_phase').val(0);
		$('#num_blocks').val('');
		$('#phase_lot_area').val('');
		$('#use_lot_area').val('');
	});

	$('#opt_project').change(function(){
		var proj_id = $(this).val();
		var opt_content = "<option value='0'>None</option>";
		$.ajax({
			type: "POST",
            url : baseurl + "compliance/get_all_phase",
            dataType : "json",
            data: {'proj_id': proj_id},
            success : function(data){
            	$.each(data, function(i, value){
                    opt_content += "<option value='" + data[i].phase_id + "'>" + data[i].phase_name + "</option>"
                });
                $('#opt_phase').html(opt_content);
            },  
            error: function(errorThrown){
                console.log(errorThrown);
            }
		});
	});

	var area,
		area_per_lot,
		block_no,
		phase_val,
		phase_text = '',
		project_val = 0,
		project_text = '',
		with_house= "0",
		area_per_block = 0,
		with_house_text,
		new_proj = 0;

	$("#check_add_all").click( function(){
        if($(this).is(':checked') ){
        	$('#new_project').show();
        	$('#old_project').hide();
        	new_proj = 1;

        	var opt_content = "<option value='0'>None</option>";
			$.ajax({
				type: "POST",
	            url : baseurl + "compliance/get_phases",
	            dataType : "json",
	            success : function(data){
	            	$.each(data, function(i, value){
	                    opt_content += "<option value='" + data[i].phase_id + "'>" + data[i].phase_name + "</option>"
	                });
	                $('#opt_phase').html(opt_content);
	                project_val = 0;
	            },  
	            error: function(errorThrown){
	                console.log(errorThrown);
	            }
			});
        }else{
        	$('#new_project').hide();
        	$('#old_project').show();
        	new_proj = 0;
        	// project_text = $('#new_proj_name').val();
        	$('#opt_phase').html("<option value='0'>None</option>");
        };
    });

	$('#btn_add_phase').click(function(){
		project_val = $('#opt_project option:selected').val();
		phase_val = $('#opt_phase option:selected').val();
		phase_text = $('#opt_phase option:selected').text();
		area = $('#use_lot_area').val();
		
		if (new_proj == 1) {
        	project_text = $('#new_proj_name').val();
		}else{
			project_text = $('#opt_project option:selected').text();
		}

		console.log(project_val);
		if (project_text != '' || project_text !== 'None' || project_val != 0) {
			if ($('#num_blocks').val() != 0) {
				// if (parseFloat($('#use_lot_area').val()) <= parseFloat($('#phase_lot_area').val())) {
					$('#proj_title').html(project_text);
					tbl_phase.row.add([
						project_val,
						phase_val,
						$('#opt_phase option:selected').text(),
						$('#num_blocks').val(),
						$('#use_lot_area').val(),
						// '<button type="button" class="btn red btn-xs phase_addblock">Add</button> <button type="button" class="btn green btn-xs phase_resetblock">Reset</button><button type="button" class="btn blue btn-xs phase_delete">Delete</button>'
					]).draw(false);

					for (var i = 0; i < $('#num_blocks').val(); i++) {
						tbl_block.row.add([
							project_val,
							phase_val,
							i+1,
							0,
							'<button type="button" class="btn red btn-xs block_addlot">Add Lot</button><button type="button" class="btn blue btn-xs block_delete">Delete</button>'
						]).draw(false);

						$('#avalailabl_lot').html(area  + " Sq m");
						$('#phase_info').hide();
						$('#save_reset_action').show();
					}
					$('#num_blocks').val('');
					$('#phase_lot_area').val('');
					$('#use_lot_area').val('');
				// }else{
					// toastr.options.timeOut = 500;
		    		// toastr.error('Usable Lot should be morethan/equal to Lot area!', 'Warning!');
				// }
			}else{
				toastr.options.timeOut = 500;
		    	toastr.error('Block Number cannot be Empty!', 'Warning!');
			}
		}else{
			toastr.options.timeOut = 500;
	    	toastr.error('Please Select Project', 'Warning!');
		}
	});

	$("#reset_lot").click(function(){
        reset_inputs();
    });


	$("#check_with_house").click( function(){
        if($(this).is(':checked') ){
        	with_house = 1;
        }else{
        	with_house = 0;
        };
    });
    $("#check_with_house_edit").click( function(){
        if($(this).is(':checked') ){
        	with_house = 1;
        }else{
        	with_house = 0;
        };
    });
    

	tbl_block.on('click', '.block_addlot', function(e){
        e.preventDefault();
        var row = $(this).closest('tr')[0];
        block_no = tbl_block.cell(row, 2 ).data();

		$('#block_num_head').html(block_no);
        $('#add_lot_modal').modal('toggle');
        $('#available_lot_temp').html(area  + "Sq m");
	});



	var row_index = 1;
	$('#btn_add_area').click(function(){
		//project- Phase [#]- Block [#]- lot [#] - With House
		var with_house = "0";
		var area_per_lot = parseFloat($('#area_per_lot').val());

		if($('#check_with_house').is(':checked') ){
        	with_house = 1;
        	with_house_text = "-with House";
        }else{
        	with_house = 0;
        	with_house_text = "";
        };
        
		if (parseFloat(area) >= parseFloat(area_per_lot)) {
			var lot_desc = project_text + "- " + phase_text + "- Block" + block_no + "- Lot " + row_index + " " + with_house_text;
			area -= parseFloat(area_per_lot);
			area_per_block += parseFloat(area_per_lot);
			tbl_lot_temp.row.add([
				row_index,
				block_no,
				lot_desc,
				area_per_lot,
				with_house,
			]).draw(false);
			// tbl_lot_temp.clear().draw();
			$('#available_lot_temp').html(area  + " Sq m");
			row_index++;
		}else{
			toastr.options.timeOut = 500;
    		toastr.error('Exceed!', 'Warning!');
		}
	});	

	$('#btn_reset_templot').click(function(){
		row_index = 1;
		$('#area_per_lot').val('');
		area += parseFloat(area_per_block);
		$('#available_lot_temp').html(area  + " Sq m");

		area_per_block = 0;
		tbl_lot_temp.clear().draw();
	});

	$('#btn_cancel_lottemp').click(function(){
		row_index = 1;
		$('#area_per_lot').val('');
	});


	$('#btn_add_lots').click(function(){
		// row_index = 1;
		var row_num = tbl_lot_temp.rows().count();
		var block_num = tbl_block.rows().count();

		if (row_num > 0 || row_num != 0) {
			// $.each($("#tbl_lot_temp tbody tr"), function(i, value){
			for(var i = 0; i < row_num; i++){
				tbl_lot.row.add([
					tbl_lot_temp.cell(i, 1).data(),
					tbl_lot_temp.cell(i, 0).data(),
					"Block " + tbl_lot_temp.cell(i, 1).data(),
					tbl_lot_temp.cell(i, 2).data(),
					tbl_lot_temp.cell(i, 3).data(),
					// <button type="button" class="btn blue btn-xs lot_delete">Delete</button>
					'<button type="button" class="btn blue btn-xs edit_lot_final">Edit</button>',
					tbl_lot_temp.cell(i, 4).data(),
				]).draw(false);
			}

			// });
			$('#add_lot_modal').modal('toggle');
			$('#area_per_lot').val('');
			tbl_lot_temp.clear().draw();
			row_index = 1;

			// $.each($("#tbl_block tbody tr"), function(i, value){
			for (var i = 0; i < block_num; i++) {
				if (tbl_block.cell(i, 2).data() == block_no) {
					tbl_block.cell(i, 3).data(area_per_block);
				}
			}
			// });
			$('#avalailabl_lot').html(area  + " Sq m");
			area_per_block = 0;
		}else{
			toastr.options.timeOut = 500;
	    	toastr.error('Empty Lots', 'Warning!');
		}

	});

	tbl_lot.on('click', '.lot_delete', function(e){
        e.preventDefault();
        tbl_lot.row($(this).closest('tr')).remove().draw();
    });


	var selected_row;
	var temp_desc;
	var temp_with_house;
    tbl_lot.on('click', '.edit_lot_final', function(e){
        e.preventDefault();
        var row = $(this).closest('tr')[0];
        selected_row = row
        var block_id = tbl_lot.cell(row, 0 ).data();
        var lot_area = tbl_lot.cell(row, 4 ).data();
        var temp_lot = parseFloat(area) + parseFloat(lot_area);

        temp_with_house = tbl_lot.cell(row, 6 ).data();
        temp_desc = tbl_lot.cell(row, 3 ).data();
        area = temp_lot;

        $('#edit_lot_modal').modal('toggle');
		if (temp_with_house == 1) {
			$('#check_with_house_edit').prop('checked', true);
		}else{
			$('#check_with_house_edit').prop('checked', false);
		}



        $('#area_per_lot_edit').val('0');
		$('#available_lot_temp_edit').html(temp_lot  + " Sq m");

    });

    $('#btn_saveedit_lot').click(function(){
    	var row = selected_row;
    	var new_area = $('#area_per_lot_edit').val();

    	if (new_area <= area || new_area != '0') {
	    	area -= new_area;
	    	tbl_lot.cell(row, 4 ).data(new_area);
	    	tbl_lot.cell(row, 6 ).data(with_house);
			$('#avalailabl_lot').html(area  + " Sq m");
	        $('#edit_lot_modal').modal('toggle');

	        if (with_house == 1 && with_house != temp_with_house) {
			    tbl_lot.cell(row, 3 ).data(temp_desc +  " -with House");
	        }else if (with_house == 0) {
	        	var str = temp_desc.replace("-with House", "");
			    tbl_lot.cell(row, 3 ).data(str);
	        }

    	}


    });


	var id_project;
	$('#save_all_lots').click(function(){
		var lot_row_num = tbl_lot.rows().count();
		console.log(project_val);

		if (lot_row_num > 0) {
			var lot_arr = [];
			// $.each($("#tbl_lot tbody tr"), function(i, value){
			var playground = {
				'project_id': project_val,
				'phase_id': phase_val,
				'block_no': '',
				'lot_no': '',
				'lot_description': 'Park/Playground',
				'lot_area': $('#playground_area').val(),
				'with_house': 0,
				'is_residential': 0,
			};
			lot_arr.push(playground);

			var road_arr = {
				'project_id': project_val,
				'phase_id': phase_val,
				'block_no': '',
				'lot_no': '',
				'lot_description': 'Road Area',
				'lot_area': $('#road_area').val(),
				'with_house': 0,
				'is_residential': 0,
			};
			lot_arr.push(road_arr);


			for (var i = 0; i < lot_row_num; i++) {
				var data_temp = {
					'project_id': project_val,
					'phase_id': phase_val,
					'block_no': tbl_lot.cell(i, 0).data(),
					'lot_no': tbl_lot.cell(i, 1).data(),
					'lot_description': tbl_lot.cell(i, 3).data(),
					'lot_area': tbl_lot.cell(i, 4).data(),
					'with_house': tbl_lot.cell(i, 6).data(),
					'is_residential': tbl_lot.cell(i, 6).data(),
				};
				lot_arr.push(data_temp);
			}

			$.ajax({
				type: "POST",
	            url : baseurl + "compliance/save_lots",
	            data: {'lot_arr' : lot_arr, 'proj_name' : $('#new_proj_name').val(), 'proj_desc' : $('#new_proj_desc').val(), 'new_proj' : new_proj, 'license_number' : $('#new_proj_license').val()},
	            success : function(data){
		            	// toastr.options.timeOut = 500;
			    		toastr.success('Lots Saved!', 'Success');
	            		reset_inputs();
	            },  
	            error: function(errorThrown){
	                console.log(errorThrown);
	            }
			});
		}else{
			toastr.options.timeOut = 500;
    		toastr.error('Empty Lots', 'Warning!');
		}
	});


	function reset_inputs(){
		tbl_phase.clear().draw();
		tbl_block.clear().draw();
		tbl_lot.clear().draw();
		tbl_lot_temp.clear().draw();

		area 		   = 0; 
		area_per_lot   = 0;
		block_no 	   = 0;
		phase_val 	   = 0;
		project_val    = 0;
		area_per_block = 0;
		new_proj 	   = 0;
		phase_text 	   ='';
		project_text   ='';

		$('#proj_title').html('');
		$('#avalailabl_lot').html('0');
		$('#phase_info').show();
		$('#save_reset_action').hide();
	    // $("#opt_project option[value=0]").attr('selected', true);
	    $("#opt_project").val('0');
	    $("#select2-opt_project-container").text('None');
	    // $("#select2-opt_project-container").text('None');
	    $('#new_proj_license').val('');
	    $('#opt_phase').html("<option value='0'>None</option>");
	}
});


