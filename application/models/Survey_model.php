<?php
class Survey_model extends CI_Model {

    public function getSurvey() {
        $this->db->from('hexad_questions');
        $query = $this->db->get();

        return $query->result();
    }

    public function checkUserFinishSurvey($user_id) {
        $q = $this->db->get_where('hexad_questions_answer', array('user_id' => $user_id));
        if($q->num_rows() ==30) {
            return true;
        } else {
            return false;
        }
    }

    public function getUserAnswer($user_id) {
        $q = $this->db->get_where('hexad_questions_answer', array('user_id' => $user_id));
        return $q->result();
    }

    public function insertUserAnswer($user_id, $question_id, $answer) {
        $q =  $this->db->get_where('hexad_questions_answer', array('user_id' => $user_id, 'hexad_questions_id' => $question_id));

        if($q->num_rows() > 0) {
            // update
            $hq = $q->row();
            $data = array('answer' => $answer);
            $this->db->where('hexad_questions_id', $question_id);
            $this->db->where('user_id', $user_id);
            $this->db->update('hexad_questions_answer', $data);
        } else {
            // insert
            $data = array('hexad_questions_id' => $question_id, 'answer' => $answer, 'user_id' => $user_id);
            $this->db->insert('hexad_questions_answer', $data);
        }
    }
}

?>
