<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config = array(
    'back_product_form' => array(
        array(
                'field' => 'product_name',
                'label' => 'Product name',
                'rules' => 'required|xss_clean'
             ),
        array(
                'field' => 'product_code',
                'label' => 'Product code',
                'rules' => 'xss_clean'
             ),
        array(
                'field' => 'product_category',
                'label' => 'Product category',
                'rules' => 'required|xss_clean'
             ),
        array(
                'field' => 'product_quantity',
                'label' => 'product_quantity',
                'rules' => 'xss_clean'
             ),            
        array(
                'field' => 'product_description',
                'label' => 'Product description',
                'rules' => 'xss_clean'
             ),
        array(
                'field' => 'product_price_without_vat',
                'label' => 'Price without vat',
                'rules' => 'xss_clean'
             ),
        array(
                'field' => 'product_price_with_vat',
                'label' => 'Price with vat',
                'rules' => 'required|xss_clean'
             ),
        array(
                'field' => 'meta_tags',
                'label' => 'Meta tags',
                'rules' => 'required|xss_clean'
             ),
        array(
                'field' => 'product_options_available',
                'label' => 'Options available',
                'rules' => 'xss_clean'
             ),
        array(
                'field' => 'product_options',
                'label' => 'Product options',
                'rules' => 'xss_clean'
             ),
        array(
                'field' => 'product_sale_price',
                'label' => 'Product sale price',
                'rules' => 'xss_clean'
             ),             
        array(
                'field' => 'youtube_link',
                'label' => 'Youtube link',
                'rules' => 'xss_clean'
             ),
        array(
                'field' => 'product_active',
                'label' => 'Product active',
                'rules' => 'xss_clean'
             )
    ),
    'back_category_form' => array(
        array(
                'field' => 'category_name',
                'label' => 'Category name',
                'rules' => 'required|xss_clean'
             ),
        array(
                'field' => 'category_active',
                'label' => 'Category active',
                'rules' => 'xss_clean'
             )
    ),
    'back_order_month_form' => array(
        array(
                'field' => 'order_month',
                'label' => 'Month',
                'rules' => 'required|xss_clean'
             ),
        array(
                'field' => 'order_year',
                'label' => 'Year',
                'rules' => 'required|xss_clean'
             )    
    ),
    'back_country_form' => array(
        array(
                'field' => 'country_code',
                'label' => 'Country code',
                'rules' => 'min_length[2]|max_length[3]|required|xss_clean'
             ),
        array(
                'field' => 'country_name',
                'label' => 'Country name',
                'rules' => 'required|xss_clean'
             ),
        array(
                'field' => 'country_active',
                'label' => 'Country active',
                'rules' => 'xss_clean'
             )
    ),
    'back_user_data' => array(
        array(
                'field' => 'username',
                'label' => 'Username',
                'rules' => 'trim|alpha_dash|xss_clean'
             ),
        array(
                'field' => 'email',
                'label' => 'Email',
                'rules' => 'trim|required|valid_email|xss_clean'
             ),
        array(
                'field' => 'activated',
                'label' => 'Activated',
                'rules' => 'xss_clean'
             ),
        array(
                'field' => 'banned',
                'label' => 'Banned',
                'rules' => 'xss_clean'
             ),
        array(
                'field' => 'ban_reason',
                'label' => 'Ban reason',
                'rules' => 'xss_clean'
             ),
    ),
    'back_coupon_data' => array(
        array(
                'field' => 'coupon_code',
                'label' => 'Coupon',
                'rules' => 'trim|required|xss_clean'
             ),
        array(
                'field' => 'discount_type',
                'label' => 'Discount type',
                'rules' => 'trim|required|xss_clean'
             ),
        array(
                'field' => 'discount',
                'label' => 'Discount',
                'rules' => 'trim|required|xss_clean'
             ),
        array(
                'field' => 'min_order',
                'label' => 'Minimum order',
                'rules' => 'trim|is_natural|xss_clean'
             ),
    ),
    'front_checkout_data' => array(
        array(
                'field' => 'first_name',
                'label' => 'First name',
                'rules' => 'required|alpha|min_length[3]|xss_clean'
             ),
        array(
                'field' => 'last_name',
                'label' => 'Last name',
                'rules' => 'required|alpha|min_length[3]|xss_clean'
             ),
        array(
                'field' => 'email',
                'label' => 'Email',
                'rules' => 'required|valid_email|xss_clean'
             ),
        array(
                'field' => 'phone',
                'label' => 'Phone',
                'rules' => 'xss_clean'
             ),
        array(
                'field' => 'adress',
                'label' => 'Adress',
                'rules' => 'required|min_length[3]|xss_clean'
             ),
        array(
                'field' => 'country',
                'label' => 'Country',
                'rules' => 'required|xss_clean'
             ),
        array(
                'field' => 'city',
                'label' => 'City',
                'rules' => 'required|alpha|min_length[3]|xss_clean'
             ),
        array(
                'field' => 'zip',
                'label' => 'Zip',
                'rules' => 'required|min_length[2]|xss_clean'
             ),
    )
);
