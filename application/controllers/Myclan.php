<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Myclan extends CI_Controller {

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

	public function viewclan($clanid = null, $clanname = null) {
		$data = array();
		$data['js'] = '';
		$user = $this->input->cookie('user');
		$userjson = json_decode($user);
		$data['setting'] = $this->Setting_model->getSetting();
		$data['userjson'] = $userjson;
		$data['admin'] = false;
		$data['clanid'] = $clanid;
		$data['clanname'] = $clanname;

		if($userjson->user_type == 'student') {
			$data['info'] = $this->Student_model->getStudent(null, $userjson->id);
			if(empty($data['info'])) {
				redirect('notfound');
			}
		} else {
			redirect('notfound');
		}

		$data['clan'] = $this->Clan_model->get_clan_by_id($clanid);
		if(count($data['clan']) == 0) {
			redirect('notfound');
		}

		$data['clan_members'] = $this->Clan_model->get_users_by_clan($clanid);
		$this->Clan_model->check_visit_clan_achievement($userjson->id);

		$this->load->view('v_header', $data);
		$this->load->view('myclan/v_view_clan', $data);
		$this->load->view('v_footer', $data);
	}

	public function index() {
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
		} else {
			redirect('notfound');
		}

		// cek apakah sudah tergabung di dalam clan. jika belum dimasukkan ke clan
		$this->Clan_model->assign_user_to_clan($userjson->id);

		// get clan info
		$data['clan'] = $this->Clan_model->get_clan_by_user($userjson->id);
		$data['clan_members'] = $this->Clan_model->get_users_by_clan($data['clan']->id);
		$data['chat'] = $this->Clan_model->get_clan_chat_by_chunk($data['clan']->id, 20, null);
		$periode = $this->Setting_model->get_active_periode();
			
		$data['quest'] = $this->Quest_model->get_clan_finished_quest($data['clan']->id, "user_quest.quest_created_date >= '".$periode->start_periode."' AND user_quest.quest_created_date <= '".$periode->end_periode."'");	
		

		// cek comment
		if($this->input->post('comment')) {
			$this->Clan_model->insert_clan_chat($data['clan']->id, $userjson->id, $this->input->post('comment'));
			$qid = $this->Quest_model->get_user_quest_id('add_clan_chat', $userjson->id);
        	
    		if($this->Quest_model->check_user_quest('add_clan_chat', $userjson->id)) {
    			$this->session->set_flashdata('type', 'success');
				$this->session->set_flashdata('message', 'Quest clan chat berhasil diselesaikan!');

				$this->session->set_flashdata('trigger_rating', 'Clan Chat '); 
				$this->session->set_flashdata('trigger_quest_id', $qid); 
    		} else {
    			$this->session->set_flashdata('type', 'success');
				$this->session->set_flashdata('message', 'Chat terikirim');
    		}

			redirect('myclan#tab_2');
		}

		$data['js'] = "
			function submitOnEnter(event) {
			    if (event.key === 'Enter') {
			        event.preventDefault();  // Prevents form submission if not handled manually
			        event.target.form.submit();  // Submits the form manually
			    }
			}
		";

		if(!empty($this->session->flashdata('trigger_rating'))) {
	    	$data['js'] .= '
	    		// random show modal
      			var randomNumber = Math.random() < 0.5 ? 0 : 1;
	    		//var randomNumber = 1;
      			console.log("trigger rating = '.$this->session->flashdata('trigger_rating').'")

      			if(randomNumber == 1) {
	      			$("#labelquest").html("Selamat, quest '.$this->session->flashdata('trigger_rating').' berhasil diselesaikan. Berapa ratingmu untuk quest ini?");
	      			console.log($("#labelquest").html());
					$("#qid").val('.$this->session->flashdata('trigger_quest_id').');
					$("#modal-quest-rating").modal("show");
				}
			';
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

		// like
		$data['js'] .= "
			$('body').on('click', '.likebutton', function(e) {
		        e.preventDefault(); // Prevent the default anchor behavior

		        var chatId = $(this).attr('chatid'); // Get the chat ID from the attribute
		        var likeButton = $(this);

		        $.post('".base_url('myclan/likechat')."', {id:chatId}, function(data) {
		        	console.log(data);
		        	var likeCount = data; // Get the number of likes from the response

	                // Update the like count before the icon
	                likeButton.html('<i class=\"far fa-thumbs-up mr-1\"></i> ' + likeCount + ' Likes');
		        });

		        $.post('".base_url('myclan/check_quest_likechatclan')."', {}, function(data) {
		        	console.log('ceklike:' + data);

		        	var obj = JSON.parse(data);
		        	Toast.fire({
					        icon: 'success',
					        title: 'Quest like chat berhasil diselesaikan!'
					      });

		        	if(obj.quest_title != null) {
		        		

		      			// random show modal
		      			var randomNumber = Math.random() < 0.5 ? 0 : 1;
		      			//randomNumber=1;

		      			if(randomNumber == 1) {
			      			$('#labelquest').html('Selamat, quest ' + obj.quest_title + ' berhasil diselesaikan. Berapa ratingmu untuk quest ini?');
    						$('#qid').val(obj.quest_id);
    						$('#modal-quest-rating').modal('show');
    					}
			      	}
		        });	        
		    });
		";

		//load more
		$data['js'] .= "
			function formatChatTimestamp(timestamp) {
			    // Convert the timestamp into a Date object
			    var dateTime = new Date(timestamp);
			    var now = new Date();

			    // Calculate the difference between now and the timestamp in milliseconds
			    var diff = Math.abs(now - dateTime);

			    // Calculate the time difference in various units
			    var seconds = Math.floor(diff / 1000);
			    var minutes = Math.floor(seconds / 60);
			    var hours = Math.floor(minutes / 60);
			    var days = Math.floor(hours / 24);
			    var months = Math.floor(days / 30);
			    var years = Math.floor(months / 12);

			    // Determine the appropriate time difference
			    if (years > 0) {
			        return years + ' year' + (years > 1 ? 's' : '') + ' ago';
			    }
			    if (months > 0) {
			        return months + ' month' + (months > 1 ? 's' : '') + ' ago';
			    }
			    if (days > 0) {
			        return days + ' day' + (days > 1 ? 's' : '') + ' ago';
			    }
			    if (hours > 0) {
			        return hours + ' hour' + (hours > 1 ? 's' : '') + ' ago';
			    }
			    if (minutes > 0) {
			        return minutes + ' minute' + (minutes > 1 ? 's' : '') + ' ago';
			    }
			    if (seconds >= 0) {
			        return 'just now';
			    }

			    // If the timestamp is from today, display the time
			    if (now.toDateString() === dateTime.toDateString()) {
			        return dateTime.toLocaleTimeString('en-US', { hour: 'numeric', minute: 'numeric', hour12: true }) + ' today';
			    }

			    // Fallback if the time is too old
			    return 'long time ago';
			}


			$('#loadmore').on('click', function() {
				// ajax
				var lasttimestamp = $('#lasttimestamp').val();
				var clanid = '".$data['clan']->id."';

				console.log(lasttimestamp);

				$.post('".base_url('myclan/loadchatchunks')."', {last:lasttimestamp, id:clanid}, function(data) {
		        	console.log(data);
		        	var json = JSON.parse(data);
		        	var preparehtml = '';

		        	for(var i =json.length-1; i>=0; i--) {

			        	var name = json[i].fullname;
			        	var id = json[i].id;
			        	var msg = json[i].message;		  
			        	var nrp = json[i].nrp;		        	
			        	var timestamp = json[i].timestamp;
			        	var formatedtimestamp = formatChatTimestamp(timestamp);
			        	var like_count = json[i].like_count;
			        	var avatar_image_url = json[i].avatar_image_url;

			        	if(i == json.length-1) {
		        			$('#lasttimestamp').val(timestamp);
		        		}

			        	preparehtml += '<div class=\"post\" style=\"padding-bottom: 0px;\">';
                        preparehtml += '<div class=\"user-block d-flex justify-content-start mb-0\" >';

                        if(avatar_image_url != '') {
                        	preparehtml += '<div class=\"img-circle img-bordered-sm\" id=\"sidebarpropic\" style=\" width:2.1em; height: 2.1em; border-radius: 50%; margin-left: auto; margin-right: auto;  background: url(\'' + avatar_image_url + '?background=255,255,255\');  background-size: 270%; background-position: center 20%; background-color: gray; margin-left:0px; margin-right:0px;  background-repeat: no-repeat;  margin-left: 0px; margin-right: 0px;\"></div>';
                        } else {
                        	preparehtml += '<img class=\"img-circle img-bordered-sm\" src=\"".base_url('images/assets/propic_blank.jpg')."\" alt=\"user image\">';
                        }

                        preparehtml += '<div class=\"d-flex flex-column\">';
                        preparehtml += '<span class=\"username\" style=\"margin-left:15px !important;\"><a href=\"".base_url('myprofile')."/' + nrp + '\">' + name + '</a></span>';
                        preparehtml += '<span class=\"description\" style=\"margin-left:15px !important;\">' + formatedtimestamp + '</span>';

                        preparehtml += '</div></div><p>' + msg + '<br/>';
                        preparehtml += '<a href=\"#\" class=\"link-black text-sm likebutton\" chatid=\"' + id + '\"><i class=\"far fa-thumbs-up mr-1\"></i>';

                        if(like_count > 0) {
                        	preparehtml += like_count + ' Likes';
                        } else {                        	
                        	preparehtml += 'Like';
                        }
                        preparehtml += '</p></a></div>';

			        }
			        $('#chat_container').prepend(preparehtml);

		        });
			});
		";

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
		$this->load->view('myclan/v_clan_home', $data);
		$this->load->view('v_footer', $data);
	}	

	// ajax call section
	public function likechat() {
		$user = $this->input->cookie('user');
		$userjson = json_decode($user);
		$result = $this->Clan_model->toggle_like_chat($this->input->post('id'), $userjson->id);

		echo $result;
	}

	public function check_quest_likechatclan() {
		$user = $this->input->cookie('user');
		$userjson = json_decode($user);
		$qid = $this->Quest_model->get_user_quest_id('liking_clan_chat', $userjson->id);

		if($this->Quest_model->check_user_quest('liking_clan_chat', $userjson->id)) {
			echo json_encode(array("result" => "OK", "quest_title" => 'Like Chat Clan', "quest_id" => $qid));
		} else {
			echo json_encode(array("result" => "OK"));
		}
	}

	public function loadchatchunks() {
		$lasttimestamp = $this->input->post('last');
		$result = $this->Clan_model->get_clan_chat_by_chunk($this->input->post('id'), 20, $lasttimestamp);

		echo json_encode($result);
	}
	
	// end ajax call

	
}