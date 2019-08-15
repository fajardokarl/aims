var masterlist = function(){
	var _init = function(){
		var masterRow = -1;
		var d = new Date();
		var errmsg = [];

		$(window).load(function(){
			setTimeout(function(){ $('#tbl_masterlist_filter input').focus(); }, 500);
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
			'bInfo': false,
			'bSort': false,
			'bLengthChange': false
		});
		$('#tbl_masterlist_filter input').bind('keydown', function(e){
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

		$('#btn_add').click(function(){
			$('#frm_information').attr('action', baseurl+'Accounting/Lotcost/insertLotCost');
			showInformationForm(true);
			$('#cost_year').val(d.getFullYear());
		});

		$('#btn_back').click(function(){
			showInformationForm(false);
			$('#tbl_masterlist_filter input').focus();
			tbl_masterlist.$('tr.highlight').removeClass('highlight');
			masterRow = -1;
		});

		$('#btn_save').click(function(){
			if ($('#project_id').val() != null && $('#phase_id').val() != null) {
				$('#frm_information').submit();
			} else {
				if ($('#project_id').val() == null) {
					$('#error1').text('Project cannot be empty. Please fill in the blank.');
				}
				if ($('#phase_id').val() == null){
					$('#error2').text('Phase cannot be empty. Please fill in the blank.');
				}
			}
		});


		$('#project_id').on('change', function(){
			$('#error1').text('');
		});

		$('#phase_id').on('change', function(){
			$('#error2').text('');
		});


		$('#transfer_fee').on('keydown', function(e){
			switch(e.keyCode){
				case 9:
					e.preventDefault();
					$('#btn_save').focus();
					break;
			}
		});

		//-----------------------------------------------
		//UPDATE
		$('#tbl_masterlist tbody').on('dblclick', 'tr', function(){
			$('#frm_information').attr('action', baseurl+'Accounting/Lotcost/updateLotCost');
			showInformationForm(true);
			$.ajax({
				type: 'POST',
				url: baseurl+'Accounting/Lotcost/getLotCostByID',
				dataType: 'json',
				data: {'lotcostid': $(this).children(':eq(0)').text()},
				success: function(data){
					$('#lot_cost_id').val(data[0].lot_cost_id);
					$('#project_id').val(data[0].project_id);
					$('#phase_id').val(data[0].phase_id);
					$('#cost_year').val(data[0].cost_year);
					$('#cost_month').val(data[0].cost_month);
					$('#lot_cost').val(data[0].lot_cost);
					$('#devt_cost').val(data[0].devt_cost);
					$('#xu_share').val(data[0].xu_share);
					$('#house_cost').val(data[0].house_cost);
					$('#tucked_in_share').val(data[0].tucked_in_share);
					$('#transfer_fee').val(data[0].transfer_fee);
				},
				error: function(errorThrown){
					toastr.error('Lot Cost Masterlist Error#14411', 'Operation Failed');
					console.log(errorThrown);
				}
			});
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
			$('#lot_cost_id').val('');
			$('#project_id').val('');
			$('#phase_id').val('');

			$('#error1').text('');
			$('#error2').text('');

			$('#cost_month').val('');
			$('#lot_cost').val('');
			$('#devt_cost').val('');
			$('#xu_share').val('');
			$('#house_cost').val('');
			$('#tucked_in_share').val('');
			$('#transfer_fee').val('');
			$('#project_id').focus();
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