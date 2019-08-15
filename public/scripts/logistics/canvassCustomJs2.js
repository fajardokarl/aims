var TableDatatablesEditable = function () {
    
    var brokertable = $('#tblbroker').DataTable();
    var agents_table = $('#tblagents').DataTable({searching: false});
    var commission_table = $('#tblcommission').DataTable({searching: false, "lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]] });
    var realtytable = $('#tblrealty').DataTable();
    var tblrealty_agents = $('#tblrealty_agents').DataTable({"lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]] });
    var tblrealty_brokers = $('#tblrealty_brokers').DataTable({"lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]] });
    
    var rush_po_table = $('#rush_po_table').DataTable({"order": [[ 1, "desc" ]],"lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]] });
   
    var canvass_table = $('#canvass_table').DataTable({"order": [[ 1, "desc" ]],"lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]] });
    var canvass_detail_table = $('#canvass_detail_table').DataTable({searching: false, paging: false});
   
    var quotation_item_table = $('#quotation_item_table').DataTable({"columnDefs": [
                    {
                        "targets": [],
                        "visible": false,
                        "searchable": true
                    }, 
                    {
                      "targets": "_all",
              "orderable": false
                    }
                ]               
            });
    var contacts_table = $("#quotation_item_table");

    var report_table = $('#report_table').DataTable({"lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]] });

    var canvass_report_table = $('#canvass_report_table').DataTable({"order": [[ 0, "desc" ]],"lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]] });

    var prf_approve_table = $('#prf_approve_table').DataTable({"order": [[ 0, "desc" ]],"lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]] }); 
    var pdf_po_table = $('#pdf_po_table').DataTable({"order": [[ 0, "desc" ]],"lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]] }); 
    var prf_status_table = $('#prf_status_table').DataTable({"order": [[ 0, "desc" ]],"columnDefs": [
                    {
                        "targets": [ 0,7 ],
                        "visible": false,
                        "searchable": true
                    }, 
                    {
                      "targets": "_all",
              "orderable": false
                    }
                ], 
                "createdRow": function( row, data, dataIndex ) {
            if ( data[7] == 0 ) {
              $(row).css('background-color', '#ffcfcf');
            }else{
              $(row).css('background-color', '#d7ffcf');

            }
        }
               
            });
  var contacts_table = $("#prf_status_table");
    var canvasss_approval_table = $('#canvasss_approval_table').DataTable({"columnDefs": [
                    {
                        "targets": [ 0,9,10,11,12],
                        "visible": false,
                        "searchable": true
                    }, 
                    {
                      "targets": "_all",
              "orderable": false
                    }
                ], 
                "createdRow": function( row, data, dataIndex ) {
            if ( data[9] == 0 ) {
              $(row).css('background-color', '#ffcfcf');
            }else{
              $(row).css('background-color', '#d7ffcf');

            }
        }
               
            });
    var contacts_table = $("#canvasss_approval_table");

    var punchase_order_table = $('#punchase_order_table').DataTable({"order": [[ 0, "desc" ]],"lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]] });
    var contacts_table = $("#punchase_order_table"); 

    var rush_punchase_order_table = $('#rush_punchase_order_table').DataTable({"order": [[ 0, "desc" ]],"lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]] });
    var contacts_table = $("#rush_punchase_order_table");  
    
    var po_detail_table = $('#po_detail_table').DataTable({searching: false, paging: false});
    var contacts_table = $("#po_detail_table");  

    var create_po_table = $('#create_po_table').DataTable({searching: false, paging: false});
    var contacts_table = $("#create_po_table");  

    var canvass_list_table = $('#canvass_list_table').DataTable({"order": [[ 0, "desc" ]],"lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]] });
    var contacts_table = $("#canvass_list_table");
    // var canvass_list_table = $('#canvass_list_table').DataTable();
    // var contacts_table = $("#canvass_list_table");   

    contacts_table.on('click', '.cust_cont_remove', function (e) {
              e.preventDefault();
              var nRow = $(this).closest('.toRemove').remove();
         });   

  

    //canvass listing clickable table
    var canvass_table = $("#canvass_table").DataTable();
    // var table = $('#address_add').DataTable({searching: false, paging: false});
         $('#tab1_next').click(function() {
            $("#tab1").removeClass("active");
            $("#tab2").addClass("active");
        });
        $('#tab2_back').click(function() {
            $("#tab2").removeClass("active");
            $("#tab1").addClass("active");
        });
        $('#tab2_next').click(function() {
            $("#tab2").removeClass("active");
            $("#tab3").addClass("active");
        });
         $('#tab3_back').click(function() {
            $("#tab3").removeClass("active");
            $("#tab2").addClass("active");
        });

        $('#report_prf_form').click(function(){
          var prf_id = $('#prf_id').val();
          window.open(baseurl+"logistics/canvass/pdf_report?prf_id=" + prf_id);
        });   

        $('#pdf_amort_sched').click(function(){
          var id_prf = $('#id_prf').val();
          window.open(baseurl+"logistics/canvass_list_controller/pdf_canvassdetails?id_prf=" + id_prf);
        });     

        $('#prf_approve_table').on('click', 'tr', function () {        
            var row = $(this).closest('tr')[0];
            var prf_id = prf_approve_table.cell( row, 0 ).data();

            window.open(baseurl+"logistics/canvass/purchase_order_form?prfid="+prf_id);
        });
         $('#canvass_table').on('click', 'tr', function () {        
            var row = $(this).closest('tr')[0];
            var prf_id = canvass_table.cell( row, 0 ).data();

            window.open(baseurl+"logistics/canvass/quotedetails?prfid="+prf_id);
        });

        $('#canvass_list_table').on('click', 'tr', function () {        
            var row = $(this).closest('tr')[0];
            var prf_id = canvass_list_table.cell( row, 0 ).data();

            window.open(baseurl+"logistics/canvass/canvassApproval?prf_id="+prf_id);
        });

        $('#punchase_order_table').on('click', 'tr', function () {        
            var row = $(this).closest('tr')[0];
            var prf_id = punchase_order_table.cell( row, 0 ).data();

            window.open(baseurl+"logistics/canvass/PurchaseOrderDetails?prf_id="+prf_id);
        });


        $('#rush_punchase_order_table').on('click', 'tr', function () {        
            var row = $(this).closest('tr')[0];
            var prf_id = rush_punchase_order_table.cell( row, 0 ).data();

            window.open(baseurl+"logistics/canvass/RushPurchaseOrderDetails?prf_id="+prf_id);
        });

        $('#pdf_po_table').on('click', 'tr', function () {        
            var row = $(this).closest('tr')[0];
            var po_id = pdf_po_table.cell( row, 0 ).data();

            window.open(baseurl+"logistics/canvass/pdfPO?PO="+po_id);
        });



  // $('#save_to_PO').click(function(){
  //     var supplier_name = $('#selected_supplier').val();
  //     if (!Date.parse(supplier_name)) {
  //       toastr.options.timeOut = 500;
  //               toastr.error('Specify Supplier.', 'Notice');
  //     }else{
  //       $('#confirmation_modal').modal('toggle');
  //     }
  //   });

    $('#po_request').click(function(){     
      var po_items = [];
      var poi_arr;      
      // var date_needed = $('#date_needed').val();
      var supplier_id = $('#supplier_selected option:selected').val();
      // var supplier_id = $('#selected_supplier').val();
      var prf_id = $('#prf_id').val();
      // var lot_id = $('#item_lots option:selected').val();
      var create_po_table_data = create_po_table.rows().data();

      create_po_table_data.each(function (value, index) {
        if (create_po_table_data.cell( index, 1 ).data() != '' || create_po_table_data.cell( index, 5 ).data() != 0) {
            var poi_arr = {
            // 'bom_id' : create_po_table_data.cell( index, 0 ).data(),
            // 'canvass_detail_id' : create_po_table_data.cell( index, 0 ).data(),
            // 'supplier_id' : create_po_table_data.cell( index, 1 ).data(),
            'item_id' : create_po_table_data.cell( index, 9 ).data(),
            'qty_item' : create_po_table_data.cell( index, 3 ).data(),
            'po_uom_id' : create_po_table_data.cell( index, 4 ).data(),
            'po_item_remark' :  create_po_table_data.cell( index, 5 ).data(),
            'price_offer' : jFormatNumberRet( create_po_table_data.cell( index, 6 ).data()),
            'total' : jFormatNumberRet( create_po_table_data.cell( index, 7 ).data()),
            'budget_id' : create_po_table_data.cell( index, 10 ).data(),
            'TOP' : create_po_table_data.cell( index, 11 ).data(),


            };
            po_items.push(poi_arr);
        }
      });

      var data = {
        'supplier_id' : supplier_id,
        'prf_id' : prf_id,
        // 'date_needed' : date_needed,
        'po_items' : po_items
      };

      if (po_items.length > 0) {
        $.ajax({
          type: "POST",
                url : baseurl + "logistics/canvass/insert_po",
                dataType : "json",
                data: data,
                success : function(data){
              // reset_bom_tbl();

              // $('#bom_type').val('0');
              // $("#select2-bom_type-container").text('None');
              // $('#item_cat').val('0');
              // $("#select2-item_cat-container").text('None');
              // $('#confirmation_modal').modal('toggle');
                  
                  // tbl_material.clear().draw();
                  toastr.options.timeOut = 500;
                    toastr.success('Savad.', 'Success');
                }, 
                error: function(errorThrown){
                    console.log(errorThrown);
                }
        });
      }else{
        toastr.options.timeOut = 1000;
                toastr.error('Empty Item/s.', 'Notice');
      }
    });


$( "#supplier_selected" ).change(function() {
        $.ajax({ 
              type: "POST",
              url: baseurl+'logistics/canvass/get_all_details',
              dataType: 'json',
              data: {'supplierid' : $(this).val(),'prfid' : $('#prf_id').val()},
              success: function(data){
                          //toastr.info('Successfully saved!.', 'Operation done');
                          create_po_table.clear().draw();
                              for (var i = 0; i < data.length; i++) {

                              var av;
                              var name;
                              if (data[i].is_approved == 1) {
                                av = "<span class='font-green-jungle bold'>APPROVED</span>"
                              }else{
                                av ="<span class='font-red-intense bold'>NO</span>"
                              }


                              if (data[i].client_type_id == 1) {
                                name = data[i].organization_name
                              }else{
                                name =data[i].organization_name
                              }
                              // var price = 0;
                              // price = parseFloat((parseFloat(data[i].lot_area) * parseFloat(data[i].price_per_sqr_meter)) + (parseFloat(data[i].house_price) + parseFloat(data[i].lot_vat)));
                              create_po_table.row.add( [
                                            data[i].canvass_detail_id,                                           
                                            name,
                                            data[i].description,
                                            data[i].qty_item,
                                            data[i].uom_id,
                                            data[i].remarks,
                                            jFormatNumber(data[i].price_offer),  
                                            jFormatNumber(data[i].total),                                
                                            av,
                                            data[i].item_id,
                                            data[i].budget_id,
                                            data[i].terms_of_payment
                                            // (price),
                                     
                                        ] ).draw( false );
                        }
                          console.log(data);
                         },
              error: function (errorThrown)
                        {  
                          toastr.error('Failed to saved!.', 'Operation done');
                          console.log( errorThrown );
                        }  
        });
      });



$('#item_description').change(function(){   
      var item_id = $(this).val();    
      
      var budget_id = "";      
      var qty_content = "";
      var unit_content = ""; 
      var remarks_content = "";  
      $.ajax({
          type: "POST",
          url:  baseurl + "logistics/canvass/prf_details",
          dataType: "json",
          data: {'item_id': item_id,'prf_id': $('#prf_id').val()},
          success: function(data){            
              $.each(data, function(i, value){
                      budget_id += "<option value='" + data[i].budget_id + "'>" + data[i].budget_id + "</option>"
                      qty_content += "<option value='" + data[i].qty + "'>" + data[i].qty + "</option>"                       
                      unit_content += "<option value='" + data[i].prf_uom_id + "'>" + data[i].uom_name + "</option>"                       
                      remarks_content += "<option value='" + data[i].remarks + "'>" + data[i].remarks + "</option>"                  
                
              });
              $('#budget_id').html(budget_id);              
              $('#quote_qty').html(qty_content);
              $('#quote_unit').html(unit_content);  
              $('#quote_remark').html(remarks_content);               
          },
          error: function (errorThrown){

            // $('#quote_qty').html(qty_content);
            //   $('#quote_unit').html(unit_content);  
            //   $('#quote_remark').html(remarks_content);   
              // var qty_content = "<option value='1'>Unbudgeted</option>";
              // var unit_content = "<option value='1'>Unbudgeted</option>";
              // var remarks_content = "<option value='1'>Unbudgeted</option>";
          }
      });
   });




  // $('#request_po').click(function(){
 
  //     var quote_supplier_name = $('input[name="quote_supplier_name[]"]').map(function(){
  //         return $(this).val();
  //     }).get();

  //     var item_description = $('input[name="item_description[]"]').map(function(){
  //         return $(this).val();
  //     }).get();

  //     var qty_item = $('input[name="qty_item[]"]').map(function(){
  //         return $(this).val();
  //     }).get();

  //     var price_offer = $('input[name="price_offer[]"]').map(function(){
  //         return $(this).val();
  //     }).get();

  //     var total = $('input[name="total[]"]').map(function(){
  //         return $(this).val();
  //     }).get();

  //     var terms_of_payment = $('input[name="terms_of_payment[]"]').map(function(){
  //         return $(this).val();
  //     }).get();

  //     var contact_person = $('input[name="contact_person[]"]').map(function(){
  //         return $(this).val();
  //     }).get();

  //     var contact_number = $('input[name="contact_number[]"]').map(function(){
  //         return $(this).val();
  //     }).get();
  //     var data = {
  //   //= to view ID.......value to be inserted//
  //       'prf_id':$('#prf_id').val(),
  //       'quotation_id':$('#quotation_id').val(),
  //       'requested_by_id':$('#requested_by_id').val(),
  //       'canvass_total':$('#canvass_total').html(),
  //       'save_canvass_item':$('#save_canvass_item').val(),

  //       'quote_supplier_name':quote_supplier_name,
  //       'item_description':item_description,
  //       'qty_item':qty_item,
  //       'price_offer':price_offer,
  //       'total':total,
  //       'terms_of_payment':terms_of_payment,
  //       'contact_person':contact_person,
  //       'contact_number':contact_number,
  //     };

  //     console.log(data);
  //     $.ajax({
  //         type: "POST",
  //         url:  baseurl + "logistics/canvass/save_canvass",
  //         dataType: "text",
  //         data: data,
  //         success: function(data){
  //             toastr.success('Successfully Saved!', 'Operation Done');
  //         },
  //         error: function (errorThrown){
  //             toastr.error('Error!.', 'Operation Done');
  //         }
  //     });
  // });






    //approval of PRF item starts here
  $('#btn_todone').click(function(){
      var id = $('#prf_id').val();
      var prf_id = $('#prf_id').val();
      var stat_val;

  if ($('#txt_status').hasClass("okay")) {
        $('#txt_status').removeClass("okay");
        $('#txt_status').addClass("damaged");
        $('#btn_text').text("MARK DONE");

        $('#txt_status').removeClass("font-green-jungle");
        $('#txt_status').addClass("font-red-haze");
        $('#txt_status').removeClass("okay");
        $('#txt_status').addClass("damaged");
        $('#txt_status').html("NOT DONE");
        $('#btn_text').text("MARK DONE");
        
        stat_val =0;
      }else{
    $('#txt_status').removeClass("damaged");
        $('#txt_status').addClass("okay");
        $('#btn_text').text("MARK 'NOT DONE'");

        $('#txt_status').removeClass("font-red-haze");
        $('#txt_status').addClass("font-green-jungle");
        $('#txt_status').removeClass("damaged");
        $('#txt_status').addClass("okay");
        $('#txt_status').html('DONE');
        $('#btn_text').text("MARK NOT DONE");
        
        stat_val = 1;
      }
      var data = {
        'id' : id,
        'stat_val' : stat_val,

      };
      $.ajax({
        type: "POST",
              url : baseurl + "logistics/canvass/prf_change_status",
              dataType : "json",
              data: data,
              success : function(data){
                console.log(data);
                status_table(prf_id);
                // alert(stat_val);              
              }, 
              error: function(errorThrown){
                  console.log(errorThrown);
              }
      });
    });

   $('#prf_status_table').on('click', 'tr', function () {        
            var row = $(this).closest('tr')[0];
            var prf_id = prf_status_table.cell( row, 0 ).data();
      $('#prf_status_modal').modal('toggle');

      $('#prf_id').val(prf_status_table.cell(row, 0 ).data());
      $('#stckr_description').text(prf_status_table.cell(row, 2 ).data());
      $('#stckr_price_offer').text(prf_status_table.cell(row, 1 ).data());
      $('#stckr_supplier').text(prf_status_table.cell(row, 3 ).data());
      $('#stckr_TOP').text(prf_status_table.cell(row, 4 ).data());
      $('#stckr_person').text(prf_status_table.cell(row, 5 ).data());
      $('#stckr_number').text(prf_status_table.cell(row, 6 ).data());


      if (prf_status_table.cell(row, 7 ).data() == 0) {
      $('#txt_status').removeClass("font-red-haze");
       $('#txt_status').removeClass("font-green-jungle");
        $('#txt_status').addClass("font-red-haze");
        $('#txt_status').removeClass("okay");
        $('#txt_status').addClass("damaged");
        $('#txt_status').html("NOT DONE");
        $('#btn_text').text("MARK DONE");
      }else{
        $('#txt_status').removeClass("font-red-haze");
        $('#txt_status').addClass("font-green-jungle");
        $('#txt_status').removeClass("damaged");
        $('#txt_status').addClass("okay");
        $('#txt_status').html('DONE');
        $('#btn_text').text("MARK NOT DONE"); 
      }


  });

    function status_table(id){
      $.ajax({
          type: "POST",
                url : baseurl + "logistics/canvass/get_prf_status",
                dataType : "json",
                data: {'id':id},
                success : function(data){                                    
                        prf_status_table.clear().draw();
                  $.each(data, function (index, value){
                    prf_status_table.row.add([              
                      data[index].prf_id,
                      data[index].date_requested,                  
                      data[index].firstname + ', ' + data[index].lastname,
                      data[index].department_name,
                      data[index].purpose,                    
                      data[index].date_needed,
                      data[index].remarks,                
                      data[index].prf_status_id  
                    ]).draw( false );
                        });
                }, 
                error: function(errorThrown){
                    console.log(errorThrown);
                }

      });
    }          


//approval of canvass item starts here
    $('#toggle').click(function(){
        $('#btn_todamaged').show(); 
        $('#icon').show();
        $('#canvass_btn_text').show();
        $('#approve_reason').show();
        $('#toggle').hide();        
    });

  $('#btn_todamaged').click(function(){
        $('#btn_todamaged').hide(); 
        $('#icon').hide();
        $('#canvass_btn_text').hide();
        $('#approve_reason').hide();
        $('#toggle').show();      

      var budget_id = $('#budget_id').val();
      var budget_amount = $('#budget_amount').val();       
      var budget_quantity = $('#budget_quantity').val();
      var id = $('#canvass_detail_id').val();       
      var prf_id = $('#prf_id').val();
      var approve_reason = $('#approve_reason').val();
      var stat_val;
      var status = 1;
 
      if ($('#canvass_txt_status').hasClass("APPROVED")) {
        $('#canvass_txt_status').removeClass("APPROVED");
        $('#canvass_txt_status').addClass("DISAPPROVED");
        $('#canvass_btn_text').text("Approve?");

        $('#canvass_txt_status').removeClass("font-green-jungle");
        $('#canvass_txt_status').addClass("font-red-haze");
        $('#canvass_txt_status').removeClass("APPROVED");
        $('#canvass_txt_status').addClass("DISAPPROVED");
        $('#canvass_txt_status').html("DISAPPROVE");
        $('#canvass_btn_text').text("MARK APPROVE");
        
        stat_val = 0;
      }else{
        $('#canvass_txt_status').removeClass("DISAPPROVED");
        $('#canvass_txt_status').addClass("APPROVED");
        $('#canvass_btn_text').text("MARK DISAPPROVE");

        $('#canvass_txt_status').removeClass("font-red-haze");
        $('#canvass_txt_status').addClass("font-green-jungle");
        $('#canvass_txt_status').removeClass("DISAPPROVED");
        $('#canvass_txt_status').addClass("APPROVED");
        $('#canvass_txt_status').html('APPROVED');
        $('#canvass_btn_text').text("Mark Disapprove");
        
        stat_val = 1;
      }
      var data = {
        'id' : id,
        'stat_val' : stat_val,
        'approve_reason' : approve_reason        
      };
      $.ajax({
        type: "POST",
              url : baseurl + "logistics/canvass/change_status",
              dataType : "json",
              data: data,
              success : function(data){
                console.log(data);
                asset_table(prf_id);
                //alert(approve_reason);              
              }, 
              error: function(errorThrown){
                  console.log(errorThrown);
              }
      });

      var data2 = {
        'budget_id' : budget_id,
        'budget_amount' : budget_amount,
        'budget_quantity' : budget_quantity,
        'status' : status              
      };
       $.ajax({
        type: "POST",
              url : baseurl + "logistics/canvass/update_budget",
              dataType : "json",
              data: data2,
              success : function(data){
                console.log(data2);
                //asset_table(prf_id);
                //alert(approve_reason);              
              }, 
              error: function(errorThrown){
                  console.log(errorThrown);
              }
      });
    });

   $('#canvasss_approval_table').on('click', 'tr', function () {   
    $('#approve_reason').hide();     
            var row = $(this).closest('tr')[0];
            var canvass_detil_id = canvasss_approval_table.cell( row, 0 ).data();
           
            var budget_amount = canvasss_approval_table.cell( row, 10 ).data();
            
      $('#sticker_print').modal('toggle');

      $('#canvass_detail_id').val(canvasss_approval_table.cell(row, 0 ).data());
      $('#budget_amount').val(canvasss_approval_table.cell(row, 10 ).data());
      $('#budget_id').val(canvasss_approval_table.cell(row, 11 ).data());
      $('#budget_quantity').val(canvasss_approval_table.cell(row, 12 ).data());
      $('#stckr_description').text(canvasss_approval_table.cell(row, 1 ).data());
      $('#stckr_price_offer').text(canvasss_approval_table.cell(row, 3 ).data());
      $('#stckr_supplier').text(canvasss_approval_table.cell(row, 5 ).data());
      $('#stckr_TOP').text(canvasss_approval_table.cell(row, 8 ).data());
      $('#stckr_person').text(canvasss_approval_table.cell(row, 6 ).data());
      $('#stckr_number').text(canvasss_approval_table.cell(row, 7 ).data());
      $('#stckr_total').text(canvasss_approval_table.cell(row, 10 ).data());
  


 if (canvasss_approval_table.cell(row, 9 ).data() == 0) {
      $('#canvass_txt_status').removeClass("font-red-haze");
       $('#canvass_txt_status').removeClass("font-green-jungle");
        $('#canvass_txt_status').addClass("font-red-haze");
        $('#canvass_txt_status').removeClass("okay");
        $('#canvass_txt_status').addClass("damaged");
        $('#canvass_txt_status').html("NOT APPROVE");
        $('#canvass_btn_text').text("MARK APPROVE");
      }else{
        $('#canvass_txt_status').removeClass("font-red-haze");
        $('#canvass_txt_status').addClass("font-green-jungle");
        $('#canvass_txt_status').removeClass("damaged");
        $('#canvass_txt_status').addClass("okay");
        $('#canvass_txt_status').html('APPROVED');
        $('#canvass_btn_text').text("MARK NOT APPROVE"); 
      }
  });

    function asset_table(id){
      $.ajax({
          type: "POST",
                url : baseurl + "logistics/canvass/get_canvass",
                dataType : "json",
                data: {'id':id},
                success : function(data){                                    
                        canvasss_approval_table.clear().draw();
                  $.each(data, function (index, value){
                    canvasss_approval_table.row.add([              
                      data[index].canvass_detail_id,
                      data[index].description,
                      data[index].qty_item,                
                      data[index].price_offer,
                      data[index].total,
                      data[index].supplier_id,
                      data[index].contact_person,
                      data[index].contact_number,
                      data[index].terms_of_payment,
                      data[index].is_approved,
                      data[index].price_offer - data[index].amount,
                      data[index].budget_id,
                      data[index].budget_quantity - data[index].qty_item
                      
                      
                    ]).draw( false );
                        });
                }, 
                error: function(errorThrown){
                    console.log(errorThrown);
                }

      });
    }          


    //approval of canvass item ends here

    //prf list clickable table
    var prf_list_table = $("#prf_list_table").DataTable();
 
   $('#prf_list_table').on('dblclick', 'tr', function () {
            var row = $(this).closest('tr')[0];
            var quote_id = prf_list_table.cell( row, 0 ).data();

            window.open(baseurl+"logistics/canvass_list_controller/quotedetails?canvassid="+quote_id);
         });

    //canvass report generation start
   $('#canvass_report_table').on('dblclick', 'tr', function () {
            var row = $(this).closest('tr')[0];
            var prf_id = canvass_report_table.cell( row, 0 ).data();

            window.open(baseurl+"logistics/canvass/report?prf_id="+prf_id);
         });
    //canvass report generation end

$('#supplier_name').change(function(){   
      var item_id = $(this).val();    
      var opt_content = "<option value='0'>None</option>";     
      $.ajax({
          type: "POST",
          url:  baseurl + "logistics/prf_quotation_controller/list_suppliers",
          dataType: "json",
          data: {'item_id': item_id},
          success: function(data){
              $.each(data, function(i, value){
                  if (data[i].status_id == 1) {
                      opt_content += "<option value='" + data[i].legacy_categorycode + "'>" + data[i].subsidiary_code + "</option>"
                      
                  }
              });
              $('#supplier_name').html(opt_content);             
          },
          error: function (errorThrown){
              toastr.error('Error!.', 'Operation Done');
          }
      });    
  });     

  $('#save_canvass_item').click(function(){
 
      var quote_supplier_name = $('input[name="quote_supplier_name[]"]').map(function(){
          return $(this).val();
      }).get();

      var item_description = $('input[name="item_description[]"]').map(function(){
          return $(this).val();
      }).get();

      var budget_id = $('input[name="budget_id[]"]').map(function(){
          return $(this).val();
      }).get();

      var qty_item = $('input[name="qty_item[]"]').map(function(){
          return $(this).val();
      }).get();

      var uom = $('input[name="uom[]"]').map(function(){
          return $(this).val();
      }).get();

      var quote_remark = $('input[name="quote_remark[]"]').map(function(){
          return $(this).val();
      }).get();


      var price_offer = $('input[name="price_offer[]"]').map(function(){
          return $(this).val();
      }).get();

      var sub_total = $('input[name="sub_total[]"]').map(function(){
          return $(this).val();
      }).get();

      var terms_of_payment = $('input[name="terms_of_payment[]"]').map(function(){
          return $(this).val();
      }).get();

      var contact_person = $('input[name="contact_person[]"]').map(function(){
          return $(this).val();
      }).get();

      var contact_number = $('input[name="contact_number[]"]').map(function(){
          return $(this).val();
      }).get();
      var data = {
    //= to view ID.......value to be inserted//
        'prf_id':$('#prf_id').val(),
        'quotation_id':$('#quotation_id').val(),
        'canvassed_by':$('#canvassed_by').val(),
        'canvass_total':$('#canvass_total').html(),
        'save_canvass_item':$('#save_canvass_item').val(),

        'quote_supplier_name':quote_supplier_name,
        'item_description':item_description,
        'budget_id':budget_id,
        'qty_item':qty_item,
        'uom':uom,
        'quote_remark':quote_remark,
        'price_offer':price_offer,
        'sub_total':sub_total,
        'terms_of_payment':terms_of_payment,
        'contact_person':contact_person,
        'contact_number':contact_number,
      };

      console.log(data);
      $.ajax({
          type: "POST",
          url:  baseurl + "logistics/canvass/save_canvass",
          dataType: "text",
          data: data,
          success: function(data){
              toastr.success('Successfully Saved!', 'Operation Done');
          },
          error: function (errorThrown){
              toastr.error('Error!.', 'Operation Done');
          }
      });
  });



var total =0;
$("#add_quotation").click(function(){
        var rowCount_contact = $('#quotation_item_table tbody tr').length;
        var subtotal = ($("#qty_item").val()*$("#price_offer").val());
       
  if ($("quote_supplier_name").val() != "") {
  quotation_item_table.row.add( [        
        
         "<input type='hidden' name='quote_supplier_name[]' value='" + $("#quote_supplier_name option:selected").val() + "'>" + $("#quote_supplier_name option:selected").text(),
         "<input type='hidden' name='item_description[]' value='" + $("#item_description option:selected").val() + "'>" + $("#item_description option:selected").text(),
         "<input type='hidden' name='budget_id[]' value='" + $("#budget_id option:selected").val() + "'>" + $("#budget_id option:selected").text(),
         "<input type='hidden' name='qty_item[]' value='" + $("#qty_item option:selected").text() + "'>" + $("#qty_item option:selected").text(),
         "<input type='hidden' name='uom[]' value='" + $("#quote_unit option:selected").val() + "'>" + $("#quote_unit option:selected").text(),
         "<input type='hidden' name='quote_remark[]' value='" + $("#quote_remark option:selected").text() + "'>" + $("#quote_remark option:selected").text(),
         "<input type='hidden' name='price_offer[]' value='" + $("#price_offer").val() + "'>" + $("#price_offer").val(),
         "<input type='hidden' name='sub_total[]' value='" + ($("#qty_item").val()*$("#price_offer").val()) + "'>" + subtotal,
         //"<input type='hidden' name='total[]' value='" + $("#qty_item").val() + "'>" * $("#price_offer").val() + "'>" + subtotal,        
         "<input type='hidden' name='terms_of_payment[]' value='" + $("#terms_of_payment").val() + "'>" + $("#terms_of_payment").val(),
         "<input type='hidden' name='contact_person[]' value='" + $("#contact_person").val() + "'>" + $("#contact_person").val(),   
         "<input type='hidden' name='contact_number[]' value='" + $("#contact_number").val() + "'>" + $("#contact_number").val(), 
         '<a href="#" class="btn btn-danger cust_delete_contact">remove</a>'
        ] ).draw( false );  

        total = total + subtotal;
            $("#canvass_total").html(total);
            console.log(total);
            console.log(subtotal);



        }else{
            toastr.options.timeOut = 500;
            toastr.error('Please Fill everything in this form.', 'Replacement Notice!');
        }
      });

      quotation_item_table.on('click', '.cust_delete_contact', function(e){
        e.preventDefault();
        quotation_item_table.row($(this).closest('tr')).remove().draw();
      });
//------rush po table-------//
  

$("#add_rush_po").click(function(){
        var rowCount_contact = $('#rush_po_table tbody tr').length;
        
       
  if ($("item_description").val() != "") {
  rush_po_table.row.add( [        
        
         // "<input type='hidden' name='item_description[]' value='" + $("#item_description option:selected").val() + "'>" + $("#item_description option:selected").text(),
         // "<input type='hidden' name='quote_qty[]' value='" + $("#quote_qty option:selected").val() + "'>" + $("#quote_qty option:selected").text(),
         // "<input type='hidden' name='quote_unit[]' value='" + $("#quote_unit option:selected").val() + "'>" + $("#quote_unit option:selected").text(),
         // "<input type='hidden' name='quote_remark[]' value='" + $("#quote_remark option:selected").val() + "'>" + $("#quote_remark option:selected").text(),
         // "<input type='hidden' name='rush_sup_name[]' value='" + $("#rush_sup_name option:selected").val() + "'>" + $("#rush_sup_name option:selected").text(),
         "<input type='hidden' name='rush_price_offer[]' value='" + $("#rush_price_offer").val() + "'>" + $("#rush_price_offer").val(),
         "<input type='hidden' name='rush_person[]' value='" + $("#rush_person").val() + "'>" + $("#rush_person").val(),
         "<input type='hidden' name='rush_number[]' value='" + $("#rush_number").val() + "'>" + $("#rush_number").val(),
         "<input type='hidden' name='rush_top[]' value='" + $("#rush_top").val() + "'>" + $("#rush_top").val(),   
        
         '<a href="#" class="btn btn-danger cust_delete_contact">remove</a>'
        ] ).draw( false );         
            $("#canvass_total").html(total);     
        }else{
            toastr.options.timeOut = 500;
            toastr.error('Please Fill everything in this form.', 'Replacement Notice!');
        }
      });

      rush_po_table.on('click', '.cust_delete_contact', function(e){
        e.preventDefault();
        rush_po_table.row($(this).closest('tr')).remove().draw();
      });
//------rush po table end-------//
//------rush po save------------//
 $('#rush_po_request').click(function(){
 
      var rush_sup_name = $('input[name="rush_sup_name[]"]').map(function(){
          return $(this).val();
      }).get();

      var rush_price_offer = $('input[name="rush_price_offer[]"]').map(function(){
          return $(this).val();
      }).get();

      var rush_person = $('input[name="rush_person[]"]').map(function(){
          return $(this).val();
      }).get();

      var rush_top = $('input[name="rush_top[]"]').map(function(){
          return $(this).val();
      }).get();

      var data = {
    //= to view ID.......value to be inserted//
        'rush_po_by':$('#rush_po_by').val(),
        'prf_id':$('#prf_id').val(),
        'item_id':$('#item_id').val(),    

        
        'rush_sup_name':rush_sup_name,
        'rush_price_offer':rush_price_offer,
        'rush_person':rush_person,
        'contact_person':contact_person,
        'contact_number':contact_number,
      };

      console.log(data);
      $.ajax({
          type: "POST",
          url:  baseurl + "logistics/canvass/save_rush_po",
          dataType: "text",
          data: data,
          success: function(data){
              toastr.success('Successfully Saved!', 'Operation Done');
          },
          error: function (errorThrown){
              toastr.error('Error!.', 'Operation Done');
          }
      });
  });

//------rush po end-------------//
 
//REALTY - main
    realtytable.on('click', 'tr', function (e) {
        e.preventDefault();
        
        $("<style type='text/css'> .highlight{ background:#33F0FF;} </style>").appendTo("head");
        $("#tblrealty tr").each(function () {
            if ( $(this).hasClass('highlight') ) {
                $(this).removeClass('highlight');
            }
        });
        $(this).addClass("highlight");
        var row = $(this).closest('tr')[0];
        var realty_id = realtytable.cell(row, 0 ).data();
        $('#realty_name').html(realtytable.cell(row, 1 ).data());


        $.ajax({
            type: "POST",
            url : baseurl + "marketing/brokers/realty_agents",
            dataType : "json",
            data: {'realty_id' : realty_id},
            success : function(data){
                tblrealty_agents.clear().draw();
                $.each(data, function(i, value){
                    tblrealty_agents.row.add([
                        data[i].agent_id,
                        data[i].lastname + ", " + data[i].firstname + " " + data[i].middlename
                    ]).draw(false);
                });
            },  
            error: function(errorThrown){
                console.log(errorThrown);
            }
        });

        $.ajax({
            type: "POST",
            url : baseurl + "marketing/brokers/realty_brokers",
            dataType : "json",
            data: {'realty_id' : realty_id},
            success : function(data){
                tblrealty_brokers.clear().draw();
                $.each(data, function(i, value){
                    tblrealty_brokers.row.add([
                        data[i].broker_id,
                        data[i].lastname + ", " + data[i].firstname + " " + data[i].middlename
                    ]).draw(false);
                });
            },  
            error: function(errorThrown){
                console.log(errorThrown);
            }
        });
        realtytable.fixedHeader(false);
    });

//REALTY - agent 
    tblrealty_agents.on('click', 'tr', function (e) {
        e.preventDefault();
        var row = $(this).closest('tr')[0];
        var agent_id = tblrealty_agents.cell(row, 0 ).data();
        var cont_type = "", 
            cont_detail="",
            add_type = "",
            add_detail = "";

        if (agent_id !== undefined) {
            $('#realty_agent_modal').modal('toggle');
             console.log('agent_id -> ' + agent_id);
            $.ajax({
                type: "POST",
                url : baseurl + "marketing/brokers/get_one_agent",
                dataType : "json",
                data: {'agent_id' : agent_id},
                success : function(data){
                    // console.log(data[0].lastname + ", " + data[0].firstname + " " + data[0].middlename);
                    $('#txt_agent_fullname2').html(data[0].lastname + ", " + data[0].firstname + " " + data[0].middlename);
                    $('#txt_agent_sex2').html(data[0].sex);
                    $('#txt_agent_address2').html(data[0].line_1 + " " + data[0].line_2 + " " + data[0].line_3 + ", " + data[0].city_name + ", " + data[0].province_name  + ", " + data[0].country_name);
                    $('#txt_agent_nationality2').html(data[0].nationality);
                    $('#txt_agent_birthday2').html(data[0].birthdate);
                    $('#txt_agent_birthplace2').html(data[0].birthplace);
                    $('#txt_agent_civil2').html(data[0].civil_status_name);
                    $('#txt_agent_taxtype2').html(data[0].tax_type_name);
                    $('#txt_agent_tin2').html(data[0].tin);
                    if (data[0].is_broker == 1) {
                        $('#is_broker').html('<h4 class="bold"><i class="fa fa-check-circle-o" aria-hidden="true"></i> Broker</h4>');
                    }else{
                        $('#is_broker').html('');
                    }

                    var filename = '../public/images/profiles/default.png';
                    if (typeof data[0].picture_url != 'undefined' && data[0].picture_url != null && data[0].picture_url != "") {
                        filename = '../public/images/profiles/' + data[0].picture_url;
                        console.log(filename);
                    }
                    $('#agent_profilepic').attr('src', filename);

                    for (var i = 0; i < data.length; i++) {
                            cont_type += data[i].contact_type_name + ": <br>";
                            cont_detail += data[i].contact_value + "<br>";
                            console.log(data[i].contact_value);
                        }
                    if (cont_detail != "") {
                            $('#txt_agent_cont_type2').html(cont_type);
                            $('#txt_agent_cont_value2').html(cont_detail);
                        }

                    $.ajax({
                        type: "POST",
                        url : baseurl + "marketing/brokers/get_broker_address",
                        dataType : "json",
                        data: {'brok_id' : data[0].person_id},
                        success : function(data){
                            for (var i = 0; i <= data.length - 1; i++) {
                                add_type += data[i].address_type_name + ": <br>";
                                add_detail += data[i].line_1 + " " + data[i].line_2 + " " + data[i].line_3 + ", " + data[i].city_name + ", " + data[i].province_name  + ", " + data[i].country_name + "<br>";
                            }
                            if (add_detail != "") {
                                $('#txt_add_type2').html(add_type);
                                $('#txt_address2').html(add_detail);
                            }
                        },  
                        error: function(errorThrown){
                            console.log(errorThrown);
                        }
                    });
                },  
                error: function(errorThrown){
                    console.log(errorThrown);
                }
            });
        }
    });

//REALTY - Broker
    tblrealty_brokers.on('click', 'tr', function (e) {
        e.preventDefault();
        $('#txt_agent_fullname').html('');
        $('#txt_agent_sex').html('');
        $('#txt_agent_address').html('');
        $('#txt_agent_nationality').html('');
        $('#txt_agent_birthday').html('');
        $('#txt_agent_birthplace').html('');
        $('#txt_agent_civil').html('');
        $('#txt_agent_taxtype').html('');
        $('#txt_agent_tin').html('');
        $('#txt_agent_cont_type').html('');
        $('#txt_agent_cont_value').html('');

        var row = $(this).closest('tr')[0];
        var brokerID = tblrealty_brokers.cell(row, 0 ).data();
        var brok_id = $('#txtBrokerID').text();
        var commission,client,
            earnings = 0; 

        if (brokerID !== undefined) {
            $.ajax({
                type: "POST",
                url:  baseurl + "marketing/brokers/get_contract_by_broker",
                dataType: "json",
                data: {'brok_id': brokerID},
                success: function(data){
                    commission_table.clear();
                    if (data.length > 0) {
                        commission_table.clear();
                        for (var i = 0; i < data.length; i++) {
                            if (data[i].with_house == 1) {
                                commission = (data[i].total_contract_price * 0.05);
                            }else{
                                commission = (data[i].total_contract_price * 0.07);
                            }
                            if (data[i].client_type_id == 1) {
                                client = data[i].lastname + ", " + data[i].firstname + " " + data[i].middlename;
                            }else{
                                client = data[i].organization_name;
                            }

                            commission_table.row.add([
                                data[i].lot_description,
                                client,
                                data[i].sold_date,
                                jFormatNumber(data[i].total_contract_price),
                                jFormatNumber(commission)
                            ]).draw( true );

                            earnings = earnings + jFormatNumberRet(commission_table.cell(i, 4).data());
                        }
                        $('#txt_total_earn').html("&#8369;" + jFormatNumber(earnings));
                        console.log(jFormatNumber(earnings));
                    }else{
                        $('#txt_total_earn').html("&#8369; 0");
                        commission_table.clear().draw();
                    }
                },
                error: function(){
                    toastr.error('Error!.', 'Operation Done');
                }
            });

            $.ajax({
                type: "POST",
                url:  baseurl + "marketing/brokers/getOneBroker",
                dataType: "json",
                data: {'brokerID': brokerID },
                success: function(data){
                    var suff,cont_detail = "", 
                        cont_type = "",
                        add_type = "",
                        add_detail = "";

                    if (data[0].suffix == null) {
                        suff = " ";
                    }else{
                        suff = data[0].suffix;
                    };
                    $('#txtBrokerID').html(data[0].broker_id);
                    $('#txtLastname').html(data[0].lastname + ", " + data[0].firstname + " " + data[0].middlename + " " + suff);
                    $('#txtDateCreated').html(data[0].date_created);
                    $('#text_tin').html(data[0].new_tin);
                    $('#txt_address').html(data[0].line_1 + " " + data[0].line_2 + " " + data[0].line_3 + ", " + data[0].city_name + ", " + data[0].province_name  + ", " + data[0].country_name);
                    $('#txtNationality').html(data[0].nationality);
                    $('#txtBday').html(data[0].birthdate);
                    $('#txtBplace').html(data[0].birthplace);
                    $('#txtCivilStatus').html(data[0].civil_status_name);
                    $('#txtTaxType').html(data[0].tax_type_name);
                    $('#txt_company').html(data[0].organization_name);
                    $('#broker_head').html(data[0].lastname + ", " + data[0].firstname + " " + data[0].middlename + " " + suff);
                    // $('#txt_realty_id').html(data[0].realty_id);
                    var filename = '../public/images/profiles/default.png';
                    if (typeof data[0].picture_url != 'undefined' && data[0].picture_url != null && data[0].picture_url != "") {
                        filename = '../public/images/profiles/' + data[0].picture_url;
                        console.log(filename);
                    }
                    $('#broker_profilepic').attr('src', filename);

                    console.log("tin : " + data[0].tin);
                    for (var i = 0; i <= data.length - 1; i++) {
                        cont_type += data[i].contact_type_name + ": <br>";
                        cont_detail += data[i].contact_value + "<br>";
                    }
                    if (cont_detail != "") {
                        $('#txt_cont_type').html(cont_type);
                        $('#txt_contacts').html(cont_detail);
                    }


                    console.log('ID ------> ' + data[0].new_id);
                    var p_id = data[0].new_id;
                    $.ajax({
                        type: "POST",
                        url:  baseurl + "marketing/brokers/get_broker_address",
                        dataType: "json",
                        data: {'brok_id': p_id},
                        success: function(data){
                            for (var i = 0; i <= data.length - 1; i++) {
                                add_type += data[i].address_type_name + ": <br>";
                                add_detail += data[i].line_1 + " " + data[i].line_2 + " " + data[i].line_3 + ", " + data[i].city_name + ", " + data[i].province_name  + ", " + data[i].country_name + "<br>";
                            }
                            if (add_detail != "") {
                                $('#txt_add_type').html(add_type);
                                $('#txt_address').html(add_detail);
                            }

                        },
                        error: function(errorThrown){
                              toastr.error('Error!.', 'Operation Done');
                        }
                    });



                    agents_table.clear();
                    $.ajax({
                        type: "POST",
                        url:  baseurl + "marketing/brokers/get_agent",
                        dataType: "json",
                        data: {'brok_id': brokerID },
                        success: function(data){
                            if (data.length >0) {
                                for (var i = 0; i < data.length; i++) {
                                    agents_table.row.add([
                                        data[i].agent_id,
                                        data[i].lastname + ", " + data[i].firstname + " " + data[i].middlename,
                                        "<button type='button' class='btn btn-xs blue-dark btn-view-agent ' data-toggle='modal' data-target='#viewagent' >View Details</button>"
                                        ]).draw( true );
                                }
                            }else{
                                agents_table.clear().draw();
                            }
                            console.log(data)
                        },
                        error: function(errorThrown){
                              toastr.error('Error!.', 'Operation Done');
                        }
                    });
                    $('#viewBroker').modal('toggle');
                },
                error: function (errorThrown){
                    console.log(errorThrown)
                    toastr.error('Error!.', 'Operation Done');
                }
            }); 
        }
    });

//BROKER - agents
    agents_table.on('click', '.btn-view-agent', function(e){
        e.preventDefault();
        var row = $(this).closest('tr')[0];
        var agent_id = agents_table.cell(row, 0 ).data();
        var cont_type = "", cont_detail="";

        $.ajax({
            type: "POST",
            url : baseurl + "marketing/brokers/get_one_agent",
            dataType : "json",
            data: {'agent_id' : agent_id},
            success : function(data){
                console.log(data[0].lastname + ", " + data[0].firstname + " " + data[0].middlename);
                $('#txt_agent_fullname').html(data[0].lastname + ", " + data[0].firstname + " " + data[0].middlename);
                $('#txt_agent_sex').html(data[0].sex);
                $('#txt_agent_address').html(data[0].line_1 + " " + data[0].line_2 + " " + data[0].line_3 + ", " + data[0].city_name + ", " + data[0].province_name  + ", " + data[0].country_name);
                $('#txt_agent_nationality').html(data[0].nationality);
                $('#txt_agent_birthday').html(data[0].birthdate);
                $('#txt_agent_birthplace').html(data[0].birthplace);
                $('#txt_agent_civil').html(data[0].civil_status_name);
                $('#txt_agent_taxtype').html(data[0].tax_type_name);
                $('#txt_agent_tin').html(data[0].tin);


                for (var i = 0; i < data.length; i++) {
                        cont_type += data[i].contact_type_name + ": <br>";
                        cont_detail += data[i].contact_value + "<br>";
                        console.log(data[i].contact_value);
                    }
                    if (cont_detail != "") {
                        $('#txt_agent_cont_type').html(cont_type);
                        $('#txt_agent_cont_value').html(cont_detail);
                    }
            },  
            error: function(errorThrown){
                console.log(errorThrown);
            }
        });
    });

    brokertable.on('click', '.btnViewBroker', function (e) {
        e.preventDefault();
        $('#txt_agent_fullname').html('');
        $('#txt_agent_sex').html('');
        $('#txt_agent_address').html('');
        $('#txt_agent_nationality').html('');
        $('#txt_agent_birthday').html('');
        $('#txt_agent_birthplace').html('');
        $('#txt_agent_civil').html('');
        $('#txt_agent_taxtype').html('');
        $('#txt_agent_tin').html('');
        $('#txt_agent_cont_type').html('');
        $('#txt_agent_cont_value').html('');

        var row = $(this).closest('tr')[0];
        var brokerID = brokertable.cell(row, 0 ).data();
        var brok_id = $('#txtBrokerID').text();
        var commission,client,
            earnings = 0; 


        $.ajax({
            type: "POST",
            url:  baseurl + "marketing/brokers/get_contract_by_broker",
            dataType: "json",
            data: {'brok_id': brokerID},
            success: function(data){
                commission_table.clear();
                if (data.length > 0) {
                    commission_table.clear();
                    for (var i = 0; i < data.length; i++) {
                        if (data[i].with_house == 1) {
                            commission = (data[i].total_contract_price * 0.05);
                        }else{
                            commission = (data[i].total_contract_price * 0.07);
                        }
                        if (data[i].client_type_id == 1) {
                            client = data[i].lastname + ", " + data[i].firstname + " " + data[i].middlename;
                        }else{
                            client = data[i].organization_name;
                        }

                        commission_table.row.add([
                            data[i].lot_description,
                            client,
                            data[i].sold_date,
                            jFormatNumber(data[i].total_contract_price),
                            jFormatNumber(commission)
                        ]).draw( true );

                        earnings = earnings + jFormatNumberRet(commission_table.cell(i, 4).data());
                    }
                    $('#txt_total_earn').html("&#8369;" + jFormatNumber(earnings));
                    console.log(jFormatNumber(earnings));
                }else{
                    $('#txt_total_earn').html("&#8369; 0");
                    commission_table.clear().draw();
                }
            },
            error: function(){
                toastr.error('Error!.', 'Operation Done');
            }
        });

        $.ajax({
            type: "POST",
            url:  baseurl + "marketing/brokers/getOneBroker",
            dataType: "json",
            data: {'brokerID': brokerID },
            success: function(data){
                var suff,cont_detail = "", 
                    cont_type = "",
                    add_type = "",
                    add_detail = "";

                if (data[0].suffix == null) {
                    suff = " ";
                }else{
                    suff = data[0].suffix;
                };
                $('#txtBrokerID').html(data[0].broker_id);
                $('#txtLastname').html(data[0].lastname + ", " + data[0].firstname + " " + data[0].middlename + " " + suff);
                $('#txtDateCreated').html(data[0].date_created);
                $('#text_tin').html(data[0].new_tin);
                $('#txt_address').html(data[0].line_1 + " " + data[0].line_2 + " " + data[0].line_3 + ", " + data[0].city_name + ", " + data[0].province_name  + ", " + data[0].country_name);
                $('#txtNationality').html(data[0].nationality);
                $('#txtBday').html(data[0].birthdate);
                $('#txtBplace').html(data[0].birthplace);
                $('#txtCivilStatus').html(data[0].civil_status_name);
                $('#txtTaxType').html(data[0].tax_type_name);
                $('#txt_company').html(data[0].organization_name);
                $('#broker_head').html(data[0].lastname + ", " + data[0].firstname + " " + data[0].middlename + " " + suff);
                // $('#txt_realty_id').html(data[0].realty_id);
                var filename = '../public/images/profiles/default.png';
                if (typeof data[0].picture_url != 'undefined' && data[0].picture_url != null && data[0].picture_url != "") {
                    filename = '../public/images/profiles/' + data[0].picture_url;
                    console.log(filename);
                }
                $('#broker_profilepic').attr('src', filename);

                console.log("tin : " + data[0].tin);
                for (var i = 0; i <= data.length - 1; i++) {
                    cont_type += data[i].contact_type_name + ": <br>";
                    cont_detail += data[i].contact_value + "<br>";
                }
                if (cont_detail != "") {
                    $('#txt_cont_type').html(cont_type);
                    $('#txt_contacts').html(cont_detail);
                }


                console.log('ID ------> ' + data[0].new_id);
                var p_id = data[0].new_id;
                $.ajax({
                    type: "POST",
                    url:  baseurl + "marketing/brokers/get_broker_address",
                    dataType: "json",
                    data: {'brok_id': p_id},
                    success: function(data){
                        for (var i = 0; i <= data.length - 1; i++) {
                            add_type += data[i].address_type_name + ": <br>";
                            add_detail += data[i].line_1 + " " + data[i].line_2 + " " + data[i].line_3 + ", " + data[i].city_name + ", " + data[i].province_name  + ", " + data[i].country_name + "<br>";
                        }
                        if (add_detail != "") {
                            $('#txt_add_type').html(add_type);
                            $('#txt_address').html(add_detail);
                        }

                    },
                    error: function(errorThrown){
                          toastr.error('Error!.', 'Operation Done');
                    }
                });



                agents_table.clear();
                $.ajax({
                    type: "POST",
                    url:  baseurl + "marketing/brokers/get_agent",
                    dataType: "json",
                    data: {'brok_id': brokerID },
                    success: function(data){
                        if (data.length >0) {
                            for (var i = 0; i < data.length; i++) {
                                agents_table.row.add([
                                    data[i].agent_id,
                                    data[i].lastname + ", " + data[i].firstname + " " + data[i].middlename,
                                    "<button type='button' class='btn btn-xs blue-dark btn-view-agent ' data-toggle='modal' data-target='#viewagent' >View Details</button>"
                                    ]).draw( true );
                            }
                        }else{
                            agents_table.clear().draw();
                        }
                        console.log(data)
                    },
                    error: function(errorThrown){
                          toastr.error('Error!.', 'Operation Done');
                    }
                });
            },
            error: function (errorThrown){
                console.log(errorThrown)
                toastr.error('Error!.', 'Operation Done');
            }
        });
    });
    var handleTable = function () {}
    return {
        //main function to initiate the module
        init: function () {
            handleTable();
        }
    };
}();

$(document).ready(function(){
    var brokerAddtable = $('#brokerAddresst').DataTable({searching: false, paging: false});
    var contacts_table = $('#contacts_table').DataTable({searching: false, paging: false});
    var contacts_table_edit = $('#contacts_table_edit').DataTable({searching: false, paging: false});
    var broker_address_edit = $('#brokerAddresst_edit').DataTable({searching: false, paging: false});
    var rowNum = 0;
    var rowCount_contact = 0;

    $("#add_contact").click(function(){
        var rowCount_contact = $('#contacts_table tbody tr').length;
        if ($("#cont_value").val() != "") {
            contacts_table.row.add( [
                    "<input type='hidden' name='contact_type[]' value='" + $("#cont_type option:selected").val() + "'>" + $("#cont_type option:selected").text(),
                    "<input type='hidden' name='contact_value[]' value='" + $("#cont_value").val() + "'>" + $("#cont_value").val(),
                    '<a href="#" class="btn btn-danger delete">remove</a>'
                    ] ).draw( false );
            $("#cont_value").val('');
        }else{
            toastr.options.timeOut = 500;
            toastr.error('Please Fill Contact Value.', 'Notice!');
        }
    });

    contacts_table.on('click', '.delete', function(e){
        e.preventDefault();
        contacts_table.row($(this).closest('tr')).remove().draw();
    });
    
    // $('#try1').click(function() {
        
    // });



    $("#newAddress").click(function(){
        var rowCount = $('#brokerAddresst tbody tr').length;
        rowNum++;
        brokerAddtable.row.add( [            
        "<input type='hidden' name='supplier_name[]' value='" + $("#supplier_name").val() + "'>" + $("#supplier_name").val(),        
        "<input type='hidden' name='contact_person[]' value='" + $("#contact_person").val() + "'>" + $("#contact_person").val(), 
        "<input type='hidden' name='contact_number[]' value='" + $("#contact_number").val() + "'>" + $("#contact_number").val(),                                                 
        "<input type='hidden' name='terms_of_payment[]' value='" + $("#terms_of_payment").val() + "'>" + $("#terms_of_payment").val(),        
        "<input type='hidden' name='item_description[]' value='" + $("#item_description option:selected").val() + "'>" + $("#item_description option:selected").text(),
        "<input type='hidden' name='qty[]' value='" + $("#qty").val() + "'>" + $("#qty").val(),         
        "<input type='hidden' name='unit[]' value='" + $("#uom_opt option:selected").val() + "'>" + $("#uom_opt option:selected").text(),            
        "<input type='hidden' name='unit_price[]' value='" + $("#unit_price").val() + "'>" + $("#unit_price").val(),         
        "<input type='hidden' name='offer_price[]' value='" + $("#offer_price").val() + "'>" + $("#offer_price").val(), 
        
       
        '<a href="#" class="btn btn-danger delete">remove</a>'
                ] ).draw( false );

       
    });

    brokerAddtable.on('click', '.delete', function(e){
        e.preventDefault();
        brokerAddtable.row($(this).closest('tr')).remove().draw();
        rowNum--;
    });

    function Clear(){
        $('#brokerHomePhone').val('');
        $('#brokerWorkPhone').val('');
        $('#brokerPersonalEmail').val('');
        $('#brokerWorkEmail').val('');
        $('#brokerLname').val('');
        $('#brokerFname').val('');
        $('#brokerMname').val('');
        $('#brokerExt').val('');
        $('#brokerCompany').val('');
        $('#brokerTIN').val('');
        $('#birthdate').val('');
        $('#brokerPlaceBirth').val('');
        $('#brokerGender').val('');
        $('#brokerCivilStatus').val('');
        $('#brokerNationality').val('');
        $('#brokerVatType').val('');
        $('#broker_person_id').val('');
        $('#broker_id').val('');
        // $('#BrokerAddType').val('');
        $('#brokerStreet').val('');
        $('#brokerBarangay').val('');
        $('#brokerPostal').val('');
        // $('#brokerCity').val('');
        // $('#brokerProvince').val('');
        // $('#brokerCountry').val('');
        init_address();
    }

    $('#broker_realty').change(function(){
        var realty_id = $(this).val();
        var opt_content = "<option value='0'>None</option>";

        $.ajax({
            type: "POST",
            url:  baseurl + "marketing/brokers/realty_brokers",
            dataType: "json",
            data: {'realty_id': realty_id},
            success: function(data){

                $.each(data, function(i, value){
                    opt_content += "<option value='" + data[i].broker_id + "'>" + data[i].lastname + ", " + data[i].firstname + " " + data[i].middlename + "</option>"
                });
                $('#agents_broker').html(opt_content);
            },
            error: function (errorThrown){
                toastr.error('Error!.', 'Operation Done');
            }
        });

    });

    $('#enroll_agentbroker').change(function(){
        // alert(realty_id = $(this).val());
        var realty_id = $(this).val();
        var opt_content = "<option value='0'>None</option>";

        $.ajax({
            type: "POST",
            url:  baseurl + "marketing/brokers/realty_agents",
            dataType: "json",
            data: {'realty_id': realty_id},
            success: function(data){
                $.each(data, function(i, value){
                    if (data[i].is_broker == 0) {
                        opt_content += "<option value='" + data[i].person_id + "'>" + data[i].lastname + ", " + data[i].firstname + " " + data[i].middlename + "</option>"
                    }
                });
                $('#agent_to_broker').html(opt_content);
            },
            error: function (errorThrown){
                toastr.error('Error!.', 'Operation Done');
            }
        });
    });


    $('#agent_to_broker').change(function(){
        // alert($(this).val());
        $('#agent_person_id').val($(this).val());
    });


    $('#save_agent_to_broker').click(function(){
        var data = {
            'person_id' : $('#agent_person_id').val(),
            'realty_id' : $('#enroll_agentbroker option:selected').val(),
            'vat_type_id' : $('#new_broker_taxtype option:selected').val()
         }

        $.ajax({
            type: "POST",
            url:  baseurl + "marketing/brokers/insert_agent_to_broker",
            dataType: "json",
            data: data,
            success: function(data){

                toastr.success('Successfully Saved!', 'Operation Done');
                window.location.href = baseurl + "marketing/brokers";
            },
            error: function (errorThrown){
                toastr.error('Error!.', 'Operation Done');
            }
        });
    });


 


//REALTY - Enroll agent
    $('#add_agent').click(function(){
        Clear();
        $('#saveBroker').hide(); 
        $('#updateBroker').hide();
        $('#saveAgent').show();
        $('#broker_opt').show();
        $('#broker_opt').show();
        $('#broker_contact_info').hide();
        $('#broker_address_info').hide();
        init_address();
    });

//REALTY - Enroll broker
    $('#add_broker').click(function(){
         Clear();
        $('#saveBroker').show();
        $('#updateBroker').hide();
        $('#saveAgent').hide();
        $('#realty_opt').show();
        $('#broker_opt').hide();
        $('#li-brokerinfo').tab('show');
        $('#broker_opt').hide();
        // $('#try1').click();
        // $('#li-brokercont').show();
        // $('#li-brokeraddress').show();
        $('#broker_contact_info').hide();
        $('#broker_address_info').hide();
        
        init_address();
    });

// EDIT BROKER
    var brok_id;
    $("#editBroker").click(function(){
        brok_id = $('#txtBrokerID').html();
        init_address();
        // $('#newAddress').show();
        $('#saveBroker').hide();
        $('#updateBroker').show();
        $('#saveAgent').hide();
        $('#broker_contact_info').show();
        $('#broker_address_info').show();
        $.ajax({
            type: "POST",
            url:  baseurl + "marketing/brokers/getOneBroker",
            dataType: "json",
            data: {'brokerID': brok_id},
            success: function(data){

                Clear();
                $('#brokerLname').val(data[0].lastname);
                $('#brokerFname').val(data[0].firstname);
                $('#brokerMname').val(data[0].middlename);
                $('#brokerExt').val(data[0].suffix);
                $('#broker_realty').val(data[0].realty_id);
                $('#select2-broker_realty-container').text(data[0].organization_name);
                $('#brokerTIN').val(data[0].new_tin);
                $('#birthdate').val(data[0].birthdate);
                $('#brokerPlaceBirth').val(data[0].birthplace);
                $('#brokerGender').val(data[0].sex);
                $('#brokerCivilStatus').val(data[0].civil_status_id);
                $('#brokerNationality').val(data[0].nationality);
                $('#brokerVatType').val(data[0].vat_type_id);
                $('#broker_person_id').val(data[0].new_id);
                $('#broker_id').val(data[0].broker_id);
                $('#id_address').val(data[0].address_id);
            
                $.ajax({
                    type: "POST",
                    url:  baseurl + "marketing/brokers/get_broker_address",
                    dataType: "json",
                    data: {'brok_id': data[0].new_id},
                    success: function(data){
                        broker_address_edit.clear().draw();
                            $.each(data, function(i, value){
                                broker_address_edit.row.add([
                                    data[i].address_type_name,
                                    data[i].line_1,
                                    data[i].line_2,
                                    data[i].postal_code,
                                    data[i].city_name,
                                    data[i].province_name,
                                    data[i].country_name
                                ]).draw(false);
                            });
                    },
                    error: function (errorThrown){
                        toastr.error('Error!.', 'Operation Done');
                    }
                });


                $.ajax({
                    type: "POST",
                    url:  baseurl + "marketing/brokers/get_contacts",
                    dataType: "json",
                    data: {'brokerID': data[0].new_id },
                    success: function(data){
                        contacts_table_edit.clear().draw();
                        $.each(data, function(i, value){
                            contacts_table_edit.row.add([
                                data[i].contact_type_name,
                                data[i].contact_value
                                ]).draw(false);
                        });
                    },
                    error: function (errorThrown){
                        toastr.error('Error!.', 'Operation Done');
                    }
                });

            },
            error: function (errorThrown){
                 toastr.error('Error!.', 'Operation Done');
            }
        });
    }); 

    $('#enrollButton').click(function(){
        Clear();
        // $('#newAddress').hide();
        $('#saveBroker').show();
        $('#updateBroker').hide();
        $('#saveAgent').hide();
        $('#realty_opt').show();
        $('#broker_opt').hide();
        $('#li-brokerinfo').tab('show');
        // $('#try1').click();
        $('#li-brokercont').show();
        $('#li-brokeraddress').show();
        $('#broker_contact_info').hide();
        $('#broker_address_info').hide();
        
        init_address();
    });


    $('#addAgent').click(function(){
        Clear();
        $('#saveBroker').hide(); 
        $('#updateBroker').hide();
        $('#saveAgent').show();
        // $('#realty_opt').hide();
        $('#broker_opt').show();
        // $('#li-brokerinfo').tab('show');
        // $('#enrollBroker').modal('toggle');
        $('#broker_contact_info').hide();
        $('#broker_address_info').hide();
        init_address();
    });
    
    function init_address(){
        $("#brokerCity option[value='998']").attr('selected', true);
        $("#brokerProvince option[value='49']").attr('selected', true);
        $("#brokerCountry option[value='175']").attr('selected', true);
        $("#BrokerAddType option[value='1']").attr('selected', true);

        $("#select2-BrokerAddType-container").text('Home');
        $("#select2-brokerCity-container").text('Cagayan de Oro');
        $("#select2-brokerProvince-container").text('Misamis Oriental');
        $("#select2-brokerCountry-container").text('Philippines');
    }

//SAVE BROKER
    $('#saveBroker').click(function(){
        var tbl_count = $('#brokerAddresst tr').length;
        var tbl_count_cont = $('#contacts_table tr').length;

        console.log(tbl_count + " -- " + tbl_count_cont);

        
        if ($('#brokerLname').val() != '' && $('#brokerFname').val() != '' && $('#brokerMname').val() != '' && $('#brokerGender option:selected').val() != '' && $('#birthdate').val() != '' && $('#brokerCivilStatus').val() != '' && $('#brokerVatType').val() != '') {
            if (tbl_count_cont < 3) {
                toastr.options.timeOut = 500;
                toastr.warning("Please Add a Contact", "Notice");
            }else if(tbl_count < 3) {
                toastr.options.timeOut = 500;
                toastr.warning("Please Add an Address", "Notice");
            }else {
                $("#forminfo_submit").attr("action","brokers/saveBroker");
                $("#forminfo_submit").submit();
            }
        }else {
            toastr.options.timeOut = 500;
            toastr.warning("Please Complete the Form", "Notice");
        }
    });


$('#quote_supplier_name').change(function(){   
      var supplier_id = $(this).val();    
      var opt_content = "<option value='0'>None</option>";
      var qty_content = "<option value='0'>None</option>";     
      $.ajax({
          type: "POST",
          url:  baseurl + "logistics/canvass/list_item",
          dataType: "json",
          data: {'supplier_id': supplier_id,'prf_id':$('#prf_id').val()},
          success: function(data){
              $.each(data, function(i, value){
                  if (data[i].status_id == 1) {
                      opt_content += "<option value='" + data[i].item_id + "'>" + data[i].description+ "</option>"
                      
                  }
              });
              $('#item_description').html(opt_content);             
          },
          error: function (errorThrown){
              toastr.error('Error!.', 'Operation Done');
          }
      });  
  });     


$('#item_description').change(function(){   
      var item_id = $(this).val();    
      
      var budget_id = ""; 
      var qty_content = ""; 
      var unit_content = ""; 
      var remark_content = ""; 
      
      $.ajax({
          type: "POST",
          url:  baseurl + "logistics/canvass/qty_list",
          dataType: "json",
          data: {'item_id': item_id,'prf_id': $('#prf_id').val()},
          success: function(data){
              $.each(data, function(i, value){                                  
                     
              //  budget_id = "budget_id"

              // if (budget_id == "budget_id") {
              // $('#budget_id').val("Budgeted");
              // }else{
              // $('#budget_id').val("Unbudgeted");
              // }
                    // if (budget_id == 0) {
                    //   budget_id += "<option value='" + data[i].budget_id + "'>Unbudgeted</option>"

                    // }else{
                    //   // budget_id += "<option value='" + data[i].budget_id + "'>budgeted</option>"
                    //   budget_id += "<option value='" + data[i].budget_id + "'>" + data[i].budget_id + "</option>"                    


                    // }
                      budget_id += "<option value='" + data[i].budget_id + "'>" + data[i].budget_id + "</option>"                    
                      qty_content += "<option value='" + data[i].quote_qty + "'>" + data[i].quote_qty + "</option>"
                      unit_content += "<option value='" + data[i].quote_unit + "'>" + data[i].uom_name + "</option>"                       
                      remark_content += "<option value='" + data[i].quote_remark + "'>" + data[i].quote_remark + "</option>"                       


                  // }
              });
              $('#budget_id').html(budget_id);   
              $('#qty_item').html(qty_content);   
              $('#uom_id').html(unit_content);     
              $('#quote_remark').html(remark_content);               
          },
          error: function (errorThrown){
              var budget_id = "<option value='1'>Unbudgeted</option>";
              var qty_content = "<option value='1'>Unbudgeted</option>";
               var unit_content = "<option value='1'>Unbudgeted</option>";
                var remark_content = "<option value='1'>Unbudgeted</option>";
          }
      });
   });

///------------------------experiment------------
// $('#quote_supplier_name').change(function(){   
//       var supplier_id = $(this).val();    
//       var opt_content = "";
//       var qty_content = "";
//       var unit_content = ""; 
//       var remark_content = "";      
//       $.ajax({
//           type: "POST",
//           url:  baseurl + "logistics/canvass/list_item",
//           dataType: "json",
//           data: {'supplier_id': supplier_id,'prf_id':$('#prf_id').val()},
//           success: function(data){
//               $.each(data, function(i, value){
//                   if (data[i].status_id == 1) {
//                       opt_content += "<option value='" + data[i].item_id + "'>" + data[i].description+ "</option>"
//                       qty_content += "<option value='" + data[i].quote_qty + "'>" + data[i].quote_qty + "</option>"
//                       unit_content += "<option value='" + data[i].quote_unit + "'>" + data[i].quote_unit + "</option>"                       
//                       remark_content += "<option value='" + data[i].quote_remark + "'>" + data[i].quote_remark + "</option>"        
//                   }
//               });
//               $('#item_description').html(opt_content);
//               $('#qty_item').html(qty_content);   
//               $('#quote_unit').html(unit_content);     
//               $('#quote_remark').html(remark_content);              
//           },
//           error: function (errorThrown){
//               toastr.error('Error!.', 'Operation Done');
//           }
//       });  
//   });     
///------------------------experiment end--------



//AGENT - 1
    $('#submit_canvass').click(function(){
        //contact
        // var arr_data_contact=[];
        // var rowCount_contact = $('#contacts_table tbody tr').length;

      var supplier_name = $('input[name="supplier_name[]"]').map(function(){
          return $(this).val();
      }).get();
      var contact_person = $('input[name="contact_person[]"]').map(function(){
          return $(this).val();
      }).get();

      var contact_number = $('input[name="contact_number[]"]').map(function(){
          return $(this).val();
      }).get();

      var terms_of_payment = $('input[name="terms_of_payment[]"]').map(function(){
          return $(this).val();
      }).get();

      var item_description = $('input[name="item_description[]"]').map(function(){
          return $(this).val();
      }).get();

      var budget_id = $('input[name="budget_id[]"]').map(function(){
          return $(this).val();
      }).get();

      var qty = $('input[name="qty[]"]').map(function(){
          return $(this).val();
      }).get();
     
      var unit = $('input[name="unit[]"]').map(function(){
          return $(this).val();
      }).get();

      var unit_price = $('input[name="unit_price[]"]').map(function(){
        return $(this).val();
      }).get();
    
      var offer_price = $('input[name="offer_price[]"]').map(function(){
          return $(this).val();
      }).get();

        var data = {

          'canvass_date':$('#canvass_date').val(),
          'canvassed_by':$('#canvassed_by').val(),
          'remarks':$('#remarks').val(),       
                    
          'supplier_name': supplier_name,
          'contact_person': contact_person,
          'contact_number': contact_number,
          'terms_of_payment': terms_of_payment,
          
          'item_description': item_description,
          'budget_id': budget_id,
          'qty': qty,
          'unit': unit,
          'unit_price': unit_price,
          'offer_price': offer_price 
        };

        console.log(data);
        $.ajax({
            type: "POST",
              url:  baseurl + "logistics/canvass/save_canvass",
            dataType: "text",
            data: data,
            success: function(data){
                toastr.success('Successfully Saved!', 'Operation Done');
            },
            error: function (errorThrown){
                toastr.error('Error!.', 'Operation Done');
            }
        });

    });

});

$("#price_offer").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
             // Allow: Ctrl+A, Command+A
            (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) || 
             // Allow: home, end, left, right, down, up
            (e.keyCode >= 35 && e.keyCode <= 40)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });

$("#contact_number").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
             // Allow: Ctrl+A, Command+A
            (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) || 
             // Allow: home, end, left, right, down, up
            (e.keyCode >= 35 && e.keyCode <= 40)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });




jQuery(document).ready(function() {
    TableDatatablesEditable.init();
});

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

