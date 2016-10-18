    <div id="center_side_block">
    
        <div class="pageheader main_block">
            <div class="left"><h2><?=lang('countries');?><span><?=lang('country-list');?></span></h2></div>
            <div class="btn-right"><a class="right btn btn-blue" href="<?=site_url('back_end/country_add');?>"><?=lang('country-add');?></a></div>
            <div class="clear"></div>
        </div>
        
        <div class="block_container content-100">
            <div class="content">
                <div class="content_header"><span><?=lang('country-list');?></span></div>
                <div class="content_body">
        
                    <? if (empty($country_list)) : ?>
                    
                    <div class="block_attention"><?=lang('country-error-no-country');?></div>
                    
                    <? else: ?>
                
                    <div class="table">
                        <table id="category_list">
                            <thead>
                                <tr>
                                    <th><?=lang('code');?></td>
                                    <th><?=lang('name');?></td>
                                    <th><?=lang('status');?></td>
                                    <th><?=lang('action');?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <? foreach($country_list as $value) : ?>
                                <tr>
                                    <td class="center"><?=strtoupper($value['country_code']);?></td>
                                    <td class="left-column-margin"><?=$value['country_name'];?></td>
                                    <td class="center">
                                        <? if ($value['active']) : ?><img src="<?=site_url($this->config->item('img_folder') . 'icons/icon_prove.png');?>" alt="<?=lang('active');?>" title="<?=lang('active');?>"><? endif; ?>
                                    </td>
                                    <td class="center">
                                        <a href="<?=base_url('back_end/country_edit/'.$value['idCountry']);?>"><img src="<?=site_url('assets/img/icons/icon_edit.png');?>" alt="<?=lang('edit');?>" title="<?=lang('edit');?>"/></a>
                                        <a href="<?=site_url('back_end/country_delete/'.$value['idCountry']);?>"><img src="<?=site_url('assets/img/icons/icon_delete.png');?>" alt="<?=lang('delete');?>" title="<?=lang('delete');?>"/></a>
                                    </td>
                                </tr>
                                <? endforeach; ?>
                            </tbody>
                        	<tfoot>
                                <tr>
                                    <td><?=lang('code');?></td>
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
    
</div>

</body>
</html>