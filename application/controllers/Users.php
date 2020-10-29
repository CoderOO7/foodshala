<?php
class Users extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('User_model', 'user_model');
    }

    public function login() {

        if ($this->input->method() === 'post') {

            //Run form validation check
            $this->form_validation->set_rules('email', 'Email', 'required|min_length[6]|max_length[50]|trim|valid_email');
            $this->form_validation->set_rules('password','Password','required|min_length[8]|max_length[255]|trim');

        }

        if($this->form_validation->run() === FALSE){
            //load the view
            $this->load->view('templates/header');
            $this->load->view('users/login');
            $this->load->view('templates/footer');

        }else{

            /**
             * Check for user authorization 
             */


            $email    = $this->input->post('email', TRUE);
            $password = $this->input->post('password', TRUE);

            if ($this->user_model->resolve_user_login($email, $password)) {

                $data = $this->user_model->get_user($email);
                $firstname = $data->firstname;
                $email = $data->email;
                $role = $data->role;

                $sesdata = array(
                    'username'  => $firstname,
                    'email'     => $email,
                    'role'     => $role,
                    'is_logged_in' => TRUE
                );
                $this->session->set_userdata($sesdata);

                // access login for restaurant members
                if ($role === 'restaurant') {
                    redirect('menu/view');
                } else {
                    // access login for customers
                    redirect('home');
                }
            } else {
                $this->session->set_flashdata('msg', 'Username or Password is Wrong');
                redirect('login');
            }

        }
    }

    public function logout(){
        
        $user_data = $this->session->all_userdata();
        foreach ($user_data as $key) {
            if ($key != 'session_id' && $key != 'ip_address' && $key != 'user_agent' && $key != 'last_activity') {
                $this->session->unset_userdata($key);
            }
        }
        $this->session->sess_destroy();
        
        redirect('home');
    } 

    public function register() {

        if ($this->input->method() == 'post') {
            //Run form validation check
            $this->form_validation->set_rules('firstname', 'First Name', 'required|min_length[3]|max_length[20]|trim');
            $this->form_validation->set_rules('lastname', 'Last Name', 'required|min_length[3]|max_length[20]|trim');
            $this->form_validation->set_rules('email', 'Email', 'required|min_length[6]|max_length[50]|trim|valid_email|is_unique[users.email]');
            $this->form_validation->set_rules('password', 'Password', 'required|min_length[8]|max_length[255]|trim');
            $this->form_validation->set_rules('password_confirm', 'Password Confirmation', 'matches[password]');

        }

        if ($this->form_validation->run() === FALSE) {
            //load the view
            if ($this->uri->segment(1) === "register-restaurant") {
                
                $data['title'] = 'Register As Restaurant';

                $this->load->view('templates/header');
                $this->load->view('users/register_restaurant', $data);
                $this->load->view('templates/footer');
            } else {
                
                $data['title'] = 'Register As Customer';

                $this->load->view('templates/header');
                $this->load->view('users/register_customer', $data);
                $this->load->view('templates/footer');
            }
        } else {
        
            /**
             * Store user data in database
             */

            $user_data = array(
                'firstname' => $this->input->post('firstname', TRUE),
                'lastname' => $this->input->post('lastname', TRUE),
                'email' => $this->input->post('email', TRUE),
                'password' => $this->input->post('password', TRUE),
                'vegen' => $this->input->post('vegen', TRUE),
                'role' => $this->input->post('role', TRUE)
            );

            if ($this->user_model->insert_user($user_data)) {

                $this->session->set_flashdata('success_flashData', 'You have registered successfully.');
                redirect('login');
            } else {

                $this->session->set_flashdata('error_flashData', 'Invalid Registration.');
                if ($this->uri->segment(1) === "register-restaurant") {
                    redirect('register-restaurant');
                } else {
                    redirect('register-customer');
                }
            }
        }
    }
}
