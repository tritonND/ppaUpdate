$(document).ready(function(){
        $("#create-project-form").validator().on("submit",function(event)
        {
            if(!event.isDefaultPrevented()){
                event.preventDefault();
                   
                // FIELDS IN BUDGET SESSION
        var f1=$('#head').val();
        var f2=$('#position').val();
        var f3=$('#sub-position').val();
        var f4=$('#budget-head').val();
        var f5=$('#budget-subhead').val();
        var f6=$('#budget-comment').val();
        
// FIELDS IN APPROPRIATIONS SESSION
        var f1b=$('#approved-appropriation').val();
        var f2b=$('#supplementary-provision').val();
        var f3b=$('#sub-sector-allocation').val();
        var f4b=$('#percentage-sub-sector-allocation').val();
        var f5b=$('#approved-appropriation-year').val();
        var f6b=$('#supplementary-provision-year').val();
        
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
        var f1e=$('#financial-contractsum').val();
        var f2e=$('#financial-variations').val();
        var f3e=$('#financial-contract-sum').val();
        var f4e=$('#agreedmobilisation').val();
        var f5e=$('#mobilisation-paid').val();
        var f6e=$('#mobilisation-percentage-of-contract-sum').val();
        
    if(f1!==""||f6e!==""){
        
        var x = $.ajax(
            {
                url: "http://localhost:81/edpms/php/submit_project.php",
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
                +"&f1e="+encodeURIComponent(f1e)+"&f2e="+encodeURIComponent(f2e)+"&f3e="+encodeURIComponent(f3e)+"&f4e="+encodeURIComponent(f4e)
                +"&f5e="+encodeURIComponent(f5e)+"&f6e="+encodeURIComponent(f6e)
        
            }
        	);
            
        x.done(function(serverResponse){

            if(serverResponse.trim()==="Records submitted successfully!")
            {
                alert(serverResponse);
                document.getElementById('create-project-form').reset(); 
                //location.href = "/Surebettingtips.php";
//                location.href = "dashboard.php";
           
            }
            else{
                alert("Back end problem");
//                $('#loginresponse').html(serverResponse.trim());
            }

        });

        x.fail(function(serverResponse)
        {
            alert(serverResponse);
            $('#createusersreponsemessage').html("Server error. Please try again");

        });

        x.always(function(){
           
        });
        }
             
            }
            
        });
    });