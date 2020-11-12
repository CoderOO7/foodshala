<?php
    class Order_item_model extends CI_Model{
        function __construct(){
            $this->load->database();
        }

        function insert($order_id, $item = array()){
            if(!is_array($item)){
                log_message('debug','2nd paramater passed should be array type');
                return FALSE; 
            }
            $data = array(
                'order_id' => $order_id,
                'food_id' => $item['id'],
                'restaurant_id' => $item['restaurant_id'],
                'price' => $item['price'],
                'quantity' => $item['qty'],
            );

            return $this->db->insert('order_items',$data);
        }
    }