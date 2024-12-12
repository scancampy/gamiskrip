<?php 
class Setting_model extends CI_Model {

        public $web_name;

        public function getSetting() {
                $this->db->limit(1);
                $query = $this->db->get('setting');
                
                return $query->row();
        }

        public function getActs() {
                $q = $this->db->get_where('master_act');
                return $q->result();
        }

        public function get_active_periode() {
            // get current active periode
            $qperiode = $this->db->get_where('periode', array('is_active' => 1));
            return $qperiode->row();
        }

        public function sendemail($to, $subject, $content) {
                $this->load->library('email');

                $config['smtp_host'] = 'gamiskrip.my.id';
                $config['smtp_user'] = 'noreply@gamiskrip.my.id';
                $config['smtp_pass'] = 'r&[DT($eMhoF';
                $config['smtp_port'] = 465;
                $config['mailtype'] = 'text';

                $this->email->initialize($config);

                $this->email->from('noreply@gamiskrip.my.id', 'Gamiskrip Admin');
                $this->email->to($to);

                $this->email->subject($subject);
                $this->email->message($content);

                echo $this->email->send();
        }

}

?>