<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('loginmodel');
        $this->load->helper('url_helper');
    }

    public function index() {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->load->view('pages/loginpage');
    }

    public function view($page = 'loginpage') {
        if (!file_exists(APPPATH . 'views/pages/' . $page . '.php')) {
            // Whoops, we don't have a page for that!
            show_404();
        }

        $this->load->helper('form');
        $this->load->library('form_validation');

        //$data['title'] = ucfirst($page); // Capitalize the first letter

        $this->load->view('pages/' . $page);
    }

    public function user_login_process() {
        $this->load->helper('form');
        $this->load->library('form_validation');

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
                $this->load->view('pages/success');
            } else {
                $data = array(
                    'error_message' => 'Invalid Username or Password.'
                );
                $this->load->view('pages/loginpage', $data);
            }
        }
    }

}
