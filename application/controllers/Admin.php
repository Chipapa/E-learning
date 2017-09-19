<?php

class Admin extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url_helper');
        $this->load->library('session');
        $this->load->model('questionsmodel');
        $this->load->model('profilemodel');

        $this->load->helper('form');
        $this->load->library('form_validation');
    }

    public function view($page = '', $passData = false) {
        if (!file_exists(APPPATH . 'views/pages/' . $page . '.php')) {
            // Whoops, we don't have a page for that!
            show_404();
        }
        //$data['title'] = ucfirst($page); // Capitalize the first letter
        //$dataTitle = $this->set_titlepage($page);
        //$this->load->view('pages/headerAdmin', $dataTitle);
        $this->load->view('pages/headerAdmin');
        $this->load->view('pages/' . $page, $passData);
        $this->load->view('pages/footer');
    }

    public function index() {
        redirect('questions/index');
    }

    public function verifyQuestion($slug) {
        $data['question_item'] = $this->questionsmodel->get_questions($slug);
        $data['full_name_db'] = $this->questionsmodel->get_fullname_by_id($slug);

        $_SESSION['currentQuestion'] = $data['question_item'];

        //$data['test_data'] = $this->questionsmodel->test_func($slug);
        if (empty($data['question_item'])) {
            show_404();
            //$this->load->view('pages/about');
        }

        //$data['title'] = $data['news_item']['title'];

        $this->view('verify_question_page', $data);
    }

}
