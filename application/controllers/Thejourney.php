<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Thejourney extends CI_Controller {

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

		if($userjson->user_type == 'student') {
			$data['info'] = $this->Student_model->getStudent(null, $userjson->id);
			if(empty($data['info'])) {
				redirect('notfound');
			} else {
				// sudah punya tugas akhir atau belum
				$data['ta'] = $this->Thesis_model->getStudentThesis(null, $userjson->id, "tugas_akhir.is_active = 1");

				if(count($data['ta']) == 0) {
					redirect('notfound');
				} else {
					$data['master_journey'] = $this->Journey_model->get_journey_story($data['ta'][0]->thejourney_character_id);
					if($data['ta'][0]->thejourney_character_id != null) { 
						$data['journey_character'] = $this->Journey_model->get_journey_characters("id=".$data['ta'][0]->thejourney_character_id);
					}
					$data['periode'] = $this->Setting_model->get_active_periode();
					$data['points'] = $this->Quest_model->get_user_points($userjson->id, $data['periode']->start_periode, $data['periode']->end_periode);
					$data['master_act'] = $this->Journey_model->get_acts();
					$data['journey'] = $this->Journey_model->get_user_story($data['ta'][0]->id);

					//print_r($data['ta'][0]->thejourney_character_id);
					//print_r($data['journey']);

					//die();
				}
			}
		}

		if($this->input->post('btnpilchar')) {
			$char =  $this->input->post('btnpilchar');
			$this->Journey_model->set_character($char, $data['ta'][0]->id);
			$this->session->set_flashdata('type', 'success');
			$this->session->set_flashdata('message', 'Sukses pilih karakter');

			redirect('thejourney');
		}

		$data['characters'] = $this->Journey_model->get_journey_characters();

		// reveal story
		$data['js'] .= '
			$(".revealstorybtn").on("click", function() {
				var i = $(this).attr("storyid");
				var tugasakhirid = '.$data['ta'][0]->id.';
				$("#card_" + i).show("slow");
				$(this).hide();

				$.post("'.base_url("thejourney/insertstoryprogress").'", { storyid: i, taid:tugasakhirid }, function(data) {
					console.log(data);
				});
			});
		';

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

		/*$data['periode'] = $this->Setting_model->get_active_periode();

		$data['individual'] = $this->Quest_model->get_individual_leaderboard($data['periode']->start_periode, $data['periode']->end_periode);
		$data['clan'] = $this->Quest_model->get_clan_leaderboard($data['periode']->start_periode, $data['periode']->end_periode);*/
			

	   	$this->load->view('v_header', $data);
		$this->load->view('thejourney/v_thejourney', $data);
		$this->load->view('v_footer', $data);
	}

	public function insertstoryprogress() {
		$user = $this->input->cookie('user');
		$userjson = json_decode($user);
		$storyid = $this->input->post('storyid');
		$taid = $this->input->post('taid');
		$x = $this->Journey_model->insert_user_story($taid, $storyid, $userjson->id);
		//$result = $this->Clan_model->toggle_like_chat($this->input->post('id'), $userjson->id);

		echo $x;
	}
}