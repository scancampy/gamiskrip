<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Thesis extends CI_Controller {
	public function index()
	{
		// TODO: 
		echo 'TBA';
	}

	private function _calculateEuclideanDistance($inputCourses, $clusters) {
	    $distances = array();

	    foreach ($clusters as $cluster) {
	        $centroidCourses = array($cluster['cluster_center_1'], $cluster['cluster_center_2'], $cluster['cluster_center_3']);
	        $distance = 0;

	        for ($i = 0; $i < count($inputCourses); $i++) {
	            $distance += pow($inputCourses[$i] - $centroidCourses[$i], 2);
	        }

	        $distance = sqrt($distance);
	        $distances[$cluster['id']] = $distance;
	    }

	    asort($distances);
	    return $distances;
	}

	private function _calculateCosineSimilarity($inputCourses, $nearestClusterMembers) {
	    $similarities = array();

	    // Calculate the magnitude of the input vector
	    $inputMagnitude = sqrt(array_sum(array_map(function($course) {
	        return pow($course, 2);
	    }, $inputCourses)));

	    foreach ($nearestClusterMembers as $member) {
	        $memberCourses = array($member['encoding_course_1'], $member['encoding_course_2'], $member['encoding_course_3']);

	        // Calculate the dot product of the input vector and the member vector
	        $dotProduct = array_sum(array_map(function($a, $b) {
	            return $a * $b;
	        }, $inputCourses, $memberCourses));

	        // Calculate the magnitude of the member vector
	        $memberMagnitude = sqrt(array_sum(array_map(function($course) {
	            return pow($course, 2);
	        }, $memberCourses)));

	        // Calculate the cosine similarity
	        $similarity = $dotProduct / ($inputMagnitude * $memberMagnitude);
	        $similarities[] = array('member' => $member, 'similarity' => $similarity);
	    }

	    // Sort the similarities in descending order
	    usort($similarities, function($a, $b) {
	        return $b['similarity'] <=> $a['similarity'];
	    });

	    return $similarities;
	}


	private function _convert_nisbi($nisbi) {
		if($nisbi == 'A') {
			return 4;
		} else if($nisbi =='AB') {
			return 3.5;
		} else if($nisbi =='B') {
			return 3;
		} else if($nisbi =='BC') {
			return 2.5;
		} else if($nisbi =='C') {
			return 2;
		} else if($nisbi =='D') {
			return 1;
		} else {
			return 0;
		}
	}


	public function recommender() {
		$data = array();
		$data['js'] = '';
		$user = $this->input->cookie('user');
		$userjson = json_decode($user);
		
		// check if student
		if($userjson->user_type!='student') {
			redirect('notfound');
		}

		if($this->input->post('btnconfirm')) {
			$inputCourses = $this->input->post('courses');
			//print_r($inputCourses);
			//die();

			$data['selected_courses'] = array();
			foreach ($inputCourses as $key => $value) {
				$data['selected_courses'][]= $this->Cluster_model->getCourseByEncodingValue($value);
			}

			$clusters = $this->Cluster_model->getClusters();

			//print_r($clusters);

			$distances = $this->_calculateEuclideanDistance($inputCourses, $clusters);

			//print_r($distances);

			// The $distances array will contain the Euclidean distances for each cluster
			// You can then determine the nearest cluster based on the smallest distance
			$nearestClusterId = key($distances);
			$nearestClusterDistance = current($distances);
			$nearestClusterMembers = $this->Cluster_model->getClusterMember($nearestClusterId);

			//print_r($members);

			$similarities = $this->_calculateCosineSimilarity($inputCourses, $nearestClusterMembers);

			// The $similarities array will contain the members sorted by most similar to your input
			$data['clusterinfo'] = "Nearest Cluster ID: " . $nearestClusterId . "<br/>"."Nearest Cluster Distance: " . round($nearestClusterDistance,2). "<br/>";
			$data['similarities'] = $similarities;

			/*foreach ($similarities as $similarity) {
			    $member = $similarity['member'];
			    $similarityScore = $similarity['similarity'];

			    echo $member['title'] . "\n";
			    echo "Similarity Score: " . $similarityScore . "\n";
			    echo "\n";
			}*/

			
		}

		if($this->input->post('btnsubmit')) {
			$config['upload_path']          = './uploads/transcripts';
            $config['allowed_types']        = 'csv';
            $config['max_size']             = 10000;
            $config['encrypt_name']			= TRUE;

            $this->load->library('upload', $config);

            if ( ! $this->upload->do_upload('transcript_file'))
            {
                    $error = $this->upload->display_errors();
                    print_r($error);
            }
            else
            {
                // success 
            	// read csv
            	$datafile = $this->upload->data();

            	$file = fopen(base_url('uploads/transcripts/'.$datafile['file_name']),"r");
            	$nilai = array();
            	while(! feof($file))
				{
				  $line = fgetcsv($file,0,';');
				  $courseexits = $this->Cluster_model->isCourseExist($line[1], $line[2]);
				  if($courseexits) {
				  	//print_r($courseexits);
					  $datax = array(
					        'kode' => $line[1],
					        'nama' => $line[2],
					        'nilai' => $this->_convert_nisbi($line[5]),
					        'encoding' => $courseexits->encoding_value
					  );
					  $nilai[] = $datax;
					}
				}

				// Extract the 'nilai' values from the array for sorting
				$nilaiValues = array_column($nilai, 'nilai');

				// Sort the array $nilai based on the 'nilai' index
				array_multisort($nilaiValues, SORT_DESC, $nilai);
				$data['nilai'] = $nilai;

				/*foreach($nilai as $value) {
					echo $value['nama'].' '.$value['nilai'];
					echo '<br/>';
				}*/

				$deleteCsv =  getcwd().'/uploads/transcripts/'.$datafile['file_name'];
				 
				fclose($file);
				unlink($deleteCsv);
            	
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

	    // bs init
	    $data['js'] .= '
	      bsCustomFileInput.init();
	    ';

	    // select2 init
	    $data['js'] .= '
	    	//Initialize Select2 Elements
		    $(".select2bs4").select2({
		      theme: "bootstrap4"
		    });
	    ';

	    // datatable
	    $data['js'] .= '
	    $("#example2").DataTable({
	      "paging": true,
	      "lengthChange": false,
	      "searching": false,
	      "ordering": true,
	      "info": true,
	      "autoWidth": false,
	      "responsive": true,
	    });

	    ';

	    if(!empty($notif)) {
	    	$data['js'] .= '
	    		 Toast.fire({
			        icon: \''.$notif->type.'\',
			        title: \''.$notif->message.'.\'
			      });
			    ';
	    }

	   	$this->load->view('v_header', $data);
		$this->load->view('thesis/v_recommender', $data);
		$this->load->view('v_footer', $data);
	}

	public function start() {
		$data = array();
		$data['js'] = '';
		$user = $this->input->cookie('user');
		$userjson = json_decode($user);
		
		// check if student
		if($userjson->user_type!='student') {
			redirect('notfound');
		}

		// toast
		$data['js'] .= '
		var Toast = Swal.mixin({
	      toast: true,
	      position: \'top-end\',
	      showConfirmButton: false,
	      timer: 3000
	    });'; 

	    if(!empty($notif)) {
	    	$data['js'] .= '
	    		 Toast.fire({
			        icon: \''.$notif->type.'\',
			        title: \''.$notif->message.'.\'
			      });
			    ';
	    }

	   	$this->load->view('v_header', $data);
		$this->load->view('thesis/v_start', $data);
		$this->load->view('v_footer', $data);
	}

	public function inputthesis() {
		$data = array();
		$data['js'] = '';
		$user = $this->input->cookie('user');
		$userjson = json_decode($user);
		
		// check if student
		if($userjson->user_type!='student') {
			redirect('notfound');
		}

		if($this->input->post('btnsubmit')) {
			// TODO: check validasi
			$proposal_link  = null;
			if(trim($this->input->post('proposal_link')) != '') {
				$proposal_link  = $this->input->post('proposal_link');
			}

			$proposal_file = null;
			if($_FILES['proposal_file']['name'] != "") {
				$config['upload_path']          = './uploads/';
                $config['allowed_types']        = 'pdf|doc|docx';
                $config['max_size']             = 100000;
                $config['encrypt_name']			= TRUE;

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('proposal_file'))
                {
                	$proposal_file = $this->upload->data('file_name');
                }
			}

			$student = $this->Student_model->getStudent(null, $userjson->username);
			if(empty($student)) {
				redirect('notfound');
			}

			$this->Thesis_model->insertThesis($this->input->post('title'), $student[0]->nrp, $this->input->post('lecturer1_npk'), $this->input->post('lecturer2_npk'), $proposal_file, $proposal_link, $this->input->post('start_date_in_sk'));

			$this->session->set_flashdata('type', 'success');
			$this->session->set_flashdata('message', 'A new thesis have been successfully added.');

			redirect('dashboard/student');
		}

		$data['supervisor'] = $this->Lecturer_model->getLecturer();

		$this->load->view('v_header', $data);
		$this->load->view('thesis/v_new_thesis', $data);
		$this->load->view('v_footer', $data);
	}
}
