<?php

defined('BASEPATH') or exit('No direct script access allowed');

use Google\Cloud\Storage\StorageClient;

class Menu_items extends CI_Controller{
    
    function __construct(){
        parent::__construct();
        $this->load->model('Menu_item_model','menu_item_model');
    }

    function index(){
        $this->config->load('credentials', TRUE);
        $gc_crendentials = $this->config->item('gc_credentials', 'credentials');
        
        $data['bucket_name'] = $gc_crendentials['storage']['bucket'];
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
            
            $this->config->load('credentials', TRUE);
            $gc_crendentials = $this->config->item('gc_credentials', 'credentials');
            
            $privateKeyFileContent = $gc_crendentials['auth'];
            $bucketName = $gc_crendentials['storage']['bucket'];
            // get local file for upload testing
            $fileContent = file_get_contents($_FILES[$img_key]["tmp_name"]);
            // NOTE: if 'folder' or 'tree' is not exist then it will be automatically created !
            $cloudPath = 'images/' . $_FILES[$img_key]["name"];
     
            $isSucceed = $this->do_upload($bucketName, $fileContent, $cloudPath, $privateKeyFileContent);

            if($isSucceed ===  true){
                $img_name = $_FILES[$img_key]["name"];
            }

        }
        return $img_name;
    }

    function do_upload($bucketName, $fileContent, $cloudPath,$privateKeyFileContent){

        // connect to Google Cloud Storage using private key as authentication
        try {
            $storage = new StorageClient([
                'keyFile' => $privateKeyFileContent
            ]);
        } catch (Exception $e) {
            // maybe invalid private key ?
            print $e;
            return false;
        }

        // set which bucket to work in
        $bucket = $storage->bucket($bucketName);

        // upload/replace file 
        $storageObject = $bucket->upload($fileContent,['name' => $cloudPath]);

        // is it succeed ?
        return $storageObject != null;
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