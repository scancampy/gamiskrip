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

    public function insertThread($thread_title, $content, $created_by_user_id, $parent_folder_id=null, $is_locked=0) {
        $data = array(
            'thread_title'          => $thread_title,
            'content'               => $content,
            'created'               => date('Y-m-d H:i:s'),
            'created_by_user_id'    => $created_by_user_id,
            'parent_folder_id'      => $parent_folder_id,
            'is_locked'             => $is_locked
        );

        $this->db->insert('thread', $data);
        return $this->db->insert_id();
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
        $this->db->select('thread.*, user.first_name, user.last_name, user. avatar_image_filename');
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
    }

    public function getThreadReply($thread_id) {
        $this->db->join('user', 'user.id = thread_reply.created_by_user_id', 'left');
        $this->db->order_by('thread_reply.created', 'asc');
        $this->db->select('thread_reply.*, user.first_name, user.last_name, user.avatar_image_filename');
        $q = $this->db->get_where('thread_reply', array('thread_reply.thread_id' => $thread_id));

        return $q->result();
    }
}

?>
