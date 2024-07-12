<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Tugasakhir extends CI_Controller {

	public function __construct() {
		// Check if user cookies exists
		parent::__construct();
		$this->load->helper('cookie');
		if (empty($this->input->cookie('user'))) {
			// Redirect to default controller
			redirect('');
		}
	}

	public function logbimbinganku($idskripsi) {
		$data = array();
		$data['js'] = '';

		$data['setting'] = $this->Setting_model->getSetting();
		$user = $this->input->cookie('user');
		$userjson = json_decode($user);
		$data['userjson'] = $userjson;

		// check if lecturer
		if($userjson->user_type!='lecturer') {
			redirect('notfound');
		}

		if($this->input->post('btnkirim')) {
			$this->Thesis_model->insertKomentar($this->input->post('idlogs'), $userjson->id, $this->input->post('komentar')); 
			

			$this->session->set_flashdata('notif','success');
			$this->session->set_flashdata('msg', 'Tanggapan sukses tersimpan');
			redirect('tugasakhir/logbimbinganku/'.$idskripsi);
		}

		// get tugas akhir
		$data['tugasakhir'] = $this->Thesis_model->getStudentThesis($idskripsi);
		if(!$data['tugasakhir']) {
			redirect('notfound');
		}

		$data['filelogs'] = array();
		// get bimbingan
		if($data['tugasakhir']) {
			$data['infobox'] = $this->load->view('tugasakhir/v_box_info_tugasakhir', $data, TRUE);
			$data['logs'] = $this->Thesis_model->getLogBimbingan($data['tugasakhir'][0]->id);

			foreach ($data['logs'] as $key => $value) {
				$data['filelogs'][$key] = $this->Thesis_model->getLogBimbinganFiles($value->id);
				$data['komentar'][$key] = $this->Thesis_model->getKomentar($value->id);
			}

			$data['komentar_user'] = array();

			foreach ($data['komentar'] as $key => $value) {
				foreach ($value as $keyd => $valued) {
					if($valued->user_type == 'lecturer') {
						$data['komentar_user'][$key][$keyd] = $this->Lecturer_model->getLecturer(null, $valued->user_id);
					} else if($valued->user_type == 'student') {
						$data['komentar_user'][$key][$keyd] = $this->Student_model->getStudent(null, $valued->user_id);
					}
				}
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

	    if(!empty($this->session->flashdata('notif'))) {
	    	$data['js'] .= '
	    		 Toast.fire({
			        icon: \''.$this->session->flashdata('notif').'\',
			        title: \''.$this->session->flashdata('msg').'.\'
			      });
			    ';
	    }

		$this->load->view('v_header', $data);
		$this->load->view('tugasakhir/v_log_bimbinganku', $data);
		$this->load->view('v_footer', $data);
	}

	public function logbimbingan() {
		$data = array();
		$data['js'] = '';

		$data['setting'] = $this->Setting_model->getSetting();
		$user = $this->input->cookie('user');
		$userjson = json_decode($user);
		$data['userjson'] = $userjson;

		if($this->input->post('btnkirim')) {
			$this->Thesis_model->insertKomentar($this->input->post('idlogs'), $userjson->id, $this->input->post('komentar')); 
			

			$this->session->set_flashdata('notif','success');
			$this->session->set_flashdata('msg', 'Tanggapan sukses tersimpan');
			redirect('tugasakhir/logbimbingan');
		}

		// get tugas akhir
		$data['tugasakhir'] = $this->Thesis_model->getStudentThesis(null, $userjson->id, array('tugas_akhir.is_deleted' => 0, 'tugas_akhir.is_active' => 1));

		$data['filelogs'] = array();
		// get bimbingan
		if($data['tugasakhir']) {
			$data['logs'] = $this->Thesis_model->getLogBimbingan($data['tugasakhir'][0]->id);
			$data['infobox'] = $this->load->view('tugasakhir/v_box_info_tugasakhir', $data, TRUE);

			foreach ($data['logs'] as $key => $value) {
				$data['filelogs'][$key] = $this->Thesis_model->getLogBimbinganFiles($value->id);
				$data['komentar'][$key] = $this->Thesis_model->getKomentar($value->id);
			}

			$data['komentar_user'] = array();

			foreach ($data['komentar'] as $key => $value) {
				foreach ($value as $keyd => $valued) {
					if($valued->user_type == 'lecturer') {
						$data['komentar_user'][$key][$keyd] = $this->Lecturer_model->getLecturer(null, $valued->user_id);
					} else if($valued->user_type == 'student') {
						$data['komentar_user'][$key][$keyd] = $this->Student_model->getStudent(null, $valued->user_id);
					}
				}
			}
		}
		$data['perihal'] = $this->Perihal_logs_model->get();

		if($this->input->post('btnsubmit') && $data['tugasakhir']) {
			$filename = array();
			$judulfile = array();

			// Iterate through each file
        	for($i = 1; $i <= $this->input->post('jumlahupload'); $i++) {
        		if ($_FILES['file'.$i]['error'] != 4) {
        			// cek file first
					$config['upload_path']          = './uploads/logbimbingan/';
		            $config['allowed_types']        = 'pdf|docx|doc|csv|xls|xlsx|txt|jpg|jpeg|png';
		            $config['max_size']             = 2000;
		            $config['file_ext_tolower']		= TRUE;
		            $config['encrypt_name']			= TRUE;

		            $this->load->library('upload', $config);

		            if(!$this->upload->do_upload('file'.$i)) {
		            	$this->session->set_flashdata('notif','error');
						$this->session->set_flashdata('msg', $this->upload->display_errors());
						redirect('tugasakhir/logbimbingan');
		            } else {
		            	$filename[] = $this->upload->data('file_name');
		            	$judulfile[] = $this->input->post('filetext'.$i); 
		            }
        		}
        	}
        
			$insertid = $this->Thesis_model->insertLogBimbingan($this->input->post('judul'), $this->input->post('keterangan'), $this->input->post('link_file'), $this->input->post('perihal'), $data['tugasakhir'][0]->id);

			foreach($filename as $key => $value) {
				$this->Thesis_model->insertLogBimbinganFiles($insertid, $judulfile[$key],  $value);
			}
			$this->session->set_flashdata('notif','success');
			$this->session->set_flashdata('msg', 'Log bimbingan sukses tersimpan');
			redirect('tugasakhir/logbimbingan');
		}

		

		// tambah file
		$data['js'] .= '
		var numfile = 1;
		$("#morefile").on("click", function() {

			numfile++;
			var str = "<div class=\"form-group\">" +
              "<label for=\"file" + numfile + "\">Upload File #" + numfile + "</label>" +
              "<input type=\"text\" placeholder=\"Tuliskan judul file\" name=\"filetext" + numfile + "\" class=\"form-control\" />" +
              "<input type=\"file\" accept=\".pdf, .docx, .doc, .csv, .xls, .xlsx, .txt, .jpg, .jpeg, .png\"  class=\"form-control\" name=\"file" + numfile + "\" id=\"file" + numfile + "\" >" +
              "<small id=\"file" + numfile + "\" class=\"form-text text-muted\">Max. 2MB. Ekstensi yang diperbolehkan pdf, docx, doc, csv, xls, xlsx, txt, jpg, jpeg, dan png</small></div>";

            $("#filecontainer").append(str);
            $("#jumlahupload").val(numfile);
		});	
		';

		// reset modal
		$data['js'] .= '
			$("#modal-default").on("shown.bs.modal", function () {
		        console.log("modal shown");
		        $(this).find("input[type=\"text\"], textarea").val("");
		        var file_upload_container_default = "<div class=\"form-group\">
              <label for=\"file1\">Upload File #1</label>" +
              "<input type=\"text\" name=\"filetext1\" placeholder=\"Tuliskan judul file\" class=\"form-control\" />" +              
              "<input type=\"file\" accept=\".pdf, .docx, .doc, .csv, .xls, .xlsx, .txt, .jpg, .jpeg, .png\"  class=\"form-control\" name=\"file1\" id=\"file1\" >" +
              "<small id=\"file1\" class=\"form-text text-muted\">Max. 2MB. Ekstensi yang diperbolehkan pdf, docx, doc, csv, xls, xlsx, txt, jpg, jpeg, dan png</small></div>";

              $("#filecontainer").html(file_upload_container_default);
              numfile =1;
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

	    // data table
	    $data['js'] .= '
	    $("#commontable").DataTable({
	      "responsive": true, "lengthChange": false, "autoWidth": false,
	    });
	    ';

	    if(!empty($this->session->flashdata('notif'))) {
	    	$data['js'] .= '
	    		 Toast.fire({
			        icon: \''.$this->session->flashdata('notif').'\',
			        title: \''.$this->session->flashdata('msg').'.\'
			      });
			    ';
	    }

		
		$this->load->view('v_header', $data);
		$this->load->view('tugasakhir/v_log_bimbingan', $data);
		$this->load->view('v_footer', $data);
	}

	public function weeklyplanner() {
		$data = array();
		$data['js'] = '';

		$data['setting'] = $this->Setting_model->getSetting();
		$user = $this->input->cookie('user');
		$userjson = json_decode($user);
		$data['userjson'] = $userjson;

		$data['tugasakhir'] = $this->Thesis_model->getStudentThesis(null, $userjson->id, array('tugas_akhir.is_deleted' => 0, 'tugas_akhir.is_active' => 1));

		if(count($data['tugasakhir']) == 0) {
			redirect('notfound');
		} else {
			$data['infobox'] = $this->load->view('tugasakhir/v_box_info_tugasakhir', $data, TRUE);

			$data['weeklyplan'] = $this->Thesis_model->get_weekly_plans($userjson->id, $data['tugasakhir'][0]->id);

			if($this->input->post('btnsubmit')) {
				$this->Thesis_model->insert_weekly_plan($userjson->id, $data['tugasakhir'][0]->id, $this->input->post('week_start'), $this->input->post('week_end'), $this->input->post('judul'), 0);

				$this->session->set_flashdata('notif','success');
				$this->session->set_flashdata('msg', 'Weekly plan sukses tersimpan');
				redirect('tugasakhir/weeklyplanner');	
			}
		}

		// handle plus button
		$data['js'] .= '
			$(".btnplus").on("click",function() {
				var weekstart = $(this).attr("weekstart");
				var weekend = $(this).attr("weekend");
				var tugasakhirid = $(this).attr("tugasakhirid");
				var pekan = $(this).attr("pekan");

				$("#tugas_akhir_id").val(tugasakhirid);
				$("#week_start").val(weekstart);
				$("#week_end").val(weekend);
				$("#pekan").val(pekan);
			});
		';

		// focus on judul when bootstrap modal shown
		$data['js'] .= '
		  $("#modal-default").on("shown.bs.modal", function () {
		    $("#name").focus();
		    $("#judul").val("");
		  });';

		// handle del plan
		$data['js'] .= '
			$("body").on("click",".plandel", function(e) {
				if(confirm("Yakin hapus plan ini?")) {
					var plandel = $(this);
					$.post("'.base_url('tugasakhir/delplan').'", { planid: $(this).attr("idplan") }, function(data) {
						var obj = JSON.parse(data);
						if(obj.result == "OK") {
							console.log("OK");
							 plandel.closest(".row").remove();
						}
					});
				}
			});
		';

		// handle checkbox by ajax
		$data['js'] .= '
			$("body").on("click",".checkplan", function(e) {
				var checkplan = $(this);
				$.post("'.base_url('tugasakhir/checkplan').'", { planid: $(this).attr("idplan") }, function(data) {
					var obj = JSON.parse(data);
					if(obj.result == "OK") {
						console.log("OK");
						checkplan.prop("disabled", true);
						checkplan.closest(".row").find(".plandel").remove();
					}
				});
				
			});
		';

		// handle edit by ajax
		$data['js'] .= '
			$("body").on("click", ".editplan", function() {
				$.post("'.base_url('tugasakhir/getplan').'", { planid: $(this).attr("idplan") }, function(data) {
					var obj = JSON.parse(data);
					if(obj.result == "OK") {
						var id = obj.data.id;
						var plan = obj.data.plan;
						$("#juduledit").val(plan);
						$("#planid").val(id);
					}
				});
			});
		';

		// handle submit edit plan by ajax
		$data['js'] .= '
			$("#btnedit").on("click", function() {
				$.post("'.base_url('tugasakhir/editplan').'", { planid: $("#planid").val(), judul: $("#juduledit").val() }, function(data) {
					var obj = JSON.parse(data);
					if(obj.result == "OK") {
						Toast.fire({
			        		icon: "success",
			        		title: "Weekly plan sukses tersimpan"
			      		});
			      		$("#modal-edit").modal("hide");
			      		$("#plandisplay-" + $("#planid").val()).html($("#juduledit").val());
					}
				});
			});
		';

		// handle submit by ajax
		$data['js'] .= '
			$("#btnsubmit").on("click", function(e) {
				e.preventDefault();				

				$.post("'.base_url('tugasakhir/submitweeklyplan').'", { judul: $("#judul").val(), tugasakhirid: $("#tugas_akhir_id").val(), week_start: $("#week_start").val(), week_end: $("#week_end").val() }, function(data) {
					var obj = JSON.parse(data);
					if(obj.result == "OK") {
						var id=obj.lastid;
						Toast.fire({
			        		icon: "success",
			        		title: "Weekly plan sukses tersimpan"
			      		});

			      		var pekan = $("#pekan").val();
			      		console.log(pekan);

			      		var renderhtml = "<div class=\"row justify-content-between pb-2 pt-2\" style=\"border-bottom: 1px solid lightgray;\"><span>" + $("#judul").val() + "</span><div><i class=\"fas fa-trash text-muted plandel\" idplan=\"" + id + "\" ></i>&nbsp;&nbsp;<input type=\"checkbox\" class=\"checkplan\" idplan=\"" + id + "\"/></div></div>";

			      		$(".renderplan-" + pekan).append(renderhtml);

			      		$("#modal-default").modal("hide");

					}
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

	     if(!empty($this->session->flashdata('notif'))) {
	    	$data['js'] .= '
	    		 Toast.fire({
			        icon: \''.$this->session->flashdata('notif').'\',
			        title: \''.$this->session->flashdata('msg').'.\'
			      });
			    ';
	    }


		$this->load->view('v_header', $data);
		$this->load->view('tugasakhir/v_weekly_planner', $data);
		$this->load->view('v_footer', $data);
	}

	public function validasi($id = null) {
		$data = array();
		$data['js'] = '';

		$data['setting'] = $this->Setting_model->getSetting();
		$user = $this->input->cookie('user');
		$userjson = json_decode($user);

		// check if lecturer
		if($userjson->user_type!='lecturer') {
			redirect('notfound');
		}

		if($id != null) {
			if($this->Thesis_model->validateThesis($id, $userjson->id)) {
				$this->session->set_flashdata('notif','success');
				$this->session->set_flashdata('msg', 'Tugas akhir sukses divalidasi');
				redirect('tugasakhir/validasi');	
			}
		}

		$data['tugasakhir'] = $this->Thesis_model->getStudentThesis(null, null, '(tugas_akhir.lecturer1_id = '.$userjson->id.' OR tugas_akhir.lecturer2_id = '.$userjson->id.')', 'tanggal_st', 'desc');

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

	    if(!empty($this->session->flashdata('notif'))) {
	    	$data['js'] .= '
	    		 Toast.fire({
			        icon: \''.$this->session->flashdata('notif').'\',
			        title: \''.$this->session->flashdata('msg').'.\'
			      });
			    ';
	    }

		
		$this->load->view('v_header', $data);
		$this->load->view('tugasakhir/v_tugas_akhir_validasi', $data);
		$this->load->view('v_footer', $data);
	}

	public function bimbinganku() {
		$data = array();
		$data['js'] = '';
		$data['setting'] = $this->Setting_model->getSetting();
		$user = $this->input->cookie('user');
		$userjson = json_decode($user);

		// check if lecturer
		if($userjson->user_type!='lecturer') {
			redirect('notfound');
		}

		$data['userjson'] = $userjson;

		$data['tugasakhir'] = $this->Thesis_model->getStudentThesis(null, null," (l1.user_id = '".$userjson->id."' OR l2.user_id = '".$userjson->id."') ");

		// data table
	    $data['js'] .= '
	    $("#commontable").DataTable({
	      "responsive": true, "lengthChange": false, "autoWidth": false,
	    });
	    ';

	    // load data 
	    $data['js'] .= '
	    $(".btndetilbimbingan").on("click", function () {
	    	// ajax load
	    	var targetid = $(this).attr("targetid");
	    	console.log("target" + targetid);
	    	$.post("'.base_url('tugasakhir/getbimbingandetil').'",{id:targetid},function(data) {
	    		console.log(data);
	    		var json = $.parseJSON(data);
	    		$("#dd-judul").html(json[0].judul);
	    		$("#dd-mhs").html(json[0].fullname + " (" + json[0].nrp +  ")");
	    		$("#dd-dosbing1").html(json[0].f1);
	    		$("#dd-dosbing2").html(json[0].f2);
	    		$("#dd-proposal").html("<a href=\'" + json[0].proposal_url + "\' target=\'_blank\' class=\'btn btn-xs btn-info\'>buka link</a>");

	    		var dateString = json[0].tanggal_st;
				var parts = dateString.split("-");
				var formattedDate = parts[2] + "-" + parts[1] + "-" + parts[0];
	    		$("#dd-tanggal-st").html(formattedDate);

	    		var dateString = json[0].tanggal_akhir_st;
				var parts = dateString.split("-");
				var formattedDate = parts[2] + "-" + parts[1] + "-" + parts[0];
	    		$("#dd-masa-berlaku-st").html(formattedDate);

	    		var compareDate = new Date(parts[0], parts[1] - 1, parts[2]); 
				var today = new Date();

				if (compareDate < today) {
					$("#dd-status").html("<span class=\'badge badge-danger\' >ST Berakhir</span>");
					$("#btnvalidasi").hide();
				} else if(json[0].is_active == 0) {
	    			$("#dd-status").html("<span class=\'badge badge-secondary\' >Menunggu Approval Dosbing</span>");
	    			$("#btnvalidasi").show();
	    		} else {
	    			$("#dd-status").html("<span class=\'badge badge-primary\' >Aktif</span>");
	    			$("#btnvalidasi").hide();
	    		}
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

	    if(!empty($this->session->flashdata('notif'))) {
	    	$data['js'] .= '
	    		 Toast.fire({
			        icon: \''.$this->session->flashdata('notif').'\',
			        title: \''.$this->session->flashdata('msg').'.\'
			      });
			    ';
	    }

		$this->load->view('v_header', $data);
		$this->load->view('tugasakhir/v_bimbinganku', $data);
		$this->load->view('v_footer', $data);

	}

	public function index() {
		$data = array();
		$data['js'] = '';
		$data['setting'] = $this->Setting_model->getSetting();
		$user = $this->input->cookie('user');
		$userjson = json_decode($user);


		// check if lecturer
		if($userjson->user_type!='student') {
			redirect('notfound');
		}

		$data['userjson'] = $userjson;

		// read submit
		if($this->input->post('btnsubmit')) {
			// validate the input
			$this->load->library('form_validation');
			$this->form_validation->set_rules('judul', 'Judul', 'required', array('required' => '%s wajib diisi.'));
			$this->form_validation->set_rules('lecturer1_id', 'Dosen Pembimbing 1', 'required', array('required' => '%s wajib diisi.'));
			$this->form_validation->set_rules('lecturer2_id', 'Dosen Pembimbing 2', 'required', array('required' => '%s wajib diisi.'));
			$this->form_validation->set_rules('proposal_url', 'Link Proposal', 'required|valid_url', array('required' => '%s wajib diisi.', 'valid_url' => '%s tidak valid.'));
			
			$error = '';

			if ($this->form_validation->run() == FALSE)
            {   
            	$this->session->set_flashdata('notif', 'error');
            	$this->session->set_flashdata('msg', validation_errors());
            	redirect('tugasakhir');
            } else {
            	
            	// dosbing tidak boleh kosong dan tidak boleh kembar
            	if($this->input->post('lecturer1_id') == '-') {
            		$error = 'Dosbing 1 harus dipilih';
            	}
            	if($this->input->post('lecturer2_id') == '-') {
            		$error = 'Dosbing 2 harus dipilih';
            	}
            	if($this->input->post('lecturer1_id') == $this->input->post('lecturer2_id')) {
            		$error = 'Dosbing 1 & 2 harus berbeda';
            	}
            }

			$judul = trim($this->input->post('judul'));
			$lecturer1_id = $this->input->post('lecturer1_id');
			$lecturer2_id = $this->input->post('lecturer2_id');
			$tanggal_st = $this->input->post('tanggal_st');
			$tanggal_akhir_st = $this->input->post('tanggal_akhir_st');
			$proposal_url = $this->input->post('proposal_url');
			// Create a DateTime object from the input date string
			$converted_tanggal_st = DateTime::createFromFormat('d/m/Y', $tanggal_st);

			if ($converted_tanggal_st) {
			    $tanggal_st = $converted_tanggal_st->format('Y-m-d');
			} else {
			    $error =  "Tanggal tidak valid";
			}

			$converted_tanggal_akhir_st = DateTime::createFromFormat('d/m/Y', $tanggal_akhir_st);

			if ($converted_tanggal_akhir_st) {
			    $tanggal_akhir_st = $converted_tanggal_akhir_st->format('Y-m-d');
			    // Check if $tanggal_akhir_st is lower than $tanggal_st
			    if ($tanggal_akhir_st < $tanggal_st) {
			        $error = "Tanggal akhir harus lebih besar dari tanggal awal";
			    }
			} else {
			    $error =  "Tanggal tidak valid";
			}

			// cek error
			if($error != '') {
				$this->session->set_flashdata('notif', 'error');
            	$this->session->set_flashdata('msg', $error);
            	redirect('tugasakhir');
			}

			// save
			//echo $judul.'<br/>'.$userjson->id.'<br/>'.$lecturer1_id.'<br/>'.$lecturer2_id.'<br/>'.$proposal_url.'<br/>'.$tanggal_st.'<br/>'.$tanggal_akhir_st;
			//die();
			$this->Thesis_model->insertThesis($judul, $userjson->id, $lecturer1_id, $lecturer2_id, $proposal_url, $tanggal_st, $tanggal_akhir_st);

			$this->session->set_flashdata('notif','success');
			$this->session->set_flashdata('msg', 'Tugas akhir sukses ditambahkan');

			redirect('tugasakhir');
		}

		// get lecturer
		$data['lecturers'] = $this->Lecturer_model->getLecturer(null,null,array('is_deleted' => 0), 'fullname', 'asc');

		// get tugas akhir
		$data['tugasakhir'] = $this->Thesis_model->getStudentThesis(null, $userjson->id, array('tugas_akhir.is_deleted' => 0));
		
		
		// toast
		$data['js'] .= '
		var Toast = Swal.mixin({
	      toast: true,
	      position: \'top-end\',
	      showConfirmButton: false,
	      timer: 3000
	    });'; 

	    // date mask
	    $data['js'] .= '
	    	//Datemask dd/mm/yyyy
    		$("#datemask").inputmask("dd/mm/yyyy", { "placeholder": "dd/mm/yyyy" });

    		//Datemask dd/mm/yyyy
    		$("#datemask2").inputmask("dd/mm/yyyy", { "placeholder": "dd/mm/yyyy" });
	    ';

	    // data table
	    $data['js'] .= '
	    $("#commontable").DataTable({
	      "responsive": true, "lengthChange": false, "autoWidth": false,
	    });
	    ';

	    // js auto add 6 month from selected date
	    $data['js'] .= '
	    	$("#datemask").keyup(function() {
	    		var input = $(this).val();
	    		var datePattern = /^\d{2}\/\d{2}\/\d{4}$/;
		        if (datePattern.test(input)) {
		            var input = new Date(input.split("/").reverse().join("-"));
		            
		            // Add 6 months to the input date
		            input.setMonth(input.getMonth() + 6);
		            
		            // Format the date as "dd/mm/yyyy"
		            var newInput = input.getDate() + "/" + (input.getMonth() + 1) + "/" + input.getFullYear();
		            
		            $("#datemask2").val(newInput);
		        } 
	    	});
	    ';

	    if(!empty($this->session->flashdata('notif'))) {
	    	$data['js'] .= '
	    		 Toast.fire({
			        icon: \''.$this->session->flashdata('notif').'\',
			        title: \''.$this->session->flashdata('msg').'.\'
			      });
			    ';
	    }

	   	$this->load->view('v_header', $data);
		$this->load->view('tugasakhir/v_tugas_akhir', $data);
		$this->load->view('v_footer', $data);
	}


	// ajax call section
	public function getbimbingandetil() {
		$result = $this->Thesis_model->getStudentThesis($this->input->post('id'));
		echo json_encode($result);
	}

	public function submitweeklyplan() {
		$user = $this->input->cookie('user');
		$userjson = json_decode($user);

		$id = $this->Thesis_model->insert_weekly_plan($userjson->id, $this->input->post('tugasakhirid'), $this->input->post('week_start'), $this->input->post('week_end'), $this->input->post('judul'), 0);

		echo json_encode(array("result" => "OK", "lastid" => $id));
	}

	public function delplan() {
		$user = $this->input->cookie('user');
		$userjson = json_decode($user);
		$this->Thesis_model->del_weekly_plans($this->input->post('planid'), $userjson->id);
		echo json_encode(array("result" => "OK"));
	}

	public function checkplan() {
		$user = $this->input->cookie('user');
		$userjson = json_decode($user);
		$this->Thesis_model->check_plans($this->input->post('planid'), $userjson->id);
		echo json_encode(array("result" => "OK"));
	}

	public function editplan() {
		$this->Thesis_model->edit_plans($this->input->post('planid'), $this->input->post('judul'));
		echo json_encode(array("result" => "OK"));
	}

	public function getplan() {
		$data = $this->Thesis_model->get_weekly_plan($this->input->post('planid'));
		echo json_encode(array("result" => "OK", "data" => $data));
	}

	// end of ajax call section
}