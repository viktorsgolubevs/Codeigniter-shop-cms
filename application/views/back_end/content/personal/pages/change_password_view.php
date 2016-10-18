    <div id="center_side_block">
    
        <div class="pageheader main_block">
            <div class="left"><h2><?=lang('personal');?><span><?=lang('change-password');?></span></h2></div>
            <div class="clear"></div>
        </div>
        
        <div class="block_container content-100">
        
            <div class="content">
                <div class="content_header">
                    <ul>
                        <li><a href="<?=site_url('back_end/personal_list');?>"><?=lang('personal-list');?></a></li>
                        <li class="active"><?=lang('change-password');?></li>
                    </ul>
                    <div class="clear"></div>
                </div>
                <div class="content_body">
                    <?=form_open(uri_string()); ?>
                            
                        <div class="input_group">
                            <div class="block">
                                <div class="control-label"><span><?=lang('personal-old-password');?>:</span></div>
                                <div class="input_block">
                                    <?=form_password(array('name' => 'old_password', 'value' => set_value('old_password'), 'class' => 'form_control sz1'))?>
                                    <?=form_error('old_password','<div class="field_error">','<span>X</span></div>'); ?>
                                    <? if (isset($errors['old_password'])) : ?>
                                    <div class="field_error"><?=$errors['old_password'];?><span>X</span></div>
                                    <? endif; ?>
                                </div>
                            </div>
                        </div>
                        
                        <div class="input_group">
                            <div class="block">
                                <div class="control-label"><span><?=lang('personal-new-password');?>:</span></div>
                                <div class="input_block">
                                    <?=form_password(array('name' => 'new_password', 'value' => set_value('new_password'), 'maxlength' => $this->config->item('password_max_length','auth'), 'class' => 'form_control sz1'))?>
                                    <?=form_error('new_password','<div class="field_error">','<span>X</span></div>'); ?>
                                    <? if (isset($errors['new_password'])) : ?>
                                    <div class="field_error"><?=$errors['new_password'];?><span>X</span></div>
                                    <? endif; ?>
                                </div>
                            </div>
                        </div>
                        
                        <div class="input_group">
                            <div class="block">
                                <div class="control-label"><span><?=lang('auth-confirm-password');?>:</span></div>
                                <div class="input_block">
                                    <?=form_password(array('name' => 'confirm_new_password', 'value' => set_value('confirm_new_password'), 'maxlength' => $this->config->item('password_max_length','auth'), 'class' => 'form_control sz1'))?>
                                    <?=form_error('confirm_new_password','<div class="field_error">','<span>X</span></div>'); ?>
                                    <? if (isset($errors['confirm_new_password'])) : ?>
                                    <div class="field_error"><?=$errors['confirm_new_password'];?><span>X</span></div>
                                    <? endif; ?>
                                </div>
                            </div>
                        </div>
                        
                        <div class="clear"></div>
                        
                        <div class="footer-button-group-container">
                            <div class="button-group-block">
                                <div class="button-position">
                                    <?=form_submit(array('name' => 'change', 'value' => lang('auth-change-password'), 'class' => 'btn btn-blue'));?>
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