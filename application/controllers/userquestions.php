<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Userquestions extends CI_Controller {

  function __construct()
  {
    parent::__construct();
     //$this->load->helper(array('url'));
  }

  function index($userid = NULL)
  { 
                //echo $userid;
       if(!$userid)
                      {
                      echo "You do not have permission to view this page";
                      return false;
                  
                      } 
                      
             $data['userid'] = $userid;
             $this->load->model('process');
             $this->load->library('pagination');
        
        $config = array();
        $config["base_url"] = base_url() . "index.php/userquestions/index/$userid";
        $config["total_rows"] = $this->process->get_totalquestion($userid);  
        $config["per_page"] = 2;
        $config["uri_segment"] = 4;
        $config['use_page_numbers'] = TRUE;
        
         
        $config['cur_tag_open'] = '<b>';
//        $config['full_tag_open'] = '<p>';
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
        $data['userques_list'] =  $this->process->user_queslist($userid,$config["per_page"], $page);
        
         if(!$data['userques_list'])
                      {
                      echo "You do not have permission to view this page";
                      return false;
                  
                      }
        
        
        
        $data["links"] = $this->pagination->create_links();
        
                $data['objSession'] = $this->session;
                $data['userdetail'] = $this->process->get_username($userid); 
                 $data['catlist'] = $this->process->categorylist(); 
                $data['totalquestion'] = $this->process->get_totalquestion($userid);  
                $data['totalanswered'] = $this->process->get_totalanswered($userid);  
               
                //$data['userques_list'] = $this->process->user_queslist($userid);                
                
                 
               $this->load->view('layouts/header');    
		$this->load->view('viewuserquestions',$data);
                $this->load->view('layouts/footer'); ;

  }


}
