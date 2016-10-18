    <div id="center_side_block">
    
        <div class="pageheader main_block">
            <div class="left"><h2><?=lang('personal');?><span><?=lang('personal-data-edit');?></span></h2></div>
            <div class="clear"></div>
        </div>
        
        <div class="block_container content-100">
        
            <div class="content">
                <div class="content_header">
                    <ul>
                        <li><a href="<?=site_url('back_end/personal_list');?>"><?=lang('personal-list');?></a></li>
                        <li class="active"><?=lang('personal-edit');?></li>
                    </ul>
                    <div class="clear"></div>
                </div>
                <div class="content_body">
                    <?=form_open(uri_string()); ?>
                            
                        <div class="input_group">
                            <div class="block">
                                <div class="control-label"><span><?=lang('personal-username');?>:</span></div>
                                <div class="input_block">
                                    <?=form_input(array('name' => 'username', 'value' => $personal_data['username'], 'class' => 'form_control sz1'))?>
                                    <?=form_error('username','<div class="field_error">','<span>X</span></div>'); ?>
                                </div>
                            </div>
                        </div>
                        
                        <div class="input_group">
                            <div class="block">
                                <div class="control-label"><span><?=lang('personal-email');?>:</span></div>
                                <div class="input_block">
                                    <?=form_input(array('name' => 'email', 'value' => $personal_data['email'], 'class' => 'form_control sz1'))?>
                                    <?=form_error('email','<div class="field_error">','<span>X</span></div>'); ?>
                                </div>
                            </div>
                        </div>
                        
                        <div class="input_group">
                            <div class="block">
                                <div class="control-label"><span><label for="active"><?=lang('personal-activated');?>:</label></span></div>
                                <div class="input_block">
                                    <? if($personal_data['activated']) : ?>
                                    <?=form_checkbox(array('name' => 'activated', 'value' => '', 'checked' => 'checked', 'class' => 'checkbox-inline', 'id' => 'active'));?>
                                    <? else : ?>
                                    <?=form_checkbox(array('name' => 'activated', 'value' => '', 'class' => 'checkbox-inline', 'id' => 'active'));?>
                                    <? endif; ?>
                                </div>
                            </div>
                        </div>
                        
                        <div class="input_group">
                            <div class="block">
                                <div class="control-label"><span><label for="ban"><?=lang('personal-ban');?>:</label></span></div>
                                <div class="input_block">
                                    <? if($personal_data['banned']) : ?>
                                    <?=form_checkbox(array('name' => 'banned', 'value' => '', 'checked' => 'checked', 'class' => 'checkbox-inline', 'id' => 'ban'));?>
                                    <? else : ?>
                                    <?=form_checkbox(array('name' => 'banned', 'value' => '', 'class' => 'checkbox-inline', 'id' => 'ban'));?>
                                    <? endif; ?>
                                </div>
                            </div>
                            
                            <div class="input_separator"></div>
                            
                            <div class="block">
                                <div class="control-label"><span><?=lang('personal-ban-reason');?>:</span></div>
                                <div class="input_block">
                                    <?=form_input(array('name' => 'ban_reason', 'value' => $personal_data['ban_reason'], 'class' => 'form_control sz1'))?>
                                    <?=form_error('ban_reason','<div class="field_error">','<span>X</span></div>'); ?>
                                </div>
                            </div>
                        </div>
                        
                        <div class="clear"></div>
                        
                        <div class="footer-button-group-container">
                            <div class="button-group-block">
                                <div class="button-position">
                                    <?=form_submit(array('name' => 'edit_user', 'value' => lang('edit'), 'class' => 'btn btn-blue'));?>
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