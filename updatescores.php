<?php 

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

	$email = "";
	if (isset($_SESSION["username"])){
		$email =  $_SESSION["email"];
		echo($email);
	}
	else {
		//TO BE DONE. Why are we not getting the email here.
		$email = "admin@fhi360.com";
		phpAlert ("Email was blank");
	}

	$sql = "";
	$question_id = (int)$_POST['questionID'];
	$score = (int) $_POST['score'];
	$questiononpage = (int) $_POST['questiononpage'];
	$result = "";
	$resultnew = "";
	$resultagain = "";
	$quiz_id = "";

	if ($questiononpage == 0){
		$sql = "INSERT INTO quiz_attempted (email) values ('" . $email . "')";
		$result = mysqli_query($db, $sql);
		if ($result){
			//do nothing
		}
		else{
			echo (mysqli_error($db));
		}
	}

	$sql = "SELECT max(id) as id from quiz_attempted WHERE email ='" . $email . "'";
	$resultnew = mysqli_query($db, $sql);
	if ($resultnew->num_rows > 0){
		while($row = mysqli_fetch_array($resultnew)){
			$quiz_id = $row['id'];
		}
	}


	//get the current quiz being taken by the email ID. This would mean that this is the current quiz.
	$sql = "INSERT INTO quiz_scores values(".$quiz_id. ", " .$question_id. ", " .$score.")";
	$resultagain = mysqli_query($db, $sql);
	if ($resultagain){
		//we have been successful in inserting the record into the database
	}
	else{
		echo (mysqli_error($db));	
	}


	//closing the connection string
	mysqli_close($db);

	function phpAlert($msg) {
	    echo '<script type="text/javascript">alert("' . $msg . '")</script>';
	}

?>