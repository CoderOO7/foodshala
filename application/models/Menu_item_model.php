<?php
class Menu_item_model extends CI_Model{

    public function __construct(){
        parent::__construct();
        $this->load->database();
    }
   
    public function get_all_items(){
        $result = $this->db->get('foods');
        return $result;
    }
}