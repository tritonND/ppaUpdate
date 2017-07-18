var questionnumber;
var questionArray;
var submitclicked = false;

// FUNCTION TO CREATE A NEW SUBJECT TABLE ON DATABASE
    function process()
    {
        //retrieve html elements values
        var subject=document.getElementById('subject').value;
        var duration=document.getElementById('duration').value;
        var show=document.getElementById('show').value;
     if(subject===""||duration ===""){document.getElementById('response').innerHTML="Please complete all fields!";
	var red = document.getElementById('response');
	 red.style.color = "Red";
		 
		 }else{
      var create=$.ajax({
      type: "POST",
      url: '../php/process.php',
      contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
      data: "subject="+encodeURIComponent(subject)+"&duration="+encodeURIComponent(duration)+"&show="+encodeURIComponent(show),
       dataType: "text"
     });
     create.done(function(response)
     {
          var servervalue=response.trim();
          document.getElementById('response').innerHTML=servervalue;
		  var red = document.getElementById('response');
                    red.style.color = "Blue";
                         document.getElementById('subject').value=""; 
			document.getElementById('duration').value=""; 
     });
     
      create.fail(function(){
         document.getElementById('response').innerHTML="Server Error!"; 
		 var red = document.getElementById('response');
	 red.style.color = "red";
     });
          

     create.always(function(){
        document.getElementById('response').innerHTML=servervalue;
     });
  

    }
}
// FUNCTION TO POPULATE QUESTIONS ON DATABASE  
    function addQuestion()
    {
        //retrieve html elements values
        var e_subject =document.getElementById('e_subject').value;
        var question =document.getElementById('question').value;
	//check which option is checked.
        if(document.getElementById('option_a').checked) {
  		var answer = document.getElementById('option_a').value;
}else if(document.getElementById('option_b').checked){
	var answer = document.getElementById('option_b').value;
	}else if(document.getElementById('option_c').checked){
	var answer = document.getElementById('option_c').value;
	}else if(document.getElementById('option_d').checked){
	var answer = document.getElementById('option_d').value;
	}
    var option1 =document.getElementById('option1').value;
    var option2 =document.getElementById('option2').value;
    var option3 =document.getElementById('option3').value;
    var option4 =document.getElementById('option4').value;
	
	if(e_subject==""||question ==""||option1==""||option2==""||option3==""||option4==""){document.getElementById('response_question').innerHTML="Please complete all fields!";
	var red = document.getElementById('response_question');
	 red.style.color = "Red";
		 
		 }else{
     
      var test_question=$.ajax({
      type: "POST",
      url: '../php/questions.php',
      contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
      data: "e_subject="+encodeURIComponent(e_subject)+"&question="+encodeURIComponent(question)+"&answer="+encodeURIComponent(answer)+"&option1="+encodeURIComponent(option1)+"&option2="+encodeURIComponent(option2)+"&option3="+encodeURIComponent(option3)+"&option4="+encodeURIComponent(option4),
        dataType: "text"
     });
     
     test_question.done(function(response)
     {
          var servervalue=response.trim();
          document.getElementById('response_question').innerHTML=servervalue;
		  var blue = document.getElementById('response_question');
	 blue.style.color = "Blue";
		  	
			document.getElementById('e_subject').value=""; 
			document.getElementById('question').value=""; 
			document.getElementById('option1').value="";
                        document.getElementById('option2').value=""; 
			document.getElementById('option3').value=""; 
			document.getElementById('option4').value="";
     });
     
      test_question.fail(function(){
         document.getElementById('response_question').innerHTML="Error entering question"; 
     });
     
     test_question.always(function(){
        document.getElementById('response_question').innerHTML=servervalue;
     });
  
  
    }
}
// FUNCTION TO REGISTER A NEW CANDIDATE
    function registerCandidate()
    {
        //retrieve html elements values
    var fname=document.getElementById('fname').value;
    var mname=document.getElementById('mname').value;
    var lname=document.getElementById('lname').value;
    var dob=document.getElementById('dob').value;
    var degree=document.getElementById('degree').value;
    var sex=document.getElementById('sex').value;
    var state=document.getElementById('state').value;
    var lga=document.getElementById('lga').value;
    var phone=document.getElementById('phone').value;
    var email=document.getElementById('email').value;
    var course=document.getElementById('course').value;
    var institution=document.getElementById('institution').value;
    var address=document.getElementById('address').value;
    var position=document.getElementById('position').value;
    var test_subject=document.getElementById('test_subject').value;
    
    if(fname===""||mname ===""||lname===""||dob===""||degree===""||sex===""||state===""
            ||phone===""||email===""||course===""||institution===""||address===""||position===""
            ||test_subject===""){document.getElementById('register_response').innerHTML="Please complete all the fields";
	var red = document.getElementById('register_response');
	 red.style.color = "Red";
     }else{	 
    
    var register=$.ajax({
      type: "POST",
      url: '../php/register.php',
      contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
      data: "fname="+encodeURIComponent(fname)+"&mname="+encodeURIComponent(mname)+"&lname="+encodeURIComponent(lname)
              +"&dob="+encodeURIComponent(dob)+"&degree="+encodeURIComponent(degree)+"&sex="+encodeURIComponent(sex)
              +"&state="+encodeURIComponent(state)+"&lga="+encodeURIComponent(lga)+"&phone="+encodeURIComponent(phone)
              +"&email="+encodeURIComponent(email)+"&course="+encodeURIComponent(course)+"&institution="+encodeURIComponent(institution)
              +"&address="+encodeURIComponent(address)+"&position="+encodeURIComponent(position)+"&test_subject="+encodeURIComponent(test_subject),
        dataType: "text"
     });
     
     register.done(function(response)
     {
          var servervalue=response.trim();
          document.getElementById('register_response').innerHTML=servervalue;
          var blue = document.getElementById('register_response');
	 blue.style.color = "Blue";
         
        document.getElementById('fname').value="";
        document.getElementById('mname').value="";
        document.getElementById('lname').value="";
        document.getElementById('dob').value="";
        document.getElementById('degree').value="";
        document.getElementById('sex').value="";
        document.getElementById('state').value="";
        document.getElementById('lga').value="";
        document.getElementById('phone').value="";
        document.getElementById('email').value="";
        document.getElementById('course').value="";
        document.getElementById('institution').value="";
        document.getElementById('address').value="";
        document.getElementById('position').value="";
        document.getElementById('test_subject').value="";              
     });
     
      register.fail(function(response){
         document.getElementById('register_response').innerHTML="Cannot register candidate!";
         var red2 = document.getElementById('register_response');
	 red2.style.color = "Red";
     });
     
     register.always(function(response){
        //document.getElementById('register_response').innerHTML=servervalue;
     });
  

    }
}
// FUNCTION TO SEARCH CANDIDATES IN DATABASE
    function searchCandidate()
    {
        //retrieve html elements values
    var candidate=document.getElementById('candidate').value;
       
    if(candidate===""){document.getElementById('search_response').innerHTML="Please enter candidate's phone number or surname";
	var red = document.getElementById('search_response');
	 red.style.color = "Red";
     }else{	 
    var search=$.ajax({
      type: "POST",
      url: '../php/search.php',
      contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
      data: "candidate="+encodeURIComponent(candidate),
        dataType: "text"
     });
     
     search.done(function(response)
     {
          var servervalue=response.trim();
          document.getElementById('search').innerHTML=servervalue;
          document.getElementById('search_response').innerHTML="Search completed!";
          document.getElementById('search_response').style.color ="Green";
          var blue = document.getElementById('search');
	 blue.style.color = "green";
         
        document.getElementById('candidate').value="";
                    
     });
     
      search.fail(function(response){
         document.getElementById('search').innerHTML="No match found!";
         var red2 = document.getElementById('search');
	 red2.style.color = "Red";
     });
     
     search.always(function(response){
        //document.getElementById('search').innerHTML=servervalue;
     });
  

    }
}

// FUNCTION TO SELECT THE QUESTIONS AND OPTIONS ARRAY
    function loadQuestions()
    {
        
      var x=$.ajax({
      type: "POST",
      url: '../php/next.php',
      contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
      data: false
     });
     
	    x.done(function(response)
     {
         servervalue=$.parseJSON(response.trim());
         questionArray = servervalue;
//         console.log(servervalue[0]['id']);
         questionnumber = 1;
         $('#question').html(questionnumber + ". " + servervalue[0]['question']);
         $('#option1').html(servervalue[0]['option1']);
         $('#option2').html(servervalue[0]['option2']);
         $('#option3').html(servervalue[0]['option3']);
         $('#option4').html(servervalue[0]['option4']);
         $('#option5').html(servervalue[0]['option5']);
         
         $('#nextbutton').data('nextQuestion', 0);
          
     });
     
      x.fail(function(){
         
     });
     
     x.always(function(){
        //document.getElementById('response').innerHTML=servervalue;
     });
}

// FUNCTION TO SELECT THE NEXT QUESTIONS
    function nextButton()
    {
         var nextquestion = window.parseInt($('#nextbutton').data('nextQuestion'));
         $('#prevbutton').data('prevQuestion',nextquestion);
         nextquestion = nextquestion+1;
         questionnumber = questionnumber+1;
         $('#prevbutton').prop('disabled', false);
         $('#nextbutton').data('nextQuestion',nextquestion);
         $('#test_frm').get(0).reset();
         $('#question').html(questionnumber + ". " + questionArray[nextquestion]['question']);
         $('#option1').html(questionArray[nextquestion]['option1']);
         $('#option2').html(questionArray[nextquestion]['option2']);
         $('#option3').html(questionArray[nextquestion]['option3']);
         $('#option4').html(questionArray[nextquestion]['option4']);
         $('#option5').html(questionArray[nextquestion]['option5']);
         console.log(questionArray[nextquestion]['id']);
         if(isNaN(parseInt(questionArray[nextquestion]['answer']))){
             //do nothing
         }else{
                $('[name="answer"]').eq(questionArray[nextquestion]['answer']-1).prop('checked', true);
              }
         if(nextquestion == questionArray.length-1){
             $('#nextbutton').prop('disabled',true);
             return;
         }
         
    }
// FUNCTION TO SELECT THE PREVIOUS QUESTION
    function previousButton()
    {
         var prevquestion = window.parseInt($('#prevbutton').data('prevQuestion'));
        $('#nextbutton').data('nextQuestion',prevquestion); 
                  
         $('#nextbutton').prop('disabled', false);
         questionnumber = questionnumber-1;
         
         $('#test_frm').get(0).reset();
         $('#question').html(questionnumber + ". " + questionArray[prevquestion]['question']);
         $('#option1').html(questionArray[prevquestion]['option1']);
         $('#option2').html(questionArray[prevquestion]['option2']);
         $('#option3').html(questionArray[prevquestion]['option3']);
         $('#option4').html(questionArray[prevquestion]['option4']);
         $('#option5').html(questionArray[prevquestion]['option5']);
         if(isNaN(parseInt(questionArray[prevquestion]['answer']))){
             //do nothing
         }else{
                $('[name="answer"]').eq(questionArray[prevquestion]['answer']-1).prop('checked', true);
              }
          prevquestion = prevquestion-1;
          $('#prevbutton').data('prevQuestion',prevquestion);
        if(prevquestion < 0){
             $('#prevbutton').prop('disabled',true);
             return;
         }
        
    }
   // This event triggerred when document is fully loaded.
   $(document).ready(
           function(){
               $('[type="radio"]').on("click", function(event){
            questionArray[questionnumber-1]['answer']=$('[name="answer"]:checked').val();
            console.log(questionnumber + ' - ' + questionArray[questionnumber-1]['answer'])
               });
           }
           );
   
// Submit test answers
   function submittest() {
       console.log('question submitted.')
       var x=$.ajax({
      type: "POST",
      url: '../php/testmarker.php',
     contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
      data: 'questionArray=' + window.encodeURIComponent(JSON.stringify(questionArray))
     });
     
	    x.done(function(response)
     {
          var servervalue=response.trim();
            submitclicked = true;
            timer.minutes=0;
            timer.seconds=0;
            timer.update_target();
         swal({ title:'Your score is: '+ servervalue + ' %' ,  
             text: '<div><div class="progress">' + 
 ' <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="70"' + 
 'aria-valuemin="0" aria-valuemax="100" style="width:' + servervalue +'%">' + 
 '<span class="sr-only">' + servervalue +'% Complete</span>' + 
 '</div></div>Your test has ended. <br>' +
'Thank you.</div>',  
                    type: "success", 
                    html:true,     
                    showConfirmButton: true,
                    closeOnConfirm: false, confirmButtonText:"Log out"
                          
              }, 
         function(inputValue){
             location.href = "../php/logout.php";
         });
         $('#nextbutton').prop('disabled', true);
         $('#prevbutton').prop('disabled', true);
         $('#submit').prop('disabled', true);
        });
      x.fail(function(){
          swal({   title: "Submission failed.",   text: "There's a problem submitting your answers, please contact the examiner.",  
             type: "error",   closeOnConfirm: true
              });                
     });
     
     x.always(function(){
        //document.getElementById('response').innerHTML=servervalue;
     });
}