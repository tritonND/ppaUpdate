/**
 * Created by tritonND on 6/21/2017.
 */


$(document).ready(function(){

    // create the required start and end dates
    var start = moment(new Date(new Date().getFullYear(), 0, 1));
    var end = moment(new Date());

    // initialise date range widget
    $('#daterange').daterangepicker({
        startDate: start,
        endDate: end,
        ranges: {
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')]
        },
        linkedCalendars: false,
        "locale": {
            "format": "DD/MM/YYYY",
            "separator": " - ",
            "applyLabel": "Apply",
            "cancelLabel": "Cancel",
            "fromLabel": "From",
            "toLabel": "To",
            "customRangeLabel": "Custom",
            "weekLabel": "W",
            "daysOfWeek": [
                "Su",
                "Mo",
                "Tu",
                "We",
                "Th",
                "Fr",
                "Sa"
            ],
            "monthNames": [
                "January",
                "February",
                "March",
                "April",
                "May",
                "June",
                "July",
                "August",
                "September",
                "October",
                "November",
                "December"
            ],
            "firstDay": 1
        }
    }, updateDateRange);

    updateDateRange(start, end);
});


$('#daterange').on('apply.daterangepicker', function(ev, picker) {
    console.log(picker.startDate.format('YYYY-MM-DD'));
    console.log(picker.endDate.format('YYYY-MM-DD'));
    var startYr = picker.startDate.format('YYYY-MM-DD');
    var endYr = picker.endDate.format('YYYY-MM-DD');


    document.getElementById("years").innerHTML = "Data retrieved for " + startYr + " to " + endYr;
    document.getElementById("years1").innerHTML = "Data retrieved for " + startYr + " to " + endYr;
    document.getElementById("years2").innerHTML = "Data retrieved for " + startYr + " to " + endYr;
    document.getElementById("years3").innerHTML = "Data retrieved for " + startYr + " to " + endYr;
    document.getElementById("years4").innerHTML = "Data retrieved for " + startYr + " to " + endYr;
    document.getElementById("years5").innerHTML = "Data retrieved for " + startYr + " to " + endYr;



    var x1 = $.ajax({
        type: "POST",
        url: 'php/oth/reportScr1.php',
        contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
        data: "yr=" + encodeURIComponent(startYr) + "&yr2=" + encodeURIComponent(endYr) ,
        dataType: "text"
    });

    x1.done(function(serverResponse)
    {
        var servervalue=serverResponse.trim();
        if(servervalue=='error')
        {
            //swal("Error!", "An error occured, please try again later ", "error");
        }

        else
        {
            $('#table1').html(serverResponse.trim());

            var pf = kendo.toString(kendo.parseFloat($('#projfund').text().trim()), 'n2');
            $('#projfund').text(pf);
            //console.log(pf

            $('.currency-format').each(function(index, element) {
                $(element).text(kendo.toString(kendo.parseFloat($(element).text().trim()), 'n2'));
                console.log(kendo.toString(kendo.parseFloat($(element).text().trim()), 'n2'));
            });

        }
    });

    x1.fail(function(){
        // swal("Server Error!", "Server could not process this request, please try again later!", "error");
    });


    //mda financial reports on dashboard here
    var x2 = $.ajax({
        type: "POST",
        url: 'php/oth/reportScr2.php',
        contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
       // data: "yr=" + encodeURIComponent(yr),
        data: "yr=" + encodeURIComponent(startYr) + "&yr2=" + encodeURIComponent(endYr),
        dataType: "text"
    });


    x2.done(function(serverResponse)
    {
        var servervalue=serverResponse.trim();
        if(servervalue=='error')
        {

            //swal("Error!", "An error occured, please try again later ", "error");
        }

        else
        {

            $('#table2').html(serverResponse.trim());

            var pf = kendo.toString(kendo.parseFloat($('#projfund').text().trim()), 'n2');
            $('#projfund').text(pf);
            //console.log(pf

            $('.currency-format').each(function(index, element) {
                $(element).text(kendo.toString(kendo.parseFloat($(element).text().trim()), 'n2'));
                console.log(kendo.toString(kendo.parseFloat($(element).text().trim()), 'n2'));
            });

        }
    });

    x2.fail(function(){
        // swal("Server Error!", "Server could not process this request, please try again later!", "error");
    });


    // for mda number of projects on dashboard

    var x3 = $.ajax({
        type: "POST",
        url: 'php/oth/reportScr3.php',
        contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
        data: "yr=" + encodeURIComponent(startYr) + "&yr2=" + encodeURIComponent(endYr),
        dataType: "text"
    });

    x3.done(function(serverResponse)
    {
        var servervalue=serverResponse.trim();
        if(servervalue=='error')
        {
            //swal("Error!", "An error occured, please try again later ", "error");
        }

        else
        {
            $('#table3').html(serverResponse.trim());
            var pf = kendo.toString(kendo.parseFloat($('#projfund').text().trim()), 'n2');
            $('#projfund').text(pf);
            //console.log(pf

            $('.currency-format').each(function(index, element) {
                $(element).text(kendo.toString(kendo.parseFloat($(element).text().trim()), 'n2'));
                console.log(kendo.toString(kendo.parseFloat($(element).text().trim()), 'n2'));
            });

        }
    });

    x3.fail(function(){
        // swal("Server Error!", "Server could not process this request, please try again later!", "error");
    });


    // LGA project financials

    var x4 = $.ajax({
        type: "POST",
        url: 'php/oth/reportScr4.php',
        contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
        data: "yr=" + encodeURIComponent(startYr) + "&yr2=" + encodeURIComponent(endYr),
        dataType: "text"
    });

    x4.done(function(serverResponse)
    {
        var servervalue=serverResponse.trim();
        if(servervalue=='error')
        {
            //swal("Error!", "An error occured, please try again later ", "error");
        }

        else
        {
            $('#table4').html(serverResponse.trim());
            var pf = kendo.toString(kendo.parseFloat($('#projfund').text().trim()), 'n2');
            $('#projfund').text(pf);
            //console.log(pf

            $('.currency-format').each(function(index, element) {
                $(element).text(kendo.toString(kendo.parseFloat($(element).text().trim()), 'n2'));
                console.log(kendo.toString(kendo.parseFloat($(element).text().trim()), 'n2'));
            });

        }
    });

    x4.fail(function(){
        // swal("Server Error!", "Server could not process this request, please try again later!", "error");
    });



    // All projects financial report

    var xff = $.ajax({
        type: "POST",
        url: 'php/oth/reportScr6.php',
        contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
        data: "yr=" + encodeURIComponent(startYr) + "&yr2=" + encodeURIComponent(endYr),
        dataType: "text"
    });

    xff.done(function(serverResponse)
    {
        var servervalue=serverResponse.trim();
        if(servervalue=='error')
        {
            //swal("Error!", "An error occured, please try again later ", "error");
        }

        else
        {
            $('#table7').html(serverResponse.trim());

            var pf = kendo.toString(kendo.parseFloat($('#projfund').text().trim()), 'n2');
            $('#projfund').text(pf);
            //console.log(pf

            $('.currency-format').each(function(index, element) {
                $(element).text(kendo.toString(kendo.parseFloat($(element).text().trim()), 'n2'));
                console.log(kendo.toString(kendo.parseFloat($(element).text().trim()), 'n2'));
            });

        }
    });

    xff.fail(function(){
        // swal("Server Error!", "Server could not process this request, please try again later!", "error");
    });


    // project status
    var x = $.ajax({
        type: "POST",
        url: 'php/oth/reportScr5.php',
        contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
        data: "yr=" + encodeURIComponent(startYr) + "&yr2=" + encodeURIComponent(endYr),
        dataType: "text"
    });

    x.done(function(serverResponse)
    {
        var servervalue=serverResponse.trim();
        if(servervalue=='error')
        {
            //swal("Error!", "An error occured, please try again later ", "error");
        }

        else
        {
            $('#table5').html(serverResponse.trim());


            var pf = kendo.toString(kendo.parseFloat($('#projfund').text().trim()), 'n2');
            $('#projfund').text(pf);
            //console.log(pf

            $('.currency-format').each(function(index, element) {
                $(element).text(kendo.toString(kendo.parseFloat($(element).text().trim()), 'n2'));
                console.log(kendo.toString(kendo.parseFloat($(element).text().trim()), 'n2'));
            });

        }
    });

    x.fail(function(){
        // swal("Server Error!", "Server could not process this request, please try again later!", "error");
    });




});


// function used to update the the date range display
function updateDateRange(start, end){
    $('#daterange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
}


$(document).on("change", "#yearoption", function(event)
{
var yr = $('#yearoption').val();
document.getElementById("years").innerHTML = "Data retrieved for " + yr;
document.getElementById("years1").innerHTML = "Data retrieved for " + yr;
document.getElementById("years2").innerHTML = "Data retrieved for " + yr;
document.getElementById("years3").innerHTML = "Data retrieved for " + yr;
document.getElementById("years4").innerHTML = "Data retrieved for " + yr;
document.getElementById("years5").innerHTML = "Data retrieved for " + yr;
console.log(yr);


var xff = $.ajax({
    type: "POST",
    url: 'php/oth/reportScr6.php',
    contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
    data: "yr=" + encodeURIComponent(yr),
    dataType: "text"
});

xff.done(function(serverResponse)
{
    var servervalue=serverResponse.trim();
    if(servervalue=='error')
    {
        //swal("Error!", "An error occured, please try again later ", "error");
    }

    else
    {
        $('#table7').html(serverResponse.trim());

        var pf = kendo.toString(kendo.parseFloat($('#projfund').text().trim()), 'n2');
        $('#projfund').text(pf);
        //console.log(pf

        $('.currency-format').each(function(index, element) {
            $(element).text(kendo.toString(kendo.parseFloat($(element).text().trim()), 'n2'));
            console.log(kendo.toString(kendo.parseFloat($(element).text().trim()), 'n2'));
        });

    }
});

xff.fail(function(){
    // swal("Server Error!", "Server could not process this request, please try again later!", "error");
});

//next table

//next table

//next table

var x2 = $.ajax({
    type: "POST",
    url: 'php/oth/reportScr2.php',
    contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
    data: "yr=" + encodeURIComponent(yr),
    dataType: "text"
});

x2.done(function(serverResponse)
{
    var servervalue=serverResponse.trim();
    if(servervalue=='error')
    {
        //swal("Error!", "An error occured, please try again later ", "error");
    }

    else
    {
        $('#table2').html(serverResponse.trim());

        var pf = kendo.toString(kendo.parseFloat($('#projfund').text().trim()), 'n2');
        $('#projfund').text(pf);
        //console.log(pf

        $('.currency-format').each(function(index, element) {
            $(element).text(kendo.toString(kendo.parseFloat($(element).text().trim()), 'n2'));
            console.log(kendo.toString(kendo.parseFloat($(element).text().trim()), 'n2'));
        });

    }
});

x2.fail(function(){
    // swal("Server Error!", "Server could not process this request, please try again later!", "error");
});


//next table

var x1 = $.ajax({
    type: "POST",
    url: 'php/oth/reportScr1.php',
    contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
    data: "yr=" + encodeURIComponent(yr),
    dataType: "text"
});

x1.done(function(serverResponse)
{
    var servervalue=serverResponse.trim();
    if(servervalue=='error')
    {
        //swal("Error!", "An error occured, please try again later ", "error");
    }

    else
    {
        $('#table1').html(serverResponse.trim());

        var pf = kendo.toString(kendo.parseFloat($('#projfund').text().trim()), 'n2');
        $('#projfund').text(pf);
        //console.log(pf

        $('.currency-format').each(function(index, element) {
            $(element).text(kendo.toString(kendo.parseFloat($(element).text().trim()), 'n2'));
            console.log(kendo.toString(kendo.parseFloat($(element).text().trim()), 'n2'));
        });

    }
});

x1.fail(function(){
    // swal("Server Error!", "Server could not process this request, please try again later!", "error");
});

var x01 = $.ajax({
    type: "POST",
    url: 'php/oth/reportScr01.php',
    contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
    data: "yr=" + encodeURIComponent(yr),
    dataType: "text"
});

x01.done(function(serverResponse)
{
    var servervalue=serverResponse.trim();
    if(servervalue=='error')
    {
        //swal("Error!", "An error occured, please try again later ", "error");
    }

    else
    {
        $('#projtotal').html(serverResponse.trim());
        var pf = kendo.toString(kendo.parseFloat($('#projfund').text().trim()), 'n2');
        $('#projfund').text(pf);
        //console.log(pf

        $('.currency-format').each(function(index, element) {
            $(element).text(kendo.toString(kendo.parseFloat($(element).text().trim()), 'n2'));
            console.log(kendo.toString(kendo.parseFloat($(element).text().trim()), 'n2'));
        });
    }
});

x01.fail(function(){
    // swal("Server Error!", "Server could not process this request, please try again later!", "error");
});

var x02 = $.ajax({
    type: "POST",
    url: 'php/oth/reportScr02.php',
    contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
    data: "yr=" + encodeURIComponent(yr),
    dataType: "text"
});

x02.done(function(serverResponse)
{
    var servervalue=serverResponse.trim();
    if(servervalue=='error')
    {
        //swal("Error!", "An error occured, please try again later ", "error");
    }

    else
    {
        $('#projstatus').html(serverResponse.trim());
        var pf = kendo.toString(kendo.parseFloat($('#projfund').text().trim()), 'n2');
        $('#projfund').text(pf);
        //console.log(pf

        $('.currency-format').each(function(index, element) {
            $(element).text(kendo.toString(kendo.parseFloat($(element).text().trim()), 'n2'));
            console.log(kendo.toString(kendo.parseFloat($(element).text().trim()), 'n2'));
        });

    }
});

x02.fail(function(){
    // swal("Server Error!", "Server could not process this request, please try again later!", "error");
});

var x03 = $.ajax({
    type: "POST",
    url: 'php/oth/reportScr03.php',
    contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
    data: "yr=" + encodeURIComponent(yr),
    dataType: "text"
});

x03.done(function(serverResponse)
{
    var servervalue=serverResponse.trim();
    if(servervalue=='error')
    {
        //swal("Error!", "An error occured, please try again later ", "error");
    }

    else
    {

        $('#projfund').html(serverResponse.trim());
        var pf = kendo.toString(kendo.parseFloat($('#projfund').text().trim()), 'n2');
        $('#projfund').text(pf);
        //console.log(pf

        $('.currency-format').each(function(index, element) {
            $(element).text(kendo.toString(kendo.parseFloat($(element).text().trim()), 'n2'));
            console.log(kendo.toString(kendo.parseFloat($(element).text().trim()), 'n2'));
        });

    }
});

x03.fail(function(){
    // swal("Server Error!", "Server could not process this request, please try again later!", "error");
});



var x04 = $.ajax({
    type: "POST",
    url: 'php/oth/reportScr04.php',
    contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
    data: "yr=" + encodeURIComponent(yr),
    dataType: "text"
});

x04.done(function(serverResponse)
{
    var servervalue=serverResponse.trim();
    if(servervalue=='error')
    {
        //swal("Error!", "An error occured, please try again later ", "error");
    }

    else
    {
        $('#projfund2').html(serverResponse.trim());
        var pf = kendo.toString(kendo.parseFloat($('#projfund').text().trim()), 'n2');
        $('#projfund').text(pf);
        //console.log(pf

        $('.currency-format').each(function(index, element) {
            $(element).text(kendo.toString(kendo.parseFloat($(element).text().trim()), 'n2'));
            console.log(kendo.toString(kendo.parseFloat($(element).text().trim()), 'n2'));
        });
    }
});

x04.fail(function(){
    // swal("Server Error!", "Server could not process this request, please try again later!", "error");
});


var x05 = $.ajax({
    type: "POST",
    url: 'php/oth/reportScr05.php',
    contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
    data: "yr=" + encodeURIComponent(yr),
    dataType: "text"
});

x05.done(function(serverResponse)
{
    var servervalue=serverResponse.trim();
    if(servervalue=='error')
    {
        //swal("Error!", "An error occured, please try again later ", "error");
    }

    else
    {
        $('#projfund3').html(serverResponse.trim());
        var pf = kendo.toString(kendo.parseFloat($('#projfund').text().trim()), 'n2');
        $('#projfund').text(pf);
        //console.log(pf

        $('.currency-format').each(function(index, element) {
            $(element).text(kendo.toString(kendo.parseFloat($(element).text().trim()), 'n2'));
            console.log(kendo.toString(kendo.parseFloat($(element).text().trim()), 'n2'));
        });
    }
});

x05.fail(function(){
    // swal("Server Error!", "Server could not process this request, please try again later!", "error");
});


var x06 = $.ajax({
    type: "POST",
    url: 'php/oth/reportSrc06.php',
    contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
    data: "yr=" + encodeURIComponent(yr),
    dataType: "text"
});

x06.done(function(serverResponse)
{
    var servervalue=serverResponse.trim();
    if(servervalue=='error')
    {
        //swal("Error!", "An error occured, please try again later ", "error");
    }

    else
    {
        $('#projfund4').html(serverResponse.trim());
        var pf = kendo.toString(kendo.parseFloat($('#projfund').text().trim()), 'n2');
        $('#projfund').text(pf);
        //console.log(pf

        $('.currency-format').each(function(index, element) {
            $(element).text(kendo.toString(kendo.parseFloat($(element).text().trim()), 'n2'));
            console.log(kendo.toString(kendo.parseFloat($(element).text().trim()), 'n2'));
        });
    }
});

x06.fail(function(){
    // swal("Server Error!", "Server could not process this request, please try again later!", "error");
});



});



// adding more scripts

function myfunc() {
    var x = document.getElementById("yearoption").value;
    // document.getElementById("demo").innerHTML = "You selected: " + x;
    console.log(x);
}