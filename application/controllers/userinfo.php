<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Userinfo extends CI_Controller {

  function __construct()
  {
    parent::__construct();
     //$this->load->helper(array('url'));
  }

  function index($userid = NULL,$msg = NULL)
  { 
               // echo $userid;
      
      if(!$userid)
                      {
                      echo "You do not have permission to view this page";
                      return false;
                  
                      }    
      
      
      
      echo $msg;
             $data['userid'] = $userid;
             $this->load->model('process'); 
                $data['objSession'] = $this->session;
                $data['userdetail'] = $this->process->get_username($userid); 
                
                if(!$data['userdetail'])
                      {
                      echo "You do not have permission to view this page";
                      return false;
                  
                      }
                
                
                
                
                
                
                 $data['catlist'] = $this->process->categorylist(); 
                $data['totalquestion'] = $this->process->get_totalquestion($userid);  
                $data['totalanswered'] = $this->process->get_totalanswered($userid);  
                              
                
               $this->load->view('layouts/header');    
		$this->load->view('userdetails',$data);
                $this->load->view('layouts/footer'); ;

  }
  function changepass(){
      $this->load->helper(array('form', 'url'));
      $this->load->library('form_validation');
      //echo "asdf";
      
                $this->form_validation->set_rules('current_password', 'Current Password', 'required|callback_currentpass_check');
		$this->form_validation->set_rules('pass1', 'Password', 'required|matches[pass2]');
		$this->form_validation->set_rules('pass2', 'Password Confirmation', 'required');
		$userid = $this->security->xss_clean($this->input->post('user_id'));
                if ($this->form_validation->run() == FALSE)
		{
                   
                    $this->session->set_flashdata('currentpass_msg',form_error('current_password'));
                    $this->session->set_flashdata('pass1_msg',form_error('pass1'));
                    $this->session->set_flashdata('pass2_msg',form_error('pass2'));
                    
                    
                    //$msg = '<font color=red>Answer Addded Failed.</font><br />';
                //$this->index($userid);                   
                redirect('userinfo/index/'.$userid);
		}
                else
                {
                     $result = $this->process->update_pass($userid);
                     if ($result)
		    {
                         //$this->session->sess_destroy();
                    $this->session->set_flashdata('chngpass_msg', 'Password successfully changed,You may login now');
                    redirect('login');			
		    }
		    else
		    {
			//return false;
                         $this->index($userid);  
		    }
                     
                }
  }
   public function currentpass_check($str)
	{
                $this->load->model('process');   
                $this->load->library('form_validation');
                $userid = $this->security->xss_clean($this->input->post('user_id'));
                
                $result = $this->process->is_currentpassword($str,$userid);
		if ($result)
		{
                    return TRUE;			
		}
		else
		{
			$this->form_validation->set_message('currentpass_check', 'Current password not Valid');
			return FALSE;
		}
	}

}
