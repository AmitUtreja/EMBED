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
	<title>Password Reset - Project EMBED</title>
</head>

<body>

	<form class="registration" method="post" action="password_reset.php">
		<div class="header">
			<h2>Reset Password for EMBED</h2>
		</div>

		<!-- Display the validation errors here -->
		<?php include('registration_errors.php'); ?>
		<div class="input_group">
			<label>Email Address </label>
			<input type="password" placeholder="Email Address" name="email">
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
			<button type="submit" name="resetpassword" class="btn btn-primary">Reset Password</button>
		</div>		
	</form>

</body>


</html>
