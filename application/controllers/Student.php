<?php

class Student extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
    }

    public function index() {
        $this->redir_if_loggedIn();
        $this->load->helper('url');
        $this->load->model('question_model');
        $this->load->model('schedule_model');
        $this->load->model('user_model');
        if ($data['confirmed'] = $this->session->userdata('user_confirm')) {
            if ($res = $this->schedule_model->check_sched($this->session->userdata('userId'))) {
                // get questions
                $row = $res->row();
                $data['teacher'] = $this->user_model->fetch_user($row->teacher_id);
                $data['ec'] = $this->question_model->get_question('Explicit Curriculum');
                $data['ic'] = $this->question_model->get_question('Implicit Curriculum');
            } else {
                $data['err'] = $this->session->flashdata('err');
            }
        }
        $data['ins_res'] = $this->session->flashdata('ins_res');
        $data['ins_err'] = $this->session->flashdata('ins_err');
        $this->load->view('/templates/header');
        $this->load->view('/templates/navbar');
        $this->load->view('/components/eval_form', $data);
        $this->load->view('/templates/footer');
    }

    public function submit() {
        $this->load->model('question_model');
        if($this->question_model->submit_answer()) {
            $this->session->set_flashdata('ins_res', 'Evaluation Submitted!');
        } else {
            $this->session->set_flashdata('ins_err', 'Internal server occurred');
        }

        redirect('/evaluate', 'location');
    }

    private function redir_if_loggedIn() {
        if($this->session->has_userdata('userType')) {
            if($this->session->userdata('userType') == "admin") {
                redirect('/dashboard', 'refresh');
            } else if($this->session->userdata('userType') == "teacher") {
                redirect('/result', 'refresh');
            }
        } else {
            redirect('/login', 'refresh');
        }
    }
}