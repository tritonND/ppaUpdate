<?php
header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
header("Pragma: no-cache"); // HTTP 1.0.
header("Expires: 0"); 
@session_destroy();
?>

<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>EDPMS | EDPMS</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <link href="css/sweetalert.css" rel="stylesheet">
        <style>
           
        .content{
                background-image:url("images/bg1.png");
                background-repeat: no-repeat;
                background-position: center;
                background-size: 100%;
                height: 250px;
            }
            .tag,.padding{
                display: block;
                text-align: center;
                margin:auto;
                font-family: monospace;
                padding: 1.5em;
                font-size: 1.5em;
            }
           #btn, #btn1, #btn2{
                display: block;
                box-shadow: inset 1px 1px 20px darkgreen;
                background: #7DB11A;
                border:none;
            }
            #btn:hover,#btn1:hover, #btn2:hover{
                background: #7DB44A;
                box-shadow: none;
                color:yellow;
            }
            .grey{
                font-family: sans-serif;
                font-size: .8em;
                color: #888888;
                font-style: italic;
            }
            .head{
                background-image:url("images/bgbt.jpg"); 
                background-position: bottom;
                background-repeat: repeat-x;
                padding: 2em;
            }
            .coa{
                height: 6.5em;
                width: 8em;
            }
            .map{
                display: block;
                position: relative;
                float: right;
               height:6em;
               width:6em;
            }
            .project, .contractors, .reports{
                height:auto; 
                width: 100%; 
                border:.2px dotted #888888; 
                padding:5px; 
                vertical-align: middle; 
                background: #a1d9f2; 
                border-radius: 2px;
            }
            .views{
                height:120px; 
                border:.2px solid #888888; 
                border-radius: 2px; 
                padding: 10px; 
                box-shadow: 1px 1px 5px #adadad;
                margin-right: 5px;
                font-size:.8em;
                font-style: normal;
                font-weight: 600;
            }
            .header {

                background: red; /* For browsers that do not support gradients */    
                background: -webkit-linear-gradient(left top, #7DB44A, yellow); /* For Information, Communication Technology Agency 5.1 to 6.0 */
                background: -o-linear-gradient(bottom right, red, yellow); /* For Ministry of Health 11.1 to 12.0 */
                background: -moz-linear-gradient(bottom right, red, yellow); /* For Ministry of Housing and Urban Development 3.6 to 15 */
                background: linear-gradient(to bottom right, #7DB44A, #7DB11A); /* Standard syntax (must be last) */
                color:white; 
                border-radius: 4px 4px 0 0;
                box-shadow: inset 1px 1px 20px darkgreen;
            }
             .header_contractor {
                background: red; /* For browsers that do not support gradients */    
                background: -webkit-linear-gradient(left top, #7DB44A, yellow); /* For Information, Communication Technology Agency 5.1 to 6.0 */
                background: -o-linear-gradient(bottom right, red, yellow); /* For Ministry of Health 11.1 to 12.0 */
                background: -moz-linear-gradient(bottom right, red, yellow); /* For Ministry of Housing and Urban Development 3.6 to 15 */
                background: linear-gradient(to bottom right, #1b6d85, buttonface); /* Standard syntax (must be last) */
                color:white; 
                border-radius: 4px 4px 0 0;
                box-shadow: inset 1px 1px 20px darkgreen;
            }
            .header_reports {
                background: red; /* For browsers that do not support gradients */    
                background: -webkit-linear-gradient(left top, #7DB44A, yellow); /* For Information, Communication Technology Agency 5.1 to 6.0 */
                background: -o-linear-gradient(bottom right, red, yellow); /* For Ministry of Health 11.1 to 12.0 */
                background: -moz-linear-gradient(bottom right, red, yellow); /* For Ministry of Housing and Urban Development 3.6 to 15 */
                background: linear-gradient(to bottom right, purple, window); /* Standard syntax (must be last) */
                color:white; 
                border-radius: 4px 4px 0 0;
                box-shadow: inset 1px 1px 20px darkgreen;
            }
            .divider{
                margin:0 -4.5% 0 -1%;
            }
            .arrow{
                display: block; 
                height:30px; 
                width: auto; 
                margin-top: 70%;
            }
            #datalist
            {
                width:40%;
            }
            #proceedbutton
            {
                margin-left:20%
            }
             @media (max-width: 770px) {
            .hiddenformobile
            {
                display:none;
            }
            
            #loginbut
            {
                float:right;
            }
            #datalist
            {
                width:100%;
            }
            #proceedbutton
            {
                margin-left:40%
            }
            }
        </style>
        
        
    </head>
    <body> 
       
        <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog" style="margin-top:10%;">
      <div class="modal-dialog modal-sm">
          <div class="modal-content" style="background:none;">
          <div class="modal-header modal_title" style="background-color: rgba(0,128,0, .5)">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h6 class="modal-title" style="font-size:1.2em; color:white; ">WELCOME: User system login</h6>
        </div>
              <div class="modal-body" style="background-color: rgba(255,255,255, .7)">
          <form id="loginform">
    <div class="form-group">
      <label for="email">Email:</label>
      <input type="email" class="form-control" id="email" placeholder="Enter email">
    </div>
    <div class="form-group">
      <label for="pwd">Password:</label>
      <input type="password" class="form-control" id="pwd" placeholder="Enter password">
    </div>
              
    <button id="loginbutton" type="button" class="btn btn-success">Submit</button>
  </form>
        </div>
<!--        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>-->
      </div>
    </div>
  </div>
       
        <!--modal to create new project-->
        <!-- Modal -->
  <div class="modal fade" id="createModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
          <div class="modal-header header text-center">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h5 class="modal-title">Choose An MDA</h5>
        </div>
        <div class="modal-body">
          <!--create-contract-modal contents here-->
          <div class="container">
<!--              form here-->

    	<form action="demo_form.asp" method="get">
            
        <input id="datalist" class="datalist" list="browsers" name="browser" type="text" autofocus >
    <datalist id="browsers">  
      <option value="Ministry of Agriculture">Ministry of Agriculture</option>
      <option value="Ministry of Housing and Urban Development">Ministry of Housing and Urban Development</option>
      <option value="Ministry of Education">Ministry of Education</option>
      <option value="Ministry of Health">Ministry of Health</option>
      <option value="Information, Communication Technology Agency">Information, Communication Technology Agency</option>
    </datalist>
    </form>
    <br>

    <button id="proceedbutton" class="btn btn-success">Proceed</button>
    

          </div>
          <!--create-contract-modal contents here-->
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  
       
        <div class="container"> 
            <div class="row head">
                <div class="col-xs-2">
                    <img alt="Coat of Arms" src="images/coat_of_arms.png" class="coa hiddenformobilej">
                </div>
                <div class="col-xs-6">
                    <!--<img alt="prgress" src="images/bg.png">-->
<!--                    <h1 style="margin-bottom:-.5em; font-weight: 600;">EDPMS</h1><hr><span style="display:block; margin-top:-1em; font-weight: 600; font-size: 1.4em; color:#888888;">EDO STATE PROJECT MONITORING SYSTEM</span>-->
       <div style="margin-left:100px; color:#888888;font-weight:bold;font-size:1.4em;">EDO STATE PROJECT MONITORING SYSTEM</div>

                </div>
                <div class="col-xs-4">
                    <button id="loginbut" type="button" class="btn btn-link" data-toggle="modal" data-target="#myModal" style="color:rgba(0,128,0,.5);">Login</button>
                    <img alt="Edo state map" src="images/Edo_state_map.jpg" class="map hiddenformobile">
                </div>
            </div>
            <br><br>
            <div class="row hiddenformobile">
                <div class="col-sm-12" style="display:block; height: 150px; background-image:url(images/image.png); background-size: auto; background-repeat: no-repeat; background-position: center;">
                </div>
            
                
            </div>
            <div class="row content">
                <div class="col-sm-4 padding">
                    <p>
                        <button type="button" id="btn" class="btn btn-primary active btn-block" data-toggle="modal" data-target="#myModal"><span class="tag">Projects</span></button>
                    </p>
                    <p class="grey">Register all state projects On this platform.</p>
                </div>
                <div class="col-sm-4 padding">
                    <p>
                       <button type="button" id="btn1" class="btn btn-primary active btn-block" data-toggle="modal" data-target="#myModal"><span class="tag">Contractors</span></button>
                    </p>
                     <p class="grey">Get access to contractors and consultants directory.</p>
                </div>
                <div class="col-sm-4 padding">
                    <p>
                       <button type="button" id="btn2" class="btn btn-primary active btn-block" data-toggle="modal" data-target="#myModal"><span class="tag">Reports</span></button>
                    </p>
                     <p class="grey">View reports on all state projects here.</p>
                </div>
            </div>
        </div>
        <script>
$(document).ready(function(){
    // Show the Modal on load
    $("#myModal").modal("show");
    });
</script>
  <script src="js/spin.min.js"></script>
    <script src="js/sweetalert.min.js"></script>
    <script src="myjs/login.js"></script>
    
    </body>
</html>
