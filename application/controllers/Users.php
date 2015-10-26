<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form','html'));
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger" style="background-color:white; 
														border:none">', '</div>');

	}


	function login(){
		$data['error'] = 0;
		$data['head'] = $this->top_template();
		$data['footer'] = $this->bottom_template();

		if ($this->input->post('submit_user')) {

			// Validation Rules
			$config_validation = array(
	               array(
	                     'field'   => 'username', 
	                     'label'   => 'User', 
	                     'rules'   => 'required'
	                  ),
	               array(
	                     'field'   => 'password', 
	                     'label'   => 'Password', 
	                     'rules'   => 'required'
	                  ),
	        );
			$this->form_validation->set_rules($config_validation);
			// Check to see if validation OR upload failed
			if ($this->form_validation->run() == FALSE){
				
				$this->load->view('sec_login',$data);
			}

			$this->load->model(array('Users_model'));
			$username = $this->input->post('username',true);
			$password = $this->input->post('password',true);

			$user = $this->Users_model->login($username, $password);

			if (!$user) {
				if($this->Users_model->check_user_exists($username)){
					$data['error'] = "Password Incorrect";
				}else{
					$data['error'] = "Username: <b>".$username."</b> Doesn't exist.";
				}

			}else{
				$this->session->set_userdata('user_id', $user['user_id']);
				$this->session->set_userdata('user_type', $user['user_type']);

				redirect('/web');

			}
		}

		$this->load->view('sec_login',$data);
	}
	function login_details(){
		
		$this->load->model(array('Users_model'));

		$data['error'] = 0;
		$data['head'] = $this->top_template();
		$data['footer'] = $this->bottom_template();
		$user_id = $this->session->userdata('user_id');
		$data['user'] = $this->Users_model->get_user($user_id);

		if ($this->input->post('change_password')) {
			
			// Validation Rules
			$config_validation = array(
	               array(
	                     'field'   => 'password1', 
	                     'label'   => 'password1', 
	                     'rules'   => 'required'
	                  ),
	               array(
	                     'field'   => 'password2', 
	                     'label'   => 'password2', 
	                     'rules'   => 'required|matches[password1]'
	                  ),
	        );
			$this->form_validation->set_rules($config_validation);
			// Check to see if validation
			if ($this->form_validation->run() == FALSE){
				
				$this->load->view('sec_login_details',$data);
			}else{
				print_r($_SESSION);
				echo "<br>";
				print_r($data['user']);

				$password = $this->input->post('password1',true);
				$email = $data['user']['email'];
				$username = $data['user']['username'];
				$usertype = $data['user']['user_type'];
				
				$this->Users_model->change_password($password, $username, $email, $usertype, $user_id);
			}				
		}
		$this->load->view('sec_login_details',$data);
	}

	function logout(){
		$_SESSION['user_id'] =0;
		session_destroy();
		redirect('/web');
	}
}
?>