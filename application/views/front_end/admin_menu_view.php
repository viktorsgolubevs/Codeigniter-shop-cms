    <? if ($this->session_lib->is_logged_in()) : ?>
    <div class="admin-menu-block">
        <a href="<?=site_url('auth/logout');?>"><span class="log-out-icon"><?=lang('admin-log-out');?></span></a>
        <a href="<?=site_url('home');?>" class="admin-area-bg"><?=lang('admin-area');?></a>
    </div>
    <? endif; ?>
    