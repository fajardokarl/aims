var bank = function(){
    var _init = function(){
        var tblbankslists = $('#tblbankslists').DataTable();
        var unit_type = 1;

        $('#bank_info_form').on('submit', function(e){
            e.preventDefault();
            var newform = new FormData(this);
            newform.append('unit_type', unit_type);

            $.ajax({
                type: "POST",
                url : baseurl + "marketing/insert_bank",
                dataType : "json",
                data: newform,
                contentType: false,
                cache: false,
                processData: false,
                success : function(data){
                    toastr.options.timeOut = 500;
                    toastr.success('Customer Saved.', 'Success');
                    // load_realty();

                    $('#new_bank_modal').modal('toggle');
                    // $('#submit_new_customer').hide();
                    // $('#form_requirements').show();
                    // $('#btn_done').show();
                    // $('realty_info').hide();
                    // $('broker_info').hide();
                },  
                error: function(errorThrown){
                    console.log(errorThrown);
                }
            });
        });

        // $('#submit_bank').click(function(){
        //     alert('OK!');
        // });

        $('#opt_lot').click(function(){
            unit_type = 1;
        });

        $('#opt_houselot').click(function(){
            unit_type = 2;
        });

        function reset_bank(){
            $.ajax({
            type: "POST",
            url : baseurl + "marketing/get_broker_req",
            dataType : "json",
            data: {'a' : '1'},
            success : function(data){
                console.log(realty_id);

                tbl_broker_req.clear().draw();
                $.each(data, function(i, value){
                    tbl_broker_req.row.add([
                        data[i].broker_id,
                        data[i].broker_requirement_id,
                        data[i].broker_requirement_id,
                        data[i].broker_requirement_id,
                        data[i].broker_requirement_id,
                        data[i].broker_requirement_id,
                        data[i].broker_requirement_id,
                    ]).draw(false);
                });
            },  
            error: function(errorThrown){
                console.log(errorThrown);
            }
        });

        }
    }
    return {
        init: function(){
            _init();
        }
    };
}();

jQuery(document).ready(function(){
    // $("<style type='text/css'> .borderless td, .borderless th { border: none;} </style>").appendTo("head");
    bank.init();
});

// $(document).ready(function(){
// 	$('#bankForm').submit(function (event){
// 		var data = new FormData();
// 		data.append("bank_name",$('#bankName').val());
//         data.append("account_number", $('#accountNum').val());
// 		data.append("bank_address_type",$('#bankAddressType').val());
// 		data.append("bank_address_line1",$('#bankAddressLine1').val());
// 		data.append("bank_address_line2",$('#bankAddressLine2').val());
// 		data.append("bank_address_line3",$('#bankAddressLine3').val());
// 		data.append("bank_address_city",$('#bankAddressCity').val());
// 		data.append("bank_address_province",$('#bankAddressProvince').val());
// 		data.append("bank_address_country",$('#bankAddressCountry').val());
// 		$.each($("#userfile")[0].files,function(i,file){
//             data.append("userfile",file);
//         });
// 		data.append("firstName",$('#personFirstName').val());
// 		data.append("middleName",$('#personMiddleName').val());
// 		data.append("lastName",$('#personLastName').val());
// 		data.append("suffix",$('#personSuffix').val());
// 		data.append("sex",$('#personSex').val());
// 		data.append("birthdate",$('#personBirthday').val());
// 		data.append("birthplace",$('#personBirthplace').val());
// 		data.append("nationality",$('#personNationality').val());
// 		data.append("civil_status",$('#personCivilStatus').val());
// 		data.append("person_contact",$('#personContact').val());
// 		data.append("person_contact_type",$('#personContactType').val());
// 		data.append("person_address_type",$('#personAddressType').val());
// 		data.append("person_address_line1",$('#personAddressLine1').val());
// 		data.append("person_address_line2",$('#personAddressLine2').val());
// 		data.append("person_address_line3",$('#personAddressLine3').val());
// 		data.append("person_address_city",$('#personAddressCity').val());
// 		data.append("person_address_province",$('#personAddressProvince').val());
// 		data.append("person_address_country",$('#personAddressCountry').val());
// 		for (var pair of data.entries()) {
// 		    console.log(pair[0]+ ', ' + pair[1]); 
// 		}
// 		$.ajax({
//             type: "POST",
//             url:  baseurl + "marketing/saveBank",
//             data: data,
//             cache: false,
//             processData:false,
//             contentType:false,
//             success: function(data){
                
//                 //location.reload();
//                 console.log(data);
//                 toastr.success('Successfully Saved!', 'Operation Done');
//                 // alert(data[0].broker_person_id);
                
//             },
//             error: function (errorThrown){
//                 //toastr.error('Error!', 'Operation Done');
//                 //console.log(errorThrown);
//             }
//         });
// 		event.preventDefault();
// 	});
// 	$('#tblbankslists tbody').on('click', 'tr', function () {
// 		var t = document.getElementById('tblbankslists');
// 		var bankid = $(this).find('td:first').text();
// 		var personid = $(this).find('td:eq(1)').text();
// 		var addressid = $(this).find('td:eq(2)').text();
// 		console.log(bankid+' '+personid+' '+addressid);
// 		$.ajax({
//             type: "POST",
//             url: "marketing/retrieveOnBank",
//             //dataType: 'json',
//             data: {'bankid':bankid, 'personid':personid, 'addressid':addressid},
//             success: function(result)
//             {
//                 var data = jQuery.parseJSON(result);
//                 console.log(JSON.stringify(data));
                
//                 $('#updateBankName').val(data['bank'][0].bank_name);
//                 $('#updateAccountNum').val(data['bank'][0].account_number);
//                 $('#updateBankAddressType').val(data['bank'][0].address_type_id).change();
//                 $('#updateBankAddressLine1').val(data['bank'][0].line_1);
//                 $('#updateBankAddressLine2').val(data['bank'][0].line_2);
//                 $('#updateBankAddressLine3').val(data['bank'][0].line_3);
//                 $('#updateBankAddressCity').val(data['bank'][0].address_city_id).change();
//                 $('#updateBankAddressProvince').val(data['bank'][0].address_province_id).change();
//                 $('#updateBankAddressCountry').val(data['bank'][0].id).change();
//                 $('#updatePersonFirstName').val(data['person'][0].firstname);
//                 $('#updatePersonMiddleName').val(data['person'][0].middlename);
//                 $('#updatePersonLastName').val(data['person'][0].lastname);
//                 $('#updatePersonSuffix').val(data['person'][0].suffix);
//                 $('#updatePersonSex').val(data['person'][0].sex);
//                 $('#updatePersonBirthday').val(data['person'][0].birthdate);
//                 $('#updatePersonBirthplace').val(data['person'][0].birthplace);
//                 $('#updatePersonNationality').val(data['person'][0].nationality);
//                 $('#updatePersonCivilStatus').val(data['person'][0].civil_status_id);
//                 $('#updatePersonContact').val(data['person'][0].contact_value);
//                 $('#updatePersonContactType').val(data['person'][0].contact_type_id);
//                 $('#updatePersonAddressType').val(data['person'][0].address_type_id).change();
//                 $('#updatePersonAddressLine1').val(data['person'][0].line_1);
//                 $('#updatePersonAddressLine2').val(data['person'][0].line_2);
//                 $('#updatePersonAddressLine3').val(data['person'][0].line_3);
//                 $('#updatePersonAddressCity').val(data['person'][0].address_city_id).change();
//                 $('#updatePersonAddressProvince').val(data['person'][0].address_province_id).change();
//                 $('#updatePersonAddressCountry').val(data['person'][0].id).change();
//                 $('#UpdateBank').modal('show');
            
//                 var bankid = data['bank'][0].bank_id;
//                 var bankaddressid = data['bank'][0].address_id;
//                 var contactid = data['bank'][0].contact_id;
//                 var personid = data['person'][0].person_id;
//                 var personaddressid = data['person'][0].address_id;

//                 console.log(bankaddressid+' '+personaddressid);

//                 $("#updateBankForm").submit(function(event){
//                 	var modify = new FormData();
//                 	modify.append("bank_id", bankid);
//                 	modify.append("bank_address_id", bankid);
//                 	modify.append("bank_contact_id", contactid);
//                 	modify.append("person_id", personid);
//                 	modify.append("person_address_id", personaddressid);
//                 	modify.append("bank_name", $('#updateBankName').val());
//                     modify.append("account_number", $('#updateAccountNum').val());
//                 	modify.append("bank_address_type", $('#updateBankAddressType').val());
//                 	modify.append("bank_line_1", $('#updateBankAddressLine1').val());
//                 	modify.append("bank_line_2", $('#updateBankAddressLine2').val());
//                 	modify.append("bank_line_3", $('#updateBankAddressLine3').val());
//                 	modify.append("bank_address_city", $('#updateBankAddressCity').val());
//                 	modify.append("bank_address_province", $('#updateBankAddressProvince').val());
//                 	modify.append("bank_address_country", $('#updateBankAddressCountry').val());
//                 	modify.append("person_firstname", $('#updatePersonFirstName').val());
//                 	modify.append("person_middlename", $('#updatePersonMiddleName').val());
//                 	modify.append("person_lastname", $('#updatePersonLastName').val());
//                 	modify.append("person_suffix", $('#updatePersonSuffix').val());
//                 	modify.append("person_sex", $('#updatePersonSex').val());
//                 	modify.append("person_birthday", $('#updatePersonBirthday').val());
//                 	modify.append("person_birthplace", $('#updatePersonBirthplace').val());
//                 	modify.append("person_nationality", $('#updatePersonNationality').val());
//                 	modify.append("person_civilstatus", $('#updatePersonCivilStatus').val());
//                 	modify.append("person_contact", $('#updatePersonContact').val());
//                 	modify.append("person_contact_type", $('#updatePersonContactType').val());
//                 	modify.append("person_address_type", $('#updatePersonAddressType').val());
//                 	modify.append("person_line_1", $('#updatePersonAddressLine1').val());
//                 	modify.append("person_line_2", $('#updatePersonAddressLine2').val());
//                 	modify.append("person_line_3", $('#updatePersonAddressLine3').val());
//                 	modify.append("person_address_city", $('#updatePersonAddressCity').val());
//                 	modify.append("person_address_province", $('#updatePersonAddressProvince').val());
//                 	modify.append("person_address_country", $('#updatePersonAddressCountry').val());
//                 	$.each($("#userfile")[0].files,function(i,file){
// 			            data.append("userfile",file);
// 			        });
//                 	for (var pair of modify.entries()) {
// 					    console.log(pair[0]+ ', ' + pair[1]); 
// 					}
// 					$.ajax({
// 			            type: "POST",
// 			            url:  baseurl + "marketing/modifyBank",
// 			            data: modify,
// 			            cache: false,
// 			            processData:false,
// 			            contentType:false,
// 			            success: function(data){
			                
// 			                //location.reload();
// 			                toastr.success('Successfully Saved!', 'Operation Done');
// 			                // alert(data[0].broker_person_id);
			                
// 			            },
// 			            error: function (errorThrown){
// 			                toastr.error('Error!', 'Operation Done');
// 			                //console.log(errorThrown);
// 			            }
// 			        });
// 					event.preventDefault();
//                 });	

//             }
//         });
// 	});	
// 	$("#tab_next").on('click', function() {
// 		$('#tab a[href="#tab_person"]').tab('show');
// 	});
// 	$("#tab_back").on('click', function() {
// 		$('#tab a[href="#tab_bank"]').tab('show');
// 	});
// });
