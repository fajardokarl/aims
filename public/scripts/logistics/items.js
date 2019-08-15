jQuery(document).ready( function($) {
    App.setAssetsPath( baseurl + 'assets/' );
	$( "#specs_form" ).on( "submit", function(e) {
		e.preventDefault();

		// console.log("ID: " + $("#item_id").val());
		// console.log("BRAND: " + $("#item_brand").val());
		// console.log("COLOR: " + $("#item_color").val());
		// console.log("SIZE: " + $("#item_size").val());
		// console.log("QUANTITY: " + $("#item_quantity").val());

		var item_specs = { specs_id: '', item_id: $("#item_id").val(), category: $("#category_id").val(), brand: $("#item_brand").val(), color: $("#item_color").val(),
		size: $("#item_size").val(), quantity: $("#item_quantity").val() };

		// console.log(item_specs);

		$this = $(this);
        var url = $this.attr("action");
        console.log(url);
		$.ajax({
		    type: "POST",
		    url: url,
		    data: { item_specs: item_specs },
		    success : function(){
		    	location.reload();
		    },  
		    error: function(errorThrown){
		        console.log(errorThrown);
		    }
		});
	});

	$( "#item_id" ).on( "change", function() {
		item_id = $("#item_id").val();
		$.ajax({
			type: "POST",
			url : $("#item_id").data("url"),
			dataType : "json",
			data: { item_id: item_id },
			success : function(data){
				$("#item_category").val(data[0]['description']);
			},  
			error: function(errorThrown){
				console.log(errorThrown);
			}
		});
	});

	$( "button.edit_spec" ).on( "click", function() {
		var data = { specs_id: $(this).data("spec"), item_id: $(this).data("item") };
		spec_val = $(this).data("spec");
		$.ajax({
			type: "POST",
			url : $(".edit_spec").data("url"),
			dataType : "json",
			data: { data: data },
			success : function(data){
				console.log(data[0]['category']);
				$("#edit_item_spec_id").val(spec_val);
				$("#edit_item_category").val(data[0]['category']);
				$("#edit_item_brand").val(data[0]['brand']);
				$("#edit_item_color").val(data[0]['color']);
				$("#edit_item_size").val(data[0]['size']);
				// $("#edit_item_quantity").val(data[0]['quantity']);
			},  
			error: function(errorThrown){
				console.log(errorThrown);
			}
		});
	});

	$( "#confirm_edit" ).on( "click", function(e) {
		e.preventDefault();
        console.log("YOW");
		var edit_item_specs = { specs_id: $("#edit_item_spec_id").val(), category: $("#edit_item_category").val(), brand: $("#edit_item_brand").val(),
		color: $("#edit_item_color").val(), size: $("#edit_item_size").val() };
		$.ajax({
			type: "POST",
			url: $("#form_edit_spec").attr("action"),
			data: { item_specs: edit_item_specs },
			success : function(){
				location.reload();
			},  
			error: function(errorThrown){
				console.log(errorThrown);
			}
		});

	})  

	$( "button.delete_spec" ).on( "click", function() {
		$("#spec_id").val($(this).val());
	});

	$( "#confirm_delete" ).on( "click", function(e) {
		e.preventDefault();
		spec_id = $("#spec_id").val();
		$.ajax({
			type: "POST",
			url : $("#form_delete_spec").attr("action"),
			data: { spec_id: spec_id },
			dataType : "json",
			success : function(){
				console.log("YOW");
				location.reload();
			},  
			error: function(errorThrown){
				console.log(errorThrown);
			}
		});
	});
});