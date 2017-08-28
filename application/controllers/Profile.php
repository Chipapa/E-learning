<?php

Class Profile extends CI_Controller {

    public function __construct() {
        parent::__construct();
        //$this->load->model('ProfileModel');
        $this->load->helper('url_helper');
    }
    
    public function index() {       
        $this->view('profilepage');
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
    
    /*
    public function viewCategory($slug = NULL) {
        $data['category_item'] = $this->QuestionsModel->get_categories($slug);

        if (empty($data['category_item'])) {
            show_404();
            //$this->load->view('pages/about');
        }

        //$data['title'] = $data['news_item']['title'];

        $this->view('view_category_page', $data);
    }
    
    public function viewQuestion(){
        $this->view('questionpage');
    }*/
}
