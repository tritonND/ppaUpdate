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
                
        var sector=$('#sector').val();
        var subsector=$('#subsector').val();
        var budgethead=$('#budgethead').val();
        var budgetsubhead=$('#budgetsubhead').val();
        var budgetcomment=$('#budgetcomment').val();
        
// FIELDS IN APPROPRIATIONS SESSION
        var approvedappropriation=kendo.parseFloat($('#approvedappropriation').val());
        var supplementaryprovision=kendo.parseFloat($('#supplementaryprovision').val());
        var subsectorallocation=kendo.parseFloat($('#subsectorallocation').val());
        var percentagesubsectorallocation=kendo.parseFloat($('#percentagesubsectorallocation').val());
        var approvedappropriationyear=kendo.parseFloat($('#approvedappropriationyear').val());
        var supplementaryprovisionyear=kendo.parseFloat($('#supplementaryprovisionyear').val());
        
// FIELDS IN PROJECT DETAILS SESSION 
        var projectid=$('#projectid').val();
        var mda=$('#mda :selected').text();
        var projecttitle=$('#projecttitle').val();
        var projectdescription=$('#projectdescription').val();
        var dateofaward=$('#dateofaward').val();
        var projectstatus=$('#projectstatus').val();
        var remarks=$('#remarks').val();
        var projectlocation=$('#projectlocation').val();
        var lga=$('#lga').val();
        
        var expecteddateofcompletion=$('#expecteddateofcompletion').val();  
        var durationmonths=$('#durationmonths').val();
        var durationyears=$('#durationyears').val();
        var durationofcontract=durationyears+' '+durationmonths;
        
        
        
// FIELDS IN CONSUTANTTTS AND CONTRACTORS SESSION
	var contractor=$('#contractor').val();
        var consultant=$('#consultant').val();
     
        
// FIELDS IN FINANCIALS SESSION
        var contractsum=kendo.parseFloat($('#contractsum').val());
        var mobilisation=kendo.parseFloat($('#mobilisation').val());
        
        var mobilisationpaid=kendo.parseFloat($('#mobilisationpaid').val());
        
        
        
    
        
        var x = $.ajax(
            {
                
                url: 'php/submit_project.php',
                type: "post",
                dataType: "text",
                contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
                data: "sector="+encodeURIComponent(sector)+"&subsector="+encodeURIComponent(subsector)+"&budgethead="+encodeURIComponent(budgethead)+"&budgetsubhead="+encodeURIComponent(budgetsubhead)
                +"&budgetcomment="+encodeURIComponent(budgetcomment)+"&approvedappropriation="+encodeURIComponent(approvedappropriation)+"&supplementaryprovision="+encodeURIComponent(supplementaryprovision)+"&subsectorallocation="+encodeURIComponent(subsectorallocation)
                +"&percentagesubsectorallocation="+encodeURIComponent(percentagesubsectorallocation)+"&approvedappropriationyear="+encodeURIComponent(approvedappropriationyear)+"&supplementaryprovisionyear="+encodeURIComponent(supplementaryprovisionyear)+"&projectid="+encodeURIComponent(projectid)
                +"&mda="+encodeURIComponent(mda)+"&projecttitle="+encodeURIComponent(projecttitle)+"&projectdescription="+encodeURIComponent(projectdescription)+"&dateofaward="+encodeURIComponent(dateofaward)
                +"&projectstatus="+encodeURIComponent(projectstatus)+"&remarks="+encodeURIComponent(remarks)+"&projectlocation="+encodeURIComponent(projectlocation)+"&lga="+encodeURIComponent(lga)
                +"&durationofcontract="+encodeURIComponent(durationofcontract)+"&expecteddateofcompletion="+encodeURIComponent(expecteddateofcompletion)+"&contractor="+encodeURIComponent(contractor)+"&consultant="+encodeURIComponent(consultant)+"&contractsum="+encodeURIComponent(contractsum)
                +"&mobilisation="+encodeURIComponent(mobilisation)+"&mobilisationpaid="+encodeURIComponent(mobilisationpaid)
               
      
        
            }
        	);
            
        x.done(function(serverResponse){

            if(serverResponse.trim()==="exist")
            {
                
                swal("error", "Project has been registered already", "error");  
                 
 
           
            }
            else  if(serverResponse.trim()==="successful")
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
            
            $('#createusersreponsemessage').html("Server error. Please try again");

        });

        x.always(function(){
           spinner.stop();
        });
        
            spinner.stop();  
            }
           
      
        });
   
  
   //generate project id
 $(document).on("change", "#mda", function(e)
    {
     
var mda=$('#mda').val();
var mdatext=$('#mda :selected').text();

if(mda=='')
{
    //do nothing
}
else
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
var target = $(this).get(0);
var spinner = new Spinner(opts).spin(target);

        var x=$.ajax({
      type: "POST",
      url: 'php/generateprojectid.php',
     contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
      data: "mda=" + encodeURIComponent(mda)+"&mdatext=" + encodeURIComponent(mdatext),
      dataType: "text"
     });
     
     x.done(function(serverResponse)
     {
    $('#projectid').val(mda+serverResponse.trim());
     });
     
      x.fail(function(){
         
     });
     
     x.always(function(){
         spinner.stop();
});
}     
        
        
    });//button click closes
      
     //populate mda's ie subsector drop down dynamically from db sectors table
 $(document).on("change", "#sector", function(e)
    {
     $('#subsector').html('<option value="">Sub Sector</option>');//wipe off content first
     $('#mda').html('<option value="">Select MDA</option>');
var sector=$('#sector').val();
//var mdatext=$('#mda :selected').text();

if(sector=='')
{
    //do nothing
}
else
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
var target = $(this).get(0);
var spinner = new Spinner(opts).spin(target);

        var x=$.ajax({
      type: "POST",
      url: 'php/pullmdas.php',
     contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
      data: "sector=" + encodeURIComponent(sector),
      dataType: "text"
     });
     
     x.done(function(serverResponse)
     {
    $('#subsector').append(serverResponse);
    $('#mda').append(serverResponse);
     });
     
      x.fail(function(){
         
     });
     
     x.always(function(){
         spinner.stop();
});
}     
        
        
    });//button click closes
      
   
   
});//document.ready closes


 
//          sector
//        subsector
//        budgethead
//        budgetsubhead
//        budgetcomment
//        approvedappropriation
//        supplementaryprovision
//        subsectorallocation
//        percentagesubsectorallocation
//        approvedappropriationyear
//        supplementaryprovisionyear
//        projectid
//        mda
//        projecttitle
//        projectdescription
//        dateofaward
//        projectstatus
//        remarks
//        projectlocation
//        lga
//        durationofcontract
//        expecteddateofcompletion        
//           contractor
//        consultant
//           contractsum
//        mobilisation
//        mobilisationpaid