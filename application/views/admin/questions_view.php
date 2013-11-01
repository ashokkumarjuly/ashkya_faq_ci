<div class="navbar">
        
    <div class="navbar-inner">
   
    <ul class="nav">
    <li><a href="<?php echo base_url();?>index.php/login/do_admin">Dashboard</a></li>
    <li><a href="<?php echo base_url();?>index.php/admin/category">Category</a></li>
    <li  class="active"><a href="javascript:void(0)">Pending Questions</a></li>
    <li><a href="<?php echo base_url();?>index.php/admin/users_manage">Users</a></li>
    </ul>        
      <?php if($this->session->userdata('is_logged_in')): ?>    
     <p class="navbar-text pull-right">Logged in as <a href="javascript:void(0)"><?php echo $objSession->userdata('username'); ?></a></p>
     <?php endif; ?> 
    </div>   
        
    </div>
<div id="main" style="margin: 0px auto; min-height:380px;">
    <div class="container-fluid">
 
 <div id="" style="margin: 10px;">  
   
   <div id="total-top" style="margin-bottom:2em;"> 
     <div> 
  <h4>Pending Questions</h4>
             
   </div> 
     <div style="float:right">
         <span>Total Pending Questions:&nbsp;<?php echo $pending_quetions; ?></span>
     
     </div>
 </div>
   
   <?php if($ques_status ->num_rows () >0): ?>
   <table class="table table-bordered">
       <thead>
<tr>
<th  style="width:5%">#id</th> 
<th  style="width:10%">Category</th>  
<th style="width:10%">User</th>
<th style="width:40%;text-align: center;">Questions</th>
<th style="width:10%">Date Posted</th>
<th style="width:10%;text-align: center;">Status</th>
<th style="width:10%;text-align: center;">Delete</th>
</tr>
</thead>
<tbody>
    <?php foreach ($ques_status->result() as $row):?>   
   <tr id="pending-ques<?php echo $row->questionid; ?>">
<td><?php echo $row->questionid; ?></td>
<td>
    <a href="<?php echo base_url();?>index.php/category/index/<?php echo $row->cat_id; ?>">
        <?php echo $row->cat_name;?>
    </a>
    </td>
<td style="text-align: center;">
    <a href="<?php echo base_url();?>index.php/userinfo/index/<?php echo $row->userid; ?>">
        <?php echo $row->user_name; ?>
    </a>
    </td>
<td style="text-align: center;">
    <a href="<?php echo base_url();?>index.php/answers/index/<?php echo $row->questionid; ?>">
    <?php echo $row->ques_title; ?>
    </a>
</td>
<td style="text-align: center;"><?php echo $row->ques_date; ?></td>
<td style="text-align: center;"><?php if(!$row->ques_status=='1'){?>
  <span  id="approved-ques<?php echo $row->questionid; ?>">      
  <a href="javascript:void(0)" onclick="approve_question('<?php echo $row->questionid; ?>')" alt="Approve">
    pending
  </a>
  </span>
    <?php  }?>
</td>
<td style="text-align: center;">
    <a href="javascript:void(0)" onclick="delete_question('<?php echo $row->questionid; ?>')" alt="delete">
    <i class="icon-remove"></i>
    </a>
    </td>
</tr>
 <?php endforeach;?>
   
</tbody> 

   </table>   
       <?php echo $links; ?>
  <?php else: ?> 



    <b style="letter-spacing: 1px;word-spacing:1px;color:#5E636B"> No Pending Questions Found</b>
    
   <?php endif;?>
</div>   
    </div>  
 </div>
<script>
 function  delete_question($qid){
 //$("#abc"+$id).css({'background-color' : 'blue'});
     //alert($qid);
     
      var r=confirm("All You Sure Want to Delete the Question !");
  if (!r==true)
    {
      return false;
    } 
     
      $.ajax(
    {
        type:"POST",
        async: false, 
        url: '<?php echo base_url();?>index.php/admin/questions_manage/deleteques',
        data: "id="+$qid,
        success: function(res)
        {          alert(res);
            $('#pending-ques'+$qid).hide();
                        
        },
         error: function(jqXHR, textStatus, errorThrown){ 
      alert(textStatus + " " + errorThrown);
       }
    }); 
}


function  approve_question($id){
 //$("#abc"+$id).css({'background-color' : 'blue'});
    // alert($id);
      $.ajax(
    {
        type:"POST",
        async: false, 
        url: '<?php echo base_url();?>index.php/admin/questions_manage/approveques',
        data: "id="+$id,
        success: function(res)
        {         // alert(res);
           
                $('#approved-ques'+$id).html('<i class="icon-ok"></i>');
           
            
                        
        },
         error: function(jqXHR, textStatus, errorThrown){ 
      alert(textStatus + " " + errorThrown);
       }
    }); 
}
</script>