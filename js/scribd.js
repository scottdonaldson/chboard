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

	// remove "by clarehousing" from all the scribd titles
	$('p').each(function(){
		var $this = $(this);

		if ( $this.parents('#sidebar').length === 0 ) {
			if ( $this.html().indexOf(' by ') > -1 ) {

				$this.html( $this.html().replace(' by ', '') );

			}

			$this.find('a').each(function(){

				var link = $(this);
				
				if ( link.text() === 'clarehousing' ) {
					
					link.remove();
				
				}

			});
		}
	});

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