<?php
    class Orders extends CI_Controller{
        public function index(){            
            $data['title'] = 'Your Orders';
            
            $this->load->view('template/header');
            $this->load->view('orders/index', $data);
            $this->load->view('template/footer');

        }
    }