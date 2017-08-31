<?php

class QuestionsModel extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function record_count($category = FALSE) {
        if ($category === FALSE) {
            return $this->db->count_all("questions");
        }

        $condition = "category ='" . $category . "'";

        $this->db->select('*');
        $this->db->from('questions');
        $this->db->where($condition);
        //$this->db->limit(1);
        $query = $this->db->get();
        return $query->num_rows();
    }

    //for pagination
    public function fetch_questions($limit, $start, $category = FALSE) {
        if ($category === FALSE) {
            $this->db->limit($limit, $start);
            $this->db->select('*');
            $this->db->from('questions');
            $this->db->order_by("date_posted", "desc");
            $query = $this->db->get();

            if ($query->num_rows() > 0) {
                foreach ($query->result() as $row) {
                    $data[] = $row;
                }
                return $data;
            }
            return false;
        }

        $condition = "category ='" . $category . "'";
        $this->db->limit($limit, $start);
        $this->db->select('*');
        $this->db->from('questions');
        $this->db->where($condition);
        $this->db->order_by("date_posted", "desc");
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
    }

    //with slug
    public function get_categories($slug = FALSE) {
        if ($slug === FALSE) {
            $query = $this->db->get('stockmarket');
            return $query->result_array();
        }

//        $query = $this->db->get_where('questions', array('category' => $slug));
//        return $query->row_array();

        $condition = "category ='" . $slug . "'";
        $this->db->select('*');
        $this->db->from('questions');
        $this->db->where($condition);
        $this->db->order_by("date_posted", "desc");
        //$this->db->limit(1);
        $query = $this->db->get();

        return $query->result_array();
    }

    public function count_num_answered($category) {
        $condition = "category ='" . $category . "' AND num_of_answers > 0";
//        $this->db->select('COUNT(*)');
//        $this->db->from('questions');
//        $this->db->where($condition);
//        $this->db->limit(1);
//        $query = $this->db->get();

        $this->db->select('*');
        $this->db->from('questions');
        $this->db->where($condition);
        //$this->db->limit(1);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function ask_question() {
        //    $slug = url_title($this->input->post('title'), 'dash', TRUE);
        if (isset($this->session->userdata['logged_in'])) {
            $username = ($this->session->userdata['logged_in']['username']);
            //$usertype = ($this->session->userdata['logged_in']['usertype']);
        }else{
            $username = "unknown";
        }

        $data = array(
            'category' => $this->input->post('category'),
            'title' => $this->input->post('title'),
            'question' => $this->input->post('question'),
            'type' => $this->input->post('type'),
            'date_posted' => date('Y-m-d H:i:s'),
            'who_posted' => $username,
            'answer' => $this->input->post('gridRadios'),
            'choices' => $this->input->post('inputChoice1')
        );


        return $this->db->insert('questions', $data);
    }

    public function count_num_unanswered($category) {
        $condition = "category ='" . $category . "' AND num_of_answers = 0";
        $this->db->select('*');
        $this->db->from('questions');
        $this->db->where($condition);
        //$this->db->limit(1);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function set_num_answered() {

        foreach ($this->get_categories() as $category) {
            $count = $this->count_num_answered($category['category']);

            $data = array('answered' => $count);

            $this->db->where('category', $category['category']);
            $this->db->update('stockmarket', $data);
        }
    }

    public function set_num_unanswered() {

        foreach ($this->get_categories() as $category) {
            $count = $this->count_num_unanswered($category['category']);

            $data = array('unanswered' => $count);

            $this->db->where('category', $category['category']);
            $this->db->update('stockmarket', $data);
        }
    }

    public function get_questions($slug = FALSE) {
        if ($slug === FALSE) {

            $this->db->select('*');
            $this->db->from('questions');
            $this->db->order_by("date_posted", "desc");
            $query = $this->db->get();
            return $query->result_array();
        }
        $condition = "id ='" . $slug . "'";
        $this->db->select('*');
        $this->db->from('questions');
        $this->db->where($condition);
        //$this->db->limit(1);
        $query = $this->db->get();

        return $query->result_array();
    }

}
