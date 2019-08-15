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

    var supps = $('#tblsupp').DataTable();
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

    var emps = $('#tblemp').DataTable();
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

    var acccodes = $('#tblacccodes').DataTable();
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

    var bookcodes1 = $('#tblbookcodes1').DataTable();
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

    var bookcodes2 = $('#tblbookcodes2').DataTable();
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
        console.log(clientid);
        $.ajax({
            type: "POST",
            url:  baseurl + "collection/get_customer_desc",
            data: {'clientid':clientid},
            success: function(result){

                var data = jQuery.parseJSON(result);
                console.log(data);
                
                $('#subsidiary_name').text(data[0].firstname+' '+data[0].middlename+' '+data[0].lastname);
                $('#subsidiary_type').text('Customer');
                $('#subsidiary_code').text(data[0].subsidiary_code);
            },
            error: function(result){
            }
        });

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
        var orgid = table.rows[col].cells[0].innerHTML;
        console.log(orgid);
        $.ajax({
            type: "POST",
            url:  baseurl + "collection/get_org_desc",
            data: {'orgid':orgid},
            success: function(result){

                var data = jQuery.parseJSON(result);
                console.log(data);
                
                $('#subsidiary_name').text(data[0].organization_name);
                $('#subsidiary_type').text('Organization');
                $('#subsidiary_code').text(data[0].subsidiary_code);
            },
            error: function(result){
            }
        });

    });

    $(document).on("click","#tblsupp tr",function() {
        $("<style type='text/css'> .highlight{ background:#33F0FF;} </style>").appendTo("head");
        $("#tblsupp tr").each(function () {
            if ( $(this).hasClass('highlight') ) {
                $(this).removeClass('highlight');
            }
        });
        $(this).addClass("highlight");
        var table = document.getElementById("tblsupp");
        var col = $(this).parent().children().index($(this));
        var row = $(this).parent().parent().children().index($(this).parent());
        col = Number(col);
        col = +col + 1;
        var suppid = table.rows[col].cells[0].innerHTML;
        console.log(suppid);
        $.ajax({
            type: "POST",
            url:  baseurl + "collection/get_supp_desc",
            data: {'suppid':suppid},
            success: function(result){

                var data = jQuery.parseJSON(result);
                console.log(data);
                
                $('#subsidiary_name').text(data[0].organization_name);
                $('#subsidiary_type').text('Supplier');
                $('#subsidiary_code').text(data[0].subsidiary_code);
            },
            error: function(result){
            }
        });

    });

    $(document).on("click","#tblemp tr",function() {
        $("<style type='text/css'> .highlight{ background:#33F0FF;} </style>").appendTo("head");
        $("#tblemp tr").each(function () {
            if ( $(this).hasClass('highlight') ) {
                $(this).removeClass('highlight');
            }
        });
        $(this).addClass("highlight");
        var table = document.getElementById("tblemp");
        var col = $(this).parent().children().index($(this));
        var row = $(this).parent().parent().children().index($(this).parent());
        col = Number(col);
        col = +col + 1;
        var empid = table.rows[col].cells[0].innerHTML;
        console.log(empid);
        $.ajax({
            type: "POST",
            url:  baseurl + "collection/get_emp_desc",
            data: {'empid':empid},
            success: function(result){

                var data = jQuery.parseJSON(result);
                console.log(data);
                
                $('#subsidiary_name').text(data[0].firstname+' '+data[0].middlename+' '+data[0].lastname);
                $('#subsidiary_type').text('Customer');
                $('#subsidiary_code').text(data[0].subsidiary_code);
            },
            error: function(result){
            }
        });

    });

    //crossroads
    //cry me a river
    

    $(document).on("click","#tblacccodes tr",function() {
        $("<style type='text/css'> .highlight{ background:#33F0FF;} </style>").appendTo("head");
        $("#tblacccodes tr").each(function () {
            if ( $(this).hasClass('highlight') ) {
                $(this).removeClass('highlight');
            }
        });
        $(this).addClass("highlight");
        var table = document.getElementById("tblacccodes");
        var col = $(this).parent().children().index($(this));
        var row = $(this).parent().parent().children().index($(this).parent());
        col = Number(col);
        col = +col + 1;
        var acccode = table.rows[col].cells[0].innerHTML;
        var acccodedesc = table.rows[col].cells[1].innerHTML;
        console.log(acccode);
        console.log(acccodedesc);

        $('#accountcode').val(acccode);
        $('#accountcode_desc').text(acccodedesc);

        $('#accountCodeModal').modal('toggle');

    });

    $(document).on("click","#tblbookcodes1 tr",function() {
        $("<style type='text/css'> .highlight{ background:#33F0FF;} </style>").appendTo("head");
        $("#tblbookcodes1 tr").each(function () {
            if ( $(this).hasClass('highlight') ) {
                $(this).removeClass('highlight');
            }
        });
        $(this).addClass("highlight");
        var table = document.getElementById("tblbookcodes1");
        var col = $(this).parent().children().index($(this));
        var row = $(this).parent().parent().children().index($(this).parent());
        col = Number(col);
        col = +col + 1;
        var bookcode = table.rows[col].cells[0].innerHTML;
        var bookcodedesc = table.rows[col].cells[1].innerHTML;
        var bookcode_prefix = table.rows[col].cells[2].innerHTML;
        console.log(bookcode);
        console.log(bookcodedesc);
        console.log(bookcode_prefix);

        $('#bookcode1').val(bookcode);
        $('#bookcode_desc').text(bookcodedesc);
        $('#bookcode_prefix').text(bookcode_prefix);

        $('#bookCodeModal1').modal('toggle');

    });

    $(document).on("click","#tblbookcodes2 tr",function() {
        $("<style type='text/css'> .highlight{ background:#33F0FF;} </style>").appendTo("head");
        $("#tblbookcodes2 tr").each(function () {
            if ( $(this).hasClass('highlight') ) {
                $(this).removeClass('highlight');
            }
        });
        $(this).addClass("highlight");
        var table = document.getElementById("tblbookcodes2");
        var col = $(this).parent().children().index($(this));
        var row = $(this).parent().parent().children().index($(this).parent());
        col = Number(col);
        col = +col + 1;
        var bookcode = table.rows[col].cells[0].innerHTML;
        var bookcodedesc = table.rows[col].cells[1].innerHTML;
        var bookcode_prefix = table.rows[col].cells[2].innerHTML;
        console.log(bookcode);
        console.log(bookcodedesc);
        console.log(bookcode_prefix);

        $('#bookcode').val(bookcode);
        $('#bookcode_desc').text(bookcodedesc);
        $('#bookcode_prefix').text(bookcode_prefix);

        $('#bookCodeModal').modal('toggle');

    });

    $('#customer').on('change', function() {
        var clientid = $('#customer').val();
        console.log(clientid);
        $.ajax({
            type: "POST",
            url:  baseurl + "collection/populateDropdownCProperties",
            data: {'clientid':clientid},
            success: function(result){

                var data = jQuery.parseJSON(result);
                console.log(data);
                var content = '';
                content += '<option value="0" class ="disabled selected">Select Here..</option>';
                //$('#subcode').text(data[0].subsidiary_code);
                for (var x = 0; x < data.length; x++) {
                    content += '<option value="' + data[x].contract_id + '">' + data[x].lot_description + '</option>'; 
                }
                $('#contracts').html(content);

            },
            error: function(result){
            }
        });
    });  

    $('#tblsundrypayments').on('click', 'input[type="button"]', function(e){
       $(this).closest('tr').remove()
    })
    
    $('#add').click(function() {
    
        var account_code = $('#accountcode').val();
        var account_description = $('#accountcode_desc').text();
        var book_code = $('#bookcode1').val();
        var book_description = $('#bookcode_desc').text();
        var book_prefix = $('#bookcode_prefix').text();
        var debit = Number($('#debit').val());
        var credit = Number($('#credit').val());
        var amount = debit + credit;

        
        if($('#bookcode1').val()=="" || amount<1 || $('#accountcode').val()==""){
            if ($('#bookcode1').val()==''){
                $('#bookcode1').css({"border": "1px solid red"});
            } else {
                $('#bookcode1').css({"border": ""});
            }
            if ($('#accountcode').val()==''){
                $('#accountcode').css({"border": "1px solid red"});
            } else {
                $('#accountcode').css({"border": ""});
            }
            if ($('#debit').val()=='' || $('#credit').val()){
                if ($('#debit').val()==''){
                    $('#debit').css({"border": "1px solid red"});
                } else {
                    $('#debit').css({"border": ""});
                }
                if ($('#credit').val()==''){
                    $('#credit').css({"border": "1px solid red"});
                } else {
                    $('#credit').css({"border": ""});
                }
            } else {
                $('#debit').css({"border": ""});
                $('#credit').css({"border": ""});
            }
        } else {
            $('#tblsundrypayments tr:last').after('<tr><td>'+account_code+'</td><td>'+account_description+'</td><td>'+book_code+'</td><td>'+book_prefix+'</td><td>'+debit+'</td><td>'+credit+'</td><td><input type="button" value="Delete" onclick="deleteRow(this)"></td></tr>');
        }

    });    

    $('#save').click(function() {
        var table = document.getElementById( "tblsundrypayments" );
    
        var total_debit_and_credit = 0;
        for(var y=1; y<table.rows.length;y++){
            total_debit_and_credit += Number(table.rows[y].cells[4].innerHTML);
            total_debit_and_credit += Number(table.rows[y].cells[5].innerHTML);
        }
        console.log(total_debit_and_credit);

        var customername = $('#subsidiary_name').text();
        var subcode = $('#subsidiary_code').text();
        var subtype = $('#subsidiary_type').text();
        var book_code_top = $('#bookcode1').val();
        var book_prefix_top = $('#bookcode_prefix').text();
        var paymenttype = $('#paymenttype').val();
        var vatableamount = $('#vatableamount').val();
        var vat = $('#vatamount').val();
        console.log(book_prefix_top);
        console.log(vat);

        var TableData = [];
        
        var x=0;
        for(var i=1; i<table.rows.length;i++)
        {

            TableData[x] = {
                "account_code" : table.rows[i].cells[0].innerHTML
                , "account_name" : table.rows[i].cells[1].innerHTML
                , "book_code" : table.rows[i].cells[2].innerHTML
                , "book_prefix" : table.rows[i].cells[3].innerHTML
                , "debit" : table.rows[i].cells[4].innerHTML
                , "credit" : table.rows[i].cells[5].innerHTML
            }
            x++;
        }
        console.log(TableData);

        var data = JSON.stringify(TableData);
        var total_amount = Number($('#cash').val());
        total_amount = total_amount + Number($('#checkamount').val());
        total_amount = total_amount + Number($('#depositamount').val());

        total_debit_and_credit
        if (total_amount >= total_debit_and_credit){
            if($('#paymenttype').val()==1){
                if($('#paymentdate').val()=='' || $('#cash').val()==0){
                    if ($('#paymentdate').val()==''){
                        $('#paymentdate').css({"border": "1px solid red"});
                    } else {
                        $('#paymentdate').css({"border": ""});
                    }
                    if ($('#cash').val()==0){
                        $('#cash').css({"border": "1px solid red"});
                    } else {
                        $('#cash').css({"border": ""});
                    }
                } else {
                    var paymentdate = $('#paymentdate').val();
                    var cashamount = $('#cash').val();

                    $.ajax({
                        type: "POST",
                        url:  baseurl + "collection/pay_sundry",
                        data: {'paymenttype':paymenttype,'paymentdate':paymentdate,'cashamount':cashamount,'customername':customername,
                        'subcode':subcode,'subtype':subtype,'data':data,'cashier_id':user_id,'book_code_top':book_code_top,'book_prefix_top':book_prefix_top,'vatableamount':vatableamount,'vat':vat},
                        success: function(result){
                            toastr.success('Successfully Saved!', 'Operation Done');
                            var url = baseurl + "reports/SundryReceipt.pdf";
                            var win = window.open(url, '_blank');
                            win.focus();
                        },
                        error: function(result){
                        }
                    });
                }
            }
            if($('#paymenttype').val()==2){
                if($('#paymentdate').val()=='' || $('#checkamount').val()==0 || $('#checknumber').val()=='' || $('#checkdate').val()=='' || $('#bank2').val()==0){
                    if ($('#paymentdate').val()==''){
                        $('#paymentdate').css({"border": "1px solid red"});
                    } else {
                        $('#paymentdate').css({"border": ""});
                    }
                    if ($('#checkamount').val()==0){
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
                    if ($('#bank2').val()==0){
                        $('#bank2').css({"border": "1px solid red"});
                    } else {
                        $('#bank2').css({"border": ""});
                    }
                } else {
                    var paymentdate = $('#paymentdate').val();
                    var checkamount = $('#checkamount').val();
                    var checknumber = $('#checknumber').val();
                    var checkdate = $('#checkdate').val();
                    var bankid = $('#bank2').val();
                    var bankname = $('#bank option:selected').text();

                    $.ajax({
                        type: "POST",
                        url:  baseurl + "collection/pay_sundry",
                        data: {'bankid':bankid,'bankname':bankname,'checkdate':checkdate,'checknumber':checknumber,'paymenttype':paymenttype,'paymentdate':paymentdate,'checkamount':checkamount,
                        'customername':customername,'subcode':subcode,'subtype':subtype,'data':data,'cashier_id':user_id,'book_code_top':book_code_top,'book_prefix_top':book_prefix_top,
                        'vatableamount':vatableamount,'vat':vat},
                        success: function(result){
                            toastr.success('Successfully Saved!', 'Operation Done');
                            var url = baseurl + "reports/SundryReceipt.pdf";
                            var win = window.open(url, '_blank');
                            win.focus();
                        },
                        error: function(result){
                        }
                    });
                }
            }
            if($('#paymenttype').val()==3){
                if($('#paymentdate').val()=='' || $('#cash').val()==0 || $('#checkamount').val()==0 || $('#checknumber').val()=='' || $('#checkdate').val()=='' || $('#bank2').val()==0){
                    if ($('#paymentdate').val()==''){
                        $('#paymentdate').css({"border": "1px solid red"});
                    } else {
                        $('#paymentdate').css({"border": ""});
                    }
                    if ($('#cash').val()==0){
                        $('#cash').css({"border": "1px solid red"});
                    } else {
                        $('#cash').css({"border": ""});
                    }
                    if ($('#checkamount').val()==0){
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
                    if ($('#bank2').val()==0){
                        $('#bank2').css({"border": "1px solid red"});
                    } else {
                        $('#bank2').css({"border": ""});
                    }
                    if ($('#bank2').val()==0){
                        $('#bank2').css({"border": "1px solid red"});
                    } else {
                        $('#bank2').css({"border": ""});
                    }
                } else {
                    var paymentdate = $('#paymentdate').val();
                    var cashamount = $('#cash').val();
                    var checkamount = $('#checkamount').val();
                    var checknumber = $('#checknumber').val();
                    var checkdate = $('#checkdate').val();
                    var bankid = $('#bank2').val();
                    var bankname = $('#bank option:selected').text();

                    $.ajax({
                        type: "POST",
                        url:  baseurl + "collection/pay_sundry",
                        data: {'bankid':bankid,'bankname':bankname,'checkdate':checkdate,'checknumber':checknumber,'paymenttype':paymenttype,'paymentdate':paymentdate,'cashamount':cashamount,
                        'checkamount':checkamount,'customername':customername,'subcode':subcode,'subtype':subtype,'data':data,'cashier_id':user_id,'book_code_top':book_code_top,
                        'book_prefix_top':book_prefix_top,'vatableamount':vatableamount,'vat':vat},
                        success: function(result){
                            toastr.success('Successfully Saved!', 'Operation Done');
                            var url = baseurl + "reports/SundryReceipt.pdf";
                            var win = window.open(url, '_blank');
                            win.focus();
                        },
                        error: function(result){
                        }
                    });
                    
                }
            }
            if($('#paymenttype').val()==4){
                if($('#paymentdate').val()=='' || $('#depositamount').val()==0 || $('#accountnumber').val()=='' || $('#depositdate').val()=='' || $('#bank').val()==0){
                    if ($('#paymentdate').val()==''){
                        $('#paymentdate').css({"border": "1px solid red"});
                    } else {
                        $('#paymentdate').css({"border": ""});
                    }
                    if ($('#depositamount').val()==0){
                        $('#depositamount').css({"border": "1px solid red"});
                    } else {
                        $('#depositamount').css({"border": ""});
                    }
                    if ($('#accountnumber').val()==''){
                        $('#accountnumber').css({"border": "1px solid red"});
                    } else {
                        $('#accountnumber').css({"border": ""});
                    }
                    if ($('#depositdate').val()==''){
                        $('#depositdate').css({"border": "1px solid red"});
                    } else {
                        $('#depositdate').css({"border": ""});
                    }
                    if ($('#bank').val()==0){
                        $('#bank').css({"border": "1px solid red"});
                    } else {
                        $('#bank').css({"border": ""});
                    }
                } else {
                    var paymentdate = $('#paymentdate').val();
                    var depositamount = $('#depositamount').val();
                    var accountnumber = $('#accountnumber').val();
                    var depositdate = $('#depositdate').val();
                    var bankid = $('#bank').val();
                    var bankname = $('#bank option:selected').text();

                    $.ajax({
                        type: "POST",
                        url:  baseurl + "collection/pay_sundry",
                        data: {'bankid':bankid,'bankname':bankname,'depositdate':depositdate,'accountnumber':accountnumber,'paymenttype':paymenttype,'paymentdate':paymentdate,'depositamount':depositamount,
                        'customername':customername,'subcode':subcode,'subtype':subtype,'data':data,'cashier_id':user_id,'book_code_top':book_code_top,'book_prefix_top':book_prefix_top,
                        'vatableamount':vatableamount,'vat':vat},
                        success: function(result){
                            toastr.success('Successfully Saved!', 'Operation Done');
                            var url = baseurl + "reports/SundryReceipt.pdf";
                            var win = window.open(url, '_blank');
                            win.focus();
                        },
                        error: function(result){
                        }
                    });
                }
            }
        } else {
            toastr.error('Error!', 'Insufficient amount!');
        }

    });

    $('#paymenttype').on('change', function() {
        if($('#paymenttype').val()==1){
            $('.cash').show();
            $('.check').hide();
            $('.interbranch').hide();
        }
        if($('#paymenttype').val()==2){
            $('.cash').hide();
            $('.check').show();
            $('.interbranch').hide();
        }
        if($('#paymenttype').val()==3){
            $('.cash').show();
            $('.check').show();
            $('.interbranch').hide();
        }
        if($('#paymenttype').val()==4){
            $('.cash').hide();
            $('.check').hide();
            $('.interbranch').show();
        }
    });

    $('#account').on('change', function() {
        $('#accountcode_desc').text($('#account').val());
    }); 

    $('#book').on('change', function() {
        console.log($('#book').val());
        $('#bookcode_desc').text($('#book').val());
        if ($('#book').val()==0){
            toastr.error('Error!', 'Invalid Option!');
        } else {
            $('#bookcode_prefix').text(getPrefix($('#book option:selected').text()));
        }
    }); 

});
// window.onload = makeTable;
// function makeTable() {
//     $('#tblsundrypayments').DataTable();
// }
var account_description = '';
function get_account_description(account_code){
    $.ajax({
        type: "POST",
        url:  baseurl + "collection/get_account_code_description",
        data: {'account_code':account_code},
        success: function(result){
            var data = jQuery.parseJSON(result);
            console.log(data[0].account_name);
            account_description = data[0].account_name;  
            console.log(account_description);
            //return account_description;
        },
        error: function(result){
        }
    });
    return account_description;
}

function getPrefix(code){
    var book_prefix = '';
    $.ajax({
        type: "POST",
        url:  baseurl + "collection/get_book_code_prefix",
        data: {'book_code':code},
        async: false,
        success: function(result){
            var data = jQuery.parseJSON(result);
            console.log(data[0].book_reference);
            book_prefix = data[0].book_reference;  
            console.log(book_prefix);
        },
        error: function(result){
        }
    });
    return book_prefix;
}

function deleteRow(r) {
    var i = r.parentNode.parentNode.rowIndex;
    document.getElementById("myTable").deleteRow(i);
}