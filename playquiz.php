<?php include('server.php'); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head><meta charset="utf-8" /><meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="shortcut icon" href="images/fhi360shortcut.jpg" />
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/embed.css">
	<script src="js/jquery-3.2.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/main.js"></script>	
	<title>fhi360 | Quiz</title>

</head>

<body class="quizbody">
	<div class="container-fluid" id="topheading">
		<h2>देवियो और सज्जनों आओ खेलते हैं  कौन बचाएगा दस लाख ज़िंदगियाँ</h2>
	</div>
	<audio id="mysoundclip" preload="auto">
	   <source src="media/startquiz.wav"></source>
	</audio>
	<div class="wrapper">
		<p> We will start the game in <span id="time">5</span> seconds</p>
		<a class="btn btn-success" id="proceed" href="playquiz.php?showquestions='1'">
			<font color="red">शुरू करें पहला सवाल</font></a>
	</div>
</body>
<!--
	-->
</html>