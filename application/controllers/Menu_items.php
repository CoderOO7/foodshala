<?php
class Menu_items extends CI_Controller{
    
    function __construct(){
        parent::__construct();
        $this->load->model('Menu_item_model','menu_item_model');
    }

    function index(){
        $data['items'] = $this->menu_item_model->get_all_items();
        $data['rnames'] = $this->_get_restaurant_names($data['items']);

        $this->load->view('templates/header');
        $this->load->view('menu_items/view', $data);
        $this->load->view('templates/footer');
    }

    function add_item(){
        $data['title']= 'Add new item to the menu';

        $this->form_validation->set_rules('name','Name','required');
        $this->form_validation->set_rules('price','Price','required');
        $this->form_validation->set_rules('quantity','Quantity','required');

        if($this->form_validation->run() === FALSE){

            $this->load->view('templates/header');
            $this->load->view('menu_items/add', $data);
            $this->load->view('templates/footer');
        }else{
            
            $img_name = $this->_upload_image('food-image');
            $user_id = $this->session->userdata('user_id');
            
            $this->menu_item_model->add_item($img_name,$user_id);
            redirect('menu/view');
        }
        
    }

    function edit_item($item_id){
        $data['title']= 'Edit item details';
        $data['data']=$this->menu_item_model->get_item_by_id($item_id);
        
        $this->form_validation->set_rules('name','Name','required');
        $this->form_validation->set_rules('price','Price','required');
        $this->form_validation->set_rules('quantity','Quantity','required');

        if($this->form_validation->run() === FALSE){

            $this->load->view('templates/header');
            $this->load->view('menu_items/edit', $data);
            $this->load->view('templates/footer');
        }else{

            $param['food_id'] = $item_id;
            $param['user_id'] = $this->session->userdata('user_id');
            $param['img_name'] = $this->_upload_image('food-image');

            //setting old image name
            if(!isset($param['img_name'])){
                $param['img_name'] = $data['data']['image'];    
            }

            if($this->menu_item_model->update_item($param)){
                redirect('menu/view');
            }else{
                print_r('Error while updating the item in db');
            };
        }
    }

    function delete_item($item_id){
        $this->menu_item_model->delete_item($item_id);
        redirect('menu/view');        
    }

    function _upload_image($img_key){

        $img_name = NULL;
        if($_FILES[$img_key]['name'] != ""){

            $config['upload_path'] = './assets/images/foods/';
            $config['allowed_types'] = 'gif|jpg|jpeg|png';
            $config['max_size'] = '4096';
    
            $this->load->library('upload',$config);
            
            if(!$this->upload->do_upload($img_key)){ //If image not uploaded
                $errors = array('error' => $this->upload->display_errors());
                foreach($errors as $error){
                    log_message('error','image upload error: '.$error);
                }
                $img_name = 'noimage.jpg';
            }else{ //Image uploaded successfully
                $data = array('upload_data' => $this->upload->data());
                $img_name = $_FILES[$img_key]['name'];
            }
        }
        return $img_name;
    }

    function _get_restaurant_names($items = array()){
        if(! is_array($items) || count($items) == 0){
            log_message('error', 'The passed parameter must be passed an array containing data');
            return NULL;
        }
        $rnames = [];
        foreach($items as $item){
            $name = $this->menu_item_model->get_restaurant_name($item->id);
            array_push($rnames,$name);
        }
        return $rnames;
    }
}