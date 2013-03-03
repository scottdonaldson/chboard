$(document).ready(function(){
	
	// ----- Calendar

		// if last row is empty, remove it
		var calendar = $('.calendar'),
			empty;
		calendar.each(function(){
			$this = $(this);
			for (var i = 35; i < 42; i++) {
				if ($this.find('.date').eq(i).hasClass('empty')) {
					console.log('yuppers '+ i);
					empty = true;
				} else {
					empty = false;
					break;
				}
			}
			if (empty) {
				for (i = 35; i < 42; i++) {
					$this.children().eq(i).hide();
				}
			}
		});


});