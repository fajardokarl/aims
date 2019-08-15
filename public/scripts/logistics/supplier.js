var masterlist = function(){
	var _init = function(){
			$('#tbl_masterlist').DataTable({
				'bSort' : true,
				'aLengthMenu': [[25,50,100,-1],[25,50,100,'All']],
				'iDisplayLength': 25,
				fixedHeader: {
					header: false,			
				}
			});
						
			//add supplier
			$('#btn_add').click(function(){
				$('#reference_id').empty();
				$.ajax({
					type: "POST",
					url: baseurl + "Logistics/Supplier/optionAddSupplier",
					dataType: 'json',
					data: {'typeid': '2'},
					success: function(data){
							var items = '<option value ="" disabled selected>---- Supplier Name ----</option>';
						 	$.each(data,function(index,item){
      					items+="<option value='"+item.reference_id+"'>"+item.supplier_name+"</option>";
    					});
    					$("#reference_id").html(items); 
					},
					error: function(errorThrown){
						toastr.error('Something is Amiss!', 'Operation Done');
						console.log(errorThrown);
					}
				});

				clearForm();
				$('#client_type_id').removeAttr('readonly');
				$('#client_type_id').prop('disabled', false);
				$('#reference_id').select2('enable');

				$('#client_type_id').val('2');
				$('#status_id').val('1');
				$('#country_id').val('175');
				$('#address_type_id').val('2');

				$('#profilechange').hide();
				$('#tr_homephone').hide();
				$('#tr_personalemail').hide();
				$('#frm_masterlist').hide();
				$('#frm_information').show();

				$('#title_add').show();
				$('#title_update').hide();
				
				$('#frm_company').show();
				$('#frm_person').hide();

				$('#frm_company').find('input, select').attr('readonly', 'readonly');
				$('#frm_person').find('input, select').attr('readonly', 'readonly');
				$('#frm_contact').find('input, select').attr('readonly', 'readonly');
				$('#frm_address').find('input, select').attr('readonly', 'readonly');
				$('#profilepicture').attr('src', baseurl+'public/images/profiles/3934.jpg');
				$('#editpic').attr('disabled', 'disabled');
			});


			// choose person/organization supplier
			$('#client_type_id').change(function(){
				clearForm();
				$('#reference_id').empty();
				var typeid = $(this).val();
				$.ajax({
					type: "POST",
					url: baseurl + "Logistics/Supplier/optionAddSupplier",
					dataType: 'json',
					data: {'typeid': typeid},
					success: function(data){
							var items = '<option value ="" disabled selected>---- Supplier Name ----</option>';
						 	$.each(data,function(index,item){
      					items+="<option value='"+item.reference_id+"'>"+item.supplier_name+"</option>";
    					});
    					$("#reference_id").html(items); 
					},
					error: function(errorThrown){
						toastr.error('Something is Amiss!', 'Operation Done');
						console.log(errorThrown);
					}
				});

				if(typeid == 1){
					$('#tr_homephone').show();
					$('#tr_personalemail').show();

					$('#frm_company').hide();
					$('#frm_person').show();
				} else {
					$('#tr_homephone').hide();
					$('#tr_personalemail').hide();

					$('#frm_company').show();
					$('#frm_person').hide();
				}

				$('#frm_company').find('input, select').attr('readonly', 'readonly');
				$('#frm_person').find('input, select').attr('readonly', 'readonly');
				$('#frm_contact').find('input, select').attr('readonly', 'readonly');
				$('#frm_address').find('input, select').attr('readonly', 'readonly');
				$('#editpic').attr('disabled', 'disabled');
				$('#profilechange').hide();
				$('#imageselect').show();
			});


			// select supplier name
			$('#reference_id').select2({
				width: '100%',
				tags: true,
				createTag: function (params){
					return {
						id: params.term,
						text: params.term,
						newOption: true
					}
				},
				templateResult: function(data){
					var $result = $('<span></span>');
					$result.text(data.text);

					if (data.newOption) {
						$result.append('<em>(new)</em>');
					}
					return $result;
				}
			}).change(function(){
				if ( isNaN($('#reference_id').val()) ) {
					clearForm();
					if($('#client_type_id').val() == 1){
						
						$('#lastname').val($('#reference_id').val().charAt(0).toUpperCase()+$('#reference_id').val().slice(1));
						$('#frm_person').find('input, select').removeAttr('readonly');
						$('#frm_contact').find('input, select').removeAttr('readonly');
						$('#frm_address').find('input, select').removeAttr('readonly');
						$('#editpic').attr('disabled', false);

						$('#status_id').val('1');
						$('#province_id').val('49');
						$('#country_id').val('175');
						$('#address_type_id').val('2');
						$('#frm_information').attr('action',baseurl+'supplier/addSupplierNewPerson');
					} else {
						
						$('#organization_name').val($('#reference_id').val().charAt(0).toUpperCase()+$('#reference_id').val().slice(1));
						$('#frm_company').find('input, select').removeAttr('readonly');
						$('#frm_contact').find('input, select').removeAttr('readonly');
						$('#frm_address').find('input, select').removeAttr('readonly');

						$('#status_id').val('1');
						$('#province_id').val('49');
						$('#country_id').val('175');
						$('#address_type_id').val('2');
						$('#frm_information').attr('action',baseurl+'Logistics/Supplier/addSupplierNewCompany');
					}
				} else {

					$('#frm_company').find('input, select').removeAttr('readonly');
					$('#frm_person').find('input, select').removeAttr('readonly');
					$('#frm_contact').find('input, select').removeAttr('readonly');
					$('#frm_address').find('input, select').removeAttr('readonly');
					
					$('#frm_information').attr('action',baseurl+'Logistics/Supplier/addSupplier');
					$('#editpic').attr('disabled', false);

					var typeid = $('#client_type_id').val();
					var referenceid = $('#reference_id').val();
					getSupplierDetails(typeid,referenceid);
				}
			});// end select supplier name



			$('#frm_information').submit(function(){
				$('#frm_person').find('input, select').removeAttr('readonly');
				$('#frm_company').find('input, select').removeAttr('readonly');
				$('#frm_contact').find('input, select').removeAttr('readonly');
				$('#frm_address').find('input, select').removeAttr('readonly');
				$('#client_type_id').removeAttr('disabled');
				$('#reference_id').select2('enable');
			});
		



			//	update supplier
			$('#tbl_masterlist').on('dblclick', 'tr', function(){
				clearForm();
				
				$('#client_type_id').attr('readonly', 'readonly');
				$('#client_type_id').prop('disabled', 'disabled');
				$('#reference_id').select2('enable', false);
				$('#reference_id').empty();

				$('#frm_masterlist').hide();
				$('#frm_information').show();

				$('#title_add').hide();
				$('#title_update').show();

				$('#profilechange').hide();

				$('#frm_person').find('input, select').removeAttr('readonly');
				$('#frm_company').find('input, select').removeAttr('readonly');
				$('#frm_contact').find('input, select').removeAttr('readonly');
				$('#frm_address').find('input, select').removeAttr('readonly');

				var row = $(this).closest('tr')[0];
				var supplierid = $('#tbl_masterlist').DataTable().cell(row,0).data();
				$.ajax({
					type: 'POST',
					url: baseurl+'Logistics/Supplier/getSupplierByID',
					dataType: 'json',
					data: {'supplierid':supplierid},
					success: function(data){
						//$('#infoform').attr('action', 'supplier/updateSupplier');
						$('#supplier_id').val(supplierid);
						$('#client_type_id').val(data[0].client_type_id);
						$('#reference_id').html("<option value='"+data[0].reference_id+"'>"+data[0].supplier_name+"</option>");
						$("input[name='vatable'][value='"+data[0].vatable+"']").prop('checked', true);
						$('#status_id').val(data[0].status_id);


						var typeid = data[0].client_type_id;
						var referenceid = data[0].reference_id;
						getSupplierDetails(typeid, referenceid);
						
						if (typeid == 1) {
							$('#frm_person').show();
							$('#frm_company').hide();

							$('#tr_homephone').show();
							$('#tr_personalemail').show();
						} else {
							$('#frm_person').hide();
							$('#frm_company').show();

							$('#tr_homephone').hide();
							$('#tr_personalemail').hide();
						}
						$('#frm_information').attr('action', baseurl+'Logistics/Supplier/updateSupplier');
					},
					error: function(errorThrown){
						toastr.error('Something is Amiss!', 'Operation Done');
						console.log(errorThrown);
					}
				});//end ajax
			});//end dblclick
		
			$('#editpic').click(function(){
				$('#profilechange').show();
				$('#imageselect').hide();
				$('#userfile').attr('name', 'userfile');
			});

			if (jQuery().datepicker) {
				$('#birthdate').datepicker({
					rtl: App.isRTL(),
					format: 'yyyy-mm-dd',
					orientation: 'left',
					autoclose: true
				});
			}

			$('#birthdate').keyup(function(){
				var v = this.value;
				if (v.match(/^\d{4}$/)){
					this.value = v + '-';
				} else if (v.match(/^\d{4}\-\d{2}$/)){
					this.value = v + '-';
				}
			});

			$('#btn_back').click(function(){
				clearForm();
				closeForm();
				document.body.scrollTop = 0;
				document.documentElement.scrollTop = 0;
			});
			$('#btn_back2').click(function(){
				clearForm();
				closeForm();
				document.body.scrollTop = 0;
				document.documentElement.scrollTop = 0;
			});

			$('#btn_save').click(function(){
				validateForms();
			});
			
			function closeForm(){
				$('#frm_masterlist').show();
				$('#frm_information').hide();

				$('#frm_company').hide();
				$('#frm_person').hide();			
			}
			
			function clearForm(){
				$('#supplier_id').val('');

				$("input[name='vatable'][value='0']").prop('checked', true);
				$('#status_id').val('1');

				$('#person_id').val('');
				$('#prefix').val('');
				$('#suffix').val('');
				$('#lastname').val('');
				$('#firstname').val('');
				$('#middlename').val('');
				$('#sex').val(' ');
				$('#civil_status_id').val('');
				$('#nationality').val('');
				$('#birthdate').val('');
				$('#birthplace').val('');
				$('#ptin').val('');

				$('#organization_id').val('');
				$('#organization_name').val('');
				$('#tin').val('');
				$('#special_instruction').val('');

				$('#contact_id1').val('');
				$('#contact_id2').val('');
				$('#contact_id3').val('');
				$('#contact_id4').val('');
				$('#contact_id5').val('');
				$('#contact_value1').val('');
				$('#contact_value2').val('');
				$('#contact_value3').val('');
				$('#contact_value4').val('');
				$('#contact_value5').val('');

				$('#address_id').val('');
				$('#line_1').val('');
				$('#line_2').val('');
				$('#line_3').val('');
				$('#city_id').val('');
				$('#province_id').val('');
				$('#country_id').val('');
				$('#postal_code').val('');
			}

			function getSupplierDetails(typeid,referenceid){
				$.ajax({
					type: 'POST',
					url: baseurl + 'Logistics/Supplier/getSupplierInfo',
					dataType: 'json',
					data: {typeid: typeid, referenceid : referenceid},
					success: function(data){
						if (typeid == 1) {
							$('#person_id').val(data[0].person_id);
							$('#lastname').val(data[0].lastname);
							$('#firstname').val(data[0].firstname);
							$('#middlename').val(data[0].middlename);
							$('#prefix').val(data[0].prefix);
							$('#suffix').val(data[0].suffix);
							$('#sex').val(data[0].sex);
							
							$('#birthdate').val(data[0].birthdate);
							$('#birthplace').val(data[0].birthplace);
							$('#nationality').val(data[0].nationality);
							$('#civil_status_id').val(data[0].civil_status_id);
							$('#ptin').val(data[0].tin);
								
							var filename = baseurl+'public/images/profiles/3934.jpg';
							if (typeof data[0].picture_url != 'undefined' && data[0].picture_url != null && data[0].picture_url != ''){
								filename = baseurl+'public/images/profiles/' + data[0].picture_url;
							}	
							$('#profilepicture').attr('src', filename);
							$('#userfile').attr('name','notuserprofile');
							$('#profilechange').hide();
							$('#imageselect').show();

							// supplier address
							$.ajax({
								type: 'POST',
								url: baseurl + 'Logistics/Supplier/getPersonAddressInfo',
								dataType: 'json',
								data: {personid: referenceid},
								success: function(data){
									$('#address_id').val(data[0].address_id);
									$('#address_type_id').val(data[0].address_type_id);
									$('#line_1').val(data[0].line_1);
									$('#line_2').val(data[0].line_2);
									$('#line_3').val(data[0].line_3);
									$('#city_id').val(data[0].city_id);
									$('#province_id').val(data[0].province_id);
									$('#country_id').val(data[0].country_id);
									$('#postal_code').val(data[0].postal_code);
								},
								error: function(errorThrown){
									toastr.error('Something is Amiss!', 'Operation Failed');
									console.log(errorThrown);
								}
							});				

							// supplier contact
							$.ajax({
								type: 'POST',
								url: baseurl + 'Logistics/Supplier/getPersonContactInfo',
								dataType: 'json',
								data: {personid: referenceid},
								success: function(data){
										
									if (data.length > 0) {
										$.each(data, function(index, value){
											switch(data[index].contact_type_id){
												case '1':
													$('#contact_id1').val(data[index].contact_id);
													$('#contact_value1').val(data[index].contact_value);
													break;
												case '2':
													$('#contact_id2').val(data[index].contact_id);
													$('#contact_value2').val(data[index].contact_value);
													break;
												case '3':
													$('#contact_id3').val(data[index].contact_id);
													$('#contact_value3').val(data[index].contact_value);
													break;
												case '4':
													$('#contact_id4').val(data[index].contact_id);
													$('#contact_value4').val(data[index].contact_value);
													break;
												case '5':
													$('#contact_id5').val(data[index].contact_id);
													$('#contact_value5').val(data[index].contact_value);
													break;
											}
										});
									}
								},
								error: function(errorThrown){
									toastr.error('Something is Amiss!', 'Operation Failed');
									console.log(errorThrown);
								}
							});	


						} else {
							$('#organization_id').val(data[0].organization_id);
							$('#organization_name').val(data[0].organization_name);
							$('#tin').val(data[0].tin);
							$('#special_instruction').val(data[0].special_instruction);

							// supplier address
							$.ajax({
								type: 'POST',
								url: baseurl + 'Logistics/Supplier/getCompanyAddressInfo',
								dataType: 'json',
								data: {organizationid: referenceid},
								success: function(data){
									$('#address_id').val(data[0].address_id);
									$('#address_type_id').val(data[0].address_type_id);
									$('#line_1').val(data[0].line_1);
									$('#line_2').val(data[0].line_2);
									$('#line_3').val(data[0].line_3);
									$('#city_id').val(data[0].city_id);
									$('#province_id').val(data[0].province_id);
									$('#country_id').val(data[0].country_id);
									$('#postal_code').val(data[0].postal_code);
								},
								error: function(errorThrown){
									toastr.error('Something is Amiss!', 'Operation Failed');
									console.log(errorThrown);
								}
							});				

							// supplier contact
							$.ajax({
								type: 'POST',
								url: baseurl + 'Logistics/Supplier/getCompanyContactInfo',
								dataType: 'json',
								data: {organizationid: referenceid},
								success: function(data){
									if (data.length > 0) {
										$.each(data, function(index, value){
											switch(data[index].contact_type_id){
												case '1':
													$('#contact_id1').val(data[index].contact_id);
													$('#contact_value1').val(data[index].contact_value);
													break;
												case '2':
													$('#contact_id2').val(data[index].contact_id);
													$('#contact_value2').val(data[index].contact_value);
													break;
												case '3':
													$('#contact_id3').val(data[index].contact_id);
													$('#contact_value3').val(data[index].contact_value);
													break;
												case '4':
													$('#contact_id4').val(data[index].contact_id);
													$('#contact_value4').val(data[index].contact_value);
													break;
												case '5':
													$('#contact_id5').val(data[index].contact_id);
													$('#contact_value5').val(data[index].contact_value);
													break;
											}
										});
									}
								},
								error: function(errorThrown){
									toastr.error('Something is Amiss!', 'Operation Failed');
									console.log(errorThrown);
								}
							});	
							
						}
					},
					error: function(errorThrown){
						toastr.error('Something is Amiss!', 'Operation Failed');
						console.log(errorThrown);
					}
				});//end ajax
			}//end function

			function validateForms(){

			}

		}// end handlemasterlist
		return {
			init: function(){
				_init();
			}
		};
	}();//end masterlist

jQuery(document).ready(function(){
	masterlist.init();
});