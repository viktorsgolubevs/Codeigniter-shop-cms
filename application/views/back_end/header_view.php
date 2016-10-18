<div id="wrapper">

    <div class="page_header">
    
        <div class="logo_block">
            <a href="<?=site_url('back_end');?>" class="logo"></a>
        </div>
        <div class="header_content">
        
            <div class="drop-container">
                <div id="trigger"><?=$this->session_lib->get_username();?></div>
                <div id="drop">
                    <a href="<?=site_url('auth/change_password');?>"><?=lang("change-password");?></a>
                    <div class="menu-devider"></div>
                    <a href="<?=site_url('');?>"><?=lang('website-home');?></a>
                    <a href="<?=site_url('auth/logout');?>"><span class="log-out-icon"><?=lang('log-out');?></span></a>
                </div>
            </div>
        
        </div>
    </div>
