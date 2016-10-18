<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Display_lib {
    
	function __construct()
	{ 
        $this->ci =& get_instance();
    }
    
    /**
     * Front end
     */
    public function front_end_view($script, $page, $data)
    {
        $this->ci->load->view('front_end/pre_header/pre_'. $script .'_view', $data);
        $this->ci->load->view('front_end/admin_menu_view', $data);
        $this->ci->load->view('front_end/top_menu_view', $data);
        $this->ci->load->view('front_end/pages/'. $page . '_view', $data);
        $this->ci->load->view('front_end/footer_view', $data);
    }
    
    /**
     * Back end
     */
     
    public function back_end_auth_view($folder, $page, $data)
    {
        $this->ci->load->view('back_end/content/auth/pre_header/pre_auth_form_view' , $data);
        $this->ci->load->view('back_end/content/'. $folder .'/pages/' . $page . '_view', $data);
    }    
     
    public function back_end_view($folder, $script, $page, $data, $left_menu = true)
    {
        $this->ci->load->view('back_end/content/'. $folder .'/pre_header/pre_'. $script . '_view' , $data);
        $this->ci->load->view('back_end/header_view', $data);
        if ($left_menu) {
            $this->ci->load->view('back_end/left_side_block_view', $data);
        }
        $this->ci->load->view('back_end/content/'. $folder .'/pages/' . $page . '_view', $data);
    }
}

?>