<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config['website_name']     = 'MySHOP';
$config['websaite_email']   = 'xxxx@xxxx.xx';

$config['webmaster']        = 'Xxxxxx Xxxxxx';
$config['webmaster_email']  = 'xxxx@xxxx.xx';

$config['copyrigh_year']    = date('Y');

$config['date-simple']      = 'd-m-Y';
$config['date-full']        = 'd-m-Y H:i:s';

/*
|--------------------------------------------------------------------------
| Send order copy to client email 
|--------------------------------------------------------------------------
*/
$config['email_client_order'] = true;

/*
|--------------------------------------------------------------------------
| CSS | IMG | JS folder settings 
|--------------------------------------------------------------------------
*/

$config['assets_folder'] = 'assets/';

$config['js_folder']        = $config['assets_folder'] . 'js/';
$config['js_back_end']      = $config['js_folder'] . 'back_end/';
$config['js_front_end']     = $config['js_folder'] . 'front_end/';
$config['js_global']        = $config['js_folder'] . 'global/';

$config['css_folder']       = $config['assets_folder'] . 'css/';
$config['css_back_end']     = $config['css_folder'] . 'back_end/';
$config['css_front_end']    = $config['css_folder'] . 'front_end/';

$config['img_folder']       = $config['assets_folder'] . 'img/';

/*
|--------------------------------------------------------------------------
| Images
|--------------------------------------------------------------------------
*/
$config['image_folder'] = 'product/';

$config['image_trumb_folder'] = $config['image_folder'] . 'trumbs/';

// image temporary folder
$config['image_tmp'] = $config['image_folder'] . 'tmp/';

$config['image_max_size']   = 5000;
$config['image_max_width']  = 900;
$config['image_max_height'] = 400;
$config['image_cut_name']   = 3;

// Image trumb 1 settings
$config['image_big'] = $config['image_folder'] . 'big/';

$config['trumb1_location'] = $config['image_folder'] . 'trumbs_270/';

$config['trumb1_width']     = 272;
$config['trumb1_height']    = 246;

// Image trumb 2 settings
$config['trumb2_location'] = $config['image_folder'] . 'trumbs_75/';

$config['trumb2_width']     = 75;
$config['trumb2_height']    = 68;

$config['image_allow_type'] = array('0'=>'jpg','1'=>'jpeg','2'=>'JPG','3'=>'gif', '4'=>'png');

/*
|--------------------------------------------------------------------------
| Currency settings
|
| 'currency_list' = Website orice currency list
| 'default_currency' = Default website currency
|--------------------------------------------------------------------------
*/

$config['currency_list'] = array(
    'lv' => array(
        'name' => 'eur',
        'sign' => '&#8364;'
    ),
    'usa' => array(
        'name' => 'usd',
        'sign' => '&#36;'
    ),
    'gbr' => array(
        'name' => 'gbr',
        'sign' => '&#163;'
    ),
    'jpn' => array(
        'name' => 'jpy',
        'sign' => '&#165;'
    )
);

$config['default_currency'] = 'lv';

$config['default_currency_vat'] = '21';

/*
|--------------------------------------------------------------------------
| Admin area DataTable show per page
|
| 'show_per_page' = integer : show items per page
|--------------------------------------------------------------------------
*/

$config['admin_show_per_page'] = 10;

/*
|--------------------------------------------------------------------------
| Catalog mode
|--------------------------------------------------------------------------
*/
$config['catalog_mode'] = false;

/*
|--------------------------------------------------------------------------
| Coupon settings in shopping cart
|
| 'coupon_active' = boolean : coupon status (show/hide)
|--------------------------------------------------------------------------
*/

$config['coupon_active'] = true;