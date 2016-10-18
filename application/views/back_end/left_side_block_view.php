<div class="page-wrapper">

    <div id="left_side_block">
        <div class="left_block">
            <h5 class="sidebartitle"><?=lang('navigation-title');?></h5>
        
            <ul id="side_menu" class="menu_list">
                <li class="home"><?=anchor('home', lang('home'));?></li>
                <li><a href="#"><?=lang('product');?></a>
                    <ul>
                        <li><?=anchor('back_end/product_list', lang('product-list'))?></li>
                    </ul>
                </li>
                <li><a href="#"><?=lang('category');?></a>
                    <ul>
                        <li><?=anchor('back_end/category_list', lang('category-list'));?></li>
                    </ul>
                </li>
                <li><?=anchor('back_end/coupon_list', lang('coupons'));?></li>
                <li><a href="#"><?=lang('orders');?></a>
                    <ul>
                        <li><?=anchor('back_end/order_all_list', lang('orders'));?></li>
                        <li><?=anchor('back_end/order_new_list', lang('orders-new'));?></li>
                        <li><?=anchor('back_end/order_monthly_list', lang('orders-monthly'));?></li>
                    </ul>
                </li>
                <li><a href="<?=site_url('back_end/country_list');?>"><?=lang('countries');?></a></li>
                <li><a href="#"><?=lang('personal');?></a>
                    <ul>
                        <li><?=anchor('back_end/personal_list', lang('personal-list'));?></li>
                        <li><?=anchor('auth/change_password', lang('change-password'));?></li>
                        <li><?=anchor('auth/custom_register', lang('register-new-user'));?></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
