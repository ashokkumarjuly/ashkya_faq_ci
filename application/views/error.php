<div class="navbar">
        
    <div class="navbar-inner">
   
    <ul class="nav">
    <li class="active"><a href="javascript:void(0)">Home</a></li> 
    <li><a href="<?php echo base_url();?>index.php/viewall">View All Questions</a></li>
     <?php if($this->session->userdata('is_logged_in')){ ?>  
    <li><a href="<?php echo base_url();?>index.php/userinfo/index/<?php echo $objSession->userdata('userid'); ?>">My Account</a></li>  
    <?php }?> 
    </ul>        
      <?php if($this->session->userdata('is_logged_in')){ ?>    
     <p class="navbar-text pull-right">Logged in as 
         <a href="<?php echo base_url();?>index.php/userinfo/index/<?php echo $objSession->userdata('userid'); ?>">
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
          <?php foreach ($catlist->result() as $row){?> 
          <li><a href="<?php echo base_url();?>index.php/category/index/<?php echo $row->cat_id; ?>"><?php echo $row->cat_name; ?></a></li>
          <?php } ?>         
        </ul>
      </div><!--/.well -->
</div>



    <div id="main" style="margin: 0px auto; width:70%; min-height:380px;">
        
<div id="container" class="container" style="width:100%">
    
           
     <div class="alert alert-error" style="margin:5em">
         <h4>Access Forbidden!</h4>
       You Dont Have Acceess To View This Page
         
     </div>   
      
   

</div>    

</div>