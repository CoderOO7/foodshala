<?php
class User_model extends CI_Model
{
    protected $User_table_name = "users";

    public function __construct(){
        parent::__construct();
        $this->load->database();
    }


    public function insert_user($userdata){
        $userdata['password'] = $this->hash_password($userdata['password']);
        return $this->db->insert('users', $userdata);
    }

    public function get_user_id_from_email($email) {
		
		$this->db->select('id');
		$this->db->from('users');
		$this->db->where('email', $email);

		return $this->db->get()->row('id');
    } 
    

    public function get_user($email) {
		
		$this->db->from('users');
        $this->db->where('email', $email);
        
		return $this->db->get()->row();
    }
    
    public function resolve_user_login($email, $password) {
		
		$this->db->select('password');
		$this->db->from('users');
		$this->db->where('email', $email);
		$hash = $this->db->get()->row('password');
		
		return $this->verify_password_hash($password, $hash);
		
    }

    private function hash_password($password) {
		
		return password_hash($password, PASSWORD_BCRYPT);
		
	}

    private function verify_password_hash($password, $hash) {

        return password_verify($password, $hash);
    }

}
