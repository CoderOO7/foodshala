<?php
class Menu_items extends CI_Controller{
    
    function __construct(){
        parent::__construct();
        $this->load->model('Menu_item_model','menu_item_model');
    }

    function index(){
        $data['data']=$this->menu_item_model->get_all_items();
        
        $this->load->view('templates/header');
        $this->load->view('menu_items/view', $data);
        $this->load->view('templates/footer');
    }
}