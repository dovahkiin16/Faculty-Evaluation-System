<?php
class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
    }

    public function index() {
        $this->redir_if_loggedIn();
        $data['err'] = $this->session->flashdata('login_err');
        $this->load->view('/templates/header');
        $this->load->view('/templates/navbar');
        $this->load->view('/components/login', $data);
        $this->load->view('/templates/footer');
    }

    public function signin() {
        $this->load->model('user_model');
        if($this->user_model->signin()) {
            $this->redir_if_loggedIn();
        } else {
            $this->session->set_flashdata('login_err', 'Username or password Incorrect');
            redirect('/login', 'refresh');
        }
    }

    public function signup() {
        $this->redir_if_loggedIn();
        $this->load->model('section_model');
        $data['sections'] = $this->section_model->fetch_section();
        $data['err'] = $this->session->flashdata('register_err');
        $this->load->view('/templates/header');
        $this->load->view('/templates/navbar');
        $this->load->view('/components/register', $data);
        $this->load->view('/templates/footer');
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect('/login', 'refresh');
    }

    public function register() {
        $this->load->model('user_model');
        $res = $this->user_model->register();
        if($res) {
            if($this->session->userdata('userType') == "admin") {
                redirect('/dashboard', 'refresh');
            } else if($this->session->userdata('userType') == "admin") {
                redirect('/evaluate', 'refresh');
            } else {
                redirect('/result', 'refresh');
            }
        } else {
            redirect('/signup', 'refresh');
        }
    }

    private function redir_if_loggedIn() {
        if($this->session->has_userdata('userType')) {
            if($this->session->userdata('userType') == "admin") {
                redirect('/dashboard', 'refresh');
            } else if($this->session->userdata('userType') == "student") {
                redirect('/evaluate', 'refresh');
            } else if($this->session->userdata('userType') == "teacher") {
                redirect('/result', 'refresh');
            }
        }
    }
}