<?php
class Cluster_model extends CI_Model {

    public function isCourseExist($code, $name) {
        $this->db->like('course_name', $name);
        $this->db->or_where('course_id', $code);  
        $q = $this->db->get('course');
        if($q->num_rows() > 0) {
                return $q->row();
        } else {
                return false;
        }
    }

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
