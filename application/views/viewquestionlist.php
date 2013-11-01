<div class="navbar">
        
    <div class="navbar-inner">
   
    <ul class="nav">
    <li ><a href="<?php echo base_url();?>">Home</a></li> 
    <li class="active"><a href="javascript:void(0)">View All Questions</a></li>
    <?php if($this->session->userdata('is_logged_in')){ ?>  
    <li><a href="<?php echo base_url();?>index.php/home/addquestion">Post Question</a></li>
    <li><a href="<?php echo base_url();?>index.php/userinfo/index/<?php echo $objSession->userdata('userid'); ?>">My Account</a></li>  
    <?php }?> 
    </ul>        
      <?php if($this->session->userdata('is_logged_in')){ ?>    
     <p class="navbar-text pull-right">Logged in as   <a href="<?php echo base_url();?>index.php/userinfo/index/<?php echo $objSession->userdata('userid'); ?>">
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
   
 <div id="">  <span> <?php //echo $msg; ?></span> 

<div id="total-top" style="margin-bottom:1em;"> 
     <div> 
  <h4>Questions Posted</h4>
             
   </div> 
   
 </div>
     
     <?php //echo $_SERVER['HTTP_REFERER'];  ?>
      <?php if($all_queslist): ?>
       <div style="float:right;margin-bottom:1em;">
         <span>Total Questions:&nbsp;<?php  echo $totalquestion; ?></span>
     
     </div>
     
    <table class="table table-striped">
    <thead>
<tr>
<th  style="width:5%">#id</th> 
<th  style="width:10%">Category</th>  
<th style="width:10%">User</th>
<th style="width:30%">Questions</th>
<th style="width:10%">Date Posted</th>
<th style="width:5%">Views</th>
<th style="width:10%">Total Answers</th>
</tr>
</thead>
<tbody>
<?php //p foreach ($all_queslist->result() as $row){?> 
    <?php foreach ($all_queslist as $row){?> 
    
          <!--<li><a href="javascript:void(0)"><?php echo $row->cat_name; ?></a></li>-->
<tr>
    <td><?php echo $row->id; ?></td>
    <?php foreach ($catlist->result() as $catn){ 
    if($catn->cat_id == $row->cat_id){?>
    <td><a href="<?php echo base_url();?>index.php/category/index/<?php echo $row->cat_id; ?>">
        <?php echo $catn->cat_name; ?>
         </a>
    </td>
    <?php } }?>
    
     <?php foreach ($userdetail->result() as $uname){ 
    if($uname->id == $row->user_id){?>
    <td>
        <a href="<?php echo base_url();?>index.php/userinfo/index/<?php echo $row->user_id; ?>">
            <?php echo $uname->user_name; ?>
        </a>
    </td>
    <?php } }?>
    
    
    
    
<!--   <td><a href="<?php echo base_url();?>index.php/category/index/<?php echo $row->cat_id; ?>"><?php echo $row->cat_id; ?></a></td>-->
<!--   <td><a href="<?php echo base_url();?>index.php/userinfo/index/<?php echo $row->user_id; ?>"><?php echo $row->user_id; ?></a></td>-->
   <td><a onclick="getview(<?php echo $row->id; ?>)" href="<?php echo base_url();?>index.php/answers/index/<?php echo $row->id; ?>"><?php echo $row->ques_title; ?></a></td>
   <td><?php echo $row->ques_date; ?></td>
    <td><?php echo $row->ques_views; ?></td>
   <td style="text-align: center;"><?php echo $row->num_answers; ?></td>    
 
</tr> 
          <?php } ?> 

</tbody>
    </table>
     
<!--<div class="pagination">-->
    
<!--</div>-->
<?php echo $links; ?>
  <?php else: ?> 



    <b> No Query Found</b>
    
   <?php endif;?>
 </div>

</div>    
</div>
