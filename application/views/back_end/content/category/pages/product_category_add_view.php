    <div id="center_side_block">
    
        <div class="pageheader main_block">
            <div class="left"><h2><?=lang('category');?><span><?=lang('category-add');?></span></h2></div>
            <div class="clear"></div>
        </div>
        
        <div class="block_container content-100">
        
            <div class="content">
                <div class="content_header">
                    <ul>
                        <li><a href="<?=site_url('back_end/category_list');?>"><?=lang('category-list');?></a></li>
                        <li class="active"><?=lang('category-add');?></li>
                    </ul>
                    <div class="clear"></div>
                </div>
                <div class="content_body">
                    
                    <?=form_open(uri_string()); ?>
                            
                        <div class="input_group">
                            <div class="block">
                                <div class="control-label"><span><?=lang('category-name');?>:</span></div>
                                <div class="input_block">
                                    <?=form_input(array('name' => 'category_name', 'value' => set_value('category_name'), 'class' => 'form_control sz1'))?>
                                    <?=form_error('category_name','<div class="field_error">','<span>X</span></div>'); ?>
                                </div>
                            </div>
                        </div>
                        
                        <div class="input_group">
                            <div class="block">
                                <div class="control-label"><span><label for="category_active"><?=lang('active');?>:</label></span></div>
                                <div class="input_block">
                                    <?=form_checkbox(array('name' => 'category_active', 'value' => true, 'checked' => set_checkbox('category_active', true, true), 'class' => 'checkbox-inline', 'id' => 'category_active'));?>
                                </div>
                            </div>
                        </div>
                        
                        <div class="clear"></div>
                        
                        <div class="footer-button-group-container">
                            <div class="button-group-block">
                                <div class="button-position">
                                    <?=form_submit(array('name' => 'add_category', 'value' => lang('add'), 'class' => 'btn btn-blue'));?>
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