  var customermasterlist = function () {

    var handleCustomerMasterList = function () {
        var cust_contacts_table = $("#cust_contacts_table").DataTable({searching: false, paging: false});
        var contacts_table = $("#cust_contacts_table");
        var payment_table = $("#tbl-payments").DataTable({searching: false, paging: false});
        var misc_table = $("#misc_table").DataTable({searching: false});

        // var verify = $('#tbl_verify').DataTable({
        //     "bSort" : true,
        //     "aLengthMenu": [[10, 25, 100, -1], [10, 25, 100, "All"]],
        //     "iDisplayLength": 10,
        //     "fixedHeader": true,
        //      fixedHeader: {
        //         header: true,
        //     }
        // });
         var recommend = $('#tbl_recommend').DataTable({
            "bSort" : true,
            "aLengthMenu": [[10, 25, 100, -1], [10, 25, 100, "All"]],
            "iDisplayLength": 10,
            "fixedHeader": true,
             fixedHeader: {
                header: true,
            }
        });
         var approve = $('#tbl_approve').DataTable({
            "bSort" : true,
            "aLengthMenu": [[10, 25, 100, -1], [10, 25, 100, "All"]],
            "iDisplayLength": 10,
            "fixedHeader": true,
             fixedHeader: {
                header: true,
            }
        });

      // $('#message').ready(function(){
      // if ($('#requested_by_id').val() == 101) {  
      //     console.log( "ready!" );   
         
      //     alert("I am an alert box!");
      //     $('#verify').show();
      //     $('#recommend').hide();
      //     $('#approve').hide();            
      //   } 
      //  });








       
$('#tblcustomerlists').on('dblclick', 'tr', function () {
var row = $(this).closest('tr')[0];
var clientid = brokerlist.cell( row, 0 ).data();
console.log(clientid);
$('#pdf_report').show();
$.ajax({
type: "POST",
url: "marketing/retrieveOnCustomer",
dataType: 'json',
data: {'clientid':clientid},
success: function(data)
{
//toastr.info('Successfully saved!.', 'Operation done');
//populate textboxes
$("#allsubmit").attr("action","marketing/modifyPerson");
$('#custFname').val(data[0].firstname);
$('#custLname').val(data[0].lastname);
$('#custMname').val(data[0].middlename);
$('#custGender').val(data[0].sex);
$('#CustomerID').val(data[0].new_person_id);
$('#custContactNum').val("");
$('#custEmail').val("");
$('#birthdate').val(data[0].birthdate);
$('#custCivilStatus').val(data[0].civil_status_id);
$('#custPlaceOfBirth').val(data[0].birthplace);
$('#custFaxNumber').val("");
$('#custBusinessPhone').val("");
$('#custTIN').val(data[0].tin);
$('#cust_occupation').val(data[0].occupation);
$('#cust_funds').val(data[0].source_of_funds);
$('#job_title').val(data[0].job_title);
$('#cust_income').val(data[0].monthly_gross_income);
$('#custNationality').val(data[0].nationality);
$('#comp_name').val(data[0].organization_name);
$("#customer_page_tittle").html("Customer Details");
$('#cust_org_id').val(data[0].organization_id);
$('#cust_work_id').val(data[0].customer_work_id);
$('#id_client').val(data[0].client_id);


var filename = '../public/images/profiles/default.png';
if (typeof data[0].picture_url != 'undefined' && data[0].picture_url != null && data[0].picture_url != "") {
filename = '../public/images/profiles/' + data[0].picture_url;
console.log(filename);
}
$('#profilepicture').attr('src', filename);
$("#userfile").attr('name','notuserprofile');
console.log(data[0].picture_url);
$('#custidforedit').show();
$("#forexisting").show();
$("#fornew").hide();
$("#custSubmitUpdate").show();
$("#custSubmit").hide();
$("#profilechange").hide();
$("#imageselect").show();
$("#partner_panel").show();
$("#custPartnerSave").hide();
$('#pdf_report').show();

if(data.length > 0){
 var ref = 0;
 var add_ref = 0;
 $.each(data, function (index, value){
  
     var cont_html = '<tr class="toRemove"><td>'+ data[index].contact_type_name +'</td><td>'+ data[index].contact_value +'</td><td><a href="" class="btn red cust_cont_remove"> remove</a></td></tr>';
     if (data[index].contact_type_name !== null && ref != data[index].contact_id) {
          contacts_table.append(cont_html);
     }
     ref  = data[index].contact_id;
     
 });
  $.ajax({
      type: "POST",
      url: "marketing/get_address",
      dataType: 'json',
      data: {'clientid':clientid},
      success: function(data){
        var add_ref = 0;

        $.each(data, function (index, value){
          console.log(" address -----> " + data[index].person_address_id + " add_ref ------->" + add_ref);
          console.log(toString(value[2]));
          var html = '<tr class="toRemove"><td><input type="hidden" class="rmv" value="'+ data[index].address_type_id +'">'+ data[index].address_type_name + '</td><td>'+ data[index].line_3 +'</td><td>'+ data[index].line_2 +'</td> <td>'+ data[index].line_1 +'</td> <td>' + data[index].city_name +'</td> <td>'+ data[index].province_name +'</td> <td>'+ data[index].country_name +'</td>  <td><a href="#" class="btn btn-danger delete" >remove</a></td></tr>';
          if(data[index].person_address_id !== null && add_ref !== data[index].person_address_id){
                address_addtbl.append(html);
          }
          add_ref = data[index].person_address_id;

        });
      }, 
      error: function(data){
         toastr.error('Failed to saved!.', 'Operation done');
         console.log( errorThrown );
      }
  });
}else{
address_addtbl.clear().draw();
}
$('#AddCustomer').modal('toggle');
},
error: function (errorThrown)
{  
toastr.error('Failed to saved!.', 'Operation done');
console.log( errorThrown );
}  
});
$.ajax({
type: "POST",
url: "marketing/retrieveOnCustomerPartner",
dataType: 'json',
data: {'clientid':clientid},
success: function(data)
{
console.log(data);
if(data.length > 0){
     customer_partner.clear().draw();
     $.each(data, function (index, value){
        console.log(data[index].lastname);
        var partner_fullname = data[index].lastname + ", "+ data[index].firstname +" " + data[index].middlename;
        customer_partner.row.add( [
                    data[index].customer_partner_id,
                    partner_fullname,
                    '09987126376',
                    'sample@gmail.com',
                    data[index].line_3 + " " + data[index].line_2 + ", " + data[index].line_1 + ", " + data[index].city_name + ", " + data[index].province_name + ", " + data[index].country_name,
                     // '<a href="#" class="btn btn-danger delete" >remove</a>'
                ] ).draw( false );
     });
 } else{
    customer_partner.clear().draw();
 }
},
error: function (errorThrown)
{  
toastr.error('Failed to saved!.', 'Operation done');
console.log( errorThrown );
}  
});
tblcustamort.clear().draw();
$.ajax({
type: "POST",
url: "marketing/retrieve_customers_amortization",
dataType: 'json',
data: {'clientid':clientid},
success: function(data)
{
for (var i = 0; i < data.length; i++) {
 tblcustamort.row.add( [
          data[i].contract_id,
          data[i].lot_description,
          data[i].contract_date,
          data[i].total_contract_price,
          '<a href="" class="btn green btn-xs contract_details"><i class="fa fa-eye" aria-hidden="true"></i> view</a>' 
    ] ).draw( false );
}
console.log( data );
},
error: function (errorThrown)
{  
toastr.error('Failed to process!.', 'Operation done');
console.log( errorThrown );
}  
});
});

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

        var cont_id = $('#cont_id').val();
        var cont_status_id;

        $('#edit_status').click(function(){
          cont_status_id = $('#cont_status_id').val();

          $('#cont_status_opt').val($('#cont_status_id').val());
          $('#cont_status_opt').show();
          $('#cont_status').hide();

          $(this).hide();
          $('#edit_buttons').show();
        });

        $('#cancel_edit').click(function(){
          $('#edit_status').show();
          $('#cont_status').show();
          $('#cont_status_opt').hide();
          $('#edit_buttons').hide();
        });

        $('#save_status').click(function(){
          cont_status_id = $('#cont_status_opt').find('option:selected').val();

          $.ajax({
              type: "POST",
              url: "marketing/update_contract_status",
              dataType: 'json',
              data: {'cont_id':cont_id, 'cont_status_id':cont_status_id},
              success: function(data){
                $('#cont_status').html($('#cont_status_opt').find('option:selected').text());
                $('#cont_status_id').val($('#cont_status_opt').find('option:selected').val())
                $('#edit_status').show();
                $('#cont_status').show();
                $('#cont_status_opt').hide();
                $('#edit_buttons').hide();

                toastr.options.timeOut = 500;
                toastr.success('Status Updated', 'Operation done');
              }, 
              error: function(data){
                toastr.options.timeOut = 500;
                toastr.error('Failed to saved!.', 'Operation done');
                // console.log( errorThrown );
              }
          });
        });

        $('#add_misc_btn').click(function(){
          $('#misc_amount').html("&#8369; " + jFormatNumber($('#tcp').val() * (5/100)));
        });

        var tcp_misc, terms_misc, monthly_misc, date_misc;
       
        
        $('#compute_misc').click(function(){
          tcp_misc = $('#tcp').val() * (5/100);
          terms_misc = $('#terms_misc').val();
          monthly_misc = tcp_misc / terms_misc;
          date_misc = $('#date_misc').val();

          console.log(tcp_misc);
          console.log(terms_misc);
          console.log(monthly_misc);

          if (tcp_misc != null || tcp_misc != 0) {
            for (var i = 1; i <= terms_misc; i++) {
              var misc_date = moment(date_misc).add(i-1, 'M').format("MMM DD, YYYY")
              misc_table.row.add([
                misc_date,
                jFormatNumber(monthly_misc)
              ]).draw( false );
            }
          }
        });

        var misc_arr = [];
        $('#save_misc').click(function(){
          var cont_id = $('#cont_id').val();

          for (var i = 0; i < terms_misc; i++) {
            var misc_date = moment(misc_table.cell( i, 0 ).data()).format("YYYY-MM-DD");
            var misc_value = jFormatNumberRet(misc_table.cell( i, 1 ).data());

            var data = {
              'contract_id' : cont_id,
              'line_order' : i + 1,
              'due_date': misc_date,
              // 'outstanding_balance':jFormatNumberRet(tbl_misc.cell( i, 3 ).data()),
              'principal_amount': misc_value,
              'rebate':0,
              'cashier_id':user_id,
              'miscellaneous_amount':misc_value,
              'paid_up':'false',
            }
            misc_arr.push(data);
          }
          

          $.ajax({
              type: "POST",
              url: "marketing/miscellaneous_save",
              dataType: 'json',
              data: {'misc_arr' : misc_arr},
              success: function(data){
                toastr.options.timeOut = 500;
                toastr.success('Successfully Saved', 'Operation done');
                location.reload();
              }, 
              error: function(data){
                toastr.options.timeOut = 500;
                toastr.error('Failed to save!.', 'Operation done');
                // console.log( errorThrown );
              }
          });


        });


        if (jQuery().datepicker) {
            $('#birthdate').datepicker({
                rtl: App.isRTL(),
                format: 'yyyy-mm-dd',
                orientation: "left",
                autoclose: true
            });
        }

        if (jQuery().datepicker) {
            $('#spouseBday').datepicker({
                rtl: App.isRTL(),
                format: 'yyyy-mm-dd',
                orientation: "left",
                autoclose: true
            });
        }

         if (jQuery().datepicker) {
            $('#spousebirthday').datepicker({
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

         $('#spouseBday').keyup(function(){
             var v = this.value;
            if (v.match(/^\d{4}$/) !== null) {
                this.value = v + '-';
            } else if (v.match(/^\d{4}\-\d{2}$/) !== null) {
                this.value = v + '-';
            }
        }); 

        $('#customerbirthday').keyup(function(){
             var v = this.value;
            if (v.match(/^\d{4}$/) !== null) {
                this.value = v + '-';
            } else if (v.match(/^\d{4}\-\d{2}$/) !== null) {
                this.value = v + '-';
            }
        }); 
        
        $('#spousebirthday').keyup(function(){
             var v = this.value;
            if (v.match(/^\d{4}$/) !== null) {
                this.value = v + '-';
            } else if (v.match(/^\d{4}\-\d{2}$/) !== null) {
                this.value = v + '-';
            }
        }); 
       
        var IncrementCustID =  Number($('#getcustid').val()) + 1;
        //alert(IncrementCustID);
        // $("#CustomerID").val(IncrementCustID.toFixed(0));


        $('#custSubmit').click(function() {   
            var text = document.getElementById('subsidiary');
            var v = $.trim(text.value)
            var elems = $('#tablecustomerlist td').filter(function(){
             return $.trim($(this).text())===v
            });
            if (elems.length) {
                alert(text.value + ' Subsidiary Account Exist!');
            }
            var myRows = $("#tablecustomerlist tr:contains('"+ text.value +"')");
            alert(myRows.length);
        });

        $("#add_cust_contact").click(function(){
          var rowCount_contact = $('#cust_contacts_table tbody tr').length;
          if ($("#cust_cont_value").val() != "") {
              cust_contacts_table.row.add( [
                      "<input type='hidden' name='cust_cont_type[]' value='" + $("#cust_cont_type option:selected").val() + "'>" + $("#cust_cont_type option:selected").text(),
                      "<input type='hidden' name='cust_cont_value[]' value='" + $("#cust_cont_value").val() + "'>" + $("#cust_cont_value").val(),
                      '<a href="#" class="btn btn-danger cust_delete_contact">remove</a>'
                      ] ).draw( false );
              // $("#cust_cont_value").val('');
          }else{
              toastr.options.timeOut = 500;
              toastr.error('Please Fill Contact Value.', 'Notice!');
          }
        });

        cust_contacts_table.on('click', '.cust_delete_contact', function(e){
          e.preventDefault();
          cust_contacts_table.row($(this).closest('tr')).remove().draw();
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

function blurFunction() {
    var str = document.getElementById('custName').value;
    var res = str.substring(0, 3);
    var afterComma = str.substr(str.indexOf(",") + 1);
    var res2 = afterComma.substring(1, 4);
    document.getElementById('sample').value = res.toUpperCase() + res2.toUpperCase();
    document.getElementById('subsidiary').value = res.toUpperCase() + res2.toUpperCase();

    var text = document.getElementById('subsidiary');
    var v = $.trim(text.value)
    var elems = $('#tablecustomerlist td').filter(function(){
     return $.trim($(this).text())===v
    });
    if (elems.length) {
        //alert(text.value + ' Subsidiary Account Exist!');
    }
    var myRows = $("#tablecustomerlist tr:contains('"+text.value+"')");
    //alert(myRows.length);

    if (myRows.length == '0')
    {
        var result = text.value;
    }
    else if (myRows.length > '0')
    {
        var result = text.value + myRows.length;
    }

    document.getElementById('subsidiary').value = result;
}



var lots_table = $('#tbl_verify').DataTable();
lots_table.on('click', '.btn-lot-edit', function (e) {
        e.preventDefault();
        var row = $(this).closest('tr')[0];
        var prf_id = lots_table.cell(row, 0 ).data();

        $.ajax({
            type: "POST",
            url:  baseurl + "message/get_messages",
            dataType: "json",
            data: {'prf_id': prf_id},
            success: function(data){
              console.log(data);
              // alert(prf_id);
              $("#prf_id").val(prf_id);
              $("#txt_requested_by_id").html(data[0].requested_by_id);
              $("#txt_department_id").html(data[0].department_id);
              $("#txt_date_request").html(data[0].date_requested);
              $("#txt_total_amount").val((data[0].total_amount));
              $("#txt_remarks").html(data[0].remarks);
              $("#txt_purpose").html(data[0].purpose);
              $("#text_justification").html(data[0].justification);
              // $("#txt_house_price").html(data[0].house_price);
            
            },
             error: function (errorThrown){
                        console.log(errorThrown)
                        toastr.error('Error!.', 'Operation Done');
                    }           
        });
    });


function ValidateForm(){
  // if (document.getElementById('spouseBday').value == ''){
  //       document.getElementById('spouseBday').value = '1950-01-01';
  //   }

     $(document).ajaxStop($.unblockUI); 
     $.blockUI({ message: '<h1><img src="/images/assets/apps/img/default.gif" /> Just a moment...</h1>' });
}
jQuery.validator.addMethod("taxid", function(value, element) {
  return this.optional(element) || /^(\d{3})-?\d{2}-?\d{4}$/i.test(value) || /^(\d{2})-?\d{7}$/i.test(value)
}, "Invalid Tax ID");




