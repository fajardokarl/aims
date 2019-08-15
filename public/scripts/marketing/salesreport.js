$(document).ready(function(){
	$('#generateReport').click(function (event) {
		var data = new FormData();
		data.append('fromDate',$('#fromDate').val());
		data.append('toDate',$('#toDate').val());
		for (var pair of data.entries()) {
		    console.log(pair[0]+ ', ' + pair[1]); 
		}
		$.ajax({
            type: "POST",
            url:  baseurl + "marketing/generateSalesReport",
            data: data,
            cache: false,
            processData:false,
            contentType:false,
            success: function(data){
                
                //location.reload();
                //toastr.success('Successfully Saved!', 'Operation Done');
                // alert(data[0].broker_person_id);
                var data = jQuery.parseJSON(data);
                var content = '';
                for (var i = 0; i < data.length; i++) {
		            content += '<tr>';
		            content += '<td style="display: none;">' + data[i].contract_id + '</td>';
		            content += '<td>' + data[i].block_no + '</td>';
		            content += '<td>' + data[i].lot_no + '</td>';
		            content += '<td>' + data[i].firstname + data[i].middlename + data[i].lastname + '</td>';
		            content += '<td>' + data[i].sold_date + '</td>';
		            content += '<td>' + data[i].sold_date + '</td>';
		            content += '<td>' + data[i].price_per_sqr_meter + '</td>';
		            content += '<td>' + data[i].sold_date + '</td>';
		            content += '<td>' + data[i].contract_status_name + '</td>';
		            content += '<td>';
		            if (data[i].is_paid==1){ content += 'Fully Paid';} else { content += 'Installment';}
		            content += '</td>';
		            content += '</tr>';
		        }
		        $('#tbody_rp').html(content);
		        $('#dateDiv').show();
		        $('#dateText').text($('#fromDate').val() + ' to ' + $('#toDate').val());
                
            },
            error: function (errorThrown){
                toastr.error('Error!', 'Operation Done');
                //console.log(errorThrown);
            }
        });
		event.preventDefault();
	});

	$('#print').click(function () {
		var css = '@page { size: landscape; }',
		    head = document.head || document.getElementsByTagName('head')[0],
		    style = document.createElement('style');

		style.type = 'text/css';
		style.media = 'print';

		if (style.styleSheet){
		  style.styleSheet.cssText = css;
		} else {
		  style.appendChild(document.createTextNode(css));
		}

		head.appendChild(style);
		window.print();
	});

	$('#sales_xls').click(function(){
		// frromDate and ToDate from reservationreport.php
		var from_date = $('#fromDate').val();
		var to_date   = $('#toDate').val();
		console.log(from_date + " : " + to_date);

		var dates = {'from_date':from_date, 'to_date':to_date};

		$.ajax({
            type: 'POST',
            url: baseurl + "marketing/xls_salesreport",
            dataType: 'text',
            data: dates,
            // cache: false,
            // processData:false,
            // contentType:false,
            success: function(data) {
                $("#xls_sales_trigger").trigger("click").attr("target", "_blank");
                //$("#receiptTrigger").trigger("click").attr("target", "_blank");     
            }
        });
    });
});
