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

	public function edit_cluster($id) {
		$data = array();
		$data['js'] = '';
		$user = $this->input->cookie('user');
		$userjson = json_decode($user);
		
		// check if admin
		if($userjson->user_type!='admin') {
			redirect('notfound');
		}

		$data['cluster'] = $this->Cluster_model->getClusterId($id);
		$data['lecturer'] = $this->Lecturer_model->getLecturer(null, null,null, 'name', 'asc');

		if(!$data['cluster']) {
			redirect('notfound');
		}

		if($this->input->post('btnsubmit')) {
			$array = array(
							'supervisor1' => $this->input->post('supervisor1'),
							'supervisor2' => $this->input->post('supervisor2')
						  );
			$this->Cluster_model->updateCluster($id, $array);

			$this->session->set_flashdata('type', 'success');
			$this->session->set_flashdata('message', 'Cluster updated!');
			redirect('dashboard/edit_cluster/'.$id);
			
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
		$this->load->view('v_edit_cluster', $data);
		$this->load->view('v_footer', $data);
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

		$data['student'] = $this->Student_model->getStudent(null, $userjson->username);
		if(empty($data['student'])) {
			redirect('notfound');
		}

		// check if student not yet have thesis title
		$data['thesis'] = $this->Thesis_model->getStudentThesis('',$data['student'][0]->nrp);
		if(empty($data['thesis'])) {
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