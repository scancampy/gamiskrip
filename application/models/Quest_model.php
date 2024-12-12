<?php
class Quest_model extends CI_Model {

    public function checkFirstQuest($user_id) {
       $q =  $this->db->get_where('user_quest', array('user_id' => $user_id)); 
       
       if($q->num_rows == 0) {
        return true;
       }  
    }

    public function getQuest($id = null) {
        if($id != null) {
            $q = $this->db->get_where('master_query', array('id' => $id));
        } else {
            $q = $this->db->get('master_query');
        }
        return $q->result();
    }

    public function getCurrentUserQuest($user_id) {
        $this->db->select('user_quest.*, master_quest.points');
        $this->db->join('master_quest', 'master_quest.id = user_quest.quest_id', 'left');
        $this->db->limit(3);
        $this->db->order_by('quest_finished_date', 'asc');
        $result = $this->db->get_where('user_quest', array('user_quest.user_id' => $user_id));
        return $result->result();
    }

    public function get_finished_quest($user_id, $where = null) {
        $this->db->select('user_quest.*, master_quest.points, master_quest.rendered_caption');
        $this->db->join('master_quest', 'master_quest.id = user_quest.quest_id', 'left');
        $this->db->order_by('quest_finished_date', 'desc');

        if($where != null ) {
            $this->db->where($where);
        }
        $result = $this->db->get_where('user_quest', array('user_quest.user_id' => $user_id,'user_quest.quest_status' => 'finished'));
        return $result->result();
    }

    public function get_user_points($user_id, $start_date, $end_date) {
         $this->db->select('user_quest.user_id, SUM(user_quest.quest_points) as total_points, user.first_name, user.last_name, user.avatar_image_url, student.nrp');
        $this->db->join('user', 'user.id = user_quest.user_id');
        $this->db->join('student', 'student.user_id = user.id');
        $this->db->from('user_quest');
        $this->db->group_by('user_quest.user_id');
        $this->db->order_by('total_points', 'DESC');
        $this->db->where('user_quest.user_id = '.$user_id);
        $this->db->where('user_quest.quest_created_date >= "'.$start_date.'" AND "'.$end_date.'"');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return array();
        }
    }

    public function get_individual_leaderboard($start_date, $end_date) {
        $this->db->select('user_quest.user_id, SUM(user_quest.quest_points) as total_points, user.first_name, user.last_name, user.avatar_image_url, student.nrp, clan.id as `clanid`, clan.nama as `namaclan`');
        $this->db->join('user', 'user.id = user_quest.user_id');
        $this->db->join('student', 'student.user_id = user.id');
        $this->db->join('user_clan', 'user_clan.user_id = user.id','left');
        $this->db->join('clan', 'clan.id = user_clan.clan_id','left');
        $this->db->from('user_quest');
        $this->db->group_by('user_quest.user_id');
        $this->db->order_by('total_points', 'DESC');
        $this->db->where('user_quest.quest_created_date >= "'.$start_date.'" AND user_quest.quest_created_date <= "'.$end_date.'"');
        $query = $this->db->get();

        //echo $this->db->last_query();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return array();
        }
    }

    public function get_individual_top_leaderboard_months() {
        $q = $this->db->get_where('periode', array('is_active' => 1));
        if($q->num_rows() > 0) {
            $hq = $q->row();
            $startPeriode = new DateTime($hq->start_periode);
            $endPeriode = new DateTime($hq->end_periode);

            
            $months = array();
            $k = 0;
            while ($startPeriode < $endPeriode) {  
                $months[$k] = $startPeriode->format('Y-m-d');
                $k++;
                $startPeriode->modify('first day of next month'); 
            } 

           
            foreach ($months as $key => $value) {
                $current = new DateTime();
                $dateEnd = new DateTime($value);
                $dateEnd->modify('last day of this month');

                if($dateEnd < $current) {
                    $result = $this->get_individual_leaderboard($value, $dateEnd->format('Y-m-d'));

                    if(count($result) > 0) {
                        $user_id = $result[0]->user_id;

                        // check apakah sudah unlock achievement months
                        $q = $this->db->get_where('user_achievement', array('user_id' => $user_id, 'achievement_id' => 27));
                        if($q->num_rows() == 0) {
                            $datainsert = array('user_id' => $user_id, 'achievement_id' => 27, 'obtained_date' => date('Y-m-d H:i:s'));
                            $this->db->insert('user_achievement', $datainsert);
                        }
                    }                    
                } else {
                    break;
                }
            }
        }
    }

    public function get_clan_top_leaderboard_months() {
        $q = $this->db->get_where('periode', array('is_active' => 1));
        if($q->num_rows() > 0) {
            $hq = $q->row();
            $startPeriode = new DateTime($hq->start_periode);
            $endPeriode = new DateTime($hq->end_periode);

            
            $months = array();
            $k = 0;
            while ($startPeriode < $endPeriode) {  
                $months[$k] = $startPeriode->format('Y-m-d');
                $k++;
                $startPeriode->modify('first day of next month'); 
            } 

           
            foreach ($months as $key => $value) {
                $current = new DateTime();
                $dateEnd = new DateTime($value);
                $dateEnd->modify('last day of this month');

                if($dateEnd < $current) {
                    $result = $this->get_clan_leaderboard($value, $dateEnd->format('Y-m-d'));

                    if(count($result) > 0) {
                        $clan_id = $result[0]->clan_id;

                        $p = $this->db->get_where('user_clan', array('clan_id' => $clan_id));
                        $hp = $p->result();

                        foreach ($hp as $key => $value) {
                            $user_id = $value->user_id;
                            $q = $this->db->get_where('user_achievement', array('user_id' => $user_id, 'achievement_id' => 28));
                            if($q->num_rows() == 0) {
                                $datainsert = array('user_id' => $user_id, 'achievement_id' => 28, 'obtained_date' => date('Y-m-d H:i:s'));
                                $this->db->insert('user_achievement', $datainsert);
                            }
                        }
                    }                    
                } else {
                    break;
                }
            }
        }
    }


    public function get_clan_leaderboard($start_date, $end_date)
    {
        $this->db->select('clan.id as clan_id, clan.nama, SUM(user_quest.quest_points) as total_points');
        $this->db->from('user_quest');
        $this->db->join('user_clan', 'user_clan.user_id = user_quest.user_id');
        $this->db->join('clan', 'clan.id = user_clan.clan_id');
        $this->db->group_by('clan.id');
        $this->db->order_by('total_points', 'DESC');
        $this->db->where('user_quest.quest_created_date >= "'.$start_date.'" AND user_quest.quest_created_date <= "'.$end_date.'"');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return array();
        }

    }

     public function get_clan_finished_quest($clan_id, $where = null) {
        $this->db->select('user_quest.*, master_quest.points, master_quest.rendered_caption, user.first_name, user.last_name, student.nrp, user.avatar_image_url');
        $this->db->join('master_quest', 'master_quest.id = user_quest.quest_id', 'left');
        $this->db->join('user', 'user.id= user_quest.user_id', 'left');
        $this->db->join('student', 'student.user_id = user_quest.user_id', 'left');
        $this->db->join('user_clan', 'user_clan.user_id = user_quest.user_id', 'left');
        $this->db->join('clan', 'clan.id = user_clan.clan_id');
        $this->db->order_by('quest_finished_date', 'desc');

        if($where != null ) {
            $this->db->where($where);
        }
        $result = $this->db->get_where('user_quest', array('user_quest.quest_status' => 'finished', 'clan.id'=> $clan_id));
        return $result->result();
    }

    public function check_user_quest($quest_label, $user_id) {
        $this->db->select('user_quest.*');
        $this->db->where('user_quest.quest_label = "'.$quest_label.'"');
        $this->db->where('user_quest.user_id = '.$user_id);
        $this->db->where('user_quest.quest_status = "active"');
        $q = $this->db->get('user_quest');
        if($q->num_rows() > 0) {
            $hq = $q->row();
            return $this->quest_finished($hq->id);
        } else {
            return false;
        }
    }

    public function get_user_quest_id($quest_label, $user_id) {
        $this->db->select('user_quest.*');
        $this->db->where('user_quest.quest_label = "'.$quest_label.'"');
        $this->db->where('user_quest.user_id = '.$user_id);
        $this->db->where('user_quest.quest_status = "active"');
        $q = $this->db->get('user_quest');
        if($q->num_rows() > 0) {
            $hq = $q->row();
            return $hq->id;
        } else {
            return false;
        }
    }

    public function submit_rating($id, $user_id, $rating) {
        $data = array( 'quest_rating' => $rating);
        $this->db->where('id = '.$id);
        $this->db->where('user_id = '.$user_id);
        $this->db->update('user_quest', $data);
    }

    public function quest_finished($id) {
        $timezone = new DateTimeZone('Asia/Jakarta');     
        $q = $this->db->get_where('user_quest', array('id' => $id));
        $userid = null;

        // cek repeated
        if($q->num_rows() > 0) {
            $hq = $q->row();
            $userid = $hq->user_id;

            $mq = $this->db->get_where('master_quest', array('id' => $hq->quest_id));
            $hmq= $mq->row();

            if($hq->repeated_by != '') {
                // cek if eligble to solve the quest
                $eligibleRepeat = false;
                // cek last repeated date
                if($hq->last_repeat_date != null) {
                    // die();
                    if($hq->repeated_by == 'weekly') {
                        $date = new DateTime($hq->last_repeat_date);
                        // Find the Monday (start of the week)
                        $startOfWeek = clone $date->modify('Monday this week');

                        // Find the Sunday (end of the week)
                        $endOfWeek = clone $date->modify('Sunday this week');
                        $endOfWeek->setTime(23, 59, 0);  // Set time to 23:59:00

                        // Get the current date and DateTime    
                        $now = new DateTime('now', $timezone);

                        // Compare if the current time is greater than $endOfWeek
                        if ($now > $endOfWeek) {
                          $eligibleRepeat = true;
                         // die();
                        } 
                    } else if($hq->repeated_by == 'daily') {
                        $now = new DateTime('now', $timezone);
                        $date = new DateTime($hq->last_repeat_date);
                        $nowFormatted = $now->format('Y-m-d');   // Format as 'YYYY-MM-DD'
                        $dateFormatted = $date->format('Y-m-d'); // Format as 'YYYY-MM-DD'

                        if($nowFormatted != $dateFormatted) {
                            $eligibleRepeat = true;
                        } else {
                            $eligibleRepeat = false;
                        }
                    } else {
                        $eligibleRepeat = true; //number
                    }

                    if($eligibleRepeat == true) {
                        // cek finish atau tidak
                        if($hq->number_of_repetition_done + 1 == $hq->repeated_need) {
                            $data = array(
                                'quest_points'              => $hmq->points * $hq->repeated_need,
                                'quest_finished_date'       => date('Y-m-d H:i:s'),                                
                                'last_repeat_date'       => date('Y-m-d H:i:s'),
                                'quest_status'              => 'finished',
                                'number_of_repetition_done' => $hq->number_of_repetition_done+1
                            );
                            $this->db->where('id', $id);
                            $this->db->update('user_quest', $data);

                            $this->check_quest_complete_achievement($userid);
                            return true;
                        } else {
                            $data = array(
                                'last_repeat_date'       => date('Y-m-d H:i:s'),
                                'number_of_repetition_done' => $hq->number_of_repetition_done+1
                            );
                            $this->db->where('id', $id);
                            $this->db->update('user_quest', $data);

                            return false;
                        }                        
                    } 
                } else {
                    // baru pertama kali
                    // cek finish atau tidak
                    if($hq->number_of_repetition_done + 1 == $hq->repeated_need) {
                        $data = array(
                            'quest_points'              => $hmq->points * $hq->repeated_need,
                            'quest_finished_date'       => date('Y-m-d H:i:s'),                            
                            'last_repeat_date'       => date('Y-m-d H:i:s'),
                            'quest_status'              => 'finished',
                            'number_of_repetition_done' => $hq->number_of_repetition_done+1
                        );
                        $this->db->where('id', $id);
                        $this->db->update('user_quest', $data);

                        $this->check_quest_complete_achievement($userid);

                        return true;
                    } else {
                        $data = array(
                            'last_repeat_date'       => date('Y-m-d H:i:s'),
                            'number_of_repetition_done' => $hq->number_of_repetition_done+1
                        );
                        $this->db->where('id', $id);
                        $this->db->update('user_quest', $data);

                        return false;
                    }   
                }  

            } else {
                $q_master_quest = $this->db->get_where('master_quest', array('id' => $id));
                $hq_master_quest = $q_master_quest->row();
                $point = $hq_master_quest->points;

                $data = array(
                    'quest_points'              => $hmq->points,
                    'quest_finished_date'       => date('Y-m-d H:i:s'),
                    'quest_status'              => 'finished',
                    'number_of_repetition_done' => $hq->number_of_repetition_done+1
                );

                $this->db->where('id', $id);
                $this->db->update('user_quest', $data);

                $this->check_quest_complete_achievement($userid);

                return true;
            }
        } else {
            return false;
        }
    }

    public function check_quest_complete_achievement($user_id) {
        // first quest achievement
        $q = $this->db->get_where('user_achievement', array('user_id' => $user_id, 'achievement_id' => 1));
        if($q->num_rows() == 0) {
            $datainsert = array('user_id' => $user_id, 'achievement_id' => 1, 'obtained_date' => date('Y-m-d H:i:s'));
            $this->db->insert('user_achievement', $datainsert);
        }

        $p = $this->db->get_where('user_quest', array('user_id' => $user_id, 'quest_status' => 'finished'));
        $totalquest = $p->num_rows();

        // 20 quest completed
        $q = $this->db->get_where('user_achievement', array('user_id' => $user_id, 'achievement_id' => 18));
        if($q->num_rows() == 0) {
            if($totalquest >= 20) {
                $datainsert = array('user_id' => $user_id, 'achievement_id' => 18, 'obtained_date' => date('Y-m-d H:i:s'));
                $this->db->insert('user_achievement', $datainsert);
            }
        }

        // 50 quest completed
        $q = $this->db->get_where('user_achievement', array('user_id' => $user_id, 'achievement_id' => 19));
        if($q->num_rows() == 0) {
            if($totalquest >= 50) {
                $datainsert = array('user_id' => $user_id, 'achievement_id' => 19, 'obtained_date' => date('Y-m-d H:i:s'));
                $this->db->insert('user_achievement', $datainsert);
            }
        }

        // 75 quest completed
        $q = $this->db->get_where('user_achievement', array('user_id' => $user_id, 'achievement_id' => 20));
        if($q->num_rows() == 0) {
            if($totalquest >= 75) {
                $datainsert = array('user_id' => $user_id, 'achievement_id' => 20, 'obtained_date' => date('Y-m-d H:i:s'));
                $this->db->insert('user_achievement', $datainsert);
            }
        }

        $this->db->select_sum('quest_points');
        $this->db->where('user_id', $user_id);
        $this->db->where('quest_status', 'finished');
        $query = $this->db->get('user_quest');
        $result = $query->row();

        // achieve 50 points
        $q = $this->db->get_where('user_achievement', array('user_id' => $user_id, 'achievement_id' => 24));
        if($q->num_rows() == 0) {
            if($result->quest_points >= 50) {
                $datainsert = array('user_id' => $user_id, 'achievement_id' => 24, 'obtained_date' => date('Y-m-d H:i:s'));
                $this->db->insert('user_achievement', $datainsert);
            }
        }

        //achieve 100 points
        $q = $this->db->get_where('user_achievement', array('user_id' => $user_id, 'achievement_id' => 25));
        if($q->num_rows() == 0) {
            if($result->quest_points >= 100) {
                $datainsert = array('user_id' => $user_id, 'achievement_id' => 25, 'obtained_date' => date('Y-m-d H:i:s'));
                $this->db->insert('user_achievement', $datainsert);
            }
        }

        // achieve 200 points
        $q = $this->db->get_where('user_achievement', array('user_id' => $user_id, 'achievement_id' => 26));
        if($q->num_rows() == 0) {
            if($result->quest_points >= 200) {
                $datainsert = array('user_id' => $user_id, 'achievement_id' => 26, 'obtained_date' => date('Y-m-d H:i:s'));
                $this->db->insert('user_achievement', $datainsert);
            }
        }
    }

    // Function to perform weighted random selection
    public function weighted_random($player_style_weight) {
        // Calculate the total weight sum
        $total_weight = array_sum($player_style_weight);

        //echo 'Total weight: '.$total_weight;
        //echo '<br/>';
        /*foreach ($player_style_weight as $style => $weight) {
            echo 'style - '.$style.' : '.$weight;
            echo '<br/>';   
        }*/
        
        // Generate a random number between 0 and the total weight
        $random = rand(0, $total_weight - 1);
       // echo 'Random = '.$random;
        // echo '<br/>';  

        // Iterate through the player styles and find the one that corresponds to the random number
        $cumulative_weight = 0;
        foreach ($player_style_weight as $style => $weight) {
            $cumulative_weight += $weight;
            if ($random < $cumulative_weight) {
              //  echo 'Chosen style: '.$style;
                return $style;
            }
        }
    }

    function weighted_random_selection($questWeight, $total_weight, $resQuest) {
        // Generate a random number between 0 and total_weight
        $random = mt_rand(0, $total_weight * 1000) / 1000; // Use mt_rand for better randomization

        $cumulative_weight = 0.0;

        // Iterate over quests and weights to perform selection
        foreach ($questWeight as $key => $weight) {
            $cumulative_weight += $weight;

            // If the random number is less than the cumulative weight, select this quest
            if ($random <= $cumulative_weight) {
                return $resQuest[$key]; // Return the selected quest object
            }
        }

        // Just in case no quest is selected (which should never happen), return the last quest
        return end($resQuest);
    }

    public function generateQuestAllUser() {
        $this->db->join('student', 'student.user_id = user.id', 'left');        
        $this->db->join('tugas_akhir', 'tugas_akhir.student_id = user.id', 'left');
        $this->db->where('student.player_style <> ""');
        $this->db->where('tugas_akhir.is_active = 1');
        $q = $this->db->get_where('user', array('user_type' => 'student'));

        $hq = $q->result();
        foreach ($hq as $key => $value) {
            $this->generateNewQuest($value->id);
        }
    }


    public function generateNewQuest($user_id) {    
        // get act
        $act = null;
        $q = $this->db->get_where('tugas_akhir', array('student_id' => $user_id));
        if($q->num_rows() > 0) {
            $hq = $q->row();
            $act = $hq->progress;
        } else {
            return false;
        }

        // 1. check if student already have 3 active quest
        $qCreateQuest = $this->db->get_where('user_quest', array('user_id' => $user_id, 'quest_status' => 'active'));
        $createQuest = 3- $qCreateQuest->num_rows();

        $q = $this->db->get_where('student', array('user_id' => $user_id));
        $resq = $q->row();

        $player_style_weight = array(
            'socializer'        => $resq->socializer,
            'philanthropist'    => $resq->philanthropist,
            'free_spirit'       => $resq->free_spirit,
            'achiever'          => $resq->achiever,
            'players'            => $resq->players
        );

        //echo $createQuest;
        
        while($createQuest > 0) {

            $playertype= $this->weighted_random($player_style_weight);
           

            $q = $this->db->get_where('master_player_type', array('nama' => $playertype ));
            $resq = $q->row();

            // list available quest berdasarkan player style dan act student
            $this->db->select('master_quest.*');
           // $this->db->join('quest_has_player_type', 'quest_has_player_type.quest_id = master_quest.id');
            $this->db->where('master_quest.player_style = '.$resq->id);
            $this->db->where('master_quest.act_id = '.$act);
            $quest = $this->db->get('master_quest');

            $resQuest = $quest->result();
            $questWeight = array();
            $total_weight = 0.0;

            // get current active periode
            $qperiode = $this->db->get_where('periode', array('is_active' => 1));
            $resperiode = $qperiode->row();

            foreach ($resQuest as $key => $value) {
                // check if user already set rating for the quest
                $this->db->select_avg('quest_rating');
                $this->db->where('quest_status', 'finished');
                $this->db->where('quest_label', $value->label);
                $this->db->where('quest_finished_date >=', $resperiode->start_periode);
                $this->db->where('quest_finished_date <=', $resperiode->end_periode);
                $qRating = $this->db->get('user_quest');
                $resRating = $qRating->row();

                if($resRating->quest_rating > 0.0) {
                    $questWeight[$key] = $resRating->quest_rating;
                    $total_weight += $resRating->quest_rating;
                } else {
                    $questWeight[$key] = 3.0;
                    $total_weight += 3.0;
                }                
            }

            // Perform weighted random selection
            $selected_quest = $this->weighted_random_selection($questWeight, $total_weight, $resQuest);



            // cek selected quest id apakah sudah ada di quest si user yg sedang aktif           
            $cekQuest = $this->db->get_where('user_quest', array('user_id' => $user_id, 'quest_status' => 'active', 'quest_label' => $selected_quest->label));

            if($cekQuest->num_rows() == 0) {

                // cek for repeated
                if($selected_quest->repeated_by != null) {
                    $random_repetition = mt_rand(2, 5);
                    $qRepeat = $this->db->get_where('master_quest', array('id' => $selected_quest->id));
                    $rowRepeat = $qRepeat->row();
                    $repeated_by = $rowRepeat->repeated_by;
                } else {
                    $random_repetition = 1;
                    $repeated_by = "";
                }


                $desc = explode(";", $selected_quest->description);
                $jml = count($desc);
                $rnd = (int)mt_rand(0,$jml-1);
                $quest_desc = trim($desc[$rnd]);


                // insert quest
                $dataInsert = array(
                    'quest_created_date'        => date('Y-m-d H:i:s'),
                    'user_id'                   => $user_id,
                    'quest_id'                  => $selected_quest->id,
                    'quest_label'               => $selected_quest->label,
                    'quest_desc'                => $quest_desc,
                    'repeated_need'             => $random_repetition,
                    'repeated_by'               => $repeated_by,
                    'number_of_repetition_done' => 0,
                    'quest_status'              => 'active'
                );

                $this->db->insert('user_quest', $dataInsert);


               // print_r($selected_quest);

                $createQuest--;
            }
        }
       
    }

    public function getUserAchievements($user_id) {
        $timezone = new DateTimeZone('Asia/Jakarta'); 
        $q = $this->db->get_where('master_achievement');

        $hq = $q->result();
        $array = array();
        foreach ($hq as $key => $value) {
            $p = $this->db->get_where('user_achievement', array('achievement_id' => $value->id, 'user_id' => $user_id));

            if($p->num_rows() > 0) {
                $hp = $p->row();
                $array[$key]['achievement'] = $value;
                $array[$key]['obtained_date'] = $hp->obtained_date; 
            } else {
                $array[$key] = false;
            }
        }

        return $array;
    }
}

?>
