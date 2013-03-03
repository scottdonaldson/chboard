jQuery(document).ready(function($){
	
	if ($('body').hasClass('toplevel_page_acf-options')) {
		// For existing items, hide the unused types
		var radio = $('.radio_list');
		var value, others, target;
		
		var rightType = function(value){
			switch(value) {
				case 'pdf':
					target = $this.closest('.row').find('.acf-file-uploader');
					others = $this.closest('.row').find('.page_link, .text');
					break;

				case 'in-link':
					target = $this.closest('.row').find('.page_link');
					others = $this.closest('.row').find('.acf-file-uploader, .text');
					break;

				case 'ex-link':
					target = $this.closest('.row').find('.text');
					others = $this.closest('.row').find('.page_link, .acf-file-uploader');
					break;
			}

			target.show();
			others.hide();
		}

		radio.each(function(){
			$this = $(this);
			value = $this.find(':checked').val();
			
			rightType(value);
		});

		// Since new rows are added to the DOM when sidebar items are added,
		// need to check with each document click if we're changing an input
		$(document).click(function(e){

			$this = $(e.target);
			value = $this.val();

			rightType(value);
		});
	}

});