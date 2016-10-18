<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

    function get_currency_name($currency)
    {
        foreach (config_item('currency_list') as $key => $value)
        {
            if ($key == $currency) 
            {
                return $value['sign'];
            }
        }
    }
    
    function get_price_with_tax($price)
    {
        return sprintf ("%.2f", $price += ($price*config_item('default_currency_vat'))/100);
    }
    
    function get_price_tax($price)
    {
        return sprintf("%.2f", ($price*config_item('default_currency_vat')/100)); 
    }
    
    function get_price_without_tax($price)
    {
        return sprintf("%.2f", ($price - $price*config_item('default_currency_vat')/(100+config_item('default_currency_vat')))); 
    }
    
    function get_price_tax_back($price)
    {
        return sprintf("%.2f", ($price*config_item('default_currency_vat')/(100+config_item('default_currency_vat')))); 
    }
    
    function format_price($price)
    {
        return sprintf("%.2f", $price); 
    }

?>