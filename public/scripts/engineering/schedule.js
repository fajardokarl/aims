var sched = function(){
	var _init = function(){
		var globalColNum;
		var tbl_col = $("#tbl_col").DataTable({searching: false, paging: false});
		var tbl_items = $("#tbl_items").DataTable({searching: false, paging: false});


	// TRIGGERS
		$("#btn _col").click(function(){
			globalColNum = $("#days").val();

			var duration = $("#days").val();
			var test_row = $("#test_row").val();
			
			// $("#tbl_col").find('td').eq(1).after('<td>new cell added</td>');
			if (duration != '' && test_row != '' && (duration != 0 && test_row != 0)) {
				$("#tbl_head").html("");
				$("#tbl_body").html("");
				// for (var i = 1; i <= duration; i++) { 
				// 	$("#tbl_head").append("<th>"+ i +"h</th>");
				// 	// $("#tbl_body").append("<td>"+ i +"b</td>");
				// }

				for (var i = 1; i <= test_row; i++) {
					$("#tbl_body").append("<tr class='tr"+ i +"'>");
					for (var j = 1; j <= duration; j++) {
						// if ((j%2) == 0 ) {
							$(".tr" + i + "").append("<td class='odd'> ROW - " + i + " COL - " + j +" </td>");
						// }else{
						// 	$(".tr" + i + "").append("<td class='even'> ROW - " + i + " COL - " + j +" </td>");
						// }
					}
					$("#tbl_body").append("</tr>");
				}
			}else{
				toastr.options.timeOut = 500;
    			toastr.error('Complete Required Fields!', 'Warning!');
			}
		});


		$("#btn_addto_tbl").click(function(){
			
		});	


	// FUNCTIONS

	// function myFunc(){
	// }


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
	sched.init();
});

// a = duration of the project[in days]


// for(i = 1; i <= [a]; i++){


// }

// code below to change/add a cell's CSS properties
	// var sample = tbl_assets.cell(row, 6 ).node();
	// $(sample).css('background-color', '#ffcfcf');
	// console.log(sample);
