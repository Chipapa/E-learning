<?php

<<<<<<< HEAD
Class Questions extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('questionsmodel');
        $this->load->helper('url_helper');
    }
    public function index() {
        $data['questions'] = $this->questionsmodel->get_questions();
                    
        $this->view('LandingPage', $data);
=======
class Questions extends CI_Controller 
{
 
    public function __construct()
    {
        parent::__construct();
        $this->load->model('QuestionsModel');
        $this->load->helper('url_helper');
        $this->load->library('session');
        $this->load->helper('form');
       $this->load->library('form_validation');
        
        
>>>>>>> Addquestion
    }
    
    public function view($page = false, $passData = false) {
        if (!file_exists(APPPATH . 'views/pages/' . $page . '.php')) {
            // Whoops, we don't have a page for that!
            show_404();
        }
        //$data['title'] = ucfirst($page); // Capitalize the first letter
        if ($page == 'loginpage' || $page == 'signuppage') {
            $this->load->view('pages/headerLogin');
            $this->load->view('pages/' . $page, $passData);
            $this->load->view('pages/footer');
<<<<<<< HEAD
        } else {
=======
        }else{
>>>>>>> Addquestion
            $this->load->view('pages/headerMain');
            $this->load->view('pages/' . $page, $passData);
            $this->load->view('pages/footer');
        }
    }
<<<<<<< HEAD

    
    
    public function viewquestion($slug = NULL){
        $data['question_item'] = $this->questionsmodel->get_questions($slug);

        if (empty($data['question_item'])) {
            show_404();
            //$this->load->view('pages/about');
        }

        //$data['title'] = $data['news_item']['title'];

        $this->view('answer_question_page', $data);
    }
}
=======
 
    public function index()
    {   $this->view('AskQuestionPage');
        //$this->load->helper('form');
    }
   public function create()
    {
        $data['title'] = 'Add Question  ';
 
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('question', 'Question', 'required');
 
        if ($this->form_validation->run() === FALSE)
        {
            $this->view("askquestionpage");    
        }
        else
        {
            $this->QuestionsModel->ask_question();
//           $this->load->view('pages/headerMain', $dataTitle);
//            $this->load->view('pages/' . $page, $passData);
//            $this->load->view('pages/footer');
                $this->view('success');
            //echo 'Jesther gwpao';
        }
    }

}
>>>>>>> Addquestion
