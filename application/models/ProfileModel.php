<?php

class ProfileModel extends CI_Model {

    public function __construct() {
        $this->load->database();
    }
     public function read_user_info_byID($slug = FALSE) {
        $condition = "id =" . "'" . $slug . "'";
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
    
    public function getQuestionByID($id){
        //$id = ($this->session->userdata['logged_in']['id']);
        $condition = "who_posted =" . "'" . $id . "'";
        $this->db->select('*');
        $this->db->from('questions');
        $this->db->where($condition);
        $this->db->order_by("date_posted", "desc");
        $this->db->limit(10);
        $query = $this->db->get();
        return $query->result_array(); 
    }
    
    public function count_answers_by_user($id){
        $condition = "who_posted ='" . $id . "'";

        $this->db->select('*');
        $this->db->from('questions');
        $this->db->where($condition);
        //$this->db->limit(1);
        $query = $this->db->get();
        return $query->num_rows();
    }
}
