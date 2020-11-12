<?php
    class Orders extends CI_Controller{
        function __construct(){
            parent::__construct();
            $this->load->model('Order_model','order_model');
        }

        public function index(){
            
            if(!isset($_SESSION['user_id']) && $_SESSION['role'] !== "restaurant"){
                redirect('login');
            }            
            $user_id = $_SESSION['user_id'];
            
            $data['title'] = 'Customers Orders';
            $data['data'] = $this->order_model->get_restaurant_orders($user_id);

            $this->load->view('templates/header');
            $this->load->view('orders/index', $data);
            $this->load->view('templates/footer');
        
        }

        public function orders_history($user_id = NULL){
            
            $data['title'] = 'My Orders History';
            $data['orders'] = $this->order_model->get_customer_orders($user_id);
            
            $this->load->view('templates/header');
            $this->load->view('orders/history', $data);
            $this->load->view('templates/footer');
        }

        
    }