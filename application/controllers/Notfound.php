<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notfound extends CI_Controller {

	
	public function index()
	{
		$data = array();
		$data['js'] = '';
		$user = $this->input->cookie('user');
		$userjson = json_decode($user);
		$data['setting'] = $this->Setting_model->getSetting();
		$data['userjson'] = $userjson;

		$this->load->view('v_header', $data);
		$this->load->view('v_not_found', $data);
		$this->load->view('v_footer', $data);
	}
}
