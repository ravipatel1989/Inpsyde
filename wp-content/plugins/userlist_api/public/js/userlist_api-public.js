(function( $ ) {
	'use strict';

	/**
	 * All of the code for your public-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */
	 $(document).ready( function () {
		$('#userList').DataTable();
		$(".userdata td").on('click',function(){
			let userid = $(this).parent().data('id');
			$.ajax({
				type:"POST",
				url: ajax_var.url,
				data:{action:"get_user_by_ajax",nonce: ajax_var.nonce,"user_id":userid},
				beforeSend:function(){
					$("#overlay").fadeIn(300);
				},
				success:function(response){
					if(undefined != response){
						console.log(response);
						$('.resuserdata').html(response);
					}
				},
				complete:function(response){
					$('.userList').hide();
					$('.userDetails').show();
					setTimeout(function(){
						$("#overlay").fadeOut(300);
					  },500);
				}
			})
		});

		$('button.userdata').on('click',function(){
			$('.userList').show();
			$('.userDetails').hide();
		});
	} );

})( jQuery );
