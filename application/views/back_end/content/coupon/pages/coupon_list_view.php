    <div id="center_side_block">
    
        <div class="pageheader main_block">
            <div class="left"><h2><?=lang('coupons');?><span><?=lang('coupon-list');?></span></h2></div>
            <div class="btn-right"><a class="right btn btn-blue" href="<?=site_url('back_end/coupon_add');?>"><?=lang('coupon-add');?></a></div>
            <div class="clear"></div>
        </div>
        
        <div class="block_container content-100">
            <div class="content">
                <div class="content_header"><span><?=lang('coupon-list');?></span></div>
                <div class="content_body">
        
                    <? if (empty($coupon_data)) : ?>
                    
                    <div class="block_attention"><?=lang('coupon-error-no-coupon');?></div>
                    
                    <? else: ?>
                
                    <div class="table">
                        <table id="category_list">
                            <thead>
                                <tr>
                                    <th><?=lang('coupon-code');?></td>
                                    <th><?=lang('discount');?></td>
                                    <th><?=lang('coupon-minimal-order');?></td>
                                    <th><?=lang('action');?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <? foreach($coupon_data as $value) : ?>
                                <tr>
                                    <td class="center"><?=$value['coupon_code'];?></td>
                                    <td class="center"><?=$value['discount'];?></td>
                                    <td class="center"><?=$value['min_order'];?></td>
                                    <td class="center">
                                        <a href="<?=base_url('back_end/coupon_edit/'.$value['idCoupon']);?>"><img src="<?=site_url('assets/img/icons/icon_edit.png');?>" alt="edit" title="edit"/></a>
                                        <a href="<?=site_url('back_end/coupon_delete/'.$value['idCoupon']);?>"><img src="<?=site_url('assets/img/icons/icon_delete.png');?>" alt="delete"/></a>
                                    </td>
                                </tr>
                                <? endforeach; ?>
                            </tbody>
                        	<tfoot>
                                <tr>
                                    <td><?=lang('coupon-code');?></td>
                                    <td><?=lang('discount');?></td>
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