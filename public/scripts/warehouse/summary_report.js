$(document).ready(function(){
  var po_table = $("#po_table").DataTable();
  var sent_prf_table = $('#sent_prf_table').DataTable({searching: false, paging: false});

    if($('#itemAvailability').val()) {
        toastr.error('Item Quantity is Low.', 'Alert');
        toastr.error('Cannot generate receiving report.', 'Error');
    } else {
        $('.actions').show();
    }

  $('#po_table').on('dblclick', 'tr', function () {
    var row = $(this).closest('tr')[0];
    var po_id = po_table.cell( row, 0 ).data();

    /*$.ajax({
        type: "POST",
        url : $("#remark_button").val(),
        dataType : "json",
        data: { po_id: po_id }
    });*/

    window.open(baseurl+"Warehouse/report_controller/report_po?poid="+po_id);
 });

  $('.po_buttons').on('click', '#status_confirm', function(e) {
    var button_clicked = $(this).data('value');
    if(button_clicked == "incomplete" && $('#po_status_remark').val() == "") {
        e.preventDefault();
        alert("Please write a remark why it's incomplete.");
    }
    $('#status_clicked').val(button_clicked);
 });

    $('#generateReport').click(function (event) {
        var data = new FormData();
        data.append('fromDate',$('#fromDate').val());
        data.append('toDate',$('#toDate').val());
        for (var pair of data.entries()) {
            console.log(pair[0]+ ', ' + pair[1]); 
        }
        $.ajax({
            type: "POST",
            url:  baseurl + "logistics/report_controller/generateSalesReport",
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
                    content += '<td>' + data[i].po_id + '</td>';
                    content += '<td>' + data[i].supplier_id + '</td>';
                    content += '<td>' + data[i].po_date + '</td>';
                    content += '<td>' + data[i].department_name + '</td>';
                    content += '<td>' + data[i].prf_id + '</td>';
                    
                    content += '<td>';
                    if (data[i].pbudget_id!=0){ content += data[i].po_price * data[i].po_qty; }
                   
                    content += '</td>';

                    content += '<td>';
                    if (data[i].pbudget_id==0){ content += data[i].po_price * data[i].po_qty; }
                    content += '</td>';
        
                    // if (data[i].is_paid==1){ content += 'Fully Paid';} else { content += 'Installment';}
                    // content += '</td>';
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

    $('#pdf_amort_sched').on('click', function() {
        var po_id = $('#po_id').val();
        window.open(baseurl+"Warehouse/report_controller/pdfPO?po_id="+po_id);
    });

    $('#generate_receiving_report').on('click', function(event) {
        $('#loadings').show();
        event.preventDefault();

        var po_id = $('#po_id').val();
        var po_mod = $("input[name='po_mod']:checked").val();
        var serializeData = $('#po_form').serialize();

        if ( $('#dr_no').val() < 0 && $('#invoice_no').val() > 0 ) {
            toastr.error("Invalid delivery receipt number or invoice number.", 'Error');
        } else if ( $('#dr_no').val() > 0 && $('#invoice_no').val() < 0 ) {
            toastr.error("Invalid delivery receipt number or invoice number.", 'Error');
        } else if ( $('#dr_no').val() == 0 && $('#invoice_no').val() == 0 ) {
            toastr.error("Invalid delivery receipt number or invoice number.", 'Error');
        }

        if(po_mod == null) {
            toastr.error('Please choose a mode of delivery.', 'Error');
        }

        if(po_mod != null && (($('#dr_no').val() > 0 && $('#invoice_no').val() >= 0) || ($('#dr_no').val() >= 0 && $('#invoice_no').val() > 0))) {
            $.ajax({
                type: 'POST',
                url: baseurl + "Warehouse/report_controller/generateRR",
                data: { serializeData: serializeData },
                success: function(data) {
                    toastr.success('Successfully generated a receiving report.');
                    setTimeout(function() {
                        window.location.href = "/abci/Warehouse/report_controller/report_po?poid=" + po_id;
                    }, 2000);
                },
                error: function(data) {
                    toastr.error('Unsuccessful in generating a receiving report.');
                    toastr.error('Try again.');
                }
            });
        }
        $('#loadings').hide();
    });

    $('#cancel_po').on('click', function(event) {
        $('#loadings').show();
        event.preventDefault();

        var po_id = $('#po_id').val();
        var po_mod = $("input[name='po_mod']:checked").val();
        var serializeData = $('#po_form').serialize();

        $.ajax({
            type: 'POST',
            url: baseurl + "Warehouse/report_controller/cancelPO",
            data: { serializeData: serializeData },
            success: function(data) {
                setTimeout(function() {
                    window.location.href = "/abci/Warehouse/cancelled_reports";
                }, 2000);
            },
            error: function(data) {
                toastr.error('Try again.');
            }
        });
    });

//-----------------------------------POdetailsReport
});
