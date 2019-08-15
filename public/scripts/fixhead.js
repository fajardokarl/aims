
$(document).ready(function(){
	    var head = $('#title_head').offset();
	    
	$(window).scroll(function (event) {
	    var scroll = $(window).scrollTop();


	    if (scroll > head.top) {
	    	$('#title_head').addClass('sticky');
	    }
	    else if(scroll <= head.top){
	    	$('#title_head').removeClass('sticky');

	    }
	});
});

