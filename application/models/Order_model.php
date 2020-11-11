<?php
    class Order_model extends CI_Model{
        
        function __construct(){
            $this->load->database();
        }

        function place_order($param = array()){
            $order_data = array(
                'user_id' => $param['user_id'],
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
            );

            $this->db->insert('orders',$order_data);
            $order_id = $this->db->insert_id();
            return $order_id;
        }
    }