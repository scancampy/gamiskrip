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

		if(oboarding_check()) {
			$this->session->set_flashdata('showonboarding', 'true');	
		} 
	}
	
	public function index()
	{
		$data = array();
		$data['js'] = '';
		$user = $this->input->cookie('user');
		$userjson = json_decode($user);
		$data['userjson'] = $userjson;

		$data['setting'] = $this->Setting_model->getSetting();

		// check if student
		if($userjson->user_type!='student') {
			redirect('notfound');
		}
		$data['survey'] = $this->Survey_model->getSurvey();
		$data['answers'] = $this->Survey_model->getUserAnswer($userjson->id);

		//print_r($data['answers']);

		if($this->input->post('btnsubmit')) {
			$not_complete = false;
			$player_style = array('socializer' => 0,'free spirit' => 0,'achiever' => 0,'disruptor' => 0,'players' => 0,'philanthropist' => 0);

			foreach ($data['survey'] as $key => $value) {
				if(!$this->input->post('likert_'.$value->id)) {
					$not_complete = true;
					break;
				}

				$player_style[$value->user_type] += $this->input->post('likert_'.$value->id);
				// store user answer
				$this->Survey_model->insertUserAnswer($userjson->id, $value->id, $this->input->post('likert_'.$value->id));
			}

			if($not_complete== true) {
				$notif = (object)array('type' => 'warning', 'message' => 'Please answer all questions');
				$data['answers'] = $this->Survey_model->getUserAnswer($userjson->id);

			} else {
			    $this->Student_model->updateUserType($userjson->id, $player_style);
				$this->session->set_flashdata('type',  'success');
				$this->session->set_flashdata('message', 'Your answer have been recorded');

				// update cookie
				$student = $this->User_model->getUser($userjson->id);

				//success create cookies
				//$this->input->set_cookie('user', json_encode($student[0]), time() + (3600 * 24 * 30)); 

				redirect('survey');
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

	   	$this->load->view('v_header_survey', $data);
		$this->load->view('v_survey', $data);
		$this->load->view('v_footer', $data);
	}
}