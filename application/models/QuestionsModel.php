<?php

class QuestionsModel extends CI_Model {

    public function __construct() {
        $this->load->database();

        $this->load->library('session');
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

        $query = $this->db->get_where('stockmarket', array('category' => $slug));
        return $query->row_array();
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
            $id = ($this->session->userdata['logged_in']['id']);
            $username = ($this->session->userdata['logged_in']['username']);
            //$usertype = ($this->session->userdata['logged_in']['usertype']);
            $fname = ($this->session->userdata['logged_in']['fname']);
            $lname = ($this->session->userdata['logged_in']['lname']);
            $full_name = $fname . " " . $lname;
        } else {
            $username = "unknown";
        }
        if ($this->input->post('type') === "Multiple Choice") {
            $data = array(
                'category' => $this->input->post('category'),
                'title' => $this->input->post('title'),
                'question' => $this->input->post('question'),
                'type' => $this->input->post('type'),
                'date_posted' => date('Y-m-d H:i:s'),
                'who_posted' => $id,
                'answer' => $this->input->post('gridRadios')
            );
            $this->db->insert('questions', $data);

            $currentQuestionId = $this->db->insert_id();
            $dataChoices = array(
                'questionID' => $currentQuestionId,
                'choice1' => $this->input->post('inputChoice1'),
                'choice2' => $this->input->post('inputChoice2'),
                'choice3' => $this->input->post('inputChoice3'),
                'choice4' => $this->input->post('inputChoice4')
            );
            $this->db->insert('choices', $dataChoices);
        } else if ($this->input->post('type') === "Identification") {
            $dataIdentification = array(
                'category' => $this->input->post('category'),
                'title' => $this->input->post('title'),
                'question' => $this->input->post('question'),
                'type' => $this->input->post('type'),
                'date_posted' => date('Y-m-d H:i:s'),
                'who_posted' => $id,
                'answer' => $this->input->post('identificationAnswer')
            );
            $this->db->insert('questions', $dataIdentification);
        } else if ($this->input->post('type') === "Coding") {
            $dataCoding = array(
                'category' => $this->input->post('category'),
                'title' => $this->input->post('title'),
                'question' => $this->input->post('question'),
                'type' => $this->input->post('type'),
                'date_posted' => date('Y-m-d H:i:s'),
                'who_posted' => $id,
                'answer' => $this->input->post('codingAnswer')
            );
            $this->db->insert('questions', $dataCoding);
        }
    }

    public function set_points() {
        if (isset($this->session->userdata['logged_in'])) {
            $username = ($this->session->userdata['logged_in']['username']);
        } else {
            $username = "unknown";
        }

        $POINTS_FROM_ASKING = 2;

        $this->db->set('ask_points', 'ask_points + ' . (int) $POINTS_FROM_ASKING, FALSE);
        $this->db->where('username', $username);
        $this->db->update('users');

        //update session data for current points
        //FIX ME: MUST ONLY UPDATE A SINGLE SESSION VARIABLE, NOT ENTIRE SESSION DATA
        $condition = "username =" . "'" . $username . "'";
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where($condition);
        $this->db->limit(1);
        $query = $this->db->get();

        $query_point = $query->row();

        $session_data = array(
            'id' => $query_point->id,
            'username' => $query_point->username,
            'usertype' => $query_point->userType,
            'fname' => $query_point->fname,
            'lname' => $query_point->lname,
            'ask_points' => $query_point->ask_points,
            'answer_points' => $query_point->answer_points
        );

        $this->session->set_userdata('logged_in', $session_data);
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

    public function get_fullname_by_id($userID) {
        //$condition = "questions.id ='" . $questionID . "'";
        $this->db->select('*');
        $this->db->from('users');
        $this->db->join('questions', 'questions.who_posted = users.id');
        $this->db->where_in('users.id', $userID);


        $query = $this->db->get();
        return $query->row_array();
    }
}
    