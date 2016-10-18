    <div id="center_side_block">
    
        <div class="pageheader main_block">
            <div class="left"><h2><?=lang('category');?><span><?=lang('category-view');?> - <?=$category_data['name'];?></span></h2></div>
            <div class="clear"></div>
        </div>
        
        <div class="block_container content-100">
        
            <div class="content">
                <div class="content_header">
                    <ul>
                        <li><a href="<?=site_url('back_end/category_list');?>"><?=lang('category-list');?></a></li>
                        <li class="active"><?=lang('category-view');?></li>
                    </ul>
                    <div class="clear"></div>
                </div>
                <div class="content_body">
                    <?=form_open(uri_string()); ?>
                            
                        <div class="input_group">
                            <div class="block">
                                <div class="control-label"><span><?=lang('category-name');?>:</span></div>
                                <div class="input_block">
                                    <?=form_input(array('name' => 'category_name', 'value' => $category_data['name'], 'class' => 'form_control sz1', 'disabled' => 'disabled'))?>
                                </div>
                            </div>
                        </div>
                        
                        <div class="input_group">
                            <div class="block">
                                <div class="control-label"><span><label for="category_active"><?=lang('active');?>:</label></span></div>
                                <div class="input_block">
                                    <? if($category_data['active']) : ?>
                                    <?=form_checkbox(array('name' => 'category_active', 'value' => 0, 'checked' => 'checked', 'class' => 'checkbox-inline', 'id' => 'category_active', 'disabled' => 'disabled'));?>
                                    <? else : ?>
                                    <?=form_checkbox(array('name' => 'category_active', 'value' => 0, 'class' => 'checkbox-inline', 'id' => 'category_active', 'disabled' => 'disabled'));?>
                                    <? endif; ?>
                                </div>
                            </div>
                        </div>
                        
                        <div class="clear"></div>
                        
                        <div class="footer-button-group-container">
                            <div class="button-group-block">
                                <div class="button-position">
                                    <a href="<?=site_url('back_end/category_list');?>" class="btn btn-gray"><?=lang('back');?></a>
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