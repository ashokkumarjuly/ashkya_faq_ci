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
    <?php //if($this->session->userdata('is_logged_in')){ ?> 
     <div id="" style="padding:2%; text-align: center;">         
         <a href="<?php echo base_url();?>index.php/home/addquestion">
         <i class="icon-question-sign"></i>
         Ask a Question
         </a>
         
     </div>    
    <?php //} ?>
<div id="recent-questions" style="margin-bottom:2em;"> 
    
<span> <?php echo $msg; ?></span> 

   <div id="recent-questionstop" style="margin-bottom:1em;"> 
     <div>   
     <span style="font-size:18px;letter-spacing: 2px;">Recently Posted Questions</span><br/>            
   </div> 
 </div> 

 <table class="table table-bordered">
    <thead>
<tr>
<th>Category</th>
<th style="width:60%">Questions</th>
<th>Answers</th>
<th>Views</th>
<th>Posted By</th>
<th style="width:10%">Date Posted</th>
</tr>
</thead>

<tbody>
<?php foreach ($recent_queslist as $row){
//     foreach($recentq as $row){
    
    
    ?> 
          <!--<li><a href="javascript:void(0)"><?php echo $row->cat_name; ?></a></li>-->
<tr>
   <td><a href="<?php echo base_url();?>index.php/category/index/<?php echo $row->cat_id; ?>">
       <?php echo $row->cat_name; ?>
       </a>
   </td>
   <td><a onclick="getview(<?php echo $row->id; ?>)"  href="<?php echo base_url();?>index.php/answers/index/<?php echo $row->id; ?>"><?php echo $row->ques_title; ?></a></td>
    <td><?php echo $row->num_answers; ?></td>
   <td style="text-align:center;"><?php echo $row->ques_views; ?></td>
    <td style="text-align:center;">
         <a href="<?php echo base_url();?>index.php/userinfo/index/<?php echo $row->userid; ?>">
            <?php echo $row->username; ?>
        </a>
    </td>
   <td><?php echo $row->ques_date; ?></td>
</tr> 
          <?php } ?> 
</tbody>
    </table>
</div>
    
<div id="recent-answers"> 

<div id="recent-answerstop" style="margin-bottom:1em;"> 
     <div>   
     <span style="font-size:18px;letter-spacing: 2px;">Recently Answered Questions</span><br/>            
   </div> 
 </div>
    
    
<table class="table table-bordered">
    <thead>
<tr>
<th>Category</th>
<th style="width:70%">Questions</th>
<th>Answers</th>
<th>Views</th>
<th>Posted By</th>
<th style="width:10%">Date Posted</th>
</tr>
</thead>
<tbody>
<?php //echo $anslist; 
if(!empty($recent_anslist)){
foreach ($recent_anslist as $row): ?> 
    
<tr>
   <td><a href="<?php echo base_url();?>index.php/category/index/<?php echo $row->cat_id; ?>">
       <?php echo $row->cat_name; ?>
       </a>
   </td>
   <td><a onclick="getview(<?php echo $row->id; ?>)" href="<?php echo base_url();?>index.php/answers/index/<?php echo $row->id; ?>">
       <?php echo $row->ques_title; ?>
       </a>
   </td>       
   <td>
       <?php echo $row->sum_answers; ?>
   </td>
      
   <td style="text-align:center;">
      <?php echo $row->ques_views; ?>
   </td>
   <td style="text-align:center;">
       <a href="<?php echo base_url();?>index.php/userinfo/index/<?php echo $row->userid; ?>">
            <?php echo $row->username; ?>
        </a>
   </td>
   <td>
     <?php echo $row->ques_date; ?>
   </td>
</tr> 
          <?php endforeach; } ?> 


<!--      <?php foreach($anslist as $row):?>
  <?php echo $row->cat_name; ?><br/> 
  <?php //echo $row->id; ?><br/>
<?php echo $row->ques_title; ?><br/>

<?php echo $row->ques_views; ?><br/>
<?php echo $row->ques_date; ?><br/>
  <?php endforeach;?><br/><br/> -->






    

    
</tbody>
    </table>

</div>
</div>    

</div>