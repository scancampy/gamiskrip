<?php
class Journey_model extends CI_Model {

    public function get_journey_characters($where = null) {
        if($where != null) {
            $this->db->where($where);
        }
        $q = $this->db->get('thejourney_character');
        return $q->result();
    } 

    public function set_character($character_id, $tugas_akhir_id) {
        $data= array(
            'thejourney_character_id'   => $character_id
        );

        $this->db->where('id='.$tugas_akhir_id);
        $this->db->update('tugas_akhir', $data);
    }

    public function get_journey_story($character_id) {
        $this->db->order_by('story_order', 'asc');
        $q =  $this->db->get_where('thejourney', array('character_id' => $character_id));


        return $q->result();
    }

    public function insert_user_story($tugas_akhir_id, $thejourney_id, $user_id) {
        $data = array(
            'tugas_akhir_id'    => $tugas_akhir_id,
            'thejourney_id'     => $thejourney_id,
            'user_id'           => $user_id
        );

        $this->db->insert('user_story', $data);
        $this->check_first_journey_achievement($user_id);
        return $this->check_complete_journey_achievement($user_id,$thejourney_id);
    }

     // first unlock journey story achievement
    public function check_first_journey_achievement($user_id) {
        $q = $this->db->get_where('user_achievement', array('user_id' => $user_id, 'achievement_id' => 9));
        if($q->num_rows() == 0) {
            $datainsert = array('user_id' => $user_id, 'achievement_id' => 9, 'obtained_date' => date('Y-m-d H:i:s'));
            $this->db->insert('user_achievement', $datainsert);
        }
    }

    // check journey story complete achievement
    public function check_complete_journey_achievement($user_id,$thejourney_id) {
        $q = $this->db->get_where('user_achievement', array('user_id' => $user_id, 'achievement_id' => 32));
        if($q->num_rows() == 0) {
            // hitung ada berapa story
            $p = $this->db->get_where('thejourney', array('id' => $thejourney_id));
            $hp = $p->row();

            $l = $this->db->get_where('thejourney', array('character_id' => $hp->character_id));
            $tot = $l->num_rows();

            // cek skrips aktifnya dulu
            $q = $this->db->get_where('tugas_akhir', array('is_active' => 1, 'student_id' => $user_id));
            $hq = $q->row();
            $s = $this->db->get_where('user_story', array('user_id' => $user_id, 'tugas_akhir_id' => $hq->id));

            

            if($s->num_rows() >= $tot) {
                $datainsert = array('user_id' => $user_id, 'achievement_id' => 32, 'obtained_date' => date('Y-m-d H:i:s'));
                $this->db->insert('user_achievement', $datainsert);
            }

            $str = 'total '.$tot;
            $str .= '<br/>user '.$s->num_rows();

            return $str;
        } else {
            return false;
        }
    }



    public function get_user_story($tugas_akhir_id) {
        $q =  $this->db->get_where('user_story', array('tugas_akhir_id' => $tugas_akhir_id));
        return $q->result();
    }

    public function get_acts() {
        $q = $this->db->get('master_act');
        return $q->result();
    }
}

?>
