<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	
	public function index()
	{
		$data = array();

		if($this->input->post('btnsignin')) {
			$user = null;
			if($user = $this->User_model->do_login()) {
				//success create cookies
				$this->input->set_cookie('user', json_encode($user), time() + (3600 * 24 * 30)); 

				// redirect
				if($user->user_type=='student') {
					redirect('dashboard/student');
				}
			} else {
				$this->session->set_flashdata('notif', 'failed');
				$this->session->set_flashdata('msg', 'Username or password is incorrect');
				redirect('');
			}
		}

		if($this->session->flashdata('notif')) {
			$data['notif'] =$this->session->flashdata('notif');
			$data['msg'] = $this->session->flashdata('msg');
		}

		$this->load->view('v_login', $data);
	}
}
