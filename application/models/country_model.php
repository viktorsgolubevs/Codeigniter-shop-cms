<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Country_model extends Crud
{  
    public $table = 'countries';    // Table
    public $idkey = 'idCountry';    // Id
    
    public function get_active_country_list()
    {
        $this->db->order_by('country_name','asc');
        $this->db->where('active', true);
        $query = $this->db->get($this->table);
        return $query->result_array();
    }
}

?>