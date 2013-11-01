<div class="navbar">
        
    <div class="navbar-inner">
   
    <ul class="nav">
    <li><a href="<?php echo base_url();?>index.php/login/do_admin">Dashboard</a></li>
    <li  class="active"><a href="javascript:void(0)">Category</a></li>
    <li><a href="<?php echo base_url();?>index.php/admin/questions_manage">Pending Questions</a></li>
    <li><a href="<?php echo base_url();?>index.php/admin/users_manage">Users</a></li>
    </ul>        
      <?php if($this->session->userdata('is_logged_in')): ?>    
     <p class="navbar-text pull-right">Logged in as <a href="javascript:void(0)"><?php echo $objSession->userdata('username'); ?></a></p>
     <?php endif; ?> 
    </div>   
        
    </div>

<div id="main" style="margin: 0px auto; min-height:380px;">
    <div class="container-fluid">
    <div id="" style="border: 1px solid #E5E5E5;">         
     <div style="margin-left:50px;">   
     <form class="form-inline" enctype="multipart/form-data" method='post' action="<?php echo base_url();?>index.php/admin/category/category_add">    
         <span class="help-inline" style="color:red;"><?php echo form_error('cat_name'); ?></span>    
    <span class="help-inline" style="color:red;"><?php //echo $image_error; ?></span>
     <span class="help-inline" style="color:red;"><?php echo $this->session->flashdata('edit_image');  ?> </span> 
    
     <h4>Add Category 
         <span style="font-size:15px;word-spacing:1px;margin-left:6px" class="help-inline">
                  <?php echo $this->session->flashdata('add_cat');  ?>
          </span> 
     </h4>
   
<!--    <form class="form-inline" enctype="multipart/form-data" method='post' action="<?php echo base_url();?>index.php/admin/category/category_add">-->
  <label class="control-label">Enter Category Name:</label>
   <input name="cat_name"  class="input-small" value="<?php echo set_value('cat_name'); ?>" type="text" />
   <label class="control-label" style="margin-left:15px;">Upload Image :</label>
   <input name="cat_img"  class="input-file" type="file" /> 
    &nbsp;&nbsp;&nbsp;&nbsp;
<!--    <button type="submit" class="btn">Submit</button>   -->
  <button type="submit" class="btn btn-primary">Save changes</button>
  
    </form>
    
    </div>
  </div>
        
 <div id="cat-list" style="margin-top:30px;">  
   
   <div id="total-top" style="margin-bottom:1em;"> 
     <div> 
  <h4>Category</h4><span id="catdelete_msg"></span>
  
  <span class="help-inline" style="color:red;">
      <?php echo $this->session->flashdata('result_cat');  ?>
  </span> 
             
   </div> 
   
 </div>
   <span class="help-inline" style="color:red;"><?php echo form_error('edit_catname'); ?></span>  
  
<!--    <span class="help-inline" style="color:red;"><?php echo $error_image2; ?></span>-->
   
  <?php if($query->num_rows ()>0): ?>
   <div style="float:right;margin-bottom: 1em;">
         <span>Total Category:&nbsp;<?php echo $total_category; ?></span>
     
     </div>
   
   <table class="table table-bordered">
       <thead>
<tr>
<th style="width:5%">#</th>
<th style="width:10%">Category Image</th>
<th style="width:10%">Category Name</th>
<th style="width:5%; text-align: center;">Edit</th>
<th style="width:5%; text-align: center;">Delete</th>
</tr>
</thead>
<tbody>
    <?php foreach ($query->result() as $row){?>  
<tr id="delete-cat<?php echo $row->cat_id; ?>">
<td><?php echo $row->cat_id; ?></td>
<td><img src="<?php echo base_url().$row->cat_image; ?>" height="50px" width="80px"/></td>
<td><?php echo $row->cat_name; ?></td>
<td style="text-align: center;"><a href="javascript:void(0)" onclick="$('#category-edit<?php echo $row->cat_id; ?>').show()"><i class="icon-edit"></i></a></td>
<td style="text-align: center;">
    <a href="javascript:void(0)" onclick="delete_cat('<?php echo $row->cat_id; ?>')" title="delete">
    <i class="icon-remove"></i>
    </a>    
</td>
</tr>

<tr id="category-edit<?php echo $row->cat_id; ?>" style="display:none;">
    <td colspan="7" >
    <div>
        <form enctype="multipart/form-data" method='post' action="<?php echo base_url();?>index.php/admin/category/category_edit" onSubmit="return cformvalidate('<?php echo $row->cat_id; ?>');">
            <div style="float:left;width:40%;"><label style="font-size:15px;letter-spacing: 2px;">Choose Image</label>
                <input type="file" name="edit_catimage" id="edit_catimage<?php echo $row->cat_id; ?>"/>
            </div>    
            <div style="float:left;width:30%"><label style="font-size:15px;letter-spacing: 2px;">Category Name</label>
                <input type="text" name="edit_catname" id="edit_catname<?php echo $row->cat_id; ?>" value="<?php echo $row->cat_name; ?>">
            </div>
         <div class="form-actions" style="border-top:none;">
             <input type="hidden" name="cat_id" value="<?php echo $row->cat_id; ?>">
    <button type="submit" class="btn btn-primary">Save changes</button>
    <button type="button" class="btn" onclick="$('#category-edit<?php echo $row->cat_id; ?>').hide()">Cancel</button>
    </div>    
        </form>   
    </div>
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
 function  delete_cat($cid){
 //$("#abc"+$id).css({'background-color' : 'blue'});
     //alert($cid);
     
    var r=confirm("All Q & A Posted Under the Category also deleted !");
  if (!r==true)
    {
      return false;
    } 
     
     
      $.ajax(
    {
        type:"POST",
        async: false, 
        url: '<?php echo base_url();?>index.php/admin/category/deletecat',
        data: "cid="+$cid,
        success: function(res)
        {          //alert(res);
            $('#delete-cat'+$cid).hide();
            $('#catdelete_msg').html('<b style="color:green">Category Deleted</b>');
                        
        },
         error: function(jqXHR, textStatus, errorThrown){ 
      alert(textStatus + " " + errorThrown);
       }
    }); 
}

function cformvalidate($x){

var image_file =$("#edit_catimage"+$x);
var cat_name =$("#edit_catname"+$x);
var ext = $('#edit_catimage'+$x).val().split('.').pop().toLowerCase();


//alert(ext);

function checkfield(x) {
			if ( x.val()==null || x.val()=="" ) {
				x.css('border', '1px red solid');
                      //alert("Please Fill the Fields");				
				return false;
			} else {
				return true;
			}
		}

function checkimage(y) {
//			if($.inArray(ext, ['gif','png','jpg','jpeg']) == -1) {
if (y == 'gif' || y == 'jpg' || y == 'jpeg'|| y == 'png'){
                        
                       return true;
                  }
                  else {
				
                     image_file.css('border', '1px red solid');
                       alert('Allowed Extensions : png,jpeg,gif,jpg');
                       return false;
			}
		}



 var aValid = true;                                        
    aValid = aValid && checkfield(image_file, "image_file" );
    aValid = aValid && checkimage(ext ,"ext" );
    aValid = aValid && checkfield(cat_name ,"cat_name" );
    
    


 if(!aValid){
     return false;
 }
 
 



}

</script>