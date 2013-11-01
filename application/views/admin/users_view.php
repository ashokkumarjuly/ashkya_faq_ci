<div class="navbar">
        
    <div class="navbar-inner">
   
    <ul class="nav">
    <li><a href="<?php echo base_url();?>index.php/login/do_admin">Dashboard</a></li>
    <li><a href="<?php echo base_url();?>index.php/admin/category">Category</a></li>
    <li><a href="<?php echo base_url();?>index.php/admin/questions_manage">Pending Questions</a></li>
    <li  class="active"><a href="javascript:void(0)">Users</a></li>
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
  <h4>Manage Users</h4>
             
   </div> 
   
 </div>
    <?php if($query->num_rows ()>0): ?>
     <div style="float:right">
         <span>Total users:&nbsp;<?php echo $usercount; ?></span>
     
     </div>
   <table class="table table-bordered">
       <thead>
<tr>
<th>#</th>
<th style="width:20%;text-align: center;">UserName</th>
<th style="width:40%;text-align: center;">Email</th>
<th style="width:20%;text-align: center;">Gender</th>
<th style="width:10%; text-align: center;">Delete</th>
</tr>
</thead>
<tbody>
    <?php foreach ($query->result() as $row){?>   
   <tr id="delete-user<?php echo $row->id; ?>">
<td><a href="<?php echo base_url();?>index.php/userinfo/index/<?php echo $row->id; ?>"><?php echo $row->id; ?></a></td>
<td style="text-align: center;">
    <a href="<?php echo base_url();?>index.php/userinfo/index/<?php echo $row->id; ?>">
        <?php echo $row->user_name; ?>
    </a>
    </td>
<td style="text-align: center;"><?php echo $row->user_email; ?></td>
<td style="text-align: center;"><?php echo $row->user_gender; ?></td>
<td style="text-align: center;">
    <a href="javascript:void(0)" onclick="delete_user('<?php echo $row->id; ?>')" alt="delete">

    <i class="icon-remove"></i>
    </a>
</td>
</tr>
<?php } ?>
   
</tbody> 

   </table>       
  <?php echo $links; ?>
   <?php else:?> 



    <b style="letter-spacing: 1px;word-spacing:1px;color:#5E636B"> No Query Found </b>
    
   <?php endif;?>
</div>   
    </div>  
 </div>  



<script>
 function  delete_user($uid){
 //$("#abc"+$id).css({'background-color' : 'blue'});
    // alert($uid);
     
    var r=confirm("All Q & A posted by the user also deleted !");
  if (!r==true)
    {
      return false;
    } 
     
     
      $.ajax(
    {
        type:"POST",
        async: false, 
        url: '<?php echo base_url();?>index.php/admin/users_manage/deleteuser',
        data: "id="+$uid,
        success: function(res)
        {          alert(res);
            $('#delete-user'+$uid).hide();
                        
        },
         error: function(jqXHR, textStatus, errorThrown){ 
      alert(textStatus + " " + errorThrown);
       }
    }); 
}
</script>