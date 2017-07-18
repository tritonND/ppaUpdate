//javascript for login and forgot password functions on login.php page
$(document).ready(function()
{
   $("#create-project-form").validator().on("submit",function(event)
        {
            if(!event.isDefaultPrevented()){
                event.preventDefault();
                   //start spinner
                       
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
var target = $('#create-project-form').get(0);
var spinner = new Spinner(opts).spin(target);
                   
                   
                // FIELDS IN BUDGET SESSION
                
        var f1=$('#head').val();
        var f2=$('#position').val();
        var f3=$('#sub-position').val();
        var f4=$('#budget-head').val();
        var f5=$('#budget-subhead').val();
        var f6=$('#budget-comment').val();
        
// FIELDS IN APPROPRIATIONS SESSION
        var f1b=kendo.parseFloat($('#approved-appropriation').val());
        var f2b=kendo.parseFloat($('#supplementary-provision').val());
        var f3b=kendo.parseFloat($('#sub-sector-allocation').val());
        var f4b=kendo.parseFloat($('#percentage-sub-sector-allocation').val());
        var f5b=kendo.parseFloat($('#approved-appropriation-year').val());
        var f6b=kendo.parseFloat($('#supplementary-provision-year').val());
        
// FIELDS IN PROJECT DETAILS SESSION 
        var f1c=$('#projectid').val();
        var f2c=$('#procuringentity').val();
        var f3c=$('#projtitle').val();
        var f4c=$('#projdesc').val();
        var f5c=$('#projdateofaward').val();
        var f6c=$('#projstatus').val();
        var f7c=$('#projremarks').val();
        var f8c=$('#projlocation').val();
        var f9c=$('#lga-sel2').val();
        var f10c=$('#contractduration').val();
        var f11c=$('#expectedcompletion').val();
        var f12c=$('#expirydate').val();
        
// FIELDS IN CONSUTANTTTS AND CONTRACTORS SESSION
	var f1d=$('#contractorsname').val();
        var f2d=$('#contractoraddress').val();
        var f3d=$('#contractorgsm').val();
        var f4d=$('#contractorgsm2').val();
        var f5d=$('#contractorsemail').val();
        var f6d=$('#contractor-areaofspec1').val();
        var f7d=$('#consultantname').val();
        var f8d=$('#consultantaddress').val();
        var f9d=$('#consultantsphone').val();
        var f10d=$('#consultantsphone2').val();
        var f11d=$('#consultantsemail').val();
        var f12d=$('#consultantareaofspec').val();
        
// FIELDS IN FINANCIALS SESSION
        var f1e=kendo.parseFloat($('#financial-contractsum').val());
        var f2e=kendo.parseFloat($('#financial-variations').val());
        
        var f4e=kendo.parseFloat($('#agreedmobilisation').val());
        var f5e=kendo.parseFloat($('#mobilisation-paid').val());
        
        
    
        
        var x = $.ajax(
            {
                
                url: 'php/submit_project.php',
                type: "post",
                dataType: "text",
                contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
                data: "f1="+encodeURIComponent(f1)+"&f2="+encodeURIComponent(f2)+"&f3="+encodeURIComponent(f3)+"&f4="+encodeURIComponent(f4)
                +"&f5="+encodeURIComponent(f5)+"&f6="+encodeURIComponent(f6)+"&f1b="+encodeURIComponent(f1b)+"&f2b="+encodeURIComponent(f2b)
                +"&f3b="+encodeURIComponent(f3b)+"&f4b="+encodeURIComponent(f4b)+"&f5b="+encodeURIComponent(f5b)+"&f6b="+encodeURIComponent(f6b)
                +"&f1c="+encodeURIComponent(f1c)+"&f2c="+encodeURIComponent(f2c)+"&f3c="+encodeURIComponent(f3c)+"&f4c="+encodeURIComponent(f4c)
                +"&f5c="+encodeURIComponent(f5c)+"&f6c="+encodeURIComponent(f6c)+"&f7c="+encodeURIComponent(f7c)+"&f8c="+encodeURIComponent(f8c)
                +"&f9c="+encodeURIComponent(f9c)+"&f10c="+encodeURIComponent(f10c)+"&f11c="+encodeURIComponent(f11c)+"&f12c="+encodeURIComponent(f12c)+"&f1d="+encodeURIComponent(f1d)
                +"&f2d="+encodeURIComponent(f2d)+"&f3d="+encodeURIComponent(f3d)+"&f4d="+encodeURIComponent(f4d)
                +"&f5d="+encodeURIComponent(f5d)+"&f6d="+encodeURIComponent(f6d)+"&f7d="+encodeURIComponent(f7d)+"&f8d="+encodeURIComponent(f8d)
                +"&f9d="+encodeURIComponent(f9d)+"&f10d="+encodeURIComponent(f10d)+"&f11d="+encodeURIComponent(f11d)+"&f12d="+encodeURIComponent(f12d)
                +"&f1e="+encodeURIComponent(f1e)+"&f2e="+encodeURIComponent(f2e)+"&f4e="+encodeURIComponent(f4e)
                +"&f5e="+encodeURIComponent(f5e)
        
            }
        	);
            
        x.done(function(serverResponse){

            if(serverResponse.trim()==="Records submitted successfully!")
            {
                
                swal("Successful!", "Records submitted successfully", "success"); 
                document.getElementById('create-project-form').reset(); 
 
           
            }
            else{
                swal("error", "Error Creating Project", "error"); 
//                $('#loginresponse').html(serverResponse.trim());
            }

        });

        x.fail(function(serverResponse)
        {
            alert(serverResponse);
            $('#createusersreponsemessage').html("Server error. Please try again");

        });

        x.always(function(){
           spinner.stop();
        });
        
            spinner.stop();  
            }
           
      
        });
   

   
 //add variations
 $(document).on("click", "#addvariation", function(e)
    {
     
var id=$('#variationsprojectid').html();
var dateofcreation=$('#dateofcreation').val();
var amount=$('#amount').val();
var comment=$('#comments').val();
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
var target = $('#variationstable').get(0);
var spinner = new Spinner(opts).spin(target);

        var x=$.ajax({
      type: "POST",
      url: 'php/addvariations.php',
      contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
      data: "date=" + encodeURIComponent(dateofcreation)+"&amount=" + encodeURIComponent(amount)+"&comment=" + encodeURIComponent(comment)+"&id=" + encodeURIComponent(id),
      dataType: "text"
     });
     
     x.done(function(serverResponse)
     {
         if(serverResponse.trim()=='error')
         {
         swal("Error!", "Could not add variations", "error");       
         }
         else
         {
         
         $('#variationstable').html(serverResponse.trim());
        
    }
     });
     
      x.fail(function(){
         
     });
     
     x.always(function(){
         spinner.stop();
});
        
        
        
    });//button click closes
   
   
      //show certificates
 $(document).on("click", ".cert", function(e)
    {
        
     var mytag = $(this);
var dataid=mytag.attr("data-id");
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
var target = $('#certtable').get(0);
var spinner = new Spinner(opts).spin(target);

        var x=$.ajax({
      type: "POST",
      url: 'php/certifications.php',
      contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
      data: "projectid=" + encodeURIComponent(dataid),
      dataType: "text"
     });
     
     x.done(function(serverResponse)
     {
         $('#certificateprojectid').html(dataid);
         $('#certtable').html(serverResponse.trim());
         var buttonlink='http://localhost:82/edpms/certificates.php?id='+dataid;
         $('#addcertbutton').attr("href",buttonlink);
        $('#certificatesmodal').modal('show');
        
     });
     
      x.fail(function(){
         
     });
     
     x.always(function(){
         spinner.stop();
});
        
        
        
    });//button click closes
   
 //approve certificate
 $(document).on("click", ".approve", function(e)
    {
          var mytag = $(this);
var id=mytag.attr("data-id");
var projectid=$('#certificateprojectid').html();



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
var target = $('#certtable').get(0);
var spinner = new Spinner(opts).spin(target);

        var x=$.ajax({
      type: "POST",
      url: 'php/approvecertificate.php',
      contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
      data: "id=" + encodeURIComponent(id)+"&projectid=" + encodeURIComponent(projectid),
      dataType: "text"
     });
     
     x.done(function(serverResponse)
     {
         if(serverResponse.trim()==='error')
         {
         swal("Error!", "Could not approve certifcate", "error");       
         }
         else if(serverResponse.trim()==='approved')
         {
             
             swal("Error!", "Certificate has been approved already", "error");  
         }
         else if(serverResponse.trim()==='paid')
         {
             swal("Error!", "Certificate has been paid already", "error");  
         }
         else
         {
         
         $('#certtable').html(serverResponse.trim());
        
    }
     });
     
      x.fail(function(){
         
     });
     
     x.always(function(){
         spinner.stop();
});
        
        
        
    });//button click closes
   
    //paid a certificate
 $(document).on("click", ".paid", function(e)
    {
          var mytag = $(this);
var id=mytag.attr("data-id");
var projectid=$('#certificateprojectid').html();


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
var target = $('#certtable').get(0);
var spinner = new Spinner(opts).spin(target);

        var x=$.ajax({
      type: "POST",
      url: 'php/paidcertificate.php',
      contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
      data: "id=" + encodeURIComponent(id)+"&projectid=" + encodeURIComponent(projectid),
      dataType: "text"
     });
     
     x.done(function(serverResponse)
     {
         if(serverResponse.trim()=='error')
         {
         swal("Error!", "Could not approve certifcate", "error");       
         }
         else if(serverResponse.trim()=='paid')
         {
             swal("Error!", "Certificate has been paid already", "error");  
         }
         else if(serverResponse.trim()=='issued')
         {
             swal("Error!", "Certificate has not been paid", "error");  
         }
         else
         {
         
         $('#certtable').html(serverResponse.trim());
        
    }
     });
     
      x.fail(function(){
         
     });
     
     x.always(function(){
         spinner.stop();
});
        
        
        
    });//button click closes
   
    
    //add certificate
     
 $(document).on("click", "#addcert", function(event)
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
var target = $('#certform').get(0);
var spinner = new Spinner(opts).spin(target);

  
        
       
        
       var projectid=$('#projectid').val();
//        var certno=$('#certno').val();
//        var amount=$('#amount').val();
//        var dateissued=$('#dateissued').val();
//        var status=$('#status').val();
            
        var x=$.ajax({
      type: "POST",
      url: 'php/addcertificate.php',
      contentType: false,
      data: new FormData($('#certform').get(0)),
      dataType: "text",
      processData: false
     });
     
     x.done(function(serverResponse)
     {
         servervalue=serverResponse.trim();
         if(servervalue=='no image')
         {
swal("Error!", "No photo uploaded", "error");  
         }
         else if(servervalue=='successful')
         {
swal("Certificate Uploaded", "Certificate uploaded successfully", "success"); 
$('#certform').get(0).reset();
         }
         else
         {
           swal("Error!", "An error occured while uploading certificate", "error");   
         }
        
        
     });
     
      x.fail(function(){
        // $('#responsemessage').html("Server Error. Please try again");
     });
     
     x.always(function(){
         spinner.stop();
});
        
     
    });//button click closes
   
     
     //show certificate image
      //approve certificate
 $(document).on("click", ".certno", function(e)
    {
          var mytag = $(this);
var id=mytag.attr("data-certid");
//var projectid=$('#certificateprojectid').html();

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
var target = $('#certtable').get(0);
var spinner = new Spinner(opts).spin(target);

        var x=$.ajax({
      type: "POST",
      url: 'php/displaycertificate.php',
      contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
      data: "id=" + encodeURIComponent(id),
      dataType: "text"
     });
     
     x.done(function(serverResponse)
     {
         var link="php/"+serverResponse.trim();
     $('#certphoto').attr("src",link);
     $('#certphoto').show(400);
     $('#back').show(400);
     
     });
     
      x.fail(function(){
         
     });
     
     x.always(function(){
         spinner.stop();
});
        
        
        
    });//button click closes
   
   
   //hide certificate photo
    $(document).on("click", "#back", function(e)
    {
     
     
     $('#certphoto').hide(400);
     $('#back').hide(400);
     
     
});
        
        
        
   
   
});//document.ready closes


 
