<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Synthesis extends CI_Controller {

public function __construct() {
	parent::__construct();		
}

public function index() {

	$query = $this->db->get('users');		

	$result = array();
	
	if( $query->num_rows() > 0 ) {
		foreach( $query->result() as $row 	) {
			//echo $row->username;
			$result[$row->id] = $row->username;
		}
	}
	
	$data['users'] = $result;
	
	//print_r($data['users']);
	
	$this->load->view('synthesis_view', $data);
}	

}
