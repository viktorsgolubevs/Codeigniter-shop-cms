    <div id="center_side_block">
    
        <div class="pageheader main_block">
            <div class="left"><h2><?=lang('category');?><span><?=lang('category-list');?></span></h2></div>
            <div class="btn-right"><a class="right btn btn-blue" href="<?=site_url('back_end/category_add');?>"><?=lang('category-add');?></a></div>
            <div class="clear"></div>
        </div>
        
        <div class="block_container content-100">
            <div class="content">
                <div class="content_header"><span><?=lang('category-list');?></span></div>
                <div class="content_body">
        
                    <? if (empty($category_list)) : ?>
                    
                    <div class="block_attention">No product! Please add new product</div>
                    
                    <? else: ?>
                
                    <div class="table">
                        <table id="category_list">
                            <thead>
                                <tr>
                                    <th><?=lang('name');?></td>
                                    <th><?=lang('status');?></td>
                                    <th><?=lang('action');?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <? foreach($category_list as $value) : ?>
                                <tr>
                                    <td class="left-column-margin"><?=$value['name'];?></td>
                                    <td class="center">
                                        <? if ($value['active']) : ?><img src="<?=site_url($this->config->item('img_folder') . 'icons/icon_prove.png');?>" alt="<?=lang('active');?>" title="<?=lang('active');?>"><? endif; ?>
                                    </td>
                                    <td class="center">
                                        <a href="<?=base_url('back_end/category_view/'.$value['idCategory']);?>"><img src="<?=site_url('assets/img/icons/icon_view.png');?>" alt="<?=lang('view');?>" title="<?=lang('view');?>"/></a>
                                        <a href="<?=base_url('back_end/category_edit/'.$value['idCategory']);?>"><img src="<?=site_url('assets/img/icons/icon_edit.png');?>" alt="<?=lang('edit');?>" title="<?=lang('edit');?>"/></a>
                                        <a href="<?=site_url('back_end/category_delete/'.$value['idCategory']);?>"><img src="<?=site_url('assets/img/icons/icon_delete.png');?>" alt="<?=lang('delete');?>" title="<?=lang('delete');?>"/></a>
                                    </td>
                                </tr>
                                <? endforeach; ?>
                            </tbody>
                        	<tfoot>
                                <tr>
                                    <td><?=lang('name');?></td>
                                    <td> &nbsp; </td>
                                    <td> &nbsp; </td>
                                </tr>
                        	</tfoot>
                        </table>        
                    </div>
                    
                    <? endif; ?>
                </div>
            </div>
        </div>
    </div>
    
</div> <!-- Page wrapper end -->

</body>
</html>