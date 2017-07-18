//javascript for login and signup pages
$(document).ready(function()
{
   
    
   //EDIT PROFILE
 $(document).on("click", "#editbutton", function(event)
    {
    
             //starts spinner
        
        var opts = {
  lines: 13 // The number of lines to draw
, length: 8 // The length of each line
, width: 14 // The line thickness
, radius: 35 // The radius of the inner circle
, scale: 1 // Scales overall size of the spinner
, corners: 0.9 // Corner roundness (0..1)
, color: '#000' // #rgb or #rrggbb or array of colors
, opacity: 0.35 // Opacity of the lines
, rotate: 26 // The rotation offset
, direction: 1 // 1: clockwise, -1: counterclockwise
, speed: 1.2 // Rounds per second
, trail: 56 // Afterglow percentage
, fps: 20 // Frames per second when using setTimeout() as a fallback for CSS
, zIndex: 2e9 // The z-index (defaults to 2000000000)
, className: 'spinner' // The CSS class to assign to the spinner
, top: '51%' // Top position relative to parent
, left: '70%' // Left position relative to parent
, shadow: false // Whether to render a shadow
, hwaccel: false // Whether to use hardware acceleration
, position: 'absolute' // Element positioning
}

var target = $('#edituserdetailsform').get(0);
var spinner = new Spinner(opts).spin(target);

         //continue ur code   
            var email=$('#email').val();
        var firstname=$('#firstname').val();
        
        var lastname=$('#lastname').val();
        var address=$('#address').val();
        var phone=$('#phone').val();
       //alert(email);
      
         var x=$.ajax({
      type: "POST",
      url: 'php/updateuserdetails.php',
      contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
      data: "firstname=" + encodeURIComponent(firstname)+"&lastname=" + encodeURIComponent(lastname)+"&address=" + encodeURIComponent(address)+"&phone="+encodeURIComponent(phone)+"&email="+encodeURIComponent(email),
      dataType: "text"
     });
     
     x.done(function(serverResponse)
     {
         
        var servervalue=serverResponse.trim();
               if(servervalue=='successful')
               { 
                  swal("Update!", "Update successful", "success"); 
               }
               else
               {
                swal("Error!", "An error occured while updating your details", "error");  
                   
               }
               
     });
     
      x.fail(function(){
        swal("Server Error!", "Server could not process this request, please try again later!", "error")
     
     });
     
     x.always(function(){
         spinner.stop();
                 
});
//}// end of if for validity   
     //if its individual or tutor
        
       
//     else{
//         
//     }
     //document.getElementById("loader").style.display="none";   
        //$('.signupbutton').button('reset');
    });//button click closes
      
   
    
     $(document).on("click", "#changepasswordbutton", function(event)
    {
    
             //starts spinner
        
        var opts = {
  lines: 13 // The number of lines to draw
, length: 8 // The length of each line
, width: 14 // The line thickness
, radius: 35 // The radius of the inner circle
, scale: 1 // Scales overall size of the spinner
, corners: 0.9 // Corner roundness (0..1)
, color: '#000' // #rgb or #rrggbb or array of colors
, opacity: 0.35 // Opacity of the lines
, rotate: 26 // The rotation offset
, direction: 1 // 1: clockwise, -1: counterclockwise
, speed: 1.2 // Rounds per second
, trail: 56 // Afterglow percentage
, fps: 20 // Frames per second when using setTimeout() as a fallback for CSS
, zIndex: 2e9 // The z-index (defaults to 2000000000)
, className: 'spinner' // The CSS class to assign to the spinner
, top: '51%' // Top position relative to parent
, left: '70%' // Left position relative to parent
, shadow: false // Whether to render a shadow
, hwaccel: false // Whether to use hardware acceleration
, position: 'absolute' // Element positioning
}

var target = $('#changepasswordform').get(0);
var spinner = new Spinner(opts).spin(target);

         //continue ur code   
            var old=$('#oldpassword').val();
        var new1=$('#newpassword1').val();
        
        var new2=$('#newpassword2').val();
       
      
         var x=$.ajax({
      type: "POST",
      url: 'php/changepassword.php',
      contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
      data: "oldpassword=" + encodeURIComponent(old)+"&newpassword1=" + encodeURIComponent(new1)+"&newpassword2=" + encodeURIComponent(new2),
      dataType: "text"
     });
     
     x.done(function(serverResponse)
     {
         
        var servervalue=serverResponse.trim();
               if(servervalue=='successful')
               { 
                  swal("Update!", "Password change successful", "success"); 
               }
               else if(servervalue=='error')
               {
                   swal("Error!", "An error occured while changing your password", "error");  
               }
               else
               {
                swal("Error!", "An error occured!"+servervalue, "error");  
                   
               }
               
     });
     
      x.fail(function(){
        swal("Server Error!", "Server could not process this request, please try again later!", "error")
     
     });
     
     x.always(function(){
         spinner.stop();
                 
});
//}// end of if for validity   
     //if its individual or tutor
        
       
//     else{
//         
//     }
     //document.getElementById("loader").style.display="none";   
        //$('.signupbutton').button('reset');
    });//button click closes
      
     
     $(document).on("click", "#cancelautorenew", function(event)
    {
    
    
    
        swal({
  title: "Cancel Subscription Auto Renewal!",
  text: "Are you sure you want to cancel auto renewal?",
  type: "warning",
  showCancelButton: true,
  confirmButtonColor: "#DD6B55",
  confirmButtonText: "Yes,Go Ahead!",
  cancelButtonText: "No, Sorry!",
  closeOnConfirm: true,
  closeOnCancel: true
},
function(isConfirm){
  if (isConfirm) 
  {
      //spinner first
      
    
        var opts = {
  lines: 13 // The number of lines to draw
, length: 8 // The length of each line
, width: 14 // The line thickness
, radius: 35 // The radius of the inner circle
, scale: 1 // Scales overall size of the spinner
, corners: 0.9 // Corner roundness (0..1)
, color: '#000' // #rgb or #rrggbb or array of colors
, opacity: 0.35 // Opacity of the lines
, rotate: 26 // The rotation offset
, direction: 1 // 1: clockwise, -1: counterclockwise
, speed: 1.2 // Rounds per second
, trail: 56 // Afterglow percentage
, fps: 20 // Frames per second when using setTimeout() as a fallback for CSS
, zIndex: 2e9 // The z-index (defaults to 2000000000)
, className: 'spinner' // The CSS class to assign to the spinner
, top: '51%' // Top position relative to parent
, left: '70%' // Left position relative to parent
, shadow: false // Whether to render a shadow
, hwaccel: false // Whether to use hardware acceleration
, position: 'absolute' // Element positioning
}

var target = $('#changepasswordform').get(0);
var spinner = new Spinner(opts).spin(target);

      
      
         var x=$.ajax({
      type: "POST",
      url: 'php/deactivateautorenewal.php',
      contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
      data: false,
      dataType: "text"
     });
     
     x.done(function(serverResponse)
     {
         
        var servervalue=serverResponse.trim();
               if(servervalue=='1')
               { 
                  swal("Autorenewal!", "Autorenewal turned off", "success"); 
               }
               else
               {
                   swal("Error!", "An error occured!", "error");  
               }
               
               
     });
     
      x.fail(function(){
        swal("Server Error!", "Server could not process this request, please try again later!", "error")
     
     });
     
     x.always(function(){
         spinner.stop();
                 
});
  } else 
  {
	   // log out cancelled
  }
});
    });
    
    
    
    
    
    
    
    
    
    
    
    
});//document.ready closes


 
