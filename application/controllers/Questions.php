<?php

Class Questions extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('questionsmodel');
        $this->load->helper('url_helper');
        $this->load->library('session');
        $this->load->library("pagination");

        $this->load->helper('form');
        $this->load->library('form_validation');
    }

//    public function index() {
//        $data['questions'] = $this->questionsmodel->get_questions();
//
//        $this->view('LandingPage', $data);
//    }

    public function index() {
        $config = array();
        $config["base_url"] = base_url() . "index.php/questions/index";
        $config["total_rows"] = $this->questionsmodel->record_count();
        $config["per_page"] = 10;
        $config["uri_segment"] = 3;
//      $choice = $config["total_rows"] / $config["per_page"];
//      $config["num_links"] = round($choice);
//      $config['attributes'] = array('class' => 'page-link');

        $config['prev_link'] = 'Previous';
        $config['next_link'] = 'Next';
        $config['full_tag_open'] = '<div class="pagging text-center"><nav><ul class="pagination">';
        $config['full_tag_close'] = '</ul></nav></div>';
        $config['num_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close'] = '</span></li>';
        $config['cur_tag_open'] = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close'] = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close'] = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close'] = '</span></li>';
        $config['first_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close'] = '</span></li>';

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data["questions"] = $this->questionsmodel->fetch_questions($config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();

        $this->view('LandingPage', $data);
    }

    public function view($page = false, $passData = false) {
        if (!file_exists(APPPATH . 'views/pages/' . $page . '.php')) {
            // Whoops, we don't have a page for that!
            show_404();
        }
        //$data['title'] = ucfirst($page); // Capitalize the first letter
        if ($page == 'loginpage' || $page == 'signuppage') {
            $this->load->view('pages/headerLogin');
            $this->load->view('pages/' . $page, $passData);
            $this->load->view('pages/footer');
        } else {
            $this->load->view('pages/headerMain');
            $this->load->view('pages/' . $page, $passData);
            $this->load->view('pages/footer');
        }
    }

    public function viewAskQuestion() {
        //this $_SESSION['categories'] is unset upon logging out
        //cannot use view('page', $data) function here because the method is being called instead of the page
        //so session is used, after calling in the method, session is immediately unset
        $_SESSION['categories'] = $this->questionsmodel->get_categories();
        $this->view('AskQuestionPage');
    }

    public function create() {
        //$data['title'] = 'Add Question  ';

        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('question', 'Question', 'required');

        if ($this->input->post('type') === "Multiple Choice") {
            $this->form_validation->set_rules('inputChoice1', 'Choice 1', 'required');
            $this->form_validation->set_rules('inputChoice2', 'Choice 2', 'required');
            $this->form_validation->set_rules('inputChoice3', 'Choice 3', 'required');
            $this->form_validation->set_rules('inputChoice4', 'Choice 4', 'required');
        } else if ($this->input->post('type') === "Coding") {
            $this->form_validation->set_rules('codingAnswer', 'Code Text Area', 'required');
        } else if ($this->input->post('type') === "Identification") {
            $this->form_validation->set_rules('identificationAnswer', 'Answer to Identification', 'required');
        }

        if ($this->form_validation->run() === FALSE) {
            $this->view("askquestionpage");
        } else {
            $this->questionsmodel->ask_question();
            
            $this->questionsmodel->set_points();

            //cannot use view('page', $data) function here because the method is being called instead of the page
            //so session is used, after calling in the method, session is immediately unset
            $_SESSION['flash'] = 'Your question has been successfully posted.';
            redirect("questions/index");
        }

//          TESTING PART AJAX     
//        if ($this->input->post('title') == "") {
//            $message = "You can't send empty text";
//        } else {
//            $message = $this->input->post('title');
//        }
//        echo $message;
//        
//         $data = array(
//            'title' => $this->input->post('title')
//        );
//
////Either you can print value or you can send value to database
//        echo json_encode($data);
    }

    public function viewquestion($slug = NULL) {
        $data['question_item'] = $this->questionsmodel->get_questions($slug);

        if (empty($data['question_item'])) {
            show_404();
            //$this->load->view('pages/about');
        }

        //$data['title'] = $data['news_item']['title'];

        $this->view('answer_question_page', $data);
    }
    
    public function answerquestion() {
        $data = $this->input->post('user');
        echo $data;
        
    }

}
