<div class="navbar">
        
    <div class="navbar-inner">
   
    <ul class="nav">
    <li><a href="<?php echo base_url();?>index.php/">Home</a></li>
    <li><a href="<?php echo base_url();?>index.php/viewall">View All Questions</a></li>
    <li class="active"><a href="javascript:void(0)">Register</a></li>
    </ul>
    
    </div>
</div>
<div class="container">
	
  <div class="row">
	
	
  <div class="span8">
	<?php if(!is_null($msg)):?>
	<div class="alert alert-success">
        <?php echo $msg;?> 	  <!--Well done! You successfully read this important alert message.-->
	</div>
	<?php endif;?> 
<?php //echo validation_errors(); ?>

	<form class="form-horizontal" id="registerHere" method='post' action="<?php echo base_url();?>index.php/register/newuser">
	  <fieldset>
	    <legend>Registration</legend>
	    <div class="control-group">
	      <label class="control-label" for="input01">Name</label>
	      <div class="controls">
                  
	        <input type="text" value="<?php echo set_value('user_name'); ?>" class="input-xlarge" id="user_name" name="user_name" rel="popover" data-content="Enter your first and last name." data-original-title="Full Name">
	        <span class="help-inline" style="color:red;"><?php echo form_error('user_name'); ?></span>
	      </div>
	</div>
	
	 <div class="control-group">
		<label class="control-label" for="input01">Email</label>
	      <div class="controls">
                  
	        <input type="text" class="input-xlarge" value="<?php echo set_value('user_email'); ?>" id="user_email" name="user_email" rel="popover" data-content="What’s your email address?" data-original-title="Email">
	       <span class="help-inline" style="color:red;"><?php echo form_error('user_email'); ?></span>
	      </div>
	</div>
	
	<div class="control-group">
		<label class="control-label" for="input01">Password</label>
	      <div class="controls">                 
	        <input type="password" value="<?php echo set_value('pwd'); ?>" class="input-xlarge" id="pwd" name="pwd" rel="popover" data-content="6 characters or more! Be tricky" data-original-title="Password" >
	       <span class="help-inline" style="color:red;"><?php echo form_error('pwd'); ?></span>
	      </div>
	</div>
	<div class="control-group">
		<label class="control-label" for="input01">Confirm Password</label>
	      <div class="controls">                  
	        <input type="password" value="<?php echo set_value('cpwd'); ?>" class="input-xlarge" id="cpwd" name="cpwd" rel="popover" data-content="Re-enter your password for confirmation." data-original-title="Re-Password" >
	       <span class="help-inline" style="color:red;"><?php echo form_error('cpwd'); ?></span>
	      </div>
	</div>
	
	
	 <div class="control-group">
		<label class="control-label" for="input01">Gender</label>
	      <div class="controls">                 
	        <select name="gender" id="gender" >
            				<option value="gender" <?php echo set_select('myselect', 'gender', TRUE); ?>>Gender</option>
			                <option value="male" <?php echo set_select('myselect', 'male'); ?>>Male</option>
			                <option value="female" <?php echo set_select('myselect', 'female'); ?>>Female</option>
			<option value="other" <?php echo set_select('myselect', 'other'); ?>>Other</option>
			               
			              </select>
	       <span class="help-inline" style="color:red;"><?php echo form_error('gender'); ?></span>
	      </div>
	
	</div>
	
	
	<div class="control-group">
		<label class="control-label" for="input01"></label>
	      <div class="controls">
	       <button type="submit" class="btn btn-success" rel="tooltip" title="first tooltip">Create My Account</button>
	       
	      </div>
	
	</div>
	
	
	   
	  </fieldset>
	</form>
	</div>
	
		</div>
        
        
          </div><!--/row-->

          
          
<!--  <script src="http://twitter.github.com/bootstrap/assets/js/jquery.js"></script>
    <script src="http://twitter.github.com/bootstrap/assets/js/bootstrap-transition.js"></script>
    <script src="http://twitter.github.com/bootstrap/assets/js/bootstrap-alert.js"></script>
    <script src="http://twitter.github.com/bootstrap/assets/js/bootstrap-modal.js"></script>
    <script src="http://twitter.github.com/bootstrap/assets/js/bootstrap-dropdown.js"></script>
    <script src="http://twitter.github.com/bootstrap/assets/js/bootstrap-scrollspy.js"></script>
    <script src="http://twitter.github.com/bootstrap/assets/js/bootstrap-tab.js"></script>
    <script src="http://twitter.github.com/bootstrap/assets/js/bootstrap-tooltip.js"></script>
    <script src="http://twitter.github.com/bootstrap/assets/js/bootstrap-popover.js"></script>
	<script type="text/javascript" src="http://jzaefferer.github.com/jquery-validation/jquery.validate.js"></script>
	  <script type="text/javascript">
	  $(document).ready(function(){
			$('input').hover(function()
			{
			$(this).popover('show')
		});
			$("#registerHere").validate({
				rules:{
					user_name:"required",
					user_email:{
							required:true,
							email: true
						},
					pwd:{
						required:true,
						minlength: 6
					},
					cpwd:{
						required:true,
						equalTo: "#pwd"
					},
					gender:"required"
				},
				messages:{
					user_name:"Enter your first and last name",
					user_email:{
						required:"Enter your email address",
						email:"Enter valid email address"
					},
					pwd:{
						required:"Enter your password",
						minlength:"Password must be minimum 6 characters"
					},
					cpwd:{
						required:"Enter confirm password",
						equalTo:"Password and Confirm Password must match"
					},
					gender:"Select Gender"
				},
				errorClass: "help-inline",
				errorElement: "span",
				highlight:function(element, errorClass, validClass) {
					$(element).parents('.control-group').addClass('error');
				},
				unhighlight: function(element, errorClass, validClass) {
					$(element).parents('.control-group').removeClass('error');
					$(element).parents('.control-group').addClass('success');
				}
			});
		});
	  </script> -->