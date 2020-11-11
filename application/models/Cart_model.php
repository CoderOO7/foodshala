<?php
class Cart_model extends CI_Model{

    public function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function insert_data($user_id){
        
        $data = array(
            'user_id' => $user_id,
            'food_id' => $this->input->post('food_id'),
            'qty' => '1'
        );

        return $this->db->insert('cart',$data);
    }

    public function get_data($user_id){

        if(isset($user_id)){
            $this->db->order_by('cart.row_id','DESC');
            $this->db->join('foods','foods.id = cart.food_id');
            $this->db->where('cart.user_id', $user_id);
            
            $query = $this->db->get('cart');
            return $query->result_array();
        }

    }

    public function delete(){
        $row_id = $this->input->post('row_id');
        
        if(isset($row_id)){
            $this->db->where('row_id',$row_id);
            $this->db->delete('cart');
            return true;
        }else{
            echo 'row_id is not valid';
        }
    }

    public function get_items_count(){
        return $this->db->from('cart')->count_all_results();
    }

    public function destroy(){
        return $this->db->truncate('cart');
    }
}
