var maps = function(){
	var _init = function(){
		
		//Selection of lot to fill textboxes
		$('#opt_lot').change(function(){
			var lot_id = $(this).val();
			// alert("OK");
			$.ajax({
	            type: "POST",
	            url : baseurl + "maps/get_lot",
	            dataType : "json",
	            data: {'lot_id' : lot_id},
	            success : function(data){
            	    $('#lot_flooraea').val(data[0].floor_area);
					$('#lot_length').val(data[0].lot_length);
					$('#lot_width').val(data[0].lot_width);
					// $('#userfile').val(data[0].picture_url);
					console.log(data[0].floor_area+ " " +data[0].lot_height+ " " +data[0].lot_width);
	            }, 
	            error: function(errorThrown){
	                console.log(errorThrown);
	            }
	        });
			// $('#lot_flooraea').val();
			// $('#lot_length').val();
			// $('#lot_width').val();
			// $('#userfile').val();
		});

		//Save changes to database
		$('#submit_lotinfo').click(function(){

			var data = {
				'lot_id' : $('#opt_lot').val(),
				'userfile' : $('#userfile').val(),
				'lot_length' : $('#lot_length').val(),
				'lot_width' : $('#lot_width').val(),
				'floor_area' : $('#lot_flooraea').val(),
			};

			$.ajax({
	            type: "POST",
	            url : baseurl + "maps/save_lot_info",
	            // dataType : "json",
	            data: data,
	            success : function(data){
	            	// alert(data);
	    			//$('#lot_flooraea').val('');
					// $('#lot_length').val('');
					// $('#lot_width').val('');

            	    toastr.options.timeOut = 500;
					toastr.info('Successfully Saved.', 'Operation done');
	            }, 
	            error: function(errorThrown){
	                console.log(errorThrown);
	            }
	        });
		});

		$('#form').submit(function(e){
			// alert($('#userfile').val());
			e.preventDefault();
			// var data = {
			// 	'lot_id' : $('#opt_lot').val(),
			// 	'userfile' : $('#userfile').val(),
			// 	'lot_length' : $('#lot_length').val(),
			// 	'lot_width' : $('#lot_width').val(),
			// 	'floor_area' : $('#lot_flooraea').val(),
			// };

			$.ajax({
	            url: baseurl + "maps/do_upload",
	            type: "post",
	            data: new FormData(this),
	            // processData: false,
	            // contentType: false,
	            // cache: false,
	            // async: false,
	            success: function(data){
	                alert(data);
	            }
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
	maps.init();
});










