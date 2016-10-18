<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Crud extends CI_Model
{  
    public $table = '';     // Table
    public $idkey = '';     // Id
    
    public function get_row($obj_id)
    {
        $this->db->where($this->idkey, $obj_id);
        $query = $this->db->get($this->table);
        if ($query->num_rows() == 1) {
            return $query->row_array();
        }
        return false;
    }
    
    public function get_array($sort_field = null, $sort_type = null)
    {
        if (!is_null($sort_field) && !is_null($sort_type)) {
            $this->db->order_by($sort_field, $sort_type);
        }
        $query = $this->db->get($this->table);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }
    
    public function insert($data)
    {
        $this->db->insert($this->table, $data);
    }
    
    public function insert_return($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }
    
    public function update($obj_id, $data)
    {
        $this->db->where($this->idkey, $obj_id);
        $this->db->update($this->table, $data);
    }
    
    public function delete($obj_id)
    {
        $this->db->delete($this->table, array($this->idkey => $obj_id));
    }
}

?>