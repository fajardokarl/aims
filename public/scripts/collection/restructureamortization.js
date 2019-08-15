var TableDatatablesEditable = function () {

    var bankslist = $('#tblcustomers').DataTable();
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

    var lots = $('#tbllots').DataTable();
    var handleTable = function () {

    }
    return {
        //main function to initiate the module
        init: function () {
            handleTable();
        }
    };
}();

$(document).ready(function(){

    var balance_ratio_text;
    var contract_id;
    var balance_ratio;
    var dp_ratio;
    var dp_terms;
    var dp_interest_rate;
    var dp_discount_rate;
    var dp_discount;
    var dp_surcharge_rate;

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
        var clientid = table.rows[col].cells[0].innerHTML;
        //alert(clientid);
        $.ajax({
            type: "POST",
            url:  baseurl + "collection/populateDropdownCProperties",
            data: {'clientid':clientid},
            success: function(result){
                var data = jQuery.parseJSON(result);
                if (data.length != 0){   

                    $('#generate').show();
                    var content = '';
                    content += '<option value="0" class ="disabled selected">Select Here..</option>';
                    for (var i = 0; i < data.length; i++) {
                        content += '<option value="' + data[i].contract_id + '">' + data[i].lot_description + '</option>'; 
                    }

                    $('#clientProperties').html(content); //populate the other dropdown
                    var content2 = '';
                    numberWithCommas
                    for (var x = 0; x < data.length; x++) {
                        var tcp = parseFloat(Math.round(Number(data[x].total_contract_price) * 100) / 100).toFixed(2)
                        var lot_area = parseFloat(Math.round(Number(data[x].lot_area) * 100) / 100).toFixed(2)
                        var ppsm = parseFloat(Math.round(Number(data[x].price_per_sqr_meter) * 100) / 100).toFixed(2)
                        content2 += '<tr id="row">';
                        content2 += '<td>' + data[x].contract_id + '</td>'; 
                        content2 += '<td>' + data[x].lot_description + '</td>';
                        content2 += '<td>' + converter(data[x].contract_date) + '</td>';
                        content2 += '<td>' + numberWithCommas(tcp) + '</td>';
                        content2 += '<td>' + numberWithCommas(lot_area) + '</td>';
                        content2 += '<td>' + numberWithCommas(ppsm) + '</td>';

                        var contractid = data[x].contract_id;  
                        var sum_of_payments = getPayments(contractid);
                        content2 += '<td>' + numberWithCommas(parseFloat(Math.round(sum_of_payments * 100) / 100).toFixed(2)) + '</td>';
                        var balance = Number(data[x].total_contract_price) - sum_of_payments;
                        balance = parseFloat(Math.round(balance * 100) / 100).toFixed(2);
                        content2 += '<td>' + numberWithCommas(balance) + '</td>';

                        var percentage = (sum_of_payments / Number(data[x].total_contract_price)) * 100;
                        percentage = parseFloat(Math.round(percentage * 100) / 100).toFixed(2);
                        
                        content2 += '<td>' + percentage + '</td>';
                        content2 += '<td>' + data[x].contract_status_name + '</td>';

                        content2 += '</tr>';

                    }

                    $('#tbody_contracts').html(content2); 
                    var tblcontracts = $('#tblcontracts').DataTable();
                    var handleTable = function () {

                    }
                    return {
                        //main function to initiate the module
                        init: function () {
                            handleTable();
                        }
                    };
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
                console.log(errorThrown);
            }
        });
        event.preventDefault();

    });

    $(document).on("click","#tbllots tr",function() {
        $("<style type='text/css'> .highlight{ background:#33F0FF;} </style>").appendTo("head");
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
        //alert(contractid);
        $.ajax({
            type: "POST",
            url:  baseurl + "collection/getSingleContractDetails",
            data: {'lotid':lotid},
            success: function(result){
                var data = jQuery.parseJSON(result);
                if (data.length != 0){   

                    //toastr.success('Successfully Saved!', 'Operation Done');
                    var content2 = '';
                    for (var x = 0; x < data.length; x++) {
                        var tcp = parseFloat(Math.round(Number(data[x].total_contract_price) * 100) / 100).toFixed(2)
                        var lot_area = parseFloat(Math.round(Number(data[x].lot_area) * 100) / 100).toFixed(2)
                        var ppsm = parseFloat(Math.round(Number(data[x].price_per_sqr_meter) * 100) / 100).toFixed(2)
                        content2 += '<tr id="row">';
                        content2 += '<td>' + data[x].contract_id + '</td>'; 
                        content2 += '<td>' + data[x].lot_description + '</td>';
                        content2 += '<td>' + converter(data[x].contract_date) + '</td>';
                        content2 += '<td>' + numberWithCommas(tcp) + '</td>';
                        content2 += '<td>' + numberWithCommas(lot_area) + '</td>';
                        content2 += '<td>' + numberWithCommas(ppsm) + '</td>';

                        var contractid = data[x].contract_id;  
                        var sum_of_payments = getPayments(contractid);
                        content2 += '<td>' + numberWithCommas(parseFloat(Math.round(sum_of_payments * 100) / 100).toFixed(2)) + '</td>';
                        var balance = Number(data[x].total_contract_price) - sum_of_payments;
                        balance = parseFloat(Math.round(balance * 100) / 100).toFixed(2);
                        content2 += '<td>' + numberWithCommas(balance) + '</td>';

                        var percentage = (sum_of_payments / Number(data[x].total_contract_price)) * 100;
                        percentage = parseFloat(Math.round(percentage * 100) / 100).toFixed(2);
                        
                        content2 += '<td>' + percentage + '</td>';
                        content2 += '<td>' + data[x].contract_status_name + '</td>';

                        content2 += '</tr>';

                    }

                    $('#tbody_contracts').html(content2); 
                    var tblcontracts = $('#tblcontracts').DataTable();
                    var handleTable = function () {

                    }
                    return {
                        //main function to initiate the module
                        init: function () {
                            handleTable();
                        }
                    };
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
                console.log(errorThrown);
            }
        });
    });

    $(document).on("click","#tblcontracts tr",function() {

        $("<style type='text/css'> .highlight{ background:#33F0FF;} </style>").appendTo("head");
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
        console.log(contractid);
        var data = new FormData();
        data.append('contractid',contractid);
        //data.append('clientid',$('#clientName').val());

        $.ajax({
            type: "POST",
            url:  baseurl + "collection/getClientDetails2",
            data: data,
            cache: false,
            processData:false,
            contentType:false,
            success: function(result){
                //tunga ang ips kung naay surcharge
                //r001 is equal to 20% if yes ang pay 20%
                //
                var data = jQuery.parseJSON(result);
                console.log(data);
                if (data['contract'].length != 0){
                    contract_id = data['contract'][0].contract_id;
                    balance_ratio_text = data['contract'][0].balance_ratio;
                    balance_ratio = data['contract'][0].balance_ratio;
                    $('#details').show();
                    $('#discount').text(numberWithCommas(data['discount'][0].amortization_amount));
                    $('#customerName').text(data['contract'][0].firstname+' '+data['contract'][0].lastname);
                    $('#customerTIN').text(data['contract'][0].tin);
                    $('#spouseName').text('Sample');
                    dp_ratio = data['contract'][0].downpayment_ratio;
                    dp_terms = data['contract'][0].downpayment_terms;
                    dp_interest_rate = data['contract'][0].downpayment_interest_rate;
                    dp_discount_rate = data['contract'][0].downpayment_discount_rate;
                    dp_discount = data['contract'][0].downpayment_discount;
                    dp_surcharge_rate = data['contract'][0].downpayment_surcharge_rate;
                    $('#houseprice').text(numberWithCommas(data['contract'][0].house_price));
                    $('#lotprice').text(numberWithCommas(data['contract'][0].lot_price));
                    $('#lotvat').text(numberWithCommas(data['contract'][0].lot_vat));
                    $('#customerAddress').text(data['contract'][0].line_1+', '+data['contract'][0].city_name+', '+data['contract'][0].province_name+', '+data['contract'][0].country_name);
                    $('#lotDescription').text(data['contract'][0].lot_description);
                    $('#areaSqMtr').text(data['contract'][0].lot_area);
                    $('#priceSqrMtr').text(data['contract'][0].price_per_sqr_meter);
                    $('#tcp').text(numberWithCommas(data['contract'][0].total_contract_price));
                    $('#customerName2').text(data['contract'][0].firstname+' '+data['contract'][0].lastname);
                    $('#customerAddress2').text(data['contract'][0].line_1+', '+data['contract'][0].city_name+', '+data['contract'][0].province_name+', '+data['contract'][0].country_name);
                    $('#lotDescription2').text(data['contract'][0].lot_description);
                    $('#areaSqMtr2').text(data['contract'][0].lot_area);
                    $('#priceSqrMtr2').text(data['contract'][0].price_per_sqr_meter);
                    $('#details2').show();
                    $('#downpayment').text(data['contract'][0].downpayment_ratio+'% TCP in '+data['contract'][0].downpayment_terms+' months with '
                        +data['contract'][0].downpayment_interest_rate+'% Interest Rate, '+data['contract'][0].downpayment_discount_rate+'% Discount and '
                        +data['contract'][0].downpayment_surcharge_rate+'% Surcharge');
                    $('#balancetcp').text(data['contract'][0].balance_ratio+'% TCP in '+data['contract'][0].balance_terms+' months with '
                        +data['contract'][0].balance_interest_rate+'% Interest Rate, '+data['contract'][0].balance_discount_rate+'% Discount and '
                        +data['contract'][0].balance_surcharge_rate+'% Surcharge');
                    var total_payments = getPayments(data['contract'][0].contract_id);
                    var tcp = data['contract'][0].total_contract_price;
                    total_payments = Number(total_payments).toFixed(2);
                    $('#principalpayment').text(numberWithCommas(total_payments));
                    total_payments = Number(total_payments).toFixed(2);
                    tcp = Number(tcp).toFixed(2);
                    var principalbalance = tcp - total_payments;
                    principalbalance = principalbalance.toFixed(2)
                    $('#principalbalance').text(numberWithCommas(principalbalance));
                    $('#oldamortization').text(numberWithCommas(data['amortization'][0].amortization_amount));
                    $('#contractdate').text(converter(data['contract'][0].contract_date));
                    $('#details3').show();
                    

                } else {
                    toastr.error('No data to be shown!', 'Operation Done');
                    console.log(errorThrown);
                }

            },
            error: function (errorThrown){
                toastr.error('Error!', 'Operation Done');
                console.log(errorThrown);
            }
        });
    });
    
    $('#twenty').on('change', function() {
        if ($('#twenty').val()==1){
            $('#twenty_row').show();
            // var $br = $( "<br>" );
            // $("#twenty_row").append($br);
        }
        if ($('#twenty').val()==2){
            $('#twenty_row').hide();
        }
    });

    $("#new_term").on("change paste keyup", function() {
        var new_term_text = $("#new_term").val();
        var new_interest_text = $("#new_interest").val();
        var new_surcharge_text = $("#new_surcharge").val();
        var desc_text = "";
        desc_text = balance_ratio_text+'% in '+new_term_text+' months with '+new_interest_text+'% Interest Rate and '+new_surcharge_text+'% Surcharge Rate';
       $("#desc").text(desc_text);
    });

    $("#new_interest").on("change paste keyup", function() {
        var new_term_text = $("#new_term").val();
        var new_interest_text = $("#new_interest").val();
        var new_surcharge_text = $("#new_surcharge").val();
        var desc_text = "";
        desc_text = balance_ratio_text+'% in '+new_term_text+' months with '+new_interest_text+'% Interest Rate and '+new_surcharge_text+'% Surcharge Rate';
       $("#desc").text(desc_text);
    });

    $("#new_surcharge").on("change paste keyup", function() {
        var new_term_text = $("#new_term").val();
        var new_interest_text = $("#new_interest").val();
        var new_surcharge_text = $("#new_surcharge").val();
        var desc_text = "";
        desc_text = balance_ratio_text+'% in '+new_term_text+' months with '+new_interest_text+'% Interest Rate and '+new_surcharge_text+'% Surcharge Rate';
       $("#desc").text(desc_text);
    });

    $('#compute').click(function () {
        var twenty = $("#twenty").val();
        var principal_balance =  Number($("#principalbalance").text().replace(/,/g, ''));
        var new_term = Number($("#new_term").val());
        console.log(new_term);
        var new_interest = Number($("#new_interest").val());
        var new_interest_monthly = (new_interest/100)/12;
        console.log(new_interest);
        var new_surcharge_payable = Number($("#surcharge_balance_payable").val());
        var new_surcharge = Number($("#new_surcharge").val());
        var new_amort_date = $("#new_amort_date").val();
        var new_amortization = 0;
        var new_ips_amort = 0;
        var twenty_percent = 0;
        var content = '';

        if ($("#new_term").val()=='' || $("#new_interest").val()=='' || $("#new_surcharge").val()=='' 
            || $("#surcharge_balance_payable").val()=='' || $("#new_amort_date").val()=='' || $("#restruction_date").val()==''){
            if ($('#new_term').val()==""){
                $('#new_term').css({"border": "1px solid red"});
            } else {
                $('#new_term').css({"border": ""});
            }
            if ($('#new_interest').val()==""){
                $('#new_interest').css({"border": "1px solid red"});
            } else {
                $('#new_interest').css({"border": ""});
            }
            if ($('#new_surcharge').val()==""){
                $('#new_surcharge').css({"border": "1px solid red"});
            } else {
                $('#new_surcharge').css({"border": ""});
            }
            if ($('#surcharge_balance_payable').val()==""){
                $('#surcharge_balance_payable').css({"border": "1px solid red"});
            } else {
                $('#surcharge_balance_payable').css({"border": ""});
            }
            if ($('#new_amort_date').val()==""){
                $('#new_amort_date').css({"border": "1px solid red"});
            } else {
                $('#new_amort_date').css({"border": ""});
            }
            if ($('#restruction_date').val()==""){
                $('#restruction_date').css({"border": "1px solid red"});
            } else {
                $('#restruction_date').css({"border": ""});
            }
        } else {

            $('#new_term').css({"border": ""});
            $('#new_interest').css({"border": ""});
            $('#new_surcharge').css({"border": ""});
            $('#surcharge_balance_payable').css({"border": ""});
            $('#new_amort_date').css({"border": ""});
            $('#restruction_date').css({"border": ""});

            if (twenty==1){
                var removeDataTable = $('#tblrestructure').dataTable();
                removeDataTable.fnDestroy();
                twenty_percent = principal_balance * 0.20;
                principal_balance = principal_balance - twenty_percent;
                $("#twenty_percent_value").val(twenty_percent.toFixed(2));
                content += '<tr>';
                content += '<td>20% Payable</td>';
                content += '<td>'+ moment(new_amort_date).format("MMM DD YYYY") +'</td>';
                content += '<td>'+ numberWithCommas(twenty_percent.toFixed(2)) +'</td>';
                content += '<td>0.00</td>';
                content += '<td>'+ numberWithCommas(twenty_percent.toFixed(2)) +'</td>';
                content += '<td>0.00</td>';
                content += '<td>0.00</td>';
                content += '<td>0.00</td>';
                content += '<td>'+ numberWithCommas(principal_balance.toFixed(2)) +'</td>';
                content += '</tr>';
                new_ips_amort = new_surcharge / new_term;
                var amort = calcMonthly(principal_balance,new_term,new_interest);
                var ips_amort = calcMonthly(new_surcharge_payable,new_term,new_interest);
                $("#balance_tcp_payable").val(amort.toFixed(2));
                $("#new_monthly_amortization").val(amort.toFixed(2));
                $("#ips_amortization").val(new_ips_amort.toFixed(2));
                for(x = 1; x <= new_term ; x++ ){
                    var interest = principal_balance * new_interest_monthly;
                    var ips_interest = new_surcharge_payable * new_interest_monthly;
                    var principal = amort - interest;
                    var ips_accrued = ips_amort - ips_interest;
                    principal_balance = principal_balance - principal;
                    new_surcharge_payable = new_surcharge_payable - ips_accrued;
                    var amort_whole = amort + ips_amort;
                    var runbal_whole = principal_balance + new_surcharge_payable;
                    content += '<tr>';
                    content += '<td>R00'+x+'</td>';
                    content += '<td>'+ moment(new_amort_date).format("MMM DD YYYY"); +'</td>';
                    content += '<td>'+ numberWithCommas(amort_whole.toFixed(2)) +'</td>';
                    content += '<td>'+ numberWithCommas(interest.toFixed(2)) +'</td>';
                    content += '<td>'+ numberWithCommas(principal.toFixed(2)) +'</td>';
                    content += '<td>'+ numberWithCommas(ips_amort.toFixed(2)) +'</td>';
                    content += '<td>'+ numberWithCommas(ips_interest.toFixed(2)) +'</td>';
                    content += '<td>'+ numberWithCommas(ips_accrued.toFixed(2)) +'</td>';
                    content += '<td>'+ numberWithCommas(Math.abs(runbal_whole).toFixed(2)) +'</td>';
                    content += '<td style="display: none;">'+ numberWithCommas(Math.abs(principal_balance).toFixed(2)) +'</td>';
                    content += '<td style="display: none;">'+ numberWithCommas(Math.abs(new_surcharge_payable).toFixed(2)) +'</td>';
                    content += '</tr>';
                    new_amort_date = moment(new_amort_date).add(1, 'month');
                }
                console.log(content);
                $('#tbody_restructure').html(content);
                $('#tblrestructure').DataTable({
                    "ordering": false,
                }); 
                $("#restructure_table_row").show();

            } else {
                //IPS NEEDED
                var removeDataTable = $('#tblrestructure').dataTable();
                removeDataTable.fnDestroy();
                var amort = calcMonthly(principal_balance,new_term,new_interest);
                var ips_amort = calcMonthly(new_surcharge_payable,new_term,new_interest);
                $("#balance_tcp_payable").val(amort.toFixed(2));
                $("#new_monthly_amortization").val(amort.toFixed(2));
                $("#ips_amortization").val(new_ips_amort.toFixed(2));
                for(x = 1; x <= new_term ; x++ ){
                    var interest = principal_balance * new_interest_monthly;
                    var ips_interest = new_surcharge_payable * new_interest_monthly;
                    var principal = amort - interest;
                    var ips_accrued = ips_amort - ips_interest;
                    principal_balance = principal_balance - principal;
                    new_surcharge_payable = new_surcharge_payable - ips_accrued;
                    var amort_whole = amort + ips_amort;
                    var runbal_whole = principal_balance + new_surcharge_payable;
                    content += '<tr>';
                    content += '<td>R00'+x+'</td>';
                    content += '<td>'+ moment(new_amort_date).format("MMM DD YYYY"); +'</td>';
                    content += '<td>'+ numberWithCommas(amort_whole.toFixed(2)) +'</td>';
                    content += '<td>'+ numberWithCommas(interest.toFixed(2)) +'</td>';
                    content += '<td>'+ numberWithCommas(principal.toFixed(2)) +'</td>';
                    content += '<td>'+ numberWithCommas(ips_amort.toFixed(2)) +'</td>';
                    content += '<td>'+ numberWithCommas(ips_interest.toFixed(2)) +'</td>';
                    content += '<td>'+ numberWithCommas(ips_accrued.toFixed(2)) +'</td>';
                    content += '<td>'+ numberWithCommas(Math.abs(runbal_whole).toFixed(2)) +'</td>';
                    content += '<td style="display: none;">'+ numberWithCommas(Math.abs(principal_balance).toFixed(2)) +'</td>';
                    content += '<td style="display: none;">'+ numberWithCommas(Math.abs(new_surcharge_payable).toFixed(2)) +'</td>';
                    content += '</tr>';
                    new_amort_date = moment(new_amort_date).add(1, 'month');
                }

                $('#tbody_restructure').html(content); 
                $('#tblrestructure').DataTable({
                    "ordering": false,
                });
                $("#restructure_table_row").show();
            }
        }
        
    });

    $('#save').click(function () {
        var principal_balance =  parseFloat($("#principalbalance").text().replace(/,/g, ''));
        principalbalance = Number(principal_balance);
        var new_term = parseFloat($("#new_term").val());
        var new_interest = parseFloat($("#new_interest").val());
        var new_surcharge = parseFloat($("#surcharge_balance_payable").val());
        var twenty = $("#twenty").val();
        var new_amortization = 0;
        var new_ips_amort = 0;
        var twenty_percent = 0;
        if ($("#new_term").val()=='' || $("#new_interest").val()=='' || $("#new_surcharge").val()=='' 
            || $("#surcharge_balance_payable").val()=='' || $("#new_amort_date").val()=='' || $("#restruction_date").val()==''){
            if ($('#new_term').val()==""){
                $('#new_term').css({"border": "1px solid red"});
            } else {
                $('#new_term').css({"border": ""});
            }
            if ($('#new_interest').val()==""){
                $('#new_interest').css({"border": "1px solid red"});
            } else {
                $('#new_interest').css({"border": ""});
            }
            if ($('#new_surcharge').val()==""){
                $('#new_surcharge').css({"border": "1px solid red"});
            } else {
                $('#new_surcharge').css({"border": ""});
            }
            if ($('#surcharge_balance_payable').val()==""){
                $('#surcharge_balance_payable').css({"border": "1px solid red"});
            } else {
                $('#surcharge_balance_payable').css({"border": ""});
            }
            if ($('#new_amort_date').val()==""){
                $('#new_amort_date').css({"border": "1px solid red"});
            } else {
                $('#new_amort_date').css({"border": ""});
            }
            if ($('#restruction_date').val()==""){
                $('#restruction_date').css({"border": "1px solid red"});
            } else {
                $('#restruction_date').css({"border": ""});
            }
        } else {

            var newterm = $("#new_term").val();
            var interestrate = $("#new_interest").val();
            var surchargerate = $("#new_surcharge").val();
            var restructiondate = $("#restruction_date").val();
            var newamortdate = $("#new_amort_date").val();
            var principalbalance = $("#principalbalance").text().replace(/,/g, '');
            
            var TableData1 = [];
            var rows = $("#tblrestructure").dataTable().fnGetNodes();
            console.log(rows);
            for(var i=0; i<rows.length;i++)
            {
                TableData1[i] = {
                    "desc" : $(rows[i]).find("td:eq(0)").html()
                    , "duedate" :moment($(rows[i]).find("td:eq(1)").html()).format("YYYY-MM-DD")
                    , "amort" : $(rows[i]).find("td:eq(2)").html().replace(/,/g, '')
                    , "interest" : $(rows[i]).find("td:eq(3)").html().replace(/,/g, '')
                    , "principal" : $(rows[i]).find("td:eq(4)").html().replace(/,/g, '')
                    , "ips_amort" : $(rows[i]).find("td:eq(5)").html().replace(/,/g, '')
                    , "ips_interest" : $(rows[i]).find("td:eq(6)").html().replace(/,/g, '')
                    , "ips_accrued" : $(rows[i]).find("td:eq(7)").html().replace(/,/g, '')
                    , "runbal" : $(rows[i]).find("td:eq(8)").html().replace(/,/g, '')
                    , "outbal" : $(rows[i]).find("td:eq(9)").html().replace(/,/g, '')
                    , "ipsbal" : $(rows[i]).find("td:eq(10)").html().replace(/,/g, '')
                }
            }
            console.log(TableData1);

            var data = JSON.stringify(TableData1);
            console.log(data);
            $.ajax({
                type: "POST",
                url:  baseurl + "collection/save_restructured_contract",
                data: {'data':data,'contractid':contract_id,'balanceratio':balance_ratio,'newterm':newterm,'interestrate':interestrate,
                        'surchargerate':surchargerate,'restructiondate':restructiondate,'newamortdate':newamortdate,'principalbalance':principalbalance,
                        'dp_ratio':dp_ratio,'dp_terms':dp_terms,'dp_interest_rate':dp_interest_rate,'dp_discount_rate':dp_discount_rate,
                        'dp_discount':dp_discount,'dp_surcharge_rate':dp_surcharge_rate,'user_id':user_id},
                success: function(data){
                    toastr.success('Successfully Saved!', 'Operation Done');
                    console.log(data);
                },
                error: function(data){

                },
            });
            
        }

    });
    
    $('#print').click(function () {

        var customer = $('#customerName').text();
        var lotdesc = $('#lotDescription').text();
        var dp = $('#downpayment').text();
        var baldesc = $('#desc').text();
        var area = $('#areaSqMtr').text();
        var price = $('#priceSqrMtr').text();
        var tcp = $('#tcp').text();
        var contractdate = $('#contractdate').text();
        var houseprice = $('#houseprice').text();
        var lotprice = $('#lotprice').text();
        var lotvat = $('#lotvat').text();

        var TableData1 = [];
        var rows = $("#tblrestructure").dataTable().fnGetNodes();
        console.log(rows);
        for(var i=0; i<rows.length;i++)
        {
            TableData1[i] = {
                "desc" : $(rows[i]).find("td:eq(0)").html()
                , "duedate" :moment($(rows[i]).find("td:eq(1)").html()).format("YYYY-MM-DD")
                , "amort" : $(rows[i]).find("td:eq(2)").html().replace(/,/g, '')
                , "interest" : $(rows[i]).find("td:eq(3)").html().replace(/,/g, '')
                , "principal" : $(rows[i]).find("td:eq(4)").html().replace(/,/g, '')
                , "ips_amort" : $(rows[i]).find("td:eq(5)").html().replace(/,/g, '')
                , "ips_interest" : $(rows[i]).find("td:eq(6)").html().replace(/,/g, '')
                , "ips_accrued" : $(rows[i]).find("td:eq(7)").html().replace(/,/g, '')
                , "runbal" : $(rows[i]).find("td:eq(8)").html().replace(/,/g, '')
                , "outbal" : $(rows[i]).find("td:eq(9)").html().replace(/,/g, '')
                , "ipsbal" : $(rows[i]).find("td:eq(10)").html().replace(/,/g, '')
            }
        }
        console.log(TableData1);

        var data = JSON.stringify(TableData1);

        $.ajax({
            type: "POST",
            url:  baseurl + "collection/print_restructured",
            data: {'data':data,'customer':customer,'lotdesc':lotdesc,'dp':dp,'baldesc':baldesc,'area':area,'price':price,'tcp':tcp,'contractdate':contractdate
        ,'houseprice':houseprice,'lotvat':lotvat,'lotprice':lotprice},
            success: function(data){
                var url = baseurl + "reports/RestructuredAmortization.pdf";
                var win = window.open(url, '_blank');
                win.focus();
            },
            error: function(data){

            },
        });
    });

});

window.onload = computeLoan;
function computeLoan(){
    var amount = 333000;
    var interest_rate = 3;
    var months = 3;
    var interest = (amount * (interest_rate * .01)) / months;
    var payment = ((amount / months) + interest).toFixed(2);
    payment = payment.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    console.log(payment);
}
function PMT(ir, np, pv, fv, type) {
    /*
     * ir   - interest rate per month
     * np   - number of periods (months)
     * pv   - present value
     * fv   - future value
     * type - when the payments are due:
     *        0: end of the period, e.g. end of month (default)
     *        1: beginning of period
     */
    var pmt, pvif;

    fv || (fv = 0);
    type || (type = 0);

    if (ir === 0)
        return -(pv + fv)/np;

    pvif = Math.pow(1 + ir, np);
    pmt = - ir * pv * (pvif + fv) / (pvif - 1);

    if (type === 1)
        pmt /= (1 + ir);

    return pmt;
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

function formatDate(date) {
    var d = new Date(date),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();

    if (month.length < 2) month = '0' + month;
    if (day.length < 2) day = '0' + day;

    return [year, month, day].join('-');
}

function numberWithCommas(x) {
    var parts = x.toString().split(".");
    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    return parts.join(".");
}

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
                sum_of_payments = +sum_of_payments + +Number(data[x].principal);
            }
        },
        error: function (errorThrown){
            toastr.error('Error!', 'Operation Done');
            console.log(errorThrown);
        }
    });
    return sum_of_payments;
}

var statusOfContract = 0;
function checkContractStatus(contractid,amount) {

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
            
            for(x=0; x < data['payment'].length; x++){
                sumofpayments = +sumofpayments + +Number(data['payment'][x].principal);
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

function converter(s) {

  var months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
  s =  s.replace(/-/g, '/');
  var d = new Date(s);

  return months[d.getMonth()] + ' ' + d.getDate() + ', ' + d.getFullYear();
}

function calcMonthly(principal,numPay,intRate) {
  var monthly;
  var intRate=(intRate/100)/12;
  var principal;
  // The accounting formula to calculate the monthly payment is
  //    M = P * ((I + 1)^N) * I / (((I + 1)^N)-1)
  // The following code  transforms this accounting formula into JavaScript to calculate the monthly payment
  if(intRate!="" && intRate > 0){
  monthly=(principal*(Math.pow((1+intRate),numPay))*intRate/(Math.pow((1+intRate),numPay)-1));

  }else{
    monthly=(principal/numPay);
  }
  console.log("monthly->"+monthly);
  return monthly;
}