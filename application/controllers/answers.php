<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Answers extends CI_Controller {

  function __construct()
  {
    parent::__construct();
     //$this->load->helper(array('url'));
  }

  function index($id = NULL,$msg = NULL)
  { 
                //echo $id;
      
      
                 if(!$id)
                      {
                      echo "You do not have permission to view this page";
                      return;
                  
                      }
      
      
      
                echo $msg;
                $this->load->model('process'); 
		$data['msg'] = $msg;
                $data['objSession'] = $this->session;
                
                $data['catlist'] = $this->process->categorylist();  
                $data['ques_view'] = $this->process->question_view($id);
                
                  if(!$data['ques_view'])
                      {
                      echo "You do not have permission to view this page";
                      return;
                  
                      }
                
                
                $data['answer_view'] = $this->process->answer_view($id);
                $data['userdetail'] = $this->process->userlist();
                
                //$data['testanswer'] = $this->process->answer_view2($id);
                
                
                $this->load->view('layouts/header');    
		$this->load->view('viewquestion',$data);
                $this->load->view('layouts/footer');

  }

  function check($id){
      $this->index($id);
      echo $id;
  } 
  function addview(){
       if($this->input->is_ajax_request())
        {
           $this->load->model('process');             
            echo $viewadd = $this->process->add_view(); 
//            echo '<h2>Login succeeded with ajax</h2>';
//            echo '<p>Your username is '.$this->input->post('id').'</p>';   
            return TRUE;    
        }
        else
        {           
            echo '<p>But your ajax failed miserably</p>';
        }   
  }
  
  function editpost(){
      $this->load->helper(array('form','url'));
      $this->load->library('form_validation');
      $this->form_validation->set_rules('ques_description', 'Description', 'required');
      $question_id = $this->security->xss_clean($this->input->post('ques_id'));
      if ($this->form_validation->run() == FALSE)
		{		
                //$this->index($question_id);
           $msg = '<font color=red>Edit Post Failed.</font><br />';
                redirect('answers/index/'.$question_id,$msg  );
		}
      if ($this->form_validation->run() == TRUE)
		{		
                $this->load->model('process');  
              
                $result = $this->process->edit_post();  
                if(!$result){
           $msg = '<font color=red>Edit Post Failed.</font><br />';           
           redirect('answers/index/'.$question_id);
          
            }else{
            $msg = '<font color=green>Post Edited Successfully.</font><br />';
          
            redirect('answers/index/'.$question_id );
            
              }
		}
      
      
      }
  
  
  
  
  function addanswer(){
     //echo"asdf";
       $this->load->helper(array('form', 'url'));
      $this->load->library('form_validation');
      
      $this->form_validation->set_rules('add_answer', 'Answer', 'required');
//      $this->form_validation->set_rules('ques_description', 'Description', 'required');      
     //echo $this->session->userdata('userid');
      $question_id = $this->security->xss_clean($this->input->post('question_id'));
        
       if ($this->form_validation->run() == FALSE)
		{		
                //$this->index($question_id);
           $msg = '<font color=red>Answer Addded Failed.</font><br />';
                redirect('answers/index/'.$question_id,$msg  );
		}
        else
		{
		$this->load->model('process');  
              
                $result = $this->process->add_answer();  
                if(!$result){
           $msg = '<font color=red>Answer Addded Failed.</font><br />';
           //$this->addquestion($msg);
           //$this->index($question_id,$msg);
           redirect('answers/index/'.$question_id);
          
            }else{
            $msg = '<font color=green>Answer Addded Successfully.</font><br />';
           //$this->addquestion($msg);
          // $this->index($question_id,$msg);
            redirect('answers/index/'.$question_id );
            
              }
	} 
 } 
 function addreply(){
     //echo"asdf";
       $this->load->helper(array('form', 'url'));
      $this->load->library('form_validation');
      
      $this->form_validation->set_rules('add_reply', 'Reply', 'required');
//      $this->form_validation->set_rules('ques_description', 'Description', 'required');      
     //echo $this->session->userdata('userid');
      $question_id = $this->security->xss_clean($this->input->post('question_id'));
        
       if ($this->form_validation->run() == FALSE)
		{		
                redirect('answers/index/'.$question_id );
		}
        else
		{
		$this->load->model('process');  
              
                $result = $this->process->add_reply();  
                if(!$result){
           $msg = '<font color=red>Reply Addded Failed.</font><br />';
           //$this->addquestion($msg);
          // $this->index($question_id,$msg);
           redirect('answers/index/'.$question_id );
          
            }else{
            $msg = '<font color=green>Reply Addded Successfully.</font><br />';
           //$this->addquestion($msg);
           //$this->index($question_id,$msg);
            
            redirect('answers/index/'.$question_id );
            
              }
	} 
 }
}
