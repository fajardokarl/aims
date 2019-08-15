  var customermasterlist = function () {

    var handleCustomerMasterList = function () {
        var cust_contacts_table = $("#cust_contacts_table").DataTable({searching: false, paging: false});
        var cust_org_contacts = $("#cust_org_contacts").DataTable({searching: false, paging: false});
        var cust_org_contlist_table = $("#cust_org_contlist_table").DataTable({searching: false, paging: false});
        var contacts_table = $("#cust_contacts_table");
        var payment_table = $("#tbl-payments").DataTable({searching: false, paging: false});
        var misc_table = $("#misc_table").DataTable({searching: false});
        var cust_address = $("#cust_address").DataTable({searching: false, paging: false});
        var cust_contact = $("#cust_contact").DataTable({searching: false, paging: false});
        var oldacc_table = $("#oldacc_table").DataTable({searching: false, paging: false});
        var tbl_legacy_table = $("#tbl_legacy_table").DataTable();
        // var listoflots = $('#listOfLots').DataTable({
        //     "bSort" : true,
        //     "aLengthMenu": [[10, 25, 100, -1], [10, 25, 100, "All"]],
        //     "iDisplayLength": 10,
        //     "fixedHeader": false,
        //      fixedHeader: {
        //         header: true,
        //     }
        // });
        var legacy_table = $("#legacy_table").DataTable({bInfo:false, searching: false, "lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]], "columnDefs": [
                    {
                        "targets": [ 0 ],
                        "visible": false,
                        "searchable": false
                    }
                ]
              });
        // var brokerlist = $('#tblcustomerlists').DataTable({
        //     "bSort" : true,
        //     "aLengthMenu": [[10, 25, 100, -1], [10, 25, 100, "All"]],
        //     "iDisplayLength": 10,
        //     "fixedHeader": true,
        //      fixedHeader: {
        //         header: true,
        //     }
        // });
        var tblAmortdetails = $('#tblAmortdetails').DataTable({
            "bSort" : true,
            "aLengthMenu": [[10, 25, 100, -1], [10, 25, 100, "All"]],
            "iDisplayLength": 10,
            "fixedHeader": true,
            "columnDefs": [
                    {
                        "targets": [ 0 ],
                        "visible": false,
                        "searchable": false
                    },
                    {
                      "targets": [ "_all" ],
                      "orderable" : false
                    }
                ],
             fixedHeader: {
                header: true,
            }
        });
        var tbl_misc_details = $('#tbl-misc-details').DataTable({
            "bSort" : true,
            "aLengthMenu": [[10, 25, 100, -1], [10, 25, 100, "All"]],
            "iDisplayLength": 10,
            "fixedHeader": true,
            "searchable": false,
            "columnDefs": [
                    {
                        "targets": [ 0, 3 ],
                        "visible": false,
                        "searchable": false
                    },
                    {
                      "targets": [ "all_" ],
                      "orderable" : false
                    }
                ],
             fixedHeader: {
                header: true,
            }
        });

         var address_addtbl = $('#address_add').DataTable( {
                bFilter: false,
                "columnDefs": [
                    {
                        "targets": [ 0 ],
                        "visible": false,
                        "searchable": false
                    }
                ]
         });
         var customer_partner = $('#partner_details').DataTable({
                 bFilter: false,
                  "columnDefs": [
                      {
                          "targets": [ 0 ],
                          "visible": false,
                          "searchable": false
                      }
                  ]
            });
         var tblcustamort = $('#tblcustamort').DataTable({
                 bFilter: false,
            });
         
         $('#reason_price').click(function() {
            if($(this).is(':checked')){
                  $(this).val('1');
              }else{
                  $(this).val('0');
              }
         });
         $('#reason_location').click(function() {
            if($(this).is(':checked')){
                  $(this).val('1');
              }else{
                  $(this).val('0');
              }
         });
         $('#reason_design').click(function() {
            if($(this).is(':checked')){
                  $(this).val('1');
              }else{
                  $(this).val('0');
              }
         });
         $('#reason_developer').click(function() {
            if($(this).is(':checked')){
                  $(this).val('1');
              }else{
                  $(this).val('0');
              }
         });
         $('#source_flyers').click(function() {
            if($(this).is(':checked')){
                  $(this).val('1');
              }else{
                  $(this).val('0');
              }
         });
         $('#source_refer').click(function() {
            if($(this).is(':checked')){
                  $(this).val('1');
              }else{
                  $(this).val('0');
              }
         });
         $('#source_invitation').click(function() {
            if($(this).is(':checked')){
                  $(this).val('1');
              }else{
                  $(this).val('0');
              }
         });
         $('#source_billboard').click(function() {
            if($(this).is(':checked')){
                  $(this).val('1');
              }else{
                  $(this).val('0');
              }
         });
         $('#source_magazine').click(function() {
            if($(this).is(':checked')){
                  $(this).val('1');
              }else{
                  $(this).val('0');
              }
         });
         $('#source_activity').click(function() {
            if($(this).is(':checked')){
                  $(this).val('1');
              }else{
                  $(this).val('0');
              }
         });
         $('#source_online').click(function() {
            if($(this).is(':checked')){
                  $(this).val('1');
              }else{
                  $(this).val('0');
              }
         });
         $('#done_survey').click(function(){
            $('#reason_price1').val($('#reason_price').val());
            $('#reason_location1').val($('#reason_location').val());
            $('#reason_design1').val($('#reason_design').val());
            $('#reason_developer1').val($('#reason_developer').val());
            $('#reason_others1').val($('#reason_others').val());
            $('#source_flyers1').val($('#source_flyers').val());
            $('#source_refer1').val($('#source_refer').val());
            $('#source_invitation1').val($('#source_invitation').val());
            $('#source_billboard1').val($('#source_billboard').val());
            $('#source_magazine1').val($('#source_magazine').val());
            $('#source_activity1').val($('#source_activity').val());
            $('#source_online1').val($('#source_online').val());
            $('#source_others1').val($('#source_others').val());
            // console.log($('#reason_price1').val());
            // console.log($('#reason_location1').val());
            // console.log($('#reason_design1').val());
            // console.log($('#reason_developer1').val());
            // console.log($('#reason_others1').val());
            // console.log($('#source_flyers1').val());
            // console.log($('#source_refer1').val());
            // console.log($('#source_invitation1').val());
            // console.log($('#source_billboard1').val());
            // console.log($('#source_magazine1').val());
            // console.log($('#source_activity1').val());
            // console.log($('#source_online1').val());
            // console.log($('#source_others1').val());

            $('#main_customer_info').show();
            $('#customer_survey').hide();

            $('#close_all').show();
            $('#cust_toreserve').show();
            $('#custSubmit').show();
            
         });

        $('#addnewcust').click(function() {
            $('#main_customer_info').hide();
            $('#customer_survey').show();

            $('#close_all').hide();
            $('#cust_toreserve').hide();
            $('#custSubmit').hide();

            $('#custidforedit').hide();
            $("#forexisting").hide();
            $("#fornew").show();
            $("#profilechange").show();
            $("#imageselect").hide();
            $("#custSubmitUpdate").hide();
            // $("#custSubmit").show();
            $("#partner_panel").hide();
            $("#custPartnerSave").hide();
            $("#work_portlet").show();
            // $('#cust_toreserve').show();
            $('#contact_portlet').show();
            $('#pdf_report').hide();
            $("#allsubmit").attr("action","marketing/saveCustomer");
            $("#userfile").attr('name','userfile');
            $("#customer_page_tittle").html("Customer Details");
            $('#cont_existing').hide();

            $("#addtype option[value='1']").attr('selected', true);
            $("#city option[value='998']").attr('selected', true);
            $("#province option[value='49']").attr('selected', true);
            $("#country option[value='175']").attr('selected', true);

            $("#select2-addtype-container").text('Home');
            $("#select2-city-container").text('Cagayan de Oro');
            $("#select2-province-container").text('Misamis Oriental');
            $("#select2-country-container").text('Philippines');

            $('#custFname').val('');
            $('#custLname').val('');
            $('#custMname').val('');
            $('#custGender').val('');
            $('#CustomerID').val('');
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
            $("#customer_page_tittle").html("Customer Details");

            //Hide tab li
            // $('[href="#tab_customer"]').closest('li').hide();
            // $('[href="#tab_cont"]').closest('li').hide();
            // $('[href="#tab_addr"]').closest('li').hide();
            // $('[href="#tab_instructions"]').closest('li').hide();
            $('[href="#tab_accounts"]').closest('li').hide();
            $('[href="#tab_old_acc"]').closest('li').hide();

            $('#tab_a').trigger('click');

            $('#instruct_next1').hide();
            $('#old_div').show();
        });

        
        // $('#cont_next').click(function() {
        //    $('#custSubmit').show();
        //    $('#custSubmitUpdate').show();
        //    $('#custPartnerSave').show();
        // });

        // $('#cont_back').click(function() {
        //    $('#custSubmit').hide();
        //    $('#custSubmitUpdate').hide();
        //    $('#custPartnerSave').hide();
        // });

        $('#editpic').click(function() {
            $("#profilechange").show();
            $("#imageselect").hide();
            $("#userfile").attr('name','userfile');
        });

        // $('#tblcustomerlists').on('dblclick', 'tbody tr', function () {
        //     var row = $(this).closest('tr')[0];
        //     var clientid = brokerlist.cell( row, 0 ).data();
        //     console.log('client_id -> ' + clientid);
        //     // alert(clientid);
        //     if (brokerlist.cell( row, 2 ).data() == 'individual') {
        //       $('#pdf_report').show();
        //       $('#cont_existing').show(); 
        //       $("#allsubmit").attr("action","marketing/modifyPerson");
        //       $("#customer_page_tittle").html("Customer Details");
        //       $('#instruct_next1').show();
        //       $('[href="#tab_accounts"]').closest('li').show();
        //       $('[href="#tab_old_acc"]').closest('li').show();
        //       $('#old_div').hide();
        //       $('#cust_toreserve').hide();

        //       $('#tab_a').trigger('click');
        //        $.ajax({
        //             type: "POST",
        //             url: "marketing/retrieveOnCustomer",
        //             dataType: 'json',
        //             data: {'clientid':clientid},
        //             success: function(data)
        //                      {
        //                       //populate textboxes
        //                       $('#custFname').val(data[0].firstname);
        //                       $('#custLname').val(data[0].lastname);
        //                       $('#custMname').val(data[0].middlename);
        //                       $('#custGender').val(data[0].sex);
        //                       $('#CustomerID').val(data[0].new_person_id);
        //                       $('#custContactNum').val("");
        //                       $('#custEmail').val("");
        //                       $('#birthdate').val(data[0].birthdate);
        //                       $('#custCivilStatus').val(data[0].civil_status_id);
        //                       $('#custPlaceOfBirth').val(data[0].birthplace);
        //                       $('#custFaxNumber').val("");
        //                       $('#custBusinessPhone').val("");
        //                       $('#custTIN').val(data[0].tin2);
        //                       $('#cust_occupation').val(data[0].occupation);
        //                       $('#cust_funds').val(data[0].source_of_funds);
        //                       $('#job_title').val(data[0].job_title);
        //                       $('#cust_income').val(data[0].monthly_gross_income);
        //                       $('#custNationality').val(data[0].nationality);
        //                       $('#comp_name').val(data[0].organization_name);
        //                       $("#customer_page_tittle").html("Customer Details");
        //                       $('#cust_org_id').val(data[0].organization_id);
        //                       $('#cust_work_id').val(data[0].customer_work_id);
        //                       $('#id_client').val(data[0].client_id);


        //                       var filename = '../public/images/profiles/default.png';
        //                       if (typeof data[0].picture_url != 'undefined' && data[0].picture_url != null && data[0].picture_url != "") {
        //                       filename = '../public/images/profiles/' + data[0].picture_url;
        //                       console.log(filename);
        //                       }
        //                       $('#profilepicture').attr('src', filename);
        //                       $("#userfile").attr('name','notuserprofile');
        //                        console.log(data[0].picture_url);
        //                       $('#custidforedit').show();
        //                       $("#forexisting").show();
        //                       $("#fornew").hide();
        //                       $("#custSubmitUpdate").show();
        //                       $("#custSubmit").hide();
        //                       $("#profilechange").hide();
        //                       $("#imageselect").show();
        //                       $("#partner_panel").show();
        //                       $("#custPartnerSave").hide();
        //                       $('#pdf_report').show();
                              
        //                       $('#main_customer_info').show();
        //                       $('#customer_survey').hide();

        //                       if(data.length > 0){
        //                            var ref = 0;
        //                            var add_ref = 0;
        //                            cust_contact.clear().draw();
        //                            $.each(data, function (index, value){
        //                                var cont_html = '<tr class="toRemove"><td>'+ data[index].contact_type_name +'</td><td>'+ data[index].contact_value +'</td><td><a href="" class="btn red cust_cont_remove"> remove</a></td></tr>';
        //                                // if (data[index].contact_type_name !== null && ref != data[index].contact_id) {
        //                                     // contacts_table.append(cont_html);
        //                                     cust_contact.row.add([
        //                                       data[index].contact_type_name,
        //                                       data[index].contact_value
        //                                     ]).draw(false);
        //                                // }
        //                                ref  = data[index].contact_id;
                                       
        //                            });
        //                             $.ajax({
        //                                 type: "POST",
        //                                 url: "marketing/get_address",
        //                                 dataType: 'json',
        //                                 data: {'clientid':clientid},
        //                                 success: function(data){
        //                                   var add_ref = 0;

        //                                   cust_address.clear().draw();
        //                                   $.each(data, function (index, value){
        //                                     add_ref = data[index].person_address_id;
        //                                     console.log(data[index].city_name);
        //                                     console.log(data[index].province_name);

        //                                     cust_address.row.add([
        //                                         data[index].address_type_name,
        //                                         data[index].line_3,
        //                                         data[index].line_2,
        //                                         data[index].line_1,
        //                                         data[index].city_name,
        //                                         data[index].province_name,
        //                                         data[index].country_name
        //                                     ]).draw(false);

        //                                   });
        //                                 }, 
        //                                 error: function(data){
        //                                    toastr.error('Failed to saved!.', 'Operation done');
        //                                    console.log( errorThrown );
        //                                 }
        //                             });
        //                       }else{
        //                         // address_addtbl.clear().draw();
        //                         cust_address.clear().draw();
        //                       }
        //                       $('#AddCustomer').modal('toggle');
        //                      },
        //             error: function (errorThrown)
        //                     {  
        //                       toastr.error('Failed to saved!.', 'Operation done');
        //                       console.log( errorThrown );
        //                     }  
        //            });
        //           $.ajax({
        //                 type: "POST",
        //                 url: "marketing/retrieveOnCustomerPartner",
        //                 dataType: 'json',
        //                 data: {'clientid':clientid},
        //                 success: function(data)
        //                          {
        //                           console.log(data);
        //                           if(data.length > 0){
        //                                customer_partner.clear().draw();
        //                                $.each(data, function (index, value){
        //                                   console.log(data[index].lastname);
        //                                   var partner_fullname = data[index].lastname + ", "+ data[index].firstname +" " + data[index].middlename;
        //                                   customer_partner.row.add( [
        //                                               data[index].customer_partner_id,
        //                                               partner_fullname,
        //                                               '09987126376',
        //                                               'sample@gmail.com',
        //                                               data[index].line_3 + " " + data[index].line_2 + ", " + data[index].line_1 + ", " + data[index].city_name + ", " + data[index].province_name + ", " + data[index].country_name,
        //                                                // '<a href="#" class="btn btn-danger delete" >remove</a>'
        //                                           ] ).draw( false );
        //                                });
        //                            } else{
        //                               customer_partner.clear().draw();
        //                            }
        //                          },
        //                 error: function (errorThrown)
        //                         {  
        //                           toastr.error('Failed to saved!.', 'Operation done');
        //                           console.log( errorThrown );
        //                         }  
        //              });
        //           tblcustamort.clear().draw();
        //           $.ajax({
        //             type: "POST",
        //             url: "marketing/retrieve_customers_amortization",
        //             dataType: 'json',
        //             data: {'clientid':clientid},
        //             success: function(data)
        //                     {
        //                       for (var i = 0; i < data.length; i++) {
        //                            tblcustamort.row.add( [
        //                                     data[i].contract_id,
        //                                     data[i].lot_description,
        //                                     data[i].contract_date,
        //                                     data[i].total_contract_price,
        //                                     '<a href="" class="btn green btn-xs contract_details"><i class="fa fa-eye" aria-hidden="true"></i> view</a>' 
        //                               ] ).draw( false );
        //                       }
        //                       console.log( data );
        //                     },
        //             error: function (errorThrown)
        //                     {  
        //                       toastr.error('Failed to process!.', 'Operation done');
        //                       console.log( errorThrown );
        //                     }  
        //           });

        //           // legacy_id - ID for post to controller. ajax below

        //           oldacc_table.clear().draw();
        //           $.ajax({
        //             type: "POST",
        //             url: "marketing/get_legacy_info",
        //             dataType: 'json',
        //             data: {'clientid':clientid},
        //             success: function(data){
        //                       console.log( data );
        //                       $.each(data, function (index, value){
        //                               oldacc_table.row.add([
        //                                 data[index].custid,
        //                                 data[index].custname,
        //                                 data[index].lotdesc,
        //                                 data[index].tcpamount,
        //                               ]).draw(false);
        //                      });
        //                     },
        //             error: function (errorThrown)
        //                     {  
        //                       toastr.error('Failed to process!.', 'Operation done');
        //                       console.log( errorThrown );
        //                     }  
        //           });



        //       }else{
        //           $('#cust_org_contlist').show();
        //           $('#btn_reserve_orgclient').hide();

        //           $('#add_custorg_modal').modal('toggle');
        //           $.ajax({
        //             type: "POST",
        //             url: "marketing/get_org_info",
        //             dataType: 'json',
        //             data: {'clientid':clientid},
        //             success: function(data){
        //                     $('#cust_org_name').val(data[0].organization_name);
        //                     $('#cust_org_lname').val(data[0].lastname);
        //                     $('#cust_org_fname').val(data[0].firstname);
        //                     $('#cust_org_mname').val(data[0].middlename);
        //                     $('#cust_org_gender').val(data[0].sex);
        //                     $('#cust_org_birthday').val(data[0].birthdate);
        //                     $('#cust_org_nationality').val(data[0].c);
        //                     $('#cust_org_birthplace').val(data[0].birthplace);
        //                     $('#cust_org_civil').val(data[0].civil_status_id);
        //                     $('#cust_org_tin').val(data[0].tin);
                            
        //                     //address
        //                     $('#cust_org_addtype').val(data[0].address_type_id); 
        //                     $('#cust_org_street').val(data[0].line_2);
        //                     $('#cust_org_barangay').val(data[0].line_1);
        //                     $('#cust_org_houseno').val(data[0].line_3);
        //                     $('#cust_org_city option:selected').val(data[0].city_id);
        //                     $('#cust_org_province option:selected').val(data[0].province_id);
        //                     $('#cust_org_country option:selected').val(data[0].country_id);


        //                     if (data.length < 0) {
        //                       $.each(data, function (index, value){
        //                           var cont_html = '<tr class="toRemove"><td>'+ data[index].contact_type_name +'</td><td>'+ data[index].contact_value +'</td><td><a href="" class="btn red cust_org_remove"> remove</a></td></tr>';
        //                           cust_org_contlist_table.row.add([
        //                             data[index].contact_type_name,
        //                             data[index].contact_value
        //                           ]).draw(false);
        //                            // ref  = data[index].contact_id; 
                                   
        //                        });



        //                     }

        //                     },
        //             error: function (errorThrown)
        //                     {  
        //                       toastr.error('Failed to process!.', 'Operation done');
        //                       console.log( errorThrown );
        //                     }  
        //           }); 


        //       }


        //  });
      $('#addressnew').click(function() {
        if ($("#addtype2 option:selected").val() == 0 || $("#street2").val() != '' || $("#barangay2").val() != '') {
          address_addtbl.row.add( [
             ".",
              "<input type='hidden' name='cust_addtype[]' value='"+ $("#addtype2 option:selected").val() +"'/>" + $("#select2-addtype2-container").text(),
              "<input type='hidden' name='cust_house[]' value='"+ $("#house_num2").val() +"'/>" + $("#house_num2").val(),
              "<input type='hidden' name='cust_street[]' value='"+ $("#street2").val() +"'/>" + $("#street2").val(),
              "<input type='hidden' name='cust_brgy[]' value='"+ $("#barangay2").val() +"'/>" + $("#barangay2").val(),
              // "<input type='hidden' name='cust_postal[]' value='"+ $("#brokerPostal").val() +"'/>" + $("#brokerPostal").val(),
              "<input type='hidden' name='cust_city[]' value='"+ $("#city2 option:selected").val() +"'/>" + $("#select2-city2-container").text(),
              "<input type='hidden' name='cust_prov[]' value='"+ $("#province2 option:selected").val() +"'/>" + $("#select2-province2-container").text(),
              "<input type='hidden' name='cust_country[]' value='"+ $("#country2 option:selected").val() +"'/>" + $("#select2-country2-container").text(),
              '<a href="#" class="btn btn-danger delete">remove</a>'
            ] ).draw(false);
        }
        //  console.log($("#barangay2").val()+"-->"+ $('#addtype2').find( "option:selected" ).text());
        //  var html = '<tr class="toRemove"><td>'+$("#addtype2 option:selected").text()+'</td><td>'+$("#house_num2").val()+'</td> <td>'+$("#street2").val()+'</td> <td>'+$("#barangay2").val()+'</td> <td>'+$("#city2 option:selected").text()+'</td> <td>'+$("#province2 option:selected").text()+'</td> <td>'+$("#country2 option:selected").text()+'</td>  <td><a href="#" class="btn btn-danger delete" >remove</a></td></tr>';
        //  table.append(html);
        //  var new_data = {
        //   'custid':$("#CustomerID").val(),
        //   'addid':$("#addtype2 option:selected").val(),
        //   'barangay':$("#barangay2").val(),
        //   'house_num2':$("#house_num2").val(), 
        //   'street2':$("#street2").val(), 
        //   'city':$("#city2 option:selected").val(),
        //   'province':$("#province2 option:selected").val(), 
        //   'country':$("#country2 option:selected").val()
        // };
        //   $.ajax({
        //             type: "POST",
        //             url: "marketing/addressSave",
        //             dataType: 'json',
        //             data: new_data,
        //             success: function(data)
        //                      {
        //                       toastr.info('Successfully saved!.', 'Operation done');
                              
        //                      },
        //             error: function (errorThrown)
        //                     {  
        //                       toastr.error('Failed to saved!.', 'Operation done');
        //                       console.log( errorThrown );
        //                     }  
        //            });
          
        });

         address_addtbl.on('click', '.delete', function (e) {
              e.preventDefault();
              var nRow = $(this).closest('.tffoRemove').remove();
         });


        $('#pdf_report').click(function(){
          var pid = $('#id_client').val();
          window.open(baseurl+"marketing/customer_pdf?personid=" + pid);
        });

        $('#pdf_amort_sched').click(function(){
          var id_contract = $('#id_contract').val();
          window.open(baseurl+"marketing/pdf_amortsched?id_contract=" + id_contract);
        });

        $('#pdf_resagreement').click(function(){
          var id_contract = $('#id_contract').val();
          window.open(baseurl+"marketing/reservationagreement_pdf?id_contract=" + id_contract);
        });

        contacts_table.on('click', '.cust_cont_remove', function (e) {
                e.preventDefault();
                var nRow = $(this).closest('.toRemove').remove();
           });

        // tblAmortdetails.on('click', '.edit_amort_details', function (e) {
        //    e.preventDefault();
        //    var row = $(this).closest('tr')[0];
        //    var amortid = tblAmortdetails.cell( row, 0 ).data();
        //    var bankname = tblAmortdetails.cell( row, 1 ).data();
        //    $('#det_id').val(amortid);
        //    $('#det_duedate').val(tblAmortdetails.cell( row, 2 ).data());
        //    $('#det_amort_amt').val(tblAmortdetails.cell( row, 3 ).data());
        //    // $('#det_misc').val(tblAmortdetails.cell( row, 4 ).data());
        //    $('#det_interest').val(tblAmortdetails.cell( row, 4 ).data());
        //    $('#det_principal').val(tblAmortdetails.cell( row, 5 ).data());
        //    $('#det_balance').val(tblAmortdetails.cell( row, 6 ).data());
        //    $('#detailed_edit').modal('toggle');
        // });

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
        var count_row = tbl_misc_details.rows().count();
        
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
              var misc_date = moment(date_misc).add(i-1, 'M').format("MMM DD, YYYY");
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


        // if (jQuery().datepicker) {
        //     $('#birthdate').datepicker({
        //         rtl: App.isRTL(),
        //         format: 'yyyy-mm-dd',
        //         orientation: "left",
        //         autoclose: true
        //     });
        // }

        // if (jQuery().datepicker) {
        //     $('#spouseBday').datepicker({
        //         rtl: App.isRTL(),
        //         format: 'yyyy-mm-dd',
        //         orientation: "left",
        //         autoclose: true
        //     });
        // }

        //  if (jQuery().datepicker) {
        //     $('#spousebirthday').datepicker({
        //         rtl: App.isRTL(),
        //         format: 'yyyy-mm-dd',
        //         orientation: "left",
        //         autoclose: true
        //     });
        // }

        //  $('#birthdate').keyup(function(){
        //      var v = this.value;
        //     if (v.match(/^\d{4}$/) !== null) {
        //         this.value = v + '-';
        //     } else if (v.match(/^\d{4}\-\d{2}$/) !== null) {
        //         this.value = v + '-';
        //     }
        // }); 

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
         tblcustamort.on('click', '.contract_details', function (e) {
               e.preventDefault();
               var row = $(this).closest('tr')[0];
               var contractdetailsid = tblcustamort.cell( row, 0 ).data();
               console.log("-->" + contractdetailsid);
               window.open(baseurl+"marketing/amortizationdetails?contractid="+contractdetailsid);
        });
        var IncrementCustID =  Number($('#getcustid').val()) + 1;
        //alert(IncrementCustID);
        // $("#CustomerID").val(IncrementCustID.toFixed(0));


        $('#cust_toreserve').click(function() {   
            $("#allsubmit").attr("action","marketing/saveCustomer");

        });

        $('#custSubmit').click(function() {   
            $("#allsubmit").attr("action","marketing/saveCustomer2");

            // var text = document.getElementById('subsidiary');
            // var v = $.trim(text.value)
            // var elems = $('#tablecustomerlist td').filter(function(){
            //  return $.trim($(this).text())===v
            // });
            // if (elems.length) {
            //     alert(text.value + ' Subsidiary Account Exist!');
            // }
            // var myRows = $("#tablecustomerlist tr:contains('"+ text.value +"')");
            // alert(myRows.length);
        });


        $("input[name='cust_client_type']").click(function() {
          if ($(this).val() == 'cust_person') {

          } else if ($(this).val() == 'cust_org') {

          } 
        });

        
  // ORGANIZATION
        $('#btn_save_orgclient').click(function(){
            $("#cust_org_allsubmit").attr("action","marketing/saveCustomer_org");

        });        

        $('#btn_reserve_orgclient').click(function(){
            $("#cust_org_allsubmit").attr("action","marketing/saveCustomer_org2");

        });


        $("#add_custorg_contact").click(function(){
          // var rowCount_contact = $('#cust_contacts_table tbody tr').length;
          if ($("#cust_org_cont_value").val() != "") {
              cust_org_contacts.row.add( [
                      "<input type='hidden' name='cust_org_cont_types[]' value='" + $("#cust_org_cont_type option:selected").val() + "'>" + $("#cust_org_cont_type option:selected").text(),
                      "<input type='hidden' name='cust_org_cont_values[]' value='" + $("#cust_org_cont_value").val() + "'>" + $("#cust_org_cont_value").val(),
                      '<a href="#" class="btn btn-danger cust_org_delete_contact">remove</a>'
                      ] ).draw( false );
              $("#cust_org_cont_value").val('');
          }else{
              toastr.options.timeOut = 500;
              toastr.error('Please Fill Contact Value.', 'Notice!');
          }
        });


        cust_org_contacts.on('click', '.cust_org_delete_contact', function(e){
          e.preventDefault();
          cust_org_contacts.row($(this).closest('tr')).remove().draw();
        });

        $('#addneworg').click(function(){
            $('#cust_org_contlist').hide();
            $('#btn_reserve_orgclient').show();

        });



  // END - ORGANIZATION

        $("#add_cust_contact").click(function(){
          // var rowCount_contact = $('#cust_contacts_table tbody tr').length;
          if ($("#cust_cont_value").val() != "") {
              cust_contacts_table.row.add( [
                      "<input type='hidden' name='cust_cont_types[]' value='" + $("#cust_cont_type option:selected").val() + "'>" + $("#cust_cont_type option:selected").text(),
                      "<input type='hidden' name='cust_cont_values[]' value='" + $("#cust_cont_value").val() + "'>" + $("#cust_cont_value").val(),
                      '<a href="#" class="btn btn-danger cust_delete_contact">remove</a>'
                      ] ).draw( false );
              $("#cust_cont_value").val('');
          }else{
              toastr.options.timeOut = 500;
              toastr.error('Please Fill Contact Value.', 'Notice!');
          }
        });


        cust_contacts_table.on('click', '.cust_delete_contact', function(e){
          e.preventDefault();
          cust_contacts_table.row($(this).closest('tr')).remove().draw();
        });



        // link for legacy database
        $('#old_cust_text').click(function(){
            var fname = $('#custFname').val();
            var lname = $('#custLname').val();
            if (lname != '' && fname != '') {
                $('#legacy_modal').modal('toggle');
                $.ajax({
                type: "POST",
                    url : baseurl + "marketing/get_legacycust",
                    dataType : "json",
                    data: {'fname' : fname, 'lname' : lname},
                    success : function(data){
                      legacy_table.clear().draw();
                      $.each(data, function (index, value){
                        legacy_table.row.add([
                            data[index].custid,
                            data[index].custname
                        ]).draw(false);
                      })
                    },  
                    error: function(errorThrown){
                        console.log(errorThrown);
                    }
                });
            }else{
                toastr.options.timeOut = 500;
                toastr.error('Fill names First', 'Notice!');
            }
        });
        
        $('#legacy_table tbody').on( 'click', 'tr', function () {
          $(this).toggleClass('selected');
        });

        $('#custTIN').keyup(function(){
          var tinRegex = /[^0-9\-]/gi;
          $(this).val($(this).val().replace(tinRegex, ""));
          // console.log($(this).val());
        }); 


        $('#select_oldcust').click(function(){
            var legacy_table_data = legacy_table.rows('.selected').data();
            var legacy_str = '';

            $('#old_cust_div').html('');
            $('#old_cust_text').val('');

            legacy_table_data.each(function (value, index) {
              // alert(legacy_table_data.cell( index, 1 ).data());
              legacy_str += legacy_table_data.cell( index, 1 ).data() + ', '
              $('#old_cust_div').append('<input type="text" name="old_cust_id[]" value="' + legacy_table_data.cell( index, 0 ).data() + '">');
            });
            
            // $('#legacy_modal').modal('toggle');
            $('#close_old').click();
            $('#old_cust_text').val(legacy_str);

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
    $("<style type='text/css'> .selected{ background:#acbad4;} </style>").appendTo("head");
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

// function blurFunction2() {
//     var custid = document.getElementById('customerid').value;
//     var str = document.getElementById('customername').value;
//     var res = str.substring(0, 3);
//     var afterComma = str.substr(str.indexOf(",") + 1);
//     var res2 = afterComma.substring(1, 4);
//     document.getElementById('subaccount').value = res.toUpperCase() + res2.toUpperCase();
//     document.getElementById('subaccount').value = res.toUpperCase() + res2.toUpperCase();

//     var text = document.getElementById('subaccount');
//     var v = $.trim(text.value);
//     var elems = $('#tablecustomerlist td').filter(function(){
//      return $.trim($(this).text())===v
//     });
//     if (elems.length) {
//         //alert(text.value + ' Subsidiary Account Exist!');
//     }
//     var myRows = $("#tablecustomerlist tr:contains('"+text.value+"')");
//     //alert(myRows.length);
//     var custidRows = $("#tablecustomerlist tr:contains('"+custid+"')");
//     //alert(custidRows.find('td:eq(1)').text());

//    if (myRows.length == '0')
//     {
//         var result = text.value;
//     }
//     else if ((myRows.length > '0') & (str == custidRows.find('td:eq(1)').text()))
//     {
//         var result = text.value;
//     }
//     else if ((myRows.length > '0') & (str !== custidRows.find('td:eq(1)').text()))
//     {
//         var result = text.value + myRows.length;
//     }

//     document.getElementById('subaccount').value = result;
// }

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
