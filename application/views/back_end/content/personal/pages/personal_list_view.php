    <div id="center_side_block">
    
        <div class="pageheader main_block">
            <div class="left"><h2><?=lang('personal');?><span><?=lang('personal-list');?></span></h2></div>
            <div class="clear"></div>
        </div>
        
        <div class="block_container content-100">
            <div class="content">
                <div class="content_header"><span><?=lang('personal-list');?></span></div>
                <div class="content_body">
        
                    <? if (empty($personal_data)) : ?>
                    
                    <div class="block_attention"><?=lang('personal-error-no-personal');?></div>
                    
                    <? else: ?>
                
                    <div class="table">
                        <table id="personal_list">
                            <thead>
                                <tr>
                                    <th><?=lang('personal-username');?></td>
                                    <th><?=lang('personal-email');?></td>
                                    <th><?=lang('personal-activated');?></td>
                                    <th><?=lang('personal-ban');?></td>
                                    <th><?=lang('personal-last-login');?></th>
                                    <th><?=lang('action');?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <? foreach($personal_data as $value) : ?>
                                <tr>
                                    <td class="left-column-margin"><?=$value['username'];?></td>
                                    <td class="left-column-margin"><?=$value['email'];?></td>
                                    <td class="center">
                                        <? if ($value['activated']) : ?><img src="<?=site_url($this->config->item('img_folder') . 'icons/icon_prove.png');?>" alt="<?=lang('active');?>" title="<?=lang('active');?>"><? endif; ?>
                                    </td>
                                    <td class="center">
                                        <? if ($value['banned']) : ?><img src="<?=site_url($this->config->item('img_folder') . 'icons/icon_prove.png');?>" alt="active"><? endif; ?>
                                    </td>
                                    <td class="center"><?=!is_null($value['last_login']) ? date($this->config->item('date-simple'), strtotime($value['last_login'])) : '';?></td>
                                    <td class="center">
                                        <a href="<?=base_url('back_end/personal_list_view/'.$value['id']);?>"><img src="<?=site_url('assets/img/icons/icon_view.png');?>" alt="<?=lang('view');?>" title="<?=lang('view');?>"/></a>
                                        <a href="<?=base_url('back_end/personal_edit/'.$value['id']);?>"><img src="<?=site_url('assets/img/icons/icon_edit.png');?>" alt="<?=lang('edit');?>" title="<?=lang('edit');?>"/></a>
                                        <a href="<?=site_url('back_end/personal_delete/'.$value['id']);?>"><img src="<?=site_url('assets/img/icons/icon_delete.png');?>" alt="<?=lang('delete');?>" title="<?=lang('delete');?>"/></a>
                                    </td>
                                </tr>
                                <? endforeach; ?>
                            </tbody>
                        	<tfoot>
                                <tr>
                                    <td><?=lang('personal-username');?></td>
                                    <td><?=lang('personal-email');?></td>
                                    <td> &nbsp; </td>
                                    <td> &nbsp; </td>
                                    <td><?=lang('personal-last-login');?></td>
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