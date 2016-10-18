<?php

if ($login_by_username AND $login_by_email) {
	$login_label = lang('auth-email-login');
} else if ($login_by_username) {
	$login_label = lang('auth-login');
} else {
	$login_label = lang('auth-email');
}

$login = array(
	'name'	      => 'login',
	'value'       => set_value('login'),
	'maxlength'	  => 80,
	'size'	      => 30,
    'class'       => 'form-control no-border',
    'placeholder' => $login_label
);
$password = array(
	'name'	      => 'password',
	'size'	      => 30,
    'class'       => 'form-control no-border',
    'placeholder' => lang('auth-password')
);
$remember = array(
	'name'	      => 'remember',
	'id'	      => 'remember',
	'value'	      => 1,
	'checked'	  => set_value('remember')
);
$captcha = array(
	'name'	=> 'captcha',
	'id'	=> 'captcha',
	'maxlength'	=> 8
);

?>

    <div class="auth_container_table">
        <div class="auth_container_cell">
            <div class="auth_block">
                
                <a class="navbar-brand block" href="<?=site_url('auth/login');?>"><?=lang('shop-cms');?></a>
            
                <div class="header-txt"><?=lang('auth-login-desc');?></div>
            
                <?=form_open($this->uri->uri_string())?>

                <div class="list-group">
                	<div class="list-group-item">
                   		<?=form_input($login)?>
                        <?=form_error($login['name'], '<div class="form_field_error">', '</div>'); ?>
                        
                        <? if (isset($errors[$login['name']])) : ?>
                        <div class="form_field_error"><?=$errors[$login['name']];?></div>
                        <? endif; ?>
                	</div>
                    <div class="list-group-item">
                        <?=form_password($password)?>
                        <?=form_error($password['name'], '<div class="form_field_error">', '</div>'); ?>
                        
                        <? if (isset($errors[$password['name']])) : ?>
                        <div class="form_field_error"><?=$errors[$password['name']];?></div>
                        <? endif; ?>
                    </div>
               	</div>
                
                
                	<? if ($show_captcha) : ?>
                        <div class="captcha-block">
                		<? if ($use_recaptcha) : ?>
                	
                        <div class="captcha-label recaptcha_only_if_image"><?=lang('auth-captcha-desc');?>:</div>
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
                
                
                <? if ($this->config->item('remember_password', 'auth')) : ?>
                <div class="remember"><?=form_checkbox($remember);?><span><?=form_label(lang('auth-remember-me'), $remember['id']);?></span></div>
                <? endif; ?>
                
                <?=form_submit(array('name' => 'submit', 'value' => 'Login', 'class' => 'btn btn-block')); ?>
                
                <? if ($this->config->item('reset_password', 'auth')): ?>
                <div class="forgot"><?=anchor('auth/forgot_password', lang('auth-forgot-password'));?></div>
                <? endif; ?>

                <? if ($this->config->item('allow_registration', 'auth')): ?>
                    <?=anchor('auth/register', lang('auth-register'), array('class' => 'btn btn-default btn-block')); ?>
                <? endif; ?>

                <?=form_close()?>        
            </div>
        </div>
    </div>
</body>
</html>
