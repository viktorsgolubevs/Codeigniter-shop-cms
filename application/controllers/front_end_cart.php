<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Front_end_cart extends MY_Controller {
	
    public function __construct()
	{
        parent::__construct();
        
        $this->data = array();
        
        // If catalog mode enabled then redirect to main page
        if (config_item('catalog_mode')) {
            redirect('/');
        }
        
        // Load models
        $this->load->model('cart_model');
        
        // Load languages
        $this->lang->load('front_end');
        
        $this->data['korzina_count'] = $this->cart->total_items();
    }
    
    public function shopping_cart()
    {
        if(!$this->cart->contents())
        {
            $this->data['empty_cart'] = true;
        }
        else
        {
            foreach ($this->cart->contents() as $value)
            {
                $this->data['cart_list'][$value['rowid']] = $this->cart_model->get_product($value['id']);
                $this->data['cart_list'][$value['rowid']]['subtotal'] = $value['subtotal'];
                $this->data['cart_list'][$value['rowid']]['quantity'] = $value['qty'];
                $this->data['cart_list'][$value['rowid']]['price'] = $value['price'];
                $this->data['cart_list'][$value['rowid']]['rowid'] = $value['rowid'];
            }
            
            $cart_data = $this->session_lib->get_coupon_data();
            
            if(!empty($cart_data))
            {
                $this->data['cart_discount'] = true;
                $this->data['coupon_code'] = $cart_data['coupon_code'];
                
                switch($cart_data['discount_type']) {
                    case(1):
                        $this->data['discount_price'] = $this->cart->total() - ($this->cart->total()*$cart_data['discount'])/100;
                        break;
                    case(2):
                        $this->data['discount_price'] = $this->cart->total() - $cart_data['discount'];
                        break;
                }
            }
        }
        $this->display_lib->front_end_view('shopping_cart', 'shopping_cart', $this->data);
    }
    
    public function add_to_cart()
    {
        $size = $this->input->post('size');
        $quantity = $this->input->post('quantity');
        $product_id = (int)$this->input->post('product');
        
        if ($this->data = $this->cart_model->get_product($product_id))
        {
            // Check if product is set sale and sale price is entered
            if (!empty($this->data['sale_price']) && $this->data['options_available'] && $this->data['options'] == 'sale')
            {
                $price = format_price($this->data['sale_price']);
            }
            else
            {
                $price = format_price($this->data['price']);
            }
            
            $tovar_data = array(
          		'id'      => $this->data['idProduct'],
          		'qty'     => $quantity,
          		'price'   => $price,
          		'name'    => 'default'
           	);
            
            $this->cart->insert($tovar_data);
        
            if (IS_AJAX)
            {
                $total_items = $this->cart->total_items();
                if (!empty($total_items))
                {
                    echo json_encode(array('basket' => $total_items));
                }
            }
            else
            {
                redirect('product/'.$product_id);
            }
        }

    }
    
   	public function empty_cart()
    {
		$this->cart->destroy();
        $this->session_lib->delete_coupon_data();
        
		redirect('');
	}
    
    public function remove_item($product_id)
    {
        $tovar_data = array(
      		'rowid'   => $product_id,
      		'qty'     => '0',
       	);
            
        $this->cart->update($tovar_data);
            
        redirect('cart');
    }
    
    public function update_total()
    {
        if (isset($_POST['code_check']))
        {
            $coupon_code = $this->security->xss_clean($this->input->post('coupon_code'));
            
            if (isset($coupon_code) && !empty($coupon_code))
            {
                $this->load->model('coupon_model');
                
                if (!$coupon_data = $this->coupon_model->check_coupon($coupon_code))                                // Check if correct coupon
                {
                    $this->session->set_flashdata('cart_error', 'Coupon '.$coupon_code.' you try to enter is incorrect!');
                    
                    $this->session_lib->delete_coupon_data();
                }
                elseif (!empty($coupon_data['min_order']) && $coupon_data['min_order'] >= $this->cart->total())     // Check if coupon min order set and currect cart price more then coupon min order
                {
                    $this->session->set_flashdata('cart_error', $this->lang->line('cart-error-min-coupon-order', $coupon_data['coupon_code'], $coupon_data['min_order']));
                    
                    $this->session_lib->delete_coupon_data();
                }
                else
                {
                    $this->session->set_userdata('cart_coupon' , array(
                        'coupon_code'   => $coupon_data['coupon_code'],
                        'discount'      => $coupon_data['discount'],
                        'discount_type' => $coupon_data['discount_type'],
                        'min_order'     => $coupon_data['min_order']
                    ));
                }
            }
        }
        elseif (isset($_POST['update_total'])) 
        {
    		$item         = $this->input->post('rowid');
    	    $quantity     = $this->input->post('quantity');
       
            $prod_error   = array();
       
            $i = 0;
                
            foreach($this->cart->contents() as $value)
            {
                $val = $this->cart_model->check_max_quantity(array('product_id' => $value['id'], 'quantity' => $quantity[$i]));
               
                if (!empty($val))
                {
                    $this->cart->update(array('rowid' => $item[$i], 'qty'   => $quantity[$i]));
                }
                else
                {
                    $prod_error[$i] = $value['id'];
                }
               
                $i += 1;
            }
            
            // If updating we have errors then show them
            if (!empty($prod_error)) 
            {
                
                $this->session->set_flashdata('cart_error', $this->lang->line('cart-error-maximum-quantity'));
                $this->session->set_flashdata('cart_row_error', $prod_error);
            }
             
            $coupon_data = $this->session_lib->get_coupon_data();
            
            // Check if coupon min order  cart price more then coupon min order
            if (!empty($coupon_data) && !empty($coupon_data['min_order']) && $coupon_data['min_order'] >= $this->cart->total())     // Check if coupon min order set and currect cart price more then coupon min order
            {
                $this->session->set_flashdata('cart_error', 'Current Coupon: '.$coupon_data['coupon_code'].' off on order of '.$coupon_data['min_order'].' and above.');
                
                $this->session_lib->delete_coupon_data();
            }
            
        }
        
        redirect('cart');
    }
    
   	public function empty_coupon()
    {
        $this->session_lib->delete_coupon_data();
        
		redirect($_SERVER['HTTP_REFERER']);
	}
    
    public function checkout()
    {
        if ($this->cart->total_items() == 0) {
            redirect(base_url());
        } else {
            
            $this->load->model('country_model');
            $this->load->model('product_model');
            
            $this->data['country_list'] = $this->country_model->get_active_country_list();
            
            foreach ($this->cart->contents() as $value)
            {
                $this->data['cart_list'][$value['rowid']] = $this->cart_model->get_product($value['id']);
                $this->data['cart_list'][$value['rowid']]['subtotal'] = $value['subtotal'];
                $this->data['cart_list'][$value['rowid']]['quantity'] = $value['qty'];
                $this->data['cart_list'][$value['rowid']]['price'] = $value['price'];
                $this->data['cart_list'][$value['rowid']]['rowid'] = $value['rowid'];
            }
            
            $cart_data = $this->session_lib->get_coupon_data();
            
            if(!empty($cart_data))
            {
                $this->data['cart_discount'] = true;
                $this->data['coupon_code'] = $cart_data['coupon_code'];
                
                switch($cart_data['discount_type']) {
                    case(1):
                        $this->data['discount_price'] = $this->cart->total() - ($this->cart->total()*$cart_data['discount'])/100;
                        break;
                    case(2):
                        $this->data['discount_price'] = $this->cart->total() - $cart_data['discount'];
                        break;
                }
            }
            
            if ($this->form_validation->run('front_checkout_data') == true)
            {
                if ($order_id = $this->cart_model->add_order_details(array(
                                'first_name'        => $this->form_validation->set_value('first_name'),
                                'last_name'         => $this->form_validation->set_value('last_name'),
                                'adress'            => $this->form_validation->set_value('adress'),
                                'email'             => $this->form_validation->set_value('email'),
                                'phone'             => $this->form_validation->set_value('phone'),
                                'idCountry'         => $this->form_validation->set_value('country'),
                                'city'              => $this->form_validation->set_value('city'),
                                'zip'               => $this->form_validation->set_value('zip'),
                                'discount'          => isset($this->data['cart_discount']) ? true : false,
                                'discount_name'     => isset($cart_data['coupon_code']) ? $cart_data['coupon_code'] : null,
                                'discount_price'    => isset($this->data['discount_price']) ? $this->cart->total() - $this->data['discount_price'] : null,
                                'order_total_price' => $this->cart->total())
                                ))
                {
                    
                    foreach ($this->cart->contents() as $value)
                    {
                        $product_data['order_detail_id']      = $order_id;
                        $product_data['product_id']           = $value['id'];
                        $product_data['quantity']             = $value['qty'];
                        $product_data['price']                = $value['price'];
                        $product_data['total_price']          = $value['subtotal'];

                        $this->cart_model->add_order_product($product_data);
                        $this->data['product_data_row'] = $this->product_model->get_row($product_data['product_id']);
                        
                        // Update product quantity
                        $this->product_model->update($product_data['product_id'], array('quantity' => $this->data['product_data_row']['quantity'] - $product_data['quantity']));
                    }
                }
                 
                // Send order copy to client email
                if ($this->config->item('email_client_order'))
                {
                    // Check if order id exist
                    if (!is_null($order_id))
                    {
                        $this->load->model('order_model');
                        
                        $this->data['order_data'] = $this->order_model->get_order($order_id);
                        $this->data['order_product_data'] = $this->order_model->get_order_products($this->data['order_data']['idOrder']);
                     
                        $this->load->library('email');
                        
                        $this->email->from($this->config->item('websaite_email'));
                        $this->email->to($this->form_validation->set_value('email'));
                        // Give abbility to post in email message reply email
                        //$this->email->reply_to($this->config->item('websaite_email'));
                        $this->email->subject('Order #'.$order_id);
                        $this->email->message($this->load->view('front_end/email/order_send-html', $this->data, TRUE));
                        
                        $this->email->send();
                    }
                }
                 
                $this->cart->destroy();
                $this->session_lib->delete_coupon_data();
                
                $data['korzina_count'] = $this->cart->total_items();
                
                // Load view
                $this->display_lib->front_end_view('checkout', 'send_order_message', $this->data);
            } else {
                // Load view
                $this->display_lib->front_end_view('checkout', 'checkout', $this->data);
            }            
        }
    }
}

?>