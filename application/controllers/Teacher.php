<?php

class Teacher extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
    }

    public function index() {
        $this->redir_if_loggedIn();

        $this->load->model('answer_model');
        $this->load->model('user_model');
        $this->load->model('section_model');
        $this->load->helper('url');

        $data = $this->answer_model->get_res($this->session->userdata('userId'));
        $data['teacher'] = $this->user_model->fetch_user($this->session->userdata('userId'));
        $data['section'] = $this->section_model->fetch_section($data['teacher']->section_id);
        $questions = array();
        for($i = 1; $i <= 30; $i++) {
            array_push($questions, $this->answer_model->get_quest_res($this->session->userdata('userId'), $i));
        }
        $data['quest_res'] = $questions;
        $this->load->view('/templates/header');
        $this->load->view('/templates/navbar');
        $this->load->view('/components/eval_result', $data);
        $this->load->view('/templates/footer');
    }

    public function delete_teacher() {
        $teacher_id = $this->input->post('teacher_id');
        $this->load->model('user_model');
        $res = $this->user_model->delete_user($teacher_id);
        if($res){
            echo "success";
        } else {
            echo " res:".$res;
        }
    }

    private function redir_if_loggedIn() {
        $this->load->library('session');
        if($this->session->has_userdata('userType')) {
            if($this->session->userdata('userType') == "admin") {
                redirect('/dashboard', 'refresh');
            } else if($this->session->userdata('userType') == "student") {
                redirect('/evaluate', 'refresh');
            }
        } else {
            redirect('/login', 'refresh');
        }
    }
}