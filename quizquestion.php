<?php include('server.php'); ?>
<?php include('updatescores.php'); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head><meta charset="utf-8" /><meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="shortcut icon" href="images/fhi360shortcut.jpg" />
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/embed.css">
	<script src="js/jquery-3.2.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/main.js"></script>	
	<title>Quiz Questions</title>


</head>

<body class="quizbody">
		<?php if (isset($_SESSION["username"])){
			$LoggedinUser = $_SESSION["username"];
			$UserRole = $_SESSION["role"];
			$email =  $_SESSION["email"];
			echo($email);
		}
		else{
			echo ("<script type='text/javascript'>window.location.href = 'login.php';</script>");
		}
		?>
	<!-- we need to add the audio file like the one in the presentation
	-->
	<div id="quizquestionlogos">
		<div class="container-fluid" >
			<div class="row">	
				<div class="col-sm-3" id="lifelinelogo">
					<p><img src="images/leftlogo.png" height="300" width="250"/> </p>
				</div>
				<div class="col-sm-3" id="questionsimage">
					<p><img src="images/MissionIndradhanushNew.jpg" height="300" width="550"/></p>
				</div>
				<!-- Here we will add the container which will contain the score card for the questions
				which are being attempted by the user.
				-->
				<div class="col-sm-2 col-sm-offset-3" id="scorecard" 
				style="box-shadow: inset 1px -1px 1px #444, 
				inset -1px 1px 1px #444; font-size:14px; 
				border: 2px solid blue; text-align:left;">
					<a style="text-decoration:none;color:white;" 
					href="#" id="score15">15 Saved 1 MILLION <br /></a>
					<a style="text-decoration:none" 
					href="#" id="score14">14 Saved 500,000 <br /></a>
					<a style="text-decoration:none" 
					href="#" id="score13">13 Saved 250,000 <br /></a>
					<a style="text-decoration:none" 
					href="#" id="score12">12 Saved 125,000 <br /></a>
					<a style="text-decoration:none" 
					href="#" id="score11">11 Saved 64,000 <br /></a>
					<a style="text-decoration:none;color:white;" 
					href="#" id="score10">10 Saved 32,000 <br /></a>
					<a style="text-decoration:none" 
					href="#" id="score9">9 Saved 16,000 <br /></a>
					<a style="text-decoration:none" 
					href="#" id="score8">8 Saved 8,000 <br /></a>
					<a style="text-decoration:none" 
					href="#" id="score7">7 Saved 4,000 <br /></a>
					<a style="text-decoration:none" 
					href="#" id="score6">6 Saved 2,000 <br /></a>
					<a style="text-decoration:none;color:white;" 
					href="#" id="score5">5 Saved 1,000 <br /></a>
					<a style="text-decoration:none" 
					href="#" id="score4">4 Saved 500 <br /></a>
					<a style="text-decoration:none" 
					href="#" id="score3">3 Saved 300 <br /></a>
					<a style="text-decoration:none" 
					href="#" id="score2">2 Saved 200 <br /></a>
					<a style="text-decoration:none" 
					href="#" id="score1">1 Saved 100 <br /></a>
				</div>
			</div> <!-- 1st row ends here -->
		</div>
		<div class="container-fluid" >
			<div class="row">	
				<div class="col-sm-12" id="godhelpquestion">
					<a  href="#" id="question_text" style="text-decoration:none; color:white;"> 
						</a><!--बचे को जन्म पे कौन्से टीके दिय जाते हैं........... </a>-->
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12">
					<div class="row">
						<div class="col-sm-6" id="godhelpanswer1" class="godhelpanswer1">
							<!-- Here currently I am hardcoding the values but later 
							on I will get the values from the Ddtabase. 
							THIS NEEDS TO BE DONE. -->
							<a  href="#" class="answer_A" id="answer_A"style="text-decoration:none; color:white;"> 
								<span style="color:orange;"> A: </span></a>
								<!--हेप बी, ओ पी वी, हिब </a>-->
						</div>
						<div class="col-sm-6" id="godhelpanswer2">
							<!-- Here currently I am hardcoding the values but later 
							on I will get the values from the Ddtabase. 
							THIS NEEDS TO BE DONE. -->
							<a  href="#" id="answer_B" style="text-decoration:none; color:white;"> 
								<span style="color:orange;"> B: </span>
							</a><!--हेप बी, ओ पी वी, बी सी जी </a>-->
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12">
					<div class="row">
						<div class="col-sm-6" id="godhelpanswer3">
							<!-- Here currently I am hardcoding the values but later 
							on I will get the values from the Ddtabase. 
							THIS NEEDS TO BE DONE. -->
							<a  href="#" id="answer_C" style="text-decoration:none; color:white;"> 
								<span style="color:orange;"> C: </span>
							</a><!--हेप बी, पेंटा, डी पी टी </a>-->
						</div>
						<div class="col-sm-6" id="godhelpanswer4">
							<!-- Here currently I am hardcoding the values but later 
							on I will get the values from the Ddtabase. 
							THIS NEEDS TO BE DONE. -->
							<a  href="#" id="answer_D" style="text-decoration:none; color:white;"> 
								<span style="color:orange;"> D: </span>
							</a><!--टेटेनस, ओ पी वी, बी सी जी </a>-->
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-11">
					<button class="btn btn-info btn-sm" 
					id="btn_next" name="btn_next" style="background-color:black; 
					border:1px solid blue;"> Next Question</button>
				</div>
			</div>
		</div>


	<script type="text/javascript">

		var questions = [];
		var answersA = [];
		var answersB = [];
		var answersC = [];
		var answersD = [];
		var answerdetails = [];
		var correctanswers = [];
		var questionIDs = [];
		var currentquestioncorrectchoice = "";
		var currentanswerdetails = "";
		var questiononpage = 0;
		var questionID;
		var count = 0;
		var score = 0;
		var email = "";

		$(document).ready(function(){


			playAudioClip();
			fetchquestions_data();	
			
/*			setquestions_data();
			setquestions_image();
			refresh_scores();
			alert("Not sure how this comes first");
			alert(questions[questiononpage]);*/

		});

		$("#godhelpanswer1").on("mouseover", function() {
  			$(this).css( "color", "green");
  			$(this).css( "font-size", "30px");
		});

		$("#godhelpanswer1").on("mouseout", function() {
  			$(this).css( "color", "yellow");
  			$(this).css( "font-size", "25px");
		});

		$("#godhelpanswer2").on("mouseover", function() {
  			$(this).css( "color", "green");
  			$(this).css( "font-size", "30px");
		});

		$("#godhelpanswer2").on("mouseout", function() {
  			$(this).css( "color", "yellow");
  			$(this).css( "font-size", "25px");
		});

		$("#godhelpanswer3").on("mouseover", function() {
  			$(this).css( "color", "green");
  			$(this).css( "font-size", "30px");
		});

		$("#godhelpanswer3").on("mouseout", function() {
  			$(this).css( "color", "yellow");
  			$(this).css( "font-size", "25px");
		});

		$("#godhelpanswer4").on("mouseover", function() {
  			$(this).css( "color", "green");
  			$(this).css( "font-size", "30px");
		});

		$("#godhelpanswer4").on("mouseout", function() {
  			$(this).css( "color", "yellow");
  			$(this).css( "font-size", "25px");
		});		
		//playing the quiz starting audio file
		function playAudioClip(){
			var obj = document.createElement("audio");
    		obj.src="media/startquiz.WAV";
			obj.play();
		}

		$("#godhelpanswer1").on("click", function(){
			checkcorrect_answer(questiononpage, "A");
		});

		$("#godhelpanswer2").on("click", function(){
			checkcorrect_answer(questiononpage, "B");
		});

		$("#godhelpanswer3").on("click", function(){
			checkcorrect_answer(questiononpage, "C");
		});

		$("#godhelpanswer4").on("click", function(){
			checkcorrect_answer(questiononpage, "D");
		});

		$("#btn_next").on("click", function(){
			//lets show the text of the next question, set the questiononpage counter to next
			questiononpage++;
			//now we have to set the text of the next question and also change the image
			//first we will start with changing the text, then the score line and finally image
			if (score == 1){
				alert(questiononpage);
				$("#score" + questiononpage +"").css("color", "green");
			}
			setquestions_image(questiononpage);
			setquestions_data(questiononpage);
		});

		/*here will have to write an ajax code to get all the questions from the database
		and store it here, pass it to relevant code portion of this page to display
		the questions and then with every click start responding and checking what will
		happen what text will be shown and what images will start changing. From the point 
		of view of the game this is the most crucial page.
		*/
		function fetchquestions_data(){
			$.ajax({
				url:"fetchdata.php", 
				method:"POST",
				success: function(response){
					var $content = "";
					$content = $.parseJSON(response);
					console.log($content);
					$.each($content, function(key, value){
						questions[count] = value.question_text;
						answersA[count] = value.answer_a;
						answersB[count] = value.answer_b;
						answersC[count] = value.answer_c;
						answersD[count] = value.answer_d;
						answerdetails[count] = value.answer_details;
						correctanswers[count] = value.correct_answer;
						questionIDs[count] = value.id;
						count++;
						setquestions_data(questiononpage);
					});
				}
			})
		}

		function setquestions_data(questiononpage){
			/*$("#question_text").html("<a  style='text-decoration:none; 
				color:yellow; font-size: 20px'>" + questions[questiononpage] + "'</a>");*/
			$("#question_text").html("<a style='text-decoration:none;color:white; font-size: 20px;'>" 
				+ questions[questiononpage] + "</a>");
			$("#godhelpanswer1").text("A: " + answersA[questiononpage]);
			$("#godhelpanswer2").text("B: " + answersB[questiononpage]);
			$("#godhelpanswer3").text("C: " + answersC[questiononpage]);
			$("#godhelpanswer4").text("D: " + answersD[questiononpage]);
			currentquestioncorrectchoice = correctanswers[questiononpage];
			currentanswerdetails = answerdetails[questiononpage];
			questionID = questionIDs[questiononpage];
		}

		function setquestions_image(questiononpage){
			
		}

		function checkcorrect_answer(question_no, choice){
			if (choice == currentquestioncorrectchoice){
				//now that we have the correct answer we need to show the elaborate
				//answer and also remove the picture
				$("#questionsimage").html("<p style='color:red; font-size: 35px;'>" 
				+ currentanswerdetails + "</p>");
				//next we have to save the score
				score = 1;
				refresh_scores(questionID, score, questiononpage, email);
			}
			else{
				score = 0;
				refresh_scores(questionID, score, questiononpage, email);
			}
		}

		//email has to be sent from here. TO BE DONE.
		function refresh_scores(questionID, score, questiononpage, email){
			$.ajax({
				url:"updatescores.php", 
				method:"POST",
				dataType:"text",
				data:{questionID:questionID, score:score, questiononpage:questiononpage, email:email},
				success:function(data){
					//this line is required since the refresh was adding the rows to
					//the existing rows which should not be the case
					alert(data);
				}
			});
		}

		
	</script>

</body>
</html>