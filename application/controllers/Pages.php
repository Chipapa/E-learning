<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Login_model');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->helper('form');
        $this->load->helper('url_helper');
    }

    public function index() {
        $this->view('Loginpage');
    }

    public function view($page = '', $passData = false) {
        //Shows error 404 if pages does not exist
        if (!file_exists(APPPATH . 'views/pages/' . $page . '.php')) {
            show_404();
        }

        //Checkes if page is login
        $data['title'] = "Login";
        if ($page == 'Loginpage') {
            $this->load->view('headers/Header_Login', $data);
            $this->load->view('pages/' . $page, $passData);
            $this->load->view('headers/Footer');
        }

        //Else redirect to another page
        else {
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
            //redirect('questions/index');
        }
    }

    public function user_login_process() {
        $post = json_decode(file_get_contents("php://input"));
        $username = $post->Username;
        $password = $post->Password;

        $data = array(
            'username' => $username,
            'password' => $password
        );
        
        $result = $this->Login_model->login($data);
        if ($result == TRUE) {
            $result = $this->Login_model->read_user_information($username);

            if ($result != false) {
                if ($result[0]->userType === "student") {
                    $session_data = array(
                        'id' => $result[0]->id,
                        'username' => $result[0]->username,
                        'usertype' => $result[0]->userType,
                        'fname' => $result[0]->fname,
                        'lname' => $result[0]->lname,
                        'ask_points' => $result[0]->ask_points,
                        'answer_points' => $result[0]->answer_points,
                        'slug' => $result[0]->slug
                    );

                    // Add user data in session
                    if (!isset($_SESSION)) {
                        session_start();
                    }
                    $this->session->set_userdata('logged_in', $session_data);
                    echo "success";
                }
            }
        } else {
            //echo "User does nto exist!";
            echo "invalid";
        }
    }

    public function logout() {
        $sess_array = array(
            'username' => ''
        );
        $this->session->unset_userdata('logged_in', $sess_array);
        $this->index();
    }

}
