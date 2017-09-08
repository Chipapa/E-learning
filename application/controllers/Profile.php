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

    public function viewProfile($slug = NULL) {
        $id = ($this->session->userdata['logged_in']['id']);
        $data['userinfo'] = $this->ProfileModel->read_user_info_byID($id);
        $data['test'] = $slug;
        $username = ($this->session->userdata['logged_in']['username']);
        $data['myQuestions'] = $this->ProfileModel->getQuestionByID($username);
        $this->view('ProfilePage', $data);
    }

    public function getMyQuestion(){
        $username = ($this->session->userdata['logged_in']['username']);
        $data['myQuestions'] = $this->ProfileModel->getQuestionByID($username);
        $this->view('ProfilePage', $data);
        
    }
    public function getleaderboard()
    {
        //$data = $this->input->post('sampleData');
       // $username = ($this->session->userdata['logged_in']['username']);
        $data['leaderboard'] = $this->ProfileModel->getTopTen();
        
        //echo json_encode($data['Leaderboards']);    
        //$this->view('LandingPage', $data);  
        //while($myQuestions != null)
        $this->view('LandingPage', $data);
        //$totalpoints = $myQuestions->ask_points. + $myQuestions->answer_points;
       
    }
}
