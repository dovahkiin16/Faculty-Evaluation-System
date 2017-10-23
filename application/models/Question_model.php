<?php

class Question_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
    }

    public function get_question($section) {
        $sql = "SELECT * FROM `question` WHERE `section`='$section'";
        $res = $this->db->query($sql);
        if($res->num_rows() > 0) {
            return $res->result();
        } else {
            return false;
        }
    }

    public function submit_answer() {
        $user = $this->session->userdata('userId');
        $teacher = $this->input->post('teacher');
        $this->db->trans_start();
        for($i = 1; $i < 30; $i++) {
            $ans = $this->input->post("q-$i");
            $data = array(
                'user_id' => $user,
                'question_id' => $i,
                'teacher_id' =>$teacher,
                'answer' =>$ans
            );
            $this->db->insert('answer', $data);
        }
        $this->db->trans_complete();
        return $this->db->trans_status();
    }
}