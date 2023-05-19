<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Thesis extends CI_Controller {
	public function index()
	{
		echo 'TBA';
	}

	public function start() {
		$data = array();
		$data['js'] = '';
		$user = $this->input->cookie('user');
		$userjson = json_decode($user);
		
		// check if student
		if($userjson->user_type!='student') {
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

	    if(!empty($notif)) {
	    	$data['js'] .= '
	    		 Toast.fire({
			        icon: \''.$notif->type.'\',
			        title: \''.$notif->message.'.\'
			      });
			    ';
	    }

	   	$this->load->view('v_header', $data);
		$this->load->view('thesis/v_start', $data);
		$this->load->view('v_footer', $data);
	}
}
