<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Front_end_client extends MY_Controller {

	public function __construct()
	{
        parent::__construct();
            
        $this->data = array();
        
        // Load languages
        $this->lang->load('front_end');
        
        $this->data['korzina_count'] = $this->cart->total_items();
	}
    
    public function show_product_list()
    {            
        $this->load->model('product_category_model');
        $this->load->model('product_model');
        
        // Load youtube video helper
        $this->load->helper('youtube_video');
        
        $this->data['category_list'] = $this->product_category_model->get_product_categories(true);
        
        $this->data['product_list'] = $this->product_model->get_active_product('asc');
          
		$this->display_lib->front_end_view('product_list', 'product_list', $this->data);
    }
    
    public function show_product($product_id)
    {
        $this->load->model('product_model');
        
        // Load youtube video helper
        $this->load->helper('youtube_video');
        
        $this->data['product_item'] = $this->product_model->get_row($product_id);

        if ($this->data['product_item']['quantity'] > 0)
        {
            for ($i = 1; $i<= $this->data['product_item']['quantity']; $i++ )
            {
                $this->data['quantity_items'][$i] = $i;
            }
        }

        $this->data['korzina_count'] = $this->cart->total_items();
       
		$this->display_lib->front_end_view('product_inside', 'product_inside', $this->data);
    }
    
    public function show_stock_quanity()
    {
        if (IS_AJAX)
        {
            $this->load->model('product_details_model');
            
            $size_id = $this->input->post('size_id');

            if ($this->data['quantity_list'] = $this->product_details_model->get_row($size_id))
            {
                if ($this->data['quantity_list']['quantity'] > 0)
                {
                    for ($i = 1; $i<= $this->data['quantity_list']['quantity']; $i++ )
                    {
                        $this->data['quantity_items'][$i] = $i;
                    }
                    
                    echo json_encode(array('quantity_items' => $this->data['quantity_items']));
                }
                else
                {
                    echo json_encode(array('no_quantity' => true));
                }
            }
        }
        else
        {
            die('error');
        }
    }
    
}