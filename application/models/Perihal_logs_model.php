<?php
class Perihal_logs_model extends CI_Model {
    public function get() {
        $q = $this->db->get_where('perihal_logs');
        return $q->result();
    }
}

?>
