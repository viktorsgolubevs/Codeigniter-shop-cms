<?php

if ($this->config->item('use_username', 'auth')) {
	$login_label = lang('auth-email-login');
} else {
	$login_label = lang('auth-email');
}

$login = array(
	'name'	=> 'login',
	'value' => set_value('login'),
	'maxlength'	=> 80,
	'size'	=> 30,
    'class' => 'form-control no-border',
    'placeholder' => $login_label
);
?>

    <div class="auth_container_table">
        <div class="auth_container_cell">
            <div class="auth_block">
            
                <a class="navbar-brand block" href="<?=site_url('auth/login');?>"><?=lang('shop-cms');?></a>
            
                <div class="header-txt"><?=lang('auth-forget-desc');?></div>
                
                <?=form_open($this->uri->uri_string())?>
                
                <div class="list-group">
            
                	<div class="list-group-item">
                   		<?=form_input($login); ?>
                        <?=form_error($login['name'], '<div class="form_field_error">', '</div>'); ?>
                        <? if (isset($errors[$login['name']])) : ?>
                        <div class="form_field_error"><?=$errors[$login['name']];?></div>
                        <? endif; ?>
                	</div>
                
                </div>
                
                <?=form_submit('reset', lang('auth-new-password'), 'class = "btn btn-block"'); ?>
                
                <?=form_close()?>        
            </div>
        </div>
    </div>
</body>
</html>