var legacyreport = function(){
	var _init = function(){
		var legacy_contract_tbl = $("#legacy_contract_tbl").DataTable({searching: false, "columnDefs" : [{
                "targets": [ 0 ],
                "visible": false,
                "searchable": false,
                }
            ]
        });
		
		
		
		
		
		
		
        // FUNCTIONS
        function jFormatNumber(a) {
		    try {
		        return parseFloat(a).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,")
		    } catch (a) {
		        return "Error FORMAT"
		    }
		}
		function jFormatNumberRet(a) {
		    try {
		        return parseFloat(a.replace(/,/g, ""))
		    } catch (a) {
		        return "Error FORMAT"
		    }
		}
	}
	return {
		init: function(){
			_init();
		}
	};
}();
jQuery(document).ready(function(){
	// $("<style type='text/css'> .selected{ background:#acbad4;} </style>").appendTo("head");
	legacyreport.init();
});