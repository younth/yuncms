/*******/// COUNTDOWN /*******/
$(function () {
var newYear = new Date(); 
newYear = new Date(2014, 04, 15,20,00,00);
$('.defaultCountdown').countdown({until: newYear, format: 'DHMS'}); 
});        


/*******/// FANCYBOX /*******/
$(document).ready(function() {
	$("#inline").fancybox();
});