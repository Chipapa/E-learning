<?php

class ProfileModel extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function read_user_info_by_slug($slug = FALSE) {
        $condition = "slug =" . "'" . $slug . "'";
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

    public function getQuestionBySlug($slug) {
        //$id = ($this->session->userdata['logged_in']['id']);
        $conditionUser = "slug =" . "'" . $slug . "'";
        $this->db->select('id');
        $this->db->from('users');
        $this->db->where($conditionUser);
        $queryUser = $this->db->get();
        $userID = $queryUser->row();

        //if userId is not set, prevent page from showing up errors
        if (isset($userID)) {
            $condition = "who_posted =" . "'" . $userID->id . "'";
            $this->db->select('*');
            $this->db->from('questions');
            $this->db->where($condition);
            $this->db->order_by("date_posted", "desc");
            $this->db->limit(10);
            $query = $this->db->get();
            return $query->result_array();
        }
    }

    public function count_questions_by_user($slug) {
        $conditionUser = "slug =" . "'" . $slug . "'";
        $this->db->select('id');
        $this->db->from('users');
        $this->db->where($conditionUser);
        $queryUser = $this->db->get();
        $userID = $queryUser->row();

        //if userId is not set, prevent page from showing up errors
        if (isset($userID)) {
            $condition = "who_posted ='" . $userID->id . "'";
            $this->db->select('*');
            $this->db->from('questions');
            $this->db->where($condition);
            //$this->db->limit(1);
            $query = $this->db->get();
            return $query->num_rows();
        }
    }

}
