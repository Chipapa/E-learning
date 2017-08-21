<?php

class QuestionsModel extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    //with slug
    public function get_categories($slug = FALSE) {
        if ($slug === FALSE) {
            $query = $this->db->get('stockmarket');
            return $query->result_array();
        }

        $query = $this->db->get_where('questions', array('category' => $slug));
        return $query->row_array();
        
//        $condition = "category =" . "'" . $slug . "'";
//        $this->db->select('*');
//        $this->db->from('questions');
//        $this->db->where($condition);
//        $this->db->limit(1);
//        $query = $this->db->get();
//        
//        return $query;
    }

    public function get_questions($data) {
        $condition = "category =" . "'" . $data['$category'] . "'";
        $this->db->select('*');
        $this->db->from('questions');
        $this->db->where($condition);
        $this->db->limit(1);
        $query = $this->db->get();
        
        return $query;
//        
//        $query = $this->db->get_where('questions', array('category' => $categoryOfQuestion));
//        return $query->row_array();
    }

//    public function get_categories() {
//        $query = $this->db->get('stockmarket');
//        return $query->result_array();
//    }
}
