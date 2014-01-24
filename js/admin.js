(function($){
$(document).ready(function(){

	if ($('#acf-sidebar').length > 0) {

		// This is tied to the DOM! Beware!
		var config = {
			'pdf': 	   'field_5',
			'in-link': 'field_6',
			'ex-link': 'field_7'
		}

		// For existing items, hide the unused types
		var radio = $('.acf-radio-list');
		
		function hideUnnecessary( $elem ) {
			for (var item in config) {
				if ( $elem.val() === item ) {
					// This logic is also tied to the DOM!
					$elem.closest('tbody').find('[data-field_key="' + config[item] + '"]').show();
				} else {
					// Ditto!
					$elem.closest('tbody').find('[data-field_key="' + config[item] + '"]').hide();
				}
			}
		}

		radio.each(function(){
			hideUnnecessary( $(this).find(':checked') );
		});

		// Since new rows are added to the DOM when sidebar items are added,
		// need to check with each document click if we're changing an input
		$(document).click(function(e){
			if (e.target.id &&
				e.target.id.slice(0, 9) === 'acf-field' && 
				e.target.type &&
				e.target.type === 'radio') {

				hideUnnecessary( $(e.target) );
			}
		});
	}

});
}(jQuery));