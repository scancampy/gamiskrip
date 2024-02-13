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

	public function index() {
		$data = array();
		$data['js'] = '';
		$data['setting'] = $this->Setting_model->getSetting();
		$user = $this->input->cookie('user');
		$userjson = json_decode($user);

		// read submit
		if($this->input->post('btnsubmit')) {
			// validate the input
			$this->load->library('form_validation');
			$this->form_validation->set_rules('judul', 'Judul', 'required', array('required' => '%s wajib diisi.'));
			$this->form_validation->set_rules('lecturer1_id', 'Dosen Pembimbing 1', 'required', array('required' => '%s wajib diisi.'));
			$this->form_validation->set_rules('lecturer2_id', 'Dosen Pembimbing 2', 'required', array('required' => '%s wajib diisi.'));
			
			// cek dosbing tidak boleh kembar
			// cek dosbing tidak boleh kosong
			// cek proposal harus diisi
			// cek tanggal berakhir tidak boleh < tanggal awal st

			if ($this->form_validation->run() == FALSE)
            {   
            	$this->session->set_flashdata('notif', true);
            	$this->session->set_flashdata('msg', validation_errors());
            	redirect('newaccount');
            } else {

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
			    echo "Invalid date format!";
			}

			$converted_tanggal_akhir_st = DateTime::createFromFormat('d/m/Y', $tanggal_akhir_st);

			if ($converted_tanggal_akhir_st) {
			    $tanggal_akhir_st = $converted_tanggal_akhir_st->format('Y-m-d');
			} else {
			    echo "Invalid date format!";
			}

			// save
			$this->Thesis_model->insertThesis($judul, $userjson->id, $lecturer1_id, $lecturer2_id, $proposal_url, $tanggal_st, $tanggal_akhir_st);

			$this->session->set_flashdata('notif','success');
			$this->session->set_flashdata('msg', 'Tugas akhir sukses ditambahkan');

			redirect('tugasakhir');
		}

		// get lecturer
		$data['lecturers'] = $this->Lecturer_model->getLecturer(null,null,array('is_deleted' => 0), 'fullname', 'asc');
		
		
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

	
}