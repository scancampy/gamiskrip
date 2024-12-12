<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Diskusi extends CI_Controller {

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
		redirect('notfound');
	}

	public function read($id = null, $title=null, $offset = 0) {
		$data = array();
		$data['js'] = '';
		$user = $this->input->cookie('user');
		$userjson = json_decode($user);
		$data['setting'] = $this->Setting_model->getSetting();
		$data['userjson'] = $userjson;
		$data['admin'] = false;

		$this->load->library('pagination');

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

		

		// load thread data
		$data['thread'] = $this->Diskusi_model->getThread($id);
		if(count($data['thread']) == 0) {
			redirect('notfound');
		}

		// reply discussion
		if($this->input->post('btnSubmit')) {
			$content = htmlspecialchars(trim($this->input->post('content')), ENT_QUOTES, 'UTF-8');

			$content = sanitize_description($content);

			$content = convertEmojisToHtmlEntities($content);

			/*$json = json_encode($content);
		    $json = preg_replace_callback('/\\\\u([0-9a-fA-F]{4})/', function ($match) {
		        return '&#' . hexdec($match[1]) . ';';
		    }, $json);*/

		   // print_r($json);
		   // die();
			$this->Diskusi_model->replyThread($id, $content, $userjson->id);

			$qid = $this->Quest_model->get_user_quest_id('reply_post', $userjson->id);
			$quest_complete = false;
        	
    		if($this->Quest_model->check_user_quest('reply_post', $userjson->id)) {
    			$this->session->set_flashdata('type', 'success');
				$this->session->set_flashdata('message', 'Quest reply post berhasil diselesaikan!');

				$this->session->set_flashdata('trigger_rating', 'Reply Post '); 
				$this->session->set_flashdata('trigger_quest_id', $qid); 
				$quest_complete = true;
    		} 

    		$qid = $this->Quest_model->get_user_quest_id('reply_post_ask_for_help', $userjson->id);
        	
    		if($this->Quest_model->check_user_quest('reply_post_ask_for_help', $userjson->id)) {
    			$this->session->set_flashdata('type', 'success');
				$this->session->set_flashdata('message', 'Quest bantu teman di ruang diskusi berhasil diselesaikan!');

				$this->session->set_flashdata('trigger_rating', 'Reply Post Ask for Help '); 
				$this->session->set_flashdata('trigger_quest_id', $qid); 
				$quest_complete = true;	
    		} 

    		$qid = $this->Quest_model->get_user_quest_id('reply_post_share_knowledge', $userjson->id);
        	
    		if($this->Quest_model->check_user_quest('reply_post_share_knowledge', $userjson->id)) {
    			$this->session->set_flashdata('type', 'success');
				$this->session->set_flashdata('message', 'Quest bantu teman di ruang diskusi berhasil diselesaikan!');

				$this->session->set_flashdata('trigger_rating', 'Reply Post Share Knowledge '); 
				$this->session->set_flashdata('trigger_quest_id', $qid); 
				$quest_complete = true;	
    		} 

    		$qid = $this->Quest_model->get_user_quest_id('reply_post_share_work_in_progress', $userjson->id);
        	
    		if($this->Quest_model->check_user_quest('reply_post_share_work_in_progress', $userjson->id)) {
    			$this->session->set_flashdata('type', 'success');
				$this->session->set_flashdata('message', 'Quest bantu teman di ruang diskusi berhasil diselesaikan!');

				$this->session->set_flashdata('trigger_rating', 'Reply Post Share Work in Progress '); 
				$this->session->set_flashdata('trigger_quest_id', $qid); 
				$quest_complete = true;	
    		} 

    		if(!$quest_complete) {
    			$this->session->set_flashdata('type', 'success');
				$this->session->set_flashdata('message', 'Balasan diskusi sukses dibuat');
    		}

			
			// redirect to read thread
			redirect('diskusi/read/'.$id.'/'.url_title($data['thread']->thread_title));
		}

		/*if($this->input->post('btnSubmit')) {
			$this->Diskusi_model->replyThread($id, $this->input->post('content'), $userjson->id);
			$this->session->set_flashdata('type', 'success');
			$this->session->set_flashdata('message', 'Balasan diskusi sukses dibuat');

			// redirect to read thread
			redirect('diskusi/read/'.$id.'/'.url_title($data['thread']->thread_title));
		}*/

		$data['files'] = $this->Diskusi_model->getThreadFiles($id);
		// breadcrumb
		$data['arraybreadcrumb'] = array();
		$this->Diskusi_model->createBreadcrumbFolder($data['thread']->parent_folder_id, $data['arraybreadcrumb']);

		// thread read
		$this->Diskusi_model->insertThreadRead($id, $userjson->id);

		// thread reply

		$config['base_url'] = base_url('diskusi/read/'.$id.'/'.$title.'/');
		$config['total_rows'] = $this->Diskusi_model->countAllReply($id);
		$config['per_page'] = 10;
		$config['full_tag_open'] = '<ul class="pagination pagination-sm m-0 ">';
		$config['full_tag_close'] = '</ul>';
		$config['num_tag_open'] = '<li class="page-item">';
		$config['num_tag_close'] = '</li>';
		$config['attributes'] = array('class' => 'page-link');
		$config['cur_tag_open'] = '<li class="page-item"><a href="#" class="page-link bg-primary">';
		$config['cur_tag_close'] = '</a></li>';

		$data['thread_reply'] = $this->Diskusi_model->getThreadReply($id, $config['per_page'], $offset);

		$this->pagination->initialize($config);

		$data['paging'] = $this->pagination->create_links();
	
		// toast
		$data['js'] .= '
		var Toast = Swal.mixin({
	      toast: true,
	      position: \'top-end\',
	      showConfirmButton: false,
	      timer: 3000
	    });';

	    // button like
	    $data['js'] .= '
	    $(".btnlikes").on("click", function() {
	    	var id = $(this).attr("threadid");
	    	console.log(id);

	    	$.post("'.base_url('diskusi/likethread').'", { threadid:id }, function(data) {
	    		var json = JSON.parse(data);
	    		$("#numlikes_" + id).html(json.num_likes);
	    	});

	    	$.post("'.base_url('diskusi/check_quest_likepost').'", {}, function(data) {
	        	console.log("ceklike:" + data);

	        	var obj = JSON.parse(data);
	        	Toast.fire({
				        icon: "success",
				        title: "Quest like post berhasil diselesaikan!"
				      });

	        	if(obj.quest_title != null) {
	      			// random show modal
	      			var randomNumber = Math.random() < 0.5 ? 0 : 1;
	      			//randomNumber =1;

	      			if(randomNumber == 1) {
		      			$("#labelquest").html("Selamat, quest " + obj.quest_title + " berhasil diselesaikan. Berapa ratingmu untuk quest ini?");
		      			console.log($("#labelquest").html());
						$("#qid").val(obj.quest_id);
						$("#modal-quest-rating").modal("show");
					}
		      	}
	        });
	    });';

	    // button likes reply
	    $data['js'] .= '
	    $(".btnlikesreply").on("click", function() {
	    	var id = $(this).attr("threadid");
	    	console.log(id);

	    	$.post("'.base_url('diskusi/likethreadreply').'", { threadid:id }, function(data) {
	    		var json = JSON.parse(data);
	    		$("#numlikesreply_" + id).html(json.num_likes);
	    	});

	    	$.post("'.base_url('diskusi/check_quest_likepost').'", {}, function(data) {
	        	console.log("ceklike:" + data);

	        	var obj = JSON.parse(data);
	        	Toast.fire({
				        icon: "success",
				        title: "Quest like post berhasil diselesaikan!"
				      });

	        	if(obj.quest_title != null) {
	      			// random show modal
	      			var randomNumber = Math.random() < 0.5 ? 0 : 1;
	      			//randomNumber =1;

	      			if(randomNumber == 1) {
		      			$("#labelquest").html("Selamat, quest " + obj.quest_title + " berhasil diselesaikan. Berapa ratingmu untuk quest ini?");
						$("#qid").val(obj.quest_id);
						$("#modal-quest-rating").modal("show");
					}
		      	}
	        });
	    });';

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

	    	});
	    ';

	    //summernote
	    $data['js'] .= '
	    	// Summernote
    		$("#summernote").summernote({  height: 200 });
    	';

	    if(!empty($this->session->flashdata('type'))) {
	    	$data['js'] .= '
	    		 Toast.fire({
			        icon: \''.$this->session->flashdata('type').'\',
			        title: \''.$this->session->flashdata('message').'.\'
			      });
			    ';
	    }

	    if(!empty($this->session->flashdata('trigger_rating'))) {
	    	$data['js'] .= '
	    		// random show modal
      			var randomNumber = Math.random() < 0.5 ? 0 : 1;
	    		//var randomNumber = 1;
      			console.log("trigger rating = '.$this->session->flashdata('trigger_rating').'")

      			console.log("num " + randomNumber);
      			if(randomNumber == 1) {
      				console.log("num " + randomNumber);
	      			$("#labelquest").html("Selamat, quest '.$this->session->flashdata('trigger_rating').' berhasil diselesaikan. Berapa ratingmu untuk quest ini?");
	      			console.log($("#labelquest").html());
					$("#qid").val('.$this->session->flashdata('trigger_quest_id').');
					$("#modal-quest-rating").modal("show");
				}
			';
	    }

	   	$this->load->view('v_header', $data);
		$this->load->view('diskusi/v_diskusi_read', $data);
		$this->load->view('v_footer', $data);
	}

	public function baru($parent_folder_id = null) {
		$data = array();
		$data['js'] = '';
		$user = $this->input->cookie('user');
		$userjson = json_decode($user);
		$data['setting'] = $this->Setting_model->getSetting();
		$data['userjson'] = $userjson;
		$data['admin'] = false;
		
		//print_r($userjson);
		if($parent_folder_id == null) { $data['parent_folder_id'] = ''; }
		else {	$data['parent_folder_id'] = $parent_folder_id;	}

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

		// handle submit
		if($this->input->post('btnsubmit')) {
			$thread_title = trim($this->input->post('thread_title'));
			$content = trim($this->input->post('content'));
			$is_locked = 0;

			if($this->input->post('is_locked')) {
				$is_locked = 1;
			}
			
			$id = $this->Diskusi_model->insertThread($thread_title, $content, $userjson->id, $parent_folder_id, $this->input->post('thread_type'), $is_locked);

			// handle files
			$filename = array();
			$judulfile = array();

        	for($i = 1; $i <= $this->input->post('hidjumlah'); $i++) {
        		if ($_FILES['files'.$i]['error'] != 4) {
        			// cek file first
					$config['upload_path']          = './uploads/diskusi/';
		            $config['allowed_types']        = 'pdf|docx|doc|csv|xls|xlsx|txt|jpg|jpeg|png';
		            $config['max_size']             = 10000;
		            $config['file_ext_tolower']		= TRUE;
		            $config['encrypt_name']			= TRUE;

		            $this->load->library('upload', $config);

		            if(!$this->upload->do_upload('files'.$i)) {
		            	//echo $this->upload->display_errors();
		            	//$this->session->set_flashdata('notif','error');
						//$this->session->set_flashdata('msg', $this->upload->display_errors());
						//redirect('diskusi/new');
		            } else {
		            	$filename[] = $this->upload->data('file_name');
		            	$judulfile[] = $this->input->post('file_titles'.$i); 
		            }
        		} 
        	}

        	// insert files into db
        	foreach ($filename as $key => $value) {
        		$this->Diskusi_model->insertThreadFiles($id, $filename[$key], $judulfile[$key]);
        	}


        	$quest_detected = false;

        	// cek quest terkait ask for help
        	if($this->input->post('thread_type') == 'add_post_share_work_in_progress') {
        		$qid = $this->Quest_model->get_user_quest_id('add_post_share_work_in_progress', $userjson->id);
        	
        		if($this->Quest_model->check_user_quest('add_post_share_work_in_progress', $userjson->id)) {
        			$this->session->set_flashdata('type', 'success');
					$this->session->set_flashdata('message', 'Quest share WIP berhasil diselesaikan!');

					$this->session->set_flashdata('trigger_rating', 'Share Work in Progress '); 
					$this->session->set_flashdata('trigger_quest_id', $qid); 
					$quest_detected = true;
        		} else {
        			$this->session->set_flashdata('type', 'success');
					$this->session->set_flashdata('message', 'Diskusi sukses dibuat');
        		}
        	} else if($this->input->post('thread_type') == 'add_post_ask_for_help') {
        		$qid = $this->Quest_model->get_user_quest_id('add_post_ask_for_help', $userjson->id);
        	
        		if($this->Quest_model->check_user_quest('add_post_ask_for_help', $userjson->id)) {
        			$this->session->set_flashdata('type', 'success');
					$this->session->set_flashdata('message', 'Quest Ask for Help berhasil diselesaikan!');

					$this->session->set_flashdata('trigger_rating', 'Ask for Help '); 
					$this->session->set_flashdata('trigger_quest_id', $qid); 
					$quest_detected = true;
        		} else {
        			$this->session->set_flashdata('type', 'success');
					$this->session->set_flashdata('message', 'Diskusi sukses dibuat');
        		}
        	} else if($this->input->post('thread_type') == 'add_post_share_knowledge') {
        		$qid = $this->Quest_model->get_user_quest_id('add_post_share_knowledge', $userjson->id);
        	
        		if($this->Quest_model->check_user_quest('add_post_share_knowledge', $userjson->id)) {
        			$this->session->set_flashdata('type', 'success');
					$this->session->set_flashdata('message', 'Quest Share Knowledge berhasil diselesaikan!');

					$this->session->set_flashdata('trigger_rating', 'Share Knoweldge '); 
					$this->session->set_flashdata('trigger_quest_id', $qid);
					$quest_detected = true; 
        		} else {
        			$this->session->set_flashdata('type', 'success');
					$this->session->set_flashdata('message', 'Diskusi sukses dibuat');
        		}
        	}       

        	if($quest_detected == false) {
	    		$qid = $this->Quest_model->get_user_quest_id('add_post', $userjson->id);
	    	
	    		if($this->Quest_model->check_user_quest('add_post', $userjson->id)) {
	    			$this->session->set_flashdata('type', 'success');
					$this->session->set_flashdata('message', 'Quest Add Post berhasil diselesaikan!');

					$this->session->set_flashdata('trigger_rating', 'Add Post '); 
					$this->session->set_flashdata('trigger_quest_id', $qid); 
	    		} else {
	    			$this->session->set_flashdata('type', 'success');
					$this->session->set_flashdata('message', 'Diskusi sukses dibuat');
	    		}
	    	}
        			

			// redirect to read thread
			redirect('diskusi/read/'.$id.'/'.url_title($thread_title));
		}

		// toast
		$data['js'] .= '
		var Toast = Swal.mixin({
	      toast: true,
	      position: \'top-end\',
	      showConfirmButton: false,
	      timer: 3000
	    });'; 

	    //summernote
	    $data['js'] .= '
	    	// Summernote
    		$("#summernote").summernote({  height: 300 });
    	';

    	//variables
    	$data['js'] .= '
    		var numfiles = 0;
    	';

    	// add button files
    	$data['js'] .= '
    		$("#btnaddfiles").on("click", function() {
    			if(numfiles ==0) {
	    			$("#tbody_files").html("");
	    		}

    			numfiles++;
    			$("#hidjumlah").val(numfiles);
    			var str = "<tr>" +
                            "<td><div class=\"row\"><div class=\"col-4\"><input type=\"file\" class=\"form-control\" name=\"files" + numfiles + "\"/></div><div class=\"col-8\"><input type=\"text\" class=\"form-control\" placeholder=\"Tulis nama file\" name=\"file_titles" + numfiles + "\"/></div></div></td>" + 
                            "<td><a id=\"delfiles\" class=\"btn btn-xs btn-danger\"><i class=\"fas fa-trash\"></i> Hapus</a></td>" +
                          "</tr>";
    			$("#tbody_files").append(str);
    		});
    	';

    	// del files
    	$data['js'] .= '
    		$("body").on("click", "#delfiles", function() { 
    			console.log("del");
    			$(this).closest("tr").remove();
    			//realnumfiles--;
    			//$("#hidjumlah").val(numfiles);

    			if(numfiles == 0) {
    				$("#tbody_files").html("<tr><td colspan=\"2\">Belum ada file</td></tr>");
    			}
    		});
    	';


	    if(!empty($this->session->flashdata('type'))) {
	    	$data['js'] .= '
	    		 Toast.fire({
			        icon: \''.$this->session->flashdata('type').'\',
			        title: \''.$this->session->flashdata('message').'.\'
			      });
			    ';
	    }



	   	$this->load->view('v_header', $data);
		$this->load->view('diskusi/v_diskusi_new', $data);
		$this->load->view('v_footer', $data);
	}

	public function home($parent_folder_id = null) {
		$data = array();
		$data['js'] = '';
		$user = $this->input->cookie('user');
		$userjson = json_decode($user);
		$data['setting'] = $this->Setting_model->getSetting();
		$data['userjson'] = $userjson;
		$data['admin'] = false;
		
		//print_r($userjson);
		if($parent_folder_id == null) { $data['parent_folder_id'] = ''; }
		else {	$data['parent_folder_id'] = $parent_folder_id;	}

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

		// content
		$data['diskusi_folder'] = $this->Diskusi_model->getFolder($parent_folder_id);
		$data['arraybreadcrumb'] = array();
		$this->Diskusi_model->createBreadcrumbFolder($parent_folder_id, $data['arraybreadcrumb']);
	
		// thread
		$data['threads'] = $this->Diskusi_model->getThreadList($parent_folder_id);
		$data['num_of_reply'] = array();

		// thread read
		$data['reads'] = array();
		foreach ($data['threads'] as $key => $value) {
			$data['reads'][] = $this->Diskusi_model->checkThreadRead($value->id, $userjson->id);
			$data['num_of_reply'][] = $this->Diskusi_model->get_num_of_reply($value->id);
		}

		if($this->input->post('btnsubmit')) {
			// cek harus admin
			if($data['admin'] == true) {
				$folder_title = trim($this->input->post('folder_title'));
				$notes = trim($this->input->post('notes'));
				$this->Diskusi_model->insertFolder($folder_title, $notes,$userjson->id, $parent_folder_id);

				$this->session->set_flashdata('type', 'success');
				$this->session->set_flashdata('message', 'Folder ruang diskusi berhasil dibuat');

				if($parent_folder_id != null) {
					redirect('diskusi/home/'.$parent_folder_id);
				} else {
					redirect('diskusi/home');
				}
			} else {
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

	    // data table
	    $data['js'] .= '
	    $("#commontable").DataTable({
	      "responsive": true, "lengthChange": false, "autoWidth": false,
	    });
	    ';

	    // bs modal
	    $data['js'] .= '
	    	$("#modal-lg").on("shown.bs.modal", function() {
			  $("#folder_title").focus();
			})
	    ';

	    if(!empty($this->session->flashdata('type'))) {
	    	$data['js'] .= '
	    		 Toast.fire({
			        icon: \''.$this->session->flashdata('type').'\',
			        title: \''.$this->session->flashdata('message').'.\'
			      });
			    ';
	    }

	   	$this->load->view('v_header', $data);
		$this->load->view('diskusi/v_diskusi_home', $data);
		$this->load->view('v_footer', $data);
	}

	// ajax call section
	public function likethread() {
		$user = $this->input->cookie('user');
		$userjson = json_decode($user);
		$result = $this->Diskusi_model->updateLikes($this->input->post('threadid'), $userjson->id);
		echo json_encode(array("result" => "OK", "num_likes" => $result));
	}

	public function check_quest_likepost() {
		$user = $this->input->cookie('user');
		$userjson = json_decode($user);
		$qid = $this->Quest_model->get_user_quest_id('liking_post', $userjson->id);

		if($this->Quest_model->check_user_quest('liking_post', $userjson->id)) {
			echo json_encode(array("result" => "OK", "quest_title" => 'Like Post', "quest_id" => $qid));
		} else {
			echo json_encode(array("result" => "OK"));
		}
	}

	public function likethreadreply() {
		$user = $this->input->cookie('user');
		$userjson = json_decode($user);
		$result = $this->Diskusi_model->updateLikesReply($this->input->post('threadid'), $userjson->id);
		echo json_encode(array("result" => "OK", "num_likes" => $result));
	}
	// end ajax call

	
}