<?php 
class Setting_model extends CI_Model {

        public $web_name;

        public function getSetting() {
                $this->db->limit(1);
                $query = $this->db->get('setting');
                
                return $query->row();
        }

}

?>