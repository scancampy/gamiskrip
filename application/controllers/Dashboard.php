<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Dashboard extends CI_Controller {

	public function __construct() {
		// Check if user cookies exists
		parent::__construct();
		$this->load->helper('cookie');
		//print_r($this->input->cookie('user'));
		//die();
		if ($this->input->cookie('user') == '') {
			// Redirect to default controller
			redirect('');
		}
		if(oboarding_check()) {
			$this->session->set_flashdata('showonboarding', 'true');	
		}
	}

	public function edit_cluster($id) {
		$data = array();
		$data['js'] = '';
		$user = $this->input->cookie('user');
		$userjson = json_decode($user);
		$data['setting'] = $this->Setting_model->getSetting();
		
		
		// check if admin
		if($userjson->user_type!='admin') {
			redirect('notfound');
		}

		$data['userjson'] = $userjson;

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

	    if($this->session->flashdata('type') != '') {
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
		$data['setting'] = $this->Setting_model->getSetting();
		
		$data['userjson'] = $userjson;
		if($this->Quest_model->checkFirstQuest($userjson->id)) {			
			$this->Quest_model->generateNewQuest($userjson->id);	
		}
		
		$data['quest'] = $this->Quest_model->getCurrentUserQuest($userjson->id);
		$data['acts'] = $this->Setting_model->getActs();
		$data['thesis'] = $this->Thesis_model->getStudentThesis(null, $userjson->id, "is_active = 1");

		// check if not yet complete the questionnaire
		/*if(empty($userjson->player_style)) {
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
		}*/
		
		// toast
		$data['js'] .= '
		var Toast = Swal.mixin({
	      toast: true,
	      position: \'top-end\',
	      showConfirmButton: false,
	      timer: 3000
	    });'; 

	    if($this->session->flashdata('type') != '') {
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

		$data['setting'] = $this->Setting_model->getSetting();		
		$data['userjson'] = $userjson;

		$this->load->view('v_header', $data);
		$this->load->view('v_dashboard_admin', $data);
		$this->load->view('v_footer', $data);
	}

	public function signout() {
		delete_cookie('user');
		redirect(''); 
	}

	public function lecturer() {
		$data = array();
		$data['js'] = '';
		$user = $this->input->cookie('user');
		$userjson = json_decode($user);

		$data['setting'] = $this->Setting_model->getSetting();
		
		$data['userjson'] = $userjson;
		
		// check if lecturer
		if($userjson->user_type!='lecturer') {
			redirect('notfound');
		}

		$this->load->view('v_header', $data);
		$this->load->view('v_dashboard_lecturer', $data);
		$this->load->view('v_footer', $data);
	}
	
	public function index()
	{
		$user = $this->input->cookie('user');
		$userjson = json_decode($user);

		//print_r($userjson);
		
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