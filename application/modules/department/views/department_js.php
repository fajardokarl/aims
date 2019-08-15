<script src="<?=base_url()?>public/scripts/department/department.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/global/plugins/jquery-validation/js/jquery.validate.min.js"></script>

<!-- <script  type="text/javascript">
	var masterlist = function(){
		var masterlist_init = function(){
			$('#tblmasterlist').DataTable({
				"bSort" : true,
				"aLengthMenu": [[25,50,100,-1], [25,50,100, "All"]],
				"iDisplayLength": 25,
				"fixedHeader": true,
				fixedHeader: {
					header: true
				}
			});


			$('#addnew').click(function(){
				$('#showtable').hide();
				$('#showform').show();
				
				$('#title_add').show();
				$('#title_update').hide();

				$('#department_code').val('');
				$('#activity_code').val('');
				$('#department_name').val('');
				$('#route_id').val('');
				$('#status_id').val('1');
				$('#infoform').attr("action","department/addDepartment");
			});

			$('#bck').click(function(){
				$('#showtable').show();
				$('#showform').hide();
			});

			$('#bck2').click(function(){
				$('#showtable').show();
				$('#showform').hide();
			});
			

			$('#tblmasterlist').on('dblclick', 'tr', function(){
				var row = $(this).closest('tr')[0];
				var departmentid = $('#tblmasterlist').DataTable().cell(row, 0).data();
				console.log(departmentid);
				
				$.ajax({
					type: "POST",
					url: "department/getDepartment",
					dataType: 'json',
					data: {'departmentid':departmentid},
					success: function(data){
						$('#infoform').attr("action", "department/updateDepartment");
						$('#department_id').val(data[0].department_id);
						$('#department_code').val(data[0].department_code);
						$('#activity_code').val(data[0].activity_code);
						$('#department_name').val(data[0].department_name);
						$('#route_id').val(data[0].route_id);
						$('#status_id').val(data[0].status_id);

						$('#showtable').hide();
						$('#showform').show();
				
						$('#title_add').hide();
						$('#title_update').show();
					},
					error: function(errorThrown){
						toastr.error('Something is Amiss!', 'Operation done');
						console.log(errorThrown);
					}
				});
			});




		}//end handlemasterlist
		return {
			init: function(){
				masterlist_init();
			}
		};
	}();//end masterlist

	jQuery(document).ready(function(){
		masterlist.init();
	});
</script> -->