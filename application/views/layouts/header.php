    <!DOCTYPE html>
<html>
<head>
<title>Bootstrap 101 Template</title>
<!-- Bootstrap -->
<!--<link href="http://localhost/faq_ci/assets/bootstrap/css/bootstrap.css" rel="stylesheet" media="screen">-->
<link href="<?php echo base_url();?>assets/bootstrap/css/bootstrap.css" rel="stylesheet" media="screen">
<script src="<?php echo base_url();?>assets/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo base_url();?>assets/bootstrap/js/bootstrap.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.0/jquery.min.js"></script>	
<script src="<?php echo base_url();?>assets/Js/common.js"></script>
</head>

<body>
   <div id="top" style="background: none repeat scroll 0 0 whitesmoke;">	
		
<div id="" style="margin: 0px auto; width:70%">		<!-- Header -->
  <div id="header" style="height: 61px;">
      <div id="logo" style="float: left;"><h1><a href="<?php echo base_url();?>">Q & A</a> </h1>
      </div>  
     
      <div style="float:right">
           <?php if($this->session->userdata('is_logged_in')){
                echo anchor('login/do_logout', 'Logout'); }else { ?> 
          <a href="<?php echo base_url();?>index.php/login">Login</a>
          <span>|</span>
          <a href="<?php echo base_url();?>index.php/register">Register</a>
          <?php } ?>
      </div>    
              
    </div>
<!--        <div id="top-search" style="display: inline;float: right;margin-top: 20px;">   
              <form class="navbar-form pull-left">
                 <input type="text" class="span2">
                 <button type="submit" class="btn">Submit</button>
               </form>
         </div>      -->
		<!-- End Header -->
	
    
    
    
    
    