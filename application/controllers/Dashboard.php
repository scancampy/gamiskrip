<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Dashboard extends CI_Controller {

	public function __construct() {
		// Check if user cookies exists
		parent::__construct();
		$this->load->helper('cookie');
		if (empty($this->input->cookie('user'))) {
			// Redirect to default controller
			redirect('');
		}
	}

	public function student() {
		$data = array();
		$data['js'] = '';
		$user = $this->input->cookie('user');
		$userjson = json_decode($user);
		
		// check if student
		if($userjson->user_type!='student') {
			redirect('notfound');
		}

		// check if not yet complete the questionnaire
		if(empty($userjson->player_style)) {
			redirect('survey');
		}

		$student = $this->Student_model->getStudent(null, $userjson->username);
		if(empty($student)) {
			redirect('notfound');
		}

		// check if student not yet have thesis title
		$thesis = $this->Thesis_model->getStudentThesis($student[0]->nrp);
		if(empty($thesis)) {
			redirect('thesis/start');
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
		$this->load->view('v_dashboard', $data);
		$this->load->view('v_footer', $data);
	}

	public function admin() {
		$data = array();
		$data['js'] = '';
		$user = $this->input->cookie('user');
		$userjson = json_decode($user);
		
		// check if admin
		if($userjson->user_type!='admin') {
			redirect('notfound');
		}

		echo 'admin';
	}

	public function lecturer() {
		$data = array();
		$data['js'] = '';
		$user = $this->input->cookie('user');
		$userjson = json_decode($user);
		
		// check if lecturer
		if($userjson->user_type!='lecturer') {
			redirect('notfound');
		}

		echo 'lecturer';
	}
	
	public function index()
	{
		$user = $this->input->cookie('user');
		$userjson = json_decode($user);
		
		// check if student
		if($userjson->user_type == 'student') {
			redirect('dashboard/student');
		}

		// check if admin
		if($userjson->user_type == 'admin') {
			redirect('dashboard/admin');
		}

		// check if admin
		if($userjson->user_type == 'lecturer') {
			redirect('dashboard/lecturer');
		}
	}
}