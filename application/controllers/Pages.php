<?php

//defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('loginmodel');
        $this->load->model('questionsmodel');
        $this->load->helper('url_helper');
        $this->load->library('session');

        $this->load->helper('form');
        $this->load->library('form_validation');
    }

    public function index() {
        $this->view('loginpage');
    }
    
    //STILL BUGGY, FIX ME
    public function set_titlepage($page){
        if($page == 'loginpage'){
            $data['title'] = ucfirst('Login');
        }else if($page == 'signuppage'){
            $data['title'] = ucfirst('Sign up');
        }else{
            $data['title'] = ucfirst('Unknown Page');
        }     
        return $data;
    }

    public function view($page = '', $passData = false) {
        if (!file_exists(APPPATH . 'views/pages/' . $page . '.php')) {
            // Whoops, we don't have a page for that!
            show_404();
        }
        //$data['title'] = ucfirst($page); // Capitalize the first letter
        $dataTitle = $this->set_titlepage($page);
        
        if ($page == 'loginpage') {
            $this->load->view('pages/headerLogin', $dataTitle);
            $this->load->view('pages/' . $page, $passData);
            $this->load->view('pages/footer');
        }else{
            $this->load->view('pages/headerMain', $dataTitle);
            $this->load->view('pages/' . $page, $passData);
            $this->load->view('pages/footer');
        }
    }

    public function user_login_process() {
        $this->form_validation->set_rules('username', 'Email', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        //check if the inputs are valid
        if ($this->form_validation->run() === FALSE) {
            //$this->load->view('pages/loginpage');
            $this->view('loginpage');
        } else {
            $data = array(
                'username' => $this->input->post('username'),
                'password' => $this->input->post('password')
            );

            //check if login inputs has a match in the database
            $result = $this->loginmodel->login($data);
            if ($result == TRUE) {
                $username = $this->input->post('username');

                //get the whole row in the database of the specific username then assign to session array
                $result = $this->loginmodel->read_user_information($username);
                if ($result != false) {
                    $session_data = array(
                        'username' => $result[0]->username,
                        'usertype' => $result[0]->userType,
                        'fname' => $result[0]->fname,
                        'lname' => $result[0]->lname,
                        'ask_points' => $result[0]->ask_points,
                        'answer_points' => $result[0]->answer_points 
                    );

                    // Add user data in session
                    if (!isset($_SESSION)) {
                        session_start();
                    }
                    
                    $this->session->set_userdata('logged_in', $session_data);
                    redirect("questions/index");
                    //$this->load->view("pages\LandingPage.php");
//                        $data['questions'] = $this->questionsmodel->get_questions();
//                          
//                        $this->load->view('pages/footer');
//                    $this->view("LandingPage");
                    //site_url("questions/index");
                }
            } else {
                $data = array(
                    'error_message' => 'Invalid Username or Password.'
                );
                //$this->load->view('pages/loginpage', $data);

                $this->view('loginpage', $data);
            }
        }
    }

    public function logout() {
        $sess_array = array(
            'username' => ''    
        );
        $this->session->unset_userdata('logged_in', $sess_array);
        
        unset($_SESSION['categories']);
        
        $data['message_display'] = 'Logged out successfully';

        $this->view('loginpage', $data);
        //$this->load->view('pages/loginpage', $data);
    }   
}
