
(function($){
	/* ---------------------------------------------- /*
	 * Preloader
	 /* ---------------------------------------------- */

	 $(window).load(function() {
	 	$('.loader').fadeOut();
	 	$('.page-loader').delay(350).fadeOut('slow');
	 });

	 $(document).ready(function() {
		// $(function() {
   		 // $("img.lazy").lazyload();
		// });
		$('#container_section').on('click','.pagination span',function(){			
			var type=$(this).attr('class');
			var action = $(this).parent('.pagination').find("input[name='pagination_action']").val();			
			switch(action) {
				case 'profile_detail':
				var currid = $(this).parent('.pagination').find("input[name='current_userid']").val();				
				$.ajax({
					url:'/cex_test/profile/paginate/'+type+'/'+action+'/'+currid,
					success: function(data) {						
						$('#container_section').html(data);
						// $('#main').html($(data).find('#main *'));
						// $('#notification-bar').text('The page has been successfully loaded');
					},
					error: function() {
						$('.error').text('An error occurred');
					}
				});	
				break;
			}
		});		
	});
	})(jQuery);