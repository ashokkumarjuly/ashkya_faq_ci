<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Viewall extends CI_Controller {
     function __construct()
  {
    parent::__construct();
    //$this->is_logged_in(); 
  }
  
	public function index($msg = NULL)
	{
        $data['msg'] = $msg;
        $this->load->model('process'); 
        $this->load->library('pagination');
        
        $config = array();
        $config["base_url"] = site_url("viewall/index");
//        $config["base_url"] = base_url() . "index.php/viewall/index";
        $config["total_rows"] = $this->process->allquestions_count();  
        $config["per_page"] = 5;
        $config['num_links'] = 5; 
        $config["uri_segment"] = 3;
//        $config['use_page_numbers'] = TRUE;
          
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

        
        $config['first_url'] = '1';
      
//        $this->pagination->suffix = '{YOUR QUERY STRING}';
        $this->pagination->initialize($config);  
        

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data['all_queslist'] =  $this->process->allquestionlist($config["per_page"], $page);       

        $data["links"] = $this->pagination->create_links();
                $data['objSession'] = $this->session;
                $data['catlist'] = $this->process->categorylist();  
               // $data['all_queslist'] = $this->process->allquestionlist();              
                $data['userdetail'] = $this->process->userlist(); 
               $data['totalquestion']=$this->process->allquestions_count();  
                
               $this->load->view('layouts/header');    
		$this->load->view('viewquestionlist',$data);
                $this->load->view('layouts/footer');  
	}
        
   
        
   function login($msg = NULL){
       redirect('login');
  } 
  
  
        
}

