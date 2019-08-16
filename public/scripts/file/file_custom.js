var all_my_TO = $('#all_my_TO').DataTable({searching: false, paging: false});
var transportation_table = $('#transportation_table').DataTable({searching: false, paging: false});

jQuery(document).ready( function($) {
 
    if (jQuery().datepicker) {
          $('#datefrom').datepicker({
              rtl: App.isRTL(),
              format: 'yyyy-mm-dd',
              orientation: "left",
              autoclose: true
          });
      }   


       $('#datefrom').keyup(function(){
           var v = this.value;
          if (v.match(/^\d{4}$/) !== null) {
              this.value = v + '-';
          } else if (v.match(/^\d{4}\-\d{2}$/) !== null) {
              this.value = v + '-';
          }
      });

      if (jQuery().datepicker) {
          $('#dateTo').datepicker({
              rtl: App.isRTL(),
              format: 'yyyy-mm-dd',
              orientation: "left",
              autoclose: true
          });
      }   


       $('#dateTo').keyup(function(){
           var v = this.value;
          if (v.match(/^\d{4}$/) !== null) {
              this.value = v + '-';
          } else if (v.match(/^\d{4}\-\d{2}$/) !== null) {
              this.value = v + '-';
          }
      }); 

        $(function () {
            $('#datetimepicker3').datetimepicker({
                format: 'LT'
            });
        });


  //---populate from database ajax for maintenance asset
  $('#destination').change(function(){      
      var destination_type = $(this).val();
         $('#through').html('');

         var through = ''; 
     console.log(destination_type);
        $.ajax({
          type: "POST",
          url:  baseurl + "file/file/retrieve_transport",
          dataType: "json",
          data: {'destination_type': destination_type},
          success: function(data){

         

              $.each(data, function(i, value){                 
                      through += "<option value='" + data[i].destination_type + "'>" + data[i].transportation_description + "</option>"                       
                  
              });
              $('#through').html(through);                       
          },
          error: function (errorThrown){
              
          }
      });
  }); 
//--- end here
      
  // $('#all_my_TO').on('dblclick', 'tr', function () {
  //           var row = $(this).closest('tr')[0];
  //           var TO_id = all_my_TO.cell( row, 0 ).data();
  //           window.open(baseurl+"file/file/retrieve_TO_detailsf?TO_id="+TO_id);
  //        });

  // $('#all_my_TO').on('dblclick', 'tr', function () {
  //       var row = $(this).closest('tr')[0];
  //       var prf_id = all_my_TO.cell( row, 0 ).data();
  //       window.open(baseurl+"message/prf_request?messageid="+prf_id);
  //    });

  
  // Edit and save price and quantity in PRF using Karl style in marketing
  var all_my_TO = $('#all_my_TO').DataTable();
  all_my_TO.on('click', '.btn-lot-edit', function (e) {
                e.preventDefault();
                var row = $(this).closest('tr')[0];
                // var prf_detail_id = all_my_TO.cell(row, 0 ).data();
                var to_id = all_my_TO.cell(row, 0 ).data();
                console.log(to_id);
                if (to_id != null || to_id != 0) {
                  $.ajax({
                      type: "POST",
                      url:  baseurl + "file/get_one_TO",
                      dataType: "json",
                      data: {'to_id': to_id},
                      success: function(data){
                        // alert(prf_detail_id);                        
                        $("#to_id").val(to_id);                      
                        $("#datefrom").val(data[0].date_from);
                        $("#dateTo").val(data[0].date_to);
                        $("#etd").val(data[0].EDT);                       
                        $("#eta").val(data[0].ETA);
                        $("#purpose").val(data[0].purpose);                     
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
    $('#update_TO').click(function(){
   
    var row = $(this).closest('tr')[0];
    var to_id = all_my_TO.cell( row, 0 ).data();    
        var data = {
            'to_id': to_id, 
            'datefrom': $("#datefrom").val(),            
            'dateTo': $("#dateTo").val(),
            'etd': $("#etd").val(),
            'eta': $("#eta").val(),
            'purpose': $("#purpose").val(),
            'is_cancel':$('#is_cancel option:selected').val()   
        };
    $.ajax({
            type: "POST",
            url:  baseurl + "file/update_TO",
            dataType: "json",
            data: data,
            success: function(data){
              $('#view-TO').modal('toggle');
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


  $('#submit_to').click(function(){
     
      var data = {
    //= to view ID.......value to be inserted//
        'created_by':$('#created_by').val(),
    //Employee information

        'department':$('#department').val(),
        'date_requested':$('#date_requested').val(),
        'datefrom':$('#datefrom').val(),
        'dateTo':$('#dateTo').val(),
        'destination':$('#destination').val(),    
        'purpose':$('#purpose').val(),
        'etd':$('#etd').val(),
        'eta':$('#eta').val(),        
        'through':$('#through').val()  
    
 
      };

      console.log(data);
      $.ajax({
          type: "POST",
          url:  baseurl + "file/file/request_to",
          dataType: "text",
          data: data,
          success: function(data){
              toastr.success('Successfully Saved!', 'Operation Done');
          },
          error: function (errorThrown){
              toastr.error('Error!.', 'Operation failed');
          }
      });
  });  

  });     



