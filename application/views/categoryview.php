<div class="navbar">
        
    <div class="navbar-inner">
   
    <ul class="nav">
    <li><a href="<?php echo base_url();?>">Home</a></li>
    <li><a href="<?php echo base_url();?>index.php/viewall">View All Questions</a></li>
    <?php if($this->session->userdata('is_logged_in')){ ?>  
    <li><a href="<?php echo base_url();?>index.php/home/addquestion">Post Question</a></li>  
    <?php }?>  
    <li class="active"><a href="javascript:void(0)">Category View</a></li> 
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
     <span style="font-size:15px;letter-spacing: 2px;">Category </span><br/> 
      <span id="catlogo"><img src="<?php echo base_url().$catdetail->cat_image; ?>" /></span>       
   </div> 


   <div style="float:right">
         <span>Total Questions:&nbsp;<?php  echo $total; ?></span>
     
     </div>  
     
     
 </div>
 <div id="category-view">        
     <?php if($cat_queslist): ?>
     
<!--    <b> No Query FOund</b>-->
    
   <?php //else: ?>
    
    
    
    
    <table class="table table-bordered">
    <thead>
<tr>   
<th style="width:10%">User</th>
<th style="width:50%">Questions</th>
<th style="width:20%">Date Posted</th>
<th style="width:10%">Views</th>
<th style="width:10%">Answers</th>
</tr>
</thead>
<tbody>  
    
<?php //  foreach ($cat_queslist->result() as $row):?> 
    <?php   foreach ($cat_queslist as $row):?> 
          <!--<li><a href="javascript:void(0)"><?php echo $row->cat_name; ?></a></li>-->
<tr>
   <!--<td><a href="<?php echo base_url();?>index.php/category/index/<?php echo $row->id; ?>"><?php echo $row->cat_id; ?></a></td>-->
    
     
    <td>
        <a href="<?php echo base_url();?>index.php/userinfo/index/<?php echo $row->userid; ?>">
            <?php echo $row->user_name; ?>
        </a>
    </td>
      

<!--   <td><a href="<?php echo base_url();?>index.php/userinfo/index/<?php echo $row->user_id; ?>"><?php echo $row->user_id; ?></a></td>-->
   <td><a onclick="getview(<?php echo $row->quesid; ?>)" href="<?php echo base_url();?>index.php/answers/index/<?php echo $row->quesid; ?>"><?php echo $row->ques_title; ?></a></td>
   <td><?php echo $row->ques_date; ?></td>   
   <td><?php echo $row->ques_views; ?></td>  
  <td><?php echo $row->num_answers; ?></td>
 
</tr> 
          <?php endforeach;?> 

</tbody>
    </table>
    <?php echo $links; ?>
   <?php else:?> 



    <b style="letter-spacing: 1px;word-spacing:1px;color:#5E636B"> No Questions Posted in This Category</b>
    
   <?php endif;?>
</div>

</div>    
</div>
<style>
    #catlogo img{
        margin-top:1em;
        height: 70px;
        width: 90px;
    }
</style>    