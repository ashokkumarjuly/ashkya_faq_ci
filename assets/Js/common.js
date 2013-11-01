 function  getview($id){
 //$("#abc"+$id).css({'background-color' : 'blue'});
     //alert($id);
      $.ajax(
    {
        type:"POST",
        async: false, 
        url: 'http://localhost/faq_ci/index.php/answers/addview',
        data: "id="+$id,
        success: function()
        {          
                        
        },
         error: function(jqXHR, textStatus, errorThrown){ 
      alert(textStatus + " " + errorThrown);
       }
    }); 
}