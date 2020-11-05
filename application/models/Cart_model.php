<?php
class Cart_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function insert_cart_data($user_id,$data){
       
        if(isset($user_id) && $this->cart->insert($data)){
           $cart_data_string = serialize($this->cart->contents());
           $data = array(
            'user_id' => $user_id, 
            'data' => $cart_data_string, 
           );

           $this->db->where('user_id',$user_id);
           $query = $this->db->get('cart');
           if($query->num_rows() > 0){
               echo 'update';
                $this->db->where('user_id',$user_id);
                return $this->db->update('cart',$data);
           }else{
               echo 'inset';
                return $this->db->insert('cart',$data);
           }
       }

    }

    public function get_cart_data($user_id){    
        
        if(isset($user_id)){
            $this->db->select('data');
            $this->db->where('user_id', $user_id);
            $query = $this->db->get('cart');
            $cart_data_array = unserialize($query->row('data'));
            return $cart_data_array;
        }

    }
}
