<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class process extends CI_Model{
    
    private $table_user	= 'tbl_user';
    private $table_category = 'tbl_category';
    private $table_ques = 'tbl_ques';
    private $table_answers = 'tbl_answers';
    
    
    function __construct(){
        parent::__construct();
    }
      public function login(){
        
//        $username = $this->security->xss_clean($this->input->post('usr_email'));
        $username = $this->security->xss_clean($this->input->post('usr_name'));
        $password = $this->security->xss_clean($this->input->post('pwd')); 
        
        //$username = $this->input->post('usr_name');
        //$password = $this->input->post('pwd');
         
        $password=md5($password);
        
        $this->db->where('user_name', $username);
        $this->db->where('user_password', $password);
         
        
        $query = $this->db->get($this->table_user);
        
        if($query->num_rows == 1)
        {
           
            $row = $query->row();
            $data = array(
                    'userid' => $row->id,
                    'username' => $row->user_name,
                    'userlevel' => $row->user_level,               
                
                    'validated' => true,
                    'is_logged_in' => true
                    );
            $this->session->set_userdata($data);
            return true;
        }
        
        return false;
    }
    
    public function login2(){
        
//        $username = $this->security->xss_clean($this->input->post('usr_email'));
        $username = $this->security->xss_clean($this->input->post('usr_name'));
        $password = $this->security->xss_clean($this->input->post('pwd'));        
         
        $password=md5($password);
        
        $this->db->where('user_name', $username);
        //$this->db->where('user_password', $password);
         
        
        $query = $this->db->get($this->table_user);
        
        if($query->num_rows == 0){
         return 1; //Indicates username failure
        }
      
        
        if($query->num_rows == 1){
           
            $row = $query->row();
           
         if($password == $row->user_password){
             //$row = $query->row();
            $data = array(
                    'userid' => $row->id,
                    'username' => $row->user_name,
                    'userlevel' => $row->user_level,               
                
                    'validated' => true,
                    'is_logged_in' => true
                    );
            $this->session->set_userdata($data);
             
               //return true; //Success! Username and password confirmed
            return 0;
               }
         else{
                return 2; //Indicates password failure
            }
            
            
        }
        
        
      
//        if($query->num_rows == 1)
//        {
//           
//            $row = $query->row();
//            $data = array(
//                    'userid' => $row->id,
//                    'username' => $row->user_name,
//                    'userlevel' => $row->user_level,               
//                
//                    'validated' => true,
//                    'is_logged_in' => true
//                    );
//            $this->session->set_userdata($data);
//            return true;
//        }
        
        return false;
    }
    
    function register(){
        
        $username = $this->security->xss_clean($this->input->post('user_name'));
        $password = $this->security->xss_clean($this->input->post('pwd'));        
        $useremail = $this->security->xss_clean($this->input->post('user_email'));
        $gender =$this->security->xss_clean($this->input->post('gender'));
        $time = date('Y-m-d');
        //echo $username."...".$password."...".$useremail;
        
        $data['user_name'] = $username;
        $data['user_password'] = md5($password);
        $data['user_email'] = $useremail;
	$data['user_gender'] = $gender;
        $data['date'] = $time;	

		if ($this->db->insert($this->table_user, $data)) {
                   return true;
		}
		return false;
        
    }   
   
function is_username_available($username)
	{
		$this->db->select('1', FALSE);
		$this->db->where('LOWER(user_name)=', strtolower($username));

		$query = $this->db->get($this->table_user);
		return $query->num_rows() == 0;
	}    
    
 function is_currentpassword($pass,$id){
     $password = $this->security->xss_clean($this->input->post('current_password')); 
    
     $this->db->select('1', FALSE);
              $this->db->where('id',$id);
		$this->db->where('user_password',md5($password) );

		$query = $this->db->get($this->table_user);
                
                if($query->num_rows()== 1){
                    return true;
                }
                else{
                    return false;
                }
                
		//return $query->num_rows() == 0;
 }       
 function update_pass($userid){      
        $password = $this->security->xss_clean($this->input->post('pass1')); 
        
        $data = array(
               'user_password' => md5($password)
            );

        $this->db->where('id', $userid);
      if($this->db->update($this->table_user, $data)){

                   return true;
      }
      else{
                    return false;
                }
 }       
        
 function userlist(){
     $query = $this->db->get($this->table_user);
     return $query;
 }  
 function categorylist(){
     
     $catlist = $this->db->get($this->table_category);
     
     return $catlist;    
 }
 
 function all_category($limit, $start){
     
    $query = $this->db->get($this->table_category, $limit,$start);
   return $query;
 }
 
 function all_userlist($limit, $start){
     
//    $query = $this->db->get($this->table_user, $limit,$start);
//   return $query;
     $this->db->select('*');         
     $this->db->from($this->table_user);
     
      $this->db->limit($limit, $start);
     $sql= $this->db->get();
     if($sql){
         return $sql;
     }
     
     
     
     else 
 {
     return null;   
 }
     
 }
 
// function recent_questionlist(){
//    $this->db->select('tbl_ques.*, COUNT(tbl_answers.id) as num_answers,tbl_category.*,tbl_category.cat_name as catname');
//        $this->db->from($this->table_ques);
//         $this->db->where('ques_status', '1');
////          $this->db->where('ans_parent_id', '0');
//        $this->db->order_by('tbl_ques.ques_date','desc');
//        $this->db->limit(10);
//        
//       $this->db->join('tbl_answers','ques_id = tbl_ques.id','left');
//         $this->db->join($this->table_category, ''.$this->table_category.'.cat_id = '.$this->table_ques.'.cat_id');
//      
//         $this->db->group_by('id');
//     $query = $this->db->get();
//     return $query;
//
// }
 
  function recent_questionlist(){
     $this->db->select('id');         
     $this->db->from($this->table_ques);
     $this->db->where('ques_status', '1');
     $this->db->order_by('tbl_ques.ques_date','desc');
     $this->db->limit(10);
     $sql = $this->db->get();
     
    if ($sql->num_rows ()>0) {
    $a = array();
    //$count=0;
    foreach($sql->result() as $row) {
        $this->db->select('tbl_ques.*, COUNT(tbl_answers.id) as num_answers,tbl_category.*,tbl_category.cat_name as catname,tbl_user.id as userid,tbl_user.user_name as username');
        $this->db->from($this->table_ques);        
        $this->db->where('tbl_ques.id',$row->id);
         $this->db->where('ans_parent_id', '0');
        
        $this->db->join('tbl_answers','ques_id = tbl_ques.id','left');
        $this->db->join($this->table_category, ''.$this->table_category.'.cat_id = '.$this->table_ques.'.cat_id');
        $this->db->join($this->table_user, ''.$this->table_user.'.id = '.$this->table_ques.'.user_id');
       $a[] = $this->db->get()->row();
       
    }   
    return $a;
 }
 else 
 {
     return null;   
 }
 }
 
 
 
 
 
 
 
 
 
//function allquestionlist($limit, $start) {
//    $this->db->select('tbl_ques.*, COUNT(tbl_answers.id) as num_answers');
//        $this->db->from($this->table_ques);
//        $this->db->where('ques_status', '1');
////        $this->db->where('ans_parent_id', '0');
//        $this->db->order_by('tbl_ques.ques_date','desc');      
//       $this->db->join('tbl_answers','ques_id = tbl_ques.id','left');
//       $this->db->group_by('id');
//               $this->db->limit($limit, $start);
//     $query = $this->db->get();
//     return $query;
//}

function allquestionlist($limit, $start){
     $this->db->select('id');         
     $this->db->from($this->table_ques);
     $this->db->where('ques_status', '1');
     $this->db->order_by('tbl_ques.ques_date','desc');
     //$this->db->limit(10);
      $this->db->limit($limit, $start);
     $sql = $this->db->get();
     
    if ($sql->num_rows ()>0) {
    $a = array();
    //$count=0;
    foreach($sql->result() as $row) {
        $this->db->select('tbl_ques.*, COUNT(tbl_answers.id) as num_answers,tbl_category.*,tbl_category.cat_name as catname');
        $this->db->from($this->table_ques);        
        $this->db->where('tbl_ques.id',$row->id);
         $this->db->where('ans_parent_id', '0');
        
        $this->db->join('tbl_answers','ques_id = tbl_ques.id','left');
        $this->db->join($this->table_category, ''.$this->table_category.'.cat_id = '.$this->table_ques.'.cat_id');
        //$this->db->limit($limit, $start);
        $a[] = $this->db->get()->row();
       
    }   
    return $a;
 }
 else 
 {
     return null;   
 }
 }



//function question_category($cat_id,$limit,$start){
//       $this->db->select('tbl_ques.*, COUNT(tbl_answers.id) as num_answers');
//        $this->db->from($this->table_ques);
//         $this->db->where('cat_id', $cat_id);
//         $this->db->where('ques_status', '1');
//         $this->db->order_by('tbl_ques.ques_date','desc'); 
//       $this->db->limit($limit);
//     $this->db->join('tbl_answers','ques_id = tbl_ques.id','left');
//       $this->db->group_by('id');
//      
//       
//     $query = $this->db->get(); 
//  
//      return $query; 
// }
 
function question_category($cat_id,$limit,$start){   
     $this->db->select('id');         
     $this->db->from($this->table_ques);
     $this->db->where('ques_status', '1');
     $this->db->where('cat_id', $cat_id);
     $this->db->order_by('tbl_ques.ques_date','desc');
  $this->db->limit($limit, $start);
//     $this->db->limit($limit);
     $sql = $this->db->get();
     
    if ($sql->num_rows ()>0) {
    $a = array();
    //$count=0;
    foreach($sql->result() as $row) {
        $this->db->select('tbl_ques.*,tbl_user.*,COUNT(tbl_answers.id) as num_answers,tbl_user.id as userid,tbl_ques.id as quesid,tbl_category.*,tbl_category.cat_name as catname');
        $this->db->from($this->table_ques);        
        $this->db->where('tbl_ques.id',$row->id);
         $this->db->where('ans_parent_id', '0');
        
        $this->db->join('tbl_answers','ques_id = tbl_ques.id','left');
          $this->db->join($this->table_user, ''.$this->table_user.'.id = '.$this->table_ques.'.user_id');
        $this->db->join($this->table_category, ''.$this->table_category.'.cat_id = '.$this->table_ques.'.cat_id');
       // $this->db->join($this->table_user, ''.$this->table_user.'.id = '.$this->table_ques.'.user_id');
     
        $a[] = $this->db->get()->row();
       
    }   
    return $a;
 }
 else 
 {
     return null;   
 }
 }
 
 
 
 
 
function treat(){
      $this->db->select('tbl_ques.*, COUNT(tbl_answers.id) as num_answers');
        $this->db->from($this->table_ques);
        $this->db->order_by('tbl_ques.id','desc');
        $this->db->limit(3);

       $this->db->join('tbl_answers','ques_id = tbl_ques.id');
       $this->db->group_by('ques_id');
     $query = $this->db->get();
     return $query;
 } 
//function user_queslist($userid,$limit,$start){
//      $this->db->select('tbl_ques.*, COUNT(tbl_answers.id) as num_answers,tbl_category.*,tbl_category.cat_name as catname');
//        $this->db->from($this->table_ques);
//        $this->db->where('tbl_ques.user_id',$userid);
//        $this->db->where('ques_status', '1');
//        $this->db->where('tbl_answers.ans_parent_id','0');
//        $this->db->order_by('tbl_ques.id','desc');
//        //$this->db->limit($limit);
//
//       $this->db->join('tbl_answers','ques_id = tbl_ques.id','left');
//        $this->db->join($this->table_category, ''.$this->table_category.'.cat_id = '.$this->table_ques.'.cat_id');
//       $this->db->group_by('id');
//     $query = $this->db->get();
//     return $query;
//}  
function user_queslist($userid,$limit,$start){
     $this->db->select('id');         
     $this->db->from($this->table_ques);
     $this->db->where('tbl_ques.user_id',$userid);
     $this->db->where('ques_status', '1');
     $this->db->order_by('tbl_ques.ques_date','desc');
     $this->db->limit($limit,$start);
     $sql = $this->db->get();
     
    if ($sql->num_rows ()>0) {
    $a = array();
    //$count=0;
    foreach($sql->result() as $row) {
        $this->db->select('tbl_ques.*, COUNT(tbl_answers.id) as num_answers,tbl_category.*,tbl_category.cat_name as catname');
        $this->db->from($this->table_ques);        
        $this->db->where('tbl_ques.id',$row->id);
         $this->db->where('ans_parent_id', '0');
        
        $this->db->join('tbl_answers','ques_id = tbl_ques.id','left');
        $this->db->join($this->table_category, ''.$this->table_category.'.cat_id = '.$this->table_ques.'.cat_id');
       $a[] = $this->db->get()->row();
       
    }   
    return $a;
 }
 else 
 {
     return null;   
 }
 }
function user_answerlist($userid,$limit,$start){
   $this->db->select('ques_id'); 
   $this->db->where('tbl_answers.user_id',$userid);
//   $this->db->where('tbl_answers.ans_parent_id','0');
//     $this->db->distinct();
     $this->db->from($this->table_answers);
     $this->db->order_by("ans_date","DESC"); 
$this->db->limit($limit,$start);
       $this->db->group_by('ques_id');
     $sql = $this->db->get();
     
     if ($sql->num_rows ()>0) {
    $a = array();
    //$count=0;
    foreach($sql->result() as $row) {
        $this->db->select('tbl_ques.*, COUNT(tbl_answers.id) as sum_answers,tbl_category.*,tbl_category.cat_name as catname');
        $this->db->from($this->table_ques);        
        $this->db->where('tbl_ques.id',$row->ques_id);
        $this->db->where('tbl_answers.ans_parent_id','0');
        
        
        $this->db->join('tbl_answers','ques_id = tbl_ques.id','left');
        $this->db->join($this->table_category, ''.$this->table_category.'.cat_id = '.$this->table_ques.'.cat_id');
      
        $a[] = $this->db->get()->row();
       
       
    }   
    return $a;
 }
     
  else 
 {
     return null;   
 }   
     
     
}

function useranswerlist_count($userid){
     
     $this->db->where('tbl_answers.user_id',$userid); 
     $this->db->where('tbl_answers.ans_parent_id','0');
   
     $count=$this->db->count_all_results($this->table_answers);
      return $count;
     
     
}   
 function recent_answerlist(){
     $this->db->select('ques_id');    
     $this->db->distinct();
     $this->db->from($this->table_answers);
     $this->db->order_by("ans_date","DESC"); 
     $this->db->limit(10);
     $sql = $this->db->get();
     
    if ($sql->num_rows ()>0) {
    $a = array();
    //$count=0;
    foreach($sql->result() as $row) {
        $this->db->select('tbl_ques.*, COUNT(tbl_answers.id) as sum_answers,tbl_category.*,tbl_category.cat_name as catname,tbl_user.id as userid,tbl_user.user_name as username');
        $this->db->from($this->table_ques);        
        $this->db->where('tbl_ques.id',$row->ques_id);
         $this->db->where('tbl_answers.ans_parent_id', '0');
//        $this->db->order_by("tbl_answers.ans_date","DESC");
        
        $this->db->join('tbl_answers','ques_id = tbl_ques.id','left');
        $this->db->join($this->table_category, ''.$this->table_category.'.cat_id = '.$this->table_ques.'.cat_id');
        $this->db->join($this->table_user, ''.$this->table_user.'.id = '.$this->table_ques.'.user_id');
       $a[] = $this->db->get()->row();
       
    }   
    return $a;
 }
 else 
 {
     return null;   
 }
 }
 
 function recent_answerlist2(){
  $this->db->select('ques_id');    
     $this->db->distinct();
     $this->db->from($this->table_answers);
     $this->db->order_by("ans_date","DESC"); 
     $this->db->limit(10);
     $sql = $this->db->get();
     
    if ($sql->num_rows ()>0) {
    $a = array();
    //$count=0;
    foreach($sql->result() as $row) {
        $this->db->select('tbl_ques.*, COUNT(tbl_answers.id) as sum_answers,tbl_category.*,tbl_category.cat_name as catname,tbl_user.id as userid,tbl_user.user_name as username');
        $this->db->from($this->table_ques);        
        $this->db->where('tbl_ques.id',$row->ques_id);
         $this->db->where('tbl_answers.ans_parent_id', '0');
//        $this->db->order_by("tbl_answers.ans_date","DESC");
        
        $this->db->join('tbl_answers','ques_id = tbl_ques.id','left');
        $this->db->join($this->table_category, ''.$this->table_category.'.cat_id = '.$this->table_ques.'.cat_id');
        $this->db->join($this->table_user, ''.$this->table_user.'.id = '.$this->table_ques.'.user_id');
       $a[] = $this->db->get()->row();
       
    }   
    return $a;
 }
 else 
 {
     return null;   
 }
 }
 
 
 
 function questionstatus($limit,$start){
   $this->db->select('tbl_ques.*,tbl_user.*,tbl_category.*,tbl_ques.id as questionid,tbl_user.id as userid,tbl_category.cat_name as catname');
     $this->db->from($this->table_ques);
     $this->db->where('tbl_ques.ques_status','0');
     $this->db->join($this->table_user, ''.$this->table_user.'.id = '.$this->table_ques.'.user_id');
     $this->db->join($this->table_category, ''.$this->table_category.'.cat_id = '.$this->table_ques.'.cat_id');
     $this->db->limit($limit,$start);
     
     if($query = $this->db->get()){
         return $query;
     }
     else  {
     return null;
     }
   
 }
// function questionstatus2(){
//     $this->db->select('tbl_ques.*,tbl_user.*,tbl_category.*,tbl_ques.id as questionid,tbl_user.id as userid,tbl_category.cat_name as catname');
//     $this->db->from($this->table_ques);
//     $this->db->join($this->table_user, ''.$this->table_user.'.id = '.$this->table_ques.'.user_id');
//     $this->db->join($this->table_category, ''.$this->table_category.'.cat_id = '.$this->table_ques.'.cat_id');
//     
//     
//     $query = $this->db->get();
//     return $query;
// }
 
 
// function question_view($id){
//     $this->db->where('id', $id);    
//
//		$ques_view = $this->db->get($this->table_ques);
//		if ($ques_view ->num_rows() == 1) {
//                    return $ques_view->row();
//                }else{
//		return NULL;
//                }
// }
 
 function question_view($id){
      $this->db->select('tbl_ques.*,tbl_user.*,tbl_category.*,tbl_ques.id as questionid,tbl_user.id as userid,tbl_category.cat_name as catname');
     $this->db->from($this->table_ques);
     $this->db->where('tbl_ques.id',$id); 
     $this->db->join($this->table_user, ''.$this->table_user.'.id = '.$this->table_ques.'.user_id');
     $this->db->join($this->table_category, ''.$this->table_category.'.cat_id = '.$this->table_ques.'.cat_id');
     
     $ques_view = $this->db->get();
                
                
		if ($ques_view ->num_rows() == 1) {
                    return $ques_view->row();
                }else{
		return NULL;
                }
 }
 
 
 
 
 function answer_view($id){
//     $this->db->where('ques_id', $id);	
//    $this->db->where('ans_parent_id','0' );
//		$ans_view = $this->db->get($this->table_answers);
//		return $ans_view;
     $this->db->select('tbl_answers.*,tbl_user.*,tbl_answers.id as answerid,tbl_answers.ans_parent_id as parentid,tbl_user.id as userid');
     $this->db->from($this->table_answers);
     $this->db->where('tbl_answers.ques_id',$id);
     $this->db->where('tbl_answers.ans_parent_id','0');
     $this->db->join($this->table_user, ''.$this->table_user.'.id = '.$this->table_answers.'.user_id');
   $ans_view = $this->db->get();
		return $ans_view;
		
 }
// function answer_view2($id){
//     $this->db->select('tbl_answers.*,tbl_user.*,tbl_answers.id as answerid,tbl_answers.ans_parent_id as parentid,tbl_user.id as userid');
//     $this->db->from($this->table_answers);
//     $this->db->where('tbl_answers.ques_id',$id);
//     $this->db->where('tbl_answers.ans_parent_id','0');
//     $this->db->join($this->table_user, ''.$this->table_user.'.id = '.$this->table_answers.'.user_id');
//   $ans_view = $this->db->get();
//		return $ans_view;
//		
// }

 
 
 
  
 function addCategory($cat_img,$cat_name){
     $time = date('Y-m-d');     
        $data['cat_name'] = $cat_name;
        $data['cat_image'] = $cat_img;
        $data['cat_date'] = $time;
        
        if ($this->db->insert($this->table_category, $data)) {
                   return true;
		}
		return false;
 }
 
 function edit_category($cat_img){    
     
        $catname = $this->security->xss_clean($this->input->post('edit_catname'));
        $catid = $this->security->xss_clean($this->input->post('cat_id'));
         
        $data = array(
               'cat_name' => $catname,
               'cat_image' => $cat_img            
            );
          $this->db->where('cat_id', $catid);
          
        if ($this->db->update($this->table_category, $data)) {
                   return true;
		}
		return false;
 }
 
 function add_question(){
     $time = date('Y-m-d');  
        $qtitle = $this->security->xss_clean($this->input->post('ques_title'));
        $qdescription = $this->security->xss_clean($this->input->post('ques_description'));        
        $qcat = $this->security->xss_clean($this->input->post('ques_category'));
        
        $data['cat_id'] =$qcat;
        $data['ques_title'] = $qtitle;
        $data['ques_description'] =$qdescription;        
	$data['user_id'] =$this->session->userdata('userid');
        $data['ques_date'] =$time;
        
		if ($this->db->insert($this->table_ques, $data)) {
                   return true;
		}
		return false;
 }
 function edit_post(){
     $qid = $this->security->xss_clean($this->input->post('ques_id'));
     $description= $this->security->xss_clean($this->input->post('ques_description'));
     $user_id = $this->security->xss_clean($this->input->post('user_id'));
     $data = array(
               'ques_description' => $description,                
            );

        $this->db->where('user_id', $user_id);
        $this->db->where('id', $qid);
      if($this->db->update($this->table_ques, $data)){

                   return true;
      }
      else{
                    return false;
                }
     
 }
 function add_answer(){
     $time = date('Y-m-d');  
        $qid = $this->security->xss_clean($this->input->post('question_id'));
        $answer= $this->security->xss_clean($this->input->post('add_answer'));   
  
        $data['ques_id'] =$qid;
        $data['answer'] = $answer;               
	$data['user_id'] =$this->session->userdata('userid');
        $data['ans_date'] =$time;
        
		if ($this->db->insert($this->table_answers, $data)) {
                   return true;
		}
		return false;
 }
 function add_reply(){
     $time = date('Y-m-d');  
        $qid = $this->security->xss_clean($this->input->post('question_id'));
        $parent_id = $this->security->xss_clean($this->input->post('answer_id'));
        
        $reply= $this->security->xss_clean($this->input->post('add_reply'));   
  
        $data['ques_id'] =$qid;
        $data['ans_parent_id'] =$parent_id;
        $data['answer'] = $reply;               
	$data['user_id'] =$this->session->userdata('userid');
        $data['ans_date'] =$time;
        
		if ($this->db->insert($this->table_answers, $data)) {
                   return true;
		}
		return false;
 }
 function add_view(){
     $qid = $this->security->xss_clean($this->input->post('id'));
     $this->db->select('ques_views');     
     $this->db->from($this->table_ques); 
     $this->db->where('id', $qid);
     $quesview = $this->db->get();
     
    if($quesview->num_rows == 1)
        {       
            $row = $quesview->row();
             $viewcount=  (int)$row->ques_views;
             
        $data = array(
               'ques_views' => $viewcount+1,
               
            );
        $this->db->where('id', $qid);
           $this->db->update($this->table_ques, $data); 
           
            $row = $quesview->row();           
                  //echo $row->ques_views;
                
            return true;
        }
     
 }
 
 function category_detail($catid){
    $this->db->select('*');
     $this->db->from($this->table_category);
     $this->db->where('cat_id',$catid);     
    
    if( $cat_detail = $this->db->get()){
   return $cat_detail->row();
    }else{
        return false;
    }
		
 } 
 
 function allusers_count(){
      $allusercount=$this->db->count_all_results($this->table_user);
      return $allusercount;
 }
  function allquestions_count(){
      $this->db->where('ques_status','1');
      $allquestioncount=$this->db->count_all_results($this->table_ques);
      return $allquestioncount;
 }
  function allcategory_count(){
      $count=$this->db->count_all_results($this->table_category);
      return $count;
 }
 
 function question_catcount($cid){
    $this->db->where('cat_id',$cid); 
    $this->db->where('ques_status','1');
     $count=$this->db->count_all_results($this->table_ques);
      return $count;
 }
 
 function questionlist_pending(){
    
    $this->db->where('ques_status','0'); 
     $q_current=$this->db->count_all_results($this->table_ques);
      return $q_current;

 }
 
  function questionlist_current(){
      $time = date('Y-m-d'); 
     $this->db->where('ques_date',$time);  
     $q_current=$this->db->count_all_results($this->table_ques);
      return $q_current;

 }
 function answerlist_current(){
     $time = date('Y-m-d'); 
     $this->db->distinct();
     $this->db->where('ans_date',$time);  
     $ans_current=$this->db->count_all_results($this->table_answers);
      return $ans_current;

 }
 function get_username($userid){
             $this->db->where('id', $userid); 
      
      
     $query = $this->db->get($this->table_user);
        
       if ($query ->num_rows() == 1) {
           
                    return $query->row();
                }else{
		return NULL;
                }  
 }
 function get_totalquestion($userid){
     $this->db->where('user_id', $userid);
     $this->db->where('ques_status','1');
      $questioncount=$this->db->count_all_results($this->table_ques);
      return $questioncount;
     
 }

 function get_totalanswered($userid){
     $this->db->where('user_id', $userid); 
     $this->db->where('ans_parent_id', '0');      
      $answercount=$this->db->count_all_results($this->table_answers);
      return $answercount;
 }
 
 function delete_ques(){
     $qid = $this->security->xss_clean($this->input->post('id'));
     
     if($this->session->userdata('userlevel') == '5'){
          $this->db->where('id', $qid); 
          if($this->db->delete($this->table_ques))
          {
              return true;
          }
          else{
              return false;
          }    
     }
     else{
         return false;
     } 
}

 function delete_user(){
     $uid = $this->security->xss_clean($this->input->post('id'));
     
     if($this->session->userdata('userlevel') == '5'){
         
//         $tables = array('tbl_user', 'tbl_ques', 'tbl_answers');
//         $this->db->where('tbl_user.id', $uid);
//         $this->db->where('tbl_ques.user_id', $uid);
//         $this->db->where('tbl_answer.user_id', $uid);
//         
//         $query = $this->db->delete($tables); 
         
         $this->db->where('id', $uid);
         $this->db->where('user_name', !'admin');
         
        $query= $this->db->delete($this->table_user);
        
         $this->db->where('user_id', $uid);
         $query=$this->db->delete($this->table_ques);
         
         $this->db->where('user_id', $uid);
         $query=$this->db->delete($this->table_answers);
         
          
          if($query)
          {
              return true;
          }
          else{
              return false;
          }    
     }
     else{
         return false;
     } 
}

function delete_cat(){
    $cid = $this->security->xss_clean($this->input->post('cid'));
    
    if($this->session->userdata('userlevel') == '5'){ 
         
     $this->db->select('id');  
     $this->db->where('cat_id', $cid);
     $this->db->from($this->table_ques);     
     $sql = $this->db->get();
     
    if ($sql->num_rows () >0) {    
    foreach($sql->result() as $row) { 
        
         $this->db->where('ques_id',$row->id);
         $query=$this->db->delete($this->table_answers);  
         
       }   
    
     } 
          $this->db->where('cat_id', $cid);
          $query=$this->db->delete($this->table_ques);
 
           $this->db->where('cat_id', $cid);
           $query= $this->db->delete($this->table_category);
 
          if($query)
          {
              return true;
          }
          else{
              return false;
          }    
     }
     else{
         return false;
     } 
    
}



function delete_user2(){
     $uid = $this->security->xss_clean($this->input->post('id'));
    if($this->session->userdata('userlevel') == '5'){
        
    $this->db->delete('tbl_ques,tbl_user,tbl_answer');
     $this->db->from($this->table_ques);
     $this->db->where('tbl_ques.user_id','25');
     $this->db->join($this->table_user, ''.$this->table_user.'.id = '.$this->table_ques.'.user_id');
     $this->db->join($this->table_answers, ''.$this->table_answers.'.user_id = '.$this->table_ques.'.user_id');
     
     
     $query = $this->db->get();
     //return $query;
//    $uid = $this->security->xss_clean($this->input->post('id'));
//      if($this->session->userdata('userlevel') == '5'){
//    
//    
//    $q = $this->db->query('DELETE tbl_user,tbl_ques,tbl_answers
//                  FROM tbl_user
//                  LEFT JOIN tbl_ques ON tbl_ques.user_id = tbl_user.id      
//                  LEFT JOIN tbl_answers ON tbl_ques.user_id = tbl_answers.user_id
//                  WHERE tbl_user.id = '.$uid.'');  
//    $query = $this->db->query($q);
     if($query)
          {
              return true;
          }
          else{
              return false;
          }
    
    }
     else{
         return false;
     } 
}


  function approve_ques(){
     $qid = $this->security->xss_clean($this->input->post('id'));
     
     if($this->session->userdata('userlevel') == '5'){         
          
          $data = array(
               'ques_status' => '1'               
            );
          $this->db->where('id', $qid);
          $query=$this->db->update($this->table_ques, $data); 
        
          if($query)
          {
              return true;
          }
          else{
              return false;
          }    
     }
     else{
         return false;
     }
     
 }

}
?>

