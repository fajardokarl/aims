
jQuery(document).ready( function($) {  
  var language_table = $('#language_table').DataTable({searching: false, paging: false});
  var examination_table = $('#examination_table').DataTable({searching: false, paging: false});
  var last_school_table = $('#last_school_table').DataTable({searching: false, paging: false});
  var work_experience_table = $('#work_experience_table').DataTable({searching: false, paging: false});
  var family_table = $('#family_table').DataTable({searching: false, paging: false});
  var evaluation_table = $('#evaluation_table').DataTable({searching: false, paging: false});
  var movement_table = $('#movement_table').DataTable({searching: false, paging: false});
	var address_contacts_table = $('#address_contacts_table').DataTable({searching: false, paging: false});
	var emp_contacts_table = $('#emp_contacts_table').DataTable({searching: false, paging: false});
  var employee_table = $('#employee_table').DataTable({"order": [[ 0, "desc" ]],"lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]] }); 

$("#add_address").click(function(){
        var rowCount_contact = $('#address_contacts_table tbody tr').length;      
       
  if ($("addtype").val() != "") {
  address_contacts_table.row.add( [ 
         "<input type='hidden' name='addtype[]' value='" + $("#addtype option:selected").val() + "'>" + $("#addtype option:selected").text(),    
         "<input type='hidden' name='line_1[]' value='" + $("#line_1").val() + "'>" + $("#line_1").val(),
         "<input type='hidden' name='line_2[]' value='" + $("#line_2").val() + "'>" + $("#line_2").val(),
         "<input type='hidden' name='allcity[]' value='" + $("#allcity option:selected").val() + "'>" + $("#allcity option:selected").text(),    
         "<input type='hidden' name='allprovince[]' value='" + $("#allcityallcity option:selected").val() + "'>" + $("#allprovince option:selected").text(),    
         "<input type='hidden' name='postal[]' value='" + $("#postal").val() + "'>" + $("#postal").val(),
         "<input type='hidden' name='addcountry[]' value='" + $("#addcountry option:selected").val() + "'>" + $("#addcountry option:selected").text(), 
         '<a href="#" class="btn btn-danger cust_delete_contact">remove</a>'
        ] ).draw( false );         
            // $("#canvass_total").html(total); 
            $('#addtype').val('');
            $('#line_1').val('');
            $('#line_2').val(''); 
            $('#allcity').val('');
            $('#allprovince').val('');
            $('#postal').val('');
            $('#addcountry').val('');     
        }else{
            toastr.options.timeOut = 500;
            toastr.error('Please Fill everything in this form.', 'Replacement Notice!');
        }
      });

      address_contacts_table.on('click', '.cust_delete_contact', function(e){
        e.preventDefault();
        address_contacts_table.row($(this).closest('tr')).remove().draw();
      });


 $('#employee_table').on('dblclick', 'tr', function () {
            var row = $(this).closest('tr')[0];
            var person_id = employee_table.cell( row, 0 ).data();
            window.open(baseurl+"hris/employee_info?personid="+person_id);
         });


    $('#update_evaluation').click(function(){
       $('#view-evaluation').modal('toggle');
  });

    $('#update_movement').click(function(){
      $('#view-movement').modal('toggle');
  });
   $('#update_member').click(function(){
      $('#view-family').modal('toggle');
  });


  function clearFields()
  {
    $('#lastname').val('');
    $('#firstname').val('');
    $('#middlename').val('');
    $('#prefix').val('');
    $('#suffix').val('');
    $('#sex').val('');
    $('#birthdate').val('');
    $('#birthplace').val('');
    $('#nationality').val('');
    $('#civil_status option:selected').val('');
    $('#tin').val('');
    $('#philhealth').val('');
    $('#sss').val('');
    $('#hdmf').val('');
    $('#addtype option:selected').val('');
    $('#line_1').val('');
    $('#line_2').val('');
    $('#allcity option:selected').val('');
    $('#allprovince option:selected').val('');
    $('#addcountry option:selected').val('');
    $('#postal').val('');
    $('#contact_type_id option:selected').val('');
    $('#contact_value').val('');
    $('#department_id option:selected').val('');
    $('#job_position').val('');
    $('#level option:selected').val('');
    $('#schoolName').val('');
    $('#fromdate').val('');
    $('#todate').val('');
    $('#yearGraduate').val('');
    $('#examtype').val('');
    $('#examName').val('');
    $('#examRating').val('');
    $('#examTaken').val('');
    $('#dateExpiration').val('');
    $('#previous_position').val('');
    $('#employer').val('');
    $('#exclusive_from').val('');
    $('#exclusive_to').val('');
    $('#compensation').val('');
    $('#fam_desc option:selected').val('');    
    $('#fam_name').val('');
    $('#fam_age').val('');
    $('#fam_address').val('');
    $('#fam_contact').val('');
    $('#current_position').val('');
    $('#evaluated_by option:selected').val('');    
    $('#eval_from').val('');
    $('#eval_to').val('');
    $('#eval_result').val('');
    $('#eval_remark').val('');
    $('#movement_from').val('');
    $('#movement_to').val('');
    $('#effective_date').val('');
    $('#approval_date').val('');
    $('#movement_remarks').val('');
    $('#username').val('');
    $('#password').val('');
    $('#email').val('');
    $('#all_permission option:selected').val('');   
    };


    $('#cancel').click(function(){ 
       clearFields();
      location.reload();
    });


if (jQuery().datepicker) {
          $('#add_approval_date').datepicker({
              rtl: App.isRTL(),
              format: 'yyyy-mm-dd',
              orientation: "left",
              autoclose: true
          });
      }   


       $('#add_approval_date').keyup(function(){
           var v = this.value;
          if (v.match(/^\d{4}$/) !== null) {
              this.value = v + '-';
          } else if (v.match(/^\d{4}\-\d{2}$/) !== null) {
              this.value = v + '-';
          }
      });


if (jQuery().datepicker) {
          $('#add_effective_date').datepicker({
              rtl: App.isRTL(),
              format: 'yyyy-mm-dd',
              orientation: "left",
              autoclose: true
          });
      }   


       $('#add_effective_date').keyup(function(){
           var v = this.value;
          if (v.match(/^\d{4}$/) !== null) {
              this.value = v + '-';
          } else if (v.match(/^\d{4}\-\d{2}$/) !== null) {
              this.value = v + '-';
          }
      });


if (jQuery().datepicker) {
          $('#add_movement_to').datepicker({
              rtl: App.isRTL(),
              format: 'yyyy-mm-dd',
              orientation: "left",
              autoclose: true
          });
      }   


       $('#add_movement_to').keyup(function(){
           var v = this.value;
          if (v.match(/^\d{4}$/) !== null) {
              this.value = v + '-';
          } else if (v.match(/^\d{4}\-\d{2}$/) !== null) {
              this.value = v + '-';
          }
      });


if (jQuery().datepicker) {
          $('#add_movement_from').datepicker({
              rtl: App.isRTL(),
              format: 'yyyy-mm-dd',
              orientation: "left",
              autoclose: true
          });
      }   


       $('#add_movement_from').keyup(function(){
           var v = this.value;
          if (v.match(/^\d{4}$/) !== null) {
              this.value = v + '-';
          } else if (v.match(/^\d{4}\-\d{2}$/) !== null) {
              this.value = v + '-';
          }
      });

if (jQuery().datepicker) {
          $('#effective_date').datepicker({
              rtl: App.isRTL(),
              format: 'yyyy-mm-dd',
              orientation: "left",
              autoclose: true
          });
      }   


       $('#effective_date').keyup(function(){
           var v = this.value;
          if (v.match(/^\d{4}$/) !== null) {
              this.value = v + '-';
          } else if (v.match(/^\d{4}\-\d{2}$/) !== null) {
              this.value = v + '-';
          }
      });


if (jQuery().datepicker) {
          $('#add_evaldate_from').datepicker({
              rtl: App.isRTL(),
              format: 'yyyy-mm-dd',
              orientation: "left",
              autoclose: true
          });
      }   


       $('#add_evaldate_from').keyup(function(){
           var v = this.value;
          if (v.match(/^\d{4}$/) !== null) {
              this.value = v + '-';
          } else if (v.match(/^\d{4}\-\d{2}$/) !== null) {
              this.value = v + '-';
          }
      });
       
if (jQuery().datepicker) {
          $('#add_evaldate_to').datepicker({
              rtl: App.isRTL(),
              format: 'yyyy-mm-dd',
              orientation: "left",
              autoclose: true
          });
      }   


       $('#add_evaldate_to').keyup(function(){
           var v = this.value;
          if (v.match(/^\d{4}$/) !== null) {
              this.value = v + '-';
          } else if (v.match(/^\d{4}\-\d{2}$/) !== null) {
              this.value = v + '-';
          }
      });
       


  if (jQuery().datepicker) {
          $('#movement_from').datepicker({
              rtl: App.isRTL(),
              format: 'yyyy-mm-dd',
              orientation: "left",
              autoclose: true
          });
      }   


       $('#movement_from').keyup(function(){
           var v = this.value;
          if (v.match(/^\d{4}$/) !== null) {
              this.value = v + '-';
          } else if (v.match(/^\d{4}\-\d{2}$/) !== null) {
              this.value = v + '-';
          }
      });     

    if (jQuery().datepicker) {
          $('#movement_to').datepicker({
              rtl: App.isRTL(),
              format: 'yyyy-mm-dd',
              orientation: "left",
              autoclose: true
          });
      }   


       $('#movement_to').keyup(function(){
           var v = this.value;
          if (v.match(/^\d{4}$/) !== null) {
              this.value = v + '-';
          } else if (v.match(/^\d{4}\-\d{2}$/) !== null) {
              this.value = v + '-';
          }
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
          $('#fromdate').datepicker({
              rtl: App.isRTL(),
              format: 'yyyy-mm-dd',
              orientation: "left",
              autoclose: true
          });
      }   


       $('#fromdate').keyup(function(){
           var v = this.value;
          if (v.match(/^\d{4}$/) !== null) {
              this.value = v + '-';
          } else if (v.match(/^\d{4}\-\d{2}$/) !== null) {
              this.value = v + '-';
          }

      });    
       if (jQuery().datepicker) {
          $('#todate').datepicker({
              rtl: App.isRTL(),
              format: 'yyyy-mm-dd',
              orientation: "left",
              autoclose: true
          });
      }   


       $('#todate').keyup(function(){
           var v = this.value;
          if (v.match(/^\d{4}$/) !== null) {
              this.value = v + '-';
          } else if (v.match(/^\d{4}\-\d{2}$/) !== null) {
              this.value = v + '-';
          }
      });

    if (jQuery().datepicker) {
          $('#examTaken').datepicker({
              rtl: App.isRTL(),
              format: 'yyyy-mm-dd',
              orientation: "left",
              autoclose: true
          });
      }   


       $('#examTaken').keyup(function(){
           var v = this.value;
          if (v.match(/^\d{4}$/) !== null) {
              this.value = v + '-';
          } else if (v.match(/^\d{4}\-\d{2}$/) !== null) {
              this.value = v + '-';
          }

      });    
       if (jQuery().datepicker) {
          $('#dateExpiration').datepicker({
              rtl: App.isRTL(),
              format: 'yyyy-mm-dd',
              orientation: "left",
              autoclose: true
          });
      }   


       $('#dateExpiration').keyup(function(){
           var v = this.value;
          if (v.match(/^\d{4}$/) !== null) {
              this.value = v + '-';
          } else if (v.match(/^\d{4}\-\d{2}$/) !== null) {
              this.value = v + '-';
          }
      });

        if (jQuery().datepicker) {
          $('#eval_from').datepicker({
              rtl: App.isRTL(),
              format: 'yyyy-mm-dd',
              orientation: "left",
              autoclose: true
          });
      }   


       $('#eval_from').keyup(function(){
           var v = this.value;
          if (v.match(/^\d{4}$/) !== null) {
              this.value = v + '-';
          } else if (v.match(/^\d{4}\-\d{2}$/) !== null) {
              this.value = v + '-';
          }
      });
        if (jQuery().datepicker) {
          $('#eval_to').datepicker({
              rtl: App.isRTL(),
              format: 'yyyy-mm-dd',
              orientation: "left",
              autoclose: true
          });
      }   


       $('#eval_to').keyup(function(){
           var v = this.value;
          if (v.match(/^\d{4}$/) !== null) {
              this.value = v + '-';
          } else if (v.match(/^\d{4}\-\d{2}$/) !== null) {
              this.value = v + '-';
          }
      });

  if (jQuery().datepicker) {
          $('#exclusive_from').datepicker({
              rtl: App.isRTL(),
              format: 'yyyy-mm-dd',
              orientation: "left",
              autoclose: true
          });
      }   


       $('#exclusive_from').keyup(function(){
           var v = this.value;
          if (v.match(/^\d{4}$/) !== null) {
              this.value = v + '-';
          } else if (v.match(/^\d{4}\-\d{2}$/) !== null) {
              this.value = v + '-';
          }
      });
        if (jQuery().datepicker) {
          $('#exclusive_to').datepicker({
              rtl: App.isRTL(),
              format: 'yyyy-mm-dd',
              orientation: "left",
              autoclose: true
          });
      }   


       $('#exclusive_to').keyup(function(){
           var v = this.value;
          if (v.match(/^\d{4}$/) !== null) {
              this.value = v + '-';
          } else if (v.match(/^\d{4}\-\d{2}$/) !== null) {
              this.value = v + '-';
          }
      });
        if (jQuery().datepicker) {
          $('#exclusve_date').datepicker({
              rtl: App.isRTL(),
              format: 'yyyy-mm-dd',
              orientation: "left",
              autoclose: true
          });
      }   


       $('#exclusve_date').keyup(function(){
           var v = this.value;
          if (v.match(/^\d{4}$/) !== null) {
              this.value = v + '-';
          } else if (v.match(/^\d{4}\-\d{2}$/) !== null) {
              this.value = v + '-';
          }
      });

        if (jQuery().datepicker) {
          $('#approval_date').datepicker({
              rtl: App.isRTL(),
              format: 'yyyy-mm-dd',
              orientation: "left",
              autoclose: true
          });
      }   


       $('#approval_date').keyup(function(){
           var v = this.value;
          if (v.match(/^\d{4}$/) !== null) {
              this.value = v + '-';
          } else if (v.match(/^\d{4}\-\d{2}$/) !== null) {
              this.value = v + '-';
          }
      });
 $("#add_language").click(function(){
        var rowCount_contact = $('#language_table tbody tr').length;
        
       
  if ($("language").val() != "") {
  language_table.row.add( [        
         "<input type='hidden' name='language[]' value='" + $("#language").val() + "'>" + $("#language").val(),         
         '<a href="#" class="btn btn-danger cust_delete_contact">remove</a>'
        ] ).draw( false );         
            // $("#canvass_total").html(total);
        $('#language').val('');
           
                 
        }else{
            toastr.options.timeOut = 500;
            toastr.error('Please Fill everything in this form.', 'Replacement Notice!');
        }
      });

      language_table.on('click', '.cust_delete_contact', function(e){
        e.preventDefault();
        language_table.row($(this).closest('tr')).remove().draw();
      });
       


 $("#add_contact").click(function(){
        var rowCount_contact = $('#emp_contacts_table tbody tr').length;
        
       
  if ($("contact_type_id").val() != "") {
  emp_contacts_table.row.add( [ 
         "<input type='hidden' name='contact_type_id[]' value='" + $("#contact_type_id option:selected").val() + "'>" + $("#contact_type_id option:selected").text(),    
         "<input type='hidden' name='contact_value[]' value='" + $("#contact_value").val() + "'>" + $("#contact_value").val(),         
         '<a href="#" class="btn btn-danger cust_delete_contact">remove</a>'
        ] ).draw( false );         
            // $("#canvass_total").html(total);  
            $('#contact_type_id').val('');
            $('#contact_value').val('');
            
        }else{
            toastr.options.timeOut = 500;
            toastr.error('Please Fill everything in this form.', 'Replacement Notice!');
        }
      });

      emp_contacts_table.on('click', '.cust_delete_contact', function(e){
        e.preventDefault();
        emp_contacts_table.row($(this).closest('tr')).remove().draw();
      });

 $("#add_school").click(function(){
        var rowCount_contact = $('#last_school_table tbody tr').length;
        
       
  if ($("level").val() != "") {
  last_school_table.row.add( [ 
         "<input type='hidden' name='level[]' value='" + $("#level option:selected").val() + "'>" + $("#level option:selected").text(),    
         "<input type='hidden' name='schoolName[]' value='" + $("#schoolName").val() + "'>" + $("#schoolName").val(),         
         "<input type='hidden' name='fromdate[]' value='" + $("#fromdate").val() + "'>" + $("#fromdate").val(),  
         "<input type='hidden' name='todate[]' value='" + $("#todate").val() + "'>" + $("#todate").val(),         
         "<input type='hidden' name='yearGraduate[]' value='" + $("#yearGraduate").val() + "'>" + $("#yearGraduate").val(),         

         '<a href="#" class="btn btn-danger cust_delete_contact">remove</a>'
        ] ).draw( false );         
            // $("#canvass_total").html(total);     
            $('#level').val('');
            $('#schoolName').val('');
            $('#fromdate').val(''); 
            $('#todate').val('');
            $('#yearGraduate').val('');
        }else{
            toastr.options.timeOut = 500;
            toastr.error('Please Fill everything in this form.', 'Replacement Notice!');
        }
      });

      last_school_table.on('click', '.cust_delete_contact', function(e){
        e.preventDefault();
        last_school_table.row($(this).closest('tr')).remove().draw();
      });

$("#add_work").click(function(){
        var rowCount_contact = $('#work_experience_table tbody tr').length;
        
       
  if ($("previous_position").val() != "") {
  work_experience_table.row.add( [ 
         "<input type='hidden' name='previous_position[]' value='" + $("#previous_position").val() + "'>" + $("#previous_position").val(),         
         "<input type='hidden' name='employer[]' value='" + $("#employer").val() + "'>" + $("#employer").val(),         
         "<input type='hidden' name='exclusive_from[]' value='" + $("#exclusive_from").val() + "'>" + $("#exclusive_from").val(), 
         "<input type='hidden' name='exclusive_to[]' value='" + $("#exclusive_to").val() + "'>" + $("#exclusive_to").val(), 
         "<input type='hidden' name='compensation[]' value='" + $("#compensation").val() + "'>" + $("#compensation").val(),         
        
         '<a href="#" class="btn btn-danger cust_delete_contact">remove</a>'
        ] ).draw( false );         
            // $("#canvass_total").html(total); 
            $('#previous_position').val('');
            $('#employer').val('');
            $('#exclusive_from').val(''); 
            $('#exclusive_to').val('');
            $('#compensation').val('');
          

        }else{
            toastr.options.timeOut = 500;
            toastr.error('Please Fill everything in this form.', 'Replacement Notice!');
        }
      });

      work_experience_table.on('click', '.cust_delete_contact', function(e){
        e.preventDefault();
        work_experience_table.row($(this).closest('tr')).remove().draw();
      });
 $("#add_exam").click(function(){
        var rowCount_contact = $('#examination_table tbody tr').length;
        
       
  if ($("examtype").val() != "") {
  examination_table.row.add( [ 
         "<input type='hidden' name='examtype[]' value='" + $("#examtype").val() + "'>" + $("#examtype").val(),
         "<input type='hidden' name='examName[]' value='" + $("#examName").val() + "'>" + $("#examName").val(),         
         "<input type='hidden' name='examRating[]' value='" + $("#examRating").val() + "'>" + $("#examRating").val(), 
         "<input type='hidden' name='examTaken[]' value='" + $("#examTaken").val() + "'>" + $("#examTaken").val(),         
         "<input type='hidden' name='dateExpiration[]' value='" + $("#dateExpiration").val() + "'>" + $("#dateExpiration").val(),         

         '<a href="#" class="btn btn-danger cust_delete_contact">remove</a>'
        ] ).draw( false );         
            // $("#canvass_total").html(total);

            $('#examtype').val('');
            $('#examName').val('');
            $('#examRating').val(''); 
            $('#examTaken').val('');
            $('#dateExpiration').val('');     
        }else{
            toastr.options.timeOut = 500;
            toastr.error('Please Fill everything in this form.', 'Replacement Notice!');
        }
      });

      examination_table.on('click', '.cust_delete_contact', function(e){
        e.preventDefault();
        examination_table.row($(this).closest('tr')).remove().draw();
      });

 $("#add_family").click(function(){
        var rowCount_contact = $('#family_table tbody tr').length;
        
       
  if ($("fam_desc").val() != "") {
  family_table.row.add( [ 
         "<input type='hidden' name='fam_desc[]' value='" + $("#fam_desc option:selected").val() + "'>" + $("#fam_desc option:selected").text(),    
        
         "<input type='hidden' name='fam_name[]' value='" + $("#fam_name").val() + "'>" + $("#fam_name").val(),         
         "<input type='hidden' name='fam_age[]' value='" + $("#fam_age").val() + "'>" + $("#fam_age").val(), 
         "<input type='hidden' name='fam_address[]' value='" + $("#fam_address").val() + "'>" + $("#fam_address").val(),         
         "<input type='hidden' name='fam_contact[]' value='" + $("#fam_contact").val() + "'>" + $("#fam_contact").val(),         

         '<a href="#" class="btn btn-danger cust_delete_contact">remove</a>'
        ] ).draw( false );         
            // $("#canvass_total").html(total); 

            $('#fam_desc').val('');
            $('#fam_name').val('');
            $('#fam_age').val(''); 
            $('#fam_address').val('');
            $('#fam_contact').val('');     
        }else{
            toastr.options.timeOut = 500;
            toastr.error('Please Fill everything in this form.', 'Replacement Notice!');
        }
      });

      family_table.on('click', '.cust_delete_contact', function(e){
        e.preventDefault();
        family_table.row($(this).closest('tr')).remove().draw();
      });

$("#add_evaluation").click(function(){
        var rowCount_contact = $('#evaluation_table tbody tr').length;
        
       
  if ($("current_position").val() != "") {
  evaluation_table.row.add( [ 
         "<input type='hidden' name='current_position[]' value='" + $("#current_position").val() + "'>" + $("#current_position").val(),         
         
        
         "<input type='hidden' name='evaluated_by[]' value='" + $("#evaluated_by").val() + "'>" + $("#evaluated_by").val(),         
         "<input type='hidden' name='eval_from[]' value='" + $("#eval_from").val() + "'>" + $("#eval_from").val(), 
         "<input type='hidden' name='eval_to[]' value='" + $("#eval_to").val() + "'>" + $("#eval_to").val(),         
         "<input type='hidden' name='eval_result[]' value='" + $("#eval_result").val() + "'>" + $("#eval_result").val(),         
         "<input type='hidden' name='eval_remark[]' value='" + $("#eval_remark").val() + "'>" + $("#eval_remark").val(),         

         '<a href="#" class="btn btn-danger cust_delete_contact">remove</a>'
        ] ).draw( false );         
            // $("#canvass_total").html(total);
            $('#current_position').val('');
            $('#evaluated_by').val('');
            $('#eval_from').val(''); 
            $('#eval_to').val('');
            $('#eval_result').val('');     
            $('#eval_remark').val('');     
        }else{
            toastr.options.timeOut = 500;
            toastr.error('Please Fill everything in this form.', 'Replacement Notice!');
        }
      });

      evaluation_table.on('click', '.cust_delete_contact', function(e){
        e.preventDefault();
        evaluation_table.row($(this).closest('tr')).remove().draw();
      });

$("#add_movement").click(function(){
        var rowCount_contact = $('#movement_table tbody tr').length;
        
       
  if ($("movement_from").val() != "") {
  movement_table.row.add( [ 
       
         "<input type='hidden' name='movement_from[]' value='" + $("#movement_from").val() + "'>" + $("#movement_from").val(),         
         "<input type='hidden' name='movement_to[]' value='" + $("#movement_to").val() + "'>" + $("#movement_to").val(), 
         "<input type='hidden' name='effective_date[]' value='" + $("#effective_date").val() + "'>" + $("#effective_date").val(),         
         "<input type='hidden' name='approval_date[]' value='" + $("#approval_date").val() + "'>" + $("#approval_date").val(),         
         "<input type='hidden' name='movement_remarks[]' value='" + $("#movement_remarks").val() + "'>" + $("#movement_remarks").val(),         

         '<a href="#" class="btn btn-danger cust_delete_contact">remove</a>'
        ] ).draw( false );         
            // $("#canvass_total").html(total);     
        }else{
            toastr.options.timeOut = 500;
            toastr.error('Please Fill everything in this form.', 'Replacement Notice!');
        }
      });

      movement_table.on('click', '.cust_delete_contact', function(e){
        e.preventDefault();
        movement_table.row($(this).closest('tr')).remove().draw();
      });




 $('#submit_add_evaluation').click(function(){
   var data = {
  'add_employee_id':$('#add_employee_id').val(),   
  'add_job_position':$('#add_job_position').text(),   
  'add_evaluated_by':$('#add_evaluated_by').val(),   
  'add_evaldate_from':$('#add_evaldate_from').val(),   
  'add_evaldate_to':$('#add_evaldate_to').val(),   
  'add_eval_result':$('#add_eval_result').val(),   
  'add_eval_remarks':$('#add_eval_remarks').val()    
      };

      console.log(data);
      $.ajax({
          type: "POST",
          url:  baseurl + "hris/update_evaluation",
          dataType: "text",
          data: data,
          success: function(data){
              clearFields(); 
              toastr.success('Successfully Saved!', 'Operation Done');
              location.reload();
          },
          error: function (errorThrown){
              toastr.error('Error!.', 'Error. Please try again');
          }
      });
  });   


 $('#submit_add_movement').click(function(){
   var data = {
  'movement_employee_id':$('#movement_employee_id').val(),    
  'add_movement_from':$('#add_movement_from').val(),   
  'add_movement_to':$('#add_movement_to').val(),   
  'add_effective_date':$('#add_effective_date').val(),   
  'add_approval_date':$('#add_approval_date').val(),   
  'add_movement_remarks':$('#add_movement_remarks').val()    
      };

      console.log(data);
      $.ajax({
          type: "POST",
          url:  baseurl + "hris/update_movement",
          dataType: "text",
          data: data,
          success: function(data){
              clearFields(); 
              toastr.success('Successfully Saved!', 'Operation Done');
              location.reload();
          },
          error: function (errorThrown){
              toastr.error('Error!.', 'Error. Please try again');
          }
      });
  });


 $('#submit_add_member').click(function(){
   var data = {
  'family_employee_id':$('#family_employee_id').val(),    
  'add_fam':$('#add_fam').val(),   
  'add_fam_name':$('#add_fam_name').val(),   
  'add_fam_age':$('#add_fam_age').val(),   
  'add_fam_contact':$('#add_fam_contact').val(),   
  'add_fam_add':$('#add_fam_add').val()    
      };

      console.log(data);
      $.ajax({
          type: "POST",
          url:  baseurl + "hris/update_family",
          dataType: "text",
          data: data,
          success: function(data){
              clearFields(); 
              toastr.success('Successfully Saved!', 'Operation Done');
              location.reload();
          },
          error: function (errorThrown){
              toastr.error('Error!.', 'Error. Please try again');
          }
      });
  });

  $('#saveEmployee').click(function(){
 //Address
      var addtype = $('input[name="addtype[]"]').map(function(){
          return $(this).val();
      }).get();

      var line_1 = $('input[name="line_1[]"]').map(function(){
          return $(this).val();
      }).get();

      var line_2 = $('input[name="line_2[]"]').map(function(){
          return $(this).val();
      }).get();

      var allcity = $('input[name="allcity[]"]').map(function(){
          return $(this).val();
      }).get();

      var allprovince = $('input[name="allprovince[]"]').map(function(){
          return $(this).val();
      }).get();   

      var postal = $('input[name="postal[]"]').map(function(){
          return $(this).val();
      }).get();   

      var addcountry = $('input[name="addcountry[]"]').map(function(){
          return $(this).val();
      }).get();
      

//Contact
      var contact_type_id = $('input[name="contact_type_id[]"]').map(function(){
          return $(this).val();
      }).get();

      var contact_value = $('input[name="contact_value[]"]').map(function(){
          return $(this).val();
      }).get();

//Assignment
      var department_id = $('input[name="department_id[]"]').map(function(){
          return $(this).val();
      }).get();

      var job_position = $('input[name="job_position[]"]').map(function(){
          return $(this).val();
      }).get();

//School attended
      var level = $('input[name="level[]"]').map(function(){
          return $(this).val();
      }).get();

      var schoolName = $('input[name="schoolName[]"]').map(function(){
          return $(this).val();
      }).get();  
      var fromdate = $('input[name="fromdate[]"]').map(function(){
          return $(this).val();
      }).get();

      var todate = $('input[name="todate[]"]').map(function(){
          return $(this).val();
      }).get();  

    var yearGraduate = $('input[name="yearGraduate[]"]').map(function(){
          return $(this).val();
      }).get(); 

//Examinations taken
      var examtype = $('input[name="examtype[]"]').map(function(){
          return $(this).val();
      }).get();

      var examName = $('input[name="examName[]"]').map(function(){
          return $(this).val();
      }).get();  
    
     var examRating = $('input[name="examRating[]"]').map(function(){
          return $(this).val();
      }).get();

     var examTaken = $('input[name="examTaken[]"]').map(function(){
          return $(this).val();
      }).get();

      var dateExpiration = $('input[name="dateExpiration[]"]').map(function(){
          return $(this).val();
      }).get(); 

//Work experence
        var previous_position = $('input[name="previous_position[]"]').map(function(){
          return $(this).val();
      }).get();  
        var employer = $('input[name="employer[]"]').map(function(){
          return $(this).val();
      }).get();  
        var exclusive_from = $('input[name="exclusive_from[]"]').map(function(){
          return $(this).val();
      }).get();  
        var exclusive_to = $('input[name="exclusive_to[]"]').map(function(){
          return $(this).val();
      }).get();
          var compensation = $('input[name="compensation[]"]').map(function(){
          return $(this).val();
      }).get();

//Family Background
      var fam_desc = $('input[name="fam_desc[]"]').map(function(){
          return $(this).val();
      }).get();

      var fam_name = $('input[name="fam_name[]"]').map(function(){
          return $(this).val();
      }).get();  
      var fam_age = $('input[name="fam_age[]"]').map(function(){
          return $(this).val();
      }).get();

      var fam_address = $('input[name="fam_address[]"]').map(function(){
          return $(this).val();
      }).get();  

      var fam_contact = $('input[name="fam_contact[]"]').map(function(){
          return $(this).val();
      }).get();
     
//Evaluation
      var current_position = $('input[name="current_position[]"]').map(function(){
          return $(this).val();
      }).get();

      var evaluated_by = $('input[name="evaluated_by[]"]').map(function(){
          return $(this).val();
      }).get();  
      var eval_from = $('input[name="eval_from[]"]').map(function(){
          return $(this).val();
      }).get();

      var eval_to = $('input[name="eval_to[]"]').map(function(){
          return $(this).val();
      }).get();  

      var eval_result = $('input[name="eval_result[]"]').map(function(){
          return $(this).val();
      }).get();
      
      var eval_remark = $('input[name="eval_remark[]"]').map(function(){
          return $(this).val();
      }).get();

//Movement
      var movement_from = $('input[name="movement_from[]"]').map(function(){
          return $(this).val();
      }).get();

      var movement_to = $('input[name="movement_to[]"]').map(function(){
          return $(this).val();
      }).get();  
      var effective_date = $('input[name="effective_date[]"]').map(function(){
          return $(this).val();
      }).get();

      var approval_date = $('input[name="approval_date[]"]').map(function(){
          return $(this).val();
      }).get();  

      var movement_remarks = $('input[name="movement_remarks[]"]').map(function(){
          return $(this).val();
      }).get();

//Language
      var language = $('input[name="language[]"]').map(function(){
          return $(this).val();
      }).get();
   
    var data = {
    //= to view ID.......value to be inserted//
        'created_by':$('#created_by').val(),
    //Employee information

        'lastname':$('#lastname').val(),
        'firstname':$('#firstname').val(),
        'middlename':$('#middlename').val(),    
   		  'prefix':$('#prefix').val(),
        'suffix':$('#suffix').val(),
        'sex':$('#sex').val(),  
        'birthdate':$('#birthdate').val(),
        'birthplace':$('#birthplace').val(),
        'nationality':$('#nationality').val(),
        'civil_status':$('#civil_status').val(),
        'tin':$('#tin').val(),
        'philhealth':$('#philhealth').val(),
        'sss':$('#sss').val(),
        'hdmf':$('#hdmf').val(),
        'height':$('#height').val(),
        'weight':$('#weight').val(),

    //School attended
        'language':language,

    //School attended
        'level':level,
        'schoolName':schoolName,
        'fromdate':fromdate,
        'todate':todate,
        'yearGraduate':yearGraduate,

    //Exam taken    
        'examtype':examtype,
        'examName':examName,
        'examRating':examRating,
        'examTaken':examTaken,
        'dateExpiration':dateExpiration,

    //Family    
        'fam_desc':fam_desc,
        'fam_name':fam_name,
        'fam_age':fam_age,
        'fam_address':fam_address,
        'fam_contact':fam_contact,

    //Work Experience 
        'previous_position':previous_position,
        'employer':employer,
        'exclusive_from':exclusive_from,
        'exclusive_to':exclusive_to,
        'compensation':compensation,

    //Evaluation   
        'current_position':current_position,
        'evaluated_by':evaluated_by,
        'eval_from':eval_from,
        'eval_to':eval_to,
        'eval_result':eval_result,
        'eval_remark':eval_remark,

    //Movement
        'movement_from':movement_from,
        'movement_to':movement_to,
        'effective_date':effective_date,
        'approval_date':approval_date,
        'movement_remarks':movement_remarks,

    // User information    
        'username':$('#username').val(),
        'password':$('#password').val(),
        'email':$('#email').val(),
        'all_permission':$('#all_permission').val(),

    // Address information    
        'addtype':addtype,
        'line_1':line_1,
        'line_2':line_2,
        'allcity':allcity,
        'allprovince':allprovince,
        'postal':postal,
        'addcountry':addcountry,

    //Department
        'department_id':$('#department_id').val(),  
        'job_position':$('#job_position').val(),  
          
    //Status
        'saveEmployee':$('#saveEmployee').val(),
    
    //Contact information    
        'contact_type_id':contact_type_id,
        'contact_value':contact_value
      };

      console.log(data);
      $.ajax({
          type: "POST",
          url:  baseurl + "hris/hris/save_employee",
          dataType: "text",
          data: data,
          success: function(data){
              clearFields();
              location.reload();

              toastr.success('Successfully Saved!', 'Operation Done');
          },
          error: function (errorThrown){
              toastr.error('Error!.', 'Employee or username already existed');
          }
      });
  });     
});


