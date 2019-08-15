$(document).ready(function(){

	$('#sortby').on('change', function() {
		if($('#sortby').val() == 1){
			$('#projectdiv').show();
			$('#vatdiv').hide();
			$('#generatediv').show();
		}
		if($('#sortby').val() == 2) {
			$('#vatdiv').show();
			$('#projectdiv').hide();
			$('#generatediv').show();
		}
	});	

	$('#generate').on('click', function() {
		//alert('wiw');
		if($('#sortby').val() == 1){
			var projectid = $('#project').val();
			$.ajax({
	            type: "POST",
	            url:  baseurl + "collection/get_monthly_collection_per_project",
	            data: {'projectid':projectid},
	            success: function(result){

	                var data = jQuery.parseJSON(result);
	                console.log(data);
	                var content = '';

	                if(data.length==0){
	                	toastr.error('Error!', 'No records found!');
	                } else {
	                	for(x=0;x<data.length;x++){
	                		content += '<tr>';
	                		content += '<td>' + data[x].lastname + ', ' + data[x].firstname + ' ' + data[x].middlename + '</td>';
	                		content += '<td>' + data[x].payment_name + '</td>';
	                		if (!data[x].fromBank){
	                			content += '<td align="right">None</td>';
	                		} else {
	                			content += '<td align="right">' + data[x].fromBank + '</td>';
	                		}
	                		if (!data[x].toBank){
	                			content += '<td align="right">None</td>';
	                		} else {
	                			content += '<td align="right">' + data[x].toBank + '</td>';
	                		}
	                		content += '<td align="right">' + jFormatNumber(data[x].amount) + '</td>';
	                		if (!data[x].principal){
	                			content += '<td align="right">0.00</td>';
	                		} else {
	                			content += '<td align="right">' + jFormatNumber(data[x].principal) + '</td>';
	                		}
	                		if (!data[x].interest){
	                			content += '<td align="right">0.00</td>';
	                		} else {
	                			content += '<td align="right">' + jFormatNumber(data[x].interest) + '</td>';
	                		}
	                		if (!data[x].surcharge){
	                			content += '<td align="right">0.00</td>';
	                		} else {
	                			content += '<td align="right">' + jFormatNumber(data[x].surcharge) + '</td>';
	                		}
	                		if (!data[x].ips){
	                			content += '<td align="right">0.00</td>';
	                		} else {
	                			content += '<td align="right">' + jFormatNumber(data[x].ips) + '</td>';
	                		}
	                		if (!data[x].sundry){
	                			content += '<td align="right">0.00</td>';
	                		} else {
	                			content += '<td align="right">' + jFormatNumber(data[x].sundry) + '</td>';
	                		}
	                	}
	                	var removeDataTable = $('#tbldailycollection').dataTable();
                    	removeDataTable.fnDestroy();
	                	$('#title1').text($('#project option:selected').text());
	                	$('#tbody_rp').html(content);
	                	$('#tbldailycollection').dataTable({
	                        "aaSorting": []
	                    });
	                }


	            },
	            error: function(result){
	            }
	        });
		}
		if($('#sortby').val() == 2) {
			var vatid = $('#vat').val();
			$.ajax({
	            type: "POST",
	            url:  baseurl + "collection/get_monthly_collection_per_vat",
	            data: {'vatid':vatid},
	            success: function(result){

	                var data = jQuery.parseJSON(result);
	                console.log(data);
	                var content = '';

	                if(data.length==0){
	                	toastr.error('Error!', 'No records found!');
	                } else {
	                	for(x=0;x<data.length;x++){
	                		content += '<tr>';
	                		content += '<td>' + data[x].lastname + ', ' + data[x].firstname + ' ' + data[x].middlename + '</td>';
	                		content += '<td>' + data[x].payment_name + '</td>';
	                		content += '<td align="right">' + jFormatNumber(data[x].amount) + '</td>';
	                		if (!data[x].fromBank){
	                			content += '<td align="right">None</td>';
	                		} else {
	                			content += '<td align="right">' + data[x].fromBank + '</td>';
	                		}
	                		if (!data[x].toBank){
	                			content += '<td align="right">None</td>';
	                		} else {
	                			content += '<td align="right">' + data[x].toBank + '</td>';
	                		}
	                		if (!data[x].principal){
	                			content += '<td align="right">0.00</td>';
	                		} else {
	                			content += '<td align="right">' + jFormatNumber(data[x].principal) + '</td>';
	                		}
	                		if (!data[x].interest){
	                			content += '<td align="right">0.00</td>';
	                		} else {
	                			content += '<td align="right">' + jFormatNumber(data[x].interest) + '</td>';
	                		}
	                		if (!data[x].surcharge){
	                			content += '<td align="right">0.00</td>';
	                		} else {
	                			content += '<td align="right">' + jFormatNumber(data[x].surcharge) + '</td>';
	                		}
	                		if (!data[x].ips){
	                			content += '<td align="right">0.00</td>';
	                		} else {
	                			content += '<td align="right">' + jFormatNumber(data[x].ips) + '</td>';
	                		}
	                		if (!data[x].sundry){
	                			content += '<td align="right">0.00</td>';
	                		} else {
	                			content += '<td align="right">' + jFormatNumber(data[x].sundry) + '</td>';
	                		}
	                	}
	                	var removeDataTable = $('#tbldailycollection').dataTable();
                    	removeDataTable.fnDestroy();
	                	$('#title1').text($('#vat option:selected').text());
	                	$('#tbody_rp').html(content);
	                	$('#tbldailycollection').dataTable({
	                        "aaSorting": []
	                    });
	                }


	            },
	            error: function(result){
	            }
	        });
		}
	});	
	
	$('#print').click(function () {
        var title = $('#title1').text();
        var date = $('#year_text').text();
        console.log(date);
        var TableData1 = [];
        var rows = $("#tbldailycollection").dataTable().fnGetNodes();
        for(var i=0; i<rows.length;i++){
            TableData1[i] = {
                "customer" : $(rows[i]).find('td:eq(0)').text().replace(/,/g, '')
                , "paymenttype" :$(rows[i]).find('td:eq(1)').text().replace(/,/g, '')
                , "fromBank" :$(rows[i]).find('td:eq(2)').text().replace(/,/g, '')
                , "toBank" :$(rows[i]).find('td:eq(3)').text().replace(/,/g, '')
                , "amount" : $(rows[i]).find('td:eq(4)').text().replace(/,/g, '')
                , "principal" : $(rows[i]).find('td:eq(5)').text().replace(/,/g, '')
                , "interest" : $(rows[i]).find('td:eq(6)').text().replace(/,/g, '')
                , "surcharge" : $(rows[i]).find('td:eq(7)').text().replace(/,/g, '')
                , "ips" : $(rows[i]).find('td:eq(8)').text().replace(/,/g, '')
                , "sundry" : $(rows[i]).find('td:eq(9)').text().replace(/,/g, '')
            }
        }

        var data = JSON.stringify(TableData1);

        console.log(TableData1);

        $.ajax({
            type: "POST",
            url:  baseurl + "collection/print_monthly_collection",
            // dataType: 'json',
            data: {'data':data,'title':title,'date':date},
            success: function(data){
                var url = baseurl + "reports/MonthlyCollection.pdf";
                var win = window.open(url, '_blank');
                win.focus();
            },
            error: function(data){

            },
        });
    });

    $('#excel').click(function () {
    	var title = $('#title1').text();
        var date = $('#year_text').text();
        console.log(date);
        var TableData1 = [];
        var rows = $("#tbldailycollection").dataTable().fnGetNodes();
        for(var i=0; i<rows.length;i++){
            TableData1[i] = {
                "customer" : $(rows[i]).find('td:eq(0)').text().replace(/,/g, '')
                , "paymenttype" :$(rows[i]).find('td:eq(1)').text().replace(/,/g, '')
                , "fromBank" :$(rows[i]).find('td:eq(2)').text().replace(/,/g, '')
                , "toBank" :$(rows[i]).find('td:eq(3)').text().replace(/,/g, '')
                , "amount" : $(rows[i]).find('td:eq(4)').text().replace(/,/g, '')
                , "principal" : $(rows[i]).find('td:eq(5)').text().replace(/,/g, '')
                , "interest" : $(rows[i]).find('td:eq(6)').text().replace(/,/g, '')
                , "surcharge" : $(rows[i]).find('td:eq(7)').text().replace(/,/g, '')
                , "ips" : $(rows[i]).find('td:eq(8)').text().replace(/,/g, '')
                , "sundry" : $(rows[i]).find('td:eq(9)').text().replace(/,/g, '')
            }
        }

        var data = JSON.stringify(TableData1);

        console.log(TableData1);

        $.ajax({
            type: "POST",
            url:  baseurl + "collection/get_monthly_collection_report",
            data: {'data':data,'title':title,'date':date},
            success: function(data){
                $("#exceltrigger").trigger("click").attr("target", "_blank");
            },
            error: function(data){

            },
        });

    });

});

function numberWithCommas(x) {
    var parts = x.toString().split(".");
    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    return parts.join(".");
}


function jFormatNumber(a) {
    try {
        return parseFloat(a).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,")
    } catch (a) {
        return "Error FORMAT"
    }
}