<?php
class Users extends CI_Controller
{
    public function __construct() {
		parent::__construct();
		$this->load->model('User_model','UserModel');
    }
    
    public function index(){

        $this->load->view('template/header');
        $this->load->view('users/login');
        $this->load->view('template/footer');
    }

    public function register()
    {
        if ($this->input->method() == 'post') {
            //Add sever side validation
            $rules = array(
                array(
                    'field' => 'firstname',
                    'label' => 'First Name',
                    'rules' => 'required|min_length[3]|max_length[20]'
                ),
                array(
                    'field' => 'lastname',
                    'label' => 'Last Name',
                    'rules' => 'required|min_length[3]|max_length[20]'
                ),
                array(
                    'field' => 'email',
                    'label' => 'Email',
                    'rules' => 'required|min_length[6]|max_length[50]|valid_email'
                ),

                array(
                    'field' => 'password',
                    'label' => 'Password',
                    'rules' => 'required|min_length[8]|max_length[255]',
                ),
                array(
                    'field' => 'password_confirm',
                    'label' => 'Password Confirmation',
                    'rules' => 'matches[password]'
                ),
            );

            $this->form_validation->set_rules($rules);
        }

        if ($this->form_validation->run() == FALSE) {
            
            $this->load->view('template/header');
            $this->load->view('users/register');
            $this->load->view('template/footer');

        } else {

            //store the user in database
            $insert_data = array(
                'firstname' => $this->input->post('firstname', TRUE),
                'lastname' => $this->input->post('lastname', TRUE),
                'email' => $this->input->post('email', TRUE),
                'password' => password_hash($this->input->post('password', TRUE), PASSWORD_DEFAULT),
                'created_at' => time(),
            );

            /**
             * Load User Model
             */
            if ($this->UserModel->insert_user($insert_data)) {

                $this->session->set_flashdata('success_flashData', 'You have registered successfully.');
                redirect('Users/register');
            } else {

                $this->session->set_flashdata('error_flashData', 'Invalid Registration.');
                redirect('Users/register');
            }

        }
    }
}
