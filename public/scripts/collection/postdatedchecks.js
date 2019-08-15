var TableDatatablesEditable = function () {

    var customers = $('#tblcustomers').DataTable();
    var handleTable = function () {

    }
    return {
        //main function to initiate the module
        init: function () {
            handleTable();
        }
    };
}();
var TableDatatablesEditable2 = function () {

    var orgs = $('#tblorg').DataTable();
    var handleTable = function () {

    }
    return {
        //main function to initiate the module
        init: function () {
            handleTable();
        }
    };
}();
var TableDatatablesEditable3 = function () {

    var customers2 = $('#tblcustomers2').DataTable();
    var handleTable = function () {

    }
    return {
        //main function to initiate the module
        init: function () {
            handleTable();
        }
    };
}();
var TableDatatablesEditable4 = function () {

    var orgs2 = $('#tblorg2').DataTable();
    var handleTable = function () {

    }
    return {
        //main function to initiate the module
        init: function () {
            handleTable();
        }
    };
}();
// var TableDatatablesEditable5 = function () {

//     var checks = $('#tblchecks').DataTable();
//     var handleTable = function () {

//     }
//     return {
//         //main function to initiate the module
//         init: function () {
//             handleTable();
//         }
//     };
// }();

var global_customer_id = '';

$(document).ready(function(){
	$('#generate').click(function () {
		if(!$('#fromDate').val() && !$('#toDate').val()){
			alert("Please enter dates.")
		} else {
			var fromDate = $('#fromDate').val();
			var toDate = $('#toDate').val();
			$('#postdatedchecksdiv').show();

			if (!$('#toDate').val()){
				$('#excel1').show();
				$('#excel2').hide();
                $('#print1').show();
                $('#print2').hide();
				$('#text1').text("Post Dated Checks From "+fromDate);
				var data = new FormData();
                data.append("fromDate", fromDate);
                for (var pair of data.entries()) {
                    console.log(pair[0]+ ', ' + pair[1]); 
                }
                $.ajax({
                    type: "POST",
                    url:  baseurl + "collection/get_postdatedchecks_1",
                    data: data,
                    cache: false,
                    processData:false,
                    contentType:false,
                    success: function(data){
                    	var data = jQuery.parseJSON(data);
                    	var content = '';
                    	for (var x = 0; x < data.length; x++) {
	                        content += '<tr id="row">';
	                        content += '<td>' + data[x].firstname + ' '+ data[x].middlename + ' ' + data[x].lastname +'</td>';
	                        content += '<td>' + data[x].check_date + '</td>';
	                        content += '<td>' + data[x].bankname1 + '</td>';
	                        content += '<td>' + data[x].check_number + '</td>';
	                        content += '<td>' + numberWithCommas(data[x].amount) + '</td>';
	                        content += '<td>' + data[x].bankname2 + '</td>';
	                        content += '</tr>';
	                    }
	                    $('#tbody_rp').html(content);
	                    var tblpostdatedchecks = $('#tblpostdatedchecks').DataTable();
					    var handleTable = function () {

					    }
					    return {
					        //main function to initiate the module
					        init: function () {
					            handleTable();
					        }
					    };
                    },
                    error: function(data){

                    },
                });
			} else {
				$('#excel1').hide();
				$('#excel2').show();
                $('#print1').hide();
                $('#print2').show();
				$('#text1').text("Post Dated Checks From "+fromDate+" To "+toDate);
				var data = new FormData();
                data.append("fromDate", fromDate);
                data.append("toDate", toDate);
                for (var pair of data.entries()) {
                    console.log(pair[0]+ ', ' + pair[1]); 
                }
                $.ajax({
                    type: "POST",
                    url:  baseurl + "collection/get_postdatedchecks_2",
                    data: data,
                    cache: false,
                    processData:false,
                    contentType:false,
                    success: function(data){
                    	var data = jQuery.parseJSON(data);
                        console.log(data);
                    	var content = '';
                    	for (var x = 0; x < data.length; x++) {
	                        content += '<tr id="row">';
                            content += '<td>' + data[x].firstname + ' '+ data[x].middlename + ' ' + data[x].lastname +'</td>';
                            content += '<td>' + data[x].check_date + '</td>';
                            content += '<td>' + data[x].bankname1 + '</td>';
                            content += '<td>' + data[x].check_number + '</td>';
                            content += '<td>' + numberWithCommas(data[x].amount) + '</td>';
                            content += '<td>' + data[x].bankname2 + '</td>';
                            content += '</tr>';
	                    }
	                    $('#tbody_rp').html(content);
	                    var tblpostdatedchecks = $('#tblpostdatedchecks').DataTable();
					    var handleTable = function () {

					    }
					    return {
					        //main function to initiate the module
					        init: function () {
					            handleTable();
					        }
					    };
                    },
                    error: function(data){

                    },
                });
			}
		}
	});
	$('#excel1').click(function () {
		var fromDate = $('#fromDate').val();
		var data = new FormData();
        data.append("fromDate", fromDate);
        for (var pair of data.entries()) {
            console.log(pair[0]+ ', ' + pair[1]); 
        }
        $.ajax({
            type: "POST",
            url:  baseurl + "collection/get_postdatedchecks_1_report",
            data: data,
            cache: false,
            processData:false,
            contentType:false,
            success: function(data){
            	//window.location.href = baseurl + "collection/get_postdatedchecks_1_report?fromDate="+ fromDate;
            	$("#excel1trigger").trigger("click").attr("target", "_blank");
            },
            error: function(data){

            },
        });
	});
    $('#print1').click(function () {
        var fromDate = $('#fromDate').val();
        var data = new FormData();
        data.append("fromDate", fromDate);
        for (var pair of data.entries()) {
            console.log(pair[0]+ ', ' + pair[1]); 
        }
        $.ajax({
            type: "POST",
            url:  baseurl + "collection/print_postdatedchecks_1_report",
            data: data,
            cache: false,
            processData:false,
            contentType:false,
            success: function(data){
                //window.location.href = baseurl + "collection/get_postdatedchecks_1_report?fromDate="+ fromDate;
                var url = baseurl + "reports/PostdatedChecks.pdf";
                var win = window.open(url, '_blank');
                win.focus();
            },
            error: function(data){

            },
        });
    });
	$('#excel2').click(function () {
		var fromDate = $('#fromDate').val();
		var toDate = $('#toDate').val();
		var data = new FormData();
        data.append("fromDate", fromDate);
        data.append("toDate", toDate);
        for (var pair of data.entries()) {
            console.log(pair[0]+ ', ' + pair[1]); 
        }
        $.ajax({
            type: "POST",
            url:  baseurl + "collection/get_postdatedchecks_2_report",
            data: data,
            cache: false,
            processData:false,
            contentType:false,
            success: function(data){
            	//window.location.href = baseurl + "collection/get_postdatedchecks_1_report?fromDate="+fromDate+'&toDate='+toDate;
            	$("#excel2trigger").trigger("click").attr("target", "_blank");
            },
            error: function(data){

            },
        });
	});
    $('#print2').click(function () {
        var fromDate = $('#fromDate').val();
        var toDate = $('#toDate').val();
        var data = new FormData();
        data.append("fromDate", fromDate);
        data.append("toDate", toDate);
        for (var pair of data.entries()) {
            console.log(pair[0]+ ', ' + pair[1]); 
        }
        $.ajax({
            type: "POST",
            url:  baseurl + "collection/print_postdatedchecks_2_report",
            data: data,
            cache: false,
            processData:false,
            contentType:false,
            success: function(data){
                //window.location.href = baseurl + "collection/get_postdatedchecks_1_report?fromDate="+fromDate+'&toDate='+toDate;
                var url = baseurl + "reports/PostdatedChecks.pdf";
                var win = window.open(url, '_blank');
                win.focus();
            },
            error: function(data){

            },
        });
    });

    $(document).on("click","#tblcustomers tr",function() {
        $("<style type='text/css'> .highlight{ background:#33F0FF;} </style>").appendTo("head");
        $("#tblcustomers tr").each(function () {
            if ( $(this).hasClass('highlight') ) {
                $(this).removeClass('highlight');
            }
        });
        $(this).addClass("highlight");
        var table = document.getElementById("tblcustomers");
        var col = $(this).parent().children().index($(this));
        var row = $(this).parent().parent().children().index($(this).parent());
        col = Number(col);
        col = +col + 1;
        
        global_customer_id = table.rows[col].cells[0].innerHTML;
        $("#custName").text(table.rows[col].cells[1].innerHTML);

    });

    $(document).on("click","#tblcustomers2 tr",function() {
        $("<style type='text/css'> .highlight{ background:#33F0FF;} </style>").appendTo("head");
        $("#tblcustomers2 tr").each(function () {
            if ( $(this).hasClass('highlight') ) {
                $(this).removeClass('highlight');
            }
        });
        $(this).addClass("highlight");
        var table = document.getElementById("tblcustomers2");
        var col = $(this).parent().children().index($(this));
        var row = $(this).parent().parent().children().index($(this).parent());
        col = Number(col);
        col = +col + 1;
        
        global_customer_id = table.rows[col].cells[0].innerHTML;
        $("#custName2").text(table.rows[col].cells[1].innerHTML);

    });

    $(document).on("click","#tblorg tr",function() {
        $("<style type='text/css'> .highlight{ background:#33F0FF;} </style>").appendTo("head");
        $("#tblorg tr").each(function () {
            if ( $(this).hasClass('highlight') ) {
                $(this).removeClass('highlight');
            }
        });
        $(this).addClass("highlight");
        var table = document.getElementById("tblorg");
        var col = $(this).parent().children().index($(this));
        var row = $(this).parent().parent().children().index($(this).parent());
        col = Number(col);
        col = +col + 1;
        
        global_customer_id = table.rows[col].cells[0].innerHTML;
        $("#custName").text(table.rows[col].cells[1].innerHTML);

    });

    $(document).on("click","#tblorg2 tr",function() {
        $("<style type='text/css'> .highlight{ background:#33F0FF;} </style>").appendTo("head");
        $("#tblorg2 tr").each(function () {
            if ( $(this).hasClass('highlight') ) {
                $(this).removeClass('highlight');
            }
        });
        $(this).addClass("highlight");
        var table = document.getElementById("tblorg2");
        var col = $(this).parent().children().index($(this));
        var row = $(this).parent().parent().children().index($(this).parent());
        col = Number(col);
        col = +col + 1;
        
        global_customer_id = table.rows[col].cells[0].innerHTML;
        $("#custName2").text(table.rows[col].cells[1].innerHTML);

    });

    $('#saveSingle').click(function () {

        if(global_customer_id=="" || $('#checkamount').val()=="" || $('#checknumber').val()=="" || $('#checkdate').val()=="" || $('#destbank1').val()=="" || $('#sourcebank1').val()==""){
            if (global_customer_id==''){
                toastr.error('Error!', 'Select Customer/Organization!');
            } 
            if ($('#checkamount').val()==''){
                $('#checkamount').css({"border": "1px solid red"});
            } else {
                $('#checkamount').css({"border": ""});
            }
            if ($('#checknumber').val()==''){
                $('#checknumber').css({"border": "1px solid red"});
            } else {
                $('#checknumber').css({"border": ""});
            }
            if ($('#checkdate').val()==''){
                $('#checkdate').css({"border": "1px solid red"});
            } else {
                $('#checkdate').css({"border": ""});
            }
            if ($('#destbank1').val()==''){
                toastr.error('Error!', 'Select Destination Bank!');
            }
            if ($('#sourcebank1').val()==''){
                toastr.error('Error!', 'Select Source Bank!');
            } 
        } else {
            var customerid = global_customer_id;
            var checkamount = $('#checkamount').val();
            var checknumber = $('#checknumber').val();
            var checkdate = $('#checkdate').val();
            var destinationbank = $('#destbank1').val();
            var sourcebank = $('#sourcebank1').val();
            var data = new FormData();
            data.append("customerid",customerid);
            data.append("checkamount",checkamount);
            data.append("checknumber",checknumber);
            data.append("checkdate",checkdate);
            data.append("destinationbank",destinationbank);
            data.append("sourcebank",sourcebank);
            for (var pair of data.entries()) {
                console.log(pair[0]+ ', ' + pair[1]); 
            }

            $.ajax({
                type: "POST",
                url:  baseurl + "collection/save_postdated_check_single",
                data: data,
                cache: false,
                processData:false,
                contentType:false,
                success: function(data){
                    //window.location.href = baseurl + "collection/get_postdatedchecks_1_report?fromDate="+fromDate+'&toDate='+toDate;
                    toastr.success('Successfully Saved!', 'Operation Done');
                },
                error: function(data){

                },
            });
        }
    });  

    $('#add').click(function () {

        if(global_customer_id=="" || $('#checkamount2').val()=="" || $('#checknumber2').val()=="" || $('#checkdate2').val()=="" || $('#destbank2').val()=="" || $('#sourcebank2').val()==""){
            if (global_customer_id==''){
                toastr.error('Error!', 'Select Customer/Organization!');
            } 
            if ($('#checkamount2').val()==''){
                $('#checkamount2').css({"border": "1px solid red"});
            } else {
                $('#checkamount2').css({"border": ""});
            }
            if ($('#checknumber2').val()==''){
                $('#checknumber2').css({"border": "1px solid red"});
            } else {
                $('#checknumber2').css({"border": ""});
            }
            if ($('#checkdate2').val()==''){
                $('#checkdate2').css({"border": "1px solid red"});
            } else {
                $('#checkdate2').css({"border": ""});
            }
            if ($('#destbank2').val()==''){
                toastr.error('Error!', 'Select Destination Bank!');
            }
            if ($('#sourcebank2').val()==''){
                toastr.error('Error!', 'Select Source Bank!');
            } 
        } else {
            var checkamount = $('#checkamount2').val();
            var checknumber = $('#checknumber2').val();
            var checkdate = $('#checkdate2').val();
            var destbank = $('#destbank2 option:selected').text();
            var destbankid = $('#destbank2').val();
            var sourcebank = $('#sourcebank2 option:selected').text();
            var sourcebankid = $('#sourcebank2').val();

            // var removeDataTable = $('#tblchecks').dataTable();
            // removeDataTable.fnDestroy();

            $('#tblchecks tr:last').after('<tr><td>'+checkamount+'</td><td>'+checknumber+'</td><td>'+converter(checkdate)+'</td><td>'+destbank+'</td><td>'+sourcebank+'</td><td><input type="button" value="Delete" onclick="deleteRow(this)"></td><td style="display: none;">'+destbankid+'</td><td style="display: none;">'+sourcebankid+'</td></tr>');
            
            // $('#tblchecks').DataTable({
            //     "ordering": false,
            // }); 
        }

    }); 

    $('#saveMultiple').click(function () {

        var table = document.getElementById("tblchecks");
        var length = table.rows.length;
        console.log(length);
        if (length>1){

            var TableData1 = [];
            // var rows = $("#tblchecks").dataTable().fnGetNodes();
            // console.log(rows);
            var x=0;
            for(var i=1; i<length;i++)
            {
                TableData1[x] = {
                    "customerid" : global_customer_id
                    , "checkamount" : table.rows[i].cells[0].innerHTML.replace(/,/g, '')
                    , "checknumber" : table.rows[i].cells[1].innerHTML
                    , "checkdate" :moment(table.rows[i].cells[2].innerHTML).format("YYYY-MM-DD")
                    , "destbankid" : table.rows[i].cells[6].innerHTML
                    , "sourcebank" : table.rows[i].cells[7].innerHTML
                }
                x++;
            }
            console.log(TableData1);
            var data = JSON.stringify(TableData1);
            console.log(data);
            $.ajax({
                type: "POST",
                url:  baseurl + "collection/save_multiple_checks",
                data: {'data':data},
                success: function(data){
                    toastr.success('Successfully Saved!', 'Operation Done');
                    
                },
                error: function(data){

                },
            });
        }
    });
});

function numberWithCommas(x) {
    var parts = x.toString().split(".");
    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    return parts.join(".");
}
function deleteRow(r) {
    var i = r.parentNode.parentNode.rowIndex;
    document.getElementById("myTable").deleteRow(i);
}
function converter(s) {

    var months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
    s =  s.replace(/-/g, '/');
    var d = new Date(s);

    return months[d.getMonth()] + ' ' + d.getDate() + ', ' + d.getFullYear();
}