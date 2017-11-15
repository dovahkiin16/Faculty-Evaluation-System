<?php

class Schedule_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
    }

    public function check_sched($id) {
        //check he's scheduled ATM
        $section = $this->session->userdata('userSectionId');
        $sql = "SELECT * FROM `schedule` WHERE `section_id` AND NOW() BETWEEN `start_time` AND `end_time`";
        $res = $this->db->query($sql);
        if($res->num_rows() == 0) {
            $this->session->set_flashdata('err', "You're not scheduled to evaluate now");
            return false;
        }

        // check teachers left to evaluate
        $sql = "SELECT `user`.`id`, `schedule`.`teacher_id` 
                FROM `user`
                INNER JOIN `schedule`
                ON `user`.`section_id`=`schedule`.`section_id` 
                WHERE `user`.`type`='student' 
                AND `user`.`id`='$id'
                AND `schedule`.`teacher_id` NOT IN (SELECT `teacher_id` FROM `answer` WHERE `user_id`='$id')
                ORDER BY `user`.`id` ASC, `schedule`.`teacher_id` ASC";
        $res = $this->db->query($sql);
        if($res->num_rows() > 0) {
            return $res;
        }

        // check if he's done evaluating or isn't scheduled
        $sql = "SELECT * FROM `answer` WHERE user_id='$id'";
        $res = $this->db->query($sql);
        if($res->num_rows() > 0 ) {
            $this->session->set_flashdata('err',"You're done evaluating! Thank you for your participation!");
        } else {
            $this->session->set_flashdata('err',"You're not scheduled. Please ask the administrator for assistance.");
        }
        return false;
    }

    public function get_schedules() {
        $query = $this->db->query("SELECT `schedule`.`exam_room_no`, `schedule`.`start_time`,`schedule`.`end_time`, `section`.`name` AS sname, `section`.`level` AS slevel, `user`.`fname` AS fname, `user`.`lname` AS lname
                              FROM `schedule` 
                              INNER JOIN `section` ON `schedule`.`section_id`=`section`.`id`
                              INNER JOIN `user` ON `schedule`.`teacher_id`=`user`.`id`");
        $result = array();
        foreach ($query->result_array() as $row) {
            $name = $row['slevel']."-".$row['sname'];
            $result[$name] = $row;
        }
        return $result;
    }

    public function insert_schedule() {
        // check if evaluator or evaluatee is empty
        if(!$this->input->post('evaluator')){
            $this->session->set_flashdata('sched_err', 'Evaluator cannot be empty');
            return false;
        }

        // fetch inputs
        $year = $this->input->post('year');
        $month = $this->input->post('month');
        $day = $this->input->post('day');
        $time = $this->input->post('time');
        $hour = (explode(':', $time)[0]);
        $hour = (substr($time, -2)) == 'PM' ? $hour+12 : $hour;
        $min = (substr(explode(':',$time)[1], 0, 2));
        $sdate = new DateTime("$year-$month-$day $hour:$min");
        $edate = new DateTime("$year-$month-$day $hour:$min");
        $edate->add(new DateInterval("PT59M"));
        $room = $this->input->post('room');
        $evaluators = $this->input->post('evaluator');
        $evaluatees = $this->input->post('evaluatee');

        // check time validity
        $now = date("Y-m-d H:i:s");
        if(strtotime($now) >= strtotime($sdate->format("Y-m-d H:i:s"))) {
            $this->session->set_flashdata('sched_err', 'Invalid Time');
            $this->session->set_flashdata('sched_year', $year);
            $this->session->set_flashdata('sched_month', $month);
            $this->session->set_flashdata('sched_day', $day);
            $this->session->set_flashdata('sched_time', $time);
            $this->session->set_flashdata('sched_room', $room);
            return false;
        }
        $stime = $sdate->format("Y-m-d H:i:s");

        // check schedule availability
        $sql = "SELECT * FROM `schedule` 
                WHERE '$stime' 
                BETWEEN `schedule`.`start_time` AND `schedule`.`end_time` 
                AND `schedule`.`exam_room_no`='$room'";
        if(!($this->db->query("$sql"))->num_rows() == 0) {
            $this->session->set_flashdata('sched_err', 'Schedule is occupied');
            $this->session->set_flashdata('sched_year', $year);
            $this->session->set_flashdata('sched_month', $month);
            $this->session->set_flashdata('sched_day', $day);
            $this->session->set_flashdata('sched_time', $time);
            return false;
        }

        // insert data
        $this->db->trans_start();
        foreach($evaluators as $evaluator) {
            $query = $this->db->query("SELECT * FROM subject_teacher WHERE section_id='$evaluator'");
            foreach ($query->result() as $teacher) {
                $isd = NULL;
                $start_time = $sdate->format("Y-m-d H:i:s");
                $end_time = $edate->format("Y-m-d H:i:s");
                $exam_room_no = $room;
                $section_id = $evaluator;
                $teacher_id = $teacher->teacher_id;
                $this->db->query("INSERT INTO schedule 
                    VALUES('$isd', '$start_time', '$end_time', '$exam_room_no', '$section_id', '$teacher_id', NOW())");
            }
        }
        echo "ASDFASDFASDFASDF";
        $this->db->trans_complete();
        return $this->db->trans_status();
    }
}