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

    public function teacher_dashboard() {
    $this->load->model('user_model');
    $this->redir_if_loggedIn();
    $data['list'] = $this->user_model->fetch_teachers();
    $this->load->view('/templates/header');
    $this->load->view('/templates/navbar');
    $this->load->view('/components/teacher_list', $data);
    $this->load->view('/templates/footer');
}

    public function teach_list() {
        $this->load->model('user_model');
        $this->redir_if_loggedIn();
        $data['list'] = $this->user_model->fetch_teachers();
        $this->load->view('/templates/header');
        $this->load->view('/templates/navbar');
        $this->load->view('/components/teacher_list', $data);
        $this->load->view('/templates/footer');
    }

    public function teach_res($id) {
        $this->redir_if_loggedIn();

        $this->load->model('answer_model');
        $this->load->model('user_model');
        $this->load->model('section_model');
        $this->load->helper('url');

        $data = $this->answer_model->get_res($id);
        $data['teacher'] = $this->user_model->fetch_user($id);
        $data['section'] = $this->section_model->fetch_section($data['teacher']->section_id);
        $questions = array();
        for($i = 1; $i <= 30; $i++) {
            array_push($questions, $this->answer_model->get_quest_res($id, $i));
        }
        $data['quest_res'] = $questions;
        $this->load->view('/templates/header');
        $this->load->view('/templates/navbar');
        $this->load->view('/components/eval_result', $data);
        $this->load->view('/templates/footer');
    }

    public function delete_teacher() {
        $this->load->database();
        $teacher_id = $this->input->post('teacher_id');
        $this->load->model('user_model');
        $res = $this->user_model->delete_user($teacher_id);
        if($res == "success"){
            echo "success";
        } else {
            echo "last query: ".$teacher_id;
        }
    }

    public function student_dashboard() {
        $this->load->model('user_model');
        $data['list'] = $this->user_model->fetch_students();
        $this->load->view('/templates/header');
        $this->load->view('/templates/navbar');
        $this->load->view('/components/student_list', $data);
        $this->load->view('/templates/footer');
    }

    public function results() {
        $this->redir_if_loggedIn();
        $this->load->model('user_model');
        $this->load->model('answer_model');
        $this->load->model('section_model');
        $this->load->library('Pdf');


        $teachers = $this->user_model->fetch_teacher();
        $items = array();
        foreach ($teachers as $teacher) {
            $arr = $this->answer_model->get_res($teacher->id);
            if(! $arr){
                continue;
            }
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

        $PDF_HEADER_LOGO = NULL;//any image file. check correct path.
        $PDF_HEADER_LOGO_WIDTH = "20";
        $PDF_HEADER_TITLE = "This is my Title";
        $PDF_HEADER_STRING = "Tel 1234567896 Fax 987654321\n"
            . "E abc@gmail.com\n"
            . "www.abc.com";

        $pdf = new Pdf('P', 'px', 'A4', true, 'UTF-8', false);
        $pdf->SetTitle('My Title');
        $pdf->SetHeaderMargin(30);
        $pdf->SetTopMargin(20);
        $pdf->setFooterMargin(20);
        $pdf->SetAutoPageBreak(true);
        $pdf->SetHeaderData($PDF_HEADER_LOGO, $PDF_HEADER_LOGO_WIDTH, $PDF_HEADER_TITLE, $PDF_HEADER_STRING);
        $pdf->setPrintFooter(false);
        $pdf->setPrintHeader(false);
        $pdf->SetAuthor('Author');
        $pdf->SetDisplayMode('real', 'default');

        $pdf->AddPage();

        $content = '';

        $content .= '
            <h1 style="text-align: center; line-height: 6px; font-size: 30px">Tibag High School</h1>
            <p style="text-align: center; line-height: 5px">Tibag, Tarlac</p>
            <hr />
            <h3 style="text-align: center; line-height: 5px">Evaluation Result Summary</h3>
            <table border="1" cellpadding="5" cellspacing="0">
                <tr>
                    <th>
                        <b>Name</b>
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

    public function create_schedule() {
        $this->redir_if_loggedIn();
        $this->load->model('user_model');
        $this->load->model('section_model');
        $this->load->model('schedule_model');
        $data['evaluators'] = $this->section_model->fetch_evaluator();
        $data['evaluatees'] = $this->user_model->fetch_evaluatee();
        $data['sched_err'] = $this->session->flashdata('sched_err');
        $data['result'] = $this->session->flashdata('result');
        $this->load->view('/templates/header');
        $this->load->view('/templates/navbar');
        $this->load->view('/components/schedule_form', $data);
        $this->load->view('/templates/footer');
    }

    public function view_schedule() {
        $this->redir_if_loggedIn();
        $this->load->model('user_model');
        $this->load->model('section_model');
        $this->load->model('schedule_model');
        $data['sched_list'] = $this->schedule_model->get_schedules();
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
        $this->load->view('/components/schedule_list', $data);
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

    public function create_section() {
        $this->redir_if_loggedIn();
        $this->load->model('user_model');
        $this->load->model('section_model');
        $res['result'] = $this->session->flashdata('result');
        $res['err'] = $this->session->flashdata('err');
        $res['evaluatees'] = $this->user_model->fetch_evaluatee();
        $this->load->view('/templates/header');
        $this->load->view('/templates/navbar');
        $this->load->view('/components/section_form', $res);
        $this->load->view('/templates/footer');
    }

    public function view_section() {
        $this->redir_if_loggedIn();
        $this->load->model('section_model');
        $list['sections'] = $this->section_model->fetch_section_with_student();
        $this->load->view('/templates/header');
        $this->load->view('/templates/navbar');
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
        redirect('/section/add', 'location');
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