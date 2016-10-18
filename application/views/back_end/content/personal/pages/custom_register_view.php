    <div id="center_side_block">
    
        <div class="pageheader main_block">
            <div class="left"><h2><?=lang('personal');?><span><?=lang('personal-register-user');?></span></h2></div>
            <div class="clear"></div>
        </div>
        
        <div class="block_container content-100">
        
            <div class="content">
                <div class="content_header">
                    <ul>
                        <li><a href="<?=site_url('back_end/personal_list');?>"><?=lang('personal-list');?></a></li>
                        <li class="active"><?=lang('personal-register-user');?></li>
                    </ul>
                    <div class="clear"></div>
                </div>
                <div class="content_body">
                    <?=form_open(uri_string()); ?>
                          
                        <? if ($use_username) : ?>
                            
                        <div class="input_group">
                            <div class="block">
                                <div class="control-label"><span><?=lang('personal-username');?>:</span></div>
                                <div class="input_block">
                                    <?=form_input(array('name' => 'username', 'value' => set_value('username'), 'class' => 'form_control sz1'))?>
                                    <?=form_error('username','<div class="field_error">','<span>X</span></div>'); ?>
                                    <? if (isset($errors['username'])) : ?>
                                    <div class="field_error"><?=$errors['username'];?><span>X</span></div>
                                    <? endif; ?>
                                </div>
                            </div>
                        </div>
                        
                        <? endif; ?>
                        
                        <div class="input_group">
                            <div class="block">
                                <div class="control-label"><span><?=lang('personal-email');?>:</span></div>
                                <div class="input_block">
                                    <?=form_input(array('name' => 'email', 'value' => set_value('email'), 'class' => 'form_control sz1'))?>
                                    <?=form_error('email','<div class="field_error">','<span>X</span></div>'); ?>
                                    <? if (isset($errors['email'])) : ?>
                                    <div class="field_error"><?=$errors['email'];?><span>X</span></div>
                                    <? endif; ?>
                                </div>
                            </div>
                        </div>
                        
                        <div class="input_group">
                            <div class="block">
                                <div class="control-label"><span><?=lang('auth-password');?>:</span></div>
                                <div class="input_block">
                                    <?=form_password(array('name' => 'password', 'value' => set_value('password'), 'maxlength' => $this->config->item('password_max_length', 'auth'), 'class' => 'form_control sz1'))?>
                                    <?=form_error('password','<div class="field_error">','<span>X</span></div>'); ?>
                                </div>
                            </div>
                        </div>
                        
                        <div class="input_group">
                            <div class="block">
                                <div class="control-label"><span><?=lang('auth-confirm-password');?>:</span></div>
                                <div class="input_block">
                                    <?=form_password(array('name' => 'confirm_password', 'value' => set_value('confirm_password'), 'maxlength' => $this->config->item('password_max_length', 'auth'), 'class' => 'form_control sz1'))?>
                                    <?=form_error('confirm_password','<div class="field_error">','<span>X</span></div>'); ?>
                                </div>
                            </div>
                        </div>
                        
                        <div class="clear"></div>
                        
                        <div class="footer-button-group-container">
                            <div class="button-group-block">
                                <div class="button-position">
                                
                                    <?=form_submit(array('name' => 'register_user', 'value' => lang('personal-add-user'), 'class' => 'btn btn-blue'));?>
                                    
                                    <a href="<?=site_url('back_end/personal_list');?>" class="btn btn-gray"><?=lang('back');?></a>
                                </div>
                            </div>
                        </div>
                        
                    <?=form_close();?>
                </div>
            </div>
        </div>
    </div>
    
</div> <!-- Page wrapper end -->

</body>
</html>