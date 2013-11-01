<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Category extends CI_Controller {

  function __construct()
  {
    parent::__construct();
    $this->is_logged_in();  
        $this->is_admin();
  }

   function index($msg = NULL)
  {     //$data['image_error'] = $msg;
             $this->load->model('process'); 
              $this->load->library('pagination');
              
               $config = array();
        $config["base_url"] = base_url() . "index.php/admin/category/index";
        
//        $config["base_url"] = site_url("admin/category/index");
       $config["total_rows"] = $this->process->allcategory_count();  
        $config["per_page"] = 2;
         
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
        $data['query'] =  $this->process->all_category($config["per_page"], $page);       

        $data["links"] = $this->pagination->create_links();  
              
              
	     $data['objSession'] = $this->session;
             //$data['query'] = $this->process->categorylist(); 
		$data['total_category'] = $this->process->allcategory_count();
                
                $data['total_category'] = $config["total_rows"];
                
                $this->load->view('layouts/header');    
		$this->load->view('admin/category_view',$data);
                $this->load->view('layouts/footer');

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
function category_add()
	{         
       $this->load->helper(array('form', 'url'));
      $this->load->library('form_validation');
      $file_element_name = 'cat_img';
      $this->form_validation->set_rules('cat_name', 'Category Name', 'required|is_unique[tbl_category.cat_name]');
      
      if ($this->form_validation->run() == FALSE)
		{
          //echo "asdf";
                $this->index();
		}
     if($this->form_validation->run() == TRUE){
                $config['file_name']= md5(rand() * time());         
		$config['upload_path'] = 'images/category/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '100';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';                
         
		$this->load->library('upload', $config);       
		if (! $this->upload->do_upload($file_element_name))
		{
                    $msg = $this->upload->display_errors();	
                     $this->session->set_flashdata('edit_image',$msg);
//                        $this->index($msg);	
                redirect('admin/category');
		}
		else
		{
                    $this->load->model('process');                      
                    
                    $data = $this->upload->data();
                    $imagelocation='/images/category/'.$data['file_name'];  
                   // echo  $imagelocation;
                    
                    $catname = $this->security->xss_clean($this->input->post('cat_name'));
                    $file_id = $this->process->addCategory($imagelocation, $catname);		
                    
                    if($file_id){
                        $msg = '<font color=green>Uploaded Successfully .</font><br />';
//                        $this->index($msg);
                          $this->session->set_flashdata('add_cat',$msg);
	                  redirect('admin/category');
                    }
                    else{
                        $msg = '<font color=red>Uploaded Failed </font><br />';
//                        $this->index($msg);
                          $this->session->set_flashdata('add_cat',$msg);
	                  redirect('admin/category');
                    }                        
			
		}
	}

    }
    
    function category_edit(){
        //echo"success";
        $this->load->helper(array('form', 'url'));
      $this->load->library('form_validation');
      $file_element_name = 'edit_catimage';
      $this->form_validation->set_rules('edit_catname', 'Category Name', 'required');
      
      if ($this->form_validation->run() == FALSE)
		{
          //echo "asdf";
                    $this->session->set_flashdata('result_cat',form_error('edit_catname'));
	            redirect('admin/category');
		}
                
      if($this->form_validation->run() == TRUE){
                $config['file_name']= md5(rand() * time());         
		$config['upload_path'] = 'images/category/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '100';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';                
         
		$this->load->library('upload', $config);       
		if (! $this->upload->do_upload($file_element_name))
		{
                    $msg = $this->upload->display_errors();			
//                        $this->index($msg);
                    $this->session->set_flashdata('result_cat',$msg);
	            redirect('admin/category');
		}
		else
		{
                    $this->load->model('process');                      
                    
                    $data = $this->upload->data();
                    $imagelocation='/images/category/'.$data['file_name'];  
                    //echo  $imagelocation;
                    
                    
                    $file_id = $this->process->edit_category($imagelocation);		
                    
                    if($file_id){
                        $msg = '<font color=green>Uploaded Successfully .</font><br />';
//                        $this->index($msg);
                         $this->session->set_flashdata('result_cat',$msg);
	            redirect('admin/category');
                        
                    }
                    else{
                        $msg = '<font color=red>Uploaded Failed </font><br />';
//                        $this->index($msg);
                         $this->session->set_flashdata('result_cat',$msg);
	            redirect('admin/category');
                    }                        
			
		}
	}          
    }
   
    
    function deletecat(){
      if($this->input->is_ajax_request())
        {
           $this->load->model('process');             
           $result = $this->process->delete_cat();        
//            echo '<p>question +  '.$this->input->post('id').'</p>';   
           if($result){           
               echo "Category Deleted";               
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
    
    
}
