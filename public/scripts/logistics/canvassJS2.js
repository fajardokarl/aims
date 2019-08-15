var TableDatatablesEditable = function () {
    
    var brokertable = $('#tblbroker').DataTable();
    var agents_table = $('#tblagents').DataTable({searching: false});
    var commission_table = $('#tblcommission').DataTable({searching: false, "lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]] });
    var realtytable = $('#tblrealty').DataTable();
    var tblrealty_agents = $('#tblrealty_agents').DataTable({"lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]] });
    var tblrealty_brokers = $('#tblrealty_brokers').DataTable({"lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]] });

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
                            console.log(data[i].contact_value);
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
    var handleTable = function () {}
    return {
        //main function to initiate the module
        init: function () {
            handleTable();
        }
    };
}();

$(document).ready(function(){
    var brokerAddtable = $('#brokerAddresst').DataTable({searching: false, paging: false});
    var contacts_table = $('#contacts_table').DataTable({searching: false, paging: false});
    var contacts_table_edit = $('#contacts_table_edit').DataTable({searching: false, paging: false});
    var broker_address_edit = $('#brokerAddresst_edit').DataTable({searching: false, paging: false});
    var rowNum = 0;
    var rowCount_contact = 0;

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
        // var rowCount = $('#brokerAddresst tbody tr').length;
        // rowNum++;
        brokerAddtable.row.add( [            
        "<input type='hidden' name='supplier_name[]' value='" + $("#supplier_name").val() + "'>" + $("#supplier_name").val(),        
        "<input type='hidden' name='contact_person[]' value='" + $("#contact_person").val() + "'>" + $("#contact_person").val(), 
        "<input type='hidden' name='contact_no[]' value='" + $("#contact_no").val() + "'>" + $("#contact_no").val(),                                                 
        "<input type='hidden' name='terms_of_payment[]' value='" + $("#terms_of_payment").val() + "'>" + $("#terms_of_payment").val(),        
        "<input type='hidden' name='item_description[]' value='" + $("#item_description option:selected").val() + "'>" + $("#item_description option:selected").text(),
        "<input type='hidden' name='qty[]' value='" + $("#qty").val() + "'>" + $("#qty").val(),         
        "<input type='hidden' name='unit[]' value='" + $("#uom_opt option:selected").val() + "'>" + $("#uom_opt option:selected").text(),            
        "<input type='hidden' name='unit_price[]' value='" + $("#unit_price").val() + "'>" + $("#unit_price").val(),         
        "<input type='hidden' name='offer_price[]' value='" + $("#offer_price").val() + "'>" + $("#offer_price").val(), 
        
       
        '<a href="#" class="btn btn-danger cust_delete_contact">remove</a>'
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
            'vat_type_id' : $('#new_broker_taxtype option:selected').val()
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
        // var arr_data_contact=[];
        // var rowCount_contact = $('#contacts_table tbody tr').length;

        // var contact_type = $('input[name="contact_type[]"]').map(function(){
        //     return $(this).val();
        // }).get();
        // var contact_value = $('input[name="contact_value[]"]').map(function(){
        //     return $(this).val();
        // }).get();

// insert new function
      var supplier_name = $('input[name="supplier_name[]"]').map(function(){
          return $(this).val();
      }).get();
      var contact_person = $('input[name="contact_person[]"]').map(function(){
          return $(this).val();
      }).get();
      var qty = $('input[name="qty[]"]').map(function(){
          return $(this).val();
      }).get();

      var contact_no = $('input[name="contact_no[]"]').map(function(){
          return $(this).val();
      }).get();

      var terms_of_payment = $('input[name="terms_of_payment[]"]').map(function(){
          return $(this).val();
      }).get();

      var item_description = $('input[name="item_description[]"]').map(function(){
          return $(this).val();
      }).get();

      var qty = $('input[name="qty[]"]').map(function(){
        return $(this).val();
      }).get();
    
      var unit = $('input[name="unit[]"]').map(function(){
          return $(this).val();
      }).get();

      var unit_price = $('input[name="unit_price[]"]').map(function(){
        return $(this).val();
      }).get();
    
      var offer_price = $('input[name="offer_price[]"]').map(function(){
          return $(this).val();
      }).get();



      var data = {

        //= to view ID.......value to be inserted//
          'canvass_date':$('#canvass_date').val(),
          'canvassed_by':$('#canvassed_by').val(),
          'remarks':$('#remarks').val(),       
                    
          'supplier_name': supplier_name,
          'contact_person': contact_person,
          'contact_no': contact_no,
          'terms_of_payment': terms_of_payment,
          'item_description': item_description,
          'qty': qty,
          'uom_opt': uom_opt,
          'offer_price': offer_price 
      }; 
//end function

        //address
        // var addtype = $('input[name="addtype[]"]').map(function(){
        //     return $(this).val();
        // }).get();
        // var street = $('input[name="street[]"]').map(function(){
        //     return $(this).val();
        // }).get();
        // var brgy = $('input[name="brgy[]"]').map(function(){
        //     return $(this).val();
        // }).get();
        // var postal = $('input[name="postal[]"]').map(function(){
        //     return $(this).val();
        // }).get();
        // var city = $('input[name="city[]"]').map(function(){
        //     return $(this).val();
        // }).get();
        // var prov = $('input[name="prov[]"]').map(function(){
        //     return $(this).val();
        // }).get();
        // var country = $('input[name="country[]"]').map(function(){
        //     return $(this).val();
        // }).get();

        // var data = {
            // 'brokerLname': $('#brokerLname').val(),
            // 'brokerFname': $('#brokerFname').val(),
            // 'brokerMname': $('#brokerMname').val(),
            // 'brokerExt': $('#brokerExt').val(),
            // 'realty_id': $('#broker_realty option:selected').val(),
            // 'brokerGender': $('#brokerGender option:selected').val(),
            // 'birthdate': $('#birthdate').val(),
            // 'brokerPlaceBirth':$('#brokerPlaceBirth').val(),
            // 'brokerNationality': $('#brokerNationality').val(),
            // 'brokerCivilStatus': $('#brokerCivilStatus').val(),
            // 'brokerTIN': $('#brokerTIN').val(),
            // 'txtBrokerID': $('#agents_broker option:selected').val(),
            // 'addtype': addtype,
            // 'street': street,
            // 'barangay': brgy,
            // 'postal': postal,
            // 'city': city,
            // 'province': prov,
            // 'country': country,
            // 'contact_value' : contact_value,
            // 'contact_type' : contact_type
        // };


        $.ajax({
            type: "POST",
            url:  baseurl + "logistics/canvassController/save_agent",
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

});


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