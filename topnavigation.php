<?php 
@session_start();
$firstname = $_SESSION['firstname'];
  ?>

<html lang="en">

  <head>
   <link href="https://fonts.googleapis.com/css?family=Montserrat:400" rel="stylesheet">
  </head>

  <body style="font-family: 'Montserrat', sans-serif;" >
   
<div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                      <span class="glyphicon glyphicon-user"></span> &nbsp;
					  <span>
					  <?php 
					  
                       echo $firstname;  
						   
					  ?>
					  </span>
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
<!--                    <li><a href="javascript:;"> Profile</a></li>-->
            
                    <li><a data-toggle="modal" data-target="#passwordMod">Change Password</a></li>
                      <li><a href="manual.php">Help Manual</a></li>
                    <li><a href="php/logout.php"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                  </ul>
                </li>


              </ul>
            </nav>
          </div>
        </div>
		
		
		<div class="modal fade" id="passwordMod" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
     <div class="modal-content">
        <div class="modal-header bg-primary" >
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"> Change Password</h4>
        </div>
        <div class="modal-body">
          <p></p>
		   <form class="form-horizontal" id="changepsd" role="form" >
				<div class="form-group"> 
					<label for="opass" class="col-sm-4  control-label">
						Old Password
					</label>
					<div  class="col-sm-4">
						<input type="password" class="form-control" placeholder="Old Password" id="opass" name="opass">
					</div>
				</div>
				
				<div class="form-group"> 
					<label for="npass" class="col-sm-4  control-label">
						New Password
					</label>
					<div  class="col-sm-4">
						<input type="password" class="form-control" placeholder="New Password" id="npass" name="opass">
					</div>
				</div>				
				
			</form>
			 <div id="message"> </div>
        </div>
        <div class="modal-footer">
		  <button type="button" class="btn btn-warning" data-dismiss="modal" >Close</button>
          <button type="button" class="btn btn-primary" onclick = "changePwd()">Change</button>
		  
		 
        </div>
      </div>
      
    </div>
  </div>

  
  
  <script>
	function changePwd() {	
	var opass = $('#opass').val();
	var npass = $('#npass').val();
	
	console.log(opass);
	console.log(npass);
	
   var results = $.ajax(
    {	
        url: "php/changePwd.php",
        type: "post",            
        //dataType: "text",
        timeout: 240000, // wait for 4 minutes before timeout of request
        processData: false,
         data: "opass=" + encodeURIComponent(opass) + "&npass=" + encodeURIComponent(npass)
		//data: new FormData($('#changepsd').get(0))
		//{ opass : $('#opass').val(), 
		//        npass : $('#npass').val()  }
    }
);

results.done( function(serverRes) {
	if (serverRes == "success")
	{
	  	$('#message').html("Password Change Successful");
	}
 else {
	 $('#message').html("Password Change Failed")
 }
});
	}
	</script>
		

  
  </body>
</html>