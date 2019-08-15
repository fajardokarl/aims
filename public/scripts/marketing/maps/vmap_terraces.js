jQuery(document).ready(function()
            {   
                jQuery('#vmap').vectorMap({
                    map: 'terraces',
                    enableZoom: false,
                    // showTooltip: false,
                    onRegionClick: function(element, code, region){
                        if (code != "road" && code != '') {
                            $.ajax({
                                type: "POST",
                                url : baseurl + "maps/get_lot",
                                dataType : "json",
                                data: {'lot_id': code},
                                success : function(data){
                                    var stat, is_booked, is_invoiced, house_lot, house_pic;

                                    if (data[0].availability == 0) {
                                        if (data[0].is_booked == 0 || data[0].is_booked == null) {
                                            is_booked = "<span class='font font-red bold'>NO</span>";
                                        }else{
                                            is_booked = "<span class='font font-green-jungle bold'>YES</span>" 
                                        }

                                        if (data[0].is_invoiced == 0 || data[0].is_invoiced == null) {
                                            is_invoiced = "<span class='font font-red bold'>NO</span>";
                                        }else{
                                            is_invoiced = "<span class='font font-green-jungle bold'>YES</span>" 
                                        }

                                        // $('#map_contno').html(data[0].contract_id);
                                        // $('#map_custname').html(data[0].lastname + ", " + data[0].firstname + " " + data[0].middlename);
                                        // $('#map_contadate').html(data[0].contract_date);
                                        // $('#map_plantype').html(data[0].payment_scheme_name);
                                        // $('#map_booked').html(is_booked);
                                        // $('#map_invoiced').html(is_invoiced); 
                                        // $('#col_body').removeClass('portlet-collapsed');
                                        // $('#col_body').addClass('portlet-collapsed');
                                        // $('#map_portlet_contract').show();

                                        stat = "<span class='font font-red bold'> [SOLD] </span>";
                                    }else{
                                        $('#map_portlet_contract').hide();
                                        stat = "<span class='font font-green-jungle bold'> [VACANT] </span>";
                                    }

                                    if (data[0].with_house == 1) {
                                        house_lot = "<span class='font font-green-jungle'><i class='fa fa-home'></i> with House</span>";
                                    }else{
                                        house_lot = "<span class='font font-red'><i class='fa fa-home'></i> without House</span>";
                                    }

                                  


                                    $('#house_lot').html(house_lot);
                                    $('#lot_desc').html(stat + data[0].lot_description);
                                    $('#map_lotarea').html(data[0].lot_area + " Sq M");
                                    
                                    // $('#map_tcp').html(jFormatNumber((data[0].lot_area * data[0].price_per_sqr_meter) + parseInt(data[0].house_price)));
                                    // $('#map_ppsqm').html(jFormatNumber(data[0].price_per_sqr_meter));
                                    // $('#map_hprice').html(jFormatNumber(data[0].house_price));

                                    $('#lot_detail').modal('toggle');

                                }, 
                                error: function(errorThrown){
                                    console.log(errorThrown);
                                }
                            });
                            
                        }else{
                            jQuery('#vmap').vectorMap('set', 'selectedColor', {'road':'white'});
                        }

                    },
                    selectedColor: 'yellow',
                    hoverColor: 'white',
                    borderColor: 'black',
                    color: '#f7ffbb',
                    backgroundColor: 'rgba(255, 255, 255, 0)',
                    showLabels: true,
                    showTooltip: true,
                    // onLabelShow: function (event, label, code) {
                    //         if(sample_data[code] > 0)
                    //             label.append(': '+sample_data[code]+' Views'); 
                    //     }
                });


                $.ajax({
                    type: "POST",
                    url : baseurl + "maps/get_all_lots",
                    dataType : "json",
                    data: {'a': 'a'},
                    success : function(data){
                            
                        $.each(data, function (index, value){
                            var availability = data[index].availability;
                            var lot_id = data[index].lot_id;

                            if (data[index].availability == 1) {
                                change_color(lot_id, '#6bc979');
                            }else{
                                change_color(lot_id, '#ff8080');
                            }
                        });
                    }, 
                    error: function(errorThrown){
                        console.log(errorThrown);
                    }
                });


                $('#close_mapdet').click(function(){
                    // $("#collapsible").trigger("click");
                    $('#col_body').RemoveClass('portlet-collapsed');
                    $('#col_body').addClass('portlet-collapsed');
                });




                function change_color(val, color){
                    var arr = {};
                    arr[val] = color;
                    jQuery('#vmap').vectorMap('set', 'colors', arr);
                }

                function jFormatNumber(a) {
                    try {
                        return parseFloat(a).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,")
                    } catch (a) {
                        return "Error FORMAT"
                    }
                }

            });
