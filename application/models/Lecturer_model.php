<?php
class Lecturer_model extends CI_Model {

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

    public function getLecturer($npk = null, $username = null, $where = null, $orderby=null, $ordertype=null) {
        if($npk!=null) {
            $this->db->where('npk', $npk);
        }

        if($orderby != null) {
            $this->db->order_by($orderby, $ordertype);
        }

        if($username!=null) {
            $this->db->where('username', $username);
        }

        if($where!=null) {
            $this->db->where($where);
        }

        $q = $this->db->get('lecturer');
        return $q->result();
    }
}

?>
