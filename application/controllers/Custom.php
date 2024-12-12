<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Custom extends CI_Controller {

	public function __construct() {
		// Check if user cookies exists
		parent::__construct();
		
	}

	public function cron() {
		$this->Quest_model->get_individual_top_leaderboard_months();
		$this->Quest_model->get_clan_top_leaderboard_months();
		$this->Quest_model->generateQuestAllUser();
	}

	public function testemail() {
		echo $this->Setting_model->sendemail('andre@staff.ubaya.ac.id', 'Judul', 'Test isi');
	}
}