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

	$sql = "SELECT id, question_text, answer_a, answer_b, answer_c, answer_d, 
	answer_details, correct_answer FROM questions where status = 'Active' ORDER BY sequence_no desc";

	$result = mysqli_query($db, $sql);
	$output = "";
	$concatStr = "|";
	$rows = array();

	if (mysqli_num_rows($result) > 0){
		//All the data which was comming mismanaged when I was doing a mysqli_fetch_array($results)
		//has got sorted out and now we are getting the right columns while fetching the data
		//after doing a $row = $result->fetch_assoc()
		while ($row = $result->fetch_assoc()){
			/*echo "id:" . $row["id"] ." question_text:" . $row["question_text"].
			" answer_a:". $row["answer_a"]." answer_b:" . $row["answer_b"]
			." answer_c:" . $row["answer_c"]." answer_d:" . $row["answer_d"].
			"correct_answer:" . $row["correct_answer"]. "<br>"; 
			//we will have to create a custom JSON format here.
			we are sending back the data which is a concatenated string separated by |
			$output .= $row["id"] . $concatStr.$row["question_text"].$concatStr.
						$row["answer_a"].$concatStr.$row["answer_b"].
						$concatStr.$row["answer_c"].$concatStr.$row["answer_d"].
						$row["answer_details"].$concatStr.$row["correct_answer"].$concatStr;
			//we have sent to out put of one record back. We will have to check how do
			//we handle multiple records here.
			echo $output;*/
			//I WANT TO SEND THESE RECORDS IN JSON FORMAT AND I WANT TO SEE HOW THAT HAPPENS
			//THIS NEEDS TO BE DONE.
			//by adding data to the array we have now got three rows in JSON format and 
			//each row is going to have a data tag and then the values inside it
			//$rows[] = array('data' => $row);
			//this code above is used to insert a key element 'data' inside your JSON string 
			//but we don't need it 
			$rows[] = $row;
		}
	}
	else{
		phpAlert("No questions found in the database. Please go ahead and add some questions");
	}

	//encoding the data in the json format. JSON_UNESCAPED_UNICODE is very important here
	//this will ensure that the characters are translated to the language of choice. After
	//doing this I was able to see Hindi text for the first time from the calling function
	$json = json_encode($rows, JSON_UNESCAPED_UNICODE);
	//sending the data to editquestions.php
	echo $json;

	//closing the connection string
	mysqli_close($db);

	function phpAlert($msg) {
	    echo '<script type="text/javascript">alert("' . $msg . '")</script>';
	}

?>