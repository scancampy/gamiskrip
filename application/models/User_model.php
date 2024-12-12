<?php 
class User_model extends CI_Model {

        public $password;
        public $user_type;
        public $last_login;
        public $first_name;
        public $last_name;
        public $email;

        public function getUser($email =null, $where= null) {
                if($email != null) {
                        $this->db->where('email', $email);
                }

                if($where != null) {
                        $this->db->where($where);
                }
                $query = $this->db->get('user');
                
                return $query->row();
        }

        // first visit friend profile achievement
        public function check_visit_profile_achievement($user_id) {
                $q = $this->db->get_where('user_achievement', array('user_id' => $user_id, 'achievement_id' => 7));
                if($q->num_rows() == 0) {
                    $datainsert = array('user_id' => $user_id, 'achievement_id' => 7, 'obtained_date' => date('Y-m-d H:i:s'));
                    $this->db->insert('user_achievement', $datainsert);
                }
        }

        public function do_login() {
                $query = $this->db->get_where('user', array('email' => $this->input->post('username', TRUE)));
                $row = $query->row();

                if (isset($row))
                {
                      $this->password = $row->password;
                      if(password_verify($this->input->post('password', TRUE), $this->password)) {
                        // Get current date
                            $current_date = new DateTime();
                            $last_login = new DateTime($row->last_login);
                            $interval = $last_login->diff($current_date);

                            // Check if the last login was yesterday (1 day apart)
                            if ($interval->days === 1 && $interval->invert === 0) {
                                // Increment consecutive login days
                                $new_consecutive_login = $row->consecutive_login + 1;
                            } else {
                                // Reset consecutive login to 1 if last login is not yesterday or first login
                                $new_consecutive_login = 1;
                            }

                            // Update last_login and consecutive_login fields
                            $this->db->where('email', $this->input->post('username', TRUE));
                            $this->db->update('user', array(
                                'last_login' => $current_date->format('Y-m-d H:i:s'),
                                'consecutive_login' => $new_consecutive_login
                            ));

                            // Return user data
                            $prow = $row;

                            $this->check_consecutive_login_achievement($row->id, $new_consecutive_login);
                            return $prow;
                      }
                }
                return false;
        }

         // consecutive login achievement
            public function check_consecutive_login_achievement($user_id, $new_consecutive_login) {
                    $q = $this->db->get_where('user_achievement', array('user_id' => $user_id, 'achievement_id' => 16));
                    if($q->num_rows() == 0) {
                        if($new_consecutive_login >= 3) {
                                $datainsert = array('user_id' => $user_id, 'achievement_id' => 16, 'obtained_date' => date('Y-m-d H:i:s'));
                                $this->db->insert('user_achievement', $datainsert);
                        }
                    }

                    $q = $this->db->get_where('user_achievement', array('user_id' => $user_id, 'achievement_id' => 17));
                    if($q->num_rows() == 0) {
                        if($new_consecutive_login >= 7) {
                                $datainsert = array('user_id' => $user_id, 'achievement_id' => 17, 'obtained_date' => date('Y-m-d H:i:s'));
                                $this->db->insert('user_achievement', $datainsert);
                        }
                    }
            }

        public function addStudent() {
                $this->first_name = trim($this->input->post('first_name'));
                $this->last_name = trim($this->input->post('last_name'));
                $this->email = trim($this->input->post('email'));
                $this->password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
                $this->user_type = 'student';
                $this->last_login = null;
                // get random avatar
                $this->db->order_by('RAND()'); 
                $q = $this->db->get('avatar_images', 1);
                $hq = $q->row();
                $this->avatar_image_filename = $hq->avatar;

                $this->db->insert('user',$this);

                $data = array(
                                'nrp'           => trim($this->input->post('nrp')),

                                'user_id'       => $this->db->insert_id(),
                                'fullname'      => trim($this->input->post('first_name')).' '.trim($this->input->post('last_name'))
                        );
                $this->db->insert('student', $data);

                return ($this->db->affected_rows() != 1) ? false : true;
        }

        public function resetpass($username, $newpass) {
               // echo $username; die();
                $data = array('password' =>  password_hash($newpass, PASSWORD_DEFAULT));
                $this->db->where('username', $username);
                $this->db->update('user', $data);
        }

        public function change_password($user_id, $oldpass, $newpass) {
                $query = $this->db->get_where('user', array('id' => $user_id));
                $row = $query->row();

                if (isset($row))
                {
                      $this->password = $row->password;
                      if(password_verify($oldpass, $this->password)) {
                        //ubah password
                        $data = array('password' =>  password_hash($newpass, PASSWORD_DEFAULT));
                        $this->db->where('id', $user_id);
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

        public function getAvatars() {
                $q = $this->db->get_where('avatar_images');
                return $q->result();
        }

        public function getAvatar($id) {
                $q = $this->db->get_where('avatar_images', array('id' => $id));
                return $q->row();
        }

        public function updateAvatars($user_id, $filename) {
                $data = array('avatar_image_filename' => $filename);
                $this->db->where('id', $user_id);
                $this->db->update('user', $data);
        }

        public function updateAvatarID($user_id, $avatar_id) {
                $this->db->where('id', $user_id);
                $this->db->update('user', array('user_id_avatar' => $avatar_id));

        }

        public function updateAvatarImageURL($user_id, $newurl) {
                $this->db->where('id', $user_id);
                $this->db->update('user', array('avatar_image_url' => $newurl));
                
        }

}

?>