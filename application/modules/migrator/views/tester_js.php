<script type="text/javascript">
var masterlist = function(){
	var _init = function(){
		var files;

		$('#send').click(function(){
			$('#frm_test').attr('action',baseurl+'migrator/tester/send');
			$('#frm_test').submit();
		});


	}
	return {
		init: function(){
			_init();
		}
	};
}();
jQuery(document).ready(function(){
	masterlist.init();
});
</script>