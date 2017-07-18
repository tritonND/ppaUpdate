//javascript for login and forgot password functions on login.php page
$(document).ready(function()
{
   
   

   //register a contractor or consultant
 $(document).on("click", "#createcontractorsbut", function(e)
    {
     var type=$('#option').val();
if(type=='select')
{
  swal("Error!", "Select an option ", "error");   
  return;
}


       //alert("hello");
        swal({
  title: "Submit ?",
  text: "Are you sure you want to submit!",
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
//var target = document.getElementById('spinnerdiv');
var target = $('#contractorsform').get(0);
var spinner = new Spinner(opts).spin(target);

        var x=$.ajax({
      type: "POST",
      url: 'php/contractors.php',
      contentType: false,
      data: new FormData($('#contractorsform').get(0)),
      dataType: "text",
      processData: false
     });
     
     x.done(function(serverResponse)
     {
    response=serverResponse.trim();
    
     if(response=='successful')
    {
        swal("Successful", "Action successful", "success");
        $('#contractorsform').get(0).reset();
        $('#assoc_passport1').css("display","none");
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
   
        //show details of contractor or supervisor
 $(document).on("click", ".mysupervisor", function(e)
    {

     var mytag = $(this);
var email=mytag.attr("data-id");
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
//var target = document.getElementById('spinnerdiv');
var target = $(this).get(0);
var spinner = new Spinner(opts).spin(target);

        var x=$.ajax({
      type: "POST",
      url: 'php/showcontractorsdetails.php',
      contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
      data: "email=" + encodeURIComponent(email),
      dataType: "text"
     });
     
     x.done(function(serverResponse)
     {
         var response = $.parseJSON(serverResponse);
         $('#supervisorsemail').html(email);
         $('#supervisorscac').html(response['cac']);
         $('#supervisorsmd').html(response['fullname']);
         $('#supervisorsphoto').attr("src","php/"+response['photo']);
         
         $('#blacklist').attr("dataid",email);
         $('#restore').attr("dataid",email);
         $('#editbut').attr("dataid",email);
         
         if(response['state']==0)
         {
           
           $('#supervisorsstatus').html('Blacklisted');
           
         }
          if(response['state']==1)
         {
           $('#supervisorsstatus').html('Active');
           
         }
         
         
        $('#supervisorsmodal').modal('show');
        
     });
     
      x.fail(function(){
         
     });
     
     x.always(function(){
         spinner.stop();
});
        
        
        
    });//button click closes
   
   //blacklist a company
      $(document).on("click", "#blacklist", function(e)
    {

     var mytag = $(this);
var email=mytag.attr("dataid");
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
//var target = document.getElementById('spinnerdiv');
var target = $(this).get(0);
var spinner = new Spinner(opts).spin(target);

        var x=$.ajax({
      type: "POST",
      url: 'php/blacklist.php',
      contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
      data: "email=" + encodeURIComponent(email),
      dataType: "text"
     });
     
     x.done(function(serverResponse)
     {
       var response=serverResponse.trim();
       if(response=='already')
       {
        swal("Error!", "Company blacklisted already ", "error");      
       }
       else if(response=='successful')
       {
           swal("Successful", "Company successfully blacklisted ", "success"); 
           $('#supervisorsstatus').html('Blacklisted');
       }
       else{
           swal("Error!", "An error occured, please try again later", "error"); 
       }
         
         
        
        
     });
     
      x.fail(function(){
         
     });
     
     x.always(function(){
         spinner.stop();
});
        
        
        
    });//button click closes
   
      
    //restore a blacklisted company
      $(document).on("click", "#restore", function(e)
    {

     var mytag = $(this);
var email=mytag.attr("dataid");
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
//var target = document.getElementById('spinnerdiv');
var target = $(this).get(0);
var spinner = new Spinner(opts).spin(target);

        var x=$.ajax({
      type: "POST",
      url: 'php/restoreblacklist.php',
      contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
      data: "email=" + encodeURIComponent(email),
      dataType: "text"
     });
     
     x.done(function(serverResponse)
     {
       var response=serverResponse.trim();
       if(response=='already')
       {
        swal("Error!", "Company is not blacklisted ", "error");      
       }
       else if(response=='successful')
       {
           swal("Successful", "Company Successfully Restored", "success"); 
           $('#supervisorsstatus').html('Active');
       }
       else{
           swal("Error!", "An error occured, please try again later", "error"); 
       }
         
         
        
        
     });
     
      x.fail(function(){
         
     });
     
     x.always(function(){
         spinner.stop();
});
        
        
        
    });//button click closes
   
        
        //when u click on edit button
         $(document).on("click", "#editbut", function(e)
    {

     var mytag = $(this);
var email=mytag.attr("dataid");
location.href="/edpms/edit-contractors-consultants.php?id="+email;
        //starts spinner
    });
        
     //edit or make changes to the details of  a contractor or consultant
 $(document).on("click", "#editcontractorsbut", function(e)
    {
     var type=$('#option').val();
if(type=='select')
{
  swal("Error!", "Select an option ", "error");   
  return;
}
var option=$('#option').val();
var companyname=$('#companyname').val();
var fullname=$('#fullname').val();
var email=$('#email').val();
var phone=$('#phone').val();
var address=$('#address').val();
var spec=$('#specialization').val();
var cac=$('#cacnumber').val();

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
//var target = document.getElementById('spinnerdiv');
var target = $('#contractorsform').get(0);
var spinner = new Spinner(opts).spin(target);

        var x=$.ajax({
      type: "POST",
      url: 'php/editcontractors.php',
      contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
      data: "email="+encodeURIComponent(email)+"&option=" + encodeURIComponent(option)+"&fullname=" + encodeURIComponent(fullname)+"&cac=" + encodeURIComponent(cac)+"&companyname=" + encodeURIComponent(companyname)+"&phone=" + encodeURIComponent(phone)+"&address=" + encodeURIComponent(address)+"&spec=" + encodeURIComponent(spec),
      dataType: "text"
      
     });
     
     x.done(function(serverResponse)
     {
    response=serverResponse.trim();
    
     if(response=='successful')
    {
        swal("Successful", "Action successful", "success");
       // $('#contractorsform').get(0).reset();
        
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
        
        
        
    });//button click closes
   
});//document.ready closes


 
