<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Category extends CI_Controller {
     function __construct()
  {
    parent::__construct();
    //$this->is_logged_in(); 
  }
  
	public function index($cat_id = NULL)
	{
           //  $data['cat'] = $cat_id;
            $this->load->model('process'); 
            $this->load->library('pagination');
            $data['catdetail'] = $this->process->category_detail($cat_id);
             $data['objSession'] = $this->session;
                $data['catlist'] = $this->process->categorylist();  
                //$data['cat_queslist'] = $this->process->question_category($cat_id);   
                $data['userdetail'] = $this->process->userlist(); 
            
            if(!$cat_id || !$data['catdetail'])
                      {
                
                      //echo "You do not have permission to view this page";
                      //return;
                       $this->load->view('layouts/header');    
		$this->load->view('error',$data);
                $this->load->view('layouts/footer');
                  return;
                      }

                      
                      
        $config = array();
        //$config["base_url"] = base_url() . "index.php/category/index/$cat_id";
        
         $config["base_url"] = site_url("category/index/$cat_id");
        $config["total_rows"] = $this->process->question_catcount($cat_id);  
        $config["per_page"] = 2;
        $config["uri_segment"] = 4;
//        $config['use_page_numbers'] = TRUE;

        
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
        
        
        
//         $config['first_url'] = '1';
        $this->pagination->initialize($config);     

        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $data['cat_queslist'] =  $this->process->question_category($cat_id,$config["per_page"], $page);   
        $data["links"] = $this->pagination->create_links();
        
               
                
                      
                $data['total']=$config["total_rows"];
                
               $this->load->view('layouts/header');    
		$this->load->view('categoryview',$data);
                $this->load->view('layouts/footer'); 
	}
        
   
        
   function login($msg = NULL){
       redirect('login');
  } 
  
  
        
}

