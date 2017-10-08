$(document).ready(function(){
	"use strict";
	var closeBtn = $('.closebtn');
	var openBtn = $('.openbtn');
	var contentContainer = $('.contentLeft');
	
	// run test on initial page load
    checkSize();
    // run test on resize of the window
    $(window).resize(checkSize);
//Function to the css rule
function checkSize(){
	//when resize from tablet/desktop to mobile, keep menu close by default.
	contentContainer.css("width", "0px");
	//makes width 25% if tablet or desktop
	if ($(window).width() >= 760) {
		contentContainer.css("width", "25%");
	}
	//checks if it's mobile
	if ($(window).width() < 760) {	
	//if close button is clicked, then close the menu
	closeBtn.click(function(){
		contentContainer.css("width", "0px");

	});
	//if open button is clicked, then open the menu
	openBtn.click(function(){
		contentContainer.css("width", "300px");
	});
	}
}

});



