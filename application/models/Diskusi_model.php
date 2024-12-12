<?php
class Diskusi_model extends CI_Model {

    public function insertFolder($folder_title, $notes, $created_by_user_id, $parent_folder_id = null) {
        $data = array(
            'folder_title'          => $folder_title,
            'notes'                 => $notes,
            'created'               => date('Y-m-d H:i:s'),
            'created_by_user_id'    => $created_by_user_id,
            'parent_folder_id'      => $parent_folder_id
        );

        $this->db->insert('diskusi_folder', $data);
    }

    public function updateLikes($thread_id, $user_id) {
        $q = $this->db->get_where('thread_likes', array('thread_id' => $thread_id, 'user_id' => $user_id));
        if($q->num_rows() >0) {
            // delete
            $this->db->where('thread_id', $thread_id);
            $this->db->where('user_id', $user_id);
            $this->db->delete('thread_likes');
        } else {
            // insert
            $this->db->insert('thread_likes', array('thread_id' => $thread_id, 'user_id' => $user_id));
            $this->check_post_likes_complete_achievement($user_id);
            $this->check_ten_thread_likes_complete_achievement();
        }

        $q = $this->db->get_where('thread_likes', array('thread_id' => $thread_id));
        return $q->num_rows();
    }

    public function check_post_likes_complete_achievement($user_id) {
        // first likes in ruang diskusi
        $q = $this->db->get_where('user_achievement', array('user_id' => $user_id, 'achievement_id' => 4));
        if($q->num_rows() == 0) {
            $datainsert = array('user_id' => $user_id, 'achievement_id' => 4, 'obtained_date' => date('Y-m-d H:i:s'));
            $this->db->insert('user_achievement', $datainsert);
        }
    }

    public function check_ten_thread_likes_complete_achievement() {
        $this->db->select('thread_id, COUNT(user_id) as like_count')
                 ->from('thread_likes')
                 ->group_by('thread_id')
                 ->having('COUNT(user_id) >', 10);
        $query = $this->db->get();
        $h = $query->result();

        foreach ($h as $key => $value) {
            $q = $this->db->get_where('thread', array('id' => $value->thread_id));
            $hq = $q->row();
            $userid = $hq->created_by_user_id;

            // cek sudah dapat achievement 10 likes belum
            $q = $this->db->get_where('user_achievement', array('user_id' => $userid, 'achievement_id' => 29));
            if($q->num_rows() == 0) {
                $datainsert = array('user_id' => $userid, 'achievement_id' => 29, 'obtained_date' => date('Y-m-d H:i:s'));
                $this->db->insert('user_achievement', $datainsert);
            }
        }
    }

    public function check_ten_thread_reply_likes_complete_achievement() {
        $this->db->select('thread_id, COUNT(user_id) as like_count')
                 ->from('thread_likes_reply')
                 ->group_by('thread_id')
                 ->having('COUNT(user_id) >', 10);
        $query = $this->db->get();
        $h = $query->result();

        foreach ($h as $key => $value) {
            $q = $this->db->get_where('thread_reply', array('id' => $value->thread_id));
            $hq = $q->row();
            $userid = $hq->created_by_user_id;

            // cek sudah dapat achievement 10 likes belum
            $q = $this->db->get_where('user_achievement', array('user_id' => $userid, 'achievement_id' => 29));
            if($q->num_rows() == 0) {
                $datainsert = array('user_id' => $userid, 'achievement_id' => 29, 'obtained_date' => date('Y-m-d H:i:s'));
                $this->db->insert('user_achievement', $datainsert);
            }
        }
    }

     public function updateLikesreply($thread_id, $user_id) {
        $q = $this->db->get_where('thread_likes_reply', array('thread_id' => $thread_id, 'user_id' => $user_id));
        if($q->num_rows() >0) {
            // delete
            $this->db->where('thread_id', $thread_id);
            $this->db->where('user_id', $user_id);
            $this->db->delete('thread_likes_reply');
        } else {
            // insert
            $this->db->insert('thread_likes_reply', array('thread_id' => $thread_id, 'user_id' => $user_id));
            $this->check_post_likes_complete_achievement($user_id); 
            $this->check_ten_thread_reply_likes_complete_achievement();
        }

        $q = $this->db->get_where('thread_likes_reply', array('thread_id' => $thread_id));
        return $q->num_rows();
    }

    public function insertThread($thread_title, $content, $created_by_user_id, $parent_folder_id=null, $thread_type="general_discussion", $is_locked=0) {
        $data = array(
            'thread_title'          => $thread_title,
            'content'               => $content,
            'created'               => date('Y-m-d H:i:s'),
            'created_by_user_id'    => $created_by_user_id,
            'parent_folder_id'      => $parent_folder_id,
            'thread_type'           => $thread_type,
            'is_locked'             => $is_locked
        );

        $this->db->insert('thread', $data);
        $lastid = $this->db->insert_id();

        $this->check_post_complete_achievement($created_by_user_id);

        return $lastid;
    }

    public function check_post_complete_achievement($user_id) {
        // first post in ruang diskusi
        $q = $this->db->get_where('user_achievement', array('user_id' => $user_id, 'achievement_id' => 2));
        if($q->num_rows() == 0) {
            $datainsert = array('user_id' => $user_id, 'achievement_id' => 2, 'obtained_date' => date('Y-m-d H:i:s'));
            $this->db->insert('user_achievement', $datainsert);
        }

        // share knowledge10 times
        $q = $this->db->get_where('user_achievement', array('user_id' => $user_id, 'achievement_id' => 22));
        if($q->num_rows() == 0) {
            $p = $this->db->get_where('thread', array('created_by_user_id' => $user_id, 'thread_type' => 'add_post_share_knowledge', 'is_deleted' => 0));

            if($p->num_rows() >=10) {
                $datainsert = array('user_id' => $user_id, 'achievement_id' => 22, 'obtained_date' => date('Y-m-d H:i:s'));
                $this->db->insert('user_achievement', $datainsert);
            }            
        }

        // share work in progress 10 times
        $q = $this->db->get_where('user_achievement', array('user_id' => $user_id, 'achievement_id' => 23));
        if($q->num_rows() == 0) {
            $p = $this->db->get_where('thread', array('created_by_user_id' => $user_id, 'thread_type' => 'add_post_share_work_in_progress', 'is_deleted' => 0));

            if($p->num_rows() >=10) {
                $datainsert = array('user_id' => $user_id, 'achievement_id' => 23, 'obtained_date' => date('Y-m-d H:i:s'));
                $this->db->insert('user_achievement', $datainsert);
            }            
        }
    }

    public function createBreadcrumbFolder($id, &$arr = array()) {
        if($id != null) {
            //echo 'enter';
            $q = $this->db->get_where('diskusi_folder', array('id' => $id));
            //echo $this->db->last_query();
            $hq = $q->row();
            $arr[] = $q->row();
            if($hq->parent_folder_id != null) {
              //  echo 'not null';
                $this->createBreadcrumbFolder($hq->parent_folder_id, $arr);
            } else {
                //echo 'null';
            }
        }
    }

    public function getThreadList($parent_folder_id = null) {
        $this->db->join('user', 'user.id = thread.created_by_user_id', 'left');
        $this->db->select('thread.*, user.first_name, user.last_name');
        $this->db->order_by('created', 'desc');
        $q =  $this->db->get_where('thread', array('thread.is_deleted' => 0, 'thread.parent_folder_id' => $parent_folder_id));
        return $q->result();
    }

    public function getThread($id) {
        // inner join
        $this->db->join('user', 'user.id = thread.created_by_user_id', 'left');
        $this->db->join('student', 'student.user_id = thread.created_by_user_id', 'left');
        $this->db->join('user_clan', 'user_clan.user_id = user.id','left');
        $this->db->join('clan', 'clan.id = user_clan.clan_id','left');
        $this->db->select('thread.*, user.first_name, user.last_name, student.nrp, clan.id as `clanid`, clan.nama as `namaclan`, user. avatar_image_filename, user.avatar_image_url, (SELECT COUNT(*) FROM thread_likes WHERE thread_id = thread.id) AS `num_likes` ');
        $q = $this->db->get_where('thread', array('thread.id' => $id));
        return $q->row();
    }

    public function getThreadFiles($thread_id) {
        $q = $this->db->get_where('thread_files', array('thread_id' => $thread_id));
        return $q->result();
    }

    public function insertThreadFiles($thread_id, $filename, $title) {
        $data = array('thread_id' => $thread_id,'filename' => $filename, 'title' => $title);
        $this->db->insert('thread_files', $data);
    }

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

    public function getFolder($parent_folder_id = null) {
        $this->db->join('user', 'user.id = diskusi_folder.created_by_user_id', 'left');

        $this->db->select('diskusi_folder.*, user.first_name, user.last_name');

        if($parent_folder_id!=null) {
            $this->db->where(array('diskusi_folder.is_deleted' => 0, 'diskusi_folder.parent_folder_id' => $parent_folder_id));
        } else {
            $this->db->where(array('diskusi_folder.is_deleted' => 0, 'diskusi_folder.parent_folder_id' => null));
        }

        $this->db->order_by('diskusi_folder.created', 'asc');

        $q = $this->db->get('diskusi_folder');
        return $q->result();
    }

    public function insertThreadRead($thread_id, $user_id) {
        $q = $this->db->get_where('thread_read', array('thread_id' => $thread_id, 'user_id' => $user_id));
        if($q->num_rows() == 0) {
            $data = array('thread_id' => $thread_id, 'user_id' => $user_id);
            $this->db->insert('thread_read', $data);
        }

    }

    public function checkThreadRead($thread_id, $user_id) {
        $q = $this->db->get_where('thread_read', array('thread_id' => $thread_id, 'user_id' => $user_id));
        if($q->num_rows() >0){
            return true;
        } else {
            return false;
        }
    }

    public function replyThread($thread_id, $content, $user_id) {
        $data = array(
                    'thread_id'             => $thread_id, 
                    'content'               => $content,
                    'created'               => date('Y-m-d H:i:s'),
                    'created_by_user_id'    => $user_id
                );
        $this->db->insert('thread_reply', $data);

        $this->check_reply_complete_achievement($user_id);
    }

    public function check_reply_complete_achievement($user_id) {
        // first reply in ruang diskusi
        $q = $this->db->get_where('user_achievement', array('user_id' => $user_id, 'achievement_id' => 3));
        if($q->num_rows() == 0) {
            $datainsert = array('user_id' => $user_id, 'achievement_id' => 3, 'obtained_date' => date('Y-m-d H:i:s'));
            $this->db->insert('user_achievement', $datainsert);
        }

        // reply ask for help 10 times
        $q = $this->db->get_where('user_achievement', array('user_id' => $user_id, 'achievement_id' => 21));
        if($q->num_rows() == 0) {
            $p = $this->db->query("SELECT DISTINCT(thread.id) FROM `thread` 
                                   INNER JOIN thread_reply ON thread_reply.thread_id = thread.id
                                   WHERE 
                        thread_reply.`created_by_user_id` = ".$user_id." AND thread.thread_type = 'add_post_ask_for_help';");

            if($p->num_rows() >=10) {
                $datainsert = array('user_id' => $user_id, 'achievement_id' => 21, 'obtained_date' => date('Y-m-d H:i:s'));
                $this->db->insert('user_achievement', $datainsert);
            }            
        }
    }

    public function getThreadReply($thread_id, $limit = 10, $offset = 0) {
        $this->db->join('user', 'user.id = thread_reply.created_by_user_id', 'left');
        $this->db->join('student', 'student.user_id = thread_reply.created_by_user_id', 'left');
        $this->db->join('user_clan', 'user_clan.user_id = user.id','left');
        $this->db->join('clan', 'clan.id = user_clan.clan_id','left');
        $this->db->order_by('thread_reply.created', 'asc');
        $this->db->limit($limit, $offset);
        $this->db->select('thread_reply.*, user.first_name, user.last_name, student.nrp,  clan.id as `clanid`, clan.nama as `namaclan`, user.avatar_image_filename, user.avatar_image_url, (SELECT COUNT(*) FROM thread_likes_reply WHERE thread_id = thread_reply.id) AS `num_likes` ');
        $q = $this->db->get_where('thread_reply', array('thread_reply.thread_id' => $thread_id));

        return $q->result();
    }

    public function get_num_of_reply($thread_id) {
        $q = $this->db->get_where('thread_reply', array('thread_id' => $thread_id));
        return $q->num_rows();
    }

    public function countAllReply($thread_id) {
        $this->db->where('thread_id', $thread_id);
        $count = $this->db->count_all_results("thread_reply");
        return $count;
    }
}

?>
