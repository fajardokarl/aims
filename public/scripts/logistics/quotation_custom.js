var TableDatatablesEditable = function() {
  var prf_list_table = $("#prf_list_table").DataTable({"order": [[ 1, "desc" ]],"lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]] });

  var prf_quotation_table = $("#prf_quotation_table").DataTable({"order": [[ 1, "desc" ]],"lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]] });
  var quotation_item_table = $("#quotation_item_table").DataTable({"columnDefs": [
                    {
                        "targets": [],
                        "visible": false,
                        "searchable": true
                    }, 
                    {
                      "targets": "_all",
              "orderable": false
                    }
                ],searching: false, paging: false});

 
  var capex_repair = $("#capex_repair").DataTable();
  var capex_acquisition = $("#capex_acquisition").DataTable();
  var capex_details_list = $("#capex_details_list").DataTable({searching: false, paging: false});
  var capex_details_list = $("#capex_acquisition_list").DataTable({searching: false, paging: false});
  var quotation_list_table = $('#quotation_list_table').DataTable({"order": [[ 0, "desc" ]],"lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]] });
  var list_table = $('#list_table').DataTable({"order": [[ 0, "desc" ]],"lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]] });  
  var list_of_quote = $("#list_of_quote").DataTable({searching: false, paging: false});
        
  var capex_table = $('#capex_table').DataTable({searching: false, paging: false});

         
         $('#prf_quotation_table').on('dblclick', 'tr', function () {
            var row = $(this).closest('tr')[0];
            var prf_id = prf_quotation_table.cell( row, 0 ).data();
            window.open(baseurl+"Logistics/prf_quotation_controller/retrieve_all_prf_details?prfid="+prf_id);
         });




         $('#prf_list_table').on('dblclick', 'tr', function () {
            var row = $(this).closest('tr')[0];
            var prf_id = prf_list_table.cell( row, 0 ).data();
            window.open(baseurl+"Logistics/prf_list_controller/retrieve_all_prf?prf_id="+prf_id);
         });




        $('#pdf_canvass_form').click(function(){
          var prf_id = $('#prf_id').val();
          window.open(baseurl+"Logistics/prf_list_controller/pdf_prfdetails?id_prf="+prf_id);
        });

       $('#capex_repair').on('click', 'tr', function () {
         var row = $(this).closest('tr')[0];
         var capex_id = capex_repair.cell( row, 0 ).data();
        window.open(baseurl+"Logistics/capex_list_controller/retrieve_all_capex_details?capexid=" + capex_id);
        });

//CAPEX Clickable Table ends here
       $('#pdf_capex_form').click(function(){
          var capex_id = $('#capex_id').val();
          window.open(baseurl+"Logistics/capex_list_controller/pdf_capexlist?capexid="+capex_id);
        });

//capex New project/aquisition clickable table

        $('#capex_acquisition').on('click', 'tr', function () {        
          var row = $(this).closest('tr')[0];
          var capex_acquisition_id = capex_acquisition.cell( row, 0 ).data();
          window.open(baseurl+"Logistics/capex_list_controller/retrieve_all_capex_project_details?capex_repair=" + capex_acquisition_id);
        });
//CAPEX Clickable Table ends here
      $('#pdf_capex_form_acquisition').click(function(){
          var capex_id = $('#capex_id').val();
          window.open(baseurl+"Logistics/capex_list_controller/pdf_capex_acquisition?capexid="+capex_id);
        });

      $('#list_of_quote').on('click', 'tr', function () {        
          var row = $(this).closest('tr')[0];
          var quote_detail_id = list_of_quote.cell( row, 0 ).data();
          // var quote_detail_id = quotation_list_table.cell( row, 1 ).data();
          // window.open(baseurl+"Logistics/prf_quotation_controller/pdf_quotation?quote_detail_id="+quote_detail_id +"&q_id="+quotation_id);
          window.open(baseurl+"Logistics/prf_quotation_controller/pdf_quotation?quote_detail_id="+quote_detail_id);

        });

      $('#list_table').on('click', 'tr', function () {        
          var row = $(this).closest('tr')[0];
          var prf_id = list_table.cell( row, 0 ).data();          
          window.open(baseurl+"Logistics/prf_quotation_controller/all_quotation?prf_id="+prf_id);

        });
$('#item_description').change(function(){   
      var item_id = $(this).val();    
      
      var budget_ids = "";      
      var qty_content = "";
      var unit_content = ""; 
      var remarks_content = "";  
      $.ajax({
          type: "POST",
          url:  baseurl + "logistics/prf_quotation_controller/prf_details",
          dataType: "json",
          data: {'item_id': item_id,'prf_id': $('#prf_id').val()},
          success: function(data){            
              $.each(data, function(i, value){

                    // if (budget_id == 0) {
                    //   budget_ids += "<option value='0'>Unbudgeted</option>"

                    // }else{
                    //   budget_ids += "<option value='" + data[i].budget_ids + "'>budgeted</option>"
                    
                    // }
                      budget_ids += "<option value='" + data[i].budget_id + "'>" + data[i].budget_id + "</option>"
                      qty_content += "<option value='" + data[i].qty + "'>" + data[i].qty + "</option>"                       
                      unit_content += "<option value='" + data[i].prf_uom_id + "'>" + data[i].uom_name + "</option>"                       
                      remarks_content += "<option value='" + data[i].remarks + "'>" + data[i].remarks + "</option>"                  
                
              });
              $('#budget_id').html(budget_ids);              
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



// $('#trybtn').click(function(){
// // alert($("#supplier_name").val());
// var a = $("#supplier_name").val();
//   $.each(a, function(i, val){
//     alert(val);
//   });


// });

$(document).on('click', '.status_action', function(){
      $('#mod_prf_id').val($('#prf_id').val());

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
        $('#mod_statusid').val('0');
     });
     $(document).on('click', '#status_deny', function() {
        $('#mod_statusid').val('1');
     });








  $('#request_quotation').click(function(){
 

      var item_description = $('input[name="item_description[]"]').map(function(){
          return $(this).val();
      }).get();

      var budget_id = $('input[name="budget_id[]"]').map(function(){
          return $(this).val();
      }).get();

      var supplier_name = $('input[name="supplier_name[]"]').map(function(){
          return $(this).val();
      }).get();

      var quote_qty = $('input[name="quote_qty[]"]').map(function(){
          return $(this).val();
      }).get();
      var quote_unit = $('input[name="quote_unit[]"]').map(function(){
          return $(this).val();
      }).get();
      var quote_remark = $('input[name="quote_remark[]"]').map(function(){
          return $(this).val();
      }).get();





      var data = {

        //= to view ID.......value to be inserted//
          'requested_by_id':$('#requested_by_id').val(),        
          'date_requested':$('#date_requested').val(),            
          'prf_id':$('#prf_id').val(),
          'request_quotation':$('#request_quotation').val(),

          'item_description':item_description,
          'budget_id':budget_id,
          'supplier_name':supplier_name, 
          'quote_qty':quote_qty, 
          'quote_unit':quote_unit, 
          'quote_remark':quote_remark 
      };

      console.log(data);
      $.ajax({
          type: "POST",
          url:  baseurl + "logistics/prf_quotation_controller/save_quotation",
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


  $("#add_quotation").click(function(){
        var rowCount_contact = $('#quotation_item_table tbody tr').length;
       
       
  if ($("item_description").val() != "") {
  quotation_item_table.row.add( [        
        
         "<input type='hidden' name='item_description[]' value='" + $("#item_description option:selected").val() + "'>" + $("#item_description option:selected").text(),
         "<input type='hidden' name='budget_id[]' value='" + $("#budget_id option:selected").val() + "'>" + $("#budget_id option:selected").text(),
         "<input type='hidden' name='quote_qty[]' value='" + $("#quote_qty option:selected").val() + "'>" + $("#quote_qty option:selected").text(),
         "<input type='hidden' name='quote_unit[]' value='" + $("#quote_unit option:selected").val() + "'>" + $("#quote_unit option:selected").text(),
         "<input type='hidden' name='quote_remark[]' value='" + $("#quote_remark option:selected").val() + "'>" + $("#quote_remark option:selected").text(),         
         "<input type='hidden' name='supplier_name[]' value='" + $("#supplier_name option:selected").val() + "'>" + $("#supplier_name option:selected").text(),        
         '<a href="#" class="btn btn-danger cust_delete_contact">remove</a>'
        ] ).draw( false );  

        }else{
            toastr.options.timeOut = 500;
            toastr.error('Please Fill everything in this form.', 'Replacement Notice!');
        }
      });

      quotation_item_table.on('click', '.cust_delete_contact', function(e){
        e.preventDefault();
        quotation_item_table.row($(this).closest('tr')).remove().draw();
      });
   

      
   var handleTable = function () {
           
    }
    return {

        //main function to initiate the module
        init: function () {
            handleTable();
        }

    };
  var select = $('#select2').select2();
  
}();
jQuery(document).ready(function() {
    TableDatatablesEditable.init();
});