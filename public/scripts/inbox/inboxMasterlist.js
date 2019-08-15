var TableDatatablesEditable = function () {
    
    var brokertable = $('#tblbroker').DataTable();
    var agents_table = $('#tblagents').DataTable({searching: false});
    var commission_table = $('#tblcommission').DataTable({searching: false, "lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]] });
    var realtytable = $('#tblrealty').DataTable();

    agents_table.on('click', '.btn-view-agent', function(e){
        e.preventDefault();
        var row = $(this).closest('tr')[0];
        var agent_id = agents_table.cell(row, 0 ).data();
        var cont_type = "", cont_detail="";

        $.ajax({
            type: "POST",
            url : baseurl + "inbox/inbox/get_one_agent",
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
        //var brokerID = 6;
        //***********************************************
        // code for retreiving data from table using ID
        var brokerID = brokertable.cell(row, 1 ).data();
        //**********************************************
        var brok_id = $('#txtBrokerID').text();
        var commission,client,
            earnings = 0; 


        $.ajax({
            type: "POST",
            url:  baseurl + "inbox/inbox/get_contract_by_broker",
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
            url:  baseurl + "inbox/getOneBroker",
            dataType: "json",
            data: {'brokerID': brokerID },
            success: function(data){
                var suff,cont_detail = "", 
                    cont_type = "",
                    add_type = "",
                    add_detail = "";

                // if (data[0].suffix == null) {
                //     suff = " ";
                // }else{
                //     suff = data[0].suffix;
                // };
                $('#body').html(data[0].body);
                $('#sender_id').html(data[0].sender_id);
                $('#subject').html(data[0].subject);
                // $('#txtLastname').html(data[0].lastname + ", " + data[0].firstname + " " + data[0].middlename + " " + suff);
                // $('#body').html(data[0].date_created);
                // $('#txtTIN').html(data[0].tin);
                // $('#txt_address').html(data[0].line_1 + " " + data[0].line_2 + " " + data[0].line_3 + ", " + data[0].city_name + ", " + data[0].province_name  + ", " + data[0].country_name);
                // $('#txtNationality').html(data[0].nationality);
                // $('#txtBday').html(data[0].birthdate);
                // $('#txtBplace').html(data[0].birthplace);
                // $('#txtCivilStatus').html(data[0].civil_status_name);
                // $('#txtTaxType').html(data[0].tax_type_name);
                // $('#txt_company').html(data[0].organization_name);
                // $('#broker_head').html(data[0].lastname + ", " + data[0].firstname + " " + data[0].middlename + " " + suff);
                // $('#txt_realty_id').html(data[0].realty_id);

                for (var i = 0; i <= data.length - 1; i++) {
                    cont_type += data[i].contact_type_name + ": <br>";
                    cont_detail += data[i].contact_value + "<br>";
                }
                if (cont_detail != "") {
                    $('#txt_cont_type').html(cont_type);
                    $('#txt_contacts').html(cont_detail);
                }

                agents_table.clear();
                $.ajax({
                    type: "POST",
                    url:  baseurl + "inbox/inbox/get_agent",
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
    
    $("#newAddress").click(function(){
        var rowCount = $('#brokerAddresst tbody tr').length;
        rowNum++;
        brokerAddtable.row.add( [
                ".",
                "<input type='hidden' name='addtype[]' value='"+ $("#BrokerAddType option:selected").val() +"'/>" + $("#BrokerAddType option:selected").text(),
                "<input type='hidden' name='street[]' value='"+ $("#brokerStreet").val() +"'/>" + $("#brokerStreet").val(),
                "<input type='hidden' name='brgy[]' value='"+ $("#brokerBarangay").val() +"'/>" + $("#brokerBarangay").val(),
                "<input type='hidden' name='postal[]' value='"+ $("#brokerPostal").val() +"'/>" + $("#brokerPostal").val(),
                "<input type='hidden' name='city[]' value='"+ $("#brokerCity option:selected").val() +"'/>" + $("#brokerCity option:selected").text(),
                "<input type='hidden' name='prov[]' value='"+ $("#brokerProvince option:selected").val() +"'/>" + $("#brokerProvince option:selected").text(),
                "<input type='hidden' name='country[]' value='"+ $("#brokerCountry option:selected").val() +"'/>" + $("#brokerCountry option:selected").text(),
                '<a href="#" class="btn btn-danger delete">remove</a>'
                ] ).draw( false );
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
        $('#BrokerAddType').val('');
        $('#brokerStreet').val('');
        $('#brokerBarangay').val('');
        $('#brokerPostal').val('');
        $('#brokerCity').val('');
        $('#brokerProvince').val('');
        $('#brokerCountry').val('');
    }

// EDIT BROKER
    var brok_id;
    $("#editBroker").click(function(){
        brok_id = $('#txtBrokerID').html();
        $('#newAddress').show();
        $('#saveBroker').hide();
        $('#updateBroker').show();
        $('#saveAgent').hide();

        $.ajax({
            type: "POST",
            url:  baseurl + "inbox/inbox/getOneBroker",
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
                $('#brokerTIN').val(data[0].tin);
                $('#birthdate').val(data[0].birthdate);
                $('#brokerPlaceBirth').val(data[0].birthplace);
                $('#brokerGender').val(data[0].sex);
                $('#brokerCivilStatus').val(data[0].civil_status_id);
                $('#brokerNationality').val(data[0].nationality);
                $('#brokerVatType').val(data[0].vat_type_id);
                $('#broker_person_id').val(data[0].new_id);
                $('#broker_id').val(data[0].broker_id);
                $('#id_address').val(data[0].address_id);
                $('#BrokerAddType').val(data[0].address_type_id);
                $('#select2-BrokerAddType-container').text(data[0].address_type_name);
                $('#brokerStreet').val(data[0].line_1);
                $('#brokerBarangay').val(data[0].line_2);
                $('#brokerPostal').val(data[0].postal_code);
                $('#brokerCity').val(data[0].city_id);
                $('#select2-brokerCity-container').text(data[0].city_name);
                $('#brokerProvince').val(data[0].province_id);
                $('#select2-brokerProvince-container').text(data[0].province_name);
                $('#brokerCountry').val(data[0].country_id);
                $('#select2-brokerCountry-container').text(data[0].country_name);

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
    });

    $('#addAgent').click(function(){
        Clear();
        $('#saveBroker').hide();
        $('#updateBroker').hide();
        $('#saveAgent').show();
        $('#realty_opt').hide();
        $('#broker_opt').show();
        $('#li-brokerinfo').tab('show');
    });
        
//UPDATE BROKER
    $('#updateBroker').click(function(){
        var id_broker = $('#txtBrokerID').text();
       
        var data = { 
            'broker_person_id': $('#broker_person_id').val(),
            'brokerLname':  $('#brokerLname').val(),
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
            'brokerStreet': $('#brokerStreet').val(),
            'brokerBarangay': $('#brokerBarangay').val(),
            'brokerPostal': $('#brokerPostal').val(),
            'brokerCity': $('#brokerCity').val(),
            'brokerProvince': $('#brokerProvince').val(),
            'brokerCountry': $('#brokerCountry').val(),
            'id_address': $('#id_address').val(),
            'broker_realty' : $('#broker_realty').val()
        };

        $.ajax({
            type: "POST",
            url:  baseurl + "inbox/inbox/saveUpdateBroker",
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

//AGENT 
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
            'brokerGender': $('#brokerGender option:selected').val(),
            'birthdate': $('#birthdate').val(),
            'brokerPlaceBirth':$('#brokerPlaceBirth').val(),
            'brokerNationality': $('#brokerNationality').val(),
            'brokerCivilStatus': $('#brokerCivilStatus').val(),
            'brokerTIN': $('#brokerTIN').val(),
            'txtBrokerID': $('#txtBrokerID').text(),
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
            url:  baseurl + "inbox/inbox/save_agent",
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

    $('#viewBroker').on('hidden.bs.modal', function(){
        $('.nav-tabs a:first').tab('show');
    });

     $('#enrollBroker').on('hidden.bs.modal', function(){
        $('.nav-tabs a:first').tab('show');
    });

    if($('.circle').html() == 0) { // ibutang sa common nga js sa tanan pages
        $('#header_inbox_bar').hide();
    }
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