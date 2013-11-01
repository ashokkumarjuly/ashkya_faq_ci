<div class="navbar">
        
    <div class="navbar-inner">
   
    <ul class="nav">
    <li class="active"><a href="javascript:void(0)">Home</a></li>
    <li><a href="<?php echo base_url();?>index.php/admin/category">Category</a></li>
    <li><a href="<?php echo base_url();?>index.php/admin/questions_manage">Pending Questions</a></li>
    <li><a href="<?php echo base_url();?>index.php/admin/users_manage">Users</a></li>
    </ul>        
      <?php if($this->session->userdata('is_logged_in')): ?>    
     <p class="navbar-text pull-right">Logged in as <a href="javascript:void(0)"><?php echo $objSession->userdata('username'); ?></a></p>
     <?php endif; ?> 
    </div>   
        
    </div>
<!--</div>
</div>-->
<div id="main" style="margin: 0px auto; min-height:380px;">
    <div class="container-fluid">
    <h3>Welcome to Dashboard</h3>
    
    <!--Body content-->
    <table class="table table-bordered" style="width:40%">
       <tr>
          <td>Total Users:</td>
          <td><?php echo $usercount; ?>&nbsp;&nbsp;
              <span style="letter-spacing:1px;float:right">
                  <a  href="<?php echo base_url();?>index.php/admin/users_manage">View</a>
              </span>
          </td>
       </tr>
       <tr>
           <td>Pending Questions:</td>
          <td><?php echo $pending_quetions; ?>&nbsp;&nbsp;
              <span style="letter-spacing:1px;float:right">
                  <a href="<?php echo base_url();?>index.php/admin/questions_manage" >View</a>
              </span>
          </td>
       </tr>
       <tr>
           <td>Total Question Posted:</td>
          <td><?php echo $questioncount; ?></td>
       </tr>
       <tr>
           <td>Todays Question Posted:</td>
          <td><?php echo $queslist_today; ?></td>
       </tr>
       <tr>
           <td>Todays Answered Posted:</td>
          <td><?php echo $answerlist_today; ?></td>
       </tr>
       
    </table>    
  
<!--    Todays Question:5<br/>
    Today Answered:2-->
    
  
   
    </div>    
</div>