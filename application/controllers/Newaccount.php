<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Newaccount extends CI_Controller {

	public function __construct() {
		// Check if user cookies exists
		parent::__construct();
		/*$this->load->helper('cookie');
		if (empty($this->input->cookie('user'))) {
			// Redirect to default controller
			redirect('');
		}*/
	}
	
	public function index()
	{
		$data = array();
		
		// catch submission
		if($this->input->post('btnsubmit')) {
			$this->load->library('form_validation');
			$this->form_validation->set_rules('first_name', 'Nama Depan', 'required', array('required' => '%s wajib diisi.'));
			$this->form_validation->set_rules('last_name', 'Nama Belakang', 'required', array('required' => '%s wajib diisi.'));
			$this->form_validation->set_rules('password', 'Password', 'required',
                        array('required' => '%s wajib diisi.')
                );
			$this->form_validation->set_rules('repassword', 'Ulangi Password', 'required|matches[password]', array('required' => '%s wajib diisi.','matches' => '%s tidak sama.'));
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[user.email]', array('required' => '%s wajib diisi.', 'is_unique' => '%s sudah terdaftar.',  'valid_email' => '%s tidak valid.'));

			if ($this->form_validation->run() == FALSE)
            {   
            	$this->session->set_flashdata('notif', true);
            	$this->session->set_flashdata('msg', validation_errors());
            	redirect('newaccount');
            } else {
            	//insert
            	if($this->User_model->addStudent()) {
            		$this->session->set_flashdata('notif', 'success');
	            	$this->session->set_flashdata('msg', 'Akun sukses dibuat. Silahkan login.');
	            	redirect('');
            	} else {
            		$this->session->set_flashdata('notif', 'failed');
	            	$this->session->set_flashdata('msg', 'Gagal membuat akun.');
	            	redirect('newaccount');
            	}
            }

			//print_r($_POST);
			//die();
		}

		$data['setting'] = $this->Setting_model->getSetting();


		if($this->session->flashdata('notif')) {
			$data['notif'] =$this->session->flashdata('notif');
			$data['msg'] = $this->session->flashdata('msg');
		}

		$this->load->view('v_new_account', $data);
	}
}
