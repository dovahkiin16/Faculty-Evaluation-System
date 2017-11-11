<?php

/**
 * Created by PhpStorm.
 * User: Eden E Fernandez Jr
 * Date: 17/10/2017
 * Time: 11:31 PM
 */
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
        $this->load->view('/templates/header');
        $this->load->view('/templates/navbar');
        $this->load->view('/components/eval_result', $data);
        $this->load->view('/templates/footer');
    }

    public function dashboard() {
        $this->load->model('user_model');
        $data['list'] = $this->user_model->fetch_teachers();
        $this->load->view('/templates/header');
        $this->load->view('/templates/navbar');
        $this->load->view('/components/teacher_list', $data);
        $this->load->view('/templates/footer');
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