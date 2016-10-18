    <div id="center_side_block">
    
        <div class="pageheader main_block">
            <div class="left"><h2><?=lang('category');?><span><?=lang('category-edit');?> - <?=$category_edit['name'];?></span></h2></div>
            <div class="clear"></div>
        </div>
        
        <div class="block_container content-100">
        
            <div class="content">
                <div class="content_header">
                    <ul>
                        <li><a href="<?=site_url('back_end/category_list');?>"><?=lang('category-list');?></a></li>
                        <li class="active"><?=lang('category-edit');?></li>
                    </ul>
                    <div class="clear"></div>
                </div>
                <div class="content_body">
                    <?=form_open(uri_string()); ?>
                            
                        <div class="input_group">
                            <div class="block">
                                <div class="control-label"><span><?=lang('category-name');?>:</span></div>
                                <div class="input_block">
                                    <?=form_input(array('name' => 'category_name', 'value' => $category_edit['name'], 'class' => 'form_control sz1'))?>
                                    <?=form_error('category_name','<div class="field_error">','<span>X</span></div>'); ?>
                                </div>
                            </div>
                        </div>
                        
                        <div class="input_group">
                            <div class="block">
                                <div class="control-label"><span><label for="category_active"><?=lang('active');?>:</label></span></div>
                                <div class="input_block">
                                    <? if($category_edit['active']) : ?>
                                    <?=form_checkbox(array('name' => 'category_active', 'value' => 0, 'checked' => 'checked', 'class' => 'checkbox-inline', 'id' => 'category_active'));?>
                                    <? else : ?>
                                    <?=form_checkbox(array('name' => 'category_active', 'value' => 1, 'class' => 'checkbox-inline', 'id' => 'category_active'));?>                                    
                                    <? endif; ?>
                                </div>
                            </div>
                        </div>
                        
                        <div class="clear"></div>
                        
                        <div class="footer-button-group-container">
                            <div class="button-group-block">
                                <div class="button-position">
                                    <?=form_submit(array('name' => 'edit_category', 'value' => lang('edit'), 'class' => 'btn btn-blue'));?>
                                    <a href="<?=site_url('back_end/category_list');?>" class="btn btn-gray"><?=lang('reset');?></a>
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