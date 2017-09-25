<?php

class Questions_model extends CI_Model {

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

            //$this->db->select('*');
            $this->db->select(
                    'users.fname, '
                    . 'users.lname, '
                    . 'questions.id, '
                    . 'questions.title,  '
                    . 'questions.question, '
                    . 'questions.type, questions.who_posted, '
                    . 'questions.date_posted, '
                    . 'questions.num_of_answers, '
                    . 'questions.category, '
                    . 'verification.status, '
                    . 'verification.comment');

            $this->db->from('users');
            $this->db->join('questions', 'questions.who_posted = users.id');
            $this->db->join('verification', 'verification.questionID = questions.id');
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
        $this->db->select(
                'users.fname, '
                . 'users.lname, '
                . 'questions.id, '
                . 'questions.title,  '
                . 'questions.question, '
                . 'questions.type, questions.who_posted, '
                . 'questions.date_posted, '
                . 'questions.num_of_answers, '
                . 'questions.category');

        $this->db->from('users');
        $this->db->join('questions', 'questions.who_posted = users.id');
        // $this->db->select('*');
        //  $this->db->from('questions');
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
        $questionCategory = $this->input->post('category');
        if (isset($this->session->userdata['logged_in'])) {
            $id = ($this->session->userdata['logged_in']['id']);
            $username = ($this->session->userdata['logged_in']['username']);
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

            //get id of the last insert then use as FK to the next table
            $currentQuestionId = $this->db->insert_id();
            $dataChoices = array(
                'questionID' => $currentQuestionId,
                'option1' => $this->input->post('inputChoice1'),
                'option2' => $this->input->post('inputChoice2'),
                'option3' => $this->input->post('inputChoice3'),
                'option4' => $this->input->post('inputChoice4')
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
            $currentQuestionId = $this->db->insert_id();
        } else if ($this->input->post('type') === "Coding") {
            $dataCoding = array(
                'category' => $this->input->post('category'),
                'title' => $this->input->post('title'),
                'question' => $this->input->post('question'),
                'type' => $this->input->post('type'),
                'date_posted' => date('Y-m-d H:i:s'),
                'who_posted' => $id,
                'answer' => ''
            );
            $this->db->insert('questions', $dataCoding);

            $currentQuestionId = $this->db->insert_id();
            $dataCoding = array(
                'questionID' => $currentQuestionId,
                'code' => $this->input->post('codingAnswer'),
            );
            $this->db->insert('coding', $dataCoding);
        }
        $this->update_stock_market($questionCategory);
        $this->set_question_status_unverfied($currentQuestionId);
    }

    public function set_question_status_unverfied($questionId) {
        $dataVerified = array(
            'questionID' => $questionId,
            'status' => 'unverified'
        );
        $this->db->insert('verification', $dataVerified);
    }

    public function update_stock_market($questionCategory) {
        $this->db->set('unanswered', 'unanswered+1', FALSE);
        $this->db->where('category', $questionCategory);
        $this->db->update('stockmarket');
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
            'answer_points' => $query_point->answer_points,
            'slug' => $query_point->slug
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

    public function getQuestionByID($id) {
        $condition = "id='" . $id . "'";
        $this->db->select('*');
        $this->db->from('questions');
        $this->db->where($condition);

        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_questions($slug = FALSE) {
        if ($slug === FALSE) {

//            $this->db->select('*');
//            $this->db->from('questions');
//            $this->db->order_by("date_posted", "desc");
//            $query = $this->db->get();
//            return $query->result_array();
        }

//        $condition = "questions.id ='" . $slug . "'";
//        $this->db->select('*');
//        $this->db->from('questions');
//        $this->db->join('users', 'questions.who_posted = users.id');       
//        $this->db->where($condition);
//        $this->db->select(
//                'users.fname, '
//                . 'users.lname, '
//                . 'questions.title, '
//                . 'questions.question, '
//                . 'questions.date_posted, '
//                . 'questions.category, '
//                . 'questions.type, '
//                . 'questions.who_posted, '
//                . 'questions.answer');
//        $this->db->from('questions');
//        $this->db->join('users', 'users.id = questions.who_posted');
//        $this->db->where($condition);
        //$this->db->join('users', 'users.id = questions.who_posted');
        //$this->db->limit(1);
//        $query = $this->db->get();
//        $questionArray = $query->result_array();

        $questionArray = $this->getQuestionByID($slug);
        $questionStatus = $this->getStatus($slug);
        $questionType = $questionArray[0]['type'];
        if ($questionType === "Multiple Choice") {
            $questionArray = $this->get_multiple_choice($slug);
            $questionArray[0]['answer'] = $questionArray[0][$questionArray[0]['answer']];
            $questionArray[0]['code'] = null;
            $questionArray[0]['status'] = $questionStatus[0]['status'];
            $questionArray[0]['comment'] = $questionStatus[0]['comment'];
            return $questionArray;
        } else if ($questionType === "Identification") {
            $questionArray[0]['option1'] = null;
            $questionArray[0]['option2'] = null;
            $questionArray[0]['option3'] = null;
            $questionArray[0]['option4'] = null;
            $questionArray[0]['code'] = null;
            $questionArray[0]['status'] = $questionStatus[0]['status'];
            $questionArray[0]['comment'] = $questionStatus[0]['comment'];
            return $questionArray;
        } else if ($questionType === "Coding") {
            $questionArray = $this->get_coding($slug);
            $questionArray[0]['option1'] = null;
            $questionArray[0]['option2'] = null;
            $questionArray[0]['option3'] = null;
            $questionArray[0]['option4'] = null;
            $questionArray[0]['status'] = $questionStatus[0]['status'];
            $questionArray[0]['comment'] = $questionStatus[0]['comment'];
            return $questionArray;
        }
//        return $query->result_array();
//        else {
//            $questionArray[0]['option1'] = null;
//            $questionArray[0]['option2'] = null;
//            $questionArray[0]['option3'] = null;
//            $questionArray[0]['option4'] = null;
//            return $questionArray;
//        }
    }

    public function getStatus($questionID) {
        $this->db->select('*');
        $this->db->from('verification');
        $this->db->where("questionID = '" . $questionID . "'");
        $query = $this->db->get();
        $qStatus = $query->result_array();

        //$this->shuffle($choicesArray);
//        $choicesArray = array(
//            "answer" => $mcQuestion[0][$mcQuestion[0]['answer']],
//            
//        );
        return $qStatus;
    }

    public function get_multiple_choice($questionID) {
        $this->db->select('*');
        $this->db->from('choices');
        $this->db->join('questions', 'questions.id = choices.questionID');
        $this->db->where("choices.questionID = '" . $questionID . "'");
        $query = $this->db->get();
        $mcQuestion = $query->result_array();

        //$this->shuffle($choicesArray);
//        $choicesArray = array(
//            "answer" => $mcQuestion[0][$mcQuestion[0]['answer']],
//            
//        );
        return $mcQuestion;
    }

    public function get_coding($questionID) {
        $this->db->select('*');
        $this->db->from('coding');
        $this->db->join('questions', 'questions.id = coding.questionID');
        $this->db->where("coding.questionID = '" . $questionID . "'");
        $query = $this->db->get();
        $cdQuestion = $query->result_array();
        //$this->shuffle($choicesArray);
//        $choicesArray = array(
//            "answer" => $mcQuestion[0][$mcQuestion[0]['answer']],
//            
//        );
        return $cdQuestion;
    }

    public function get_fullname_by_id($ID, $direct = FALSE) {
//        $condition = "id ='" . $questionID . "'";
//        $this->db->select('users.fname, users.lname');
//        $this->db->from('users');
//        $this->db->join('questions', 'questions.who_posted = users.id');
//        $this->db->where_in('users.id', $userID);
        if ($direct === TRUE) {
            $condition = "id ='" . $ID . "'";
            $this->db->select('fname, lname');
            $this->db->from('users');
            $this->db->where($condition);
            $query = $this->db->get();
            return $query->row_array();
        }

        $condition = "id ='" . $ID . "'";
        $this->db->select('who_posted');
        $this->db->from('questions');
        $this->db->where($condition);
        $query = $this->db->get();
        $userId = $query->row();

        if (isset($userId)) {
            $condition = "id ='" . $userId->who_posted . "'";
            $this->db->select('fname, lname');
            $this->db->from('users');
            $this->db->where($condition);
            $query = $this->db->get();
            return $query->row_array();
        }
    }

    public function set_answer() {
        $id = ($this->session->userdata['logged_in']['id']);
        $questionArray = $_SESSION['currentQuestion'];
        unset($_SESSION['currentQuestion']);

        if ($questionArray[0]['type'] === "Multiple Choice") {
            if ($questionArray[0]['answer'] === $this->input->post('gridRadiosAnswer')) {
                $correctAnswer = true;
            } else {
                $correctAnswer = false;
            }
            $dataAnsweredBy = array(
                'userID' => $id,
                'questionID' => $questionArray[0]['id'],
                'answer' => $this->input->post('gridRadiosAnswer'),
                'correct' => $correctAnswer,
                'answeredWhen' => date('Y-m-d H:i:s')
            );
        } else if ($questionArray[0]['type'] === "Coding") {
            $dataAnsweredBy = array(
                'userID' => $id,
                'questionID' => $questionArray[0]['id'],
                'answer' => $this->input->post('codeAnswer'),
                'correct' => false,
                'answeredWhen' => date('Y-m-d H:i:s')
            );
        } else if ($questionArray[0]['type'] === "Identification") {
            if ($questionArray[0]['answer'] === $this->input->post('textAnswer')) {
                $correctAnswer = true;
            } else {
                $correctAnswer = false;
            }
            $dataAnsweredBy = array(
                'userID' => $id,
                'questionID' => $questionArray[0]['id'],
                'answer' => $this->input->post('textAnswer'),
                'correct' => $correctAnswer,
                'answeredWhen' => date('Y-m-d H:i:s')
            );
        }

        $this->db->insert('answered_by', $dataAnsweredBy);
        $this->update_answer($questionArray);
    }

    public function update_answer($questionArray) {
        $this->db->set('num_of_answers', 'num_of_answers+1', FALSE);
        $this->db->where('id', $questionArray[0]['id']);
        $this->db->update('questions');

//        $stockUpdate = array(
//            'answered' => 'answered+1',
//            'unanswered' => 'unanswered-1'
//        );
        $this->db->set('answered', 'answered+1', FALSE);
        $this->db->set('unanswered', 'unanswered-1', FALSE);
        $this->db->where('category', $questionArray[0]['category']);
        $this->db->update('stockmarket', $stockUpdate);
    }

    public function set_status() {
        $questionArray = $_SESSION['currentQuestion'];
        unset($_SESSION['currentQuestion']);
        if ($this->input->post('rejectComment') == null) {
            $data = array(
                'status' => 'verified',
                'comment' => 'Your question has been verified!',
                'verified_when' => date('Y-m-d H:i:s')
            );
        } else {
            $data = array(
                'status' => 'removed',
                'comment' => $this->input->post('rejectComment'),
                'verified_when' => date('Y-m-d H:i:s')
            );
        }
        $this->db->where('questionID', $questionArray[0]['questionID']);
        $this->db->update('verification', $data);

//        $dataAnsweredBy = array(
//                'userID' => $id,
//                'questionID' => $questionArray[0]['id'],
//                'answer' => $this->input->post('gridRadiosAnswer'),
//                'answeredWhen' => date('Y-m-d H:i:s')
//            );
//        $this->db->insert('answered_by', $dataAnsweredBy);
        //$this->update_answer($questionArray[0]['id']);
    }

    public function display_answers($questionID, $who_posted, $count = FALSE) {
        if ($count === TRUE) {
            if ($this->session->userdata['logged_in']['id'] === $who_posted) {
                $this->db->select('*');
                $this->db->from('answered_by');
                $this->db->where("questionID = '" . $questionID . "'");
                $query = $this->db->get();
                return $query->num_rows();
            }
        }
//$this->db->select(
//                'users.fname, '
//                . 'users.lname, '
//                . 'questions.id, '
//                . 'questions.title,  '
//                . 'questions.question, '
//                . 'questions.type, questions.who_posted, '
//                . 'questions.date_posted, '
//                . 'questions.num_of_answers, '
//                . 'questions.category');
        if ($this->session->userdata['logged_in']['id'] === $who_posted) {
            $this->db->select(
                    'answered_by.id, '
                    . 'answered_by.userID, '
                    . 'answered_by.questionID, '
                    . 'answered_by.answer, '
                    . 'answered_by.correct, '
                    . 'answered_by.answeredWhen, '
                    . 'users.lname, '
                    . 'users.fname');
            $this->db->from('answered_by');
            $this->db->join('users', 'users.id = answered_by.userID');
            $this->db->where("questionID = '" . $questionID . "'");
            $query = $this->db->get();
            $data = $query->result_array();
        } else {
            $data = array(
                'who_posted' => 'Di sayo to bata'
            );
        }
        return $data;
    }

    public function getDataAnswer($slug) {
        $id = ($this->session->userdata['logged_in']['id']);
        $condition = "userID= " . "'" . $id . "'" . "AND " . "questionID= " . "'" . $slug . "'";
        $this->db->select('*');
        $this->db->from('answered_by');
        $this->db->where($condition);
        $query = $this->db->get();


        if ($query->num_rows() == 1) {
            return $query->row_array();
        } else {
            return "false";
        }
    }

    public function if_answer($slug) {
        $id = ($this->session->userdata['logged_in']['id']);
        $condition = "userID= " . "'" . $id . "'" . "AND " . "questionID= " . "'" . $slug . "'";
        $this->db->select('id');
        $this->db->from('answered_by');
        $this->db->where($condition);
        $query = $this->db->get();


        if ($query->num_rows() == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function mark_correct_code($slug) {
        $this->db->set('correct', true);
        $this->db->where('id', $slug);
        $this->db->update('answered_by');
    }
    
    public function view_correct_code($slug) {
        $condition = "questionID= " . "'" . $slug . "'" . "AND " . "correct=true";
        $this->db->select('answered_by.id, '
                    . 'answered_by.userID, '
                    . 'answered_by.questionID, '
                    . 'answered_by.answer, '
                    . 'answered_by.correct, '
                    . 'answered_by.answeredWhen, '
                    . 'users.lname, '
                    . 'users.fname');
        $this->db->from('answered_by');
        $this->db->join('users', 'answered_by.userID = users.id');
        $this->db->where($condition);
        $query = $this->db->get();


        if ($query->num_rows() == 1) {
            return $query->row_array();
        } else {
            return "false";
        }
        
        
    }
    
}
