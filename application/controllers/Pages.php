<?php
    class Pages extends CI_Controller{
        public function __construct(){
            parent::__construct();
            if(!isset($_SESSION['is_logged_in'])){
                $_SESSION['is_logged_in'] = FALSE;
            }   
        }

        public function view($page = 'home'){
            if(!file_exists(APPPATH.'views/pages/'.$page.'.php')){
                show_404();
            }
            
            $data['title'] = ucfirst($page);
            
            $this->load->view('templates/header');
            $this->load->view('pages/'.$page, $data);
            $this->load->view('templates/footer');

        }
    }