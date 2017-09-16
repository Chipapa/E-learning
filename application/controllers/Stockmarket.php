<?php

Class Stockmarket extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('QuestionsModel');
        $this->load->helper('url_helper');

        $this->load->library("pagination");
        $this->load->helper('form');
        $this->load->library('form_validation');
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
            if (isset($this->session->userdata['logged_in'])) {
                $userType = ($this->session->userdata['logged_in']['usertype']);
            }

            if ($userType === "student") {
                $this->load->view('pages/headerMain');
            } else if ($userType === "admin") {
                $this->load->view('pages/headerAdmin');
            }
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
        //$data['category_item'] = $this->QuestionsModel->get_categories($slug);
        //$slug = url_title($slugParam, 'dash', TRUE);

        $config = array();
        $config["base_url"] = base_url() . "index.php/stockmarket/viewcategory/" . $slug;
        $config["total_rows"] = $this->QuestionsModel->record_count($slug);
        $config["per_page"] = 10;
        $config["uri_segment"] = 4;
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

        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $data["category_item"] = $this->QuestionsModel->fetch_questions($config["per_page"], $page, $slug);
        $data["links"] = $this->pagination->create_links();
        $data["category_title"] = $this->QuestionsModel->get_categories($slug);
//        if (empty($data['category_item'])) {
//            show_404();
//            //$this->load->view('pages/about');
//        }
        //$data['title'] = $data['news_item']['title'];
        $this->view('view_category_page', $data);
    }

    public function viewQuestion() {
        $_SESSION['categories'] = $this->QuestionsModel->get_categories();
        $this->view('askquestionpage');
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
