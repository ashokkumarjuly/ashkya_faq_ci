<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

  function __construct()
  {
    parent::__construct();
    
  }

  function index($msg = NULL)
  {     $data['msg'] = $msg;
      $this->load->view('layouts/header');    
		$this->load->view('login',$data);
                $this->load->view('layouts/footer'); 
    //$this->check_isvalidated();
    
  }
  
  
 function checklogin(){
      $this->load->helper(array('form', 'url'));
      $this->load->library('form_validation');      
      $this->load->model('process');
      
      
        if(isset($_POST['referingpage']) && $_POST['referingpage']!= null){
                    
                    if($_POST['referingpage'] != base_url().'index.php/login'){
                    
                        if($_POST['referingpage'] != base_url().'index.php/register' && $_POST['referingpage'] != base_url().'index.php/register/newuser'){
                      //  if($_POST['referingpage'] != base_url().'index.php/login/checklogin'){
                        
                            $location=$_POST['referingpage'];
                            
                            $data = array('referpage' => $location );
                            
                    $this->session->set_userdata($data);
                            
                            
                        // }
                        }
                    
                      }
                
                }
         else{
             
             echo "not setted";
             
             
         }       
                
      
        $this->form_validation->set_rules('usr_name', 'Username', 'required');
        $this->form_validation->set_rules('pwd', 'Password', 'required');
		
                if ($this->form_validation->run() == FALSE)
		{
                    $this->session->set_flashdata('errmsg1',form_error('usr_name'));
                    $this->session->set_flashdata('errmsg2',form_error('pwd'));
                                    
                   redirect('login');
                    //$this->index();
		}  
                
        $result = $this->process->login2();        
       
        if($result==1){
           $msg = '<font color=red>Invalid username</font><br />';
           //$this->index($msg);
           
           $this->session->set_flashdata('error_message',$msg);
           redirect('login');

        }
         if($result==2){
           $msg = '<font color=red>Invalid Password</font><br />';
           //$this->index($msg);
           
            $this->session->set_flashdata('error_message',$msg);
           redirect('login');

        }
        if($result == 0){
            if($this->session->userdata('userlevel') == '5'){
                redirect('admin/dashboard');                
                
            }else{                

            
                if($this->session->userdata('referpage')){
                    redirect($this->session->userdata('referpage'));
                }
                else{
                
                redirect('home');
                }
            }
             //$this->session->userdata('userlevel') == 'admin' ? redirect('admin/') : redirect('user');  
 
        }
   
          
  }
  
  
  private function check_isvalidated(){
        if(! $this->session->userdata('validated')){
            redirect('login');
        }
    }
    
    
  function do_admin(){
       if($this->session->userdata('userlevel') == '5'){
                redirect('admin/dashboard');                
                
            }
            else{
                redirect('login');
            }
    }
//   function login($msg = NULL){
//       $data['msg'] = $msg;
//      $this->load->view('layouts/header');    
//		$this->load->view('login',$data);
//                $this->load->view('layouts/footer'); 
//  } 
  
  function newuser(){
      $this->load->view('register');
      
     // redirect('register');
  }
  
  
  function register(){
      $this->load->model('process');
       
            
      $result = $this->process->register();  
      
       if(! $result){
           
            echo "failed";
        }else{
            
            redirect('register');
            echo "success";
        }
  }
  
  function newpro(){
      $session['objSession'] = $this->session;
      $this->load->view('addform',$session);
      
  }
  
  
  function addpro(){
      $this->load->model('process');
      
      $result = $this->process->pro_add();
      if(! $result){
           
            echo "failed";
        }else{          
                       
             return true;
            
        }
  }
  
  
  public function do_logout(){
        $this->session->sess_destroy();
        redirect('home');
    }

    
    
    
}
