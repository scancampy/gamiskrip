<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Survey extends CI_Controller {

	public function __construct() {
		// Check if user cookies exists
		parent::__construct();
		$this->load->helper('cookie');
		if (empty($this->input->cookie('user'))) {
			// Redirect to default controller
			redirect('');
		}
	}
	
	public function index()
	{
		$data = array();
		$data['js'] = '';
		$data['survey'] = $this->Survey_model->getSurvey();
		$user = $this->input->cookie('user');
		$userjson = json_decode($user);

		// check if student
		if($userjson->user_type!='student') {
			redirect('notfound');
		}
		
		if($this->input->post('btnsubmit')) {
			$not_complete = false;
			$player_style = array('socializer' => 0,'free_spirit' => 0,'achiever' => 0,'disruptor' => 0,'player' => 0,'philanthropist' => 0);

			foreach ($data['survey'] as $key => $value) {
				if(!$this->input->post('likert_'.$value->id)) {
					$not_complete = true;
					break;
				}

				$player_style[$value->player_type] += $this->input->post('likert_'.$value->id);
			}

			if($not_complete== true) {
				$notif = (object)array('type' => 'warning', 'message' => 'Please answer all questions');
			} else {
			    $this->Student_model->updateUserType($userjson->username, $player_style);
				$this->session->set_flashdata('type',  'success');
				$this->session->set_flashdata('message', 'Your answer have been recorded');

				// update cookie
				$student = $this->User_model->getUser($userjson->username);

				//success create cookies
				$this->input->set_cookie('user', json_encode($student[0]), time() + (3600 * 24 * 30)); 

				redirect('dashboard/student');
			}
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
		$this->load->view('v_survey', $data);
		$this->load->view('v_footer', $data);
	}
}