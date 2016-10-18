    <div id="center_side_block">
    
        <div class="pageheader main_block">
            <div class="left"><h2><?=lang('personal');?><span><?=lang('personal-data');?></span></h2></div>
            <div class="clear"></div>
        </div>
        
        <div class="block_container content-100">
        
            <div class="content">
                <div class="content_header">
                    <ul>
                        <li><a href="<?=site_url('back_end/personal_list');?>"><?=lang('personal-list');?></a></li>
                        <li class="active"><?=lang('personal-data');?></li>
                    </ul>
                    <div class="clear"></div>
                </div>
                <div class="content_body">
                    <?=form_open(uri_string()); ?>
                            
                        <div class="input_group">
                            <div class="block">
                                <div class="control-label"><span><?=lang('personal-username');?>:</span></div>
                                <div class="input_block">
                                    <?=form_input(array('name' => 'username', 'value' => $personal_data['username'], 'class' => 'form_control sz1', 'disabled' => 'disabled'))?>
                                </div>
                            </div>
                        </div>
                        
                        <div class="input_group">
                            <div class="block">
                                <div class="control-label"><span><?=lang('personal-email');?>:</span></div>
                                <div class="input_block">
                                    <?=form_input(array('name' => 'email', 'value' => $personal_data['email'], 'class' => 'form_control sz1', 'disabled' => 'disabled'))?>
                                </div>
                            </div>
                        </div>
                        
                        <div class="input_group">
                            <div class="block">
                                <div class="control-label"><span><label><?=lang('personal-activated');?>:</label></span></div>
                                <div class="input_block">
                                    <? if($personal_data['activated']) : ?>
                                    <?=form_checkbox(array('name' => 'activated', 'value' => '', 'checked' => 'checked', 'class' => 'checkbox-inline', 'disabled' => 'disabled'));?>
                                    <? else : ?>
                                    <?=form_checkbox(array('name' => 'activated', 'value' => '', 'class' => 'checkbox-inline', 'disabled' => 'disabled'));?>
                                    <? endif; ?>
                                </div>
                            </div>
                        </div>
                        
                        <div class="input_group">
                            <div class="block">
                                <div class="control-label"><span><label><?=lang('personal-ban');?>:</label></span></div>
                                <div class="input_block">
                                    <? if($personal_data['banned']) : ?>
                                    <?=form_checkbox(array('name' => 'banned', 'value' => '', 'checked' => 'checked', 'class' => 'checkbox-inline', 'disabled' => 'disabled'));?>
                                    <? else : ?>
                                    <?=form_checkbox(array('name' => 'banned', 'value' => '', 'class' => 'checkbox-inline', 'disabled' => 'disabled'));?>
                                    <? endif; ?>
                                </div>
                            </div>
                            
                            <? if($personal_data['banned']) : ?>
                            <div class="input_separator"></div>
                            
                            <div class="block">
                                <div class="control-label"><span><?=lang('personal-ban-reason');?>:</span></div>
                                <div class="input_block">
                                    <?=form_input(array('name' => 'ban_reason', 'value' => $personal_data['ban_reason'], 'class' => 'form_control sz1', 'disabled' => 'disabled'))?>
                                </div>
                            </div>
                            <? endif; ?>
                        </div>
                        
                        <div class="input_group">
                            <div class="block">
                                <div class="control-label"><span><?=lang('personal-last-ip');?>:</span></div>
                                <div class="input_block">
                                    <?=form_input(array('name' => 'last-ip', 'value' => $personal_data['last_ip'], 'class' => 'form_control sz1', 'disabled' => 'disabled'))?>
                                </div>
                            </div>
                        </div>
                        
                        <div class="input_group">
                            <div class="block">
                                <div class="control-label"><span><?=lang('personal-last-login');?>:</span></div>
                                <div class="input_block">
                                    <?=form_input(array('name' => 'last-login', 'value' => date($this->config->item('date-full'), strtotime($personal_data['last_login'])), 'class' => 'form_control sz1', 'disabled' => 'disabled'))?>
                                </div>
                            </div>
                        </div>
                        
                        <div class="input_group">
                            <div class="block">
                                <div class="control-label"><span><?=lang('personal-modified');?>:</span></div>
                                <div class="input_block">
                                    <?=form_input(array('name' => 'modified', 'value' => date($this->config->item('date-full'), strtotime($personal_data['modified'])), 'class' => 'form_control sz1', 'disabled' => 'disabled'))?>
                                </div>
                            </div>
                        </div>
                        
                        <div class="input_group">
                            <div class="block">
                                <div class="control-label"><span><?=lang('personal-created');?>:</span></div>
                                <div class="input_block">
                                    <?=form_input(array('name' => 'created', 'value' => date($this->config->item('date-full'), strtotime($personal_data['created'])), 'class' => 'form_control sz1', 'disabled' => 'disabled'))?>
                                </div>
                            </div>
                        </div>
                        
                        <div class="clear"></div>
                        
                        <div class="footer-button-group-container">
                            <div class="button-group-block">
                                <div class="button-position">
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