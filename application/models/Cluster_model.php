<?php
class Cluster_model extends CI_Model {

    public function isCourseExist($code, $name) {
        $q = $this->db->get_where('course', array('course_id' => $code));

        if($q->num_rows() >0) {
            return $q->row();
        } else {
            // cek di table kestaraan
            $q = $this->db->get_where('kesetaraan_course', array('kesetaraan_id' => $code));

            if($q->num_rows() > 0) {
                $hq = $q->row();
                $p = $this->db->get_where('course', array('course_id' => $hq->course_id));

                if($p->num_rows() >0) {
                    return $p->row();
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }
        /*$this->db->like('course_name', $name);
        $this->db->or_where('course_id', $code);  
        $q = $this->db->get('course');
        if($q->num_rows() > 0) {
                return $q->row();
        } else {
                return false;
        }*/
    }

    public function getNilaiFromCourseList($nearestCourses, $nilaiValues) {
        $nilai = array();
        //print_r($nearestCourses);
        foreach ($nearestCourses as $key => $value) {
          //  echo $value->course_id;
            foreach ($nilaiValues as $keyn => $valuen) {
                if($valuen['kode'] == $value->course_id) {
                    $value->mark = $valuen['nilai'];
                    $nilai[] = $value;
                } else {
                    //cari di kesetaraannya
                     $q = $this->db->get_where('kesetaraan_course', array('course_id' => $value->course_id));
                     if($q->num_rows() >0 ) {
                        $hq = $q->result();

                        foreach ($hq as $keyhq => $valuehq) {
                            if($valuen['kode'] == $valuehq->kesetaraan_id) {
                                $value->mark = $valuen['nilai'];
                                $nilai[] = $value; 
                                break;  
                            }
                        }
                        
                     }
                }           
            }
        }

        return $nilai;
    }

    public function getClusterCenterEncoding($clusterId) {
     $q = $this->db->get_where('cluster_center', array('id' => $clusterId));
     $qrow = $q->row();
     return $qrow;   
    }

    public function checkMarkWithinCluster($clusterId, $nilai) {
        $this->db->join('course c1', 'cluster_result.encoding_course_1 = c1.encoding_value', 'left');
        $this->db->join('course c2', 'cluster_result.encoding_course_2 = c2.encoding_value', 'left');
        $this->db->join('course c3', 'cluster_result.encoding_course_3 = c3.encoding_value', 'left');

        $this->db->select('cluster_result.*, c1.course_name as cname1, c2.course_name as cname2, c3.course_name as cname3');
        $q = $this->db->get_where('cluster_result', array('cluster_code' => $clusterId));

        $result = $q->result();
        $array = array();

        foreach ($result as $key => $value) {
            $courseEncValue1 = $value->encoding_course_1;
            $courseEncValue2 = $value->encoding_course_2;
            $courseEncValue3 = $value->encoding_course_3;
            $nilai1 = 0;
            $nilai2 = 0;
            $nilai3 = 0;

            foreach($nilai as $nkey => $nvalue) {
                if($nvalue['encoding'] == $courseEncValue1) {
                    $nilai1 = $nvalue['nilai'];
                } else if($nvalue['encoding'] == $courseEncValue2) {
                    $nilai2 = $nvalue['nilai'];
                } else if($nvalue['encoding'] == $courseEncValue3) {
                    $nilai3 = $nvalue['nilai'];
                }
            }

            $value->nilai1 = $nilai1;
            $value->nilai2 = $nilai2;
            $value->nilai3 = $nilai3;
            $value->avg = ($value->nilai1+$value->nilai2+$value->nilai3)/ 3.0;

            $array[] = $value;
        }

        return $array;
    }

    public function getCourseListNearCenter($clusterId, $numCourseRange) {
        $courses = array();
        $q = $this->db->get_where('cluster_center', array('id' => $clusterId));
        $qrow = $q->row();
        
        for($i = 1; $i <= 3; $i++) {
            if($i == 1) {
              $targetEncodingValue = $qrow->cluster_center_1;  
            } else if($i==2) {
                $targetEncodingValue = $qrow->cluster_center_2;
            } else {
                $targetEncodingValue = $qrow->cluster_center_3; 
            }

            $minDifference = PHP_INT_MAX;
            $nearestCourse = [];

            $this->db->order_by('encoding_value', 'asc');
            $mk = $this->db->get('course');

            foreach ($mk->result() as $key => $value) {
                // Get the encoding value for the current course
                $encodingValue = $value->encoding_value;

                // Calculate the absolute difference between the target and current encoding value
                $difference = abs($targetEncodingValue - $encodingValue);

                // Add the course and its difference to the array
                $nearestCourses[$value->course_id] = $difference;
            }

            // Sort the array by difference in ascending order
            asort($nearestCourses);

            // Retrieve the specified number of nearest courses
            $nearestCourses = array_slice($nearestCourses, 0, $numCourseRange, true);

            foreach($nearestCourses as $key => $value) {
                $p = $this->db->get_where('course', array('course_id' => $key));
                $courses[] = $p->row();
            }
        }

        return $courses;
    }

    public function getNumberOfEligibleCourse($clusterId, $courses) {
        $count = 0;
        $q = $this->db->get_where('cluster_course', array('cluster_id' => $clusterId));

        foreach ($q->result() as $key => $value) {
            foreach ($courses as $course) {
                if($value->course_id == $course['kode']) {
                    $count++;
                    break;
                }
            }            
        }

        return $count;
    }

    public function getClusterCourses($clusterId) {
        $q = $this->db->get_where('cluster_course', array('cluster_id' => $clusterId));
        return $q->result();
    }

    public function getClusterResultBasedOnTranscripts($courseData, $clusterId) {
        $result = [];
        $centerq = $this->db->get_where('cluster_center', array('id' => $clusterId));
        $center = $centerq->result();

        // Iterate through the course data
        $q = $this->db->get_where('cluster_result', array('cluster_code' => $clusterId));

        $hq = $q->result();
        foreach ($hq as $cresult) {
            //check if encoding value similar
            $similar = 0;
            $averagenilai = 0;
            $inputCourses =  [];

            foreach($courseData as $cdata) {
               // print_r($cdata);
                if($cdata['encoding'] == $cresult->encoding_course_1) {
                    $similar++;
                    $averagenilai += $cdata['nilai'];
                    $cresult->nilai1 = $cdata['nilai'];

                    $inputCourses[] = $cresult->encoding_course_1;
                }

                if($cdata['encoding'] == $cresult->encoding_course_2) {
                    $similar++;
                    $averagenilai += $cdata['nilai'];
                    $cresult->nilai2 = $cdata['nilai'];

                    $inputCourses[] = $cresult->encoding_course_2;
                }

                if($cdata['encoding'] == $cresult->encoding_course_3) {
                    $similar++;
                    $averagenilai += $cdata['nilai'];
                    $cresult->nilai3 = $cdata['nilai'];

                    $inputCourses[] = $cresult->encoding_course_3;
                }
            }

            if($similar == 3) {
                $averagenilai = $averagenilai/$similar;
                $cresult->averagenilai = $averagenilai;

                $centroidCourses = array($center[0]->cluster_center_1, $center[0]->cluster_center_2, $center[0]->cluster_center_3);
                $distance = 0;

                for ($i = 0; $i < count($inputCourses); $i++) {
                    $distance += pow($inputCourses[$i] - $centroidCourses[$i], 2);
                }

                $distance = sqrt($distance);
                $cresult->distance = $distance;
                // hitung juga eulidean distance ke center

                // print_r($cresult);
                //die();
                $result[] = $cresult;
            }
        }

        return $result;

    }

    public function getClusterResultsForClusterId($clusterId) {
        $this->db->select('*');
        $this->db->from('cluster_result');
        $this->db->where('cluster_code', $clusterId);
        $query = $this->db->get();

        return $query->result_array();
    }

    public function calculateCosineSimilarityForCourse($encodingValue, $clusterResult) {
        // Convert the cluster result's encoding values to an array
        $clusterEncoding = [
            $clusterResult['encoding_course_1'],
            $clusterResult['encoding_course_2'],
            $clusterResult['encoding_course_3'],
        ];

        // Calculate the dot product between the encoding values
        $dotProduct = array_sum(array_map(function ($a, $b) {
            return $a * $b;
        }, $clusterEncoding, [$encodingValue, $encodingValue, $encodingValue]));

        // Calculate the magnitude of the encoding values
        $magnitude1 = sqrt(array_sum(array_map(function ($a) {
            return $a * $a;
        }, $clusterEncoding)));
        $magnitude2 = sqrt(3 * $encodingValue * $encodingValue);

        // Calculate the cosine similarity
        if ($magnitude1 * $magnitude2 != 0) {
            $cosineSimilarity = $dotProduct / ($magnitude1 * $magnitude2);
        } else {
            $cosineSimilarity = 0; // Handle division by zero or cases where the magnitude is zero
        }

        return $cosineSimilarity;
    }

    public function calculateCosineSimilarity($courseData, $clusterId) {
        // Initialize an array to store cosine similarity scores
        $cosineSimilarities = [];

        // Iterate through the course data
        foreach ($courseData as $course) {
            // Get the encoding value for the current course
            $encodingValue = $course['encoding'];

            // Get cluster results for the given cluster ID
            $clusterResults = $this->getClusterResultsForClusterId($clusterId);

            foreach ($clusterResults as $clusterResult) {
                $cosineSimilarity = $this->calculateCosineSimilarityForCourse($encodingValue, $clusterResult);

                // Store the cosine similarity score along with the course data
                $cosineSimilarities[] = [
                    'course_data' => $course,
                    'cluster_result' => $clusterResult,
                    'cosine_similarity' => $cosineSimilarity,
                ];
            }
        }

        // Sort the array by cosine similarity in descending order
        usort($cosineSimilarities, function($a, $b) {
            if ($a['cosine_similarity'] === $b['cosine_similarity']) {
                return 0;
            }
            return ($a['cosine_similarity'] > $b['cosine_similarity']) ? -1 : 1;
        });

        return $cosineSimilarities;
    }


/* SELECT DISTINCT  course.course_id FROM `cluster_result` LEFT JOIN `course` ON `course`.`encoding_value` = encoding_course_1 WHERE cluster_code = 0 UNION SELECT DISTINCT  course.course_id FROM `cluster_result` LEFT JOIN `course` ON `course`.`encoding_value` = encoding_course_2 WHERE cluster_code = 0 UNION SELECT DISTINCT  course.course_id FROM `cluster_result` LEFT JOIN `course` ON `course`.`encoding_value` = encoding_course_3 WHERE cluster_code = 0; */

    public function getClusters() {
        $q = $this->db->get('cluster_center');
        return $q->result_array();
    }

    public function getClusterId($id) {
        $q = $this->db->get_where('cluster_result', array('id' => $id));
        return $q->row();
    }

    public function updateCluster($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('cluster_result', $data);
    }

    public function getClusterMember($id) {
        $q = $this->db->get_where('cluster_result', array('cluster_code' => $id));
        return $q->result_array();
    }

    public function getCourseByEncodingValue($encoding_value) {
        $q = $this->db->get_where('course', array('encoding_value'=> $encoding_value));

        return $q->row();
    }

}

?>