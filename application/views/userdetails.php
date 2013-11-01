<div class="navbar">
        
    <div class="navbar-inner">
   
    <ul class="nav">
    <li><a href="<?php echo base_url();?>">Home</a></li> 
    <li><a href="<?php echo base_url();?>index.php/viewall">View All Questions</a></li>
    <?php if($this->session->userdata('is_logged_in')){ ?>  
    <li><a href="<?php echo base_url();?>index.php/home/addquestion">Post Question</a></li>  
    <?php }?> 
    <li class="active"><a href="javascript:void(0)">User Info</a></li> 
    </ul>        
      <?php if($this->session->userdata('is_logged_in')){ ?>    
     <p class="navbar-text pull-right">Logged in as <a href="javascript:void(0)">
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
  

 <div style="margin-bottom:1.5em;">
   <span style="float: left;width:30%;" >  
      <h1 style="color:orange;font: 1em normal Arial, Helvetica, sans-serif;">USER-DETAILS</h1>
   </span>   
  
</div><br/>
<div id="user-detailform">

      <div style="margin: 15px; float: left;width:50%">       
      
      <table>         
          
              <thead>
                          <tr>
                              <th></th>
                              <th></th>

                          </tr>                
              </thead>
              <tbody>
                          <tr>
                                    <th style="text-align: left;padding:5px;">
                                    <strong>User Name</strong>
                                    </th>
                                    <td style="padding:5px;"><span><?php echo $userdetail ->user_name; ?></span></td>
                           </tr>
                           <tr>
                                    <th style="text-align: left;padding:5px;">
                                    <strong>User Email</strong>
                                    </th>
                                    <td style="padding:5px;"><span><?php echo $userdetail ->user_email; ?></span></td>
                           </tr>
                           <tr>
                                     <th style="text-align: left;padding:5px;">Gender </th>
                                     <td style="padding:5px;"><span><?php echo $userdetail ->user_gender; ?></span></td>
                           </tr>
                           <tr>
                                    <th style="text-align:left;padding:5px;"><strong>Total Question Posted</strong></th>
                                    <td style="padding:5px;text-align:left;"><span><?php echo $totalquestion; ?></span>
                                        <?php if(!$totalquestion=='0'){ ?>
                                        
                                        <a href="<?php echo base_url();?>index.php/userquestions/index/<?php echo $userdetail->id; ?>" title="View Question Posted by User">
                                            <span style="padding-left:10px;">view</span>
                                        </a>
                                       <?php  } ?>        
                                    </td>
                           </tr>
                            <tr>
                                    <th style="text-align: left;padding:5px;"><strong>Total Question Answered</strong></th>
                                    <td style="padding:5px;text-align:left;"><span><?php echo $totalanswered; ?></span>
                                        <?php if(!$totalanswered=='0'){ ?>
                                        <a href="<?php echo base_url();?>index.php/useranswers/index/<?php echo $userdetail->id; ?>" title="View Answers Posted by User">
                                        <span style="padding-left:10px;">view</span>
                                        </a>
                                        
                                          <?php  } ?>  
                                        </span></td>
                           </tr>
        
                </tbody>             
              
               
        </table>    
	
      
</div>
   <?php if($this->session->userdata('is_logged_in')){ ?>  
 <?php if($objSession->userdata('userid')==$userdetail ->id):?>     
    
 <div id="edit-userinfo" style="float: left;width:30%;background-color: gainsboro;padding:10px 0px 0px 30px;">
  <h1 style="color:orange;font:1em normal Arial, Helvetica, sans-serif;font-size:18px;margin-left:15px;">Change Password</h1>
     
     <form method='post' action="<?php echo base_url();?>index.php/userinfo/changepass">
    <fieldset>   
    <label>Current Password</label>
    <span class="help-block"style="color:red;">
        <?php echo form_error('current_password'); ?>
        <?php echo $this->session->flashdata('currentpass_msg');  ?> 
    
    </span>
    <input type="password" id="inputPassword"  name="current_password" value="<?php echo set_value('current_password'); ?>">
    
    <label>New Password</label>
     <span class="help-block"style="color:red;">
         <?php echo form_error('pass1'); ?>
         <?php echo $this->session->flashdata('pass1_msg');  ?> 
     
     </span>
    <input type="password" id="inputPassword" name="pass1" value="<?php echo set_value('pass1'); ?>">
    
     <label>Retype New Password</label>
    <span class="help-block"style="color:red;">
        <?php echo form_error('pass2'); ?>
        <?php echo $this->session->flashdata('pass2_msg');  ?> 
    </span>
    <input type="password" id="inputPassword" name="pass2" value="<?php echo set_value('pass2'); ?>">
     <input type="hidden"  name="user_id" value="<?php echo $objSession->userdata('userid');?>">
    <button type="submit" class="btn">Submit</button>
    </fieldset>
    </form>
 </div>    
  <?php endif; } ?>
</div>
 
</div>    
</div>
