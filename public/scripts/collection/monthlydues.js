
$(document).ready(function(){
    // $.ajax({
    //     type: "POST",
    //     url:  baseurl + "collection/get_monthly_dues_report",
    //     data: data,
    //     cache: false,
    //     processData:false,
    //     contentType:false,
    //     success: function(data){
    //         //window.location.href = baseurl + "collection/get_monthly_dues_report";
    //         //var content = '';

    //     },
    //     error: function(data){

    //     },
    // });
    

	$('#excel1').click(function () {

        var TableData = [];
        var rows = $("#tblmonthlydues").dataTable().fnGetNodes();
        for(var i=0; i<rows.length;i++){
            TableData[i] = {
                "amortid" : $(rows[i]).find('td:eq(0)').text()
                , "duedate" :$(rows[i]).find('td:eq(1)').text()
                , "customername" : $(rows[i]).find('td:eq(2)').text()
                , "lotdesc" : $(rows[i]).find('td:eq(3)').text()
                , "daysdue" : $(rows[i]).find('td:eq(4)').text()
                , "amountdue" : $(rows[i]).find('td:eq(5)').text()
                , "amortdue" : $(rows[i]).find('td:eq(6)').text()
                , "surcharge" : $(rows[i]).find('td:eq(7)').text()
                , "vat" : $(rows[i]).find('td:eq(8)').text()
                , "ips" : $(rows[i]).find('td:eq(9)').text()
                , "interest" : $(rows[i]).find('td:eq(10)').text()
                , "principal" : $(rows[i]).find('td:eq(11)').text()
                , "payments" : $(rows[i]).find('td:eq(12)').text()
            }
        }

        var data = JSON.stringify(TableData);

        console.log(TableData);

		$.ajax({
            type: "POST",
            url:  baseurl + "collection/get_monthly_dues_report",
            data: {'data':data},
            success: function(data){
                $("#excel1trigger").trigger("click").attr("target", "_blank");
            },
            error: function(data){

            },
        });
	});

    $('#print1').click(function () {

        var TableData = [];
        var rows = $("#tblmonthlydues").dataTable().fnGetNodes();
        for(var i=0; i<rows.length;i++){
            TableData[i] = {
                "amortid" : $(rows[i]).find('td:eq(0)').text()
                , "duedate" :$(rows[i]).find('td:eq(1)').text()
                , "customername" : $(rows[i]).find('td:eq(2)').text()
                , "lotdesc" : $(rows[i]).find('td:eq(3)').text()
                , "daysdue" : $(rows[i]).find('td:eq(4)').text()
                , "amountdue" : $(rows[i]).find('td:eq(5)').text()
                , "amortdue" : $(rows[i]).find('td:eq(6)').text()
                , "surcharge" : $(rows[i]).find('td:eq(7)').text()
                , "vat" : $(rows[i]).find('td:eq(8)').text()
                , "ips" : $(rows[i]).find('td:eq(9)').text()
                , "interest" : $(rows[i]).find('td:eq(10)').text()
                , "principal" : $(rows[i]).find('td:eq(11)').text()
                , "payments" : $(rows[i]).find('td:eq(12)').text()
            }
        }

        var data = JSON.stringify(TableData);

        console.log(TableData);

        $.ajax({
            type: "POST",
            url:  baseurl + "collection/print_monthly_dues_report",
            // dataType: 'json',
            data: {'data':data},
            success: function(data){
                var url = baseurl + "reports/MonthlyDues.pdf";
                var win = window.open(url, '_blank');
                win.focus();
            },
            error: function(data){

            },
        });
    });
});
// }
window.onload = makeTable;
function makeTable() {
    //alert("loaded");
    var content = '';
    var data = '';
    $.ajax({
        type: "POST",
        url:  baseurl + "collection/get_monthly_dues_report2",
        data: data,
        cache: false,
        processData:false,
        contentType:false,
        success: function(result){
            //window.location.href = baseurl + "collection/get_monthly_dues_report";
            //var content = '';
            var data = jQuery.parseJSON(result);
            console.log(data);
            for (var i = 0; i < data.length; i++) {
                content += '<tr id="myRow">';
                var due_date = moment(data[i].due_date, "YYYY-MM-DD");
                var date_today = moment();

                var parts = data[i].due_date.split('-');
                var due_date2 = new Date(parts[0],parts[1]-1,parts[2]); 
                var date_today2 = new Date();

                var amortizationAmount = Number(data[i].amortization_amount);
                var vatAmount = Number(data[i].vat_amount); //- Number(data['amortization'][i].vat_paid);
                var ips = Number(data[i].rebate);
                var interestAmount = Number(data[i].interest_amount); //- Number(data['amortization'][i].interest_paid);
                var principalAmount = Number(data[i].principal_amount); //- Number(data['amortization'][i].principal_paid);
                //Days Due
                var timeDiff = Math.abs(due_date2.getTime() - date_today2.getTime());
                //console.log('diffdays = '+timeDiff);
                var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24)); 

                console.log('due_date3 '+due_date+' type: '+typeof(due_date));
                console.log('surcharge_date_new3 '+date_today+' type: '+typeof(date_today));

                var unpaid = vatAmount + interestAmount + ips + principalAmount;
                var surcharge_unpaid = calculateSurchargeMonth(due_date, date_today, 0.03, unpaid);
                var due_amount = unpaid + surcharge_unpaid;
                console.log('unpaid type '+typeof(unpaid));
                console.log('unpaid type '+typeof(surcharge_unpaid));
                var paid_up = Number(data[i].interest_paid) + Number(data[i].principal_paid) + Number(data[i].vat_paid) + Number(data[i].surcharge_paid);
                var due2 = 0;

                
                var printAmort = parseFloat(Math.round(amortizationAmount * 100) / 100).toFixed(2);
                var printSurcharge = parseFloat(Math.round(surcharge_unpaid * 100) / 100).toFixed(2);
                var printVat = parseFloat(Math.round(vatAmount * 100) / 100).toFixed(2);
                var printIPS = parseFloat(Math.round(ips * 100) / 100).toFixed(2);
                var printInterest = parseFloat(Math.round(interestAmount * 100) / 100).toFixed(2);
                var printPrincipal = parseFloat(Math.round(principalAmount * 100) / 100).toFixed(2);
                var printPaid = parseFloat(Math.round(paid_up * 100) / 100).toFixed(2);
                
                due2 = due_amount - paid_up;
                var printDue = parseFloat(Math.round(due2 * 100) / 100).toFixed(2);
                console.log('printDue ='+printDue);
                content += '<td style="display: none;">' + data[i].amortization_id + '</td>'; 
                content += '<td>' + data[i].due_date + '</td>'; 
                content += '<td>' + data[i].firstname + ' '+ data[i].middlename + ' ' + data[i].lastname + '</td>'; 
                content += '<td>' + data[i].lot_description + '</td>'; 
                content += '<td>' + diffDays + '</td>';
                content += '<td>' + numberWithCommas(printDue) +'</td>';
                content += '<td>' + numberWithCommas(printAmort) + '</td>';
                content += '<td>' + numberWithCommas(printSurcharge) + '</td>';
                content += '<td>' + numberWithCommas(printVat) + '</td>';
                content += '<td>' + numberWithCommas(printIPS) +'</td>';
                content += '<td>' + numberWithCommas(printInterest) + '</td>';
                content += '<td>' + numberWithCommas(printPrincipal) + '</td>';
                content += '<td>' + numberWithCommas(printPaid) + '</td>';
                content += '</tr>';

            }
            //return content;
            $('#tbody_rp').html(content);
            $('#tblmonthlydues').dataTable({
                "order": [[ 1, "asc" ]] // Sort by first column descending
            });
            // var tblmonthlydues = $('#tblmonthlydues').DataTable();
            // var handleTable = function () {
                
            // }
            // return {
            //     //main function to initiate the module
            //     init: function () {
            //         handleTable();
            //     }
            // };



        },
        error: function(data){

        },
    });
}
function calculateSurchargeMonth(due_date, surchargedate, surchargerate, amount){
    today = moment();

    if (surchargedate.diff(today, 'days') < 0){
        //alert(surchargedate);
        today = surchargedate;
    }
    aging = surchargedate.diff(today, 'days');
    months_past_due = today.diff(due_date, 'months');
    month_before_today = due_date.add(months_past_due, 'months');
    days_past_due = today.diff(month_before_today, 'days');     
    total_surcharge = 0;
    for (var i = 0; i < months_past_due; i++){
        surcharge = amount * surchargerate;
        amount += surcharge;
        total_surcharge += surcharge;
    }
    if (days_past_due > 0){
        days_in_month = month_before_today.daysInMonth();
        surcharge = amount * surchargerate * days_past_due / days_in_month;
        amount += surcharge;
        total_surcharge += surcharge;
    }
    return total_surcharge;
}
function numberWithCommas(x) {
    var parts = x.toString().split(".");
    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    return parts.join(".");
}
var sumofpayments = 0;
function getPayments(contractid) {

    var contractID = contractid;
    var data = new FormData();
    data.append('contractid',contractID);
    for (var pair of data.entries()) {
        console.log(pair[0]+ ', ' + pair[1]); 
    }

    $.ajax({
        async: false,
        type: "POST",
        url:  baseurl + "collection/getClientDetails",
        data: data,
        cache: false,
        processData:false,
        contentType:false,
        success: function(result){

            var data = jQuery.parseJSON(result);
            
            console.log(data);
            console.log(data['payment'].length);
            for(x=0; x < data['payment'].length; x++){
                sumofpayments = +sumofpayments + +Number(data['payment'][x].amount);
                console.log(Number(data['payment'][x].amount));
            }
            console.log("Sum of Payments = "+parseFloat(Math.round(Number(sumofpayments) * 100) / 100).toFixed(2));
            // var table = document.getElementById("tblcontracts");
            // table.rows[1].cells[5].innerHTML = 'samples';
            // return sumofpayments;
        },
        error: function (errorThrown){
            toastr.error('Error!', 'Operation Done');
            console.log(errorThrown);
        }
    });
    return sumofpayments;
}
function createArray(length) {
    var arr = new Array(length || 0),
        i = length;

    if (arguments.length > 1) {
        var args = Array.prototype.slice.call(arguments, 1);
        while(i--) arr[length-1 - i] = createArray.apply(this, args);
    }

    return arr;
}
// var TableDatatablesEditable = function () {

//     var tblmonthlydues = $('#tblmonthlydues').DataTable();
//     var handleTable = function () {

//     }
//     return {
//         //main function to initiate the module
//         init: function () {
//             handleTable();
//         }
//     };
// }();