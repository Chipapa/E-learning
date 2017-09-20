<?php

Class Profile extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('ProfileModel');
        $this->load->helper('url_helper');
        $this->load->library('session');
    }

    public function index() {
        $this->view('profilepage');
    }

    public function view($page = false, $passData = false) {
        if (!file_exists(APPPATH . 'views/pages/' . $page . '.php')) {
            // Whoops, we don't have a page for that!
            show_404();
        }
        if ($page === "ProfilePage") {
            $data['title'] = "Profile"; // Capitalize the first letter
        }

        if ($page == 'loginpage' || $page == 'signuppage') {
            $this->load->view('pages/headerLogin');
            $this->load->view('pages/' . $page, $passData);
            $this->load->view('pages/footer');
        } else {
            if (isset($this->session->userdata['logged_in'])) {
                $userType = ($this->session->userdata['logged_in']['usertype']);
            }

            if ($userType === "student") {
                $this->load->view('pages/headerMain', $data);
            } else if ($userType === "admin") {
                $this->load->view('pages/headerAdmin');
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
        $data['userInfo'] = $this->ProfileModel->read_user_info_by_slug($slug);
        $data['userQuestions'] = $this->ProfileModel->getQuestionBySlug($slug);
        $data['num_of_question'] = $this->ProfileModel->count_questions_by_user($id);

        if (empty($slug) || empty($data['userInfo'])) {
            show_404();
            //$this->load->view('pages/about');
        }

        $this->view('ProfilePage', $data);
    }

    public function viewQuestions($slug = NULL) {
        
    }

}
