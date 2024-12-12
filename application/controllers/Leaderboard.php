<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Leaderboard extends CI_Controller {

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

		if($this->input->get('month_individual')) {
			if($this->input->get('month_individual') == 'all') {
				$data['individual'] = $this->Quest_model->get_individual_leaderboard($data['periode']->start_periode, $data['periode']->end_periode);
			} else {
				$dateStart = new DateTime($this->input->get('month_individual'));
				$dateEnd = new DateTime($this->input->get('month_individual'));
				$dateEnd->modify('last day of this month');
				$data['individual'] = $this->Quest_model->get_individual_leaderboard($dateStart->format('Y-m-d'), $dateEnd->format('Y-m-d'));
			}
		} else {
			$data['individual'] = $this->Quest_model->get_individual_leaderboard($data['periode']->start_periode, $data['periode']->end_periode);
		}

		if($this->input->get('month_clan')) {
			if($this->input->get('month_clan') == 'all') {
				$data['clan'] = $this->Quest_model->get_clan_leaderboard($data['periode']->start_periode, $data['periode']->end_periode);
			} else {
				$dateStart = new DateTime($this->input->get('month_clan'));
				$dateEnd = new DateTime($this->input->get('month_clan'));
				$dateEnd->modify('last day of this month');
				$data['clan'] = $this->Quest_model->get_clan_leaderboard($dateStart->format('Y-m-d'), $dateEnd->format('Y-m-d'));
			}
		} else {
			$data['clan'] = $this->Quest_model->get_clan_leaderboard($data['periode']->start_periode, $data['periode']->end_periode);
		}

		
		// javasript to change tab focus
		$data['js'] .= "
			$(document).ready(function() {
			    // Get the fragment part of the URL
			    var hash = window.location.hash;

			    // Check if the fragment exists and matches the tab you want to activate
			    if (hash) {
			      // Activate the tab
			      $('a[href=\"' + hash.replace('my', '') + '\"]').tab('show');
			    }

			    // Optional: Update the URL when tabs are clicked
			    $('.nav-pills a').on('shown.bs.tab', function (e) {
			      window.location.hash = $(e.target).attr('href').replace('#', '#my');
			    });
			  });
		";

		$data['js'] .= '
		$("#month_individual").change(function() {
	        $("#form_submit_individual").submit();
	    });

	    $("#month_clan").change(function() {
	        $("#form_submit_clan").submit();
	    });
		';

	   	$this->load->view('v_header', $data);
		$this->load->view('leaderboard/v_leaderboard', $data);
		$this->load->view('v_footer', $data);
	}
}