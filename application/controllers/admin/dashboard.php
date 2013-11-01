<?php
class Dashboard extends CI_Controller
{
    function __construct()
    {
        parent:: __construct();
        $this->is_logged_in();  
        $this->is_admin(); 
        //echo "ASDF";
    }
    function index($msg = NULL)
  {     $data['msg'] = $msg;
  $this->load->model('process'); 
      $data['objSession'] = $this->session;
      $data['usercount'] = $this->process->allusers_count();
      $data['questioncount'] = $this->process->allquestions_count();
      $data['queslist_today'] = $this->process->questionlist_current();
      $data['answerlist_today'] = $this->process->answerlist_current();
      $data['pending_quetions'] = $this->process->questionlist_pending();
      $this->load->view('layouts/header');    
		$this->load->view('admin/dashboard_view',$data);
                $this->load->view('layouts/footer'); 
    //$this->check_isvalidated();
    
  }
    function is_logged_in() 
    {
        $is_logged_in = $this -> session -> userdata('is_logged_in');
        if (!isset($is_logged_in) || $is_logged_in != true)
        {
            redirect('login');
        }
    } 
    function is_admin(){
        $is_admin=$this->session->userdata('userlevel') == '5';
       if(!isset($is_admin) || $is_admin != true){
                redirect('login');                
                
            }
    }
    function admin_home()
    {
        $data['main_content'] = 'home_view';
        $this->load->view('admin/dashboard_view');
    }
}
