//javascript for login and forgot password functions on login.php page
$(document).ready(function()
{
   
   

   //approve validity of project details
 $(document).on("click", "#approveprj", function(e)
    {
  var mytag = $(this);
var id=mytag.attr("data-id");
console.log(id);
        swal({
  title: "Approve correctness of data ?",
  text: "Are you sure you want to approve the validity of these data!",
  type: "warning",
  showCancelButton: true,
  confirmButtonColor: "#DD6B55",
  confirmButtonText: "Yes!",
  cancelButtonText: "No, Sorry!",
  closeOnConfirm: false,
  closeOnCancel: true
},
function(isConfirm){
  if (isConfirm) 
  {
   
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
//var target = document.getElementById('spinnerdiv');
var target = $(mytag).get(0);
var spinner = new Spinner(opts).spin(target);

        var x=$.ajax({
      url: 'php/approveproject.php',
      contentType: false,
      data: "id=" + encodeURIComponent(id),
      dataType: "text",
      cache: false
     });
     
     x.done(function(serverResponse)
     {
    response=serverResponse.trim();
    
     if(response=='successful')
    {
        swal("Successful", "Project approved successful", "success");
      location.reload(true);
    }
    else{
        swal("Error!", "An error occured ", "error"); 
    }
        
     });
     
      x.fail(function(){
         
     });
     
     x.always(function(){
         spinner.stop();
});
    
  } else 
  {
	   // submit cancelled
  }
});



       
        
        
        
    });//button click closes
   
    //approve validity of certificate financial details
 $(document).on("click", "#approvecert", function(e)
    {
  var mytag = $(this);
var id=mytag.attr("data-id");

        swal({
  title: "Approve correctness of data ?",
  text: "Are you sure you this certificate has been paid",
  type: "warning",
  showCancelButton: true,
  confirmButtonColor: "#DD6B55",
  confirmButtonText: "Yes!",
  cancelButtonText: "No, Sorry!",
  closeOnConfirm: false,
  closeOnCancel: true
},
function(isConfirm){
  if (isConfirm) 
  {
   
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
//var target = document.getElementById('spinnerdiv');
var target = $(mytag).get(0);
var spinner = new Spinner(opts).spin(target);

        var x=$.ajax({
      url: 'php/approvecertificate2.php',
      contentType: false,
      data: "id=" + encodeURIComponent(id),
      dataType: "text",
      cache: false
     });
     
     x.done(function(serverResponse)
     {
    response=serverResponse.trim();
    
     if(response=='successful')
    {
        swal("Successful", "Certificate approved successful", "success");
      location.reload(true);
    }
    else{
        swal("Error!", "An error occured ", "error"); 
    }
        
     });
     
      x.fail(function(){
         
     });
     
     x.always(function(){
         spinner.stop();
});
    
  } else 
  {
	   // submit cancelled
  }
});



       
        
        
        
    });//button click closes
        
     //approve validity of certificate financial details
 $(document).on("click", "#approvevar", function(e)
    {
  var mytag = $(this);
var id=mytag.attr("data-id");

        swal({
  title: "Approve correctness of data ?",
  text: "Are you sure you this variation is valid",
  type: "warning",
  showCancelButton: true,
  confirmButtonColor: "#DD6B55",
  confirmButtonText: "Yes!",
  cancelButtonText: "No, Sorry!",
  closeOnConfirm: false,
  closeOnCancel: true
},
function(isConfirm){
  if (isConfirm) 
  {
   
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
//var target = document.getElementById('spinnerdiv');
var target = $(mytag).get(0);
var spinner = new Spinner(opts).spin(target);

        var x=$.ajax({
      url: 'php/approvevariation.php',
      contentType: false,
      data: "id=" + encodeURIComponent(id),
      dataType: "text",
      cache: false
     });
     
     x.done(function(serverResponse)
     {
    response=serverResponse.trim();
    
     if(response=='successful')
    {
        swal("Successful", "Variation approved successful", "success");
      location.reload(true);
    }
    else{
        swal("Error!", "An error occured ", "error"); 
    }
        
     });
     
      x.fail(function(){
         
     });
     
     x.always(function(){
         spinner.stop();
});
    
  } else 
  {
	   // submit cancelled
  }
});



       
        
        
        
    });//button click closes
        
  
   
});//document.ready closes


 
