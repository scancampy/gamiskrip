<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Timeline extends CI_Controller {

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

		if($this->input->post('btnSubmitComment')) {
			$content = htmlspecialchars(trim($this->input->post('content')), ENT_QUOTES, 'UTF-8');
			$content = sanitize_description($content);
			$content = convertEmojisToHtmlEntities($content);

			$this->Timeline_model->insert_timeline($userjson->id, $content);

			$qid = $this->Quest_model->get_user_quest_id('add_timeline', $userjson->id);
        	
    		if($this->Quest_model->check_user_quest('add_timeline', $userjson->id)) {
    			$this->session->set_flashdata('type', 'success');
				$this->session->set_flashdata('message', 'Quest Update Timeline berhasil diselesaikan!');

				$this->session->set_flashdata('trigger_rating', 'Update Timeline '); 
				$this->session->set_flashdata('trigger_quest_id', $qid); 
    		} else {
    			$this->session->set_flashdata('type', 'success');
				$this->session->set_flashdata('message', 'Timeline sukses dibuat');
    		}

			// redirect to read thread
			redirect('timeline');
		}

		$data['timeline'] = $this->Timeline_model->get_timeline_by_chunk(null, 20, null);
		$timezone = new DateTimeZone('Asia/Jakarta');
		
		// toast
		$data['js'] .= '
		var Toast = Swal.mixin({
	      toast: true,
	      position: \'top-end\',
	      showConfirmButton: false,
	      timer: 3000
	    });'; 

	    //load more
		$data['js'] .= "
			function formatChatTimestamp(timestamp) {
			    // Convert the timestamp into a Date object
			    var dateTime = new Date(timestamp);
			    var now = new Date('".date('Y-m-d H:i:s')."');

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
				var filterselected = $('#filter_timeline').val();
				// ajax
				var lasttimestamp = $('#lasttimestamp').val();

				console.log(lasttimestamp);

				$.post('".base_url('timeline/loadtimelinechunks')."', {last:lasttimestamp, filter:filterselected, id:".$userjson->id."}, function(data) {
		        	console.log(data);
		        	var json = JSON.parse(data);
		        	var preparehtml = '';

		        	for(var i =0; i<json.length; i++) {
			        	var name = json[i].fullname;
			        	var id = json[i].id;
			        	var msg = json[i].content;		  
			        	var nrp = json[i].nrp;		        	
			        	var timestamp = json[i].created;
			        	var formatedtimestamp = formatChatTimestamp(timestamp);
			        	var avatar_image_url = json[i].avatar_image_url;

			        	if(i == json.length-1) {
		        			$('#lasttimestamp').val(timestamp);
		        		}

			        	preparehtml += '<div class=\"card\">';
  						preparehtml += '<div class=\"card-body\">';
    					preparehtml += '<div class=\"post\">';
  						preparehtml += '<div class=\"user-block d-flex mb-0\">';

                        if(avatar_image_url != '') {
                        	preparehtml += '<div class=\"img-circle img-bordered-sm\" id=\"sidebarpropic\" style=\"width:2.1em; height: 2.1em; border-radius: 50%; margin-left: auto; margin-right: auto; background: url(\'' + avatar_image_url + '?background=255,255,255\');  background-size: 270%; background-position: center 20%; background-color: gray; margin-left:0px; margin-right:0px;  background-repeat: no-repeat;  margin-left: 0px; margin-right: 0px;\"></div>';
                        } else {
                        	preparehtml += '<img class=\"img-circle img-bordered-sm\" src=\"".base_url('images/assets/propic_blank.jpg')."\" alt=\"user image\">';
                        }

                        preparehtml += ' <div class=\"d-flex flex-column\"><div class=\"d-flex flex-row  align-items-center\"><span class=\"username ml-3\" ><a href=\"".base_url('myprofile')."/' + nrp + '\">' + name + '</a></span><span class=\"description\" style=\"margin-left:15px !important;\">' + formatedtimestamp + '</span></div><div class=\"ml-3\">';

                        preparehtml += msg;
                        preparehtml += '</div></div></div></div></div></div>';
			        }
			        $('#chat_container').append(preparehtml);

		        });
			});
		";



	    // char left
	    $data['js'] .= '
	    	const maxChars = 140;

	    	function calculateCharLeft() {
	    		// Get the current length of the input
		        const currentLength = $("#content").val().length;

		        // Calculate the remaining characters
		        const charsLeft = maxChars - currentLength;

		        // Update the character left message
		        $("#charleft").text(charsLeft + " characters left");

		        // Optional: Change color if limit is reached
		        if (charsLeft < 0) {
		            $("#charleft").css("color", "red"); // Change to red if over limit
		        } else {
		            $("#charleft").css("color", "black"); // Reset to black
		        }
	    	}

	    	$("#content").on("input", function() {
		        calculateCharLeft();
		    });
	    ';

	    // timeline select
	    $data['js'] .= "
	    	$(\"#filter_timeline\").on(\"change\", function(data) {
	    		var filterselected =  $(this).val();
	    		// ajax
				var lasttimestamp = null;

				console.log(lasttimestamp);

				$.post('".base_url('timeline/loadtimelinechunks')."', {last:lasttimestamp, filter:filterselected, id:".$userjson->id."}, function(data) {
		        	console.log(data);
		        	var json = JSON.parse(data);
		        	var preparehtml = '';

		        	for(var i =0; i<json.length; i++) {
			        	var name = json[i].fullname;
			        	var id = json[i].id;
			        	var msg = json[i].content;		  
			        	var nrp = json[i].nrp;		        	
			        	var timestamp = json[i].created;
			        	var formatedtimestamp = formatChatTimestamp(timestamp);
			        	var avatar_image_url = json[i].avatar_image_url;

			        	if(i == json.length-1) {
		        			$('#lasttimestamp').val(timestamp);
		        		}

			        	preparehtml += '<div class=\"card\">';
  						preparehtml += '<div class=\"card-body\">';
    					preparehtml += '<div class=\"post\">';
  						preparehtml += '<div class=\"user-block d-flex mb-0\">';

                        if(avatar_image_url != '') {
                        	preparehtml += '<div class=\"img-circle img-bordered-sm\" id=\"sidebarpropic\" style=\"width:2.1em; height: 2.1em; border-radius: 50%; margin-left: auto; margin-right: auto; background: url(\'' + avatar_image_url + '?background=255,255,255\');  background-size: 270%; background-position: center 20%; background-color: gray; margin-left:0px; margin-right:0px;  background-repeat: no-repeat;  margin-left: 0px; margin-right: 0px;\"></div>';
                        } else {
                        	preparehtml += '<img class=\"img-circle img-bordered-sm\" src=\"".base_url('images/assets/propic_blank.jpg')."\" alt=\"user image\">';
                        }

                        preparehtml += ' <div class=\"d-flex flex-column\"><div class=\"d-flex flex-row  align-items-center\"><span class=\"username ml-3\" ><a href=\"".base_url('myprofile')."/' + nrp + '\">' + name + '</a></span><span class=\"description\" style=\"margin-left:15px !important;\">' + formatedtimestamp + '</span></div><div class=\"ml-3\">';

                        preparehtml += msg;
                        preparehtml += '</div></div></div></div></div></div>';
			        }
			        $('#lasttimestamp').val(json[json.length-1].created);
			        $('#chat_container').html(preparehtml);

		        });
	    	});
	    ";

	    // insert emoji
	    $data['js'] .= '
	    	$(".btn-insert-emoji").on("click", function() {
	    		var code = $(this).attr("code");
	    		//console.log(code);
	    		//const codePoint = code.codePointAt(0);
    			//const htmlEntity = `&#${codePoint};`;

	    		//console.log(htmlEntity);
	    		var textarea = $("#content");
        		var cursorPos = textarea.prop("selectionStart");
		        var textBefore = textarea.val().substring(0, cursorPos);
		        var textAfter = textarea.val().substring(cursorPos, textarea.val().length);
		        textarea.val(textBefore + code + textAfter);
		        textarea.focus();
		        textarea.prop("selectionStart", cursorPos + code.length);
		        textarea.prop("selectionEnd", cursorPos + code.length);
		        $("#modal-emoji").modal("hide");
		        calculateCharLeft();
	    	});
	    ';

	    if(!empty($this->session->flashdata('trigger_rating'))) {
	    	$data['js'] .= '
	    		// random show modal
      			var randomNumber = Math.random() < 0.5 ? 0 : 1;

      			console.log("trigger rating = '.$this->session->flashdata('trigger_rating').'")

      			if(randomNumber == 1) {
	      			$("#labelquest").html("Selamat, quest '.$this->session->flashdata('trigger_rating').' berhasil diselesaikan. Berapa ratingmu untuk quest ini?");
	      			console.log("label quest" + $("#labelquest").html());
					$("#qid").val('.$this->session->flashdata('trigger_quest_id').');
					$("#modal-quest-rating").modal("show");
				}
			';
	    }

	    if(!empty($this->session->flashdata('type'))) {
	    	$data['js'] .= '
	    		 Toast.fire({
			        icon: \''.$this->session->flashdata('type').'\',
			        title: \''.$this->session->flashdata('message').'.\'
			      });
			    ';
	    }

	   	$this->load->view('v_header', $data);
		$this->load->view('timeline/v_timeline', $data);
		$this->load->view('v_footer', $data);
	}

	public function loadtimelinechunks() {
		$lasttimestamp = $this->input->post('last');
		$filter = $this->input->post('filter');
		$id = $this->input->post('id');
		$where = null;

		if($filter == "me") {
			$where = "timeline.user_id = ".$id;
		}
		$result = $this->Timeline_model->get_timeline_by_chunk($where, 20, $lasttimestamp);

		echo json_encode($result);
	}	
}