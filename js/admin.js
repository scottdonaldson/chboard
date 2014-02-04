jQuery(document).ready(function(){
	var meeting = jQuery('[data-field_name="meeting"]');
	setInterval(function(){
		meeting.find('.acf-conditional_logic-hide').removeClass('acf-conditional_logic-hide');
	}, 1000);
});