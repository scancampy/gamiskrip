<?php
class Clan_model extends CI_Model {

    // Function to get a specific clan by its ID
    public function get_clan_by_id($id) {
        $query = $this->db->get_where('clan', array('id' => $id));
        return $query->result(); // Return a single row as an array
    }

    public function get_clan_by_user($user_id) {
        // Select the clan data by joining clan and user_clan tables
        $this->db->select('clan.*');
        $this->db->from('clan');
        $this->db->join('user_clan', 'clan.id = user_clan.clan_id');
        $this->db->where('user_clan.user_id', $user_id);
        $query = $this->db->get();

        return $query->row(); // Return the clan data as an array
    }

     // first clan visit achievement
    public function check_visit_clan_achievement($user_id) {
            $q = $this->db->get_where('user_achievement', array('user_id' => $user_id, 'achievement_id' => 8));
            if($q->num_rows() == 0) {
                $datainsert = array('user_id' => $user_id, 'achievement_id' => 8, 'obtained_date' => date('Y-m-d H:i:s'));
                $this->db->insert('user_achievement', $datainsert);
            }
    }

    // Function to get all clans
    public function get_all_clans() {
        $query = $this->db->get('clan');
        return $query->result(); // Return all rows as an array
    }

    // Function to update a clan by its ID
    public function update_clan($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('clan', $data); // Update clan with the given ID
    }

    // Function to delete a clan by its ID
    public function delete_clan($id) {
        $this->db->where('id', $id);
        return $this->db->delete('clan'); // Delete the clan with the given ID
    }

    // Function to check if user already have clan
    public function is_user_have_clan($user_id) {
        $existing = $this->db->get_where('user_clan', array('user_id' => $user_id));
        
        if ($existing->num_rows() == 0) {
            return false;
        } else {
            return true; // User already assigned to the clan
        }
    }

    // Function to assign a user to a clan
    public function assign_user_to_clan($user_id) {
        $clan_id = $this->get_clan_with_least_members();

        // Check if the user is already assigned to this clan
        if($this->is_user_have_clan($user_id) == false) {
            // Assign the user to the clan if not already assigned
            return $this->db->insert('user_clan', array('user_id' => $user_id, 'clan_id' => $clan_id[0]->id));
        } else {
            return false; // User already assigned to the clan
        }
    }

    // Function to remove a user from a clan
    public function remove_user_from_clan($user_id, $clan_id) {
        $this->db->where(array('user_id' => $user_id, 'clan_id' => $clan_id));
        return $this->db->delete('user_clan'); // Remove the user from the clan
    }

    // Function to get all users belonging to a specific clan
    public function get_users_by_clan($clan_id) {
        // Subquery to get the start and end date of the active periode
        $this->db->select('start_periode, end_periode');
        $this->db->from('periode');
        $this->db->where('is_active', 1); // Get the active periode
        $periode = $this->db->get()->row(); // Fetch the active period
        
        if (!$periode) {
            return []; // If no active period, return empty result
        }

        // Main query to get users along with their total points in the active period
        $this->db->select('student.user_id, student.fullname, student.nrp, SUM(user_quest.quest_points) as total_points');
        $this->db->from('user_clan');
        $this->db->join('student', 'user_clan.user_id = student.user_id', 'left'); // Join with student table
        $this->db->join('user_quest', 'user_quest.user_id = student.user_id AND user_quest.quest_created_date BETWEEN \''.$periode->start_periode.'\' AND \''.$periode->end_periode.'\'', 'left'); // Join with user_point and filter by active periode
        $this->db->where('user_clan.clan_id', $clan_id);
        $this->db->where('student.is_deleted', 0); // Optional: exclude deleted users
        $this->db->group_by('student.user_id'); // Group by user to sum points for each user
        $this->db->order_by('total_points', 'DESC');
        $query = $this->db->get();

       // echo $this->db->last_query();

        return $query->result(); // Return the result as an array of user objects
    }


    // Function to get clan ID with the least members
    public function get_clan_with_least_members() {
        // Build the query to count users per clan and get the clan with the least members
        $this->db->select('clan.id, COUNT(user_clan.user_id) as member_count');
        $this->db->from('clan');
        $this->db->join('user_clan', 'clan.id = user_clan.clan_id', 'left'); // Left join to count even if there are no users
        $this->db->group_by('clan.id'); // Group by clan ID to count members
        $this->db->order_by('member_count', 'ASC'); // Order by the member count in ascending order
        $this->db->limit(1); // Limit the result to get only the clan with the least members
        $query = $this->db->get();

        return $query->result(); // Return the result as an array
    }

    // CLAN CHAT
    public function insert_clan_chat($clan_id, $user_id, $message) {
        // Prepare the data to insert into the clan_chat table
        $data = array(
            'clan_id' => $clan_id,
            'user_id' => $user_id,
            'message' => $message,
            'timestamp' => date('Y-m-d H:i:s') // Using current timestamp in case needed explicitly
        );

        // Insert the data into the clan_chat table
        $a =  $this->db->insert('clan_chat', $data);
        $this->check_clan_achievement($user_id);
        return $a;
    }

    public function check_clan_achievement($user_id) {
        // first chat in clan
        $q = $this->db->get_where('user_achievement', array('user_id' => $user_id, 'achievement_id' => 5));
        if($q->num_rows() == 0) {
            $datainsert = array('user_id' => $user_id, 'achievement_id' => 5, 'obtained_date' => date('Y-m-d H:i:s'));
            $this->db->insert('user_achievement', $datainsert);
        }
    }

    public function get_clan_chat_by_chunk($clan_id, $limit = 20, $last_timestamp = null) {
        // Select the necessary fields along with the count of likes
        $this->db->select('clan_chat.message, student.fullname, student.nrp, clan_chat.timestamp, user.avatar_image_url, clan_chat.id, 
                           (SELECT COUNT(*) FROM chat_likes WHERE chat_likes.chat_id = clan_chat.id) AS like_count');
        $this->db->from('clan_chat');
        $this->db->join('student', 'clan_chat.user_id = student.user_id', 'left'); 
        $this->db->join('user', 'clan_chat.user_id = user.id', 'left'); 
        $this->db->where('clan_chat.clan_id', $clan_id);

        // If last_timestamp is provided, load older messages
        if ($last_timestamp) {
            $this->db->where('clan_chat.timestamp <', $last_timestamp); // Load messages before the last loaded timestamp
        }

        // Order by timestamp to get the most recent first
        $this->db->order_by('clan_chat.timestamp', 'DESC');

        // Limit the number of messages retrieved
        $this->db->limit($limit);

        $query = $this->db->get();

        // Return the result as an array of chat messages with like count
        return $query->result(); // Return as an array of chat data
    }


    public function toggle_like_chat($chat_id, $user_id) {
        // Check if the like already exists
        $this->db->where('chat_id', $chat_id);
        $this->db->where('user_id', $user_id);
        $query = $this->db->get('chat_likes');

        if ($query->num_rows() > 0) {
            // If the like exists, delete it (unlike)
            $this->db->where('chat_id', $chat_id);
            $this->db->where('user_id', $user_id);
            $this->db->delete('chat_likes'); // Perform the delete operation
        } else {
            // If the like does not exist, insert it (like)
            $data = array(
                'chat_id' => $chat_id,
                'user_id' => $user_id,
                'created_at' => date('Y-m-d H:i:s') // Optional, as the database sets it automatically
            );
            $this->db->insert('chat_likes', $data); // Perform the insert operation

            $this->check_clan_likes_complete_achievement($user_id);
        }

        // Return the number of likes for the chat message
        $this->db->where('chat_id', $chat_id);
        $like_count_query = $this->db->get('chat_likes');
        return $like_count_query->num_rows(); // Return the count of likes
    }

    public function check_clan_likes_complete_achievement($user_id) {
        // first likes in clan chat
        $q = $this->db->get_where('user_achievement', array('user_id' => $user_id, 'achievement_id' => 6));
        if($q->num_rows() == 0) {
            $datainsert = array('user_id' => $user_id, 'achievement_id' => 6, 'obtained_date' => date('Y-m-d H:i:s'));
            $this->db->insert('user_achievement', $datainsert);
        }
    }



}

?>
