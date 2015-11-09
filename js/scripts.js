
jQuery(document).ready(function($){
	
	
	
	$('a#menu-toggler').click(function(){
		
		var nav_container = $('nav#main-menu');
		nav_container.slideToggle();
		
	});

	$('nav.main-menu').scrollToFixed({
		minWidth : '700',
	});
	
});	
		