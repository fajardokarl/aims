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
                                url : baseurl + "marketing/get_one_lot",
                                dataType : "json",
                                data: {'lot_id': code},
                                success : function(data){
                                    var stat, is_booked, is_invoiced;

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

                                        $('#map_contno').html(data[0].contract_id);
                                        $('#map_custname').html(data[0].lastname + ", " + data[0].firstname + " " + data[0].middlename);
                                        $('#map_contadate').html(data[0].contract_date);
                                        $('#map_plantype').html(data[0].payment_scheme_name);
                                        $('#map_booked').html(is_booked);
                                        $('#map_invoiced').html(is_invoiced); 
                                        $('#col_body').removeClass('portlet-collapsed');
                                        $('#col_body').addClass('portlet-collapsed');
                                        $('#map_portlet_contract').show();

                                        stat = "<span class='font font-red bold'> [SOLD] </span>";
                                    }else{
                                        $('#map_portlet_contract').hide();
                                        stat = "<span class='font font-green-jungle bold'> [VACANT] </span>";
                                    }


                                    $('#lot_desc').html(stat + data[0].lot_description);
                                    $('#map_tcp').html(jFormatNumber((data[0].lot_area * data[0].price_per_sqr_meter) + parseInt(data[0].house_price)));
                                    $('#map_lotarea').html(data[0].lot_area);
                                    $('#map_ppsqm').html(jFormatNumber(data[0].price_per_sqr_meter));
                                    $('#map_hprice').html(jFormatNumber(data[0].house_price));

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
                    backgroundColor: 'rgba(255, 255, 255, 0.01)',
                    showLabels: true,
                    onLabelShow: function(event, label, code){
                        if (code == 10) {
                            label.html('<div class="map-tooltip"><h1 class="header">Header</h1><p class="description">Some Description</p></div>');
                        }
                        // $.ajax({
                        //     type: "POST",
                        //     url : baseurl + "marketing/get_one_lot",
                        //     dataType : "json",
                        //     data: {'lot_id': code},
                        //     success : function(data){
                                

                        //     }, 
                        //     error: function(errorThrown){
                        //         console.log(errorThrown);
                        //     }
                        // });
                    }
                });
                jQuery('#vmap').bind('labelShow.jqvmap',
                function(event, label, code)
                    {
                        if (code == 2) {
                            label.html('<div class="map-tooltip"><h1 class="header">1</h1><p class="description">1</p></div>');
                        }
                    }
                );

                jQuery('#vmap').vectorMap('set', 'colors', {'road':'white'});



                $.ajax({
                    type: "POST",
                    url : baseurl + "marketing/get_all_lots",
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
