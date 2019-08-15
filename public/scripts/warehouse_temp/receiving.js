var receiving = function(){
	var _init = function(){
		var tbl_rr_lists = $("#tbl_rr_lists").DataTable({searching: true, "columnDefs": [
                {
                    "targets": [0],
                    "visible": false,
                    "searchable": false
                }
            ]
        });

        var tbl_rritem_lists = $("#tbl_rritem_lists").DataTable({paging: false, sorting: false, searching: false, "columnDefs": [
                {
                    "targets": [],
                    "visible": false,
                    "searchable": false
                }
            ]
        });

		tbl_rr_lists.on('click', 'tbody tr', function(e){
        	e.preventDefault();

	        var row = $(this).closest('tr')[0];
	        var rr_id = tbl_rr_lists.cell(row, 1 ).data();

			$("#tbl_rr_lists tr").each(function () {
	            if ( $(this).hasClass('highlight') ) {
	                $(this).removeClass('highlight');
	            }
	        });
	        $(this).addClass("highlight");

	        $.ajax({
				type: "POST",
	            url : baseurl + "warehouse_temp/get_onerr",
	            dataType : "json",
	            data: {'rr_id': rr_id},
	            success : function(data){
	            	tbl_rritem_lists.clear().draw();

	            	$.each(data, function(i, value){
						tbl_rritem_lists.row.add([
							data[i].rr_detail_id,
							data[i].description,
							data[i].qty_rcv,
						]).draw(false);
						// alert(data[i].description);
	                });
	            },  
	            error: function(errorThrown){
	                console.log(errorThrown);
	            }
			});


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
});
