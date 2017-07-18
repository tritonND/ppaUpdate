
  function logout()
    {
        //alert("hello");
        swal({
  title: "Log Out?",
  text: "Are you sure you really want to log out!",
  type: "warning",
  showCancelButton: true,
  confirmButtonColor: "#DD6B55",
  confirmButtonText: "Yes,Log Me Out!",
  cancelButtonText: "No, Sorry!",
  closeOnConfirm: false,
  closeOnCancel: true
},
function(isConfirm){
  if (isConfirm) 
  {
    var xy=$.ajax({
      type: "POST",
      url: 'php/logout.php',
      contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
      data: false,
      dataType: "text"
     });
     
     xy.done(function(serverResponse)
     {
          
          location.href = "/laundry/index.php";
             
     });
     
      xy.fail(function(){
         //$('#notices_message').html("Server Error. Please try again");
     });
     
     xy.always(function(){
         
     });
  } else 
  {
	   // log out cancelled
  }
});
    }
   
    

    
     function checkLoginAdmin()
    {
        var x=$.ajax({
      type: "POST",
      url: 'php/checkuserlogin.php',
      contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
      data: false
      
     });
     
     x.done(function(serverResponse)
     {
         var servervalue=serverResponse.trim();
         
         if(servervalue!=='admin')
         {
          location.href = "/schoolsconn/index.php";  
         }
         else{
             
           
         }
               
        
     });
     
      x.fail(function(){
         
     });
     
     x.always(function(){

    });
        
}

     
         function displayUserDetails()
    {
        var x=$.ajax({
      type: "POST",
      url: 'php/displaydetails.php',
      contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
      data: false
      
     });
     
     x.done(function(serverResponse)
     {
         var response = $.parseJSON(serverResponse);
      
       
       $('#email').val(response['email']);
       $('#firstname').val(response['firstname']);
       $('#lastname').val(response['lastname']);
       $('#address').val(response['address']);
       $('#phone').val(response['phone']);
       $('#plan').val(response['plan']);
       $('#daysleft').val(response['daysleft']);
       $('#suits').val(response['suits']);
       $('#clothings').val(response['clothings']);
       $('#pickups').val(response['pickups']);
       $('#expirydate').val(response['expirydate']);
       $('#autorenewal').val(response['autorenewal']);
       
          $(".userdetails").attr("disabled", "true");     
          //$("#backlink").css("color", "red");  
            if(response['autorenewal']=='OFF')
            {
        $("#cancelautorenew").addClass("disabled");
    }
        
     });
     
      x.fail(function(){
         
     });
     
     x.always(function(){

    });
        
}
  
    function enableEdit()
    {
        $(".userdetails").removeAttr("disabled");   
    }
    
    function showUserDetailsPane()
    {
        $('#secondpane').show(300);
        $('#firstpane').hide(300);
        $('#thirdpane').hide(300);
    }
    function showCedrBasket()
    {
        $('#thirdpane').show(300);
        $('#firstpane').hide(300);
        $('#secondpane').hide(300);
    }
    function hideUserDetailsPane()
    {
        $('#secondpane').hide(300);
        $('#thirdpane').hide(300);
        $('#firstpane').show(300);
    }
    function showChangePassword()
    {
        $('#changepasswordform').show(300);
        $('#edituserdetailsform').hide(300);
    }
    
     function showEditProfile()
    {
        $('#changepasswordform').hide(300);
        $('#edituserdetailsform').show(300);
    }