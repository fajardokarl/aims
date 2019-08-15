var cust = function(){
	var _init = function(){

		var tblcustomerlists = $("#tblcustomerlists").DataTable({searching: true, "columnDefs": [
                {
                    "targets": [],
                    "visible": false,
                    "searchable": false
                }
            ]
        });

		// FOR ATTACHMENT REQUIREMENTS
		var isLegalAge = 0;
    	var isFilipino = 0;
    	var isSpouseConsent = 0; // if female and married
    	var isSelfEmployed = 0;






	// SAVE CUSTOMER PERSON
		$('#btn_done').click(function(){
            $('#add_newcustomer_modal').modal('toggle');
			$('#form_inputs').show();
			$('#submit_new_customer').show(); 	 
			$('#form_requirements').hide();
			$('#btn_done').hide();

            $('#personal_info_form')[0].reset();
		});

		$('#add_newcustomer_modal').on('hidden.bs.modal', function () {
			$('#form_inputs').show();
			$('#submit_new_customer').show();
			$('#form_requirements').hide();
			$('#btn_done').hide();
            $('#personal_info_form')[0].reset();

            $('#select2-permanent_city-container').text('Municipality/City');
			$('#select2-permanent_province-container').text('Province');
			$('#select2-permanent_country-container').text('Country');
			$('#select2-present_city-container').text('Municipality/City');
			$('#select2-present_province-container').text('Province');
			$('#select2-present_country-container').text('Country');
		});

		$('#personal_info_form').on('submit', function(e){
			e.preventDefault();
			var newform = new FormData(this);
			newform.append('is_legal', isLegalAge);
			newform.append('is_filipino', isFilipino);
			newform.append('is_consent', isSpouseConsent);
			newform.append('is_selfemployed', isSelfEmployed);

			$.ajax({
                type: "POST",
                url : baseurl + "marketing/save_new_customer",
                dataType : "json",
                data: newform,
                contentType: false,
	            cache: false,
	            processData: false,
                success : function(data){
                  	toastr.options.timeOut = 500;
	                toastr.success('Customer Saved.', 'Success');

					$('#form_inputs').hide();
					$('#submit_new_customer').hide();
					$('#form_requirements').show();
					$('#btn_done').show();

					// console.log(data);
					$('#select2-permanent_city-container').text('Municipality/City');
					$('#select2-permanent_province-container').text('Province');
					$('#select2-permanent_country-container').text('Country');
					$('#select2-present_city-container').text('Municipality/City');
					$('#select2-present_province-container').text('Province');
					$('#select2-present_country-container').text('Country');

					$('#client_id').val(data.client_id);
					$('#is_ids_id').val(data.valid_id);
					$('#is_legal_id').val(data.legal_id);
					$('#is_filipino_id').val(data.filipino_id);
					$('#is_consent_id').val(data.consent_id);
					$('#is_selfemployed_id').val(data.selfemployed_id);
					
                },  
                error: function(errorThrown){
                    console.log(errorThrown);
                }
            });
			// console.log( $( this ).serializeArray() );

		});







    // ADDING ATTACHMENT
		$('#is_ids').on('change', function(e){
			e.preventDefault();
			var file_data = $("#is_ids").prop("files")[0];
			var is_ids_id = $('#is_ids_id').val();
			var client_id = $('#client_id').val();

			console.log(file_data);
			var fd = new FormData();

			fd.append("files", file_data);
			fd.append("requirement_id", is_ids_id);
			fd.append("client_id", client_id);

			$.ajax({
				method: "POST",
	            url : baseurl + "marketing/upload_file",
	            dataType : "json",
	            data: fd,
	            contentType: false,
	            cache: false,
	            processData: false,
	            success : function(data){	
	            	toastr.options.timeOut = 500;
                	toastr.success('Saved.', 'Success');
                	$(this).val(data);
	            },   
	            error: function(errorThrown){
	                console.log(errorThrown);
	            }
			});
		});

		$('#is_filipino2').on('change', function(e){
			e.preventDefault();
			var file_data = $("#is_filipino2").prop("files")[0];
			var is_filipino_id = $('#is_filipino_id').val();
			var client_id = $('#client_id').val();

			console.log(is_filipino_id);
			console.log(client_id);
			var fd = new FormData();

			fd.append("files", file_data);
			fd.append("requirement_id", is_filipino_id);
			fd.append("client_id", client_id);


			$.ajax({
				method: "POST",
	            url : baseurl + "marketing/upload_file",
	            dataType : "text",
	            data: fd,
	            contentType: false,
	            cache: false,
	            processData: false,
	            success : function(data){	
	            	toastr.options.timeOut = 500;
                	toastr.success('Saved.', 'Success');
                	$(this).val(data);
	            },   
	            error: function(errorThrown){
	                console.log(errorThrown);
	            }
			});
		});

		$('#is_legal').on('change', function(e){
			e.preventDefault();
			var file_data = $("#is_legal").prop("files")[0];
			var is_legal_id = $('#is_legal_id').val();
			var client_id = $('#client_id').val();

			console.log(file_data);
			var fd = new FormData();

			fd.append("files", file_data);
			fd.append("requirement_id", is_legal_id);
			fd.append("client_id", client_id);

			$.ajax({
				method: "POST",
	            url : baseurl + "marketing/upload_file",
	            dataType : "text",
	            data: fd,
	            contentType: false,
	            cache: false,
	            processData: false,
	            success : function(data){	
	            	toastr.options.timeOut = 500;
                	toastr.success('Saved.', 'Success');
                	$(this).val(data);
	            },   
	            error: function(errorThrown){
	                console.log(errorThrown);
	            }
			});
		});

		$('#is_consent').on('change', function(e){
			e.preventDefault();
			var file_data = $("#is_consent").prop("files")[0];
			var is_consent_id = $('#is_consent_id').val();
			var client_id = $('#client_id').val();

			console.log(file_data);
			var fd = new FormData();

			fd.append("files", file_data);
			fd.append("requirement_id", is_consent_id);
			fd.append("client_id", client_id);

			$.ajax({
				method: "POST",
	            url : baseurl + "marketing/upload_file",
	            dataType : "text",
	            data: fd,
	            contentType: false,
	            cache: false,
	            processData: false,
	            success : function(data){	
	            	toastr.options.timeOut = 500;
                	toastr.success('Saved.', 'Success');
                	$(this).val(data);
	            },   
	            error: function(errorThrown){
	                console.log(errorThrown);
	            }
			});
		});

		$('#is_selfemployed').on('change', function(e){
			e.preventDefault();
			var file_data = $("#is_selfemployed").prop("files")[0];
			var is_selfemployed_id = $('#is_selfemployed_id').val();
			var client_id = $('#client_id').val();

			console.log(file_data);
			var fd = new FormData();

			fd.append("files", file_data);
			fd.append("requirement_id", is_selfemployed_id);
			fd.append("client_id", client_id);

			$.ajax({
				method: "POST",
	            url : baseurl + "marketing/upload_file",
	            dataType : "text",
	            data: fd,
	            contentType: false,
	            cache: false,
	            processData: false,
	            success : function(data){	
	            	toastr.options.timeOut = 500;
                	toastr.success('Saved.', 'Success');
                	$(this).val(data);
	            },   
	            error: function(errorThrown){
	                console.log(errorThrown);
	            }
			});
		});

















	// TABLE CLICK
        $('#tblcustomerlists').on('click', 'tbody tr', function () {
        	var row = $(this).closest('tr')[0];
	        var clientid = tblcustomerlists.cell( row, 0 ).data();
			
			$('#submit_new_customer').hide();
			$('#address_check').hide();
			$('#spouse_check').hide();

			// SOURCE OF FUND
			$.ajax({
			    type: "POST",
			    url: "marketing/get_fundsource",
			    dataType: 'json',
			    data: {'clientid' : clientid},
			    success: function(data){
	            	$.each(data, function (index, value){
	            		$('input[name="customer_source[]"]').each(function() {
	            			if (data[index].source_of_fund_id == $(this).val()) {
	            				$(this).prop('checked', true);
	            			}
						});
	            	});
				}, 
			    error: function(data){
			       toastr.error('Failed!.', 'Operation done');
			       console.log( errorThrown );
			    }
			});


			$.ajax({
                type: "POST",
                url: "marketing/retrieveOnCustomer",
                dataType: 'json',
                data: {'clientid':clientid},
                success: function(data){
                	// console.log(data);
                	var person_id = data[0].person_id;

                	// if (data[0].picture_url) {
	                	// $('#profile_picture').html('<img src="' + baseurl + 'public/images/profiles/' + data[0].picture_url + '" id="profilepicture" class="img-responsive" alt="">');
                	// }
                	// $('#userfile').val(baseurl + 'public/images/profiles/' + data[0].picture_url);
                	$('#cust_lname').val(data[0].firstname);
					$('#cust_fname').val(data[0].lastname);
					$('#cust_mname').val(data[0].middlename);
					$('#cust_tin').val(data[0].tin2);
					$('#cust_profession').val(data[0].profession);
					$('#cust_birthdate').val(data[0].birthdate);
					$('#cust_birthplace').val(data[0].birthplace);
					$('#cust_nationality').val(data[0].nationality);
					$('#cust_gender').val(data[0].sex);
					$('#cust_civil').val(data[0].civil_status_id);

					//CONTACTS
					$('#cust_residential').val(data[0].residential_phone);
					$('#cust_bphone').val(data[0].business_phone);
					$('#cust_mphone').val(data[0].mobile_phone);
					$('#cust_fax').val(data[0].fax_no);
					$('#cust_email').val(data[0].email);

					// WORK
					$('#cust_employer').val(data[0].employer_name);
					$('#cust_job').val(data[0].job_title);
					$('#cust_gross').val(data[0].monthly_gross_income);
					$('#cust_occupation').val(data[0].occupation_id);

					// WORK ADDRESS
					$('#employer_line_1').val(data[0].line_1);
					$('#employer_line_2').val(data[0].line_2);
					$('#employer_line_3').val(data[0].line_3);
					$('#employer_city').val(data[0].city_id);
					$('#employer_province').val(data[0].province_id);
					$('#employer_country').val(data[0].country_id);
					$('#employer_postalcode').val(data[0].postal_code);

	            	$('#select2-employer_city-container').text($('#employer_city option:selected').text());
	            	$('#select2-employer_province-container').text($('#employer_province option:selected').text());
	            	$('#select2-employer_country-container').text($('#employer_country option:selected').text());



					// ADDRESS 
					$.ajax({
					    type: "POST",
					    url: "marketing/get_personaddress",
					    dataType: 'json',
					    data: {'person_id':person_id},
					    success: function(data){
                        	$.each(data, function (index, value){
                        		if (data[index].address_type_id == 3) {
									$('#present_line_1').val(data[index].line_1);
									$('#present_line_2').val(data[index].line_2);
									$('#present_line_3').val(data[index].line_3);
									$('#present_city').val(data[index].city_id);
									$('#present_province').val(data[index].province_id);
									$('#present_country').val(data[index].country_id);
									$('#present_postalcode').val(data[index].postal_code);
									$('#present_lengthofstay').val(data[index].stay_length);

									$('#select2-present_city-container').text($('#present_city option:selected').text());
					            	$('#select2-present_province-container').text($('#present_province option:selected').text());
					            	$('#select2-present_country-container').text($('#present_country option:selected').text());


                        		}else if (data[index].address_type_id == 4){
                        			$('#permanent_line_1').val(data[index].line_1);
									$('#permanent_line_2').val(data[index].line_2);
									$('#permanent_line_3').val(data[index].line_3);
									$('#permanent_city').val(data[index].city_id);
									$('#permanent_province').val(data[index].province_id);
									$('#permanent_country').val(data[index].country_id);
									$('#permanent_postalcode').val(data[index].postal_code);
									$('#permanent_lengthofstay').val(data[index].stay_length);

									$('#select2-permanent_city-container').text($('#permanent_city option:selected').text());
					            	$('#select2-permanent_province-container').text($('#permanent_province option:selected').text());
					            	$('#select2-permanent_country-container').text($('#permanent_country option:selected').text());
                        		}
                        	});

						}, 
					    error: function(data){
					       toastr.error('Failed!.', 'Operation done');
					       console.log( errorThrown );
					    }
					});

					// PERSONAL REFERENCE
					$.ajax({
					    type: "POST",
					    url: "marketing/get_references",
					    dataType: 'json',
					    data: {'person_id':person_id},
					    success: function(data){
       						if (data.length >= 1) {
       							// 1
       							$('#reference_id').val(data[0].personal_reference_id);
								$('#reference_fullname').val(data[0].reference_name);
								$('#reference_address').val(data[0].address);
								$('#reference_relation').val(data[0].relation);
								$('#reference_tel').val(data[0].contact_no);
								// 2
								$('#reference_id1').val(data[1].personal_reference_id);
								$('#reference_fullname1').val(data[1].reference_name);
								$('#reference_address1').val(data[1].address);
								$('#reference_relation1').val(data[1].relation);
								$('#reference_tel1').val(data[1].contact_no);
								// 3
								$('#reference_id2').val(data[2].personal_reference_id);
								$('#reference_fullname2').val(data[2].reference_name);
								$('#reference_address2').val(data[2].address);
								$('#reference_relation2').val(data[2].relation);
								$('#reference_tel2').val(data[2].contact_no);
       						}



						}, 
					    error: function(data){
					       toastr.error('Failed!.', 'Operation done');
					       console.log( errorThrown );
					    }
					});




					$('#add_newcustomer_modal').modal('toggle');



				},
                error: function (errorThrown){  
	                toastr.error('Failed to saved!.', 'Operation done');
	                console.log( errorThrown );
                }  
            });
        });





    // FILTERS
    	$('#add_new_customer').click(function(){
    		$('#submit_new_customer').show();
			$('#address_check').show();
			$('#spouse_check').show();

            $('#personal_info_form')[0].reset();
    	});

    	$('#has_spouse').click(function(){
            if ($(this).prop('checked') == true) {
				$('#spouse').slideDown('slow');
				$('#has_spouse_val').val(1);
            }else{
				$('#spouse').slideUp('slow');
				$('#has_spouse_val').val(0);
            }
        });

        $('#same_address').click(function(){
        	if ($("#present_line_1,#present_line_2,#present_line_3,#present_city,#present_province,#present_country,#present_postalcode,#present_lengthofstay").filter(function() { return $(this).val(); }).length > 0) {
	            if ($(this).prop('checked') == true) {
					$('#select2-permanent_city-container').text($('#select2-present_city-container').text());
					$('#select2-permanent_province-container').text($('#select2-present_province-container').text());
					$('#select2-permanent_country-container').text($('#select2-present_country-container').text());

					$('#permanent_line_1').val($('#present_line_1').val());
					$('#permanent_line_2').val($('#present_line_2').val());
					$('#permanent_line_3').val($('#present_line_3').val());

					$('#permanent_city').val($('#present_city option:selected').val());
					$('#permanent_province').val($('#present_province option:selected').val());
					$('#permanent_country').val($('#present_country option:selected').val());
					$('#permanent_postalcode').val($('#present_postalcode').val());
					$('#permanent_lengthofstay').val($('#present_lengthofstay').val());
	            }else{
	            	$('#permanent_line_1').val('');
					$('#permanent_line_2').val('');
					$('#permanent_line_3').val('');

					$('#permanent_city').val('');
					$('#permanent_province').val('');
					$('#permanent_country').val('');
					$('#permanent_postalcode').val('');
					$('#permanent_lengthofstay').val('');

	            	$('#select2-permanent_city-container').text('Municipality/City');
					$('#select2-permanent_province-container').text('Province');
					$('#select2-permanent_country-container').text('Country');

					// $(this).prop('checked', false);
	            }
			}else{
				toastr.options.timeOut = 500;
              	toastr.warning('No Current Address', 'Warning');
			}
        });

    	$('#cust_birthdate').on('blur',function(){
    		var yearDiff = moment().diff(moment($('#cust_birthdate').val()), 'years', true)
    		console.log(yearDiff);
			if ($(this).val() == '') {
				$('#is_legal_age').html('');
    			$('#cust_birthdate').css('border-color', '');
    			isLegalAge = 0;
    		}else if (yearDiff <= 18) { //fa-item
    			$('#is_legal_age').html('<div class="font font-red"><i class="fa fa-close"></i> Age is under 18</div>');
    			$('#cust_birthdate').css('border-color', 'red');
	    		$('#is_legal_tr').show();
    			isLegalAge = 0;
    		}else{
	    		$('#is_legal_age').html('<div class="font font-green-meadow"><i class="fa fa-check"></i> Age is equal/over 18</div>');
    			$('#cust_birthdate').css('border-color', '');
    			// $('#cust_birthdate').css('border-color', '');
	    		$('#is_legal_tr').hide();
	    		isLegalAge = 1;
    		}
    	});

    	$('#cust_nationality').on('blur', function(){
			if ($(this).val() == '') {
    			$(this).css('border-color', '');
				isFilipino = 0;
			}else if ($(this).val().toLowerCase().trim() == 'filipino') {
    			$(this).css('border-color', '');
	    		$('#is_filipino_tr').hide();
	    		isFilipino = 1;
			}else{
    			$(this).css('border-color', 'red');
	    		$('#is_filipino_tr').show();
	    		isFilipino = 0;
			}
    	});

        $('#cust_civil').on('blur', function(){
        	if ($('#cust_civil option:selected').val() == 2 && $('#cust_gender').val() == 'F') {
	    		$('#is_consent_tr').show();
				isSpouseConsent = 1
			}else{
	    		$('#is_consent_tr').hide();
				isSpouseConsent = 0
			}
        });

        $('#cust_civil').on('change', function(){
        	if ($(this).val() == 2) {
				isSpouseConsent = 1
				$('#spouse').show();
			}else{
				isSpouseConsent = 0
				$('#spouse').hide();
			}
        });
        
		$('#cust_gender').on('blur', function(){
			// $('#cust_civil').blur();
			if ($('#cust_civil option:selected').val() == 2 && $('#cust_gender').val() == 'F') {
	    		$('#is_consent_tr').show();
				isSpouseConsent = 1
			}else{
	    		$('#is_consent_tr').hide();
				isSpouseConsent = 0
			}
		});

		$('#cust_occupation').on('blur', function(){
			if ($('#cust_occupation option:selected').val() == 2) {
	    		$('#is_selfemployed_tr').show();
				isSelfEmployed = 1;
			}else{
	    		$('#is_selfemployed_tr').hide();
				isSelfEmployed = 0;
			}
		});

		


















    // TEST
        $('#test_button').click(function(){
        	// alert(moment().diff(moment($('#cust_birthdate').val()), 'years', true));
        	$('input[name="customer_source[]"]').each(function() {
			    $(this).val()
			});
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
	cust.init();
});