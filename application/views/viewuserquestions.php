<div class="navbar">
        
    <div class="navbar-inner">
   
    <ul class="nav">
    <li><a href="<?php echo base_url();?>">Home</a></li>
    <li><a href="<?php echo base_url();?>index.php/viewall">View All Questions</a></li>
    <?php if($this->session->userdata('is_logged_in')){ ?>  
    <li><a href="<?php echo base_url();?>index.php/home/addquestion">Post Question</a></li> 
    <li><a href="<?php echo base_url();?>index.php/userinfo/index/<?php echo $objSession->userdata('userid'); ?>">
            My Account
        </a>
    </li>
    <?php }?>  
    <li class="active"><a href="javascript:void(0)">User Questions</a></li> 
    </ul>        
      <?php if($this->session->userdata('is_logged_in')){ ?>    
     <p class="navbar-text pull-right">Logged in as <a href="javascript:void(0)"><?php echo $objSession->userdata('username'); ?></a>
     <?php if($this->session->userdata('userlevel') == '5'){?>
          <a href="http://localhost/faq_ci/index.php/admin/dashboard" title="Dashboard">
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
  
 <div id="category-top" style="margin-bottom:2em;"> 
     <div> 
    Question Posted By :<?php echo $userdetail ->user_name; ?>
             
   </div> 
     <div style="float:right">
     <span>Total Questions:<?php echo $totalquestion; ?></span>
     
     </div>
 </div>
 <div id="userquestion-view">        

    
    
    
    
    <table class="table table-bordered">
    <thead>
<tr>   
<th style="width:10%">Category</th>
<th style="width:30%">Questions</th>
<th style="width:20%">Date Posted</th>
<th style="width:10%">Views</th>
<th style="width:10%">Total Answers</th>
</tr>
</thead>
<tbody>  
  <tbody>
    <?php if($userques_list): ?>
     
  
      
      
<?php //foreach ($userques_list->result() as $row):?> 
<?php foreach ($userques_list as $row):?> 

 <tr> 
   
    <td><a href="<?php echo base_url();?>index.php/category/index/<?php echo $row->cat_id; ?>">
        <?php echo $row->cat_name; ?>
         </a>
    </td>
    
   <td><a onclick="getview(<?php echo $row->id; ?>)"  href="<?php echo base_url();?>index.php/answers/index/<?php echo $row->id; ?>"><?php echo $row->ques_title; ?></a></td>
   
   <td><?php echo $row->ques_date; ?></td> 
   <td style="text-align:center;"><?php echo $row->ques_views; ?></td>
   <td style="text-align:center;"><?php echo $row->num_answers; ?></td> 



    <?php endforeach; ?> 

 </tr>   
</tbody>  

    </table>
     <?php echo $links; ?>
     <?php else:?>
        <b> No Query FOund</b>
    
   <?php endif; ?> 
</div>

</div>    
</div>
 