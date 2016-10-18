<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Coupon_model extends Crud
{  
    public $table = 'coupon';       // Table name
    public $idkey = 'idCoupon';     // Id
    
    public function check_coupon($coupon_name)
    {
        $this->db->where('coupon_code', $coupon_name);
        $query = $this->db->get($this->table);
        if ($query->num_rows() == 1) {
            return $query->row_array();
        }
        return false;
    }
}

?>