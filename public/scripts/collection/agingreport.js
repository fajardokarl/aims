$(document).ready(function(){

    $('#generate').click(function () {
        
        if($('#type').val()==1){
            $('#print_detailed3').hide();
            $('#print_detailed1').show();
            $('#print_detailed2').hide();
            $.ajax({
                url: baseurl + "collection/get_amort_for_aging",
                type: 'POST',
                success: function(result) {
                    var content = '';
                    var table = document.getElementById("tblsummaryaging");
                    var data = jQuery.parseJSON(result);
                    console.log(data);
                    var date = new Date();
                    var date_30 = date.setDate(date.getDate() - 30);
                    date_30 = new Date(date_30);
                    var date_60 = date.setDate(date.getDate() - 60);
                    date_60 = new Date(date_60);
                    var date_90 = date.setDate(date.getDate() - 90);
                    date_90 = new Date(date_90);
                    var date_120 = date.setDate(date.getDate() - 120);
                    date_120 = new Date(date_120);

                    var temp_projects = {};
                    var temp_30 = {};
                    var temp_60 = {};
                    var temp_90 = {};
                    var temp_120 = {};
                    var temp_120_more = {};
                    var temp_contract_id = {};
                    var temp_project_id = {};
                    var temp_sum = {};
                    var temp_tcp = {};

                    for(var i=0; i < data.length; i++) {

                        var amortizationid = data[i].amortization_id;
                        var contractID = data[i].contractID;
                        var paidamount = Number(data[i].interest_paid) + Number(data[i].principal_paid) + Number(data[i].vat_paid) + Number(data[i].surcharge_paid);
                        var amortization = Number(data[i].amortization_amount);
                        //amortization = parseFloat(Math.round(amortization * 100) / 100).toFixed(2);
                        var principal = Number(data[i].principal_amount);
                        var vat = Number(data[i].vat_amount);
                        var ips = Number(data[i].rebate);
                        var interest = Number(data[i].interest_amount);
                        var unpaid = vat + interest + ips + amortization;
                        var parts = data[i].due_date.split('-');
                        var due_date2 = new Date(parts[0],parts[1]-1,parts[2]); 
                        var due_date = moment(data[i].due_date, "YYYY-MM-DD");
                        var date_today = moment();
                        var surcharge = calculateSurchargeMonth(due_date, date_today, 0.03, unpaid);
                        unpaid = unpaid + surcharge;

                        if (!temp_projects.hasOwnProperty(data[i].project_id)) {
                            temp_projects[data[i].project_id] = 0;
                        }
                        temp_projects[data[i].project_id] = data[i].project_name;

                        if (!temp_30.hasOwnProperty(data[i].project_id)) {
                            temp_30[data[i].project_id] = 0;
                        }
                        if (due_date2 >= date_30 && due_date2 <date_today){
                            temp_30[data[i].project_id] += unpaid;
                        }

                        if (!temp_60.hasOwnProperty(data[i].project_id)) {
                            temp_60[data[i].project_id] = 0;
                        }
                        if (due_date2 >= date_60 && due_date2 <date_today){
                            temp_60[data[i].project_id] += unpaid;
                        }

                        if (!temp_90.hasOwnProperty(data[i].project_id)) {
                            temp_90[data[i].project_id] = 0;
                        }
                        if (due_date2 >= date_90 && due_date2 <date_today){
                            temp_90[data[i].project_id] += unpaid;
                        }

                        if (!temp_120.hasOwnProperty(data[i].project_id)) {
                            temp_120[data[i].project_id] = 0;
                        }
                        if (due_date2 >= date_120 && due_date2 <date_today){
                            temp_120[data[i].project_id] += unpaid;
                        }

                        if (!temp_120_more.hasOwnProperty(data[i].project_id)) {
                            temp_120_more[data[i].project_id] = 0;
                        }
                        if (due_date2 <= date_120 && due_date2 <date_today){
                            temp_120_more[data[i].project_id] += unpaid;
                        }

                        if (!temp_contract_id.hasOwnProperty(data[i].contractID)) {
                            temp_contract_id[data[i].contractID] = 0;
                        }
                        temp_contract_id[data[i].contractID] = data[i].contractID;

                    }

                    var contractids = [];
                    for (var prop in temp_contract_id){
                        contractids.push(temp_contract_id[prop]);
                    }

                    for (var x=0; x<contractids.length;x++){
                        var data = new FormData();
                        var payment = 0;
                        data.append('contractid',contractids[x]);
                        // for (var pair of data.entries()) {
                        //     console.log(pair[0]+ ', ' + pair[1]); 
                        // }
                        var sum_of_payments = 0;
                        $.ajax({
                            async: false,
                            type: "POST",
                            url:  baseurl + "collection/get_person_for_aging",
                            data: data,
                            cache: false,
                            processData:false,
                            contentType:false,
                            success: function(result){
                                var data = jQuery.parseJSON(result);
                                if (!temp_project_id.hasOwnProperty(data[x].project_id)) {
                                    temp_project_id[data[x].project_id] = 0;
                                }
                                temp_project_id[data[x].project_id] = data[x].project_id;
                                if(data[0].project_id = temp_project_id[data[x].project_id]){
                                    if (!temp_sum.hasOwnProperty(data[x].project_id)) {
                                        temp_sum[data[x].project_id] = 0;
                                    }
                                    payment = getPayments(contractids[x]);
                                    temp_sum[data[x].project_id] += payment;
                                    if (!temp_tcp.hasOwnProperty(data[x].project_id)) {
                                        temp_tcp[data[x].project_id] = 0;
                                    }
                                    temp_tcp[data[x].project_id] += Number(data[x].total_contract_price);
                                }
                            },
                            error:  function(result){

                            },
                        });
                    }

                    var projects = [];
                    for (var prop in temp_projects){
                        projects.push(temp_projects[prop]);
                    }
                    var days_30 = [];
                    for (var prop in temp_30){
                        days_30.push(temp_30[prop].toFixed(2));
                    }
                    var days_60 = [];
                    for (var prop in temp_60){
                        days_60.push(temp_60[prop].toFixed(2));
                    }
                    var days_90 = [];
                    for (var prop in temp_90){
                        days_90.push(temp_90[prop].toFixed(2));
                    }
                    var days_120 = [];
                    for (var prop in temp_120){
                        days_120.push(temp_120[prop].toFixed(2));
                    }
                    var days_120_more = [];
                    for (var prop in temp_120_more){
                        days_120_more.push(temp_120_more[prop].toFixed(2));
                    }
                    var tcp = [];
                    for (var prop in temp_tcp){
                        tcp.push(temp_tcp[prop].toFixed(2));
                    }
                    var payments = [];
                    for (var prop in temp_sum){
                        payments.push(temp_sum[prop].toFixed(2));
                    }

                    console.log(temp_projects);
                    console.log(temp_30);
                    console.log(temp_60);
                    console.log(temp_90);
                    console.log(temp_120);
                    console.log(temp_project_id);
                    console.log(temp_tcp);
                    console.log(temp_sum);
                    console.log('-------------------------');
                    console.log(projects);
                    console.log(days_30);
                    console.log(days_60);
                    console.log(days_90);
                    console.log(days_120);
                    console.log(tcp);
                    console.log(payments);

                    var days_30_total = 0;
                    var days_60_total = 0;
                    var days_90_total = 0;
                    var days_120_total = 0;
                    var days_120_more_total = 0;
                    var overall_current_total = 0;
                    var longterm_total = 0;

                    for (var x=0;x<projects.length;x++){
                        var current_total = Number(days_30[x]) + Number(days_60[x]) + Number(days_90[x]) + Number(days_120[x]) + Number(days_120_more[x]);
                        current_total = current_total.toFixed(2);
                        overall_current_total += Number(current_total);
                        days_30_total += Number(days_30[x]);
                        days_60_total += Number(days_60[x]);
                        days_90_total += Number(days_90[x]);
                        days_120_total += Number(days_120[x]);
                        days_120_more_total += Number(days_120_more[x]);
                        var longterm = Number(tcp[x]) - Number(current_total) - Number(payments[x]);
                        longterm = longterm.toFixed(2);
                        longterm_total += Number(longterm);
                        content += '<tr>';
                        content += '<td>' + projects[x] + '</td>';
                        content += '<td>' + numberWithCommas(days_30[x]) + '</td>';
                        content += '<td>' + numberWithCommas(days_60[x]) + '</td>';
                        content += '<td>' + numberWithCommas(days_90[x]) + '</td>';
                        content += '<td>' + numberWithCommas(days_120[x]) + '</td>';
                        content += '<td>' + numberWithCommas(days_120_more[x]) + '</td>';
                        content += '<td>' + numberWithCommas(current_total) + ' </td>';
                        content += '<td>' + numberWithCommas(longterm) + '</td>';
                        content += '</tr>';
                    }
                    $('#030total2').text(numberWithCommas(days_30_total.toFixed(2)));
                    $('#3160total2').text(numberWithCommas(days_60_total.toFixed(2)));
                    $('#6190daystotal2').text(numberWithCommas(days_90_total.toFixed(2)));
                    $('#91120daystotal2').text(numberWithCommas(days_120_total.toFixed(2)));
                    $('#120daystotal2').text(numberWithCommas(days_120_more_total.toFixed(2)));
                    $('#currenttotal2').text(numberWithCommas(overall_current_total.toFixed(2)));
                    $('#longtermtotal2').text(numberWithCommas(longterm_total.toFixed(2)));
                    $('#tbody_sa').html(content);
                    $('#tblsummaryaging').dataTable({
                        "order": [[ 0, "asc" ]] // Sort by first column descending
                    });
                    var removeDataTable = $('#tblsummaryaging2').dataTable();
                    removeDataTable.fnDestroy();
                    $('#summaryrow').show();
                    $('#summaryrow2').hide();
                    $('#excel_summary3').hide();


                },
                error: function(data) {

                },
            });
        }
        if($('#type').val()==2){
            $('#print_detailed3').hide();
            $('#print_detailed1').hide();
            $('#print_detailed2').show();
            $.ajax({
                url: baseurl + "collection/get_amort_for_aging",
                type: 'POST',
                success: function(result) {

                    var content='';
                    var table = document.getElementById("tblsummaryaging2");
                    var data = jQuery.parseJSON(result);
                    console.log(data);
                    var date = new Date();
                    var date_30 = date.setDate(date.getDate() - 30);
                    date_30 = new Date(date_30);
                    var date_60 = date.setDate(date.getDate() - 60);
                    date_60 = new Date(date_60);
                    var date_90 = date.setDate(date.getDate() - 90);
                    date_90 = new Date(date_90);
                    var date_120 = date.setDate(date.getDate() - 120);
                    date_120 = new Date(date_120);

                    var temp_tax = {};
                    var temp_30 = {};
                    var temp_60 = {};
                    var temp_90 = {};
                    var temp_120 = {};
                    var temp_120_more = {};
                    var temp_contract_id = {};
                    var temp_tax_id = {};
                    var temp_sum = {};
                    var temp_tcp = {};

                    for(var i=0; i < data.length; i++) {

                        var amortizationid = data[i].amortization_id;
                        var contractID = data[i].contract_id;
                        var paidamount = Number(data[i].interest_paid) + Number(data[i].principal_paid) + Number(data[i].vat_paid) + Number(data[i].surcharge_paid);
                        var amortization = Number(data[i].amortization_amount);
                        //amortization = parseFloat(Math.round(amortization * 100) / 100).toFixed(2);
                        var principal = Number(data[i].principal_amount);
                        var vat = Number(data[i].vat_amount);
                        var ips = Number(data[i].rebate);
                        var interest = Number(data[i].interest_amount);
                        var unpaid = vat + interest + ips + amortization;
                        var parts = data[i].due_date.split('-');
                        var due_date2 = new Date(parts[0],parts[1]-1,parts[2]); 
                        var due_date = moment(data[i].due_date, "YYYY-MM-DD");
                        var date_today = moment();
                        var surcharge = calculateSurchargeMonth(due_date, date_today, 0.03, unpaid);
                        unpaid = unpaid + surcharge;

                        if (!temp_tax.hasOwnProperty(data[i].is_tax_deferred)) {
                            temp_tax[data[i].is_tax_deferred] = 0;
                        }
                        temp_tax[data[i].is_tax_deferred] = data[i].is_tax_deferred;

                        if (!temp_30.hasOwnProperty(data[i].is_tax_deferred)) {
                            temp_30[data[i].is_tax_deferred] = 0;
                        }
                        if (due_date2 >= date_30 && due_date2 <date_today){
                            temp_30[data[i].is_tax_deferred] += unpaid;
                        }

                        if (!temp_60.hasOwnProperty(data[i].is_tax_deferred)) {
                            temp_60[data[i].is_tax_deferred] = 0;
                        }
                        if (due_date2 >= date_60 && due_date2 <date_today){
                            temp_60[data[i].is_tax_deferred] += unpaid;
                        }

                        if (!temp_90.hasOwnProperty(data[i].is_tax_deferred)) {
                            temp_90[data[i].is_tax_deferred] = 0;
                        }
                        if (due_date2 >= date_90 && due_date2 <date_today){
                            temp_90[data[i].is_tax_deferred] += unpaid;
                        }

                        if (!temp_120.hasOwnProperty(data[i].is_tax_deferred)) {
                            temp_120[data[i].is_tax_deferred] = 0;
                        }
                        if (due_date2 >= date_120 && due_date2 < date_today){
                            temp_120[data[i].is_tax_deferred] += unpaid;
                        }

                        if (!temp_120_more.hasOwnProperty(data[i].is_tax_deferred)) {
                            temp_120_more[data[i].is_tax_deferred] = 0;
                        }
                        if (due_date2 <= date_120 && due_date2 <date_today){
                            temp_120_more[data[i].is_tax_deferred] += unpaid;
                        }
                        if (!temp_contract_id.hasOwnProperty(data[i].contractID)) {
                            temp_contract_id[data[i].contractID] = 0;
                        }
                        temp_contract_id[data[i].contractID] = data[i].contractID;

                    }

                    var contractids = [];
                    for (var prop in temp_contract_id){
                        contractids.push(temp_contract_id[prop]);
                    }

                    for (var x=0; x<contractids.length;x++){
                        var data = new FormData();
                        var payment = 0;
                        data.append('contractid',contractids[x]);
                        // for (var pair of data.entries()) {
                        //     console.log(pair[0]+ ', ' + pair[1]); 
                        // }
                        var sum_of_payments = 0;
                        $.ajax({
                            async: false,
                            type: "POST",
                            url:  baseurl + "collection/get_person_for_aging",
                            data: data,
                            cache: false,
                            processData:false,
                            contentType:false,
                            success: function(result){
                                var data = jQuery.parseJSON(result);
                                if (!temp_tax_id.hasOwnProperty(data[x].is_tax_deferred)) {
                                    temp_tax_id[data[x].is_tax_deferred] = 0;
                                }
                                temp_tax_id[data[x].is_tax_deferred] = data[x].is_tax_deferred;
                                if(data[0].is_tax_deferred = temp_tax_id[data[x].is_tax_deferred]){
                                    if (!temp_sum.hasOwnProperty(data[x].is_tax_deferred)) {
                                        temp_sum[data[x].is_tax_deferred] = 0;
                                    }
                                    payment = getPayments(contractids[x]);
                                    temp_sum[data[x].is_tax_deferred] += payment;
                                    if (!temp_tcp.hasOwnProperty(data[x].is_tax_deferred)) {
                                        temp_tcp[data[x].is_tax_deferred] = 0;
                                    }
                                    temp_tcp[data[x].is_tax_deferred] += Number(data[x].total_contract_price);
                                }
                            },
                            error:  function(result){

                            },
                        });
                    }

                    var tax = [];
                    for (var prop in temp_tax){
                        tax.push(temp_tax[prop]);
                    }
                    var days_30 = [];
                    for (var prop in temp_30){
                        days_30.push(temp_30[prop].toFixed(2));
                    }
                    var days_60 = [];
                    for (var prop in temp_60){
                        days_60.push(temp_60[prop].toFixed(2));
                    }
                    var days_90 = [];
                    for (var prop in temp_90){
                        days_90.push(temp_90[prop].toFixed(2));
                    }
                    var days_120 = [];
                    for (var prop in temp_120){
                        days_120.push(temp_120[prop].toFixed(2));
                    }
                    var days_120_more = [];
                    for (var prop in temp_120_more){
                        days_120_more.push(temp_120_more[prop].toFixed(2));
                    }
                    var tcp = [];
                    for (var prop in temp_tcp){
                        tcp.push(temp_tcp[prop].toFixed(2));
                    }
                    var payments = [];
                    for (var prop in temp_sum){
                        payments.push(temp_sum[prop].toFixed(2));
                    }

                    console.log(temp_tax);
                    console.log(temp_30);
                    console.log(temp_60);
                    console.log(temp_90);
                    console.log(temp_120);
                    console.log(temp_tax_id);
                    console.log(temp_tcp);
                    console.log(temp_sum);
                    console.log('-------------------');
                    console.log(tax);
                    console.log(days_30);
                    console.log(days_60);
                    console.log(days_90);
                    console.log(days_120);
                    console.log(tcp);
                    console.log(payments);

                    var days_30_total = 0;
                    var days_60_total = 0;
                    var days_90_total = 0;
                    var days_120_total = 0;
                    var days_120_more_total = 0;
                    var overall_current_total = 0;
                    var longterm_total = 0;

                    for (var x=0;x<tax.length;x++){
                        var current_total = Number(days_30[x]) + Number(days_60[x]) + Number(days_90[x]) + Number(days_120[x]) + Number(days_120_more[x]);
                        current_total = current_total.toFixed(2);
                        content += '<tr>';
                        if (tax[x] == 1){
                            content += '<td>Deferred</td>';
                        } else {
                            content += '<td>Installment</td>';
                        }
                        overall_current_total += Number(current_total);
                        days_30_total += Number(days_30[x]);
                        days_60_total += Number(days_60[x]);
                        days_90_total += Number(days_90[x]);
                        days_120_total += Number(days_120[x]);
                        days_120_more_total += Number(days_120_more[x]);
                        var longterm = Number(tcp[x]) - Number(current_total) - Number(payments[x]);
                        longterm = longterm.toFixed(2);
                        longterm_total += Number(longterm);
                        content += '<td>' + numberWithCommas(days_30[x]) + '</td>';
                        content += '<td>' + numberWithCommas(days_60[x]) + '</td>';
                        content += '<td>' + numberWithCommas(days_90[x]) + '</td>';
                        content += '<td>' + numberWithCommas(days_120[x]) + '</td>';
                        content += '<td>' + numberWithCommas(days_120_more[x]) + '</td>';
                        content += '<td>' + numberWithCommas(current_total) + ' </td>';
                        content += '<td>' + numberWithCommas(longterm) + '</td>';
                        content += '</tr>';
                    }
                    $('#030total3').text(numberWithCommas(days_30_total.toFixed(2)));
                    $('#3160total3').text(numberWithCommas(days_60_total.toFixed(2)));
                    $('#6190daystotal3').text(numberWithCommas(days_90_total.toFixed(2)));
                    $('#91120daystotal3').text(numberWithCommas(days_120_total.toFixed(2)));
                    $('#120daystotal3').text(numberWithCommas(days_120_more_total.toFixed(2)));
                    $('#currenttotal3').text(numberWithCommas(overall_current_total.toFixed(2)));
                    $('#longtermtotal3').text(numberWithCommas(longterm_total.toFixed(2)));
                    $('#tbody_sa2').html(content);
                    $('#tblsummaryaging2').dataTable({
                        "order": [[ 0, "asc" ]] // Sort by first column descending
                    });
                    var removeDataTable = $('#tblsummaryaging').dataTable();
                    removeDataTable.fnDestroy();
                    $('#summaryrow2').show();
                    $('#summaryrow').hide();
                    $('excel_summary1').hide();
                    $('print_summary1').hide();
                    $('excel_summary2').show();
                    $('print_summary2').show();

                },
                error: function(data) {

                },
            });

        }

        if($('#type').val()==3){
            $('#print_detailed3').show();
            $('#print_detailed1').hide();
            $('#print_detailed2').hide();
            $.ajax({
                url: baseurl + "collection/get_amort_for_aging",
                type: 'POST',
                success: function(result) {
                    var content = '';
                    var table = document.getElementById("tblsummaryaging");
                    var data = jQuery.parseJSON(result);
                    console.log(data);
                    var date = new Date();
                    var date_30 = date.setDate(date.getDate() - 30);
                    date_30 = new Date(date_30);
                    var date_60 = date.setDate(date.getDate() - 60);
                    date_60 = new Date(date_60);
                    var date_90 = date.setDate(date.getDate() - 90);
                    date_90 = new Date(date_90);
                    var date_120 = date.setDate(date.getDate() - 120);
                    date_120 = new Date(date_120);

                    var temp_projects = {};
                    var temp_30 = {};
                    var temp_60 = {};
                    var temp_90 = {};
                    var temp_120 = {};
                    var temp_120_more = {};
                    var temp_contract_id = {};
                    var temp_project_id = {};
                    var temp_sum = {};
                    var temp_tcp = {};

                    for(var i=0; i < data.length; i++) {

                        var amortizationid = data[i].amortization_id;
                        var contractID = data[i].contractID;
                        var paidamount = Number(data[i].interest_paid) + Number(data[i].principal_paid) + Number(data[i].vat_paid) + Number(data[i].surcharge_paid);
                        var amortization = Number(data[i].amortization_amount);
                        //amortization = parseFloat(Math.round(amortization * 100) / 100).toFixed(2);
                        var principal = Number(data[i].principal_amount);
                        var vat = Number(data[i].vat_amount);
                        var ips = Number(data[i].rebate);
                        var interest = Number(data[i].interest_amount);
                        var unpaid = vat + interest + ips + amortization;
                        var parts = data[i].due_date.split('-');
                        var due_date2 = new Date(parts[0],parts[1]-1,parts[2]); 
                        var due_date = moment(data[i].due_date, "YYYY-MM-DD");
                        var date_today = moment();
                        var surcharge = calculateSurchargeMonth(due_date, date_today, 0.03, unpaid);
                        unpaid = unpaid + surcharge;

                        if (!temp_projects.hasOwnProperty(data[i].project_id)) {
                            temp_projects[data[i].project_id] = 0;
                        }
                        temp_projects[data[i].project_id] = data[i].project_name;

                        if (!temp_30.hasOwnProperty(data[i].project_id)) {
                            temp_30[data[i].project_id] = 0;
                        }
                        if (due_date2 >= date_30 && due_date2 <date_today){
                            temp_30[data[i].project_id] += unpaid;
                        }

                        if (!temp_60.hasOwnProperty(data[i].project_id)) {
                            temp_60[data[i].project_id] = 0;
                        }
                        if (due_date2 >= date_60 && due_date2 <date_today){
                            temp_60[data[i].project_id] += unpaid;
                        }

                        if (!temp_90.hasOwnProperty(data[i].project_id)) {
                            temp_90[data[i].project_id] = 0;
                        }
                        if (due_date2 >= date_90 && due_date2 <date_today){
                            temp_90[data[i].project_id] += unpaid;
                        }

                        if (!temp_120.hasOwnProperty(data[i].project_id)) {
                            temp_120[data[i].project_id] = 0;
                        }
                        if (due_date2 >= date_120 && due_date2 <date_today){
                            temp_120[data[i].project_id] += unpaid;
                        }

                        if (!temp_120_more.hasOwnProperty(data[i].project_id)) {
                            temp_120_more[data[i].project_id] = 0;
                        }
                        if (due_date2 <= date_120 && due_date2 <date_today){
                            temp_120_more[data[i].project_id] += unpaid;
                        }

                        if (!temp_contract_id.hasOwnProperty(data[i].contractID)) {
                            temp_contract_id[data[i].contractID] = 0;
                        }
                        temp_contract_id[data[i].contractID] = data[i].contractID;

                    }

                    var contractids = [];
                    for (var prop in temp_contract_id){
                        contractids.push(temp_contract_id[prop]);
                    }

                    for (var x=0; x<contractids.length;x++){
                        var data = new FormData();
                        var payment = 0;
                        data.append('contractid',contractids[x]);
                        // for (var pair of data.entries()) {
                        //     console.log(pair[0]+ ', ' + pair[1]); 
                        // }
                        var sum_of_payments = 0;
                        $.ajax({
                            async: false,
                            type: "POST",
                            url:  baseurl + "collection/get_person_for_aging",
                            data: data,
                            cache: false,
                            processData:false,
                            contentType:false,
                            success: function(result){
                                var data = jQuery.parseJSON(result);
                                if (!temp_project_id.hasOwnProperty(data[x].project_id)) {
                                    temp_project_id[data[x].project_id] = 0;
                                }
                                temp_project_id[data[x].project_id] = data[x].project_id;
                                if(data[0].project_id = temp_project_id[data[x].project_id]){
                                    if (!temp_sum.hasOwnProperty(data[x].project_id)) {
                                        temp_sum[data[x].project_id] = 0;
                                    }
                                    payment = getPayments(contractids[x]);
                                    temp_sum[data[x].project_id] += payment;
                                    if (!temp_tcp.hasOwnProperty(data[x].project_id)) {
                                        temp_tcp[data[x].project_id] = 0;
                                    }
                                    temp_tcp[data[x].project_id] += Number(data[x].total_contract_price);
                                }
                            },
                            error:  function(result){

                            },
                        });
                    }

                    var projects = [];
                    for (var prop in temp_projects){
                        projects.push(temp_projects[prop]);
                    }
                    var days_30 = [];
                    for (var prop in temp_30){
                        days_30.push(temp_30[prop].toFixed(2));
                    }
                    var days_60 = [];
                    for (var prop in temp_60){
                        days_60.push(temp_60[prop].toFixed(2));
                    }
                    var days_90 = [];
                    for (var prop in temp_90){
                        days_90.push(temp_90[prop].toFixed(2));
                    }
                    var days_120 = [];
                    for (var prop in temp_120){
                        days_120.push(temp_120[prop].toFixed(2));
                    }
                    var days_120_more = [];
                    for (var prop in temp_120_more){
                        days_120_more.push(temp_120_more[prop].toFixed(2));
                    }
                    var tcp = [];
                    for (var prop in temp_tcp){
                        tcp.push(temp_tcp[prop].toFixed(2));
                    }
                    var payments = [];
                    for (var prop in temp_sum){
                        payments.push(temp_sum[prop].toFixed(2));
                    }

                    console.log(temp_projects);
                    console.log(temp_30);
                    console.log(temp_60);
                    console.log(temp_90);
                    console.log(temp_120);
                    console.log(temp_project_id);
                    console.log(temp_tcp);
                    console.log(temp_sum);
                    console.log('-------------------------');
                    console.log(projects);
                    console.log(days_30);
                    console.log(days_60);
                    console.log(days_90);
                    console.log(days_120);
                    console.log(tcp);
                    console.log(payments);

                    var days_30_total = 0;
                    var days_60_total = 0;
                    var days_90_total = 0;
                    var days_120_total = 0;
                    var days_120_more_total = 0;
                    var overall_current_total = 0;
                    var longterm_total = 0;

                    for (var x=0;x<projects.length;x++){
                        var current_total = Number(days_30[x]) + Number(days_60[x]) + Number(days_90[x]) + Number(days_120[x]) + Number(days_120_more[x]);
                        current_total = current_total.toFixed(2);
                        overall_current_total += Number(current_total);
                        days_30_total += Number(days_30[x]);
                        days_60_total += Number(days_60[x]);
                        days_90_total += Number(days_90[x]);
                        days_120_total += Number(days_120[x]);
                        days_120_more_total += Number(days_120_more[x]);
                        var longterm = Number(tcp[x]) - Number(current_total) - Number(payments[x]);
                        longterm = longterm.toFixed(2);
                        longterm_total += Number(longterm);
                        content += '<tr>';
                        content += '<td>' + projects[x] + '</td>';
                        content += '<td>' + numberWithCommas(days_30[x]) + '</td>';
                        content += '<td>' + numberWithCommas(days_60[x]) + '</td>';
                        content += '<td>' + numberWithCommas(days_90[x]) + '</td>';
                        content += '<td>' + numberWithCommas(days_120[x]) + '</td>';
                        content += '<td>' + numberWithCommas(days_120_more[x]) + '</td>';
                        content += '<td>' + numberWithCommas(current_total) + ' </td>';
                        content += '<td>' + numberWithCommas(longterm) + '</td>';
                        content += '</tr>';
                    }
                    $('#030total2').text(numberWithCommas(days_30_total.toFixed(2)));
                    $('#3160total2').text(numberWithCommas(days_60_total.toFixed(2)));
                    $('#6190daystotal2').text(numberWithCommas(days_90_total.toFixed(2)));
                    $('#91120daystotal2').text(numberWithCommas(days_120_total.toFixed(2)));
                    $('#120daystotal2').text(numberWithCommas(days_120_more_total.toFixed(2)));
                    $('#currenttotal2').text(numberWithCommas(overall_current_total.toFixed(2)));
                    $('#longtermtotal2').text(numberWithCommas(longterm_total.toFixed(2)));
                    $('#tbody_sa').html(content);
                    $('#tblsummaryaging').dataTable({
                        "order": [[ 0, "asc" ]] // Sort by first column descending
                    });
                    var removeDataTable = $('#tblsummaryaging2').dataTable();
                    removeDataTable.fnDestroy();
                    $('#summaryrow').show();
                    $('#excel_summary3').show();
                    $('#excel_summary1').hide();
                    $('#excel_summary2').hide();

                },
                error: function(data) {

                },
            });

            $.ajax({
                url: baseurl + "collection/get_amort_for_aging",
                type: 'POST',
                success: function(result) {

                    var content='';
                    var table = document.getElementById("tblsummaryaging2");
                    var data = jQuery.parseJSON(result);
                    console.log(data);
                    var date = new Date();
                    var date_30 = date.setDate(date.getDate() - 30);
                    date_30 = new Date(date_30);
                    var date_60 = date.setDate(date.getDate() - 60);
                    date_60 = new Date(date_60);
                    var date_90 = date.setDate(date.getDate() - 90);
                    date_90 = new Date(date_90);
                    var date_120 = date.setDate(date.getDate() - 120);
                    date_120 = new Date(date_120);

                    var temp_tax = {};
                    var temp_30 = {};
                    var temp_60 = {};
                    var temp_90 = {};
                    var temp_120 = {};
                    var temp_120_more = {};
                    var temp_contract_id = {};
                    var temp_tax_id = {};
                    var temp_sum = {};
                    var temp_tcp = {};

                    for(var i=0; i < data.length; i++) {

                        var amortizationid = data[i].amortization_id;
                        var contractID = data[i].contract_id;
                        var paidamount = Number(data[i].interest_paid) + Number(data[i].principal_paid) + Number(data[i].vat_paid) + Number(data[i].surcharge_paid);
                        var amortization = Number(data[i].amortization_amount);
                        //amortization = parseFloat(Math.round(amortization * 100) / 100).toFixed(2);
                        var principal = Number(data[i].principal_amount);
                        var vat = Number(data[i].vat_amount);
                        var ips = Number(data[i].rebate);
                        var interest = Number(data[i].interest_amount);
                        var unpaid = vat + interest + ips + amortization;
                        var parts = data[i].due_date.split('-');
                        var due_date2 = new Date(parts[0],parts[1]-1,parts[2]); 
                        var due_date = moment(data[i].due_date, "YYYY-MM-DD");
                        var date_today = moment();
                        var surcharge = calculateSurchargeMonth(due_date, date_today, 0.03, unpaid);
                        unpaid = unpaid + surcharge;

                        if (!temp_tax.hasOwnProperty(data[i].is_tax_deferred)) {
                            temp_tax[data[i].is_tax_deferred] = 0;
                        }
                        temp_tax[data[i].is_tax_deferred] = data[i].is_tax_deferred;

                        if (!temp_30.hasOwnProperty(data[i].is_tax_deferred)) {
                            temp_30[data[i].is_tax_deferred] = 0;
                        }
                        if (due_date2 >= date_30 && due_date2 <date_today){
                            temp_30[data[i].is_tax_deferred] += unpaid;
                        }

                        if (!temp_60.hasOwnProperty(data[i].is_tax_deferred)) {
                            temp_60[data[i].is_tax_deferred] = 0;
                        }
                        if (due_date2 >= date_60 && due_date2 <date_today){
                            temp_60[data[i].is_tax_deferred] += unpaid;
                        }

                        if (!temp_90.hasOwnProperty(data[i].is_tax_deferred)) {
                            temp_90[data[i].is_tax_deferred] = 0;
                        }
                        if (due_date2 >= date_90 && due_date2 <date_today){
                            temp_90[data[i].is_tax_deferred] += unpaid;
                        }

                        if (!temp_120.hasOwnProperty(data[i].is_tax_deferred)) {
                            temp_120[data[i].is_tax_deferred] = 0;
                        }
                        if (due_date2 >= date_120 && due_date2 < date_today){
                            temp_120[data[i].is_tax_deferred] += unpaid;
                        }

                        if (!temp_120_more.hasOwnProperty(data[i].is_tax_deferred)) {
                            temp_120_more[data[i].is_tax_deferred] = 0;
                        }
                        if (due_date2 <= date_120 && due_date2 <date_today){
                            temp_120_more[data[i].is_tax_deferred] += unpaid;
                        }
                        if (!temp_contract_id.hasOwnProperty(data[i].contractID)) {
                            temp_contract_id[data[i].contractID] = 0;
                        }
                        temp_contract_id[data[i].contractID] = data[i].contractID;

                    }

                    var contractids = [];
                    for (var prop in temp_contract_id){
                        contractids.push(temp_contract_id[prop]);
                    }

                    for (var x=0; x<contractids.length;x++){
                        var data = new FormData();
                        var payment = 0;
                        data.append('contractid',contractids[x]);
                        // for (var pair of data.entries()) {
                        //     console.log(pair[0]+ ', ' + pair[1]); 
                        // }
                        var sum_of_payments = 0;
                        $.ajax({
                            async: false,
                            type: "POST",
                            url:  baseurl + "collection/get_person_for_aging",
                            data: data,
                            cache: false,
                            processData:false,
                            contentType:false,
                            success: function(result){
                                var data = jQuery.parseJSON(result);
                                if (!temp_tax_id.hasOwnProperty(data[x].is_tax_deferred)) {
                                    temp_tax_id[data[x].is_tax_deferred] = 0;
                                }
                                temp_tax_id[data[x].is_tax_deferred] = data[x].is_tax_deferred;
                                if(data[0].is_tax_deferred = temp_tax_id[data[x].is_tax_deferred]){
                                    if (!temp_sum.hasOwnProperty(data[x].is_tax_deferred)) {
                                        temp_sum[data[x].is_tax_deferred] = 0;
                                    }
                                    payment = getPayments(contractids[x]);
                                    temp_sum[data[x].is_tax_deferred] += payment;
                                    if (!temp_tcp.hasOwnProperty(data[x].is_tax_deferred)) {
                                        temp_tcp[data[x].is_tax_deferred] = 0;
                                    }
                                    temp_tcp[data[x].is_tax_deferred] += Number(data[x].total_contract_price);
                                }
                            },
                            error:  function(result){

                            },
                        });
                    }

                    var tax = [];
                    for (var prop in temp_tax){
                        tax.push(temp_tax[prop]);
                    }
                    var days_30 = [];
                    for (var prop in temp_30){
                        days_30.push(temp_30[prop].toFixed(2));
                    }
                    var days_60 = [];
                    for (var prop in temp_60){
                        days_60.push(temp_60[prop].toFixed(2));
                    }
                    var days_90 = [];
                    for (var prop in temp_90){
                        days_90.push(temp_90[prop].toFixed(2));
                    }
                    var days_120 = [];
                    for (var prop in temp_120){
                        days_120.push(temp_120[prop].toFixed(2));
                    }
                    var days_120_more = [];
                    for (var prop in temp_120_more){
                        days_120_more.push(temp_120_more[prop].toFixed(2));
                    }
                    var tcp = [];
                    for (var prop in temp_tcp){
                        tcp.push(temp_tcp[prop].toFixed(2));
                    }
                    var payments = [];
                    for (var prop in temp_sum){
                        payments.push(temp_sum[prop].toFixed(2));
                    }

                    console.log(temp_tax);
                    console.log(temp_30);
                    console.log(temp_60);
                    console.log(temp_90);
                    console.log(temp_120);
                    console.log(temp_tax_id);
                    console.log(temp_tcp);
                    console.log(temp_sum);
                    console.log('-------------------');
                    console.log(tax);
                    console.log(days_30);
                    console.log(days_60);
                    console.log(days_90);
                    console.log(days_120);
                    console.log(tcp);
                    console.log(payments);

                    var days_30_total = 0;
                    var days_60_total = 0;
                    var days_90_total = 0;
                    var days_120_total = 0;
                    var days_120_more_total = 0;
                    var overall_current_total = 0;
                    var longterm_total = 0;

                    for (var x=0;x<tax.length;x++){
                        var current_total = Number(days_30[x]) + Number(days_60[x]) + Number(days_90[x]) + Number(days_120[x]) + Number(days_120_more[x]);
                        current_total = current_total.toFixed(2);
                        content += '<tr>';
                        if (tax[x] == 1){
                            content += '<td>Deferred</td>';
                        } else {
                            content += '<td>Installment</td>';
                        }
                        overall_current_total += Number(current_total);
                        days_30_total += Number(days_30[x]);
                        days_60_total += Number(days_60[x]);
                        days_90_total += Number(days_90[x]);
                        days_120_total += Number(days_120[x]);
                        days_120_more_total += Number(days_120_more[x]);
                        var longterm = Number(tcp[x]) - Number(current_total) - Number(payments[x]);
                        longterm = longterm.toFixed(2);
                        longterm_total += Number(longterm);
                        content += '<td>' + numberWithCommas(days_30[x]) + '</td>';
                        content += '<td>' + numberWithCommas(days_60[x]) + '</td>';
                        content += '<td>' + numberWithCommas(days_90[x]) + '</td>';
                        content += '<td>' + numberWithCommas(days_120[x]) + '</td>';
                        content += '<td>' + numberWithCommas(days_120_more[x]) + '</td>';
                        content += '<td>' + numberWithCommas(current_total) + ' </td>';
                        content += '<td>' + numberWithCommas(longterm) + '</td>';
                        content += '</tr>';
                    }
                    $('#030total3').text(numberWithCommas(days_30_total.toFixed(2)));
                    $('#3160total3').text(numberWithCommas(days_60_total.toFixed(2)));
                    $('#6190daystotal3').text(numberWithCommas(days_90_total.toFixed(2)));
                    $('#91120daystotal3').text(numberWithCommas(days_120_total.toFixed(2)));
                    $('#120daystotal3').text(numberWithCommas(days_120_more_total.toFixed(2)));
                    $('#currenttotal3').text(numberWithCommas(overall_current_total.toFixed(2)));
                    $('#longtermtotal3').text(numberWithCommas(longterm_total.toFixed(2)));
                    $('#tbody_sa2').html(content);
                    $('#tblsummaryaging2').dataTable({
                        "order": [[ 0, "asc" ]] // Sort by first column descending
                    });
                    var removeDataTable = $('#tblsummaryaging').dataTable();
                    removeDataTable.fnDestroy();
                    $('#summaryrow2').show();
                    $('#excel_summary3').show();
                    $('#excel_summary1').hide();
                    $('#excel_summary2').hide();

                },
                error: function(data) {

                },
            });

        }
    });

    $('#excel_detailed').click(function () {

        var TableData1 = [];
        var rows = $("#tbldetailedaging").dataTable().fnGetNodes();
        for(var i=0; i<rows.length;i++)
        {
            TableData1[i] = {
                "customername" : $(rows[i]).find('td:eq(0)').text().replace(/,/g, '')
                , "030days" :$(rows[i]).find('td:eq(1)').text().replace(/,/g, '')
                , "3160days" : $(rows[i]).find('td:eq(2)').text().replace(/,/g, '')
                , "6190days" : $(rows[i]).find('td:eq(3)').text().replace(/,/g, '')
                , "91120days" : $(rows[i]).find('td:eq(4)').text().replace(/,/g, '')
                , "120daysmore" : $(rows[i]).find('td:eq(5)').text().replace(/,/g, '')
                , "currenttotal" : $(rows[i]).find('td:eq(6)').text().replace(/,/g, '')
                , "longtermtotal" : $(rows[i]).find('td:eq(7)').text().replace(/,/g, '')
            }
        }
        console.log(TableData1);

        var data = JSON.stringify(TableData1);

        console.log(TableData1);

        $.ajax({
            type: "POST",
            url:  baseurl + "collection/get_aging_report_detailed",
            data: {'data':data},
            success: function(data){
                $("#exceldetailedtrigger").trigger("click").attr("target", "_blank");
            },
            error: function(data){

            },
        });
    });

    $('#print_detailed').click(function () {

        var TableData1 = [];
        var rows = $("#tbldetailedaging").dataTable().fnGetNodes();
        for(var i=0; i<rows.length;i++)
        {
            TableData1[i] = {
                "customername" : $(rows[i]).find('td:eq(0)').text().replace(/,/g, '')
                , "030days" :$(rows[i]).find('td:eq(1)').text().replace(/,/g, '')
                , "3160days" : $(rows[i]).find('td:eq(2)').text().replace(/,/g, '')
                , "6190days" : $(rows[i]).find('td:eq(3)').text().replace(/,/g, '')
                , "91120days" : $(rows[i]).find('td:eq(4)').text().replace(/,/g, '')
                , "120daysmore" : $(rows[i]).find('td:eq(5)').text().replace(/,/g, '')
                , "currenttotal" : $(rows[i]).find('td:eq(6)').text().replace(/,/g, '')
                , "longtermtotal" : $(rows[i]).find('td:eq(7)').text().replace(/,/g, '')
            }
        }
        console.log(TableData1);

        var data = JSON.stringify(TableData1);

        console.log(TableData1);

        $.ajax({
            type: "POST",
            url:  baseurl + "collection/print_aging_report_detailed",
            data: {'data':data},
            success: function(data){
                var url = baseurl + "reports/AgingReportDetailed.pdf";
                var win = window.open(url, '_blank');
                win.focus();
            },
            error: function(data){

            },
        });
    });

    $('#excel_summary1').click(function () {

        var TableData = [];
        var rows = $("#tblsummaryaging").dataTable().fnGetNodes();
        for(var i=0; i<rows.length;i++)
        {
            TableData[i] = {
                "projectname" : $(rows[i]).find('td:eq(0)').text().replace(/,/g, '')
                , "030days" :$(rows[i]).find('td:eq(1)').text().replace(/,/g, '')
                , "3160days" : $(rows[i]).find('td:eq(2)').text().replace(/,/g, '')
                , "6190days" : $(rows[i]).find('td:eq(3)').text().replace(/,/g, '')
                , "91120days" : $(rows[i]).find('td:eq(4)').text().replace(/,/g, '')
                , "120daysmore" : $(rows[i]).find('td:eq(5)').text().replace(/,/g, '')
                , "currenttotal" : $(rows[i]).find('td:eq(6)').text().replace(/,/g, '')
                , "longtermtotal" : $(rows[i]).find('td:eq(7)').text().replace(/,/g, '')
            }
        }
        console.log(TableData);

        var data = JSON.stringify(TableData);

        console.log(TableData);

        $.ajax({
            type: "POST",
            url:  baseurl + "collection/get_aging_report_summary1",
            data: {'data':data},
            success: function(data){
                $("#excelsummarytrigger").trigger("click").attr("target", "_blank");
            },
            error: function(data){

            },
        });
    });

    $('#print_detailed1').click(function () {

        var TableData1 = [];
        var rows = $("#tblsummaryaging").dataTable().fnGetNodes();
        for(var i=0; i<rows.length;i++)
        {
            TableData1[i] = {
                "projectname" : $(rows[i]).find('td:eq(0)').text().replace(/,/g, '')
                , "030days" :$(rows[i]).find('td:eq(1)').text().replace(/,/g, '')
                , "3160days" : $(rows[i]).find('td:eq(2)').text().replace(/,/g, '')
                , "6190days" : $(rows[i]).find('td:eq(3)').text().replace(/,/g, '')
                , "91120days" : $(rows[i]).find('td:eq(4)').text().replace(/,/g, '')
                , "120daysmore" : $(rows[i]).find('td:eq(5)').text().replace(/,/g, '')
                , "currenttotal" : $(rows[i]).find('td:eq(6)').text().replace(/,/g, '')
                , "longtermtotal" : $(rows[i]).find('td:eq(7)').text().replace(/,/g, '')
            }
        }
        console.log(TableData1);

        var data = JSON.stringify(TableData1);

        console.log(TableData1);

        $.ajax({
            type: "POST",
            url:  baseurl + "collection/print_aging_report_detailed1",
            data: {'data':data},
            success: function(data){
                var url = baseurl + "reports/AgingReportProject.pdf";
                var win = window.open(url, '_blank');
                win.focus();
            },
            error: function(data){

            },
        });
    });

    $('#excel_summary2').click(function () {

        var TableData = [];
        var rows = $("#tblsummaryaging2").dataTable().fnGetNodes();
        for(var i=0; i<rows.length;i++)
        {
            TableData[i] = {
                "taxtype" : $(rows[i]).find('td:eq(0)').text().replace(/,/g, '')
                , "030days" :$(rows[i]).find('td:eq(1)').text().replace(/,/g, '')
                , "3160days" : $(rows[i]).find('td:eq(2)').text().replace(/,/g, '')
                , "6190days" : $(rows[i]).find('td:eq(3)').text().replace(/,/g, '')
                , "91120days" : $(rows[i]).find('td:eq(4)').text().replace(/,/g, '')
                , "120daysmore" : $(rows[i]).find('td:eq(5)').text().replace(/,/g, '')
                , "currenttotal" : $(rows[i]).find('td:eq(6)').text().replace(/,/g, '')
                , "longtermtotal" : $(rows[i]).find('td:eq(7)').text().replace(/,/g, '')
            }
        }
        console.log(TableData);

        var data = JSON.stringify(TableData);

        console.log(TableData);

        $.ajax({
            type: "POST",
            url:  baseurl + "collection/get_aging_report_summary2",
            data: {'data':data},
            success: function(data){
                $("#excelsummary2trigger").trigger("click").attr("target", "_blank");
            },
            error: function(data){

            },
        });
    });

    $('#print_detailed2').click(function () {

        var TableData1 = [];
        var rows = $("#tblsummaryaging2").dataTable().fnGetNodes();
        for(var i=0; i<rows.length;i++)
        {
            TableData1[i] = {
                "taxtype" : $(rows[i]).find('td:eq(0)').text().replace(/,/g, '')
                , "030days" :$(rows[i]).find('td:eq(1)').text().replace(/,/g, '')
                , "3160days" : $(rows[i]).find('td:eq(2)').text().replace(/,/g, '')
                , "6190days" : $(rows[i]).find('td:eq(3)').text().replace(/,/g, '')
                , "91120days" : $(rows[i]).find('td:eq(4)').text().replace(/,/g, '')
                , "120daysmore" : $(rows[i]).find('td:eq(5)').text().replace(/,/g, '')
                , "currenttotal" : $(rows[i]).find('td:eq(6)').text().replace(/,/g, '')
                , "longtermtotal" : $(rows[i]).find('td:eq(7)').text().replace(/,/g, '')
            }
        }
        console.log(TableData1);

        var data = JSON.stringify(TableData1);

        console.log(TableData1);

        $.ajax({
            type: "POST",
            url:  baseurl + "collection/print_aging_report_detailed2",
            data: {'data':data},
            success: function(data){
                var url = baseurl + "reports/AgingReportTax.pdf";
                var win = window.open(url, '_blank');
                win.focus();
            },
            error: function(data){

            },
        });
    });

    $('#excel_summary3').click(function () {

        var TableData1 = [];
        var rows = $("#tblsummaryaging").dataTable().fnGetNodes();
        for(var i=0; i<rows.length;i++)
        {
            TableData1[i] = {
                "projectname" : $(rows[i]).find('td:eq(0)').text().replace(/,/g, '')
                , "030days" :$(rows[i]).find('td:eq(1)').text().replace(/,/g, '')
                , "3160days" : $(rows[i]).find('td:eq(2)').text().replace(/,/g, '')
                , "6190days" : $(rows[i]).find('td:eq(3)').text().replace(/,/g, '')
                , "91120days" : $(rows[i]).find('td:eq(4)').text().replace(/,/g, '')
                , "120daysmore" : $(rows[i]).find('td:eq(5)').text().replace(/,/g, '')
                , "currenttotal" : $(rows[i]).find('td:eq(6)').text().replace(/,/g, '')
                , "longtermtotal" : $(rows[i]).find('td:eq(7)').text().replace(/,/g, '')
            }
        }

        var data1 = JSON.stringify(TableData1);

        var TableData2 = [];
        var rows = $("#tblsummaryaging2").dataTable().fnGetNodes();
        for(var i=0; i<rows.length;i++)
        {
            TableData2[i] = {
                "taxtype" : $(rows[i]).find('td:eq(0)').text().replace(/,/g, '')
                , "030days" :$(rows[i]).find('td:eq(1)').text().replace(/,/g, '')
                , "3160days" : $(rows[i]).find('td:eq(2)').text().replace(/,/g, '')
                , "6190days" : $(rows[i]).find('td:eq(3)').text().replace(/,/g, '')
                , "91120days" : $(rows[i]).find('td:eq(4)').text().replace(/,/g, '')
                , "120daysmore" : $(rows[i]).find('td:eq(5)').text().replace(/,/g, '')
                , "currenttotal" : $(rows[i]).find('td:eq(6)').text().replace(/,/g, '')
                , "longtermtotal" : $(rows[i]).find('td:eq(7)').text().replace(/,/g, '')
            }
        }

        var data2 = JSON.stringify(TableData2);

        console.log(TableData2);

        $.ajax({
            type: "POST",
            url:  baseurl + "collection/get_aging_report_summary3",
            data: {'data1':data1,'data2':data2},
            success: function(data){
                $("#excelsummary3trigger").trigger("click").attr("target", "_blank");
            },
            error: function(data){

            },
        });
    });

    $('#print_detailed3').click(function () {

        var TableData1 = [];
        var rows = $("#tblsummaryaging").dataTable().fnGetNodes();
        for(var i=0; i<rows.length;i++)
        {
            TableData1[i] = {
                "projectname" : $(rows[i]).find('td:eq(0)').text().replace(/,/g, '')
                , "030days" :$(rows[i]).find('td:eq(1)').text().replace(/,/g, '')
                , "3160days" : $(rows[i]).find('td:eq(2)').text().replace(/,/g, '')
                , "6190days" : $(rows[i]).find('td:eq(3)').text().replace(/,/g, '')
                , "91120days" : $(rows[i]).find('td:eq(4)').text().replace(/,/g, '')
                , "120daysmore" : $(rows[i]).find('td:eq(5)').text().replace(/,/g, '')
                , "currenttotal" : $(rows[i]).find('td:eq(6)').text().replace(/,/g, '')
                , "longtermtotal" : $(rows[i]).find('td:eq(7)').text().replace(/,/g, '')
            }
        }

        var data1 = JSON.stringify(TableData1);
        
        console.log(TableData1);

        var TableData2 = [];
        var rows = $("#tblsummaryaging2").dataTable().fnGetNodes();
        for(var i=0; i<rows.length;i++)
        {
            TableData2[i] = {
                "taxtype" : $(rows[i]).find('td:eq(0)').text().replace(/,/g, '')
                , "030days" :$(rows[i]).find('td:eq(1)').text().replace(/,/g, '')
                , "3160days" : $(rows[i]).find('td:eq(2)').text().replace(/,/g, '')
                , "6190days" : $(rows[i]).find('td:eq(3)').text().replace(/,/g, '')
                , "91120days" : $(rows[i]).find('td:eq(4)').text().replace(/,/g, '')
                , "120daysmore" : $(rows[i]).find('td:eq(5)').text().replace(/,/g, '')
                , "currenttotal" : $(rows[i]).find('td:eq(6)').text().replace(/,/g, '')
                , "longtermtotal" : $(rows[i]).find('td:eq(7)').text().replace(/,/g, '')
            }
        }

        var data2 = JSON.stringify(TableData2);

        console.log(TableData2);

        $.ajax({
            type: "POST",
            url:  baseurl + "collection/print_aging_report_detailed3",
            data: {'data1':data1,'data2':data2},
            success: function(data){
                var url = baseurl + "reports/AgingReportProjectsAndTax.pdf";
                var win = window.open(url, '_blank');
                win.focus();
            },
            error: function(data){

            },
        });
    });

});

window.onload = makeTable;
function makeTable() {
    //alert("loaded");
    var content1 = '';
    var content2 = '';
    var data1 = '';
    var data2 = '';
    $.ajax({
        type: "POST",
        url:  baseurl + "collection/get_amort_for_aging",
        success: function(result){

            var table = document.getElementById("tbldetailedaging");
            var data = jQuery.parseJSON(result);
            console.log(data);
            var date = new Date();
            var date_30 = date.setDate(date.getDate() - 30);
            date_30 = new Date(date_30);
            var date_60 = date.setDate(date.getDate() - 60);
            date_60 = new Date(date_60);
            var date_90 = date.setDate(date.getDate() - 90);
            date_90 = new Date(date_90);
            var date_120 = date.setDate(date.getDate() - 120);
            date_120 = new Date(date_120);
            //for detailed
            var temp_names = {};
            var temp_30 = {};
            var temp_60 = {};
            var temp_90 = {};
            var temp_120 = {};
            var temp_120_more = {};
            var temp_tcp = {};
            var temp_contract_id = {};
            var temp_person_id = {};
            var temp_sum = {};


            for(var i=0; i < data.length; i++) {
                var amortizationid = data[i].amortization_id;
                var contractID = data[i].contractID;
                var paidamount = Number(data[i].interest_paid) + Number(data[i].principal_paid) + Number(data[i].vat_paid) + Number(data[i].surcharge_paid);
                var amortization = Number(data[i].amortization_amount);
                //amortization = parseFloat(Math.round(amortization * 100) / 100).toFixed(2);
                var tcp = Number(data[i].total_contract_price);
                //var payment = 0;
                var principal = Number(data[i].principal_amount);
                var vat = Number(data[i].vat_amount);
                var ips = Number(data[i].rebate);
                var interest = Number(data[i].interest_amount);
                var unpaid = vat + interest + ips + amortization;
                var parts = data[i].due_date.split('-');
                var due_date2 = new Date(parts[0],parts[1]-1,parts[2]); 
                var due_date = moment(data[i].due_date, "YYYY-MM-DD");
                var date_today = moment();
                var surcharge = calculateSurchargeMonth(due_date, date_today, 0.03, unpaid);
                unpaid = unpaid + surcharge;
                
                //for detailed
                if (!temp_names.hasOwnProperty(data[i].person_id)) {
                    temp_names[data[i].person_id] = 0;
                }
                temp_names[data[i].person_id] = data[i].firstname+' '+data[i].middlename+' '+data[i].lastname;

                if (!temp_30.hasOwnProperty(data[i].person_id)) {
                    temp_30[data[i].person_id] = 0;
                }
                if (due_date2 >= date_30 && due_date2 <date_today){
                    temp_30[data[i].person_id] += unpaid;
                }

                if (!temp_60.hasOwnProperty(data[i].person_id)) {
                    temp_60[data[i].person_id] = 0;
                }
                if (due_date2 >= date_60 && due_date2 <date_today){
                    temp_60[data[i].person_id] += unpaid;
                }

                if (!temp_90.hasOwnProperty(data[i].person_id)) {
                    temp_90[data[i].person_id] = 0;
                }
                if (due_date2 >= date_90 && due_date2 <date_today){
                    temp_90[data[i].person_id] += unpaid;
                }

                if (!temp_120.hasOwnProperty(data[i].person_id)) {
                    temp_120[data[i].person_id] = 0;
                }
                if (due_date2 >= date_120 && due_date2 <date_today){
                    temp_120[data[i].person_id] += unpaid;
                }

                if (!temp_120_more.hasOwnProperty(data[i].person_id)) {
                    temp_120_more[data[i].person_id] = 0;
                }
                if (due_date2 <= date_120 && due_date2 <date_today){
                    temp_120_more[data[i].person_id] += unpaid;
                }

                if (!temp_contract_id.hasOwnProperty(data[i].contractID)) {
                    temp_contract_id[data[i].contractID] = 0;
                }
                temp_contract_id[data[i].contractID] = data[i].contractID;
                
            }

            var contractids = [];
            for (var prop in temp_contract_id){
                contractids.push(temp_contract_id[prop]);
            }

            for (var x=0; x<contractids.length;x++){
                var data = new FormData();
                var payment = 0;
                data.append('contractid',contractids[x]);
                // for (var pair of data.entries()) {
                //     console.log(pair[0]+ ', ' + pair[1]); 
                // }
                var sum_of_payments = 0;
                $.ajax({
                    async: false,
                    type: "POST",
                    url:  baseurl + "collection/get_person_for_aging",
                    data: data,
                    cache: false,
                    processData:false,
                    contentType:false,
                    success: function(result){
                        var data = jQuery.parseJSON(result);
                        if (!temp_person_id.hasOwnProperty(data[x].person_id)) {
                            temp_person_id[data[x].person_id] = 0;
                        }
                        temp_person_id[data[x].person_id] = data[x].person_id;
                        if(data[0].person_id = temp_person_id[data[x].person_id]){
                            if (!temp_sum.hasOwnProperty(data[x].person_id)) {
                                temp_sum[data[x].person_id] = 0;
                            }
                            payment = getPayments(contractids[x]);
                            temp_sum[data[x].person_id] += payment;
                            if (!temp_tcp.hasOwnProperty(data[x].person_id)) {
                                temp_tcp[data[x].person_id] = 0;
                            }
                            temp_tcp[data[x].person_id] += Number(data[x].total_contract_price);
                        }
                    },
                    error:  function(result){

                    },
                });
            }

            //for detailed
            var names = [];
            for (var prop in temp_names){
                names.push(temp_names[prop]);
            }
            var days_30 = [];
            for (var prop in temp_30){
                days_30.push(temp_30[prop].toFixed(2));
            }
            var days_60 = [];
            for (var prop in temp_60){
                days_60.push(temp_60[prop].toFixed(2));
            }
            var days_90 = [];
            for (var prop in temp_90){
                days_90.push(temp_90[prop].toFixed(2));
            }
            var days_120 = [];
            for (var prop in temp_120){
                days_120.push(temp_120[prop].toFixed(2));
            }
            var days_120_more = [];
            for (var prop in temp_120_more){
                days_120_more.push(temp_120_more[prop].toFixed(2));
            }
            var tcp = [];
            for (var prop in temp_tcp){
                tcp.push(temp_tcp[prop].toFixed(2));
            }
            var payments = [];
            for (var prop in temp_sum){
                payments.push(temp_sum[prop].toFixed(2));
            }
            
            console.log(temp_names);
            console.log(temp_30);
            console.log(temp_60);
            console.log(temp_90);
            console.log(temp_120);
            console.log(temp_tcp);
            console.log(temp_sum);
            console.log('-------------------');
            console.log(names);
            console.log(days_30);
            console.log(days_60);
            console.log(days_90);
            console.log(days_120);
            console.log(tcp);
            console.log(payments);

            var days_30_total = 0;
            var days_60_total = 0;
            var days_90_total = 0;
            var days_120_total = 0;
            var days_120_more_total = 0;
            var overall_current_total = 0;
            var longterm_total = 0;

            for (var x=0;x<names.length;x++){
                var current_total = Number(days_30[x]) + Number(days_60[x]) + Number(days_90[x]) + Number(days_120[x]) + Number(days_120_more[x]);
                current_total = current_total.toFixed(2);
                overall_current_total += Number(current_total);
                days_30_total += Number(days_30[x]);
                days_60_total += Number(days_60[x]);
                days_90_total += Number(days_90[x]);
                days_120_total += Number(days_120[x]);
                days_120_more_total += Number(days_120_more[x]);
                var longterm = Number(tcp[x]) - Number(current_total) - Number(payments[x]);
                longterm = longterm.toFixed(2);
                longterm_total += Number(longterm);
                content1 += '<tr>';
                content1 += '<td>' + names[x] + '</td>';
                content1 += '<td>' + numberWithCommas(days_30[x]) + '</td>';
                content1 += '<td>' + numberWithCommas(days_60[x]) + '</td>';
                content1 += '<td>' + numberWithCommas(days_90[x]) + '</td>';
                content1 += '<td>' + numberWithCommas(days_120[x]) + '</td>';
                content1 += '<td>' + numberWithCommas(days_120_more[x]) + '</td>';
                content1 += '<td>' + numberWithCommas(current_total) + ' </td>';
                content1 += '<td>' + numberWithCommas(longterm) + '</td>';
                content1 += '</tr>';
            }

            $('#030total').text(numberWithCommas(days_30_total.toFixed(2)));
            $('#3160total').text(numberWithCommas(days_60_total.toFixed(2)));
            $('#6190daystotal').text(numberWithCommas(days_90_total.toFixed(2)));
            $('#91120daystotal').text(numberWithCommas(days_120_total.toFixed(2)));
            $('#120daystotal').text(numberWithCommas(days_120_more_total.toFixed(2)));
            $('#currenttotal').text(numberWithCommas(overall_current_total.toFixed(2)));
            $('#longtermtotal').text(numberWithCommas(longterm_total.toFixed(2)));
            $('#tbody_da').html(content1);
            $('#tbody_sa').html(content2);
            $('#tbldetailedaging').dataTable({
                "order": [[ 0, "asc" ]] // Sort by first column descending
            });


            

        },
        error: function(result){

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

Date.prototype.addDays = function(days) {
  var dat = new Date(this.valueOf());
  dat.setDate(dat.getDate() + days);
  return dat;
}

function getPayments(contractID) {

    //var contractID = contractid;
    var data = new FormData();
    data.append('contractid',contractID);
    // for (var pair of data.entries()) {
    //     console.log(pair[0]+ ', ' + pair[1]); 
    // }
    var sum_of_payments = 0;
    $.ajax({
        async: false,
        type: "POST",
        url:  baseurl + "collection/getPayments",
        data: data,
        cache: false,
        processData:false,
        contentType:false,
        success: function(result){

            var data = jQuery.parseJSON(result);
            //console.log(data);
            
            for(x=0; x < data.length; x++){
                sum_of_payments = +sum_of_payments + +Number(data[x].amount);

            }
            // var table = document.getElementById("tblcontracts");
            // table.rows[1].cells[5].innerHTML = 'samples';
            // return sumofpayments;
        },
        error: function (errorThrown){
            toastr.error('Error!', 'Operation Done');
            console.log(errorThrown);
        }
    });
    return sum_of_payments;
    //console.log('sumofpayments '+sum_of_payments);
}

