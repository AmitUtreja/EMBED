<?php include('server.php'); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head><meta charset="utf-8" /><meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="shortcut icon" href="images/fhi360shortcut.jpg" />
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/embed.css" rel="stylesheet">
	<script src="js/jquery-3.2.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<title>fhi360 | Project EMBED</title>


</head>

<body>
	<?php if (isset($_SESSION["username"])){
			$LoggedinUser = $_SESSION["username"];
			$UserRole = $_SESSION["role"];
			$email = $_SESSION["email"];
			echo($email);
		}
		else{
			header('location: login.php');
		}
	?>

	<?php if (isset($_SESSION['username'])): ?>
	<div class="container-fluid">
		<div class="row" id="indexheader">
			<div class="col-md-1"> <!-- id="MOHFW" -->
				<a href="https://mohfw.gov.in" title="Ministry of Health and Family Welfare"> 
					<img src="images/MOHFW.png" height="125" width="150"/>
				</a>
			</div>
			<div class="col-md-9">
				<p style="font-weight: bold; color: blue; font-size: 40px;text-shadow: 1px 1px yellow; 
				text-align: center; padding:35px 0 0 50px;">
				प्रॉजेक्ट एमबेड में आपका स्वागत है <?php echo $LoggedinUser; ?></p>
			</div>
			<div class="col-md-1"> <!-- id="FHI"-->
				<a href="https://fhi360.org" title="Family Health International"> 
					<img src="images/fhi360.png" height="125" width="150"/></a>
			</div>
		</div>
	</div>
	<div class="container-fluid">
		<div class="nav-bar" id="indexnavigation">
			<ul class="nav-bar" style="font-size:19px">
				<li> <a href="#" title="Add New Users">Add Users</a> </li> 
				<li> <a href="#" title="Delete Users">Delete Users</a> </li>
				<li> <a href="#" title="View Quiz Scores">View Scores</a> </li> 
				<li> <a href="index.php?AddQuestions='1'" 
					id="AddQuestions"title="Add Quiz Questions">Add Questions</a></li>
				<li> <a href="index.php?EditQuestions='1'" 
					title="Edit Quiz Questions">Edit Questions</a></li>
				<!-- TO BE DONE. WHen the user clicks on playquiz, I will have to ask\
					if the user who is logged in is going to play the quiz or will someone else
					be playing thje quiz. This is on similar lines to the fact that if a team
					member of project EMBED is going to play the quiz vs a quack is going to 
					play the quiz on the tablet of the project EMBED team member. 
					THIS NEEDS TO BE DONE. Will come back to this after finishing the quiz-->
				<li> <a href="index.php?playquiz='1'" 
					title="Play Quiz Right Now">Play Quiz</a></li>
				<li> <a href="index.php?logout='1'" title="Logout" 
					onmouseover="this.style.color='red'" 
					onmouseout="this.style.color='orange'">Logout</a></li>
			</ul>
		</div>
	</div>

	<div id="mainbody">
	<marquee behavior="scroll" direction="left">
		<blockquote style="border-left:none; color:green;">
			“India’s infant mortality rate is 39, which means that an estimated 9.9 
			lakh babies die within one year of birth, mostly from preventable causes.”
			<footer style="color:blue;">Minister of Health & Family Welfare, Hindustan Times, 
				December 9, 2016
			</footer>
		</blockquote>
	</marquee>	
	</div>

	<?php endif ?>
</body>

</html>
