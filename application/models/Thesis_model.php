<?php
class Thesis_model extends CI_Model {

    public function getStudentThesis($id = null, $student_nrp=null, $where = null) {
        if($where!= null) {
                $this->db->where($where);
        }

        if($student_nrp != null) {
                $this->db->where('student_nrp', $student_nrp);
        }

        if($id != null) {
                $this->db->where('id', $id);
        }

        $q = $this->db->get('thesis');
        return $q->result();
    }

    public function insertThesis($title, $student_nrp, $lecturer1_npk, $lecturer2_npk, $proposal_file=null, $proposal_link = null, $start_date_in_sk) {
        $data = array(
                'title'                 => $title,
                'student_nrp'           => $student_nrp,
                'lecturer1_npk'         => $lecturer1_npk,
                'lecturer2_npk'         => $lecturer2_npk,
                'proposal_file'         => $proposal_file,
                'proposal_link'         => $proposal_link,
                'created_date'          => date('Y-m-d H:i:s'),
                'start_date_in_sk'      => $start_date_in_sk
        );

        $this->db->insert('thesis', $data);
    }
}

?>
