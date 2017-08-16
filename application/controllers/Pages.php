<?php

//defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('loginmodel');
        $this->load->helper('url_helper');
        $this->load->library('session');

        $this->load->helper('form');
        $this->load->library('form_validation');
    }

    public function index() {
        $this->load->view('pages/loginpage');
    }

    public function view($page = 'loginpage') {
        if (!file_exists(APPPATH . 'views/pages/' . $page . '.php')) {
            // Whoops, we don't have a page for that!
            show_404();
        }
        //$data['title'] = ucfirst($page); // Capitalize the first letter
        $this->load->view('pages/' . $page);
    }

    public function user_login_process() {

        $this->form_validation->set_rules('username', 'Email', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('pages/loginpage');
        } else {
            $data = array(
                'username' => $this->input->post('username'),
                'password' => $this->input->post('password')
            );
            $result = $this->loginmodel->login($data);

            if ($result == TRUE) {

                $username = $this->input->post('username');

                $result = $this->loginmodel->read_user_information($username);
                if ($result != false) {
                    $session_data = array(
                        'username' => $result[0]->username,
                        'usertype' => $result[0]->userType,
                    );

                    // Add user data in session
                    if (!isset($_SESSION)) {
                        session_start();
                    }
                    $this->session->set_userdata('logged_in', $session_data);
                    $this->load->view('pages/success');
                }
            } else {
                $data = array(
                    'error_message' => 'Invalid Username or Password.'
                );
                $this->load->view('pages/loginpage', $data);
            }
        }
    }

    public function logout() {
        $sess_array = array(
            'username' => ''
        );
        $this->session->unset_userdata('logged_in', $sess_array);
        $data['message_display'] = 'Logged out successfully';
        $this->load->view('pages/loginpage', $data);
    }

}
