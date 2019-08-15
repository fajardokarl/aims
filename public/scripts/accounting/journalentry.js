var masterlist = function(){
	var _init = function(){
//------------------------------------------------------------------------------
//global declarations
		var masterRow = -1, previousRow, currentRow, detailRow = 0, tabRow = 0, eraseRow = false;
		var d = new Date();

//------------------------------------------------------------------------------
//DataTable
//Datepicker
		$(window).load(function(){
			var month = ((d.getMonth()+1)<10? '0'+(d.getMonth()+1):(d.getMonth()+1));
			$('#datepicker').datepicker({
				format: 'yyyy-mm-dd',
				autoclose: true,
			}).datepicker('setDate', d.getFullYear()+"-"+month+"-01");
			$('#datepicker2').datepicker({
				format: 'yyyy-mm-dd',
				autoclose: true,
			}).datepicker('setDate', d.getFullYear()+"-"+month+"-"+new Date(d.getFullYear(),d.getMonth()+1,0));
			$('#btn_searchrange').trigger('click');
		});


		$(document).on('keydown', function(e){
			switch(e.which){
				/*case 27:
					e.preventDefault();
					$('#btn_back').click();
					break;*/
				case 113:
					e.preventDefault();
					$('#btn_add').click();
					break;
			}
		});


		$('#btn_searchrange').on('click', function(){
			$.ajax({
				type: 'POST',
				url: baseurl+'accounting/journalentry/getJournalByRange',
				dataType: 'json',
				data: {'begin': $('#datepicker').val(), 'end': $('#datepicker2').val()},
				success: function(data){
					var postdate = '';
					tbl_masterlist.clear().draw();
					for (var i = 0; i <= data.length-1; i++) {
						if (data[i].post_date == '0000-00-00 00:00:00') {
							postdate = 'Not Yet';
						} else {
							postdate = data[i].post_date;
						}
						tbl_masterlist.row.add([
							data[i].transaction_id,
							data[i].book_prefix,
							data[i].reference,
							data[i].subsidiary_name,
							data[i].remarks,
							data[i].encode_date,
							data[i].post_status.charAt(0).toUpperCase()+data[i].post_status.slice(1),
							postdate,
							data[i].is_locked.charAt(0).toUpperCase()+data[i].is_locked.slice(1)
						]).draw(false);
					}
				},
				error: function(errorThrown){
					toastr.error('Journal Range Error#10122', 'Operation Failed');
					console.log(errorThrown);
				}
			});
			setTimeout(function(){ $('#tbl_masterlist_filter input').focus(); }, 500);
			
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


		$('#datepicker').on('keydown', function(){
			tbl_masterlist.draw();
		});
		$('#datepicker').on('change', function(){
			tbl_masterlist.draw();
		});
		$('#datepicker2').on('keydown', function(){
			tbl_masterlist.draw();
		});
		$('#datepicker2').on('change', function(){
			tbl_masterlist.draw();
		});

		
		var tbl_customer = $('#tbl_customer').DataTable({
			'bPaginate': true,
			'bLengthChange': true,
			'bSort' : true,
			'aLengthMenu' : [[10,50,100,-1],[10,50,100,'All']],
			'iDisplayLength' : 10,
			fixedHeader: {
				header: false,
			}
		});
		//$('#tbl_customer_filter input').unbind();
		$('#tbl_customer_filter input').bind('keydown', function(e){
			switch(e.keyCode){
				case 9:
					e.preventDefault();
					$('#taberino a[href="#tab_department"]').trigger('click');
					break;
				case 13: 
					e.preventDefault();
					$('#tbl_customer tbody tr:eq('+tabRow+')').click();
					$('#remarks').focus();
					break;
				case 27:
					e.preventDefault();
					closeTaberino();
					break;
				case 37:
					e.preventDefault();
					tabRow = 0;
					tbl_customer.page('previous').draw('page');
					tbl_customer.$('tr.highlight').removeClass('highlight');
					$('#tbl_customer tbody tr:eq('+tabRow+')').addClass('highlight');
					break;
				case 38:
					e.preventDefault();
					tbl_customer.$('tr.highlight').removeClass('highlight');
					tabRow--;
					if (tabRow < 0) { tabRow = $('#tbl_customer tbody tr').length-1; }
					$('#tbl_customer tbody tr:eq('+tabRow+')').addClass('highlight');
					break;
				case 39:
					e.preventDefault();
					tabRow = 0;
					tbl_customer.page('next').draw('page');
					tbl_customer.$('tr.highlight').removeClass('highlight');
					$('#tbl_customer tbody tr:eq('+tabRow+')').addClass('highlight');
					break;
				case 40:
					e.preventDefault();
					tbl_customer.$('tr.highlight').removeClass('highlight');
					tabRow++;
					if (tabRow > $('#tbl_customer tbody tr').length-1) { tabRow = 0; }
					$('#tbl_customer tbody tr:eq('+tabRow+')').addClass('highlight');
					break;
				default:
					tabRow = 0;
					tbl_customer.$('tr.highlight').removeClass('highlight');
					$('#tbl_customer tbody tr:eq('+tabRow+')').addClass('highlight');
					break;
			}
		});
		$('#tbl_customer tbody').on('click', 'tr', function(){
			var data = tbl_customer.row(this).data();
			var str = data[1];
			$('#subsidiary_table').val('client');
			$('#sub_code').val(data[0]);
			$('#department').val(str.replace('&amp;', '&'));
			$('#frm_activitycenter .close').click();
			$('#department_error').text('');
		});
		$('#taberino a[href="#tab_customer"]').bind('click', function(){
			setTimeout( function(){
				$('#tbl_customer_filter input').val('');
				$('#tbl_customer_filter input').focus();
				tabRow = 0;
				tbl_customer.$('tr.highlight').removeClass('highlight');
				$('#tbl_customer tbody tr:eq('+tabRow+')').addClass('highlight');
			}, 100);
		});
		$('#tbl_customer_paginate').on('click', function(){
			tabRow = 0;
			tbl_customer.$('tr.highlight').removeClass('highlight');
			$('#tbl_customer tbody tr:eq('+tabRow+')').addClass('highlight');
		});



		//-----------------------------------------------------
		var tbl_department = $('#tbl_department').DataTable({
			'bSort' : true,
			'aLengthMenu' : [[10,50,100,-1],[10,50,100,'All']],
			'iDisplayLength' : 10,
			fixedHeader: {
				header: false,
			}
		});
		$('#tbl_department_filter input').bind('keydown', function(e){
			switch(e.keyCode){
				case 9:
					e.preventDefault();
					$('#taberino a[href="#tab_employee"]').trigger('click');
					break;
				case 13: 
					e.preventDefault();
					$('#tbl_department tbody tr:eq('+tabRow+')').click();
					$('#remarks').focus();
					break;
				case 27:
					e.preventDefault();
					closeTaberino();
					break;
				case 37:
					e.preventDefault();
					tabRow = 0;
					tbl_department.page('previous').draw('page');
					tbl_department.$('tr.highlight').removeClass('highlight');
					$('#tbl_department tbody tr:eq('+tabRow+')').addClass('highlight');
					break;
				case 38:
					e.preventDefault();
					tbl_department.$('tr.highlight').removeClass('highlight');
					tabRow--;
					if (tabRow < 0) { tabRow = $('#tbl_department tbody tr').length-1; }
					$('#tbl_department tbody tr:eq('+tabRow+')').addClass('highlight');
					break;
				case 39:
					e.preventDefault();
					tabRow = 0;
					tbl_department.page('next').draw('page');
					tbl_department.$('tr.highlight').removeClass('highlight');
					$('#tbl_department tbody tr:eq('+tabRow+')').addClass('highlight');
					break;
				case 40:
					e.preventDefault();
					tbl_department.$('tr.highlight').removeClass('highlight');
					tabRow++;
					if (tabRow > $('#tbl_department tbody tr').length-1) { tabRow = 0; }
					$('#tbl_department tbody tr:eq('+tabRow+')').addClass('highlight');
					break;
				default:
					tabRow = 0;
					tbl_department.$('tr.highlight').removeClass('highlight');
					$('#tbl_department tbody tr:eq('+tabRow+')').addClass('highlight');
					break;
			}
		});
		$('#tbl_department tbody').on('click', 'tr', function(){
			var data = tbl_department.row(this).data();
			var str = data[1];
			$('#subsidiary_table').val('department');
			$('#sub_code').val(data[0]);
			$('#department').val(str.replace('&amp;', '&'));
			$('#frm_activitycenter .close').click();
			$('#department_error').text('');
		});
		$('#taberino a[href="#tab_department"]').bind('click', function(){
			setTimeout( function(){
				$('#tbl_department_filter input').val('');
				$('#tbl_department_filter input').focus();
				tabRow = 0;
				tbl_department.$('tr.highlight').removeClass('highlight');
				$('#tbl_department tbody tr:eq('+tabRow+')').addClass('highlight');
			}, 100);
		});
		$('#tbl_department_paginate').on('click', function(){
			tabRow = 0;
			tbl_department.$('tr.highlight').removeClass('highlight');
			$('#tbl_department tbody tr:eq('+tabRow+')').addClass('highlight');
		});

		//-------------------------------------------------
		var tbl_employee = $('#tbl_employee').DataTable({
			'bSort' : true,
			'aLengthMenu' : [[10,50,100,-1],[10,50,100,'All']],
			'iDisplayLength' : 10,
			fixedHeader: {
				header: false,
			}
		});
		$('#tbl_employee_filter input').bind('keydown', function(e){
			switch(e.keyCode){
				case 9:
					e.preventDefault();
					$('#taberino a[href="#tab_supplier"]').trigger('click');
					break;
				case 13: 
					e.preventDefault();
					$('#tbl_employee tbody tr:eq('+tabRow+')').click();
					$('#remarks').focus();
					break;
				case 27:
					e.preventDefault();
					closeTaberino();
					break;
				case 37:
					e.preventDefault();
					tabRow = 0;
					tbl_employee.page('previous').draw('page');
					tbl_employee.$('tr.highlight').removeClass('highlight');
					$('#tbl_employee tbody tr:eq('+tabRow+')').addClass('highlight');
					break;
				case 38:
					e.preventDefault();
					tbl_employee.$('tr.highlight').removeClass('highlight');
					tabRow--;
					if (tabRow < 0) { tabRow = $('#tbl_employee tbody tr').length-1; }
					$('#tbl_employee tbody tr:eq('+tabRow+')').addClass('highlight');
					break;
				case 39:
					e.preventDefault();
					tabRow = 0;
					tbl_employee.page('next').draw('page');
					tbl_employee.$('tr.highlight').removeClass('highlight');
					$('#tbl_employee tbody tr:eq('+tabRow+')').addClass('highlight');
					break;
				case 40:
					e.preventDefault();
					tbl_employee.$('tr.highlight').removeClass('highlight');
					tabRow++;
					if (tabRow > $('#tbl_employee tbody tr').length-1) { tabRow = 0; }
					$('#tbl_employee tbody tr:eq('+tabRow+')').addClass('highlight');
					break;
				default:
					tabRow = 0;
					tbl_employee.$('tr.highlight').removeClass('highlight');
					$('#tbl_employee tbody tr:eq('+tabRow+')').addClass('highlight');
					break;
			}
		});
		$('#tbl_employee tbody').on('click', 'tr', function(){
			var data = tbl_employee.row(this).data();
			var str = data[1];
			$('#subsidiary_table').val('employee');
			$('#sub_code').val(data[0]);
			$('#department').val(str.replace('&amp;', '&'));
			$('#frm_activitycenter .close').click();
			$('#department_error').text('');
		});
		$('#taberino a[href="#tab_employee"]').bind('click', function(){
			setTimeout( function(){
				$('#tbl_employee_filter input').val('');
				$('#tbl_employee_filter input').focus();
				tabRow = 0;
				tbl_employee.$('tr.highlight').removeClass('highlight');
				$('#tbl_employee tbody tr:eq('+tabRow+')').addClass('highlight');
			}, 100);
		});
		$('#tbl_employee_paginate').on('click', function(){
			tabRow = 0;
			tbl_employee.$('tr.highlight').removeClass('highlight');
			$('#tbl_employee tbody tr:eq('+tabRow+')').addClass('highlight');
		});

	


		//-------------------------------------------------
		var tbl_supplier = $('#tbl_supplier').DataTable({
			'bSort' : true,
			'aLengthMenu' : [[10,50,100,-1],[10,50,100,'All']],
			'iDisplayLength' : 10,
			fixedHeader: {
				header: false,
			}
		});
		$('#tbl_supplier_filter input').bind('keydown', function(e){
			switch(e.keyCode){
				case 9:
					e.preventDefault();
					$('#taberino a[href="#tab_project"]').trigger('click');
					break;
				case 13: 
					e.preventDefault();
					$('#tbl_supplier tbody tr:eq('+tabRow+')').click();
					$('#remarks').focus();
					break;
				case 27:
					e.preventDefault();
					closeTaberino();
					break;
				case 37:
					e.preventDefault();
					tabRow = 0;
					tbl_supplier.page('previous').draw('page');
					tbl_supplier.$('tr.highlight').removeClass('highlight');
					$('#tbl_supplier tbody tr:eq('+tabRow+')').addClass('highlight');
					break;
				case 38:
					e.preventDefault();
					tbl_supplier.$('tr.highlight').removeClass('highlight');
					tabRow--;
					if (tabRow < 0) { tabRow = $('#tbl_supplier tbody tr').length-1; }
					$('#tbl_supplier tbody tr:eq('+tabRow+')').addClass('highlight');
					break;
				case 39:
					e.preventDefault();
					tabRow = 0;
					tbl_supplier.page('next').draw('page');
					tbl_supplier.$('tr.highlight').removeClass('highlight');
					$('#tbl_supplier tbody tr:eq('+tabRow+')').addClass('highlight');
					break;
				case 40:
					e.preventDefault();
					tbl_supplier.$('tr.highlight').removeClass('highlight');
					tabRow++;
					if (tabRow > $('#tbl_supplier tbody tr').length-1) { tabRow = 0; }
					$('#tbl_supplier tbody tr:eq('+tabRow+')').addClass('highlight');
					break;
				default:
					tabRow = 0;
					tbl_supplier.$('tr.highlight').removeClass('highlight');
					$('#tbl_supplier tbody tr:eq('+tabRow+')').addClass('highlight');
					break;
			}
		});
		$('#tbl_supplier tbody').on('click', 'tr', function(){
			var data = tbl_supplier.row(this).data();
			var str = data[1];
			$('#subsidiary_table').val('supplier');
			$('#sub_code').val(data[0]);
			$('#department').val(str.replace('&amp;', '&'));
			$('#frm_activitycenter .close').click();
			$('#department_error').text('');
		});
		$('#taberino a[href="#tab_supplier"]').bind('click', function(){
			setTimeout( function(){
				$('#tbl_supplier_filter input').val('');
				$('#tbl_supplier_filter input').focus();
				tabRow = 0;
				tbl_supplier.$('tr.highlight').removeClass('highlight');
				$('#tbl_supplier tbody tr:eq('+tabRow+')').addClass('highlight');
			}, 100);
		});
		$('#tbl_supplier_paginate').on('click', function(){
			tabRow = 0;
			tbl_supplier.$('tr.highlight').removeClass('highlight');
			$('#tbl_supplier tbody tr:eq('+tabRow+')').addClass('highlight');
		});


		var tbl_project = $('#tbl_project').DataTable({
			'bSort' : true,
			'aLengthMenu' : [[10,50,100,-1],[10,50,100,'All']],
			'iDisplayLength' : 10,
			fixedHeader: {
				header: false,
			}
		});
		$('#tbl_project_filter input').bind('keydown', function(e){
			switch(e.keyCode){
				case 9:
					e.preventDefault();
					$('#taberino a[href="#tab_customer"]').trigger('click');
					break;
				case 13: 
					e.preventDefault();
					$('#tbl_project tbody tr:eq('+tabRow+')').click();
					$('#remarks').focus();
					break;
				case 27:
					e.preventDefault();
					closeTaberino();
					break;
				case 37:
					e.preventDefault();
					tabRow = 0;
					tbl_project.page('previous').draw('page');
					tbl_project.$('tr.highlight').removeClass('highlight');
					$('#tbl_project tbody tr:eq('+tabRow+')').addClass('highlight');
					break;
				case 38:
					e.preventDefault();
					tbl_project.$('tr.highlight').removeClass('highlight');
					tabRow--;
					if (tabRow < 0) { tabRow = $('#tbl_project tbody tr').length-1; }
					$('#tbl_project tbody tr:eq('+tabRow+')').addClass('highlight');
					break;
				case 39:
					e.preventDefault();
					tabRow = 0;
					tbl_project.page('next').draw('page');
					tbl_project.$('tr.highlight').removeClass('highlight');
					$('#tbl_project tbody tr:eq('+tabRow+')').addClass('highlight');
					break;
				case 40:
					e.preventDefault();
					tbl_project.$('tr.highlight').removeClass('highlight');
					tabRow++;
					if (tabRow > $('#tbl_project tbody tr').length-1) { tabRow = 0; }
					$('#tbl_project tbody tr:eq('+tabRow+')').addClass('highlight');
					break;
				default:
					tabRow = 0;
					tbl_project.$('tr.highlight').removeClass('highlight');
					$('#tbl_project tbody tr:eq('+tabRow+')').addClass('highlight');
					break;
			}
		});
		$('#tbl_project tbody').on('click', 'tr', function(){
			var data = tbl_project.row(this).data();
			var str = data[1];
			$('#subsidiary_table').val('project');
			$('#sub_code').val(data[0]);
			$('#department').val(str.replace('&amp;', '&'));
			$('#frm_activitycenter .close').click();
			$('#department_error').text('');
		});
		$('#taberino a[href="#tab_project"]').bind('click', function(){
			setTimeout( function(){
				$('div#tbl_project_filter input').val('');
				$('div#tbl_project_filter input').focus();
				tabRow = 0;
				tbl_project.$('tr.highlight').removeClass('highlight');
				$('#tbl_project tbody tr:eq('+tabRow+')').addClass('highlight');
			}, 100);
		});
		$('#tbl_project_paginate').on('click', function(){
			tabRow = 0;
			tbl_project.$('tr.highlight').removeClass('highlight');
			$('#tbl_project tbody tr:eq('+tabRow+')').addClass('highlight');
		});


		function closeTaberino(){
			$('#tbl_customer_filter input').val('');
			$('#tbl_department_filter input').val('');
			$('#tbl_employee_filter input').val('');
			$('#tbl_supplier_filter input').val('');
			$('#tbl_project_filter input').val('');
			$('#frm_activitycenter .close').click();
		}


//-----------------------------------------------------------------------
//Buttons
		$('#btn_add').click(function(){
			$('#frm_information').attr('action', baseurl+'accounting/journalentry/insertJournal');
			showFormInformation('insert');
			showPost();		
		});

		$('#btn_back').click(function(){
			$('#frm_information').hide();
			$('#frm_masterlist').show();
			$('#tbl_masterlist_filter input').focus();
			masterRow = -1;
		});

		$('#frm_information').submit(function(){
			$('#date_now').val(d.getFullYear()+"-"+(d.getMonth()+1)+"-"+d.getDate()+" "+d.getHours()+":"+d.getMinutes()+":"+d.getSeconds());
			$('#post_date').removeAttr('readonly');
			$('#reference_code').removeAttr('readonly');
			//$('#reference_number').removeAttr('readonly');
		});

		$('#frm_bookregister').on('click', '.close', function(){
			$('#book_code').focus();
		});

		$('#frm_activitycenter').on('click', '.close', function(){
			$('#department').focus();
		});
		
		$('#btn_post').click(function(){
			if ($('#book_code').val().length > 0 && $('#department').val().length > 0) {
				$('#date_now').val(d.getFullYear()+"-"+(d.getMonth()+1)+"-"+d.getDate()+" "+d.getHours()+":"+d.getMinutes()+":"+d.getSeconds());
				$('#post_date').val(d.getFullYear()+"-"+(d.getMonth()+1)+"-"+d.getDate()+" "+d.getHours()+":"+d.getMinutes()+":"+d.getSeconds());
				$('#post_status').val('posted');
				$('#frm_information').submit();
			} else {
				if($('#book_code').val().length == 0){
					$('#bookcode_error').text('Book Code cannot be empty. Please fill in the blank.');
				}
				if($('#department').val().length == 0){
					$('#department_error').text('Subsidiary cannot be empty. Please fill in the blank.');
				}
			}
		});

		$('#btn_save').click(function(){
			if ($('#book_code').val().length > 0 && $('#department').val().length > 0) {
				$('#date_now').val(d.getFullYear()+"-"+(d.getMonth()+1)+"-"+d.getDate()+" "+d.getHours()+":"+d.getMinutes()+":"+d.getSeconds());
				$('#frm_information').submit();
			} else {
				if($('#book_code').val().length == 0){
					$('#bookcode_error').text('Book Code cannot be empty. Please fill in the blank.');
				}
				if($('#department').val().length == 0){
					$('#department_error').text('Subsidiary cannot be empty. Please fill in the blank.');
				}
			}
		});
//------------------------------------------------------------------------------
//display modals
		$('#book_code').click(function(){
			showFormBook();
		});
		$('#book_code').bind('keydown', function (e){
			switch(e.keyCode){
				case 8:
					e.preventDefault();
					$(this).val('');
					$('#book_description').val('');
					$('#reference_code').val('');
					//$('#reference_number').val('');
					break;
				case 9: //tab
					e.preventDefault();
					if($(this).val().length > 0){
						$('#bookcode_error').text('');
						setBookCode();
					} else {
						$(this).focus();
						$('#bookcode_error').text('Book Code cannot be empty. Please fill in the blank.');
					} 
					break;

				case 13: //enter
				 	e.preventDefault();
					if ($(this).val().length > 0) {
						setBookCode();
					} else {
						showFormBook();
					}
					break;

				case 27:
					e.preventDefault();
					$('#btn_back').click();
					break;
			}
		});



		$('#department').click(function(){
			showFormActivity();
		});
		$('#department').bind('keydown', function(e){
			switch(e.keyCode){
				case 8:
					e.preventDefault();
					$('#department').val('');
					$('#sub_code').val('');
					$('#subsidiary_table').val('');
					break;
				case 9: //tab
					e.preventDefault();
					if ($(this).val().length == 0) {
						$('#sub_code').val('');
						$('#subsidiary_table').val('');
						$(this).focus();
						$('#department_error').text('Subsidiary cannot be empty. Please fill in the blank.');
					} else {
						$('#remarks').focus();
						$('#department_error').text('');
					}
					break;
				case 13: //enter
					e.preventDefault();
					showFormActivity();
					break;
				default:
					e.preventDefault();
					break;
			}
		});
//-----------------------------------------------------------------------------		
//search boxes	
		$('#txt_searchbook').keydown(function(e){
			switch(e.keyCode){
				case 9:
					e.preventDefault();
					$('#txt_searchbook').focus();
					break;	
			}
		});
		$('#txt_searchbook').keyup(function(e){
			switch(e.keyCode){
				case 13: //enter
					e.preventDefault();
					$('#book_code').val($('#tbl_bookregister tbody tr').children(':visible:eq('+((currentRow-1)*2)+')').text());
					setBookCode();
					$('#tbl_bookregister tr:visible:eq('+currentRow+') td').removeClass('highlight');
					closeFormBook();
					break;

				case 27: //escape
					e.preventDefault();
					$('#tbl_bookregister tr:visible:eq('+currentRow+') td').removeClass('highlight');
					closeFormBook();
					$('#book_code').focus();
					break;

				case 37:
				case 39:
					e.preventDefault();
					break;

				case 38:
					e.preventDefault();
					previousRow = currentRow;
					currentRow--;
					drawTableBook();
					$('#txt_searchbook').val($('#tbl_bookregister tbody tr').children(':visible:eq('+((currentRow-1)*2)+')').text());
					break;

				case 40:
					e.preventDefault();
					previousRow = currentRow;
					currentRow++;
					drawTableBook();
					$('#txt_searchbook').val($('#tbl_bookregister tbody tr').children(':visible:eq('+((currentRow-1)*2)+')').text());
					break;

				default:
					$('#tbl_bookregister tr:visible:eq('+currentRow+') td').removeClass('highlight');
					var searchText = $(this).val().toLowerCase();
					$.each($('#tbl_bookregister tbody tr'), function(){
						if($(this).children(':eq(0)').text().toLowerCase().indexOf(searchText) === 0 || $(this).children(':eq(1)').text().toLowerCase().indexOf(searchText) === 0){
							$(this).show();
						} else {
							$(this).hide();
							$(this).removeClass('highlight');
						}
					});
					previousRow = currentRow;
					currentRow = 1;
					drawTableBook();
					break;
			}
		});

		


		$('#txt_searchaccount').keydown(function (e){
			switch(e.keyCode ){
				case 9:
					e.preventDefault();
					$('#txt_searchaccount').focus();
					break;
			}
		});
		$('#txt_searchaccount').keyup(function(e){
			switch(e.keyCode){
				case 13: //enter
					e.preventDefault();
					$('#tbl_transactiondetail tbody tr').children(':eq('+((detailRow*8)+1)+')').find('input').val($('#tbl_accountcode tbody tr').children(':visible:eq('+((currentRow-1)*2)+')').text());
					$('#tbl_transactiondetail tbody tr').children(':eq('+((detailRow*8)+2)+')').find('input').val($('#tbl_accountcode tbody tr').children(':visible:eq('+((currentRow*2)-1)+')').text());
					$('#tbl_accountcode tr:visible:eq('+currentRow+') td').removeClass('highlight');
					//setAccountCode();
					closeFormAccount();
					if($('#tbl_accountcode tbody tr').children(':visible').length == 0){
						$('#tbl_transactiondetail tbody tr').children(':eq('+((detailRow*8)+1)+')').find('input').focus();
					} else {
						$('#tbl_transactiondetail tbody tr').children(':eq('+((detailRow*8)+3)+')').find('input').focus();
					}
					break;

				case 27: //escape
					e.preventDefault();
					$('#tbl_accountcode tr:visible:eq('+currentRow+') td').removeClass('highlight');
					closeFormAccount();
					$('#tbl_transactiondetail tbody tr').children(':eq('+((detailRow*8)+1)+')').find('input').focus();
					break;

				case 37:
				case 39:
					e.preventDefault();
					break;

				case 38:
					e.preventDefault();
					previousRow = currentRow;
					currentRow--;
					drawTableAccount();
					$('#txt_searchaccount').val($('#tbl_accountcode tbody tr').children(':visible:eq('+((currentRow-1)*2)+')').text());
					break;

				case 40:
					e.preventDefault();
					previousRow = currentRow;
					currentRow++;
					drawTableAccount();
					$('#txt_searchaccount').val($('#tbl_accountcode tbody tr').children(':visible:eq('+((currentRow-1)*2)+')').text());
					break;

				default:
					$('#tbl_accountcode tr:visible:eq('+currentRow+') td').removeClass('highlight');
						
					var searchText = $(this).val().toLowerCase();
					$.each($("#tbl_accountcode tbody tr"), function(){
						if($(this).children(':eq(0)').text().indexOf(searchText) === 0 || $(this).children(':eq(1)').text().toLowerCase().indexOf(searchText) === 0){
							$(this).show();
						} else {
							$(this).hide();
							$(this).removeClass('highlight');
						}
					});
					previousRow = currentRow;
					currentRow = 1;
					drawTableAccount();
					break;
			}
		});

		$('#txt_searchsub').keydown(function(e){
			switch(e.keyCode){
				case 9:
					e.preventDefault();
					$('#txt_searchsub').focus();
					break;
			}
		});
		$('#txt_searchsub').keyup(function(e){
			switch(e.keyCode){
				case 13:
					e.preventDefault();
					$('#tbl_transactiondetail tbody tr').children(':eq('+((detailRow*8)+3)+')').find('input').val($('#tbl_subsidiary tbody tr').children(':visible:eq('+((currentRow-1)*2)+')').text());
					$('#tbl_transactiondetail tbody tr').children(':eq('+((detailRow*8)+4)+')').find('input').val($('#tbl_subsidiary tbody tr').children(':visible:eq('+((currentRow*2)-1)+')').text());
					$('#tbl_subsidiary tr:visible:eq('+currentRow+') td').removeClass('highlight');
					closeFormSubsidiary();
					$('#tbl_transactiondetail tbody tr').children(':eq('+((detailRow*8)+5)+')').find('input').focus();
					break;

				case 27:
					e.preventDefault();
					$('#tbl_subsidiary tr:visible:eq('+currentRow+') td').removeClass('highlight');
					closeFormSubsidiary();
					$('#tbl_transactiondetail tbody tr').children(':eq('+((detailRow*8)+3)+')').find('input').focus();
					break;
				
				case 37:
				case 39:
					e.preventDefault();
					break;

				case 38:
					e.preventDefault();
					previousRow = currentRow;
					currentRow--;
					drawTableSubsidiary();
					$('#txt_searchsub').val($('#tbl_subsidiary tbody tr').children(':visible:eq('+((currentRow-1)*2)+')').text());
					break;

				case 40:
					e.preventDefault();
					previousRow = currentRow;
					currentRow++;
					drawTableSubsidiary();
					$('#txt_searchsub').val($('#tbl_subsidiary tbody tr').children(':visible:eq('+((currentRow-1)*2)+')').text());
					break;

				default:
					$('#tbl_subsidiary tr:visible:eq('+currentRow+') td').removeClass('highlight');
					
					var searchText = $(this).val().toLowerCase();
					$.each($("#tbl_subsidiary tbody tr"), function(){
						if($(this).children(':eq(0)').text().indexOf(searchText) === 0 || $(this).children(':eq(1)').text().toLowerCase().indexOf(searchText) === 0){
							$(this).show();
						} else {
							$(this).hide();
							$(this).removeClass('highlight');
						}
					});
					previousRow = currentRow;
					currentRow = 1;
					drawTableSubsidiary();
					break;
			}
		});
//----------------------------------------------------------------------
//tables on show
		$('#frm_bookregister').on('shown.bs.modal', function(){
			$('#txt_searchbook').focus();
			previousRow = 0;
			currentRow = 1;
			drawTableBook();
		});


		$('#frm_account').on('shown.bs.modal', function(){
			$('#txt_searchaccount').focus();
			previousRow = 0;
			currentRow = 1;
			drawTableAccount();
		});

		$('#frm_subsidiary').on('shown.bs.modal', function(){
				$('#txt_searchsub').focus();
				previousRow = 0;
				currentRow = 1;
				drawTableSubsidiary();
		});
//------------------------------------------------------------------------
//tables click
		$('#tbl_bookregister tbody tr').click(function(){
			$('#book_code').val($(this).find('td').first().text());
			$('#book_description').val($(this).children(':eq(1)').text());
			setBookCode();
			closeFormBook();
		});


		$('#tbl_accountcode tbody tr').click(function(){
			$('#tbl_transactiondetail tbody tr').children(':eq('+((detailRow*8)+1)+')').find('input').val($(this).find('td').first().text());
			$('#tbl_transactiondetail tbody tr').children(':eq('+((detailRow*8)+2)+')').find('input').val($(this).children(':visible:eq(1)').text());
			closeFormAccount();
			$('#tbl_transactiondetail tbody tr').children(':eq('+((detailRow*8)+3)+')').find('input').focus();
		});


		$('#tbl_subsidiary tbody').on('click', 'td', function(){
			$('#tbl_transactiondetail tbody tr').children(':eq('+((detailRow*8)+3)+')').find('input').val($(this).closest('tr').children(':visible:eq(0)').text());
			$('#tbl_transactiondetail tbody tr').children(':eq('+((detailRow*8)+4)+')').find('input').val($(this).closest('tr').children(':visible:eq(1)').text());
			closeFormSubsidiary();
			$('#tbl_transactiondetail tbody tr').children(':eq('+((detailRow*8)+5)+')').find('input').focus();
		});
		
//------------------------------------------------------------------------
//special magic shit -----------------------------------------------------------
		$('#tbl_transactiondetail tbody').on('click', 'td', function(){
			detailRow = $(this).closest('tr').index();
		});

		$('#tbl_transactiondetail tbody').on('click', '.account-code', function(){
			if($('input .account-code').is(':disabled')){
			} else {
				showFormAccount();
			}
		});

		$('#tbl_transactiondetail tbody').on('keydown', '.account-code', function(e){
			var str = $(this).val();
			switch(e.keyCode){
				case 9:
					e.preventDefault();
					if (str.length > 0) {
						setAccountCode();
					} else {
						$('#tbl_transactiondetail tbody tr').children(':eq('+((detailRow*8)+3)+')').find('input').focus();
					}
					break;
				case 13:
					e.preventDefault();
					if (str.length > 0) {
						setAccountCode();
					} else {
						showFormAccount();
					}
					break;
				case 37:
					e.preventDefault();
					$('#tbl_transactiondetail tbody tr').children(':eq('+((detailRow*8)+7)+')').find('textarea').focus();
					break;
				case 38:
					e.preventDefault();
					detailRow--;
					if(detailRow < 0){
						detailRow = $('#tbl_transactiondetail tbody tr').length-1;
					}
					$('#tbl_transactiondetail tbody tr').children(':eq('+((detailRow*8)+1)+')').find('input').focus();
					break;
				case 39:
					e.preventDefault();
					$('#tbl_transactiondetail tbody tr').children(':eq('+((detailRow*8)+3)+')').find('input').focus();
					break;
				case 40:
					e.preventDefault();
					detailRow++;
					if(detailRow > $('#tbl_transactiondetail tbody tr').length-1){
						detailRow = 0;
					}
					$('#tbl_transactiondetail tbody tr').children(':eq('+((detailRow*8)+1)+')').find('input').focus();
					break;
			}
		});

		$('#tbl_transactiondetail tbody').on('click', '.subsidiary-code', function(){
			getSubsidiaryTable();
			showFormSubsidiary();
		});

		$('#tbl_transactiondetail tbody').on('keydown', '.subsidiary-code', function(e){
			var str = $(this).val();
			switch(e.keyCode){
				case 9:
					e.preventDefault();
					if(str.length > 0){
						setSubsidiaryCode();
					} else {
						$('#tbl_transactiondetail tbody tr').children(':eq('+((detailRow*8)+5)+')').find('input').focus();
					}
					break;
				case 13: 
					e.preventDefault(); 
					if(str.length > 0){
						setSubsidiaryCode();
					} else {
						getSubsidiaryTable();
						showFormSubsidiary();
					}
					break;
				case 37:
					e.preventDefault();
					$('#tbl_transactiondetail tbody tr').children(':eq('+((detailRow*8)+1)+')').find('input').focus();
					break;
				case 38:
					e.preventDefault();
					detailRow--;
					if(detailRow < 0){
						detailRow = $('#tbl_transactiondetail tbody tr').length-1;
					}
					$('#tbl_transactiondetail tbody tr').children(':eq('+((detailRow*8)+3)+')').find('input').focus();
					break;
				case 39:
					e.preventDefault();
					$('#tbl_transactiondetail tbody tr').children(':eq('+((detailRow*8)+5)+')').find('input').focus();
					break;
				case 40:
					e.preventDefault();
					detailRow++;
					if(detailRow > $('#tbl_transactiondetail tbody tr').length-1){
						detailRow = 0;
					}
					$('#tbl_transactiondetail tbody tr').children(':eq('+((detailRow*8)+3)+')').find('input').focus();
					break;
			}
		});

		$('#tbl_transactiondetail tbody').on('keydown', '.debit', function(e){
			switch(e.keyCode){
				case 37:
					e.preventDefault();
					$('#tbl_transactiondetail tbody tr').children(':eq('+((detailRow*8)+3)+')').find('input').focus();
					break;
				case 38:
					e.preventDefault();
					detailRow--;
					if(detailRow < 0){
						detailRow = $('#tbl_transactiondetail tbody tr').length-1;
					}
					$('#tbl_transactiondetail tbody tr').children(':eq('+((detailRow*8)+5)+')').find('input').focus();
					break;
			  case 39:
			  	e.preventDefault();
					$('#tbl_transactiondetail tbody tr').children(':eq('+((detailRow*8)+6)+')').find('input').focus();
					break;
				case 40:
					e.preventDefault();
					detailRow++;
					if(detailRow > $('#tbl_transactiondetail tbody tr').length-1){
						detailRow = 0;
					}
					$('#tbl_transactiondetail tbody tr').children(':eq('+((detailRow*8)+5)+')').find('input').focus();
					break;
			}
			calcDebit();
			calcTotal();
			showPost();
		});
	

		$('#tbl_transactiondetail tbody').on('keydown', '.credit', function(e){
			switch(e.keyCode){
				case 37:
					e.preventDefault();
					$('#tbl_transactiondetail tbody tr').children(':eq('+((detailRow*8)+5)+')').find('input').focus();
					break;
				case 38:
					e.preventDefault();
					detailRow--;
					if(detailRow < 0){
						detailRow = $('#tbl_transactiondetail tbody tr').length-1;
					}
					$('#tbl_transactiondetail tbody tr').children(':eq('+((detailRow*8)+6)+')').find('input').focus();
					break;
				case 39:
					e.preventDefault();
					$('#tbl_transactiondetail tbody tr').children(':eq('+((detailRow*8)+7)+')').find('textarea').focus();
					break;
				case 40:
					e.preventDefault();
					detailRow++;
					if(detailRow > $('#tbl_transactiondetail tbody tr').length-1){
						detailRow = 0;
					}
					$('#tbl_transactiondetail tbody tr').children(':eq('+((detailRow*8)+6)+')').find('input').focus();
					break;
			}
			calcCredit();
			calcTotal();
			showPost();
		});
	
//----------------------------------------------------------------------
		$('#tbl_transactiondetail tbody').on('keydown','.detail-remarks', function(e){
			switch(e.keyCode){
				case 9:
					e.preventDefault();
					eraseRow = false;
					detailRow++;
					if (detailRow < $('#tbl_transactiondetail tbody tr').length) {
						$('#tbl_transactiondetail tbody tr').children(':eq('+((detailRow*8)+1)+')').find('input').focus();
					} else {
						if($('#btn_post').is(':disabled')){
							$('#btn_save').focus();
						} else {
							$('#btn_post').focus();
						}
					}
					break;
				case 13:
					e.preventDefault();
					eraseRow = false;
					var newrow = '<tr><td style="visibility: hidden;"><input type="hidden" class="transaction_detail_id" id="transaction_detail_id" name="transaction_detail_id[]" value="0"></td>'+
					'<td ><input type="text" class="form-control input-sm account-code" name="account_code[]"></td>'+
					'<td ><input type="text" class="form-control input-sm" id="account_description" readonly="readonly" tabindex="-1"></td>'+
					'<td ><input type="text" class="form-control input-sm subsidiary-code" id="subsidiary_code" name="subsidiary_code[]"></td>'+
					'<td ><input type="text" class="form-control input-sm" id="subsidiary_description" readonly="readonly" tabindex="-1"></td>'+
					'<td ><input type="number" class="form-control input-sm debit" id="debit" name="debit[]"></td>'+
					'<td ><input type="number" class="form-control input-sm credit" id="credit" name="credit[]"></td>'+
					'<td rowspan="1"><textarea rows="1" class="form-control detail-remarks" id="detail_remarks" name="detail_remarks[]"></textarea></td></tr>';
					$('#tbl_transactiondetail').append(newrow);
					detailRow = $('#tbl_transactiondetail tbody tr').length-1;
					//console.log('detailRow:'+((detailRow*8)+1));
					$('#tbl_transactiondetail tbody tr').children(':eq('+((detailRow*8)+1)+')').find('input').focus();
					break;

				case 37:
					e.preventDefault();
					eraseRow = false;
					$('#tbl_transactiondetail tbody tr').children(':eq('+((detailRow*8)+6)+')').find('input').focus();
					break;
				case 38:
					e.preventDefault();
					eraseRow = false;
					detailRow--;
					if(detailRow < 0){
						detailRow = $('#tbl_transactiondetail tbody tr').length-1;
					}
					$('#tbl_transactiondetail tbody tr').children(':eq('+((detailRow*8)+7)+')').find('textarea').focus();
					break;
				case 39:
					e.preventDefault();
					eraseRow = false;
					$('#tbl_transactiondetail tbody tr').children(':eq('+((detailRow*8)+1)+')').find('input').focus();
					break;
				case 40:
					e.preventDefault();
					eraseRow = false;
					detailRow++;
					if(detailRow > $('#tbl_transactiondetail tbody tr').length-1){
						detailRow = 0;
					}
					$('#tbl_transactiondetail tbody tr').children(':eq('+((detailRow*8)+7)+')').find('textarea').focus();
					break;

				case 46:
					e.preventDefault();
					if($('#tbl_transactiondetail tbody tr').length != 1) {
						if($('#tbl_transactiondetail tbody tr').children(':eq('+((detailRow*8))+')').find('input').val() != 0){
							if (eraseRow) {
								$('#tbl_transactiondetail tbody tr').children(':eq('+((detailRow*8)+1)+')').find('input').val('');
								$('#tbl_transactiondetail tbody tr').children(':eq('+((detailRow*8)+2)+')').find('input').val('');
								$('#tbl_transactiondetail tbody tr').children(':eq('+((detailRow*8)+3)+')').find('input').val('');
								$('#tbl_transactiondetail tbody tr').children(':eq('+((detailRow*8)+4)+')').find('input').val('');
								$('#tbl_transactiondetail tbody tr').children(':eq('+((detailRow*8)+5)+')').find('input').val('');
								$('#tbl_transactiondetail tbody tr').children(':eq('+((detailRow*8)+6)+')').find('input').val('');
								$('#tbl_transactiondetail tbody tr').children(':eq('+((detailRow*8)+7)+')').find('input').val('');
								eraseRow = false;
							} else {
								toastr.warning('Cannot Delete Row. Press Del again to erase data.', 'System Warning!');
								eraseRow = true;
							}
							
						} else {
							$(this).closest('tr').remove();
							detailRow--;
							$('#tbl_transactiondetail tbody tr').children(':eq('+((detailRow*8)+7)+')').find('textarea').focus();
							calcDebit();
							calcCredit();
							calcTotal();
						}
					} else {
						toastr.warning('Cannot Delete Last Row', 'System Warning!');
					}
					break;
				default:
					eraseRow = false;
					break;
			}
		});

//-----------------------------------------------------------------------
//UPDATE
		$('#tbl_masterlist tbody').on('dblclick', 'tr', function(){
			$('#frm_information').attr('action', baseurl+'accounting/journalentry/updateJournal');
			var transactionid = $(this).children(':eq(0)').text();
			$.ajax({
				type: 'POST',
				url: baseurl+'Accounting/Journalentry/getTransactionByID',
				dataType: 'json',
				data: {'transactionid':transactionid},
				success: function(data){
					//console.log(data);
					$('#transaction_id').val(data[0].transaction_id);
					$('#post_status').val(data[0].post_status);
					$('#book_id').val(data[0].book_id);
					$('#book_code').val(data[0].book_code);
					$('#book_description').val(data[0].book_description);
					$('#sub_code').val(data[0].subsidiary_code);
					$('#subsidiary_table').val(data[0].subsidiary_table);
					$('#department').val(data[0].subsidiary_name);
					$('#reference_code').val(data[0].book_reference);
					$('#reference_number').val(data[0].reference);
					if(data[0].post_date == '0000-00-00 00:00:00'){
						$('#post_date').val('');
					} else {
						$('#post_date').val(data[0].post_date);
					}
					$('#remarks').val(data[0].remarks);
					$('#is_locked').val(data[0].is_locked);

					
					$.ajax({
						type: 'POST',
						url: baseurl+'accounting/journalentry/getTransactionDetailByID',
						dataType: 'json',
						data: {'transactionid': transactionid},
						success: function(data){
							$('#tbl_transactiondetail tbody').empty();
							if(data != false){
								var items = '';
								for(var i = 0; i <= data.length - 1; i++){
									var sbc = '', sbd = '';
									if(data[i].subsidiary_code == null){ sbc = ''; }else{ sbc = data[i].subsidiary_code}
									if(data[i].subsidiary_description == null){ sbd = ''; }else{ sbd = data[i].subsidiary_description}
									items+= '<tr><td style="visibility: hidden;"><input type="hidden" class="transaction_detail_id" id="transaction_detail_id" name="transaction_detail_id[]" value="'+data[i].transaction_detail_id+'"></td>'+
										'<td ><input type="text" class="form-control input-sm account-code" name="account_code[]" value="'+data[i].account_code+'"></td>'+
										'<td ><input type="text" class="form-control input-sm" id="account_description" readonly="readonly" tabindex="-1" value="'+data[i].account_name+'"></td>'+
										'<td ><input type="text" class="form-control input-sm subsidiary-code" id="subsidiary_code" name="subsidiary_code[]" value="'+sbc +'"></td>'+
										'<td ><input type="text" class="form-control input-sm" id="subsidiary_description" readonly="readonly" tabindex="-1" value="'+sbd+'"></td>'+
										'<td ><input type="number" class="form-control input-sm debit" id="debit" name="debit[]" value="'+data[i].debit+'"></td>'+
										'<td ><input type="number" class="form-control input-sm credit" id="credit" name="credit[]" value="'+data[i].credit+'"></td>'+
										'<td rowspan="1"><textarea rows="1" class="form-control detail-remarks" id="detail_remarks" name="detail_remarks[]" value="'+data[i].remarks+'"></textarea></td></tr>';
								}
							} else {
								items = '<tr><td style="visibility: hidden;"><input type="hidden" class="transaction_detail_id" id="transaction_detail_id" name="transaction_detail_id[]" value="0"></td>'+
									'<td ><input type="text" class="form-control input-sm account-code" name="account_code[]"></td>'+
									'<td ><input type="text" class="form-control input-sm" id="account_description" readonly="readonly" tabindex="-1"></td>'+
									'<td ><input type="text" class="form-control input-sm subsidiary-code" id="subsidiary_code" name="subsidiary_code[]"></td>'+
									'<td ><input type="text" class="form-control input-sm" id="subsidiary_description" readonly="readonly" tabindex="-1"></td>'+
									'<td ><input type="number" class="form-control input-sm debit" id="debit" name="debit[]"></td>'+
									'<td ><input type="number" class="form-control input-sm credit" id="credit" name="credit[]"></td>'+
									'<td rowspan="1"><textarea rows="1" class="form-control detail-remarks" id="detail_remarks" name="detail_remarks[]"></textarea></td></tr>';
							}
							$('#tbl_transactiondetail').append(items);
						},
						error: function(errorThrown){
							toastr.error('TransactionDetail Masterlist Error#10001', 'Operation Failed');
							console.log(errorThrown);
						}
					});
				},
				error: function(errorThrown){
					toastr.error('Transaction Masterlist Error#10100','Operation Failed');
					console.log(errorThrown);
				}
			});

			setTimeout(function(){
				calcDebit();
				calcCredit();
				calcTotal();
				showFormInformation('update');
				showPost();
			}, 500);
		});

//----------------------------------------------------------------------
//functions

		function setBookCode(){
			$.ajax({
				type: 'POST',
				url: baseurl + 'accounting/journalentry/getBookByCode',
				dataType: 'json',
				data: {'bookcode': $('#book_code').val()},
				success: function(data){
					if (data) {
						$('#book_id').val(data[0].book_register_id);
						$('#book_description').val(data[0].book_description);
						$('#reference_code').val(data[0].book_reference);
						//$('#department').focus();
						$('#reference_number').focus();
						$('#bookcode_error').text('');
						/*$.ajax({
							type: 'POST',
							url: baseurl + 'accounting/journalentry/getMaxReference',
							dataType: 'json',
							data: {'prefix': data[0].book_reference},
							success: function(data){
								if (data == false){
									$('#reference_number').val('Temporary ID:0000000001');
								} else {
									var reference = data[0].reference;
									var asdf = '', fdsa = '';
									for (var i = 0; i <= reference.length-1; i++) {
										if (reference.substring(i,i+1) != '0') {
											fdsa = reference.substring(i);
											break;
										} 
									}
									fdsa++;
									for (var i = 0; i < 10-fdsa.toString().length; i++) {
										asdf += '0';
									}
									console.log('asdf:'+asdf);
									console.log('fdsa:'+fdsa);
									$('#reference_number').val('Temporary ID:'+asdf+fdsa);
								}
							},
							error: function(errorThrown){
								toastr.error('Max Reference Error#:98314', 'Operation Failed');
								console.log(errorThrown);
							}
						});*/
					} else {
						$('#book_id').val('');
						$('#book_code').val('');
						$('#book_description').val('');
						$('#reference_code').val('');
						$('#book_code').focus();		
					}
				},
				error: function(errorThrown){
					toastr.error('Book Register Error#:23186', 'Operation Failed');
					console.log(errorThrown);
					$('#book_code').focus();
				}
			});
		}


		function setAccountCode(){
			$.ajax({
				type: 'POST',
				url: baseurl + 'accounting/journalentry/getAccountByCode',
				dataType: 'json',
				data: {'accountcode': $('#tbl_transactiondetail tbody tr').children(':eq('+((detailRow*8)+1)+')').find('input').val()},
				success: function(data){
					if (data == false) {
						$('#tbl_transactiondetail tbody tr').children(':eq('+((detailRow*8)+1)+')').find('input').val('');
						$('#tbl_transactiondetail tbody tr').children(':eq('+((detailRow*8)+2)+')').find('input').val('');
						$('#tbl_transactiondetail tbody tr').children(':eq('+((detailRow*8)+1)+')').find('input').focus();
					} else {
						$('#tbl_transactiondetail tbody tr').children(':eq('+((detailRow*8)+2)+')').find('input').val(data[0].account_name);
						$('#tbl_transactiondetail tbody tr').children(':eq('+((detailRow*8)+3)+')').find('input').focus();
					}
				},
				error: function(errorThrown){
					toastr.error('Account Code Error#:53971', 'Operation Failed');
					console.log(errorThrown);
				}
			});
		}

		function setSubsidiaryCode(){
			$.ajax({
				type: 'POST',
				url: baseurl + 'accounting/journalentry/getSubsidiaryByCode',
				dataType: 'json',
				data: {'accountcode':$('#tbl_transactiondetail tbody tr').children(':eq('+((detailRow*8)+1)+')').find('input').val(), 'subsidiarycode': $('#tbl_transactiondetail tbody tr').children(':eq('+((detailRow*8)+3)+')').find('input').val()},
				success: function(data){
					if (data == false){
						$('#tbl_transactiondetail tbody tr').children(':eq('+((detailRow*8)+3)+')').find('input').val('');
						$('#tbl_transactiondetail tbody tr').children(':eq('+((detailRow*8)+4)+')').find('input').val('');
						$('#tbl_transactiondetail tbody tr').children(':eq('+((detailRow*8)+3)+')').find('input').focus();
					} else {
						$('#tbl_transactiondetail tbody tr').children(':eq('+((detailRow*8)+4)+')').find('input').val(data[0].subsidiary_description);
						$('#tbl_transactiondetail tbody tr').children(':eq('+((detailRow*8)+5)+')').find('input').focus();
					}
				},
				error: function(errorThrown){
					toastr.error('Subsidiary Code Error#:68131', 'Operation Failed');
					console.log(errorThrown);
				}
			});
		}

		function getSubsidiaryTable(){
			$('#tbl_subsidiary tbody').empty();
			var items = '';
			$.ajax({
				type: 'POST',
				url: baseurl + 'accounting/journalentry/setSubsidiaryTableByCode',
				dataType: 'json',
				data: {'accountcode': $('#tbl_transactiondetail tbody tr').children(':eq('+((detailRow*8)+1)+')').find('input').val()},
				success: function(data){
					for (var i = 0; i <= data.length -1; i++) {
						items += '<tr><td class="col-xs-6">'+data[i].subsidiary_code+'</td><td class="col-xs-6">'+data[i].subsidiary_description+'</td></tr>';
					}
						$('#tbl_subsidiary').append(items);
				},
				error: function(errorThrown){
					toastr.error('Account Subsidiary Error#:52479', 'Operation Failed');
					console.log(errorThrown);
					$('#book_code').focus();
				}
			});
		}

		function drawTableBook(){
			if(currentRow == 0 ){
				currentRow = $('#tbl_bookregister tbody tr:visible').length;
			} else if (currentRow == $('#tbl_bookregister tbody tr:visible').length+1){
				currentRow = 1;
			}
			$('#tbl_bookregister tr:visible:eq('+previousRow+') td').removeClass('highlight');
			$('#tbl_bookregister tr:visible:eq('+currentRow+') td').addClass('highlight');
			$('#tbl_bookregister tbody').scrollTop((currentRow-1)*36);
		}


		function drawTableAccount(){
			if (currentRow == 0) {
				currentRow = $('#tbl_accountcode tbody tr:visible').length;
			} else if (currentRow == $('#tbl_accountcode tbody tr:visible').length +1) {
				currentRow = 1;
			}
			$('#tbl_accountcode tr:visible:eq('+previousRow+') td').removeClass('highlight');
			$('#tbl_accountcode tr:visible:eq('+currentRow+') td').addClass('highlight');	
			$('#tbl_accountcode tbody').scrollTop((currentRow-1)*36);	
		}

		function drawTableSubsidiary(){
			if(currentRow == 0){
				currentRow = $('#tbl_subsidiary tbody tr:visible').length;
			} else if (currentRow == $('#tbl_subsidiary tbody tr:visible').length+1){
				currentRow = 1;
			}
			$('#tbl_subsidiary tr:visible:eq('+previousRow+') td').removeClass('highlight');
			$('#tbl_subsidiary tr:visible:eq('+currentRow+') td').addClass('highlight');
			$('#tbl_subsidiary tbody').scrollTop((currentRow-1)*36);
		}

		function showFormBook(){
			$('#frm_bookregister').modal('toggle');
		}

		function showFormActivity(){
			$('#frm_activitycenter').modal('toggle');
			setTimeout(function(){ $('#taberino a[href="#tab_customer"]').trigger('click');	}, 100);
		}

		function showFormAccount(){
			$('#frm_account').modal('toggle');
		}

		function showFormSubsidiary(){
			$('#frm_subsidiary').modal('toggle');
		}

		function closeFormBook(){
			$('#frm_bookregister .close').click();
			$('#txt_searchbook').val('');
			$.each($('#tbl_bookregister tbody tr'), function(){
				$(this).show();
			});
		}

		function closeFormActivity(){
			$('#frm_activitycenter .close').click();
		}

		function closeFormAccount(){
			$("#frm_account .close").click();
			$('#txt_searchaccount').val('');
			$.each($('#tbl_accountcode tbody tr'), function(){
				$(this).show();
			});
		}

		function closeFormSubsidiary(){
			$('#frm_subsidiary .close').click();
			$('#txt_searchsub').val('');
			$.each($('#tbl_subsidiary tbody tr'), function(){
				$(this).show();
			});
		}

		function calcDebit(){
			var debit = 0;
			$('.debit').each(function(index){
				var str = $(this).val();
				if(str.length < 1){
					debit = parseFloat(debit) + parseFloat('0');
				} else {
					debit = parseFloat(debit) + parseFloat($(this).val());
				}
			});
			$('#txt_debit').val(parseFloat(debit).toFixed(2));
		}

		function calcCredit(){
			var credit = 0;
			$('.credit').each(function(index){
				var str = $(this).val();
				if(str.length < 1){
					credit = parseFloat(credit) + parseFloat('0');
				} else {
					credit = parseFloat(credit) + parseFloat($(this).val());
				}
			});
			$('#txt_credit').val(parseFloat(credit).toFixed(2));
		}

		function calcTotal(){
			var total = 0;
			total = parseFloat($('#txt_debit').val()) - parseFloat($('#txt_credit').val());
			$('#txt_total').val(parseFloat(total).toFixed(2));
		}

		function showFormInformation(washa){
			switch(washa){
				case 'insert':
					$('#frm_information').show();
					$('#frm_masterlist').hide();
					
					$('#frm_information').find('input, textarea').removeAttr('disabled');
					$('#transaction_id').val('0');
					$('#post_status').val('draft');
					$('#book_id').val('');
					$('#subsidiary_table').val('');
					$('#sub_code').val('');
					$('#book_code').val('');
					$('#book_description').val('');
					$('#reference_code').val('');
					$('#reference_number').val('');
					$('#post_date').val('');
					$('#department').val('');
					$('#remarks').val('');
					$('#is_locked').val('no');
					$('#txt_debit').val('0.00');
					$('#txt_credit').val('0.00');
					$('#txt_total').val('0.00');

					$('#bookcode_error').text('');
					$('#department_error').text('');
					$('#book_code').focus();
					$('#post_date').attr('readonly', 'readonly');
					$('#reference_code').attr('readonly', 'readonly');
					//$('#reference_number').attr('readonly', 'readonly');
					$('#btn_save').removeAttr('disabled');

					$('#tbl_transactiondetail tbody').empty();
					var items = '<tr><td style="visibility: hidden;"><input type="hidden" class="transaction_detail_id" id="transaction_detail_id" name="transaction_detail_id[]"></td>'+
									'<td ><input type="text" class="form-control input-sm account-code" id="account_code" name="account_code[]"></td>'+
									'<td ><input type="text" class="form-control input-sm" id="account_description" readonly="readonly" tabindex="-1"></td>'+
									'<td ><input type="text" class="form-control input-sm subsidiary-code" id="subsidiary_code" name="subsidiary_code[]"></td>'+
									'<td ><input type="text" class="form-control input-sm" id="subsidiary_description" readonly="readonly" tabindex="-1"></td>'+
									'<td ><input type="number" class="form-control input-sm debit" id="debit" name="debit[]"></td>'+
									'<td ><input type="number" class="form-control input-sm credit" id="credit" name="credit[]"></td>'+
									'<td rowspan="1"><textarea rows="1" class="form-control detail-remarks" id="detail_remarks" name="detail_remarks[]"></textarea></td></tr>';
					$('#tbl_transactiondetail').append(items);
					break;
				case 'update':
					$('#frm_masterlist').hide();
					$('#frm_information').show();

					$('#bookcode_error').text('');
					$('#department_error').text('');
					if($('#is_locked').val() == 'yes'){
						$('#frm_information').find('input, textarea').attr('disabled', 'disabled');
						$('#btn_post').attr('disabled', 'disabled');
						$('#btn_save').attr('disabled', 'disabled');
					} else {
						$('#frm_information').find('input, textarea').removeAttr('disabled');
						$('#post_date').attr('readonly', 'readonly');
						$('#reference_code').attr('readonly', 'readonly');
						//$('#reference_number').attr('readonly', 'readonly');
					
						if($('#post_status').val() == 'draft'){
							//$('#book_code').removeAttr('readonly');
							$('#department').removeAttr('readonly');
							$('#remarks').removeAttr('readonly');
							$('#tbl_transactiondetail').find('input.account-code, input.subsidiary-code, input.debit, input.credit, textarea.detail-remarks').removeAttr('readonly');
							$('#btn_save').removeAttr('disabled');
							$('#book_code').focus();
						} else {
								$('#tbl_transactiondetail').find('input, textarea').attr('disabled','disabled');
								$('#btn_save').removeAttr('disabled');
						}
					}
					break;
			}
		}

		function showPost(){
			if($('#post_status').val() == 'draft'){
				if($('#txt_debit').val() != '0.00' && $('#txt_credit').val() != '0.00' && $('#txt_total').val() == '0.00'){
					$('#btn_post').removeAttr('disabled');
				} else {
					$('#btn_post').attr('disabled', 'disabled');
				}
			} else {
				$('#btn_post').attr('disabled', 'disabled');
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