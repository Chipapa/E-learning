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

//        $query = $this->db->get_where('questions', array('category' => $slug));
//        return $query->row_array();
        
        $condition = "category ='" . $slug . "'";
        $this->db->select('*');
        $this->db->from('questions');
        $this->db->where($condition);
        //$this->db->limit(1);
        $query = $this->db->get();
        
        return $query->result_array();
    }
    
    public function count_num_answered($category){       
        $condition = "category ='" . $category . "' AND num_of_answers > 0";
//        $this->db->select('COUNT(*)');
//        $this->db->from('questions');
//        $this->db->where($condition);
//        //$this->db->limit(1);
//        $query = $this->db->get();
        
        $this->db->select('*');
        $this->db->from('questions');
        $this->db->where($condition);
        //$this->db->limit(1);
        $query = $this->db->get();
        return $query->num_rows();
    }
    public function ask_question()
    {
      
 
    //    $slug = url_title($this->input->post('title'), 'dash', TRUE);

        $data = array(
             
            'category' => $this->input->post('category'),
            'question' => $this->input->post('question'),
            'type' => $this->input->post('type'),
            'date_posted' =>date('Y-m-d H:i:s')
            
                
        );
        
     
            return $this->db->insert('questions', $data);
           
        
    }
    
    public function count_num_unanswered($category){       
        $condition = "category ='" . $category . "' AND num_of_answers = 0";       
        $this->db->select('*');
        $this->db->from('questions');
        $this->db->where($condition);
        //$this->db->limit(1);
        $query = $this->db->get();
        return $query->num_rows();
    }
    
    public function set_num_answered(){
        
        foreach($this->get_categories() as $category){
            $count = $this->count_num_answered($category['category']);
            
            $data = array('answered' => $count);
            
            $this->db->where('category', $category['category']);
            $this->db->update('stockmarket', $data);
        }
        
    }
    
    public function set_num_unanswered(){
        
        foreach($this->get_categories() as $category){
            $count = $this->count_num_unanswered($category['category']);
            
            $data = array('unanswered' => $count);
            
            $this->db->where('category', $category['category']);
            $this->db->update('stockmarket', $data);
        }
        
        
    }
}
