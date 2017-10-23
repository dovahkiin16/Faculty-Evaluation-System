<?php
class Admin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
    }

    public function index() {
        $this->load->model('user_model');
        $data['users'] = $this->user_model->fetch_user();
        $data['result'] = $this->session->userdata('result');
        $this->redir_if_loggedIn();
        $this->load->view('/templates/header');
        $this->load->view('/templates/navbar');
        $this->load->view('/components/user_confirmation', $data);
        $this->load->view('/templates/footer');
    }

    public function results() {
        $this->load->model('user_model');
        $this->load->model('answer_model');
        $this->load->model('section_model');
        $this->load->library('Pdf');


        $teachers = $this->user_model->fetch_user(NULL, true);
        $items = array();
        foreach ($teachers as $teacher) {
            $arr = $this->answer_model->get_res($teacher->id);
            $arr2 = $this->section_model->fetch_section($teacher->section_id);
            if($arr == false || $arr2 == false) {
                continue;
            }
            $arr2 = (array) $arr2;
            $data = array_merge($arr, $arr2);
            $data = array_merge((array)$teacher, $data);
            array_push($items, $data);
        }

        usort($items, function($a, $b){ return strcmp($a["lname"], $b["lname"]); });

        $pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->SetTitle('My Title');
        $pdf->SetHeaderMargin(30);
        $pdf->SetTopMargin(20);
        $pdf->setFooterMargin(20);
        $pdf->SetAutoPageBreak(true);
        $pdf->setPrintFooter(false);
        $pdf->setPrintHeader(false);
        $pdf->SetAuthor('Author');
        $pdf->SetDisplayMode('real', 'default');

        $pdf->AddPage();

        $content = '';

        $content .= '
            <h3>Evaluation Result Summary</h3>
            <table border="1" cellpadding="5" cellspacing="0">
                <tr>
                    <th>
                        <b>Name</b>
                    </th>
                    <th>
                        <b>Advisory Year & Section</b>
                    </th>
                    <th>
                        <b>Explicit Curriculum</b>
                    </th>
                    <th>
                        <b>Implicit Curriculum Score</b>
                    </th>
                    <th>
                        <b>Overall Descriptive  Rating</b>
                    </th>
                    <th>
                        <b>Number of Evaluators</b>
                    </th>
                </tr>
        ';
        foreach($items as $item) {
            $name = $item['lname'].", ".$item['fname'];
            $year = $item['level']."-".$item['name'];
            $ec = $item['ec_sc'];
            $ic = $item['ic_sc'];
            $dr = $item['desc_rating'];
            $eval_sum = $item['eval_count'];
            $content .= "
            <tr>
                <td>
                    $name
                </td>
                <td>
                    $year
                </td>
                <td>
                    $ec
                </td>
                <td>
                    $ic
                </td>
                <td>
                    $dr
                </td>
                <td>
                    $eval_sum
                </td>
            </tr>
        ";
        }
        $content .= "</table>";
        $pdf->WriteHTML($content);
        $pdf->Output('result.pdf', 'I');
    }

    public function schedule() {
        $this->redir_if_loggedIn();
        $this->load->model('user_model');
        $this->load->model('section_model');
        $data['evaluators'] = $this->section_model->fetch_evaluator();
        $data['evaluatees'] = $this->user_model->fetch_evaluatee();
        $data['sched_err'] = $this->session->flashdata('sched_err');
        $form = array();
        if(isset($data['sched_err']) && $data['sched_err']) {
            $year = $this->session->flashdata('sched_year');
            $month = $this->session->flashdata('sched_month');
            $day = $this->session->flashdata('sched_day');
            $time = $this->session->flashdata('sched_time');
            $room = $this->session->flashdata('sched_room');
            $form['year'] =  $year;
            $form['month'] = $month;
            $form['day'] =  $day;
            $form['time'] = $time;
            $form['room'] = $room;
        }
        $data['form'] = $form;
        $data['result'] = $this->session->flashdata('result');
        $this->load->view('/templates/header');
        $this->load->view('/templates/navbar');
        $this->load->view('components/schedule_form', $data);
        $this->load->view('/templates/footer');
    }

    public function insert_schedule() {
        $this->redir_if_loggedIn();
        $this->load->model('schedule_model');
        $res = $this->schedule_model->insert_schedule();
        if($res) {
            $this->session->set_flashdata('result', 'Action Successful!');
        }
        redirect('/schedule', 'location');
    }

    public function section() {
        $this->redir_if_loggedIn();
        $this->load->model('section_model');
        $res['result'] = $this->session->flashdata('result');
        $res['err'] = $this->session->flashdata('err');
        $list['sections'] = $this->section_model->fetch_section_with_student();
        $this->load->view('/templates/header');
        $this->load->view('/templates/navbar');
        $this->load->view('/components/section_form', $res);
        $this->load->view('/components/section_list', $list);
        $this->load->view('/templates/footer');
    }

    public function add_section() {
        $this->load->model('section_model');
        if($this->section_model->add_section()) {
            $this->session->set_flashdata('result', 'Action Successful!');
        } else {
            $this->session->set_flashdata('err', 'Error: Internal Server Error Occurred');
        }
        redirect('/sections', 'location');
    }

    public function confirm() {
        $this->load->model('user_model');
        print_r($_POST);
        $res = false;
        if($this->input->post('del_all')) {
            $res = $this->user_model->delete_user($this->input->post('userId'));
        } else if($this->input->post('conf_all')) {
            $res = $this->user_model->confirm_user($this->input->post('userId'));
        } else if($this->input->post('del')) {
            $res = $this->user_model->delete_user($this->input->post('del'));
        } else if($this->input->post('conf')) {
            $res = $this->user_model->confirm_user($this->input->post('conf'));
        }

        if ($res) {
            $this->session->set_flashdata('result', 'Action Successful!');
        } else {
            $this->session->set_flashdata('result', 'Error: Internal Server Error Occurred');
        }

        redirect('/dashboard', 'location');
    }

    private function redir_if_loggedIn() {
        $this->load->library('session');
        if($this->session->has_userdata('userType')) {
            if($this->session->userdata('userType') == "student") {
                redirect('/evaluate', 'refresh');
            } else if($this->session->userdata('userType') == "teacher") {
                redirect('/result', 'refresh');
            }
        } else {
            redirect('/login', 'refresh');
        }
    }
}