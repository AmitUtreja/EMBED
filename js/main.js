$(document).ready(function(){

	setButtonvisibility();

	beginCountDown();
	
	$("#proceed").click(function(){
		showFirstQuizQuestion();
	});
});


//this function will make the proceed button to start the quiz appear after
//the countdown on the screen finishes
function setButtonvisibility(){
		var count = parseInt($('span#time').html());
		var timercount = (count + 1) * 1000;
		setTimeout(function() {
	    $(".btn-success").show();
	  }, timercount);
};

//this function is responsible for making the count down from 0 to 5 on the screen
// once the countdown finishes the button will appear and the text which was showing the 
//countdown will disappear.
function beginCountDown(){
	var count = parseInt($('span#time').html());
	var interval = setInterval(function(){
		count--;
		if (count == -1){
			clearInterval(interval);
			$(".wrapper > p").hide();
			return;
		}
		$('#time').html(count);
	}, 1000);
};


//this function will display the first quiz question and make the other things on the page disappear
function showFirstQuizQuestion(){

	// we want to remove the initial heading of lets play the quiz and make the screen blank for the 
	//other HTML elements to start appearing and also the button
	$("#topheading").hide();
	$("#proceed").hide();

};

//This function will be called from addquestions.php to filter out the values of the correct answer
//for a question. i.e. if the user has chosen "Choice A" then we will send back only A. This was only a 
//test to see how to pass values to a JQuery function and return the values from a jQuery Function
function getRightAnswerChoice(answerchoice){
	alert("inside the getRightAnswerChoice function in main.js");
	var thisArray = answerchoice.split(" ");
	alert(thisArray[0]);
	alert(thisArray[1]);
	return thisArray[1];
};