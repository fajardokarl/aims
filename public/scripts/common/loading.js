
$( document ).ajaxSend(function( event, jqxhr, settings ) {
	if(settings.url == "http://localhost/abci/Login/login/get_unseen") {
		console.log(settings.url);
	} else if(settings.url == "http://localhost/abci/Login/login/update_inbox_notif") {
		console.log(settings.url);
	} else {
		$(document).ajaxStart(function(){
			$('#loadings').show();
			}).ajaxStop(function(){
			$('#loadings').hide();
		});
	}
});
   // Karl
if(window.location.href != "http://localhost/abci/message") {
	$(document).ajaxStart(function(){
	    $('#loadings').show();
	  }).ajaxStop(function(){
	    $('#loadings').hide();
	 });
 }

