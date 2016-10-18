    <div class="head_menu">
        <div class="menu_content">
        
            <a href="<?=base_url();?>" class="logo">logo</a>
        
            <? if (!config_item('catalog_mode')) : ?>
            <div class="mini_cart">
                <a href="<?=site_url('cart');?>" title="View cart">
                    <span class="basket_count"><?=$korzina_count;?></span>
                    <span><?=lang('cart-items');?></span>
                    (<span class="minicart_view"><?=lang('cart-view');?></span>)
                </a>
            </div>
            <? endif; ?>
        
        </div>
    </div>
    
    
    

    
    