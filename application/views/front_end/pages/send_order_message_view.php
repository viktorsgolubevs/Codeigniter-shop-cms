    <div class="wrap_bg">
        <div class="main_container">
        
        <div class="attention_block">
            <div class="img_icon">
                <img src="<?=site_url($this->config->item('img_folder') . 'report-icon.png');?>" alt="received order"/>
            </div>
            <h1><?=lang('cart-successful-message');?></h1>
            <h3><?=lang('cart-successful-maneger-message');?></h3>

            <br />
            <br />

            <p><?=$this->lang->line('cart-successful-link', '<a href="'.base_url().'" class="underline">', '</a>');?></p>
            
        </div>
            
        </div>    
    </div>