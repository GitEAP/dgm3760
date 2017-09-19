$(document).ready(function(){
	"use strict";
	var closeBtn = $('.closeBtn');
	var openBtn = $('.openBtn');
	var mainContainer = $('.container');
	
	//if close button is clicked, then close the menu
	closeBtn.click(function(){
		document.getElementById("mainSideNav").style.width = "0";
		mainContainer.css("margin-left", "0px");
	});
	//if open button is clicked, then open the menu
	openBtn.click(function(){
		document.getElementById("mainSideNav").style.width = "250px";
		mainContainer.css("margin-left", "250px");
	});




	
});