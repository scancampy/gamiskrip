<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Myprofile extends CI_Controller {

	public function __construct() {
		// Check if user cookies exists
		parent::__construct();
		$this->load->helper('cookie');
		if (empty($this->input->cookie('user'))) {
			// Redirect to default controller
			redirect('');
		}
	}

	public function index() {
		$data = array();
		$data['js'] = '';
		$user = $this->input->cookie('user');
		$userjson = json_decode($user);
		$data['setting'] = $this->Setting_model->getSetting();
		$data['userjson'] = $userjson;
		

		if($userjson->user_type == 'student') {
			$data['info'] = $this->Student_model->getStudent(null, $userjson->id);
			if(empty($data['info'])) {
				redirect('notfound');
			}
		} else if($userjson->user_type == 'lecturer') {
			$data['info'] = $this->Lecturer_model->getLecturer(null, $userjson->id);
			if(empty($data['info'])) {
				redirect('notfound');
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

	    if(!empty($this->session->flashdata('type'))) {
	    	$data['js'] .= '
	    		 Toast.fire({
			        icon: \''.$this->session->flashdata('type').'\',
			        title: \''.$this->session->flashdata('message').'.\'
			      });
			    ';
	    }

	   	$this->load->view('v_header', $data);
		$this->load->view('myprofile/v_profile', $data);
		$this->load->view('myprofile/v_profile_home', $data);
		$this->load->view('v_footer', $data);
	}

	public function ubahavatar() {
		$data = array();
		$data['js'] = '';
		$user = $this->input->cookie('user');
		$userjson = json_decode($user);
		$data['setting'] = $this->Setting_model->getSetting();
		$data['userjson'] = $userjson;
		$data['admin'] = false;

		if($userjson->user_type == 'student') {
			$data['info'] = $this->Student_model->getStudent(null, $userjson->id);
			if(empty($data['info'])) {
				redirect('notfound');
			}
		} else if($userjson->user_type == 'lecturer') {
			$data['info'] = $this->Lecturer_model->getLecturer(null, $userjson->id);
			if(empty($data['info'])) {
				redirect('notfound');
			}
		} else if($userjson->user_type == 'admin') {
			$data['admin'] = true;
		}

		$data['avatar_images'] = $this->User_model->getAvatars();

		// toast
		$data['js'] .= '
		var Toast = Swal.mixin({
	      toast: true,
	      position: \'top-end\',
	      showConfirmButton: false,
	      timer: 3000
	    });'; 

	    // select image
	    $data['js'] .= '
	    $(".avatar_img_btn").on("click",function() {
	    	console.log($(this).attr("avatarid"));
	    	$(".avatar_img_btn").css("background-color", "white");
	    	$(this).css("background-color", "red");
	    	var link = $(this).attr("avatarlink");
	    	$("#propic").css("background-image", "url(" + link + ")");
	    	$("#propic").css("background-size", "cover");
	    	$("#propic").css("background-repeat", "no-repeat");

	    	$("#sidebarpropic").css("background-image", "url(" + link + ")");
	    	$("#sidebarpropic").css("background-size", "cover");
	    	$("#sidebarpropic").css("background-repeat", "no-repeat");

	    	$.post("'.base_url('myprofile/updateavatarjson').'",{ avatarid:$(this).attr("avatarid") }, function(data) {
	    		console.log(data);
	    	});
	    });
	    ';

		$this->load->view('v_header', $data);
		$this->load->view('myprofile/v_profile', $data);
		$this->load->view('myprofile/v_avatar', $data);
		$this->load->view('v_footer', $data);
	}

	public function updateavatarjson() {
		$avatarid = $this->input->post('avatarid');
		$user = $this->input->cookie('user');
		$userjson = json_decode($user);

		$filename = $this->User_model->getAvatar($avatarid);
		$this->User_model->updateAvatars($userjson->id, $filename->avatar);

		delete_cookie('user');
		$user = $this->User_model->getUser();
		$this->input->set_cookie('user', json_encode($user), time() + (3600 * 24 * 30)); 
	}

	
}