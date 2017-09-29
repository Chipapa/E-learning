<?php

class Login_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function checkUserExists($username) {
        $query = $this->db->get_where('users', array('username' => $username));

        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function registerUser() {
        $data = array(
            'username' => $this->input->post('username'),
            'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
            'userType' => "student"
        );

        return $this->db->insert('users', $data);
    }

    // Read data using username and password
    public function login($data) {

        $conditionPass = "username =" . "'" . $data['username'] . "'";
        $this->db->select('password');
        $this->db->from('users');
        $this->db->where($conditionPass);
        $this->db->limit(1);
        $queryPass = $this->db->get();

        if ($queryPass->num_rows() > 0) {
            $hashedPass = $queryPass->row();

            if (password_verify($data['password'], $hashedPass->password)) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function read_user_information($username) {

        $condition = "username =" . "'" . $username . "'";
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where($condition);
        $this->db->limit(1);
        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            return $query->result();
        } else {
            return false;
        }
    }

}
