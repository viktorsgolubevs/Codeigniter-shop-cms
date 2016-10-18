    <div class="navigation-block">
        <div class="navigation_menu">
            <ul class="nav_btn">
                <li class="filter" data-filter="all"><?=lang('menu-show-all');?></li>
                <? foreach($category_list as $value) : ?>
                <li class="filter" data-filter="category_<?=$value['idCategory'];?>"><?=$value['name'];?></li>
                <? endforeach; ?>
            </ul>
            
            <div class="sort-drop-container">
                <div id="sort-btn">Sort</div>
                <div id="sort-dropdown-list">
                    <ul>
                        <li class="sort" data-sort="data-cat" data-order="desc"><?=lang('sort-descending');?></li>
                        <li class="sort" data-sort="data-cat" data-order="asc"><?=lang('sort-ascending');?></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    
    <div class="wrap_bg_index">
    
        <div id="youtube-window"></div>
    
        <div class="main_container">
        
        <? if (empty($product_list)) : ?>
        
        <div class="attention_block">
            <?=lang('products-no-available');?>
            <p><?=$this->lang->line('product-no-available-link','<a href="'.base_url().'">', '</a>');?></p>
        </div>
        
        <? else : ?>
        
            <ul id="product">
                <? foreach($product_list as $value) : ?>
                <li class="product_item necet mix category_<?=$value['product_category_id'];?>"  data-cat="<?=$value['price'];?>">
                    <a href="<?=site_url('product/'.$value['idProduct']);?>" title="<?=$value['name'];?>">
                        
                        <div class="img_block">
                            <? if(!empty($value['image'])) : ?>
                            <img src="<?=site_url($this->config->item('trumb1_location') . $value['image']);?>" alt=""/>
                            <? else : ?>
                            <img src="<?=site_url($this->config->item('trumb1_location') . 'empty_270.jpg');?>" alt=""/>
                            <? endif; ?>                     
        
                            <? if (!empty($value['youtube_link'])) : ?>
                            <div class="video-btn-preview-block">
                                <div class="video-button" data-video="<?=show_youtube($value['youtube_link']);?>"><?=lang('product-label-video');?></div>
                            </div>
                            <? endif; ?>
                            
                        </div>
                        
                        <div class="product-inf">
                            <div class="product-name-block">
                                <div class="product-name-cell">
                                    <?=$value['name'];?>
                                </div>
                            </div>
                            <div class="product-price">
                                <? if ($value['sale_price'] && $value['options_available'] && $value['options'] == 'sale') : ?>
                                <div class="sale-price">
                                    <?=get_currency_name($this->config->item('default_currency'));?>
                                    <span class="price"><?=format_price($value['price']);?></span> 
                                </div>
                                <div class="price">
                                    <?=get_currency_name($this->config->item('default_currency'));?>
                                    <span class="price"><?=format_price($value['sale_price']);?></span>                                
                                </div>
                                <? else : ?>
                                <div class="price">
                                    <?=get_currency_name($this->config->item('default_currency'));?>
                                    <span class="price">
                                    <?=format_price($value['price']);?>
                                    </span>                                
                                </div>
                                <? endif; ?>
                            </div>
                            <? if ($value['options_available']) : ?>
                            
                            <? if($value['options'] == 'sale') : ?>
                            <span class="option sale"><?=lang('product-label-sale');?></span>
                            <? endif; ?>
                            
                            <? if($value['options'] == 'hot') : ?>
                            <span class="option hot"><?=lang('product-label-hot');?></span>
                            <? endif; ?>
                            
                            <? if($value['options'] == 'new') : ?>
                            <span class="option new"><?=lang('product-label-new');?></span>
                            <? endif; ?>
                            
                            <? endif; ?>
                        </div>
                    </a>
                </li>
                <? endforeach; ?>
            </ul>
            
        <? endif; ?>      
            
        </div>    
    </div>