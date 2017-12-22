<?php include('server.php'); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head><meta charset="utf-8" /><meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="shortcut icon" href="images/fhi360shortcut.jpg" />
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/embed.css" rel="stylesheet">
	<script src="js/jquery-3.2.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/main.js"></script>
	<title>fhi360 | Add Questions</title>

	<script type="text/javascript">

	$(document).ready(function(){

		//declaring this variable outside the block to make it global to the script
		//as we need to post it to server.php on click of the savequestion button
		var finalChoice = '';
		//Code to change the text of the drop down selected in the answer choice selection
		//drop down menu and then changing the text accordingly.
        $(".dropdown-menu li a").click(function(){
        	//this code will change the text of the drop down based on the user selection
        	$("#selected").html($(this).html() + '<span class="caret"></span>');
        	//this will select the value into the variable selText
        	var selText = $(this).html();
        	//this will remove all the leading the trailing /&nbsp and give you only the text "Choice A" 
        	var finalValue = selText.replace(/&nbsp;/g, ' ').replace(/^\s+|\s+$/g, '');

        	//since we will be getting "Choice A" in the finalValue we will split into an Array
        	//based on " " empty space as the delimiter and use that to put Choice in array element 0
        	//and A in array element 1.
        	var thisArray = finalValue.split(" ");
        	finalChoice = thisArray[1];
        	//values have to passed within'' + variable + '' wasted so much time here today, not a joke
        	$("#correctChoiceid").val(''+ finalChoice + '');
        });

	});

	</script>

</head>

<body>
	<?php if (isset($_SESSION["username"])){
			$LoggedinUser = $_SESSION["username"];
			$UserRole = $_SESSION["role"];
		}
		else{
			header('location: login.php');
		}
	?>
	
	<!-- We are putting everything in a fluid container so that the resizing of the screen
	does not make the logo files disappear from the screen. Currently in css their positions
	are absolute but this should not be the case. We need to use bootstrap columns to adjust the
	logos of MOHFW and FHI.-->
	<div class="container-fluid">
		<div class="row" id="indexheader">
			<div class="col-md-1"> <!-- id="MOHFW" -->
				<a href="https://mohfw.gov.in" title="Ministry of Health and Family Welfare"> 
					<img src="images/MOHFW.png" height="125" width="150"/>
				</a>
			</div>
			<div class="col-md-9">
				<p style="font-weight: bold; color: blue; font-size: 40px;text-shadow: 1px 1px yellow; 
				text-align: center; padding:35px 0 0 50px;">Welcome to Add New Questions</p>
			</div>
			<div class="col-md-1"> <!-- id="FHI"-->
				<a href="https://fhi360.org" title="Family Health International"> 
					<img src="images/fhi360.png" height="125" width="150"/></a>
			</div>
		</div>
	</div>
<!--
	We are adding the questions here for adding new questions. Since only an admin will be 
	able to add questions the email ID which needs to be sent to the data base is autopopulated
	from the session object
-->
<div class="container-fluid">

	<!-- Display the validation errors here -->
	<?php include('registration_errors.php'); ?>

	<form class="form-horizontal" id="addquestion" method="post" action="addquestions.php">
	    <div class="form-group">
	        <label for="question" class="control-label col-xs-1">Question: </label>
	        <div class="col-xs-11">
	            <input type="text" class="form-control" name="question" 
	            placeholder="Enter Question" value="<?php echo $question; ?>">
	        </div>
	    </div>
	    <div class="form-group">
	        <label for="optionA" class="control-label col-xs-1">Option A: </label>
	        <div class="col-xs-4">
	            <input type="text" class="form-control" name="answerAtext" 
	            placeholder="Enter Option A" value="<?php echo $answerA; ?>">
	        </div>
	        <label for="optionB" class="control-label col-xs-1">Option B: </label>
	        <div class="col-xs-4">
	            <input type="text" class="form-control" name="answerBtext" 
	            placeholder="Enter Option B" value="<?php echo $answerB; ?>">
	        </div>
	    </div>
	    <div class="form-group">
	        <label for="optionC" class="control-label col-xs-1">Option C: </label>
	        <div class="col-xs-4">
	            <input type="text" class="form-control" name="answerCtext" 
	            placeholder="Enter Option C" value="<?php echo $answerC; ?>">
	        </div>
	        <label for="optionD" class="control-label col-xs-1">Option D: </label>
	        <div class="col-xs-4">
	            <input type="text" class="form-control" name="answerDtext" 
	            placeholder="Enter Option D" value="<?php echo $answerD; ?>">
	        </div>
	    </div>
	    <div class="form-group">
	        <label for="answer" class="control-label col-xs-1">Answer : </label>
	        <div class="col-xs-11">
	            <input type="text" class="form-control" name="correctAnswertext" 
	            placeholder="Enter Answer Details" value="<?php echo $answerDetails; ?>">
	        </div>
	    </div>
	    <div class="form-group">
	    	<input type="hidden" name="correctChoice" id="correctChoiceid"/>
	        <label for="answer" class="control-label col-xs-1">Correct Answer : </label>
			<div class="dropdown col-xs-2">
				<!-- button ID is called "selected" this will be used up in the javascript code 
				to change the selection and show the selected text based on the users selection
				-->
				<button id="selected" name="selectedChoice" class="btn btn-default dropdown-toggle" type="button" 
				data-toggle="dropdown" style="background:green; text-color:black">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Correct Answer
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<span class="caret" id="opt"></span></button>
				<ul class="dropdown-menu dropdown-menu-right dropdown-menu-wide" id="answerchoice">
					<li><a class="dropdown-item" id="A">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Option A
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></li>
					<li><a class="dropdown-item" id="B">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Option B
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></li>
					<li><a class="dropdown-item" id="C">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Option C
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></li>
					<li><a class="dropdown-item" id="D">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Option D
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></li>
				</ul>
			</div>
 	    </div>
 	   	<div class="form-group">
 	   		<div class="col-xs-5">
				<!-- adding the submit button in the form group to save the added text to the database-->
				<button type="submit" name="savequestion" id="savequestionid" 
				class="btn btn-outline-success btn-lg" style="background:blue">Save Question</button>
			</div>
 	   		<div class="col-xs-7">
				<!-- adding the submit button in the form group to save the added text to the database-->
				<a type="btn" name="mainpage" id="mainpageid" href="index.php" 
				class="btn btn-outline-success btn-lg" style="background:blue">Main Page</a>
			</div>
		</div>
	</form>
</div>

</body>

</html>