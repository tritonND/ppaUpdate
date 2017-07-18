//javascript for login and signup pages
$(document).ready(function()
{


    //signup code
    $(document).on("click", "#createusersbut", function(event)
    {

        if((document.getElementById('password1').validity.valid)&&(document.getElementById('password2').validity.valid)
        )
        {

            var firstname=$('#firstname').val();
            var othernames=$('#othernames').val();
            var username=$('#username').val();
            var password1=$('#password1').val();
            var password2=$('#password2').val();
            var usertype=$('#usertype').val();

            if(password1!==password2)
            {
                swal("Error!", "Passwords do not match!", "error");
            }
            else{
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

                var target = $('#createusersform').get(0);
                var spinner = new Spinner(opts).spin(target);


                var x=$.ajax({
                    type: "POST",
                    url: 'php/createusers.php',
                    contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
                    data: "firstname=" + encodeURIComponent(firstname)+"&othernames=" + encodeURIComponent(othernames)+"&password=" + encodeURIComponent(password1)+"&usertype="+encodeURIComponent(usertype)+"&username="+encodeURIComponent(username),
                    dataType: "text"
                });

                x.done(function(serverResponse)
                {
                    var servervalue=serverResponse.trim();

                    if(servervalue=='existing')
                    {
                        swal("Error!", "This email is already in use!", "error");
                    }

                    else
                    {
                        $('#deleteuserstable').html(serverResponse.trim());


                    }

                });

                x.fail(function(){
                    swal("Server Error!", "Server could not process this request, please try again later!", "error");

                });

                x.always(function(){
                    spinner.stop();

                });
            }
//}// end of if for validity
            //if its individual or tutor
        }
        else{
        }
        //document.getElementById("loader").style.display="none";
        //$('.signupbutton').button('reset');
    });//button click closes

    $(document).on("click", ".myBtn", function(event)
    {
        //set check boxes to false first
        $('.priv').prop('checked', false);

        //get id
        var mytag = $(this);
        var dataid=mytag.attr("data-id");

        // now start spinner

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

        var target = $(this).get(0);
        var spinner = new Spinner(opts).spin(target);

        var x=$.ajax({
            type: "POST",
            url: 'php/displayuserpriv.php',
            contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
            data: "dataid=" + encodeURIComponent(dataid),
            dataType: "text"
        });

        x.done(function(serverResponse)
        {
            var response = $.parseJSON(serverResponse);
            $('#fullname').html(response['fullname']);
            var priv=response['priv'];
            //everyone no longer has this privilege
//            $('#createproject').prop('checked', true);
            if(priv=='')
            {
                $('#updatebut').attr("data-id",dataid);
                $('#deleteusersbut').attr("data-id",dataid);
                $('#userprivilegemodal').modal('show');
                return;
            }
            if(priv.indexOf("sysadmin")!=-1)
            {
                $('.priv').prop('checked', true);
                $('#updatebut').attr("data-id",dataid);
                $('#deleteusersbut').attr("data-id",dataid);
                $('#userprivilegemodal').modal('show');
                return;
            }
            if(priv.indexOf("dashboard")!=-1)
            {
                $('#dashboard').prop('checked', true);
            }
            if(priv.indexOf("reporting")!=-1)
            {
                $('#reporting').prop('checked', true);
            }
            if(priv.indexOf("updateproject")!=-1)
            {
                $('#updateproject').prop('checked', true);
            }
            if(priv.indexOf("supervisors")!=-1)
            {
                $('#supervisors').prop('checked', true);
            }
            if(priv.indexOf("updateprogress")!=-1)
            {
                $('#updateprogress').prop('checked', true);
            }
            if(priv.indexOf("users")!=-1)
            {
                $('#users').prop('checked', true);
            }
            if(priv.indexOf("qa")!=-1)
            {
                $('#qa').prop('checked', true);
            }

            //assigning attribute to delete and update buttons and display modal

            $('#updatebut').attr("data-id",dataid);
            $('#deleteusersbut').attr("data-id",dataid);
            $('#userprivilegemodal').modal('show');




        });

        x.fail(function(){
            swal("Server Error!", "Server could not process this request, please try again later!", "error");
        });

        x.always(function(){
            spinner.stop();
        });

    });//button click closes

    $(document).on("click", "#deleteusersbut", function(event)
    {
        var mytag = $(this);
        var dataid=mytag.attr("data-id");

        swal({
                title: "Delete "+$('#fullname').html()+ '?',
                text: "Are you sure you want to delete this user!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes,delete!",
                cancelButtonText: "No, Sorry!",
                closeOnConfirm: true,
                closeOnCancel: true
            },
            function(isConfirm){
                if (isConfirm)
                {
                    //get id


                    // now start spinner

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

                    var target = $('#fullname').get(0);
                    var spinner = new Spinner(opts).spin(target);

                    var x=$.ajax({
                        type: "POST",
                        url: 'php/deleteusers.php',
                        contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
                        data: "dataid=" + encodeURIComponent(dataid),
                        dataType: "text"
                    });

                    x.done(function(serverResponse)
                    {
                        var servervalue=serverResponse.trim();
                        if(servervalue=='error')
                        {

                            swal("Error!", "An error occured, please try again later ", "error");
                        }

                        else
                        {
                            $('#deleteuserstable').html(serverResponse.trim());
                            $('#userprivilegemodal').modal('hide');

                        }


                    });

                    x.fail(function(){
                        swal("Server Error!", "Server could not process this request, please try again later!", "error");
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


    $(document).on("click", "#updatebut", function(event)
    {
        var mytag = $(this);
        var dataid=mytag.attr("data-id");


        // now start spinner

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

        var target = $(this).get(0);
        var spinner = new Spinner(opts).spin(target);

//pick all selected privileges
        var params='';
        if($('#createproject:checked').val()!==undefined)
        {
            params=params+'createproject,';
        }
        if($('#updateproject:checked').val()!==undefined)
        {
            params=params+'updateproject,';
        }
        if($('#dashboard:checked').val()!==undefined)
        {
            params=params+'dashboard,';
        }
        if($('#updateprogress:checked').val()!==undefined)
        {
            params=params+'updateprogress,';
        }
        if($('#supervisors:checked').val()!==undefined)
        {
            params=params+'supervisors,';
        }
        if($('#users:checked').val()!==undefined)
        {
            params=params+'users,';
        }
         if($('#qa:checked').val()!==undefined)
        {
            params=params+'qa,';
        }
        if($('#reporting:checked').val()!==undefined)
        {
            params=params+'reporting,';
        }
        if($('#sysadmin:checked').val()!==undefined)
        {
            params=params+'sysadmin,';
        }
        //call ajax
        var x=$.ajax({
            type: "POST",
            url: 'php/updateprivileges.php',
            contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
            data: "priv=" + encodeURIComponent(params)+"&dataid=" + encodeURIComponent(dataid),
            dataType: "text"
        });

        x.done(function(serverResponse)
        {
            if(serverResponse.trim()=='successful')
            {
                swal("Successful!", "User privileges updated successfully", "success");
                $('#userprivilegemodal').modal('hide');

            }
            else
            {
                swal("Error!", "An error occured, please try again later!", "error");
            }



        });

        x.fail(function(){
            swal("Server Error!", "Server could not process this request, please try again later!", "error");
        });

        x.always(function(){
            spinner.stop();
        });

    });//button click closes


});//document.ready closes


 