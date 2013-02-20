$(document).ready(function(){
	
	// ----- Calendar
	var date = $('.date:eq(35), .date:eq(36), .date:eq(37), .date:eq(38), .date:eq(39), .date:eq(40), .date:eq(41)');
	if (date.each(function(){ $(this).hasClass('empty') ? true : false; })) {
		date.hide();
	}


	// ---------- Footer Menu -------------- //
	
	var footerMenu = $('#menu-footer-menu');
	footerMenu.find('li:not(:last-child)').append(' |');
	footerMenu.find('li:not(:first-child)').prepend('&nbsp;');


});