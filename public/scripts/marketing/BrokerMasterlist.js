var broker = function(){
    var _init = function(){

    var brokertable = $('#tblbroker').DataTable();
    var agents_table = $('#tblagents').DataTable({searching: false});
    var commission_table = $('#tblcommission').DataTable({searching: false, "lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]] });
    var realtytable = $('#tblrealty').DataTable();
    var tblrealty_agents = $('#tblrealty_agents').DataTable({"lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]] });
    var tblrealty_brokers = $('#tblrealty_brokers').DataTable({"lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]] });
    var brokerAddtable = $('#brokerAddresst').DataTable({searching: false, paging: false});
    var contacts_table = $('#contacts_table').DataTable({searching: false, paging: false});
    var contacts_table_edit = $('#contacts_table_edit').DataTable({searching: false, paging: false});
    var broker_address_edit = $('#brokerAddresst_edit').DataTable({searching: false,  paging: false});
    var tbl_salesperson = $('#tbl_salesperson').DataTable({searching: true, paging: false, "columnDefs": [
                {
                    "targets": [4],
                    "visible": false,
                    "searchable": false
                }
            ]
        });
    var tbl_broker_req = $('#tbl_broker_req').DataTable({searching: false, paging: false, "columnDefs": [
                {
                    "targets": [0,4],
                    "visible": false,
                    "searchable": false
                }
            ]
        });
    
    // toastr.options.timeOut = 500;
    

    var rowNum = 0;
    var rowCount_contact = 0;
 //REALTY - main
    realtytable.on('click', 'tr', function (e) {
        e.preventDefault();
        
        $("<style type='text/css'> .highlight{ background:#33F0FF;} </style>").appendTo("head");
        $("#tblrealty tr").each(function () {
            if ( $(this).hasClass('highlight') ) {
                $(this).removeClass('highlight');
            }
        });
        $(this).addClass("highlight");
        var row = $(this).closest('tr')[0];
        var realty_id = realtytable.cell(row, 0 ).data();
        $('#realty_name').html(realtytable.cell(row, 1 ).data());


        $.ajax({
            type: "POST",
            url : baseurl + "marketing/brokers/realty_agents",
            dataType : "json",
            data: {'realty_id' : realty_id},
            success : function(data){
                tblrealty_agents.clear().draw();
                $.each(data, function(i, value){
                    tblrealty_agents.row.add([
                        data[i].agent_id,
                        data[i].lastname + ", " + data[i].firstname + " " + data[i].middlename
                    ]).draw(false);
                });
            },  
            error: function(errorThrown){
                console.log(errorThrown);
            }
        });

        $.ajax({
            type: "POST",
            url : baseurl + "marketing/brokers/realty_brokers",
            dataType : "json",
            data: {'realty_id' : realty_id},
            success : function(data){
                tblrealty_brokers.clear().draw();
                $.each(data, function(i, value){
                    tblrealty_brokers.row.add([
                        data[i].broker_id,
                        data[i].lastname + ", " + data[i].firstname + " " + data[i].middlename
                    ]).draw(false);
                });
            },  
            error: function(errorThrown){
                console.log(errorThrown);
            }
        });
        realtytable.fixedHeader(false);
    });

 //REALTY - agent 
    tblrealty_agents.on('click', 'tr', function (e) {
        e.preventDefault();
        var row = $(this).closest('tr')[0];
        var agent_id = tblrealty_agents.cell(row, 0 ).data();
        var cont_type = "", 
            cont_detail="",
            add_type = "",
            add_detail = "";

        if (agent_id !== undefined) {
            $('#realty_agent_modal').modal('toggle');
             console.log('agent_id -> ' + agent_id);
            $.ajax({
                type: "POST",
                url : baseurl + "marketing/brokers/get_one_agent",
                dataType : "json",
                data: {'agent_id' : agent_id},
                success : function(data){
                    // console.log(data[0].lastname + ", " + data[0].firstname + " " + data[0].middlename);
                    $('#txt_agent_fullname2').html(data[0].lastname + ", " + data[0].firstname + " " + data[0].middlename);
                    $('#txt_agent_sex2').html(data[0].sex);
                    $('#txt_agent_address2').html(data[0].line_1 + " " + data[0].line_2 + " " + data[0].line_3 + ", " + data[0].city_name + ", " + data[0].province_name  + ", " + data[0].country_name);
                    $('#txt_agent_nationality2').html(data[0].nationality);
                    $('#txt_agent_birthday2').html(data[0].birthdate);
                    $('#txt_agent_birthplace2').html(data[0].birthplace);
                    $('#txt_agent_civil2').html(data[0].civil_status_name);
                    $('#txt_agent_taxtype2').html(data[0].tax_type_name);
                    $('#txt_agent_tin2').html(data[0].tin);

                    if (data[0].is_broker == 1) {
                        $('#is_broker').html('<h4 class="bold"><i class="fa fa-check-circle-o" aria-hidden="true"></i> Broker</h4>');
                    }else{
                        $('#is_broker').html('');
                    }

                    var filename = '../public/images/profiles/default.png';
                    if (typeof data[0].picture_url != 'undefined' && data[0].picture_url != null && data[0].picture_url != "") {
                        filename = '../public/images/profiles/' + data[0].picture_url;
                        console.log(filename);
                    }
                    $('#agent_profilepic').attr('src', filename);

                    for (var i = 0; i < data.length; i++) {
                            cont_type += data[i].contact_type_name + ": <br>";
                            cont_detail += data[i].contact_value + "<br>";
                            // console.log(data[i].contact_value);
                        }
                    if (cont_detail != "") {
                            $('#txt_agent_cont_type2').html(cont_type);
                            $('#txt_agent_cont_value2').html(cont_detail);
                        }

                    $.ajax({
                        type: "POST",
                        url : baseurl + "marketing/brokers/get_broker_address",
                        dataType : "json",
                        data: {'brok_id' : data[0].person_id},
                        success : function(data){
                            for (var i = 0; i <= data.length - 1; i++) {
                                add_type += data[i].address_type_name + ": <br>";
                                add_detail += data[i].line_1 + " " + data[i].line_2 + " " + data[i].line_3 + ", " + data[i].city_name + ", " + data[i].province_name  + ", " + data[i].country_name + "<br>";
                            }
                            if (add_detail != "") {
                                $('#txt_add_type2').html(add_type);
                                $('#txt_address2').html(add_detail);
                            }
                        },  
                        error: function(errorThrown){
                            console.log(errorThrown);
                        }
                    });
                },  
                error: function(errorThrown){
                    console.log(errorThrown);
                }
            });
        }
    });

//REALTY - Broker
    tblrealty_brokers.on('click', 'tr', function (e) {
        e.preventDefault();
        $('#txt_agent_fullname').html('');
        $('#txt_agent_sex').html('');
        $('#txt_agent_address').html('');
        $('#txt_agent_nationality').html('');
        $('#txt_agent_birthday').html('');
        $('#txt_agent_birthplace').html('');
        $('#txt_agent_civil').html('');
        $('#txt_agent_taxtype').html('');
        $('#txt_agent_tin').html('');
        $('#txt_agent_cont_type').html('');
        $('#txt_agent_cont_value').html('');

        var row = $(this).closest('tr')[0];
        var brokerID = tblrealty_brokers.cell(row, 0 ).data();
        var brok_id = $('#txtBrokerID').text();
        var commission,client,
            earnings = 0; 

        if (brokerID !== undefined) {
            $.ajax({
                type: "POST",
                url:  baseurl + "marketing/brokers/get_contract_by_broker",
                dataType: "json",
                data: {'brok_id': brokerID},
                success: function(data){
                    commission_table.clear();
                    if (data.length > 0) {
                        commission_table.clear();
                        for (var i = 0; i < data.length; i++) {
                            if (data[i].with_house == 1) {
                                commission = (data[i].total_contract_price * 0.05);
                            }else{
                                commission = (data[i].total_contract_price * 0.07);
                            }
                            if (data[i].client_type_id == 1) {
                                client = data[i].lastname + ", " + data[i].firstname + " " + data[i].middlename;
                            }else{
                                client = data[i].organization_name;
                            }

                            commission_table.row.add([
                                data[i].lot_description,
                                client,
                                data[i].sold_date,
                                jFormatNumber(data[i].total_contract_price),
                                jFormatNumber(commission)
                            ]).draw( true );

                            earnings = earnings + jFormatNumberRet(commission_table.cell(i, 4).data());
                        }
                        $('#txt_total_earn').html("&#8369;" + jFormatNumber(earnings));
                        console.log(jFormatNumber(earnings));
                    }else{
                        $('#txt_total_earn').html("&#8369; 0");
                        commission_table.clear().draw();
                    }
                },
                error: function(){
                    toastr.error('Error!.', 'Operation Done');
                }
            });

            $.ajax({
                type: "POST",
                url:  baseurl + "marketing/brokers/getOneBroker",
                dataType: "json",
                data: {'brokerID': brokerID },
                success: function(data){
                    var suff,cont_detail = "", 
                        cont_type = "",
                        add_type = "",
                        add_detail = "";

                    if (data[0].suffix == null) {
                        suff = " ";
                    }else{
                        suff = data[0].suffix;
                    };
                    $('#txtBrokerID').html(data[0].broker_id);
                    $('#txtLastname').html(data[0].lastname + ", " + data[0].firstname + " " + data[0].middlename + " " + suff);
                    $('#txtDateCreated').html(data[0].date_created);
                    $('#text_tin').html(data[0].new_tin);
                    $('#txt_address').html(data[0].line_1 + " " + data[0].line_2 + " " + data[0].line_3 + ", " + data[0].city_name + ", " + data[0].province_name  + ", " + data[0].country_name);
                    $('#txtNationality').html(data[0].nationality);
                    $('#txtBday').html(data[0].birthdate);
                    $('#txtBplace').html(data[0].birthplace);
                    $('#txtCivilStatus').html(data[0].civil_status_name);
                    $('#txtTaxType').html(data[0].tax_type_name);
                    $('#txt_company').html(data[0].organization_name);
                    $('#broker_head').html(data[0].lastname + ", " + data[0].firstname + " " + data[0].middlename + " " + suff);
                    $('#txt_prc_license').html(data[0].prc_license);
                    $('#txt_hlurb_no').html(data[0].hlurb_no);
                    $('#txt_license_validity_date').html(data[0].license_validity_date);
                    // $('#txt_realty_id').html(data[0].realty_id);
                    var filename = '../public/images/profiles/default.png';
                    if (typeof data[0].picture_url != 'undefined' && data[0].picture_url != null && data[0].picture_url != "") {
                        filename = '../public/images/profiles/' + data[0].picture_url;
                        console.log(filename);
                    }
                    $('#broker_profilepic').attr('src', filename);

                    console.log("tin : " + data[0].tin);
                    for (var i = 0; i <= data.length - 1; i++) {
                        cont_type += data[i].contact_type_name + ": <br>";
                        cont_detail += data[i].contact_value + "<br>";
                    }
                    if (cont_detail != "") {
                        $('#txt_cont_type').html(cont_type);
                        $('#txt_contacts').html(cont_detail);
                    }


                    console.log('ID ------> ' + data[0].new_id);
                    var p_id = data[0].new_id;
                    $.ajax({
                        type: "POST",
                        url:  baseurl + "marketing/brokers/get_broker_address",
                        dataType: "json",
                        data: {'brok_id': p_id},
                        success: function(data){
                            for (var i = 0; i <= data.length - 1; i++) {
                                add_type += data[i].address_type_name + ": <br>";
                                add_detail += data[i].line_1 + " " + data[i].line_2 + " " + data[i].line_3 + ", " + data[i].city_name + ", " + data[i].province_name  + ", " + data[i].country_name + "<br>";
                            }
                            if (add_detail != "") {
                                $('#txt_add_type').html(add_type);
                                $('#txt_address').html(add_detail);
                            }

                        },
                        error: function(errorThrown){
                              toastr.error('Error!.', 'Operation Done');
                        }
                    });



                    agents_table.clear();
                    $.ajax({
                        type: "POST",
                        url:  baseurl + "marketing/brokers/get_agent",
                        dataType: "json",
                        data: {'brok_id': brokerID },
                        success: function(data){
                            if (data.length >0) {
                                for (var i = 0; i < data.length; i++) {
                                    agents_table.row.add([
                                        data[i].agent_id,
                                        data[i].lastname + ", " + data[i].firstname + " " + data[i].middlename,
                                        "<button type='button' class='btn btn-xs blue-dark btn-view-agent ' data-toggle='modal' data-target='#viewagent' >View Details</button>"
                                        ]).draw( true );
                                }
                            }else{
                                agents_table.clear().draw();
                            }
                            console.log(data)
                        },
                        error: function(errorThrown){
                              toastr.error('Error!.', 'Operation Done');
                        }
                    });
                    $('#viewBroker').modal('toggle');
                },
                error: function (errorThrown){
                    console.log(errorThrown)
                    toastr.error('Error!.', 'Operation Done');
                }
            }); 
        }
    });

//BROKER - agents
    agents_table.on('click', '.btn-view-agent', function(e){
        e.preventDefault();
        var row = $(this).closest('tr')[0];
        var agent_id = agents_table.cell(row, 0 ).data();
        var cont_type = "", cont_detail="";

        $.ajax({
            type: "POST",
            url : baseurl + "marketing/brokers/get_one_agent",
            dataType : "json",
            data: {'agent_id' : agent_id},
            success : function(data){
                console.log(data[0].lastname + ", " + data[0].firstname + " " + data[0].middlename);
                $('#txt_agent_fullname').html(data[0].lastname + ", " + data[0].firstname + " " + data[0].middlename);
                $('#txt_agent_sex').html(data[0].sex);
                $('#txt_agent_address').html(data[0].line_1 + " " + data[0].line_2 + " " + data[0].line_3 + ", " + data[0].city_name + ", " + data[0].province_name  + ", " + data[0].country_name);
                $('#txt_agent_nationality').html(data[0].nationality);
                $('#txt_agent_birthday').html(data[0].birthdate);
                $('#txt_agent_birthplace').html(data[0].birthplace);
                $('#txt_agent_civil').html(data[0].civil_status_name);
                $('#txt_agent_taxtype').html(data[0].tax_type_name);
                $('#txt_agent_tin').html(data[0].tin);


                for (var i = 0; i < data.length; i++) {
                        cont_type += data[i].contact_type_name + ": <br>";
                        cont_detail += data[i].contact_value + "<br>";
                        console.log(data[i].contact_value);
                    }
                    if (cont_detail != "") {
                        $('#txt_agent_cont_type').html(cont_type);
                        $('#txt_agent_cont_value').html(cont_detail);
                    }
            },  
            error: function(errorThrown){
                console.log(errorThrown);
            }
        });
    });

    brokertable.on('click', '.btnViewBroker', function (e) {
        e.preventDefault();
        $('#txt_agent_fullname').html('');
        $('#txt_agent_sex').html('');
        $('#txt_agent_address').html('');
        $('#txt_agent_nationality').html('');
        $('#txt_agent_birthday').html('');
        $('#txt_agent_birthplace').html('');
        $('#txt_agent_civil').html('');
        $('#txt_agent_taxtype').html('');
        $('#txt_agent_tin').html('');
        $('#txt_agent_cont_type').html('');
        $('#txt_agent_cont_value').html('');

        var row = $(this).closest('tr')[0];
        var brokerID = brokertable.cell(row, 0 ).data();
        var brok_id = $('#txtBrokerID').text();
        var commission,client,
            earnings = 0; 


        $.ajax({
            type: "POST",
            url:  baseurl + "marketing/brokers/get_contract_by_broker",
            dataType: "json",
            data: {'brok_id': brokerID},
            success: function(data){
                commission_table.clear();
                if (data.length > 0) {
                    commission_table.clear();
                    for (var i = 0; i < data.length; i++) {
                        if (data[i].with_house == 1) {
                            commission = (data[i].total_contract_price * 0.05);
                        }else{
                            commission = (data[i].total_contract_price * 0.07);
                        }
                        if (data[i].client_type_id == 1) {
                            client = data[i].lastname + ", " + data[i].firstname + " " + data[i].middlename;
                        }else{
                            client = data[i].organization_name;
                        }

                        commission_table.row.add([
                            data[i].lot_description,
                            client,
                            data[i].sold_date,
                            jFormatNumber(data[i].total_contract_price),
                            jFormatNumber(commission)
                        ]).draw( true );

                        earnings = earnings + jFormatNumberRet(commission_table.cell(i, 4).data());
                    }
                    $('#txt_total_earn').html("&#8369;" + jFormatNumber(earnings));
                    console.log(jFormatNumber(earnings));
                }else{
                    $('#txt_total_earn').html("&#8369; 0");
                    commission_table.clear().draw();
                }
            },
            error: function(){
                toastr.error('Error!.', 'Operation Done');
            }
        });

        $.ajax({
            type: "POST",
            url:  baseurl + "marketing/brokers/getOneBroker",
            dataType: "json",
            data: {'brokerID': brokerID },
            success: function(data){
                var suff,cont_detail = "", 
                    cont_type = "",
                    add_type = "",
                    add_detail = "";

                if (data[0].suffix == null) {
                    suff = " ";
                }else{
                    suff = data[0].suffix;
                };
                $('#txtBrokerID').html(data[0].broker_id);
                $('#txtLastname').html(data[0].lastname + ", " + data[0].firstname + " " + data[0].middlename + " " + suff);
                $('#txtDateCreated').html(data[0].date_created);
                $('#text_tin').html(data[0].new_tin);
                $('#txt_address').html(data[0].line_1 + " " + data[0].line_2 + " " + data[0].line_3 + ", " + data[0].city_name + ", " + data[0].province_name  + ", " + data[0].country_name);
                $('#txtNationality').html(data[0].nationality);
                $('#txtBday').html(data[0].birthdate);
                $('#txtBplace').html(data[0].birthplace);
                $('#txtCivilStatus').html(data[0].civil_status_name);
                $('#txtTaxType').html(data[0].tax_type_name);
                $('#txt_company').html(data[0].organization_name);
                $('#broker_head').html(data[0].lastname + ", " + data[0].firstname + " " + data[0].middlename + " " + suff);
                $('#txt_prc_license').html(data[0].prc_license);
                $('#txt_hlurb_no').html(data[0].hlurb_no);
                $('#txt_license_validity_date').html(data[0].license_validity_date);
                // $('#txt_realty_id').html(data[0].realty_id);
                var filename = '../public/images/profiles/default.png';
                if (typeof data[0].picture_url != 'undefined' && data[0].picture_url != null && data[0].picture_url != "") {
                    filename = '../public/images/profiles/' + data[0].picture_url;
                    console.log(filename);
                }
                $('#broker_profilepic').attr('src', filename);

                console.log("tin : " + data[0].tin);
                for (var i = 0; i <= data.length - 1; i++) {
                    cont_type += data[i].contact_type_name + ": <br>";
                    cont_detail += data[i].contact_value + "<br>";
                }
                if (cont_detail != "") {
                    $('#txt_cont_type').html(cont_type);
                    $('#txt_contacts').html(cont_detail);
                }


                console.log('ID ------> ' + data[0].new_id);
                var p_id = data[0].new_id;
                $.ajax({
                    type: "POST",
                    url:  baseurl + "marketing/brokers/get_broker_address",
                    dataType: "json",
                    data: {'brok_id': p_id},
                    success: function(data){
                        for (var i = 0; i <= data.length - 1; i++) {
                            add_type += data[i].address_type_name + ": <br>";
                            add_detail += data[i].line_1 + " " + data[i].line_2 + " " + data[i].line_3 + ", " + data[i].city_name + ", " + data[i].province_name  + ", " + data[i].country_name + "<br>";
                        }
                        if (add_detail != "") {
                            $('#txt_add_type').html(add_type);
                            $('#txt_address').html(add_detail);
                        }

                    },
                    error: function(errorThrown){
                          toastr.error('Error!.', 'Operation Done');
                    }
                }); 

                agents_table.clear();
                $.ajax({
                    type: "POST",
                    url:  baseurl + "marketing/brokers/get_agent",
                    dataType: "json",
                    data: {'brok_id': brokerID },
                    success: function(data){
                        if (data.length >0) {
                            for (var i = 0; i < data.length; i++) {
                                agents_table.row.add([
                                    data[i].agent_id,
                                    data[i].lastname + ", " + data[i].firstname + " " + data[i].middlename,
                                    "<button type='button' class='btn btn-xs blue-dark btn-view-agent ' data-toggle='modal' data-target='#viewagent' >View Details</button>"
                                    ]).draw( true );
                            }
                        }else{
                            agents_table.clear().draw();
                        }
                        console.log(data)
                    },
                    error: function(errorThrown){
                          toastr.error('Error!.', 'Operation Done');
                    }
                });
            },
            error: function (errorThrown){
                console.log(errorThrown)
                toastr.error('Error!.', 'Operation Done');
            }
        });
    });

     $("#add_contact").click(function(){
        var rowCount_contact = $('#contacts_table tbody tr').length;
        if ($("#cont_value").val() != "") {
            contacts_table.row.add( [
                    "<input type='hidden' name='contact_type[]' value='" + $("#cont_type option:selected").val() + "'>" + $("#cont_type option:selected").text(),
                    "<input type='hidden' name='contact_value[]' value='" + $("#cont_value").val() + "'>" + $("#cont_value").val(),
                    '<a href="#" class="btn btn-danger delete">remove</a>'
                    ] ).draw( false );
            $("#cont_value").val('');
        }else{
            toastr.options.timeOut = 500;
            toastr.error('Please Fill Contact Value.', 'Notice!');
        }
    });

    contacts_table.on('click', '.delete', function(e){
        e.preventDefault();
        contacts_table.row($(this).closest('tr')).remove().draw();
    });
    
    // $('#try1').click(function() {
        
    // });

    $("#newAddress").click(function(){
        var rowCount = $('#brokerAddresst tbody tr').length;
        rowNum++;
        brokerAddtable.row.add( [            
                ".",
                "<input type='hidden' name='addtype[]' value='"+ $("#BrokerAddType option:selected").val() +"'/>" + $("#select2-BrokerAddType-container").text(),
                "<input type='hidden' name='street[]' value='"+ $("#brokerStreet").val() +"'/>" + $("#brokerStreet").val(),
                "<input type='hidden' name='brgy[]' value='"+ $("#brokerBarangay").val() +"'/>" + $("#brokerBarangay").val(),
                "<input type='hidden' name='postal[]' value='"+ $("#brokerPostal").val() +"'/>" + $("#brokerPostal").val(),
                "<input type='hidden' name='city[]' value='"+ $("#brokerCity option:selected").val() +"'/>" + $("#select2-brokerCity-container").text(),
                "<input type='hidden' name='prov[]' value='"+ $("#brokerProvince option:selected").val() +"'/>" + $("#select2-brokerProvince-container").text(),
                "<input type='hidden' name='country[]' value='"+ $("#brokerCountry option:selected").val() +"'/>" + $("#select2-brokerCountry-container").text(),
                '<a href="#" class="btn btn-danger delete">remove</a>'
                ] ).draw( false );

        console.log('type :' + $("select#BrokerAddType option:checked").val());
        console.log('county : ' + $("select#brokerCountry option:checked").val());
        console.log('city : ' + $("select#brokerCity option:checked").val());
        console.log('province : ' + $("select#brokerProvince option:checked").val());
    });

    brokerAddtable.on('click', '.delete', function(e){
        e.preventDefault();
        brokerAddtable.row($(this).closest('tr')).remove().draw();
        rowNum--;
    });

    function Clear(){
        $('#brokerHomePhone').val('');
        $('#brokerWorkPhone').val('');
        $('#brokerPersonalEmail').val('');
        $('#brokerWorkEmail').val('');
        $('#brokerLname').val('');
        $('#brokerFname').val('');
        $('#brokerMname').val('');
        $('#brokerExt').val('');
        $('#brokerCompany').val('');
        $('#brokerTIN').val('');
        $('#birthdate').val('');
        $('#brokerPlaceBirth').val('');
        $('#brokerGender').val('');
        $('#brokerCivilStatus').val('');
        $('#brokerNationality').val('');
        $('#brokerVatType').val('');
        $('#broker_person_id').val('');
        $('#broker_id').val('');
        // $('#BrokerAddType').val('');
        $('#brokerStreet').val('');
        $('#brokerBarangay').val('');
        $('#brokerPostal').val('');
        // $('#brokerCity').val('');
        // $('#brokerProvince').val('');
        // $('#brokerCountry').val('');
        init_address();
    }

    $('#broker_realty').change(function(){
        var realty_id = $(this).val();
        var opt_content = "<option value='0'>None</option>";

        $.ajax({
            type: "POST",
            url:  baseurl + "marketing/brokers/realty_brokers",
            dataType: "json",
            data: {'realty_id': realty_id},
            success: function(data){

                $.each(data, function(i, value){
                    opt_content += "<option value='" + data[i].broker_id + "'>" + data[i].lastname + ", " + data[i].firstname + " " + data[i].middlename + "</option>"
                });
                $('#agents_broker').html(opt_content);
            },
            error: function (errorThrown){
                toastr.error('Error!.', 'Operation Done');
            }
        });
    });

    $('#enroll_agentbroker').change(function(){
        // alert(realty_id = $(this).val());
        var realty_id = $(this).val();
        var opt_content = "<option value='0'>None</option>";

        $.ajax({
            type: "POST",
            url:  baseurl + "marketing/brokers/realty_agents",
            dataType: "json",
            data: {'realty_id': realty_id},
            success: function(data){
                $.each(data, function(i, value){
                    if (data[i].is_broker == 0) {
                        opt_content += "<option value='" + data[i].person_id + "'>" + data[i].lastname + ", " + data[i].firstname + " " + data[i].middlename + "</option>"
                    }
                });
                $('#agent_to_broker').html(opt_content);
            },
            error: function (errorThrown){
                toastr.error('Error!.', 'Operation Done');
            }
        });
    });


    $('#agent_to_broker').change(function(){
        // alert($(this).val());
        $('#agent_person_id').val($(this).val());
    });


    $('#save_agent_to_broker').click(function(){
        var data = {
            'person_id' : $('#agent_person_id').val(),
            'realty_id' : $('#enroll_agentbroker option:selected').val(),
            'vat_type_id' : $('#new_broker_taxtype option:selected').val(),
            'prc_license' : $('#prc_license').val(),
            'hlurb_no' : $('#hlurb_no').val(),
            'license_validity_date' : $('#license_validity_date').val()
         }

        $.ajax({
            type: "POST",
            url:  baseurl + "marketing/brokers/insert_agent_to_broker",
            dataType: "json",
            data: data,
            success: function(data){

                toastr.success('Successfully Saved!', 'Operation Done');
                window.location.href = baseurl + "marketing/brokers";
            },
            error: function (errorThrown){
                toastr.error('Error!.', 'Operation Done');
            }
        });
    });

 //REALTY - Enroll agent
    $('#add_agent').click(function(){
        Clear();
        $('#saveBroker').hide(); 
        $('#updateBroker').hide();
        $('#saveAgent').show();
        $('#broker_opt').show();
        $('#broker_opt').show();
        $('#broker_contact_info').hide();
        $('#broker_address_info').hide();
        init_address();
    });

 //REALTY - Enroll broker
    $('#add_broker').click(function(){
         Clear();
        $('#saveBroker').show();
        $('#updateBroker').hide();
        $('#saveAgent').hide();
        $('#realty_opt').show();
        $('#broker_opt').hide();
        $('#li-brokerinfo').tab('show');
        $('#broker_opt').hide();
        // $('#try1').click();
        // $('#li-brokercont').show();
        // $('#li-brokeraddress').show();
        $('#broker_contact_info').hide();
        $('#broker_address_info').hide();
        
        init_address();
    });

 // EDIT BROKER
    var brok_id;
    $("#editBroker").click(function(){
        brok_id = $('#txtBrokerID').html();
        init_address();
        // $('#newAddress').show();
        $('#saveBroker').hide();
        $('#updateBroker').show();
        $('#saveAgent').hide();
        $('#broker_contact_info').show();
        $('#broker_address_info').show();
        $.ajax({
            type: "POST",
            url:  baseurl + "marketing/brokers/getOneBroker",
            dataType: "json",
            data: {'brokerID': brok_id},
            success: function(data){

                Clear();
                $('#brokerLname').val(data[0].lastname);
                $('#brokerFname').val(data[0].firstname);
                $('#brokerMname').val(data[0].middlename);
                $('#brokerExt').val(data[0].suffix);
                $('#broker_realty').val(data[0].realty_id);
                $('#select2-broker_realty-container').text(data[0].organization_name);
                $('#brokerTIN').val(data[0].new_tin);
                $('#birthdate').val(data[0].birthdate);
                $('#brokerPlaceBirth').val(data[0].birthplace);
                $('#brokerGender').val(data[0].sex);
                $('#brokerCivilStatus').val(data[0].civil_status_id);
                $('#brokerNationality').val(data[0].nationality);
                $('#brokerVatType').val(data[0].vat_type_id);
                $('#broker_person_id').val(data[0].new_id);
                $('#broker_id').val(data[0].broker_id);
                $('#id_address').val(data[0].address_id);
            
                $.ajax({
                    type: "POST",
                    url:  baseurl + "marketing/brokers/get_broker_address",
                    dataType: "json",
                    data: {'brok_id': data[0].new_id},
                    success: function(data){
                        broker_address_edit.clear().draw();
                            $.each(data, function(i, value){
                                broker_address_edit.row.add([
                                    data[i].address_type_name,
                                    data[i].line_1,
                                    data[i].line_2,
                                    data[i].postal_code,
                                    data[i].city_name,
                                    data[i].province_name,
                                    data[i].country_name
                                ]).draw(false);
                            });
                    },
                    error: function (errorThrown){
                        toastr.error('Error!.', 'Operation Done');
                    }
                });


                $.ajax({
                    type: "POST",
                    url:  baseurl + "marketing/brokers/get_contacts",
                    dataType: "json",
                    data: {'brokerID': data[0].new_id },
                    success: function(data){
                        contacts_table_edit.clear().draw();
                        $.each(data, function(i, value){
                            contacts_table_edit.row.add([
                                data[i].contact_type_name,
                                data[i].contact_value
                                ]).draw(false);
                        });
                    },
                    error: function (errorThrown){
                        toastr.error('Error!.', 'Operation Done');
                    }
                });

            },
            error: function (errorThrown){
                 toastr.error('Error!.', 'Operation Done');
            }
        });
    }); 

    $('#enrollButton').click(function(){
        Clear();
        // $('#newAddress').hide();
        $('#saveBroker').show();
        $('#updateBroker').hide();
        $('#saveAgent').hide();
        $('#realty_opt').show();
        $('#broker_opt').hide();
        $('#li-brokerinfo').tab('show');
        // $('#try1').click();
        $('#li-brokercont').show();
        $('#li-brokeraddress').show();
        $('#broker_contact_info').hide();
        $('#broker_address_info').hide();
        
        init_address();
    });


    $('#addAgent').click(function(){
        Clear();
        $('#saveBroker').hide(); 
        $('#updateBroker').hide();
        $('#saveAgent').show();
        // $('#realty_opt').hide();
        $('#broker_opt').show();
        // $('#li-brokerinfo').tab('show');
        // $('#enrollBroker').modal('toggle');
        $('#broker_contact_info').hide();
        $('#broker_address_info').hide();
        init_address();
    });
    
    function init_address(){
        $("#brokerCity option[value='998']").attr('selected', true);
        $("#brokerProvince option[value='49']").attr('selected', true);
        $("#brokerCountry option[value='175']").attr('selected', true);
        $("#BrokerAddType option[value='1']").attr('selected', true);

        $("#select2-BrokerAddType-container").text('Home');
        $("#select2-brokerCity-container").text('Cagayan de Oro');
        $("#select2-brokerProvince-container").text('Misamis Oriental');
        $("#select2-brokerCountry-container").text('Philippines');
    }

 //SAVE BROKER
    $('#saveBroker').click(function(){
        var tbl_count = $('#brokerAddresst tr').length;
        var tbl_count_cont = $('#contacts_table tr').length;

        console.log(tbl_count + " -- " + tbl_count_cont);

        
        if ($('#brokerLname').val() != '' && $('#brokerFname').val() != '' && $('#brokerMname').val() != '' && $('#brokerGender option:selected').val() != '' && $('#birthdate').val() != '' && $('#brokerCivilStatus').val() != '' && $('#brokerVatType').val() != '') {
            if (tbl_count_cont < 3) {
                toastr.options.timeOut = 500;
                toastr.warning("Please Add a Contact", "Notice");
            }else if(tbl_count < 3) {
                toastr.options.timeOut = 500;
                toastr.warning("Please Add an Address", "Notice");
            }else {
                $("#forminfo_submit").attr("action","brokers/saveBroker");
                $("#forminfo_submit").submit();
            }
        }else {
            toastr.options.timeOut = 500;
            toastr.warning("Please Complete the Form", "Notice");
        }
    });

 //UPDATE BROKER
    $('#updateBroker').click(function(){
        var id_broker = $('#txtBrokerID').text();
        var tbl_count_cont = $('#contacts_table tr').length;
        // var cont_arr =[];

        var contact_type = $('input[name="contact_type[]"]').map(function(){
            return $(this).val();
        }).get();
        var contact_value = $('input[name="contact_value[]"]').map(function(){
            return $(this).val();
        }).get();

        //address
        var addtype = $('input[name="addtype[]"]').map(function(){
            return $(this).val();
        }).get();
        var street = $('input[name="street[]"]').map(function(){
            return $(this).val();
        }).get();
        var brgy = $('input[name="brgy[]"]').map(function(){
            return $(this).val();
        }).get();
        var postal = $('input[name="postal[]"]').map(function(){
            return $(this).val();
        }).get();
        var city = $('input[name="city[]"]').map(function(){
            return $(this).val();
        }).get();
        var prov = $('input[name="prov[]"]').map(function(){
            return $(this).val();
        }).get();
        var country = $('input[name="country[]"]').map(function(){
            return $(this).val();
        }).get();


        console.log(contact_value);
        var data = { 
            'broker_person_id': $('#broker_person_id').val(),
            'brokerLname': $('#brokerLname').val(),
            'brokerFname': $('#brokerFname').val(),
            'brokerMname': $('#brokerMname').val(),
            'brokerExt':$('#brokerExt').val(),
            'brokerGender': $('#brokerGender option:selected').val(),
            'birthdate': $('#birthdate').val(),
            'brokerPlaceBirth':$('#brokerPlaceBirth').val(),
            'brokerNationality': $('#brokerNationality').val(),
            'brokerCivilStatus': $('#brokerCivilStatus').val(),
            'brokerTIN': $('#brokerTIN').val(),
            'broker_id': $('#broker_id').val(),
            'brokerVatType':$('#brokerVatType').val(),
            'BrokerAddType': $('#BrokerAddType').val(),
            'broker_realty' : $('#broker_realty').val(),
            'contact_value' : contact_value,
            'contact_type' : contact_type,
            'addtype': addtype,
            'street': street,
            'barangay': brgy,
            'postal': postal,
            'city': city,
            'province': prov,
            'country': country
        };

        $.ajax({
            type: "POST",
            url:  baseurl + "marketing/brokers/saveUpdateBroker",
            dataType: "json",
            data: data,
            success: function(data){
                console.log(data);
                $('#enrollBroker').modal('toggle');
                location.reload();
                toastr.success('Successfully Saved!', 'Operation Done');            },
            error: function (errorThrown){
                toastr.error('Error!.', 'Operation Done');
            }
        });
    });

 //AGENT - 1
    $('#saveAgent').click(function(){
        //contact
        var arr_data_contact=[];
        var rowCount_contact = $('#contacts_table tbody tr').length;

        var contact_type = $('input[name="contact_type[]"]').map(function(){
            return $(this).val();
        }).get();
        var contact_value = $('input[name="contact_value[]"]').map(function(){
            return $(this).val();
        }).get();

        //address
        var addtype = $('input[name="addtype[]"]').map(function(){
            return $(this).val();
        }).get();
        var street = $('input[name="street[]"]').map(function(){
            return $(this).val();
        }).get();
        var brgy = $('input[name="brgy[]"]').map(function(){
            return $(this).val();
        }).get();
        var postal = $('input[name="postal[]"]').map(function(){
            return $(this).val();
        }).get();
        var city = $('input[name="city[]"]').map(function(){
            return $(this).val();
        }).get();
        var prov = $('input[name="prov[]"]').map(function(){
            return $(this).val();
        }).get();
        var country = $('input[name="country[]"]').map(function(){
            return $(this).val();
        }).get();

        var data = {
            'brokerLname': $('#brokerLname').val(),
            'brokerFname': $('#brokerFname').val(),
            'brokerMname': $('#brokerMname').val(),
            'brokerExt': $('#brokerExt').val(),
            'realty_id': $('#broker_realty option:selected').val(),
            'brokerGender': $('#brokerGender option:selected').val(),
            'birthdate': $('#birthdate').val(),
            'brokerPlaceBirth':$('#brokerPlaceBirth').val(),
            'brokerNationality': $('#brokerNationality').val(),
            'brokerCivilStatus': $('#brokerCivilStatus').val(),
            'brokerTIN': $('#brokerTIN').val(),
            'userfile': $('#userfile').val(),
            'txtBrokerID': $('#agents_broker option:selected').val(),
            'addtype': addtype,
            'street': street,
            'barangay': brgy,
            'postal': postal,
            'city': city,
            'province': prov,
            'country': country,
            'contact_value' : contact_value,
            'contact_type' : contact_type
        };


        $.ajax({
            type: "POST",
            url:  baseurl + "marketing/brokers/save_agent",
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





































    // NEW BROKER FORM
        var is_corporation = 0;
        var sales_count = 0;
        var realty_id = 0;
        var broker_id = 0;
        var req_id;

        $('select[name*=yes]').click(function(){
            
        });

        // RADIO BUTTON - SELLER TYPE
        $('#opt_corporation').click(function(){
            $('#realty_info').slideDown('slow')
            $('#realty_partnership').hide();
            is_corporation = 1;
            // $('#broker_realtyname').attr('required', true);
            // $('#broker_represent').attr('required', true);
            // $('#broker_designation').attr('required', true);
            // $('#broker_affdate').attr('required', true);

        });

        $('#opt_sole').click(function(){
            $('#realty_info').slideUp('slow');
            $('#realty_partnership').show();
            is_corporation = 0;
            // $('#broker_realtyname').attr('required', false);
            // $('#broker_represent').attr('required', false);
            // $('#broker_designation').attr('required', false);
            // $('#broker_affdate').attr('required', false);
        });

        $('#enroll_Broker_btn').click(function(){
            // $('#save_broker').show();
            $('#salesperson_next').show();
            $('#broker_selectdp').show();
            $('#all_broker_info').show();
            $('#salesperson_next').show();
            $('#seller_type_info').show();
            $('#broker_info').show();
            // $('#show_salesperson').show();

            $('#salesperson_list').hide();
            $('#print_broker').hide();
            $('#realty_info').hide();
            $('#broker_dp').hide();
            $('#broker_salesperson').hide();
            $('#save_broker').hide();
            $('#salesperson_back').hide();
            $('#show_salesperson').hide();
            $('#show_broker_requirement').hide();
            $('#broker_form_info')[0].reset();
        });

        $('#salesperson_next').click(function(){
            $(this).hide();
            
            $('#broker_salesperson').show();
            $('#salesperson_list').show();
            $('#salesperson_back').show();
            $('#save_broker').show();

            $('#show_requirement').hide();
            $('#broker_requirements').hide();

            $('#all_broker_info').hide();
        });

        $('#show_salesperson').click(function(){
            $(this).hide();
            $('#show_requirement').hide();
            $('#broker_requirements').hide();
            $('#all_broker_info').hide();
            $('#save_broker').hide();

            $('#salesperson_list').show();
            $('#show_broker_requirement').show();
            $('#salesperson_back').show();
        });

        
        $('#salesperson_back').click(function(){
            $(this).hide();
            $('#salesperson_list').hide();
            $('#salesperson_next').hide();
            $('#broker_salesperson').hide();
            $('#broker_requirements').hide();
            $('#show_requirement').hide();
            $('#save_broker').hide();

            $('#all_broker_info').show();
            $('#show_salesperson').show();
            $('#show_broker_requirement').show();
        });

        $('#btncloseClear').click(function(){
            // $(this).hide();
            $('#broker_info').show();
            $('#show_salesperson').show();
            $('#all_broker_info').show();
            $('#broker_salesperson').hide();
            $('#salesperson_next').show();
            $('#show_broker_requirement').show();

            $('#save_broker').hide();
            $('#broker_requirements').hide();
            $('#show_requirement').hide();
        });


        $('#show_broker_requirement').click(function(){
            $(this).hide();
            $('#salesperson_list').hide();            
            $('#save_broker').hide();
            $('#all_broker_info').hide();

            $('#show_salesperson').show();
            $('#broker_requirements').show();
            $('#salesperson_back').show();
        });

        $('#close_file').click(function(){
            $('#show_requirement').slideUp('slow');
            $('#broker_requirements').slideDown('slow');

        });
        
        
        $('#add_salesperson').click(function(){
            if ($('#salesperson_name').val() != '' && $('#salesperson_prcno').val() != '' && $('#salesperson_mobile').val() != '' && $('#salesperson_email').val() != '') {
                if (sales_count < 20) {
                    tbl_salesperson.row.add([
                        $('#salesperson_name').val(),
                        $('#salesperson_prcno').val(),
                        $('#salesperson_mobile').val(),
                        $('#salesperson_email').val(),
                        '',
                    ]).draw(false);
                    $('#salesperson_name').val('');
                    $('#salesperson_prcno').val('');
                    $('#salesperson_mobile').val('');
                    $('#salesperson_email').val('');
                    sales_count++;
                    $('#salesperson_name').focus();
                    console.log(sales_count);

                    if (sales_count >= 12) {
                        $('#save_broker').attr('disabled', false);
                        // $('#save_broker').addClass('disabled');
                    }else{
                        $('#save_broker').attr('disabled', true);
                        // $('#save_broker').addClass('disabled');
                    }

                }else{
                    toastr.options.timeOut = 500;
                    toastr.warning('Reached Maximum count of Salespersons(20)', 'Notice!');
                }
            }else{
                toastr.options.timeOut = 500;
                toastr.error('Recuired Field/s empty', 'Notice!');
            }
        });

        // INSERTING BROKER TO DATABASE
        $('#broker_form_info').on('submit', function(e){
            e.preventDefault();
            var newform = new FormData(this);
            var sales_data = tbl_salesperson.rows().data();
            var sales_arr = [];

            for (var i = 0; i < sales_count; i++) {
                var arr_data = {
                    'salesperson_name': tbl_salesperson.cell( i, 0 ).data(),
                    'prc_accrtn_license': tbl_salesperson.cell( i, 1 ).data(),
                    'salesperson_mobile': tbl_salesperson.cell( i, 2 ).data(),
                    'salesperson_email': tbl_salesperson.cell( i, 3 ).data(),
                }
                sales_arr.push(arr_data);
                newform.append('salesperson_name[]', tbl_salesperson.cell( i, 0 ).data());
                newform.append('prc_accrtn_license[]', tbl_salesperson.cell( i, 1 ).data());
                newform.append('salesperson_mobile[]', tbl_salesperson.cell( i, 2 ).data());
                newform.append('salesperson_email[]', tbl_salesperson.cell( i, 3 ).data());
            }
            newform.append('is_corporation', is_corporation);

            $.ajax({
                type: "POST",
                url : baseurl + "marketing/brokers/save_broker",
                dataType : "json",
                data: newform,
                contentType: false,
                cache: false,
                processData: false,
                success : function(data){
                    toastr.options.timeOut = 500;
                    toastr.success('Customer Saved.', 'Success');
                    load_realty();

                    $('#form_inputs').hide();
                    $('#submit_new_customer').hide();
                    $('#form_requirements').show();
                    $('#btn_done').show();
                    $('realty_info').hide();
                    $('broker_info').hide();
                },  
                error: function(errorThrown){
                    console.log(errorThrown);
                }
            });
        });
        
        
    var search_data = [];
    brokertable.on('click', '.btn_viewbroker', function (e) {

        var row = $(this).closest('tr')[0];
        broker_id = brokertable.cell(row, 0 ).data();

        $('#save_broker').hide();
        $('#broker_selectdp').hide();
        $('#realty_info').hide();
        $('#salesperson_next').hide();
        $('#broker_salesperson').hide();
        $('#seller_type_info').hide();
        $('#salesperson_list').hide();

        $('#broker_dp').show();
        $('#print_broker').show();
        $('#show_salesperson').show();
        $('#broker_info').show();
        $('#all_broker_info').show();
        $('#show_broker_requirement').show();
        
        // $('#broker_requirements').show();
        // alert(broker_id);
        $.ajax({
            type: "POST",
            url:  baseurl + "marketing/brokers/get_onebroker",
            dataType: "json",
            data: {'broker_id': broker_id },
            success: function(data){
                // PERSON
                if (data[0].picture_url == '') {
                    $('#broker_dp').prop('src', baseurl + 'public/images/profiles/default__profile');
                }else{
                    $('#broker_dp').prop('src', baseurl + 'public/images/profiles/' + data[0].picture_url);

                }
                realty_id = data[0].realty_id;
                $('#broker_lastname').val(data[0].lastname);
                $('#broker_firstname').val(data[0].firstname);
                $('#broker_middlename').val(data[0].middlename);
                $('#broker_sex').val(data[0].sex);
                $('#broker_birthdate').val(data[0].birthdate);
                $('#broker_birthplace').val(data[0].birthplace);
                $('#broker_civil').val(data[0].civil_status_id);
                $('#broker_citizen').val(data[0].nationality);
                $('#broker_tin').val(data[0].tin);
                // ADDRESS
                $('#broker_line_1').val(data[0].line_1);
                $('#broker_line_2').val(data[0].line_2);
                $('#broker_line_3').val(data[0].line_3);
                $('#broker_city').val(data[0].city_id);
                $('#broker_province').val(data[0].province_id);
                $('#broker_country').val(data[0].country_id);
                $('#broker_postalcode').val(data[0].postal_code);
                // CONTACT
                $('#broker_residential').val(data[0].residential_phone);
                $('#broker_mobile').val(data[0].mobile_phone);
                $('#broker_fax').val(data[0].fax_no);
                $('#broker_email').val(data[0].email);
                // REALTY 
                $('#broker_realtyname').val(data[0].realty_name);
                $('#broker_represent').val(data[0].realty_representative);
                $('#broker_designation').val(data[0].representative_designation);
                $('#broker_affdate').val(data[0].affiliation_date);
                // BROKER TABLE
                $('#broker_religion').val(data[0].religion);
                $('#broker_spouse').val(data[0].spouse_name);
                $('#broker_passport').val(data[0].passport_number);
                $('#broker_pass_from').val(data[0].passport_from);
                $('#broker_pass_to').val(data[0].passport_to);
                $('#broker_sss').val(data[0].sss_number);
                $('#broker_business_nature').val(data[0].business_nature);
                $('#broker_business_name').val(data[0].business_name);
                $('#broker_business_address').val(data[0].business_address);
                $('#broker_business_zip').val(data[0].business_zip);
                $('#broker_business_phone').val(data[0].business_phone2);
                $('#broker_business_fax').val(data[0].business_fax);
                // BROKER LICENSE - BROKER TABLE
                $('#broker_prc').val(data[0].prc_number);
                $('#broker_prc_from').val(data[0].prc_from);
                $('#broker_prc_to').val(data[0].prc_to);
                $('#broker_ptr').val(data[0].ptr_number);
                $('#broker_ptr_from').val(data[0].ptr_from);
                $('#broker_ptr_to').val(data[0].ptr_to);
                $('#broker_aipo_org').val(data[0].aipo_membership);
                $('#broker_aipo_from').val(data[0].aipo_from);
                $('#broker_aipo_to').val(data[0].aipo_to);
                $('#broker_aipo_receipt').val(data[0].aipo_receipt);
                
                $('#broker_realty_name').val(data[0].realty_name);

                if (data[0].realty_id == 0 || data[0].realty_id == null) {
                    $('#realty_info').hide();
                }else{
                    $('#broker_realtyname').val(data[0].realty_name);
                    $('#broker_represent').val(data[0].realty_representative);
                    $('#broker_designation').val(data[0].representative_designation);
                    $('#broker_affdate').val(data[0].affiliation_date);

                    $('#realty_info').show();                    
                }
            },
            error: function (errorThrown){
                console.log(errorThrown)
                toastr.error('Error!.', 'Operation Done');
            }
        });
        
        $.ajax({
            type: "POST",
            url : baseurl + "marketing/brokers/get_salesperson",
            dataType : "json",
            data: {'broker_id' : broker_id},
            success : function(data){
                tbl_salesperson.clear().draw();
                $.each(data, function(i, value){
                    tbl_salesperson.row.add([
                        data[i].salesperson_name,
                        data[i].prc_accrtn_license,
                        data[i].salesperson_mobile,
                        data[i].salesperson_email,
                        data[i].salesperson_id,
                    ]).draw(false);
                });
            },  
            error: function(errorThrown){
                console.log(errorThrown);
            }
        });
        refresh_requirement();

    });

    tbl_broker_req.on('click', '.btn-upload-req', function (e) {
        var row = $(this).closest('tr')[0];
        req_id = tbl_broker_req.cell(row, 0 ).data();

        $('#broker_req_file').trigger('click');
    });

    tbl_broker_req.on('click', '.btn-show-req', function (e) {
        var row = $(this).closest('tr')[0];
        req_file = tbl_broker_req.cell(row, 4 ).data();
        $('#show_requirement').hide();
        $('#file_img').prop('src', baseurl + 'public/images/requirements/brokers/' + req_file );
        $('#req_file_name').html(tbl_broker_req.cell(row, 1 ).data());
        $('#broker_requirements').slideUp('slow');
        $('#show_requirement').slideDown('slow');

    });

    // UPLOAD
    $('#broker_req_file').on('change', function(e){
        e.preventDefault();
        var file_data = $("#broker_req_file").prop("files")[0];
        var fd = new FormData();
                console.log(broker_id);

        fd.append("requirement_id", req_id);
        fd.append("file_name", file_data);

        if (realty_id == '' || realty_id == null || realty_id == 0) {
            fd.append("ref_id", broker_id);
            fd.append("ref_text", 'broker');
        }else{
            fd.append("ref_id", realty_id);
            fd.append("ref_text", 'realty');
        }

        $.ajax({
            method: "POST",
            url : baseurl + "marketing/brokers/upload_file",
            dataType : "text",
            data: fd,
            contentType: false,
            cache: false,
            processData: false,
            success : function(data){   
                toastr.options.timeOut = 500;
                toastr.success('Saved.', 'Success');
                $(this).val('');
                realty_id = 0;
                refresh_requirement();
            },   
            error: function(errorThrown){
                toastr.options.timeOut = 1000;
                toastr.error('Error uploading file.', 'Error');
            }
        });
    });

    $('#print_broker').click(function(){
        window.open(baseurl+"marketing/brokers/broker_pdf?broker=" + broker_id);
    });





















    // var search_data = ["Leuterio Realty", "Truly Wealthy Realty Corp", "Gambe Realty", "Power Properties Realty Mgt and Dev Corp", "JCA Realty", "Chee Realty Development Corp", "Leuterio Realty", "Truly Wealthy Realty Corp", "Gambe Realty", "Power Properties Realty Mgt and Dev Corp", "JCA Realty", "Chee Realty Development Corp"];
    $(document).ready(function(){
        search_data = [];
        $.ajax({
            url: baseurl + "marketing/brokers/get_realty",
            dataType: "json",
            data: {q: $(this).val()},
            success: function( data ) {
                $.each(data, function (index, value){
                   var arr = { 'value': data[index].realty_id, 'label': data[index].realty_name };
                   search_data.push(arr);
                });
                console.log(search_data);
            }
        });
    });

    $( function() {
        $( "#broker_realty_name" ).autocomplete({
            source: search_data,
            select: function(event, ui){
                event.preventDefault();
                $('#broker_realty_id').val(ui.item.value);
                $(this).val(ui.item.label)
            },
            appendTo : $('#broker_modal_body')
        });
    });

    const inputSelector = ':input[required]';
    function load_realty(){
        search_data = [];
        $.ajax({
            url: baseurl + "marketing/brokers/get_realty",
            dataType: "json",
            data: {q: 1},
            success: function( data ) {
                $.each(data, function (index, value){
                   var arr = { 'value': data[index].realty_id, 'label': data[index].realty_name };
                   search_data.push(arr);
                });
                console.log(search_data);
            }
        });
    }

    function checkForm() {
        var isValidForm = true;
        $(this.form).find(inputSelector).each(function() {
            if (!this.value.trim()) {
                isValidForm = false;
            }
        });
        $(this.form).find('.monitored-btn').prop('disabled', !isValidForm);
        return isValidForm;
    }

    $('.monitored-btn').closest('form').submit(function() {
        return checkForm.apply($(this).find(':input')[0]);
    }).find(inputSelector).keyup(checkForm).keyup().change(checkForm);

    function refresh_requirement(){
        $.ajax({
            type: "POST",
            url : baseurl + "marketing/brokers/get_broker_req",
            dataType : "json",
            data: {'ref_id' : broker_id, 'type': 1},
            success : function(data){
                console.log(realty_id);

                tbl_broker_req.clear().draw();
                $.each(data, function(i, value){
                    tbl_broker_req.row.add([
                        data[i].broker_requirement_id,
                        data[i].requirement_description,
                        (data[i].document_filename == null || data[i].document_filename == '') ? "No File Uploaded" : "<button type='button' class='btn btn-xs green btn-show-req'>Show</button>",
                        "<button type='button' class='btn btn-xs blue-dark btn-upload-req'>Upload</button>",
                        data[i].document_filename,
                    ]).draw(false);
                });

                $.ajax({
                    type: "POST",
                    url : baseurl + "marketing/brokers/get_broker_req",
                    dataType : "json",
                    data: {'ref_id' : realty_id, 'type': 2},
                    success : function(data){
                        $.each(data, function(i, value){
                            tbl_broker_req.row.add([
                                data[i].broker_requirement_id,
                                data[i].requirement_description,
                                "<button type='button' class='btn btn-xs green btn-show-req'>Show</button>",
                                "<button type='button' class='btn btn-xs blue-dark btn-upload-req'>Upload</button>",
                                data[i].document_filename,
                            ]).draw(false);
                        });
                    },  
                    error: function(errorThrown){
                        console.log(errorThrown);
                    }
                });
            },  
            error: function(errorThrown){
                console.log(errorThrown);
            }
        });
    }




    $('#test_button').click(function(){
        alert(tbl_salesperson.cell( 0, 0 ).data());
    });


    }
    return {
        init: function(){
            _init();
        }
    };
}();

jQuery(document).ready(function(){
    // $("<style type='text/css'> .odd{ background:#acbad4;} </style>").appendTo("head");
    // $("<style type='text/css'> .even{ background:#abc123;} </style>").appendTo("head");
    broker.init();
});





















// var TableDatatablesEditable = function () {
    

//     var handleTable = function () {}
//     return {
//         //main function to initiate the module
//         init: function () {
//             handleTable();
//         }
//     };
// }();

// $(document).ready(function(){
   

   





// });


jQuery(document).ready(function() {
    TableDatatablesEditable.init();
});


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

// function genericAjax(url, data, successAction){
//     $.ajax({
//         type: "POST",
//         url:  url,
//         dataType: "json",
//         data: data,
//         success: function(data){
//             successAction
//         },
//         error: function (errorThrown){
//             toastr.error('Error!.', 'Operation Done');
//         }
//     });
// }