<?php
$email = array(
	'name'	        => 'email',
	'value'	        => set_value('email'),
	'maxlength'	    => 80,
	'size'	        => 30,
    'class'         => 'form-control no-border',
    'placeholder'   => 'Email Address'
);
?>

    <div class="auth_container_table">
        <div class="auth_container_cell">
            <div class="auth_block">
            
                <div class="header-txt">Send again email</div>
            
                <?=form_open($this->uri->uri_string())?>
                
                    <div class="list-group">
                        <div class="list-group-item">
                            <?=form_input($email); ?>
                            <?=form_error($email['name'], '<div class="form_field_error">', '</div>'); ?>
                            
                            <? if (isset($errors[$email['name']])) : ?>
                            <div class="form_field_error"><?=$errors[$email['name']]; ?></div>
                            <? endif; ?>
                        </div>
                   	</div>
                    
                    <?=form_submit(array('name' => 'send', 'value' => 'Send', 'class' => 'btn btn-block')); ?>
                    
                <?=form_close()?>        
            </div>
        </div>
    </div>
</body>
</html>