var Dashboard = function() {

    return {

        initAmChart3: function() {
            if (typeof(AmCharts) === 'undefined' || $('#dashboard_amchart_3').size() === 0) {
                return;
            }

            $.ajax({
			    type: "POST",
			    url:  baseurl + "collection/get_monthly_sales2",
			    success: function(result){
			    	var data = jQuery.parseJSON(result);
					console.log(data);
					
					var monthNames = ["January", "February", "March", "April", "May", "June",
					  "July", "August", "September", "October", "November", "December"
					];
					// console.log(monthNames[data[0].month]);
					var guides = [];
					for ( var i = 0; i < data.length; i++ ) {
						var monthnumber = Number(data[i].month);
						console.log(monthnumber);
						monthnumber = monthnumber - 1;
						console.log(monthnumber);
					    guides.push( {
					      "year": monthNames[monthnumber],
		                  "income": data[i].monthlySales2,
		                  "expenses": data[i].monthlySales2
					    } );
					}
					console.log(guides);
		            var chart = AmCharts.makeChart("dashboard_amchart_3", {
		                "type": "serial",
		                "addClassNames": true,
		                "theme": "light",
		                "path": "../assets/global/plugins/amcharts/ammap/images/",
		                "autoMargins": true,
		                // "marginLeft": 30,
		                // "marginRight": 8,
		                // "marginTop": 10,
		                // "marginBottom": 26,
		                "balloon": {
		                    "adjustBorderColor": false,
		                    "horizontalPadding": 10,
		                    "verticalPadding": 8,
		                    "color": "#141212"
		                },

		                "dataProvider": guides,
		                "valueAxes": [{
		                    "axisAlpha": 0,
		                    "position": "left"
		                }],
		                "startDuration": 1,
		                "graphs": [{
		                    "alphaField": "alpha",
		                    "balloonText": "<span style='font-size:12px;'>[[title]] in [[category]]:<br><span style='font-size:20px;'>[[value]]</span> [[additional]]</span>",
		                    "fillAlphas": 1,
		                    "title": "Income",
		                    "type": "column",
		                    "valueField": "income",
		                    "dashLengthField": "dashLengthColumn"
		                }, {
		                    "id": "graph2",
		                    "balloonText": "<span style='font-size:12px;'>[[title]] in [[category]]:<br><span style='font-size:20px;'>[[value]]</span> [[additional]]</span>",
		                    "bullet": "round",
		                    "lineThickness": 3,
		                    "bulletSize": 7,
		                    "bulletBorderAlpha": 1,
		                    "bulletColor": "#FFFFFF",
		                    "useLineColorForBulletBorder": true,
		                    "bulletBorderThickness": 3,
		                    "fillAlphas": 0,
		                    "lineAlpha": 1,
		                    "title": "Expenses",
		                    "valueField": "expenses"
		                }],
		                "categoryField": "year",
		                "categoryAxis": {
		                    "gridPosition": "start",
		                    "axisAlpha": 0,
		                    "tickLength": 0
		                },
		                "export": {
		                    "enabled": true
		                }
		            });
		        },
				error: function(data){

				},
			});

            
        },

        init: function() {
            this.initAmChart3();
        }
    };

}();

if (App.isAngularJsApp() === false) {
    jQuery(document).ready(function() {
        Dashboard.init(); // init metronic core componets
    });
}

function getData(x){
	$.ajax({
	    type: "POST",
	    url:  baseurl + "collection/get_monthly_sales2",
	    success: function(result){
	    	var data = jQuery.parseJSON(result);
			console.log(data);
			var monthNames = ["January", "February", "March", "April", "May", "June",
			  "July", "August", "September", "October", "November", "December"
			];
			console.log(monthNames[data[0].month]);
			var guides = [];
			for ( var i = 0; i < data.length; i++ ) {
			    guides.push( {
			      "month": monthNames[data[i].month],
                  "income": data[i].monthlySales2,
                  "expenses": data[i].monthlySales2
			    } );
			}
			return guides;
			console.log(guides);
		},
		error: function(data){

		},
	});
}