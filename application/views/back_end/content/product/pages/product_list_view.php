    <div id="center_side_block">
    
        <? $this->load->view('back_end/attention_message_view');?>
    
        <div class="pageheader main_block">
            <div class="left"><h2><?=lang('product');?><span><?=lang('product-list');?></span></h2></div>
            <div class="btn-right"><a class="right btn btn-blue" href="<?=site_url('back_end/product_add');?>"><?=lang('product-add');?></a></div>
            <div class="clear"></div>
        </div>
        
        <div class="block_container content-100">
            <div class="content">
                <div class="content_header"><span><?=lang('product-list');?></span></div>
                <div class="content_body">
                
                    <? if (empty($product_list)) : ?>
                    
                    <div class="block_attention"><?=lang('product-error-no-prod');?></div>
                    
                    <? else: ?>
                
                    <div class="table">
                        <table id="product_list">
                            <thead>
                                <tr>
                                    <th width="75"><?=lang('image');?></th>
                                    <th><?=lang('code');?></th>
                                    <th><?=lang('name');?></td>
                                    <th><?=lang('product-quantity');?></td>
                                    <th><?=lang('product-price');?></td>
                                    <th><?=lang('status');?></td>
                                    <th><?=lang('action');?></td>
                                </tr>
                            </thead>
                            <tbody>
                                <? foreach($product_list as $value) : ?>
                                <tr>
                                    <td class="highslide-gallery">
                                        <? if (!empty($value['image'])) : ?>
                                        <a href="<?=site_url($this->config->item('trumb1_location').$value['image']);?>" class="highslide" onclick="return hs.expand(this)">
                                            <img src="<?=site_url($this->config->item('trumb2_location').$value['image']);?>" alt="" title="<?=lang('enlarge-image');?>"/>
                                        </a>
                                        <? endif; ?>
                                    </td>
                                    <td class="left-column-margin"><?=$value['product_code'];?></td>
                                    <td class="left-column-margin"><?=$value['name'];?></td>
                                    <td class="center"><?=$value['quantity'];?></td>
                                    <td class="center">
                                        <? if ($value['options_available'] && !empty($value['sale_price'])) : ?>
                                        
                                        <?=get_currency_name($this->config->item('default_currency'));?>&nbsp;<span class="sale-price"><?=format_price($value['price']);?></span>
                                        <br />
                                        <?=get_currency_name($this->config->item('default_currency'));?>&nbsp;<?=format_price($value['sale_price']);?>
                                            
                                        <? else : ?>
                                        
                                            <?=get_currency_name($this->config->item('default_currency'));?>&nbsp;<?=format_price($value['price']);?>
                                        
                                        <? endif; ?>
                                    </td>
                                    <td class="center"><? if ($value['active']) : ?><img src="<?=site_url($this->config->item('img_folder') . 'icons/icon_prove.png');?>" alt="<?=lang('active');?>" title="<?=lang('active');?>"><? endif; ?></td>
                                    <td class="center">
                                        <a href="<?=site_url('back_end/product_view/'.$value['idProduct']);?>"><img src="<?=site_url('assets/img/icons/icon_view.png');?>" alt="<?=lang('view');?>" title="<?=lang('view');?>"/></a>
                                        <a href="<?=site_url('back_end/product_edit/'.$value['idProduct']);?>"><img src="<?=site_url('assets/img/icons/icon_edit.png');?>" alt="<?=lang('edit');?>" title="<?=lang('edit');?>"/></a>
                                        <a href="<?=site_url('back_end/product_delete/'.$value['idProduct']);?>"><img src="<?=site_url('assets/img/icons/icon_delete.png');?>" alt="<?=lang('delete');?>" title="<?=lang('delete');?>"/></a>
                                    </td>
                                </tr>
                                <? endforeach; ?>
                            </tbody>
                        	<tfoot>
                                <tr>
                                    <td> &nbsp; </td>
                                    <td><?=lang('code');?></td>
                                    <td><?=lang('name');?></td>
                                    <td><?=lang('product-quantity');?></td>
                                    <td><?=lang('product-price');?></td>
                                    <td>  &nbsp; </td>
                                    <td>  &nbsp; </td>
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