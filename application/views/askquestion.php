<div class="navbar">
        
    <div class="navbar-inner">
   
    <ul class="nav">
    <li ><a href="<?php echo base_url();?>">Home</a></li>
    <li><a href="<?php echo base_url();?>index.php/viewall">View All Questions</a></li> 
    <li class="active"><a href="javascript:void(0)">Post Question</a></li>
    
     <?php if($this->session->userdata('is_logged_in')){ ?>     
    <li><a href="<?php echo base_url();?>index.php/userinfo/index/<?php echo $objSession->userdata('userid'); ?>">My Account</a></li>  
    <?php }?> 
    </ul>        
      <?php if($this->session->userdata('is_logged_in')){ ?>    
     <p class="navbar-text pull-right">Logged in as <a href="<?php echo base_url();?>index.php/userinfo/index/<?php echo $objSession->userdata('userid'); ?>">
         <?php echo $objSession->userdata('username'); ?></a>
     <?php if($this->session->userdata('userlevel') == '5'){?>
          <a href="<?php echo base_url();?>index.php/admin/dashboard" title="Dashboard">
              <i class="icon-user"></i>
          </a>
                
     </p>
     <?php } }?> 
    </div>   
        
    </div>	

		
	</div>
</div>
<div id="" style="float: left;width: 14%;">

<div class="well sidebar-nav-fixed">
        <ul class="nav nav-list">
       
          <li class="nav-header">Category</li>
          <?php foreach ($query->result() as $row){?> 
         <li><a href="<?php echo base_url();?>index.php/category/index/<?php echo $row->cat_id; ?>"><?php echo $row->cat_name; ?></a></li>
          <?php } ?>         
        </ul>
      </div><!--/.well -->
</div>



    <div id="main" style="margin: 0px auto; width:70%; min-height:380px;">
        
<div id="container" class="container" style="width:100%">
 <?php if(!$this->session->userdata('is_logged_in')): ?> 
   <div id="loggedin_post" style="width:500px;">
       <h1 style="border-bottom: 1px solid #DDDDDD;
    
    color: #444444;
    font-family: Arial,Helvetica,sans-serif;
    font-size: 16px;
    font-weight: 700;
    line-height: 1.1em;
    margin: 2em 0 0 4em;
    padding: 25px 0 25px 50px;
    position: relative;">
       Please <a href="<?php echo base_url();?>index.php/login">Login</a> or <a href="<?php echo base_url();?>index.php/register">Register</a> to Post Your Question.
       </h1>   
   </div>    
<?php else:?>    
    
    
    
<div id="total-top" style="margin-bottom:2em;margin-top: 2em;margin-left: 1.5em;"> 
     <div> 
  <h4>Post Your Question</h4>
             
   </div> 
     <div style="float:right">
         <span><?php echo $msg; ?></span>
     
     </div>
 </div>

 <div id=form_quespost" style="margin:30px;"> 
     

   <div style="margin:10px 0px 0px 50px;"> 
       
       <form class="form-horizontal" enctype="multipart/form-data" method='post' action="<?php echo base_url();?>index.php/home/postquestion">
       <div style="margin-bottom:1em">
       <label>TITLE:</label>
       <span style="color:red;"><?php echo form_error('ques_title'); ?></span>        
       <input class="input-xxlarge" value="<?php echo set_value('ques_title'); ?>" type="text" name="ques_title" placeholder="Enter Title to Your Question">
       </div>
       <div style="margin-bottom:1em">    
       <label>DESCRIPTION:</label>
       <span style="color:red;"><?php echo form_error('ques_description'); ?></span>
       <textarea rows="3" class="input-xxlarge" value="<?php echo set_value('ques_description'); ?>"  name="ques_description" placeholder="Enter Description"></textarea>
       </div>
       <div style="margin-bottom:1em">
       <label>CATEGORY:</label>
       <span style="color:red;"><?php echo form_error('ques_category'); ?></span>
       <select multiple="multiple" name="ques_category">
           <?php foreach ($query->result() as $row){?> 
<option value="<?php echo $row->cat_id; ?>"><?php echo $row->cat_name; ?></option>
<?php } ?>
</select>
       </div>
       <p style="margin-left:70px; ">
       <button type="submit" class="btn btn-primary">Submit</button>
       </p>
      </form> 
       
       
       
       
   </div>    
</div>
    
  <?php endif; ?>      
    
    
</div>    
</div>
