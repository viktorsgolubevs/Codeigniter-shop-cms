    $(window).load(function() {
        $('#side_menu > li.open').addClass('active');
    });
    
    $(window).resize(function () {
        window_size();
    });
    
    function window_size()
    {
        if ($(window).width() <= 900)
        {
            $('#left_side_block').addClass('hide');
        }
        else
        {
            $('#left_side_block').removeClass('hide');
        }
    }
    
    $(window).load(function() {
        
        var html =  '<div class="menu-icon left" id="left-side">';
            html += '<div class="bar"></div>';
            html += '<div class="bar"></div>';
            html += '<div class="bar"></div>';
            html += '</div>';
        
        $('.pageheader .left').before(html);
    });
    
    $(document).click( function(){
    
        $('#drop').hide();
        $('#trigger').removeClass('active');
        
        hide_dropdown();
    
    });
    
    function hide_dropdown()
    {
        $('.order-trigger').removeClass('active');
        $('.order-drop').hide();
    }
    
    $(document).ready(function(){
        
        window_size();
        
        // Show hide left side menu bar
        $('body').on('click', '#left-side', function() {
            if ($('#left_side_block').hasClass('hide')) {
                $('#left_side_block').removeClass('hide');
            } else {
                $('#left_side_block').addClass('hide');
            }
        });
        
        // Show menu
        $('body').on('click', '#trigger', function(event){
            
            event.stopPropagation();
            
            $('#drop').toggle();
            
            $('#trigger').toggleClass(function() {
                if ( $('#trigger').is( ".active" ) ) {
                    return 'active';
                } else {
                    return 'active';
                }
            });
            
        });
        
        // Show menu
        $('body').on('click', '.order-trigger', function(event){
            
            event.stopPropagation();
            
                if ($(this).hasClass('active')) {
                    $(this).removeClass('active');
                    $(this).next('.order-drop').hide();
                } else {
                   
                    // hide all parent if it is opened
                    hide_dropdown();
                   
                    $(this).addClass('active');
                    $(this).next('.order-drop').show();
                }
       
            
        });
        
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
    
                reader.onload = function (e) {
                    $('#img_preview').html('<a href="#" class="highslide" onclick="return hs.expand(this)"><img src="#" alt="" /></a>');
                    $('#img_preview a').attr('href', e.target.result);
                    $('#img_preview img').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#imgInp").change(function(){
            readURL(this);
        });
        
        $('.field_error span').click(function(){
            $(this).parent().hide();
        });
        
        $('#side_menu').navgoco({
            accordion: true,
            onClickAfter: function(e, submenu) {
                e.preventDefault();
                $('#side_menu').find('li').removeClass('active');
                    var li =  $(this).parent();
                    var lis = li.parents('li');
                    li.addClass('active');
                    lis.addClass('active');
            }
        });
        
        /* Select all checkbox */
        $('#select_all').change(function(){
            var checkboxes = $(this).closest('form').find(':checkbox');
            if($(this).prop('checked')) {
              checkboxes.prop('checked', true);
              $(this).closest('form').find('tr').addClass('row_selected')
            } else {
              checkboxes.prop('checked', false);
              $(this).closest('form').find('tr').removeClass('row_selected')
            }
        });
        
        $('.tb_selected tr').click( function() {
            
            var checkboxes = $(this).find(':checkbox');
            
    		if ($(this).hasClass('row_selected')) {
                checkboxes.prop('checked', false);
    			$(this).removeClass('row_selected');        		  
    		} else {
                checkboxes.prop('checked', true);
    			$(this).addClass('row_selected');        		  
    		} 
    	});

    });