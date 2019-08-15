// var TableDatatablesEditable = function () {

//     var bankslist = $('#tblcustomers').DataTable();
//     var handleTable = function () {

//     }
//     return {
//         //main function to initiate the module
//         init: function () {
//             handleTable();
//         }
//     };
// }();
// var TableDatatablesEditable2 = function () {

//     var lots = $('#tbllots').DataTable();
//     var handleTable = function () {

//     }
//     return {
//         //main function to initiate the module
//         init: function () {
//             handleTable();
//         }
//     };
// }();

//Global Declarations for receipt variables
var r_customer_name = '';
var r_customer_address = '';
var r_customer_tin = '';
var r_lot_desc = '';
var r_vatable_amount = 0;
var r_vat_exempt_amount = 0;
var r_vat_zero_rated_amount = 0;
var r_total_or_details = 0;
var r_add_vat = 0;
var r_net_amount_received = 0;
var r_surcharge_paid = 0;
var r_ips = 0;
var r_interest = 0;
var r_principal = 0;
var r_total_payment_details = 0;
var r_total_payment_details2 = 0; //surcharge not included
var r_cash_amount = 0;
var r_check_amount = 0;
var r_check_date = 0;
var r_check_bank = '';
var r_check_number = '';
var r_bank_amount = 0;
var r_bank_designated = '';
var r_bank_deposit_date = 0;
var r_cashier = '';
var r_total_amount = 0;
var r_ips_accrued_paid = 0;
var r_ips_interest_paid = 0;
var global_customer_id='';
var global_balance_interest_rate = 0;
var global_is_deferred = '';
var global_is_licensed_to_sell = '';
var global_subsidiary_code = '';
var global_contract_id = '';

$(document).ready(function(){
    $("<style type='text/css'> .highlight{ background:#33F0FF;} </style>").appendTo("head");
    var tblcustomers = $('#tblcustomers').DataTable();
    var tblcontracts = $('#tblcontracts').DataTable();
    var bankslist = $('#tblcustomers').DataTable();
    var lots = $('#tbllots').DataTable();

    var oneWeekAgo = new Date();
    oneWeekAgo.setDate(oneWeekAgo.getDate() - 7);
    //for backtrack 7 days
    //document.getElementById("surchargeDate").min = formatDate(oneWeekAgo);

    // $('#tblcontracts').find('tr').dblclick( function(){
    //   var row = $(this).find('td:first').text();
    //   alert('You clicked ' + row);
    // });
    // $(document).on("click","#tblcustomers tr",function() {
        // $("<style type='text/css'> .highlight{ background:#33F0FF;} </style>").appendTo("head"); <- original location
    tblcustomers.on('click', 'tbody tr', function() {
            
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
        var clientid = table.rows[col].cells[0].innerHTML;
        //alert(clientid);

        $('#title_name').html(table.rows[col].cells[1].innerHTML);
        $('#sub_extra').html('');
        $.ajax({
            type: "POST",
            url:  baseurl + "collection/populateDropdownCProperties",
            dataType : "json",
            data: {'clientid':clientid},
            success: function(result){
                if (result.length != 0){   

                    // $('#clientProperties').html(content); //populate the other dropdown
                    var content2 = '';
                    // numberWithCommas
                    global_customer_id = result[0].custID;
                    console.log(global_customer_id);

                    tblcontracts.clear().draw();
                    $.each(result, function (index, value){

                        var tcp = parseFloat(Math.round(Number(result[index].total_contract_price) * 100) / 100).toFixed(2);
                        var lot_area = parseFloat(Math.round(Number(result[index].lot_area) * 100) / 100).toFixed(2);
                        var ppsm = parseFloat(Math.round(Number(result[index].price_per_sqr_meter) * 100) / 100).toFixed(2);
                        var contractid = result[index].contract_id;  
                        var sum_of_payments = getPayments(contractid);
                        var balance = Number(result[index].total_contract_price) - sum_of_payments;
                        balance = parseFloat(Math.round(balance * 100) / 100).toFixed(2);

                        tblcontracts.row.add([
                            result[index].contract_id,
                            result[index].lot_description,
                            result[index].contract_date,
                            numberWithCommas(tcp),
                            numberWithCommas(lot_area),
                            numberWithCommas(ppsm),
                            numberWithCommas(parseFloat(Math.round(sum_of_payments * 100) / 100).toFixed(2)),
                            numberWithCommas(balance),
                            result[index].contract_status_name
                        ]).draw( false );
                    });
                    $('#amort').hide();
                    $('#cid').hide();
                }
                else{   
                    toastr.options.timeOut = 500;
                    toastr.error('No Contract Found!', 'Operation Done');
                    var content3 = '';
                    content3 += '<tr id="row">';
                    content3 += '</tr>';
                    $('#tbody_contracts').html(content3); 
                    $('#generate').hide();
                    $('#amort').hide();
                    $('#cid').hide();
                }
                
            },
            error: function (errorThrown){
                toastr.options.timeOut = 500;
                toastr.error('Error!', 'Operation Done');
                console.log(errorThrown);
            }
        });
        event.preventDefault();
    });

    // $(document).on("click","#tbllots tr",function() {
    $('#tbllots').on('click', 'tbody tr', function() {

        // $("<style type='text/css'> .highlight{ background:#33F0FF;} </style>").appendTo("head"); <- orig location to init_
        $("#tbllots tr").each(function () {
            if ( $(this).hasClass('highlight') ) {
                $(this).removeClass('highlight');
            }
        });
        $(this).addClass("highlight");
        var table = document.getElementById("tbllots");
        var col = $(this).parent().children().index($(this));
        var row = $(this).parent().parent().children().index($(this).parent());
        col = Number(col);
        col = +col + 1;
        var lotid = table.rows[col].cells[0].innerHTML;
        
        $.ajax({
            type: "POST",
            url:  baseurl + "collection/getSingleContractDetails",
            dataType : "json",
            data: {'lotid':lotid},
            success: function(result){
                // var data = jQuery.parseJSON(result);
                if (result.length != 0){   

                    //toastr.success('Successfully Saved!', 'Operation Done');
                    // $('#clientProperties').html(content); //populate the other dropdown
                    var content2 = '';
                    // numberWithCommas
                    global_customer_id = result[0].custID;
                    console.log(global_customer_id);

                    tblcontracts.clear().draw();
                    $.each(result, function (index, value){
                        var tcp = parseFloat(Math.round(Number(result[index].total_contract_price) * 100) / 100).toFixed(2);
                        var lot_area = parseFloat(Math.round(Number(result[index].lot_area) * 100) / 100).toFixed(2);
                        var ppsm = parseFloat(Math.round(Number(result[index].price_per_sqr_meter) * 100) / 100).toFixed(2);
                        var contractid = result[index].contract_id;  
                        var sum_of_payments = getPayments(contractid);
                        var balance = Number(result[index].total_contract_price) - sum_of_payments;
                        balance = parseFloat(Math.round(balance * 100) / 100).toFixed(2);

                        tblcontracts.row.add([
                            contractid,
                            result[index].lot_description,
                            result[index].contract_date,
                            numberWithCommas(tcp),
                            numberWithCommas(lot_area),
                            numberWithCommas(ppsm),
                            numberWithCommas(parseFloat(Math.round(sum_of_payments * 100) / 100).toFixed(2)),
                            numberWithCommas(balance),
                            result[index].contract_status_name
                        ]).draw( false );
                    });
                    $('#amort').hide();
                    $('#cid').hide();

                }
                else{   
                    toastr.error('No Contract Found!', 'Operation Done');
                    var content3 = '';
                    content3 += '<tr id="row">';
                    content3 += '</tr>';
                    $('#tbody_contracts').html(content3); 
                    $('#generate').hide();
                    $('#amort').hide();
                    $('#cid').hide();
                }
            },
            error: function (errorThrown){
                toastr.error('Error!', 'Operation Done');
                // 
            }
        });
    });

    $(document).on("click","#tblcontracts tbody tr",function() {

        // $("<style type='text/css'> .highlight{ background:#33F0FF;} </style>").appendTo("head");

        $("#tblcontracts tr").each(function () {
            if ( $(this).hasClass('highlight') ) {
                $(this).removeClass('highlight');
            }
        });
        $(this).addClass("highlight");
        
        var table = document.getElementById("tblcontracts");
        var col = $(this).parent().children().index($(this));
        var row = $(this).parent().parent().children().index($(this).parent());
        console.log(row);
        console.log(col);
        col = Number(col);
        col = +col + 1;
        var contractid = table.rows[col].cells[0].innerHTML;
        global_contract_id = contractid;
        console.log(contractid);
        var data = new FormData();
        data.append('contractid',contractid);
        data.append('customerid',global_customer_id);
        //data.append('clientid',$('#clientName').val());
        $('#sub_extra').html('');
        $('#sub_extra').append(table.rows[col].cells[1].innerHTML);


        $.ajax({
            type: "POST",
            url:  baseurl + "collection/getClientDetails",
            data: data,
            cache: false,
            processData:false,
            contentType:false,
            success: function(result){
                
                var data = jQuery.parseJSON(result);
                if (data['contract'].length != 0){
                    //alert(data['contract'][0].tin);
                    $('#details').show();
                    $('#discount').text(numberWithCommas(data['discount'][0].amortization_amount));
                    $('#customerName').text(data['contract'][0].firstname+' '+data['contract'][0].lastname);
                    $('#customerTIN').text(data['contract'][0].tin);
                    $('#spouseName').text('Sample');
                    $('#customerAddress').text(data['contract'][0].line_1+', '+data['contract'][0].city_name+', '+data['contract'][0].province_name+', '+data['contract'][0].country_name);
                    $('#lotDescription').text(data['contract'][0].lot_description);
                    $('#areaSqMtr').text(numberWithCommas(data['contract'][0].lot_area));
                    $('#priceSqrMtr').text(numberWithCommas(data['contract'][0].price_per_sqr_meter));
                    $('#tcp').text(numberWithCommas(data['contract'][0].total_contract_price));
                    $('#customerName2').text(data['contract'][0].firstname+' '+data['contract'][0].lastname);
                    $('#customerAddress2').text(data['contract'][0].line_1+', '+data['contract'][0].city_name+', '+data['contract'][0].province_name+', '+data['contract'][0].country_name);
                    $('#lotDescription2').text(data['contract'][0].lot_description);
                    $('#areaSqMtr2').text(data['contract'][0].lot_area);
                    $('#priceSqrMtr2').text(data['contract'][0].price_per_sqr_meter);
                    $('#dp_int_rate').val(data['contract'][0].downpayment_interest_rate);
                    $('#balance_int_rate').val(data['contract'][0].balance_interest_rate);
                    global_balance_interest_rate = data['contract'][0].balance_interest_rate;
                    global_is_deferred = data['contract'][0].is_tax_deferred;
                    global_is_licensed_to_sell = data['contract'][0].license_to_sell;
                    global_subsidiary_code = data['contract'][0].subsidiary_code;
                    var content = '';
                    var content2 = '';
                    var content3 = '';
                    var content4 = '';
                    var surcharge_total = 0;
                    var amortization_total = 0;
                    var amountDue_total = 0;
                    var vat_total = 0;
                    var ips_total = 0;
                    var ips_accrued_total = 0;
                    var ips_interest_total = 0;
                    var interest_total = 0;
                    var principal_total = 0;
                    var paid_total = 0;

                    for (var i = 0; i < data['amortization'].length; i++) {
                        content += '<tr id="myRow">';
                        var due_date = moment(data['amortization'][i].due_date, "YYYY-MM-DD");
                        var date_today = moment();
                        console.log('date_today '+date_today);

                        var parts = data['amortization'][i].due_date.split('-');
                        var due_date2 = new Date(parts[0],parts[1]-1,parts[2]); 
                        var date_today2 = new Date();

                        var amortizationAmount = Number(data['amortization'][i].amortization_amount);
                        var vatAmount = Number(data['amortization'][i].vat_amount); //- Number(data['amortization'][i].vat_paid);
                        var ipsAccruedAmount = Number(data['amortization'][i].ips_accrued);
                        var ipsInterestAmount = Number(data['amortization'][i].ips_interest);
                        var ips = ipsAccruedAmount + ipsInterestAmount;
                        var interestAmount = Number(data['amortization'][i].interest_amount); //- Number(data['amortization'][i].interest_paid);
                        var principalAmount = Number(data['amortization'][i].principal_amount); //- Number(data['amortization'][i].principal_paid);
                        //Days Due
                        var timeDiff = Math.abs(due_date2.getTime() - date_today2.getTime());
                        var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24)); 

                        var unpaid = vatAmount + interestAmount + ips + principalAmount;
                        console.log('unpaid '+unpaid);
                        var surcharge_unpaid = calculateSurchargeMonth(due_date, date_today, 0.03, unpaid);
                        console.log('surcharge_unpaid '+surcharge_unpaid);
                        surcharge_unpaid2 = surcharge_unpaid - Number(data['amortization'][i].surcharge_paid);
                        console.log('surcharge_unpaid2 '+surcharge_unpaid2);
                        var due_amount = unpaid + surcharge_unpaid;
                        var paid_up = Number(data['amortization'][i].interest_paid) + Number(data['amortization'][i].principal_paid) + Number(data['amortization'][i].vat_paid) + Number(data['amortization'][i].surcharge_paid) + Number(data['amortization'][i].ips_accrued_paid) + Number(data['amortization'][i].ips_interest_paid);
                        var due2 = 0;

                        
                        var printAmort = parseFloat(Math.round(amortizationAmount * 100) / 100).toFixed(2);
                        var printSurcharge = parseFloat(Math.round(surcharge_unpaid2 * 100) / 100).toFixed(2);
                        var printVat = parseFloat(Math.round(vatAmount * 100) / 100).toFixed(2);
                        var printIPS = parseFloat(Math.round(ips * 100) / 100).toFixed(2);
                        var printIPSAccrued = parseFloat(Math.round(ipsAccruedAmount * 100) / 100).toFixed(2);
                        var printIPSInterest = parseFloat(Math.round(ipsInterestAmount * 100) / 100).toFixed(2);
                        var printInterest = parseFloat(Math.round(interestAmount * 100) / 100).toFixed(2);
                        var printPrincipal = parseFloat(Math.round(principalAmount * 100) / 100).toFixed(2);
                        var printPaid = parseFloat(Math.round(paid_up * 100) / 100).toFixed(2);
                        
                        due2 = due_amount - paid_up;
                        var printDue = parseFloat(Math.round(due2 * 100) / 100).toFixed(2);
                        content += '<td style="display: none;">' + data['amortization'][i].amortization_id + '</td>'; 
                        content += '<td>' + data['amortization'][i].due_date + '</td>'; 
                        content += '<td>' + diffDays + '</td>';
                        content += '<td align="right">' + numberWithCommas(printDue) +'</td>';
                        content += '<td align="right">' + numberWithCommas(printAmort) + '</td>';
                        content += '<td align="right">' + numberWithCommas(printSurcharge) + '</td>';
                        content += '<td align="right">' + numberWithCommas(printVat) + '</td>';
                        content += '<td align="right">' + numberWithCommas(printInterest) + '</td>';
                        content += '<td align="right">' + numberWithCommas(printIPS) +'</td>';
                        content += '<td align="right">' + numberWithCommas(printIPSAccrued) +'</td>';
                        content += '<td align="right">' + numberWithCommas(printIPSInterest) +'</td>';
                        content += '<td align="right">' + numberWithCommas(printPrincipal) + '</td>';
                        content += '<td align="right">' + numberWithCommas(printPaid) + '</td>';
                        content += '<td style="display: none;">' + data['amortization'][i].contract_id + '</td>'; 
                        content += '<td style="display: none;">' + data['amortization'][i].interest_paid + '</td>'; 
                        content += '<td style="display: none;">' + data['amortization'][i].vat_paid + '</td>'; 
                        content += '<td style="display: none;">' + data['amortization'][i].surcharge_paid + '</td>';
                        content += '<td style="display: none;">' + data['amortization'][i].principal_paid + '</td>';
                        content += '<td style="display: none;">' + data['amortization'][i].ips_accrued_paid + '</td>';
                        content += '<td style="display: none;">' + data['amortization'][i].ips_interest_paid + '</td>';  
                        content += '</tr>';

                        // console.log(Number(data['amortization'][i].principal_amount));
                        //Totals
                        amountDue_total += due2;
                        amortization_total += amortizationAmount;
                        surcharge_total += surcharge_unpaid;
                        vat_total += Number(data['amortization'][i].vat_amount);
                        ips_total += Number(data['amortization'][i].ips_amortization);
                        ips_accrued_total += Number(data['amortization'][i].ips_accrued);
                        ips_interest_total += Number(data['amortization'][i].ips_interest);
                        interest_total += Number(data['amortization'][i].interest_amount);
                        principal_total += Number(data['amortization'][i].principal_amount);
                        paid_total += paid_up;

                    }
                    //for misc
                    if (data['misc'].length>0){
                        for (var i = 0; i < data['misc'].length; i++) {
                            content2 += '<tr id="myRow2">';
                            content2 += '<td style="display: none;">' + data['misc'][i].contract_id + '</td>'; 
                            content2 += '<td style="display: none;">' + data['misc'][i].miscelaneous_id + '</td>'; 
                            content2 += '<td>' + data['misc'][i].due_date + '</td>'; 
                            content2 += '<td align="right">' + data['misc'][i].miscelaneous_amount + '</td>'; 
                            content2 += '<td align="right">' + data['misc'][i].principal_amount + '</td>'; 
                            content2 += '</tr>';
                        }
                    }
                    //for amort schedule
                    for (var i = 0; i < data['amortization2'].length; i++) {
                        var ips = Number(data['amortization2'][i].ips_accrued) + Number(data['amortization2'][i].ips_interest);
                        var ips_paid = Number(data['amortization2'][i].ips_accrued_paid) + Number(data['amortization2'][i].ips_interest_paid);
                        content3 += '<tr id="myRow2">';
                        content3 += '<td style="display: none;">' + data['amortization2'][i].contract_id + '</td>'; 
                        content3 += '<td style="display: none;">' + data['amortization2'][i].amortization_id + '</td>'; 
                        content3 += '<td>' +data['amortization2'][i].due_date + '</td>'; 
                        content3 += '<td>' + data['amortization2'][i].line_type_name + '</td>'; 
                        content3 += '<td align="right">' + numberWithCommas(data['amortization2'][i].amortization_amount) + '</td>'; 
                        content3 += '<td align="right">' + numberWithCommas(data['amortization2'][i].vat_amount) + '</td>'; 
                        content3 += '<td align="right">' + numberWithCommas(ips) + '</td>'; 
                        content3 += '<td align="right">' + numberWithCommas(data['amortization2'][i].interest_amount) + '</td>'; 
                        content3 += '<td align="right">' + numberWithCommas(data['amortization2'][i].principal_amount) + '</td>';
                        content3 += '<td align="right">' + numberWithCommas(data['amortization2'][i].outstanding_balance) + '</td>';
                        content3 += '<td align="right">' + numberWithCommas(data['amortization2'][i].vat_paid) + '</td>';
                        content3 += '<td align="right">' + numberWithCommas(ips_paid) + '</td>';
                        content3 += '<td align="right">' + numberWithCommas(data['amortization2'][i].interest_paid) + '</td>';
                        content3 += '<td align="right">' + numberWithCommas(data['amortization2'][i].principal_paid) + '</td>';
                        content3 += '<td align="right">' + numberWithCommas(data['amortization2'][i].surcharge_paid) + '</td>';
                        content3 += '</tr>';
                    }
                    //for pdc
                    if (data['pdc'].length > 0) {
                        for (var i = 0; i < data['pdc'].length; i++) {
                            content4 += '<tr>';
                            content4 += '<td style="display: none;">' + data['pdc'][i].postdated_check_id + '</td>'; 
                            content4 += '<td>' +data['pdc'][i].check_date + '</td>'; 
                            content4 += '<td align="right">' + jFormatNumber(data['pdc'][i].amount) + '</td>'; 
                            content4 += '<td>' +data['pdc'][i].check_number + '</td>';
                            content4 += '<td>' +data['pdc'][i].bankname1 + '</td>';
                            content4 += '<td>' +data['pdc'][i].bankname2 + '</td>';
                            content4 += '<tr>';
                        }
                    }
                    
                    amountDue_total = parseFloat(Math.round(amountDue_total * 100) / 100).toFixed(2);
                    amortization_total = parseFloat(Math.round(amortization_total * 100) / 100).toFixed(2);
                    surcharge_total = parseFloat(Math.round(surcharge_total * 100) / 100).toFixed(2);
                    vat_total = parseFloat(Math.round(vat_total * 100) / 100).toFixed(2);
                    ips_total = parseFloat(Math.round(ips_total * 100) / 100).toFixed(2);
                    ips_accrued_total = parseFloat(Math.round(ips_accrued_total * 100) / 100).toFixed(2);
                    ips_interest_total = parseFloat(Math.round(ips_interest_total * 100) / 100).toFixed(2);
                    interest_total = parseFloat(Math.round(interest_total * 100) / 100).toFixed(2);
                    principal_total = parseFloat(Math.round(principal_total * 100) / 100).toFixed(2);
                    paid_up = parseFloat(Math.round(paid_up * 100) / 100).toFixed(2);
                    var wiw = parseFloat(numberWithCommas(paid_up).replace(/,/g, ''));
                    content += '<td>&nbsp;</td>';
                    content += '<td><b> TOTAL: </b></td>';
                    content += '<td align="right"><b>' + numberWithCommas(amountDue_total) + '</b></td>';
                    content += '<td align="right"><b>' + numberWithCommas(amortization_total) + '</b></td>';
                    content += '<td align="right"><b>' + numberWithCommas(surcharge_total) + '</b></td>';
                    content += '<td align="right"><b>' + numberWithCommas(vat_total) + '</b></td>';
                    content += '<td align="right"><b>' + numberWithCommas(interest_total) + '</b></td>';
                    content += '<td align="right"><b>' + numberWithCommas(ips_total) + '</b></td>';
                    content += '<td align="right"><b>' + numberWithCommas(ips_accrued_total) + '</b></td>';
                    content += '<td align="right"><b>' + numberWithCommas(ips_interest_total) + '</b></td>';
                    content += '<td align="right"><b>' + numberWithCommas(principal_total) + '</b></td>';
                    content += '<td align="right"><b>' + numberWithCommas(paid_up) + '</b></td>';
                    $('#amort').show(); 
                    $('#cid').show();
                    $('#cidPortlet2').show();
                    $('#cidPortlet3').show();
                    $('#tbody_rp').html(content);
                    $('#tbody_misc').html(content2); //populate the other dropdown
                    $('#tbody_rp2').html(content3);
                    $('#tbody_pdc').html(content4);
                    $('#tblamortization2').dataTable();
                    // $('#tblmisc').dataTable();
                    // $('#tblpdc').dataTable();
                    
                    var payment_total = 0;
                    payment_total = +surcharge_total + +ips_total + +interest_total + +vat_total + +principal_total;
                    payment_total = payment_total - paid_total;
                    $('#surcharges_text').text(parseFloat(Math.round(surcharge_total * 100) / 100).toFixed(2));
                    $('#ips_text').text(parseFloat(Math.round(ips_total * 100) / 100).toFixed(2));
                    $('#interest_text').text(parseFloat(Math.round(interest_total * 100) / 100).toFixed(2));
                    $('#vat_text').text(parseFloat(Math.round(vat_total * 100) / 100).toFixed(2));
                    $('#tcp2_text').text(jFormatNumber(Math.round(principal_total * 100) / 100));
                    $('#total_text').html(jFormatNumber(Math.round(payment_total * 100) / 100));
                    $('#total_text').css("font-weight","Bold");
                    console.log('-----------> ' + $('#total_text').html());
                    
                    var content_summary = '';
                    var summaryTotalAmount = 0;
                    var summaryTotalPrincipal = 0;
                    var summaryTotalSurcharge = 0;
                    var summaryTotalInterest = 0;
                    var summaryTotalIPS = 0;

                    if (data['payment'].length>0){
                        for (var x = 0; x < data['payment'].length; x++) {
                            content_summary += '<tr>';
                            content_summary += '<td style="display: none;">' + data['payment'][x].payment_id + '</td>'; 
                            content_summary += '<td>' + converter(data['payment'][x].pay_date) + '</td>';
                            content_summary += '<td>' + data['payment'][x].payment_name + '</td>';  
                            content_summary += '<td>' + numberWithCommas(parseFloat(data['payment'][x].amount)) + '</td>'; 
                            content_summary += '<td>' + numberWithCommas(parseFloat(data['payment'][x].principal)) + '</td>'; 
                            content_summary += '<td>' + numberWithCommas(parseFloat(data['payment'][x].surcharge)) + '</td>'; 
                            content_summary += '<td>' + numberWithCommas(parseFloat(data['payment'][x].interest)) + '</td>'; 
                            content_summary += '<td>' + numberWithCommas(parseFloat(data['payment'][x].sundry)) + '</td>'; 
                            content_summary += '<td>' + numberWithCommas(parseFloat(data['payment'][x].ips)) + '</td>'; 
                            content_summary += '<td>' + numberWithCommas(parseFloat(data['payment'][x].balance)) + '</td>'; 
                            content_summary += '</tr>';

                            summaryTotalAmount = +summaryTotalAmount + +Number(data['payment'][x].amount);
                            summaryTotalPrincipal = +summaryTotalPrincipal + +Number(data['payment'][x].principal);
                            summaryTotalSurcharge = +summaryTotalSurcharge + +Number(data['payment'][x].surcharge);
                            summaryTotalInterest = +summaryTotalInterest + +Number(data['payment'][x].interest);
                            summaryTotalIPS = +summaryTotalIPS + +Number(data['payment'][x].ips);
                        }
                    }
                    content_summary += '<tr>';
                    content_summary += '<td>&nbsp;</td>';
                    content_summary += '<td><b> TOTAL: </b></td>';
                    content_summary += '<td><b>' + numberWithCommas(parseFloat(Math.round(summaryTotalAmount * 100) / 100).toFixed(2)) + '</b></td>';
                    content_summary += '<td><b>' + numberWithCommas(parseFloat(Math.round(summaryTotalPrincipal * 100) / 100).toFixed(2)) + '</b></td>';
                    content_summary += '<td><b>' + numberWithCommas(parseFloat(Math.round(summaryTotalSurcharge * 100) / 100).toFixed(2)) + '</b></td>';
                    content_summary += '<td><b>' + numberWithCommas(parseFloat(Math.round(summaryTotalInterest * 100) / 100).toFixed(2)) + '</b></td>';
                    content_summary += '<td><b>' + numberWithCommas(parseFloat(Math.round(summaryTotalIPS * 100) / 100).toFixed(2)) + '</b></td>';
                    content_summary += '<td>&nbsp;</td>';
                    content_summary += '<td>&nbsp;</td>';
                    content_summary += '</tr>';

                    $('#tbody_summary').html(content_summary); 
                    //var summary = $('#tblsummary').DataTable();
                    // $('#tblsummary').dataTable({
                    //     "aaSorting": []
                    // });
                } else {
                    toastr.error('No data to be shown!', 'Operation Done');
                    // console.log(errorThrown);
                }

            },
            error: function (errorThrown){
                toastr.error('Error!', 'Operation Done');
                console.log(errorThrown);
            }
        });
    });
    
    $('#generate2').click(function () {
        var table = document.getElementById("tblamortization");
        var surcharge_date_new = moment($('#surchargeDate').val()).format("YYYY-MM-DD");
        var surcharge_date_new2 = moment($('#surchargeDate').val());
        var contractid_new = global_contract_id;

        // alert('surchargedate:'+surcharge_date_new+' contractid:'+contractid_new);

        var dataNew = new FormData();
        dataNew.append("surcharge_date_new",surcharge_date_new);
        dataNew.append("contractid_new",contractid_new);
                for (var pair of dataNew.entries()) {
            console.log(pair[0]+ ', ' + pair[1]); 
        }

        $.ajax({
            type: "POST",
            url:  baseurl + "collection/getDetailsByNewDate",
            data: dataNew,
            cache: false,
            processData:false,
            contentType:false,
            success: function(result){

                var data = jQuery.parseJSON(result);
                console.log(data);
                var content2 = '';
                var surcharge_total = 0;
                var amortization_total = 0;
                var amountDue_total = 0;
                var vat_total = 0;
                var ips_total = 0;
                var ips_accrued_total = 0;
                var ips_interest_total = 0;
                var interest_total = 0;
                var principal_total = 0;
                var paid_total = 0;
                var content = '';

                // content2 += '<tr id="myRow">';
                // content2 += '<td style="display: none;">' + data2[0].amortization_id + '</td>'; 
                // content2 += '<td>' + $('#surchargeDate').val() + '</td>'; 
                // content2 += '<td>' + diffDays2 + '</td>';
                // content2 += '<td>' + parseFloat(Math.round(due2 * 100) / 100).toFixed(2) +'</td>';
                // content2 += '<td>' + parseFloat(Math.round(amortizationAmount2 * 100) / 100).toFixed(2) + '</td>';
                // content2 += '<td id="surchargeCell">' + parseFloat(Math.round(surcharge_unpaid2 * 100) / 100).toFixed(2) + '</td>';
                // content2 += '<td>' + parseFloat(Math.round(vatAmount2 * 100) / 100).toFixed(2) + '</td>';
                // content2 += '<td>' + parseFloat(Math.round(ips2 * 100) / 100).toFixed(2) +'</td>';
                // content2 += '<td>' + parseFloat(Math.round(interestAmount2 * 100) / 100).toFixed(2) + '</td>';
                // content2 += '<td>' + parseFloat(Math.round(principalAmount2 * 100) / 100).toFixed(2) + '</td>';
                // content2 += '<td>' + parseFloat(Math.round(paid_up2 * 100) / 100).toFixed(2) + '</td>';
                // content2 += '<td style="display: none;">' + data2[0].contract_id + '</td>'; 
                // content2 += '<td style="display: none;">' + data2[0].interest_paid + '</td>'; 
                // content2 += '<td style="display: none;">' + data2[0].vat_paid + '</td>'; 
                // content2 += '<td style="display: none;">' + data2[0].surcharge_paid + '</td>'; 
                // content2 += '<td style="display: none;">' + data2[0].principal_paid + '</td>'; 
                // content2 += '</tr>';

                for (var i = 0; i < data.length; i++) {
                    var amortizationAmount2 = Number(data[i].amortization_amount);
                    var vatAmount2 = Number(data[i].vat_amount); //- Number(data2[0].vat_paid);
                    var ipsAccruedAmount = Number(data[i].ips_accrued);
                    var ipsInterestAmount = Number(data[i].ips_interest);
                    var ips2 = ipsAccruedAmount + ipsInterestAmount;
                    var interestAmount2 = Number(data[i].interest_amount); //- Number(data2[0].interest_paid);
                    var principalAmount2 = Number(data[i].principal_amount); //- Number(data2[0].principal_paid);

                    var parts2 = data[i].due_date.split('-');
                    var new_due_date3 = new Date(parts2[0],parts2[1]-1,parts2[2]);
                    var due_date3 = moment(data[i].due_date, "YYYY-MM-DD");
                    var chosen_date = $('#surchargeDate').val();
                    var parts3 = chosen_date.split('-');
                    var surcharge_date_new3 = new Date(parts3[0],parts3[1]-1,parts3[2]);
                    var timeDiff2 = Math.abs(surcharge_date_new3.getTime() - new_due_date3.getTime());
                    var diffDays2 = Math.ceil(timeDiff2 / (1000 * 3600 * 24)); 
                    var unpaid2 = vatAmount2 + interestAmount2 + ips2 + principalAmount2;
                    var surcharge_unpaid2 = calculateSurchargeMonth2(due_date3, surcharge_date_new2, 0.03, unpaid2);
                    console.log('surcharge_unpaid2 '+surcharge_unpaid2);
                    var due_amount2 = unpaid2 + surcharge_unpaid2;
                    var paid_up2 = Number(data[i].interest_paid) + Number(data[i].principal_paid) + Number(data[i].vat_paid) + Number(data[i].surcharge_paid) + Number(data[i].ips_accrued_paid) + Number(data[i].ips_interest_paid);
                    var due2 = 0;
                    due2 = due_amount2 - paid_up2;

                    content += '<tr id="myRow">';
                    // var due_date = moment(data[i].due_date, "YYYY-MM-DD");
                    // var date_today = moment();

                    // var parts = data[i].due_date.split('-');
                    // var due_date2 = new Date(parts[0],parts[1]-1,parts[2]); 
                    // var date_today2 = new Date();

                    // var amortizationAmount = Number(data[i].amortization_amount);
                    // var vatAmount = Number(data[i].vat_amount); //- Number(data['amortization'][i].vat_paid);
                    // var ipsAccruedAmount = Number(data[i].ips_accrued);
                    // var ipsInterestAmount = Number(data[i].ips_interest);
                    // var ips = ipsAccruedAmount + ipsInterestAmount;
                    // var interestAmount = Number(data[i].interest_amount); //- Number(data['amortization'][i].interest_paid);
                    // var principalAmount = Number(data[i].principal_amount); //- Number(data['amortization'][i].principal_paid);
                    // //Days Due
                    // var timeDiff = Math.abs(due_date2.getTime() - date_today2.getTime());
                    // var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24)); 

                    // var unpaid = vatAmount + interestAmount + ips + principalAmount;
                    // console.log('unpaid '+unpaid);
                    // var surcharge_unpaid = calculateSurchargeMonth(due_date, date_today, 0.03, unpaid);
                    // console.log('surcharge_unpaid '+surcharge_unpaid);
                    // surcharge_unpaid2 = surcharge_unpaid - Number(data[i].surcharge_paid);
                    // console.log('surcharge_unpaid2 '+surcharge_unpaid2);
                    // var due_amount = unpaid + surcharge_unpaid;
                    // var paid_up = Number(data[i].interest_paid) + Number(data[i].principal_paid) + Number(data[i].vat_paid) + Number(data[i].surcharge_paid);
                    // var due2 = 0;

                    
                    // var printAmort = parseFloat(Math.round(amortizationAmount * 100) / 100).toFixed(2);
                    // var printSurcharge = parseFloat(Math.round(surcharge_unpaid2 * 100) / 100).toFixed(2);
                    // var printVat = parseFloat(Math.round(vatAmount * 100) / 100).toFixed(2);
                    // var printIPS = parseFloat(Math.round(ips * 100) / 100).toFixed(2);
                    // var printIPSAccrued = parseFloat(Math.round(ipsAccruedAmount * 100) / 100).toFixed(2);
                    // var printIPSInterest = parseFloat(Math.round(ipsInterestAmount * 100) / 100).toFixed(2);
                    // var printInterest = parseFloat(Math.round(interestAmount * 100) / 100).toFixed(2);
                    // var printPrincipal = parseFloat(Math.round(principalAmount * 100) / 100).toFixed(2);
                    // var printPaid = parseFloat(Math.round(paid_up * 100) / 100).toFixed(2);
                    // due2 = due_amount - paid_up;
                    // var printDue = parseFloat(Math.round(due2 * 100) / 100).toFixed(2);

                    content += '<td style="display: none;">' + data[i].amortization_id + '</td>'; 
                    content += '<td>' + data[i].due_date + '</td>'; 
                    content += '<td>' + diffDays2 + '</td>';
                    content += '<td align="right">' + numberWithCommas(due2.toFixed(2)) +'</td>';
                    content += '<td align="right">' + numberWithCommas(amortizationAmount2.toFixed(2)) + '</td>';
                    content += '<td align="right">' + numberWithCommas(surcharge_unpaid2.toFixed(2)) + '</td>';
                    content += '<td align="right">' + numberWithCommas(vatAmount2.toFixed(2)) + '</td>';
                    content += '<td align="right">' + numberWithCommas(interestAmount2.toFixed(2)) + '</td>';
                    content += '<td align="right">' + numberWithCommas(ips2.toFixed(2)) +'</td>';
                    content += '<td align="right">' + numberWithCommas(ipsAccruedAmount.toFixed(2)) +'</td>';
                    content += '<td align="right">' + numberWithCommas(ipsInterestAmount.toFixed(2)) +'</td>';
                    content += '<td align="right">' + numberWithCommas(principalAmount2.toFixed(2)) + '</td>';
                    content += '<td align="right">' + numberWithCommas(paid_up2.toFixed(2)) + '</td>';
                    content += '<td style="display: none;">' + data[i].contract_id + '</td>'; 
                    content += '<td style="display: none;">' + data[i].interest_paid + '</td>'; 
                    content += '<td style="display: none;">' + data[i].vat_paid + '</td>'; 
                    content += '<td style="display: none;">' + data[i].surcharge_paid + '</td>';
                    content += '<td style="display: none;">' + data[i].principal_paid + '</td>';
                    content += '<td style="display: none;">' + data[i].ips_accrued_paid + '</td>';
                    content += '<td style="display: none;">' + data[i].ips_interest_paid + '</td>';  
                    content += '</tr>';

                    // console.log(Number(data['amortization'][i].principal_amount));
                    //Totals
                    amountDue_total += due2;
                    amortization_total += amortizationAmount2;
                    surcharge_total += surcharge_unpaid2;
                    vat_total += Number(data[i].vat_amount);
                    ips_accrued_total += Number(data[i].ips_accrued);
                    ips_interest_total += Number(data[i].ips_interest);
                    ips_total = ips_accrued_total + ips_interest_total;
                    interest_total += Number(data[i].interest_amount);
                    principal_total += Number(data[i].principal_amount);
                    paid_total += paid_up2;

                }

                // amountDue_total2 += due2;
                // amortization_total2 += amortizationAmount2;
                // surcharge_total2 += surcharge_unpaid2;
                // vat_total2 += Number(data2[0].vat_amount);
                // ips_total2 += Number(data2[0].rebate);
                // interest_total2 += Number(data2[0].interest_amount);
                // principal_total2 += Number(data2[0].principal_amount);

                // content2 += '<tr>';
                // content2 += '<td>&nbsp;</td>';
                // content2 += '<td><b> TOTAL: </b></td>';
                // content2 += '<td><b>' + parseFloat(Math.round(amountDue_total2 * 100) / 100).toFixed(2) + '</b></td>';
                // content2 += '<td><b>' + parseFloat(Math.round(amortization_total2 * 100) / 100).toFixed(2) + '</b></td>';
                // content2 += '<td><b>' + parseFloat(Math.round(surcharge_total2 * 100) / 100).toFixed(2) + '</b></td>';
                // content2 += '<td><b>' + parseFloat(Math.round(vat_total2 * 100) / 100).toFixed(2) + '</b></td>';
                // content2 += '<td><b>' + parseFloat(Math.round(ips_total2 * 100) / 100).toFixed(2) + '</b></td>';
                // content2 += '<td><b>' + parseFloat(Math.round(ips_total2 * 100) / 100).toFixed(2) + '</b></td>';
                // content2 += '<td><b>' + parseFloat(Math.round(principal_total2 * 100) / 100).toFixed(2) + '</b></td>';
                // content2 += '<td><b>' + parseFloat(Math.round(paid_up2 * 100) / 100).toFixed(2) + '</b></td>';
                // content2 += '</tr>';

                amountDue_total = parseFloat(amountDue_total.toFixed(2));
                amortization_total = parseFloat(amortization_total.toFixed(2));
                surcharge_total = parseFloat(surcharge_total.toFixed(2));
                vat_total = parseFloat(vat_total.toFixed(2));
                ips_total = parseFloat(ips_total.toFixed(2));
                ips_accrued_total = parseFloat(ips_accrued_total.toFixed(2));
                ips_interest_total = parseFloat(ips_interest_total.toFixed(2));
                interest_total = parseFloat(interest_total.toFixed(2));
                principal_total = parseFloat(principal_total.toFixed(2));
                paid_total = parseFloat(paid_total.toFixed(2));
                // var wiw = parseFloat(numberWithCommas(paid_up).replace(/,/g, ''));
                content += '<td>&nbsp;</td>';
                content += '<td><b> TOTAL: </b></td>';
                content += '<td align="right"><b>' + numberWithCommas(amountDue_total.toFixed(2)) + '</b></td>';
                content += '<td align="right"><b>' + numberWithCommas(amortization_total.toFixed(2)) + '</b></td>';
                content += '<td align="right"><b>' + numberWithCommas(surcharge_total.toFixed(2)) + '</b></td>';
                content += '<td align="right"><b>' + numberWithCommas(vat_total.toFixed(2)) + '</b></td>';
                content += '<td align="right"><b>' + numberWithCommas(interest_total.toFixed(2)) + '</b></td>';
                content += '<td align="right"><b>' + numberWithCommas(ips_total.toFixed(2)) + '</b></td>';
                content += '<td align="right"><b>' + numberWithCommas(ips_accrued_total.toFixed(2)) + '</b></td>';
                content += '<td align="right"><b>' + numberWithCommas(ips_interest_total.toFixed(2)) + '</b></td>';
                content += '<td align="right"><b>' + numberWithCommas(principal_total.toFixed(2)) + '</b></td>';
                content += '<td align="right"><b>' + numberWithCommas(paid_total.toFixed(2)) + '</b></td>';

                $('#amort').show();
                $('#cid').show();
                $('#tbody_rp').html(content); //populate the other dropdown
                // alert(diffDays);
                var payment_total = 0;
                payment_total = surcharge_total + ips_total + interest_total + vat_total + principal_total;
                $('#surcharges_text').text(numberWithCommas(surcharge_total.toFixed(2)));
                $('#ips_text').text(numberWithCommas(ips_total.toFixed(2)));
                $('#interest_text').text(numberWithCommas(interest_total.toFixed(2)));
                $('#vat_text').text(numberWithCommas(vat_total.toFixed(2)));
                $('#tcp2_text').text(jFormatNumber(principal_total.toFixed(2)));
                $('#total_text').text(jFormatNumber(payment_total));
                $('#total_text').css("font-weight","Bold");

                
            },
            error: function (errorThrown){
                toastr.error('Error!', 'Operation Done');
                console.log(errorThrown);
            }
        });
    });

    $('#multiple').click(function () {
        $('#tblamortization').find('tr').each(function(){
            $(this).find('td').eq(11).after('<td><input type="checkbox"></td>');
        });
    });
    
    $('#paymentType').on('change', function() {
        if ($('#paymentType').val()==2){
            $('#checkOnlyDiv').show();
            $('#amountRow').hide();
            $('#bankPayment').hide();
        }
        if ($('#paymentType').val()==1){
            $('#checkOnlyDiv').hide();
            $('#amountRow').show();
            $('#bankPayment').hide();
        }
        if ($('#paymentType').val()==3){
            $('#checkOnlyDiv').show();
            $('#amountRow').show();
            $('#bankPayment').hide();
        }
        if ($('#paymentType').val()==4){
            $('#checkOnlyDiv').hide();
            $('#amountRow').hide();
            $('#bankPayment').show();
        }
    });

    $('#printSummarys').click(function () {
        var table = document.getElementById("tblamortization");
        // var amortizationid = Number(table.rows[1].cells[0].innerHTML);
        var contractid = table.rows[1].cells[11].innerHTML;
        // var wiw = "sample";
        var data = new FormData();
        data.append("contractid", contractid);
        for (var pair of data.entries()) {
            console.log(pair[0]+ ', ' + pair[1]); 
        }
        $.ajax({
            url: baseurl + "collection/print_all_payments",
            type: 'POST',
            //contentType: "application/json; charset=utf-8",
            data: data,
            cache: false,
            processData:false,
            contentType:false,
            success: function(html) {
                var url = baseurl + "reports/SummaryOfPayments.pdf";
                var win = window.open(url, '_blank');
                win.focus();
                //$("#receiptTrigger").trigger("click").attr("target", "_blank");     
            }
        });
    });
    
    $('#waiveSubmit').click(function () {
        var table = document.getElementById("tblamortization");
        var newSurcharge = Number($('#waiveSurchargeAmount').val());
        var principal = parseFloat(table.rows[1].cells[9].innerHTML.replace(/,/g, ''));
        var newTotal = +newSurcharge + +principal;
        console.log(newSurcharge);
        console.log(principal);
        console.log(newTotal);
        table.rows[1].cells[5].innerHTML = parseFloat(Math.round(newSurcharge * 100) / 100).toFixed(2);
        table.rows[1].cells[3].innerHTML = parseFloat(Math.round(newTotal * 100) / 100).toFixed(2);
        console.log(table.rows.length);
    });

    var recomputeSurchargeLine = 0;
    var numberOfLines = 0; 
    $('#recomputeSubmits').click(function () {
        recomputeSurchargeLine = 1;
        var table = document.getElementById("tblamortization");
        var newSurcharge = $('#recomputeSurchargeAmount').val(); 

        //Variables for the sum
        var amountDueTotal = 0;
        var amortizationTotal = 0;
        var surchargeTotal = 0;
        var vatTotal = 0;
        var ipsTotal = 0;
        var ipsAccruedTotal = 0;
        var ipsInterestTotal = 0;
        var interestTotal = 0;
        var principalTotal = 0;
        var paymentsTotal = 0;
        console.log("row length "+table.rows.length);

        //This for loop is to check each line if it has a surcharge
        for (x=1; x<table.rows.length; x++){
            //This is to get the values of each line and get their sum
            var surchargePerLine = parseFloat(table.rows[x].cells[5].innerHTML.replace(/,/g, ''));
            var amortization = parseFloat(table.rows[x].cells[4].innerHTML.replace(/,/g, ''));
            var surcharge = parseFloat(table.rows[x].cells[5].innerHTML.replace(/,/g, ''));
            var vat = parseFloat(table.rows[x].cells[6].innerHTML.replace(/,/g, ''));
            var interest = parseFloat(table.rows[x].cells[7].innerHTML.replace(/,/g, ''));
            var ips = parseFloat(table.rows[x].cells[8].innerHTML.replace(/,/g, ''));
            var ips_accrued = parseFloat(table.rows[x].cells[9].innerHTML.replace(/,/g, ''));
            var ips_interest = parseFloat(table.rows[x].cells[10].innerHTML.replace(/,/g, ''));
            var principal = parseFloat(table.rows[x].cells[11].innerHTML.replace(/,/g, ''));
            // var payments = parseFloat(table.rows[x].cells[12].innerHTML.replace(/,/g, ''));
            
            if (surchargePerLine>0){
                //If it has a surcharge value then numberOfLines + 1
                numberOfLines = numberOfLines + 1;
                amortizationTotal = +amortizationTotal + +amortization;
                surchargeTotal = +surchargeTotal + +surcharge;
                vatTotal = +vatTotal + +vat;
                interestTotal = +interestTotal + +interest;
                ipsTotal = +ipsTotal + +ips;
                ipsAccruedTotal = +ipsTotal + +ips_accrued;
                ipsInterestTotal = +ipsTotal + +ips_interest;
                principalTotal = +principalTotal + +principal;
                paymentsTotal = +paymentsTotal + +parseFloat(table.rows[x].cells[12].innerHTML.replace(/,/g, ''));
            }

        }

        //valPerLine is the variable for the new value of surcharge each line based from the new amount of surcharge and the number of lines with surcharges
        var valPerLine = newSurcharge / numberOfLines;
        var newAmountDue = 0;
        for (x=1; x<=numberOfLines; x++){
            var principal = parseFloat(table.rows[x].cells[11].innerHTML.replace(/,/g, ''));
            var payments = parseFloat(table.rows[x].cells[12].innerHTML.replace(/,/g, ''));
            newAmountDue = +principal + +valPerLine;
            newAmountDue = newAmountDue - payments;
            amountDueTotal = +amountDueTotal + +newAmountDue;
            //Replace the values of the cells in the table
            table.rows[x].cells[3].innerHTML = numberWithCommas(parseFloat(Math.round(newAmountDue * 100) / 100).toFixed(2));
            table.rows[x].cells[5].innerHTML = numberWithCommas(parseFloat(Math.round(valPerLine * 100) / 100).toFixed(2));
        }


        //Delete the last row to replace it with a new one
        table.deleteRow(numberOfLines + 1);
        //Replacing a new last row
        var totalIndex = numberOfLines + 1;
        table.rows[totalIndex].cells[2].innerHTML = '<b>'+numberWithCommas(parseFloat(Math.round(amountDueTotal * 100) / 100).toFixed(2))+'</b>';
        table.rows[totalIndex].cells[3].innerHTML = '<b>'+numberWithCommas(parseFloat(Math.round(amortizationTotal * 100) / 100).toFixed(2))+'</b>';
        table.rows[totalIndex].cells[4].innerHTML = '<b>'+numberWithCommas(parseFloat(Math.round(newSurcharge * 100) / 100).toFixed(2))+'</b>';
        table.rows[totalIndex].cells[5].innerHTML = '<b>'+numberWithCommas(parseFloat(Math.round(vatTotal * 100) / 100).toFixed(2))+'</b>';
        table.rows[totalIndex].cells[6].innerHTML = '<b>'+numberWithCommas(parseFloat(Math.round(interestTotal * 100) / 100).toFixed(2))+'</b>';
        table.rows[totalIndex].cells[7].innerHTML = '<b>'+numberWithCommas(parseFloat(Math.round(ipsTotal * 100) / 100).toFixed(2))+'</b>';
        table.rows[totalIndex].cells[8].innerHTML = '<b>'+numberWithCommas(parseFloat(Math.round(ipsAccruedTotal * 100) / 100).toFixed(2))+'</b>';
        table.rows[totalIndex].cells[9].innerHTML = '<b>'+numberWithCommas(parseFloat(Math.round(ipsInterestTotal * 100) / 100).toFixed(2))+'</b>';
        table.rows[totalIndex].cells[10].innerHTML = '<b>'+numberWithCommas(parseFloat(Math.round(principalTotal * 100) / 100).toFixed(2))+'</b>';
        table.rows[totalIndex].cells[11].innerHTML = '<b>'+numberWithCommas(parseFloat(Math.round(paymentsTotal * 100) / 100).toFixed(2))+'</b>';
        // table.rows[newLength].cells[3].innerHTML = amountDueTotal;
        var payment_total = amountDueTotal;
        $('#surcharges_text').text(numberWithCommas(parseFloat(Math.round(newSurcharge * 100) / 100).toFixed(2)));
        $('#ips_text').text(numberWithCommas(parseFloat(Math.round(ipsTotal * 100) / 100).toFixed(2)));
        $('#interest_text').text(numberWithCommas(parseFloat(Math.round(interestTotal * 100) / 100).toFixed(2)));
        $('#vat_text').text(numberWithCommas(parseFloat(Math.round(vatTotal * 100) / 100).toFixed(2)));
        $('#tcp2_text').text(jFormatNumber(parseFloat(Math.round(principalTotal * 100) / 100).toFixed(2)));
        $('#total_text').html(jFormatNumber(parseFloat(Math.round(payment_total * 100) / 100)));
        $('#total_text').css("font-weight","Bold");

        console.log('-----------> ' + $('#total_text').html());
    });
    $('#try_btn').click(function(){
        var tots = 0;
        var table = document.getElementById("tblamortization");
        var principal = parseFloat(table.rows[1].cells[11].innerHTML.replace(/,/g, ''));
        for (var i = 1; i < $('#tblamortization tr').length-1; i++) {
            var temp = parseFloat(table.rows[i].cells[11].innerHTML.replace(/,/g, ''))
            tots += temp;
        }

        alert("principal total-> " + tots);
    });
    $('#masking').keypress(function(){
        $value = jFormatNumberRet($(this).val());

        if ($value != '') {
            $(this).val(jFormatNumber($value));
            console.log(jFormatNumber($value));
        }
    });



    $('#saveButton').click(function () {
        if(document.getElementById('payToPrincipal').checked) {
            var amountForChecking1 = $('#payment1').val();
            var amountForChecking2 = $('#payment2').val();
            var amountForChecking3 = $('#payment3').val();
            var amountForCheckingTotal = amountForChecking1 + amountForChecking2 + amountForChecking3;
            var totalForChecking = $('#total_text').text();
            //amountForChecking = parseFloat(amountForChecking.replace(/,/g, ''));
            console.log('amountForCheckingTotal = '+amountForCheckingTotal);
            console.log('totalForChecking = '+totalForChecking);
            totalForChecking = parseFloat(totalForChecking.replace(/,/g, ''));
            if(amountForCheckingTotal >= totalForChecking){
                if ($('#paymentType').val()==1){
                    console.log('PAY TO PRINCIPAL');
                    if ($('#payment1').val()=="" || $('#paymentDate').val()==""){
                        if ($('#payment1').val()==""){
                            $('#payment1').css({"border": "1px solid red"});
                        } else {
                            $('#payment1').css({"border": ""});
                        }
                        if ($('#paymentDate').val()==""){
                            $('#paymentDate').css({"border": "1px solid red"});
                        } else {
                            $('#paymentDate').css({"border": ""});
                        }

                    } else {
                        var table = document.getElementById("tblamortization");
                        var amortizationid = Number(table.rows[1].cells[0].innerHTML);
                        var tcp = parseFloat($('#tcp').text().replace(/,/g, ''));
                        var contractID = table.rows[1].cells[13].innerHTML;
                        var paymentdate = $('#paymentDate').val();
                        var amount = Number($('#payment1').val());
                        var paymenttype = $('#paymentType').val();
                        var paidamount = parseFloat(table.rows[1].cells[10].innerHTML.replace(/,/g, ''));
                        var principal = parseFloat(table.rows[1].cells[11].innerHTML.replace(/,/g, ''));
                        var principal_already_paid = parseFloat(table.rows[1].cells[17].innerHTML.replace(/,/g, ''));
                        var amount2 = amount;
                        var principal2 = principal;
                        var principal_paid = 0;
                        var success_flag = 0
                        principal2 = principal2 - principal_already_paid;

                        if(amount2 >= principal2){
                            principal_paid = principal2;
                            amount2 = amount2 - principal2;
                        } else {
                            principal_paid = amount2;
                            amount2 = amount2 - amount2;
                        }

                        var data = new FormData();
                        data.append("amortization_id", amortizationid);
                        data.append("contract_id",contractID);
                        data.append("payment_date",paymentdate);
                        data.append("amount",amount);
                        data.append("payment_type",paymenttype);
                        data.append("principal",principal_paid);
                        data.append("principal_paid", principal_paid);
                        data.append("cashier_id", user_id);
                        for (var pair of data.entries()) {
                            console.log(pair[0]+ ', ' + pair[1]); 
                        }
                        $.ajax({
                            type: "POST",
                            url:  baseurl + "collection/savePaymentCashPrincipalOnly",
                            data: data,
                            cache: false,
                            processData:false,
                            contentType:false,
                            success: function(result){
                                

                                var data = jQuery.parseJSON(result);
                                console.log(data['success']);
                                var totalpaid = Number(getPayments(contractID));
                                console.log("TOTAL PAID --------------> " + totalpaid);
                                console.log("TCP ---------------------> " + tcp);
                                console.log("UNPAID ------------------> " + parseFloat(tcp - totalpaid));

                                var unpaidprincipaltotal = parseFloat(tcp - totalpaid);
                                // console.log('unpaid principal = '+unpaidprincipaltotal);
                                var unpaidlines = Number(data['unpaid'][0].num);
                                // console.log('unpaidlines = '+unpaidlines);
                                var newprincipalperline = unpaidprincipaltotal / unpaidlines;
                                // console.log('newprincipalperline = '+newprincipalperline);
                                var length = data['lineorder'].length;
                                var runbalance = unpaidprincipaltotal;
                            // -----------------------------------------------------------------------------------------------------------------------------------------
                                for (var x=0;x<length;x++){
                                    //ORIG CODE
                                    var interest = Number(data['lineorder'][x].interest_amount);
                                    var vat = Number(data['lineorder'][x].vat_amount);
                                    var ips = Number(data['lineorder'][x].ips_amortization);
                                    var newamort = interest + vat + ips + newprincipalperline;
                                    console.log('newamort '+newamort);
                                    var amortid = data['lineorder'][x].amortization_id;
                                    console.log('amortid '+amortid);
                                    runbalance = runbalance - newamort;

                                    var data2 = new FormData();
                                    data2.append("amortization_amount", newamort);
                                    data2.append("principal_amount",newprincipalperline);
                                    data2.append("amortization_id",amortid);
                                    data2.append("outstanding_balance",runbalance);
                                    for (var pair of data2.entries()) {
                                        console.log(pair[0]+ ', ' + pair[1]); 
                                    }    

                                    //REORG CODE
                                        // var interest = Number(data['lineorder'][x].interest_amount);
                                        // var vat = Number(data['lineorder'][x].vat_amount);
                                        // var ips = Number(data['lineorder'][x].ips_amortization);
                                        // var newamort = interest + vat + ips + newprincipalperline;
                                        // console.log('newamort '+newamort);
                                        // var amortid = data['lineorder'][x].amortization_id;
                                        // console.log('amortid '+amortid);
                                        // runbalance = runbalance - newamort;

                                        // var data2 = new FormData();
                                        // data2.append("amortization_amount", newamort);
                                        // data2.append("principal_amount",newprincipalperline);
                                        // data2.append("amortization_id",amortid);
                                        // data2.append("outstanding_balance",runbalance);
                                        // for (var pair of data2.entries()) {
                                        //     console.log(pair[0]+ ', ' + pair[1]); 
                                        // }

                                        // var int_rate;
                                        // var interest2 = Number(data['lineorder'][x].interest_amount);
                                        // var vat2;
                                        // var ips2;
                                        // var newamort2;
                                        // var amortid2;
                                        // // interest_amount = run_balance * interest;
                                        // if (balance_interest_rate != 0 || balance_interest_rate != "") {
                                        //     int_rate = (balance_interest_rate/100) / 12;
                                        //     // interest2 = run_balance * int_rate; 
                                        //     run_balance = run_balance + interest2;
                                    // }

                                    $.ajax({
                                        type: "POST",
                                        url:  baseurl + "collection/updateAmortizationPrincipalOnlyPayment",
                                        data: data2,
                                        cache: false,
                                        processData:false,
                                        contentType:false,
                                        success: function(result){
                                            if (result.length > 0) {
                                                success_flag = 1;
                                            }else{
                                                success_flag = 0;
                                            }
                                            // r_vatable_amount += vat_paid;
                                                // r_vat_exempt_amount = 0;
                                                // r_vat_zero_rated_amount = 0;
                                                // r_total_or_details = r_vatable_amount +r_vat_exempt_amount +r_vat_zero_rated_amount;
                                                // r_add_vat += r_total_or_details;
                                                // r_surcharge_paid += 0;
                                                // r_ips += 0;
                                                // r_interest += 0;
                                                // r_principal = principal_paid;
                                                // // r_principal += principal_paid; ----> original code;
                                                // r_total_payment_details = r_surcharge_paid + r_ips + r_interest + r_principal;
                                                // r_customer_name = $('#customerName').text();
                                                // r_customer_address = $('#customerAddress').text();
                                                // r_customer_tin = $('#customerTIN').text();
                                                // r_lot_desc = $('#lotDescription').text();
                                                // r_cash_amount = Number($('#payment1').val());
                                                // r_check_amount = Number($('#payment2').val());
                                                // r_check_date = $('#checkDate').val();
                                                // r_check_bank = '';
                                                // r_check_number = $('#checkNumber1').val();
                                                // r_bank_amount = 0;
                                                // r_bank_designated = '';
                                                // r_bank_deposit_date = 0;
                                                // r_cashier = '';
                                                // r_total_amount = + r_cash_amount + r_check_amount + r_bank_amount;
                                                // var data = new FormData();
                                                // data.append("r_customer_name", r_customer_name);
                                                // data.append("r_customer_address",r_customer_address);
                                                // data.append("r_customer_tin",r_customer_tin);
                                                // data.append("r_lot_desc",r_lot_desc);
                                                // data.append("r_vatable_amount",r_vatable_amount);
                                                // data.append("r_vat_exempt_amount",r_vat_exempt_amount);
                                                // data.append("r_vat_zero_rated_amount",r_vat_zero_rated_amount);
                                                // data.append("r_total_or_details",r_total_or_details);
                                                // data.append("r_add_vat",r_add_vat);
                                                // data.append("r_surcharge_paid",r_surcharge_paid);
                                                // data.append("r_ips",r_ips);
                                                // data.append("r_interest", r_interest);
                                                // data.append("r_principal", r_principal);
                                                // data.append("r_total_payment_details", r_total_payment_details);
                                                // data.append("r_cash_amount", r_cash_amount);
                                                // data.append("r_check_amount", r_check_amount);
                                                // data.append("r_check_date", r_check_date);
                                                // data.append("r_check_bank", r_check_bank);
                                                // data.append("r_check_number", r_check_number);
                                                // data.append("r_bank_amount", r_bank_amount);
                                                // data.append("r_bank_designated", r_bank_designated);
                                                // data.append("r_bank_deposit_date", r_bank_deposit_date);
                                                // data.append("r_total_amount", r_total_amount);
                                                // data.append("r_cashier", user_id);
                                                // data.append("cashier_id",user_id);
                                                // data.append("customer_id",global_customer_id);
                                                // for (var pair of data.entries()) {
                                                //     console.log(pair[0]+ ', ' + pair[1]); 
                                                // }
                                                // $.ajax({
                                                //     url: baseurl + "collection/receipt2",
                                                //     type: 'POST',
                                                //     //contentType: "application/json; charset=utf-8",
                                                //     // dataType: 'json',
                                                //     data: data,
                                                //     cache: false,
                                                //     processData:false,
                                                //     contentType:false,
                                                //     success: function(html) {
                                                //         var url = baseurl + "reports/Receipt.pdf";
                                                //         var win = window.open(url, '_blank');
                                                //         win.focus();
                                                //         //$("#receiptTrigger").trigger("click").attr("target", "_blank");     
                                                //     },
                                                //     error: function (errorThrown){
                                                //         //toastr.error('Error!', 'Operation Done');
                                                //         //console.log(errorThrown);
                                                //     }
                                            // });
                                        },
                                        error: function(result){
                                            toastr.error('Error!', 'Operation Done');
                                        }
                                    });
                                }
                            // -----------------------------------------------------------------------------------------------------------------------------------------
                                // if (success_flag == 1) {
                                    r_vatable_amount += vat_paid;
                                    r_vat_exempt_amount = 0;
                                    r_vat_zero_rated_amount = 0;
                                    r_total_or_details = r_vatable_amount +r_vat_exempt_amount +r_vat_zero_rated_amount;
                                    r_add_vat += r_total_or_details;
                                    r_surcharge_paid += 0;
                                    r_ips += 0;
                                    r_interest += 0;
                                    r_principal = principal_paid;
                                    // r_principal += principal_paid; ----> original code;
                                    r_total_payment_details = r_surcharge_paid + r_ips + r_interest + r_principal;
                                    r_customer_name = $('#customerName').text();
                                    r_customer_address = $('#customerAddress').text();
                                    r_customer_tin = $('#customerTIN').text();
                                    r_lot_desc = $('#lotDescription').text();
                                    r_cash_amount = Number($('#payment1').val());
                                    r_check_amount = Number($('#payment2').val());
                                    r_check_date = $('#checkDate').val();
                                    r_check_bank = '';
                                    r_check_number = $('#checkNumber1').val();
                                    r_bank_amount = 0;
                                    r_bank_designated = '';
                                    r_bank_deposit_date = 0;
                                    r_cashier = '';
                                    r_total_amount = + r_cash_amount + r_check_amount + r_bank_amount;
                                    var data = new FormData();
                                    data.append("r_customer_name", r_customer_name);
                                    data.append("r_customer_address",r_customer_address);
                                    data.append("r_customer_tin",r_customer_tin);
                                    data.append("r_lot_desc",r_lot_desc);
                                    data.append("r_vatable_amount",r_vatable_amount);
                                    data.append("r_vat_exempt_amount",r_vat_exempt_amount);
                                    data.append("r_vat_zero_rated_amount",r_vat_zero_rated_amount);
                                    data.append("r_total_or_details",r_total_or_details);
                                    data.append("r_add_vat",r_add_vat);
                                    data.append("r_surcharge_paid",r_surcharge_paid);
                                    data.append("r_ips",r_ips);
                                    data.append("r_interest", r_interest);
                                    data.append("r_principal", r_principal);
                                    data.append("r_total_payment_details", r_total_payment_details);
                                    data.append("r_cash_amount", r_cash_amount);
                                    data.append("r_check_amount", r_check_amount);
                                    data.append("r_check_date", r_check_date);
                                    data.append("r_check_bank", r_check_bank);
                                    data.append("r_check_number", r_check_number);
                                    data.append("r_bank_amount", r_bank_amount);
                                    data.append("r_bank_designated", r_bank_designated);
                                    data.append("r_bank_deposit_date", r_bank_deposit_date);
                                    data.append("r_total_amount", r_total_amount);
                                    data.append("r_cashier", user_id);
                                    data.append("cashier_id",user_id);
                                    data.append("customer_id",global_customer_id);
                                    for (var pair of data.entries()) {
                                        console.log(pair[0]+ ', ' + pair[1]); 
                                    }
                                    $.ajax({
                                        url: baseurl + "collection/receipt2",
                                        type: 'POST',
                                        //contentType: "application/json; charset=utf-8",
                                        // dataType: 'json',
                                        data: data,
                                        cache: false,
                                        processData:false,
                                        contentType:false,
                                        success: function(html) {
                                            var url = baseurl + "reports/Receipt.pdf";
                                            var win = window.open(url, '_blank');
                                            win.focus();
                                            //$("#receiptTrigger").trigger("click").attr("target", "_blank");     
                                        },
                                        error: function (errorThrown){
                                            //toastr.error('Error!', 'Operation Done');
                                            //console.log(errorThrown);
                                        }
                                    });
                                    toastr.success('Successfully Saved!', 'Operation Done');
                                // }else{
                                //     toastr.error('ERROR!', 'Operation Failed');
                                // }

                            },
                            error: function(data){

                            }
                        });
                    }
                }
                if ($('#paymentType').val()==2){
                    // alert('Check');

                    if ($('#bank').val()=='0' || $('#payment2').val()=="" || $('#checkNumber1').val()=="" || $('#checkDate').val()==""){
                        if ($('#bank').val()=='0'){
                            $('#bank').css({"border": "1px solid red"});
                        } else {
                            $('#bank').css({"border": ""});
                        }
                        if ($('#payment2').val()==0){
                            $('#payment2').css({"border": "1px solid red"});
                        } else {
                            $('#payment2').css({"border": ""});
                        }
                        if ($('#checkNumber1').val()==0){
                            $('#checkNumber1').css({"border": "1px solid red"});
                        } else {
                            $('#checkNumber1').css({"border": ""});
                        }
                        if ($('#checkDate').val()==0){
                            $('#checkDate').css({"border": "1px solid red"});
                        } else {
                            $('#checkDate').css({"border": ""});
                        }

                    } else {
                        // alert("Okay!");
                        var table = document.getElementById("tblamortization");
                        var tcp = parseFloat($('#tcp').text().replace(/,/g, ''));
                        var amortizationid = Number(table.rows[1].cells[0].innerHTML);
                        var contractID = table.rows[1].cells[13].innerHTML;
                        var paymentdate = $('#paymentDate').val();
                        var amount = Number($('#payment2').val());
                        var checkNumber = $('#checkNumber1').val();
                        var checkDate = $('#checkDate').val();
                        var bankID = $('#bank').val();
                        var paymenttype = $('#paymentType').val();
                        var paidamount = parseFloat(table.rows[1].cells[10].innerHTML.replace(/,/g, ''));
                        var principal = parseFloat(table.rows[1].cells[11].innerHTML.replace(/,/g, ''));
                        var principal_already_paid = parseFloat(table.rows[1].cells[17].innerHTML.replace(/,/g, ''));
                        var amount2 = amount;
                        var principal2 = principal;
                        var principal_paid = 0;

                        principal2 = principal2 - principal_already_paid;

                        if(amount2 > principal2){
                            principal_paid = principal2;
                            amount2 = amount2 - principal2;
                        } else {
                            principal_paid = amount2;
                            amount2 = amount2 - amount2;
                        }

                        var data = new FormData();
                        data.append("amortization_id", amortizationid);
                        data.append("contract_id",contractID);
                        data.append("payment_date",paymentdate);
                        data.append("amount",amount);
                        data.append("check_number",checkNumber);
                        data.append("check_date",checkDate);
                        data.append("bank_id",bankID);
                        data.append("payment_type",paymenttype);
                        data.append("principal",principal_paid);
                        data.append("principal_paid", principal_paid);
                        data.append("cashier_id",user_id)
                        console.log("FIRST DATA PASSED: ");
                        for (var pair of data.entries()) {
                            console.log(pair[0]+ ', ' + pair[1]); 
                        }

                        $.ajax({
                            type: "POST",
                            url:  baseurl + "collection/savePaymentCheckPrincipalOnly",
                            data: data,
                            cache: false,
                            processData:false,
                            contentType:false,
                            success: function(result){
                                
                                //console.log(data);
                                console.log("SAVE PAYMENT!");

                                var data = jQuery.parseJSON(result);
                                var totalpaid = Number(getPayments(contractID));
                                var unpaidprincipaltotal = tcp - totalpaid;
                                console.log('unpaid principal = '+unpaidprincipaltotal);
                                var unpaidlines = Number(data['unpaid'][0].num);
                                console.log('unpaidlines = '+unpaidlines);
                                var newprincipalperline = unpaidprincipaltotal / unpaidlines;
                                console.log('newprincipalperline = '+newprincipalperline);
                                var length = data['lineorder'].length;
                                var runbalance = unpaidprincipaltotal;

                                for (var x=0;x<length;x++){
                                    var interest = Number(data['lineorder'][x].interest_amount);
                                    var vat = Number(data['lineorder'][x].vat_amount);
                                    var ips = Number(data['lineorder'][x].ips_amortization);
                                    var newamort = interest + vat + ips + newprincipalperline;
                                    console.log('newamort '+newamort);
                                    var amortid = data['lineorder'][x].amortization_id;
                                    console.log('amortid '+amortid);
                                    runbalance = runbalance - newamort;

                                    var data2 = new FormData();
                                    data2.append("amortization_amount", newamort);
                                    data2.append("principal_amount",newprincipalperline);
                                    data2.append("amortization_id",amortid);
                                    data2.append("outstanding_balance",runbalance);
                                    for (var pair of data2.entries()) {
                                        console.log(pair[0]+ ', ' + pair[1]); 
                                    }
                                    $.ajax({
                                        type: "POST",
                                        url:  baseurl + "collection/updateAmortizationPrincipalOnlyPayment",
                                        data: data2,
                                        cache: false,
                                        processData:false,
                                        contentType:false,
                                        success: function(result){
                                            console.log("UPDATE AMORT!");
                                            r_vatable_amount += vat_paid;
                                            r_vat_exempt_amount = 0;
                                            r_vat_zero_rated_amount = 0;
                                            r_total_or_details = +r_vatable_amount + +r_vat_exempt_amount + +r_vat_zero_rated_amount;
                                            r_add_vat += r_total_or_details;
                                            r_surcharge_paid += 0;
                                            r_ips += 0;
                                            r_interest += 0;
                                            r_principal += principal_paid;
                                            r_total_payment_details = r_surcharge_paid + r_ips + r_interest + r_principal;
                                            r_customer_name = $('#customerName').text();
                                            r_customer_address = $('#customerAddress').text();
                                            r_customer_tin = $('#customerTIN').text();
                                            r_lot_desc = $('#lotDescription').text();
                                            r_cash_amount = Number($('#payment1').val());
                                            r_check_amount = Number($('#payment2').val());
                                            r_check_date = $('#checkDate').val();
                                            r_check_bank = $('#bank option:selected').text();
                                            r_check_number = $('#checkNumber1').val();
                                            r_bank_amount = 0;
                                            r_bank_designated = '';
                                            r_bank_deposit_date = 0;
                                            r_cashier = '';
                                            r_total_amount = +r_cash_amount +r_check_amount +r_bank_amount;
                                           

                                        },
                                        error: function(result){

                                        }
                                    });
                                }
                                            var data = new FormData();
                                            data.append("r_customer_name", r_customer_name);
                                            data.append("r_customer_address",r_customer_address);
                                            data.append("r_customer_tin",r_customer_tin);
                                            data.append("r_lot_desc",r_lot_desc);
                                            data.append("r_vatable_amount",r_vatable_amount);
                                            data.append("r_vat_exempt_amount",r_vat_exempt_amount);
                                            data.append("r_vat_zero_rated_amount",r_vat_zero_rated_amount);
                                            data.append("r_total_or_details",r_total_or_details);
                                            data.append("r_add_vat",r_add_vat);
                                            data.append("r_surcharge_paid",r_surcharge_paid);
                                            data.append("r_ips",r_ips);
                                            data.append("r_interest", r_interest);
                                            data.append("r_principal", r_principal);
                                            data.append("r_total_payment_details", r_total_payment_details);
                                            data.append("r_cash_amount", r_cash_amount);
                                            data.append("r_check_amount", r_check_amount);
                                            data.append("r_check_date", r_check_date);
                                            data.append("r_check_bank", r_check_bank);
                                            data.append("r_check_number", r_check_number);
                                            data.append("r_bank_amount", r_bank_amount);
                                            data.append("r_bank_designated", r_bank_designated);
                                            data.append("r_bank_deposit_date", r_bank_deposit_date);
                                            data.append("r_total_amount", r_total_amount);
                                            data.append("r_cashier", user_id);
                                            data.append("cashier_id",user_id);
                                            data.append("customer_id",global_customer_id);
                                            for (var pair of data.entries()) {
                                                console.log(pair[0]+ ', ' + pair[1]); 
                                            }
                                            $.ajax({
                                                url: baseurl + "collection/receipt2",
                                                type: 'POST',
                                                //contentType: "application/json; charset=utf-8",
                                                dataType: 'json',
                                                data: data,
                                                cache: false,
                                                processData:false,
                                                contentType:false,
                                                success: function(html) {
                                                    var url = baseurl + "reports/Receipt.pdf";
                                                    var win = window.open(url, '_blank');
                                                    win.focus();
                                                    //$("#receiptTrigger").trigger("click").attr("target", "_blank");     
                                                },
                                                error: function (errorThrown){
                                                    //toastr.error('Error!', 'Operation Done');
                                                    //console.log(errorThrown);
                                                }
                                            });
                                toastr.success('Successfully Saved!', 'Operation Done');

                            },
                            error: function(data){

                            }
                        });

                    }
                }
                if ($('#paymentType').val()==3){
                    // alert('Cash and Check');

                    if ($('#bank').val()=='0' || $('#payment2').val()=="" || $('#checkNumber1').val()=="" || $('#checkDate').val()=="" || $('#payment1').val()==""){
                        if ($('#bank').val()=='0'){
                            $('#bank').css({"border": "1px solid red"});
                        } else {
                            $('#bank').css({"border": ""});
                        }
                        if ($('#payment2').val()==0){
                            $('#payment2').css({"border": "1px solid red"});
                        } else {
                            $('#payment2').css({"border": ""});
                        }
                        if ($('#checkNumber1').val()==0){
                            $('#checkNumber1').css({"border": "1px solid red"});
                        } else {
                            $('#checkNumber1').css({"border": ""});
                        }
                        if ($('#checkDate').val()==0){
                            $('#checkDate').css({"border": "1px solid red"});
                        } else {
                            $('#checkDate').css({"border": ""});
                        }
                        if ($('#payment1').val()==0){
                            $('#payment1').css({"border": "1px solid red"});
                        } else {
                            $('#payment1').css({"border": ""});
                        }

                    } else {
                        var table = document.getElementById("tblamortization");
                        var tcp = parseFloat($('#tcp').text().replace(/,/g, ''));
                        var amortizationid = Number(table.rows[1].cells[0].innerHTML);
                        var contractID = table.rows[1].cells[13].innerHTML;
                        var paymentdate = $('#paymentDate').val();
                        var amountCash = Number($('#payment1').val());
                        var amountCheck = Number($('#payment2').val());
                        var amount = amountCash + amountCheck;
                        var checkNumber = $('#checkNumber1').val();
                        var checkDate = $('#checkDate').val();
                        var bankID = $('#bank').val();
                        var paymenttype = $('#paymentType').val();
                        var paidamount = parseFloat(table.rows[1].cells[10].innerHTML.replace(/,/g, ''));
                        var principal = parseFloat(table.rows[1].cells[11].innerHTML.replace(/,/g, ''));
                        var principal_already_paid = parseFloat(table.rows[1].cells[17].innerHTML.replace(/,/g, ''));
                        var amount2 = amount;
                        var principal2 = principal;
                        var principal_paid = 0;

                        principal2 = principal2 - principal_already_paid;

                        if(amount2 > principal2){
                            principal_paid = principal2;
                            amount2 = amount2 - principal2;
                        } else {
                            principal_paid = amount2;
                            amount2 = amount2 - amount2;
                        }

                        var data = new FormData();
                        data.append("amortization_id", amortizationid);
                        data.append("contract_id",contractID);
                        data.append("payment_date",paymentdate);
                        data.append("amount",amount);
                        data.append("check_number",checkNumber);
                        data.append("check_date",checkDate);
                        data.append("bank_id",bankID);
                        data.append("amount_check",amountCheck);
                        data.append("payment_type",paymenttype);
                        data.append("principal",principal_paid);
                        data.append("principal_paid", principal_paid);
                        data.append("cashier_id",user_id)
                        console.log("FIRST DATA PASSED: ");
                        for (var pair of data.entries()) {
                            console.log(pair[0]+ ', ' + pair[1]); 
                        }
                        $.ajax({
                            type: "POST",
                            url:  baseurl + "collection/savePaymentCashAndCheckPrincipalOnly",
                            data: data,
                            cache: false,
                            processData:false,
                            contentType:false,
                            success: function(result){
                                
                                //console.log(data);

                                var data = jQuery.parseJSON(result);
                                var totalpaid = Number(getPayments(contractID));
                                var unpaidprincipaltotal = tcp - totalpaid;
                                console.log('unpaid principal = '+unpaidprincipaltotal);
                                var unpaidlines = Number(data['unpaid'][0].num);
                                console.log('unpaidlines = '+unpaidlines);
                                var newprincipalperline = unpaidprincipaltotal / unpaidlines;
                                console.log('newprincipalperline = '+newprincipalperline);
                                var length = data['lineorder'].length;
                                var runbalance = unpaidprincipaltotal;

                                for (var x=0;x<length;x++){
                                    var interest = Number(data['lineorder'][x].interest_amount);
                                    var vat = Number(data['lineorder'][x].vat_amount);
                                    var ips = Number(data['lineorder'][x].ips_amortization);
                                    var newamort = interest + vat + ips + newprincipalperline;
                                    console.log('newamort '+newamort);
                                    var amortid = data['lineorder'][x].amortization_id;
                                    console.log('amortid '+amortid);
                                    runbalance = runbalance - newamort;

                                    var data2 = new FormData();
                                    data2.append("amortization_amount", newamort);
                                    data2.append("principal_amount",newprincipalperline);
                                    data2.append("amortization_id",amortid);
                                    data2.append("outstanding_balance",runbalance);
                                    for (var pair of data2.entries()) {
                                        console.log(pair[0]+ ', ' + pair[1]); 
                                    }
                                    $.ajax({
                                        type: "POST",
                                        url:  baseurl + "collection/updateAmortizationPrincipalOnlyPayment",
                                        data: data2,
                                        cache: false,
                                        processData:false,
                                        contentType:false,
                                        success: function(result){
                                            r_vatable_amount += vat_paid;
                                            r_vat_exempt_amount = 0;
                                            r_vat_zero_rated_amount = 0;
                                            r_total_or_details = +r_vatable_amount + +r_vat_exempt_amount + +r_vat_zero_rated_amount;
                                            r_add_vat += r_total_or_details;
                                            r_surcharge_paid += 0;
                                            r_ips += 0;
                                            r_interest += 0;
                                            r_principal += principal_paid;
                                            r_total_payment_details = r_surcharge_paid + r_ips + r_interest + r_principal;
                                            r_customer_name = $('#customerName').text();
                                            r_customer_address = $('#customerAddress').text();
                                            r_customer_tin = $('#customerTIN').text();
                                            r_lot_desc = $('#lotDescription').text();
                                            r_cash_amount = Number($('#payment1').val());
                                            r_check_amount = Number($('#payment2').val());
                                            r_check_date = $('#checkDate').val();
                                            r_check_bank = $('#bank option:selected').text();;
                                            r_check_number = $('#checkNumber1').val();
                                            r_bank_amount = 0;
                                            r_bank_designated = '';
                                            r_bank_deposit_date = 0;
                                            r_cashier = '';
                                            r_total_amount = +r_cash_amount +r_check_amount +r_bank_amount;
                                            var data = new FormData();
                                            data.append("r_customer_name", r_customer_name);
                                            data.append("r_customer_address",r_customer_address);
                                            data.append("r_customer_tin",r_customer_tin);
                                            data.append("r_lot_desc",r_lot_desc);
                                            data.append("r_vatable_amount",r_vatable_amount);
                                            data.append("r_vat_exempt_amount",r_vat_exempt_amount);
                                            data.append("r_vat_zero_rated_amount",r_vat_zero_rated_amount);
                                            data.append("r_total_or_details",r_total_or_details);
                                            data.append("r_add_vat",r_add_vat);
                                            data.append("r_surcharge_paid",r_surcharge_paid);
                                            data.append("r_ips",r_ips);
                                            data.append("r_interest", r_interest);
                                            data.append("r_principal", r_principal);
                                            data.append("r_total_payment_details", r_total_payment_details);
                                            data.append("r_cash_amount", r_cash_amount);
                                            data.append("r_check_amount", r_check_amount);
                                            data.append("r_check_date", r_check_date);
                                            data.append("r_check_bank", r_check_bank);
                                            data.append("r_check_number", r_check_number);
                                            data.append("r_bank_amount", r_bank_amount);
                                            data.append("r_bank_designated", r_bank_designated);
                                            data.append("r_bank_deposit_date", r_bank_deposit_date);
                                            data.append("r_total_amount", r_total_amount);
                                            data.append("r_cashier", user_id);
                                            data.append("cashier_id",user_id);
                                            data.append("customer_id",global_customer_id);
                                            for (var pair of data.entries()) {
                                                console.log(pair[0]+ ', ' + pair[1]); 
                                            }
                                            $.ajax({
                                                url: baseurl + "collection/receipt2",
                                                type: 'POST',
                                                //contentType: "application/json; charset=utf-8",
                                                dataType: 'json',
                                                data: data,
                                                cache: false,
                                                processData:false,
                                                contentType:false,
                                                success: function(html) {
                                                    var url = baseurl + "reports/Receipt.pdf";
                                                    var win = window.open(url, '_blank');
                                                    win.focus();
                                                    //$("#receiptTrigger").trigger("click").attr("target", "_blank");     
                                                },
                                                error: function (errorThrown){
                                                    //toastr.error('Error!', 'Operation Done');
                                                    //console.log(errorThrown);
                                                }
                                            });
                                        },
                                        error: function(result){

                                        }
                                    });
                                }

                                toastr.success('Successfully Saved!', 'Operation Done');

                            },
                            error: function(data){

                            }
                        });
                    }
                }
                if ($('#paymentType').val()==4){

                    if ($('#payment3').val()=='' || $('#bank2').val()=='0' || $('#accNumber').val()=='' || $('#depositDate').val()==''){
                        if ($('#payment3').val()=='0'){
                            $('#payment3').css({"border": "1px solid red"});
                        } else {
                            $('#payment1').css({"border": ""});
                        }
                        if ($('#bank2').val()=='0'){
                            $('#bank2').css({"border": "1px solid red"});
                        } else {
                            $('#bank2').css({"border": ""});
                        }
                        if ($('#accNumber').val()=='0'){
                            $('#accNumber').css({"border": "1px solid red"});
                        } else {
                            $('#accNumber').css({"border": ""});
                        }
                        if ($('#depositDate').val()=='0'){
                            $('#depositDate').css({"border": "1px solid red"});
                        } else {
                            $('#depositDate').css({"border": ""});
                        }
                    } else {
                        var table = document.getElementById("tblamortization");
                        var tcp = parseFloat($('#tcp').text().replace(/,/g, ''));
                        var amortizationid = Number(table.rows[1].cells[0].innerHTML);
                        var contractID = table.rows[1].cells[13].innerHTML;
                        var paymentdate = $('#paymentDate').val();
                        var amount = Number($('#payment3').val());
                        var bankID = $('#bank2').val();
                        var accountnumber = $('#accNumber').val();
                        var depositdate = $('#depositDate').val();
                        var paymenttype = $('#paymentType').val();
                        var paidamount = parseFloat(table.rows[1].cells[10].innerHTML.replace(/,/g, ''));
                        var principal = parseFloat(table.rows[1].cells[11].innerHTML.replace(/,/g, ''));
                        var principal_already_paid = parseFloat(table.rows[1].cells[17].innerHTML.replace(/,/g, ''));
                        var amount2 = amount;
                        var principal2 = principal;
                        var principal_paid = 0;

                        principal2 = principal2 - principal_already_paid;

                        if(amount2 > principal2){
                            principal_paid = principal2;
                            amount2 = amount2 - principal2;
                        } else {
                            principal_paid = amount2;
                            amount2 = amount2 - amount2;
                        }

                        var data = new FormData();
                        data.append("amortization_id", amortizationid);
                        data.append("contract_id",contractID);
                        data.append("payment_date",paymentdate);
                        data.append("amount",amount);
                        data.append("account_number",accountnumber);
                        data.append("deposit_date",depositdate);
                        data.append("bank_id",bankID);
                        data.append("payment_type",paymenttype);
                        data.append("principal",principal_paid);
                        data.append("principal_paid", principal_paid);
                        data.append("cashier_id",user_id)
                        console.log("FIRST DATA PASSED: ");
                        for (var pair of data.entries()) {
                            console.log(pair[0]+ ', ' + pair[1]); 
                        }

                        $.ajax({
                            type: "POST",
                            url:  baseurl + "collection/savePaymentInterbranchPrincipalOnly",
                            dataType: 'json',
                            data: data,
                            cache: false,
                            processData:false,
                            contentType:false,
                            success: function(result){
                                
                                //console.log(data);

                                var data = jQuery.parseJSON(result);
                                var totalpaid = Number(getPayments(contractID));
                                var unpaidprincipaltotal = tcp - totalpaid;
                                console.log('unpaid principal = '+unpaidprincipaltotal);
                                var unpaidlines = Number(data['unpaid'][0].num);
                                console.log('unpaidlines = '+unpaidlines);
                                var newprincipalperline = unpaidprincipaltotal / unpaidlines;
                                console.log('newprincipalperline = '+newprincipalperline);
                                var length = data['lineorder'].length;
                                var runbalance = unpaidprincipaltotal;

                                for (var x=0;x<length;x++){
                                    var interest = Number(data['lineorder'][x].interest_amount);
                                    var vat = Number(data['lineorder'][x].vat_amount);
                                    var ips = Number(data['lineorder'][x].ips_amortization);
                                    var newamort = interest + vat + ips + newprincipalperline;
                                    console.log('newamort '+newamort);
                                    var amortid = data['lineorder'][x].amortization_id;
                                    console.log('amortid '+amortid);
                                    runbalance = runbalance - newamort;

                                    var data2 = new FormData();
                                    data2.append("amortization_amount", newamort);
                                    data2.append("principal_amount",newprincipalperline);
                                    data2.append("amortization_id",amortid);
                                    data2.append("outstanding_balance",runbalance);
                                    for (var pair of data2.entries()) {
                                        console.log(pair[0]+ ', ' + pair[1]); 
                                    }
                                    $.ajax({
                                        type: "POST",
                                        url:  baseurl + "collection/updateAmortizationPrincipalOnlyPayment",
                                        data: data2,
                                        cache: false,
                                        processData:false,
                                        contentType:false,
                                        success: function(result){
                                            r_vatable_amount += vat_paid;
                                            r_vat_exempt_amount = 0;
                                            r_vat_zero_rated_amount = 0;
                                            r_total_or_details = +r_vatable_amount + +r_vat_exempt_amount + +r_vat_zero_rated_amount;
                                            r_add_vat += r_total_or_details;
                                            r_surcharge_paid += 0;
                                            r_ips += 0;
                                            r_interest += 0;
                                            r_principal += principal_paid;
                                            r_total_payment_details = r_surcharge_paid + r_ips + r_interest + r_principal;
                                            r_customer_name = $('#customerName').text();
                                            r_customer_address = $('#customerAddress').text();
                                            r_customer_tin = $('#customerTIN').text();
                                            r_lot_desc = $('#lotDescription').text();
                                            r_cash_amount = 0;
                                            r_check_amount = 0;
                                            r_check_date = '';
                                            r_check_bank = '';
                                            r_check_number = '';
                                            r_bank_amount = Number($('#payment3').val());
                                            r_bank_designated = $('#bank option:selected').text();
                                            r_bank_deposit_date = $('#depositDate').val();
                                            r_cashier = '';
                                            r_total_amount = +r_cash_amount +r_check_amount +r_bank_amount;
                                            var data = new FormData();
                                            data.append("r_customer_name", r_customer_name);
                                            data.append("r_customer_address",r_customer_address);
                                            data.append("r_customer_tin",r_customer_tin);
                                            data.append("r_lot_desc",r_lot_desc);
                                            data.append("r_vatable_amount",r_vatable_amount);
                                            data.append("r_vat_exempt_amount",r_vat_exempt_amount);
                                            data.append("r_vat_zero_rated_amount",r_vat_zero_rated_amount);
                                            data.append("r_total_or_details",r_total_or_details);
                                            data.append("r_add_vat",r_add_vat);
                                            data.append("r_surcharge_paid",r_surcharge_paid);
                                            data.append("r_ips",r_ips);
                                            data.append("r_interest", r_interest);
                                            data.append("r_principal", r_principal);
                                            data.append("r_total_payment_details", r_total_payment_details);
                                            data.append("r_cash_amount", r_cash_amount);
                                            data.append("r_check_amount", r_check_amount);
                                            data.append("r_check_date", r_check_date);
                                            data.append("r_check_bank", r_check_bank);
                                            data.append("r_check_number", r_check_number);
                                            data.append("r_bank_amount", r_bank_amount);
                                            data.append("r_bank_designated", r_bank_designated);
                                            data.append("r_bank_deposit_date", r_bank_deposit_date);
                                            data.append("r_total_amount", r_total_amount);
                                            data.append("r_cashier", user_id);
                                            data.append("cashier_id",user_id);
                                            data.append("customer_id",global_customer_id);
                                            for (var pair of data.entries()) {
                                                console.log(pair[0]+ ', ' + pair[1]); 
                                            }
                                            $.ajax({
                                                url: baseurl + "collection/receipt2",
                                                type: 'POST',
                                                //contentType: "application/json; charset=utf-8",
                                                dataType: 'json',
                                                data: data,
                                                cache: false,
                                                processData:false,
                                                contentType:false,
                                                success: function(html) {
                                                    var url = baseurl + "reports/Receipt.pdf";
                                                    var win = window.open(url, '_blank');
                                                    win.focus();
                                                    //$("#receiptTrigger").trigger("click").attr("target", "_blank");     
                                                },
                                                error: function (errorThrown){
                                                    //toastr.error('Error!', 'Operation Done');
                                                    //console.log(errorThrown);
                                                }
                                            });
                                        },
                                        error: function(result){

                                        }
                                    });
                                }

                                toastr.success('Successfully Saved!', 'Operation Done');

                            },
                            error: function(data){

                            }
                        });
                    }
                }
            } else {
                alert("Insufficient Amount!");
            }
        } else {
            if (recomputeSurchargeLine==1){
                console.log("RECOMPUTE");
                var amountForChecking1 = $('#payment1').val();
                var amountForChecking2 = $('#payment2').val();
                var amountForChecking3 = $('#payment3').val();
                var amountForCheckingTotal = amountForChecking1 + amountForChecking2 + amountForChecking3;
                var totalForChecking = $('#total_text').text();
                //amountForChecking = parseFloat(amountForChecking.replace(/,/g, ''));
                console.log('amountForCheckingTotal = '+amountForCheckingTotal);
                console.log('totalForChecking = '+totalForChecking);
                totalForChecking = parseFloat(totalForChecking.replace(/,/g, ''));
                if(amountForCheckingTotal >= totalForChecking){
            
                    if ($('#paymentType').val()==1){
                        console.log('WEEEEEEEEEEEEEEEEEE');
                        if ($('#payment1').val()=="" || $('#paymentDate').val()==""){
                            if ($('#payment1').val()==""){
                                $('#payment1').css({"border": "1px solid red"});
                            } else {
                                $('#payment1').css({"border": ""});
                            }
                            if ($('#paymentDate').val()==""){
                                $('#paymentDate').css({"border": "1px solid red"});
                            } else {
                                $('#paymentDjate').css({"border": ""});
                            }
                        } else {
                            var table = document.getElementById("tblamortization");
                            var row = 1;
                            var amortizationid = Number(table.rows[row].cells[0].innerHTML);
                            var contractID = table.rows[row].cells[13].innerHTML;
                            var paymentdate = $('#paymentDate').val();
                            var amount = Number($('#payment1').val());
                            var paymenttype = $('#paymentType').val();
                            var paidamount = parseFloat(table.rows[row].cells[12].innerHTML.replace(/,/g, ''));
                            var amortization = parseFloat(table.rows[row].cells[4].innerHTML.replace(/,/g, ''));
                            var principal = parseFloat(table.rows[row].cells[11].innerHTML.replace(/,/g, ''));
                            var vat = parseFloat(table.rows[row].cells[6].innerHTML.replace(/,/g, ''));
                            var interest = parseFloat(table.rows[row].cells[7].innerHTML.replace(/,/g, ''));
                            var ips = parseFloat(table.rows[row].cells[8].innerHTML.replace(/,/g, ''));
                            var ipsaccrued = parseFloat(table.rows[row].cells[9].innerHTML.replace(/,/g, ''));
                            var ipsinterest = parseFloat(table.rows[row].cells[10].innerHTML.replace(/,/g, ''));
                            var surcharge = parseFloat(table.rows[row].cells[5].innerHTML.replace(/,/g, ''));
                            var amountDue = vat + ips + interest + surcharge + principal;

                            var interest_already_paid = 0;
                            var vat_already_paid = 0;
                            var surcharge_already_paid = 0;
                            var principal_already_paid = 0;
                            var ips_accrued_already_paid = 0;
                            var ips_interest_already_paid = 0;
                            var total_already_paid = 0;

                            //code for getting paid amounts
                            //for interest
                            if (table.rows[row].cells[14].innerHTML == 'null'){
                                 interest_already_paid = 0;
                            } else {
                                 interest_already_paid = parseFloat(table.rows[row].cells[14].innerHTML.replace(/,/g, ''));
                            }
                            //for vat
                            if (table.rows[row].cells[15].innerHTML == 'null'){
                                 vat_already_paid = 0;
                            } else {
                                 vat_already_paid = parseFloat(table.rows[row].cells[15].innerHTML.replace(/,/g, ''));
                            }
                            //for surcharge
                            if (table.rows[row].cells[16].innerHTML == 'null'){
                                 surcharge_already_paid = 0;
                            } else {
                                 surcharge_already_paid = parseFloat(table.rows[row].cells[16].innerHTML.replace(/,/g, ''));
                            }
                            //for principal
                            if (table.rows[row].cells[17].innerHTML == 'null'){
                                 principal_already_paid = 0;
                            } else {
                                 principal_already_paid = parseFloat(table.rows[row].cells[17].innerHTML.replace(/,/g, ''));
                            }
                            //for ips accrued
                            if (table.rows[row].cells[18].innerHTML == 'null'){
                                 ips_accrued_already_paid = 0;
                            } else {
                                 ips_accrued_already_paid = parseFloat(table.rows[row].cells[18].innerHTML.replace(/,/g, ''));
                            }
                            //for ips interest
                            if (table.rows[row].cells[18].innerHTML == 'null'){
                                 ips_interest_already_paid = 0;
                            } else {
                                 ips_interest_already_paid = parseFloat(table.rows[row].cells[18].innerHTML.replace(/,/g, ''));
                            }

                            //get sum of total paid
                            total_already_paid = interest_already_paid + vat_already_paid + surcharge_already_paid + principal_already_paid + ips_accrued_already_paid + ips_interest_already_paid;

                            //use amount2 for computations
                            var amount2 = amount;
                            //variables for paid amounts
                            var surcharge_paid = 0;
                            var principal_paid = 0;
                            var vat_paid = 0;
                            var interest_paid = 0;
                            var ips_accrued_paid = 0;
                            var ips_interest_paid = 0;
                            var ips_paid = ips_accrued_paid + ips_interest_paid;
                            var total_paid = 0;
                            var sundry = 0;

                            //deduct the dues with the already paid
                            surcharge = surcharge - surcharge_already_paid;
                            principal = principal - principal_already_paid;
                            vat = vat - vat_already_paid;
                            interest = interest - interest_already_paid;
                            ipsaccrued = ipsaccrued - ips_accrued_already_paid;
                            ipsinterest = ipsinterest - ips_interest_already_paid;

                            //computation for deduction in each payments
                            //if amount is greater than principal to pay, principal paid = principal to pay

                            //surcharge deduction
                            if(amount2 > surcharge){
                                 surcharge_paid = surcharge;
                                 amount2 = amount2 - surcharge;
                            } else {
                                 surcharge_paid = amount2;
                                 amount2 = amount2 - amount2;
                            }
                            console.log("amount2 after surcharge deduction = "+amount2);
                            //principal deduction
                            if(amount2 > principal){
                                 principal_paid = principal;
                                 amount2 = amount2 - principal;
                            } else {
                                 principal_paid = amount2;
                                 amount2 = amount2 - amount2;
                            }
                            console.log("amount2 after principal deduction = "+amount2);
                            //vat deduction
                            if(amount2 > vat){
                                 vat_paid = vat;
                                 amount2 = amount2 - vat;
                            } else {
                                 vat_paid = amount2;
                                 amount2 = amount2 - amount2;
                            }
                            console.log("amount2 after vat deduction = "+amount2);
                            //ips accrued deduction
                            if(amount2 > ipsaccrued){
                                 ips_accrued_paid = ipsaccrued;
                                 amount2 = amount2 - ipsaccrued;
                            } else {
                                 ips_accrued_paid = amount2;
                                 amount2 = amount2 - amount2;
                            }
                            console.log("amount2 after ips accrued deduction = "+amount2);
                            //ips accrued deduction
                            if(amount2 > ipsaccrued){
                                 ips_interest_paid = ipsinterest;
                                 amount2 = amount2 - ipsinterest;
                            } else {
                                 ips_interest_paid = amount2;
                                 amount2 = amount2 - amount2;
                            }
                            console.log("amount2 after ips interest deduction = "+amount2);
                            //interest deduction
                            if(amount2 > interest){
                                 interest_paid = interest;
                                 amount2 = amount2 - interest;
                            } else {
                                 interest_paid = amount2;
                                 amount2 = amount2 - amount2;
                            }
                            console.log("amount2 after interest deduction = "+amount2);
                            total_paid = surcharge_paid + principal_paid + vat_paid + ips_accrued_paid + ips_interest_paid + interest_paid;

                            var balance = 0;
                            var paiup;
                            var total_all_the_paid = total_already_paid + total_paid;

                            balance = amountDue - total_all_the_paid;
                            balance = parseFloat(Math.round(balance * 100) / 100).toFixed(2);

                            //check if there is still balance, if none then paidup = 1
                            if(balance > 0){
                                 paidup = 0;
                            } else {
                                 paidup = 1;
                            }

                            //add the already paid and paid now
                            var surcharge_total = surcharge_paid + surcharge_already_paid;
                            var principal_total = principal_paid + principal_already_paid;
                            var vat_total = vat_paid + vat_already_paid;
                            var interest_total = interest_paid + interest_already_paid;
                            var ips_accrued_total = ips_accrued_paid + ips_accrued_already_paid;
                            var ips_interest_total = ips_interest_paid + ips_interest_already_paid;
                            var ips_total = ips_accrued_total + ips_interest_total;

                            r_vatable_amount += vat_paid;
                            r_vat_exempt_amount = 0;
                            r_vat_zero_rated_amount = 0;
                            r_total_or_details = +r_vatable_amount + +r_vat_exempt_amount + +r_vat_zero_rated_amount;
                            r_add_vat += r_total_or_details;
                            r_surcharge_paid += surcharge_paid;
                            r_ips = ips_accrued_paid + ips_interest_paid;
                            r_interest += interest_paid;
                            r_principal += principal_paid;
                            r_total_payment_details = r_surcharge_paid + r_ips + r_interest + r_principal;

                            var contractStatus = checkContractStatus(contractID,total_all_the_paid);

                            console.log("amount2 after payment = "+amount2);

                            var data = new FormData();
                            data.append("amortization_id", amortizationid);
                            data.append("contract_id",contractID);
                            data.append("payment_date",paymentdate);
                            data.append("amount",total_paid);
                            data.append("payment_type",paymenttype);
                            data.append("principal",principal);
                            data.append("interest",interest);
                            data.append("surcharge",surcharge);
                            data.append("sundry",sundry);
                            data.append("paid_up",paidup);
                            data.append("balance",balance);
                            data.append("surcharge_paid", surcharge_paid);
                            data.append("principal_paid", principal_paid);
                            data.append("vat_paid", vat_paid);
                            data.append("interest_paid", interest_paid);
                            data.append("ips_accrued_paid", ips_accrued_paid);
                            data.append("ips_interest_paid", ips_interest_paid);
                            data.append("surcharge_total", surcharge_total);
                            data.append("principal_total", principal_total);
                            data.append("vat_total", vat_total);
                            data.append("interest_total", interest_total);
                            data.append("ips_accrued_total", ips_accrued_total);
                            data.append("ips_interest_total", ips_interest_total);
                            data.append("contract_status_id", contractStatus);
                            data.append("cashier_id",user_id);
                            console.log("FIRST DATA PASSED: ");
                            for (var pair of data.entries()) {
                                console.log(pair[0]+ ', ' + pair[1]); 
                            }
                            $.ajax({
                                type: "POST",
                                url:  baseurl + "collection/updateContractAndAmortizationLine",
                                data: data,
                                cache: false,
                                processData:false,
                                contentType:false,
                                success: function(data){
                                    toastr.success('Successfully Saved!', 'Operation Done');
                                    console.log(data);

                                    row++;

                                    var table_row_length = table.rows.length;
                                    table_row_length = table_row_length - 1;

                                    if (amount2 > 0){
                                        console.log('doing payment');
                                        console.log('amount 2 = '+amount2);
                                        console.log('contractID = '+contractID);
                                        console.log('table_row_length = '+table_row_length);
                                        console.log('row = '+row);
                                        handlePaymentCash2(amount2,contractID,table_row_length,row);
                                    } else {

// CHECK HERE
                                        receiptCash(contractID,amortizationid);
                                    }
                                },
                                error: function (errorThrown){
                                    //toastr.error('Error!', 'Operation Done');
                                    //console.log(errorThrown);
                                }
                            });
                        }
                    //event.preventDefault();

                    }
                    if ($('#paymentType').val()==2){
                        // alert('Check');

                        if ($('#bank').val()=='0' || $('#payment2').val()=="" || $('#checkNumber1').val()=="" || $('#checkDate').val()==""){
                            if ($('#bank').val()=='0'){
                                $('#bank').css({"border": "1px solid red"});
                            } else {
                                $('#bank').css({"border": ""});
                            }
                            if ($('#payment2').val()==0){
                                $('#payment2').css({"border": "1px solid red"});
                            } else {
                                $('#payment2').css({"border": ""});
                            }
                            if ($('#checkNumber1').val()==0){
                                $('#checkNumber1').css({"border": "1px solid red"});
                            } else {
                                $('#checkNumber1').css({"border": ""});
                            }
                            if ($('#checkDate').val()==0){
                                $('#checkDate').css({"border": "1px solid red"});
                            } else {
                                $('#checkDate').css({"border": ""});
                            }

                        } else {
                            var table = document.getElementById("tblamortization");
                            var row = 1;
                            var amortizationid = Number(table.rows[row].cells[0].innerHTML);
                            var contractID = table.rows[row].cells[13].innerHTML;
                            var paymentdate = $('#paymentDate').val();
                            var amount = Number($('#payment2').val());
                            var paymenttype = $('#paymentType').val();
                            var paidamount = parseFloat(table.rows[row].cells[12].innerHTML.replace(/,/g, ''));
                            var amortization = parseFloat(table.rows[row].cells[4].innerHTML.replace(/,/g, ''));
                            var principal = parseFloat(table.rows[row].cells[11].innerHTML.replace(/,/g, ''));
                            var vat = parseFloat(table.rows[row].cells[6].innerHTML.replace(/,/g, ''));
                            var interest = parseFloat(table.rows[row].cells[7].innerHTML.replace(/,/g, ''));
                            var ips = parseFloat(table.rows[row].cells[8].innerHTML.replace(/,/g, ''));
                            var ipsaccrued = parseFloat(table.rows[row].cells[9].innerHTML.replace(/,/g, ''));
                            var ipsinterest = parseFloat(table.rows[row].cells[10].innerHTML.replace(/,/g, ''));
                            var surcharge = parseFloat(table.rows[row].cells[5].innerHTML.replace(/,/g, ''));
                            var amountDue = vat + ips + interest + surcharge + principal;

                            var interest_already_paid = 0;
                            var vat_already_paid = 0;
                            var surcharge_already_paid = 0;
                            var principal_already_paid = 0;
                            var ips_accrued_already_paid = 0;
                            var ips_interest_already_paid = 0;
                            var total_already_paid = 0;

                            //code for getting paid amounts
                            //for interest
                            if (table.rows[row].cells[14].innerHTML == 'null'){
                                 interest_already_paid = 0;
                            } else {
                                 interest_already_paid = parseFloat(table.rows[row].cells[14].innerHTML.replace(/,/g, ''));
                            }
                            //for vat
                            if (table.rows[row].cells[15].innerHTML == 'null'){
                                 vat_already_paid = 0;
                            } else {
                                 vat_already_paid = parseFloat(table.rows[row].cells[15].innerHTML.replace(/,/g, ''));
                            }
                            //for surcharge
                            if (table.rows[row].cells[16].innerHTML == 'null'){
                                 surcharge_already_paid = 0;
                            } else {
                                 surcharge_already_paid = parseFloat(table.rows[row].cells[16].innerHTML.replace(/,/g, ''));
                            }
                            //for principal
                            if (table.rows[row].cells[17].innerHTML == 'null'){
                                 principal_already_paid = 0;
                            } else {
                                 principal_already_paid = parseFloat(table.rows[row].cells[17].innerHTML.replace(/,/g, ''));
                            }
                            //for ips accrued
                            if (table.rows[row].cells[18].innerHTML == 'null'){
                                 ips_accrued_already_paid = 0;
                            } else {
                                 ips_accrued_already_paid = parseFloat(table.rows[row].cells[18].innerHTML.replace(/,/g, ''));
                            }
                            //for ips interest
                            if (table.rows[row].cells[18].innerHTML == 'null'){
                                 ips_interest_already_paid = 0;
                            } else {
                                 ips_interest_already_paid = parseFloat(table.rows[row].cells[18].innerHTML.replace(/,/g, ''));
                            }

                            //get sum of total paid
                            total_already_paid = interest_already_paid + vat_already_paid + surcharge_already_paid + principal_already_paid + ips_accrued_already_paid + ips_interest_already_paid;

                            //use amount2 for computations
                            var amount2 = amount;
                            //variables for paid amounts
                            var surcharge_paid = 0;
                            var principal_paid = 0;
                            var vat_paid = 0;
                            var interest_paid = 0;
                            var ips_accrued_paid = 0;
                            var ips_interest_paid = 0;
                            var total_paid = 0;
                            var sundry = 0;

                            //deduct the dues with the already paid
                            surcharge = surcharge - surcharge_already_paid;
                            principal = principal - principal_already_paid;
                            vat = vat - vat_already_paid;
                            interest = interest - interest_already_paid;
                            ipsaccrued = ipsaccrued - ips_accrued_already_paid;
                            ipsinterest = ipsinterest - ips_interest_already_paid;

                            //computation for deduction in each payments
                            //if amount is greater than principal to pay, principal paid = principal to pay

                            //surcharge deduction
                            if(amount2 > surcharge){
                                 surcharge_paid = surcharge;
                                 amount2 = amount2 - surcharge;
                            } else {
                                 surcharge_paid = amount2;
                                 amount2 = amount2 - amount2;
                            }
                            console.log("amount2 after surcharge deduction = "+amount2);
                            //principal deduction
                            if(amount2 > principal){
                                 principal_paid = principal;
                                 amount2 = amount2 - principal;
                            } else {
                                 principal_paid = amount2;
                                 amount2 = amount2 - amount2;
                            }
                            console.log("amount2 after principal deduction = "+amount2);
                            //vat deduction
                            if(amount2 > vat){
                                 vat_paid = vat;
                                 amount2 = amount2 - vat;
                            } else {
                                 vat_paid = amount2;
                                 amount2 = amount2 - amount2;
                            }
                            console.log("amount2 after vat deduction = "+amount2);
                            //ips accrued deduction
                            if(amount2 > ipsaccrued){
                                 ips_accrued_paid = ipsaccrued;
                                 amount2 = amount2 - ipsaccrued;
                            } else {
                                 ips_accrued_paid = amount2;
                                 amount2 = amount2 - amount2;
                            }
                            console.log("amount2 after ips accrued deduction = "+amount2);
                            //ips accrued deduction
                            if(amount2 > ipsaccrued){
                                 ips_interest_paid = ipsinterest;
                                 amount2 = amount2 - ipsinterest;
                            } else {
                                 ips_interest_paid = amount2;
                                 amount2 = amount2 - amount2;
                            }
                            console.log("amount2 after ips interest deduction = "+amount2);
                            //interest deduction
                            if(amount2 > interest){
                                 interest_paid = interest;
                                 amount2 = amount2 - interest;
                            } else {
                                 interest_paid = amount2;
                                 amount2 = amount2 - amount2;
                            }
                            console.log("amount2 after interest deduction = "+amount2);
                            total_paid = surcharge_paid + principal_paid + vat_paid + ips_accrued_paid + ips_interest_paid + interest_paid;

                            var balance = 0;
                            var paiup;
                            var total_all_the_paid = total_already_paid + total_paid;

                            balance = amountDue - total_all_the_paid;
                            balance = parseFloat(Math.round(balance * 100) / 100).toFixed(2);

                            //check if there is still balance, if none then paidup = 1
                            if(balance > 0){
                                 paidup = 0;
                            } else {
                                 paidup = 1;
                            }

                            //add the already paid and paid now
                            var surcharge_total = surcharge_paid + surcharge_already_paid;
                            var principal_total = principal_paid + principal_already_paid;
                            var vat_total = vat_paid + vat_already_paid;
                            var interest_total = interest_paid + interest_already_paid;
                            var ips_accrued_total = ips_accrued_paid + ips_accrued_already_paid;
                            var ips_interest_total = ips_interest_paid + ips_interest_already_paid;
                            var ips_total = ips_accrued_total + ips_interest_total;

                            r_vatable_amount += vat_paid;
                            r_vat_exempt_amount = 0;
                            r_vat_zero_rated_amount = 0;
                            r_total_or_details = +r_vatable_amount + +r_vat_exempt_amount + +r_vat_zero_rated_amount;
                            r_add_vat += r_total_or_details;
                            r_surcharge_paid += surcharge_paid;
                            r_ips = ips_accrued_paid + ips_interest_paid;
                            r_interest += interest_paid;
                            r_principal += principal_paid;
                            r_total_payment_details = r_surcharge_paid + r_ips + r_interest + r_principal;

                            var contractStatus = checkContractStatus(contractID,total_all_the_paid);

                            console.log("amount2 after payment = "+amount2);

                            var data = new FormData();
                            data.append("amortization_id", amortizationid);
                            data.append("contract_id",contractID);
                            data.append("payment_date",paymentdate);
                            data.append("amount",total_paid);
                            data.append("payment_type",paymenttype);
                            data.append("principal",principal);
                            data.append("interest",interest);
                            data.append("surcharge",surcharge);
                            data.append("sundry",sundry);
                            data.append("paid_up",paidup);
                            data.append("balance",balance);
                            data.append("surcharge_paid", surcharge_paid);
                            data.append("principal_paid", principal_paid);
                            data.append("vat_paid", vat_paid);
                            data.append("interest_paid", interest_paid);
                            data.append("ips_accrued_paid", ips_accrued_paid);
                            data.append("ips_interest_paid", ips_interest_paid);
                            data.append("surcharge_total", surcharge_total);
                            data.append("principal_total", principal_total);
                            data.append("vat_total", vat_total);
                            data.append("interest_total", interest_total);
                            data.append("ips_accrued_total", ips_accrued_total);
                            data.append("ips_interest_total", ips_interest_total);
                            data.append("contract_status_id", contractStatus);
                            data.append("cashier_id",user_id);
                            console.log("FIRST DATA PASSED: ");
                            for (var pair of data.entries()) {
                                console.log(pair[0]+ ', ' + pair[1]); 
                            }
                            $.ajax({
                                type: "POST",
                                url:  baseurl + "collection/updateContractAndAmortizationLine",
                                data: data,
                                cache: false,
                                processData:false,
                                contentType:false,
                                success: function(data){
                                    toastr.success('Successfully Saved!', 'Operation Done');
                                    console.log(data);

                                    row++;

                                    var table_row_length = table.rows.length;
                                    table_row_length = table_row_length - 1;

                                    if (amount2 > 0){
                                        console.log('doing payment');
                                        console.log('amount 2 = '+amount2);
                                        console.log('contractID = '+contractID);
                                        console.log('table_row_length = '+table_row_length);
                                        console.log('row = '+row);
                                        handlePaymentCheck2(amount2,contractID,table_row_length,row);
                                    } else {
                                        receiptCheck(contractID,amortizationid);
                                    }
                                },
                                error: function (errorThrown){
                                    //toastr.error('Error!', 'Operation Done');
                                    //console.log(errorThrown);
                                }
                            });

                        }
                    //event.preventDefault();
                    }

                    if ($('#paymentType').val()==3){
                        // alert('Cash and Check');

                        if ($('#bank').val()=='0' || $('#payment2').val()=="" || $('#checkNumber1').val()=="" || $('#checkDate').val()=="" || $('#payment1').val()==""){
                            if ($('#bank').val()=='0'){
                                $('#bank').css({"border": "1px solid red"});
                            } else {
                                $('#bank').css({"border": ""});
                            }
                            if ($('#payment2').val()==0){
                                $('#payment2').css({"border": "1px solid red"});
                            } else {
                                $('#payment2').css({"border": ""});
                            }
                            if ($('#checkNumber1').val()==0){
                                $('#checkNumber1').css({"border": "1px solid red"});
                            } else {
                                $('#checkNumber1').css({"border": ""});
                            }
                            if ($('#checkDate').val()==0){
                                $('#checkDate').css({"border": "1px solid red"});
                            } else {
                                $('#checkDate').css({"border": ""});
                            }
                            if ($('#payment1').val()==0){
                                $('#payment1').css({"border": "1px solid red"});
                            } else {
                                $('#payment1').css({"border": ""});
                            }

                        } else {
                            var table = document.getElementById("tblamortization");
                            var row = 1;
                            var amortizationid = Number(table.rows[row].cells[0].innerHTML);
                            var contractID = table.rows[row].cells[13].innerHTML;
                            var paymentdate = $('#paymentDate').val();
                            var amountCash = Number($('#payment1').val());
                            var amountCheck = Number($('#payment2').val());
                            var amount = amountCash + amountCheck;
                            var paymenttype = $('#paymentType').val();
                            var paidamount = parseFloat(table.rows[row].cells[12].innerHTML.replace(/,/g, ''));
                            var amortization = parseFloat(table.rows[row].cells[4].innerHTML.replace(/,/g, ''));
                            var principal = parseFloat(table.rows[row].cells[11].innerHTML.replace(/,/g, ''));
                            var vat = parseFloat(table.rows[row].cells[6].innerHTML.replace(/,/g, ''));
                            var interest = parseFloat(table.rows[row].cells[7].innerHTML.replace(/,/g, ''));
                            var ips = parseFloat(table.rows[row].cells[8].innerHTML.replace(/,/g, ''));
                            var ipsaccrued = parseFloat(table.rows[row].cells[9].innerHTML.replace(/,/g, ''));
                            var ipsinterest = parseFloat(table.rows[row].cells[10].innerHTML.replace(/,/g, ''));
                            var surcharge = parseFloat(table.rows[row].cells[5].innerHTML.replace(/,/g, ''));
                            var amountDue = vat + ips + interest + surcharge + principal;

                            var interest_already_paid = 0;
                            var vat_already_paid = 0;
                            var surcharge_already_paid = 0;
                            var principal_already_paid = 0;
                            var ips_accrued_already_paid = 0;
                            var ips_interest_already_paid = 0;
                            var total_already_paid = 0;

                            //code for getting paid amounts
                            //for interest
                            if (table.rows[row].cells[14].innerHTML == 'null'){
                                 interest_already_paid = 0;
                            } else {
                                 interest_already_paid = parseFloat(table.rows[row].cells[14].innerHTML.replace(/,/g, ''));
                            }
                            //for vat
                            if (table.rows[row].cells[15].innerHTML == 'null'){
                                 vat_already_paid = 0;
                            } else {
                                 vat_already_paid = parseFloat(table.rows[row].cells[15].innerHTML.replace(/,/g, ''));
                            }
                            //for surcharge
                            if (table.rows[row].cells[16].innerHTML == 'null'){
                                 surcharge_already_paid = 0;
                            } else {
                                 surcharge_already_paid = parseFloat(table.rows[row].cells[16].innerHTML.replace(/,/g, ''));
                            }
                            //for principal
                            if (table.rows[row].cells[17].innerHTML == 'null'){
                                 principal_already_paid = 0;
                            } else {
                                 principal_already_paid = parseFloat(table.rows[row].cells[17].innerHTML.replace(/,/g, ''));
                            }
                            //for ips accrued
                            if (table.rows[row].cells[18].innerHTML == 'null'){
                                 ips_accrued_already_paid = 0;
                            } else {
                                 ips_accrued_already_paid = parseFloat(table.rows[row].cells[18].innerHTML.replace(/,/g, ''));
                            }
                            //for ips interest
                            if (table.rows[row].cells[18].innerHTML == 'null'){
                                 ips_interest_already_paid = 0;
                            } else {
                                 ips_interest_already_paid = parseFloat(table.rows[row].cells[18].innerHTML.replace(/,/g, ''));
                            }

                            //get sum of total paid
                            total_already_paid = interest_already_paid + vat_already_paid + surcharge_already_paid + principal_already_paid + ips_accrued_already_paid + ips_interest_already_paid;

                            //use amount2 for computations
                            var amount2 = amount;
                            //variables for paid amounts
                            var surcharge_paid = 0;
                            var principal_paid = 0;
                            var vat_paid = 0;
                            var interest_paid = 0;
                            var ips_accrued_paid = 0;
                            var ips_interest_paid = 0;
                            var total_paid = 0;
                            var sundry = 0;

                            //deduct the dues with the already paid
                            surcharge = surcharge - surcharge_already_paid;
                            principal = principal - principal_already_paid;
                            vat = vat - vat_already_paid;
                            interest = interest - interest_already_paid;
                            ipsaccrued = ipsaccrued - ips_accrued_already_paid;
                            ipsinterest = ipsinterest - ips_interest_already_paid;

                            //computation for deduction in each payments
                            //if amount is greater than principal to pay, principal paid = principal to pay

                            //surcharge deduction
                            if(amount2 > surcharge){
                                 surcharge_paid = surcharge;
                                 amount2 = amount2 - surcharge;
                            } else {
                                 surcharge_paid = amount2;
                                 amount2 = amount2 - amount2;
                            }
                            console.log("amount2 after surcharge deduction = "+amount2);
                            //principal deduction
                            if(amount2 > principal){
                                 principal_paid = principal;
                                 amount2 = amount2 - principal;
                            } else {
                                 principal_paid = amount2;
                                 amount2 = amount2 - amount2;
                            }
                            console.log("amount2 after principal deduction = "+amount2);
                            //vat deduction
                            if(amount2 > vat){
                                 vat_paid = vat;
                                 amount2 = amount2 - vat;
                            } else {
                                 vat_paid = amount2;
                                 amount2 = amount2 - amount2;
                            }
                            console.log("amount2 after vat deduction = "+amount2);
                            //ips accrued deduction
                            if(amount2 > ipsaccrued){
                                 ips_accrued_paid = ipsaccrued;
                                 amount2 = amount2 - ipsaccrued;
                            } else {
                                 ips_accrued_paid = amount2;
                                 amount2 = amount2 - amount2;
                            }
                            console.log("amount2 after ips accrued deduction = "+amount2);
                            //ips accrued deduction
                            if(amount2 > ipsaccrued){
                                 ips_interest_paid = ipsinterest;
                                 amount2 = amount2 - ipsinterest;
                            } else {
                                 ips_interest_paid = amount2;
                                 amount2 = amount2 - amount2;
                            }
                            console.log("amount2 after ips interest deduction = "+amount2);
                            //interest deduction
                            if(amount2 > interest){
                                 interest_paid = interest;
                                 amount2 = amount2 - interest;
                            } else {
                                 interest_paid = amount2;
                                 amount2 = amount2 - amount2;
                            }
                            console.log("amount2 after interest deduction = "+amount2);
                            total_paid = surcharge_paid + principal_paid + vat_paid + ips_accrued_paid + ips_interest_paid + interest_paid;

                            var balance = 0;
                            var paiup;
                            var total_all_the_paid = total_already_paid + total_paid;

                            balance = amountDue - total_all_the_paid;
                            balance = parseFloat(Math.round(balance * 100) / 100).toFixed(2);

                            //check if there is still balance, if none then paidup = 1
                            if(balance > 0){
                                 paidup = 0;
                            } else {
                                 paidup = 1;
                            }

                            //add the already paid and paid now
                            var surcharge_total = surcharge_paid + surcharge_already_paid;
                            var principal_total = principal_paid + principal_already_paid;
                            var vat_total = vat_paid + vat_already_paid;
                            var interest_total = interest_paid + interest_already_paid;
                            var ips_accrued_total = ips_accrued_paid + ips_accrued_already_paid;
                            var ips_interest_total = ips_interest_paid + ips_interest_already_paid;
                            var ips_total = ips_accrued_total + ips_interest_total;

                            r_vatable_amount += vat_paid;
                            r_vat_exempt_amount = 0;
                            r_vat_zero_rated_amount = 0;
                            r_total_or_details = +r_vatable_amount + +r_vat_exempt_amount + +r_vat_zero_rated_amount;
                            r_add_vat += r_total_or_details;
                            r_surcharge_paid += surcharge_paid;
                            r_ips = ips_accrued_paid + ips_interest_paid;
                            r_interest += interest_paid;
                            r_principal += principal_paid;
                            r_total_payment_details = r_surcharge_paid + r_ips + r_interest + r_principal;

                            var contractStatus = checkContractStatus(contractID,total_all_the_paid);

                            console.log("amount2 after payment = "+amount2);

                            var data = new FormData();
                            data.append("amortization_id", amortizationid);
                            data.append("contract_id",contractID);
                            data.append("payment_date",paymentdate);
                            data.append("amount",total_paid);
                            data.append("payment_type",paymenttype);
                            data.append("principal",principal);
                            data.append("interest",interest);
                            data.append("surcharge",surcharge);
                            data.append("sundry",sundry);
                            data.append("paid_up",paidup);
                            data.append("balance",balance);
                            data.append("surcharge_paid", surcharge_paid);
                            data.append("principal_paid", principal_paid);
                            data.append("vat_paid", vat_paid);
                            data.append("interest_paid", interest_paid);
                            data.append("ips_accrued_paid", ips_accrued_paid);
                            data.append("ips_interest_paid", ips_interest_paid);
                            data.append("surcharge_total", surcharge_total);
                            data.append("principal_total", principal_total);
                            data.append("vat_total", vat_total);
                            data.append("interest_total", interest_total);
                            data.append("ips_accrued_total", ips_accrued_total);
                            data.append("ips_interest_total", ips_interest_total);
                            data.append("contract_status_id", contractStatus);
                            data.append("cashier_id",user_id)
                            console.log("FIRST DATA PASSED: ");
                            for (var pair of data.entries()) {
                                console.log(pair[0]+ ', ' + pair[1]); 
                            }
                            $.ajax({
                                type: "POST",
                                url:  baseurl + "collection/updateContractAndAmortizationLine",
                                data: data,
                                cache: false,
                                processData:false,
                                contentType:false,
                                success: function(data){
                                    toastr.success('Successfully Saved!', 'Operation Done');
                                    console.log(data);

                                    row++;

                                    var table_row_length = table.rows.length;
                                    table_row_length = table_row_length - 1;

                                    if (amount2 > 0){
                                        console.log('doing payment');
                                        console.log('amount 2 = '+amount2);
                                        console.log('contractID = '+contractID);
                                        console.log('table_row_length = '+table_row_length);
                                        console.log('row = '+row);
                                        handlePaymentCashAndCheck2(amount2,contractID,table_row_length,row);
                                    } else {
                                        receiptCashAndCheck(contractID,amortizationid);
                                    }
                                },
                                error: function (errorThrown){
                                    //toastr.error('Error!', 'Operation Done');
                                    //console.log(errorThrown);
                                }
                            });
                            //event.preventDefault();
                        }
                    }

                    if ($('#paymentType').val()==4){

                        if ($('#payment3').val()=='' || $('#bank2').val()=='0' || $('#accNumber').val()=='' || $('#depositDate').val()==''){
                            if ($('#payment3').val()=='0'){
                                $('#payment3').css({"border": "1px solid red"});
                            } else {
                                $('#payment1').css({"border": ""});
                            }
                            if ($('#bank2').val()=='0'){
                                $('#bank2').css({"border": "1px solid red"});
                            } else {
                                $('#bank2').css({"border": ""});
                            }
                            if ($('#accNumber').val()=='0'){
                                $('#accNumber').css({"border": "1px solid red"});
                            } else {
                                $('#accNumber').css({"border": ""});
                            }
                            if ($('#depositDate').val()=='0'){
                                $('#depositDate').css({"border": "1px solid red"});
                            } else {
                                $('#depositDate').css({"border": ""});
                            }
                        } else {
                            var table = document.getElementById("tblamortization");
                            var row = 1;
                            var amortizationid = Number(table.rows[row].cells[0].innerHTML);
                            var contractID = table.rows[row].cells[13].innerHTML;
                            var paymentdate = $('#paymentDate').val();
                            var amount = Number($('#payment3').val());
                            var bankID = $('#bank2').val();
                            var accountnumber = $('#accNumber').val();
                            var depositdate = $('#depositDate').val();
                            var paymenttype = $('#paymentType').val();
                            var paidamount = parseFloat(table.rows[row].cells[12].innerHTML.replace(/,/g, ''));
                            var amortization = parseFloat(table.rows[row].cells[4].innerHTML.replace(/,/g, ''));
                            var principal = parseFloat(table.rows[row].cells[11].innerHTML.replace(/,/g, ''));
                            var vat = parseFloat(table.rows[row].cells[6].innerHTML.replace(/,/g, ''));
                            var interest = parseFloat(table.rows[row].cells[7].innerHTML.replace(/,/g, ''));
                            var ips = parseFloat(table.rows[row].cells[8].innerHTML.replace(/,/g, ''));
                            var ipsaccrued = parseFloat(table.rows[row].cells[9].innerHTML.replace(/,/g, ''));
                            var ipsinterest = parseFloat(table.rows[row].cells[10].innerHTML.replace(/,/g, ''));
                            var surcharge = parseFloat(table.rows[row].cells[5].innerHTML.replace(/,/g, ''));
                            var amountDue = vat + ips + interest + surcharge + principal;

                            var interest_already_paid = 0;
                            var vat_already_paid = 0;
                            var surcharge_already_paid = 0;
                            var principal_already_paid = 0;
                            var ips_accrued_already_paid = 0;
                            var ips_interest_already_paid = 0;
                            var total_already_paid = 0;

                            //code for getting paid amounts
                            //for interest
                            if (table.rows[row].cells[14].innerHTML == 'null'){
                                 interest_already_paid = 0;
                            } else {
                                 interest_already_paid = parseFloat(table.rows[row].cells[14].innerHTML.replace(/,/g, ''));
                            }
                            //for vat
                            if (table.rows[row].cells[15].innerHTML == 'null'){
                                 vat_already_paid = 0;
                            } else {
                                 vat_already_paid = parseFloat(table.rows[row].cells[15].innerHTML.replace(/,/g, ''));
                            }
                            //for surcharge
                            if (table.rows[row].cells[16].innerHTML == 'null'){
                                 surcharge_already_paid = 0;
                            } else {
                                 surcharge_already_paid = parseFloat(table.rows[row].cells[16].innerHTML.replace(/,/g, ''));
                            }
                            //for principal
                            if (table.rows[row].cells[17].innerHTML == 'null'){
                                 principal_already_paid = 0;
                            } else {
                                 principal_already_paid = parseFloat(table.rows[row].cells[17].innerHTML.replace(/,/g, ''));
                            }
                            //for ips accrued
                            if (table.rows[row].cells[18].innerHTML == 'null'){
                                 ips_accrued_already_paid = 0;
                            } else {
                                 ips_accrued_already_paid = parseFloat(table.rows[row].cells[18].innerHTML.replace(/,/g, ''));
                            }
                            //for ips interest
                            if (table.rows[row].cells[18].innerHTML == 'null'){
                                 ips_interest_already_paid = 0;
                            } else {
                                 ips_interest_already_paid = parseFloat(table.rows[row].cells[18].innerHTML.replace(/,/g, ''));
                            }

                            //get sum of total paid
                            total_already_paid = interest_already_paid + vat_already_paid + surcharge_already_paid + principal_already_paid + ips_accrued_already_paid + ips_interest_already_paid;

                            //use amount2 for computations
                            var amount2 = amount;
                            //variables for paid amounts
                            var surcharge_paid = 0;
                            var principal_paid = 0;
                            var vat_paid = 0;
                            var interest_paid = 0;
                            var ips_accrued_paid = 0;
                            var ips_interest_paid = 0;
                            var total_paid = 0;
                            var sundry = 0;

                            //deduct the dues with the already paid
                            surcharge = surcharge - surcharge_already_paid;
                            principal = principal - principal_already_paid;
                            vat = vat - vat_already_paid;
                            interest = interest - interest_already_paid;
                            ipsaccrued = ipsaccrued - ips_accrued_already_paid;
                            ipsinterest = ipsinterest - ips_interest_already_paid;

                            //computation for deduction in each payments
                            //if amount is greater than principal to pay, principal paid = principal to pay

                            //surcharge deduction
                            if(amount2 > surcharge){
                                 surcharge_paid = surcharge;
                                 amount2 = amount2 - surcharge;
                            } else {
                                 surcharge_paid = amount2;
                                 amount2 = amount2 - amount2;
                            }
                            console.log("amount2 after surcharge deduction = "+amount2);
                            //principal deduction
                            if(amount2 > principal){
                                 principal_paid = principal;
                                 amount2 = amount2 - principal;
                            } else {
                                 principal_paid = amount2;
                                 amount2 = amount2 - amount2;
                            }
                            console.log("amount2 after principal deduction = "+amount2);
                            //vat deduction
                            if(amount2 > vat){
                                 vat_paid = vat;
                                 amount2 = amount2 - vat;
                            } else {
                                 vat_paid = amount2;
                                 amount2 = amount2 - amount2;
                            }
                            console.log("amount2 after vat deduction = "+amount2);
                            //ips accrued deduction
                            if(amount2 > ipsaccrued){
                                 ips_accrued_paid = ipsaccrued;
                                 amount2 = amount2 - ipsaccrued;
                            } else {
                                 ips_accrued_paid = amount2;
                                 amount2 = amount2 - amount2;
                            }
                            console.log("amount2 after ips accrued deduction = "+amount2);
                            //ips accrued deduction
                            if(amount2 > ipsaccrued){
                                 ips_interest_paid = ipsinterest;
                                 amount2 = amount2 - ipsinterest;
                            } else {
                                 ips_interest_paid = amount2;
                                 amount2 = amount2 - amount2;
                            }
                            console.log("amount2 after ips interest deduction = "+amount2);
                            //interest deduction
                            if(amount2 > interest){
                                 interest_paid = interest;
                                 amount2 = amount2 - interest;
                            } else {
                                 interest_paid = amount2;
                                 amount2 = amount2 - amount2;
                            }
                            console.log("amount2 after interest deduction = "+amount2);
                            total_paid = surcharge_paid + principal_paid + vat_paid + ips_accrued_paid + ips_interest_paid + interest_paid;

                            var balance = 0;
                            var paiup;
                            var total_all_the_paid = total_already_paid + total_paid;

                            balance = amountDue - total_all_the_paid;
                            balance = parseFloat(Math.round(balance * 100) / 100).toFixed(2);

                            //check if there is still balance, if none then paidup = 1
                            if(balance > 0){
                                 paidup = 0;
                            } else {
                                 paidup = 1;
                            }

                            //add the already paid and paid now
                            var surcharge_total = surcharge_paid + surcharge_already_paid;
                            var principal_total = principal_paid + principal_already_paid;
                            var vat_total = vat_paid + vat_already_paid;
                            var interest_total = interest_paid + interest_already_paid;
                            var ips_accrued_total = ips_accrued_paid + ips_accrued_already_paid;
                            var ips_interest_total = ips_interest_paid + ips_interest_already_paid;
                            var ips_total = ips_accrued_total + ips_interest_total;

                            r_vatable_amount += vat_paid;
                            r_vat_exempt_amount = 0;
                            r_vat_zero_rated_amount = 0;
                            r_total_or_details = +r_vatable_amount + +r_vat_exempt_amount + +r_vat_zero_rated_amount;
                            r_add_vat += r_total_or_details;
                            r_surcharge_paid += surcharge_paid;
                            r_ips = ips_accrued_paid + ips_interest_paid;
                            r_interest += interest_paid;
                            r_principal += principal_paid;
                            r_total_payment_details = r_surcharge_paid + r_ips + r_interest + r_principal;

                            var contractStatus = checkContractStatus(contractID,total_all_the_paid);

                            console.log("amount2 after payment = "+amount2);

                            var data = new FormData();
                            data.append("amortization_id", amortizationid);
                            data.append("contract_id",contractID);
                            data.append("payment_date",paymentdate);
                            data.append("amount",total_paid);
                            data.append("payment_type",paymenttype);
                            data.append("principal",principal);
                            data.append("interest",interest);
                            data.append("surcharge",surcharge);
                            data.append("sundry",sundry);
                            data.append("paid_up",paidup);
                            data.append("balance",balance);
                            data.append("surcharge_paid", surcharge_paid);
                            data.append("principal_paid", principal_paid);
                            data.append("vat_paid", vat_paid);
                            data.append("interest_paid", interest_paid);
                            data.append("ips_accrued_paid", ips_accrued_paid);
                            data.append("ips_interest_paid", ips_interest_paid);
                            data.append("surcharge_total", surcharge_total);
                            data.append("principal_total", principal_total);
                            data.append("vat_total", vat_total);
                            data.append("interest_total", interest_total);
                            data.append("ips_accrued_total", ips_accrued_total);
                            data.append("ips_interest_total", ips_interest_total);
                            data.append("contract_status_id", contractStatus);
                            data.append("cashier_id",user_id)
                            console.log("FIRST DATA PASSED: ");
                            for (var pair of data.entries()) {
                                console.log(pair[0]+ ', ' + pair[1]); 
                            }
                            $.ajax({
                                type: "POST",
                                url:  baseurl + "collection/updateContractAndAmortizationLine",
                                data: data,
                                cache: false,
                                processData:false,
                                contentType:false,
                                success: function(data){
                                    toastr.success('Successfully Saved!', 'Operation Done');
                                    console.log(data);

                                    row++;

                                    var table_row_length = table.rows.length;
                                    table_row_length = table_row_length - 1;

                                    if (amount2 > 0){
                                        console.log('doing payment');
                                        console.log('amount 2 = '+amount2);
                                        console.log('contractID = '+contractID);
                                        console.log('table_row_length = '+table_row_length);
                                        console.log('row = '+row);
                                        handlePaymentInterbranch2(amount2,contractID,table_row_length,row);
                                    } else {
                                        receiptInterbranch(contractID,amortizationid);
                                    }
                                },
                                error: function (errorThrown){
                                    //toastr.error('Error!', 'Operation Done');
                                    //console.log(errorThrown);
                                }
                            });
                        }
                    }
                }
                else {
                    alert("Insufficient Amount!");
                }
            } else {
                console.log("!PAY TO PRINCIPAL");
                if ($('#paymentType').val()==1){
                    if ($('#payment1').val()=="" || $('#paymentDate').val()==""){
                        if ($('#payment1').val()==""){
                            $('#payment1').css({"border": "1px solid red"});
                        } else {
                            $('#payment1').css({"border": ""});
                        }
                        if ($('#paymentDate').val()==""){
                            $('#paymentDate').css({"border": "1px solid red"});
                        } else {
                            $('#paymentDate').css({"border": ""});
                        }

                    } else {
                        var table = document.getElementById("tblamortization");
                        var contractID = table.rows[1].cells[13].innerHTML;
                        console.log(contractID);
                        var amount = Number($('#payment1').val());
                        handlePaymentCash(amount,contractID);
                    }
                }
                if ($('#paymentType').val()==2){
                    if ($('#bank').val()=='0' || $('#payment2').val()=="" || $('#checkNumber1').val()=="" || $('#checkDate').val()==""){
                        if ($('#bank').val()=='0'){
                            $('#bank').css({"border": "1px solid red"});
                        } else {
                            $('#bank').css({"border": ""});
                        }
                        if ($('#payment2').val()==0){
                            $('#payment2').css({"border": "1px solid red"});
                        } else {
                            $('#payment2').css({"border": ""});
                        }
                        if ($('#checkNumber1').val()==0){
                            $('#checkNumber1').css({"border": "1px solid red"});
                        } else {
                            $('#checkNumber1').css({"border": ""});
                        }
                        if ($('#checkDate').val()==0){
                            $('#checkDate').css({"border": "1px solid red"});
                        } else {
                            $('#checkDate').css({"border": ""});
                        }

                    } else {
                        var table = document.getElementById("tblamortization");
                        var contractID = table.rows[1].cells[11].innerHTML;
                        var amount = Number($('#payment2').val());
                        handlePaymentCheck(amount,contractID);
                    }    
                }
                if ($('#paymentType').val()==3){
                    if ($('#bank').val()=='0' || $('#payment2').val()=="" || $('#checkNumber1').val()=="" || $('#checkDate').val()=="" || $('#payment1').val()==""){
                        if ($('#bank').val()=='0'){
                            $('#bank').css({"border": "1px solid red"});
                        } else {
                            $('#bank').css({"border": ""});
                        }
                        if ($('#payment2').val()==0){
                            $('#payment2').css({"border": "1px solid red"});
                        } else {
                            $('#payment2').css({"border": ""});
                        }
                        if ($('#checkNumber1').val()==0){
                            $('#checkNumber1').css({"border": "1px solid red"});
                        } else {
                            $('#checkNumber1').css({"border": ""});
                        }
                        if ($('#checkDate').val()==0){
                            $('#checkDate').css({"border": "1px solid red"});
                        } else {
                            $('#checkDate').css({"border": ""});
                        }
                        if ($('#payment1').val()==0){
                            $('#payment1').css({"border": "1px solid red"});
                        } else {
                            $('#payment1').css({"border": ""});
                        }

                    } else {
                        var table = document.getElementById("tblamortization");
                        var contractID = table.rows[1].cells[11].innerHTML;
                        var amount = Number($('#payment2').val()) + Number($('#payment1').val());
                        handlePaymentCashAndCheck(amount,contractID);
                    }
                }
                if ($('#paymentType').val()==4){
                    if ($('#payment3').val()=='' || $('#bank2').val()=='0' || $('#accNumber').val()=='' || $('#depositDate').val()==''){
                        if ($('#payment3').val()=='0'){
                            $('#payment3').css({"border": "1px solid red"});
                        } else {
                            $('#payment1').css({"border": ""});
                        }
                        if ($('#bank2').val()=='0'){
                            $('#bank2').css({"border": "1px solid red"});
                        } else {
                            $('#bank2').css({"border": ""});
                        }
                        if ($('#accNumber').val()=='0'){
                            $('#accNumber').css({"border": "1px solid red"});
                        } else {
                            $('#accNumber').css({"border": ""});
                        }
                        if ($('#depositDate').val()=='0'){
                            $('#depositDate').css({"border": "1px solid red"});
                        } else {
                            $('#depositDate').css({"border": ""});
                        }
                    } else {
                        var table = document.getElementById("tblamortization");
                        var contractID = table.rows[1].cells[11].innerHTML;
                        var amount = Number($('#payment3').val());
                        handlePaymentInterbranch(amount,contractID);
                    }
                }
            }
        }        
    });    
    
    $('#print').click(function () {
        var table = document.getElementById("tblamortization");
        var contractid = table.rows[1].cells[11].innerHTML;
        // var wiw = "sample";
        var data = new FormData();
        data.append("contractid", contractid);
        for (var pair of data.entries()) {
            console.log(pair[0]+ ', ' + pair[1]); 
        }
        $.ajax({
            url: baseurl + "collection/receipt",
            type: 'POST',
            //contentType: "application/json; charset=utf-8",
            data: data,
            cache: false,
            processData:false,
            contentType:false,
            success: function(html) {
                var url = baseurl + "reports/Receipt.pdf";
                var win = window.open(url, '_blank');
                win.focus();
                //$("#receiptTrigger").trigger("click").attr("target", "_blank");     
            }
        });
    });

    $('#trigger').click(function () {
        var table = document.getElementById("tblamortization");
        // var amortizationid = Number(table.rows[1].cells[0].innerHTML);
        var contractid = table.rows[1].cells[11].innerHTML;
        // var wiw = "sample";
        var data = new FormData();
        data.append("contractid", contractid);
        for (var pair of data.entries()) {
            console.log(pair[0]+ ', ' + pair[1]); 
        }
        $.ajax({
            url: baseurl + "collection/print_all_payments",
            type: 'POST',
            //contentType: "application/json; charset=utf-8",
            data: data,
            cache: false,
            processData:false,
            contentType:false,
            success: function(html) {
                var url = baseurl + "reports/Receipt.pdf";
                var win = window.open(url, '_blank');
                win.focus();
                //$("#receiptTrigger").trigger("click").attr("target", "_blank");     
            }
        });
    });
});

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

function calculateSurchargeMonth2(due_date, surchargedate, surchargerate, amount){
    today = surchargedate;

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

function formatDate(date) {
    var d = new Date(date),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();

    if (month.length < 2) month = '0' + month;
    if (day.length < 2) day = '0' + day;

    return [year, month, day].join('-');
}

// var sumofpayments = 0;
function getPayments(contractid) {

    var contractID = contractid;
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
            
            for(x=0; x < data.length; x++){
                var principal = Number(data[x].principal);
                var interest = Number(data[x].interest);
                var sundry = Number(data[x].sundry);
                var amount = Number(data[x].amount)
                // sum_of_payments = sum_of_payments + principal;
                // sum_of_payments = sum_of_payments + interest;
                // sum_of_payments = sum_of_payments + sundry;
                sum_of_payments = sum_of_payments + amount
                // sumofpayments = +sumofpayments + +Number(data[x].principal);
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
}

// var statusOfContract = 0;
function checkContractStatus(contractid,amount) {

    var contractID = contractid;
    var data = new FormData();
    data.append('contractid',contractID);
    data.append('customerid',global_customer_id);
    for (var pair of data.entries()) {
        console.log(pair[0]+ ', ' + pair[1]); 
    }
    var sumofpayments = 0;
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
            
            for(x=0; x < data['payment'].length; x++){
                var principal = Number(data['payment'][x].principal);
                var interest = Number(data['payment'][x].interest);
                var sundry = Number(data['payment'][x].sundry);
                sumofpayments = sumofpayments + principal;
                sumofpayments = sumofpayments + interest;
                sumofpayments = sumofpayments + sundry;
            }
            sumofpayments = +sumofpayments + +amount;
            var tcp = Number(data['contract'].total_contract_price);
            if (sumofpayments>=tcp){
                statusOfContract = 7;
            } else {
                statusOfContract = 5;
            }

        },
        error: function (errorThrown){
            toastr.error('Error!', 'Operation Done');
            console.log(errorThrown);
        }
    });
    return statusOfContract;
}

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

function jFormatNumberRet(a) {
    try {
        return parseFloat(a.replace(/,/g, ""))
    } catch (a) {
        return "Error FORMAT"
    }
}
function TableDatatablesEditable(){
    var customers = $('#tblcustomers').DataTable();
    var handleTable = function () {

    }
    return {
        //main function to initiate the module
        init: function () {
            handleTable();
        }
    };
}

function TableDatatablesEditable2(){
    var lots = $('#tbllots').DataTable();
    var handleTable = function () {

    }
    return {
        //main function to initiate the module
        init: function () {
            handleTable();
        }
    };
}

function handlePaymentCash(amount2,contractID){
    console.log('handling payment');
    console.log(amount2);
    console.log(contractID);
    var amortizationid ='';
    var old_amortization_amount = 0;
    var last_outstanding_balance = 0;
    var principal_paid_to_be_passed = 0;
    $.ajax({
        type: "POST",
        url:  baseurl + "collection/getSingleAmort",
        data: {'contractid':contractID},
        async: false,
        success: function(result){
            var data = jQuery.parseJSON(result);
            console.log("LENGTH "+data['amortization'].length);
            for (var i = 0; i < 1; i++) {
                //console.log("length "+data['amortization'][i].length);
                last_outstanding_balance = Number(data['amortization'][i].outstanding_balance);
                amortizationid = data['amortization'][i].amortization_id;
                var contractID = data['amortization'][i].contract_id;
                var paymentdate = $('#paymentDate').val();
                var paymenttype = $('#paymentType').val();
                //due amounts
                var amortization = Number(data['amortization'][i].amortization_amount);
                old_amortization_amount = amortization;
                console.log('amortization amount '+amortization);
                var principal = Number(data['amortization'][i].principal_amount);
                console.log('principal amount '+principal);
                var vat = Number(data['amortization'][i].vat_amount);
                console.log('vat amount '+vat);
                
                var ips_accrued = Number(data['amortization'][i].ips_accrued);
                console.log('ips_accrued amount '+ips_accrued);
                var ips_interest = Number(data['amortization'][i].ips_interest);
                console.log('ips_interest amount '+ips_interest);
                var ips = ips_accrued + ips_interest;
                var interest = Number(data['amortization'][i].interest_amount);
                console.log('interest amount '+interest);
                var due_date = moment(data['amortization'][i].due_date, "YYYY-MM-DD");
                var date_today = moment();
                //var ips_surcharge = calculateSurchargeMonth(due_date, date_today, 0.03, ips);
                
                var unpaid = vat + interest + ips + principal;
                var surcharge = calculateSurchargeMonth(due_date, date_today, 0.03, unpaid);
                surcharge = surcharge.toFixed(2);
                surcharge = Number(surcharge);
                console.log('surcharge amount '+surcharge);
                var amountDue = unpaid + surcharge;
                //var paidamount = Number(data['amortization'][i].interest_paid) + Number(data['amortization'][i].principal_paid) + Number(data['amortization'][i].vat_paid) + Number(data['amortization'][i].surcharge_paid);
                
                var interest_already_paid = Number(data['amortization'][i].interest_paid);
                var vat_already_paid = Number(data['amortization'][i].vat_paid);
                var surcharge_already_paid = Number(data['amortization'][i].surcharge_paid);
                var principal_already_paid = Number(data['amortization'][i].principal_paid);
                var ips_accrued_already_paid = Number(data['amortization'][i].ips_accrued_paid);
                var ips_interest_already_paid = Number(data['amortization'][i].ips_interest_paid);
                //var ips_surcharge_already_paid = Number(data['amortization'][i].ips_surcharge_paid);
                var ips_already_paid = ips_accrued_already_paid + ips_interest_already_paid; //+ ips_surcharge_already_paid;
                var total_already_paid = interest_already_paid + vat_already_paid + surcharge_already_paid + principal_already_paid + ips_already_paid;

                var surcharge_paid = 0;
                var principal_paid = 0;
                var vat_paid = 0;
                var interest_paid = 0;
                var ips_accrued_paid = 0;
                var ips_interest_paid = 0;
                //var ips_surcharge_paid = 0;
                var ips_paid = 0;
                var total_paid = 0;

                //deduct the dues with the already paid
                surcharge = surcharge - surcharge_already_paid;
                principal = principal - principal_already_paid;
                vat = vat - vat_already_paid;
                interest = interest - interest_already_paid;
                ips_accrued = ips_accrued - ips_accrued_already_paid;
                ips_interest = ips_interest - ips_interest_already_paid;

                //computation for deduction in each payments
                //if amount is greater than principal to pay, principal paid = principal to pay
                //surcharge deduction
                if(amount2 > surcharge){
                     surcharge_paid = surcharge;
                     amount2 = amount2 - surcharge;
                } else {
                     surcharge_paid = amount2;
                     amount2 = amount2 - amount2;
                }
                surcharge_paid = Number(surcharge_paid);
                amount2 = amount2.toFixed(2);
                console.log("amount2 after surcharge deduction = "+amount2);
                
                //principal deduction
                if(amount2 > principal){
                     principal_paid = principal;
                     amount2 = amount2 - principal;
                } else {
                     principal_paid = amount2;
                     amount2 = amount2 - amount2;
                }
                principal_paid = Number(principal_paid);
                amount2 = amount2.toFixed(2);
                principal_paid_to_be_passed = principal_paid;
                console.log("amount2 after principal deduction = "+amount2);
                
                //vat deduction
                if(amount2 > vat){
                     vat_paid = vat;
                     amount2 = amount2 - vat;
                } else {
                     vat_paid = amount2;
                     amount2 = amount2 - amount2;
                }
                vat_paid = Number(vat_paid);
                amount2 = amount2.toFixed(2);
                console.log("amount2 after vat deduction = "+amount2);
                //ips surcharge deduction
                // if(amount2 > ips_surcharge){
                //      ips_surcharge_paid = ips_surcharge;
                //      amount2 = amount2 - ips_surcharge;
                // } else {
                //      ips_surcharge_paid = amount2;
                //      amount2 = amount2 - amount2;
                // }
                //ips principal deduction
                if(amount2 > ips_accrued){
                     ips_accrued_paid = ips_accrued;
                     amount2 = amount2 - ips_accrued;
                } else {
                     ips_accrued_paid = amount2;
                     amount2 = amount2 - amount2;
                }
                ips_accrued_paid = Number(ips_accrued_paid);
                amount2 = amount2.toFixed(2);
                //ips interest deduction
                if(amount2 > ips_interest){
                     ips_interest_paid = ips_interest;
                     amount2 = amount2 - ips_interest;
                } else {
                     ips_interest_paid = amount2;
                     amount2 = amount2 - amount2;
                }
                ips_interest_paid = Number(ips_interest_paid);
                amount2 = amount2.toFixed(2);
                //interest deduction
                if(amount2 > interest){
                     interest_paid = interest;
                     amount2 = amount2 - interest;
                } else {
                     interest_paid = amount2;
                     amount2 = amount2 - amount2;
                }
                interest_paid = Number(interest_paid);
                amount2 = amount2.toFixed(2);
                console.log("amount2 after interest deduction = "+amount2);
                total_paid = surcharge_paid + principal_paid + vat_paid + ips_accrued_paid + ips_interest_paid + interest_paid;
                console.log('surcharge_paid');
                console.log(surcharge_paid);
                console.log('principal_paid');
                console.log(principal_paid);
                console.log('vat_paid ');
                console.log(vat_paid);
                console.log('ips_accrued_paid ');
                console.log(ips_accrued_paid);
                console.log('ips_interest_paid ');
                console.log(ips_interest_paid);
                console.log('interest_paid ');
                console.log(interest_paid);
                console.log('total_paid '+total_paid);
                console.log('total_already_paid '+total_already_paid);
                var balance = 0;
                var paiup;
                var total_all_the_paid = total_already_paid + total_paid;
                console.log('total_all_the_paid '+total_all_the_paid);
                 console.log('amountDue '+amountDue);
                balance = amountDue - total_all_the_paid;
                console.log('balance '+balance);
                balance = parseFloat(Math.round(balance * 100) / 100).toFixed(2);
                console.log('balance '+balance);

                //check if there is still balance, if none then paidup = 1
                if(balance > 0){
                     paidup = 0;
                } else {
                     paidup = 1;
                }

                //add the already paid and paid now
                var surcharge_total = surcharge_paid + surcharge_already_paid;
                var principal_total = principal_paid + principal_already_paid;
                var vat_total = vat_paid + vat_already_paid;
                var interest_total = interest_paid + interest_already_paid;
                //var ips_surcharge_total = ips_surcharge_paid + ips_surcharge_already_paid;
                var ips_accrued_total = ips_accrued_paid + ips_accrued_already_paid;
                var ips_interest_total = ips_interest_paid + ips_interest_already_paid;
                var ips_total_paid = ips_accrued_paid + ips_interest_paid;

                //for receipt values
                r_vatable_amount += vat_paid;
                r_vat_exempt_amount = 0;
                r_vat_zero_rated_amount = 0;
                r_total_or_details = +r_vatable_amount + +r_vat_exempt_amount + +r_vat_zero_rated_amount;
                r_add_vat += r_total_or_details;
                r_surcharge_paid += surcharge_paid;
                r_ips_accrued_paid += ips_accrued_paid;
                r_ips_interest_paid += ips_interest_paid;
                r_ips += ips_total_paid;
                r_interest += interest_paid;
                r_principal += principal_paid;
                r_total_payment_details = r_surcharge_paid + r_ips + r_interest + r_principal;
                r_total_payment_details2 = r_ips + r_interest + r_principal;

                var contractStatus = checkContractStatus(contractID,total_all_the_paid);

                console.log("amount2 after payment = "+amount2);

                var data = new FormData();
                data.append("amortization_id", amortizationid);
                data.append("contract_id",contractID);
                data.append("payment_date",paymentdate);
                data.append("amount",total_paid);
                data.append("payment_type",paymenttype);
                data.append("principal",principal);
                data.append("interest",interest);
                data.append("surcharge",surcharge);
                data.append("paid_up",paidup);
                data.append("balance",balance);
                data.append("surcharge_paid", surcharge_paid);
                data.append("principal_paid", principal_paid);
                data.append("vat_paid", vat_paid);
                data.append("interest_paid", interest_paid);
                data.append("contract_status_id", contractStatus);
                data.append("surcharge_total", surcharge_total);
                data.append("principal_total", principal_total);
                data.append("vat_total", vat_total);
                data.append("interest_total", interest_total);
                data.append("ips_accrued_total", ips_accrued_total);
                data.append("ips_interest_total", ips_interest_total);
                data.append("cashier_id",user_id)
                console.log("PASSED DATA "+i);
                for (var pair of data.entries()) {
                    console.log(pair[0]+ ', ' + pair[1]); 
                }
                console.log("AMOUNT 2 LEFT: "+amount2);
                $.ajax({
                    type: "POST",
                    url:  baseurl + "collection/updateContractAndAmortizationLine",
                    data: data,
                    cache: false,
                    processData:false,
                    contentType:false,
                    // async: false,
                    success: function(data){

                        console.log(data);
                        toastr.success('Successfully Saved!', 'Operation Done');

                    },
                    error: function (errorThrown){
                        //toastr.error('Error!', 'Operation Done');
                        //console.log(errorThrown);
                    }
                });

            }
            

            //toastr.success('Successfully Saved!', 'Operation Done');
            // alert(data[0].broker_person_id);
            
        },
        error: function (errorThrown){
            //toastr.error('Error!', 'Operation Done');
            //console.log(errorThrown);
        }
    });
    if(amount2>0){
        if (global_balance_interest_rate > 0){
            if (amount2>=old_amortization_amount){
                console.log('amount2 '+amount2);
                console.log('old_amortization_amount '+old_amortization_amount);
                handlePaymentCash(amount2,contractID);
            } else {
                console.log('amount2 '+amount2);
                console.log('old_amortization_amount '+old_amortization_amount);
                diminishingPayment(amount2,contractID,old_amortization_amount,global_balance_interest_rate,last_outstanding_balance,amortizationid,principal_paid_to_be_passed);
            }
        } else {
            console.log('passed for another iteration');
            handlePaymentCash(amount2,contractID);
        }
    } else {
        receiptCash(contractID,amortizationid);
    }
}

function handlePaymentCheck(amount2,contractID){
    console.log('handling excess amount');
    var amortizationid ='';
    var old_amortization_amount = 0;
    var last_outstanding_balance = 0;
    var principal_paid_to_be_passed = 0;
    $.ajax({
        type: "POST",
        url:  baseurl + "collection/getSingleAmort",
        data: {'contractid':contractID},
        async: false,
        success: function(result){
            var data = jQuery.parseJSON(result);
            console.log("LENGTH "+data['amortization'].length);
            for (var i = 0; i < 1; i++) {
                //console.log("length "+data['amortization'][i].length);
                last_outstanding_balance = Number(data['amortization'][i].outstanding_balance);
                amortizationid = data['amortization'][i].amortization_id;
                var contractID = data['amortization'][i].contract_id;
                var paymentdate = $('#paymentDate').val();
                var paymenttype = $('#paymentType').val();
                //due amounts
                var amortization = Number(data['amortization'][i].amortization_amount);
                old_amortization_amount = amortization;
                console.log('amortization amount '+amortization);
                var principal = Number(data['amortization'][i].principal_amount);
                console.log('principal amount '+principal);
                var vat = Number(data['amortization'][i].vat_amount);
                console.log('vat amount '+vat);
                
                var ips_accrued = Number(data['amortization'][i].ips_accrued);
                console.log('ips_accrued amount '+ips_accrued);
                var ips_interest = Number(data['amortization'][i].ips_interest);
                console.log('ips_interest amount '+ips_interest);
                var ips = ips_accrued + ips_interest;
                var interest = Number(data['amortization'][i].interest_amount);
                console.log('interest amount '+interest);
                var due_date = moment(data['amortization'][i].due_date, "YYYY-MM-DD");
                var date_today = moment();
                //var ips_surcharge = calculateSurchargeMonth(due_date, date_today, 0.03, ips);
                
                var unpaid = vat + interest + ips + principal;
                var surcharge = calculateSurchargeMonth(due_date, date_today, 0.03, unpaid);
                surcharge = surcharge.toFixed(2);
                surcharge = Number(surcharge);
                console.log('surcharge amount '+surcharge);
                var amountDue = unpaid + surcharge;
                //var paidamount = Number(data['amortization'][i].interest_paid) + Number(data['amortization'][i].principal_paid) + Number(data['amortization'][i].vat_paid) + Number(data['amortization'][i].surcharge_paid);
                
                var interest_already_paid = Number(data['amortization'][i].interest_paid);
                var vat_already_paid = Number(data['amortization'][i].vat_paid);
                var surcharge_already_paid = Number(data['amortization'][i].surcharge_paid);
                var principal_already_paid = Number(data['amortization'][i].principal_paid);
                var ips_accrued_already_paid = Number(data['amortization'][i].ips_accrued_paid);
                var ips_interest_already_paid = Number(data['amortization'][i].ips_interest_paid);
                //var ips_surcharge_already_paid = Number(data['amortization'][i].ips_surcharge_paid);
                var ips_already_paid = ips_accrued_already_paid + ips_interest_already_paid; //+ ips_surcharge_already_paid;
                var total_already_paid = interest_already_paid + vat_already_paid + surcharge_already_paid + principal_already_paid + ips_already_paid;

                var surcharge_paid = 0;
                var principal_paid = 0;
                var vat_paid = 0;
                var interest_paid = 0;
                var ips_accrued_paid = 0;
                var ips_interest_paid = 0;
                //var ips_surcharge_paid = 0;
                var ips_paid = 0;
                var total_paid = 0;

                //deduct the dues with the already paid
                surcharge = surcharge - surcharge_already_paid;
                principal = principal - principal_already_paid;
                vat = vat - vat_already_paid;
                interest = interest - interest_already_paid;
                ips_accrued = ips_accrued - ips_accrued_already_paid;
                ips_interest = ips_interest - ips_interest_already_paid;

                //computation for deduction in each payments
                //if amount is greater than principal to pay, principal paid = principal to pay
                //surcharge deduction
                if(amount2 > surcharge){
                     surcharge_paid = surcharge;
                     amount2 = amount2 - surcharge;
                } else {
                     surcharge_paid = amount2;
                     amount2 = amount2 - amount2;
                }
                amount2 = amount2.toFixed(2);
                console.log("amount2 after surcharge deduction = "+amount2);
                //principal deduction
                if(amount2 > principal){
                     principal_paid = principal;
                     amount2 = amount2 - principal;
                } else {
                     principal_paid = amount2;
                     amount2 = amount2 - amount2;
                }
                amount2 = amount2.toFixed(2);
                principal_paid_to_be_passed = principal_paid
                console.log("amount2 after principal deduction = "+amount2);
                //vat deduction
                if(amount2 > vat){
                     vat_paid = vat;
                     amount2 = amount2 - vat;
                } else {
                     vat_paid = amount2;
                     amount2 = amount2 - amount2;
                }
                amount2 = amount2.toFixed(2);
                console.log("amount2 after vat deduction = "+amount2);
                //ips surcharge deduction
                // if(amount2 > ips_surcharge){
                //      ips_surcharge_paid = ips_surcharge;
                //      amount2 = amount2 - ips_surcharge;
                // } else {
                //      ips_surcharge_paid = amount2;
                //      amount2 = amount2 - amount2;
                // }
                //ips principal deduction
                if(amount2 > ips_accrued){
                     ips_accrued_paid = ips_accrued;
                     amount2 = amount2 - ips_accrued;
                } else {
                     ips_accrued_paid = amount2;
                     amount2 = amount2 - amount2;
                }
                amount2 = amount2.toFixed(2);
                //ips interest deduction
                if(amount2 > ips_interest){
                     ips_interest_paid = ips_interest;
                     amount2 = amount2 - ips_interest;
                } else {
                     ips_interest_paid = amount2;
                     amount2 = amount2 - amount2;
                }
                amount2 = amount2.toFixed(2);
                //interest deduction
                if(amount2 > interest){
                     interest_paid = interest;
                     amount2 = amount2 - interest;
                } else {
                     interest_paid = amount2;
                     amount2 = amount2 - amount2;
                }
                amount2 = amount2.toFixed(2);
                console.log("amount2 after interest deduction = "+amount2);
                total_paid = surcharge_paid + principal_paid + vat_paid + ips_accrued_paid + ips_interest_paid + interest_paid;

                var balance = 0;
                var paiup;
                var total_all_the_paid = total_already_paid + total_paid;

                balance = amountDue - total_all_the_paid;
                balance = parseFloat(Math.round(balance * 100) / 100).toFixed(2);

                //check if there is still balance, if none then paidup = 1
                if(balance > 0){
                     paidup = 0;
                } else {
                     paidup = 1;
                }

                //add the already paid and paid now
                var surcharge_total = surcharge_paid + surcharge_already_paid;
                var principal_total = principal_paid + principal_already_paid;
                var vat_total = vat_paid + vat_already_paid;
                var interest_total = interest_paid + interest_already_paid;
                //var ips_surcharge_total = ips_surcharge_paid + ips_surcharge_already_paid;
                var ips_accrued_total = ips_accrued_paid + ips_accrued_already_paid;
                var ips_interest_total = ips_interest_paid + ips_interest_already_paid;
                var ips_total_paid = ips_accrued_paid + ips_interest_paid;

                //for receipt values
                r_vatable_amount += vat_paid;
                r_vat_exempt_amount = 0;
                r_vat_zero_rated_amount = 0;
                r_total_or_details = +r_vatable_amount + +r_vat_exempt_amount + +r_vat_zero_rated_amount;
                r_add_vat += r_total_or_details;
                r_surcharge_paid += surcharge_paid;
                r_ips_accrued_paid += ips_accrued_paid;
                r_ips_interest_paid += ips_interest_paid;
                r_ips += ips_total_paid;
                r_interest += interest_paid;
                r_principal += principal_paid;
                r_total_payment_details = r_surcharge_paid + r_ips + r_interest + r_principal;
                r_total_payment_details2 = r_ips + r_interest + r_principal;

                var contractStatus = checkContractStatus(contractID,total_all_the_paid);

                console.log("amount2 after payment = "+amount2);

                var data = new FormData();
                data.append("amortization_id", amortizationid);
                data.append("contract_id",contractID);
                data.append("payment_date",paymentdate);
                data.append("amount",total_paid);
                data.append("payment_type",paymenttype);
                data.append("principal",principal);
                data.append("interest",interest);
                data.append("surcharge",surcharge);
                //data.append("sundry",sundry);
                data.append("paid_up",paidup);
                data.append("balance",balance);
                data.append("surcharge_paid", surcharge_paid);
                data.append("principal_paid", principal_paid);
                data.append("vat_paid", vat_paid);
                data.append("interest_paid", interest_paid);
                data.append("contract_status_id", contractStatus);
                data.append("surcharge_total", surcharge_total);
                data.append("principal_total", principal_total);
                data.append("vat_total", vat_total);
                data.append("interest_total", interest_total);
                //data.append("ips_surcharge_total", ips_surcharge_total);
                data.append("ips_accrued_total", ips_accrued_total);
                data.append("ips_interest_total", ips_interest_total);
                data.append("cashier_id",user_id)
                console.log("PASSED DATA "+i);
                for (var pair of data.entries()) {
                    console.log(pair[0]+ ', ' + pair[1]); 
                }
                console.log("AMOUNT 2 LEFT: "+amount2);
                $.ajax({
                    type: "POST",
                    url:  baseurl + "collection/updateContractAndAmortizationLine",
                    data: data,
                    cache: false,
                    processData:false,
                    contentType:false,
                    // async: false,
                    success: function(data){

                        console.log(data);
                        toastr.success('Successfully Saved!', 'Operation Done');

                    },
                    error: function (errorThrown){
                        //toastr.error('Error!', 'Operation Done');
                        //console.log(errorThrown);
                    }
                });

            }
            

            //toastr.success('Successfully Saved!', 'Operation Done');
            // alert(data[0].broker_person_id);
            
        },
        error: function (errorThrown){
            //toastr.error('Error!', 'Operation Done');
            //console.log(errorThrown);
        }
    });
    if(amount2>0){
        if (global_balance_interest_rate > 0){
            if (amount2>old_amortization_amount){
                handlePaymentCash(amount2,contractID);
            } else {
                diminishingPayment(amount2,contractID,old_amortization_amount,global_balance_interest_rate,last_outstanding_balance,amortizationid,principal_paid);
            }
        } else {
            console.log('passed for another iteration');
            handlePaymentCheck(amount2,contractID);
        }
    } else {
        receiptCheck(contractID,amortizationid);
    }
}

function handlePaymentCashAndCheck(amount2,contractID){
    console.log('handling excess amount');
    var amortizationid ='';
    var old_amortization_amount = 0;
    var last_outstanding_balance = 0;
    var principal_paid_to_be_passed = 0;
    $.ajax({
        type: "POST",
        url:  baseurl + "collection/getSingleAmort",
        data: {'contractid':contractID},
        async: false,
        success: function(result){
            var data = jQuery.parseJSON(result);
            console.log("LENGTH "+data['amortization'].length);
            for (var i = 0; i < 1; i++) {
                //console.log("length "+data['amortization'][i].length);
                last_outstanding_balance = Number(data['amortization'][i].outstanding_balance);
                amortizationid = data['amortization'][i].amortization_id;
                var contractID = data['amortization'][i].contract_id;
                var paymentdate = $('#paymentDate').val();
                var paymenttype = $('#paymentType').val();
                //due amounts
                var amortization = Number(data['amortization'][i].amortization_amount);
                old_amortization_amount = amortization;
                console.log('amortization amount '+amortization);
                var principal = Number(data['amortization'][i].principal_amount);
                console.log('principal amount '+principal);
                var vat = Number(data['amortization'][i].vat_amount);
                console.log('vat amount '+vat);
                
                var ips_accrued = Number(data['amortization'][i].ips_accrued);
                console.log('ips_accrued amount '+ips_accrued);
                var ips_interest = Number(data['amortization'][i].ips_interest);
                console.log('ips_interest amount '+ips_interest);
                var ips = ips_accrued + ips_interest;
                var interest = Number(data['amortization'][i].interest_amount);
                console.log('interest amount '+interest);
                var due_date = moment(data['amortization'][i].due_date, "YYYY-MM-DD");
                var date_today = moment();
                //var ips_surcharge = calculateSurchargeMonth(due_date, date_today, 0.03, ips);
                
                var unpaid = vat + interest + ips + principal;
                var surcharge = calculateSurchargeMonth(due_date, date_today, 0.03, unpaid);
                surcharge = surcharge.toFixed(2);
                surcharge = Number(surcharge);
                console.log('surcharge amount '+surcharge);
                var amountDue = unpaid + surcharge;
                //var paidamount = Number(data['amortization'][i].interest_paid) + Number(data['amortization'][i].principal_paid) + Number(data['amortization'][i].vat_paid) + Number(data['amortization'][i].surcharge_paid);
                
                var interest_already_paid = Number(data['amortization'][i].interest_paid);
                var vat_already_paid = Number(data['amortization'][i].vat_paid);
                var surcharge_already_paid = Number(data['amortization'][i].surcharge_paid);
                var principal_already_paid = Number(data['amortization'][i].principal_paid);
                var ips_accrued_already_paid = Number(data['amortization'][i].ips_accrued_paid);
                var ips_interest_already_paid = Number(data['amortization'][i].ips_interest_paid);
                //var ips_surcharge_already_paid = Number(data['amortization'][i].ips_surcharge_paid);
                var ips_already_paid = ips_accrued_already_paid + ips_interest_already_paid; //+ ips_surcharge_already_paid;
                var total_already_paid = interest_already_paid + vat_already_paid + surcharge_already_paid + principal_already_paid + ips_already_paid;

                var surcharge_paid = 0;
                var principal_paid = 0;
                var vat_paid = 0;
                var interest_paid = 0;
                var ips_accrued_paid = 0;
                var ips_interest_paid = 0;
                //var ips_surcharge_paid = 0;
                var ips_paid = 0;
                var total_paid = 0;

                //deduct the dues with the already paid
                surcharge = surcharge - surcharge_already_paid;
                principal = principal - principal_already_paid;
                vat = vat - vat_already_paid;
                interest = interest - interest_already_paid;
                ips_accrued = ips_accrued - ips_accrued_already_paid;
                ips_interest = ips_interest - ips_interest_already_paid;

                //computation for deduction in each payments
                //if amount is greater than principal to pay, principal paid = principal to pay
                //surcharge deduction
                if(amount2 > surcharge){
                     surcharge_paid = surcharge;
                     amount2 = amount2 - surcharge;
                } else {
                     surcharge_paid = amount2;
                     amount2 = amount2 - amount2;
                }
                amount2 = amount2.toFixed(2);
                console.log("amount2 after surcharge deduction = "+amount2);
                //principal deduction
                if(amount2 > principal){
                     principal_paid = principal;
                     amount2 = amount2 - principal;
                } else {
                     principal_paid = amount2;
                     amount2 = amount2 - amount2;
                }
                amount2 = amount2.toFixed(2);
                principal_paid_to_be_passed = principal_paid
                console.log("amount2 after principal deduction = "+amount2);
                //vat deduction
                if(amount2 > vat){
                     vat_paid = vat;
                     amount2 = amount2 - vat;
                } else {
                     vat_paid = amount2;
                     amount2 = amount2 - amount2;
                }
                amount2 = amount2.toFixed(2);
                console.log("amount2 after vat deduction = "+amount2);
                //ips surcharge deduction
                // if(amount2 > ips_surcharge){
                //      ips_surcharge_paid = ips_surcharge;
                //      amount2 = amount2 - ips_surcharge;
                // } else {
                //      ips_surcharge_paid = amount2;
                //      amount2 = amount2 - amount2;
                // }
                //ips principal deduction
                if(amount2 > ips_accrued){
                     ips_accrued_paid = ips_accrued;
                     amount2 = amount2 - ips_accrued;
                } else {
                     ips_accrued_paid = amount2;
                     amount2 = amount2 - amount2;
                }
                amount2 = amount2.toFixed(2);
                //ips interest deduction
                if(amount2 > ips_interest){
                     ips_interest_paid = ips_interest;
                     amount2 = amount2 - ips_interest;
                } else {
                     ips_interest_paid = amount2;
                     amount2 = amount2 - amount2;
                }
                amount2 = amount2.toFixed(2);
                //interest deduction
                if(amount2 > interest){
                     interest_paid = interest;
                     amount2 = amount2 - interest;
                } else {
                     interest_paid = amount2;
                     amount2 = amount2 - amount2;
                }
                amount2 = amount2.toFixed(2);
                console.log("amount2 after interest deduction = "+amount2);
                total_paid = surcharge_paid + principal_paid + vat_paid + ips_accrued_paid + ips_interest_paid + interest_paid;

                var balance = 0;
                var paiup;
                var total_all_the_paid = total_already_paid + total_paid;

                balance = amountDue - total_all_the_paid;
                balance = parseFloat(Math.round(balance * 100) / 100).toFixed(2);

                //check if there is still balance, if none then paidup = 1
                if(balance > 0){
                     paidup = 0;
                } else {
                     paidup = 1;
                }

                //add the already paid and paid now
                var surcharge_total = surcharge_paid + surcharge_already_paid;
                var principal_total = principal_paid + principal_already_paid;
                var vat_total = vat_paid + vat_already_paid;
                var interest_total = interest_paid + interest_already_paid;
                //var ips_surcharge_total = ips_surcharge_paid + ips_surcharge_already_paid;
                var ips_accrued_total = ips_accrued_paid + ips_accrued_already_paid;
                var ips_interest_total = ips_interest_paid + ips_interest_already_paid;
                var ips_total_paid = ips_accrued_paid + ips_interest_paid;

                //for receipt values
                r_vatable_amount += vat_paid;
                r_vat_exempt_amount = 0;
                r_vat_zero_rated_amount = 0;
                r_total_or_details = +r_vatable_amount + +r_vat_exempt_amount + +r_vat_zero_rated_amount;
                r_add_vat += r_total_or_details;
                r_surcharge_paid += surcharge_paid;
                r_ips_accrued_paid += ips_accrued_paid;
                r_ips_interest_paid += ips_interest_paid;
                r_ips += ips_total_paid;
                r_interest += interest_paid;
                r_principal += principal_paid;
                r_total_payment_details = r_surcharge_paid + r_ips + r_interest + r_principal;
                r_total_payment_details2 = r_ips + r_interest + r_principal;

                var contractStatus = checkContractStatus(contractID,total_all_the_paid);

                console.log("amount2 after payment = "+amount2);

                var data = new FormData();
                data.append("amortization_id", amortizationid);
                data.append("contract_id",contractID);
                data.append("payment_date",paymentdate);
                data.append("amount",total_paid);
                data.append("payment_type",paymenttype);
                data.append("principal",principal);
                data.append("interest",interest);
                data.append("surcharge",surcharge);
                //data.append("sundry",sundry);
                data.append("paid_up",paidup);
                data.append("balance",balance);
                data.append("surcharge_paid", surcharge_paid);
                data.append("principal_paid", principal_paid);
                data.append("vat_paid", vat_paid);
                data.append("interest_paid", interest_paid);
                data.append("contract_status_id", contractStatus);
                data.append("surcharge_total", surcharge_total);
                data.append("principal_total", principal_total);
                data.append("vat_total", vat_total);
                data.append("interest_total", interest_total);
                //data.append("ips_surcharge_total", ips_surcharge_total);
                data.append("ips_accrued_total", ips_accrued_total);
                data.append("ips_interest_total", ips_interest_total);
                data.append("cashier_id",user_id)
                console.log("PASSED DATA "+i);
                for (var pair of data.entries()) {
                    console.log(pair[0]+ ', ' + pair[1]); 
                }
                console.log("AMOUNT 2 LEFT: "+amount2);
                $.ajax({
                    type: "POST",
                    url:  baseurl + "collection/updateContractAndAmortizationLine",
                    data: data,
                    cache: false,
                    processData:false,
                    contentType:false,
                    // async: false,
                    success: function(data){

                        console.log(data);
                        toastr.success('Successfully Saved!', 'Operation Done');

                    },
                    error: function (errorThrown){
                        //toastr.error('Error!', 'Operation Done');
                        //console.log(errorThrown);
                    }
                });

            }
            

            //toastr.success('Successfully Saved!', 'Operation Done');
            // alert(data[0].broker_person_id);
            
        },
        error: function (errorThrown){
            //toastr.error('Error!', 'Operation Done');
            //console.log(errorThrown);
        }
    });
    if(amount2>0){
        if (global_balance_interest_rate > 0){
            if (amount2>old_amortization_amount){
                handlePaymentCash(amount2,contractID);
            } else {
                diminishingPayment(amount2,contractID,old_amortization_amount,global_balance_interest_rate,last_outstanding_balance,amortizationid,principal_paid_to_be_passed);
            }
        } else {
            console.log('passed for another iteration');
            handlePaymentCashAndCheck(amount2,contractID);
        }
    } else {
        receiptCashAndCheck(contractID,amortizationid);
    }
}

function handlePaymentInterbranch(amount2,contractID){
    console.log('handling excess amount');
    var amortizationid ='';
    var old_amortization_amount = 0;
    var last_outstanding_balance = 0;
    var principal_paid_to_be_passed = 0;
    $.ajax({
        type: "POST",
        url:  baseurl + "collection/getSingleAmort",
        data: {'contractid':contractID},
        async: false,
        success: function(result){
            var data = jQuery.parseJSON(result);
            console.log("LENGTH "+data['amortization'].length);
            for (var i = 0; i < 1; i++) {
                //console.log("length "+data['amortization'][i].length);
                last_outstanding_balance = Number(data['amortization'][i].outstanding_balance);
                amortizationid = data['amortization'][i].amortization_id;
                var contractID = data['amortization'][i].contract_id;
                var paymentdate = $('#paymentDate').val();
                var paymenttype = $('#paymentType').val();
                //due amounts
                var amortization = Number(data['amortization'][i].amortization_amount);
                old_amortization_amount = amortization;
                console.log('amortization amount '+amortization);
                var principal = Number(data['amortization'][i].principal_amount);
                console.log('principal amount '+principal);
                var vat = Number(data['amortization'][i].vat_amount);
                console.log('vat amount '+vat);
                
                var ips_accrued = Number(data['amortization'][i].ips_accrued);
                console.log('ips_accrued amount '+ips_accrued);
                var ips_interest = Number(data['amortization'][i].ips_interest);
                console.log('ips_interest amount '+ips_interest);
                var ips = ips_accrued + ips_interest;
                var interest = Number(data['amortization'][i].interest_amount);
                console.log('interest amount '+interest);
                var due_date = moment(data['amortization'][i].due_date, "YYYY-MM-DD");
                var date_today = moment();
                //var ips_surcharge = calculateSurchargeMonth(due_date, date_today, 0.03, ips);
                
                var unpaid = vat + interest + ips + principal;
                var surcharge = calculateSurchargeMonth(due_date, date_today, 0.03, unpaid);
                surcharge = surcharge.toFixed(2);
                surcharge = Number(surcharge);
                console.log('surcharge amount '+surcharge);
                var amountDue = unpaid + surcharge;
                //var paidamount = Number(data['amortization'][i].interest_paid) + Number(data['amortization'][i].principal_paid) + Number(data['amortization'][i].vat_paid) + Number(data['amortization'][i].surcharge_paid);
                
                var interest_already_paid = Number(data['amortization'][i].interest_paid);
                var vat_already_paid = Number(data['amortization'][i].vat_paid);
                var surcharge_already_paid = Number(data['amortization'][i].surcharge_paid);
                var principal_already_paid = Number(data['amortization'][i].principal_paid);
                var ips_accrued_already_paid = Number(data['amortization'][i].ips_accrued_paid);
                var ips_interest_already_paid = Number(data['amortization'][i].ips_interest_paid);
                //var ips_surcharge_already_paid = Number(data['amortization'][i].ips_surcharge_paid);
                var ips_already_paid = ips_accrued_already_paid + ips_interest_already_paid; //+ ips_surcharge_already_paid;
                var total_already_paid = interest_already_paid + vat_already_paid + surcharge_already_paid + principal_already_paid + ips_already_paid;

                var surcharge_paid = 0;
                var principal_paid = 0;
                var vat_paid = 0;
                var interest_paid = 0;
                var ips_accrued_paid = 0;
                var ips_interest_paid = 0;
                //var ips_surcharge_paid = 0;
                var ips_paid = 0;
                var total_paid = 0;

                //deduct the dues with the already paid
                surcharge = surcharge - surcharge_already_paid;
                principal = principal - principal_already_paid;
                vat = vat - vat_already_paid;
                interest = interest - interest_already_paid;
                ips_accrued = ips_accrued - ips_accrued_already_paid;
                ips_interest = ips_interest - ips_interest_already_paid;

                //computation for deduction in each payments
                //if amount is greater than principal to pay, principal paid = principal to pay
                //surcharge deduction
                if(amount2 > surcharge){
                     surcharge_paid = surcharge;
                     amount2 = amount2 - surcharge;
                } else {
                     surcharge_paid = amount2;
                     amount2 = amount2 - amount2;
                }
                amount2 = amount2.toFixed(2);
                console.log("amount2 after surcharge deduction = "+amount2);
                //principal deduction
                if(amount2 > principal){
                     principal_paid = principal;
                     amount2 = amount2 - principal;
                } else {
                     principal_paid = amount2;
                     amount2 = amount2 - amount2;
                }
                amount2 = amount2.toFixed(2);
                principal_paid_to_be_passed = principal_paid;
                console.log("amount2 after principal deduction = "+amount2);
                //vat deduction
                if(amount2 > vat){
                     vat_paid = vat;
                     amount2 = amount2 - vat;
                } else {
                     vat_paid = amount2;
                     amount2 = amount2 - amount2;
                }
                amount2 = amount2.toFixed(2);
                console.log("amount2 after vat deduction = "+amount2);
                //ips surcharge deduction
                // if(amount2 > ips_surcharge){
                //      ips_surcharge_paid = ips_surcharge;
                //      amount2 = amount2 - ips_surcharge;
                // } else {
                //      ips_surcharge_paid = amount2;
                //      amount2 = amount2 - amount2;
                // }
                //ips principal deduction
                if(amount2 > ips_accrued){
                     ips_accrued_paid = ips_accrued;
                     amount2 = amount2 - ips_accrued;
                } else {
                     ips_accrued_paid = amount2;
                     amount2 = amount2 - amount2;
                }
                amount2 = amount2.toFixed(2);
                //ips interest deduction
                if(amount2 > ips_interest){
                     ips_interest_paid = ips_interest;
                     amount2 = amount2 - ips_interest;
                } else {
                     ips_interest_paid = amount2;
                     amount2 = amount2 - amount2;
                }
                amount2 = amount2.toFixed(2);
                //interest deduction
                if(amount2 > interest){
                     interest_paid = interest;
                     amount2 = amount2 - interest;
                } else {
                     interest_paid = amount2;
                     amount2 = amount2 - amount2;
                }
                amount2 = amount2.toFixed(2);
                console.log("amount2 after interest deduction = "+amount2);
                total_paid = surcharge_paid + principal_paid + vat_paid + ips_accrued_paid + ips_interest_paid + interest_paid;

                var balance = 0;
                var paiup;
                var total_all_the_paid = total_already_paid + total_paid;

                balance = amountDue - total_all_the_paid;
                balance = parseFloat(Math.round(balance * 100) / 100).toFixed(2);

                //check if there is still balance, if none then paidup = 1
                if(balance > 0){
                     paidup = 0;
                } else {
                     paidup = 1;
                }

                //add the already paid and paid now
                var surcharge_total = surcharge_paid + surcharge_already_paid;
                var principal_total = principal_paid + principal_already_paid;
                var vat_total = vat_paid + vat_already_paid;
                var interest_total = interest_paid + interest_already_paid;
                //var ips_surcharge_total = ips_surcharge_paid + ips_surcharge_already_paid;
                var ips_accrued_total = ips_accrued_paid + ips_accrued_already_paid;
                var ips_interest_total = ips_interest_paid + ips_interest_already_paid;
                var ips_total_paid = ips_accrued_paid + ips_interest_paid;

                //for receipt values
                r_vatable_amount += vat_paid;
                r_vat_exempt_amount = 0;
                r_vat_zero_rated_amount = 0;
                r_total_or_details = +r_vatable_amount + +r_vat_exempt_amount + +r_vat_zero_rated_amount;
                r_add_vat += r_total_or_details;
                r_surcharge_paid += surcharge_paid;
                r_ips_accrued_paid += ips_accrued_paid;
                r_ips_interest_paid += ips_interest_paid;
                r_ips += ips_total_paid;
                r_interest += interest_paid;
                r_principal += principal_paid;
                r_total_payment_details = r_surcharge_paid + r_ips + r_interest + r_principal;
                r_total_payment_details2 = r_ips + r_interest + r_principal;

                var contractStatus = checkContractStatus(contractID,total_all_the_paid);

                console.log("amount2 after payment = "+amount2);

                var data = new FormData();
                data.append("amortization_id", amortizationid);
                data.append("contract_id",contractID);
                data.append("payment_date",paymentdate);
                data.append("amount",total_paid);
                data.append("payment_type",paymenttype);
                data.append("principal",principal);
                data.append("interest",interest);
                data.append("surcharge",surcharge);
                //data.append("sundry",sundry);
                data.append("paid_up",paidup);
                data.append("balance",balance);
                data.append("surcharge_paid", surcharge_paid);
                data.append("principal_paid", principal_paid);
                data.append("vat_paid", vat_paid);
                data.append("interest_paid", interest_paid);
                data.append("contract_status_id", contractStatus);
                data.append("surcharge_total", surcharge_total);
                data.append("principal_total", principal_total);
                data.append("vat_total", vat_total);
                data.append("interest_total", interest_total);
                //data.append("ips_surcharge_total", ips_surcharge_total);
                data.append("ips_accrued_total", ips_accrued_total);
                data.append("ips_interest_total", ips_interest_total);
                data.append("cashier_id",user_id)
                console.log("PASSED DATA "+i);
                for (var pair of data.entries()) {
                    console.log(pair[0]+ ', ' + pair[1]); 
                }
                console.log("AMOUNT 2 LEFT: "+amount2);
                $.ajax({
                    type: "POST",
                    url:  baseurl + "collection/updateContractAndAmortizationLine",
                    data: data,
                    cache: false,
                    processData:false,
                    contentType:false,
                    // async: false,
                    success: function(data){

                        console.log(data);
                        toastr.success('Successfully Saved!', 'Operation Done');

                    },
                    error: function (errorThrown){
                        //toastr.error('Error!', 'Operation Done');
                        //console.log(errorThrown);
                    }
                });

            }
            

            //toastr.success('Successfully Saved!', 'Operation Done');
            // alert(data[0].broker_person_id);
            
        },
        error: function (errorThrown){
            //toastr.error('Error!', 'Operation Done');
            //console.log(errorThrown);
        }
    });
    if(amount2>0){
        if (global_balance_interest_rate > 0){
            if (amount2>old_amortization_amount){
                handlePaymentCash(amount2,contractID);
            } else {
                diminishingPayment(amount2,contractID,old_amortization_amount,global_balance_interest_rate,last_outstanding_balance,amortizationid,principal_paid_to_be_passed);
            }
        } else {
            console.log('passed for another iteration');
            handlePaymentInterbranch(amount2,contractID);
        }
    } else {
        receiptInterbranch(contractID,amortizationid);
    }
}

function handlePaymentCash2(amount2,contractID,table_row_length,row){
    console.log('entered');
    var amortizationid = '';
    var contractID = '';
    $.ajax({
        type: "POST",
        url:  baseurl + "collection/getSingleAmort",
        data: {'contractid':contractID},
        async: false,
        success: function(result){
            var data = jQuery.parseJSON(result);
            console.log("LENGTH "+data['amortization'].length);
            for (var i = 0; i < 1; i++) {
                amortizationid = data['amortization'][i].amortization_id;
                contractID = data['amortization'][i].contract_id;
                var paymentdate = $('#paymentDate').val();
                var paymenttype = $('#paymentType').val();
                var paidamount = Number(data['amortization'][i].interest_paid) + Number(data['amortization'][i].principal_paid) + Number(data['amortization'][i].vat_paid) + Number(data['amortization'][i].surcharge_paid) + Number(data['amortization'][i].ips_accrued_paid) + Number(data['amortization'][i].ips_interest_paid);
                var amortization = data['amortization'][i].amortization_amount;
                var principal = Number(data['amortization'][i].principal_amount);
                var vat = Number(data['amortization'][i].vat_amount);
                var interest = Number(data['amortization'][i].interest_amount);
                var ipsaccrued = Number(data['amortization'][i].ips_accrued_amount);
                var ipsinterest = Number(data['amortization'][i].ips_interest_amount);
                var ips = ipsaccrued + ipsinterest;
                var surcharge = parseFloat(table.rows[row].cells[5].innerHTML.replace(/,/g, ''));
                var amountDue = vat + ips + interest + surcharge + principal;

                var interest_already_paid = 0;
                var vat_already_paid = 0;
                var surcharge_already_paid = 0;
                var principal_already_paid = 0;
                var ips_accrued_already_paid = 0;
                var ips_interest_already_paid = 0;
                var total_already_paid = 0;

                //code for getting paid amounts
                //for interest
                if (table.rows[row].cells[14].innerHTML == 'null'){
                     interest_already_paid = 0;
                } else {
                     interest_already_paid = Number(data['amortization'][i].interest_paid);
                }
                //for vat
                if (table.rows[row].cells[15].innerHTML == 'null'){
                     vat_already_paid = 0;
                } else {
                     vat_already_paid = Number(data['amortization'][i].vat_paid);
                }
                //for surcharge
                if (table.rows[row].cells[16].innerHTML == 'null'){
                     surcharge_already_paid = 0;
                } else {
                     surcharge_already_paid = Number(data['amortization'][i].surcharge_paid);
                }
                //for principal
                if (table.rows[row].cells[17].innerHTML == 'null'){
                     principal_already_paid = 0;
                } else {
                     principal_already_paid = Number(data['amortization'][i].principal_paid);
                }
                //for ips accrued
                if (table.rows[row].cells[18].innerHTML == 'null'){
                     ips_accrued_already_paid = 0;
                } else {
                     ips_accrued_already_paid = Number(data['amortization'][i].ips_accrued_paid);
                }
                //for ips interest
                if (table.rows[row].cells[18].innerHTML == 'null'){
                     ips_interest_already_paid = 0;
                } else {
                     ips_interest_already_paid = Number(data['amortization'][i].ips_interest_paid);
                }

                //get sum of total paid
                total_already_paid = interest_already_paid + vat_already_paid + surcharge_already_paid + principal_already_paid + ips_accrued_already_paid + ips_interest_already_paid;

                //use amount2 for computations
                var amount2 = amount;
                //variables for paid amounts
                var surcharge_paid = 0;
                var principal_paid = 0;
                var vat_paid = 0;
                var interest_paid = 0;
                var ips_accrued_paid = 0;
                var ips_interest_paid = 0;
                var ips_paid = ips_accrued_paid + ips_interest_paid;
                var total_paid = 0;
                var sundry = 0;

                //deduct the dues with the already paid
                surcharge = surcharge - surcharge_already_paid;
                principal = principal - principal_already_paid;
                vat = vat - vat_already_paid;
                interest = interest - interest_already_paid;
                ipsaccrued = ipsaccrued - ips_accrued_already_paid;
                ipsinterest = ipsinterest - ips_interest_already_paid;

                //computation for deduction in each payments
                //if amount is greater than principal to pay, principal paid = principal to pay

                //surcharge deduction
                if(amount2 > surcharge){
                     surcharge_paid = surcharge;
                     amount2 = amount2 - surcharge;
                } else {
                     surcharge_paid = amount2;
                     amount2 = amount2 - amount2;
                }
                console.log("amount2 after surcharge deduction = "+amount2);
                //principal deduction
                if(amount2 > principal){
                     principal_paid = principal;
                     amount2 = amount2 - principal;
                } else {
                     principal_paid = amount2;
                     amount2 = amount2 - amount2;
                }
                console.log("amount2 after principal deduction = "+amount2);
                //vat deduction
                if(amount2 > vat){
                     vat_paid = vat;
                     amount2 = amount2 - vat;
                } else {
                     vat_paid = amount2;
                     amount2 = amount2 - amount2;
                }
                console.log("amount2 after vat deduction = "+amount2);
                //ips accrued deduction
                if(amount2 > ipsaccrued){
                     ips_accrued_paid = ipsaccrued;
                     amount2 = amount2 - ipsaccrued;
                } else {
                     ips_accrued_paid = amount2;
                     amount2 = amount2 - amount2;
                }
                console.log("amount2 after ips accrued deduction = "+amount2);
                //ips accrued deduction
                if(amount2 > ipsaccrued){
                     ips_interest_paid = ipsinterest;
                     amount2 = amount2 - ipsinterest;
                } else {
                     ips_interest_paid = amount2;
                     amount2 = amount2 - amount2;
                }
                console.log("amount2 after ips interest deduction = "+amount2);
                //interest deduction
                if(amount2 > interest){
                     interest_paid = interest;
                     amount2 = amount2 - interest;
                } else {
                     interest_paid = amount2;
                     amount2 = amount2 - amount2;
                }
                console.log("amount2 after interest deduction = "+amount2);
                total_paid = surcharge_paid + principal_paid + vat_paid + ips_accrued_paid + ips_interest_paid + interest_paid;

                var balance = 0;
                var paiup;
                var total_all_the_paid = total_already_paid + total_paid;

                balance = amountDue - total_all_the_paid;
                balance = parseFloat(Math.round(balance * 100) / 100).toFixed(2);

                //check if there is still balance, if none then paidup = 1
                if(balance > 0){
                     paidup = 0;
                } else {
                     paidup = 1;
                }

                //add the already paid and paid now
                var surcharge_total = surcharge_paid + surcharge_already_paid;
                var principal_total = principal_paid + principal_already_paid;
                var vat_total = vat_paid + vat_already_paid;
                var interest_total = interest_paid + interest_already_paid;
                var ips_accrued_total = ips_accrued_paid + ips_accrued_already_paid;
                var ips_interest_total = ips_interest_paid + ips_interest_already_paid;
                var ips_total = ips_accrued_total + ips_interest_total;

                r_vatable_amount += vat_paid;
                r_vat_exempt_amount = 0;
                r_vat_zero_rated_amount = 0;
                r_total_or_details = +r_vatable_amount + +r_vat_exempt_amount + +r_vat_zero_rated_amount;
                r_add_vat += r_total_or_details;
                r_surcharge_paid += surcharge_paid;
                r_ips = ips_accrued_paid + ips_interest_paid;
                r_interest += interest_paid;
                r_principal += principal_paid;
                r_total_payment_details = r_surcharge_paid + r_ips + r_interest + r_principal;

                var contractStatus = checkContractStatus(contractID,total_all_the_paid);

                console.log("amount2 after payment = "+amount2);

                var data = new FormData();
                data.append("amortization_id", amortizationid);
                data.append("contract_id",contractID);
                data.append("payment_date",paymentdate);
                data.append("amount",total_paid);
                data.append("payment_type",paymenttype);
                data.append("principal",principal);
                data.append("interest",interest);
                data.append("surcharge",surcharge);
                data.append("sundry",sundry);
                data.append("paid_up",paidup);
                data.append("balance",balance);
                data.append("surcharge_paid", surcharge_paid);
                data.append("principal_paid", principal_paid);
                data.append("vat_paid", vat_paid);
                data.append("interest_paid", interest_paid);
                data.append("ips_accrued_paid", ips_accrued_paid);
                data.append("ips_interest_paid", ips_interest_paid);
                data.append("surcharge_total", surcharge_total);
                data.append("principal_total", principal_total);
                data.append("vat_total", vat_total);
                data.append("interest_total", interest_total);
                data.append("ips_accrued_total", ips_accrued_total);
                data.append("ips_interest_total", ips_interest_total);
                data.append("contract_status_id", contractStatus);
                data.append("cashier_id",user_id);
                console.log("PASSED DATA "+i);
                for (var pair of data.entries()) {
                    console.log(pair[0]+ ', ' + pair[1]); 
                }
                console.log("AMOUNT 2 LEFT: "+amount2);
                $.ajax({
                    type: "POST",
                    url:  baseurl + "collection/updateContractAndAmortizationLine",
                    data: data,
                    cache: false,
                    processData:false,
                    contentType:false,
                    // async: false,
                    success: function(data){

                        console.log(data);
                        toastr.success('Successfully Saved!', 'Operation Done');

                    },
                    error: function (errorThrown){
                        //toastr.error('Error!', 'Operation Done');
                        //console.log(errorThrown);
                    }
                });

            }
            //toastr.success('Successfully Saved!', 'Operation Done');
            // alert(data[0].broker_person_id);         
        },
        error: function (errorThrown){
            //toastr.error('Error!', 'Operation Done');
            //console.log(errorThrown);
        }
    });
    row++;
    if(amount2 > 0 && row < table_row_length){
        console.log('doing it again');
        handlePaymentCash2(amount2,contractID,table_row_length,row);
    } else {
        receiptCash(contractID,amortizationid);
    }
}

function handlePaymentCheck2(amount2,contractID,table_row_length,row){
    console.log('entered');
    var amortizationid = '';
    var contractID = '';
    $.ajax({
        type: "POST",
        url:  baseurl + "collection/getSingleAmort",
        data: {'contractid':contractID},
        async: false,
        success: function(result){
            var data = jQuery.parseJSON(result);
            console.log("LENGTH "+data['amortization'].length);
            for (var i = 0; i < 1; i++) {
                amortizationid = data['amortization'][i].amortization_id;
                contractID = data['amortization'][i].contract_id;
                var paymentdate = $('#paymentDate').val();
                var checkNumber = $('#checkNumber1').val();
                var checkDate = $('#checkDate').val();
                var bankID = $('#bank').val();
                var paymenttype = $('#paymentType').val();
                var paidamount = Number(data['amortization'][i].interest_paid) + Number(data['amortization'][i].principal_paid) + Number(data['amortization'][i].vat_paid) + Number(data['amortization'][i].surcharge_paid) + Number(data['amortization'][i].ips_accrued_paid) + Number(data['amortization'][i].ips_interest_paid);
                var amortization = data['amortization'][i].amortization_amount;
                var principal = Number(data['amortization'][i].principal_amount);
                var vat = Number(data['amortization'][i].vat_amount);
                var interest = Number(data['amortization'][i].interest_amount);
                var ipsaccrued = Number(data['amortization'][i].ips_accrued_amount);
                var ipsinterest = Number(data['amortization'][i].ips_interest_amount);
                var ips = ipsaccrued + ipsinterest;
                var surcharge = parseFloat(table.rows[row].cells[5].innerHTML.replace(/,/g, ''));
                var amountDue = vat + ips + interest + surcharge + principal;

                var interest_already_paid = 0;
                var vat_already_paid = 0;
                var surcharge_already_paid = 0;
                var principal_already_paid = 0;
                var ips_accrued_already_paid = 0;
                var ips_interest_already_paid = 0;
                var total_already_paid = 0;

                //code for getting paid amounts
                //for interest
                if (table.rows[row].cells[14].innerHTML == 'null'){
                     interest_already_paid = 0;
                } else {
                     interest_already_paid = Number(data['amortization'][i].interest_paid);
                }
                //for vat
                if (table.rows[row].cells[15].innerHTML == 'null'){
                     vat_already_paid = 0;
                } else {
                     vat_already_paid = Number(data['amortization'][i].vat_paid);
                }
                //for surcharge
                if (table.rows[row].cells[16].innerHTML == 'null'){
                     surcharge_already_paid = 0;
                } else {
                     surcharge_already_paid = Number(data['amortization'][i].surcharge_paid);
                }
                //for principal
                if (table.rows[row].cells[17].innerHTML == 'null'){
                     principal_already_paid = 0;
                } else {
                     principal_already_paid = Number(data['amortization'][i].principal_paid);
                }
                //for ips accrued
                if (table.rows[row].cells[18].innerHTML == 'null'){
                     ips_accrued_already_paid = 0;
                } else {
                     ips_accrued_already_paid = Number(data['amortization'][i].ips_accrued_paid);
                }
                //for ips interest
                if (table.rows[row].cells[18].innerHTML == 'null'){
                     ips_interest_already_paid = 0;
                } else {
                     ips_interest_already_paid = Number(data['amortization'][i].ips_interest_paid);
                }

                //get sum of total paid
                total_already_paid = interest_already_paid + vat_already_paid + surcharge_already_paid + principal_already_paid + ips_accrued_already_paid + ips_interest_already_paid;

                //use amount2 for computations
                var amount2 = amount;
                //variables for paid amounts
                var surcharge_paid = 0;
                var principal_paid = 0;
                var vat_paid = 0;
                var interest_paid = 0;
                var ips_accrued_paid = 0;
                var ips_interest_paid = 0;
                var ips_paid = ips_accrued_paid + ips_interest_paid;
                var total_paid = 0;
                var sundry = 0;

                //deduct the dues with the already paid
                surcharge = surcharge - surcharge_already_paid;
                principal = principal - principal_already_paid;
                vat = vat - vat_already_paid;
                interest = interest - interest_already_paid;
                ipsaccrued = ipsaccrued - ips_accrued_already_paid;
                ipsinterest = ipsinterest - ips_interest_already_paid;

                //computation for deduction in each payments
                //if amount is greater than principal to pay, principal paid = principal to pay

                //surcharge deduction
                if(amount2 > surcharge){
                     surcharge_paid = surcharge;
                     amount2 = amount2 - surcharge;
                } else {
                     surcharge_paid = amount2;
                     amount2 = amount2 - amount2;
                }
                console.log("amount2 after surcharge deduction = "+amount2);
                //principal deduction
                if(amount2 > principal){
                     principal_paid = principal;
                     amount2 = amount2 - principal;
                } else {
                     principal_paid = amount2;
                     amount2 = amount2 - amount2;
                }
                console.log("amount2 after principal deduction = "+amount2);
                //vat deduction
                if(amount2 > vat){
                     vat_paid = vat;
                     amount2 = amount2 - vat;
                } else {
                     vat_paid = amount2;
                     amount2 = amount2 - amount2;
                }
                console.log("amount2 after vat deduction = "+amount2);
                //ips accrued deduction
                if(amount2 > ipsaccrued){
                     ips_accrued_paid = ipsaccrued;
                     amount2 = amount2 - ipsaccrued;
                } else {
                     ips_accrued_paid = amount2;
                     amount2 = amount2 - amount2;
                }
                console.log("amount2 after ips accrued deduction = "+amount2);
                //ips accrued deduction
                if(amount2 > ipsaccrued){
                     ips_interest_paid = ipsinterest;
                     amount2 = amount2 - ipsinterest;
                } else {
                     ips_interest_paid = amount2;
                     amount2 = amount2 - amount2;
                }
                console.log("amount2 after ips interest deduction = "+amount2);
                //interest deduction
                if(amount2 > interest){
                     interest_paid = interest;
                     amount2 = amount2 - interest;
                } else {
                     interest_paid = amount2;
                     amount2 = amount2 - amount2;
                }
                console.log("amount2 after interest deduction = "+amount2);
                total_paid = surcharge_paid + principal_paid + vat_paid + ips_accrued_paid + ips_interest_paid + interest_paid;

                var balance = 0;
                var paiup;
                var total_all_the_paid = total_already_paid + total_paid;

                balance = amountDue - total_all_the_paid;
                balance = parseFloat(Math.round(balance * 100) / 100).toFixed(2);

                //check if there is still balance, if none then paidup = 1
                if(balance > 0){
                     paidup = 0;
                } else {
                     paidup = 1;
                }

                //add the already paid and paid now
                var surcharge_total = surcharge_paid + surcharge_already_paid;
                var principal_total = principal_paid + principal_already_paid;
                var vat_total = vat_paid + vat_already_paid;
                var interest_total = interest_paid + interest_already_paid;
                var ips_accrued_total = ips_accrued_paid + ips_accrued_already_paid;
                var ips_interest_total = ips_interest_paid + ips_interest_already_paid;
                var ips_total = ips_accrued_total + ips_interest_total;

                r_vatable_amount += vat_paid;
                r_vat_exempt_amount = 0;
                r_vat_zero_rated_amount = 0;
                r_total_or_details = +r_vatable_amount + +r_vat_exempt_amount + +r_vat_zero_rated_amount;
                r_add_vat += r_total_or_details;
                r_surcharge_paid += surcharge_paid;
                r_ips = ips_accrued_paid + ips_interest_paid;
                r_interest += interest_paid;
                r_principal += principal_paid;
                r_total_payment_details = r_surcharge_paid + r_ips + r_interest + r_principal;

                var contractStatus = checkContractStatus(contractID,total_all_the_paid);

                console.log("amount2 after payment = "+amount2);

                var data = new FormData();
                data.append("amortization_id", amortizationid);
                data.append("contract_id",contractID);
                data.append("payment_date",paymentdate);
                data.append("amount",total_paid);
                data.append("payment_type",paymenttype);
                data.append("principal",principal);
                data.append("interest",interest);
                data.append("surcharge",surcharge);
                data.append("sundry",sundry);
                data.append("paid_up",paidup);
                data.append("balance",balance);
                data.append("surcharge_paid", surcharge_paid);
                data.append("principal_paid", principal_paid);
                data.append("vat_paid", vat_paid);
                data.append("interest_paid", interest_paid);
                data.append("ips_accrued_paid", ips_accrued_paid);
                data.append("ips_interest_paid", ips_interest_paid);
                data.append("surcharge_total", surcharge_total);
                data.append("principal_total", principal_total);
                data.append("vat_total", vat_total);
                data.append("interest_total", interest_total);
                data.append("ips_accrued_total", ips_accrued_total);
                data.append("ips_interest_total", ips_interest_total);
                data.append("contract_status_id", contractStatus);
                data.append("cashier_id",user_id);
                console.log("PASSED DATA "+i);
                for (var pair of data.entries()) {
                    console.log(pair[0]+ ', ' + pair[1]); 
                }
                console.log("AMOUNT 2 LEFT: "+amount2);
                $.ajax({
                    type: "POST",
                    url:  baseurl + "collection/updateContractAndAmortizationLine",
                    data: data,
                    cache: false,
                    processData:false,
                    contentType:false,
                    // async: false,
                    success: function(data){

                        console.log(data);
                        toastr.success('Successfully Saved!', 'Operation Done');

                    },
                    error: function (errorThrown){
                        //toastr.error('Error!', 'Operation Done');
                        //console.log(errorThrown);
                    }
                });

            }
            

            //toastr.success('Successfully Saved!', 'Operation Done');
            // alert(data[0].broker_person_id);
            
        },
        error: function (errorThrown){
            //toastr.error('Error!', 'Operation Done');
            //console.log(errorThrown);
        }
    });
    row++;
    if(amount2 > 0 && row < table_row_length){
        console.log('doing it again');
        handlePaymentCheck2(amount2,contractID,table_row_length,row);
    } else {
        receiptCheck(contractID,amortizationid);
    }
}

function handlePaymentCashAndCheck2(amount2,contractID,table_row_length,row){
    console.log('entered');
    var amortizationid = '';
    var contractID = '';
    $.ajax({
        type: "POST",
        url:  baseurl + "collection/getSingleAmort",
        data: {'contractid':contractID},
        async: false,
        success: function(result){
            var data = jQuery.parseJSON(result);
            console.log("LENGTH "+data['amortization'].length);
            for (var i = 0; i < 1; i++) {
                amortizationid = data['amortization'][i].amortization_id;
                contractID = data['amortization'][i].contract_id;
                var paymentdate = $('#paymentDate').val();
                var amountCheck = Number($('#payment2').val());
                var checkNumber = $('#checkNumber1').val();
                var checkDate = $('#checkDate').val();
                var bankID = $('#bank').val();
                var paymenttype = $('#paymentType').val();
                var paidamount = Number(data['amortization'][i].interest_paid) + Number(data['amortization'][i].principal_paid) + Number(data['amortization'][i].vat_paid) + Number(data['amortization'][i].surcharge_paid) + Number(data['amortization'][i].ips_accrued_paid) + Number(data['amortization'][i].ips_interest_paid);
                var amortization = data['amortization'][i].amortization_amount;
                var principal = Number(data['amortization'][i].principal_amount);
                var vat = Number(data['amortization'][i].vat_amount);
                var interest = Number(data['amortization'][i].interest_amount);
                var ipsaccrued = Number(data['amortization'][i].ips_accrued_amount);
                var ipsinterest = Number(data['amortization'][i].ips_interest_amount);
                var ips = ipsaccrued + ipsinterest;
                var surcharge = parseFloat(table.rows[row].cells[5].innerHTML.replace(/,/g, ''));
                var amountDue = vat + ips + interest + surcharge + principal;

                var interest_already_paid = 0;
                var vat_already_paid = 0;
                var surcharge_already_paid = 0;
                var principal_already_paid = 0;
                var ips_accrued_already_paid = 0;
                var ips_interest_already_paid = 0;
                var total_already_paid = 0;

                //code for getting paid amounts
                //for interest
                if (table.rows[row].cells[14].innerHTML == 'null'){
                     interest_already_paid = 0;
                } else {
                     interest_already_paid = Number(data['amortization'][i].interest_paid);
                }
                //for vat
                if (table.rows[row].cells[15].innerHTML == 'null'){
                     vat_already_paid = 0;
                } else {
                     vat_already_paid = Number(data['amortization'][i].vat_paid);
                }
                //for surcharge
                if (table.rows[row].cells[16].innerHTML == 'null'){
                     surcharge_already_paid = 0;
                } else {
                     surcharge_already_paid = Number(data['amortization'][i].surcharge_paid);
                }
                //for principal
                if (table.rows[row].cells[17].innerHTML == 'null'){
                     principal_already_paid = 0;
                } else {
                     principal_already_paid = Number(data['amortization'][i].principal_paid);
                }
                //for ips accrued
                if (table.rows[row].cells[18].innerHTML == 'null'){
                     ips_accrued_already_paid = 0;
                } else {
                     ips_accrued_already_paid = Number(data['amortization'][i].ips_accrued_paid);
                }
                //for ips interest
                if (table.rows[row].cells[18].innerHTML == 'null'){
                     ips_interest_already_paid = 0;
                } else {
                     ips_interest_already_paid = Number(data['amortization'][i].ips_interest_paid);
                }

                //get sum of total paid
                total_already_paid = interest_already_paid + vat_already_paid + surcharge_already_paid + principal_already_paid + ips_accrued_already_paid + ips_interest_already_paid;

                //use amount2 for computations
                var amount2 = amount;
                //variables for paid amounts
                var surcharge_paid = 0;
                var principal_paid = 0;
                var vat_paid = 0;
                var interest_paid = 0;
                var ips_accrued_paid = 0;
                var ips_interest_paid = 0;
                var ips_paid = ips_accrued_paid + ips_interest_paid;
                var total_paid = 0;
                var sundry = 0;

                //deduct the dues with the already paid
                surcharge = surcharge - surcharge_already_paid;
                principal = principal - principal_already_paid;
                vat = vat - vat_already_paid;
                interest = interest - interest_already_paid;
                ipsaccrued = ipsaccrued - ips_accrued_already_paid;
                ipsinterest = ipsinterest - ips_interest_already_paid;

                //computation for deduction in each payments
                //if amount is greater than principal to pay, principal paid = principal to pay

                //surcharge deduction
                if(amount2 > surcharge){
                     surcharge_paid = surcharge;
                     amount2 = amount2 - surcharge;
                } else {
                     surcharge_paid = amount2;
                     amount2 = amount2 - amount2;
                }
                console.log("amount2 after surcharge deduction = "+amount2);
                //principal deduction
                if(amount2 > principal){
                     principal_paid = principal;
                     amount2 = amount2 - principal;
                } else {
                     principal_paid = amount2;
                     amount2 = amount2 - amount2;
                }
                console.log("amount2 after principal deduction = "+amount2);
                //vat deduction
                if(amount2 > vat){
                     vat_paid = vat;
                     amount2 = amount2 - vat;
                } else {
                     vat_paid = amount2;
                     amount2 = amount2 - amount2;
                }
                console.log("amount2 after vat deduction = "+amount2);
                //ips accrued deduction
                if(amount2 > ipsaccrued){
                     ips_accrued_paid = ipsaccrued;
                     amount2 = amount2 - ipsaccrued;
                } else {
                     ips_accrued_paid = amount2;
                     amount2 = amount2 - amount2;
                }
                console.log("amount2 after ips accrued deduction = "+amount2);
                //ips accrued deduction
                if(amount2 > ipsaccrued){
                     ips_interest_paid = ipsinterest;
                     amount2 = amount2 - ipsinterest;
                } else {
                     ips_interest_paid = amount2;
                     amount2 = amount2 - amount2;
                }
                console.log("amount2 after ips interest deduction = "+amount2);
                //interest deduction
                if(amount2 > interest){
                     interest_paid = interest;
                     amount2 = amount2 - interest;
                } else {
                     interest_paid = amount2;
                     amount2 = amount2 - amount2;
                }
                console.log("amount2 after interest deduction = "+amount2);
                total_paid = surcharge_paid + principal_paid + vat_paid + ips_accrued_paid + ips_interest_paid + interest_paid;

                var balance = 0;
                var paiup;
                var total_all_the_paid = total_already_paid + total_paid;

                balance = amountDue - total_all_the_paid;
                balance = parseFloat(Math.round(balance * 100) / 100).toFixed(2);

                //check if there is still balance, if none then paidup = 1
                if(balance > 0){
                     paidup = 0;
                } else {
                     paidup = 1;
                }

                //add the already paid and paid now
                var surcharge_total = surcharge_paid + surcharge_already_paid;
                var principal_total = principal_paid + principal_already_paid;
                var vat_total = vat_paid + vat_already_paid;
                var interest_total = interest_paid + interest_already_paid;
                var ips_accrued_total = ips_accrued_paid + ips_accrued_already_paid;
                var ips_interest_total = ips_interest_paid + ips_interest_already_paid;
                var ips_total = ips_accrued_total + ips_interest_total;

                r_vatable_amount += vat_paid;
                r_vat_exempt_amount = 0;
                r_vat_zero_rated_amount = 0;
                r_total_or_details = +r_vatable_amount + +r_vat_exempt_amount + +r_vat_zero_rated_amount;
                r_add_vat += r_total_or_details;
                r_surcharge_paid += surcharge_paid;
                r_ips = ips_accrued_paid + ips_interest_paid;
                r_interest += interest_paid;
                r_principal += principal_paid;
                r_total_payment_details = r_surcharge_paid + r_ips + r_interest + r_principal;

                var contractStatus = checkContractStatus(contractID,total_all_the_paid);

                console.log("amount2 after payment = "+amount2);

                var data = new FormData();
                data.append("amortization_id", amortizationid);
                data.append("contract_id",contractID);
                data.append("payment_date",paymentdate);
                data.append("amount",total_paid);
                data.append("payment_type",paymenttype);
                data.append("principal",principal);
                data.append("interest",interest);
                data.append("surcharge",surcharge);
                data.append("sundry",sundry);
                data.append("paid_up",paidup);
                data.append("balance",balance);
                data.append("surcharge_paid", surcharge_paid);
                data.append("principal_paid", principal_paid);
                data.append("vat_paid", vat_paid);
                data.append("interest_paid", interest_paid);
                data.append("ips_accrued_paid", ips_accrued_paid);
                data.append("ips_interest_paid", ips_interest_paid);
                data.append("surcharge_total", surcharge_total);
                data.append("principal_total", principal_total);
                data.append("vat_total", vat_total);
                data.append("interest_total", interest_total);
                data.append("ips_accrued_total", ips_accrued_total);
                data.append("ips_interest_total", ips_interest_total);
                data.append("contract_status_id", contractStatus);
                data.append("cashier_id",user_id);
                console.log("PASSED DATA "+i);
                for (var pair of data.entries()) {
                    console.log(pair[0]+ ', ' + pair[1]); 
                }
                console.log("AMOUNT 2 LEFT: "+amount2);
                $.ajax({
                    type: "POST",
                    url:  baseurl + "collection/updateContractAndAmortizationLine",
                    data: data,
                    cache: false,
                    processData:false,
                    contentType:false,
                    // async: false,
                    success: function(data){

                        console.log(data);
                        toastr.success('Successfully Saved!', 'Operation Done');

                    },
                    error: function (errorThrown){
                        //toastr.error('Error!', 'Operation Done');
                        //console.log(errorThrown);
                    }
                });

            }
            

            //toastr.success('Successfully Saved!', 'Operation Done');
            // alert(data[0].broker_person_id);
            
        },
        error: function (errorThrown){
            //toastr.error('Error!', 'Operation Done');
            //console.log(errorThrown);
        }
     });
    row++;
    if(amount2 > 0 && row < table_row_length){
          console.log('doing it again');
          handlePaymentCashAndCheck2(amount2,contractID,table_row_length,row);
    } else {
       receiptCashAndCheck(contractID,amortizationid);
    }
}

function handlePaymentInterbranch2(amount2,contractID,table_row_length,row){
    console.log('entered');
    var amortizationid = '';
    var contractID = '';
    $.ajax({
        type: "POST",
        url:  baseurl + "collection/getSingleAmort",
        data: {'contractid':contractID},
        async: false,
        success: function(result){
            var data = jQuery.parseJSON(result);
            console.log("LENGTH "+data['amortization'].length);
            for (var i = 0; i < 1; i++) {
                amortizationid = data['amortization'][i].amortization_id;
                contractID = data['amortization'][i].contract_id;
                var paymentdate = $('#paymentDate').val();
                var amount = Number($('#payment3').val());
                var bankID = $('#bank2').val();
                var accountnumber = $('#accNumber').val();
                var depositdate = $('#depositDate').val();
                var paymenttype = $('#paymentType').val();
                var paidamount = Number(data['amortization'][i].interest_paid) + Number(data['amortization'][i].principal_paid) + Number(data['amortization'][i].vat_paid) + Number(data['amortization'][i].surcharge_paid) + Number(data['amortization'][i].ips_accrued_paid) + Number(data['amortization'][i].ips_interest_paid);
                var amortization = data['amortization'][i].amortization_amount;
                var principal = Number(data['amortization'][i].principal_amount);
                var vat = Number(data['amortization'][i].vat_amount);
                var interest = Number(data['amortization'][i].interest_amount);
                var ipsaccrued = Number(data['amortization'][i].ips_accrued_amount);
                var ipsinterest = Number(data['amortization'][i].ips_interest_amount);
                var ips = ipsaccrued + ipsinterest;
                var surcharge = parseFloat(table.rows[row].cells[5].innerHTML.replace(/,/g, ''));
                var amountDue = vat + ips + interest + surcharge + principal;

                var interest_already_paid = 0;
                var vat_already_paid = 0;
                var surcharge_already_paid = 0;
                var principal_already_paid = 0;
                var ips_accrued_already_paid = 0;
                var ips_interest_already_paid = 0;
                var total_already_paid = 0;

                //code for getting paid amounts
                //for interest
                if (table.rows[row].cells[14].innerHTML == 'null'){
                     interest_already_paid = 0;
                } else {
                     interest_already_paid = Number(data['amortization'][i].interest_paid);
                }
                //for vat
                if (table.rows[row].cells[15].innerHTML == 'null'){
                     vat_already_paid = 0;
                } else {
                     vat_already_paid = Number(data['amortization'][i].vat_paid);
                }
                //for surcharge
                if (table.rows[row].cells[16].innerHTML == 'null'){
                     surcharge_already_paid = 0;
                } else {
                     surcharge_already_paid = Number(data['amortization'][i].surcharge_paid);
                }
                //for principal
                if (table.rows[row].cells[17].innerHTML == 'null'){
                     principal_already_paid = 0;
                } else {
                     principal_already_paid = Number(data['amortization'][i].principal_paid);
                }
                //for ips accrued
                if (table.rows[row].cells[18].innerHTML == 'null'){
                     ips_accrued_already_paid = 0;
                } else {
                     ips_accrued_already_paid = Number(data['amortization'][i].ips_accrued_paid);
                }
                //for ips interest
                if (table.rows[row].cells[18].innerHTML == 'null'){
                     ips_interest_already_paid = 0;
                } else {
                     ips_interest_already_paid = Number(data['amortization'][i].ips_interest_paid);
                }

                //get sum of total paid
                total_already_paid = interest_already_paid + vat_already_paid + surcharge_already_paid + principal_already_paid + ips_accrued_already_paid + ips_interest_already_paid;

                //use amount2 for computations
                var amount2 = amount;
                //variables for paid amounts
                var surcharge_paid = 0;
                var principal_paid = 0;
                var vat_paid = 0;
                var interest_paid = 0;
                var ips_accrued_paid = 0;
                var ips_interest_paid = 0;
                var ips_paid = ips_accrued_paid + ips_interest_paid;
                var total_paid = 0;
                var sundry = 0;

                //deduct the dues with the already paid
                surcharge = surcharge - surcharge_already_paid;
                principal = principal - principal_already_paid;
                vat = vat - vat_already_paid;
                interest = interest - interest_already_paid;
                ipsaccrued = ipsaccrued - ips_accrued_already_paid;
                ipsinterest = ipsinterest - ips_interest_already_paid;

                //computation for deduction in each payments
                //if amount is greater than principal to pay, principal paid = principal to pay

                //surcharge deduction
                if(amount2 > surcharge){
                     surcharge_paid = surcharge;
                     amount2 = amount2 - surcharge;
                } else {
                     surcharge_paid = amount2;
                     amount2 = amount2 - amount2;
                }
                console.log("amount2 after surcharge deduction = "+amount2);
                //principal deduction
                if(amount2 > principal){
                     principal_paid = principal;
                     amount2 = amount2 - principal;
                } else {
                     principal_paid = amount2;
                     amount2 = amount2 - amount2;
                }
                console.log("amount2 after principal deduction = "+amount2);
                //vat deduction
                if(amount2 > vat){
                     vat_paid = vat;
                     amount2 = amount2 - vat;
                } else {
                     vat_paid = amount2;
                     amount2 = amount2 - amount2;
                }
                console.log("amount2 after vat deduction = "+amount2);
                //ips accrued deduction
                if(amount2 > ipsaccrued){
                     ips_accrued_paid = ipsaccrued;
                     amount2 = amount2 - ipsaccrued;
                } else {
                     ips_accrued_paid = amount2;
                     amount2 = amount2 - amount2;
                }
                console.log("amount2 after ips accrued deduction = "+amount2);
                //ips accrued deduction
                if(amount2 > ipsaccrued){
                     ips_interest_paid = ipsinterest;
                     amount2 = amount2 - ipsinterest;
                } else {
                     ips_interest_paid = amount2;
                     amount2 = amount2 - amount2;
                }
                console.log("amount2 after ips interest deduction = "+amount2);
                //interest deduction
                if(amount2 > interest){
                     interest_paid = interest;
                     amount2 = amount2 - interest;
                } else {
                     interest_paid = amount2;
                     amount2 = amount2 - amount2;
                }
                console.log("amount2 after interest deduction = "+amount2);
                total_paid = surcharge_paid + principal_paid + vat_paid + ips_accrued_paid + ips_interest_paid + interest_paid;

                var balance = 0;
                var paiup;
                var total_all_the_paid = total_already_paid + total_paid;

                balance = amountDue - total_all_the_paid;
                balance = parseFloat(Math.round(balance * 100) / 100).toFixed(2);

                //check if there is still balance, if none then paidup = 1
                if(balance > 0){
                     paidup = 0;
                } else {
                     paidup = 1;
                }

                //add the already paid and paid now
                var surcharge_total = surcharge_paid + surcharge_already_paid;
                var principal_total = principal_paid + principal_already_paid;
                var vat_total = vat_paid + vat_already_paid;
                var interest_total = interest_paid + interest_already_paid;
                var ips_accrued_total = ips_accrued_paid + ips_accrued_already_paid;
                var ips_interest_total = ips_interest_paid + ips_interest_already_paid;
                var ips_total = ips_accrued_total + ips_interest_total;

                r_vatable_amount += vat_paid;
                r_vat_exempt_amount = 0;
                r_vat_zero_rated_amount = 0;
                r_total_or_details = +r_vatable_amount + +r_vat_exempt_amount + +r_vat_zero_rated_amount;
                r_add_vat += r_total_or_details;
                r_surcharge_paid += surcharge_paid;
                r_ips = ips_accrued_paid + ips_interest_paid;
                r_interest += interest_paid;
                r_principal += principal_paid;
                r_total_payment_details = r_surcharge_paid + r_ips + r_interest + r_principal;

                var contractStatus = checkContractStatus(contractID,total_all_the_paid);

                console.log("amount2 after payment = "+amount2);

                var data = new FormData();
                data.append("amortization_id", amortizationid);
                data.append("contract_id",contractID);
                data.append("payment_date",paymentdate);
                data.append("amount",total_paid);
                data.append("payment_type",paymenttype);
                data.append("principal",principal);
                data.append("interest",interest);
                data.append("surcharge",surcharge);
                data.append("sundry",sundry);
                data.append("paid_up",paidup);
                data.append("balance",balance);
                data.append("surcharge_paid", surcharge_paid);
                data.append("principal_paid", principal_paid);
                data.append("vat_paid", vat_paid);
                data.append("interest_paid", interest_paid);
                data.append("ips_accrued_paid", ips_accrued_paid);
                data.append("ips_interest_paid", ips_interest_paid);
                data.append("surcharge_total", surcharge_total);
                data.append("principal_total", principal_total);
                data.append("vat_total", vat_total);
                data.append("interest_total", interest_total);
                data.append("ips_accrued_total", ips_accrued_total);
                data.append("ips_interest_total", ips_interest_total);
                data.append("contract_status_id", contractStatus);
                data.append("cashier_id",user_id);
                console.log("PASSED DATA "+i);
                for (var pair of data.entries()) {
                    console.log(pair[0]+ ', ' + pair[1]); 
                }
                console.log("AMOUNT 2 LEFT: "+amount2);
                $.ajax({
                    type: "POST",
                    url:  baseurl + "collection/savePaymentInterBranch",
                    data: data,
                    cache: false,
                    processData:false,
                    contentType:false,
                    // async: false,
                    success: function(data){

                        console.log(data);
                        toastr.success('Successfully Saved!', 'Operation Done');

                    },
                    error: function (errorThrown){
                        //toastr.error('Error!', 'Operation Done');
                        //console.log(errorThrown);
                    }
                });

            }
            

            //toastr.success('Successfully Saved!', 'Operation Done');
            // alert(data[0].broker_person_id);
            
        },
        error: function (errorThrown){
            //toastr.error('Error!', 'Operation Done');
            //console.log(errorThrown);
        }
    });
    row++;
    if(amount2 > 0 && row < table_row_length){
        console.log('doing it again');
        handlePaymentInterbranch2(amount2,contractID,table_row_length,row);
    } else {
        receiptInterbranch(contractID,amortizationid);
    }
}

function converter(s) {

  var months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
  s =  s.replace(/-/g, '/');
  var d = new Date(s);

  return months[d.getMonth()] + ' ' + d.getDate() + ', ' + d.getFullYear();
}

// 
function receiptCash(contractID,amortizationid){
    r_customer_name = $('#customerName').text();
    r_customer_address = $('#customerAddress').text();
    r_customer_tin = $('#customerTIN').text();
    r_lot_desc = $('#lotDescription').text();
    r_cash_amount = Number($('#payment1').val());
    r_check_amount = Number($('#payment2').val());
    r_check_date = $('#checkDate').val();
    r_check_bank = '';
    r_check_number = $('#checkNumber1').val();
    r_bank_amount = 0;
    r_bank_designated = '';
    r_bank_deposit_date = '';
    r_cashier = '';
    r_total_amount = +r_cash_amount +r_check_amount +r_bank_amount;
    var data = new FormData();
    data.append("r_customer_name", r_customer_name);
    data.append("r_customer_address",r_customer_address);
    data.append("r_customer_tin",r_customer_tin);
    data.append("r_lot_desc",r_lot_desc);
    data.append("r_vatable_amount",r_vatable_amount);
    data.append("r_vat_exempt_amount",r_vat_exempt_amount);
    data.append("r_vat_zero_rated_amount",r_vat_zero_rated_amount);
    data.append("r_total_or_details",r_total_or_details);
    data.append("r_add_vat",r_add_vat);
    data.append("r_surcharge_paid",r_surcharge_paid);
    data.append("r_ips_accrued_paid",r_ips_accrued_paid);
    data.append("r_ips_interest_paid",r_ips_interest_paid);
    data.append("r_ips",r_ips);
    data.append("r_interest", r_interest);
    data.append("r_principal", r_principal);
    data.append("r_total_payment_details", r_total_payment_details);
    data.append("r_total_payment_details2", r_total_payment_details2);
    data.append("r_cash_amount", r_cash_amount);
    data.append("r_check_amount", r_check_amount);
    data.append("r_check_date", r_check_date);
    data.append("r_check_bank", r_check_bank);
    data.append("r_check_number", r_check_number);
    data.append("r_bank_amount", r_bank_amount);
    data.append("r_bank_designated", r_bank_designated);
    data.append("r_bank_deposit_date", r_bank_deposit_date);
    data.append("r_total_amount", r_total_amount);
    data.append("r_cashier", user_id);
    data.append("cashier_id",user_id);
    data.append("contract_id",contractID);
    data.append("customer_id",global_customer_id);
    data.append("payment_date",$('#paymentDate').val());
    data.append("payment_type",$('#paymentType').val());
    data.append("amortization_id",amortizationid);
    data.append("license_to_sell",global_is_licensed_to_sell);
    data.append("is_tax_deferred",global_is_deferred);
    data.append("subsidiary_code",global_subsidiary_code);
    for (var pair of data.entries()) {
        console.log(pair[0]+ ', ' + pair[1]); 
    }
    $.ajax({
        url: baseurl + "collection/receipt",
        type: 'POST',
        //contentType: "application/json; charset=utf-8",
        data: data,
        cache: false,
        processData:false,
        contentType:false,
        success: function(html) {
            var url = baseurl + "reports/Receipt.pdf";
            var win = window.open(url, '_blank');
            win.focus();
            //$("#receiptTrigger").trigger("click").attr("target", "_blank");     
        },
        error: function (errorThrown){
            //toastr.error('Error!', 'Operation Done');
            //console.log(errorThrown);
        }
    });
}

function receiptCheck(contractID,amortizationid){
    r_customer_name = $('#customerName').text();
    r_customer_address = $('#customerAddress').text();
    r_customer_tin = $('#customerTIN').text();
    r_lot_desc = $('#lotDescription').text();
    r_cash_amount = 0;
    r_check_amount = Number($('#payment2').val());
    r_check_date = $('#checkDate').val();
    r_check_bank = $('#bank option:selected').text();
    r_check_number = $('#checkNumber1').val();
    r_bank_amount = 0;
    r_bank_designated = '';
    r_bank_deposit_date = '';
    r_cashier = '';
    r_total_amount = +r_cash_amount +r_check_amount +r_bank_amount;
    var data = new FormData();
    data.append("r_customer_name", r_customer_name);
    data.append("r_customer_address",r_customer_address);
    data.append("r_customer_tin",r_customer_tin);
    data.append("r_lot_desc",r_lot_desc);
    data.append("r_vatable_amount",r_vatable_amount);
    data.append("r_vat_exempt_amount",r_vat_exempt_amount);
    data.append("r_vat_zero_rated_amount",r_vat_zero_rated_amount);
    data.append("r_total_or_details",r_total_or_details);
    data.append("r_add_vat",r_add_vat);
    data.append("r_surcharge_paid",r_surcharge_paid);
    data.append("r_ips_accrued_paid",r_ips_accrued_paid);
    data.append("r_ips_interest_paid",r_ips_interest_paid);
    data.append("r_ips",r_ips);
    data.append("r_interest", r_interest);
    data.append("r_principal", r_principal);
    data.append("r_total_payment_details", r_total_payment_details);
    data.append("r_total_payment_details2", r_total_payment_details2);
    data.append("r_cash_amount", r_cash_amount);
    data.append("r_check_amount", r_check_amount);
    data.append("r_check_date", r_check_date);
    data.append("r_check_bank", r_check_bank);
    data.append("r_check_number", r_check_number);
    data.append("r_bank_amount", r_bank_amount);
    data.append("r_bank_designated", r_bank_designated);
    data.append("r_bank_deposit_date", r_bank_deposit_date);
    data.append("r_total_amount", r_total_amount);
    data.append("r_cashier", user_id);
    data.append("cashier_id",user_id);
    data.append("contract_id",contractID);
    data.append("customer_id",global_customer_id);
    data.append("payment_date",$('#paymentDate').val());
    data.append("payment_type",$('#paymentType').val());
    data.append("bank_id",$('#bank').val());
    data.append("amortization_id",amortizationid);
    data.append("license_to_sell",global_is_licensed_to_sell);
    data.append("is_tax_deferred",global_is_deferred);
    data.append("subsidiary_code",global_subsidiary_code);
    for (var pair of data.entries()) {
        console.log(pair[0]+ ', ' + pair[1]); 
    }
    $.ajax({
        url: baseurl + "collection/receipt",
        type: 'POST',
        //contentType: "application/json; charset=utf-8",
        data: data,
        cache: false,
        processData:false,
        contentType:false,
        success: function(html) {
            var url = baseurl + "reports/Receipt.pdf";
            var win = window.open(url, '_blank');
            win.focus();
            //$("#receiptTrigger").trigger("click").attr("target", "_blank");     
        },
        error: function (errorThrown){
            //toastr.error('Error!', 'Operation Done');
            //console.log(errorThrown);
        }
    });
}

function receiptCashAndCheck(contractID,amortizationid){
    r_customer_name = $('#customerName').text();
    r_customer_address = $('#customerAddress').text();
    r_customer_tin = $('#customerTIN').text();
    r_lot_desc = $('#lotDescription').text();
    r_cash_amount = Number($('#payment1').val());
    r_check_amount = Number($('#payment2').val());
    r_check_date = $('#checkDate').val();
    r_check_bank = $('#bank option:selected').text();
    r_check_number = $('#checkNumber1').val();
    r_bank_amount = 0;
    r_bank_designated = '';
    r_bank_deposit_date = '';
    r_cashier = '';
    r_total_amount = +r_cash_amount +r_check_amount +r_bank_amount;
    var data = new FormData();
    data.append("r_customer_name", r_customer_name);
    data.append("r_customer_address",r_customer_address);
    data.append("r_customer_tin",r_customer_tin);
    data.append("r_lot_desc",r_lot_desc);
    data.append("r_vatable_amount",r_vatable_amount);
    data.append("r_vat_exempt_amount",r_vat_exempt_amount);
    data.append("r_vat_zero_rated_amount",r_vat_zero_rated_amount);
    data.append("r_total_or_details",r_total_or_details);
    data.append("r_add_vat",r_add_vat);
    data.append("r_surcharge_paid",r_surcharge_paid);
    data.append("r_ips_accrued_paid",r_ips_accrued_paid);
    data.append("r_ips_interest_paid",r_ips_interest_paid);
    data.append("r_ips",r_ips);
    data.append("r_interest", r_interest);
    data.append("r_principal", r_principal);
    data.append("r_total_payment_details", r_total_payment_details);
    data.append("r_total_payment_details2", r_total_payment_details2);
    data.append("r_cash_amount", r_cash_amount);
    data.append("r_check_amount", r_check_amount);
    data.append("r_check_date", r_check_date);
    data.append("r_check_bank", r_check_bank);
    data.append("r_check_number", r_check_number);
    data.append("r_bank_amount", r_bank_amount);
    data.append("r_bank_designated", r_bank_designated);
    data.append("r_bank_deposit_date", r_bank_deposit_date);
    data.append("r_total_amount", r_total_amount);
    data.append("r_cashier", user_id);
    data.append("cashier_id",user_id);
    data.append("contract_id",contractID);
    data.append("customer_id",global_customer_id);
    data.append("payment_date",$('#paymentDate').val());
    data.append("payment_type",$('#paymentType').val());
    data.append("bank_id",$('#bank').val());
    data.append("amortization_id",amortizationid);
    data.append("license_to_sell",global_is_licensed_to_sell);
    data.append("is_tax_deferred",global_is_deferred);
    data.append("subsidiary_code",global_subsidiary_code);
    for (var pair of data.entries()) {
        console.log(pair[0]+ ', ' + pair[1]); 
    }
    $.ajax({
        url: baseurl + "collection/receipt",
        type: 'POST',
        //contentType: "application/json; charset=utf-8",
        data: data,
        cache: false,
        processData:false,
        contentType:false,
        success: function(html) {
            var url = baseurl + "reports/Receipt.pdf";
            var win = window.open(url, '_blank');
            win.focus();
            //$("#receiptTrigger").trigger("click").attr("target", "_blank");     
        },
        error: function (errorThrown){
            //toastr.error('Error!', 'Operation Done');
            //console.log(errorThrown);
        }
    });
}

function receiptInterbranch(contractID,amortizationid){
    r_customer_name = $('#customerName').text();
    r_customer_address = $('#customerAddress').text();
    r_customer_tin = $('#customerTIN').text();
    r_lot_desc = $('#lotDescription').text();
    r_cash_amount = 0;
    r_check_amount = 0;
    r_check_date = '';
    r_check_bank = '';
    r_check_number = '';
    r_bank_amount = Number($('#payment3').val());
    r_bank_designated = $('#bank option:selected').text();
    r_bank_deposit_date = $('#depositDate').val();
    r_cashier = '';
    r_total_amount = +r_cash_amount +r_check_amount +r_bank_amount;
    var data = new FormData();
    data.append("r_customer_name", r_customer_name);
    data.append("r_customer_address",r_customer_address);
    data.append("r_customer_tin",r_customer_tin);
    data.append("r_lot_desc",r_lot_desc);
    data.append("r_vatable_amount",r_vatable_amount);
    data.append("r_vat_exempt_amount",r_vat_exempt_amount);
    data.append("r_vat_zero_rated_amount",r_vat_zero_rated_amount);
    data.append("r_total_or_details",r_total_or_details);
    data.append("r_add_vat",r_add_vat);
    data.append("r_surcharge_paid",r_surcharge_paid);
    data.append("r_ips_accrued_paid",r_ips_accrued_paid);
    data.append("r_ips_interest_paid",r_ips_interest_paid);
    data.append("r_ips",r_ips);
    data.append("r_interest", r_interest);
    data.append("r_principal", r_principal);
    data.append("r_total_payment_details", r_total_payment_details);
    data.append("r_total_payment_details2", r_total_payment_details2);
    data.append("r_cash_amount", r_cash_amount);
    data.append("r_check_amount", r_check_amount);
    data.append("r_check_date", r_check_date);
    data.append("r_check_bank", r_check_bank);
    data.append("r_check_number", r_check_number);
    data.append("r_bank_amount", r_bank_amount);
    data.append("r_bank_designated", r_bank_designated);
    data.append("r_bank_deposit_date", r_bank_deposit_date);
    data.append("r_total_amount", r_total_amount);
    data.append("r_cashier", user_id);
    data.append("cashier_id",user_id);
    data.append("contract_id",contractID);
    data.append("customer_id",global_customer_id);
    data.append("payment_date",$('#paymentDate').val());
    data.append("payment_type",$('#paymentType').val());
    data.append("bank_id",$('#bank2').val());
    data.append("account_number",$('#accNumber').val());
    data.append("amortization_id",amortizationid);
    data.append("license_to_sell",global_is_licensed_to_sell);
    data.append("is_tax_deferred",global_is_deferred);
    data.append("subsidiary_code",global_subsidiary_code);
    for (var pair of data.entries()) {
        console.log(pair[0]+ ', ' + pair[1]); 
    }
    $.ajax({
        url: baseurl + "collection/receipt",
        type: 'POST',
        //contentType: "application/json; charset=utf-8",
        data: data,
        cache: false,
        processData:false,
        contentType:false,
        success: function(html) {
            var url = baseurl + "reports/Receipt.pdf";
            var win = window.open(url, '_blank');
            win.focus();
            //$("#receiptTrigger").trigger("click").attr("target", "_blank");     
        },
        error: function (errorThrown){
            //toastr.error('Error!', 'Operation Done');
            //console.log(errorThrown);
        }
    });
}

function diminishingPayment(amount2,contractID,old_amortization_amount,global_balance_interest_rate,last_outstanding_balance,amortizationid,principal_paid_to_be_passed) {
    var data = new FormData();
    data.append("contractid", contractID);
    $.ajax({
        url: baseurl + "collection/diminishing_payment",
        type: 'POST',
        data: data,
        cache: false,
        processData:false,
        contentType:false,
        success: function(result) {
            var data = jQuery.parseJSON(result);
            var table = document.getElementById("tbldiminishing");
            // var clientid = table.rows[col].cells[0].innerHTML;
            var interest = Number(global_balance_interest_rate);
            interest = interest / 100;
            console.log('amount2 '+amount2);
            var old_amort = Number(old_amortization_amount);
            var last_remaining_balance = last_outstanding_balance;
            console.log('last_remaining_balance '+last_remaining_balance);
            last_remaining_balance = last_remaining_balance - amount2;
            console.log('last_remaining_balance after amount2 deduction '+last_remaining_balance);
            var content = '';
            var content2 = '';
            for(x=0;x<data.length;x++){
                content += '<tr>';
                content += '<td>' + data[x].amortization_id +'</td>';
                content += '<td>' + data[x].due_date +'</td>';
                content += '<td align="right">' + numberWithCommas(Number(data[x].amortization_amount).toFixed(2)) + '</td>';
                content += '<td align="right">' + numberWithCommas(Number(data[x].vat_amount).toFixed(2)) + '</td>';
                var ips_accrued = Number(data[x].ips_accrued);
                var ips_interest = Number(data[x].ips_interest);
                var ips = ips_accrued + ips_interest;
                content += '<td align="right">' + numberWithCommas(Number(ips).toFixed(2)) + '</td>';
                content += '<td align="right">' + numberWithCommas(Number(data[x].interest_amount).toFixed(2)) + '</td>';
                content += '<td align="right">' + numberWithCommas(Number(data[x].principal_amount).toFixed(2)) + '</td>';
                content += '<td align="right">' + numberWithCommas(Number(data[x].outstanding_balance).toFixed(2)) + '</td>';
                content += '<td align="right">' + numberWithCommas(Number(data[x].vat_paid).toFixed(2)) + '</td>';
                var ips_accrued_paid = Number(data[x].ips_accrued_paid);
                var ips_interest_paid = Number(data[x].ips_interest_paid);
                var ips_paid = ips_accrued_paid + ips_interest_paid;
                content += '<td align="right">' + numberWithCommas(Number(ips_paid).toFixed(2)) + '</td>';
                content += '<td align="right">' + numberWithCommas(Number(data[x].interest_paid).toFixed(2)) + '</td>';
                content += '<td align="right">' + numberWithCommas(Number(data[x].principal_paid).toFixed(2)) + '</td>';
                content += '</tr>';

                var new_interest = last_remaining_balance * interest;
                console.log('new_interest '+new_interest);
                new_interest = new_interest / 12;
                console.log('new_interest2 '+new_interest);
                if(last_remaining_balance < old_amort){
                    var new_principal = last_remaining_balance - new_interest;
                } else {
                    var new_principal = old_amort - new_interest;
                }
                var new_amortization = new_interest + new_principal;
                last_remaining_balance = last_remaining_balance - new_amortization;
                
                content2 += '<tr>';
                content2 += '<td>' + data[x].amortization_id +'</td>';
                content2 += '<td>' + data[x].due_date +'</td>';
                content2 += '<td align="right">' + numberWithCommas(Number(new_amortization).toFixed(2)) + '</td>';
                content2 += '<td align="right">' + numberWithCommas(Number(data[x].vat_amount).toFixed(2)) + '</td>';
                var ips_accrued2 = Number(data[x].ips_accrued);
                var ips_interest2 = Number(data[x].ips_interest);
                var ips2 = ips_accrued2 + ips_interest2;
                content2 += '<td align="right">' + numberWithCommas(Number(ips2).toFixed(2)) + '</td>';
                content2 += '<td align="right">' + numberWithCommas(Number(new_interest).toFixed(2)) + '</td>';
                content2 += '<td align="right">' + numberWithCommas(Number(new_principal).toFixed(2)) + '</td>';
                content2 += '<td align="right">' + numberWithCommas(Number(last_remaining_balance).toFixed(2)) + '</td>';
                content2 += '<td align="right">' + numberWithCommas(Number(data[x].vat_paid).toFixed(2)) + '</td>';
                var ips_accrued_paid2 = Number(data[x].ips_accrued_paid);
                var ips_interest_paid2 = Number(data[x].ips_interest_paid);
                var ips_paid2 = ips_accrued_paid2 + ips_interest_paid2;
                content2 += '<td align="right">' + numberWithCommas(Number(ips_paid2).toFixed(2)) + '</td>';
                content2 += '<td align="right">' + numberWithCommas(Number(data[x].interest_paid).toFixed(2)) + '</td>';
                content2 += '<td align="right">' + numberWithCommas(Number(data[x].principal_paid).toFixed(2)) + '</td>';
                content2 += '</tr>';

            }
            $('#tbody_diminishing').html(content); 
            $('#tbody_diminishing2').html(content2); 
            $('#tbldiminishing2').DataTable();
            // $('#diminishing').show();

            amount2 = Number(amount2);
            r_principal = Number(r_principal);
            //add the excess amount to the variable to reflect it in the receipt
            r_principal = r_principal + amount2;
            console.log('r_principal '+r_principal);
            r_total_payment_details = r_total_payment_details + r_principal;
            console.log('r_total_payment_details '+r_total_payment_details);

            //add the excess amount paid in the previous amortization line
            principal_paid_to_be_passed = Number(principal_paid_to_be_passed);
            var principal = amount2 + principal_paid_to_be_passed;
            console.log('principal '+principal);
            console.log('last_outstanding_balance '+last_outstanding_balance);
            var updated_previous_outstanding_balance = last_outstanding_balance - amount2;
            console.log('updated_previous_outstanding_balance '+updated_previous_outstanding_balance);
            var data = new FormData();
            data.append("amortization_id", amortizationid);
            data.append("principal",principal);
            data.append("outstandingbalance",updated_previous_outstanding_balance);
            for (var pair of data.entries()) {
                console.log(pair[0]+ ', ' + pair[1]); 
            }
            $.ajax({
                type: "POST",
                url:  baseurl + "collection/updateAmortizationLine",
                data: data,
                cache: false,
                processData:false,
                contentType:false,
                // async: false,
                success: function(data){
                    console.log(data);
                    toastr.success('Successfully Saved!', 'Operation Done');
                },
                error: function (errorThrown){
                }
            });

            //get table data to update the amortization schedule
            var TableData = [];
            var rows = $("#tbldiminishing2").dataTable().fnGetNodes();
            for(var i=0; i<rows.length;i++){
                TableData[i] = {
                    "amortizationid" : $(rows[i]).find('td:eq(0)').text().replace(/,/g, '')
                    , "duedate" :$(rows[i]).find('td:eq(1)').text().replace(/,/g, '')
                    , "amortizationamount" :$(rows[i]).find('td:eq(2)').text().replace(/,/g, '')
                    , "vat" :$(rows[i]).find('td:eq(3)').text().replace(/,/g, '')
                    , "ips" : $(rows[i]).find('td:eq(4)').text().replace(/,/g, '')
                    , "interest" : $(rows[i]).find('td:eq(5)').text().replace(/,/g, '')
                    , "principal" : $(rows[i]).find('td:eq(6)').text().replace(/,/g, '')
                    , "remainingbalance" : $(rows[i]).find('td:eq(7)').text().replace(/,/g, '')
                }
            }

            var data2 = JSON.stringify(TableData);

            console.log(TableData);

            $.ajax({
                type: "POST",
                url:  baseurl + "collection/save_new_amortization_sched_deminishing",
                data: {'data2':data2},
                success: function(data){
                    toastr.success('Successfully Saved!', 'Operation Done');
                },
                error: function(data){
                },
            });

            //do the designated receipt for the payment
            if($('#paymentType').val() == 1){
                receiptCash(contractID,amortizationid);
            }
            if($('#paymentType').val() == 2){
                receiptCheck(contractID,amortizationid);
            }
            if($('#paymentType').val() == 3){
                receiptCashAndCheck(contractID,amortizationid);
            }
            if($('#paymentType').val() == 4){
                receiptInterbranch(contractID,amortizationid);
            }

        },
        error: function (errorThrown){
            //toastr.error('Error!', 'Operation Done');
            //console.log(errorThrown);
        }
    });
}

// console.log("receipt happens");
// r_customer_name = $('#customerName').text();
// r_customer_address = $('#customerAddress').text();
// r_customer_tin = $('#customerTIN').text();
// r_lot_desc = $('#lotDescription').text();
// r_cash_amount = Number($('#payment1').val());
// r_check_amount = 0;
// r_check_date = '';
// r_check_bank = '';
// r_check_number = '';
// r_bank_amount = 0;
// r_bank_designated = '';
// r_bank_deposit_date = 0;
// r_cashier = '';
// r_total_amount = +r_cash_amount +r_check_amount +r_bank_amount;
// var data = new FormData();
// data.append("r_customer_name", r_customer_name);
// data.append("r_customer_address",r_customer_address);
// data.append("r_customer_tin",r_customer_tin);
// data.append("r_lot_desc",r_lot_desc);
// data.append("r_vatable_amount",r_vatable_amount);
// data.append("r_vat_exempt_amount",r_vat_exempt_amount);
// data.append("r_vat_zero_rated_amount",r_vat_zero_rated_amount);
// data.append("r_total_or_details",r_total_or_details);
// data.append("r_add_vat",r_add_vat);
// data.append("r_surcharge_paid",r_surcharge_paid);
// data.append("r_ips",r_ips);
// data.append("r_interest", r_interest);
// data.append("r_principal", r_principal);
// data.append("r_total_payment_details", r_total_payment_details);
// data.append("r_cash_amount", r_cash_amount);
// data.append("r_check_amount", r_check_amount);
// data.append("r_check_date", r_check_date);
// data.append("r_check_bank", r_check_bank);
// data.append("r_check_number", r_check_number);
// data.append("r_bank_amount", r_bank_amount);
// data.append("r_bank_designated", r_bank_designated);
// data.append("r_bank_deposit_date", r_bank_deposit_date);
// data.append("r_total_amount", r_total_amount);
// data.append("r_cashier", user_id);
// data.append("cashier_id",user_id);
// data.append("cashier_id",user_id);
// data.append("contract_id",contractID);
// data.append("customer_id",global_customer_id);
// data.append("payment_date",$('#paymentDate').val());
// data.append("payment_type",$('#paymentType').val());
// for (var pair of data.entries()) {
//     console.log(pair[0]+ ', ' + pair[1]); 
// }
// $.ajax({
//     url: baseurl + "collection/receipt",
//     type: 'POST',
//     //contentType: "application/json; charset=utf-8",
//     data: data,
//     cache: false,
//     processData:false,
//     contentType:false,
//     success: function(html) {
//         var url = baseurl + "reports/Receipt.pdf";
//         var win = window.open(url, '_blank');
//         win.focus();
//         //$("#receiptTrigger").trigger("click").attr("target", "_blank");     
//     }
// });