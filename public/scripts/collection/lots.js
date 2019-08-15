$(document).ready(function(){
	
	var lots_table = $('#all_lots').DataTable();
	lots_table.on('click', '.btn-lot-edit', function (e) {
                e.preventDefault();
                var row = $(this).closest('tr')[0];
                var lot_id = lots_table.cell(row, 0 ).data();
                console.log(lot_id);
                $.ajax({
                    type: "POST",
                    url:  baseurl + "marketing/get_one_lot",
                    dataType: "json",
                    data: {'lot_id': lot_id},
                    success: function(data){
                    	// alert(lot_id);
                      $("#lot_id").val(lot_id);
                    	$("#txt_project_name").html(data[0].project_name);
						          $("#txt_phase_name").html(data[0].phase_name);
          						$("#txt_block_no").html(data[0].block_no);
          						$("#txt_lot_price").html("&#8369;" + jFormatNumber((parseInt(data[0].lot_area * data[0].price_per_sqr_meter))));
          						$("#price_p_sqm").val((data[0].price_per_sqr_meter));
          						$("#house_price").val((data[0].house_price));
                      $("#tct").html(data[0].tct_no);
                      $("#tax_dec_no").html(data[0].tax_declaration_no);
                      $("#cor_no").html(data[0].cor_no);
                      $("#lot_area").val(data[0].lot_area);
                      $("#total_price").val(((parseInt(data[0].lot_area * data[0].price_per_sqr_meter) + parseInt(data[0].house_price))));
						          // $("#txt_house_price").html(data[0].house_price);
                      if (data[0].availability == 0 || data[0].availability != null) {
                        if (data[0].contract_id != null) {
                          $("#lot_status").html("<a target='_blank' href='"+ baseurl +"marketing/amortizationdetails?contractid=" + data[0].contract_id + "'>" + data[0].lastname + ", " + data[0].firstname + " " + data[0].middlename + "</a>");
                        }else{
                          $("#lot_status").html(" Available");
                        }
                      }else{
                        $("#lot_status").html(" Available");
                      }
                    },
                    error: function (errorThrown){
                        console.log(errorThrown)
                        toastr.error('Error!.', 'Operation Done');
                    }
                });

            });

  // $("#try").click(function(){
  //  console.log(parseInt( $("#house_price").val().replace(/[^0-9\.]/g, ''), 10));
  // });
  // $("#price_p_sqm").change(function(){
  //   $(this).val(jFormatNumber($(this).val()));
  // });
  // $("#house_price").change(function(){
  //   $(this).val(jFormatNumber($(this).val()));
  // });

	$('#update_lot').click(function(){
    console.log(jFormatNumberRet($("#price_p_sqm").val()));
		var id_lot = $("#lot_id").val();
        var data = {
            'lot_id': id_lot, 
            'price_p_sqm': jFormatNumberRet($("#price_p_sqm").val()),  
            'house_price': $("#house_price").val(),
            'tct': $("#tct").val(),
            'tax_dec_no': $("#tax_dec_no").val(),
            'cor_no': $("#cor_no").val(),
            'lot_area': $("#lot_area").val()

        };
	  $.ajax({
            type: "POST",
            url:  baseurl + "marketing/update_lot",
            dataType: "json",
            data: data,
            success: function(data){
            	$('#view-lots').modal('toggle');
        		location.reload();

        		toastr.success('Successfully Saved!', 'Operation Done');
            },
            error: function (errorThrown){
                console.log(errorThrown)
                toastr.error('Error!.', 'Operation Done');
            }
          });

	});


  $( "#all_project" ).change(function() {
    var av = "NO";
      
      if ($(this).val() == 0) {
        $.ajax({ 
              type: "POST",
              url: baseurl+'marketing/get_all_lots',
              dataType: 'json',
              data: {'projectid' : $(this).val()},
              success: function(data){
                          //toastr.info('Successfully saved!.', 'Operation done');
                          lots_table.clear().draw();
                          for (var i = 0; i < data.length; i++) {
                              if (data[i].availability == 1) {
                                av = "<span class='font-green-jungle bold'>YES</span>"
                              }else{
                                av ="<span class='font-red-intense bold'>NO</span>"
                              }
                              var price = 0;
                              price = parseFloat((parseFloat(data[i].lot_area) * parseFloat(data[i].price_per_sqr_meter)) + (parseFloat(data[i].house_price) + parseFloat(data[i].lot_vat)));
                              lots_table.row.add( [
                                            data[i].lot_id,
                                            data[i].lot_description,
                                            data[i].lot_area + " Sq m",
                                            "&#8369;" + jFormatNumber(data[i].price_per_sqr_meter),
                                            "&#8369;" + jFormatNumber(data[i].house_price),
                                            "&#8369;" + jFormatNumber(data[i].lot_vat),
                                            "&#8369;" + jFormatNumber(price),
                                            av,
                                            '<button type="button" class="btn blue-dark btn-lot-edit btn-xs" data-toggle="modal" data-target="#view-lots" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Edit</button>' 
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
              url: baseurl+'marketing/retrieve_project_byid',
              dataType: 'json',
              data: {'projectid':$(this).val()},
              success: function(data){
                          //toastr.info('Successfully saved!.', 'Operation done');
                          lots_table.clear().draw();
                          for (var i = 0; i < data.length; i++) {
                              if (data[i].availability == 1) {
                                av = "<span class='font-green-jungle bold'>YES</span>"
                              }else{
                                av ="<span class='font-red-intense bold'>NO</span>"
                              }
                              var price = 0;
                              price = parseFloat((parseFloat(data[i].lot_area) * parseFloat(data[i].price_per_sqr_meter)) + (parseFloat(data[i].house_price) + parseFloat(data[i].lot_vat)));
                              lots_table.row.add( [
                                            data[i].lot_id,
                                            data[i].lot_description,
                                            data[i].lot_area + " Sq m",
                                            "&#8369;" + jFormatNumber(data[i].price_per_sqr_meter),
                                            "&#8369;" + jFormatNumber(data[i].house_price),
                                            "&#8369;" + jFormatNumber(data[i].lot_vat),
                                            "&#8369;" + jFormatNumber(price),
                                            av,
                                            '<button type="button" class="btn blue-dark btn-lot-edit btn-xs" data-toggle="modal" data-target="#view-lots" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Edit</button>' 
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
});

function jFormatNumber(a) {
    try {
        return parseFloat(a).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,")
    } catch (a) {
        return "Error FORMAT"
    }
}