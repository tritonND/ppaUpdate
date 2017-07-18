<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Create Projects</title>
<meta charset="UTF-8"></meta>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"></meta>
            <link href="css/bootstrap.min.css" rel="stylesheet"></link>
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <style>
            .title{
                background: #245269;
                padding: .5em;
                color: white;
                font-weight: 600;
                border-radius:5px;
            }
            .btn, label{
                margin-top: 1em;
            }
            .caret{
                float:right; 
                margin-top:.5em;
            }
            .datalist{
                margin: .5em;
            }
        </style>
</head>

    <body>
        <div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="row">
                <div class="col-sm-12">
                    <h5 class="title">BUDGET FORM</h5>
                </div>
            </div>
            <div class="row">
                <form>
  <div class="form-group">
  <select style="display:inline; width: 60%; position: relative; float: left;" id="position" class="form-control datalist" name="position" >
    <option value="">Select a Ministry</option>
    <option value="Commissioner">Agriculture</option>
    <option value="Special Adviser">Education</option>
    <option value="Senior Special Assistant">Economic</option>
    <option value="Special Assistant">Security</option>
    <!--<span ><option value="Check">Check</span></option>-->                          
          </select>
  </div>

    <select style="display:inline; width: 60%; position: relative; float: left;" id="position" class="form-control datalist" name="position" >
    <option value="">Select a Ministry</option>
    <option value="Commissioner">Fishery</option>
    <option value="Special Adviser">Primary Education</option>
    <option value="Senior Special Assistant">Traders</option>
    <option value="Special Assistant">Civil Defense</option>
    <!--<span ><option value="Check">Check</span></option>-->                          
          </select>          
      
    
    <div class="form-group">
    <label for="head">Budget Head:</label>
    <input type="text" class="form-control" id="head">
    </div>
    <div class="form-group">
    <label for="subhead">Budget Sub-head:</label>
    <input type="text" class="form-control" id="subhead">
    </div>
    <div class="form-group">
    <label for="comment">Budget Comment:</label>
    <input type="text" class="form-control" id="comment">
    </div>
  
  <button type="submit" class="btn btn-default">Submit</button>
</form>
        </div>
            
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="col-sm-12">
            <div class="row">
                <div class="col-sm-12">
                    <h5 class="title">APPROPRIATIONS</h5>
                </div>
                <div class="row">
                <div class="col-sm-3">
                    <div class="form-group">
    <label for="subhead">Approved Appropriation N:</label>
    <input type="text" class="form-control" id="approved_approp">
    </div>
                <div class="form-group">
    <label for="subhead">Supplementary Provision N:</label>
    <input type="text" class="form-control" id="subhead">
    </div>
                </div>
                    <div class="col-sm-6">
                    <div class="form-group">
    <label for="subhead">Sub-sector Allocation N:</label>
    <input type="text" class="form-control" id="subhead">
    </div>
                <div class="form-group">
    <label for="subhead">% of Sub-sector Allocation:</label>
    <input type="text" class="form-control" id="subhead">
    </div>
    </div>
                    <div class="col-sm-3">
                    <div class="form-group">
    <select style="display:inline; width: 60%; position: relative; float: left; margin-top: 3em;" id="position" class="form-control datalist" name="position" >
    <option value="">AA YEAR</option>
    <option value="Commissioner">1999</option>
    <option value="Special Adviser">2000</option>
    <option value="Senior Special Assistant">2001</option>
    <option value="Special Assistant">2002</option>
    <!--<span ><option value="Check">Check</span></option>-->                          
          </select> 
    </div>
                <div class="form-group">
    <select style="display:inline; width: 60%; position: relative; float: left;" id="position" class="form-control datalist" name="position" >
    <option value="">SP YEAR</option>
    <option value="Commissioner">1999</option>
    <option value="Special Adviser">2000</option>
    <option value="Senior Special Assistant">2001</option>
    <option value="Special Assistant">2002</option>
    <!--<span ><option value="Check">Check</span></option>-->                          
          </select> 
    </div>
    </div>
                </div>
            </div>
                <div class="row">
                    <div class="row">
                         <div class="col-sm-12">
                    <h5 class="title">PROJECT</h5>
                </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
    <label for="subhead">Project Id:</label>
    <input type="text" class="form-control" id="subhead">
                        </div>
                            <div class="form-group">
    <label for="subhead">Procuring Entity:</label>
    <input type="text" class="form-control" id="subhead">
    </div>
                            <div class="form-group">
    <label for="subhead">Project Title:</label>
    <input type="text" class="form-control" id="subhead">
    </div>
                            <div class="form-group">
    <label for="subhead">Project Description:</label>
    <textarea type="" class="form-control" id="subhead"></textarea>
    </div>
                            <div class="form-group">
    <label for="subhead">Project Status:</label>
    <input type="text" class="form-control" id="subhead">
    </div>
                            <div class="form-group">
    <label for="subhead">Remarks:</label>
    <input type="text" class="form-control" id="subhead">
    </div>
                           
                        </div>
                        <div class="col-sm-6">
                            
                            <div class="form-group">
    <label for="subhead">Project Location:</label>
    <textarea type="text" class="form-control" id="subhead"></textarea>
    </div>
                            <div class="form-group">
    <label for="subhead">Date of Award:</label>
    <input type="text" class="form-control" id="subhead">
    </div>
                            <div class="form-group">
    <label for="subhead">Duration of Contract:</label>
    <input type="text" class="form-control" id="subhead">
    </div>
                            <div class="form-group">
    <label for="subhead">Expected Date of Completion:</label>
    <input type="date" class="form-control" id="subhead">
    </div>
          
                        <div class="form-group">
    <label for="subhead">Contract Duration Expiry Date:</label>
    <input type="date" class="form-control" id="subhead">
    </div>
                            <div class="form-group">
    <label for="subhead">Last Update:</label>
    <input type="text" class="form-control" id="subhead">
    </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="row">
                         <div class="col-sm-12">
                    <h5 class="title">CONTRACTOR and CONSULTANT</h5>
                </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-5">
                           <div class="form-group">
    <label for="subhead">Contractor:</label>
    <input type="text" class="form-control" id="subhead">
    </div> 
                            <div class="form-group">
    <label for="subhead">Address:</label>
    <textarea type="text" class="form-control" id="subhead"></textarea>
    </div>
                            <div class="form-group">
    <label for="subhead">Contractor GSM:</label>
    <input type="phone" class="form-control" id="subhead">
    </div> 
                            <div class="form-group">
    <label for="subhead">Contractor GSM (2):</label>
    <input type="phone" class="form-control" id="subhead">
    </div> 
                            <div class="form-group">
    <label for="email">Contractor's Email:</label>
    <input type="email" class="form-control" id="subhead">
    </div> 
                            <div class="form-group">
    <label for="subhead">Area of Specialization:</label>
    <textarea type="text" class="form-control" id="subhead"></textarea>
    </div> 
                        </div>
                        <div class="col-sm-7" style="border-left:2px solid #245269;">
                            <div class="form-group">
    <label for="subhead">Consultant:</label>
    <input type="text" class="form-control" id="subhead">
    </div> 
                            <div class="form-group">
    <label for="subhead">Address:</label>
    <textarea type="text" class="form-control" id="subhead"></textarea>
    </div>
                            <div class="form-group">
    <label for="subhead">Consultant GSM:</label>
    <input type="phone" class="form-control" id="subhead">
    </div> 
                            <div class="form-group">
    <label for="subhead">Consultant GSM (2):</label>
    <input type="phone" class="form-control" id="subhead">
    </div> 
                            <div class="form-group">
    <label for="email">Consultant's Email:</label>
    <input type="email" class="form-control" id="subhead">
    </div> 
                            <div class="form-group">
    <label for="subhead">Area of Specialization:</label>
    <textarea type="text" class="form-control" id="subhead"></textarea>
    </div> 
                        </div>
                    </div>
                </div>
                <!--New row start-->
<div class="row">
                    <div class="row">
                         <div class="col-sm-12">
                    <h5 class="title">FINANCIAL</h5>
                </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
    <label for="number">Contract Sum N:</label>
    <input type="number" class="form-control" id="subhead">
    </div> 
                            <div class="form-group">
    <label for="number">Variations N:</label>
    <input type="number" class="form-control" id="subhead">
    </div> 
                            <div class="form-group">
    <label for="number">Revised Contract Sum N:</label>
    <input type="number" class="form-control" id="subhead">
    </div> 
                            <div class="form-group">
    <label for="number">Agreed Mobilization N:</label>
    <input type="number" class="form-control" id="subhead">
    </div> 
    <div class="form-group">
    <label for="number">Mobilization Paid N:</label>
    <input type="number" class="form-control" id="subhead">
    </div> 
                            <div class="form-group">
    <label for="number">Percentage to Contract Sum:</label>
    <input type="number" class="form-control" id="subhead">
    </div> 
                            <div class="form-group">
    <label for="number">Estimate to Completion N:</label>
    <input type="number" class="form-control" id="subhead">
    </div> 
                            <div class="form-group">
    <label for="number">Certificates Paid N:</label>
    <input type="number" class="form-control" id="subhead">
    </div> 
                     
                        </div>
                    <div class="col-sm-6">
                            <div class="form-group">
    <label for="number">Contract Sum Outstanding N:</label>
    <input type="number" class="form-control" id="subhead">
    </div> 
                            <div class="form-group">
    <label for="number">Certificates Issued N:</label>
    <input type="number" class="form-control" id="subhead">
    </div> 
                            <div class="form-group">
    <label for="number">Certificates Approved N:</label>
    <input type="number" class="form-control" id="subhead">
    </div> 
                            <div class="form-group">
    <label for="number">Certificates Awaiting Approval N:</label>
    <input type="number" class="form-control" id="subhead">
    </div> 
                            <div class="form-group">
    <label for="number">Payments to Date N:</label>
    <input type="number" class="form-control" id="subhead">
    </div> 
                            <div class="form-group">
    <label for="number">Payment Status:</label>
    <input type="number" class="form-control" id="subhead">
    </div> 
                            <div class="form-group">
    <label for="number">Approved Unpaid Certificates N:</label>
    <input type="number" class="form-control" id="subhead">
    </div> 
                            <div class="form-group">
    <label for="number">Unpaid Certified Works N:</label>
    <input type="number" class="form-control" id="subhead">
    </div> 
                            <div class="form-group">
    <label for="number">Value of Works Outstanding:</label>
    <input type="number" class="form-control" id="subhead">
    </div> 
                    </div>
                    </div>
                </div>
<!--New row end-->
<!--New row start-->
<div class="row">
                    <div class="row">
                         <div class="col-sm-12">
                    <h5 class="title">PROJECT SUMMARY DETAILS</h5>
                </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                             <div class="form-group">
    <label for="number">Total Contract Sum N:</label>
    <input type="number" class="form-control" id="subhead">
    </div> 
                            <div class="form-group">
    <label for="number">Total Variations N:</label>
    <input type="number" class="form-control" id="subhead">
    </div> 
                            <div class="form-group">
    <label for="number">Total Revised Contract Sum N:</label>
    <input type="number" class="form-control" id="subhead">
    </div> 
                            <div class="form-group">
    <label for="number">Total Mobilization Paid N:</label>
    <input type="number" class="form-control" id="subhead">
    </div> 
    <div class="form-group">
    <label for="number">Total Estimate to Completion After Mobilization N:</label>
    <input type="number" class="form-control" id="subhead">
    </div> 
                            <div class="form-group">
    <label for="number">Total Certificates Paid N:</label>
    <input type="number" class="form-control" id="subhead">
    </div> 
                            <div class="form-group">
    <label for="number">Total Contract Sum Outstanding N:</label>
    <input type="number" class="form-control" id="subhead">
    </div>  
                            <div class="form-group">
    <label for="number">Total Certificates Paid N:</label>
    <input type="number" class="form-control" id="subhead">
    </div>      
                            <div class="form-group">
    <label for="number">Total Contract Sum Outstanding N:</label>
    <input type="number" class="form-control" id="subhead">
    </div> 
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
    <label for="number">Total Certificates Issued N:</label>
    <input type="number" class="form-control" id="subhead">
    </div> 
                            <div class="form-group">
    <label for="number">Total Certificates Approved N:</label>
    <input type="number" class="form-control" id="subhead">
    </div> 
                            <div class="form-group">
    <label for="number">Total Certificates Awaiting Approval N:</label>
    <input type="number" class="form-control" id="subhead">
    </div> 
                            <div class="form-group">
    <label for="number">Total Approved Unpaid Certificates N:</label>
    <input type="number" class="form-control" id="subhead">
    </div> 
                            <div class="form-group">
    <label for="number">Total Unpaid Certified Works N:</label>
    <input type="date" class="form-control" id="subhead">
    </div>
                            <div class="form-group">
    <label for="number">Total Payments to Date N:</label>
    <input type="number" class="form-control" id="subhead">
    </div>  
                            <div class="form-group">
    <label for="number">Total Value of Works Outstanding N:</label>
    <input type="number" class="form-control" id="subhead">
    </div>
                            <div class="form-group">
    <label for="date">Last Update:</label>
    <input type="date" class="form-control" id="subhead">
    </div> 
                        </div>
                    </div>
                </div>
<!--New row end-->
<!--New row start-->
<div class="row">
                    <div class="row">
                         <div class="col-sm-12">
                    <h5 class="title">PROJECT</h5>
                </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            
                        </div>
                        <div class="col-sm-6">
                            
                        </div>
                    </div>
                </div>
<!--New row end-->

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12"></div>
    </div>
    <div class="row">
        <div class="col-sm-12"></div>
    </div>
   </div>
</body>
</html>
