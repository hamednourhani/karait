
jQuery(document).ready(function($){
	
	
	
	$('nav.main-menu').scrollToFixed({
		minWidth : '700',
	});

	$('a#menu-toggler').click(function(){
		
		var nav_container = $('nav#main-menu');
		nav_container.slideToggle();
		
	});
	
	
	$('#subpage-tabs').tabs();

	$('#selectElementId').change(function(){
         $(this).closest('form').trigger('submit');
     });
   
});	
		