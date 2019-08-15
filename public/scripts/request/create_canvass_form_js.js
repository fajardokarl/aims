var customermasterlist = function () {

  var handleCustomerMasterList = function () {
      var quotation_item_table = $("#quotation_item_table").DataTable({searching: false, paging: false});
      var contacts_table = $("#quotation_item_table");

      var payment_table = $("#tbl-payments").DataTable({searching: false, paging: false}); 

      var prf_item_table_sample = $("#prf_item_table_sample").DataTable({searching: false, paging: false});
      var contacts_table = $("#prf_item_table_sample");


      var repairs = $("#repairs").DataTable({searching: false, paging: false});     
      var contacts_table = $("#repairs");    

      
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

    var verify = $('#tbl_budgeted').DataTable({
        "bSort" : true,
        "aLengthMenu": [[5, 10, 50, -1], [5, 10, 50, "All"]],
        "iDisplayLength": 5,
        "fixedHeader": true,
         fixedHeader: {
            header: true,
        }
    });



      //----Populate from Database AJAX
   $('#item').change(function(){
      // alert(realty_id = $(this).val());
      var item_id = $(this).val();
      var budget_detail_id = $(this).val();
      var opt_content = "<option value='0'>None</option>";
      var budget_content = "<option value='0'>None</option>";

      $.ajax({
          type: "POST",
          url:  baseurl + "logistics/request/list_uom",
          dataType: "json",
          data: {'item_id': item_id},
          success: function(data){
              $.each(data, function(i, value){
                  if (data[i].status_id == 1) {
                      opt_content += "<option value='" + data[i].uom_id + "'>" + data[i].uom_name + "</option>"
                      opt_content += "<option value='" + data[i].budget_detail_id + "'>" + data[i].budget_amount + "</option>"   

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
                      budget_content += "<option value='" + data[i].budget_detail_id + "'>" + data[i].budget_amount + "</option>"                       
                  // }
              });
              $('#budgeted').html(budget_content);             
          },
          error: function (errorThrown){
              var budget_content = "<option value='0'>Unbudgeted</option>";
          }
      });
  });     
    //---end here
 
    //---department identifier--//

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
    $('#request').click(function(){       
        $('#print').show();
        $('#prf_status_id').hide();
    });
   
    });


  $('#request_quotation').click(function(){


  // if ($('#birthdate').val() && $('#purpose') && $('#remarks') && $('#justification')) != ""{

  //   toastr.options.timeOut = 500;
  //   toastr.error('Please Fill Contact Value.', 'Notice!');
  // }

 
      //address
      // item mapping
      var requested_by_id = $('input[name="requested_by_id[]"]').map(function(){
          return $(this).val();
      }).get();
      var department_id = $('input[name="department_id[]"]').map(function(){
          return $(this).val();
      }).get();
      var supplier_name = $('input[name="supplier_name[]"]').map(function(){
          return $(this).val();
      }).get();
      // var contact_person = $('input[name="contact_person[]"]').map(function(){
      //     return $(this).html();
      // }).get();

      // var contact_number = $('input[name="contact_number[]"]').map(function(){
      //     return $(this).val();
      // }).get();

      // var terms_of_payment = $('input[name="terms_of_payment[]"]').map(function(){
      //     return $(this).val();
      // }).get();


      var item = $('input[name="item[]"]').map(function(){
          return $(this).val();
      }).get();

      // var underline_opt = $('input[name="underline_opt[]"]').map(function(){
      //   return $(this).text();
      // }).get();
    
       
     

      var data = {

        //= to view ID.......value to be inserted//
          'requested_by_id':$('#requested_by_id').val(),
          'department_id':$('#department_id').val(),
          'supplier_name':$('#supplier_name').val(),        
          'contact_person':$('#contact_person').html(),
          'contact_number':$('#contact_number').html(),
          'terms_of_payment':$('#terms_of_payment').html(),        
            
          
          
          'item': item,
          // 'underline_opt': underline_opt,
         

     };

      console.log(data);


      $.ajax({
          type: "POST",
          url:  baseurl + "logistics/create_canvass_controller/save_quotation",
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


//starts here
var total = 0;
$("#add_canvass").click(function(){
        var rowCount_contact = $('#quotation_item_table tbody tr').length;
       
if ($("#item").val() && $("#item").val() && $("#underline").val() != "") {
quotation_item_table.row.add( [ 
        "<input type='hidden' name='item[]' value='" + $("#item option:selected").val() + "'>" + $("#item option:selected").text(),
        // "<input type='hidden' name='underline[]' value='" + $("#underline_opt").text() + "'>" + $("#underline_opt").text(),
        // "<input type='hidden' name='qty[]' value='" + $("#qty").val() + "'>" + $("#qty").val(), 
        // "<input type='hidden' name='uom[]' value='" + $("#uom_opt option:selected").val() + "'>" + $("#uom_opt option:selected").text(),                                         
        // "<input type='hidden' name='budgeted[]' value='" + $("#budgeted option:selected").val() + "'>" + $("#budgeted option:selected").text(),   
        // "<input type='hidden' name='item_remarks[]' value='" + $("#item_remarks").val() + "'>" + $("#item_remarks").val(),
        // "<input type='hidden' name='delivery[]' value='" + $("#delivery option:selected").val() + "'>" + $("#delivery option:selected").text(),
        // "<input type='hidden' name='sub_total[]' value='" + ($("#qty").val()*$("#cust_cont_value").val()) + "'>" + subtotal,
        '<a href="#" class="btn btn-danger cust_delete_contact">remove</a>'
        ] ).draw( false );
            // $("#cust_cont_value").val('');
            // total = total + subtotal;
            // $("#total_amount").html(total);
            // console.log(total);

        }else{
            toastr.options.timeOut = 500;
            toastr.error('Please Fill Contact Value.', 'Notice!');
        }
      });

      quotation_item_table.on('click', '.cust_delete_contact', function(e){
        e.preventDefault();
        quotation_item_table.row($(this).closest('tr')).remove().draw();
      });

// end here

//repairs starts here


  var total = 0;
$("#add_repairs").click(function(){
        var rowCount_contact = $('#repairs tbody tr').length;
        var total = parseFloat($("#repair_equipment_cost").val()) + parseFloat($("#repair_labor_cost").val()) + parseFloat($("#repair_freight_cost").val()) + parseFloat($("#repair_incidental_expenses").val());
        var net_total = parseFloat($("#repair_equipment_cost").val()) + parseFloat($("#repair_labor_cost").val()) + parseFloat($("#repair_freight_cost").val()) + parseFloat($("#repair_incidental_expenses").val()) - parseFloat($("#repair_less_trade_in").val());
       
if ($("#repair_location").val() != "") {
repairs.row.add( [ 
         "<input type='hidden' name='repair_location[]' value='" + $("#repair_location").val() + "'>" + $("#repair_location").val(),
         "<input type='hidden' name='birthdate[]' value='" + $("#birthdate").val() + "'>" + $("#birthdate").val(), 
         "<input type='hidden' name='net_book_value[]' value='" + $("#net_book_value").val() + "'>" + $("#net_book_value").val(), 
         "<input type='hidden' name='reason_for_replacement[]' value='" + $("#reason_for_replacement").val() + "'>" + $("#reason_for_replacement").val(),
         // "<input type='hidden' name='advantage_over_repair[]' value='" + $("#advantage_over_repair").val() + "'>" + $("#advantage_over_repair").val(), 
         "<input type='hidden' name='advantage_over_new[]' value='" + $("#advantage_over_new_opt").val() + "'>" + $("#advantage_over_new_opt").val(),
         "<input type='hidden' name='repair_purpose[]' value='" + $("#repair_purpose").val() + "'>" + $("#repair_purpose").val(),
         "<input type='hidden' name='repair_capex_justification_id[]' value='" + $("#repair_capex_justification_id option:selected").val() + "'>" + $("#repair_capex_justification_id option:selected").text(),

         "<input type='hidden' name='repair_equipment_cost[]' value='" + $("#repair_equipment_cost").val() + "'>" + $("#repair_equipment_cost").val(),
         "<input type='hidden' name='repair_labor_cost[]' value='" + $("#repair_labor_cost").val() + "'>" + $("#repair_labor_cost").val(),
         "<input type='hidden' name='repair_freight_cost[]' value='" + $("#repair_freight_cost").val() + "'>" + $("#repair_freight_cost").val(), 
         "<input type='hidden' name='repair_incidental_expenses[]' value='" + $("#repair_incidental_expenses").val() + "'>" + $("#repair_incidental_expenses").val(),  


         // "<input type='hidden' name='estimated_cost[]' value='" + ($("#repair_equipment_cost").val()+$("#repair_labor_cost").val()+$("#repair_freight_cost").val()+$("#repair_incidental_expenses").val()) + "'>" + subtotal,       
         "<input type='hidden' name='estimated_cost[]' value='"+($("#equipment_cost").val()+$("#repair_labor_cost").val()+$("#repair_freight_cost").val()+$("#repair_incidental_expenses").val()) +"'>" + total,     
         "<input type='hidden' name='repair_less_trade_in[]' value='" + $("#repair_less_trade_in").val() + "'>" + $("#repair_less_trade_in").val(),   
         "<input type='hidden' name='net_estimated_cost[]' value='" + ($("#net_estimated_cost").val() + $("#repair_labor_cost").val()+$("#repair_freight_cost").val()+$("#repair_incidental_expenses").val()-$("#repair_less_trade_in").val()) +"'>" + net_total, 
         '<a href="#" class="btn btn-danger cust_delete_contact">remove</a>'
        ] ).draw( false );
            // $("#cust_cont_value").val('');
            // total = total + subtotal;
            // $("#total_amount").html(total);
            // console.log(total);

        }else{
            toastr.options.timeOut = 500;
            toastr.error('Please Fill everything in this form.', 'Replacement Notice!');
        }
      });

      repairs.on('click', '.cust_delete_contact', function(e){
        e.preventDefault();
        repairs.row($(this).closest('tr')).remove().draw();
      });

// ends here

// acquisition starts here
var total = 0;
$("#add_acquisition").click(function(){
        var rowCount_contact = $('#prf_item_table_sample tbody tr').length;
        var total = parseFloat($("#equipment_cost").val()) + parseFloat($("#labor_cost").val()) + parseFloat($("#freight_cost").val()) + parseFloat($("#incidental_expenses").val());
        var net_total = parseFloat($("#equipment_cost").val()) + parseFloat($("#labor_cost").val()) + parseFloat($("#freight_cost").val()) + parseFloat($("#incidental_expenses").val()) - parseFloat($("#less_trade_in").val());
       
if ($("#location").val() != "") {
prf_item_table_sample.row.add( [ 
         "<input type='hidden' name='location[]' value='" + $("#location").val() + "'>" + $("#location").val(),
         "<input type='hidden' name='estimate_useful_life[]' value='" + $("#estimate_useful_life").val() + "'>" + $("#estimate_useful_life").val(), 
         "<input type='hidden' name='capacity_of_life[]' value='" + $("#capacity_of_life").val() + "'>" + $("#capacity_of_life").val(), 
         "<input type='hidden' name='limitions_of_unit[]' value='" + $("#limitions_of_unit").val() + "'>" + $("#limitions_of_unit").val(),
         // "<input type='hidden' name='advantage_over_repair[]' value='" + $("#advantage_over_repair").val() + "'>" + $("#advantage_over_repair").val(), 
         "<input type='hidden' name='quantitative[]' value='" + $("#quantitative_opt").val() + "'>" + $("#quantitative_opt").val(),
         "<input type='hidden' name='purpose[]' value='" + $("#purpose").val() + "'>" + $("#purpose").val(),
         "<input type='hidden' name='capex_justification_id[]' value='" + $("#capex_justification_id option:selected").val() + "'>" + $("#capex_justification_id option:selected").text(),

         "<input type='hidden' name='equipment_cost[]' value='" + $("#equipment_cost").val() + "'>" + $("#equipment_cost").val(),
         "<input type='hidden' name='labor_cost[]' value='" + $("#labor_cost").val() + "'>" + $("#labor_cost").val(),
         "<input type='hidden' name='freight_cost[]' value='" + $("#freight_cost").val() + "'>" + $("#freight_cost").val(), 
         "<input type='hidden' name='incidental_expenses[]' value='" + $("#incidental_expenses").val() + "'>" + $("#incidental_expenses").val(),  


         // "<input type='hidden' name='estimated_cost[]' value='" + ($("#equipment_cost").val()+$("#labor_cost").val()+$("#freight_cost").val()+$("#incidental_expenses").val()) + "'>" + subtotal,       
         "<input type='hidden' name='estimated_cost[]' value='"+($("#equipment_cost").val()+$("#labor_cost").val()+$("#freight_cost").val()+$("#incidental_expenses").val()) +"'>" + total,     
         "<input type='hidden' name='less_trade_in[]' value='" + $("#less_trade_in").val() + "'>" + $("#less_trade_in").val(),   
         "<input type='hidden' name='net_estimated_cost[]' value='" + ($("#net_estimated_cost").val() + $("#labor_cost").val()+$("#freight_cost").val()+$("#incidental_expenses").val()-$("#less_trade_in").val()) +"'>" + net_total, 
         '<a href="#" class="btn btn-danger cust_delete_contact">remove</a>'
        ] ).draw( false );
            // $("#cust_cont_value").val('');
            // total = total + subtotal;
            // $("#total_amount").html(total);
            // console.log(total);

        }else{
            toastr.options.timeOut = 500;
            toastr.error('Please Fill everything in this form.', 'Acquisition Notice!');
        }
      });

      prf_item_table_sample.on('click', '.cust_delete_contact', function(e){
        e.preventDefault();
        prf_item_table_sample.row($(this).closest('tr')).remove().draw();
      });





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

