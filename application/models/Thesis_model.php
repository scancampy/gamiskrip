<?php
class Thesis_model extends CI_Model {

    // log bimbingan
    public function insertLogBimbingan($judul, $keterangan, $link_file, $perihal_logs_id, $tugas_akhir_id, $publikasi) {
        $data = array(
                'tanggal'               => date('Y-m-d H:i:s'),
                'perihal_logs_id'       => $perihal_logs_id,
                'judul'                 => $judul,
                'keterangan'            => $keterangan,
                'link_file'             => $link_file,
                'tugas_akhir_id'        => $tugas_akhir_id,
                'publikasi'             => $publikasi
        );

        $this->db->insert('log_bimbingan', $data);
        $p= $this->db->insert_id();

        // ambil user id dulu
        $q = $this->db->get_where('tugas_akhir', array('id' => $tugas_akhir_id));
        $hq = $q->row();
        $this->check_log_achievement($hq->student_id, $tugas_akhir_id);
        return $p;
    }

     // first log achievement
    public function check_log_achievement($user_id, $tugas_akhir_id) {
            $q = $this->db->get_where('user_achievement', array('user_id' => $user_id, 'achievement_id' => 10));
            if($q->num_rows() == 0) {
                $datainsert = array('user_id' => $user_id, 'achievement_id' => 10, 'obtained_date' => date('Y-m-d H:i:s'));
                $this->db->insert('user_achievement', $datainsert);
            }

            //write at least 10 log
            $q = $this->db->get_where('user_achievement', array('user_id' => $user_id, 'achievement_id' => 30));
            if($q->num_rows() == 0) {
                $p = $this->db->get_where('log_bimbingan', array('tugas_akhir_id' => $tugas_akhir_id));
                if($p->num_rows() > 10) {
                    $datainsert = array('user_id' => $user_id, 'achievement_id' => 30, 'obtained_date' => date('Y-m-d H:i:s'));
                    $this->db->insert('user_achievement', $datainsert);    
                }                
            }
    }

    public function updateLogBimbingan($id, $judul, $keterangan, $link_file, $perihal_logs_id, $tugas_akhir_id, $publikasi) {
        $data = array(
                'tanggal'               => date('Y-m-d H:i:s'),
                'perihal_logs_id'       => $perihal_logs_id,
                'judul'                 => $judul,
                'keterangan'            => $keterangan,
                'link_file'             => $link_file,
                'tugas_akhir_id'        => $tugas_akhir_id,
                'publikasi'             => $publikasi
        );

        $this->db->where('id', $id);
        $this->db->update('log_bimbingan', $data);     
    }

    public function getLogBimbinganByID($id, $tugas_akhir_id) {
        $q = $this->db->get_where('log_bimbingan', array('tugas_akhir_id' => $tugas_akhir_id, 'id' => $id));
        return $q->row();
    }

    public function getLogBimbingan($tugas_akhir_id) {
        $this->db->order_by('tanggal', 'desc');
        $q = $this->db->get_where('log_bimbingan', array('tugas_akhir_id' => $tugas_akhir_id));
        return $q->result();
    }

    public function getLogBimbinganFiles($id) {
        $q = $this->db->get_where('log_bimbingan_files', array('log_bimbingan_id' => $id));
        return $q->result();
    }

    public function insertLogBimbinganFiles($id, $judul_file, $nama_file) {
        $data = array('log_bimbingan_id' => $id,'judul' => $judul_file, 'nama_file' => $nama_file);
        $this->db->insert('log_bimbingan_files', $data);
    }

    public function delLogBimbinganFiles($id) { 
        $q = $this->db->get_where('log_bimbingan_files', array("id" => $id));
        if($q->num_rows() > 0) {
           $hq = $q->row();
           $file = $_SERVER['DOCUMENT_ROOT'] . '/uploads/logbimbingan/'.$hq->nama_file;
           if(file_exists($file)) {
                unlink($file);
            } 

            $this->db->where('id', $id);
            $this->db->delete('log_bimbingan_files');
        }
    }

    public function insertKomentar($log_bimbingan_id, $user_id, $komentar) {
        $data = array(
                'log_bimbingan_id'  => $log_bimbingan_id,
                'user_id'           => $user_id,
                'komentar'          => $komentar,
                'created'           => date('Y-m-d H:i:s')
            );

        $this->db->insert('log_bimbingan_komentar', $data);
    }

    public function getKomentar($log_bimbingan_id) {
        $this->db->order_by('created', 'asc');
        $this->db->join('user', 'user.id=log_bimbingan_komentar.user_id','left');
        $this->db->select('log_bimbingan_komentar.*, user.user_type');
        $q = $this->db->get_where('log_bimbingan_komentar', array('log_bimbingan_id' => $log_bimbingan_id));

       // echo $this->db->last_query();
        return $q->result();
    }

    public function get_number_of_log_bimbingan_need_comment($tugas_akhir_id) {
        $q = $this->db->get_where('log_bimbingan', array('sudah_comment' => 0, 'tugas_akhir_id' => $tugas_akhir_id, 'publikasi' => 'rilis'));

        return $q->num_rows();
    }

    // end of log bimbingan


    public function getStudentThesis($id = null, $student_id=null, $where = null, $orderby = null, $ordertype = null) {
        if($where!= null) {
                $this->db->where($where);
        }

        if($student_id != null) {
                $this->db->where('tugas_akhir.student_id', $student_id);
        }

        if($id != null) {
                $this->db->where('tugas_akhir.id', $id);
        }

        if($orderby != null) {
                $this->db->order_by($orderby, $ordertype);
        }

        $this->db->join('lecturer l1', 'l1.user_id = tugas_akhir.lecturer1_id', 'left');

        $this->db->join('lecturer l2', 'l2.user_id = tugas_akhir.lecturer2_id', 'left');
        $this->db->join('student', 'student.user_id = tugas_akhir.student_id', 'left');

        $this->db->select('tugas_akhir.*, l1.fullname as f1, l2.fullname as f2, student.nrp, student.fullname');

        $q = $this->db->get('tugas_akhir');
        return $q->result();
    }

    public function validateThesis($id, $lecturer_id) {
        $q = $this->db->get_where('tugas_akhir', array('id' => $id, 'is_active' => 0, 'lecturer1_id' => $lecturer_id));

        if($q->num_rows() > 0) {
                $data = array('is_active' => 1);
                $this->db->where('id', $id);
                $this->db->update('tugas_akhir', $data);
                return true;
        } else {
                $p = $this->db->get_where('tugas_akhir', array('id' => $id, 'is_active' => 0, 'lecturer1_id' => $lecturer_id));
                if($p->num_rows() >0) {
                        $data = array('is_active' => 1);
                        $this->db->where('id', $id);
                        $this->db->update('tugas_akhir', $data);
                        return true;
                } else {
                        return false;
                }
        }
    }

    public function insertThesis($judul, $student_id, $lecturer1_id, $lecturer2_id, $proposal_url, $tanggal_st, $tanggal_akhir_st) {
        $data = array(
                'judul'                 => $judul,
                'student_id'            => $student_id,
                'lecturer1_id'          => $lecturer1_id,
                'lecturer2_id'          => $lecturer2_id,
                'tanggal_st'            => $tanggal_st,
                'tanggal_akhir_st'      => $tanggal_akhir_st,
                'created'               => date('Y-m-d H:i:s'),
                'proposal_url'          => $proposal_url
        );

        $this->db->insert('tugas_akhir', $data);
    }

    // weekly planner
    public function insert_weekly_plan($user_id, $tugas_akhir_id, $start_week, $end_week, $plan, $is_done = 0) {
        $data = array(
            'user_id' => $user_id,
            'tugas_akhir_id' => $tugas_akhir_id,
            'start_week' => $start_week,
            'end_week' => $end_week,
            'plan' => $plan,
            'is_done' => $is_done
        );

        $this->db->insert('weekly_plan', $data);
        $p =  $this->db->insert_id();
        $this->check_weekly_planner_achievement($user_id);
        return $p;
    }

    // weekly plan achievement
    public function check_weekly_planner_achievement($user_id) {
        $q = $this->db->get_where('user_achievement', array('user_id' => $user_id, 'achievement_id' => 11));
        if($q->num_rows() == 0) {
            $datainsert = array('user_id' => $user_id, 'achievement_id' => 11, 'obtained_date' => date('Y-m-d H:i:s'));
            $this->db->insert('user_achievement', $datainsert);
        }

        $q = $this->db->get_where('user_achievement', array('user_id' => $user_id, 'achievement_id' => 31));
        if($q->num_rows() == 0) {
            // hitung jumlah complete
            $p = $this->db->get_where('weekly_plan', array('user_id' => $user_id));

            if($p->num_rows() >= 10) {
                $datainsert = array('user_id' => $user_id, 'achievement_id' => 31, 'obtained_date' => date('Y-m-d H:i:s'));
                $this->db->insert('user_achievement', $datainsert);
            }
        }
    }

    public function get_weekly_plans($user_id, $tugas_akhir_id) {
        $this->db->where('user_id', $user_id);
        $this->db->where('tugas_akhir_id', $tugas_akhir_id);
        $query = $this->db->get('weekly_plan');

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function get_weekly_plan($id) {
        $q = $this->db->get_where('weekly_plan', array('id' => $id));
        return $q->row();
    }

    public function del_weekly_plans($id, $user_id) {
        $this->db->delete('weekly_plan', array('id' => $id, 'user_id' => $user_id));
    }

    public function check_plans($id, $user_id) {
        $this->db->where('id', $id);
        $this->db->where('user_id', $user_id);
        $this->db->update('weekly_plan', array('is_done' => 1));
        $this->check_weekly_planner_complete_achievement($user_id);
    }

     // weekly plan complete achievement
    public function check_weekly_planner_complete_achievement($user_id) {
        $q = $this->db->get_where('user_achievement', array('user_id' => $user_id, 'achievement_id' => 12));
        if($q->num_rows() == 0) {
            $datainsert = array('user_id' => $user_id, 'achievement_id' => 12, 'obtained_date' => date('Y-m-d H:i:s'));
            $this->db->insert('user_achievement', $datainsert);
        }

        $q = $this->db->get_where('user_achievement', array('user_id' => $user_id, 'achievement_id' => 33));
        if($q->num_rows() == 0) {
            // hitung jumlah complete
            $p = $this->db->get_where('weekly_plan', array('user_id' => $user_id, 'is_done' => 1));

            if($p->num_rows() >= 10) {
                $datainsert = array('user_id' => $user_id, 'achievement_id' => 33, 'obtained_date' => date('Y-m-d H:i:s'));
                $this->db->insert('user_achievement', $datainsert);
            }
        }
    }

    public function edit_plans($id, $newjudul) {
        $data = array('plan' => $newjudul);
        $this->db->where('id', $id);
        $this->db->update('weekly_plan', $data);
    }

    // end of weekly planner

    public function advance_student_act($tugas_akhir_id) {
        $this->db->query("UPDATE tugas_akhir SET progress = progress + 1 WHERE id= ".$tugas_akhir_id.";");
        $this->check_advancing_act($tugas_akhir_id);
    }

     // first log achievement
    public function check_advancing_act($tugas_akhir_id) {
        $q = $this->db->get_where('tugas_akhir', array('id' => $tugas_akhir_id));
        $hq = $q->row();

        if($hq->progress == 2) {
            $q = $this->db->get_where('user_achievement', array('user_id' => $hq->student_id, 'achievement_id' => 13));
            if($q->num_rows() == 0) {
                $datainsert = array('user_id' => $hq->student_id, 'achievement_id' => 13, 'obtained_date' => date('Y-m-d H:i:s'));
                $this->db->insert('user_achievement', $datainsert);
            }
        } else if($hq->progress == 3) {
            $q = $this->db->get_where('user_achievement', array('user_id' => $hq->student_id, 'achievement_id' => 14));
            if($q->num_rows() == 0) {
                $datainsert = array('user_id' => $hq->student_id, 'achievement_id' => 14, 'obtained_date' => date('Y-m-d H:i:s'));
                $this->db->insert('user_achievement', $datainsert);
            }
        } else if($hq->progress == 4) {
            $q = $this->db->get_where('user_achievement', array('user_id' => $hq->student_id, 'achievement_id' => 15));
            if($q->num_rows() == 0) {
                $datainsert = array('user_id' => $hq->student_id, 'achievement_id' => 15, 'obtained_date' => date('Y-m-d H:i:s'));
                $this->db->insert('user_achievement', $datainsert);
            }
        } 
    }
}

?>
