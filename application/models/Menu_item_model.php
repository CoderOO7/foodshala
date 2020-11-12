<?php
class Menu_item_model extends CI_Model{

    public function __construct(){
        parent::__construct();
        $this->load->database();
    }
   
    public function get_all_items(){
        $this->db->order_by('id','DESC');
        $query = $this->db->get('foods');
        return $query->result();
    }

    public function get_item_by_id($food_id){
        $this->db->order_by('id','DESC');
        $result = $this->db->get_where('foods',array('id'=>$food_id));
        return $result->row_array();
    }

    public function add_item($food_image, $user_id){
        $data = array(
            'name' => $this->input->post('name'),
            'price' => $this->input->post('price'),
            'stock' => $this->input->post('quantity'),
            'image' => $food_image,
            'restaurant_id' => $user_id
        );
        return $this->db->insert('foods',$data);
    }

    public function update_item($param = array()){
        $data = array(
            'name' => $this->input->post('name'),
            'price' => $this->input->post('price'),
            'stock' => $this->input->post('quantity'),
            'image' => $param['img_name'],
            'restaurant_id' => $param['user_id'],
        );
        $this->db->where('id',$param['food_id']);
        return $this->db->update('foods',$data);
    }

    public function delete_item($food_id){
        
        if(isset($food_id)){
            $this->db->where('id',$food_id);
            return $this->db->delete('foods');
        }
    }

    public function get_restaurant_id($food_id){
        if(isset($food)){
            $this->db->select('restaurant_id');
            return $this->db->get_where('foods',array('food_id' => $food_id));
        }
    }

    public function get_restaurant_name($food_id){
        if(isset($food_id)){
            $this->db->select('firstname, lastname');
            $this->db->join('users','users.id = foods.restaurant_id');
            return $this->db->get_where('foods',array('foods.id' => $food_id))->row_array();
        }
    }

}