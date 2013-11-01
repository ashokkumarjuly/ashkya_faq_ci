<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Questions_manage extends CI_Controller {

  function __construct()
  {
    parent::__construct();
    $this->is_logged_in();  
        $this->is_admin();
    
  }

  function index()
  { 
             $this->load->model('process');   
             
             
               $this->load->library('pagination');
        
        $config = array();
        $config["base_url"] = base_url() . "index.php/admin/questions_manage/index";
        $config["total_rows"] = $this->process->questionlist_pending();  
        $config["per_page"] = 1;
        $config['num_links'] = 5; 
        $config["uri_segment"] = 4;

         
     
        
        $config['full_tag_open'] = '<div class="pagination"><ul>';
        $config['full_tag_close'] = '</ul></div><!--pagination-->';
        $config['first_link'] = '&laquo; First';
        $config['first_tag_open'] = '<li class="prev page">';
        $config['first_tag_close'] = '</li>';

        $config['last_link'] = 'Last &raquo;';
        $config['last_tag_open'] = '<li class="next page">';
        $config['last_tag_close'] = '</li>';

        $config['next_link'] = 'Next &rarr;';
        $config['next_tag_open'] = '<li class="next page">';
        $config['next_tag_close'] = '</li>';

        $config['prev_link'] = '&larr; Previous';
        $config['prev_tag_open'] = '<li class="prev page">';
        $config['prev_tag_close'] = '</li>';

        $config['cur_tag_open'] = '<li class="active"><a href="">';
        $config['cur_tag_close'] = '</a></li>';

        $config['num_tag_open'] = '<li class="page">';
        $config['num_tag_close'] = '</li>';    

        $this->pagination->initialize($config);      

        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $data['ques_status'] =  $this->process->questionstatus($config["per_page"], $page);       

        $data["links"] = $this->pagination->create_links();
             
             
             
             
             
             
             
             
             
             
             
	     $data['objSession'] = $this->session;
//             $data['ques_status'] = $this->process->questionstatus(); 
             $data['pending_quetions'] = $this->process->questionlist_pending();
                $this->load->view('layouts/header');    
		$this->load->view('admin/questions_view',$data);
                $this->load->view('layouts/footer');
                
                      
                 
                //$data = array('user_list' => $this->upload->data());

			
                

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
  function deleteques(){
      if($this->input->is_ajax_request())
        {
           $this->load->model('process');             
           $result = $this->process->delete_ques();        
//            echo '<p>question +  '.$this->input->post('id').'</p>';   
           if($result){           
               echo "Deleted";               
           }    
           else{
               return false;
           }
        }
        else
        {           
            echo '<p>But your ajax failed miserably</p>';
        } 
     // echo "hello";
  }

function approveques(){
    $this->load->model('process'); 
    if($this->input->is_ajax_request())
        {
           
           $result = $this->process->approve_ques();        

           if($result){           
               echo 'success';               
           }    
           else{
               return false;
           }
        }
        else
        {           
            echo '<p>But your ajax failed miserably</p>';
        }
}



}
