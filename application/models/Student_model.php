<?php
class Student_model extends CI_Model {

    public function updateUserType($username, $scores) {
        $max = 0;
        $user_type_max = null;

        foreach ($scores as $key => $value) {
                $this->db->where('username', $username);
                $this->db->update('student', array($key => $value));

                if($max < $value) {
                        $max = $value;
                        $user_type_max = $key;
                }
        }

        // update user
        $this->db->where('username', $username);
        $this->db->update('user', array('player_style' => $user_type_max));
    }

    public function getStudent($nrp = null, $user_id = null, $where = null) {
        if($nrp!=null) {
            $this->db->where('nrp', $nrp);
        }

        if($user_id!=null) {
            $this->db->where('user_id', $user_id);
        }

        if($where!=null) {
            $this->db->where($where);
        }

        $q = $this->db->get('student');
        return $q->result();
    }
}

?>
