
jQuery(document).ready( function($) {  
  var applicant_table = $('#applicant_table').DataTable({searching: false, paging: false});
  var language_table = $('#language_table').DataTable({searching: false, paging: false});
  var examination_table = $('#examination_table').DataTable({searching: false, paging: false});
  var last_school_table = $('#last_school_table').DataTable({searching: false, paging: false});
  var work_experience_table = $('#work_experience_table').DataTable({searching: false, paging: false});
  var family_table = $('#family_table').DataTable({searching: false, paging: false});
  var referral_table = $('#referral_table').DataTable({searching: false, paging: false});
  var movement_table = $('#movement_table').DataTable({searching: false, paging: false});
	var address_contacts_table = $('#address_contacts_table').DataTable({searching: false, paging: false});
	var emp_contacts_table = $('#emp_contacts_table').DataTable({searching: false, paging: false});
  var employee_table = $('#employee_table').DataTable({"order": [[ 0, "desc" ]],"lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]] }); 

$("#add_address").click(function(){
        var rowCount_contact = $('#address_contacts_table tbody tr').length;      
       
  if ($("app_addtype").val() != "") {
  address_contacts_table.row.add( [ 
         "<input type='hidden' name='app_addtype[]' value='" + $("#app_addtype option:selected").val() + "'>" + $("#app_addtype option:selected").text(),    
         "<input type='hidden' name='app_line_1[]' value='" + $("#app_line_1").val() + "'>" + $("#app_line_1").val(),
         "<input type='hidden' name='app_line_2[]' value='" + $("#app_line_2").val() + "'>" + $("#app_line_2").val(),
         "<input type='hidden' name='app_allcity[]' value='" + $("#app_allcity option:selected").val() + "'>" + $("#app_allcity option:selected").text(),    
         "<input type='hidden' name='app_allprovince[]' value='" + $("#app_allprovince option:selected").val() + "'>" + $("#app_allprovince option:selected").text(),    
         "<input type='hidden' name='app_postal[]' value='" + $("#app_postal").val() + "'>" + $("#app_postal").val(),
         "<input type='hidden' name='app_addcountry[]' value='" + $("#app_addcountry option:selected").val() + "'>" + $("#app_addcountry option:selected").text(), 
         '<a href="#" class="btn btn-danger cust_delete_contact">remove</a>'
        ] ).draw( false );         
            // $("#canvass_total").html(total);     
        }else{
            toastr.options.timeOut = 500;
            toastr.error('Please Fill everything in this form.', 'Replacement Notice!');
        }
      });

      address_contacts_table.on('click', '.cust_delete_contact', function(e){
        e.preventDefault();
        address_contacts_table.row($(this).closest('tr')).remove().draw();
      });



 $('#applicant_table').on('dblclick', 'tr', function () {
            var row = $(this).closest('tr')[0];
            var person_id = applicant_table.cell( row, 0 ).data();
            window.open(baseurl+"hris/applicant/applicant_info?personid="+person_id);
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
    $('#app_ref_relationship option:selected').val('');
    $('#app_line_1').val('');
    $('#app_line_2').val('');
    $('#app_language').val('');
    $('#app_allcity option:selected').val('');
    $('#app_allprovince option:selected').val('');
    $('#app_addcountry option:selected').val('');
    $('#app_postal').val('');
    $('#contact_type_id option:selected').val('');
    $('#contact_value').val('');
    $('#department_id option:selected').val('');
    $('#job_position').val('');
    $('#app_level option:selected').val('');
    $('#app_schoolName').val('');
    $('#app_fromdate').val('');
    $('#app_todate').val('');
    $('#app_yearGraduate').val('');
    $('#app_examtype').val('');
    $('#app_examName').val('');
    $('#app_examRating').val('');
    $('#app_examTaken').val('');
    $('#app_dateExpiration').val('');
    $('#app_previous_position').val('');
    $('#app_employer').val('');
    $('#app_exclusive_from').val('');
    $('#app_exclusive_to').val('');
    $('#app_compensation').val('');
    $('#app_fam_desc option:selected').val('');    
    $('#app_fam_name').val('');
    $('#app_fam_age').val('');
    $('#app_fam_address').val('');
    $('#app_fam_contact').val('');
    $('#app_ref_name').val(''); 
    $('#app_ref_company').val('');
    $('#app_ref_contact').val('');
    $('#app_ref_relationship').val('');
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
          $('#app_fromdate').datepicker({
              rtl: App.isRTL(),
              format: 'yyyy-mm-dd',
              orientation: "left",
              autoclose: true
          });
      }   


       $('#app_fromdate').keyup(function(){
           var v = this.value;
          if (v.match(/^\d{4}$/) !== null) {
              this.value = v + '-';
          } else if (v.match(/^\d{4}\-\d{2}$/) !== null) {
              this.value = v + '-';
          }

      });    
       if (jQuery().datepicker) {
          $('#app_todate').datepicker({
              rtl: App.isRTL(),
              format: 'yyyy-mm-dd',
              orientation: "left",
              autoclose: true
          });
      }   


       $('#app_todate').keyup(function(){
           var v = this.value;
          if (v.match(/^\d{4}$/) !== null) {
              this.value = v + '-';
          } else if (v.match(/^\d{4}\-\d{2}$/) !== null) {
              this.value = v + '-';
          }
      });

    if (jQuery().datepicker) {
          $('#app_examTaken').datepicker({
              rtl: App.isRTL(),
              format: 'yyyy-mm-dd',
              orientation: "left",
              autoclose: true
          });
      }   


       $('#app_examTaken').keyup(function(){
           var v = this.value;
          if (v.match(/^\d{4}$/) !== null) {
              this.value = v + '-';
          } else if (v.match(/^\d{4}\-\d{2}$/) !== null) {
              this.value = v + '-';
          }

      });    
       if (jQuery().datepicker) {
          $('#app_dateExpiration').datepicker({
              rtl: App.isRTL(),
              format: 'yyyy-mm-dd',
              orientation: "left",
              autoclose: true
          });
      }   


       $('#app_dateExpiration').keyup(function(){
           var v = this.value;
          if (v.match(/^\d{4}$/) !== null) {
              this.value = v + '-';
          } else if (v.match(/^\d{4}\-\d{2}$/) !== null) {
              this.value = v + '-';
          }
      });



  if (jQuery().datepicker) {
          $('#app_exclusive_from').datepicker({
              rtl: App.isRTL(),
              format: 'yyyy-mm-dd',
              orientation: "left",
              autoclose: true
          });
      }   


       $('#app_exclusive_from').keyup(function(){
           var v = this.value;
          if (v.match(/^\d{4}$/) !== null) {
              this.value = v + '-';
          } else if (v.match(/^\d{4}\-\d{2}$/) !== null) {
              this.value = v + '-';
          }
      });
        if (jQuery().datepicker) {
          $('#app_exclusive_to').datepicker({
              rtl: App.isRTL(),
              format: 'yyyy-mm-dd',
              orientation: "left",
              autoclose: true
          });
      }   


       $('#app_exclusive_to').keyup(function(){
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
 $("#add_app_language").click(function(){
        var rowCount_contact = $('#language_table tbody tr').length;
  if ($("app_language").val() != "") {
  language_table.row.add( [        
         "<input type='hidden' name='app_language[]' value='" + $("#app_language").val() + "'>" + $("#app_language").val(),         
         '<a href="#" class="btn btn-danger cust_delete_contact">remove</a>'
        ] ).draw( false );         
            // $("#canvass_total").html(total);     
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
        
       
  if ($("item_description").val() != "") {
  emp_contacts_table.row.add( [ 
         "<input type='hidden' name='contact_type_id[]' value='" + $("#contact_type_id option:selected").val() + "'>" + $("#contact_type_id option:selected").text(),    
         "<input type='hidden' name='contact_value[]' value='" + $("#contact_value").val() + "'>" + $("#contact_value").val(),         
         '<a href="#" class="btn btn-danger cust_delete_contact">remove</a>'
        ] ).draw( false );         
            // $("#canvass_total").html(total);     
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
  if ($("app_level").val() != "") {
  last_school_table.row.add( [ 
         "<input type='hidden' name='app_level[]' value='" + $("#app_level option:selected").val() + "'>" + $("#app_level option:selected").text(),    
         "<input type='hidden' name='app_schoolName[]' value='" + $("#app_schoolName").val() + "'>" + $("#app_schoolName").val(),         
         "<input type='hidden' name='app_fromdate[]' value='" + $("#app_fromdate").val() + "'>" + $("#app_fromdate").val(),  
         "<input type='hidden' name='app_todate[]' value='" + $("#app_todate").val() + "'>" + $("#app_todate").val(),         
         "<input type='hidden' name='app_yearGraduate[]' value='" + $("#app_yearGraduate").val() + "'>" + $("#app_yearGraduate").val(),         

         '<a href="#" class="btn btn-danger cust_delete_contact">remove</a>'
        ] ).draw( false );         
            // $("#canvass_total").html(total);     
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
  if ($("app_previous_position").val() != "") {
  work_experience_table.row.add( [ 
         "<input type='hidden' name='app_previous_position[]' value='" + $("#app_previous_position").val() + "'>" + $("#app_previous_position").val(),         
         "<input type='hidden' name='app_employer[]' value='" + $("#app_employer").val() + "'>" + $("#app_employer").val(),         
         "<input type='hidden' name='app_exclusive_from[]' value='" + $("#app_exclusive_from").val() + "'>" + $("#app_exclusive_from").val(), 
         "<input type='hidden' name='app_exclusive_to[]' value='" + $("#app_exclusive_to").val() + "'>" + $("#app_exclusive_to").val(), 
         "<input type='hidden' name='app_compensation[]' value='" + $("#app_compensation").val() + "'>" + $("#app_compensation").val(),         
        
         '<a href="#" class="btn btn-danger cust_delete_contact">remove</a>'
        ] ).draw( false );         
            // $("#canvass_total").html(total);     
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
  if ($("app_examtype").val() != "") {
  examination_table.row.add( [ 
         "<input type='hidden' name='app_examtype[]' value='" + $("#app_examtype").val() + "'>" + $("#app_examtype").val(),
         "<input type='hidden' name='app_examName[]' value='" + $("#app_examName").val() + "'>" + $("#app_examName").val(),         
         "<input type='hidden' name='app_examRating[]' value='" + $("#app_examRating").val() + "'>" + $("#app_examRating").val(), 
         "<input type='hidden' name='app_examTaken[]' value='" + $("#app_examTaken").val() + "'>" + $("#app_examTaken").val(),         
         "<input type='hidden' name='app_dateExpiration[]' value='" + $("#app_dateExpiration").val() + "'>" + $("#app_dateExpiration").val(),         

         '<a href="#" class="btn btn-danger cust_delete_contact">remove</a>'
        ] ).draw( false );         
            // $("#canvass_total").html(total);     
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
  if ($("app_fam_desc").val() != "") {
  family_table.row.add( [ 
         "<input type='hidden' name='app_fam_desc[]' value='" + $("#app_fam_desc option:selected").val() + "'>" + $("#app_fam_desc option:selected").text(),    
        
         "<input type='hidden' name='app_fam_name[]' value='" + $("#app_fam_name").val() + "'>" + $("#app_fam_name").val(),         
         "<input type='hidden' name='app_fam_age[]' value='" + $("#app_fam_age").val() + "'>" + $("#app_fam_age").val(), 
         "<input type='hidden' name='app_fam_address[]' value='" + $("#app_fam_address").val() + "'>" + $("#app_fam_address").val(),         
         "<input type='hidden' name='app_fam_contact[]' value='" + $("#app_fam_contact").val() + "'>" + $("#app_fam_contact").val(),         

         '<a href="#" class="btn btn-danger cust_delete_contact">remove</a>'
        ] ).draw( false );         
            // $("#canvass_total").html(total);     
        }else{
            toastr.options.timeOut = 500;
            toastr.error('Please Fill everything in this form.', 'Replacement Notice!');
        }
      });

      family_table.on('click', '.cust_delete_contact', function(e){
        e.preventDefault();
        family_table.row($(this).closest('tr')).remove().draw();
      });


$("#add_referral").click(function(){
        var rowCount_contact = $('#referral_table tbody tr').length;       
  if ($("app_ref_name").val() != "") {
  referral_table.row.add( [ 
         "<input type='hidden' name='app_ref_name[]' value='" + $("#app_ref_name").val() + "'>" + $("#app_ref_name").val(),
         "<input type='hidden' name='app_ref_position[]' value='" + $("#app_ref_position").val() + "'>" + $("#app_ref_position").val(),         
         "<input type='hidden' name='app_ref_company[]' value='" + $("#app_ref_company").val() + "'>" + $("#app_ref_company").val(), 
         "<input type='hidden' name='app_ref_contact[]' value='" + $("#app_ref_contact").val() + "'>" + $("#app_ref_contact").val(),         
         "<input type='hidden' name='app_ref_relationship[]' value='" + $("#app_ref_relationship").val() + "'>" + $("#app_ref_relationship").val(),         
        

         '<a href="#" class="btn btn-danger cust_delete_contact">remove</a>'
        ] ).draw( false );         
            // $("#canvass_total").html(total);     
        }else{
            toastr.options.timeOut = 500;
            toastr.error('Please Fill everything in this form.', 'Replacement Notice!');
        }
      });

      referral_table.on('click', '.cust_delete_contact', function(e){
        e.preventDefault();
        referral_table.row($(this).closest('tr')).remove().draw();
      });



  $('#saveApplicant').click(function(){
 //Address
      var app_addtype = $('input[name="app_addtype[]"]').map(function(){
          return $(this).val();
      }).get();

      var app_line_1 = $('input[name="app_line_1[]"]').map(function(){
          return $(this).val();
      }).get();

      var app_line_2 = $('input[name="app_line_2[]"]').map(function(){
          return $(this).val();
      }).get();

      var app_allcity = $('input[name="app_allcity[]"]').map(function(){
          return $(this).val();
      }).get();

      var app_allprovince = $('input[name="app_allprovince[]"]').map(function(){
          return $(this).val();
      }).get();   

      var app_postal = $('input[name="app_postal[]"]').map(function(){
          return $(this).val();
      }).get();   

      var app_addcountry = $('input[name="app_addcountry[]"]').map(function(){
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
      var app_level = $('input[name="app_level[]"]').map(function(){
          return $(this).val();
      }).get();

      var app_schoolName = $('input[name="app_schoolName[]"]').map(function(){
          return $(this).val();
      }).get();  
      var app_fromdate = $('input[name="app_fromdate[]"]').map(function(){
          return $(this).val();
      }).get();

      var app_todate = $('input[name="app_todate[]"]').map(function(){
          return $(this).val();
      }).get();  

    var app_yearGraduate = $('input[name="app_yearGraduate[]"]').map(function(){
          return $(this).val();
      }).get(); 

//Examinations taken
      var app_examtype = $('input[name="app_examtype[]"]').map(function(){
          return $(this).val();
      }).get();

      var app_examName = $('input[name="app_examName[]"]').map(function(){
          return $(this).val();
      }).get();  
    
     var app_examRating = $('input[name="app_examRating[]"]').map(function(){
          return $(this).val();
      }).get();

     var app_examTaken = $('input[name="app_examTaken[]"]').map(function(){
          return $(this).val();
      }).get();

      var app_dateExpiration = $('input[name="app_dateExpiration[]"]').map(function(){
          return $(this).val();
      }).get(); 

//Work experence
        var app_previous_position = $('input[name="app_previous_position[]"]').map(function(){
          return $(this).val();
      }).get();  
        var app_employer = $('input[name="app_employer[]"]').map(function(){
          return $(this).val();
      }).get();  
        var app_exclusive_from = $('input[name="app_exclusive_from[]"]').map(function(){
          return $(this).val();
      }).get();  
        var app_exclusive_to = $('input[name="app_exclusive_to[]"]').map(function(){
          return $(this).val();
      }).get();
          var app_compensation = $('input[name="app_compensation[]"]').map(function(){
          return $(this).val();
      }).get();

//Family Background
      var app_fam_desc = $('input[name="app_fam_desc[]"]').map(function(){
          return $(this).val();
      }).get();

      var app_fam_name = $('input[name="app_fam_name[]"]').map(function(){
          return $(this).val();
      }).get();  
      var app_fam_age = $('input[name="app_fam_age[]"]').map(function(){
          return $(this).val();
      }).get();

      var app_fam_address = $('input[name="app_fam_address[]"]').map(function(){
          return $(this).val();
      }).get();  

      var app_fam_contact = $('input[name="app_fam_contact[]"]').map(function(){
          return $(this).val();
      }).get();
     
//Referal
      var app_ref_name = $('input[name="app_ref_name[]"]').map(function(){
          return $(this).val();
      }).get();

      var app_ref_position = $('input[name="app_ref_position[]"]').map(function(){
          return $(this).val();
      }).get();  
      var app_ref_company = $('input[name="app_ref_company[]"]').map(function(){
          return $(this).val();
      }).get();

      var app_ref_contact = $('input[name="app_ref_contact[]"]').map(function(){
          return $(this).val();
      }).get();  

      var app_ref_relationship = $('input[name="app_ref_relationship[]"]').map(function(){
          return $(this).val();
      }).get();
      
//Language
      var app_language = $('input[name="app_language[]"]').map(function(){
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
        'weight':$('#weight').val(),
        'height':$('#height').val(),
        'tin':$('#tin').val(),
        'philhealth':$('#philhealth').val(),
        'sss':$('#sss').val(),
        'hdmf':$('#hdmf').val(),

    //School attended
        'app_language':app_language,

    //School attended
        'app_level':app_level,
        'app_schoolName':app_schoolName,
        'app_fromdate':app_fromdate,
        'app_todate':app_todate,
        'app_yearGraduate':app_yearGraduate,

    //Exam taken    
        'app_examtype':app_examtype,
        'app_examName':app_examName,
        'app_examTaken':app_examTaken,
        'app_examRating':app_examRating,
        'app_dateExpiration':app_dateExpiration,

    //Family    
        'app_fam_desc':app_fam_desc,
        'app_fam_name':app_fam_name,
        'app_fam_age':app_fam_age,
        'app_fam_address':app_fam_address,
        'app_fam_contact':app_fam_contact,

    //Work Experience 
        'app_previous_position':app_previous_position,
        'app_employer':app_employer,
        'app_exclusive_from':app_exclusive_from,
        'app_exclusive_to':app_exclusive_to,
        'app_compensation':app_compensation,

    //Referal   
        'app_ref_name':app_ref_name,
        'app_ref_position':app_ref_position,
        'app_ref_company':app_ref_company,
        'app_ref_contact':app_ref_contact,
        'app_ref_relationship':app_ref_relationship,

    // Answer information    
        'impairment':$('#impairment').val(),
        'impairment_yes':$('#impairment_yes').val(),
        'doctor':$('#doctor').val(),
        'doctor_yes':$('#doctor_yes').val(),
        'accident':$('#accident').val(),
        'accident_yes':$('#accident_yes').val(),
        'surgery':$('#surgery').val(),
        'surgery_yes':$('#surgery_yes').val(),
        'law':$('#law').val(),
        'law_yes':$('#law_yes').val(),
        'discharge':$('#discharge').val(),
        'discharge_yes':$('#discharge_yes').val(),
        'affiliates':$('#affiliates').val(),
        'affiliates_yes':$('#affiliates_yes').val(),
        'hospitalized':$('#hospitalized').val(),
        'work_with':$('#work_with').val(),
        'goals':$('#goals').val(),
        'strong_points':$('#strong_points').val(),
        'weak_points':$('#weak_points').val(),
        'start':$('#start').val(),
        'salary':$('#salary').val(),
       
    //Department
        'app_department_id':$('#app_department_id').val(),  
        'app_job_position':$('#app_job_position').val(),  
          
    //Source
        'source_id':$('#source_id').val(),     

    //person type
       

    // Applicant address    
        'app_addtype':app_addtype,
        'app_line_1':app_line_1,
        'app_line_2':app_line_2,
        'app_allcity':app_allcity,
        'app_allprovince':app_allprovince,
        'app_postal':app_postal,
        'app_addcountry':app_addcountry,   
    
    //Contact information    
        'contact_type_id':contact_type_id,
        'contact_value':contact_value
      };

      console.log(data);
      $.ajax({
          type: "POST",
          url:  baseurl + "hris/applicant/save_applicant",
          dataType: "text",
          data: data,
          success: function(data){
              clearFields(); 
              toastr.success('Successfully Saved!', 'Operation Done');
              location.reload();
          },
          error: function (errorThrown){
              toastr.error('Error!.', 'Employee or username already existed');
          }
      });
  });     
});

  



