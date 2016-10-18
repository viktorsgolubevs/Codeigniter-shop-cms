<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Order_model extends Crud
{  
    public $table = '';     // Table
    public $idkey = '';     // Id
    
    public function get_all_orders()
    {
        $this->db->order_by('created', 'desc');
        $query = $this->db->get('shop_order_details');
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }
    
    public function get_new_orders()
    {
        $this->db->order_by('created', 'desc');
        $this->db->where('order_status', '1');
        $query = $this->db->get('shop_order_details');
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }
    
    public function search_order($date)
    {
        $this->db->like('created', $date, 'after');
        $query = $this->db->get('shop_order_details');
        if ($query->num_rows() > 0)
        {
            return $query->result_array();
        }
        return false;
    }
    
    public function get_order($order_id)
    {
        $this->db->select('shop_order_details.*')->select('countries.country_name');
        $this->db->where('idOrder', $order_id);
        $this->db->join('countries', 'shop_order_details.idCountry = countries.idCountry');
        $query = $this->db->get('shop_order_details');
        return $query->row_array();
    }
    
    public function get_order_products($order_id)
    {
        $this->db->select('shop_order_product.product_id')
        ->select('shop_order_product.quantity')
        ->select('shop_order_product.price')
        ->select('shop_order_product.total_price')
        ->select('product.image')
        ->select('product.product_code')
        ->select('product.name');
        $this->db->where('order_detail_id', $order_id);
        $this->db->join('product', 'product.idProduct = shop_order_product.product_id', 'left outer');
        $query = $this->db->get('shop_order_product');
        return $query->result_array();
    }
    
    public function update_order_status($order_id, $data)
    {
        $this->db->where('idOrder', $order_id);
        $this->db->update('shop_order_details', $data);
    }
    
    public function update_payment_status($order_id, $data)
    {
        $this->db->where('idOrder', $order_id);
        $this->db->update('shop_order_details', $data);
    }
    
    public function delete_order_data($order_id)
    {
        $this->db->where('idOrder', $order_id);
        $this->db->delete('shop_order_details');        
    }
    
    public function delete_order_product($order_id)
    {
        $this->db->where('order_detail_id', $order_id);
        $this->db->delete('shop_order_product');
    }
}

?>