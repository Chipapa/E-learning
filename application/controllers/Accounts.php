<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Accounts extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('loginmodel');
        $this->load->helper('url_helper');
    }

    public function signUp() {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('username', 'Email', 'required|callback_username_check');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('rePassword', 'Re-Type Password', 'required|matches[password]');


        if ($this->form_validation->run() === FALSE) {
            $this->load->view('pages/signuppage');
        } else {
            
            $data['message_display'] = 'Signup successful!';
            $this->loginmodel->registerUser();
            $this->load->view('pages/loginpage', $data);
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
