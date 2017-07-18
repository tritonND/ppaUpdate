//javascript for login and forgot password functions on login.php page
$(document).ready(function()
{
    //login code
    $(document).on("click", "#loginbutton", function(event)
    {


        //starts spinner for the other form

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
            , left: '55%' // Left position relative to parent
            , shadow: false // Whether to render a shadow
            , hwaccel: false // Whether to use hardware acceleration
            , position: 'absolute' // Element positioning
        }

        var target = $('#loginform').get(0);
        var spinner = new Spinner(opts).spin(target);




        var email=$('#email').val();
        var password=$('#pwd').val();
        var x=$.ajax({
            type: "POST",
            url: 'php/login.php',
            contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
            data: "email=" + encodeURIComponent(email)+"&password=" + encodeURIComponent(password),
            dataType: "text"
        });

        x.done(function(serverResponse)
        {

            var servervalue=serverResponse.trim();

            if(servervalue.indexOf("dashboard")!=-1)
            {

                location.href="/edpms/dashboard.php" ;

            }

            else
            {

                location.href="/edpms/create-project.php" ;

            }






            if(servervalue=='governor')
            {

                location.href="/edpms/dashboard.php" ;

            }
            else  if(servervalue=='director')
            {

                location.href="/edpms/dashboard.php" ;

            }
            else  if(servervalue=='staff')
            {

                location.href="/edpms/create-project.php" ;

            }
            else{
                swal("Error!", "Error logging in "+servervalue, "error");
            }
        });

        x.fail(function(){
            swal("Error!", "Server could not process your request", "error");
        });

        x.always(function(){
            spinner.stop();
        });




    });//button click closes



    //forgot password link click, to swap to the forgot password div block
    $(document).on("click", "#forgotpasswordlink", function(event)
    {


        $('#forgotpasswordmodal').modal("show");
        $('#loginmodal').modal("hide");


    });//button click closes


    //forgot password code modal
    $(document).on("click", "#forgotpasswordbutton", function(event)
    {
        // check validity first
        if((document.getElementById('forgotpasswordemail').validity.valid))
        {

            //starts spinner for the other form

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
                , left: '55%' // Left position relative to parent
                , shadow: false // Whether to render a shadow
                , hwaccel: false // Whether to use hardware acceleration
                , position: 'absolute' // Element positioning
            }

            var target = $('#forgotpasswordform').get(0);
            var spinner = new Spinner(opts).spin(target);



            var email=$('#forgotpasswordemail').val();

            if(email=="")
            {

                swal("Error!", "Type in your email", "error");
            }
            else{

                var x=$.ajax({
                    type: "POST",
                    url: 'php/forgotpassword.php',
                    contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
                    data: "email=" + encodeURIComponent(email),
                    dataType: "text"
                });

                x.done(function(serverResponse)
                {
                    var servervalue=serverResponse.trim();

                    if(servervalue=='successful')
                    {
                        $('#forgotpasswordmodal').modal("hide");
                        swal("Password Recovery", "An email has been sent to you. Please follow the email to recover your password", "success");
                    }
                    else{

                        $('#forgotpasswordmessage').show(500);
                        $('#forgotpasswordmessage').html(servervalue);
                    }
                });

                x.fail(function(){
                    swal("Error!", "Server could not process your request", "error");
                });

                x.always(function(){
                    spinner.stop();
                });
            }// end of if for validity check

        }
        else
        {
            $('#forgotpasswordmessage').html("Email is not valid");
            $('#forgotpasswordmessage').show(400);
        }
    });//button click closes


    //reset password code

    $(document).on("click", "#resetpassworddbutton", function(event)
    {
        // check validity first
        var password1=$('#password1').val();
        var password2=$('#password2').val();

        if((document.getElementById('password1').validity.valid)&&(document.getElementById('password2').validity.valid)
            &&(password1==password2) )
        {
            //starts spinner for the other form

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
                , left: '55%' // Left position relative to parent
                , shadow: false // Whether to render a shadow
                , hwaccel: false // Whether to use hardware acceleration
                , position: 'absolute' // Element positioning
            }

            var target = $('#contact-form').get(0);
            var spinner = new Spinner(opts).spin(target);





            if(password1==""||password2=="")
            {
                $('#resetpassworderrormsg').html("Password cannot be empty.")
                $('#resetpassworderror').show(500);
                spinner.stop();
            }
            else if(password1!==password2)
            {
                $('#resetpassworderrormsg').html("Passwords mismatch.")
                $('#resetpassworderror').show(500);
                spinner.stop();
            }

            else{

                var x=$.ajax({
                    type: "POST",
                    url: 'php/resetpassword.php',
                    contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
                    data: "password1=" + encodeURIComponent(password1)+"&password2=" + encodeURIComponent(password2),
                    dataType: "text"
                });

                x.done(function(serverResponse)
                {
                    if(serverResponse.trim()=='successful')
                    {
                        $('#centralcontent').hide(500);
                        $('#centralcontent2').show(500);
                        $('#forgotpasswordsuccess').show(500);

                    }
                    else{
                        $('#resetpassworderrormsg').html("Passwords reset not successful")
                        $('#resetpassworderror').show(500);
                    }
                });

                x.fail(function(){
                    $('#resetpassworderrormsg').html("Server could not process this request.")
                });

                x.always(function(){
                    spinner.stop();
                });
            }// end of if for validation
        }
    });//button click closes





});//document.ready closes



