<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Product_category_model extends Crud
{  
    public $table = 'product_category';     // Table
    public $idkey = 'idCategory';           // Id
    
    function get_product_categories($active = false)
    {
        $this->db->order_by('name','asc');
        if ($active) {
            $this->db->where('active', true);
        }
        $query = $this->db->get($this->table);
        return $query->result_array();
    }
}

?>