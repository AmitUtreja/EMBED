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
	$sql = "DELETE from questions where id = " . $id . "";

	$result = mysqli_query($db, $sql);
	$output = "";

	if ($result){
		echo "Question successfully deleted from the quiz";
	}
	else{
		echo "There was an issue deleting the question data from the quiz. Please contact your System Administrator!!";
	}

	mysqli_close($db);

	function phpAlert($msg) {
	    echo '<script type="text/javascript">alert("' . $msg . '")</script>';
	}

?>