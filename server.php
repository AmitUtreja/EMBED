<?php 
	
	session_start();

	$username = "";
	$email = "";
	$password_1 = "";
	$password_2 = "";

	$errors = array();
	$success = array();

	//adding all the variables which are being passed back through a POST request from
	//addquestions.php for saving the questions into the database
	$question = "";
	$answerDetails = "";
	$answerA = "";
	$answerB = "";
	$answerC = "";
	$answerD = "";
	$correctAnswer = "";

	//connect to the database
	//pick up the configuration values of the database parameters from config.php
	$dbdetails = include('config.php');
	$db = mysqli_connect($dbdetails['host'], $dbdetails['username'], $dbdetails['password'], $dbdetails['dbname']);

	if (mysqli_connect_errno()){
		array_push($errors, mysqli_connect_error());
		die ();
	}
	else{
		//setting the necessary character set combinations in PHP to store Hindi text
		// tomorrow when we have to extend the project for African countries then this
		//will be all the more valuable.
		mysqli_query($db, 'SET character_set_results=utf8');
		mysqli_query($db, 'SET names=utf8');
		mysqli_query($db, 'SET character_set_client=utf8');
		mysqli_query($db, 'SET character_set_connection=utf8');
		mysqli_query($db, 'SET character_set_results=utf8');
		mysqli_query($db, 'SET collation_connection=utf8_general_ci');
		mysqli_set_charset($db, "utf-8");
	}


	//if the register button is clicked
	//while getting the value of variables username, email and password we should make sure
	//there are no HTML entities entered there. Characters are recognizable and also first step
	//to prevent phishing attacks
	if(isset($_POST['register'])){
		$username = mysqli_real_escape_string($db, htmlentities($_POST['username'], ENT_QUOTES, 'UTF-8'));
		$email = mysqli_real_escape_string($db, htmlentities($_POST['email'], ENT_QUOTES, 'UTF-8'));
		$password_1 = mysqli_real_escape_string($db, htmlentities($_POST['password_1'], ENT_QUOTES, 'UTF-8'));
		$password_2 = mysqli_real_escape_string($db, htmlentities($_POST['password_2'], ENT_QUOTES, 'UTF-8'));

		if(empty($username)){
			array_push($errors, "User Name is required");
		}
		if(empty($email)){
			array_push($errors, "Email Address is required");
		}
		else if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
			array_push($errors, "Please enter a Valid Email format");
		}
		if(empty($password_1)){
			array_push($errors, "Password is required");
		}

		if($password_1 != $password_2){
			array_push($errors, "The two passwords do not match");	
		}

		//if there are no errors recorded then we insert the values into the database
		if (count($errors) == 0){
			$password = md5($password_1); // this will encrypt the password before storing in the database
			$sql = "INSERT INTO users(name, email, password) VALUES('" . $username . "', '" . $email . "', '" . $password . "')";
			$result = mysqli_query($db, $sql);

			if ($result){
				$_SESSION['username'] = $username;
				$_SESSION['email'] = $email;
				$_SESSION['success'] = "You are now logged in";
				header('location: index.php'); // redirecting to the home page after successful login
			}
			else{
				if (mysqli_errno() == 1062){
					array_push($errors, "You are already a valid user! Please go directly to the Login page!!");
				}
				else{
					array_push($errors, mysqli_error($db));
				}
			}

		}

	}


	//This code will handle the request to reset the password from forgot_password.php
	//The testing for this needs to be done. Now that I am done with the admin part of 
	//everything except reports which we will see after we start puttint the scores, I
	// am going to focus on the quiz part. TESTING TO BE DONE.
	if (isset($_POST['resetpassword'])){
		$result = "";
		$password_1 = mysqli_real_escape_string($db, htmlentities($_POST['password_1'], ENT_QUOTES, 'UTF-8'));
		$password_2 = mysqli_real_escape_string($db, htmlentities($_POST['password_2'], ENT_QUOTES, 'UTF-8'));
		$email = mysqli_real_escape_string($db, htmlentities($_POST['email'], ENT_QUOTES, 'UTF-8'));

		if(empty($email)){
			array_push($errors, "Email Address is required to reset your password");
		}
		else if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
			array_push($errors, "Please enter a Valid Email format");
		}

		if(empty($password_1)){
			array_push($errors, "Password is required");
		}

		if($password_1 != $password_2){
			array_push($errors, "The two passwords do not match");	
		}

		if (count($errors) == 0){
			$password = md5($password_1); // this will encrypt the password before storing in the database
			$sql = "UPDATE users SET password = '" . $password . "' where email = '" . $email . "'";  
			$result = mysqli_query($db, $sqlnew);
			if ($result){
				array_push($errors, "Your password has been successfully reset");
			}
			else{
				array_push($errors, mysqli_error($db));
			}
		}
	}

	//this part will handle the forgotpassword functionality where we will send an email to 
	//the user with the new password. Since this will require SMTP server configuration and 
	// SMTP port, I am thinking that we will first just redirect the user to the 
	//forgot_password.php page and let him/her set the password.
	//so for now I am commecting this code, we might want to use it later.
	//the same logic will work from login.php and registration.php pages
	if (isset($_POST['forgotpassword'])){
		$result = "";
		$email = mysqli_real_escape_string($db, htmlentities($_POST['email'], ENT_QUOTES, 'UTF-8'));

		if(empty($email)){
			array_push($errors, "Email Address is required to reset your password");
		}
		else if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
			array_push($errors, "Please enter a Valid Email format");
		}
		if (count($errors) == 0){
			array_push($errors, "entered the redirection part");
			//first we will check if the user is a valid user and has registered with us or not.
			//if not then we will ask the user to first register. 
			$sql = "SELECT 1 from users where email = '" . $email . "'";
			$result = mysqli_query($db, $sql);
			if ($result){
				//if the user is valid then re-direct him/her to the password reset page
				header('location: forgot_password.php');
			}
			else{
				array_push($errors, "The email ID you have entered is not valid. Please go and register yourself in our system first!!");
			}
		}
	}
	/*
	if(isset($_POST['forgot_password'])){
		$email = mysqli_real_escape_string($db, htmlentities($_POST['email'], ENT_QUOTES, 'UTF-8'));

		if(empty($email)){
			array_push($errors, "Email Address is required to send you the new password");
		}
		else if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
			array_push($errors, "Please enter a Valid Email format");
		}
		$password_1 = "embed"; // we are hard coding the new password for every
		//user who has forgotten the password to embed.

		//if there are no errors recorded then we insert the values into the database
		if (count($errors) == 0){
			//first we will check if the user is a valid user and has registered with us or not.
			//if not then we will ask the user to first register. 
			$sql = "SELECT 1 from users where email = '" . $email . "'";
			$result = mysqli_query($db, $sql);
			$resultnew = "";
			$sqlnew = "";
			
			if ($result){
				$password = md5($password_1); // this will encrypt the password before storing in the database
				$sqlnew = "UPDATE users SET password = '" . $password . "' where email = '" . $email . "'";  
				$resultnew = mysqli_query($db, $sqlnew);
				if ($resultnew){
					//ADD CODE TO SEND A MAIL TO THE USER's EMAIL Address with the new password
					$to = $email;
					$subject = "Password re-set request for project EMBED";
					$txt = "Dear User,<br > Greetings from Project Embed!!! <br >. 
					Based on your request we have reset your password to the word 'embed'. <br > 
					Just a reminder, please do not use quotes (') while entering your new password. <br >
					Hope you have a great day. <br>
					Always there to help you. <br >
					Project EMBED Technical Support Team";
					$headers = "From: support@projectembed.com" . "\r\n";
					mail($to,$subject,$txt,$headers);
				}
				else{
					array_push($errors, mysqli_error($db));
				}
			}
			else{
				if (mysqli_errno() == 1062){
					array_push($errors, "The email ID you have entered is not valid. Please go and register yourself in our system first!!");
				}
				else{
					array_push($errors, mysqli_error($db));
				}
			}

		}
	}
	*/


	/*
	this part of the code will handle the login functionality
	*/
	if(isset($_POST['login'])){
		$email = mysqli_real_escape_string($db, htmlentities($_POST['email'], ENT_QUOTES, 'UTF-8'));
		$password = mysqli_real_escape_string($db, htmlentities($_POST['password'], ENT_QUOTES, 'UTF-8'));

		if(empty($email)){
			array_push($errors, "Email Address is required!!");
		}
		if(empty($password)){
			array_push($errors, "Password is required!!");	
		}

		//if there are no errors recorded then we insert the values into the database
		if (count($errors) == 0){
			$sql = "SELECT role, name, users.email from users inner join user_role on users.email = user_role.email
			where users.email = '" . $email . "' 
			and users.password = md5('" . $password . "')";
			$result=mysqli_query($db, $sql);

			if ($result->num_rows > 0){
					while($row = mysqli_fetch_array($result)){
						$username = $row['name'];
						$role = $row['role'];
					}
				/*array_push($errors, "User successfully logged in");
				while($row = $result->fetch_assoc()){
					array_push($errors, "User Name is: " . $row['name']);
					array_push($errors, "Password is: " . $row['password']);
				}*/
				$_SESSION['username'] = $username;
				$_SESSION['role'] = $role;
				$_SESSION['email'] = $email;
				$_SESSION['success'] = "You are now logged in";
//				mysqli_close($db);
				header('location: index.php'); // redirecting to the home page after successful login
			}
			else{
				array_push($errors, mysqli_error($db));
				array_push($errors, "Either of username or the password is not correct");
			}
		}
	}

	//this method will be responsible for saving the question filled in the addquestions.php
	//into the database. One major part of the admin screen will be done with this function
	if(isset($_POST['savequestion'])){

		$question = mysqli_real_escape_string($db, htmlentities($_POST['question'], ENT_QUOTES, 'UTF-8'));
		$answerA = mysqli_real_escape_string($db, htmlentities($_POST['answerAtext'], ENT_QUOTES, 'UTF-8'));
		$answerB = mysqli_real_escape_string($db, htmlentities($_POST['answerBtext'], ENT_QUOTES, 'UTF-8'));
		$answerC = mysqli_real_escape_string($db, htmlentities($_POST['answerCtext'], ENT_QUOTES, 'UTF-8'));
		$answerD = mysqli_real_escape_string($db, htmlentities($_POST['answerDtext'], ENT_QUOTES, 'UTF-8'));
		$answerDetails = mysqli_real_escape_string($db, htmlentities($_POST['correctAnswertext'], ENT_QUOTES, 'UTF-8'));
		$correctAnswer = mysqli_real_escape_string($db, htmlentities($_POST['correctChoice'], ENT_QUOTES, 'UTF-8'));
		$correctAnswer = str_replace(' ', '', $correctAnswer);

		if(empty($question)){
			array_push($errors, "Question text field cannot be blank");
		}
		if(empty($answerA)){
			array_push($errors, "Please provide Answer A in the respective text field");
		}
		if(empty($answerB)){
			array_push($errors, "Please provide Answer B in the respective text field");
		}
		if(empty($answerC)){
			array_push($errors, "Please provide Answer C in the respective text field");
		}
		if(empty($answerD)){
			array_push($errors, "Please provide Answer D in the respective text field");
		}
		if(empty($answerDetails)){
			array_push($errors, "Please provide Answer Details in the respective text field");
		}
		if(empty($correctAnswer)){
			array_push($errors, "Please provide Correct Answer choise from the drop down menu");
		}

		//if there are no errors recorded then we insert the values into the database
		if (count($errors) == 0){
			$sql = "";
			$sql = "SELECT max(sequence_no) as sequence_no from questions";
			$result=mysqli_query($db, $sql);
			//we are putting the sequence of the questions by default.
			//keeping things simple and not asking the user to change the sequence of the 
			//questions. The sequence in which they enter the questions the same sequence
			//will be visible to the users
			if ($result->num_rows > 0){
				while($row = mysqli_fetch_array($result)){
					$sequenceno = $row['sequence_no'];
				}
			}

			if ($sequenceno == 0){
				$sequenceno = 1;
			}
			else{
				$sequenceno = $sequenceno + 1;
			}

			$status = "Active";
			$email = $_SESSION['email'];

			$sql = "INSERT INTO questions(email, sequence_no, question_text, 
				answer_a, answer_b, answer_c, answer_d, answer_details, 
				correct_answer, status) VALUES('" . $email . "', $sequenceno, '" . $question . "',
				'" . $answerA . "', '" . $answerB . "', '" . $answerC . "', '" . $answerD . "',
				'" . $answerDetails . "', '" . $correctAnswer . "', '" . $status . "')";
			$result = mysqli_query($db, $sql);

			if ($result){
				phpAlert("Question successfully added to the quiz.");
				//clear all the data from the text boxes
				$question = "";
				$answerA = "";
				$answerB = "";
				$answerC = "";
				$answerD = "";
				$answerDetails = "";
				$correctAnswer = "";
			}
			else{
				array_push($errors, mysqli_error($db));
				array_push($errors, "There was a problem saving the values in the database. 
					Please contact the website administrator!! Aplogies for the inconvenience");
			}
		}
	}

	//handling the logout functionality
	if (isset($_GET['logout'])){
		session_destroy();
		unset($_SESSION['username']);
		header('location: login.php');
	}

	/*Handling the play quiz functionality from here
	Handling the stage where the user has pressed the start quiz button
	we will load a new page with the first question and the basic format
	of the quiz and then we will keep changing the question text and the 
	back ground images being shown to the user. When you are redirecting a user on another page
	from a button click it is important that the type should be button and not submit
	*/

	if (isset($_GET['playquiz'])){
		header('location: playquiz.php');
	}

	//Handling the Add questions functionality from here
	if (isset($_GET['AddQuestions'])){
		if ($_SESSION['role'] == 'admin'){
			header('location: addquestions.php');
		}
		else{
			// This is how we display an alert message in php where we do not want the user to do something
			//or alert the user on something.
			phpAlert("You are not an admin and have no permissions to do this task. You can choose to play the quiz.");
		}
	}

	//Handling the Edit questions functionality from here
	if (isset($_GET['EditQuestions'])){
		if ($_SESSION['role'] == 'admin'){
			header('location: editquestions.php');
		}
		else{
			// This is how we display an alert message in php where we do not want the user to do something
			//or alert the user on something.
			phpAlert("You are not an admin and have no permissions to do this task. You can choose to play the quiz.");
		}
	}

	//generic PHP function to throw an java script alert popup when needed
	function phpAlert($msg) {
    echo '<script type="text/javascript">alert("' . $msg . '")</script>';
	}

	// have to check what will this be doing. I think I have handled it somewhere else.
	//THIS CHECK NEEDS TO BE DONE.
	if (isset($_GET['showquestions'])){
		header('location: quizquestion.php');
	}
?>