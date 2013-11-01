<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Register extends CI_Controller {

  function __construct()
  {
    parent::__construct();
    
  }

  function index($msg = NULL)
  { 

		$data['msg'] = $msg;
                $this->load->view('layouts/header');    
		$this->load->view('register',$data);
                $this->load->view('layouts/footer');

    
  }
  function newuser(){   
      $this->load->helper(array('form', 'url'));
      $this->load->library('form_validation');
     
                $this->form_validation->set_rules('user_name', 'Username', 'required|callback_username_check');
		$this->form_validation->set_rules('pwd', 'Password', 'required|matches[cpwd]');
		$this->form_validation->set_rules('cpwd', 'Password Confirmation', 'required');
		$this->form_validation->set_rules('user_email', 'Email', 'valid_email|required|is_unique[tbl_user.user_email]');
                $this->form_validation->set_rules('gender', 'Select', 'callback_select_validate');
     if ($this->form_validation->run() == FALSE)
		{
		 
                    $this->index();
		}
      
      else
		{
		$this->load->model('process');        
                $result = $this->process->register();  
                
     if(!$result){
           $msg = '<font color=red>Registration failed.</font><br />';
           $this->index($msg);
            //echo "failed";
            }
     else   {
            
           //$msg = '<font color=red>Register Successfully .You may now login </font><br />';
           //$this->index($msg);
           
             $this->session->set_flashdata('register_msg', 'Successfully Registered.You may now login');
                    redirect('login');	
           
              }
	} 
 
  }
  
  public function username_check($str)
	{
                $this->load->model('process');   
                $this->load->library('form_validation');
                
                $result = $this->process->is_username_available($str);
		if (!$result)
		{
			$this->form_validation->set_message('username_check', 'Username Not Available');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
        
        
  function select_validate($selectValue)
    {  
        if($selectValue == 'gender')
     {
         $this->form_validation->set_message('select_validate', 'Please Select Gender.');
         return false;
     }
       else { return true; }
     }

  function newpro(){
      $session['objSession'] = $this->session;
      $this->load->view('addform',$session);
      
   }

   
   

}
