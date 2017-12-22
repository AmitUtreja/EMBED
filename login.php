<?php include('server.php'); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head><meta charset="utf-8" /><meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="shortcut icon" href="images/fhi360shortcut.jpg" />
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/embed.css">
	<script src="js/jquery-3.2.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<title>Login into EMBED</title>
</head>

<body>
	<div id="loginpagebackground">
		<div id="loginformlocation">
			<form class="login" method="post" action="login.php">
				<div class="header" id="loginheader">
					<h2>Login into EMBED</h2>
				</div>
				
				<!-- Display the validation errors here -->
				<?php include('registration_errors.php'); ?>

				<div class="input_group">
					<label>Email Address </label>
					<input type="text" name="email" placeholder="Email Address">
				</div>
				<div class="input_group">
					<label>Password </label>
					<input type="password" name="password" placeholder="Password">
				</div>
				<div class="input_group">
					<button type="submit" name="login" class="btn">Login</button>
				</div>
				<p>Not yet a Member? <a href="registration.php" style="text-decoration:none">Sign up &nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a> 
				<button type="submit" name="forgotpassword" class="btn btn-link" style="color:red; 
					text-decoration:none;" onmouseover="this.style.color='blue'"
					onmouseout="this.style.color='red'" >Forgot Password ? </button></a></p>
			</form>
		</div>
	</div>
</body>


</html>
