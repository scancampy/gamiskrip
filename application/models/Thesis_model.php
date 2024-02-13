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
}

?>
