<?php
class Timeline_model extends CI_Model {

	public function insert_timeline($user_id, $content) {
	    $data = array(
	        'user_id'          => $user_id,
	        'content'               => $content,
	        'created'               => date('Y-m-d H:i:s')
	    );

	    $this->db->insert('timeline', $data);
	    return $this->db->insert_id();
	}

	public function get_timeline_by_chunk($where = null, $limit = 20, $last_timestamp = null) {
        // Select the necessary fields along with the count of likes
        $this->db->select('timeline.*, student.fullname, student.nrp, user.avatar_image_url, clan.id as `clanid`, clan.nama as `namaclan`');
        $this->db->from('timeline');
        $this->db->join('student', 'timeline.user_id = student.user_id', 'left'); 
        $this->db->join('user', 'timeline.user_id = user.id', 'left'); 
        $this->db->join('user_clan', 'user_clan.user_id = user.id','left');
        $this->db->join('clan', 'clan.id = user_clan.clan_id','left');

        if($where != null) {
        	$this->db->where($where);
        }

        // If last_timestamp is provided, load older messages
        if ($last_timestamp) {
            $this->db->where('timeline.created <', $last_timestamp); // Load messages before the last loaded timestamp
        }

        // Order by timestamp to get the most recent first
        $this->db->order_by('timeline.created', 'DESC');

        // Limit the number of messages retrieved
        $this->db->limit($limit);

        $query = $this->db->get();

        // Return the result as an array of chat messages with like count
        return $query->result(); // Return as an array of chat data
    }

} ?>