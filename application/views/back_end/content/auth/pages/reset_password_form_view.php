
<?php
$new_password = array(
	'name'	      => 'new_password',
	'maxlength'	  => $this->config->item('password_max_length', 'auth'),
	'size'	      => 30,
    'class'       => 'form-control no-border',
    'placeholder' => lang('auth-password')
);
$confirm_new_password = array(
	'name'	      => 'confirm_new_password',
	'maxlength'	  => $this->config->item('password_max_length', 'auth'),
	'size' 	      => 30,
    'class'       => 'form-control no-border',
    'placeholder' => lang('auth-confirm-password')
);
?>

    <div class="auth_container_table">
        <div class="auth_container_cell">
            <div class="auth_block">
            
                <div class="header-txt"><?=lang('auth-reset-desc');?></div>
            
                <?=form_open($this->uri->uri_string())?>
                
                    <div class="list-group">
                    	<div class="list-group-item">
                       		<?=form_password($new_password); ?>
                            <?=form_error($new_password['name'], '<div class="form_field_error">', '</div>'); ?>
                            
                            <? if (isset($errors[$new_password['name']])) : ?>
                            <div class="form_field_error"><?=$errors[$new_password['name']];?></div>
                            <? endif; ?>
                    	</div>
                        <div class="list-group-item">
                            <?=form_password($confirm_new_password); ?>
                            <?=form_error($confirm_new_password['name'], '<div class="form_field_error">', '</div>'); ?>
                            
                            <? if (isset($errors[$confirm_new_password['name']])) : ?>
                            <div class="form_field_error"><?=$errors[$confirm_new_password['name']];?></div>
                            <? endif; ?>
                        </div>
                   	</div>
                    
                    <?=form_submit(array('name' => 'change', 'value' => lang('auth-change-password'), 'class' => 'btn btn-block')); ?>
                    
                <?=form_close()?>        
            </div>
        </div>
    </div>
</body>
</html>