<?php
if ($use_username) {
	$username = array(
		'name'	        => 'username',
		'value'         => set_value('username'),
		'maxlength'	    => $this->config->item('username_max_length', 'auth'),
		'size'	        => 30,
        'class'         => 'form-control no-border',
        'placeholder'   => lang('auth-register-username')
	);
}
$email = array(
	'name'	        => 'email',
	'value'	        => set_value('email'),
	'maxlength'	    => 80,
	'size'	        => 30,
    'class'         => 'form-control no-border',
    'placeholder'   => lang('auth-email')
);
$password = array(
	'name'	        => 'password',
	'value'         => set_value('password'),
	'maxlength'	    => $this->config->item('password_max_length', 'auth'),
	'size'	        => 30,
    'class'         => 'form-control no-border',
    'placeholder'   => lang('auth-password')
);
$confirm_password = array(
	'name'	        => 'confirm_password',
	'value'         => set_value('confirm_password'),
	'maxlength'	    => $this->config->item('password_max_length', 'auth'),
	'size'	        => 30,
    'class'         => 'form-control no-border',
    'placeholder'   => lang('auth-confirm-password')
);
$captcha = array(
	'name'	        => 'captcha',
	'id'	        => 'captcha',
	'maxlength'	    => 8,
);
?>

    <div class="auth_container_table">
        <div class="auth_container_cell">
            <div class="auth_block">
            
                <a class="navbar-brand block" href="<?=site_url('auth/login');?>"><?=lang('shop-cms');?></a>
            
                <div class="header-txt"><?=lang('auth-register-desc');?></div>

                <?=form_open($this->uri->uri_string())?>

                <div class="list-group">
                    <? if ($use_username) : ?>
                	<div class="list-group-item">
                   		<?=form_input($username)?>
                        <?=form_error($username['name'], '<div class="form_field_error">', '</div>'); ?>
                        <? if (isset($errors[$username['name']])) : ?>
                        <div class="form_field_error"><?=$errors[$username['name']];?></div>
                        <? endif; ?>
                	</div>
                    <? endif; ?>
                    <div class="list-group-item">
                   		<?=form_input($email);?>
                   		<?=form_error($email['name'], '<div class="form_field_error">', '</div>'); ?>
                        <? if (isset($errors[$email['name']])) : ?>
                        <div class="form_field_error"><?=$errors[$email['name']];?></div>
                        <? endif; ?>
                    </div>
                    <div class="list-group-item">
                   		<?=form_password($password)?>
                        <?=form_error($password['name'], '<div class="form_field_error">', '</div>'); ?>
                    </div>
                    <div class="list-group-item">
                   		<?=form_password($confirm_password);?>
                   		<?=form_error($confirm_password['name'], '<div class="form_field_error">', '</div>'); ?>
                    </div>
               	</div>

            	<? if ($captcha_registration) : ?>
                <div class="captcha-block">
                
            	<? if ($use_recaptcha) : ?>
                    <div class="captcha-label recaptcha_only_if_image">Enter the code exactly as it appears:</div>
                    <div id="recaptcha_image"></div>
        
                    <div class="txt-block captcha-link">
                    <div class="captcha-reload recaptcha_only_if_image">
                        <a href="javascript:Recaptcha.reload()">Get another CAPTCHA</a>
                    </div>
                    <div class="captcha-switch">
                        <div class="recaptcha_only_if_image"><a href="javascript:Recaptcha.switch_type('audio')">Get an audio CAPTCHA</a></div>
                        <div class="recaptcha_only_if_audio"><a href="javascript:Recaptcha.switch_type('image')">Get an image CAPTCHA</a></div>
                    </div>
                    </div>
        
                    <div class="txt-block captcha-input-label">
            			<div class="recaptcha_only_if_image">Enter the words above</div>
            			<div class="recaptcha_only_if_audio">Enter the numbers you hear</div>
                    </div>
                    
                    <div class="list-group">
                    	<div class="list-group-item">
                		<input type="text" id="recaptcha_response_field" name="recaptcha_response_field" placeholder="Confirmation code" class="captcha-input-field" />
                		<?=form_error('recaptcha_response_field', '<div class="form_field_error">', '</div>'); ?>
                        <?=$recaptcha_html; ?>
                        </div>
                    </div>

                	<? else : ?>
                    
                    <div class="captcha-label">Enter the code exactly as it appears:</div>
                    
                    <div><?=$captcha_html; ?></div>
                			
                    <div class="list-group">
                    	<div class="list-group-item">
                		<input type="text" name="captcha" maxlength="8" placeholder="Confirmation code" class="captcha-input-field" />
                		<?=form_error('captcha', '<div class="form_field_error">', '</div>'); ?>
                        </div>
                    </div>
    
                <? endif; ?>
                </div>
            	<? endif; ?>

                <input type="submit" name="register" value="<?=lang('auth-register');?>" class="btn btn-block">

                <?=form_close()?>        
            </div>
        </div>
    </div>
</body>
</html>