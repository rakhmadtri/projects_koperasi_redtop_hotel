$(function(){
	$(".datepicker").datepicker({
		format:"yyyy-mm-dd"
	});
	$(".datepicker").datepicker().on("changeDate", function(ev){                 
        $(this).datepicker("hide");
    });
    $(".datepicker").keydown(function(){return false;});





});