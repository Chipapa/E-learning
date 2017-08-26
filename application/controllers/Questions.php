<?php

Class Questions extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('questionsmodel');
        $this->load->helper('url_helper');
    }
    public function index() {
        $data['questions'] = $this->questionsmodel->get_questions();
                    
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

    
    
    public function viewquestion($slug = NULL){
        $data['question_item'] = $this->questionsmodel->get_questions($slug);

        if (empty($data['question_item'])) {
            show_404();
            //$this->load->view('pages/about');
        }

        //$data['title'] = $data['news_item']['title'];

        $this->view('answer_question_page', $data);
    }
}
