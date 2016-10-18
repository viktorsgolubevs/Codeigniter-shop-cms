<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Back_end extends CI_Controller {
    
   	public function __construct()
	{
        parent::__construct();
        
        // not logged
        if (!$this->session_lib->is_logged_in()) {
            redirect('/auth/login/');
        }
        
        // Load languages
        $this->lang->load('back_end');
        
        $this->data = array();
	}

    public function index()
    {
        $this->home();
    }
    
    public function home()
    {
        // Load view
        $this->display_lib->back_end_view('home','home_page', 'home_page', $this->data);
    }
    
    public function product_list()
    {
        $this->load->model('product_model');
        
        $this->data['product_list'] = $this->product_model->get_array();
        
        // Load view
        $this->display_lib->back_end_view('product','product_list', 'product_list', $this->data);
    }


    public function product_add()
    {
        $this->load->model('product_model');
        $this->load->model('product_category_model');
        
        $this->data['product_categories'] = $this->product_category_model->get_product_categories(true);
        
        $this->session->unset_userdata('product_image');
        
        if ($this->form_validation->run('back_product_form')) {
            $this->load->library('image_upload_lib');
            
            $config = array();
        
            $config['source_image_name'] = $_FILES['file']['name'];
            $config['source_image_tmp']  = $_FILES['file']['tmp_name'];
            $config['save_dir_product']  = $this->config->item('image_tmp');
            $config['save_dir_trumb']    = $this->config->item('image_trumb_folder');
            $config['max_size']          = $this->config->item('image_max_size');
            $config['max_width']         = $this->config->item('image_max_width');
            $config['max_height']        = $this->config->item('image_max_height');
            $config['allowed_types']     = $this->config->item('image_allow_type');
            
            $config['trumb1_width']      = $this->config->item('trumb1_width');
            $config['trumb1_height']     = $this->config->item('trumb1_height');
            
            $config['trumb2_width']      = $this->config->item('trumb2_width');
            $config['trumb2_height']     = $this->config->item('trumb2_height');
                     
            if (!empty($config['source_image_name']))
            {
                if (isset($config['source_image_name']) && empty($config['source_image_name'])) {
                    $this->session->set_flashdata('image_error', 'Please enter file');
                    redirect(current_url());
                }
                
                if (isset($config['allowed_types']) && !$this->image_upload_lib->_check_allowed_type($config['source_image_name'], $config['allowed_types'])) {
                    $this->session->set_flashdata('image_error', 'Such type not allowed');
                    redirect(current_url());
                }
                
                if (isset($config['max_size']) && !empty($config['max_size']) && !$this->image_upload_lib->_get_file_size2($config['source_image_tmp'], $config['max_size'])) {
                    $this->session->set_flashdata('image_error', 'Your image size is too big');
                    redirect(current_url());
                }

                $image_name = $this->image_upload_lib->_random_name() . '_' . $config['source_image_name'];
                
                // check image upload status - checkbok (simple upload / image manipulation)
                if ($this->input->post('simple_image_upload') == NULL) {
                    
                    $this->image_upload_lib->_img_crop($config['source_image_tmp'], $config['save_dir_product'], $config['max_width'], $config['max_height'], $image_name);
                
                } else {
                    $this->image_upload_lib->_img_crop($config['source_image_tmp'], $this->config->item('image_big'), $config['max_width'], $config['max_height'], $image_name);
                    
                    $this->image_upload_lib->_img_crop($config['source_image_tmp'], $this->config->item('trumb1_location'), $config['trumb1_width'], $config['trumb1_height'], $image_name, true);
                    
                    $this->image_upload_lib->_img_crop($config['source_image_tmp'], $this->config->item('trumb2_location'),  $config['trumb2_width'], $config['trumb2_height'], $image_name, true);
                }
            }
                            
            $last_insert_id = $this->product_model->insert_return(array(
                'product_category_id' => $this->form_validation->set_value('product_category'),
                'product_code'        => strtolower($this->form_validation->set_value('product_code')),
                'name'                => $this->form_validation->set_value('product_name'),
                'description'         => $this->form_validation->set_value('product_description'),
                'quantity'            => $this->form_validation->set_value('product_quantity') != NULL ? $this->form_validation->set_value('product_quantity') : FALSE,
                'price'               => $this->form_validation->set_value('product_price_with_vat'),
                'sale_price'          => $this->form_validation->set_value('product_sale_price'),
                'image'               => $this->input->post('simple_image_upload') != NULL ? $image_name : NULL,
                'options_available'   => $this->form_validation->set_value('product_options_available') == NULL ? FALSE : TRUE,
                'options'             => $this->form_validation->set_value('product_options'),
                'meta_tags'           => $this->form_validation->set_value('meta_tags'),
                'youtube_link'        => $this->form_validation->set_value('youtube_link'),
                'active'              => $this->form_validation->set_value('product_active') == NULL ? FALSE : TRUE
            ));
            
            if ($this->input->post('simple_image_upload') != NULL) {
                redirect(current_url());
            } else {
                if (!empty($config['source_image_name'])) {
            
                    $this->session->set_userdata('product_image', array(
                        'prod_id'   => $last_insert_id,
                        'tmp_image' => $image_name,
                        'back_url'  => current_url()
                    ));
                    
                    redirect($this->router->fetch_class() . '/image_modification');
                } else {
                    redirect(current_url());
                }
            }
        }
        // Load view
        $this->display_lib->back_end_view('product','product', 'product_add', $this->data);
    }

    public function image_modification()
    {
        if (!$this->session->userdata('product_image')) {
            redirect($this->router->fetch_class() . '/product_add');
        }
        
        $this->load->library('image_upload_lib');
        
        $this->data['image_url'] = $this->config->item('image_tmp') . $this->session->userdata['product_image']['tmp_image'];
        
        $this->data['main_image_width'] = $this->image_upload_lib->getWidth($this->data['image_url']);
        $this->data['main_image_height'] = $this->image_upload_lib->getHeight($this->data['image_url']);
        
        $this->data['trumb1_width'] = $this->config->item('trumb1_width');
        $this->data['trumb2_height'] = $this->config->item('trumb1_height');
        
        $this->data['trumb_ratio']= $this->data['trumb2_height'] / $this->data['trumb1_width'];
        
        // Load view
        $this->display_lib->back_end_view('product','image_modification', 'image_modification', $this->data, false);
    }
    
    public function upload_trumbnail()
    {
        if (isset($_POST["upload_thumbnail"])) {
            
            $this->load->model('product_model');
            
            $this->load->library('image_upload_lib');
            
        	//Get the new coordinates to crop the image.
        	$x1 = $_POST["x1"];
        	$y1 = $_POST["y1"];
        	$x2 = $_POST["x2"];
        	$y2 = $_POST["y2"];
        	$w  = $_POST["w"];
        	$h  = $_POST["h"];
            
        	//Scale the image to the thumb_width set above
        	$scale = $this->config->item('trumb1_width')/$w;
        	
        	$scale2 = $this->config->item('trumb2_width')/$w;
            
            // Start image location settings
            $main_img_tmp_location = $this->config->item('image_tmp') . $this->session->userdata['product_image']['tmp_image'];
            
            $trumb1_location = $this->config->item('trumb1_location') . $this->session->userdata['product_image']['tmp_image'];
            $trumb2_location = $this->config->item('trumb2_location') . $this->session->userdata['product_image']['tmp_image'];
            
            $big_image_location = $this->config->item('image_big') . $this->session->userdata['product_image']['tmp_image'];
            // End image location settings
            
        	$cropped = $this->image_upload_lib->_resizeThumbnailImage($trumb1_location,$main_img_tmp_location,$w,$h,$x1,$y1,$scale);
        
        	$cropped2 = $this->image_upload_lib->_resizeThumbnailImage($trumb2_location,$main_img_tmp_location,$w,$h,$x1,$y1,$scale2);
            
            if (copy($main_img_tmp_location,$big_image_location)) {
                unlink($main_img_tmp_location);
            }
            
            $this->product_model->update($this->session->userdata['product_image']['prod_id'], array('image' => $this->session->userdata['product_image']['tmp_image']));
            
            // Unlink old images
            if (isset($this->session->userdata['product_image']['old_image']))
            {
                $this->_unlink_old_images($this->session->userdata['product_image']['old_image']);
            }
            
            $back_url = $this->session->userdata['product_image']['back_url'];
            
            $this->session->unset_userdata('product_image');
                                    
            $this->_clear_product_tmp_folder();
                                    
        	redirect($back_url);
        }
        else
        {
            redirect($this->router->fetch_class() . '/image_modification');
        }
    }
    
    public function _unlink_old_images($image)
    {
        if (file_exists($this->config->item('image_big') . $image)) {
            unlink($this->config->item('image_big') . $image);
        }
        
        if (file_exists($this->config->item('trumb1_location') . $image)) {
            unlink($this->config->item('trumb1_location') . $image);
        }
        
        if (file_exists($this->config->item('trumb2_location') . $image)) {
            unlink($this->config->item('trumb2_location') . $image);
        }
    }
    
    public function _clear_product_tmp_folder()
    {
        foreach(glob($this->config->item('image_tmp').'*.*') as $file)
            if(is_file($file))
                @unlink($file);
    }
    
    public function product_edit($product_id)
    {
        $this->load->model('product_model');
        $this->load->model('product_category_model');
        
        $this->data['product_categories'] = $this->product_category_model->get_product_categories(true);
        
        if (!$this->data['product_edit'] = $this->product_model->get_row($product_id)) {
            redirect($this->router->fetch_class() . '/product_list');
        }
        
        if ($this->form_validation->run('back_product_form')) {
            
            $this->load->library('image_upload_lib');
        
            $config = array();
            
            $config['source_image_name'] = $_FILES['file']['name'];
            $config['source_image_tmp']  = $_FILES['file']['tmp_name'];
            $config['save_dir_product']  = $this->config->item('image_tmp');
            $config['save_dir_trumb']    = $this->config->item('image_trumb_folder');
            $config['max_size']          = $this->config->item('image_max_size');
            $config['max_width']         = $this->config->item('image_max_width');
            $config['max_height']        = $this->config->item('image_max_height');
            $config['allowed_types']     = $this->config->item('image_allow_type');
            
            $config['trumb1_width']      = $this->config->item('trumb1_width');
            $config['trumb1_height']     = $this->config->item('trumb1_height');
            
            $config['trumb2_width']      = $this->config->item('trumb2_width');
            $config['trumb2_height']     = $this->config->item('trumb2_height');
            
            if (!empty($config['source_image_name']))
            {
                if (isset($config['source_image_name']) && empty($config['source_image_name'])) {
                    $this->session->set_flashdata('image_error', 'Please enter file');
                    redirect(current_url());
                }
                
                if (isset($config['allowed_types']) && !$this->image_upload_lib->_check_allowed_type($config['source_image_name'], $config['allowed_types'])) {
                    $this->session->set_flashdata('image_error', 'Such type not allowed');
                    redirect(current_url());
                }
                
                if (isset($config['max_size']) && !empty($config['max_size']) && !$this->image_upload_lib->_get_file_size2($config['source_image_tmp'], $config['max_size'])) {
                    $this->session->set_flashdata('image_error', 'Your image size is too big');
                    redirect(current_url());
                }

                $image_name = $this->image_upload_lib->_random_name() . '_' . $config['source_image_name'];
                
                // check image upload status - checkbok (simple upload / image manipulation)
                if ($this->input->post('simple_image_upload') == NULL) {
                    
                    $this->image_upload_lib->_img_crop($config['source_image_tmp'], $config['save_dir_product'], $config['max_width'], $config['max_height'], $image_name);
                
                    $this->session->set_userdata('product_image', array(
                        'prod_id'   => $this->data['product_edit']['idProduct'], 
                        'tmp_image' => $image_name,
                        'old_image' => $this->data['product_edit']['image'],
                        'back_url'  => current_url()
                    ));
                
                } else {
                    $this->image_upload_lib->_img_crop($config['source_image_tmp'], $this->config->item('image_big'), $config['max_width'], $config['max_height'], $image_name);
                    
                    $this->image_upload_lib->_img_crop($config['source_image_tmp'], $this->config->item('trumb1_location'), $config['trumb1_width'], $config['trumb1_height'], $image_name, true);
                    
                    $this->image_upload_lib->_img_crop($config['source_image_tmp'], $this->config->item('trumb2_location'),  $config['trumb2_width'], $config['trumb2_height'], $image_name, true);
                }
            }
                
            $this->product_model->update($product_id, array(
                'product_category_id' => $this->form_validation->set_value('product_category'),
                'product_code'        => strtolower($this->form_validation->set_value('product_code')),
                'name'                => $this->form_validation->set_value('product_name'),
                'description'         => $this->form_validation->set_value('product_description'),
                'quantity'            => $this->form_validation->set_value('product_quantity'),
                'price'               => $this->form_validation->set_value('product_price_with_vat'),
                'sale_price'          => $this->form_validation->set_value('product_sale_price'),
                'image'               => $this->input->post('simple_image_upload') ? !empty($image_name) ? $image_name : $this->data['product_edit']['image'] : $this->data['product_edit']['image'],
                'options_available'   => $this->form_validation->set_value('product_options_available') == NULL ? FALSE : TRUE,
                'options'             => $this->form_validation->set_value('product_options'),
                'meta_tags'           => $this->form_validation->set_value('meta_tags'),
                'youtube_link'        => $this->form_validation->set_value('youtube_link'),
                'active'              => $this->form_validation->set_value('product_active') == NULL ? FALSE : TRUE
            ));
                
            if ($this->input->post('simple_image_upload') != NULL) {
                
                if (!empty($this->data['product_edit']['image'])) {
                    $this->_unlink_old_images($this->data['product_edit']['image']);
                }
                
                redirect(current_url());
            } else {
                if (!empty($config['source_image_name'])) {
                    redirect($this->router->fetch_class() . '/image_modification');
                } else {
                    redirect(current_url());
                }
            }
        }
        
        // Load view
        $this->display_lib->back_end_view('product','product', 'product_edit', $this->data);
    }
    
    public function product_view($product_id)
    {
        $this->load->model('product_model');
        
        if (!$this->data['product_data'] = $this->product_model->get_product_data($product_id)) {
            redirect($this->router->fetch_class() . '/product_list');
        }

        // Load view
        $this->display_lib->back_end_view('product','product', 'product_show', $this->data);
    }
    
    public function product_delete($product_id)
    {
        $this->load->model('product_model');
        
        if (!$this->data['product_data'] = $this->product_model->get_product_data($product_id)) {
            redirect($this->router->fetch_class() . '/product_list');
        }

        // Load view
        $this->display_lib->back_end_view('product','product', 'product_delete', $this->data);
        
        if (isset($_POST['delete_product']))
        {
            if ($this->data['product'] = $this->product_model->get_row($product_id))
            {
                if (!empty($this->data['product']['image']) || !is_null($this->data['product']['image']))
                {
                    if (file_exists($this->config->item('trumb1_location').$this->data['product']['image'])) {
                        unlink($this->config->item('trumb1_location').$this->data['product']['image']);
                    }
                    if (file_exists($this->config->item('trumb2_location').$this->data['product']['image'])) {
                        unlink($this->config->item('trumb2_location').$this->data['product']['image']);
                    }
                    if (file_exists($this->config->item('image_big').$this->data['product']['image'])) {
                        unlink($this->config->item('image_big').$this->data['product']['image']);
                    }
                }
                
                $this->product_model->delete($product_id);
            }
            
            redirect($this->router->fetch_class() . '/product_list');
        }
    }
    
    public function product_delete_image($product_id, $image)
    {
        $this->load->model('product_model');
        
        $this->product_model->update($product_id, array('image' => null));
        
        $this->_unlink_old_images($image);
        
        if (IS_AJAX) {
            echo json_encode(array('status' => true));
        } else {
            redirect($_SERVER['HTTP_REFERER']);
        }
    }
    
    /**
     * Categories
     */
    public function category_list()
    {
        $this->load->model('product_category_model');
        
        if (!$this->data['category_list'] = $this->product_category_model->get_product_categories()) {
            redirect('back_end/category_add');
        }
        
        if (IS_AJAX)
        {
            echo json_encode(array('content' => $this->data['category_list']));
        }
        else
        {
            // Load view
            $this->display_lib->back_end_view('category', 'product_category_list', 'product_category_list', $this->data);
        }
    }
    
    public function category_view($category_id)
    {
        $this->load->model('product_category_model');
        
        if (!$this->data['category_data'] = $this->product_category_model->get_row($category_id)) {
            redirect('back_end/category_list');
        }
        
        // Load view
        $this->display_lib->back_end_view('category', 'product_category', 'product_category_show', $this->data);
    }
    
    public function category_add()
    {
        $this->load->model('product_category_model');
        
        if (IS_AJAX)
        {
            $this->load->model('product_category_model');
            
            $category_name = $this->input->post('category_name');
            
            // Check modal input field for empty value
            if (empty($category_name))
            {
                echo json_encode(array('status' => false));
            }
            else
            {
                $this->product_category_model->insert(array(
                    'name' => $category_name,
                ));
                
                echo json_encode(array('status' => true));
            }
        }
        else
        {
            if ($this->form_validation->run('back_category_form')) {
                
                $this->product_category_model->insert(array(
                    'name'    => $this->form_validation->set_value('category_name'),
                    'active'  => $this->form_validation->set_value('category_active') == NULL ? FALSE : TRUE
                ));
                
                redirect(current_url());
            }
            
            // Load view
            $this->display_lib->back_end_view('category','product_category', 'product_category_add', $this->data);
        }
    }
    
    public function category_edit($category_id)
    {
        $this->load->model('product_category_model');
        
        if (!$this->data['category_edit'] = $this->product_category_model->get_row($category_id)) {
            redirect('back_end/category_list');
        }
        
        if ($this->form_validation->run('back_category_form')) {
            
            $this->product_category_model->update($category_id, array(
                'name'      => $this->form_validation->set_value('category_name'),
                'active'    => $this->form_validation->set_value('category_active') == NULL ? FALSE : TRUE
            ));
            
            redirect(current_url());
        }
        
        // Load view
        $this->display_lib->back_end_view('category','product_category', 'product_category_edit', $this->data);
    }
    
    public function category_delete($category_id)
    {
        $this->load->model('product_category_model');
        
        if (!$this->data['category_data'] = $this->product_category_model->get_row($category_id)) {
            redirect($this->router->fetch_class() . '/category_list');
        }
        
        // Load view
        $this->display_lib->back_end_view('category','product_category', 'product_category_delete', $this->data);
        
        if (isset($_POST['delete_category']))
        {
            if (!$res = $this->product_category_model->delete($category_id))
            {
                if ($this->db->_error_message())
                {
                    if ($this->db->_error_number() == 1451)
                    {
                        $this->session->set_flashdata('error', $this->lang->line('error-foreign-key').'<br>'.$this->lang->line('category-error-foreign-key'));
                        
                        redirect(current_url());
                    }
                }
            }
            
            redirect($this->router->fetch_class() . '/category_list');
        }
    }
    
    /**
     * Countries
     */
    public function country_list()
    {
        $this->load->model('country_model');
        
        if (!$this->data['country_list'] = $this->country_model->get_array('country_name','asc')) {
            redirect($this->router->fetch_class() . '/country_add');
        }

        // Load view
        $this->display_lib->back_end_view('countries','country_list', 'country_list', $this->data);
    }
    
    public function country_add()
    {
        $this->load->model('country_model');
        
        if ($this->form_validation->run('back_country_form')) {
            
            $this->country_model->insert(array(
                'country_code'  => $this->form_validation->set_value('country_code'),
                'country_name'  => $this->form_validation->set_value('country_name'),
                'active'        => $this->form_validation->set_value('country_active') == NULL ? FALSE : TRUE
            ));
            
            redirect(current_url());
        }
        
        // Load view
        $this->display_lib->back_end_view('countries','country_list', 'country_add', $this->data);
    }
    
    public function country_edit($country_id)
    {
        $this->load->model('country_model');
        
        $this->data['country_data'] = $this->country_model->get_row($country_id);
        
        if ($this->form_validation->run('back_country_form')) {
            
            $this->country_model->update($country_id, array(
                'country_code'  => $this->form_validation->set_value('country_code'),
                'country_name'  => $this->form_validation->set_value('country_name'),
                'active'        => $this->form_validation->set_value('country_active') == NULL ? FALSE : TRUE
            ));
            
            redirect(current_url());
        }
        
        // Load view
        $this->display_lib->back_end_view('countries','country_list', 'country_edit', $this->data);
    }
    
    public function country_delete($country_id)
    {
        $this->load->model('country_model');
        
        if (isset($_POST['delete_country']))
        {
            if (!$res = $this->country_model->delete($country_id))
            {
                if ($this->db->_error_message())
                {
                    if ($this->db->_error_number() == 1451)
                    {
                        $this->session->set_flashdata('error', $this->lang->line('error-foreign-key').'<br>'.$this->lang->line('country-error-foreign-key'));
                        
                        redirect(current_url());
                    }
                }
            }
            
            redirect('back_end/country_list');
        }
        
        if (!$this->data['country_data'] = $this->country_model->get_row($country_id)) {
            redirect($this->router->fetch_class() . '/country_list');
        }
        
        // Load view
        $this->display_lib->back_end_view('countries','country_list', 'country_delete', $this->data);
    }
    
    /**
     * Order list
     */    
    public function order_all_list()
    {
        $this->load->model('order_model');
        
        if ($this->data['order_data'] = $this->order_model->get_all_orders())
        {
            foreach ($this->data['order_data'] as $key => $value)
            {
                $this->data['order_data'][$key]['order_status_txt'] = $this->_get_status_name($value['order_status'], 'order_status');
                $this->data['order_data'][$key]['payment_status_txt'] = $this->_get_status_name($value['payment_status'], 'payment_status');
            }
        }

        // Load view
        $this->display_lib->back_end_view('order','order_list', 'order_list', $this->data);
    }
    
    public function order_new_list()
    {
        $this->load->model('order_model');
        
        if ($this->data['order_data'] = $this->order_model->get_new_orders())
        {
            foreach ($this->data['order_data'] as $key => $value)
            {
                $this->data['order_data'][$key]['order_status_txt'] = $this->_get_status_name($value['order_status'], 'order_status');
                $this->data['order_data'][$key]['payment_status_txt'] = $this->_get_status_name($value['payment_status'], 'payment_status');
            }
        }
        
        // Load view
        $this->display_lib->back_end_view('order','order_list', 'order_new_list', $this->data);
    }
    
    public function order_monthly_list()
    {
        $this->load->model('order_model');
        
        // Month settings
        $month_start    = 1;
        $month_end      = 12;
        
        for ($i = $month_start; $i <= $month_end; $i++)
        {
            $this->data['months'][$i]['month'] = strftime( '%B', mktime( 0, 0, 0, $i, 1 ) );
            
            if (date('m') == $i)
            {
                $this->data['months'][$i]['selected'] = true;
            }
        }
        
        // Year settings
        $year_start = 2013;
        $year_end = date('Y');
        
        for ($i = $year_start; $i <= $year_end; $i++)
        {
            $this->data['years'][$i]['year'] = $i;
            
            if (date('Y') == $i)
            {
                $this->data['years'][$i]['selected'] = true;
            }
        }
        
        if ($this->form_validation->run('back_order_month_form'))
        {
            $month = date('m', strtotime($this->form_validation->set_value('order_month')));
            $year  = $this->form_validation->set_value('order_year');
            
            $search_date = $year . '-' . $month;
            
            if ($this->data['order_data'] = $this->order_model->search_order($search_date))
            {
                foreach ($this->data['order_data'] as $key => $value)
                {
                    $this->data['order_data'][$key]['order_status_txt'] = $this->_get_status_name($value['order_status'], 'order_status');
                    $this->data['order_data'][$key]['payment_status_txt'] = $this->_get_status_name($value['payment_status'], 'payment_status');
                }
            }
        }

        // Load view
        $this->display_lib->back_end_view('order','order_list', 'order_monthly_list', $this->data);
    }
    
    public function order_show($order_id)
    {
        $this->load->model('order_model');
        
        if ($this->data['order_data'] = $this->order_model->get_order($order_id)) {
            
            $this->data['order_data']['order_status_txt'] = $this->_get_status_name($this->data['order_data']['order_status'], 'order_status');
            $this->data['order_data']['payment_status_txt'] = $this->_get_status_name($this->data['order_data']['payment_status'], 'payment_status');
            
            $this->data['order_product_data'] = $this->order_model->get_order_products($this->data['order_data']['idOrder']);
            
            $this->data['order_status'] = $this->_get_statuses('order_status', $this->data['order_data']['order_status']);
            
            $this->data['payment_status'] = $this->_get_statuses('payment_status', $this->data['order_data']['payment_status']);
        }

        $this->display_lib->back_end_view('order','order_list', 'order_show', $this->data);
    }
    
    public function order_status($order_id, $status)
    {
        $this->load->model('order_model');
                
        $this->order_model->update_order_status($order_id, array('order_status' => $status));

        redirect($_SERVER['HTTP_REFERER']);
    }
    
    public function payment_status($order_id, $status)
    {
        $this->load->model('order_model');
        
        $this->order_model->update_payment_status($order_id, array('payment_status' => $status));
                
        redirect($_SERVER['HTTP_REFERER']);
    }
    
    public function order_print_preview($order_id)
    {
        $this->load->model('order_model');
        
        if ($this->data['order_data'] = $this->order_model->get_order($order_id))
        {
            $this->data['order_product_data'] = $this->order_model->get_order_products($this->data['order_data']['idOrder']);
        }
        
        $this->load->view('back_end/content/order/print/order_print_preview_view', $this->data);
    }
    
    private function _payment_status()
    {
        $data['order_status'] = array(
            'pending' => array(
                'id'        => '1',
                'active'    => true,
                'lang'      => 'pending'
            ),
            'shipped' => array(
                'id'        => '2',
                'active'    => true,
                'lang'      => 'shipped'
            ),
            'delivered' => array(
                'id'        => '3',
                'active'    => true,
                'lang'      => 'delivered'
            ),
            'completed' => array(
                'id'        => '4',
                'active'    => true,
                'lang'      => 'completed'
            ),
            'returned' => array(
                'id'        => '5',
                'active'    => true,
                'lang'      => 'returned'
            )
        );
    
        $data['payment_status'] = array(
            'pending' => array(
                'id'        => '1',
                'active'    => true,
                'lang'      => 'pending'
            ),
            'completed' => array(
                'id'        => '2',
                'active'    => true,
                'lang'      => 'completed'
            ),
            'failed' => array(
                'id'        => '3',
                'active'    => true,
                'lang'      => 'failed'
            ),
            'refunded' => array(
                'id'        => '4',
                'active'    => true,
                'lang'      => 'returned'
            )
        );
        
        return $data;
    }
    
    private function _get_statuses($status, $checked = false)
    {
        $mas = array();
        
        $stat = $this->_payment_status();
        
        if ($status === 'order_status') 
        {
            foreach ($stat['order_status'] as $key => $value)
            {
                if ($value['active'])
                {
                    if ($value['id'] == $checked)
                    {
                        $mas[$key] = $value;
                        $mas[$key]['checked'] = true;
                    }
                    else
                    {
                        $mas[$key] = $value;
                    }
                }
            }
        }
        
        if ($status === 'payment_status') 
        {
            foreach ($stat['payment_status'] as $key => $value)
            {
                if ($value['active'])
                {
                    if ($value['id'] == $checked)
                    {
                        $mas[$key] = $value;
                        $mas[$key]['checked'] = true;
                    }
                    else
                    {
                        $mas[$key] = $value;
                    }
                }
            }
        }
        
        return $mas;
    }
    
    private function _get_status_name($status_id, $status_name)
    {
        $mas = array();
        
        $stat = $this->_payment_status();
        
        if (!empty($stat))
        {
            switch($status_name)
            {
                case('order_status'):
                    $mas = $stat['order_status'];
                    break;
                case('payment_status'):
                    $mas = $stat['payment_status'];
                    break;
            }
            
            foreach ($mas as $key => $value)
            {
                if ($value['id'] == $status_id)
                {
                    return $value['lang'];
                }
            }   
        }   
    }
    
    public function order_delete($order_id)
    {
        // Load order model
        $this->load->model('order_model');
        
        // Get order product data
        $this->data['order_product'] = $this->order_model->get_order_products($order_id);
        
        
        
        if (!empty($this->data['order_product']))
        {   
            // Loop each order product and back update product quantity, after delete order product
            foreach ($this->data['order_product'] as $value)
            {
                if (!empty($value['product_id']) && !is_null($value['product_id']))
                {
                    // Load product model
                    $this->load->model('product_model');
                    
                    // Update product quantity
                    $this->data['product_data'] = $this->product_model->get_row($value['product_id']);
                    
                    $this->product_model->update($value['product_id'], array('quantity' => $this->data['product_data']['quantity'] + $value['quantity']));               
                }
                
                $this->order_model->delete_order_product($order_id);
            }
        }
        
        $this->order_model->delete_order_data($order_id);
        
        redirect($this->router->fetch_class() . '/order_all_list');
    }
    
    /**
     * Personal (Auth)
     */
    public function personal_list()
    {
        $this->load->model('auth/users');
        
        $this->data['personal_data'] = $this->users->get_array();
        
        $this->display_lib->back_end_view('personal','personal', 'personal_list', $this->data);
    }
    
    public function personal_list_view($user_id)
    {
        $this->load->model('auth/users');
        
        $this->data['personal_data'] = $this->users->get_row($user_id);
        
        $this->display_lib->back_end_view('personal','personal', 'personal_list_show', $this->data);
    }
    
    public function personal_delete($user_id)
    {
        $this->load->model('auth/users');
        
        // Click delete button
        if (isset($_POST['delete_user'])) {
            
            $this->load->library('auth_lib');
            
            if ($this->auth_lib->delete_user($user_id))
            {
                redirect($this->router->fetch_class() . '/personal_list');
            }
        }
        
        $this->data['personal_data'] = $this->users->get_row($user_id);
        
        $this->display_lib->back_end_view('personal','personal', 'personal_delete', $this->data);
    }
    
    public function personal_edit($user_id)
    {
        $this->load->model('auth/users');
        
        $this->data['personal_data'] = $this->users->get_row($user_id);
        
        if ($this->form_validation->run('back_user_data'))
        {
            $this->users->update($user_id, array(
                'username'      => $this->form_validation->set_value('username'),
                'email'         => $this->form_validation->set_value('email'),
                'activated'     => $this->form_validation->set_value('activated') == NULL ? FALSE : TRUE,
                'banned'        => $this->form_validation->set_value('banned') == NULL ? FALSE : TRUE,
                'ban_reason'    => $this->form_validation->set_value('ban_reason')
            ));
            
            redirect($_SERVER['HTTP_REFERER']);
        }
        

        $this->display_lib->back_end_view('personal','personal', 'personal_edit', $this->data);
    }
    
    /**
     * Coupoon
     */
    public function coupon_list()
    {
        $this->load->model('coupon_model');
        
        $this->data['coupon_data'] = $this->coupon_model->get_array();
        
        // Load view
        $this->display_lib->back_end_view('coupon','coupon', 'coupon_list', $this->data);
    }
    
    public function coupon_add()
    {
        if ($this->form_validation->run('back_coupon_data')) {
            
            $this->load->model('coupon_model');
            
            $this->coupon_model->insert(array(
                'coupon_code'       => $this->form_validation->set_value('coupon_code'),
                'discount_type'     => $this->form_validation->set_value('discount_type'),
                'discount'          => $this->form_validation->set_value('discount'),
                'min_order'         => $this->form_validation->set_value('min_order'),
            ));
            
            redirect(current_url());
        }
        
        // Load view
        $this->display_lib->back_end_view('coupon','coupon', 'coupon_add', $this->data);
    }
    
    public function coupon_edit($coupon_id)
    {
        $this->load->model('coupon_model');
        
        $this->data['coupon_data'] = $this->coupon_model->get_row($coupon_id);
        
        if ($this->form_validation->run('back_coupon_data')) {
            
            $this->coupon_model->update($coupon_id, array(
                'coupon_code'       => $this->form_validation->set_value('coupon_code'),
                'discount_type'     => $this->form_validation->set_value('discount_type'),
                'discount'          => $this->form_validation->set_value('discount'),
                'min_order'         => $this->form_validation->set_value('min_order'),
            ));
            
            redirect(current_url());
        }
        
        // Load view
        $this->display_lib->back_end_view('coupon','coupon', 'coupon_edit', $this->data);
    }
    
    public function coupon_delete($coupon_id)
    {
        $this->load->model('coupon_model');
        
        if (!$this->data['coupon_data'] = $this->coupon_model->get_row($coupon_id)) {
            redirect('back_end/coupon_list');
        }
        
        // Click delete button
        if (isset($_POST['delete_coupon'])) {
            
            $this->coupon_model->delete($coupon_id);
            
            redirect($this->router->fetch_class() . '/coupon_list');
        }
        
        // Load view
        $this->display_lib->back_end_view('coupon','coupon', 'coupon_delete', $this->data);
    }
}

?>