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
}

?>
