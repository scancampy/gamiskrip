<?php 
class User_model extends CI_Model {

        public $password;
        public $user_type;
        public $last_login;
        public $first_name;
        public $last_name;
        public $email;

        public function getUser($username =null, $where= null) {
                if($username != null) {
                        $this->db->where('username', $username);
                }

                if($where != null) {
                        $this->db->where($where);
                }
                $query = $this->db->get('user');
                
                return $query->result();
        }

        public function do_login() {
                $query = $this->db->get_where('user', array('email' => $this->input->post('username', TRUE)));
                $row = $query->row();

                if (isset($row))
                {
                      $this->password = $row->password;
                      if(password_verify($this->input->post('password', TRUE), $this->password)) {
                        //update last login
                        $this->db->where('email', $this->input->post('username', TRUE));
                        $this->db->update('user', array('last_login' => date('Y-m-d H:i:s')));
                        return $row;
                      }
                }
                return false;
        }

        public function addStudent() {
                $this->first_name = trim($this->input->post('first_name'));
                $this->last_name = trim($this->input->post('last_name'));
                $this->email = trim($this->input->post('email'));
                $this->password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
                $this->user_type = 'student';
                $this->last_login = null;

                $this->db->insert('user',$this);
                return ($this->db->affected_rows() != 1) ? false : true;
        }

        public function resetpass($username, $newpass) {
               // echo $username; die();
                $data = array('password' =>  password_hash($newpass, PASSWORD_DEFAULT));
                $this->db->where('username', $username);
                $this->db->update('user', $data);
        }

        public function change_password($username, $oldpass, $newpass) {
                $query = $this->db->get_where('user', array('username' => $username));
                $row = $query->row();

                if (isset($row))
                {
                      $this->password = $row->password;
                      if(password_verify($oldpass, $this->password)) {
                        //ubah password
                        $data = array('password' =>  password_hash($newpass, PASSWORD_DEFAULT));
                        $this->db->where('username', $username);
                        $this->db->update('user', $data);
                        return true;
                      } else {
                        return false;
                      }
                }
                return false;
        }

        public function del($username) {
                $this->db->where('username', $username);
                $this->db->delete('user');
        }

}

?>