<?php

Class Stockmarket extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('QuestionsModel');
        $this->load->helper('url_helper');
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

    public function index() {
        $this->QuestionsModel->set_num_answered();
        $this->QuestionsModel->set_num_unanswered();
        $data['categories'] = $this->QuestionsModel->get_categories();
        
        $this->view('stockmarketpage', $data);
    }

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
    }
// FIX ME, TIME SINCE SHOULD BE HERE, NOT IN THE VIEW
//    public function time_since($since) {
//        $chunks = array(
//            array(60 * 60 * 24 * 365, 'year'),
//            array(60 * 60 * 24 * 30, 'month'),
//            array(60 * 60 * 24 * 7, 'week'),
//            array(60 * 60 * 24, 'day'),
//            array(60 * 60, 'hour'),
//            array(60, 'minute'),
//            array(1, 'second')
//        );
//
//        for ($i = 0, $j = count($chunks); $i < $j; $i++) {
//            $seconds = $chunks[$i][0];
//            $name = $chunks[$i][1];
//            if (($count = floor($since / $seconds)) != 0) {
//                break;
//            }
//        }
//
//        $print = ($count == 1) ? '1 ' . $name : "$count {$name}s";
//        return $print;
//    }

}
