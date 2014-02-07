(function($){
$(document).ready(function(){

	jQuery.fn.reverse = [].reverse;
	
	var frames = $('iframe'),
		sidebar = $('#sidebar');

	function scrollToFrame(e) {
		e.preventDefault();
		$('html, body').animate({
			scrollTop: $('#' + this.getAttribute( 'data-scroll-to' )).prev('p').offset().top - 20
		}, 500);
	}

	frames.reverse().each(function(){
		var p = $('<p>'),
			link = $('<a>');
		link.attr( 'href', '#' )
			.attr( 'data-scroll-to', this.id )
			.text( $(this).prev('p').text() )
			.click( scrollToFrame );

		p.append( link );
		p.prependTo( sidebar );

	});

});
}(jQuery));