<?php

class User_model extends CI_Model{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
    }

    public function signin() {
        $username = $this->input->post('username');
        $pass = $this->input->post('pass');
        $sql = "SELECT * FROM `user` WHERE `id_number`=?";
        $query = $this->db->query($sql, array($username));
        if($query->num_rows() > 0) {
            $row = $query->row();
            if(password_verify($pass, $row->pwd)) {
                $this->session->set_userdata('name', $row->lname.", ".$row->fname );
                $this->session->set_userdata('userId', $row->id);
                $this->session->set_userdata('userSectionId', $row->section_id);
                $this->session->set_userdata('userType', $row->type);
                $this->session->set_userdata('user_confirm', $row->confirmed);
                return true;
            }
        }
        return false;
    }

    public function register() {
        $type = $this->input->post('user_type');
        $fname = $this->input->post('fname');
        $lname = $this->input->post('lname');
        $username = $this->input->post('username');
        $pwd = $this->input->post('password');
        $section = $this->input->post('section');
        if($section == -1 && $type == "student") {
            $this->session->set_flashdata('register_err', 'Students must put their section.');
            return false;
        }
        $pass = password_hash($pwd, PASSWORD_BCRYPT);
        $find_user = "SELECT * FROM `$type` WHERE ".($type=="teacher"?"employee_no":"lrn")."='$username'";
        $users = $this->db->query($find_user);
        if($users->num_rows() > 0 ) {
            $sql = "INSERT INTO `user` VALUES(NULL, ?, ?,?, ?, ?, ?, NOW(), 1)";
            $this->db->query($sql, array($type, $fname, $lname, $username, $pass, $section==-1? null: $section));
            if($this->db->affected_rows() > 0) {
                $name = $lname . ", " . $fname;
                $this->session->set_userdata('name', $name);
                $this->session->set_userdata('userId', $this->db->insert_id());
                $this->session->set_userdata('userType', $type);
                $this->session->set_userdata('user_section', $section);
                return true;
            } else {
                $this->session->set_flashdata('register_err', 'LRN/Employee number already exists');
                return false;
            }
        } else {
            $this->session->set_flashdata('register_err', 'LRN/Employee number not found');
            return false;
        }
    }

    public function delete_user($userId) {
        if(!is_array($userId)) {
            $this->db->simple_query("DELETE FROM `user` WHERE id='$userId'");
            if($this->db->affected_rows() > 0) {
                return "success";
            }
            return $this->db->error();
        } else {
            $this->db->trans_begin();
            foreach ($userId as $user) {
                $this->db->where('id', $user);
                $this->db->delete('user');
            }
            $this->db->trans_complete();
            return $this->db->trans_status();
        }
    }

    public function confirm_user($userId) {
        if(!is_array($userId)) {
            return $this->db->update('user', array('confirmed'=>'1'), array('id'=>$userId));
        } else {
            $this->db->trans_begin();
            foreach ($userId as $user) {
                $this->db->update('user', array('confirmed'=>'1'), array('id'=>$user));
            }
            $this->db->trans_complete();
            return $this->db->trans_status();
        }
    }

    public function fetch_user($id=NULL) {
        $sql = '';

        if($id==NULL) {
            $sql = "SELECT * FROM `user` ORDER BY `user`.`lname` ASC";
        } else {
            $sql = "SELECT * FROM `user` WHERE `id`='$id' ORDER BY `user`.`lname` ASC";
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

    public function fetch_teacher() {
        $sql = "SELECT * FROM `user` 
                WHERE `user`.type='teacher' 
                ORDER BY `user`.`lname` ASC";
        $query = $this->db->query($sql);
        if($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function fetch_evaluatee() {
        $sql = "SELECT * FROM `user` WHERE `confirmed`='1' AND `type`='teacher'";
        $query = $this->db->query($sql);
        if($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function fetch_teachers() {
        $query = $this->db->query("SELECT * FROM user WHERE type='teacher' && confirmed='1'");
        return $query->result_array();
    }

    public function fetch_students() {
        $query = $this->db->query("SELECT `user`.*, section.level, section.name
                                        FROM user 
                                        INNER JOIN section on section_id=`section`.`id`
                                        WHERE type='student' && confirmed='1'
                                        ORDER BY `level` ASC, `name` ASC, `lname` ASC, `fname` ASC");
        return $query->result_array();
    }

    public function update_password($userId, $pass) {
        return $this->db->simple_query("UPDATE `user` SET `pwd` = '$pass' WHERE id='$userId'");
    }

    public function reset_pass($userId) {
        $pass = password_hash('change_me', PASSWORD_BCRYPT);
        return $this->update_password($userId, $pass);
    }
 }