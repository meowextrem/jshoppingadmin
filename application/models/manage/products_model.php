<?php

class Products_model extends CI_Model {

    public $table = 'products';
    public $id = 'id';
    public $id_fields = array('id');
    public $num_rows;
    public $table_structure = array();
    public $display_fields = array('thename' => 'Product Name',
        'price' => 'Price',
        'image' => 'Image',
        'stock' => 'Stocks Left',
        );
    public $visible_fields = array('thename',
        'price',
        'image',
        'stock',
    );

    public function __construct() {
        parent::__construct();
    }

    public function get_structure()
    {
        if (!count($this->table_structure))
        {
            $this->table_structure = $this->db->field_data($this->table);
        }
        return $this->table_structure;
    }

    public function get($id)
    {
        if ($id)
        {
            $this->query = $this->db->get_where($this->table, array($this->id => $id));
            return $this->query->result_array();
        }
    }

    public function add($data)
    {
        $query = $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function update($where, $data) {
        $this->db->where($where);
        $sql = $this->db->update($this->table, $data);
        
        return $this->db->affected_rows();
    }

    public function delete_product($id = "") {

        $this->db->where('id',$id);
        $this->db->delete($this->table); 
  
        return true;
    }    

    public function search_product(){

        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->order_by('id', 'ASC');
        $query = $this->db->get();

        $this->num_rows = $query->num_rows();
                    
        if (count($query->result_array()) <= 0) {
            return array();
        }
        return $query->result_array();
    }

    public function get_file($id = "") {

        $this->db->select('image');
        $this->db->from($this->table);
        $this->db->where('id',$id);
        $query = $this->db->get()->result();
        $clean_file_name = $query[0]->image;

        return $clean_file_name;
    }      
    
    public function get_products_api_based() {

        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->order_by('id', 'ASC');
        $query = $this->db->get();

        $this->num_rows = $query->num_rows();
                    
        if ($this->num_rows <= 0) {
            return array();
        }

        return $query->result_array();
        
        
    }

    public function get_latest_api_based() {

        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->order_by('id', 'DESC');
        $this->db->limit('4');
        $query = $this->db->get();

        $this->num_rows = $query->num_rows();
                    
        if ($this->num_rows <= 0) {
            return array();
        }

        return $query->result_array();

    }

    public function get_product_info($where = array()) {

        $this->db->select('*');
        $this->db->from($this->table);

        if(!empty($where)) {
            $this->db->where($where);
        }
        $query = $this->db->get();

        $this->num_rows = $query->num_rows();
                    
        if ($this->num_rows <= 0) {
            return array();
        }

        return $query->result_array()[0];
         
    }



}
