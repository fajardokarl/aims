var TableDatatablesEditable = function() {
  var all_contracts = $("#all_contracts").DataTable();



  var my_prf_table = $('#my_prf_table').DataTable({"order": [[ 0, "desc" ]],"columnDefs": [
                    {
                        "targets": [],
                        "visible": false,
                        "searchable": false
                    }, 
                    {
                      "targets": "_all",
              "orderable": false
                    }
                ]               
            });
    $('#my_prf_table').click(function(){
         var row = $(this).closest('tr')[0];
          var prf_id = my_prf_table.cell( row, 0 ).data();
          window.open(baseurl+"message/myPRFDetails?prf_id=" + prf_id);
        });     
   

       var sent_prf_table = $('#sent_prf_table').DataTable({"order": [[ 0, "desc" ]],"columnDefs": [
                    {
                        "targets": [0,1],
                        "visible": false,
                        "searchable": true
                    }, 
                    {
                      "targets": "_all",
              "orderable": false
                    }
                ], 
                "createdRow": function( row, data, dataIndex ) {
            // if ( data[8] == 0 ) {
            //   $(row).css('background-color', '#ffcfcf');
            // }else{
            //   $(row).css('background-color', '#d7ffcf');

            // }
        }
               
            });

         $('#all_contracts').on('dblclick', 'tr', function () {
            var row = $(this).closest('tr')[0];
            var prf_id = all_contracts.cell( row, 0 ).data();

            $.ajax({
                type: "POST",
                url : $("#remark_button").data("action"),
                dataType : "json",
                data: { prf_id: prf_id }/*,
                success : function(data){
                    console.log(data);
                },  
                error: function(errorThrown){
                    console.log(errorThrown);
                      toastr.success('Updated Document Remark', 'Success');
                }*/
            });

            window.open(baseurl+"message/prfdetails?messageid="+prf_id);
         });

        $('#pdf_amort_sched').click(function(){
          var id_prf = $('#id_prf').val();
          window.open(baseurl+"message/pdf_prfdetails?id_prf=" + id_prf);
        });     



  var all_request = $('#all_request').DataTable({"order": [[ 0, "desc" ]],"columnDefs": [
                    {
                        "targets": [],
                        "visible": false,
                        "searchable": false
                    }, 
                    {
                      "targets": "_all",
              "orderable": false
                    }
                ]               
            });
  
   // var all_request = $('#all_request').DataTable({searching: false, paging: false});

     $('#all_request').on('dblclick', 'tr', function () {
        var row = $(this).closest('tr')[0];
        var prf_id = all_request.cell( row, 0 ).data();

        window.open(baseurl+"message/prf_request?messageid="+prf_id);
     });

     $(document).on('click', '.status_action', function(){
      console.log('nisulod');
      $('#mod_prf_id').val($('#id_prf').val());

      var slicer = ($('button.status_action').html()).lastIndexOf(">");
      slicer = $('button.status_action').html().slice(slicer+1);
      
      /*switch(slicer){
        case 'Pending':
          $('#mod_statusid').val('3');
          // $('#btn_changestatus').text('Deny');
          // $('#btn_changestatus').removeClass('btn btn-circle green');
          // $('#btn_changestatus').addClass('btn btn-circle red');
          break;
        case 'Denied':
          $('#mod_statusid').val('1');
          // $('#btn_changestatus').text('APPROVE');
          // $('#btn_changestatus').removeClass('btn btn-circle red');
          // $('#btn_changestatus').addClass('btn btn-circle green');
          break;
        case 'Approved':
          $('#mod_statusid').val('4');
          break;
      }*/
      $('#frm_status').modal('toggle');
    });
     $(document).on('click', '#status_approve', function() {
        $('#mod_statusid').val('4');
     });
     $(document).on('click', '#status_deny', function() {
        $('#mod_statusid').val('3');
     });


//------------------------------------------------------//


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




      var id = $('#prf_detail_id').val();
      var id_prf = $('#id_prf').val();             
      var description = $('#description').val();       
      var remarks = $('#remarks').val();
      var approve_reason = $('#approve_reason').val();
      var amount = $('#amount').val();
      var sub_total =$('#approve_reason').val() * amount;
      var total = 0;
      var all_total = total + total;
      var amf =  $('#total_amount').val();
      var stat_val;
    
    $.each(sent_prf_table.rows().data(),function(i,value){

      total = parseFloat(total) + parseFloat(sent_prf_table.cell(i,5).data());

});    
      $('#total').html("&#8369; " + total);
      if ($('#canvass_txt_status').hasClass("EDITED")) {
        $('#canvass_txt_status').removeClass("EDITED");
        $('#canvass_txt_status').addClass("EDITED");
        $('#canvass_btn_text').text("Approve?");

        $('#canvass_txt_status').removeClass("font-green-jungle");
        $('#canvass_txt_status').addClass("font-red-haze");
        $('#canvass_txt_status').removeClass("EDITED");
        $('#canvass_txt_status').addClass("EDITED");
        $('#canvass_txt_status').html("EDITED");
        $('#canvass_btn_text').text("MARK APPROVE");
        
        stat_val = 0;
      }else{
        $('#canvass_txt_status').removeClass("EDITED");
        $('#canvass_txt_status').addClass("EDITED");
        $('#canvass_btn_text').text("MARK DISAPPROVE");

        $('#canvass_txt_status').removeClass("font-red-haze");
        $('#canvass_txt_status').addClass("font-green-jungle");
        $('#canvass_txt_status').removeClass("EDITED");
        $('#canvass_txt_status').addClass("EDITED");
        $('#canvass_txt_status').html('EDITED');
        $('#canvass_btn_text').text("Mark Disapprove");
        
        stat_val = 1;
      }

      var data = {
        'id' : id,
        'stat_val' : stat_val,
        'approve_reason' : approve_reason,      
        'sub_total' : sub_total,
        'all_total' : all_total,
        'amf' : amf,
        'total' : total


      };
      $.ajax({
        type: "POST",
              url : baseurl + "message/change_qty",
              dataType : "json",
              data: data,
              success : function(data){
                console.log(data);
                asset_table(id_prf);
                alert(total);              
              }, 
              error: function(errorThrown){
                  console.log(errorThrown);
              }
      });     
    });


   $('#sent_prf_table').on('click', 'tr', function () {        
            var row = $(this).closest('tr')[0];
            var prf_id = sent_prf_table.cell( row, 0 ).data();
      $('#sticker_print').modal('toggle');

      $('#prf_detail_id').val(sent_prf_table.cell(row, 0 ).data());
      $('#amount').val(sent_prf_table.cell(row, 4 ).data());
      $('#stckr_description').text(sent_prf_table.cell(row, 2 ).data());
      $('#stckr_price_offer').text(sent_prf_table.cell(row, 3 ).data());
      $('#stckr_supplier').text(sent_prf_table.cell(row, 4 ).data());
      $('#stckr_TOP').text(sent_prf_table.cell(row, 5 ).data());
      $('#stckr_person').text(sent_prf_table.cell(row, 6 ).data());
      $('#stckr_number').text(sent_prf_table.cell(row, 7 ).data());

       if (sent_prf_table.cell(row, 8 ).data() == 0) {
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
                url : baseurl + "message/get_updated_qty",
                dataType : "json",
                data: {'id':id},
                success : function(data){                                    
                        sent_prf_table.clear().draw();
                  $.each(data, function (index, value){
                    sent_prf_table.row.add([ 
                      data[index].prf_detail_id,              
                      data[index].prf_id,
                      data[index].description,
                      data[index].qty,                   
                      data[index].amount,                     
                      data[index].sub_total,                
                      data[index].description,
                      data[index].remarks,
                      data[index].is_change
                      
                      
                    ]).draw( false );
                        });
                }, 
                error: function(errorThrown){
                    console.log(errorThrown);
                }

      });
    }   


  // Edit and save price and quantity in PRF using Karl style in marketing
  var sent_prf_table = $('#sent_prf_table').DataTable();
  sent_prf_table.on('click', '.btn-lot-edit', function (e) {
                e.preventDefault();
                var row = $(this).closest('tr')[0];
                var prf_detail_id = sent_prf_table.cell(row, 0 ).data();
                var prf_id = sent_prf_table.cell(row, 1 ).data();
                console.log(prf_detail_id);
                if (prf_detail_id != null || prf_detail_id != 0) {
                  $.ajax({
                      type: "POST",
                      url:  baseurl + "message/get_one_prf",
                      dataType: "json",
                      data: {'prf_detail_id': prf_detail_id,'prf_id': prf_id},
                      success: function(data){
                        // alert(prf_detail_id);
                        $("#prf_detail_id").val(prf_detail_id);
                        $("#prf_id").val(prf_id);                      
                        $("#qty").val(data[0].qty);
                        $("#amount").val(data[0].amount);
                        $("#remarks").val(data[0].remarks);
                        $("#sub_total").val(((parseInt(data[0].qty * data[0].amount))));
                        $("#total_amount").val(data[0].total_amount);                  
                    
                      },
                      error: function (errorThrown){
                          console.log(errorThrown)
                          toastr.error('Error!.', 'Operation Done');
                      }
                  });                  
                }

            });
  //end here

  //saving edited data starts here
    $('#update_prf').click(function(){
    console.log($("#amount").val());
    var prf_detail_id = $("#prf_detail_id").val();
    var prf_id = $("#prf_id").val();

    var total_amount = 0;
    $.each(sent_prf_table.rows().data(),function(i,value){

    total_amount = parseFloat(total_amount) + parseFloat(sent_prf_table.cell(i,5).data());
      }); 

   $('#total_amount').html("&#8369; " + total_amount); 

        var data = {
            'prf_detail_id': prf_detail_id, 
            'prf_id': prf_id, 
            'qty': $("#qty").val(),            
            'remarks': $("#remarks").val(),
            'amount': $("#amount").val(),
            'sub_total': $("#qty").val() * $("#amount").val(),
            'activate_cancel':$('#activate_cancel option:selected').val(),          
            'is_cancel':$('#is_cancel option:selected').val(),          
            'total_amount': total_amount

        };
    $.ajax({
            type: "POST",
            url:  baseurl + "message/update_prf",
            dataType: "json",
            data: data,
            success: function(data){
              $('#view-lots').modal('toggle');
            location.reload();
            // alert(is_cancel);  
            toastr.success('Successfully Saved!', 'Operation Done');
            },
            error: function (errorThrown){
                console.log(errorThrown)
                toastr.error('Error!.', 'Operation Done');
            }
          });

  });
  // end here      


     $('#id_for_unseen').html('');

}();
jQuery(document).ready(function() {
    // TableDatatablesEditable.init();
});