<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Quest extends CI_Controller {

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
		$user = $this->input->cookie('user');
		$userjson = json_decode($user);
		$data['setting'] = $this->Setting_model->getSetting();
		$data['userjson'] = $userjson;
		$data['admin'] = false;

		//$this->Quest_model->generateNewQuest($userjson->id);
		$data['quest'] = $this->Quest_model->getCurrentUserQuest($userjson->id);

		$this->load->view('v_header', $data);
		$this->load->view('quest/v_quest', $data);
		$this->load->view('v_footer', $data);
	}
	
	public function submitrating() {
		$user = $this->input->cookie('user');
		$userjson = json_decode($user);

		if($this->input->post('id')) {
			$this->Quest_model->submit_rating($this->input->post('id'), $userjson->id, $this->input->post('ratingsel'));
			echo 'result true';
		} else {
			echo 'result false';
		}
	}
}