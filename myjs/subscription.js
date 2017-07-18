
   
    
   // subscription for SIMPLE PACKAGE
 function subscribeSimple()
    {
       
       //get sessional email and generate ref id for this transaction
         var x=$.ajax({
      type: "POST",
      url: 'php/getrefid.php',
      contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
      data: false,
      dataType: "text"
     });
     
     x.done(function(serverResponse)
     {
           var response = $.parseJSON(serverResponse);
       usermail=response['email'];
       var refid=response['refid'];
      
      //now you can now run paystack code
       var handler = PaystackPop.setup({
      key: 'pk_test_4362aec60774d11189812e8b13f3e0917b2cdf07',
      email: usermail,
      plan: 'PLN_5vjs49mnq9x8lrd',
      ref: refid,
      callback: function(response){
          var paystackrefid=response.reference;
          //verify this transaction before you commit database.
         if(paystackrefid==refid) 
         {
//         now lets submit to database
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

var target = $('#vouchermodal').get(0);
var spinner = new Spinner(opts).spin(target);

         //continue ur code   
       
        var package="Simple";
             
         var x=$.ajax({
      type: "POST",
      url: 'php/subscriptions.php',
      contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
      data: "package="+encodeURIComponent(package)+"&refid="+encodeURIComponent(refid)+"&usermail="+encodeURIComponent(usermail),
      dataType: "text"
     });
     
     x.done(function(serverResponse)
     {
        var servervalue=serverResponse.trim();
               if(servervalue=='successful')
               { 
               $("#vouchermodal").modal("hide");
     swal("Successful!", "Your subscription was successful", "success");
               }
              
               else
               {
           swal("Error!", "An error occured, please try again "+servervalue, "error");  
                   
               }
               
     });
     
      x.fail(function(){
        swal("Server Error!", "Server could not process the finishing part of your subscription. Please send us a mail!", "error");
     
     });
     
     x.always(function(){
         spinner.stop();
                 //$("#signupmodal").modal("hide");
});
//database submission ends here
      }
      else{
          swal("Server Error!", "Transaction could not be verified", "error");
      }
      },
      onClose: function(){
          //alert('window closed');
      }
    });
    handler.openIframe();
      //paystack code ends here
           

     
     
     
     });
     
      x.fail(function(){
   swal("Server Error!", "Server could not generate your ref id. Please try again later!", "error");
     
     });
     
     x.always(function(){
         
                 
});
     
   
 
    
    }
      
   
   
    // subscription for COMPACT PACKAGE
 function subscribeCompact()
    {
        
       //get sessional email and generate ref id for this transaction
         var x=$.ajax({
      type: "POST",
      url: 'php/getrefid.php',
      contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
      data: false,
      dataType: "text"
     });
     
     x.done(function(serverResponse)
     {
           var response = $.parseJSON(serverResponse);
       usermail=response['email'];
       var refid=response['refid'];
      
      //now you can now run paystack code
        var handler = PaystackPop.setup({
      key: 'pk_test_4362aec60774d11189812e8b13f3e0917b2cdf07',
      email: usermail,
      plan: 'PLN_ygvqphrjbz8nahy',
      ref: refid,
      callback: function(response){
          var paystackrefid=response.reference;
          //verify this transaction before you commit database.
         if(paystackrefid==refid) 
         {
//         now lets submit to database
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

var target = $('#vouchermodal').get(0);
var spinner = new Spinner(opts).spin(target);

         //continue ur code   
       
        var package="Compact";
             
         var x=$.ajax({
      type: "POST",
      url: 'php/subscriptions.php',
      contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
      data: "package="+encodeURIComponent(package)+"&refid="+encodeURIComponent(refid)+"&usermail="+encodeURIComponent(usermail),
      dataType: "text"
     });
     
     x.done(function(serverResponse)
     {
        var servervalue=serverResponse.trim();
               if(servervalue=='successful')
               { 
                           $("#vouchermodal").modal("hide");
     swal("Successful!", "Your subscription was successful", "success");
               }
              
               else
               {
                swal("Error!", "An error occured, please try again "+servervalue, "error");  
                   
               }
               
     });
     
      x.fail(function(){
        swal("Server Error!", "Server could not process the finishing part of your subscription. Please send us a mail!", "error");
     
     });
     
     x.always(function(){
         spinner.stop();
                 //$("#signupmodal").modal("hide");
});
//database submission ends here
      }
      else{
          swal("Server Error!", "Transaction could not be verified", "error");
      }
      },
      onClose: function(){
          //alert('window closed');
      }
    });
    handler.openIframe();
      //paystack code ends here
           

     
     
     
     });
     
      x.fail(function(){
   swal("Server Error!", "Server could not generate your ref id. Please try again later!", "error");
     
     });
     
     x.always(function(){
         
                 
});
     
   
     
    
    }
    
 
 
 
  // subscription for PREMIUM PACKAGE
 function subscribePremium()
    {
        
       //get sessional email and generate ref id for this transaction
         var x=$.ajax({
      type: "POST",
      url: 'php/getrefid.php',
      contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
      data: false,
      dataType: "text"
     });
     
     x.done(function(serverResponse)
     {
           var response = $.parseJSON(serverResponse);
       usermail=response['email'];
       var refid=response['refid'];
      
      //now you can now run paystack code
       var handler = PaystackPop.setup({
      key: 'pk_test_4362aec60774d11189812e8b13f3e0917b2cdf07',
      email: usermail,
      plan: 'PLN_1a7eix2s9e8xsd8',
      ref: refid,
      callback: function(response){
          var paystackrefid=response.reference;
          //verify this transaction before you commit database.
         if(paystackrefid==refid) 
         {
//         now lets submit to database
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

var target = $('#vouchermodal').get(0);
var spinner = new Spinner(opts).spin(target);

         //continue ur code   
       
        var package="Premium";
             
         var x=$.ajax({
      type: "POST",
      url: 'php/subscriptions.php',
      contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
      data: "package="+encodeURIComponent(package)+"&refid="+encodeURIComponent(refid)+"&usermail="+encodeURIComponent(usermail),
      dataType: "text"
     });
     
     x.done(function(serverResponse)
     {
        var servervalue=serverResponse.trim();
               if(servervalue=='successful')
               { 
                           $("#vouchermodal").modal("hide");
     swal("Successful!", "Your subscription was successful", "success");
               }
              
               else
               {
                swal("Error!", "An error occured, please try again "+servervalue, "error");  
                   
               }
               
     });
     
      x.fail(function(){
        swal("Server Error!", "Server could not process the finishing part of your subscription. Please send us a mail!", "error");
     
     });
     
     x.always(function(){
         spinner.stop();
                 //$("#signupmodal").modal("hide");
});
//database submission ends here
      }
      else{
          swal("Server Error!", "Transaction could not be verified", "error");
      }
      },
      onClose: function(){
          //alert('window closed');
      }
    });
    handler.openIframe();
      //paystack code ends here
           

     
     
     
     });
     
      x.fail(function(){
   swal("Server Error!", "Server could not generate your ref id. Please try again later!", "error");
     
     });
     
     x.always(function(){
         
                 
});
     
   
     
    
    }
   
   
   





 $(document).on("click", "#closebutton", function(event)
 {
             $("#vouchermodal").modal("hide");
 }
);

function checkSimpleSubscription() 
{
          var returnval;
          
         var x=$.ajax({
      type: "POST",
      url: 'php/checksubscriptions.php',
      contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
      data: false,
      dataType: "text"
     });
     
     x.done(function(serverResponse)
     {
         if(serverResponse.trim()=="no data")
         {
           subscribeCompact();  
         }
         else{
            returnval = $.parseJSON(serverResponse);
       
        if((returnval['daysleft']>0)&&((returnval['clothings']!=0)||(returnval['suits']!=0)))
       {
swal({
  title: "New Subscription ?",
  text: "You have an active subscription with "+returnval['clothings']+" clothings and "+returnval['suits']+" suits. New subscription will cancel old subscription",
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
    
   subscribeSimple();  
    
  } else 
  {
	//do nothing   
  }
});
      
     }
     else
     {
       subscribeSimple();
     }
      
         } 
               
               
     });
     
      x.fail(function(){
        swal("Server Error!", "Server could not process your request", "error");
     
     });
     
     x.always(function(){
         
                 
});

return returnval;
}

function checkCompactSubscription() 
{
          var returnval;
          
         var x=$.ajax({
      type: "POST",
      url: 'php/checksubscriptions.php',
      contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
      data: false,
      dataType: "text"
     });
     
     x.done(function(serverResponse)
     {
         if(serverResponse.trim()=="no data")
         {
           subscribeCompact();  
         }
         else{
            returnval = $.parseJSON(serverResponse);
       
        if((returnval['daysleft']>0)&&((returnval['clothings']!=0)||(returnval['suits']!=0)))
       {
swal({
  title: "New Subscription?",
  text: "You have an active subscription with "+returnval['clothings']+" clothings and "+returnval['suits']+" suits. New subscription will cancel old subscription",
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
    
 subscribeCompact();  
    
  } else 
  {
	//do nothing   
  }
});
      
     }
     else
     {
subscribeCompact();
     }
      
         }  
               
               
     });
     
      x.fail(function(){
        swal("Server Error!", "Server could not process your request", "error");
     
     });
     
     x.always(function(){
         
                 
});

return returnval;
}

function checkPremiumSubscription() 
{
          var returnval;
          
         var x=$.ajax({
      type: "POST",
      url: 'php/checksubscriptions.php',
      contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
      data: false,
      dataType: "text"
     });
     
     x.done(function(serverResponse)
     {
         if(serverResponse.trim()=="no data")
         {
           subscribeCompact();  
         }
         else{
         
            returnval = $.parseJSON(serverResponse);
       
        if((returnval['daysleft']>0)&&((returnval['clothings']!=0)||(returnval['suits']!=0)))
       {
swal({
  title: "New Subscription?",
  text: "You have an active subscription with "+returnval['clothings']+" clothings and "+returnval['suits']+" suits. New subscription will cancel old subscription",
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
    
  subscribePremium();  
    
  } else 
  {
	//do nothing   
  }
});
      
     }
     else
     {
       subscribePremium();
     }
      
     }
               
               
     });
     
      x.fail(function(){
        swal("Server Error!", "Server could not process your request", "error");
     
     });
     
     x.always(function(){
         
                 
});

return returnval;
}