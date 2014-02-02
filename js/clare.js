$(document).ready(function(){
	
	// ----- Calendar

		// if last row is empty, remove it
		$('.calendar').each(function(){
			var $this = $(this);
			for (var i = 35; i < 42; i++) {
				if ( !$this.find('.date').eq(i).hasClass('empty') ) {
					return false;
				}
			}
			for (var i = 35; i < 42; i++) {
				$this.children().eq(i).hide();
			}
		});


});