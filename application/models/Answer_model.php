<?php

class Answer_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
    }

    public function get_quest_res($user, $ques_id) {
        $res= $this->db->query("SELECT * FROM `answer` WHERE `answer`.`teacher_id`='$user' AND `question_id`='$ques_id'");

        if($res->num_rows() > 0 ) {
            $row = $res->row();
            if($row->answer == 5) {
                return 'Outstanding';
            } else if ($row->answer == 4) {
                return 'Very Satisfactory';
            } else if ($row->answer == 3) {
                return 'Satisfactory';
            } else if ($row->answer == 2) {
                return 'Unsatisfactory';
            } else {
                return 'Poor';
            }
        } else {
            return 'None';
        }
    }

    public function get_res($user) {
        $ret = array();
        // scores
        $sql = "SELECT `answer`.`answer`, COUNT(*) AS count 
                FROM `answer` 
                WHERE `teacher_id`='$user'
                GROUP BY `answer`.`answer` 
                ORDER BY count DESC";
        $res = $this->db->query($sql);

        if($res->num_rows() > 0 ) {
            $scores = array();
            foreach ($res->result() as $row) {
                $scores[$row->answer] = $row->count;
            }
            $ret['scores'] = $scores;
        } else {
            return false;
        }
        // Explicit mode
        $sql = "SELECT `answer`.`answer`, COUNT(*) AS count 
                FROM `answer` 
                WHERE `teacher_id`='$user' AND `question_id` <= '15'
                GROUP BY `answer`.`answer` 
                ORDER BY count DESC";
        $res = $this->db->query($sql);
        if($res->num_rows() > 0 ) {
            $row = $res->row();
            if($row->answer == 5) {
                $ret['ec_sc'] = 'Outstanding';
            } else if ($row->answer == 4) {
                $ret['ec_sc'] = 'Very Satisfactory';
            } else if ($row->answer == 3) {
                $ret['ec_sc'] = 'Satisfactory';
            } else if ($row->answer == 2) {
                $ret['ec_sc'] = 'Unsatisfactory';
            } else {
                $ret['ec_sc'] = 'Poor';
            }
        } else {
            return false;
        }
        // Implicit Mode
        $sql = "SELECT `answer`.`answer`, COUNT(*) AS count 
                FROM `answer` 
                WHERE `teacher_id`='$user' AND `question_id` > '15'
                GROUP BY `answer`.`answer` 
                ORDER BY count DESC";
        $res = $this->db->query($sql);
        if($res->num_rows() > 0 ) {
            $row = $res->row();
            if($row->answer == 5) {
                $ret['ic_sc'] = 'Outstanding';
            } else if ($row->answer == 4) {
                $ret['ic_sc'] = 'Very Satisfactory';
            } else if ($row->answer == 3) {
                $ret['ic_sc'] = 'Satisfactory';
            } else if ($row->answer == 2) {
                $ret['ic_sc'] = 'Unsatisfactory';
            } else {
                $ret['ic_sc'] = 'Poor';
            }
        } else {
            return false;
        }
        // Evaluator Count
        $sql = "SELECT count(user_id) AS count
                FROM (SELECT * FROM `answer` WHERE `answer`.`teacher_id`='$user' GROUP BY user_id) T";
        $res = $this->db->query($sql);
        if($res->num_rows() > 0 ) {
            $row = $res->row();
            $ret['eval_count'] = $row->count;
        } else {
            return false;
        }
        // total
        $sql = "SELECT `answer`.`answer`, COUNT(*) AS count 
                FROM `answer` 
                WHERE `teacher_id`='$user'
                GROUP BY `answer`.`answer` 
                ORDER BY count DESC";
        $res = $this->db->query($sql);
        if($res->num_rows() > 0 ) {
            $row = $res->row();
            if($row->answer == 5) {
                $ret['desc_rating'] = 'Outstanding';
            } else if ($row->answer == 4) {
                $ret['desc_rating'] = 'Very Satisfactory';
            } else if ($row->answer == 3) {
                $ret['desc_rating'] = 'Satisfactory';
            } else if ($row->answer == 2) {
                $ret['desc_rating'] = 'Unsatisfactory';
            } else {
                $ret['desc_rating'] = 'Poor';
            }
        } else {
            return false;
        }

        return $ret;
    }

}