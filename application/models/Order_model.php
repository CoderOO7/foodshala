<?php
    class Order_model extends CI_Model{
        
        function __construct(){
            $this->load->database();
        }

        function place_order($param = array()){
            $order_data = array(
                'customer_id' => $param['customer_id'],
                'first_name' => $this->input->post("firstname"),
                'last_name' => $this->input->post("lastname"),
                'address' => $this->input->post("address"),
                'address_e' => $this->input->post("address_e"),
                'state' => $this->input->post("address_e"),
                'city' => $this->input->post("city"),
                'pin_code' => $this->input->post("pincode"),
                'payment' => $this->input->post("paymentmethod"),
                'fulfilment_code' => $param['payment_code'],
                'total_amount' => $param['total_amount'],
                'status' => 'pending',
            );

            $this->db->insert('orders',$order_data);
            $order_id = $this->db->insert_id();
            return $order_id;
        }

        function get_customer_orders($user_id){
            $this->db->order_by('orders.id','DESC');
            $this->db->join('order_items','orders.id = order_id');
            $this->db->join('foods','foods.id = order_items.food_id');
            $query = $this->db->get_where('orders',array('customer_id' => $user_id));
            return $query->result_array();
        }

        function get_restaurant_orders($user_id){
            $this->db->select('orders.id, users.id AS `user_id`, users.firstname, users.lastname, users.email, city, total_amount, created_at');
            $this->db->order_by('orders.id','DESC');
            $this->db->join('order_items','restaurant_id = '.$user_id);
            $this->db->join('users','users.id = orders.customer_id');

            return $this->db->get('orders');
        }
    }