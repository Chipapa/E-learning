<?php

Class Profile extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Profile_model');
        $this->load->helper('url_helper');
        $this->load->library('session');
    }

    public function index() {
        $this->view('profile_page');
    }

    public function view($page = false, $passData = false) {
        if (!file_exists(APPPATH . 'views/pages/' . $page . '.php')) {
            // Whoops, we don't have a page for that!
            show_404();
        }
        if ($page === "profile_page") {
            $data['title'] = "Profile"; // Capitalize the first letter
        }

        if ($page == 'login_page' || $page == 'signup_page') {
            $this->load->view('pages/header_login');
            $this->load->view('pages/' . $page, $passData);
            $this->load->view('pages/footer');
        } else {
            if (isset($this->session->userdata['logged_in'])) {
                $userType = ($this->session->userdata['logged_in']['usertype']);
            }

            if ($userType === "student") {
                $this->load->view('pages/header_main', $data);
            } else if ($userType === "admin") {
                $this->load->view('pages/header_admin');
            }
            $this->load->view('pages/' . $page, $passData);
            $this->load->view('pages/footer');
        }
    }

    public function viewProfile($slug = NULL) {

        //$id = ($this->session->userdata['logged_in']['id']);
        $id = $slug;
        //$username = ($this->session->userdata['logged_in']['username']);
        $data['id'] = $id;
        $data['userInfo'] = $this->Profile_model->read_user_info_by_slug($slug);
        $data['userQuestions'] = $this->Profile_model->getQuestionBySlug($slug);
        $data['num_of_question'] = $this->Profile_model->count_questions_by_user($id);

        if (empty($slug) || empty($data['userInfo'])) {
            show_404();
            //$this->load->view('pages/about');
        }

        $this->view('profile_page', $data);
    }

    public function viewQuestions($slug = NULL) {
        
    }

}
