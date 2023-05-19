<?php
class Survey_model extends CI_Model {

    public function getSurvey() {
        $this->db->select('id, question, player_type');
        $this->db->from('survey_questions');
        $query = $this->db->get();

        return $query->result();
    }
}

?>
