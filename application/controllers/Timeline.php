<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Timeline extends CI_Controller {

	public function __construct() {
		// Check if user cookies exists
		parent::__construct();
		$this->load->helper('cookie');
		if (empty($this->input->cookie('user'))) {
			// Redirect to default controller
			redirect('');
		}
	}

	public function index() {
		$data = array();
		$data['js'] = '';
		$user = $this->input->cookie('user');
		$userjson = json_decode($user);
		
		// check if student
		if($userjson->user_type!='student') {
			redirect('notfound');
		}

		$data['student'] = $this->Student_model->getStudent(null, $userjson->username);
		if(empty($data['student'])) {
			redirect('notfound');
		}

		
		
		// toast
		$data['js'] .= '
		var Toast = Swal.mixin({
	      toast: true,
	      position: \'top-end\',
	      showConfirmButton: false,
	      timer: 3000
	    });'; 

	    if(!empty($this->session->flashdata('type'))) {
	    	$data['js'] .= '
	    		 Toast.fire({
			        icon: \''.$this->session->flashdata('type').'\',
			        title: \''.$this->session->flashdata('message').'.\'
			      });
			    ';
	    }

	   	$this->load->view('v_header', $data);
		$this->load->view('timeline/v_timeline', $data);
		$this->load->view('v_footer', $data);
	}

	
}