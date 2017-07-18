//javascript for login and forgot password functions on login.php page
$(document).ready(function()
{



    //show variations
    $(document).on("click", ".variations", function(e)
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
        var target = $('#variationstable').get(0);
        var spinner = new Spinner(opts).spin(target);

        var x=$.ajax({
            type: "POST",
            url: 'php/variations.php',
            contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
            data: "projectid=" + encodeURIComponent(dataid),
            dataType: "text"
        });

        x.done(function(serverResponse)
        {
            $('#variationsprojectid').html(dataid);
            $('#projectidtextinput').val(dataid);
            $('#variationstable').html(serverResponse.trim());
            $('#variationsmodal').modal('show');

        });

        x.fail(function(){

        });

        x.always(function(){
            spinner.stop();
        });



    });//button click closes

    //add variations
    $(document).on("click", "#addvariation", function(e)
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
        var target = $('#variationstable').get(0);
        var spinner = new Spinner(opts).spin(target);

        var x=$.ajax({
            type: "POST",
            url: 'php/addvariations.php',
            contentType: false,
            data: new FormData($('#variationsform').get(0)),
            dataType: "text",
            processData: false
        });

        x.done(function(serverResponse)
        {
            if(serverResponse.trim()=='error')
            {
                swal("Error!", "Could not add variations", "error");
            }
            else if(serverResponse.trim()=='no image')
            {
                swal("Error!", "Please upload certificate of variations", "error");
            }
            else
            {

                $('#variationstable').html(serverResponse.trim());
                $('#variationsform').get(0).reset();

                $('#covphotopreview').hide(400);
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
            var buttonlink='/edpms/certificates.php?id='+dataid;
           // var buttonlink='http://localhost:82/edpms/certificates.php?id='+dataid;
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

        swal({
                title: "Approve Certificate?",
                text: "Are you sure you want to approve this certificate?",
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



                    //now go ahead

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

                } else
                {
                    // log out cancelled
                }
            });


    });//button click closes

    //paid a certificate
    $(document).on("click", ".paid", function(e)
    {
        var mytag = $(this);
        var id=mytag.attr("data-id");
        var projectid=$('#certificateprojectid').html();
        
        swal({
  title: "Oracle Number",
  text: "Enter Oracle Voucher Number",
  type: "input",
  showCancelButton: true,
  closeOnConfirm: true,
  animation: "slide-from-top",
  inputPlaceholder: "",
  showLoaderOnConfirm: true
},
function(inputValue){
  if (inputValue === false) return false;
  
  if (inputValue === "") {
    swal.showInputError("Please write oracle number or Nill if not available");
    return false
  }
  
   var x=$.ajax({
                        url: 'php/paidcertificate.php',
                        contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
                        data: "id=" + encodeURIComponent(id)+"&projectid=" + encodeURIComponent(projectid)+"&voucher=" + encodeURIComponent(inputValue),
                        dataType: "text",
                        cache: false
                    });

                    x.done(function(serverResponse)
                    {
                        if(serverResponse.trim()=='error')
                        {
                            swal("Error!", "Could not approve certifcate", "error");
                        }
                       
                        else
                        {

                            $('#certtable').html(serverResponse.trim());
//swal("Action Successful", "Certificate successfully updated ", "success");
                        }
                    });

                    x.fail(function(){

                    });

                    x.always(function(){
                        //spinner.stop();
                    });
  
  //swal("Action Successful", "Certificate successfully updated ", "success");
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
            else if(servervalue=='exist')
            {
                swal("Error!", "Certificate already exist please", "error");
            }
            else if(servervalue=='successful')
            {
                swal("Certificate Uploaded", "Certificate uploaded successfully", "success");
                $('#certform').get(0).reset();
                $('#assoc_passport1').css("display","none");
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
             var response = $.parseJSON(serverResponse);
            //$('#fullname').html(response['fullname']);
            
            var link="php/"+response['url'];
            $('#oraclenumber').html(response['oracle']);
            $('#certphoto').attr("src",link);
            $('#certphoto').show(400);
            $('#back').show(400);
            $('#oraclenumber').show(500);

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
        $('#oraclenumber').hide(500);


    });

    //show certificate of variation, cov image

    $(document).on("click", ".vars", function(e)
    {
        var mytag = $(this);
        var id=mytag.attr("data-id");
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
        var target = $(this).get(0);
        var spinner = new Spinner(opts).spin(target);

        var x=$.ajax({
            type: "POST",
            url: 'php/displaycov.php',
            contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
            data: "id=" + encodeURIComponent(id),
            dataType: "text"
        });

        x.done(function(serverResponse)
        {
            var link="php/"+serverResponse.trim();
            $('#covphoto').attr("src",link);
            $('#covphotopreview').show(400);


        });

        x.fail(function(){

        });

        x.always(function(){
            spinner.stop();
        });



    });//button click closes


    //hide certificate photo
    $(document).on("click", "#covback", function(e)
    {


        $('#covphotopreview').hide(400);



    });



//edit or delete project
    $(document).on("change", ".chooseaction", function(e)
    {

        console.log("clicked change");
        var mytag = $(this);
        //var id=mytag.attr("data-id");
        var id= $("option:selected", mytag).attr("data-id");
        console.log(id);

        var action=(mytag).val();
        console.log(action);
//alert('id is'+id+' while action is'+action);

        if(action=='Edit')
        {
            location.href="/edpms/edit-project.php?projectid="+id;
        }
        else if(action=='Delete')
        {

        }
        else
        {

        }




    });//button click closes

});//document.ready closes


