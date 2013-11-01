<div class="navbar">
        
    <div class="navbar-inner">
   
    <ul class="nav">
    <li><a href="<?php echo base_url();?>index.php/">Home</a></li>
    <li><a href="<?php echo base_url();?>index.php/viewall">View All Questions</a></li>   
    <li class="active"><a href="javascript:void(0)">Login</a></li>
    </ul>
    
    </div>
</div>
<?php //echo current_url();  ?><br/>
<?php  //echo base_url();?>



<div id="main" style="margin: 0px auto; width:70%; min-height:380px;">
<?php if($this->session->flashdata('chngpass_msg') || $this->session->flashdata('register_msg')) { ?>     
  <div id="flashmsg-top" class="alert alert-success" style="margin-bottom:-2em;"> 
    <div><span style="font-size:15px;letter-spacing: 2px;color:#003300">
       <?php echo $this->session->flashdata('chngpass_msg');  ?>
       <?php echo $this->session->flashdata('register_msg');  ?>      
        </span>     
   </div>      
 </div>  
    
<?php } ?> 
  
    
<div id="container"class="container" style="width:100%;">
    
    <?php if($this->session->flashdata('errmsg1') || $this->session->flashdata('errmsg2')) { ?> 
                <div class="alert alert-error" style="margin-bottom:-2em;margin-left: 0em;width:92%;">
<!--                <button class="close" data-dismiss="alert" type="button">×</button> -->
               <?php echo $this->session->flashdata('errmsg1'); ?>
               <?php echo $this->session->flashdata('errmsg2'); ?>     
                </div>
    <?php } ?>
   
     <?php if($this->session->flashdata('success_message'))  {?>
                <div class="alert alert-success span7" style="margin-bottom:1em;margin-left: 0em;width:92%;">
<!--                  <a class="close" data-dismiss="alert" href="#">×</a>-->
                  <?php echo $this->session->flashdata('success_message'); ?>
                </div> <?php } ?>
                <?php if($this->session->flashdata('error_message')) { ?> 
                <div class="alert alert-error span7" style="margin-bottom:1em;margin-left: 0em;width:92%;">
<!--                    <a class="close" data-dismiss="alert" href="#">×</a>  -->
                <?php echo $this->session->flashdata('error_message'); ?>
                </div><?php } ?> 
    
    
    <div id="" style="margin-top:45px;background-color: white;padding:10% 0 7% 10%;">
        <?php if(! is_null($msg)) echo $msg;?> 
      
    <form class="form-horizontal" action="<?php echo base_url();?>index.php/login/checklogin" method="post" name="process">
    <div class="control-group">
    <label class="control-label" for="inputEmail">User Name</label>
    <div class="controls">
    <input type="text" id="inputEmail" value="<?php echo set_value('usr_name'); ?>" name="usr_name" placeholder="User Name">
    <span class="help-inline" style="color:red;"><?php echo form_error('usr_name'); ?></span>
    </div>
    </div>
    <div class="control-group">
    <label class="control-label" for="inputPassword">Password</label>
    <div class="controls">
    <input type="password" id="inputPassword" value="<?php echo set_value('pwd'); ?>" name="pwd" placeholder="Password">
    <span class="help-inline" style="color:red;"><?php echo form_error('pwd'); ?></span>
    </div>
    </div>
    <div class="control-group">
    <div class="controls">
    <label class="checkbox">
    <input type="checkbox"> Remember me
    </label>
        <?php if(isset($_SERVER['HTTP_REFERER'])) : ?>
      
        
        <input type="hidden" value="<?php echo $_SERVER['HTTP_REFERER'];  ?>" name="referingpage"> 
   
        
     <?php endif; ?>
    <button type="submit" class="btn">Sign in</button>
    </div>
    </div>
    </form>
    </div>    
</div>    
</div>