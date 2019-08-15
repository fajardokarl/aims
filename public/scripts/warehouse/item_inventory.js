var receiving = function(){
	var _init = function(){

			$('#tbl_issuances').DataTable();

		    $( 'select#warehouse-filter' ).on( 'change', function () {
		    	var filter = $(this).children("option:selected").val();
		    	console.log(tbl_po_lists.column(2).search() !== filter);
	            if ( filter == "None" ) {
	            	tbl_po_lists
	                    .column(2)
	                    .search( "" )
	                    .draw();
	            } else if ( tbl_po_lists.column(2).search() !== filter ) {
	            	console.log("Filter");
	            	tbl_po_lists
	                    .column(2)
	                    .search( filter )
	                    .draw();
	            }
	        } );
		 
		    var tbl_po_lists = $('#po_table').DataTable( {
		        orderCellsTop: true,
		        fixedHeader: true
		    } );

			tbl_po_lists.on('click', 'tbody tr', function(e){
        	e.preventDefault();

	        var row = $(this).closest('tr')[0];
	        var po_id = tbl_po_lists.cell(row, 0 ).data();

				$("#po_table tr").each(function () {
		            if ( $(this).hasClass('highlight') ) {
		                $(this).removeClass('highlight');
		            }
		        });
		        $(this).addClass("highlight");
		  //       $.ajax({
				// 	type: "POST",
		  //           url : baseurl + "warehouse_temp/get_onepo",
		  //           dataType : "json",
		  //           data: {'po_id': po_id},
		  //           success : function(data){
		  //           	po_table.clear().draw();

		  //           	$.each(data, function(i, value){
				// 			po_table.row.add([
				// 				data[i].item_id,
				// 				data[i].description,
				// 				data[i].uom_name,
				// 				data[i].po_qty,
				// 				data[i].po_received,
				// 				data[i].po_status,
				// 			]).draw(false);
		  //               });
		  //           },  
		  //           error: function(errorThrown){
		  //               console.log(errorThrown);
		  //           }
				// });


	        // alert(issuance_id);
        });

	}	
	return {
		init: function(){
			_init();
		}
	};
}();

jQuery(document).ready(function(){
    $("<style type='text/css'> .highlight{ background:#99b3ff;} </style>").appendTo("head");
	// $("<style type='text/css'> .borderless td, .borderless th { border: none;} </style>").appendTo("head");
	receiving.init();

	$('#print').on('click', function () {
		var css = '@page { size: landscape; }',
		    head = document.head || document.getElementsByTagName('head')[0],
		    style = document.createElement('style');

		style.type = 'text/css';
		style.media = 'print';

		if (style.styleSheet){
		  style.styleSheet.cssText = css;
		} else {
		  style.appendChild(document.createTextNode(css));
		}

		head.appendChild(style);
		window.print();
	});
});
