var customermasterlist = function () {

  var handleCustomerMasterList = function () {
      var prf_item_table = $("#prf_item_table").DataTable({searching: false, paging: false});
      var contacts_table = $("#prf_item_table");

      

      // var prf_item_table_sample = $("#prf_item_table_sample").DataTable({searching: false, paging: false});
      // var contacts_table = $("#prf_item_table_sample");


      var repairs = $("#repairs").DataTable({searching: false, paging: false});     
      var contacts_table = $("#repairs");   
      var prePRFlist = $('#prePRFlist').DataTable({"order": [[ 0, "desc" ]],"lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]] }); 


      var capex_table = $("#capex_table").DataTable({searching: false, paging: false}); 
      var contacts_table = $("#capex_table");

      var acquisition_table = $("#acquisition_table").DataTable({searching: false, paging: false}); 
      var contacts_table = $("#acquisition_table");  


      var repairAndMaintenance = $("#repairAndMaintenance").DataTable({searching: false, paging: false}); 
      var contacts_table = $("#repairAndMaintenance");  

      var replacement_table = $("#replacement_table").DataTable({searching: false, paging: false}); 
      var contacts_table = $("#replacement_table");  

      var preCapexLists = $("#preCapexLists").DataTable();  


      var tbl_budgeted = $("#tbl_budgeted").DataTable();

 
      $('#pdf_report').click(function(){
        var pid = $('#id_client').val();
        window.open(baseurl+"marketing/customer_pdf?personid=" + pid);
      });

      $('#pdf_amort_sched').click(function(){
        var id_contract = $('#id_contract').val();
        window.open(baseurl+"marketing/pdf_amortsched?id_contract=" + id_contract);
      });


      contacts_table.on('click', '.cust_cont_remove', function (e) {
              e.preventDefault();
              var nRow = $(this).closest('.toRemove').remove();
         });



      if (jQuery().datepicker) {
          $('#birthdate').datepicker({
              rtl: App.isRTL(),
              format: 'yyyy-mm-dd',
              orientation: "left",
              autoclose: true
          });
      }   


       $('#birthdate').keyup(function(){
           var v = this.value;
          if (v.match(/^\d{4}$/) !== null) {
              this.value = v + '-';
          } else if (v.match(/^\d{4}\-\d{2}$/) !== null) {
              this.value = v + '-';
          }
      });

          if (jQuery().datepicker) {
          $('#date_acquired').datepicker({
              rtl: App.isRTL(),
              format: 'yyyy-mm-dd',
              orientation: "left",
              autoclose: true
          });
      }   


       $('#date_acquired').keyup(function(){
           var v = this.value;
          if (v.match(/^\d{4}$/) !== null) {
              this.value = v + '-';
          } else if (v.match(/^\d{4}\-\d{2}$/) !== null) {
              this.value = v + '-';
          }
      });

    // var capex_sample = $('#capex_sample').DataTable({
    //     "bSort" : true,
    //     "aLengthMenu": [[5, 10, 50, -1], [5, 10, 50, "All"]],
    //     "iDisplayLength": 5,
    //     "fixedHeader": true,
    //      fixedHeader: {
    //         header: true,
    //     }
    // });

//---populate from database ajax for maintenance asset
  $('#custodian').change(function(){      
      var employee_id = $(this).val();
      
      var asset_item = "";
        $.ajax({
          type: "POST",
          url:  baseurl + "logistics/request/retrieve_asset",
          dataType: "json",
          data: {'employee_id': employee_id},
          success: function(data){
              $.each(data, function(i, value){                 
                      asset_item += "<option value='" + data[i].asset_description + "'>" + data[i].asset_description + "</option>"                       
                  
              });
              $('#asset_item').html(asset_item);                       
          },
          error: function (errorThrown){
              
          }
      });
  }); 
//--- end here


      //----Populate from Database AJAX
   $('#item').change(function(){
      // alert(realty_id = $(this).val());
      var item_id = $(this).val();
      var budget_detail_id = $(this).val();
      var opt_content = "";
      var budget_content = "<option value='0'>Unbudgeted</option>";
      var budget_id = "";
      var approved_amount = "";

      $.ajax({
          type: "POST",
          url:  baseurl + "logistics/request/list_uom",
          dataType: "json",
          data: {'item_id': item_id},
          success: function(data){
              $.each(data, function(i, value){
                  if (data[i].status_id == 1) {
                      opt_content += "<option value='" + data[i].uom_id + "'>" + data[i].uom_name + "</option>"
                    }
              });
              $('#uom_opt').html(opt_content);             
          },
          error: function (errorThrown){
              toastr.error('Error!.', 'Operation Done');
          }
      });
       $.ajax({
          type: "POST",
          url:  baseurl + "logistics/request/budget_list",
          dataType: "json",
          data: {'item_id': item_id, 'department_id': $('#department_id').val()},
          success: function(data){
              $.each(data, function(i, value){
                  // if (data[i].status_id == 1) {                     
                      approved_amount += "<option value='" + data[i].budget_amount + "'>" + data[i].budget_amount + "</option>"                       
                      budget_content += "<option value='" + data[i].budget_detail_id + "'>" + data[i].budget_amount + "</option>"                       
                      budget_id += "<option value='" + data[i].budget_id + "'>" + data[i].budget_id + "</option>"            
                  // }
              });
              $('#budgeted').html(budget_content);
              $('#budget_id').html(budget_id);                  
              $('#approved_amount').html(approved_amount);                  
          },
          error: function (errorThrown){
              // var budget_content = "<option value='0'>Unbudgeted</option>";
          }
      });
  });     
    //---end here
 
    //---Hide CAPEX Category
  $('#prf').ready(function(){
     
         
          $('#capex').hide();
          $('#replacement').hide();
          $('#acquisition').hide();
          $('#repair_maintenance').hide();
        }); 

$('#prf').ready(function(){
 
  
   $('#capex_acquisition').hide();
         $('#capex_repairs').hide();
  
  }); 
// $('#add').click(function(){
     
//          if($('#cust_cont_value').val() <= 5000) {
//           $('#capex_acquisition').show();
//           $('#capex_repairs').show();
//           $('#capex_acquisition_end').hide();
//         }
//         }); 
  

    $('#prf').ready(function(){
      if ($('#department_id').val() != 4) {  
          console.log( "ready!" );   
         
          $('#label_project').hide();
          $('#project_id').prop('disabled',true);     
        } 
       });

    $('#prf').submit(function(){
      $('#project_id').prop('disabled',false);     
    });

    //---end here


    $(document).ready(function(){
    $('#maintenance').click(function(){ 


        $('#repair_maintenance').show();
        $('#capex').hide();
        $('#acquisition').hide();
        $('#replacement').hide();
        // $('#prf_status_id').hide();
    });    
    }); 
$(document).ready(function(){
    $('#genPRF').click(function(){ 


        $('#repair_maintenance').hide();
        $('#capex').hide();
        $('#acquisition').hide();
        $('#replacement').hide();
    });
    });

$(document).ready(function(){
    $('#capex_aquisition').click(function(){ 
        $('#repair_maintenance').hide();
        $('#capex').show();
        $('#acquisition').show();
        $('#replacement').hide();
    });
    });


$(document).ready(function(){
    $('#capex_replacement').click(function(){ 
        $('#repair_maintenance').hide();
        $('#capex').show();
        $('#acquisition').hide();
        $('#replacement').show();
    });
    });


    $(document).ready(function(){
    $('#request').click(function(){ 


        $('#print').show();
        $('#prf_status_id').hide();
    });
   
    }); 



  $('#prf_status_id').click(function(){
 
      //maintenamce
     // var custodian = $('input[name="custodian[]"]').map(function(){
     //      return $(this).val();
     //  }).get();  

     //  var asset_item = $('input[name="asset_item[]"]').map(function(){
     //      return $(this).val();
     //  }).get();
    
      // item mapping
      var item = $('input[name="item[]"]').map(function(){
          return $(this).val();
      }).get();
      var cust_cont_value = $('input[name="cust_cont_value[]"]').map(function(){
          return $(this).val();
      }).get();
      var approved_amount = $('input[name="approved_amount[]"]').map(function(){
          return $(this).val();
      }).get();var qty = $('input[name="qty[]"]').map(function(){
          return $(this).val();
      }).get();

      var uom = $('input[name="uom[]"]').map(function(){
          return $(this).val();
      }).get();

      var budgeted = $('input[name="budgeted[]"]').map(function(){
          return $(this).val();
      }).get();

      var item_remarks = $('input[name="item_remarks[]"]').map(function(){
          return $(this).val();
      }).get();

       var budget_id = $('input[name="budget_id[]"]').map(function(){
        return $(this).val();
      }).get();
    
      var sub_total = $('input[name="sub_total[]"]').map(function(){
          return $(this).val();
      }).get();



    
      //CAPEX mapping
      // var classification_name = $('input[name="classification_name[]"]').map(function(){
      //     return $(this).val();
      // }).get();

      // var capex_type = $('input[name="capex_type[]"]').map(function(){
      //     return $(this).val();
      // }).get();

      // // var capex_description = $('input[name="capex_description[]"]').map(function(){
      // //     return $(this).val();
      // // }).get()

      // var purpose = $('input[name="purpose[]"]').map(function(){
      //     return $(this).val();
      // }).get()

      // var capex_justification_id = $('input[name="capex_justification_id[]"]').map(function(){
      //     return $(this).val();
      // }).get()

      // var equipment_cost = $('input[name="equipment_cost[]"]').map(function(){
      //     return $(this).val();
      // }).get()

      // var labor_cost = $('input[name="labor_cost[]"]').map(function(){
      //     return $(this).val();
      // }).get()

      // var freight_cost = $('input[name="freight_cost[]"]').map(function(){
      //     return $(this).val();
      // }).get()

      // var incidental_expenses = $('input[name="incidental_expenses[]"]').map(function(){
      //     return $(this).val();
      // }).get()

      // var estimated_cost = $('input[name="estimated_cost[]"]').map(function(){
      //     return $(this).val();
      // }).get()

      // var less_trade_in = $('input[name="less_trade_in[]"]').map(function(){
      //     return $(this).val();
      // }).get()

      // var net_estimated_cost = $('input[name="net_estimated_cost[]"]').map(function(){
      //     return $(this).val();
      // }).get() 

      // var remarks = $('input[name="remarks[]"]').map(function(){
      //     return $(this).val();
      // }).get()

//------------------------------------------------
//--------------------New/Acquisition mapping-------------------------

      // var new_replacement = $('input[name="new_replacement[]"]').map(function(){
      //     return $(this).val();
      // }).get();
    
      // var new_location = $('input[name="new_location[]"]').map(function(){
      //     return $(this).val();
      // }).get()   
     
      // var new_equipment_cost = $('input[name="new_equipment_cost[]"]').map(function(){
      //     return $(this).val();
      // }).get()  

      // var new_estimate_useful_life = $('input[name="new_estimate_useful_life[]"]').map(function(){
      //     return $(this).val();
      // }).get()

      // var new_capacity_of_unit = $('input[name="new_capacity_of_unit[]"]').map(function(){
      //     return $(this).val();
      // }).get()

      // var new_limitations_of_unit = $('input[name="new_limitations_of_unit[]"]').map(function(){
      //     return $(this).val();
      // }).get()

      // var new_advantage_over_repair = $('input[name="new_advantage_over_repair[]"]').map(function(){
      //     return $(this).val();
      // }).get()
//-----------------------Replacement mapping------------------------------

      // var repair_replacement = $('input[name="repair_replacement[]"]').map(function(){
      //     return $(this).val();
      // }).get();
    
      // var repair_location = $('input[name="repair_location[]"]').map(function(){
      //     return $(this).val();
      // }).get()   
     
      // var date_acquired = $('input[name="date_acquired[]"]').map(function(){
      //     return $(this).val();
      // }).get()  

      // var repair_advantage_over_new = $('input[name="repair_advantage_over_new[]"]').map(function(){
      //     return $(this).val();
      // }).get()

      // var repair_net_book_value = $('input[name="repair_net_book_value[]"]').map(function(){
      //     return $(this).val();
      // }).get()

      // var repair_reason_for_replacement = $('input[name="new_limitations_of_unit[]"]').map(function(){
      //     return $(this).val();
      // }).get()
    
      var data = {


        //maintenance
          'asset_item':$('#asset_item option:selected').val(),
          'custodian':$('#custodian option:selected').val(),

        //= to view ID.......value to be inserted//
          'requested_by_id':$('#requested_by_id').val(),
          'department_id':$('#department_id').val(),
          'project_id':$('#project_id').val(),           
          'birthdate':$('#birthdate').val(),            
          'prf_remarks':$('#prf_remarks').val(),
          'deliverTo':$('#deliverTo').val(),
          'prf_status_id':$('#prf_status_id').val(),
          'purpose_prf':$('#purpose_prf').val(),          
          'total_amount':$('#total_amount').html(),
          'justification':$('#justification').val(),
          'request_type':$('#request_type').val(),

         // 'capex_description':$('#capex_description').val(),
         // 'purpose':$('#purpose').val(),
         // 'classification_name':$('#classification_name').val(),
         'capex_type':$('#capex_type').val(),                
         'capex_justification_id':$('#capex_justification_id').val(),
         'equipment_cost':$('#equipment_cost').val(),
         'labor_cost':$('#labor_cost').val(),          
         'freight_cost':$('#freight_cost').val(),
         'incidental_expenses':$('#incidental_expenses').val(),
         'estimated_cost':$('#estimated_cost').val(),
         'less_trade_in':$('#less_trade_in').val(),
         'net_estimated_cost':$('#net_estimated_cost').val(),         
         // 'remarks':$('#remarks').val(),

         'new_replacement':$('#new_replacement').val(),
         'new_location':$('#new_location').val(),     
         'new_estimate_useful_life':$('#new_estimate_useful_life').val(),
         'new_capacity_of_unit':$('#new_capacity_of_unit').val(),  
         'new_limitations_of_unit':$('#new_limitations_of_unit').val(),        
         'new_advantage_over_repair':$('#new_advantage_over_repair').val(), 

        'repair_replacement':$('#repair_replacement').val(),
        'repair_location':$('#repair_location').val(),
        'date_acquired':$('#date_acquired').val(),        
        'repair_advantage_over_new':$('#repair_advantage_over_new').val(),
        'repair_net_book_value':$('#repair_net_book_value').val(),
        'repair_reason_for_replacement':$('#repair_reason_for_replacement').val(), 
          
          // 'asset_item':asset_item,
          // 'custodian': custodian,
          'budgeted':budgeted,
          'item':item,
          'approved_amount':approved_amount,
          'cust_cont_value':cust_cont_value,
          'qty':qty,
          'sub_total':sub_total,
          'uom':uom,
          'budget_id':budget_id,      
          'item_remarks':item_remarks 
       
           

       //-----------acquisition---------------//  
         // 'capex_description':capex_description,
         // 'purpose':purpose,
         // 'classification_name':classification_name,
         // 'capex_type':capex_type,                
         // 'capex_justification_id':capex_justification_id,
         // 'equipment_cost':equipment_cost,
         // 'labor_cost':labor_cost,          
         // 'freight_cost':freight_cost,
         // 'incidental_expenses':incidental_expenses,
         // 'estimated_cost':estimated_cost,
         // 'less_trade_in':less_trade_in,
         // 'net_estimated_cost':net_estimated_cost,         
         // 'remarks':remarks,

         // 'new_replacement':new_replacement,
         // 'new_location':new_location,     
         // 'new_estimate_useful_life':new_estimate_useful_life,
         // 'new_capacity_of_unit':new_capacity_of_unit,  
         // 'new_limitations_of_unit':new_limitations_of_unit,        
         // 'new_advantage_over_repair':new_advantage_over_repair, 


       //--------------replacement------------//

        // 'repair_replacement':repair_replacement,
        // 'repair_location':repair_location,
        // 'date_acquired':date_acquired,        
        // 'repair_advantage_over_new':repair_advantage_over_new,
        // 'repair_net_book_value':repair_net_book_value,
        // 'repair_reason_for_replacement':repair_reason_for_replacement  
        
   

      };

      console.log(data);


      $.ajax({
          type: "POST",
          url:  baseurl + "logistics/request/save_items",
          dataType: "json",
          data: data,
          success: function(data){
              toastr.success('Successfully Saved!', 'Operation Done');
          },
          error: function (errorThrown){
              toastr.error('Error!.', 'Operation Done');
          }
      });
  });


  function clearFields()
  {
    $('#item').val('');
    $('#cust_cont_value').val('');
    $('#qty').val('');
    $('#item_remarks').val('');
    $('#sub_total').val('');

  }

  $("#replacementcapex").click(function() {
    $("#capex").show();
    $("#replacement").show();
   })

 $("#project").click(function() {
  $("#capex").show();
  $("#acquisition").show();
 })

//starts here
var total = 0;
$("#add").click(function(){
        var rowCount_contact = $('#prf_item_table tbody tr').length;
        var subtotal = ($("#qty").val()*$("#cust_cont_value").val());

        if ($('#cust_cont_value').val() < $('#budget_amount').val()) {
           toastr.options.timeOut = 500;
           toastr.error('Your Item need to be CAPEX.', 'Price Checked!');
        
          $('#myModal').modal({
        show: 'false'});         
        }

        if ($('#cust_cont_value').val() >= 5000) {
          toastr.options.timeOut = 500;
          toastr.error('Your Item need to be CAPEX.', 'Price Checked!'); 
           $('#myModal').modal({
        show: 'false'});      
        }

        if ($('#cust_cont_value').val() > $("#approved_amount option:selected").val()) {
          toastr.options.timeOut = 2500;
          toastr.error('Your price is higher than approved amount.', 'Price Checked!');

        // $('#budgeted').html("Unbudgeted"); 
        // $('#budgeted').html('Unbudgeted');

        }
    

    
   

if ($("#cust_cont_value").val() && $("#item").val() && $("#qty").val() && $("#uom_opt").val() && $("#item_remarks").val() && $("#qty").val() != "") {
prf_item_table.row.add( [ 
        "<input type='hidden' name='item[]' value='" + $("#item option:selected").val() + "'>" + $("#item option:selected").text(),
        "<input type='hidden' name='budget_id[]' value='" + $("#budget_id option:selected").val() + "'>" + $("#budget_id option:selected").text(),   
        "<input type='hidden' name='approved_amount[]' value='" + $("#approved_amount option:selected").val() + "'>" + $("#approved_amount option:selected").text(),   
        "<input type='hidden' name='cust_cont_value[]' value='" + $("#cust_cont_value").val() + "'>" + $("#cust_cont_value").val(),
        "<input type='hidden' name='qty[]' value='" + $("#qty").val() + "'>" + $("#qty").val(), 
        "<input type='hidden' name='uom[]' value='" + $("#uom_opt option:selected").val() + "'>" + $("#uom_opt option:selected").text(),                                         
        "<input type='hidden' name='budgeted[]' value='" + $("#budgeted option:selected").val() + "'>" + $("#budgeted option:selected").text(),   
        "<input type='hidden' name='item_remarks[]' value='" + $("#item_remarks").val() + "'>" + $("#item_remarks").val(),
        // "<input type='hidden' name='delivery[]' value='" + $("#delivery option:selected").val() + "'>" + $("#delivery option:selected").text(),
        "<input type='hidden' name='sub_total[]' value='" + ($("#qty").val()*$("#cust_cont_value").val()) + "'>" + subtotal,
        '<a href="javascript:;" class="btn btn-danger cust_delete_contact reload">remove</a>'
        ] ).draw( false );
            // $("#cust_cont_value").val('');
            total = total + subtotal;
            $("#total_amount").html(total);
            console.log(total);

        }else{
            toastr.options.timeOut = 500;
            toastr.error('Please Fill Contact Value.', 'Notice!');
        }
      });

      prf_item_table.on('click', '.cust_delete_contact', function(e){
        e.preventDefault();
        prf_item_table.row($(this).closest('tr')).remove().draw();
      });     

// end here

//repairs starts here


//   var total = 0;
// $("#add_capex").click(function(){
//         var rowCount_contact = $('#capex_table tbody tr').length;
//         var total = parseFloat($("#equipment_cost").val()) + parseFloat($("#labor_cost").val()) + parseFloat($("#freight_cost").val()) + parseFloat($("#incidental_expenses").val());
//         var net_total = parseFloat($("#equipment_cost").val()) + parseFloat($("#labor_cost").val()) + parseFloat($("#freight_cost").val()) + parseFloat($("#incidental_expenses").val()) - parseFloat($("#less_trade_in").val());
       
// if ($("classification_name").val() != "") {
// capex_table.row.add( [        
//          // "<input type='hidden' name='capex_description[]' value='" + $("#capex_description").val() + "'>" + $("#capex_description").val(),   
//          "<input type='hidden' name='classification_name[]' value='" + $("#classification_name option:selected").val() + "'>" + $("#classification_name option:selected").text(),
//          "<input type='hidden' name='capex_type[]' value='" + $("#capex_type option:selected").html() + "'>" + $("#capex_type option:selected").html(),        
//          "<input type='hidden' name='purpose[]' value='" + $("#purpose").val() + "'>" + $("#purpose").val(),
//          "<input type='hidden' name='remarks[]' value='" + $("#remarks").val() + "'>" + $("#remarks").val(),
//          "<input type='hidden' name='capex_justification_id[]' value='" + $("#capex_justification_id option:selected").val() + "'>" + $("#capex_justification_id option:selected").text(),
//          "<input type='hidden' name='equipment_cost[]' value='" + $("#equipment_cost").val() + "'>" + $("#equipment_cost").val(),
//          "<input type='hidden' name='labor_cost[]' value='" + $("#labor_cost").val() + "'>" + $("#labor_cost").val(),
//          "<input type='hidden' name='freight_cost[]' value='" + $("#freight_cost").val() + "'>" + $("#freight_cost").val(), 
//          "<input type='hidden' name='incidental_expenses[]' value='" + $("#incidental_expenses").val() + "'>" + $("#incidental_expenses").val(),  
//          "<input type='hidden' name='estimated_cost[]' value='"+total +"'>" + total,     
//          "<input type='hidden' name='less_trade_in[]' value='" + $("#less_trade_in").val() + "'>" + $("#less_trade_in").val(),   
//          "<input type='hidden' name='net_estimated_cost[]' value='" + net_total +"'>" + net_total, 
//          '<a href="#" class="btn btn-danger cust_delete_contact">remove</a>'
//         ] ).draw( false );  

//         }else{
//             toastr.options.timeOut = 500;
//             toastr.error('Please Fill everything in this form.', 'Replacement Notice!');
//         }
//       });

//       capex_table.on('click', '.cust_delete_contact', function(e){
//         e.preventDefault();
//         capex_table.row($(this).closest('tr')).remove().draw();
//       });

// ends here

// $("#add_acquisition").click(function(){
//         var rowCount_contact = $('#acquisition_table tbody tr').length;
       
       
// if ($("new_replacement").val() != "") {
// acquisition_table.row.add( [ 
//         "<input type='hidden' name='new_replacement[]' value='" + $("#new_replacement option:selected").val() + "'>" + $("#new_replacement option:selected").text(),
//         "<input type='hidden' name='new_location[]' value='" + $("#new_location").val() + "'>" + $("#new_location").val(),         
//         "<input type='hidden' name='new_estimate_useful_life[]' value='" + $("#new_estimate_useful_life").val() + "'>" + $("#new_estimate_useful_life").val(),
//         "<input type='hidden' name='new_capacity_of_unit[]' value='" + $("#new_capacity_of_unit").val() + "'>" + $("#new_capacity_of_unit").val(),
//         "<input type='hidden' name='new_limitations_of_unit[]' value='" + $("#new_limitations_of_unit").val() + "'>" + $("#new_limitations_of_unit").val(),     
//         "<input type='hidden' name='new_advantage_over_repair[]' value='" + $("#new_advantage_over_repair").val() + "'>" + $("#new_advantage_over_repair").val(),
         
//          '<a href="#" class="btn btn-danger cust_delete_contact">remove</a>'
//         ] ).draw( false );      

//         }else{
//             toastr.options.timeOut = 500;
//             toastr.error('Please Fill everything in this form.', 'Replacement Notice!');
//         }
//       });

//       acquisition_table.on('click', '.cust_delete_contact', function(e){
//         e.preventDefault();
//         acquisition_table.row($(this).closest('tr')).remove().draw();
//       });



// $("#add_maitenance").click(function(){
//         var rowCount_contact = $('#repairAndMaintenance tbody tr').length;  

// if ($("custodian").val() != "") {
// repairAndMaintenance.row.add( [ 
//         "<input type='hidden' name='custodian[]' value='" + $("#custodian option:selected").val() + "'>" + $("#custodian option:selected").text(),        
//         "<input type='hidden' name='asset_item[]' value='" + $("#asset_item option:selected").val() + "'>" + $("#asset_item option:selected").text(),   
         
//          '<a href="#" class="btn btn-danger cust_delete_contact">remove</a>'
//         ] ).draw( false );      

//         }else{
//             toastr.options.timeOut = 500;
//             toastr.error('Please Fill everything in this form.', 'Replacement Notice!');
//         }
//       });

//       repairAndMaintenance.on('click', '.cust_delete_contact', function(e){
//         e.preventDefault();
//         repairAndMaintenance.row($(this).closest('tr')).remove().draw();
//       });


// $("#add_repairs").click(function(){
//         var rowCount_contact = $('#replacement_table tbody tr').length; 
// if ($("repair_replacement").val() != "") {
// replacement_table.row.add( [ 
//          "<input type='hidden' name='repair_replacement[]' value='" + $("#repair_replacement option:selected").val() + "'>" + $("#repair_replacement option:selected").text(),
//          "<input type='hidden' name='repair_location[]' value='" + $("#repair_location").val() + "'>" + $("#repair_location").val(),
//          "<input type='hidden' name='date_acquired[]' value='" + $("#date_acquired").val() + "'>" + $("#date_acquired").val(),
//          "<input type='hidden' name='repair_net_book_value[]' value='" + $("#repair_net_book_value").val() + "'>" + $("#repair_net_book_value").val(),
//          "<input type='hidden' name='repair_reason_for_replacement[]' value='" + $("#repair_reason_for_replacement").val() + "'>" + $("#repair_reason_for_replacement").val(), 
//          "<input type='hidden' name='repair_advantage_over_new[]' value='" + $("#repair_advantage_over_new").val() + "'>" + $("#repair_advantage_over_new").val(), 
         
//          '<a href="#" class="btn btn-danger cust_delete_contact">remove</a>'
//         ] ).draw( false );      

//         }else{
//             toastr.options.timeOut = 500;
//             toastr.error('Please Fill everything in this form.', 'Replacement Notice!');
//         }
//       });
//         replacement_table.on('click', '.cust_delete_contact', function(e){
//         e.preventDefault();
//         replacement_table.row($(this).closest('tr')).remove().draw();
//       });




// $("#add_maitenance").click(function(){
//         var rowCount_contact = $('#repairAndMaintenance tbody tr').length;  

// if ($("asset_item").val() != "Select") {
// repairAndMaintenance.row.add( [ 
//         "<input type='hidden' name='asset_item[]' value='" + $("#asset_item option:selected").val() + "'>" + $("#asset_item option:selected").text(),
        
         
//          '<a href="#" class="btn btn-danger cust_delete_contact">remove</a>'
//         ] ).draw( false );      

//         }else{
//             toastr.options.timeOut = 500;
//             toastr.error('Please Fill everything in this form.', 'Replacement Notice!');
//         }
//       });

//       repairAndMaintenance.on('click', '.cust_delete_contact', function(e){
//         e.preventDefault();
//         repairAndMaintenance.row($(this).closest('tr')).remove().draw();
//       });



  } //end handleCustomerMasterList

   return {
      //main function to initiate the module
      init: function () {
          handleCustomerMasterList();
      }
  };

   function dump(obj) {
      var out = '';
      for (var i in obj) {
          out += i + ": " + obj[i] + "\n";
      }
  }
}();


//This Jquery will filter the textbox for numeric only

    $("#cust_cont_value").keydown(function (e) {
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


      $("#qty").keydown(function (e) {
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

      $("#equipment_cost").keydown(function (e) {
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

      $("#labor_cost").keydown(function (e) {
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

      $("#freight_cost").keydown(function (e) {
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

      $("#incidental_expenses").keydown(function (e) {
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
    
     $("#less_trade_in").keydown(function (e) {
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
//------------------------------------------------------------

jQuery(document).ready(function() {
  customermasterlist.init();
  });

function isNumber(evt) {
  evt = (evt) ? evt : window.event;
  var charCode = (evt.which) ? evt.which : evt.keyCode;
  if (charCode > 31 && (charCode < 48 || charCode > 57)) {
      return false;
  }
  return true;
}

