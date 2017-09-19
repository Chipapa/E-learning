<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Accounts extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('loginmodel');
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

    public function signUp() {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('username', 'Email', 'required|callback_username_check');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('rePassword', 'Re-Type Password', 'required|matches[password]');


        if ($this->form_validation->run() === FALSE) {
            //$this->load->view('pages/signuppage');
            $this->view('signuppage');
        } else {

            $data['message_display'] = 'Signup successful!';
            $this->loginmodel->registerUser();
            //$this->load->view('pages/loginpage', $data);

            $this->view('loginpage', $data);
        }
    }

    public function username_check($username) {
        if ($this->loginmodel->checkUserExists($username)) {
            $this->form_validation->set_message('username_check', 'That email already exists.');
            return FALSE;
        } else {
            return TRUE;
        }
    }

}
