<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends CI_Controller
{
   	public function __construct()
	{
        parent::__construct();
        
        $this->load->library('auth_lib');
        
        $this->lang->load('back_end');
        
        $this->data = array();
	}

	function index()
	{
		if ($message = $this->session->flashdata('message')) {
            $this->display_lib->back_end_auth_view('auth', 'general_message', array('page_title' => $message, 'message' => $message));
		} else {
			redirect('/auth/login/');
		}
	}

	/**
	 * Login user on the site
	 *
	 * @return void
	 */
	function login()
	{
		if ($this->session_lib->is_activated(FALSE)) {						// logged in, not activated
			redirect('/auth/send_again/');

		} elseif ($this->session_lib->is_logged_in()) {						// logged in
        
            redirect('home');

		} else {
		              
			$this->data['login_by_username'] = ($this->config->item('login_by_username', 'auth') AND
					$this->config->item('use_username', 'auth'));
			$this->data['login_by_email'] = $this->config->item('login_by_email', 'auth');

			$this->form_validation->set_rules('login', 'Login', 'trim|required|xss_clean');
			$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
			$this->form_validation->set_rules('remember', 'Remember me', 'integer');

			// Get login for counting attempts to login
			if ($this->config->item('login_count_attempts', 'auth') AND
					($login = $this->input->post('login'))) {
				$login = $this->security->xss_clean($login);
			} else {
				$login = '';
			}

			$this->data['use_recaptcha'] = $this->config->item('use_recaptcha', 'auth');
			if ($this->auth_lib->is_max_login_attempts_exceeded($login)) {
				if ($this->data['use_recaptcha'])
					$this->form_validation->set_rules('recaptcha_response_field', 'Confirmation Code', 'trim|xss_clean|required|callback__check_recaptcha');
				else
					$this->form_validation->set_rules('captcha', 'Confirmation Code', 'trim|xss_clean|required|callback__check_captcha');
			}
			$this->data['errors'] = array();

			if ($this->form_validation->run()) {								// validation ok
				if ($this->auth_lib->login(
						$this->form_validation->set_value('login'),
						$this->form_validation->set_value('password'),
						$this->form_validation->set_value('remember'),
						$this->data['login_by_username'],
						$this->data['login_by_email'])) {								// success
					redirect('home');

				} else {
					$errors = $this->auth_lib->get_error_message();

					if (isset($errors['ban'])) {								// banned user
						$this->_show_message($this->lang->line('auth_message_banned').' '.$errors['banned']);

					} elseif (isset($errors['not_activated'])) {				// not activated user
						redirect('/auth/send_again/');

					} else {													// fail
						foreach ($errors as $k => $v)	$this->data['errors'][$k] = $this->lang->line($v);
					}
				}
			}
			$this->data['show_captcha'] = FALSE;
			if ($this->auth_lib->is_max_login_attempts_exceeded($login)) {
				$this->data['show_captcha'] = TRUE;
				if ($this->data['use_recaptcha']) {
					$this->data['recaptcha_html'] = $this->_create_recaptcha();
				} else {
					$this->data['captcha_html'] = $this->_create_captcha();
				}
			}
            
            $this->data['page_title'] = 'Login';
            
            $this->display_lib->back_end_auth_view('auth', 'login_form', $this->data);
		}
	}

	/**
	 * Logout user
	 *
	 * @return void
	 */
	function logout()
	{
        if ($this->session_lib->is_not_logged_in()) {									// if not logged in redirect to login page
			redirect('auth');
        }
        else
        {
            $this->auth_lib->logout();
            
            redirect($_SERVER['HTTP_REFERER']);            
        }
	}

	/**
	 * Register user on the site
	 *
	 * @return void
	 */
	function register()
	{
		if ($this->session_lib->is_logged_in()) {									// logged in
			redirect('');

		} elseif ($this->session_lib->is_activated(FALSE)) {						// logged in, not activated
			redirect('/auth/send_again/');

		} elseif (!$this->config->item('allow_registration', 'auth')) {	    // registration is off
			$this->_show_message($this->lang->line('auth_message_registration_disabled'));

		} else {
			$use_username = $this->config->item('use_username', 'auth');
			if ($use_username) {
				$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean|min_length['.$this->config->item('username_min_length', 'auth').']|max_length['.$this->config->item('username_max_length', 'auth').']|alpha_dash');
			}
			$this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean|valid_email');
			$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|min_length['.$this->config->item('password_min_length', 'auth').']|max_length['.$this->config->item('password_max_length', 'auth').']|alpha_dash');
			$this->form_validation->set_rules('confirm_password', 'Confirm Password', 'trim|required|xss_clean|matches[password]');

			$captcha_registration	= $this->config->item('captcha_registration', 'auth');
			$use_recaptcha			= $this->config->item('use_recaptcha', 'auth');
			if ($captcha_registration) {
				if ($use_recaptcha) {
					$this->form_validation->set_rules('recaptcha_response_field', 'Confirmation Code', 'trim|xss_clean|required|callback__check_recaptcha');
				} else {
					$this->form_validation->set_rules('captcha', 'Confirmation Code', 'trim|xss_clean|required|callback__check_captcha');
				}
			}
			$this->data['errors'] = array();

			$email_activation = $this->config->item('email_activation', 'auth');

			if ($this->form_validation->run()) {								// validation ok
				if (!is_null($this->data = $this->auth_lib->create_user(
						$use_username ? $this->form_validation->set_value('username') : '',
						$this->form_validation->set_value('email'),
						$this->form_validation->set_value('password'),
						$email_activation))) {									// success

					$this->data['site_name'] = $this->config->item('website_name');

					if ($email_activation) {									// send "activate" email
						$this->data['activation_period'] = $this->config->item('email_activation_expire', 'auth') / 3600;

						$this->_send_email('activate', $this->data['email'], $this->data);

						unset($this->data['password']); // Clear password (just for any case)

						$this->_show_message($this->lang->line('auth_message_registration_completed_1'));

					} else {
						if ($this->config->item('email_account_details', 'auth')) {	// send "welcome" email

							$this->_send_email('welcome', $this->data['email'], $this->data);
						}
						unset($this->data['password']); // Clear password (just for any case)

						$this->_show_message($this->lang->line('auth_message_registration_completed_2').' '.anchor('/auth/login/', 'Login'));
					}
				} else {
					$errors = $this->auth_lib->get_error_message();
					foreach ($errors as $k => $v)	$this->data['errors'][$k] = $this->lang->line($v);
				}
			}
			if ($captcha_registration) {
				if ($use_recaptcha) {
					$this->data['recaptcha_html'] = $this->_create_recaptcha();
				} else {
					$this->data['captcha_html'] = $this->_create_captcha();
				}
			}
			$this->data['use_username'] = $use_username;
			$this->data['captcha_registration'] = $captcha_registration;
			$this->data['use_recaptcha'] = $use_recaptcha;
            
            $this->data['page_title'] = 'Register';
            
            $this->display_lib->back_end_auth_view('auth', 'register_form', $this->data);
		}
	}
    
	/**
	 * Custom register user from admin panel
	 *
	 * @return void
	 */
    public function custom_register()
    {
		if ($this->session_lib->is_not_logged_in()) {								// not logged in or not activated
			redirect('/auth/login/');

		} elseif ($this->session_lib->is_activated(FALSE)) {						// logged in, not activated
			redirect('/auth/send_again/');
		} else {
			$use_username = $this->config->item('use_username', 'auth');
			if ($use_username) {
				$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean|min_length['.$this->config->item('username_min_length', 'auth').']|max_length['.$this->config->item('username_max_length', 'auth').']|alpha_dash');
			}
			$this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean|valid_email');
			$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|min_length['.$this->config->item('password_min_length', 'auth').']|max_length['.$this->config->item('password_max_length', 'auth').']|alpha_dash');
			$this->form_validation->set_rules('confirm_password', 'Confirm Password', 'trim|required|xss_clean|matches[password]');

			$this->data['errors'] = array();

//			$email_activation = $this->config->item('email_activation', 'auth');

			if ($this->form_validation->run()) {								// validation ok
                if (!is_null($this->data = $this->auth_lib->create_user(
                    $use_username ? $this->form_validation->set_value('username') : '',
                    $this->form_validation->set_value('email'),
                    $this->form_validation->set_value('password')))) {									// success

                        if ($this->config->item('email_account_details', 'auth')) {	// send "welcome" email
                        
                            $this->_send_email('welcome', $this->data['email'], $this->data);
                        }
                        
                        redirect($_SERVER['HTTP_REFERER']);
				} else {
					$errors = $this->auth_lib->get_error_message();
					foreach ($errors as $k => $v)	$this->data['errors'][$k] = $this->lang->line($v);
				}
			}
			$this->data['use_username'] = $use_username;
            
            // Load view
            $this->display_lib->back_end_view('personal','personal', 'custom_register', $this->data);
		}        
    }

	/**
	 * Send activation email again, to the same or new email address
	 *
	 * @return void
	 */
	function send_again()
	{
		if (!$this->session_lib->is_activated(FALSE)) {							// not logged in or activated
            redirect('/auth/login/');
		} else {
          
			$this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean|valid_email');

			$this->data['errors'] = array();

			if ($this->form_validation->run()) {								// validation ok
				if (!is_null($this->data = $this->auth_lib->change_email(
						$this->form_validation->set_value('email')))) {			// success

					$this->data['site_name']	= $this->config->item('website_name');
					$this->data['activation_period'] = $this->config->item('email_activation_expire', 'auth') / 3600;

					$this->_send_email('activate', $this->data['email'], $this->data);

                    $this->auth_lib->reset_send_again();

					$this->_show_message(sprintf($this->lang->line('auth_message_activation_email_sent'), $this->data['email']));
                    
				} else {
					$errors = $this->auth_lib->get_error_message();
                    
					foreach ($errors as $k => $v)	$this->data['errors'][$k] = $this->lang->line($v);
				}
			}
            
            $this->data['page_title'] = 'Send again email';
            
            $this->display_lib->back_end_auth_view('auth', 'send_again_form', $this->data);
		}
	}

	/**
	 * Activate user account.
	 * User is verified by user_id and authentication code in the URL.
	 * Can be called by clicking on link in mail.
	 *
	 * @return void
	 */
	function activate()
	{
		$user_id		= $this->uri->segment(3);
		$new_email_key	= $this->uri->segment(4);

		// Activate user
		if ($this->auth_lib->activate_user($user_id, $new_email_key)) {		// success
			$this->auth_lib->logout();
            redirect('home');
		} else {																// fail
			$this->_show_message($this->lang->line('auth_message_activation_failed'));
		}
	}

	/**
	 * Generate reset code (to change password) and send it to user
	 *
	 * @return void
	 */
	function forgot_password()
	{
		if ($this->session_lib->is_logged_in()) {									// logged in
			redirect('');

		} elseif ($this->session_lib->is_activated(FALSE)) {						// logged in, not activated
			redirect('/auth/send_again/');

        } elseif (!$this->config->item('reset_password', 'auth')) {	    // password reset is off
			$this->_show_message($this->lang->line('auth_message_password_reset_disabled'));

		} else {
			$this->form_validation->set_rules('login', 'Email or login', 'trim|required|xss_clean');

			$this->data['errors'] = array();

			if ($this->form_validation->run()) {								// validation ok
				if (!is_null($this->data = $this->auth_lib->forgot_password(
						$this->form_validation->set_value('login')))) {

					$this->data['site_name'] = $this->config->item('website_name');

					// Send email with password activation link
					$this->_send_email('forgot_password', $this->data['email'], $this->data);

					$this->_show_message($this->lang->line('auth_message_new_password_sent'));

				} else {
					$errors = $this->auth_lib->get_error_message();
					foreach ($errors as $k => $v)	$this->data['errors'][$k] = $this->lang->line($v);
				}
			}
            
            $this->data['page_title'] = 'Forgot password';
            
            $this->display_lib->back_end_auth_view('auth', 'forgot_password_form', $this->data);
		}
	}

	/**
	 * Replace user password (forgotten) with a new one (set by user).
	 * User is verified by user_id and authentication code in the URL.
	 * Can be called by clicking on link in mail.
	 *
	 * @return void
	 */
	function reset_password()
	{
		$user_id		= $this->uri->segment(3);
		$new_pass_key	= $this->uri->segment(4);

		$this->form_validation->set_rules('new_password', 'New Password', 'trim|required|xss_clean|min_length['.$this->config->item('password_min_length', 'auth').']|max_length['.$this->config->item('password_max_length', 'auth').']|alpha_dash');
		$this->form_validation->set_rules('confirm_new_password', 'Confirm new Password', 'trim|required|xss_clean|matches[new_password]');

		$this->data['errors'] = array();

		if ($this->form_validation->run()) {								// validation ok
			if (!is_null($this->data = $this->auth_lib->reset_password(
					$user_id, $new_pass_key,
					$this->form_validation->set_value('new_password')))) {	// success

				$this->data['site_name'] = $this->config->item('website_name');

				// Send email with new password
				$this->_send_email('reset_password', $this->data['email'], $this->data);

				$this->_show_message($this->lang->line('auth_message_new_password_activated').' '.anchor('/auth/login/', 'Login'));

			} else {														// fail
				$this->_show_message($this->lang->line('auth_message_new_password_failed'));
			}
		} else {
			// Try to activate user by password key (if not activated yet)
			if ($this->config->item('email_activation', 'auth')) {
				$this->auth_lib->activate_user($user_id, $new_pass_key, FALSE);
			}

			if (!$this->auth_lib->can_reset_password($user_id, $new_pass_key)) {
				$this->_show_message($this->lang->line('auth_message_new_password_failed'));
			}
		}
        
        $this->data['page_title'] = 'Reset password';
            
        $this->display_lib->back_end_auth_view('auth', 'reset_password_form', $this->data);
	}

	/**
	 * Change user password
	 *
	 * @return void
	 */
	function change_password()
	{
		if ($this->session_lib->is_not_logged_in()) {								// not logged in or not activated
			redirect('/auth/login/');
            
		} else {
			$this->form_validation->set_rules('old_password', 'Old Password', 'trim|required|xss_clean');
			$this->form_validation->set_rules('new_password', 'New Password', 'trim|required|xss_clean|min_length['.$this->config->item('password_min_length', 'auth').']|max_length['.$this->config->item('password_max_length', 'auth').']|alpha_dash');
			$this->form_validation->set_rules('confirm_new_password', 'Confirm new Password', 'trim|required|xss_clean|matches[new_password]');

			$this->data['errors'] = array();

			if ($this->form_validation->run()) {								// validation ok
				if ($this->auth_lib->change_password(
						$this->form_validation->set_value('old_password'),
						$this->form_validation->set_value('new_password'))) {	// success
					$this->_show_message($this->lang->line('auth_message_password_changed'));

				} else {														// fail
					$errors = $this->auth_lib->get_error_message();
					foreach ($errors as $k => $v)	$this->data['errors'][$k] = $this->lang->line($v);
				}
			}
            
            // Load view
            $this->display_lib->back_end_view('personal','personal', 'change_password', $this->data);
		}
	}

	/**
	 * Replace user email with a new one.
	 * User is verified by user_id and authentication code in the URL.
	 * Can be called by clicking on link in mail.
	 *
	 * @return void
	 */
	function reset_email()
	{
		$user_id		= $this->uri->segment(3);
		$new_email_key	= $this->uri->segment(4);

		// Reset email
		if ($this->auth_lib->activate_new_email($user_id, $new_email_key)) {	// success
			$this->auth_lib->logout();
			$this->_show_message($this->lang->line('auth_message_new_email_activated').' '.anchor('/auth/login/', 'Login'));

		} else {																// fail
			$this->_show_message($this->lang->line('auth_message_new_email_failed'));
		}
	}

	/**
	 * Show info message
	 *
	 * @param	string
	 * @return	void
	 */
	function _show_message($message)
	{
		$this->session->set_flashdata('message', $message);
		redirect('/auth/');
	}

	/**
	 * Send email message of given type (activate, forgot_password, etc.)
	 *
	 * @param	string
	 * @param	string
	 * @param	array
	 * @return	void
	 */
	function _send_email($type, $email, &$data)
	{
		$this->load->library('email');
		$this->email->from($this->config->item('webmaster_email'), $this->config->item('website_name'));
		$this->email->reply_to($this->config->item('webmaster_email'), $this->config->item('website_name'));
		$this->email->to($email);
		$this->email->subject(sprintf($this->lang->line('auth_subject_'.$type), $this->config->item('website_name')));
		$this->email->message($this->load->view('back_end/content/auth/email/'.$type.'-html', $data, TRUE));
		$this->email->set_alt_message($this->load->view('back_end/content/auth/email/'.$type.'-txt', $data, TRUE));
		$this->email->send();
	}

	/**
	 * Create CAPTCHA image to verify user as a human
	 *
	 * @return	string
	 */
	function _create_captcha()
	{
		$this->load->helper('captcha');

		$cap = create_captcha(array(
			'img_path'		=> './'.$this->config->item('captcha_path', 'auth'),
			'img_url'		=> base_url().$this->config->item('captcha_path', 'auth'),
			'font_path'		=> './'.$this->config->item('captcha_fonts_path', 'auth'),
			'font_size'		=> $this->config->item('captcha_font_size', 'auth'),
			'img_width'		=> $this->config->item('captcha_width', 'auth'),
			'img_height'	=> $this->config->item('captcha_height', 'auth'),
			'show_grid'		=> $this->config->item('captcha_grid', 'auth'),
			'expiration'	=> $this->config->item('captcha_expire', 'auth'),
		));

		// Save captcha params in session
		$this->session->set_flashdata(array(
				'captcha_word' => $cap['word'],
				'captcha_time' => $cap['time'],
		));

		return $cap['image'];
	}

	/**
	 * Callback function. Check if CAPTCHA test is passed.
	 *
	 * @param	string
	 * @return	bool
	 */
	function _check_captcha($code)
	{
		$time = $this->session->flashdata('captcha_time');
		$word = $this->session->flashdata('captcha_word');

		list($usec, $sec) = explode(" ", microtime());
		$now = ((float)$usec + (float)$sec);

		if ($now - $time > $this->config->item('captcha_expire', 'auth')) {
			$this->form_validation->set_message('_check_captcha', $this->lang->line('auth_captcha_expired'));
			return FALSE;

		} elseif (($this->config->item('captcha_case_sensitive', 'auth') AND
				$code != $word) OR
				strtolower($code) != strtolower($word)) {
			$this->form_validation->set_message('_check_captcha', $this->lang->line('auth_incorrect_captcha'));
			return FALSE;
		}
		return TRUE;
	}

	/**
	 * Create reCAPTCHA JS and non-JS HTML to verify user as a human
	 *
	 * @return	string
	 */
	function _create_recaptcha()
	{
		$this->load->helper('recaptcha');

		// Add custom theme so we can get only image
		$options = "<script>var RecaptchaOptions = {theme: 'custom', custom_theme_widget: 'recaptcha_widget'};</script>\n";

		// Get reCAPTCHA JS and non-JS HTML
		$html = recaptcha_get_html($this->config->item('recaptcha_public_key', 'auth'));

		return $options.$html;
	}

	/**
	 * Callback function. Check if reCAPTCHA test is passed.
	 *
	 * @return	bool
	 */
	function _check_recaptcha()
	{
		$this->load->helper('recaptcha');

		$resp = recaptcha_check_answer($this->config->item('recaptcha_private_key', 'auth'),
				$_SERVER['REMOTE_ADDR'],
				$_POST['recaptcha_challenge_field'],
				$_POST['recaptcha_response_field']);

		if (!$resp->is_valid) {
			$this->form_validation->set_message('_check_recaptcha', $this->lang->line('auth_incorrect_captcha'));
			return FALSE;
		}
		return TRUE;
	}

}

/* End of file auth.php */
/* Location: ./application/controllers/auth.php */