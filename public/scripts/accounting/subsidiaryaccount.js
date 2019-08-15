var masterlist = function(){
	var _init = function(){
//global declarations
//------------------------------------------------------------
	var tablename, fieldname;
	var currentRow = 0;
	var submit = false;
//------------------------------------------------------------
//tables
//------------------------------------------------------------
	setTimeout(function(){ 
		$('#taberino a[href="#tab_customer"]').trigger('click');
		drawtblCustomer();
		}, 100);
	var tbl_customer = $('#tbl_customer').DataTable({
		'bPaginate': true,
		'bLengthChange': true,
		'bSort': false,
		'bFilter': true,
		'aLengthMenu': [[10,25,50,-1],[10,25,50,'All']],
		'iDisplayLength': 10,
		fixedHeader: {
			header: false
		}
	});
	$('#taberino a[href="#tab_customer"]').bind('click', function(){
		setTimeout(function(){
			$('#tbl_customer_filter input').val('');
			$('#tbl_customer_filter input').focus();
			currentRow = 0;
			drawtblCustomer;
		}, 100);
	});
	$('#tbl_customer_filter input').bind('keydown', function(e){
		switch(e.keyCode){
			case 9: 
				e.preventDefault();
				$('#taberino a[href="#tab_department"]').trigger('click');
				break;
			case 13:
				e.preventDefault();
				$('#tbl_customer tbody tr:eq('+currentRow+')').trigger('dblclick');
				break;
			case 37:
				e.preventDefault();
				currentRow = 0;
				tbl_customer.page('previous').draw('page');
				drawtblCustomer();
				break;
			case 38:
				e.preventDefault();
				currentRow--;
				drawtblCustomer();
				break;
			case 39:
				e.preventDefault();
				currentRow = 0;
				tbl_customer.page('next').draw('page');
				drawtblCustomer();
				break;
			case 40:
				e.preventDefault();
				currentRow++;
				drawtblCustomer();
				break;
			default:
				currentRow = 0;
				drawtblCustomer();
				break;
		}
	});
	function drawtblCustomer(){
		if(currentRow == -1){
			currentRow = $('#tbl_customer tbody tr').length-1;
		} else if(currentRow == $('#tbl_customer tbody tr').length){
			currentRow = 0;
		}
		tbl_customer.$('tr.highlight').removeClass('highlight');
		$('#tbl_customer tbody tr:eq('+currentRow+')').addClass('highlight');
	}


	var tbl_department = $('#tbl_department').DataTable({
		'bSort': false,
		'aLengthMenu': [[10,25,50,-1],[10,25,50,'All']],
		'iDisplayLength': 10,
		fixedHeader: {
			header: false
		}
	});
	$('#taberino a[href="#tab_department"]').bind('click', function(){
		setTimeout(function(){
			$('#tbl_department_filter input').val('');
			$('#tbl_department_filter input').focus();
			currentRow = 0;
			drawtblDepartment();
		}, 100);
	});
	$('#tbl_department_filter input').bind('keydown', function(e){
		switch(e.keyCode){
			case 9:
				e.preventDefault();
				$('#taberino a[href="#tab_employee"]').trigger('click');
				break;
			case 13:
				e.preventDefault();
				$('#tbl_department tbody tr:eq('+currentRow+')').trigger('dblclick');
				break;
			case 37:
				e.preventDefault();
				currentRow = 0;
				tbl_department.page('previous').draw('page');
				drawtblDepartment();
				break;
			case 38:
				e.preventDefault();
				currentRow--;
				drawtblDepartment();
				break;
			case 39:
				e.preventDefault();
				currentRow = 0;
				tbl_department.page('next').draw('page');
				drawtblDepartment();
				break;
			case 40:
				e.preventDefault();
				currentRow++;
				drawtblDepartment();
				break;
			default:
				currentRow = 0;
				drawtblDepartment();
				break;
		}
	});
	function drawtblDepartment(){
		if(currentRow == -1){
			currentRow = $('#tbl_department tbody tr').length-1;
		} else if(currentRow == $('#tbl_department tbody tr').length){
			currentRow = 0;
		}
		tbl_department.$('tr.highlight').removeClass('highlight');
		$('#tbl_department tbody tr:eq('+currentRow+')').addClass('highlight');
	}


	var tbl_employee = $('#tbl_employee').DataTable({
		'bSort': false,
		'aLengthMenu': [[10,25,50,-1],[10,25,50,'All']],
		'iDisplayLength': 10,
		fixedHeader: {
			header: false
		}
	});
	$('#taberino a[href="#tab_employee"]').bind('click', function(){
		setTimeout(function(){
			$('#tbl_employee_filter input').val('');
			$('#tbl_employee_filter input').focus();
			currentRow = 0;
			drawtblEmployee();
		}, 100);
	});
	$('#tbl_employee_filter input').bind('keydown', function(e){
		switch(e.keyCode){
			case 9:
				e.preventDefault();
				$('#taberino a[href="#tab_supplier"]').trigger('click');
				break;
			case 13:
				e.preventDefault();
				$('#tbl_employee tbody tr:eq('+currentRow+')').trigger('dblclick');
				break;
			case 37:
				e.preventDefault();
				currentRow = 0;
				tbl_employee.page('previous').draw('page');
				drawtblEmployee();
				break;
			case 38:
				e.preventDefault();
				currentRow--;
				drawtblEmployee();
				break;
			case 39:
				e.preventDefault();
				currentRow = 0;
				tbl_employee.page('next').draw('page');
				drawtblEmployee();
				break;
			case 40:
				e.preventDefault();
				currentRow++;
				drawtblEmployee();
				break;
			default:
				currentRow = 0;
				drawtblEmployee();
				break;
		}
	});
	function drawtblEmployee(){
		if(currentRow == -1){
			currentRow = $('#tbl_employee tbody tr').length-1;
		} else if(currentRow == $('#tbl_employee tbody tr').length){
			currentRow = 0;
		}
		tbl_employee.$('tr.highlight').removeClass('highlight');
		$('#tbl_employee tbody tr:eq('+currentRow+')').addClass('highlight');
	}


	var tbl_supplier = $('#tbl_supplier').DataTable({
		'bSort': false,
		'aLengthMenu': [[10,25,50,-1],[10,25,50,'All']],
		'iDisplayLength': 10,
		fixedHeader: {
			header: false
		}
	});
	$('#taberino a[href="#tab_supplier"]').bind('click', function(){
		setTimeout(function(){
			$('#tbl_supplier_filter input').val('');
			$('#tbl_supplier_filter input').focus();
			currentRow = 0;
			drawtblSupplier();
		}, 100);
	});
	$('#tbl_supplier_filter input').bind('keydown', function(e){
		switch(e.keyCode){
			case 9:
				e.preventDefault();
				$('#taberino a[href="#tab_project').trigger('click');
				break;
			case 13:
				e.preventDefault();
				$('#tbl_supplier tbody tr:eq('+currentRow+')').trigger('dblclick');
				break;
			case 37:
				e.preventDefault();
				currentRow = 0;
				tbl_supplier.page('previous').draw('page');
				drawtblSupplier();
				break;
			case 38:
				e.preventDefault();
				currentRow--;
				drawtblSupplier();
				break;
			case 39:
				e.preventDefault();
				currentRow = 0;
				tbl_supplier.page('next').draw('page');
				drawtblSupplier();
				break;
			case 40:
				e.preventDefault();
				currentRow++;
				drawtblSupplier();
				break;
			default:
				currentRow = 0;
				drawtblSupplier();
				break;
		}
	});
	function drawtblSupplier(){
		if(currentRow == -1){
			currentRow = $('#tbl_supplier tbody tr').length-1;
		}else if(currentRow == $('#tbl_supplier tbody tr').length){
			currentRow = 0;
		}
		tbl_supplier.$('tr.highlight').removeClass('highlight');
		$('#tbl_supplier tbody tr:eq('+currentRow+')').addClass('highlight');
	}


	var tbl_project = $('#tbl_project').DataTable({
		'bSort': false,
		'aLengthMenu': [[10,25,50,-1],[10,25,50,'All']],
		'iDisplayLength': 10,
		fixedHeader: {
			header: false
		}
	});
	$('#taberino a[href="#tab_project"]').bind('click', function(){
		setTimeout(function(){
			$('#tbl_project_filter input').val('');
			$('#tbl_project_filter input').focus();
			currentRow = 0;
			drawtblProject();
		}, 100);
	});
	$('#tbl_project_filter input').bind('keydown', function(e){
		switch(e.keyCode){
			case 9:
				e.preventDefault();
				$('#taberino a[href="#tab_customer"]').trigger('click');
				break;
			case 13:
				e.preventDefault();
				$('#tbl_project tbody tr:eq('+currentRow+')').trigger('dblclick');
				break;
			case 37:
				e.preventDefault();
				currentRow = 0;
				tbl_project.page('previous').draw('page');
				drawtblProject();
				break;
			case 38:
				e.preventDefault();
				currentRow--;
				drawtblProject();
				break;
			case 39:
				e.preventDefault();
				currentRow = 0;
				tbl_project.page('next').draw('page');
				drawtblProject();
				break;
			case 40:
				e.preventDefault();
				currentRow++;
				drawtblProject();
				break;
			default:
				currentRow = 0;
				drawtblProject();
				break;
		}
	});
	function drawtblProject(){
		if(currentRow == -1){
			currentRow = $('#tbl_project tbody tr').length-1;
		}else if(currentRow == $('#tbl_project tbody tr').length){
			currentRow = 0;
		}
		tbl_project.$('tr.highlight').removeClass('highlight');
		$('#tbl_project tbody tr:eq('+currentRow+')').addClass('highlight');
	}
//-----------------------------------------------------------
//SEARCH TEXTBOX
	$('#subsidiary_code').on('keydown', function(e){
		switch(e.keyCode){
			case 9:
			case 13:
				e.preventDefault();
				checkSubCode();
				break;
			case 27:
				$('#btn_back').click();
				break;
		}
	});
//BUTTON
	$('#btn_back').on('click', function(){
		$('#frm_information').hide();
		$('#frm_masterlist').show();
		$('#frm_masterlist').find('input').focus();
		$('#subsidiary_code').val('');
		$('#error_msg').text('');
	});	
//-----------------------------------------------------------
//UPDATES
//-----------------------------------------------------------
	$('#tbl_customer tbody').on('dblclick', 'tr', function(){
		$('#frm_information').attr('action', baseurl+'Accounting/Subsidiaryaccount/updateCustomer');
		var data = tbl_customer.row(this).data();
		$('#record_id').val(data[0]);
		$('#name').val(data[2].replace('&amp;', '&'));
		$('#subsidiary_code').val(data[1]);
		$('#error_msg').text('');

		$('#frm_masterlist').hide();
		$('#frm_information').show();
		$('#subsidiary_code').focus();
		tablename = 'client';
		fieldname = 'subsidiary_code';
	});

	$('#tbl_department tbody').on('dblclick', 'tr', function(){
		$('#frm_information').attr('action', baseurl+'Accounting/Subsidiaryaccount/updateDepartment');
		var data = tbl_department.row(this).data();
		$('#record_id').val(data[0]);
		$('#name').val(data[2].replace('&amp;', '&'));
		$('#subsidiary_code').val(data[1]);

		$('#frm_masterlist').hide();
		$('#frm_information').show();
		//$('#subsidiary_code').val('');
		$('#subsidiary_code').focus();
		tablename = 'department';
		fieldname = 'activity_code';
	});

	$('#tbl_supplier tbody').on('dblclick', 'tr', function(){
		$('#frm_information').attr('action', baseurl+'Accounting/Subsidiaryaccount/updateSupplier');
		var data = tbl_supplier.row(this).data();
		$('#record_id').val(data[0]);
		$('#name').val(data[2].replace('&amp;', '&'));
		$('#subsidiary_code').val(data[1]);

		$('#frm_masterlist').hide();
		$('#frm_information').show();
		//$('#subsidiary_code').val('');
		$('#subsidiary_code').focus();
		tablename = 'supplier';
		fieldname = 'subsidiary_code';
	});

	$('#tbl_employee tbody').on('dblclick', 'tr', function(){
		$('#frm_information').attr('action', baseurl+'Accounting/Subsidiaryaccount/updateEmployee');
		var data = tbl_employee.row(this).data();
		$('#record_id').val(data[0]);
		$('#name').val(data[2].replace('&amp;', '&'));
		$('#subsidiary_code').val(data[1]);

		$('#frm_masterlist').hide();
		$('#frm_information').show();
		//$('#subsidiary_code').val('');
		$('#subsidiary_code').focus();
		tablename = 'employee';
		fieldname = 'subsidiary_code';
	});

	$('#tbl_project tbody').on('dblclick', 'tr', function(){
		$('#frm_information').attr('action', baseurl+'Accounting/Subsidiaryaccount/updateProject');
		var data = tbl_project.row(this).data();
		$('#record_id').val(data[0]);
		$('#name').val(data[2].replace('&amp;', '&'));
		$('#subsidiary_code').val(data[1]);
		
		$('#frm_masterlist').hide();
		$('#frm_information').show();
		//$('#subsidiary_code').val('');
		$('#subsidiary_code').focus();
		tablename = 'project';
		fieldname = 'subsidiary_code';
		submit = false;
	});
	
	$('#btn_save').on('click', function(){
		submit = true;
		checkSubCode();
		if (submit) {
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

	function checkSubCode(){
		if($('#subsidiary_code').val().trim().length > 0){
			$.ajax({
				type: 'POST',
				url: baseurl+'Accounting/Subsidiaryaccount/checkSubCode',
				dataType: 'json',
				data: {'tablename': tablename, 'fieldname': fieldname, 'subcode': $('#subsidiary_code').val().trim(), 'record_id': $('#record_id').val()},
				success: function(data){
					if(data){
						submit = false;
						$('#error_msg').text('Duplicate Code Found. Please try another.');
					} else {
						submit = true;
						$('#error_msg').text('');		
						$('#btn_save').focus();			
					}
				},
				error: function(errorThrown){
					toastr.error('Subsidiary Validation Error#97124','Operation Failed');
					console.log(errorThrown);
				}
			});
		} else {
			$('#error_msg').text('Subsidiary Code cannot be empty. Please fill in the blank.');
			$('#subsidiary_code').focus();
		}
	}

	}// end of _init
	return {
		init: function(){
			_init();
		}
	};
}();
jQuery(document).ready(function(){
	masterlist.init();
});