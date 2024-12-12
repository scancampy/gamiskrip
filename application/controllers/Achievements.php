<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Achievements extends CI_Controller {

	public function __construct() {
		// Check if user cookies exists
		parent::__construct();
		$this->load->helper('cookie');
		if (empty($this->input->cookie('user'))) {
			// Redirect to default controller
			redirect('');
		}

		if(oboarding_check()) {
			$this->session->set_flashdata('showonboarding', 'true');	
		} 
	}

	public function index() {
		$data = array();
		$data['js'] = '';

		$data['setting'] = $this->Setting_model->getSetting();
		$user = $this->input->cookie('user');
		$userjson = json_decode($user);
		$data['userjson'] = $userjson;
		$data['periode'] = $this->Setting_model->get_active_periode();

		if($userjson->user_type == 'student') {
			$data['info'] = $this->Student_model->getStudent(null, $userjson->id);
			if(empty($data['info'])) {
				redirect('notfound');
			}
		} else {
			redirect('notfound');
		}

		$data['achievements'] = $this->Quest_model->getUserAchievements($userjson->id);

	   	$this->load->view('v_header', $data);
		$this->load->view('achievements/v_achievements', $data);
		$this->load->view('v_footer', $data);
	}
}