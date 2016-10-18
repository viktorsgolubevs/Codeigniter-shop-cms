<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Product_model extends Crud
{  
    public $table = 'product';         // Table name
    public $idkey = 'idProduct';       // Id
    
    function get_product_data($product_id)
    {
        $this->db->select($this->table.'.*');
        $this->db->select('product_category.name as category_name');
        $this->db->where($this->table.'.'.$this->idkey, $product_id);
        $this->db->from($this->table);
        $this->db->join('product_category', 'product_category.idCategory = '.$this->table.'.product_category_id');
        $query = $this->db->get();
        if ($query->num_rows() > 0)
        {
            return $query->row_array();
        }
        return FALSE;
    }
    
    function get_active_product($sort_type = NULL)
    {
        if (!is_null($sort_type)) {
            $this->db->order_by('name', $sort_type);
        }
        $this->db->where('active', true);
        $query = $this->db->get($this->table);
        if ($query->num_rows() > 0) {
            return $query->result_array();    
        }
        return FALSE;
    }
}

?>