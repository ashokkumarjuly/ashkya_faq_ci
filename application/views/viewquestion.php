<div class="navbar">
        
    <div class="navbar-inner">
   
    <ul class="nav">
    <li ><a href="<?php echo base_url();?>">Home</a></li> 
    <li><a href="<?php echo base_url();?>index.php/viewall">View All Questions</a></li>
    <?php if($this->session->userdata('is_logged_in')){ ?> 
    <li><a href="<?php echo base_url();?>index.php/home/addquestion">Post Question</a></li>
    <li><a href="<?php echo base_url();?>index.php/userinfo/index/<?php echo $objSession->userdata('userid'); ?>">My Account</a></li>  
    <?php }?> 
    <li class="active"><a href="javascript:void(0)">View Question</a></li>  
    
    
    </ul>        
      <?php if($this->session->userdata('is_logged_in')){ ?>    
     <p class="navbar-text pull-right">Logged in as  <a href="<?php echo base_url();?>index.php/userinfo/index/<?php echo $objSession->userdata('userid'); ?>">
         <?php echo $objSession->userdata('username'); ?></a>
     <?php if($this->session->userdata('userlevel') == '5'){?>
          <a href="<?php echo base_url();?>/index.php/admin/dashboard" title="Dashboard">
              <i class="icon-user"></i>
          </a>
                
     </p>
     <?php } }?> 
    </div>   
        
    </div>	
		<!-- Slider -->
<!--		<div id="slider">
			<div id="slider-holder">
				<ul>
				    <li><a href="#"><img src="css/images/slide1.jpg" alt="" /></a></li>
				    <li><a href="#"><img src="css/images/slide2.jpg" alt="" /></a></li>
				    <li><a href="#"><img src="css/images/slide1.jpg" alt="" /></a></li>
				    <li><a href="#"><img src="css/images/slide2.jpg" alt="" /></a></li>
				    <li><a href="#"><img src="css/images/slide1.jpg" alt="" /></a></li>
				    <li><a href="#"><img src="css/images/slide2.jpg" alt="" /></a></li>
				</ul>
			</div>
			<div id="slider-nav">
				<a href="#" class="prev">Previous</a>
				<a href="#" class="next">Next</a>
			</div>
		</div>-->
		<!-- End Slider -->
		
	</div>
</div>
<div id="" style="float: left;width: 14%;">

<div class="well sidebar-nav-fixed">
        <ul class="nav nav-list">
       
          <li class="nav-header">Category</li>
          <?php foreach ($catlist->result() as $row){?> 
          <li><a href="<?php echo base_url();?>index.php/category/index/<?php echo $row->cat_id; ?>"><?php echo $row->cat_name; ?></a></li>
          <?php } ?>         
        </ul>
      </div><!--/.well -->
</div>



    <div id="main" style="margin: 0px auto; width:70%; min-height:380px;">
        
<div id="container" class="container" style="width:100%">

 <div id="qtitle-block" style="margin-bottom: 2em;padding-bottom: 2em;"><span> <?php //echo $msg; ?></span> 
<h1 style="letter-spacing:1px;word-spacing: 2px;border-bottom: 1px solid #DDDDDD;color: #444444;font-family: Arial,Helvetica,sans-serif;font-size: 16px;line-height: 1.1em;position: relative;">
    <span><?php echo $ques_view ->ques_title; ?></span></h1>     
<!--<span style="font-family: Arial,Helvetica,sans-serif;font-size: 12px;">Posted in <?php echo $ques_view ->cat_id; ?></span>-->

<div id="ques_details" style="padding:10px;width:90%;">
<!--<div style="padding-left: 10px;width: 620px;">-->
<div style="background: none repeat scroll 0 0 #FFFFFF;text-align: center;border: 1px solid #DDDDDD;float: left;margin-right: 5px;width: 10%;">
<span style="display: block;font-size: 20px;font-weight: 700;line-height: 24px;padding-top: 10px;overflow: hidden;">
    <?php echo $ques_view ->ques_views; ?></span>
   <span>Views</span> 
</div>  

    <p style="text-align: justify;"><?php echo $ques_view ->ques_description; ?></p>
<!--</div>-->    
</div>

    
<!--    Question status , Posted , Category   -->
    
    
<div id="ques_status" style="width:90%;padding-bottom:12px;margin-bottom:1em;float:left; border-bottom: 1px solid;">  
    
<div style="font-size: 12px;margin-top:1em;width: 50%;float: left; ">
 <?php if($objSession->userdata('userid')==$ques_view->user_id):?>
      <a href="javascript:void(0)" onclick="$('#editpost').toggle()" title="Edit Post"><i class="icon-edit"></i></a> 
  <?php endif;?>  
     
      Posted on <?php echo $ques_view ->ques_date; ?> in      
    
            <a href="<?php echo base_url();?>index.php/category/index/<?php echo $ques_view ->cat_id; ?>">
                <?php echo $ques_view ->cat_name; ?>              
            </a>
              
         
     by
     
    
    <td>
        <a href="<?php echo base_url();?>index.php/userinfo/index/<?php echo $ques_view->user_id; ?>">
            <?php echo  $ques_view ->user_name; ?>
        </a>
    </td>
    
    
    
</div>
    
    
<?php if(!$this->session->userdata('is_logged_in')){ ?> 
   <div id="loggedin_post" style="display:none">
       <h1 style="border-bottom: 1px solid #DDDDDD;color: #444444;font-family: Arial,Helvetica,sans-serif;font-size: 16px;font-weight: 700;line-height: 1.1em;margin: 0.5em 0 25px;padding: 14px 25px 5px 0;position: relative;">
       Please <a href="<?php echo base_url();?>index.php/login">Login</a> or <a href="<?php echo base_url();?>index.php/register">Register</a> to answer this question.
       </h1>   
   </div>    
<?php }?> 
   
  <span style="font-size: 12px;float: right">
     <a href="javascript:void(0)" onclick="$('#add_answer').toggle()"> Post your Answer  <i class="icon-plus-sign"></i></a>
  </span>
    <span><?php echo form_error('add_answer'); ?></span>
    <span><?php echo form_error('add_reply'); ?></span>
    <span><?php echo $msg; ?></span>
</div>  

</div>    
<!--   Answer - below Content starts     -->
  <div style="width:50%;display: none;" id="editpost" >
      
       <form class="form-horizontal" enctype="multipart/form-data" method='post' action="<?php echo base_url();?>index.php/answers/editpost">
       
       <label>EDIT DESCRIPTION</label><span class="help-inline"><?php echo form_error('ques_description'); ?></span>
       <textarea rows="3" class="input-xxlarge" value="<?php echo set_value('ques_description'); ?>"  name="ques_description" placeholder="Enter Description" ><?php echo $ques_view ->ques_description; ?></textarea>
      <input type="hidden" name="user_id" value="<?php echo $ques_view->userid;?>"/>
      <input type="hidden" name="ques_id" value="<?php echo $ques_view->questionid;?>"/>
      <p style="margin-top:5px;">
       <button type="submit" class="btn btn-primary">Submit</button>
       <button type="submit" onclick="$('#editpost').hide()" class="btn">Cancel</button>
       </p>
       
      </form> 
         
   </div>  

 <?php if(!$this->session->userdata('is_logged_in')){ ?> 
<div id="add_answer" style="display:none;margin:10px;padding: 10px;width: 50%;">
  <h1 style="border-bottom: 1px solid #DDDDDD;color: #444444;font-family: Arial,Helvetica,sans-serif;font-size: 16px;font-weight: 700;line-height: 1.1em;margin: 0.5em 0 25px;padding: 14px 25px 5px 0;position: relative;">
    Please <a href="<?php echo base_url();?>index.php/login">Login</a> or <a href="<?php echo base_url();?>index.php/register">Register</a> to answer this question.
  </h1>   
</div>    
   <?php }  else{ ?>    
<div id="add_answer" style="display:none;margin:10px;padding: 10px;width: 50%;">
   <form class="form-horizontal" enctype="multipart/form-data" method='post' action="<?php echo base_url();?>index.php/answers/addanswer">
    <label>Enter your Answer</label><span class="help-inline"><?php echo form_error('add_answer'); ?></span>
       <textarea rows="3" class="input-xxlarge" value="<?php echo set_value('add_answer'); ?>"  name="add_answer" placeholder="Enter Your Answer"></textarea>
    
     <p style="margin-top:5px;">
        <input type="hidden" name="question_id" value="<?php echo $ques_view ->questionid; ?>">   
       <button type="submit" class="btn btn-primary">Submit</button>       
       <button type="submit" onclick="$('#add_answer').hide()"class="btn">Cancel</button>
     </p>
    </form> 
    
</div>   
     <?php }?> 
    
<div id="ques_answer">
<!--Answers-->

 <span style="display: inline-block;font-size: 12px;vertical-align: middle;">
  <?php foreach($answer_view->result() as $row):  ?> 
   
    <div style="background-color:#F5F5F5;width:90%;padding:10px;font-size:13px;word-spacing:1px;margin-bottom:0.5em;  ">   
    <p style="text-align:justify;"><?php echo $row->answer; ?>
    <span>--by        
    
        <a href="<?php echo base_url();?>index.php/userinfo/index/<?php echo $row->userid; ?>">
           <?php echo $row->user_name; ?>
        </a>    

      &nbsp;&nbsp;<a href="javascript:void(0)" onclick="$('#ans_reply<?php echo $row->answerid; ?>').toggle()">
        Reply</a>
    </span> 
        </p>
   </div>
  
            <?php if(!$this->session->userdata('is_logged_in')){ ?> 
               <div id="ans_reply<?php echo $row->answerid; ?>" style="display:none">
                <h1 style="border-bottom: 1px solid #DDDDDD;color: #444444;font-family: Arial,Helvetica,sans-serif;font-size: 16px;font-weight: 700;line-height: 1.1em;margin: 0.5em 0 25px;padding: 14px 25px 5px 0;position: relative;">
                Please <a href="<?php echo base_url();?>index.php/login">Login</a> or <a href="<?php echo base_url();?>index.php/register">Register</a> to answer this question.
                </h1>   
               </div>    
            <?php }else { ?>     
     
     
          <div id="ans_reply<?php echo $row->answerid; ?>" style="display:none;">
           <form class="form-horizontal" enctype="multipart/form-data" method='post' action="<?php echo base_url();?>index.php/answers/addreply">
              <label>Enter your Reply</label><span class="help-inline"><?php echo form_error('add_reply'); ?></span>
              <textarea rows="3" class="input-xxlarge" value="<?php echo set_value('add_reply'); ?>"  name="add_reply" placeholder="Enter Your Answer"></textarea>
       
             <p style="margin-top:5px;">
              <input type="hidden" name="question_id" value="<?php echo $row->ques_id; ?>">    
              <input type="hidden" name="answer_id" value="<?php echo $row->answerid; ?>">   
              <button type="submit" class="btn btn-primary">Submit</button>
            <button type="submit" onclick="$('#ans_reply<?php echo $row->answerid; ?>').hide()" class="btn">Close</button>
             </p> 
          </form>              
         </div> 
    <?php } ?> 
     
     
     <?php  $query=  mysql_query("SELECT * FROM tbl_answers WHERE ans_parent_id = '$row->answerid'");
               
            if ($query):  while($child=  mysql_fetch_array($query)){?>
     
     
               <div style="background-color:#ECF3F3;margin-left:15px;width:80%;padding:5px 0px 0px 10px;font-size:12px;word-spacing:1px;margin-bottom:0.5em;  ">
                     <p style="text-align: justify">
                         
                         <?php echo $child['answer'];?>&nbsp;--&nbsp;
                     by&nbsp;
                            <?php foreach ($userdetail->result() as $uname){ 
                                 if($uname->id == $child['user_id']){?>
            
                           <a href="<?php echo base_url();?>index.php/userinfo/index/<?php echo$child['user_id']; ?>">
                                  <?php echo $uname->user_name; ?>
                           </a>
               </div>    
          <?php } } }?>  

    <?php endif;?>     

         
  <?php endforeach; ?> 
    
    
</span>


</div>    
<!--        <?php //foreach($testanswer->result() as $row):?>
  <?php //echo $row->answer; ?><br/> 
  <?php// echo $row->answerid; ?><br/>
<?php //echo $row->user_name; ?><br/>
<?php //echo $row->ques_id; ?><br/>

<?php //echo $row->ans_date; ?><br/>
  <?php //endforeach;?><br/><br/>   -->
    
</div>    
</div>
