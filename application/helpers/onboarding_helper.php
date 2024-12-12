<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function oboarding_check() {
	$CI = get_instance();
	$label = $CI->uri->uri_string();
    $CI->load->database();

    $query = $CI->db->get_where('master_onboarding', array('url' => $label));
	if($query->num_rows() > 0 ) {
		$user = $CI->input->cookie('user');
		$userjson = json_decode($user);
		$hquery = $query->row();
		$q = $CI->db->get_where('user_onboarding', array('user_id' =>$userjson->id, 'onboarding_id' => $hquery->id));

		if($q->num_rows() > 0) {
			return false;
		} else {
			$data = array('user_id' => $userjson->id, 'onboarding_id' => $hquery->id);
			$CI->db->insert('user_onboarding', $data);
			return true;
		}
	}
}	