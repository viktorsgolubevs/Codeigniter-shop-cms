    <div id="center_side_block">
    
        <? $this->load->view('back_end/attention_message_view');?>
    
        <div class="pageheader main_block">
            <div class="left"><h2><?=lang('countries');?><span><?=lang('country-delete');?> - <?=$country_data['country_name'];?></span></h2></div>
            <div class="clear"></div>
        </div>
        
        <div class="block_container content-100">
        
            <div class="content">
                <div class="content_header">
                    <ul>
                        <li><a href="<?=site_url('back_end/country_list');?>"><?=lang('country-list');?></a></li>
                        <li class="active"><?=lang('country-delete');?></li>
                    </ul>
                    <div class="clear"></div>
                </div>
                <div class="content_body">
                    <?=form_open(uri_string()); ?>
                            
                        <div class="input_group">
                            <div class="block">
                                <div class="control-label"><span><?=lang('country-code');?>:</span></div>
                                <div class="input_block">
                                    <?=form_input(array('name' => 'country_code', 'value' => strtoupper($country_data['country_code']), 'class' => 'form_control sz1', 'disabled' => 'disabled'))?>
                                </div>
                            </div>
                        </div>
                        
                        <div class="input_group">
                            <div class="block">
                                <div class="control-label"><span><?=lang('country-name');?>:</span></div>
                                <div class="input_block">
                                    <?=form_input(array('name' => 'country_name', 'value' => $country_data['country_name'], 'class' => 'form_control sz1', 'disabled' => 'disabled'))?>
                                </div>
                            </div>
                        </div>
                        
                        <div class="input_group">
                            <div class="block">
                                <div class="control-label"><span><label for="country_active"><?=lang('active');?>:</label></span></div>
                                <div class="input_block">
                                    <? if($country_data['active']) : ?>
                                    <?=form_checkbox(array('name' => 'country_active', 'checked' => 'checked', 'class' => 'checkbox-inline', 'id' => 'country_active', 'disabled' => 'disabled'));?>
                                    <? else : ?>
                                    <?=form_checkbox(array('name' => 'country_active', 'class' => 'checkbox-inline', 'id' => 'country_active', 'disabled' => 'disabled'));?>
                                    <? endif; ?>
                                </div>
                            </div>
                        </div>
                        
                        <div class="clear"></div>
                        
                        <div class="footer-button-group-container">
                            <div class="button-group-block">
                                <div class="button-position">
                                    <?=form_submit(array('name' => 'delete_country', 'value' => lang('delete'), 'class' => 'btn btn-red'));?>
                                    
                                    <a href="<?=site_url('back_end/country_list');?>" class="btn btn-gray"><?=lang('back');?></a>
                                </div>
                            </div>
                        </div>
                        
                    <?=form_close();?>
                </div>
            </div>
        </div>
    </div>
    
</div>
</body>
</html>