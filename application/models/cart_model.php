<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Cart_model extends CI_Model
{  
    function get_product($product_id, $flag = TRUE)
    {
        $this->db->where('idProduct', $product_id);
        if ($flag) {
            $this->db->where('active','1');
        }
        $query = $this->db->get('product');
        if ($query->num_rows() > 0) {
            return $query->row_array();    
        }
        return FALSE;
    }
    
    function add_order_details($data)
    {
        $this->db->insert('shop_order_details', $data);
        return $this->db->insert_id();
    }
    
    function add_order_product($data)
    {
        $this->db->insert('shop_order_product', $data);
    }
    
    function check_max_quantity($data)
    {
        $sql = "SELECT idProduct
                FROM product
                WHERE idProduct = ? and quantity >= ?";
        
        $query = $this->db->query($sql, array($data['product_id'], $data['quantity']));
        
        if ($query->num_rows() > 0) {
            return TRUE;
        }
        return FALSE;
    }
}

?>