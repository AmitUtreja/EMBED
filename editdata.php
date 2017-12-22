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

	$sql = "";
	$id = $_POST['id'];
	$text = $_POST['text'];
	$column_name = $_POST['column_name'];

	$sql = "UPDATE questions set " . $column_name . " = '" . $text . "' where id = " . $id . "";
	phpAlert($sql);
	$result = mysqli_query($db, $sql);
	$output = "";

	if ($result){
		phpAlert("Question data updated successfully in the database");
	}
	else{
		phpAlert("There was an issue updating the question data into the database. Please contact your System Administrator");
	}

	mysqli_close($db);

	function phpAlert($msg) {
	    echo '<script type="text/javascript">alert("' . $msg . '")</script>';
	}

?>