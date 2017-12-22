<?php include('server.php');?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head><meta charset="utf-8" /><meta name="viewport" 
	content="width=device-width, initial-scale=1.0" />
	<link rel="shortcut icon" href="images/fhi360shortcut.jpg" />
	<!-- adding the referrence of the bootstrap css -->
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<!-- adding the referrence of the project specific css style sheet -->
	<link href="css/embed.css" rel="stylesheet">
	<!-- adding the referrence of the jQuery javascripts file -->
	<script src="js/jquery-3.2.1.min.js"></script>
	<!-- adding the referrence of the Bootstrap javascripts file -->
	<script src="js/bootstrap.min.js"></script>
	<!-- adding the referrence of our project jQuery file -->
	<script src="js/main.js"></script>
	<title>fhi360 | Edit Questions</title>

	<script type="text/javascript">

		//writing a function after looking at the Youtube video:
		//https://www.youtube.com/watch?v=8mTIuuOGbY which shows how to insert, Edit and detele
		//data using simple jQuery, AJAX and PHP to do this without any plugins
		$(document).ready(function(){

			function fetchquestions_data(){
				$.ajax({
					url:"fetchdata.php", 
					method:"POST",
					success: function(response){
						//console.log(response);
						//doing this and alerting creates a spring respresentation of an object
						//and we will get [object Object] which is the string representation of
						//a object in string
						var $content = "";
						$content = $.parseJSON(response);
						console.log($content);
   						//$("#questions_table").find("tr:gt(0)").remove();
						var trHTML = '';
						$.each($content, function(key, value){
							trHTML += '<tr><td>'+ value.id + '</td>' + 
								'<td class="question_text" data-id1= "' + value.id + '" contenteditable>' 
								+ value.question_text + '</td>' + 
								'<td class="answer_a" data-id2= "' + value.id + 
								'" contenteditable>' + value.answer_a + '</td>' + 
								'<td class="answer_b" data-id3= "' + value.id + 
								'" contenteditable>' + value.answer_b + '</td>' + 
								'<td class="answer_c" data-id4= "' + value.id + 
								'" contenteditable>' + value.answer_c + '</td>' + 
								'<td class="answer_d" data-id5= "' + value.id + 
								'" contenteditable>' + value.answer_d + '</td>' + 
								'<td class="answer_details" data-id6= "' + 
								value.id + '" contenteditable>' + value.answer_details + '</td>' + 
								'<td class="correct_answer" data-id7= "' 
								+ value.id + '" contenteditable>' + value.correct_answer + '</td>' +
								'<td><button class="btn btn-info btn-sm" id="btn_delete" name="btn_delete" data-id8= "' + value.id + '">'+ 'Delete' + 
								'</button></td>' + 
								'<td> </td>' + 
								'<tr>';
						});
						$('#questions_table').append(trHTML);
					}
				})
			}

			fetchquestions_data();

			function edit_data(id, text, column_name){
				$.ajax({
					url:"editdata.php", 
					method:"POST",
					dataType:"text",
					data:{id:id, text:text, column_name:column_name},
					success:function(data){
						//this line is required since the refresh was adding the rows to
						//the existing rows which should not be the case
						$("#questions_table").find("tr:gt(0)").remove();
						fetchquestions_data();						
					}
				});
			};

			//The syntax of "body" is added since JQuery does not recognise the buttons
			//added after the body is loaded
			$("body").on('click', '#btn_delete', function(){
				var id = $(this).data("id8");
				$(this).parents("tr").remove();
				$.ajax({
					url:"deletedata.php", 
					method:"POST",
					data:{id:id},
					dataType:"text",
					success:function(data){
						alert(data);
					}
				});
			});			

			//this question will handle the event when the user clicks on a question_text
			$(document).on('blur', '.question_text', function(){
				var id = $(this).data("id1");
				var text = $(this).text();
				edit_data(id, text, "question_text");
			});

			//this question will handle the event when the user clicks on answer_a
			$(document).on('blur', '.answer_a', function(){
				var id = $(this).data("id2");
				var text = $(this).text();
				edit_data(id, text, "answer_a");
			});

			//this question will handle the event when the user clicks on answer_b
			$(document).on('blur', '.answer_b', function(){
				var id = $(this).data("id3");
				var text = $(this).text();
				edit_data(id, text, "answer_b");
			});

			//this question will handle the event when the user clicks on answer_c
			$(document).on('blur', '.answer_c', function(){
				var id = $(this).data("id4");
				var text = $(this).text();
				edit_data(id, text, "answer_c");
			});

			//this question will handle the event when the user clicks on answer_d
			$(document).on('blur', '.answer_d', function(){
				var id = $(this).data("id5");
				var text = $(this).text();
				edit_data(id, text, "answer_d");
			});

			//this question will handle the event when the user clicks on answer_details
			$(document).on('blur', '.answer_details', function(){
				var id = $(this).data("id6");
				var text = $(this).text();
				edit_data(id, text, "answer_details");
			});

			//this question will handle the event when the user clicks on correct_answer
			$(document).on('blur', '.correct_answer', function(){
				var id = $(this).data("id7");
				var text = $(this).text();
				edit_data(id, text, "correct_answer");
			});
		});

	</script> 

	<style>
	/* adding the back ground color for all elements of the table, th, tr and td*/
		table, th, tr, td{
			background-color: green;
			border: 1px solid blue;
		}
	</style>

</head>

<body>
<?php if (isset($_SESSION["username"])){
			$LoggedinUser = $_SESSION["username"];
			$UserRole = $_SESSION["role"];
		}
		else{
			//the header function was causing an issue, I will have to write a generic
			//java function in main.js and then call it from here for re-directing users
			//to the login page if they come from anywhere else directly to the page.
			//THIS HAS TO BE DONE. 
			//header("location: login.php, true, 302");
			echo ("<script type='text/javascript'>window.location.href = 'login.php';</script>");
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
				<p style="font-weight: bold; color: blue; font-size: 
				40px;text-shadow: 1px 1px yellow; text-align: 
				center; padding:35px 0 0 50px;">Welcome to Edit Questions</p>
				<a type="link" name="mainpage" id="mainpageid" href="index.php" 
				style="font-weight:bold; color:	green; font-size:18px; 
				background:DARKCYAN" onmouseover="this.style.color='yellow'"
				onmouseout="this.style.color='green'">
				Back to Main Page</a>
			</div>
			<div class="col-md-1"> <!-- id="FHI"-->
				<a href="https://fhi360.org" title="Family Health International"> 
					<img src="images/fhi360.png" height="125" width="150"/></a>
			</div>
		</div>
	</div>
<!--
	We are going to display the existing questions to the user and allow the user to edit a 
	question and save it using ajax calls to server.php. We will see if we can show pagination or display all the questions in one table at one shot. Will not make it too complicated
	for now and keep it simple.
-->
	<div class="container-fluid">

		<!-- Display the validation errors here -->
		<?php include('registration_errors.php'); ?>

		<div id="live_data" class="col-sm-12">
		<!-- data-toggle="bootgrid" will initialize the jQuery bootgrid which we
				are using here to modify or delete the questions from the table
				since we are going to get the data from the server.php we will
				also have to initialize the ajax calls. We have also set data-ajax
				to true. lets see what happens with that.-->
		<table id="questions_table" class="table table-responsive table-hover table-striped" 
			width="30%" style="border: 1px solid blue;"
			cellspacing="0">
			<thead>
				<tr style="border: 1px solid blue;">
					<!-- the id column in the primary key from the database with the same
						column name. we have put the data-identifier="true" here -->
					<th data-column-id="id" data-type="numeric" 
					data-identifier="true" width="5%">ID</th>
					<th data-column-id="question_text" width="25%">Question</th>
					<th data-column-id="answer_a" width="10%">Option A</th>
					<th data-column-id="answer_b" width="10%">Option B</th>
					<th data-column-id="answer_c" width="10%">Option C</th>
					<th data-column-id="answer_d" width="10%">Option D</th>
					<th data-column-id="answer_details" width="22%">Answer Details</th>
					<th data-column-id="correct_answer" width="5%">Correct Choice</th>
					<th data-column-id="actions" width="7%">Actions</th>
				</tr>
			</thead>
		</table>
		</div>
	</div>

</body>

</html>