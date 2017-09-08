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

    public function getQuestionByID($username) {
        $id = ($this->session->userdata['logged_in']['id']);
        $condition = "who_posted =" . "'" . $id . "'";
        $this->db->select('*');
        $this->db->from('questions');
        $this->db->where($condition);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getTopTen() {
        $this->db->select('*');
        $this->db->from('users');
        $query = $this->db->get();

        $arrayNames = array();
        $arrayFinal = array();
        foreach ($query->result_array() as $data) {
            $fullname = $data['fname'] . " " . $data["lname"];
            $totalpoints = $data['ask_points'] + $data['answer_points'];
            $arrayNames[] = array($fullname, $totalpoints);
        }
        //$fullname=
        array_multisort(array_column($arrayNames, 1), SORT_DESC, $arrayNames);
        $j=0;
        for ($i = 0; $i < 10; $i++) {   
            if ($arrayNames[$i][1] != 0) {
                
                $arrayFinal[$j] = $arrayNames[$i];
                $j++;
            }
            
        }

       
        return $arrayFinal;
//        
//       return $query->result_array();
    }

}
