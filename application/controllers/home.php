<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {
     function __construct()
  {
    parent::__construct();
    //$this->is_logged_in(); 
  }
  
	public function index($msg = NULL)
	{
            $data['msg'] = $msg;
            $this->load->model('process'); 
                $data['objSession'] = $this->session;
                $data['catlist'] = $this->process->categorylist();  
                $data['recent_queslist'] = $this->process->recent_questionlist();
                $data['recent_anslist'] = $this->process->recent_answerlist();   
                $data['anslist'] = $this->process->recent_answerlist2(); 
                
                
                //$data['recentq'] = $this->process->recent_questionlist2();
               //$data['treat']=$this->process->treat();
                
                
               $this->load->view('layouts/header');    
		$this->load->view('home',$data);
                $this->load->view('layouts/footer'); 
	}
        
   
        
   function login($msg = NULL){
       redirect('login');
  } 
   function is_logged_in() 
    {
        $is_logged_in = $this -> session -> userdata('is_logged_in');
        if (!isset($is_logged_in) || $is_logged_in != true)
        {
            redirect('');
        }
    }
  function addquestion($msg = NULL){
     // $this->is_logged_in();
      $data['msg'] = $msg;
      $this->load->model('process'); 
                $data['objSession'] = $this->session;
                $data['query'] = $this->process->categorylist(); 
      
       $this->load->view('layouts/header');    
		$this->load->view('askquestion',$data);
                $this->load->view('layouts/footer'); 
      
  }
  
   function postquestion(){
      //echo"asdf";
       $this->load->helper(array('form', 'url'));
      $this->load->library('form_validation');
      
      $this->form_validation->set_rules('ques_title', 'Title', 'required');
      $this->form_validation->set_rules('ques_description', 'Description', 'required');
      $this->form_validation->set_rules('ques_category', 'Category', 'required|callback_select_validate');
     //echo $this->session->userdata('userid');
      
        
       if ($this->form_validation->run() == FALSE)
		{		
                $this->addquestion();
		}
        else
		{
		$this->load->model('process');        
                $result = $this->process->add_question();  
                if(!$result){
           $msg = '<font color=red>Question Addded Failed.</font><br />';
           //$this->addquestion($msg);
           $this->index($msg);
          
            }else{
            $msg = '<font color=green>Question Addded Successfully.Waiting for Approval</font><br />';
           //$this->addquestion($msg);
           $this->index($msg);
            
              }
	}          
  }
   
   function select_validate($selectValue)
{  
    if($selectValue == '')
    {
        $this->form_validation->set_message('select_validate', 'Please Select Category.');
        return false;
    }
    else { return true; }
}   
         
}

