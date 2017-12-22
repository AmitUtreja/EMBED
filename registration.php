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
	<title>User Registration for EMBED</title>
</head>

<body>

	<form class="registration" method="post" action="registration.php">
		<div class="header">
			<h2>Register for EMBED</h2>
		</div>

		<!-- Display the validation errors here -->
		<?php include('registration_errors.php'); ?>

		<div class="input_group">
			<label>User Name </label>
			<input type="text" name="username" placeholder="Name" value="<?php echo $username; ?>">
		</div>
		<div class="input_group">
			<label>Email Address <p style="font-size:10px; font-style:italic; color:blue";)>(**this will be your user name for logging in)</p></label>
			<input type="text" name="email" placeholder="Email Address" value="<?php echo $email; ?>">
		</div>
		<div class="input_group">
			<label>Password </label>
			<input type="password" placeholder="Password" name="password_1">
		</div>
		<div class="input_group">
			<label>Confirm Password </label>
			<input type="password" placeholder="Retype Password" name="password_2">
		</div>
		<div class="input_group">
			<button type="submit" name="register" class="btn btn-primary">Register</button>
			<p>	Already a member ? <a href="login.php" style="text-decoration:none">Sign in &nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a> 
			<button type="submit" name="forgotpassword" class="btn btn-link" style="color:red; 
			text-decoration:none;" onmouseover="this.style.color='blue'"
			onmouseout="this.style.color='red'" >Forgot Password ? </button></p>
		</div>
	</form>

</body>


</html>
