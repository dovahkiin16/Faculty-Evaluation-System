<?php
class Section_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
    }

    public function fetch_section($id=NULL) {
        $sql = '';
        if($id==NULL) {
            $sql = "SELECT * FROM `section`";
        } else {
            $sql = "SELECT * FROM `section` WHERE `id`='$id'";
        }
        $query = $this->db->query($sql);
        if($query->num_rows() > 0) {
            if($id==NULL) {
                return $query->result();
            } else {
                return $query->row();
            }
        } else {
            return false;
        }
    }

    public function fetch_evaluator() {
        $sql = "SELECT * FROM `section` WHERE `id` NOT IN (SELECT `section_id` FROM `schedule`)";
        $query = $this->db->query($sql);
        if($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function fetch_section_with_student() {
        $sql = "SELECT * FROM `section` ORDER BY `level` ASC, `name` ASC";
        $query = $this->db->query($sql);
        if($query->num_rows() > 0) {
            $res = array();
            foreach ($query->result_array() as $row) {
                $id = $row['id'];
                $sql2 = "SELECT * FROM `user` WHERE `type`='student' AND `confirmed`='1' AND `section_id`='$id' ORDER BY lname";
                $query2 = $this->db->query($sql2);
                $students = array();
                foreach ($query2->result() as $row2) {
                    array_push($students, $row2);
                }
                $row['students'] = $students;
                array_push($res, $row);
            }
            return $res;
        } else {
            return false;
        }
    }

    public function add_section() {
        $level = $this->input->post('level');
        $name = $this->input->post('name');
        $teachers = $this->input->post('evaluatee');
        $this->db->trans_start();
        $sql = "INSERT INTO `section` VALUES(NULL, ?, ?, NOW())";
        $this->db->query($sql, array($level, $name));
        $id = $this->db->insert_id();
        foreach($teachers as $teacher) {
            $this->db->query("INSERT INTO `subject_teacher` VALUES(null, '$teacher', '$id')");
        }
        $this->db->trans_complete();
        return $this->db->trans_status();
    }
}