<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

public function __construct() {
	parent::__construct();
	$this->load->library('form_validation');
	$this->load->model('user_model');
	$this->load->library('session');
	$this->load->helper('url');
	$this->load->helper('date');			
}

public function index() {

	if( ($this->session->userdata('user_id') != "" )) {	
		redirect(site_url('home'));
	} else {
		$this->load->view("register_view");
	}
}

public function login() {
	$rules = array(array('field'=>'l_email','label'=>'Email or Username','rules'=>'required'),
	array('field'=>'l_pass','label'=>'Password','rules'=>'required'));
	
	$this->form_validation->set_rules($rules);
	
	if($this->form_validation->run() == FALSE) {
		$this->index();
	} else {
		$auth = $this->user_model->login($this->input->post('l_email'),$this->input->post('l_pass'));
		if($auth) {
			redirect(site_url('home'));
		} else {
			$this->session->set_flashdata('message', 'Invalid username or password.');
			$this->index();
		}
	}
}

public function register() {
	$this->load->view('register_view');//loads the register_view.php file in views folder
}

public function home() {
	$this->load->view('home');//loads the home.php file in views folder
}

public function forgotpassword() {
	$this->load->view('forgotpassword_view');//loads the forgotpassword_view.php file in views folder
}

public function resetpassword() {
	
	$auth_token = $this->input->get('auth_token');
	
	$query = $this->db->get_where('users', array('auth_token' => $auth_token), 1);		
	
	if( $query->num_rows() == 1 ) {
		$row = $query->result();
		$current_date 		= date( 'Y-m-d H:i:s');
		$link_expiry_date 	= $row[0]->link_expiry_date;
		
		if($current_date > $link_expiry_date) {
			$this->session->set_flashdata('message', 'This link is expired.');
		}
	} else {
		$this->session->set_flashdata('message', 'There isnt matching record in database for the given token.');
	}
	
	$this->load->view('resetpassword_view');//loads the resetpassword_view.php file in views folder
}

public function do_register() {
	$rules = array(
		array('field'=>'username','label'=>'User Name','rules'=>'trim|required|min_length[4]|max_length[15]'),
		array('field'=>'password','label'=>'Password','rules'=>'trim|required|min_length[6]|matches[confirm_password]'),
		array('field'=>'confirm_password','label'=>'Confirm Password','rules'=>'trim|required|min_length[6]'),		
		array('field'=>'email','label'=>'Email','rules'=>'trim|required|valid_email')		
	);
	
	$this->form_validation->set_rules($rules);
	
	if($this->form_validation->run() == FALSE) {
		$this->load->view('register_view');
	} else {
		$this->user_model->register_user();
		$this->load->view('success');
	}
}

public function do_forget() {
	$rules = array(	
		array('field'=>'email','label'=>'Email','rules'=>'trim|required|valid_email')		
	);
	
	$this->form_validation->set_rules($rules);
	
	if($this->form_validation->run() == FALSE) {
		$this->load->view('forgotpassword_view');
	} else {
		$email = $this->input->post('email');

		$query = $this->db->get_where('users', array('email' => $email), 1);		
		
        if( $query->num_rows() > 0 ) {
            $row = $query->result();		
			$this->sendpasswordemail( $row[0] );
		}
			
		$this->session->set_flashdata('message', 'The email id you entered is not found on our database.');
		
		redirect(site_url('forgotpassword'));
	}
}

private function sendpasswordemail( $user ) {

		$this->load->helper('string');
		
		$auth_token 		= random_string('alnum', 16);
		$time				= 30 * 60; //30 minutes		
		$link_expiry_date 	= date( 'Y-m-d H:i:s' , time() + $time );
		
		$this->db->where('id', $user->id);
		$this->db->update('users',array('auth_token' => $auth_token, 'link_expiry_date' => $link_expiry_date));
		
		$this->load->library('email');
		
		$this->email->from('18.amol@gmail.com', 'Amol Nikam');
		$this->email->to($user->email); 	
		$this->email->subject('Password reset');
		$this->email->message("You have requested the new password, Please click below link to reset your password:\r\n" . 
								site_url('resetpassword') . '?auth_token=' . $auth_token);
		
		$this->email->set_newline("\r\n");	
		
		if ($this->email->send()) {
			$message = 'Email Successfully Sent !';
		} else {
			$message =  '<p class="error_msg">Invalid Email Account or Password !</p>';
		}
		
		$this->session->set_flashdata( 'message', $message );
		
		redirect(site_url('forgotpassword'));
} 

public function do_resetpassword() {

	$rules = array(	
		array('field'=>'password','label'=>'Password','rules'=>'trim|required|min_length[6]|matches[confirm_password]'),
		array('field'=>'confirm_password','label'=>'Confirm Password','rules'=>'trim|required|min_length[6]')	
	);
	
	$this->form_validation->set_rules($rules);
	
	if($this->form_validation->run() == FALSE) {
		$data['postauth_token'] = $this->input->post('auth_token');			
		$this->load->view('resetpassword_view', $data);
	} else {
		$auth_token = $this->input->post('auth_token');
		$password 	= $this->input->post('password');		
		
		$query = $this->db->get_where('users', array('auth_token' => $auth_token), 1);		
		
        if( $query->num_rows() == 1 ) {
            $row = $query->result();	
			$this->user_model->reset_password( $row[0], $password );
			
			$this->session->set_flashdata('message', 'Your new password updated successfully. Please check by login.');
			redirect(site_url('resetpassword'));
		}
			
		$this->session->set_flashdata('message', 'We didnt get any record in our database matching with given token.');
		redirect(site_url('resetpassword'));
	}
}

public function logout() {
	$this->session->sess_destroy();
		redirect(site_url());
	}
}