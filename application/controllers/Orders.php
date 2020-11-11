<?php
    class Orders extends CI_Controller{
        function __construct(){
            parent::__construct();
            $this->load->model('Order_model','order_model');
        }

        public function index(){            
            $data['title'] = 'Your Orders';
            
            $this->load->view('template/header');
            $this->load->view('orders/index', $data);
            $this->load->view('template/footer');

        }

    }