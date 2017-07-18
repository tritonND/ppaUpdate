// JavaScript Document
// Compute the the duration notice:
//
var minutes;
var seconds;
function Countdown()
{
var time=document.getElementById('timer').value;
var minutes = time-1;
var seconds = 59;
//var seconds = 00;
	this.start_time = minutes+":"+seconds;
	this.target_id = "#timer";
	this.name = "timer";
}
Countdown.prototype.init = function()
{
	this.reset();
	setInterval(this.name+ '.tick()', 1000);
};

Countdown.prototype.reset =function()
{
	time = this.start_time.split(":");
	this.minutes = parseInt(time[0]);
	this.seconds = parseInt(time[1]);
	this.update_target();
};

Countdown.prototype.tick =function()
{
	if(this.second> 0 || this.minutes >=0 )
	{
		this.seconds = this.seconds - 1;
		if(this.seconds == 0)
		{
			this.minutes = this.minutes -1;
			this.seconds = 59;	
		}
                

	}
	this.update_target();
};

           
Countdown.prototype.update_target = function()
{
	seconds = this.seconds;
	if(seconds <10) seconds ="0"+seconds;
        $(this.target_id).val(this.minutes+":"+seconds );
              
        if(this.minutes == 4 && this.seconds ==58 || this.minutes == 2 && this.seconds ==58){
            var totalminutes = parseInt(this.minutes) +1;
                    swal({   title: "",   text: "<span style='color:#C60F11; font-size:1em;'>You have less than "+ totalminutes +" minutes left!<span>",   
                        imageUrl: "../css/img/warn.png", html: true });
                   var x = document.getElementById('timer');
// Set timer font color to warning - Yellow.
                   if(this.minutes == 4 && this.seconds ==58){
                     x.style.background = '#FCD400';
                     x.style.color = '#ffffff';
                   }else if(this.minutes == 2 && this.seconds ==58){
                     x.style.background = '#FD0002'; 
//                     x.style.color = '#ffffff';
                   }                   
                    
                } else if(this.minutes == 0 && this.seconds <=1){
                    if (submitclicked!=true){
                    submittest();
                }
                document.getElementById('timer').style.visibility = 'hidden'; 
                } 
};