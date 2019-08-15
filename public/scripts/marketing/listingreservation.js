var TableDatatablesEditable = function () {
   var getlotid,rowcount=0, rowcount_misc=0;
   //universal variables for saving data
   var tosave_lotid,is_vatable=0,univ_broker_id="",salesperson_id = 0,realtyid,univ_scheme_typeid, tax_rate;
   //end here.............
	 var listoflots = $('#listOfLots').DataTable({
            "bSort" : true,
            "aLengthMenu": [[10, 25, 100, -1], [10, 25, 100, "All"]],
            "iDisplayLength": 10,
            "fixedHeader": false,
             fixedHeader: {
                header: true,
            }
        });
   var listofcustomers = $('#customerlists').DataTable({
            "bSort" : true,
            "aLengthMenu": [[10, 25, 100, -1], [10, 25, 100, "All"]],
            "iDisplayLength": 10,
            "fixedHeader": false,
             fixedHeader: {
                header: true,
            }
        });
   var amortlistofcustomers = $('#amortcustomerlists').DataTable({
            "bSort" : true,
            "aLengthMenu": [[10, 25, 100, -1], [10, 25, 100, "All"]],
            "iDisplayLength": 10,
            "fixedHeader": false,
             fixedHeader: {
                header: true,
            }
        });
   var amortlistOfLots = $('#amortlistOfLots').DataTable({
            "bSort" : true,
            "aLengthMenu": [[10, 25, 100, -1], [10, 25, 100, "All"]],
            "iDisplayLength": 10,
            "fixedHeader": false,
             fixedHeader: {
                header: true,
            }
        });
   var amortbanklist = $('#amortbanklist').DataTable({
            "bSort" : true,
            "aLengthMenu": [[10, 25, 100, -1], [10, 25, 100, "All"]],
            "iDisplayLength": 10,
            "fixedHeader": false,
             fixedHeader: {
                header: true,
            }
        });
   var financing_list = $('#financing_list').DataTable({
            "bSort" : true,
            "aLengthMenu": [[10, 25, 100, -1], [10, 25, 100, "All"]],
            "iDisplayLength": 10,
            "fixedHeader": false,
             fixedHeader: {
                header: true,
            }
        });
   var tblbroker = $('#tblbroker').DataTable({
            "bSort" : true,
            "aLengthMenu": [[10, 25, 100, -1], [10, 25, 100, "All"]],
            "iDisplayLength": 10,
            "fixedHeader": false,
             fixedHeader: {
                header: true,
            }
            
        });  
     var tblAgent = $('#tblAgent').DataTable({
            "bSort" : true,
            "aLengthMenu": [[10, 25, 100, -1], [10, 25, 100, "All"]],
            "iDisplayLength": 10,
            "fixedHeader": false,
             fixedHeader: {
                header: true,
            }
            
        }); 
    var tblrealty = $('#tblrealty').DataTable({
            "bSort" : true,
            "aLengthMenu": [[10, 25, 100, -1], [10, 25, 100, "All"]],
            "iDisplayLength": 10,
            "fixedHeader": false,
             fixedHeader: {
                header: true,
            }
        });    
   var tbllistlotsForagreement = $('#tbl_listOfLots').DataTable();
   var tbladdagent = $('#tbladdagent').DataTable();
   
   $('#toggle_add').click(function() {
            if(univ_broker_id != ""){
              $('#addAgent').modal('toggle');
            }else{
              toastr.options.timeOut = 500;
              toastr.warning('Please Select Broker', 'Warning');
            }
    });
  tbladdagent.on('click', '.addAgent', function (e) {
           e.preventDefault();
           var row = $(this).closest('tr')[0];
           var agid = tbladdagent.cell( row, 0 ).data();
           var agName = tbladdagent.cell( row, 1 ).data();
           salesperson_id = agid;
           $('#toggle_addagent').val(agName);
           var agent_info = {'broker':univ_broker_id,'person':agid}
           $.ajax({
                        type: "POST",
                        url: baseurl+"marketing/add_agent",
                        dataType: 'json',
                        data: agent_info,
                        success: function(data)
                                 {
                                  toastr.options.timeOut = 500;
                                  toastr.info('Successfully Added', 'Operation done');
                                  console.log(data);
                                 },
                        error: function (errorThrown)
                                {  
                                  toastr.options.timeOut = 500;
                                  toastr.error('Failed to saved!.', 'Operation done');
                                  console.log( errorThrown );
                                }  
                       });
           $('#addAgent').modal('toggle');
           $('#AgentList').modal('toggle');
   });
   var tblAmort = $('#tblAmort').DataTable({
            "columnDefs" : [{
                "targets": [ 7 ],
                "visible": false,
                "searchable": false,
                },
                {
                  "targets": [ "_all" ],
                  "orderable" : false
                },
                {
                  className: "text-right", "targets": [3, 4, 5, 6]
                }
            ],
            // "columnDefs" : [{
            //     "targets": "_all",
            //     "orderable" : false,
            // }],
            
            "footerCallback": function ( tfoot, data, start, end, display ) {
                    var api = this.api(), data;
         
                    // Remove the formatting to get integer data for summation
                    var intVal = function ( i ) {
                        return typeof i === 'string' ?
                            i.replace(/[\$,]/g, '')*1 :
                            typeof i === 'number' ?
                                i : 0;
                    };
         
                    // Total over all pages
                    total = api
                        .column( 4 )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );
         
                    // Total over this page
                    pageTotal = api
                        .column( 4, { page: 'current'} )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );
         
                    // Update footer
                    $( api.column( 4 ).footer() ).html(
                        '$'+pageTotal +' ( $'+ total +' total)'
                    );
            }
        });
   var tbl_misc = $('#tbl_misc').DataTable({
            // "columnDefs" : [{
            //     "targets": [ 7 ],
            //     "visible": false,
            //     "searchable": false
            // }],
            "footerCallback": function ( tfoot, data, start, end, display ) {
                    var api = this.api(), data;
         
                    // Remove the formatting to get integer data for summation
                    var intVal = function ( i ) {
                        return typeof i === 'string' ?
                            i.replace(/[\$,]/g, '')*1 :
                            typeof i === 'number' ?
                                i : 0;
                    };
         
                    // Total over all pages
                    total = api
                        .column( 4 )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );
         
                    // Total over this page
                    pageTotal = api
                        .column( 4, { page: 'current'} )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );
         
                    // Update footer
                    $( api.column( 4 ).footer() ).html(
                        '$'+pageTotal +' ( $'+ total +' total)'
                    );
            }
        });
    tosave_lotid = $('#amort_lot_id').val();
    
    tblAmort.on( 'order.dt search.dt', function () {
        tblAmort.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();
    listoflots.on('click', '.reservelots', function (e) {
          e.preventDefault();
           var row = $(this).closest('tr')[0];
           var lotid = listoflots.cell( row, 0 ).data();
           var ses_client = $('#ses_client').val();

           console.log("-->" + lotid + ' ses---> ' + ses_client);
           getlotid = lotid;
           
          if ($('#ses_client').val() == '' || $('#ses_client').val() == null || $('#ses_client').val() == 0) {
            // console.log("-->" + clientid);
            getlotid = lotid;
            $('#showcustomer').modal('toggle');
          }else {
            $(location).attr("href",baseurl+"marketing/reservationAgreement?clientid="+ ses_client +"&lotid="+ getlotid);
          }

   });
   amortlistOfLots.on('click', '.Lot_edit', function (e) {
          e.preventDefault();
           var row = $(this).closest('tr')[0];
           var lotid = amortlistOfLots.cell( row, 0 ).data();
           console.log("-->" + lotid);
           tosave_lotid = lotid;
           $(location).attr("href",baseurl+"marketing/reservationAgreement?clientid="+$('#amortcustid').val()+"&lotid="+lotid);
   });
    amortbanklist.on('click', '.banklist', function (e) {
           e.preventDefault();
           var row = $(this).closest('tr')[0];
           var bankid = amortbanklist.cell( row, 0 ).data();
           var bankname = amortbanklist.cell( row, 1 ).data();
           $('#bankdesc').html(bankname);
           $('#id_bank').val(bankid);
           $('#bankFinancing').modal('toggle');
   });
    financing_list.on('click', '.financelist', function (e) {
           e.preventDefault();
           var row = $(this).closest('tr')[0];
           var financing = financing_list.cell( row, 0 ).data();
           var bankname = financing_list.cell( row, 1 ).data();
           $('#finance_desc').html(bankname);
           $('#id_financing').val(financing);
           $('#financing_types').modal('toggle');

           if(bankname.toLowerCase() == 'bank' ) {
              $('#bank_portlet').show();
           }else{
              $('#bank_portlet').hide();
           }
   });


	  $('.morelostdetails').click(function() {
           var row = $(this).closest('tr')[0];
           var lotid = listoflots.cell( row, 0 ).data();
           console.log("-->" + lotid);
            $('#viewSelectedLot').modal('toggle');
    });


    tblbroker.on('click', '.brokerlist', function (e) {
           e.preventDefault();
           var row = $(this).closest('tr')[0];
           var broker_id = tblbroker.cell( row, 0 ).data();
           var agentName = tblbroker.cell( row, 1 ).data();
           univ_broker_id = broker_id;
            $.ajax({
                    type: "POST",
                    url: baseurl+"marketing/get_salesperson",
                    dataType: 'json',
                    data: {'broker_id':broker_id},
                    success: function(data){
                          toastr.options.timeOut = 500;
                          toastr.info('Successfully Retrieve ' + data.length + ' Record/s.', 'Operation done');

                          console.log(data);
                          tblAgent.clear().draw();
                          for (var i = 0; i < data.length; i++) {
                          tblAgent.row.add( [
                                    data[i].salesperson_id,
                                    data[i].salesperson_name,
                                    '<a href="" class="btn green btn-xs agentlist"><i class="fa fa-check-square-o" aria-hidden="true"></i> Select</a>' 
                              ] ).draw( false );
                          }
                    },
                    error: function (errorThrown)
                            {  
                              toastr.options.timeOut = 500;
                              toastr.error('Failed to saved!.', 'Operation done');
                              console.log( errorThrown );
                            }  
                   });
           $('#toggle_broker').val(agentName); 
           $('#BrokerList').modal('toggle');
   });

    tblAgent.on('click', 'tbody tr', function (e) {
           e.preventDefault();
           var row = $(this).closest('tr')[0];
           var agid = tblAgent.cell( row, 0 ).data();
           var agName = tblAgent.cell( row, 1 ).data();
           salesperson_id = agid;
           console.log(agName);
           $('#toggle_addagent').val(agName); 
           $('#AgentList').modal('toggle');
    });

     tblrealty.on('click', '.realtylist', function (e) {
           e.preventDefault();
           var row = $(this).closest('tr')[0];
           var relid = tblrealty.cell( row, 0 ).data();
           var relName = tblrealty.cell( row, 1 ).data();
           realtyid = relid;
           //ajax for brokers
            $.ajax({
                  type: "POST",
                  url: baseurl+"marketing/get_broker_realty",
                  dataType: 'json',
                  data: {'realtyid':relid},
                  success: function(data){
                        toastr.options.timeOut = 500;
                        toastr.info('Successfully Retrieve ' + data.length + ' Record/s.', 'Operation done');
                        console.log(data);
                          tblbroker.clear().draw();
                          for (var i = 0; i < data.length; i++) {
                          tblbroker.row.add( [
                                    data[i].broker_id,
                                    data[i].lastname + " ," + data[i].firstname + " " + data[i].middlename,
                                    '<a href="" class="btn green btn-xs brokerlist"><i class="fa fa-check-square-o" aria-hidden="true"></i> Select</a>' 
                              ] ).draw( false );
                          }
                       },
                  error: function (errorThrown){  
                        toastr.options.timeOut = 500;
                        toastr.error('Failed to saved!.', 'Operation done');
                        console.log( errorThrown );
                      }
                 });
           // end
           $('#toggle_realty').val(relName);
           $('#realtyList').modal('toggle');
    });

    listofcustomers.on('click', '.custlist', function (e) {
           e.preventDefault();
           var row = $(this).closest('tr')[0];
           var clientid = listofcustomers.cell( row, 0 ).data();
           console.log("-->" + clientid);
           $(location).attr("href",baseurl+"marketing/reservationAgreement?clientid="+clientid+"&lotid="+getlotid);
           $('#lot_list').modal('toggle');
    });
    amortlistofcustomers.on('click', '.custlist', function (e) {
           e.preventDefault();
           var row = $(this).closest('tr')[0];
           var clientid = amortlistofcustomers.cell( row, 0 ).data();
           var clientname = amortlistofcustomers.cell( row, 1 ).data();
           console.log("-->" + clientid);
           console.log("-->" + clientname);
           $('#amortcustname').html(clientname); 
           $('#amortcustid').val(clientid); 
           $('#ReserveAgreementCustList').modal('toggle'); 

    });
    $('#toggle_cust').click(function() {
        $('#ReserveAgreementCustList').modal('toggle');
    });
    $('#toggle_broker').click(function() {
        $('#BrokerList').modal('toggle');
    });
    $('#toggle_addagent').click(function() {
        $('#AgentList').modal('toggle');
    });
    $('#toggle_realty').click(function() {
        $('#realtyList').modal('toggle');
    });
     $('#lotdetails').click(function() {
        $('#lot_list').modal('toggle');
    });  
    $('#toggle_bank').click(function() {
        $('#bankFinancing').modal('toggle');
    });  
    $('#toggle_financing').click(function() {
        $('#financing_types').modal('toggle');
    });
    $('#addnewagent').click(function() {
        $('#AddnewAgent').modal('toggle');
    });  
     
    $("input[name='optionsRadios']").click(function() {
    if ($(this).val() == 'option1') {
      $('#dcTcp').val(0); $('#dcTerms').val(0); $('#dcInterest').val(0); $('#dcDiscount').val(0); $('#dcSurcharge').val(3); $('#balTerms').val(0);
      $('#balTcp').val(0);$('#balInterest').val(0);$('#balSurcharge').val(3);$('#balDescription').val(0);$('#dcDescription').val('');
      $('#percentTcp').html('0.00'); $('#perCentDiscount').html('0.00'); $('#balPercentTcp').html('0.00'); $('#balMiscellaneous').html('0.00');
      $('#totalFeesfordp').html('0.00'); $('#totalFees').html('0.00'); $('#accountDicount').val('');
      $("#schemeList").hide();
      $("#schemeDesc").hide();
      $('#dcTcp').attr('readonly', false);
      $('#dcTerms').attr('readonly', false);
      $('#dcInterest').attr('readonly', false);
      $('#dcDiscount').attr('readonly', false);
      $('#dcSurcharge').attr('readonly', false);
      $('#balTerms').attr('readonly', false);
      $('#balInterest').attr('readonly', false);
      $('#balSurcharge').attr('readonly', false);
      // $('#fixed_discount').attr('disabled', false);  

    } else if ($(this).val() == 'option2') {
      $('#dcTcp').val(0); $('#dcTerms').val(0); $('#dcInterest').val(0); $('#dcDiscount').val(0); $('#dcSurcharge').val(3); $('#balTerms').val(0);
      $('#balTcp').val(0);$('#balInterest').val(0);$('#balSurcharge').val(3);$('#balDescription').val('');$('#dcDescription').val(''); $('#accountDicount').val('');
      $("#schemeList").show();
      $("#schemeDesc").show(); 
      $('#dcTcp').attr('readonly', true);
      $('#dcTerms').attr('readonly', true);
      $('#dcInterest').attr('readonly', true);
      $('#dcDiscount').attr('readonly', true);
      $('#dcSurcharge').attr('readonly', true);
      $('#balTerms').attr('readonly', true);
      $('#balInterest').attr('readonly', true);
      $('#balSurcharge').attr('readonly', true);
      $('#fixed_discount').attr('readonly', true);  
    } 
   });
   // js_Scheme changer 
   $( "#scheme" ).change(function() {
       univ_scheme_typeid = $(this).val();
       $.ajax({ 
              type: "POST",
              url: baseurl+'marketing/retrieveOneSchemeType',
              dataType: 'json',
              data: {'schemeid':$(this).val()},
              success: function(data){
                  //toastr.info('Successfully saved!.', 'Operation done');
                  var fulldcDescription = data[0].payment_scheme_desc;
                  $("#schemeDescription").val(fulldcDescription); 
                  $('#dcTcp').val(data[0].deposit_rate);
                  $('#dcTcp').blur();
                  $('#dcTerms').val(data[0].terms);
                  $('#dcTerms').blur();
                  $('#dcInterest').val(data[0].interest_rate);
                  $('#dcInterest').blur();
                  $('#dcDiscount').val(data[0].discount_rate);
                  $('#dcDiscount').blur();
                  $('#dcSurcharge').val(data[0].surcharge_rate);
                  $('#balTerms').val(data[0].amortization_terms);
                  $('#balTerms').blur();
                  $('#lotreserveFee').val(data[0].reservation_fee);
                  $('#lotreserveFee').blur();
                  $('#balInterest').val(data[0].amortization_interest_rate);
                  $('#balSurcharge').val(data[0].amortization_surcharge_rate);
                  $('#balInterest').blur();
                  $('#fixed_discount').attr('disabled', true);
                  console.log( data );
              },
              error: function (errorThrown){  
                  toastr.options.timeOut = 500;
                  toastr.error('Failed to saved!.', 'Operation done');
                  console.log( errorThrown );
              }
      });
        
   });

   $( "#all_project" ).change(function() {
      if ($(this).val() == 0) {
        $.ajax({ 
              type: "POST",
              url: baseurl+'marketing/getAllAvailableLot',
              dataType: 'json',
              data: {'projectid':$(this).val()},
              success: function(data)
                       {
                        //toastr.info('Successfully saved!.', 'Operation done');
                        listoflots.clear().draw();
                       for (var i = 0; i < data.length; i++) {
                             listoflots.row.add( [
                                            data[i].lot_id,
                                            data[i].lot_description,
                                            data[i].lot_area,
                                            jFormatNumber(data[i].price_per_sqr_meter),
                                            jFormatNumber(data[i].house_price),
                                            data[i].lot_vat,
                                            jFormatNumber(data[i].lot_price),
                                            '<button  class="btn green btn-xs reservelots"><i class="fa fa-check-square-o" aria-hidden="true"></i> Reserve</button>' 
                                      ] ).draw( false );
                        }
                        console.log(data);
                       },
              error: function (errorThrown)
                      {  
                        toastr.error('Failed to saved!.', 'Operation done');
                        console.log( errorThrown );
                      }  
        });
      }else{
        $.ajax({ 
              type: "POST",
              url: baseurl+'marketing/get_project_byids',
              dataType: 'json',
              data: {'projectid':$(this).val()},
              success: function(data)
                       {
                        //toastr.info('Successfully saved!.', 'Operation done');
                        listoflots.clear().draw();
                       for (var i = 0; i < data.length; i++) {
                             listoflots.row.add( [
                                            data[i].lot_id,
                                            data[i].lot_description,
                                            data[i].lot_area,
                                            jFormatNumber(data[i].price_per_sqr_meter),
                                            jFormatNumber(data[i].house_price),
                                            data[i].lot_vat,
                                            jFormatNumber(data[i].lot_price),
                                            '<button  class="btn green btn-xs reservelots"><i class="fa fa-check-square-o" aria-hidden="true"></i> Reserve</button>' 
                                      ] ).draw( false );
                        }
                        console.log(data);
                       },
              error: function (errorThrown)
                      {  
                        toastr.error('Failed to saved!.', 'Operation done');
                        console.log( errorThrown );
                      }  
        });
      }
   });
   $('#vatYes').click(function() {
      if($('#vatYes').is(':checked')){
           $("#taxtype").show(); 
        }else{
           $("#taxtype").hide(); 
        }
   });
    
    // Savin part calculations
    var dcTcp=0;
    var dcTerms=0;
    var dcInterest=0;
    var dcDiscount=0;
    var dcSurcharge=0;
    var dcDescription="";
    var balTcp =0;
    var tcpdowns;
    var lotreserveFee=0;
    var discount=0;
    var balMiscellaneous=0;
    $("#chkmiscfee").click( function(){
        if($(this).is(':checked') ){
          var misc_percent = $('#misc_percent').val();
          // balMiscellaneous = (misc_percent/100) * ($('#originalTcp').val());
          balMiscellaneous = misc_percent;

          $('#dcTcp').blur();
          $('#lotreserveFee').blur();
          $('#misc_data').show();
          $('#misc_term').val('');
          // $('#balance_tcp, #downpayment_port').removeClass('col-md-6');
          // $('#balance_tcp, #downpayment_port').addClass('col-md-4');
        }else{
          balMiscellaneous=0;
          $('#dcTcp').blur();
          $('#lotreserveFee').blur();
          $('#misc_data').hide();
          // $('#balance_tcp, #downpayment_port').removeClass('col-md-4');
          // $('#balance_tcp, #downpayment_port').addClass('col-md-6');
        };
    });
    $('#misc_percent').blur(function(){
        var misc_percent = $('#misc_percent').val();
        // balMiscellaneous = (misc_percent/100) * ($('#originalTcp').val());
        balMiscellaneous = misc_percent;
    });

    $('#dcTcp').blur(function(){
      $('#lotreserveFee').blur();
    });

    $(function() {
      $('#dcTcp').on('blur' , function() {
            if($('#dcTcp').val() != dcTcp){
                dcTcp = $('#dcTcp').val();
                dcDescription = dcTcp + "% TCP in " + dcTerms + " months @ " + dcInterest + "% Interest Fee With " + dcDiscount +"% Discount And "+ dcSurcharge + "% Surcharge";
              balTcp = (100 - parseInt(dcTcp));
              $('#balTcp').val(balTcp);
             }
             $('#dcDescription').val(dcDescription);
             $('.dpPercentBal').html(dcTcp);
             $('#percentTcp').html(jFormatNumber(twoDecimal(($('#dcTcp').val()/100) * ($('#originalTcp').val()))));
             //balance...........
             var balancetcp = (balTcp/100) * ($('#originalTcp').val());
             $('#balMiscellaneous').html(jFormatNumber(twoDecimal(balMiscellaneous)));  
             
             if ($(this).val() != '' || $(this).val() != 0) {
                 $('.balpercentBal').html(balTcp);
                 $('#fixed_discount').attr('disabled', false);     
                 $('#balPercentTcp').html(jFormatNumber(twoDecimal(balancetcp)));
                 $('#totalFees').html(jFormatNumber(twoDecimal(balMiscellaneous) + twoDecimal(balancetcp)));
             }
      });
    });
    $(function() {
      $('#dcTerms').on('blur' , function() {
           if($('#dcTerms').val() != dcTerms){
                dcTerms = $('#dcTerms').val();
                dcDescription = dcTcp + "% TCP in " + dcTerms + " months @ " + dcInterest + "% Interest Fee With " + dcDiscount +"% Discount And "+ dcSurcharge + "% Surcharge";
                var ORigLessReserveFee = $('#originalTcp').val();

                tcpdowns = ((($('#dcTcp').val()/100) * ORigLessReserveFee) - (parseFloat(discount))) -  $('#lotreserveFee').val();
                var withTerms=0;
                 if($('#dcTerms').val()!="" && $('#dcTerms').val() > 0){
                     withTerms = tcpdowns/$('#dcTerms').val();
                     console.log('if dcTerms--->'+withTerms);
                  }else{
                     withTerms = tcpdowns;
                     console.log('else dcTerms--->'+withTerms);
                  }
                $('#desiredAmount').val(twoDecimal(withTerms));
                $('#depAmount').val(twoDecimal(withTerms));
             }
             $('#dcDescription').val(dcDescription);
      });
    });
    $(function() {
      $('#dcInterest').on('blur' , function() {
          if($('#dcInterest').val() != dcInterest){
            dcInterest = $('#dcInterest').val();
            dcDescription = dcTcp + "% TCP in " + dcTerms + " months @ " + dcInterest + "% Interest Fee With " + dcDiscount +"% Discount And "+ $('#dcSurcharge').val() + "% Surcharge";
          }else{
            dcDescription = dcTcp + "% TCP in " + dcTerms + " months @ 0% Interest Fee With " + dcDiscount +"% Discount And "+ $('#dcSurcharge').val() + "% Surcharge";
          }
          $('#dcDescription').val(dcDescription);
      });
    });
    $(function() {
      $('#dcDiscount').on('blur' , function() {
            var dpPercent = $('#dcTcp').val() / 100;
            var discountPercent = $('#dcDiscount').val() / 100;
            var lotReserve = $('#lotreserveFee').val();
            dcDiscount = $('#dcDiscount').val();
            var dpAmount = $('#originalTcp').val() * dpPercent;
            var dpDiscount =  dpAmount * discountPercent;
            var totalDp = (dpAmount - dpDiscount) - lotReserve;
            dcDescription = dcDescription = dcTcp + "% TCP in " + dcTerms + " months @ " + dcInterest + "% Interest Fee With " + dcDiscount +"% Discount And "+ dcSurcharge+ "% Surcharge";


            console.log("down     : " + dpAmount);
            console.log("disc     : " + dpDiscount);
            console.log("reserve  : " + lotReserve);
            console.log("total    : " + totalDp);


            if(lotReserve != 0 || lotReserve != '') {
              $('#FeesforReserve').html(jFormatNumber(twoDecimal(parseFloat(lotReserve))));
            }
            // accountDicount
            $('#accountDicount').val('0');
            $('#accountDicount').val(twoDecimal(parseFloat(dpDiscount)));
            // perCentDiscount
            $('#perCentDiscount').html(jFormatNumber(twoDecimal(parseFloat(dpDiscount))));
            // totalFeesfordp
            $('#totalFeesfordp').html(jFormatNumber(twoDecimal(parseFloat(totalDp))));

            $('#dcDescription').val(dcDescription);
           
             
      });

    });

    $(function() {
          $('#fixed_discount').on('blur' , function() {
            var dpPercent = $('#dcTcp').val() / 100;
            var dp = $('#originalTcp').val() * dpPercent;
            var fixedDiscount = $('#fixed_discount').val();
            var percentage = (fixedDiscount / dp) * 100;

            $('#dcDiscount').val(percentage);
            $('#dcDiscount').blur();

            // $('#accountDicount').val(twoDecimal(parseFloat(fixedDiscount)));
             // $('#dcDiscount').val('0');
          });
      });


    $(function() {
      $('#dcSurcharge').on('blur' , function() {
          if($('#dcSurcharge').val() != dcSurcharge){
            dcSurcharge = $('#dcSurcharge').val();
            dcDescription = dcTcp + "% TCP in " + dcTerms + " months @ " + dcInterest + "% Interest Fee With " + dcDiscount +"% Discount And "+ dcSurcharge+ "% Surcharge";
          }
          $('#dcDescription').val(dcDescription);

          if($('#balSurcharge').val() != balSurcharge){
            balSurcharge = $('#balSurcharge').val();
            balDescription = balTcp + "% TCP in " + balTerms + " months @ " + balInterest + "% Interest Fee And "+ balSurcharge+ "% Surcharge";
          }
          $('#balDescription').val(balDescription);
      });
    });
 
 //Balance TCP Computation.................. 
   $(function() {
      $('#depAmount').on('blur' , function() {
           if($('#depAmount').val() != $('#desiredAmount').val() && $('#depAmount').val() < $('#desiredAmount').val()){
                var data = $('#desiredAmount').val() - $('#depAmount').val();
                $("#amt").html(data);
                $("#remain").show();
             }else{
                $("#remain").hide();
             }   
      });
    });
var balTcp = (100 - dcTcp);
var balTerms="";
var balInterest="";
var balSurcharge="";
var balDescription="";
 $(function() {
      $('#balTerms').on('blur' , function() {
           if($('#balTerms').val() != balTerms){
                balTerms = $('#balTerms').val();
                balDescription = balTcp + "% TCP in " + balTerms + " months @ " + balInterest + "% Interest Fee And "+ balSurcharge+ "% Surcharge";
             }
             $('#balDescription').val(balDescription);
             $('.dpPercentBal').html(dcTcp);

      });
    });
 $(function() {
      $('#balInterest').on('blur' , function() {
           if($('#balInterest').val() != balInterest){
                balInterest = $('#balInterest').val();
                balDescription = balTcp + "% TCP in " + balTerms + " months @ " + balInterest + "% Interest Fee And "+ balSurcharge+ "% Surcharge";
             }else{
                balDescription = balTcp + "% TCP in " + balTerms + " months @ 0% Interest Fee And "+ balSurcharge+ "% Surcharge";
             }
             $('#balDescription').val(balDescription);
      });
    });
 $(function() {
      $('#balSurcharge').on('blur' , function() {
           if($('#balSurcharge').val() != balSurcharge){
                balSurcharge = $('#balSurcharge').val();
                balDescription = balTcp + "% TCP in " + balTerms + " months @ " + balInterest + "% Interest Fee And "+ balSurcharge+ "% Surcharge";
             }
             $('#balDescription').val(balDescription);
      });
    });
 $(function() {
      $('#lotreserveFee').on('blur' , function() { 
              $('#dcTerms').blur();
              $('#dcDiscount').blur(); 
              $('#balInterest').blur(); 
              $('#balTerms').blur(); 
              $('#balSurcharge').blur();
              $('#dcSurcharge').blur(); 
              $('#dcInterest').blur(); 
              $('#dcDiscount').blur(); 

      });
    });

//Amortizationsss....................
//interest = balance * interest rate / 12 months in one year
//principal = interest * Amort amount
//amortization =  (interst rate/12(terms-pastmonths)-balance)
//balance = balance - principal
var TcpOrig;
var terms;
var intRateuniv;
var interest;
var loanAmount = 750000;
var oldBalance=loanAmount;
var newBalance=loanAmount;  
var starting = 10000; 
var principal = 750000 - starting;
var amortAmount;
var owedInterest=0;
var totalInterestPd=0;
var tagNam;
var totalAllAmortizations;
var totalAllInterest;
var totalAllPrincipal;
var balAmort;
// totalamount * ()/    (5 years * 12 )  
$('#cumputeAmort').click(function() {
     //  && $('#id_bank').val() != 0

   if($('#balTerms').val()!="" &&  $('#depAmount').val()!="" && $('#depoDate').val()!="" && $('#amortDate').val()!=""){
        tblAmort.clear().draw();
        tbl_misc.clear().draw();
        rowcount=0;
        var downint = $('#dcInterest').val();
        var dtdown = moment($('#depoDate').val());
        var miscTerms = $('#misc_term').val();
        var miscDate = $('#misc_date').val();
        var termsForDp = $('#dcTerms').val();
        var termsForAmort = termsForDp;
        
        //Terms Validation.........................................................................................
        var dpMiscellaneous=0;
        if($('#dcTcp').val() =="100" || $('#dcTcp').val() == 100){
           dpMiscellaneous = balMiscellaneous;
        }
        console.log(dpMiscellaneous);
        //Downpayment................................START........................................L\\\\\\\\\\\\\\\\\\
        var dpAmountEntered;
        var olDbal_running = (parseFloat($('#originalTcp').val()));
        // this is the orig by tibong - var olDbal_running = (parseFloat($('#originalTcp').val()) + parseFloat(balMiscellaneous));
        //for Downpayment only.......
        var withDiscount = (($('#dcTcp').val()/100) * ($('#originalTcp').val())) - $('#accountDicount').val();
        // var newExcess =  $('#desiredAmount').val() - $('#depAmount').val();

        var run_balance = withDiscount;

        var dpLessReserve = (olDbal_running * ($('#dcTcp').val()/100)) - $('#lotreserveFee').val();
        var dpLessDiscount = dpLessReserve - $('#accountDicount').val();


        if (downint == '' || downint < 1 || downint == 0){
          var dpMonthly = dpLessDiscount / termsForDp;
          
        }else{
          var dpMonthly = calcMonthly(dpLessDiscount, termsForDp, downint);
        }


        
        //for the Run balance Universal
        var DpOlbalWithLessRservatiopnFee = olDbal_running - $('#lotreserveFee').val();
        var DpOlbalRunning_WithDiscount = DpOlbalWithLessRservatiopnFee - $('#accountDicount').val();
        var DpOlbalRunning = DpOlbalRunning_WithDiscount;
        var remainingAmt;


        var d = moment($('#amortDate').val());
        
        //populate table in Deposit and Discount..........
            populateTable("Less:Reservation",moment(dtdown).format("MMM DD, YYYY"),$('#lotreserveFee').val(), '0.00',$('#lotreserveFee').val(),twoDecimal(DpOlbalWithLessRservatiopnFee), 2);
         
          
            populateTable("Discount", moment(dtdown).format("MMM DD, YYYY"),$('#accountDicount').val(), '0.00',$('#accountDicount').val(),twoDecimal(DpOlbalRunning_WithDiscount), 1);
        
        // populateTable("Deposit",moment(dtdown).format("MMM DD, YYYY"),twoDecimal(parseFloat($('#depAmount').val())), '0.00',twoDecimal(parseFloat($('#depAmount').val())),twoDecimal(DpOlbalRunning), 3);
       
        // dpAmountEntered = DpOlbalRunning / termsForDp;
        remainingAmt = amortizeDownPayments(DpOlbalRunning,downint,termsForAmort,dpMonthly, d + 1,'DP',1,0,0);
        //validate if the downpayment is less than or whatever also the checkbox validations

        //populate table for downpaymnets days..........
        
        //Downpayment................................END........................................dpAmountEntered originally dre sa babaw
        //Amortization................................START........................................Lane// Do Not Touch
        // TcpOrig = ($('#balTcp').val()/100) * ($('#originalTcp').val());
        if($('#balInterest').val()!=""){intRateuniv = parseInt($('#balInterest').val());}else{intRateuniv = 0;}
        if($('#balTerms').val()!="" || $('#balTerms').val() != 0){ terms = $('#balTerms').val();}else{terms = 1;}

        console.log('----->'+remainingAmt);
        console.log('----->'+intRateuniv);
        console.log('----->'+terms);
        var last_date;
        // if (termsForDp > 1) {
          last_date = moment(d).add(termsForDp, 'M');
        // }else{
        //   last_date = moment(d);
        // }
        balAmort = calcMonthly(parseFloat(remainingAmt), terms, intRateuniv);
        amortizeDownPayments(remainingAmt ,intRateuniv, terms, calcMonthly(parseFloat(remainingAmt), terms, intRateuniv), last_date, 'A', 2,0,0);
        //Amortization..................................END......................................Lane// Do Not Touch
        var sumAmort=0;
        var sumInterest=0;
        var sumPrincipal=0;
        tblAmort.column(3).data().each( function ( value, index ) {
          sumAmort = parseFloat(sumAmort) + parseFloat(value);
        });
          tblAmort.column(5).data().each( function ( value, index ) {
          sumInterest = parseFloat(sumInterest) + parseFloat(value);
        });
          tblAmort.column(6).data().each( function ( value, index ) {
          sumPrincipal = parseFloat(sumPrincipal) + parseFloat(value);
        });

          
        $('#totalAmort').html(twoDecimal(sumAmort));
        $('#totalInterest').html(twoDecimal(sumInterest));
        $('#totalPrincipal').html(twoDecimal(sumPrincipal));
        $('#totalMiscfee').html(twoDecimal(balMiscellaneous));

        var rbalance_misc = balMiscellaneous;
        var misc_monthly = balMiscellaneous / miscTerms; 
        if (miscDate != null && miscTerms != null) {
          if($("#chkmiscfee").is(':checked')){
              for (i=1; i <= miscTerms; i++) {
                var date_misc = moment(miscDate).add(i - 1, 'M').format("MMM DD, YYYY");
                rbalance_misc = rbalance_misc - misc_monthly; 
                populateTableMisc(i, "M000" + i.toString(), date_misc, twoDecimal(misc_monthly), 0.00, rbalance_misc);
              }
          }
        }

        // FOR TOTAL
        // if (rowcount > 1) {
        //   for (var i = 0; i < rowcount; i++) {
        //     var amort_amount =+ jFormatNumberRet(tblAmort.cell( i, 3 ).data());
        //     var interest_amount =+ jFormatNumberRet(tblAmort.cell( i, 4 ).data());
        //     var principal_amount =+ jFormatNumberRet(tblAmort.cell( i, 5 ).data());
        //     $('#foot_totals').html('<tr><td></td><td> </td><td> </td><td align="right">'+ amort_amount +'</td><td align="right">'+ interest_amount +'</td><td align="right">'+ principal_amount +'</td><td> </td></tr>');
        //   }
        // }



    }else{
       toastr.options.timeOut = 500;
       toastr.error('Please Fill Required Fields', 'Notice!');
    }
});
function calcMonthly(principal,numPay,intRate) {
  var monthly;
  var intRate=(intRate/100)/12;
  var principal;
  // The accounting formula to calculate the monthly payment is
  //    M = P * ((I + 1)^N) * I / (((I + 1)^N)-1)
  // The following code  transforms this accounting formula into JavaScript to calculate the monthly payment
  if(intRate!="" && intRate > 0){
  monthly=(principal*(Math.pow((1+intRate),numPay))*intRate/(Math.pow((1+intRate),numPay)-1));

  }else{
    monthly=(principal/numPay);
  }
  console.log("monthly->"+monthly);
  return monthly;
}

function amortizeDownPayments(loanAmount,intRate,numPay,monPmt,dt,str,identity, recalc, numLine) {
  var interest = (intRate/100)/12;
  var whole_amount = parseFloat(loanAmount);
  var terms = numPay;
  var monthly = parseFloat(monPmt);

  var interest_amount;
  var monthly_w_interest;
  var run_balance = whole_amount;
  var date_due;
  var lType;
  var principal


  for (var i = 1; i <= terms; i++) {
    var date_due = moment(dt).add(i - 1, 'M').format("MMM DD, YYYY");
    interest_amount = run_balance * interest;
    // monthly_w_interest = interest_amount + monthly;
    principal = parseFloat(monthly) - parseFloat(interest_amount);


    if (str == 'DP') {
      lType = 3;
    }else{
      lType = 4;
    }

    if (terms == 1) {
      if (recalc == 1) {
        run_balance -= parseFloat(principal);
        populateTable(str+pad(i + numLine,4),date_due,twoDecimal(monthly),interest_amount,twoDecimal(principal),run_balance, lType);
      }else{
          run_balance -= parseFloat(principal);
          populateTable(str+pad(i,4),date_due,twoDecimal(monthly),interest_amount,twoDecimal(principal),run_balance, lType);
      }

    }else{
      if (recalc == 1) {
        if (i == terms) {
          if (interest == 0) { monthly = parseFloat(run_balance); }
            if (lType == 3) {
              run_balance = parseFloat(run_balance) - parseFloat(principal);
            }else{
              principal = parseFloat(run_balance);
              run_balance = parseFloat(run_balance) - parseFloat(principal);
            }
            populateTable(str+pad(i + numLine,4),date_due,twoDecimal(monthly),interest_amount,twoDecimal(principal),run_balance, lType);
        }else{
          run_balance -= parseFloat(principal);
          populateTable(str+pad(i + numLine,4),date_due,twoDecimal(monthly),interest_amount,twoDecimal(principal),run_balance, lType);
        }
      }else{
        if (i == terms) {
          // principal = parseFloat(run_balance);
          // if (interest == 0) { monthly = parseFloat(run_balance); }
          // monthly = parseFloat(run_balance); //commented - on testing
           if (lType == 3) {
            run_balance = parseFloat(run_balance) - parseFloat(principal);
          }else{
            principal = parseFloat(run_balance);
            run_balance = parseFloat(run_balance) - parseFloat(principal);
          }
          // run_balance = parseFloat(run_balance) - parseFloat(principal);
          populateTable(str+pad(i,4),date_due,twoDecimal(monthly),interest_amount,twoDecimal(principal),run_balance, lType);
        }else{
          run_balance -= parseFloat(principal);
          populateTable(str+pad(i,4),date_due,twoDecimal(monthly),interest_amount,twoDecimal(principal),run_balance, lType);
        }
      }
    }

  }
  return run_balance;
}


function amortizeDownPayments2(loanAmount,intRate,numPay,monPmt,dt,str,identity, recalc, numLine) {
  var oldBalance=parseFloat(loanAmount);
  var newBalance=parseFloat(loanAmount);                
  intRate=(intRate/100)/12; 
  
  var miscwithmonth= parseFloat(monPmt);         
  var monthly= parseFloat(monPmt);
  var owedInterest=0;    
  var totalInterestPd=0;
  var date_due;
  var tagNam;
  var dispInt;
  var i;
  var balance;
  var lType;
  // The for loop performs the amortization
  for(i=1;i<=numPay;i++) {
    var loopNum=i;
    date_due = moment(dt).add(i - 1, 'M').format("MMM DD, YYYY");
    // rbalance_misc =+ miscellaneous;
    owedInterest=newBalance*intRate;
    dispInt=twoDecimal(owedInterest);
    totalInterestPd=totalInterestPd+owedInterest;
    // Test for the final payment
    if (str == 'DP') {
      lType = 3;
    }else{
      lType = 4;
    }
    if (i<numPay) {
      monthly=twoDecimal(monPmt-dispInt);
      oldBalance=newBalance;
      // ,twoDecimal(miscellaneous)
      newBalance=twoDecimal(oldBalance-monthly);

      if (recalc == 1) {
          populateTable(str+pad(i + numLine,4),date_due,monthly,dispInt,monthly,newBalance, lType);
      }else{
        if (i == 1) {
          populateTable(str+pad(i,4),date_due,monthly,dispInt,monthly,newBalance, lType);
        }else{
          populateTable(str+pad(i,4),date_due,twoDecimal(miscwithmonth),dispInt,monthly,newBalance, lType);
        }
      }

      totalAllAmortizations = parseFloat(totalAllAmortizations) + parseFloat(miscwithmonth);
    }else {
        if(identity==1){
          if ($('#balTerms').val() <= 1 || $('#balTerms').val() == null) {
            balance=(oldBalance-monthly)+owedInterest;
            oldBalance = newBalance;
            miscwithmonth = balance;
            newBalance = newBalance - balance;
            monthly=twoDecimal(balance - dispInt);

          }else{
            monthly=twoDecimal(monPmt-dispInt);
            oldBalance=newBalance;
            newBalance=twoDecimal(oldBalance-monthly);
          }
        }else{
              balance=(oldBalance-monthly)+owedInterest;
              oldBalance=newBalance;
              newBalance=0;
              monthly = oldBalance
              monPmt = balance; 
              miscwithmonth = balance;
         }
      // populateTable(str+pad(i,4),moment(dt).add(i, 'M').format("MMM DD, YYYY"),twoDecimal(miscwithmonth),dispInt,monthly,newBalance, 4);
        
        if (recalc == 1) {
          populateTable(str+pad(i + numLine,4),date_due,twoDecimal(miscwithmonth),dispInt,monthly,newBalance, lType);
        }else{
          if (i == 1) {
            populateTable(str+pad(i,4),date_due,parseFloat(monthly),dispInt,monthly,newBalance, lType);
          }else{
            populateTable(str+pad(i,4),date_due,twoDecimal(miscwithmonth),dispInt,monthly,newBalance, lType);
          }
        }
        totalAllAmortizations = parseFloat(totalAllAmortizations) + parseFloat(miscwithmonth);
        $("#last_date").val(moment(date_due).add(1, "M").format("YYYY-MM-DD")); 
    }
    
  }
  return newBalance;
}

var aRow, aLineNum, alineType, currRunBal, amortVal, amortIndex;

$('#tblAmort').on('dblclick', 'tr', function() {
  aRow = $(this).closest('tr')[0];
  currRunBal = jFormatNumberRet(tblAmort.cell( aRow, 6 ).data());
  aLineNum   = parseInt(tblAmort.cell( aRow, 1 ).data().replace(/[^0-9\.]/g, ''), 10);
  alineCode  = tblAmort.cell( aRow, 1 ).data();
  // prevRunBal = currRunBal + jFormatNumberRet(tblAmort.cell( aRow, 3 ).data());
  prevRunWithInt = currRunBal + jFormatNumberRet(tblAmort.cell( aRow, 5 ).data());
  alineType  = tblAmort.cell( aRow, 7 ).data();
  amortIndex = tblAmort.row(aRow).index();
  amortVal   = jFormatNumberRet(tblAmort.cell( aRow, 3 ).data());

  console.log(amortIndex);
  console.log(aLineNum);
  // console.log(prevRunBal);
  console.log(amortVal + "\n ------------------");
  $('#balloon_amort').val(tblAmort.cell( aRow, 3 ).data());
  if (alineType == 3 && $('#dcTerms').val() != aLineNum) {
    $('#balloon_modify').modal('toggle');
  }else if(alineType == 4 && $('#balTerms').val() != aLineNum){
    $('#balloon_modify').modal('toggle');
  }else{
    toastr.options.timeOut = 500;
    toastr.warning("Cannot Edit", "Warning");
  }
});


$('#submit_new_amort').click(function(){
  console.log("onsubmit : " + amortIndex);
  console.log("onsubmit : " + aLineNum);
  // console.log("onsubmit : " + prevRunBal);
  console.log("onsubmit : " + amortVal);
  var typeString, balAmount, pervTotal = 0, dpNewMonthly, balInt, amortPrevTotal;
  // var prevRunBalance = prevRunBal;
  var trys = tblAmort.rows().data();
  var tryArray = [];
  var newAmount = jFormatNumberRet($('#balloon_amort').val());
  var aDate = moment($('#amortDate').val());
  var dpInt = $('#dcInterest').val();
  var balanceTerms = parseInt($('#balTerms').val());
  var newTerms = $('#dcTerms').val() - aLineNum;
  var dpnewAmount = jFormatNumberRet($('#totalFeesfordp').html());
  var dpOrigMonthly = dpnewAmount / $('#dcTerms').val();


  console.log("TRY------> " + dpnewAmount);
  if ($('#balInterest').val() == null || $('#balInterest').val() == 0) {
    balInt = 0;
  }else{
    balInt = $('#balInterest').val();
  }

  if (!($('#if_less_terms').is(':checked'))) { // IF CHECKED!
    //................................................................Delete bottom rows from table [START]
    trys.each(function(value, index){
      if (amortIndex <= index) {
        tryArray.push(index);
      }
    })

    for (var i = tryArray.length  - 1; i >= 0; i--) {
      trys.rows(tryArray[i]).remove().draw();
      rowcount--;
    }
    //................................................................Delete bottom rows from table [END]

    trys.each(function(value, index){
      if ( parseInt(value[1].replace(/[^0-9\.]/g, ''), 10) < aLineNum) {
        if (value[7] == alineType) {
          pervTotal = pervTotal + jFormatNumberRet(value[3]);
          console.log('------------------------------>' + value[3]);
        }
      }
      if (amortIndex - 1 == index) {
        amortPrevTotal = jFormatNumberRet(value[6]);
      }
    });
    console.log('---------------------> ' + pervTotal + ' ===========> ' + amortPrevTotal);
    dpNewMonthly = dpnewAmount - (pervTotal + newAmount);

    // ................................................................Repopulate Table [START]
    var arr = []
    if (alineType == 3) {
      //DOWNPAYMENT

      typeString = 'DP';
      if (dpInt == 0 || dpInt == null ) {
        dpInt = 0;
        if (balInt == null) { balInt = 0;}
   
        var newRunBal = parseFloat(amortPrevTotal - newAmount);
        populateTable(typeString+pad(aLineNum, 4), moment(aDate).add(aLineNum - 1, 'M').format("MMM DD, YYYY"),twoDecimal(newAmount), "0.00", twoDecimal(newAmount), twoDecimal(newRunBal), alineType);
        balAmount = amortizeDownPayments(newRunBal, dpInt, newTerms, twoDecimal(dpNewMonthly / newTerms), moment(aDate).add(aLineNum, 'M'), typeString, 1, 1, aLineNum);

        amortizeDownPayments(parseFloat(balAmount), balInt, balanceTerms, calcMonthly(balAmount, balanceTerms, balInt), moment(aDate).add($('#dcTerms').val(), 'M'), 'A', 2, 0, 0);

      }else{
        //DOWNPAYMENT WITH INTEREST
        
        if (balInt == null || balInt == 0) { balInt = 0;}
        var dpInterestAmount = twoDecimal((prevRunWithInt * (dpInt/100)) / 12);
        var newRunBal = parseFloat(prevRunWithInt - twoDecimal(newAmount - dpInterestAmount));

        populateTable(typeString+pad(aLineNum, 4), moment(aDate).add(aLineNum - 1, 'M').format("MMM DD, YYYY"),newAmount, dpInterestAmount, twoDecimal(newAmount - dpInterestAmount), newRunBal, alineType);
        balAmount = amortizeDownPayments(newRunBal, dpInt, newTerms, calcMonthly(newRunBal, newTerms, dpInt), moment(aDate).add(aLineNum, 'M'), typeString, 1, 1, aLineNum);
    
        amortizeDownPayments(parseFloat(balAmount), balInt, balanceTerms, calcMonthly(balAmount, balanceTerms, balInt), moment(aDate).add($('#dcTerms').val(), 'M'), 'A', 2, 0, 0);
        console.log('1st Amort : ' + balAmount);

      }
    }else if (alineType == 4) {
      //BALANCE

      var newRunBal = parseFloat(amortPrevTotal - newAmount);
      typeString = 'A';

      if (balInt == null) { 
        balInt = 0;
        populateTable(typeString+pad(aLineNum, 4), moment(aDate).add(($('#dcTerms').val() - 1) + aLineNum, 'M').format("MMM DD, YYYY"), newAmount, 0.00, twoDecimal(newAmount), twoDecimal(newRunBal), alineType);
        amortizeDownPayments(parseFloat(newRunBal), balInt, balanceTerms - aLineNum, calcMonthly(newRunBal, balanceTerms - aLineNum, balInt), moment(aDate).add(parseInt($('#dcTerms').val()) + parseInt(aLineNum), 'M'), 'A', 2, 1, aLineNum);

      }else{
        //BALANCE WITH INTEREST

        var balInterestAmount = twoDecimal((amortPrevTotal * (balInt/100)) / 12);
        var balanceNewRunBal = parseFloat(amortPrevTotal - twoDecimal(newAmount - balInterestAmount));
        
        populateTable(typeString+pad(aLineNum, 4), moment(aDate).add(($('#dcTerms').val() - 1) + aLineNum, 'M').format("MMM DD, YYYY"), newAmount, balInterestAmount, twoDecimal(newAmount - balInterestAmount), twoDecimal(balanceNewRunBal), alineType);
        amortizeDownPayments(parseFloat(balanceNewRunBal), balInt, balanceTerms - aLineNum, calcMonthly(balanceNewRunBal, balanceTerms - aLineNum, balInt), moment(aDate).add(parseInt($('#dcTerms').val()) + parseInt(aLineNum), 'M'), 'A', 2, 1, aLineNum);
        
      }
    }
    
  } else {
    // WORK HERE!

    var line = ($('#dcTerms').val() - 0) + aLineNum;
    var terms = parseFloat($('#dcTerms').val()) + parseFloat($('#balTerms').val());
    var prevRun = jFormatNumberRet(tblAmort.cell((line - 0), 6 ).data()); 
    var newRunBal = parseFloat(prevRun - newAmount);
    var lastrow = $('#tblAmort').closest('tr')[0]
    line++;

    tblAmort.cell( line, 3 ).data(jFormatNumber(newAmount));
    tblAmort.cell( line, 5 ).data(jFormatNumber(newAmount));
    tblAmort.cell( line, 6 ).data(jFormatNumber(newRunBal));
    
    // console.log("balAmort----> " + balAmort);
    // console.log("prevRun----> " + prevRun);
    // console.log("newRunBal----> " + newRunBal);
    // console.log("line----> " + line);

    line++;
    // var 1 = parseFloat(terms - line);
    terms++;
     console.log("terms ---->" + terms);
     console.log("line ---->" + line);
     // console.log("uptolast ---->" + uptolast);
    for (var i = line; i <= terms; i++) {
      if (balAmort <= newRunBal) {
        newRunBal = newRunBal - balAmort;
        tblAmort.cell( i, 3 ).data(jFormatNumber(balAmort));
        tblAmort.cell( i, 5 ).data(jFormatNumber(balAmort));
        tblAmort.cell( i, 6 ).data(jFormatNumber(newRunBal));

      } else {

        var last = newRunBal - balAmort;
        if (newRunBal == 0) {
          tblAmort.cell( i, 1 ).data('');
          tblAmort.cell( i, 2 ).data('');
          tblAmort.cell( i, 3 ).data('');
          tblAmort.cell( i, 4 ).data('');
          tblAmort.cell( i, 5 ).data('');
          tblAmort.cell( i, 6 ).data('');
          rowcount--;
        }else{
          tblAmort.cell( i, 3 ).data(jFormatNumber(newRunBal));
          tblAmort.cell( i, 5 ).data(jFormatNumber(newRunBal));
          tblAmort.cell( i, 6 ).data('0.00');
          newRunBal = 0;
          // $('#balTerms').val(i);
        }

      }
        console.log(i);
    }
  }
  // ................................................................Repopulate Table [END]
  $('#balloon_amort').val('');
  $('#balloon_modify').modal('toggle');
});


 
function repopulateAmort(arr){
  for (var i = 0; i <= arr.length - 1; i++) {
    var a = arr[i][1].toString();
    var b = arr[i][2].toString();
    var c = arr[i][3].toString();
    var d = arr[i][4].toString();
    var e = arr[i][5].toString();
    var f = arr[i][6].toString();
    var g = arr[i][7].toString();
    populateTable(a,b,jFormatNumberRet(c),jFormatNumberRet(d),jFormatNumberRet(e),jFormatNumberRet(f),g);
  }
}

function populateTable(months,dueDate,amortAmt,interst,principal,runBalance, lineType) {
  tblAmort.row.add( [
          "",
          months,
          dueDate,
          jFormatNumber(amortAmt),
          jFormatNumber(interst),
          jFormatNumber(principal),
          jFormatNumber(runBalance),
          lineType,
    ] ).draw( false );
  rowcount++;
}
function populateTableMisc(count, months,dueDate,misc,interst,runBalance) {
  tbl_misc.row.add( [
          count,
          months,
          dueDate,
          jFormatNumber(misc),
          jFormatNumber(interst),
          // jFormatNumber(principal),
          jFormatNumber(runBalance),
    ] ).draw( false );
  rowcount_misc++;
}

function twoDecimal(chgVar) {
  var chgVar;
  var twoDec = parseFloat(chgVar).toFixed(2);
  return twoDec;
}

function pad(str, max){
  str = str.toString();
  return str.length < max ? pad("0" + str, max) : str;
}
function jFormatNumber(a) {
    try {
        return parseFloat(a).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,")
    } catch (a) {
        return "Error FORMAT"
    }
}

function jFormatNumberRet(a) {
    try {
        return parseFloat(a.replace(/,/g, ""))
    } catch (a) {
        return "Error FORMAT"
    }
}
// end Amort........................


// Save to the database...............
$('#submitagreement').click(function() {

 var arr_data=[];
 var arr_misc=[];

 var lineType = $('input[name="line_type[]"]').map(function(){
      return $(this).val();
  }).get();

 if (rowcount != 0) {
    for (var i = 0; i < rowcount; i++) {
        var amort_lineOrder = i + 1;
        var line_description = tblAmort.cell( i, 1 ).data();
        var amort_DueDate = tblAmort.cell( i, 2 ).data();
        var amort_AmortAmount = jFormatNumberRet(tblAmort.cell( i, 3 ).data());
        // var amort_MiscFee = jFormatNumberRet(tblAmort.cell( i, 4 ).data());
        // var line_description = jFormatNumberRet(tblAmort.cell( i, 4 ).data());
        var amort_Interest = jFormatNumberRet(tblAmort.cell( i, 4 ).data());
        var amort_principal = jFormatNumberRet(tblAmort.cell( i, 5 ).data());
        var amort_runbalance = jFormatNumberRet(tblAmort.cell( i, 6 ).data());
        var amort_lineType = tblAmort.cell( i, 7 ).data();
        if (line_description != "" || line_description != null ) {
          var amort_data = {
              'line_order' : amort_lineOrder,
              'line_type' : amort_lineType,
              'due_date': moment(amort_DueDate).format("YYYY-MM-DD"),
              'amortization_amount':amort_AmortAmount,
              'interest_amount' : amort_Interest,
              'line_description' : line_description,
              'outstanding_balance':amort_runbalance,
              'principal_amount':amort_principal,
              'rebate': 0,
              'cashier_id':user_id,
              // 'miscellaneous_fee':amort_MiscFee  ,
              'paid_up':'false',
          };
          arr_data.push(amort_data);
        }
    }
  }else{
    toastr.options.timeOut = 500;
    toastr.error('Please Compute Amortization', 'Notice!');
  }
  var is_checked = 0;
  var is_deferred = 0;
  if (rowcount_misc != 0) {
    for (var i = 0; i < rowcount_misc; i++) {
      var misc_data = {
            'line_order' : i + 1,
            'due_date':moment(tbl_misc.cell( i, 2 ).data()).format("YYYY-MM-DD"),
            // 'outstanding_balance':jFormatNumberRet(tbl_misc.cell( i, 3 ).data()),
            'principal_amount':jFormatNumberRet(tbl_misc.cell( i, 3 ).data()),
            'rebate':0,
            'cashier_id':user_id,
            'miscellaneous_amount':jFormatNumberRet(tbl_misc.cell( i, 3 ).data()),
            'paid_up':'false',
        };
        arr_misc.push(misc_data);
    }
    is_checked = 1;
  }else{
    is_checked = 0;
  }
  if ($('#tax_defered').is(':checked')){
    is_deferred = 1;
  }else{
    is_deferred = 0;
  }
  if(parseFloat($('#originalVat').val()) > 0){is_vatable=1;}

  if (salesperson_id != '' || salesperson_id != 0) {
  var new_data = {'client_id':$('#amortcustid').val(),
                  'lot_id':tosave_lotid,
                  'contract_date':moment().format("YYYY-MM-DD"),
                  'sold_date':moment().format("YYYY-MM-DD"),
                  'total_contract_price':$('#originalTcp').val(),
                  'free_club_share':$("#clubshare option:selected").val(),
                  'reservation_fee':$('#lotreserveFee').val(),
                  'contract_status_id': 1,
                  'is_vatable':is_vatable,
                  'salesperson_id':salesperson_id, //Changed
                  'bank_id': $('#id_bank').val(),
                  'scheme_type_id':univ_scheme_typeid,
                  'is_tax_deferred': is_deferred,
                  'vat_rate' : $('#originalVat').val(),
                  'deposit_amount':$('#depAmount').val(),
                  'deposit_date':moment($('#depoDate').val()).format("YYYY-MM-DD"),
                  'amortization_date':moment($('#amortDate').val()).format("YYYY-MM-DD"),
                  'downpayment_ratio':$('#dcTcp').val(),
                  'downpayment_interest_rate':$('#dcInterest').val(),
                  'downpayment_terms':$('#dcTerms').val(),
                  'downpayment_discount_rate':$('#dcDiscount').val(),
                  'downpayment_discount':$('#accountDicount').val(),
                  'downpayment_surcharge_rate':$('#dcSurcharge').val(),
                  'balance_ratio':$('#balTcp').val(),
                  'balance_terms':$('#balTerms').val(),
                  'balance_interest_rate':$('#balInterest').val(),
                  'balance_surcharge_rate':$('#balSurcharge').val(),
                  'financing_type_id': $('#id_financing').val(),
                  'incentive_rate': $('#id_financing').val(),
                  'is_checked' : is_checked,
                  'added_by' : user_id,
                  'arr_data' : arr_data,
                  'arr_misc' : arr_misc
                };
                $.ajax({
                        type: "POST",
                        url: baseurl + "marketing/populateContract",
                        dataType: 'json',
                        data: new_data,
                        success: function(data)
                                 {
                                  toastr.info('Successfully saved!.', 'Operation done');
                                  console.log(data);
                                  $('#submitagreement').hide();
                                  window.location.replace(baseurl + 'marketing/amortizationdetails?contractid=' + data);
                                 },
                        error: function (errorThrown)
                                {  
                                  toastr.options.timeOut = 500;
                                  toastr.error('Failed to saved!.', 'Operation done');
                                  $('#submitagreement').show();
                                  console.log(errorThrown );

                                }
                });

  }else{
    toastr.options.timeOut = 500;
    toastr.error('Please Select an Agent', 'Notice!');
  }
  
});
//End saving Data....................
    var handleTable = function () {
  
    }
    return {

        //main function to initiate the module
        init: function () {
            handleTable();
    }
 };

}();

jQuery(document).ready(function() {
    TableDatatablesEditable.init();
});
