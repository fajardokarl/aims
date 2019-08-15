var TableDatatablesEditable = function() {
  var all_contracts = $("#all_contracts").DataTable();
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

         $('#all_contracts').on('dblclick', 'tr', function () {
            var row = $(this).closest('tr')[0];
            var contract_id = all_contracts.cell( row, 0 ).data();

            window.open(baseurl+"collection/amortizationdetails?contractid="+contract_id);
         });

        // $('#addressnew').click(function() {
        //   if ($("#addtype2 option:selected").val() == 0 || $("#street2").val() != '' || $("#barangay2").val() != '') {
        //     address_addtbl.row.add([
        //        ".",
        //         "<input type='hidden' name='cust_addtype[]' value='"+ $("#addtype2 option:selected").val() +"'/>" + $("#select2-addtype2-container").text(),
        //         "<input type='hidden' name='cust_house[]' value='"+ $("#house_num2").val() +"'/>" + $("#house_num2").val(),
        //         "<input type='hidden' name='cust_street[]' value='"+ $("#street2").val() +"'/>" + $("#street2").val(),
        //         "<input type='hidden' name='cust_brgy[]' value='"+ $("#barangay2").val() +"'/>" + $("#barangay2").val(),
        //         // "<input type='hidden' name='cust_postal[]' value='"+ $("#brokerPostal").val() +"'/>" + $("#brokerPostal").val(),
        //         "<input type='hidden' name='cust_city[]' value='"+ $("#city2 option:selected").val() +"'/>" + $("#select2-city2-container").text(),
        //         "<input type='hidden' name='cust_prov[]' value='"+ $("#province2 option:selected").val() +"'/>" + $("#select2-province2-container").text(),
        //         "<input type='hidden' name='cust_country[]' value='"+ $("#country2 option:selected").val() +"'/>" + $("#select2-country2-container").text(),
        //         '<a href="#" class="btn btn-danger delete">remove</a>'
        //       ]).draw(false);
        //   }
        //   //  console.log($("#barangay2").val()+"-->"+ $('#addtype2').find( "option:selected" ).text());
        //   //  var html = '<tr class="toRemove"><td>'+$("#addtype2 option:selected").text()+'</td><td>'+$("#house_num2").val()+'</td> <td>'+$("#street2").val()+'</td> <td>'+$("#barangay2").val()+'</td> <td>'+$("#city2 option:selected").text()+'</td> <td>'+$("#province2 option:selected").text()+'</td> <td>'+$("#country2 option:selected").text()+'</td>  <td><a href="#" class="btn btn-danger delete" >remove</a></td></tr>';
        //   //  table.append(html);
        //   //  var new_data = {
        //   //   'custid':$("#CustomerID").val(),
        //   //   'addid':$("#addtype2 option:selected").val(),
        //   //   'barangay':$("#barangay2").val(),
        //   //   'house_num2':$("#house_num2").val(), 
        //   //   'street2':$("#street2").val(), 
        //   //   'city':$("#city2 option:selected").val(),
        //   //   'province':$("#province2 option:selected").val(), 
        //   //   'country':$("#country2 option:selected").val()
        //   // };
        //   //   $.ajax({
        //   //             type: "POST",
        //   //             url: "marketing/addressSave",
        //   //             dataType: 'json',
        //   //             data: new_data,
        //   //             success: function(data)
        //   //                      {
        //   //                       toastr.info('Successfully saved!.', 'Operation done');
                                
        //   //                      },
        //   //             error: function (errorThrown)
        //   //                     {  
        //   //                       toastr.error('Failed to saved!.', 'Operation done');
        //   //                       console.log( errorThrown );
        //   //                     }  
        //   //            });
            
        //   });
        //    address_addtbl.on('click', '.delete', function (e) {
        //         e.preventDefault();
        //         var nRow = $(this).closest('.tffoRemove').remove();
        //    });
           

           $('#close_all').click(function() {
                $(".toRemove").remove(); 
           });
           $('#closeLot').click(function() {
                $(".toRemove").remove();
           });
           $('#show_partner_view').click(function() {
              $("#forexisting").hide();
              $("#fornew").show();
              $("#partner_panel").hide();
              $("#custSubmitUpdate").hide();
              $("#allsubmit").attr("action","marketing/savePartner");
              $("#custPartnerSave").show();
              $("#profilechange").show();
              $("#imageselect").hide();
              $('#custidforedit').hide();
              $("#work_portlet").hide();
              $('#contact_portlet').hide();
              $('#profilepicture').attr('src', '../public/images/profile_pic/default.png');
              $("#customer_page_tittle").html("Partner Details");
              $('#pdf_report').hide();

              $('#custFname').val('');
              $('#custLname').val('');
              $('#custMname').val('');
              $('#custGender').val('');
              // $('#CustomerID').val('');
              $('#custContactNum').val("");
              $('#custEmail').val("");
              $('#birthdate').val('');
              $('#custCivilStatus').val('');
              $('#custPlaceOfBirth').val('');
              $('#custFaxNumber').val("");
              $('#custBusinessPhone').val("");
              $('#custTIN').val('');
              $('#cust_occupation').val('');
              $('#cust_funds').val('');
              $('#job_title').val('');
              $('#cust_income').val('');
              $('#custNationality').val('');
              $('#comp_name').val('');
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