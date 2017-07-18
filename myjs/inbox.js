//javascript for login and signup pages
$(document).ready(function()
{
   
    
   //signup code
 $(document).on("click", ".newmsg", function(event)
    {
        //newrcpts
        
          var mytag = $(this);
        var dataid=mytag.attr("data-msgid");
        
         
     var x=$.ajax({
      type: "POST",
      url: 'php/updateinbox.php',
      contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
      data: "dataid=" + encodeURIComponent(dataid),
      dataType: "text"
     });
     
     x.done(function(serverResponse)
     {
         var servervalue=serverResponse.trim();
         if(servervalue==='new')
         {
         var msg=$('#inboxbadge').html();
            var msg1=parseInt(msg);
            var msg2=msg1-1;
            $('#inboxbadge').html(msg2);
            if(msg2==0)
            {
                $('#inboxbadge').css("display","none");
            }
        }    
            
         
        
     });
     
      x.fail(function(){
        // $('#responsemessage').html("Server Error. Please try again");
     });
     
     x.always(function(){
         
});
   
 });//button click closes
      
    $(document).on("click", ".newrcpts", function(event)
    {
        
        
          var mytag = $(this);
        var dataid=mytag.attr("data-msgid");
        
         
     var x=$.ajax({
      type: "POST",
      url: 'php/updateinbox.php',
      contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
      data: "dataid=" + encodeURIComponent(dataid),
      dataType: "text"
     });
     
     x.done(function(serverResponse)
     {
         servervalue=serverResponse.trim();
         if(servervalue==='newreceipt')
         {
         var msg=$('#receiptbadge').html();
            var msg1=parseInt(msg);
            var msg2=msg1-1;
            $('#receiptbadge').html(msg2);
            if(msg2==0)
            {
                $('#receiptbadge').css("display","none");
            }
                
     }
         
        
     });
     
      x.fail(function(){
        // $('#responsemessage').html("Server Error. Please try again");
     });
     
     x.always(function(){
         
});
   
 });//button click closes
      
   
    $(document).on("click", "#accept", function(event)
    {

        var mytag = $(this);
        var dataid=mytag.attr("data-accept");
                 
     var x=$.ajax({
      type: "POST",
      url: 'php/acceptinvoice.php',
      contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
      data: "dataid=" + encodeURIComponent(dataid),
      dataType: "text"
     });
     
     x.done(function(serverResponse)
     {
        var servervalue=serverResponse.trim();
        if(servervalue==='accepted')
        {
            swal("Error!", "You have accepted this invoice already!", "error"); 
        }
         else if(servervalue==='successful'||servervalue==='1successful')
        {
  swal({
  title: "Invoice Accepted",
  text: "Thank you for accepting the invoice. A receipt has been generated for you.",
  type: "success",
  showCancelButton: false,
  confirmButtonColor: "#DD6B55",
  confirmButtonText: "OK",
  closeOnConfirm: false
},
function(){
  location.href="http://localhost:82/laundry/inbox.php";
});
            
//            location.href="http://localhost:82/laundry/inbox.php";
            //swal("Invoice!", "Thank you for accepting the invoice!", "success");
        }
        else{
            swal("Error!", "Could not accept invoice!", "error"); 
        }
         
        
     });
     
      x.fail(function(){
        // $('#responsemessage').html("Server Error. Please try again");
     });
     
     x.always(function(){
         
});
   
 });//button click closes
      
    $(document).on("click", "#reject", function(event)
    {

        var mytag = $(this);
        var dataid=mytag.attr("data-reject");
                 
     var x=$.ajax({
      type: "POST",
      url: 'php/rejectinvoice.php',
      contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
      data: "dataid=" + encodeURIComponent(dataid),
      dataType: "text"
     });
     
     x.done(function(serverResponse)
     {
        var servervalue=serverResponse.trim();
        
          if(servervalue==='successful')
        {
  swal({
  title: "Invoice Rejected",
  text: "Invoice has been deleted. We will get back to you on this. Thanks!",
  type: "success",
  showCancelButton: false,
  confirmButtonColor: "#DD6B55",
  confirmButtonText: "OK",
  closeOnConfirm: false
},
function(){
  location.href="http://localhost:82/laundry/inbox.php";
});

        }
        else{
            swal("Error!", "Could not reject invoice!", "error"); 
        }
         
        
     });
     
      x.fail(function(){
        // $('#responsemessage').html("Server Error. Please try again");
     });
     
     x.always(function(){
         
});
   
 });//button click closes
      
   
    
   
});//document.ready closes

