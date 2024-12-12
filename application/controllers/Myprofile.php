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

		if(oboarding_check()) {
			$this->session->set_flashdata('showonboarding', 'true');	
		} 
	}

	public function index() {
		redirect('myprofile/ubahavatar');
	}


	public function viewprofile($nrp = null) {
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
		}

		if($nrp == null) {
			redirect('notfound');
		}

		$data['student'] = $this->Student_model->getStudent($nrp);

		if(count($data['student']) == 0) {
			redirect('notfound');
		} else {
			$data['user'] = $this->User_model->getUser(null, "id=".$data['student'][0]->user_id);
			$data['tugasakhir'] = $this->Thesis_model->getStudentThesis(null,$data['student'][0]->user_id);
			$data['acts'] = $this->Setting_model->getActs();
			$data['clan'] = $this->Clan_model->get_clan_by_user($data['student'][0]->user_id);
			//find periode date
			$periode = $this->Setting_model->get_active_periode();
			$data['quest'] = $this->Quest_model->get_finished_quest($data['student'][0]->user_id, "user_quest.quest_created_date >= '".$periode->start_periode."' AND user_quest.quest_created_date <= '".$periode->end_periode."'");
			$data['timeline'] = $this->Timeline_model->get_timeline_by_chunk("timeline.user_id = ".$data['student'][0]->user_id, 5);	

			$data['achievements'] = $this->Quest_model->getUserAchievements($data['student'][0]->user_id);

			// check achievement
			$this->User_model->check_visit_profile_achievement($userjson->id);		
		}

		// datatable
	    $data['js'] .= '
	    $("#quest_table").DataTable({
	      "paging": true,
	      "lengthChange": false,
	      "searching": false,
	      "ordering": true,
	      "info": true,
	      "autoWidth": false,
	      "responsive": true,
	    });';

	    $data['js'] .= '
		var Toast = Swal.mixin({
	      toast: true,
	      position: \'top-end\',
	      showConfirmButton: false,
	      timer: 3000
	    });'; 


	    // cek quest
	    $qid = $this->Quest_model->get_user_quest_id('view_profile', $userjson->id);
        	
		if($this->Quest_model->check_user_quest('view_profile', $userjson->id)) {
			$data['js'] .= '
				Toast.fire({
			    	icon: "success",
			   		title: "Quest View Friends Profile berhasil diselesaikan!"
		   		});

		   		console.log("cek");

				// random show modal
      			var randomNumber = Math.random() < 0.5 ? 0 : 1;

      			if(randomNumber == 1) {
      				console.log("num " + randomNumber);
	      			$("#labelquest").html("Selamat, quest lihat profil teman berhasil diselesaikan. Berapa ratingmu untuk quest ini?");
	      			console.log($("#labelquest").html());
					$("#qid").val('.$qid.');
					$("#modal-quest-rating").modal("show");
				}
			';
		}

		$this->load->view('v_header', $data);
		$this->load->view('myprofile/v_view_profile', $data);
		$this->load->view('v_footer', $data);
	}

	public function ubahpassword() {
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

		if($this->input->post('btnsubmit')) {
			if ($this->input->post('btnsubmit') === 'submit') {
            
	            // Get the POST values for password fields
	            $oldpass = $this->input->post('oldpass');
	            $newpass = $this->input->post('newpass');
	            $repass  = $this->input->post('repass');

	            // Check if new password is empty
	            if (empty($newpass)) {
	                // Set flashdata notification for empty new password
	                $this->session->set_flashdata('notif', 'Password baru tidak boleh kosong');
	                $this->session->set_flashdata('type', 'warning');
	                // Redirect back to the form
	                redirect('myprofile/ubahpassword');
	            }

	            // Check if the new password and repeat password do not match
	            if ($newpass !== $repass) {
	                // Set flashdata notification for password mismatch
	                $this->session->set_flashdata('notif', 'Password baru dan ulangi password tidak sama');
	                $this->session->set_flashdata('type', 'warning');
	                // Redirect back to the form
	                redirect('myprofile/ubahpassword');
	            }

	            // If passwords match and not empty, proceed with updating the password
	            // (Implement the password update logic here)
	            if($this->User_model->change_password($userjson->id, $oldpass, $newpass)) {
	            	$this->session->set_flashdata('notif', 'Password sukses diubah');
	                $this->session->set_flashdata('type', 'success');
	            } else {
	            	$this->session->set_flashdata('notif', 'Password lama tidak sesuai');
	                $this->session->set_flashdata('type', 'warning');
	            }
	            redirect('myprofile/ubahpassword');
	        }
		}

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
			        title: \''.$this->session->flashdata('notif').'.\'
			      });
			    ';
	    }

		$this->load->view('v_header', $data);
		$this->load->view('myprofile/v_profile', $data);
		$this->load->view('myprofile/v_ubah_password', $data);
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

		// cek apakah user_id_avatar null
		$getuser = $this->User_model->getUser($userjson->email);
		$data['infouser'] = $getuser;
		//print_r($getuser);
		$useridavatar = null;

		if($getuser->user_id_avatar == null) {
			// Initialize cURL session
			$ch = curl_init();

			// Set the URL
			curl_setopt($ch, CURLOPT_URL, "https://api.readyplayer.me/v1/users");

			// Set the HTTP method to POST
			curl_setopt($ch, CURLOPT_POST, true);

			// Set the HTTP headers
			$headers = [
			    'x-api-key: sk_live_EpoYUuayEgxDPztOANQF6D-ZDv4Qvxvrhk9_',
			    'Content-Type: application/json'
			];
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

			// Set the request body
			$datauser = [
			    'data' => [
			        'applicationId' => '669f66b2b5f7920ddaf59964'
			    ]
			];
			curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($datauser));

			// Return the response instead of printing it
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

			// Execute the cURL request
			$response = curl_exec($ch);

			// Check for errors
			if (curl_errno($ch)) {
			    echo 'Error:' . curl_error($ch);
			} else {
			    // Decode the response (assuming it's JSON)
			    $decodedResponse = json_decode($response, true);
			    // Print the response
			    // Access and echo the "id"
			    if (isset($decodedResponse['data']['id'])) {
			        //echo 'ID: ' . $decodedResponse['data']['id'];
			        $this->User_model->updateAvatarID($userjson->id, $decodedResponse['data']['id']);

			        $useridavatar = $decodedResponse['data']['id'];
			    } 
			}

			// Close cURL session
			curl_close($ch);
			//die();
		} else {
			$useridavatar = $getuser->user_id_avatar;
		}

		// Initialize cURL session
		$token = null;
		$ch = curl_init();

		// Define the URL with query parameters
		$partner = 'gamiskrip';
		$url = "https://api.readyplayer.me/v1/auth/token?userId={$useridavatar}&partner={$partner}";


		// Set the URL
		curl_setopt($ch, CURLOPT_URL, $url);

		// Set the HTTP method to GET
		curl_setopt($ch, CURLOPT_HTTPGET, true);

		// Set the HTTP headers
		$headers = [
		    'x-api-key: sk_live_EpoYUuayEgxDPztOANQF6D-ZDv4Qvxvrhk9_',
		    'Content-Type: application/json'
		];
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

		// Return the response instead of printing it
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		// Execute the cURL request
		$response = curl_exec($ch);

		// Check for errors
		if (curl_errno($ch)) {
		    echo 'Error:' . curl_error($ch);
		} else {
		    // Decode the response (assuming it's JSON)
		    $decodedResponse = json_decode($response, true);		    
		    $token = $decodedResponse['data']['token'];

		    
		}

		// Close cURL session
		curl_close($ch);
			

		// toast
		$data['js'] .= '
			var Toast = Swal.mixin({
		      toast: true,
		      position: \'top-end\',
		      showConfirmButton: false,
		      timer: 3000
		    });'; 

		    // ready player me avatar
		    $data['js'] .= '
		    const subdomain = "gamiskrip"; // Replace with your custom subdomain
	        const frame = document.getElementById("frame");

	        frame.src = `https://${subdomain}.readyplayer.me/avatar?frameApi&token='.$token.'`;

	        window.addEventListener("message", subscribe);
	        document.addEventListener("message", subscribe);

	        function subscribe(event) {
	            const json = parse(event);

	            if (json?.source !== "readyplayerme") {
	                return;
	            }

	            // Susbribe to all events sent from Ready Player Me once frame is ready
	            if (json.eventName === "v1.frame.ready") {
	                frame.contentWindow.postMessage(
	                    JSON.stringify({
	                        target: "readyplayerme",
	                        type: "subscribe",
	                        eventName: "v1.**"
	                    }),
	                    "*"
	                );
	            }

	            if(json.eventName == "v1.user.authorized") {
	            	console.log(`console log: ${json.data}`);
	            }

	            // Get avatar GLB URL
	            if (json.eventName === "v1.avatar.exported") {
	                console.log(`Avatar URL: ${json.data.url}`);
	                $.post("'.base_url('myprofile/updateavatar').'", {avatarid:json.data.url}, function(data) {
	                	console.log(data);

	                	$.post("'.base_url('myprofile/check_quest_changeavatar').'", {}, function(data) {
				        	console.log("ceklike:" + data);

				        	var obj = JSON.parse(data);
				        	Toast.fire({
							        icon: "success",
							        title: "Quest change avatar berhasil diselesaikan!"
							      });

				        	if(obj.quest_title != null) {
				      			// random show modal
				      			var randomNumber = Math.random() < 0.5 ? 0 : 1;

				      			if(randomNumber == 1) {
					      			$("#labelquest").html("Selamat, quest " + obj.quest_title + " berhasil diselesaikan. Berapa ratingmu untuk quest ini?");
					      			console.log($("#labelquest").html());
		    						$("#qid").val(obj.quest_id);
		    						$("#modal-quest-rating").modal("show");
		    					}
					      	}
				        });
	                });
	            }

	            // Get user id
	            if (json.eventName === "v1.user.set") {
	                console.log(`User with id ${json.data.id} set: ${JSON.stringify(json)}`);
	            }
	        }

	        function parse(event) {
	            try {
	                return JSON.parse(event.data);
	            } catch (error) {
	                return null;
	            }
	        }

	        $(document).ready(function() {
				document.getElementById("frame").hidden = false;
	        }); 
	    ';

	    // select image
	    $data['js'] .= '
	    	function update_avatar() {
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

		    	
	    	}

	    	$(\'[data-cy="save-button"]\').on(\'click\', function() {
			    // Your click event logic here
			    console.log(\'Button clicked!\');

			    update_avatar();
			});

			$(".avatar_img_btn").on("click",function() {
	    		update_avatar();
	    	});
	    ';

		$this->load->view('v_header', $data);
		$this->load->view('myprofile/v_profile', $data);
		$this->load->view('myprofile/v_avatar3', $data);
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

	// ajax call
	public function updateavatar() {
		$avatarid = $this->input->post('avatarid');
		$newUrl = str_replace('.glb', '.png', $avatarid);
		$user = $this->input->cookie('user');
		$userjson = json_decode($user);

		$this->User_model->updateAvatarImageURL($userjson->id, $newUrl);
		echo json_encode(array("result" => "OK"));
	}
	
	public function check_quest_changeavatar() {
		$user = $this->input->cookie('user');
		$userjson = json_decode($user);
		$qid = $this->Quest_model->get_user_quest_id('changeavatar', $userjson->id);

		if($this->Quest_model->check_user_quest('changeavatar', $userjson->id)) {
			echo json_encode(array("result" => "OK", "quest_title" => 'Change Avatar', "quest_id" => $qid));
		} else {
			echo json_encode(array("result" => "OK"));
		}
	}
}