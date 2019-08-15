jQuery(document).ready( function($) {

    var po_table = $("#po_table").DataTable();
    var tbl_issuance_detail = $("#tbl_issuance_detail").DataTable();
    var sent_prf_table = $('#sent_prf_table').DataTable({searching: false,'columnDefs': [
        {
            'targets': [ 5, 6 ],
            'createdCell':  function (td, cellData, rowData, row, col) {
                $(td).attr('id', 'td_qty'); 
            }
        }
    ]});

    $('.po_buttons').on('click', '#status_confirm', function(e) {
        console.log("po_buttons");
        var button_clicked = $(this).data('value');
        if($('#dr_no').val() <= 0) {
            e.preventDefault();
            toastr.error("Invalid delivery receipt number.");
        }
        if($('#invoice_no').val() <= 0) {
            e.preventDefault();
            toastr.error("Invalid invoice number.");
        }
        $('#status_clicked').val(button_clicked);
    });

    $('td > #received_qty').on('input', function() {
        var qty = $(this).parent().prev().children('#td_qty > .qty').val();
        var received_qty = $(this).val();
        if(received_qty < 0) {
            toastr.error('Please input a non-negative number.');
        }
    });

    $('#pdf_amort_sched').on('click', function() {
        var po_id = $('#po_id').val();
        window.open(baseurl+"Warehouse/adminsaving/pdfPO?po_id="+po_id);
    });

    $('#po_table').on('click', 'tbody tr', function(e){
        e.preventDefault();

        var row = $(this).closest('tr')[0];
        var issuance_id = po_table.cell(row, 0 ).data();

        $.ajax({
            type: "POST",
            url : baseurl + "warehouse_temp/get_issuance",
            dataType : "json",
            data: {'issuance_id': issuance_id},
            success : function(data){
                var warehouse_id = '$("#warehouse_' + data[0].warehouse_id + '")';
                var warehouse_id_title= $('#warehouse_' + data[0].warehouse_id).html();
                var project_id = '$("#project_' + data[0].issuance_project + '")';
                var project_id_title= $('#project_' + data[0].issuance_project).html();

                $('#warehouse_' + data[0].warehouse_id).attr("selected", "selected");
                $('#select2-opt_iss_warehouse-container').attr('title', warehouse_id_title);
                $('#select2-opt_iss_warehouse-container').html(warehouse_id_title);

                console.log(project_id);
                console.log(project_id_title);

                $('#project_' + data[0].project_id).attr("selected", "selected");
                $('#select2-opt_iss_project-container').attr('title', project_id_title);
                $('#select2-opt_iss_project-container').html(project_id_title);

                tbl_issuance_detail.clear().draw();
                counter = 0;
                $.each(data, function(i, value){
                    $("#is_id").val(data[i].issuance_id);
                    // console.log(data);
                    tbl_issuance_detail.row.add([
                        data[i].issuance_id,
                        data[i].description + '<input type="hidden" name="' + data[i].issuance_detail_id + '-isd_id" value="' + data[i].issuance_detail_id + '"><input type="hidden" name="' + data[i].item_id + '-item_id" value="' + data[i].item_id + '">',
                        data[i].uom_name,
                        data[i].qty,
                        '<input type="number" name="' + data[i].issuance_detail_id + '-isd_item_qty_received" value="' + data[i].qty + '">',
                        data[i].block,
                        data[i].lot,
                    ]).draw(false);
                    counter++;
                });
                $("#issuance_date").val(data[0].issuance_date);
                $("#inc").val(counter);
                if(data[0].issuance_status == "CONFIRMED") {
                    $("#approved_issuance").show();
                    $("#cancelled_issuance").hide();
                    $("#save_issuance_div").hide();
                } else if(data[0].issuance_status == "CANCELLED") {
                    $("#approved_issuance").hide();
                    $("#cancelled_issuance").show();
                    $("#save_issuance_div").hide();
                } else {
                    $("#approved_issuance").hide();
                    $("#cancelled_issuance").hide();
                    $("#save_issuance_div").show();
                }
            },  
            error: function(errorThrown){
                console.log(errorThrown);
            }
        });

    });

    $('#approve_issuance').on('click', function() {
        $('#issuance_button').val(1);
    });

    $('#cancel_issuance').on('click', function() {
        $('#issuance_button').val(0);
    });

});