<script type="text/javascript">
var masterlist = function(){
	var _init = function(){

		$('#tbl_masterlist tr').click(function(){
			console.log('clicked');
			$('#txt_main').val($(this).find('td').first().text());
			console.log($(this).find('td').first().text());
			var personid = $('#txt_main').val();
			$.ajax({
				type: "POST",
				url: baseurl + "merger/findPersonByID",
				dataType: 'json',
				data: {'personid': personid},
				success: function(data){
					console.log(data);
					$('#txt_last').val(htmlDecode(data[0].lastname));
					$('#txt_first').val(htmlDecode(data[0].firstname));
					$('#txt_middle').val(data[0].middlename);
					$('#txt_suffix').val(data[0].suffix);
					$('#txt_gender').val(data[0].sex);
					$('#txt_birthdate').val(data[0].birthdate);
					$('#txt_birthplace').val(data[0].birthplace);
					$('#txt_nationality').val(data[0].nationality);
					$('#txt_civilstatus').val(data[0].civilstatus);
					$('#txt_tin').val(data[0].tin);
				},
				error: function(errorThrown){
					toastr.error('Something is Amiss!', 'Operation Done');
					console.log(errorThrown);
				}
			});
		});

		$('#tbl_migrate tr').click(function(){
			$('#txt_merge').val($(this).find('td').first().text());
			console.log($(this).find('td').first().text());
			var personid = $('#txt_merge').val();
			$.ajax({
				type: "POST",
				url: baseurl + "merger/findPersonByID",
				dataType: 'json',
				data: {'personid': personid},
				success: function(data){
					console.log(data);
					$('#txt2_last').val(htmlDecode(data[0].lastname));
					$('#txt2_first').val(htmlDecode(data[0].firstname));
					$('#txt2_middle').val(data[0].middlename);
					$('#txt2_suffix').val(data[0].suffix);
					$('#txt2_gender').val(data[0].sex);
					$('#txt2_birthdate').val(data[0].birthdate);
					$('#txt2_birthplace').val(data[0].birthplace);
					$('#txt2_nationality').val(data[0].nationality);
					$('#txt2_civilstatus').val(data[0].civilstatus);
					$('#txt2_tin').val(data[0].tin);
				},
				error: function(errorThrown){
					toastr.error('Something is Amiss!', 'Operation Done');
					console.log(errorThrown);
				}
			});
		});

		$('#btn_merge').click(function(){
			$('#txt_main').attr('readonly', false);
			$('#txt_merge').attr('readonly', false);
			
			var mainid = $('#txt_main').val();
			var mergeid = $('#txt_merge').val();
			$.ajax({
				type: "POST",
				url: baseurl + "merger/merge",
				//dataType: 'json',
				data: {mainid: mainid, mergeid: mergeid},
				success: function(data){
					toastr.success('Merge Complete!');
					console.log(mainid);
					console.log(mergeid);
					$('#txt_main').val('');
					$('#txt_merge').val('');
					location.reload();
				},
				error: function(errorThrown){
					toastr.error('Something is Amiss!', 'Operation Failed');
					console.log(errorThrown);
				}
			});
		});

		$('#txt_search').change(function(){
			var searchText = $(this).val().toLowerCase();
			$.each($("#tbl_masterlist tbody tr"),function(){
				if($(this).text().toLowerCase().indexOf(searchText) === -1){
					$(this).hide();
				} else {
					$(this).show();
				}
			});
		});

		$('#txt2_search').change(function(){
			var searchText = $(this).val().toLowerCase();
			$.each($("#tbl_migrate tbody tr"),function(){
				if($(this).text().toLowerCase().indexOf(searchText) === -1){
					$(this).hide();
				} else {
					$(this).show();
				}
			});
		});

		function htmlDecode(input){
			var doc = new DOMParser().parseFromString(input, "text/html");
			return doc.documentElement.textContent;
		}

	}// end _init
	return {
		init: function(){
			_init();
		}
	};
}();//end masterlist

jQuery(document).ready(function(){
	masterlist.init();
})


</script>