<!DOCTYPE html>
<html "lang= en">
<head>
	<meta charset ="utf-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Help Page</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<script src="js/bootstrap.min.js"></script>

    <link href="https://fonts.googleapis.com/css?family=Montserrat:400" rel="stylesheet">
 <!--  <script src="js/bootstrap-toc.min.js"></script>
  < <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<!-- add after bootstrap.min.js 
<script src="https://cdn.rawgit.com/afeld/bootstrap-toc/v0.4.1/dist/bootstrap-toc.min.js"></script> -->
    <style>
        

    body {
    position: relative;
    -moz-box-sizing: border-box;
	-webkit-box-sizing: border-box;
	-ms-box-sizing: border-box;
  }
.nav {
		position:fixed;
		top: 32%;
		height: 68%;
		overflow-y:scroll;
		}
#main{
	top:32%;
	height: 68%;
	position: fixed;
	overflow-y:scroll;
	left: 17%;
	width: 83%;
}
#top {
				position:fixed;
				}
	

 @media (max-width: 500px) {

     #nav {
		display: inline-block;
		width: 25%;
		position:fixed;
		vertical-align: top;
	}

    </style>
    
</head>
<body data-spy="scroll" data-target="#myScrollspy" data-offset="15" style="font-family: Montserrat">
   

    <div id="top" class="navbar navbar-fixed-top" style="text-align: center;">
     <div class= "container-fluid" style="text-align: center; background-color:teal;color:#fff;height:inheret;">

    <h1 style="font-size: 100px; font-wieght:bold;font-family: agency fb;">USER MANUAL</h1>
    <br>
    <h3 style= font-family:cambria;>This user manual contains all essential information for the users to make full use of the Edo State Project Management software. This manual includes a description of the system functions and capabilities, contingencies and step-by-step procedures for system access and use.</h3>  
   </div> 
    </div>
    <br>
    

  <div class="container-fluid" style= font-family:Montserrat;>
  <div class="row">
    <nav class="col-sm-2" id="myScrollspy">
      <ul class="nav nav-pills nav-stacked">
          <br> <br>
        <!-- <li ><a href="#top">Welcome</a></li>  -->
          <li ><a href="#top1">Top</a></li>
          <li><a href="#landing">Landing page</a>
          <li> <a href="#logon">Login Page</a></li>
        <li><a href="#users">Users</a></li>
        <li><a href="#desc">Systems and Functions</a></li>
        <li><a href="#dashboard">Dashboard</a></li>
          <li><a href="#create">Create Projects</a>  <li><a href="#update">Update Progress</a></li><li><a href="#contract">Contractors/Consultants</a></li>
      <li><a href="#reports">Reports</a></li>
      <li><a href="#functions">User Functions</a></li>
    <li><a href="#createnew">Create New Users</a></li>
    <li><a href="#change">Change Password</a></li>
    <li><a href="#logout">Logout</a></li>
    <li><a href="#help">Help</a></li>
      </ul>
    </nav>
               
      <!-- main content area -->
              

  <div id="main" class="col-sm-10 fill">
      
<div id="top1">
    <br/>   <br/>   <br/>
    <!-- <h3 style= color:teal;>Landing Page</h3> -->
    <a href="dashboard.php"><input type="button" class="btn btn-primary" value="Back to Dashboard" ></a>
    <!-- <img src="img/Capture%203.PNG" class="img-thumbnail" alt="create project" width="80%" height="236"> -->
<br/>
</div>
	  
<div id="landing">
    <br/>
    <h3 style= color:teal;>Landing Page</h3>
    <img src="img/Capture%203.PNG" class="img-thumbnail" alt="create project" width="80%" height="236">
<br/>
</div>
<div id="logon">
	 <h3 style= color:teal;>Login Page</h3>
     <img src="img/Capture%202.PNG" class="img-thumbnail" alt="create project" width="80%" height="236">
    <br/>
    </div>
    <div id="dash">
    <h3 style= color:teal;>Dashboard</h3>
     <img src="img/Capture.PNG" class="img-thumbnail" alt="create project" width="80%" height="236">
    <br/>
    </div>
    
<div class="page-header">
    <h2 style= color:teal;>PURPOSE AND SCOPE</h2>
	<p style= font-family:cambria;>The Edo State public procurement agency implements this software to handle state projects documentation and monitoring of project report. When new contractors are assigned a project staff users upload their projects progress alongside photos to the database that could allow associated DAs to access and monitor their projects.</p>
</div>
    <br/>
    
<div id= "users" class="page-header">
    <h2 style= color:teal;>USERS</h2>
	<p style= font-family:cambria;>Aside from the administrators, this software also admits three tiers of users;</p> 
	<dl>
        <dt style=color:teal;>The Governor:</dt>
	<dd>-This user has full access to all MDA reports and dashboard.</dd>
	<dt style=color:teal;>The Director:</dt>
	<dd >-These users has access to reports related to their MDA projects.</dd>
	<dt style=color:teal;>The MDA staff users:</dt>
	<dd>-They are in charge of creating projects and updating contractors
	and consultants lists. They have no access to project reports.</dd> 
	</dl>
    </div>
    <br/>
    <div id="desc">
    	
    <div class="page-header">
    <h2 style= color:teal;>DESCRIPTION OF SYSTEM FUNCTIONS</h2>
	<p>In this section we would describe all system functions on the portal. Each user has their own privileges and duties;</p>
</div>
    <div id="dashboard">
    <h4 style= color:teal;>DASHBOARD</h4>
<p>This section provides projects summary.</p>
    <h4 style= color:teal;>DETAILED DESCRIPTION OF FUNCTION</h4>
<p>The dashboard section provides access to the summary of all projects reports. Its major functions include:</p>

    <img src="img/jj.jpg" class="img-thumbnail" alt="create project" width="80%" height="236">
    
    <br/>
    
<ul>
<li>Here you can query the database to search for a project from a particular year</li>
<li>View of total completed and ongoing projects and Funds disbursed</li> 
<li>Get a summary of all reports from MDAs, contractors, consultants, LGAs etc.</li> 
<li>Project locations</li>
    
</ul>
<br/>
    </div>
    <div id="projects">
 <div class="page-header">
    <h2 style= color:teal;>PROJECTS</h2>
	<p>This section allows a staff user create and update projects and project progress.</p>
</div>	

    <h4 style= color:teal;>DETAILED DESCRIPTION OF FUNCTION</h4>
<p>The project section provides access to the following functions:</p>
   <div id="create">
    <h4 style= color:teal;>1.	CREATE PROJECT:</h4>
<p>Here you are required to provide the details of the new projects, contractor and consultant involved, the project location, budget and a few more details.</p>
<p style= font-weight:bold;>NOTE: All fields are required.</p>

<img src="img/Projects1.PNG" class="img-thumbnail" alt="create project" width="80%" height="236"> 
    
    <br/>
    
    <ul>
    <li>Click on projects</li>
    <li>Then click on "create a project".</li><li>After completing the required fields on this page click next to enter project details.</li>
    <li>You could also click previous to return to the previous page and finish to submit enttry.</li>
    </ul>

    <br/>
    
    <h4 style= color:teal;>Create a Project (page two)</h4>
    <img src="img/projects2.PNG" class="img-thumbnail" alt="create project" width="80%" height="236">
    <br/>
    
    <h4 style= color:teal;>Create a Project (page three)</h4>
    <img src="img/projects3.PNG" class="img-thumbnail" alt="create project" width="80%" height="236">
    <br/>
    
    <h4 style= color:teal;>Create a Project (page four)</h4>
    <img src="img/projects4.PNG" class="img-thumbnail" alt="create project" width="80%" height="236">
    <br/>
    <br/>
    </div>
    
    <div id="update">
     <h4 style= color:teal;>2.	UPDATE PROJECT:</h4>
<p>Here you can update the information of any project on the list if there is a change or an error or to show that the project has completed. </p>
    
   <img src="img/pup.PNG" class="img-thumbnail" alt="create project" width="80%" height="236">
    <br/>
    
     <h4 style= color:teal;>3.	UPDATE PROJECT PROGRESS:</h4>
<p>Here you can update project progress and also indicate if project have been completed with project Id. You can also upload photos from project site.</p>
    
   <img src="img/progress.PNG" class="img-thumbnail" alt="create project" width="80%" height="236">
    
    <br/>
    </div>
    </div>
    <div id="contract">
    <h4 style= color:teal;>4.	CONTRACTORS/CONSULTANTS:</h4>
<p>This section allows a staff user to create new contractor or consultant information in other to assign them to projects.</p>
    
   <img src="img/contract.PNG" class="img-thumbnail" alt="create project" width="80%" height="236">
    
    <br/>
    
    <h4 style= color:teal;>4. I.  CONTRACTORS/CONSULTANTS DIRECTORY</h4>
<p>Provides a list view of registered contractors and consultants.</p> 
    <br/>
    <h4 style= color:teal;>Contractor Directory</h4>
    <img src="img/cd.PNG" class="img-thumbnail" alt="create project" width="80%" height="236">
    
    <br/>
    
    <h4 style= color:teal;>Consultant Directory</h4>
    <img src="img/cs.PNG" class="img-thumbnail" alt="create project" width="80%" height="236">
    
    <br/>
</div>
<div id="reports">    
    <h4 style= color:teal;>5.	REPORTS:</h4>
<p>This section provides detailed reports of all project and their progress across all LGAs and MDAs.</p>
    
   <img src="img/reports.PNG" class="img-thumbnail" alt="create project" width="80%" height="236">
    
    <br/>
<ul>
    <li>Here, just as in the dashboard section, you could query the database using the year and get list of projects for that year.</li>
    <li>You could search the database for projects through the search bar using the project Id, MDA, Project title, Description, LGA.</li>
    <li>You can always hit the “back to summary” button whenever you are done with your search to return to the summary page.</li>
    </ul>
<br/>
    <p>You could also perform other tasks in this section. They include:</p>
    
    <ol>
    
        <li><span style="color:teal;">View reports via LGA:</span> get reports from particular LGAs</li>
        <li><span style="color:teal;">View project sum per MDA:</span> total projects per MDA</li>
        <li><span style="color:teal;">View projects per MDA:</span> view list of projects from a particular MDA</li>
        <li><span style="color:teal;">View project sum per LGA:</span> total projects per LGA</li>
        <li><span style="color:teal;">View project status:</span> find out progress of ongoing projects and identify those that are completed</li>
        <li><span style="color:teal;">View projects by maps:</span> view a project’s location on map</li>
        
    </ol>
<br/>
</div>

<div id="functions">
    <div class="page-header">
<h4 style= color:teal;>USERS AND FUNCTIONS</h4>
<p>This section provides a table of users and their privileges.</p>

  <table class="table table-bordered">
    <thead>
      <tr>
        <th style= color:teal;>USER</th>
        <th style= color:teal;>DESCRIPTION</th>
        <th style= color:teal;>FUNCTION</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>Administrator</td>
        <td>These are the system administrators<br> that operate and maintain the software.</td>
        <td>
        <ul>
            <li>They create new user accounts.</li>
            <li>They add new functionalities to the software.</li>
            <li>They handle any errors encountered in the <br/>course of using this software.</li></ul></td>
      </tr>
      <tr>
        <td>MDA Staff User</td>
        <td>These are staffs of PPA that are in<br> charge of managing project details.<br> They have no permission to view reports.</td>
        <td><ul><li>They handle the creation and monitoring of projects, contractors and<br> consultants data.</li></ul></td>
      </tr>
      <tr>
        <td>Director</td>
          <td>These includes Commissioners and Directors.<br> The directors and commissioners only have<br> access to project information relating<br> to their agencies/ministries</td>
        <td><ul><li>They logon to view project progress and details</li></ul></td>
      </tr>
        
      <tr>
        <td>Governor</td>
        <td>The governor has access to view all projects<br> reports and budget details</td>
        <td><ul><li>This user has full access to all MDA reports and dashboard.</li></ul></td>
      </tr>
    </tbody>
  </table>
</div>
   </div>
    <br>
    
    <div id="createnew">
  <div class="page-header">  
    <h2 style= color:teal;> CREATING NEW USERS</h2> 
<p>A staff user could request for a new user to be created by sending a form to Admin for validation and creation.</p>
    </div>
    <br>
    </div>

    <div id="change">
<div class="page-header">
    <h2 style= color:teal;>CHANGE PASSWORD</h2>
<p>After a user has been created, the user can now change his/her password to something secure and easy to remember. Passwords can be changed at any time but when you misplace your password and can’t log into your account you should contact an Admin for assistance.</p>
    <br>
    
    <img src="img/pass.PNG" class="img-thumbnail" alt="create project" width="80%" height="236">
    <br>
    
    <img src="img/pass2.PNG" class="img-thumbnail" alt="create project" width="80%" height="236">
<br>
    </div>
</div>

<div id="logout">    
    <div class="page-header">
    <h2 style= color:teal;>LOGOUT</h2>
<p>When a user is done with the software, they could hit the logout button just below the help button (see change password picture photo1) to exist their account and return to the login page.</p>
<br>
    </div>
    </div>

<div id="help">
    <div class="page-header">
    <h2 style= color:teal;>HELP</h2>
    <p>In the help section below the change password button (see change password picture photo1), you can find the user manual. Also If you require more assistance or you encounter an error while using this portal, you could request further assistance from the site administrators.</p>
    <br>
    </div>
             </div> </div>
    </div>
        </div> </div> 
    <style>
        $( '.sidebar' ).fixedsticky();
    </style>
</body>
    
</html>