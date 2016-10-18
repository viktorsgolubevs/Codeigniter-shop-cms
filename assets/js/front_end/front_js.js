$(window).scroll(function() {
    if($(window).scrollTop() + $(window).height() == $(document).height()) {
        if (!$('*').hasClass('.admin-menu-block')) {
            $('.footer_content').css('margin-bottom', $('.admin-menu-block').height() + 'px');            
        }
   }
});

$(document).keyup(function(e) {
    if (e.keyCode == 27) { $('#modal-box-bg').click() }   // esc youtube video
});

$(document).click( function(){
    
    $('#sort-dropdown-list').hide();
    $('#sort-btn').removeClass('active');

});

$(document).ready(function(){
        
    // show menu
    $('body').on('click', '#sort-btn', function(event){
        
        event.stopPropagation();
        
        $('#sort-dropdown-list').toggle();
        
        $('#sort-btn').toggleClass(function() {
            if ( $('#sort-btn').is( ".active" ) ) {
                return 'active';
            } else {
                return 'active';
            }
        });
        
    });
        
    setTimeout(function() {
        // Hide top error block
        $('.cart_error_block').slideUp(600);
        // Hide color background for rows
        $('.cart_error_row').removeClass();
    }, 4000);
    
    $('#btn_product_buy').prop('disabled', true);
    
    $("select[name='quantity']").change(function() {

        if ($(this).val() > 0) {
            $('#btn_product_buy').prop('disabled', false);
            $('#btn_product_buy').removeClass('non-active').addClass('active');
        }
        else
        {
            $('#btn_product_buy').prop('disabled', true);
            $('#btn_product_buy').removeClass('active').addClass('non-active');
        }
    });
    
    $('#btn_product_buy').click(function(event){
        event.preventDefault();
        
        var link = $(this).closest('form').attr('action');
        
        var quantity = $('.quantity_block select').find(':selected')[0].value;
        var product  = $('input[name="product"]').val();

        jQuery.ajax({
            type: "POST",
			url: link,
			data: { product : product, quantity : quantity, csrf_name : csrf_token },
			dataType: "json",
          	success: function(data) {
                if (data.basket && data.basket !== null) 
                {
                    var cart = $('.basket_count');
                    var imgtodrag = $('.product_image').find('img').eq(0);
                    if (imgtodrag) {
                        var imgclone = imgtodrag.clone()
                            .offset({
                            top: imgtodrag.offset().top,
                            left: imgtodrag.offset().left
                        })
                            .css({'opacity':'0.7', 'position':'absolute', 'height':'276px', 'width':'302px', 'z-index':'1000'})
                            .appendTo($('body'))
                            .animate({
                            'top': cart.offset().top + 10,
                                'left': cart.offset().left + 10,
                                'width': 60,
                                'height': 60
                        }, 1000, 'easeInOutExpo');
                        
                        setTimeout(function () {
                            $('.mini_cart').effect("shake", {
                                times: 2
                            }, 200);
                            
                            $('.basket_count').html(data.basket);
                            
                        }, 1500);
            
                        imgclone.animate({
                            'width': 0,
                                'height': 0
                        }, function () {
                            $(this).detach()
                        });
                    }
                }
                else 
                {
                    alert('error #003');
                }
         	},
            error:function (xhr){
                if (xhr.status == 401) {
                    //window.location.href = link;
                }
            }
        });
    });
    
    //-------------------------------
    // Image hover - option
    //-------------------------------
    $('.product_image').mouseenter(function(){
        $('.video-btn-preview-block').show();
    }).mouseleave(function() {
        $('.video-btn-preview-block').hide();
    });
    
    $('.product_item').mouseenter(function(){
        $('.video-btn-preview-block', this).show();
    }).mouseleave(function() {
        $('.video-btn-preview-block', this).hide();
    });
    
    //-------------------------------
    // Hide modal - youtube (background)
    //-------------------------------
    $('#modal-box-bg').click(function()
	{
		if ($('#youtube-window').css('display') == 'block')
		{
			$('#modal-box-bg').hide();
			$('#youtube-window').hide();
		}
	});
    
    //-------------------------------
    // Show modal - youtube
    //-------------------------------
	$('.video-btn-preview-block .video-button').click(function(event){
	   event.preventDefault();
       
		var url		= $(this).attr('data-video');
        
		var embed	= '<object width="480" height="385"><param name="movie" value="'+url+'"></param><param name="allowFullScreen" value="true"></param><param name="allowscriptaccess" value="always"></param><embed src="'+url+'" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" width="480" height="385"></embed></object>';
				
		$('#modal-box-bg').show();
		$('#youtube-window').show().html(embed);
	});
    
});
