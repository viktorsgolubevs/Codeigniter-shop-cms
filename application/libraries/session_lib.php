<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Session_lib
{
    
	function __construct()
	{
		$this->ci =& get_instance();
	}
    
    /**
	 * Check if user logged in.
	 *
	 * @param	bool
	 * @return	bool
	 */
	function is_logged_in()
	{
		return $this->ci->session->userdata('log_in');
	}
    
    /**
	 * Check if user is not logged in.
	 *
	 * @param	bool
	 * @return	bool
	 */
	function is_not_logged_in()
	{
        return !$this->ci->session->userdata('log_in');
	}
    
	/**
	 * Check if user is activated or no.
	 *
	 * @param	bool
	 * @return	bool
	 */
	function is_activated($activated = TRUE)
	{
		return $this->ci->session->userdata('status') === ($activated ? STATUS_ACTIVATED : STATUS_NOT_ACTIVATED);
	}

	/**
	 * Get user_id
	 *
	 * @return	string
	 */
	function get_user_id()
	{
		return $this->ci->session->userdata('user_id');
	}

	/**
	 * Get username
	 *
	 * @return	string
	 */
	function get_username()
	{
		return $this->ci->session->userdata('username');
	}
    
	/**
	 * Get all coupon data
	 *
	 * @return	array
	 */
	function get_coupon_data()
	{
		return $this->ci->session->userdata('cart_coupon');
	}
    
	/**
	 * Check if coupon data exist
	 *
	 * @return	array
	 */
	function is_coupon_data()
	{
		return $this->ci->session->userdata('cart_coupon') ? TRUE : FALSE;
	}
    
	/**
	 * Delete coupon data
	 *
	 * @return	void
	 */
	function delete_coupon_data()
	{
		$this->ci->session->unset_userdata('cart_coupon');
	}
    
}

?>