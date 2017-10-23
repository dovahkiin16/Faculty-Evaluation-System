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
        $sql = "SELECT * FROM `user` WHERE `username`=?";
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
        $pass = password_hash($pwd, PASSWORD_BCRYPT);
        $sql = "INSERT INTO `user` VALUES(NULL, ?, ?,?, ?, ?, ?, NOW(), 0)";
        $res = $this->db->query($sql, array($type, $fname, $lname, $username, $pass, $section));
        if($res) {
            $name = $lname . ", " . $fname;
            $this->session->set_userdata('name', $name);
            $this->session->set_userdata('userId', $this->db->insert_id());
            $this->session->set_userdata('userType', $type);
            $this->session->set_userdata('user_section', $section);
        } else {
            $this->session->set_flashdata('register_err', 'Username already exists');
        }
        return $res;
    }

    public function delete_user($userId) {
        if(!is_array($userId)) {
            $this->db->where('id', $userId);
            $this->db->delete('user');
            return $this->db->get();
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


    public function fetch_user($id=NULL, $conf = false) {
        $sql = '';

        if($id==NULL) {
            $sql = "SELECT * FROM `user` WHERE `confirmed`='$conf' ORDER BY `user`.`lname` ASC";
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

    public function fetch_evaluatee() {
        $sql = "SELECT * FROM `user` WHERE `confirmed`='1' AND `type`='teacher'";
        $query = $this->db->query($sql);
        if($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
 }