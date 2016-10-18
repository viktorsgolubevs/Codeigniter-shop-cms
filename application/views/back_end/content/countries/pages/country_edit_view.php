    <div id="center_side_block">
    
        <div class="pageheader main_block">
            <div class="left"><h2><?=lang('countries');?><span><?=lang('country-edit');?> - <?=$country_data['country_name'];?></span></h2></div>
            <div class="clear"></div>
        </div>
        
        <div class="block_container content-100">
        
            <div class="content">
                <div class="content_header">
                    <ul>
                        <li><a href="<?=site_url('back_end/country_list');?>"><?=lang('country-list');?></a></li>
                        <li class="active"><?=lang('country-edit');?></li>
                    </ul>
                    <div class="clear"></div>
                </div>
                <div class="content_body">
                    <?=form_open(uri_string()); ?>
                            
                        <div class="input_group">
                            <div class="block">
                                <div class="control-label"><span><?=lang('country-code');?>:</span></div>
                                <div class="input_block">
                                    <?=form_input(array('name' => 'country_code', 'value' => $country_data['country_code'], 'class' => 'form_control sz1'))?>
                                    <?=form_error('country_code','<div class="field_error">','<span>X</span></div>'); ?>
                                </div>
                            </div>
                        </div>
                        
                        <div class="input_group">
                            <div class="block">
                                <div class="control-label"><span><?=lang('country-name');?>:</span></div>
                                <div class="input_block">
                                    <?=form_input(array('name' => 'country_name', 'value' => $country_data['country_name'], 'class' => 'form_control sz1'))?>
                                    <?=form_error('country_name','<div class="field_error">','<span>X</span></div>'); ?>
                                </div>
                            </div>
                        </div>
                        
                        <div class="input_group">
                            <div class="block">
                                <div class="control-label"><span><label for="country_active"><?=lang('active');?>:</label></span></div>
                                <div class="input_block">
                                    <? if($country_data['active']) : ?>
                                    <?=form_checkbox(array('name' => 'country_active', 'value' => false, 'checked' => 'checked', 'class' => 'checkbox-inline', 'id' => 'country_active'));?>
                                    <? else : ?>
                                    <?=form_checkbox(array('name' => 'country_active', 'value' => true, 'class' => 'checkbox-inline', 'id' => 'country_active'));?>
                                    <? endif; ?>
                                </div>
                            </div>
                        </div>
                        
                        <div class="clear"></div>
                        
                        <div class="footer-button-group-container">
                            <div class="button-group-block">
                                <div class="button-position">
                                    <?=form_submit(array('name' => 'edit_country', 'value' => lang('edit'), 'class' => 'btn btn-blue'));?>
                                    
                                    <a href="<?=site_url('back_end/country_list');?>" class="btn btn-gray"><?=lang('reset');?></a>
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