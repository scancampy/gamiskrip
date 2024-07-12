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
	}

	public function index() {
		redirect('notfound');
	}

	public function read($id = null) {
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

		

		// load thread data
		$data['thread'] = $this->Diskusi_model->getThread($id);

		if($this->input->post('btnSubmit')) {
			$this->Diskusi_model->replyThread($id, $this->input->post('content'), $userjson->id);
			$this->session->set_flashdata('type', 'success');
			$this->session->set_flashdata('message', 'Balasan diskusi sukses dibuat');

			// redirect to read thread
			redirect('diskusi/read/'.$id.'/'.url_title($data['thread']->thread_title));
		}

		$data['files'] = $this->Diskusi_model->getThreadFiles($id);
		// breadcrumb
		$data['arraybreadcrumb'] = array();
		$this->Diskusi_model->createBreadcrumbFolder($data['thread']->parent_folder_id, $data['arraybreadcrumb']);

		// thread read
		$this->Diskusi_model->insertThreadRead($id, $userjson->id);

		// thread reply
		$data['thread_reply'] = $this->Diskusi_model->getThreadReply($id);
	
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

	   	$this->load->view('v_header', $data);
		$this->load->view('diskusi/v_diskusi_read', $data);
		$this->load->view('v_footer', $data);
	}

	public function new($parent_folder_id = null) {
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
			
			$id = $this->Diskusi_model->insertThread($thread_title, $content, $userjson->id, $parent_folder_id, $is_locked);

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


			$this->session->set_flashdata('type', 'success');
			$this->session->set_flashdata('message', 'Diskusi sukses dibuat');

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

		// thread read
		$data['reads'] = array();
		foreach ($data['threads'] as $key => $value) {
			$data['reads'][] = $this->Diskusi_model->checkThreadRead($value->id, $userjson->id);
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

	
}